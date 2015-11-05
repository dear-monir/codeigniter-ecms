<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/15/13
 * Time: 9:19 PM
 * To change this template use File | Settings | File Templates.
 */
//print_r($cart_contents);
?>
<div id="main-content" class="float-left fix">
    <?php $this->load->view('public/'.get_language().'/search_view'); ?>

    <h2>Shopping cart summary</h2>
    <table class="view-cart text-center">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Unit Price($)</th>
                <th>Quantity</th>
                <th>Sub-Total($)</th>
                <th>&nbsp;</th>
            </tr>
        </thead>

        <tbody>
        <?php if(!empty($cart_contents)):foreach($cart_contents as $item):?>
            <form action="<?php echo base_url()."public/cart/update";?>" method="post" class="update_qty_form">
            <tr>
                <td>
                    <b><?php echo getProductInfo($item['id']);//$item['name'];?></b>
                    <ul>
                        <?php if(!empty($item['options'])):foreach($item['options'] as $option => $option_val):?>
                            <li>
                                <?php
                                    $opt = explode('_',$option);
                                    $opt_val = explode('_',$option_val);
                                    //echo $option .": " .$opt_val[0];
                                    $row = getOptions($opt[1],$opt_val[0]);
                                echo $row['product_option_name']." : ".$row['product_option_value_name'];
                                ?>
                            </li>
                        <?php endforeach;endif;?>
                    </ul>
                </td>
                <td>
                   $ <?php echo $item['price'];?>
                </td>
                <td>
                    <input type="hidden" name="product_id" value="<?php echo $item['id'];?>"/>
                    <input type="hidden" name="row_id" value="<?php echo $item['rowid'];?>"/>
                    <input type="text" name="item_quantity" id="item_quantity" value="<?php echo $item['qty'];?>" maxlength="3" size="3"/>
                    <input type="submit" value="Update" class="change_qty_btn"/>
                </td>
                <td>
                    $<?php echo $item['subtotal'];?>
                </td>
            </form>
                <td>
                    <form action="<?php base_url()."public/cart/delete";?>" method="post" class="delete_item_form">
                        <input type="hidden" name="row_id" value="<?php echo $item['rowid'];?>"/>
                        <input type="submit" value="delete" class="delete-black hide-text" title="delete"/>
                    </form>
                </td>
            </tr>

        <?php endforeach;endif;?>
            <tr>
                <td colspan="3">
                    &nbsp;
                </td>
                <td>
                    Total:$<?php echo $total_price;?>
                </td>
                <td>
                    <a href="<?php echo base_url()."public/cart/destroy";?>" class="button">Empty cart</a>
                </td>
            </tr>
        </tbody>
    </table>

</div>