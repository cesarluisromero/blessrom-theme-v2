<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class SingleProductComposer extends Composer
{
    protected static $views = [
        'woocommerce.single-product',
    ];

    public function with()
    {
        global $product;

        if (!$product || !is_a($product, 'WC_Product')) {
            $product = wc_get_product(get_the_ID());
        }

        // Obtener variaciones disponibles solo para productos variables
        $available_variations = [];
        if ($product && $product->is_type('variable')) {
            $available_variations = $product->get_available_variations();
        }

        return [
            'product'             => $product,
            'attachment_ids'      => $product->get_gallery_image_ids(),
            'main_image'          => $product->get_image_id(),
            'brand'             => $product->get_attribute('pa_marca'),
            'available_variations' => $available_variations,
        ];
    }
}



