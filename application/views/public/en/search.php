<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 11/20/13
 * Time: 8:30 PM
 * To change this template use File | Settings | File Templates.
 */

?>

<div id="main-content" class="float-left fix">
    <?php $this->load->view('public/'.get_language().'/search_view', array('term' => $search_term)); ?>
    <?php
    $user_currency_info= getUserCurrencyInfo();
    if(empty($products)):?>
        <h3>There are no products available for "<?php echo $search_term; ?>".</h3>
    <?php else:?>
        <h3> Showing Products for "<?php echo $search_term; ?>"</h3>
        <?php require_once(APPPATH.'views/public/'.get_language().'/product_view.php'); ?>
    <?php endif;?>

</div>