<?php
/**
 * Created by PhpStorm.
 * User: neal
 * Date: 6/6/2018
 * Time: 11:12 PM
 */
// include database
require_once 'bootstrap.php';

// include classes
use classes\Guitar;
use classes\CartItem;


// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize objects
$product = new Guitar($db);
//$product_image = new ProductImage($db);
$cart_item = new CartItem($db);

// get ID of the product to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
$action = isset($_GET['action']) ? $_GET['action'] : "";

// set the id as product id property
$product->product_id = $id;

// to read single record product
$product->readOne();

// set page title
$page_title = $product->guitar_name;

// include page header HTML
include_once 'header.php';

echo "<div class='col-md-12'>";
if($action=='added'){
    echo "<div class='alert alert-info'>";
    echo "Product was added to your cart!";
    echo "</div>";
}

else if($action=='unable_to_add'){
    echo "<div class='alert alert-info'>";
    echo "Unable to add product to cart. Please contact Admin.";
    echo "</div>";
}
echo "</div>";

echo "<div class='col-md-1'>";
if(!empty($product->product_image)){
    echo "<img src='uploads/images/{$product->product_image}' class='product-img-thumb'/>";
}else{
    echo "No images for this product";
}
echo "</div>";

echo "<div class='col-md-5'>";

echo "<div class='product-detail'>Price:</div>";
echo "<h4 class='m-b-10px price-description'>&#36;" . number_format($product->product_price, 2, '.', ',') . "</h4>";

echo "<div class='product-detail'>Description:</div>";
echo "<div class='m-b-10px'>";
// make html
$page_description = htmlspecialchars_decode(htmlspecialchars_decode($product->guitar_strings_cnt));

// show to user
echo $page_description;
echo "</div>";

echo "<div class='product-detail'>Product category:</div>";
echo "<div class='m-b-10px'>{$product->category_name}</div>";

echo "</div>";
// include page footer HTML
include_once 'footer.php';