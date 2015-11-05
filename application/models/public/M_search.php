<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 11/20/13
 * Time: 8:29 PM
 * To change this template use File | Settings | File Templates.
 */

class M_search extends CI_Model
{
    var $user_language;
    var $user_language_id;
    public function __construct()
    {
        $this->db->query ("set character_set_results='utf8'");
        $this->user_language = get_language();
        $this->user_language_id = get_language_id();
    }

    private function bulid_search_query($product_name)
    {
        $keywords = explode(' ',$product_name);
        $searchTermKeywords = array();
        foreach ($keywords as $word)
        {

            $searchTermKeywords[] = "(product_description LIKE '%$word%' or product_name LIKE '%$word%')";

        }
        return $searchTermKeywords;
    }

    public function count_suggested_product($product_name)
    {
        $searchTermKeywords = $this->bulid_search_query($product_name);
        //  $query = "select product_name form products_description where language_id = {$this->user_language_id}
        //                                                            and product_name like '%$product_name'";
        //$query = "SELECT product_name FROM products_description WHERE language_id = {$this->user_language_id} and product_name like '".$product_name."%'";
        $query = "SELECT count(*)as count FROM products,products_description WHERE product_status = 1 and  date_available <= curdate() and language_id = {$this->user_language_id} and ". implode(' or ',$searchTermKeywords);
        $q = $this->db->query($query);
        //print_r($q);
        if($q->num_rows()>0)
        {
            foreach($q->result_array() as $row)
            {
                return $row['count'];
            }
        }
    }
    public function suggested_product_names($product_name)
    {
        $searchTermKeywords = $this->bulid_search_query($product_name);
      //  $query = "select product_name form products_description where language_id = {$this->user_language_id}
           //                                                            and product_name like '%$product_name'";
        //$query = "SELECT product_name FROM products_description WHERE language_id = {$this->user_language_id} and product_name like '".$product_name."%'";
        $query = "SELECT distinct product_name FROM products,products_description WHERE product_status = 1 and  date_available <= curdate() and language_id = {$this->user_language_id} and ". implode(' or ',$searchTermKeywords);
        $q = $this->db->query($query);
        //print_r($q);
       if($q->num_rows()>0)
        {
            foreach($q->result_array() as $row)
            {
                $data[] = array(
                    'label' => $row['product_name']
                );
            }
            return $data;
        }
    }

  /*  public function get_all_suggested_product($product_name,$limit,$min_price=0,$max_price=0,$manufacturer=0)
    {

    }*/

    public function get_all_suggested_product($product_name,$offset=0,$limit=1000)
    {
        $searchTermKeywords = $this->bulid_search_query($product_name);
        $query = "select tbl1.product_id,product_price,product_name,image_id,image_ext,special_price
                    from
                    (
                        select products.product_id as product_id,product_price,product_name
                        from  products,products_description
                        where products.product_id = products_description.product_id
                              and ".implode(" or ",$searchTermKeywords)." and language_id = {$this->user_language_id} and product_status = 1 and  date_available <= curdate()
                    )as tbl1

                    left join

                    (
                        select product_id,image_id,min(image_ext) as  image_ext
                        from products_images
                        where product_id in(
                                            select product_id from  products where  product_status = 1
                                                   and  date_available <= curdate()
                                            )
                        group by product_id
                    )as tbl2

                    on tbl1.product_id = tbl2.product_id

                    left join

                    (
                        select product_id,special_price
                        from specials
                        where expire_date > curdate() and status = 1
                              and product_id in (select product_id from  products where  product_status = 1 and  date_available <= curdate()
                                                )
                    ) as tbl3

                    on tbl1.product_id = tbl3.product_id

                    limit $offset,$limit";

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

    public function get_min_max_price()
    {
        $query = "select min(product_price) as min_price,max(product_price) as max_price from products";
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
?>