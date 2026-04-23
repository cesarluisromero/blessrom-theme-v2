<?php

add_action('wp_ajax_custom_search', 'custom_search_handler');
add_action('wp_ajax_nopriv_custom_search', 'custom_search_handler');

function custom_search_handler() {
    $query = isset($_GET['query']) ? sanitize_text_field($_GET['query']) : '';
    $results = [];

    if (strlen($query) < 2) {
        wp_send_json($results);
        wp_die();
    }

    // Buscar categorías
    $terms = get_terms([
        'taxonomy'   => 'product_cat',
        'hide_empty' => true,
        'name__like' => $query,
    ]);

    if (!is_wp_error($terms)) {
        foreach ($terms as $term) {
            $slug = $term->slug;
            $parent = $term->parent ? get_term($term->parent, 'product_cat') : null;
            $parent_name = $parent ? $parent->name : '';
            $results[] = [
                'id'    => $term->term_id,
                'title' => $term->name,
                'url'   => home_url('/tienda/?categorias[]=' . $slug),
                'type'  => $parent_name ? "Categoría de $parent_name" : 'Categoría',
                'image' => wc_placeholder_img_src(),
            ];
        }
    }
    // Buscar productos
    $product_query = new WP_Query([
        'post_type'      => 'product',
        'posts_per_page' => 10,
        's'              => $query,
        'post_status'    => 'publish',
    ]);

    if ($product_query->have_posts()) {
        foreach ($product_query->posts as $product_post) {
            $product = wc_get_product($product_post->ID);
            if ($product) {
                $results[] = [
                    'id'    => $product->get_id(),
                    'title' => $product->get_name(),
                    'url'   => get_permalink($product->get_id()),
                    'type'  => 'Producto',
                    'image' => get_the_post_thumbnail_url($product->get_id(), 'thumbnail'),
                ];
            }
        }
    }

    // Buscar por atributos como talla y marca
    $attribute_taxonomies = ['pa_talla', 'pa_marcas'];
    foreach ($attribute_taxonomies as $taxonomy) {
        $terms = get_terms([
            'taxonomy'   => $taxonomy,
            'hide_empty' => true,
            'name__like' => $query,
        ]);

        if (!is_wp_error($terms)) {
            foreach ($terms as $term) {
                $results[] = [
                    'id'    => $term->term_id,
                    'title' => $term->name,
                    'url'   => home_url("/tienda/?{$taxonomy}[]=" . $term->slug),
                    'type'  => ucfirst(str_replace('pa_', '', $taxonomy)),
                    'image' => wc_placeholder_img_src(),
                ];
            }
        }
    }

    // --- INTEGRACIÓN DE IA (Búsqueda Semántica) ---
    // Si tenemos pocos resultados o queremos enriquecer la búsqueda
    $ai_args = [
        'headers' => ['Content-Type' => 'application/json'],
        'body'    => json_encode(['query' => $query, 'limit' => 3, 'minScore' => 0.5]),
        'method'  => 'POST',
        'timeout' => 5,
    ];

    $ai_response = wp_remote_post('http://77.37.43.158/ia-search', $ai_args);

    if (!is_wp_error($ai_response)) {
        $ai_body = wp_remote_retrieve_body($ai_response);
        $ai_data = json_decode($ai_body, true);

        if (isset($ai_data['results']) && !empty($ai_data['results'])) {
            foreach ($ai_data['results'] as $ai_prod) {
                // Evitar duplicados si ya lo encontró WP
                $exists = false;
                foreach ($results as $res) {
                    if ($res['id'] == $ai_prod['id']) { $exists = true; break; }
                }

                if (!$exists) {
                    $results[] = [
                        'id'    => $ai_prod['id'],
                        'title' => $ai_prod['name'],
                        'url'   => $ai_prod['url'], // Usamos la URL completa que ya viene de la IA
                        'type'  => 'Sugerencia IA ✨',
                        'image' => !empty($ai_prod['imageUrl']) ? $ai_prod['imageUrl'] : wc_placeholder_img_src(),
                    ];
                }
            }
        }
    }
    // --- FIN INTEGRACIÓN IA ---

    wp_send_json($results);
    wp_die();
}
add_action('wp_ajax_add_product_to_cart', 'custom_add_to_cart_ajax');
add_action('wp_ajax_nopriv_add_product_to_cart', 'custom_add_to_cart_ajax');

