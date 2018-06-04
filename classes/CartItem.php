<?php

namespace classes;


class CartItem implements iCart
{
    // database connection and table name
    private $conn;
    private $table_name = "product_cart";

    // object properties
    public $cart_id;
    public $prod_id;
    public $user_id;
    public $prod_quantity;
    public $created;
    public $modified;

    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

    public function exists()
    {
        // query to count existing cart item
        $query = "SELECT count(*) FROM " . $this->table_name . " WHERE prod_id=:product_id AND user_id=:user_id";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // sanitize
        $this->prod_id=htmlspecialchars(strip_tags($this->prod_id));
        $this->user_id=htmlspecialchars(strip_tags($this->user_id));

        // bind category id variable
        $stmt->bindParam(":product_id", $this->product_id);
        $stmt->bindParam(":user_id", $this->user_id);

        // execute query
        $stmt->execute();

        // get row value
        $rows = $stmt->fetch(\PDO::FETCH_NUM);

        // return
        if($rows[0]>0){
            return true;
        }

        return false;
    }

    // count user's items in the cart
    public function count(){

        // query to count existing cart item
        $query = "SELECT count(*) FROM " . $this->table_name . " WHERE user_id=:user_id";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // sanitize
        $this->user_id=htmlspecialchars(strip_tags($this->user_id));

        // bind category id variable
        $stmt->bindParam(":user_id", $this->user_id);

        // execute query
        $stmt->execute();

        // get row value
        $rows = $stmt->fetch(\PDO::FETCH_NUM);

        // return
        return $rows[0];
    }

}