<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/12/13
 * Time: 12:54 PM
 * To change this template use File | Settings | File Templates.
 */
?>
<div id="main-content" class="float-left fix">

   <?php /*if(!empty($sub_categories)):foreach($sub_categories as $sub_categorie):?>
        <a href="<?php echo base_url()."public/category/index/".$sub_categorie->category_id;?>">
            <img src="<?php echo base_url()."images/categories/{$sub_categorie->category_id}.{$sub_categorie->image_ext}"; ?>">
            <br/><span><?php echo $sub_categorie->category_name?></span>
        </a>-->
    <?php endforeach;else:*/
        //print_r($cat_name);
        $user_currency_info= getUserCurrencyInfo();
        if(!empty($cat_name))
        {
            foreach($cat_name as $c_name)
            {
                echo "<h3>{$c_name->category_name}</h3>";
            }
        }

    ?>
    <?php $this->load->view('public/'.get_language().'/search_view'); ?>

    <?php if(empty($products)):?>
                <h3>দুঃখিত এই ধরনের কিছু খুজে পাওয়া যাচ্ছে না</h3>
            <?php else:?>
                <?php require_once(APPPATH.'views/public/'.get_language().'/product_view.php'); ?>
            <?php endif;?>
    <?php //endif;?>
</div>