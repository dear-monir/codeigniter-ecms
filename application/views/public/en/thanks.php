<?php
/**
 * Created by PhpStorm.
 * User: Monir
 * Date: 7/6/14
 * Time: 2:39 PM
 */

$user_currency_info = getUserCurrencyInfo();
?>
<div id="main-content" class="float-left fix">
    <?php $this->load->view('public/'.get_language().'/search_view'); ?>
    <h3>Your Order Has Been Processed!</h3>
    <b>Your order has been successfully processed! Your products will arrive at their destination within 2-5 working days</b>
    <h4>Thanks for shopping with us online!</h4>
    <a href="<?php echo base_url().'public/home';?>" class="btn">Continue</a>
</div>
