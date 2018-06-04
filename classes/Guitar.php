<?php
/**
 * Created by PhpStorm.
 * User: ABC
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

        if (!$stmt->execute()) {
            echo "\nPDO::errorInfo():\n";
            print_r($stmt->errorInfo());
            die(1);
        }

        // return values
        return $stmt;

    }

    public function count(){
        // query to count all product records
        $query = "SELECT count(*) FROM " . $this->parent_tbl;

        // prepare query statement
        $stmt = $this->conn->prepare( $query );

        // execute query
        $stmt->execute();

        if (!$stmt->execute()) {
            echo "\nPDO::errorInfo():\n";
            print_r($stmt->errorInfo());
            die(1);
        }

        // get row value
        $rows = $stmt->fetch(\PDO::FETCH_NUM);

        // return count
        return $rows[0];

    }

    public function readById(){

    }

    public function readone(){

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