<?php
/**
 * Created by PhpStorm.
 * User: neal
 * Date: 6/6/2018
 * Time: 11:08 PM
 */
// include classes
require_once 'bootstrap.php';

use classes\CartItem;


// get database connection
$database = new Database();
$db = $database->getConnection();

// initialize objects
$cart_item = new CartItem($db);

// remove all cart item by user, from database
$cart_item->user_id=1; // we default to '1' because we do not have logged in user
$cart_item->deleteByUser();

// set page title
$page_title="Thank You!";

// include page header HTML
include_once 'header.php';

echo "<div class='col-md-12'>";
// tell the user order has been placed
echo "<div class='alert alert-success'>";
echo "<strong>Your order has been placed!</strong> Thank you very much!";
echo "</div>";
echo "</div>";

// include page footer HTML
include_once 'footer.php';