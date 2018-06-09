<?php
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    // creating box
    echo "<div class='col-md-4 m-b-20px'>";

    // product id for javascript access
    echo "<div class='product-id display-none'>{$product_id}</div>";

    echo "<a href='product.php?id={$product_id}' class='product-link'>";

    echo "<img src='uploads/images/{$image}' class='w-50-h-50' />";

    // product name
    echo "<div class='product-name m-b-10px'>{$guitar_name}</div>";
    echo "</a>";

    // product price and category name
    echo "<div class='m-b-10px'>";
    echo "&#36;" . number_format($price, 2, '.', ',');
    echo "</div>";

    // add to cart button
    echo "<div class='m-b-10px'>";
    // cart item settings
    $cart_item->user_id=1; // we default to a user with ID "1" for now
    $cart_item->prod_id=$product_id;

    // if product was already added in the cart
    if($cart_item->exists()){
        echo "<a href='cart.php' class='btn btn-success w-100-pct'>";
        echo "Update Cart";
        echo "</a>";
    }else{
        echo "<a href='add_to_cart.php?id={$product_id}&page={$page}' class='btn btn-primary w-100-pct'>Add to Cart</a>";
    }
    echo "</div>";



    echo "</div>";
}

include_once "paging.php";
