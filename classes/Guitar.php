<?php
/**
 * Created by PhpStorm.
 * User: Neal
 * Date: 6/2/2018
 * Time: 11:34 AM
 */

namespace classes;


class Guitar extends ShopProduct implements iProduct
{

    public $conn;
    public $guitar_id;
    public $guitar_brand_id;
    public $guitar_model_id;
    public $guitar_strings_cnt;
    public $guitar_name;
    public $guitar_tbl = 'product_guitar';
    public $parent_tbl = 'product_products';

    public function __construct($db){
        $this->conn = $db;
    }

    public function read($from_record_num, $records_per_page){

        $query = "SELECT
                p.prod_id as product_id, p.price, p.product_added_on, p.type, p.image,
                g.name as guitar_name
            FROM
                " . $this->parent_tbl . " p
                LEFT JOIN
                    $this->guitar_tbl g
                        ON g.prod_id = p.prod_id
            ORDER BY
                p.product_added_on DESC
            LIMIT
                ?, ?";


        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind limit clause variables
        $stmt->bindParam(1, $from_record_num, \PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, \PDO::PARAM_INT);

        // execute query
        \Database::execute($stmt);

        // return values
        return $stmt;

    }

    public function count(){
        // query to count all product records
        $query = "SELECT count(*) FROM " . $this->parent_tbl;

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // execute query

        \Database::execute($stmt);

        // get row value
        $rows = $stmt->fetch(\PDO::FETCH_NUM);

        // return count
        return $rows[0];

    }

    public function readByIds($ids){
        $ids_arr = str_repeat('?,', count($ids) - 1) . '?';

        $query = "SELECT p.prod_id as product_id, p.price, p.type, g.name as guitar_name,
                  g.type as guitar_type, g.no_of_strings as strings
                  FROM " . $this->parent_tbl . " p
                  LEFT JOIN $this->guitar_tbl g ON g.prod_id = p.prod_id
                  WHERE g.prod_id IN ({$ids_arr}) ORDER BY g.name ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        \Database::execute($stmt);

        // return values from database
        return $stmt;

    }

    public function readone(){
        // query to select single record
        $query = "SELECT
                p.prod_id as product_id, p.price, p.image,g.name as guitar_name,
                g.type as guitar_type, g.no_of_strings as strings
                  FROM
                " . $this->parent_tbl . " p
                  LEFT JOIN
                    $this->guitar_tbl g
                  ON g.prod_id = p.prod_id WHERE p.prod_id = ?
                  LIMIT 0,1";

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // sanitize
        $this->product_id=htmlspecialchars(strip_tags($this->product_id));

        // bind product id value
        $stmt->bindParam(1, $this->product_id);

        // execute query
        \Database::execute($stmt);

        // get row values
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        // assign retrieved row value to object properties
        $this->guitar_name = $row['guitar_name'];
        $this->product_price = $row['price'];
        $this->product_image = $row['image'];

    }

    public function getProductPrice()
    {
        // TODO: Implement getProductPrice() method.
    }

    public function getProductID()
    {
        // TODO: Implement getProductID() method.
    }

    public function getProductQuantity()
    {
        // TODO: Implement getProductQuantity() method.
    }

    public function getProductSKU()
    {
        // TODO: Implement getProductSKU() method.
    }

    public function getProductType()
    {
        // TODO: Implement getProductType() method.
    }

}