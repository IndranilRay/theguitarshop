<?php
use classes\Guitar;
use classes\CartItem;
require_once 'bootstrap.php';

// set page title
$page_title="Products";

$database = new Database();
$db = $database->getConnection();

// Initialize product objects
$product = new Guitar($db);
$product->read(0,6);
$cart_item = new CartItem($db);

// page header html
include 'header.php';

// to prevent undefined index notice
$action = isset($_GET['action']) ? $_GET['action'] : "";

// for pagination purposes
$page = isset($_GET['page']) ? $_GET['page'] : 1; // page is the current page, if there's nothing set, default is page 1
$records_per_page = 6; // set records or rows of data per page
$from_record_num = ($records_per_page * $page) - $records_per_page; // calculate for the query LIMIT clause

// read all products in the database
$stmt=$product->read($from_record_num, $records_per_page);

// count number of retrieved products
$num = $stmt->rowCount();

// if products retrieved were more than zero
if($num>0){
    // needed for paging
    $page_url="products.php?";
    $total_rows=$product->count();

    // show products
    include_once "read_products_template.php";
}

// tell the user if there's no products in the database
else{
    echo "<div class='col-md-12'>";
    echo "<div class='alert alert-danger'>No products found.</div>";
    echo "</div>";
}

// layout footer code
include 'footer.php';
?>