function custom_add_to_cart_ajax() {
    // Verifica el nonce si es necesario
    // check_ajax_referer('woocommerce-add-to-cart', '_wpnonce');

    $product_id = intval($_POST['add-to-cart'] ?? 0);
    $variation_id = intval($_POST['variation_id'] ?? 0);
    $quantity = intval($_POST['quantity'] ?? 1);
    $attributes = [];

    foreach ($_POST as $key => $value) {
        if (strpos($key, 'attribute_') === 0) {
            $attributes[$key] = sanitize_text_field($value);
        }
    }

    $added = WC()->cart->add_to_cart($product_id, $quantity, $variation_id, $attributes);

    if ($added) {
        wp_send_json([
            'success' => true,
            'fragments' => apply_filters('woocommerce_add_to_cart_fragments', []),
            'cart_hash' => WC()->cart->get_cart_hash()
        ]);
    } else {
        wp_send_json_error('No se pudo agregar el producto al carrito.');
    }

    wp_die();
}

add_action('wp_ajax_custom_quick_view', 'App\\custom_quick_view_handler');
add_action('wp_ajax_nopriv_custom_quick_view', 'App\\custom_quick_view_handler');

function custom_quick_view_handler() {
    $product_id = intval($_GET['product_id'] ?? 0);
    $product = wc_get_product($product_id);

    if (!$product) {
        wp_send_json_error('Producto no encontrado.');
    }

    $data = [
        'id' => $product->get_id(),
        'name' => $product->get_name(),
        'price_html' => $product->get_price_html(),
        'description' => $product->get_short_description(),
        'image' => wp_get_attachment_image_url($product->get_image_id(), 'large'),
        'gallery' => array_map(function($id) {
            return wp_get_attachment_image_url($id, 'large');
        }, $product->get_gallery_image_ids()),
        'permalink' => get_permalink($product->get_id()),
    ];

    if ($product->is_type('variable')) {
        $data['variations'] = $product->get_available_variations();
        $data['attributes'] = $product->get_variation_attributes();
    }
}

add_action('wp_ajax_semantic_search', 'semantic_search_handler');
add_action('wp_ajax_nopriv_semantic_search', 'semantic_search_handler');

function semantic_search_handler() {
    // Capturamos la consulta de cualquier medio (GET/POST/JSON)
    $query = '';
    if (!empty($_REQUEST['query'])) {
        $query = sanitize_text_field($_REQUEST['query']);
    } elseif (!empty($_GET['query'])) {
        $query = sanitize_text_field($_GET['query']);
    }

    if (empty($query)) {
        wp_send_json_error('Consulta vacía en el puente');
    }

    // Enviamos la petición POST JSON al VPS a través del túnel Nginx (Puerto 80)
    $args = [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
        ],
        'body'        => json_encode([
            'query'    => $query,
            'limit'    => 4,
            'minScore' => 0.5
        ]),
        'method'      => 'POST',
        'data_format' => 'body',
        'timeout'     => 10,
    ];

    $response = wp_remote_post('http://77.37.43.158/ia-search', $args);

    if (is_wp_error($response)) {
        wp_send_json_error('Error de conexión con VPS: ' . $response->get_error_message());
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (isset($data['results'])) {
        wp_send_json_success($data['results']);
    } else {
        wp_send_json_error('La IA en el VPS no devolvió resultados validos');
    }

    wp_die();
}

// --- CHAT INTELIGENTE WEB ---
add_action('wp_ajax_web_chat', 'web_chat_handler');
add_action('wp_ajax_nopriv_web_chat', 'web_chat_handler');

