<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Response;

class FeedController extends Controller
{
    public function googleShopping()
    {
        $products = Product::with(['category', 'brand', 'primaryImage'])
            ->where('is_active', true)
            ->where('stock', '>', 0)
            ->get();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<rss version="2.0" xmlns:g="http://base.google.com/ns/1.0">';
        $xml .= '<channel>';
        $xml .= '<title>Strikeball Shop</title>';
        $xml .= '<link>' . url('/') . '</link>';
        $xml .= '<description>Інтернет-магазин страйкбольного обладнання</description>';

        foreach ($products as $product) {
            $xml .= '<item>';
            $xml .= '<g:id>' . $product->id . '</g:id>';
            $xml .= '<g:title><![CDATA[' . $product->name . ']]></g:title>';
            $xml .= '<g:description><![CDATA[' . strip_tags($product->description ?? $product->name) . ']]></g:description>';
            $xml .= '<g:link>' . route('product.show', $product->slug) . '</g:link>';

            if ($product->primaryImage) {
                $xml .= '<g:image_link>' . asset('storage/' . $product->primaryImage->image_path) . '</g:image_link>';
            }

            $xml .= '<g:condition>new</g:condition>';
            $xml .= '<g:availability>in stock</g:availability>';
            $xml .= '<g:price>' . number_format($product->price, 2, '.', '') . ' UAH</g:price>';

            if ($product->brand) {
                $xml .= '<g:brand><![CDATA[' . $product->brand->name . ']]></g:brand>';
            }

            $xml .= '<g:product_type><![CDATA[' . $product->category->name . ']]></g:product_type>';
            $xml .= '<g:google_product_category>Sporting Goods &gt; Outdoor Recreation &gt; Paintball &amp; Airsoft</g:google_product_category>';

            if ($product->sku) {
                $xml .= '<g:mpn>' . $product->sku . '</g:mpn>';
            }

            $xml .= '<g:identifier_exists>no</g:identifier_exists>';

            $xml .= '</item>';
        }

        $xml .= '</channel>';
        $xml .= '</rss>';

        return response($xml, 200)
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function facebookCatalog()
    {
        $products = Product::with(['category', 'brand', 'primaryImage'])
            ->where('is_active', true)
            ->where('stock', '>', 0)
            ->get();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<rss version="2.0" xmlns:g="http://base.google.com/ns/1.0">';
        $xml .= '<channel>';
        $xml .= '<title>Strikeball Shop</title>';
        $xml .= '<link>' . url('/') . '</link>';
        $xml .= '<description>Інтернет-магазин страйкбольного обладнання</description>';

        foreach ($products as $product) {
            $xml .= '<item>';
            $xml .= '<g:id>' . $product->id . '</g:id>';
            $xml .= '<g:title><![CDATA[' . $product->name . ']]></g:title>';
            $xml .= '<g:description><![CDATA[' . strip_tags($product->description ?? $product->name) . ']]></g:description>';
            $xml .= '<g:link>' . route('product.show', $product->slug) . '</g:link>';

            if ($product->primaryImage) {
                $xml .= '<g:image_link>' . asset('storage/' . $product->primaryImage->image_path) . '</g:image_link>';
            }

            $xml .= '<g:condition>new</g:condition>';
            $xml .= '<g:availability>in stock</g:availability>';
            $xml .= '<g:price>' . number_format($product->price, 2, '.', '') . ' UAH</g:price>';

            if ($product->brand) {
                $xml .= '<g:brand><![CDATA[' . $product->brand->name . ']]></g:brand>';
            }

            $xml .= '</item>';
        }

        $xml .= '</channel>';
        $xml .= '</rss>';

        return response($xml, 200)
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
