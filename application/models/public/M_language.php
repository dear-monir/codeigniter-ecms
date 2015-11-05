<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/27/13
 * Time: 10:33 PM
 * To change this template use File | Settings | File Templates.
 */
class M_language extends CI_Model
{
    var $user_language;
    var $user_language_id;
    public function __construct()
    {
        $this->db->query ("set character_set_results='utf8'");
        $this->user_language = get_language();
        $this->user_language_id = get_language_id();
    }

    public function getAll($product_id,$option_id,$opt_val_id)
    {

       /*$query = "select product_name,product_option_name,product_option_value_name
                 from products_description,products_options_values,product_option_description
                 where product_id = $product_id and product_option_id = $option_id
                and product_option_value_id = $opt_val_id  and language_id = {$this->user_language_id}";
       */

        $query = "select product_name,product_option_name,product_option_value_name
                  from   products_description as p_d,products_options_values as p_opt_val,product_option_description as p_opt_des
                  where  product_id = $product_id and p_opt_des.product_option_id = $option_id
                         and product_option_value_id = $option_id  and p_d.language_id = {$this->user_language_id}
                         and p_opt_val.language_id = {$this->user_language_id} and p_opt_des.language_id = {$this->user_language_id}";

        $q = $this->db->query($query);
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            {
                $data[] = $row;
            }
            return $data;

        }
    }

    public function getProductInfo($p_id)
    {
        $query = "select product_name from products_description
                  where  product_id = $p_id and language_id = {$this->user_language_id}";
        $q     = $this->db->query($query);
        if($q->num_rows()>0)
        {
            $row = $q->row_array();
            return $row['product_name'];
        }
    }

    public function getOptions($option_id,$opt_val_id)
    {
        $query = "select product_option_name,product_option_value_name
                       from product_option_description, products_options_values
                       where product_option_value_id = $opt_val_id and product_option_description.product_option_id = $option_id
                       and product_option_description.language_id = {$this->user_language_id} and products_options_values.language_id = {$this->user_language_id}";

        $q     = $this->db->query($query);
        if($q->num_rows()>0)
        {
            $row = $q->row_array();
            return $row;
        }
    }
}