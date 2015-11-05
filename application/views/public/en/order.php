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

    <?php
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

    <?php if(empty($order_info)):?>
        <h3>Stil you did not order for any product.</h3>
    <?php else:?>
        <table style="width: 100%" class="display-product">
            <thead>
                <tr>
                    <th>Shipped To</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>&nbsp;</th>

                </tr>
            </thead>
            <tbody>
            <?php foreach($order_info as $info):?>
                <tr>
                    <td><?php echo $info->delivery_fname .' '. $info->delivery_lname; ?></td>
                    <td><?php echo $info->currency.' ' .($info->total * $info->currency_value); ?></td>
                    <td>
                        <?php
                        if($info->status == '1')
                        {
                            echo 'Processing';
                        }
                        else
                        {
                            echo "Delivered";
                        }
                        ?>
                    </td>
                    <td>
                        <a href="<?php echo base_url().'public/customer/order_details/'.$info->id; ?>">Details</a>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    <?php endif;?>
    <?php //endif;?>
</div>