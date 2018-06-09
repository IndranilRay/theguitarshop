<?php
/**
 * Created by PhpStorm.
 * User: neal
 * Date: 6/6/2018
 * Time: 9:18 PM
 */
// get the product id
$product_id = isset($_GET['id']) ? $_GET['id'] : 1;
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : "";

// make quantity a minimum of 1
$quantity=$quantity<=0 ? 1 : $quantity;

// connect to database
require_once 'bootstrap.php';
// include object
use classes\CartItem;

// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize objects
$cart_item = new CartItem($db);

// set cart item values
$cart_item->user_id=1; // we default to '1' because we do not have logged in user
$cart_item->prod_id=$product_id;
$cart_item->prod_quantity=$quantity;

// add to cart
if($cart_item->update()){
    // redirect to product list and tell the user it was added to cart
    header("Location: cart.php?action=updated");
}else{
    header("Location: cart.php?action=unable_to_update");
}