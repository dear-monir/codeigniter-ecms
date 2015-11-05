<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/13/13
 * Time: 11:44 AM
 * To change this template use File | Settings | File Templates.
 */
?>

<div id="main-content" class="float-left fix">

    <?php
    $user_currency_info= getUserCurrencyInfo();
    if(empty($products)):?>
        <h3>এই ক্যাটেগরির কোন পণ্য পাওয়া যায়নি .</h3>
    <?php else:?>
        <h3>নতুন পণ্য </h3>
        <?php require_once(APPPATH.'views/public/'.get_language().'/product_view.php'); ?>
    <?php endif;?>
</div>