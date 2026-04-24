<?php

namespace App;

/**
 * Agrega el Meta Box de IA en la pantalla de edición de productos de WooCommerce
 */
add_action('add_meta_boxes', function () {
    add_meta_box(
        'blessrom_ai_description_box',
        '🤖 Descripción Persuasiva IA',
        __NAMESPACE__ . '\\render_ai_description_metabox',
        'product',
        'side',
        'high'
    );
});

/**
 * Renderiza el contenido del Meta Box
 */
function render_ai_description_metabox($post) {
    $ai_desc = get_post_meta($post->ID, '_blessrom_ai_description', true);
    wp_nonce_field('blessrom_ai_save', 'blessrom_ai_nonce');
    ?>
    <div class="blessrom-ai-box">
        <textarea id="blessrom_ai_description" name="blessrom_ai_description" style="width:100%; min-height:120px; border-radius: 8px; margin-bottom: 10px;" placeholder="La descripción IA aparecerá aquí..."><?php echo esc_textarea($ai_desc); ?></textarea>
        
        <button type="button" id="blessrom-generate-ai" class="button button-primary" style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 8px; background: #2563eb; border-color: #1d4ed8;">
            <span class="dashicons dashicons-superhero" style="margin-top: 4px;"></span>
            Generar con IA
        </button>

        <p class="description" style="margin-top: 10px; font-size: 11px;">
            Haga clic para generar una descripción persuasiva basada en el nombre y categoría del producto.
        </p>

        <script>
            jQuery(document).ready(function($) {
                $('#blessrom-generate-ai').on('click', function() {
                    const btn = $(this);
                    const originalText = btn.html();
                    const productId = <?php echo $post->ID; ?>;

                    btn.prop('disabled', true).html('🪄 Generando...');

                    $.ajax({
                        url: ajaxurl,
                        type: 'POST',
                        data: {
                            action: 'blessrom_generate_ai_desc',
                            product_id: productId,
                            nonce: '<?php echo wp_create_nonce("blessrom_ai_ajax_nonce"); ?>'
                        },
                        success: function(response) {
                            if (response.success) {
                                $('#blessrom_ai_description').val(response.data.description);
                            } else {
                                alert('Error: ' + response.data.message);
                            }
                        },
                        error: function() {
                            alert('Error de conexión con el servidor.');
                        },
                        complete: function() {
                            btn.prop('disabled', false).html(originalText);
                        }
                    });
                });
            });
        </script>
    </div>
    <?php
}

/**
 * Guarda manualmente los cambios en el campo de IA si el usuario edita el texto
 */
add_action('save_post_product', function ($post_id) {
    if (!isset($_POST['blessrom_ai_nonce']) || !wp_verify_nonce($_POST['blessrom_ai_nonce'], 'blessrom_ai_save')) {
        return;
    }
    if (isset($_POST['blessrom_ai_description'])) {
        update_post_meta($post_id, '_blessrom_ai_description', sanitize_textarea_field($_POST['blessrom_ai_description']));
    }
});

/**
 * AJAX Handler para generar la descripción con OpenAI
 */
add_action('wp_ajax_blessrom_generate_ai_desc', function () {
    check_ajax_referer('blessrom_ai_ajax_nonce', 'nonce');

    $product_id = intval($_POST['product_id']);
    $product = wc_get_product($product_id);

    if (!$product) {
        wp_send_json_error(['message' => 'Producto no encontrado']);
    }

    // Verificar si la API KEY existe
    if (!defined('OPENAI_API_KEY') || empty(OPENAI_API_KEY)) {
        wp_send_json_error(['message' => 'API Key de OpenAI no configurada en wp-config.php']);
    }

    $name = $product->get_name();
    $categories = strip_tags($product->get_categories());
    $short_desc = strip_tags($product->get_short_description());

    $prompt = "Eres un copywriter de respuesta directa experto en moda de lujo y psicología del consumo. Tu misión es VENDER este producto AHORA. 
    Genera una descripción ultra-persuasiva, audaz y agresiva que genere un deseo irresistible. 
    Enfócate en la exclusividad, en cómo la cliente será el centro de todas las miradas y en la sensación de poder y belleza al usarlo.
    
    Usa frases cortas, potentes y de alto impacto. Máximo 3 frases.
    
    Producto: {$name}
    Categorías: {$categories}
    Descripción base: {$short_desc}
    
    IMPORTANTE: No uses emojis. No menciones el precio. No uses introducciones aburridas. Ve directo a la emoción y al deseo.";

    $response = wp_remote_post('https://api.openai.com/v1/chat/completions', [
        'headers' => [
            'Authorization' => 'Bearer ' . OPENAI_API_KEY,
            'Content-Type'  => 'application/json',
        ],
        'timeout' => 30,
        'body'    => json_encode([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $prompt]
            ],
            'temperature' => 0.7,
        ]),
    ]);

    if (is_wp_error($response)) {
        wp_send_json_error(['message' => $response->get_error_message()]);
    }

    $body = json_decode(wp_remote_retrieve_body($response), true);
    $ai_text = $body['choices'][0]['message']['content'] ?? '';

    if (empty($ai_text)) {
        wp_send_json_error(['message' => 'La IA no devolvió ningún resultado. Verifique su API Key o cuota.']);
    }

    // Opcional: Actualizar automáticamente al generar
    update_post_meta($product_id, '_blessrom_ai_description', sanitize_textarea_field($ai_text));

    wp_send_json_success(['description' => $ai_text]);
});
