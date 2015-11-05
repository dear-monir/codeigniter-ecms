<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/13/13
 * Time: 12:25 PM
 * To change this template use File | Settings | File Templates.
 */

class M_product_info extends CI_Model
{
    var $user_language;
    var $user_language_id;
    public function __construct()
    {
        $this->db->query ("set character_set_results='utf8'");
        $this->user_language = get_language();
        $this->user_language_id = get_language_id();
    }

    public function getProductInfo($product_id)
    {
        /*$query = "select products.product_id as product_id,product_quantity,product_model,product_price,product_name,product_description
                    from products,products_description
                    where products.product_id =$product_id and products.product_id = products_description.product_id  and language_id = {$this->user_language_id}";
        */
        $query = "select product_quantity,product_model,product_price,product_name,product_description,special_price
                    from
                    ( select products.product_id as product_id,product_quantity,product_model,product_price,product_name,product_description
                      from products,products_description
                      where products.product_id = $product_id and products.product_id = products_description.product_id  and language_id = {$this->user_language_id}
                    ) as tbl1

                    left join

                    (
                         select product_id,special_price
                         from   specials
                         where expire_date > curdate() and status = 1
                                and product_id = $product_id
                    ) as tbl2

                  on tbl1.product_id = tbl2.product_id";

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

    public function getProductOptions($product_id)
    {
        $query = "select    products_attributes.product_option_id as product_option_id,  product_option_name,product_option_value_id
                  from      products_attributes,product_option_description
                  where     product_id = $product_id and  language_id = {$this->user_language_id}
                            and products_attributes.product_option_id = product_option_description.product_option_id
                  group by  product_option_id";
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

    public function getOptionValues($product_id)
    {
        $query = "select  products_attributes.product_option_id,products_attributes.product_option_value_id,
                          option_value_price,price_prefix,product_option_value_name
                  from    products_attributes,products_options_values
                  where   products_options_values.product_option_value_id = products_attributes.product_option_value_id and language_id = {$this->user_language_id}
                          and products_options_values.product_option_id = products_attributes.product_option_id and product_id = $product_id";
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
}