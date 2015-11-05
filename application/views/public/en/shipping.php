<?php
/**
 * Created by PhpStorm.
 * User: Monir
 * Date: 6/30/14
 * Time: 10:39 PM
 */
$user_currency_info = getUserCurrencyInfo();
?>
<div id="main-content" class="float-left fix">
    <?php $this->load->view('public/' . get_language() . '/search_view'); ?>
    <h1>Delivery Information</h1>

    <h2>Shipping Address</h2>
    <b>Choose a shipping address where products will be delivered

        <table style="width: 100%">
            <!-- <thead>
                 <th>
                     <td>Shipping Address</td>
                     <td>&nbsp;</td>
                 </th>
             </thead>-->
            <tbody>
            <tr>
                <td style="text-align: left">
                    <a style="font-size: 14px;color: blue;text-decoration:underline"
                       href="<?php echo base_url() . 'public/shipping/new_shipping_address'; ?>">Change Address</a>
    </b>
    </td>
    <td style="text-align: right">
        <table style="width: 100%">
            <thead>
            <td style="text-align: center;">
                <span style="padding: 2px;font-weight: bold">Your Shipping Address</span>
            </td>
            </thead>
            <tbody style="font-size: 14px;font-weight: normal;text-align: center">
                <tr>
                    <td> <?php echo $shipping_address['fname'] . ' ' . $shipping_address['lname'];?></td>
                </tr>
                <tr>
                    <td>  <?php echo $shipping_address['saddress']; ?> </td>
                </tr>
                <tr>
                    <td> <?php echo $shipping_address['city'] . ', ' . $shipping_address['postcode'];?> </td>
                </tr>
                <tr>
                    <td> <?php echo $shipping_address['state'] . ', ' . $shipping_address['country'];?> </td>
                </tr>
            </tbody>
        </table>
    </td>
    </tr>
    </tbody>
    </table>

    <h2>Shipping Cost</h2>
    <b>Please select the preferred shipping method to use on this order.</b>

    <form method="post" action="<?php echo base_url() . 'public/shipping/payment_method'; ?>">
        <table>
            <tbody>
            <?php if (count($shipping_methods) > 0): foreach ($shipping_methods as $s_m): ?>
                <tr>
                    <td><?php echo $s_m->configuration_title;?></td>
                    <td>
                        <?php
                        $shipping_cost = $s_m->shipping_cost;
                        if ($s_m->configuration_key == 'PER_ITEM') {
                            $shipping_cost = $number_of_items * $shipping_cost;
                        }
                        echo get_price(
                            $shipping_cost,
                            $user_currency_info->value,
                            $user_currency_info->symbol,
                            $user_currency_info->symbol_position,
                            $user_currency_info->decimal_places,
                            $user_currency_info->decimal_point,
                            $user_currency_info->thousands_point

                        );?>
                    </td>
                    <td>
                        <input type="radio" value="<?php echo $s_m->shipping_method_id; ?>" name="shipping_method_id"
                            <?php if ($selected_shipping_method_id == $s_m->shipping_method_id) {
                            echo 'checked';
                        } ?>
                            >
                    </td>
                </tr>
            <?php endforeach;endif;?>
            </tbody>
        </table>
        <input type="submit" value="Continue" name="continue">
    </form>
</div>