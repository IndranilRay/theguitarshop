<?php
/**
 * Created by PhpStorm.
 * User: ABC
 * Date: 6/2/2018
 * Time: 11:32 AM
 */

namespace classes;


abstract class ShopProduct
{
    public $product_id;
    public $product_sku;
    public $product_price;
    public $product_addded_on;
    public $product_type;
    public $product_quantiy;
    public $product_image;

    abstract protected function getProductID();

    abstract protected function getProductSKU();

    abstract protected function getProductPrice();

    abstract protected function getProductType();

    abstract protected function getProductQuantity();

}