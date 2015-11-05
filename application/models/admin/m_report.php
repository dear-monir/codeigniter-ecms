<?php
/**
 * Created by PhpStorm.
 * User: Monir
 * Date: 7/6/14
 * Time: 9:47 PM
 */

class M_report extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db->query ("set character_set_results='utf8'");
    }

    public function getAllOrder($status)
    {
        $query = "select * from orders where status = $status";
        $q     = $this->db->query($query);
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getById($order_id)
    {
        $query = "select * from orders where id = $order_id";
        return $this->db->query($query)->first_row();
    }

    public function details($order_id)
    {
        $query = "select order_id,product_id,product_name,product_price,product_tax,product_quantity,total_price from orders_products where order_id = $order_id ";
        $q     = $this->db->query($query);
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getProductOptions($order_id,$product_id)
    {
        $query = "select * from orders_products_options where order_id = $order_id and product_id = $product_id";
        $q     = $this->db->query($query);
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function update_order($data,$order_id){

        $this->db->where('id', $order_id);
        $this->db->update('orders', $data);
    }

    public function getCustomerOrder($customer_id)
    {
        $query = "select * from orders where customer_id = $customer_id";
        $q     = $this->db->query($query);
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }
} 