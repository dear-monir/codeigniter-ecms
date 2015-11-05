<?php
/**
 * Created by PhpStorm.
 * User: Monir
 * Date: 6/16/14
 * Time: 11:07 AM
 */
?>
<form action="<?php echo base_url()."public/search/get_all_suggested_products";?>" method="get" id="search_form">
        <input type="text" name="term" id="search_product" placeholder="Search"
            <?php
                if(isset($search_term)):
                    echo 'value="'.$search_term.'"';
                endif;
            ?>
        />
</form>