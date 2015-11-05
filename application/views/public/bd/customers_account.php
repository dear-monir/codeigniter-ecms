<div id="main-content" class="float-left fix" xmlns="http://www.w3.org/1999/html">
    <?php $this->load->view('public/'.get_language().'/search_view'); ?>

    <?php
    echo '<strong>Welcome</strong> ', $customer_firstname, ' ', $customer_lastname . '';
    ?>

    <h3 style="text-decoration: none;padding:5px 5px;margin: 0px">My Account Information</h3>
    <?php echo '<h6 style="color:#006400;margin:0px">' . $message .'</h6>'?>
    <h4 style="text-decoration: underline;padding:5px 5px;margin: 0px">My Account</h4>
    <ul class="account_info" style="font-size: 12px">
        <li><a href="<?php echo base_url() . 'public/customer/view_my_account'?>">View or change my account information.</a></li>
        <li><a href="<?php echo base_url() . 'public/customer/view_password'?>">Change my account password.</a></li>
    </ul>
    <h4 style="text-decoration: underline;padding:5px 5px;margin: 0px">My Orders</h4>
    <ul class="account_info" style="font-size: 12px">
        <li><a href="<?php echo base_url() . 'public/customer/view_orders'?>">View the orders I have made. </a></li>
    </ul>
</div>