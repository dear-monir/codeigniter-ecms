<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/8/13
 * Time: 3:40 PM
 * To change this template use File | Settings | File Templates.
 */
?>

<div id="main-content" class="float-left fix">
    <?php $this->load->view('public/'.get_language().'/search_view'); ?>

    <h2>Welcome to My Old Online Store</h2>
    <p>Welcome Guest! Would you like to <a href="#">log yourself in</a>? Or would you prefer to <a href="#">create an account?</a></p>
    <h3>New Products For <?php echo date('F');?></h3>
    <?php if(isset($new_products)):foreach($new_products as $new_product):?>
    <div class="current-month-product">
        <a href="<?php echo base_url()."public/product_info/index/{$new_product->product_id}";?>">
            <img src="<?php echo base_url()."images/products_images/{$new_product->image_id}.$new_product->image_ext";?>">
        </a>
        <br/>
        <span>
            <a href="<?php echo base_url()."public/product_info/index/{$new_product->product_id}";?>">
                <?php echo $new_product->product_name;?>
            </a>
        </span><br/>
        <span><?php echo $new_product->product_price;?></span>
    </div>
    <?php endforeach;endif;?>
</div>