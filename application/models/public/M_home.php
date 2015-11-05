<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/11/13
 * Time: 9:58 PM
 * To change this template use File | Settings | File Templates.
 */

class M_home extends CI_Model
{
    var $user_language;
    var $user_language_id;
    public function __construct()
    {
        $this->db->query ("set character_set_results='utf8'");
        $this->user_language = get_language();
        $this->user_language_id = get_language_id();
    }

    public function newProduct()
    {
        $query = "select tbl1.product_id as product_id,product_name,product_price,image_id, image_ext
                  from
                    (
                    select products.product_id as product_id,product_price
                    from products
                    where date_available <= curdate() and product_status = 1 and YEAR(date_available) = YEAR(CURDATE())AND  MONTH

                    (date_available) = MONTH(CURDATE())
                    )as tbl1

                    left join
                    (
                    select products_description.product_id AS product_id, min( image_id ) AS image_id, image_ext,product_name
                    from products_images, products_description
                    where products_images.product_id = products_description.product_id
                    and language_id = {$this->user_language_id}
                    group by product_id
                    )as tbl2

                    on tbl1.product_id = tbl2.product_id
                    limit 9";

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