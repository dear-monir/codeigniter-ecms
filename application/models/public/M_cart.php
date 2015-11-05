<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/15/13
 * Time: 3:10 PM
 * To change this template use File | Settings | File Templates.
 */
class M_cart extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->db->query ("set character_set_results='utf8'");
    }
    public function getNumProduct($product_id)
    {
        $query = "select * from products where product_id = $product_id";
        $result = $this->db->query($query);
        $row = $result->row_array();
        return $row['product_quantity'];
    }

}