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
        \Database::execute($stmt);

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
        \Database::execute($stmt);

        // get row value
        $rows = $stmt->fetch(\PDO::FETCH_NUM);

        // return
        return $rows[0];
    }

    // create cart item record
    function create(){

        // to get times-tamp for 'created' field
        $this->created=date('Y-m-d H:i:s');

        // query to insert cart item record

        $query = "INSERT INTO " . $this->table_name . "
            SET
                prod_id = :product_id,
                prod_quantity = :quantity,
                user_id = :user_id,
                created = :created";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->prod_id=htmlspecialchars(strip_tags($this->prod_id));
        $this->prod_quantity=htmlspecialchars(strip_tags($this->prod_quantity));
        $this->user_id=htmlspecialchars(strip_tags($this->user_id));

        // bind values
        $stmt->bindParam(":product_id", $this->prod_id);
        $stmt->bindParam(":quantity", $this->prod_quantity);
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":created", $this->created);

        // execute query
        \Database::execute($stmt);

        return true;
    }

    // read items in the cart
    public function read(){

        $query="SELECT p.prod_id, g.name, p.price, ci.prod_quantity, ci.prod_quantity * p.price AS subtotal
            FROM " . $this->table_name . " ci
                LEFT JOIN product_products p
                    ON ci.prod_id = p.prod_id
                LEFT JOIN product_guitar g
                    ON g.prod_id = p.prod_id
            WHERE ci.user_id=:user_id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->user_id=htmlspecialchars(strip_tags($this->user_id));

        // bind value
        $stmt->bindParam(":user_id", $this->user_id, \PDO::PARAM_INT);

        // execute query
        \Database::execute($stmt);

        // return values
        return $stmt;
    }

    public function update(){
        // query to insert cart item record
        $query = "UPDATE " . $this->table_name . "
            SET prod_quantity=:quantity
            WHERE prod_id=:product_id AND user_id=:user_id";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->prod_quantity=htmlspecialchars(strip_tags($this->prod_quantity));
        $this->prod_id=htmlspecialchars(strip_tags($this->prod_id));
        $this->user_id=htmlspecialchars(strip_tags($this->user_id));

        // bind values
        $stmt->bindParam(":quantity", $this->prod_quantity);
        $stmt->bindParam(":product_id", $this->prod_id);
        $stmt->bindParam(":user_id", $this->user_id);

        // execute query
        \Database::execute($stmt);
        return true;
    }

    public function delete(){
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE prod_id=:product_id AND user_id=:user_id";
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->product_id=htmlspecialchars(strip_tags($this->product_id));
        $this->user_id=htmlspecialchars(strip_tags($this->user_id));

        // bind ids
        $stmt->bindParam(":product_id", $this->prod_id);
        $stmt->bindParam(":user_id", $this->user_id);

        //execute query
        \Database::execute($stmt);
        return false;
    }

    // remove cart items by user
    public function deleteByUser(){
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE user_id=:user_id";
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->user_id=htmlspecialchars(strip_tags($this->user_id));

        // bind id
        $stmt->bindParam(":user_id", $this->user_id);

        \Database::execute($stmt);

        return true;
    }

}