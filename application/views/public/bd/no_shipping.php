<?php
/**
 * Created by PhpStorm.
 * User: Monir
 * Date: 7/7/14
 * Time: 8:10 PM
 */
$user_currency_info= getUserCurrencyInfo();
?>
<div id="main-content" class="float-left fix">
    <?php $this->load->view('public/'.get_language().'/search_view'); ?>
    <div>
        <p>
            <b>Sorry</b>, currently we are not shipping region products into your region.
        </p>
        <p>
            <a href="<?php base_url().'public/cart/destroy'?>">Empty your cart</a>
            <a href="<?php base_url().'public/shipping/new_shipping_address'?>">Change Shipping Address</a>
        </p>
    </div>
</div>