function web_chat_handler() {
    $session_id = sanitize_text_field($_POST['session_id'] ?? '');
    $message = sanitize_text_field($_POST['message'] ?? '');
    $product_id = sanitize_text_field($_POST['product_id'] ?? '');

    if (empty($message)) {
        wp_send_json_error('Mensaje vacío');
    }

    $body = [
        'sessionId' => $session_id,
        'message' => $message,
    ];

    // Identificar al usuario si está logueado en WordPress
    if (is_user_logged_in()) {
        $current_user = wp_get_current_user();
        $body['userId'] = (string)$current_user->ID;
        $body['userName'] = $current_user->display_name;
    }

    if (!empty($product_id)) {
        $body['currentProductId'] = $product_id;
    }

    $response = wp_remote_post('http://77.37.43.158:8080/web-chat', [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'body' => json_encode($body),
        'timeout' => 15,
        'data_format' => 'body',
    ]);

    if (is_wp_error($response)) {
        wp_send_json_error('Error de conexión con el asistente: ' . $response->get_error_message());
    }

    $data = json_decode(wp_remote_retrieve_body($response), true);

    // Enriquecer las tarjetas de producto con URLs de "Agregar al carrito"
    if (!empty($data['products'])) {
        foreach ($data['products'] as &$product) {
            $wc_product = wc_get_product(intval($product['id']));
            if ($wc_product) {
                $product['addToCartUrl'] = $wc_product->add_to_cart_url();
                $product['permalink'] = get_permalink($wc_product->get_id());
                $product['priceHtml'] = $wc_product->get_price_html();
                $product['priceFormatted'] = wc_price($wc_product->get_price()); // Añadir este campo para el JS
                // Usar imagen de WP si la del índice no existe
                if (empty($product['imageUrl'])) {
                    $product['imageUrl'] = wp_get_attachment_image_url($wc_product->get_image_id(), 'thumbnail');
                }
            }
        }
    }

    wp_send_json_success($data);
    wp_die();
}

// --- RECOMENDACIONES DE PRODUCTOS ---
add_action('wp_ajax_product_recommendations', 'product_recommendations_handler');
add_action('wp_ajax_nopriv_product_recommendations', 'product_recommendations_handler');

function product_recommendations_handler() {
    $product_id = sanitize_text_field($_GET['product_id'] ?? '');
    $limit = intval($_GET['limit'] ?? 4);
    $price_range = floatval($_GET['price_range'] ?? 0); // ±rango de precio

    if (empty($product_id)) {
        wp_send_json_error('Product ID requerido');
    }

    // Obtener el nombre del producto actual para buscar similares por semántica
    $product = wc_get_product(intval($product_id));
    if (!$product) {
        wp_send_json_error('Producto no encontrado');
    }

    $query = $product->get_name() . ' ' . wp_strip_all_tags($product->get_short_description());
    $current_price = floatval($product->get_price());

    $response = wp_remote_post('http://77.37.43.158/ia-search', [
        'headers' => ['Content-Type' => 'application/json'],
        'body' => json_encode([
            'query' => $query,
            'limit' => $limit + 5, // Pedimos extras para filtrar por precio
            'minScore' => 0.4,
        ]),
        'timeout' => 10,
    ]);

    if (is_wp_error($response)) {
        wp_send_json_error('Error obteniendo recomendaciones');
    }

    $data = json_decode(wp_remote_retrieve_body($response), true);
    $recommendations = [];

    if (!empty($data['results'])) {
        foreach ($data['results'] as $item) {
            // Excluir el producto actual
            if ($item['id'] == $product_id) continue;

            // Filtro de precio: si se especificó un rango, solo incluir productos en rango
            if ($price_range > 0 && !empty($item['price'])) {
                $item_price = floatval($item['price']);
                if ($item_price < ($current_price - $price_range) || $item_price > ($current_price + $price_range)) {
                    continue;
                }
            }

            // Enriquecer con datos de WooCommerce
            $wc_item = wc_get_product(intval($item['id']));
            if ($wc_item) {
                $recommendations[] = [
                    'id' => $item['id'],
                    'name' => $wc_item->get_name(),
                    'imageUrl' => wp_get_attachment_image_url($wc_item->get_image_id(), 'medium'),
                    'url' => get_permalink($wc_item->get_id()),
                    'priceHtml' => $wc_item->get_price_html(),
                    'addToCartUrl' => $wc_item->add_to_cart_url(),
                    'score' => $item['score'] ?? 0,
                ];
            }

            if (count($recommendations) >= $limit) break;
        }
    }

    wp_send_json_success($recommendations);
    wp_die();
}
