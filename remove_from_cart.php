<?php
/**
 * Created by PhpStorm.
 * User: neal
 * Date: 6/6/2018
 * Time: 9:39 PM
 */
// get the product id
$product_id = isset($_GET['id']) ? $_GET['id'] : "";

// include database
require_once 'bootstrap.php';
// include object
use classes\CartItem;

// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize objects
$cart_item = new CartItem($db);

// remove cart item from database
$cart_item->user_id=1; // we default to '1' because we do not have logged in user
$cart_item->prod_id=$product_id;
$cart_item->delete();

// redirect to product list and tell the user it was added to cart
header('Location: cart.php?action=removed&id=' . $id);