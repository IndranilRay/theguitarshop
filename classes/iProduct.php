<?php
/**
 * Created by PhpStorm.
 * User: ABC
 * Date: 6/2/2018
 * Time: 11:29 AM
 */

namespace classes;


interface iProduct
{
    /* Must implement this method to read all
     * product from database
     */
    public function read($offset, $records_per_page);

    public function count();

    public function readByIds($ids);

    public function readone();

}