<?php
/**
 * Created by PhpStorm.
 * User: Neal
 * Date: 06/02/2018
 */
class Database
{
    // Database credentials
    public $conn = null;

    /* getConnection(): Method returns a vaild database connection object
     * return:(object)PDO
     */
    public function getConnection(){
        if($this->conn === null){
            try{
                $this->conn =
                    new \PDO('mysql:host=localhost;dbname=guitar_shop', 'root','');
                $this->conn->exec("set names utf8");
            } catch (PDOException $e){
                echo $e->getMessage();
            }
        }
        return $this->conn;
    }
}