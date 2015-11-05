<?php
/**
 * Created by PhpStorm.
 * User: Monir
 * Date: 7/4/14
 * Time: 10:49 PM
 */
class M_order extends CI_model
{

    public function __construct()
    {
        parent::__construct();
        $this->db->query("set character_set_results='utf8'");
    }

    public function getTaxRate($product_id,$country_id)
    {
        $query = "select tax_rate from tax_rates,products where tax_rates.tax_class_id = products.tax_class_id and tax_rates.country_id = $country_id and product_id = $product_id";
        return $this->db->query($query)->first_row();
    }

    public function confirm($order,$order_products,$order_products_options)
    {
        $this->load->model('admin/m_products');
        $this->db->trans_start();
        $this->db->set('order_date','NOW()',false);
        $this->db->insert('orders', $order);
        $order_id = $this->db->insert_id();

        foreach($order_products as $r_p)
        {
            $products = $r_p + array('order_id'=>$order_id);
            $product_id = $r_p['product_id'];
            $qty = $r_p['product_quantity'];
            $this->m_products->decreaseProduct($product_id,$qty);
            $this->db->insert('orders_products', $products);
        }

        foreach($order_products_options as $r_p_o)
        {
            $products_options = $r_p_o + array('order_id'=>$order_id);
            $this->db->insert('orders_products_options', $products_options);
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}