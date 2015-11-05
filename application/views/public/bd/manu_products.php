<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/13/13
 * Time: 10:54 AM
 * To change this template use File | Settings | File Templates.
 */
?>

<div id="main-content" class="float-left fix">

        <?php
        $user_currency_info= getUserCurrencyInfo();
        if(empty($products)):?>
            <h3>There are no products available in this category.</h3>
        <?php else:?>
            <?php require_once(APPPATH.'views/public/'.get_language().'/product_view.php'); ?>
        <?php endif;?>
</div>