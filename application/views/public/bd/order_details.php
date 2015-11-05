<?php
/**
 * Created by PhpStorm.
 * User: Monir
 * Date: 7/7/14
 * Time: 6:03 PM
 */
$user_currency_info= getUserCurrencyInfo();

?>
<div id="main-content" class="float-left fix">
    <?php $this->load->view('public/'.get_language().'/search_view'); ?>
    <h2>Order Details</h2>
    <table>
        <tr>
            <td>
                Shipping Address
            </td>
            <td>
                <?php echo $order_info->delivery_fname . ' '. $order_info->delivery_lname; ?>
                <br/>
                <?php echo $order_info->delivery_street_address; ?>
                <br/>
                <?php echo $order_info->delivery_city.', '.$order_info->delivery_postcode; ?>
                <br/>
                <?php echo $order_info->delivery_state.', '.$order_info->delivery_country; ?>
            </td>
        </tr>

    </table>
    <div>
        <table style="width: 100%" class="display-product">
            <thead>
            <tr>
                <th>Product Name</th>
                <th>Qantity</th>
                <th>Price</th>
                <th>Tax</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($order_details)): foreach($order_details as $details): ?>
                <tr>
                    <td>
                        <?php
                        echo $details->product_name;
                        $options = $this->m_report->getProductOptions($details->order_id,$details->product_id);
                        if(!empty($options)):foreach($options as $option):
                            echo "<br/>";
                            echo "<b>{$option->product_option}</b>: {$option->product_option_value}( <small>{$order_info->currency}</small> {$option->product_option_value_prefix}".($option->product_option_value_price * $order_info->currency_value).")";
                        endforeach; endif;
                        ?>
                    </td>
                    <td><?php echo $details->product_quantity;?></td>
                    <td><?php echo "<small>{$order_info->currency}</small> ".$details->product_price * $order_info->currency_value ;?></td>
                    <td><?php echo "<small>{$order_info->currency}</small> ". $details->product_tax * $order_info->currency_value ;?></td>
                    <td><?php echo "<small>{$order_info->currency}</small> ". $details->total_price * $order_info->currency_value;?></td>
                </tr>
            <?php endforeach; endif; ?>
            <tr>
                <td colspan="3">&nbsp;</td>
                <td>Shipping Cost</td>
                <td>
                    <?php echo "<small>{$order_info->currency}</small> ".$order_info->shipping_cost * $order_info->currency_value;?>
                </td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
                <td>Total</td>
                <td>
                    <?php echo "<small>{$order_info->currency}</small> ". $order_info->total * $order_info->currency_value;?>
                </td>
            </tr>
            </tbody>
        </table>
        <a href="<?php echo base_url().'public/customer/view_orders'?>">Back</a>
    </div>
</div>