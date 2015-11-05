<?php
/**
 * Created by PhpStorm.
 * User: Monir
 * Date: 7/5/14
 * Time: 12:04 AM
 */

$user_currency_info = getUserCurrencyInfo();
if($this->session->userdata('payment_method') == 'PAYPAL')
{
    $action = "https://www.sandbox.paypal.com/cgi-bin/webscr";
    $return_url = base_url().'public/order/thanks';
    $supported_currency = array();
    $currency_supported = true;
    if(!in_array($currency_code,$supported_currency))
    {
        $currency_code = 'USD';
        $currency_supported = false;
    }

}
else
{
    $action = base_url().'public/order/thanks';
}

function product_cost($price)
{
    global $currency_supported;
    global $user_currency_info;
    if($currency_supported)
    {
        return get_price(
            $price,
            $user_currency_info->value,
            $user_currency_info->symbol,
            $user_currency_info->symbol_position,
            $user_currency_info->decimal_places,
            $user_currency_info->decimal_point,
            $user_currency_info->thousands_point

        );
    }
    return $price;
}
?>
<div id="main-content" class="float-left fix">
    <?php $this->load->view('public/'.get_language().'/search_view'); ?>
    <h2>Confirm Order</h2>
    <form method="post" action="<?php echo $action;?>">
        <table>
            <tbody>

                <tr>
                    <td>Subtotal</td>
                    <td>
                        <?php
                        echo get_price(
                            $subtotal,
                            $user_currency_info->value,
                            $user_currency_info->symbol,
                            $user_currency_info->symbol_position,
                            $user_currency_info->decimal_places,
                            $user_currency_info->decimal_point,
                            $user_currency_info->thousands_point

                        );?>
                    </td>

                </tr>
                <td>Tax</td>
                <td>
                    <?php
                    echo get_price(
                        $totaltax,
                        $user_currency_info->value,
                        $user_currency_info->symbol,
                        $user_currency_info->symbol_position,
                        $user_currency_info->decimal_places,
                        $user_currency_info->decimal_point,
                        $user_currency_info->thousands_point

                    );?>

                </td>

                </tr>
                <td>Shipping Cost</td>
                <td>
                    <?php
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

                </tr>

                <td>Total</td>
                <td>
                    <?php
                    echo get_price(
                        $total,
                        $user_currency_info->value,
                        $user_currency_info->symbol,
                        $user_currency_info->symbol_position,
                        $user_currency_info->decimal_places,
                        $user_currency_info->decimal_point,
                        $user_currency_info->thousands_point

                    );?>
                    <?php if($this->session->userdata('payment_method') != 'PAYPAL'): ?>
                        <input type="hidden" name="subtotal" value="<?php echo $subtotal;?>"/>
                        <input type="hidden" name="totaltax" value="<?php echo $totaltax;?>"/>
                        <input type="hidden" name="shipping_cost" value="<?php echo $shipping_cost;?>"/>
                        <input type="hidden" name="total" value="<?php echo $total;?>"/>
                    <?php endif; ?>

                </td>

                </tr>
            </tbody>
        </table>
    <?php if($this->session->userdata('payment_method') == 'PAYPAL'):?>
        <input name = "cmd" value = "_cart" type = "hidden">
        <input name = "upload" value = "1" type = "hidden">
        <input name = "no_note" value = "0" type = "hidden">
        <input name = "bn" value = "PP-BuyNowBF" type = "hidden">
        <input type="hidden" name="shipping" value="15.25">

        <input name = "business" value = "monirbd41-facilitator@yahoo.com" type = "hidden">
        <input name = "handling_cart" value = "0" type = "hidden">
        <input name = "currency_code" value = "<?php echo $currency_code; ?>" type = "hidden">
        <!--<input name = "lc" value = "GB" type = "hidden">-->
        <INPUT TYPE="hidden" name="charset" value="utf-8">
        <input name = "return" value = "<?php echo $return_url; ?>" type = "hidden">
        <input name = "cbt" value = "Return to My Site" type = "hidden">
        <input name = "cancel_return" value = "<?php echo base_url().'public/home'; ?>" type = "hidden">


        <?php if(!empty($cart_contents)): $i = 1; foreach($cart_contents as $item):?>
            <div id = "item_<?php echo $i; ?>" class = "itemwrap">
                <input name = "item_name_<?php echo $i; ?>" value = "<?php echo getProductInfo($item['id']);?>" type = "hidden">
                <input name = "quantity_<?php echo $i; ?>" value = "<?php echo $item['qty'];?>" type = "hidden">
                <input name = "amount_<?php echo $i; ?>" value = "<?php echo product_cost($item['price']); ?>" type = "hidden">
                <?php if($i == 1):?>
                <input name = "tax_<?php echo $i; ?>" value = "<?php echo product_cost($totaltax); ?>" type = "hidden">
                <input name = "shipping_<?php echo $i; ?>" value = "<?php echo product_cost($shipping_cost); ?>" type = "hidden">
                <?php endif; ?>
            </div>
        <?php ++$i; endforeach;endif;?>

        <?php endif; ?>
        <input type="submit" value="Confirm" name="confirm">
    </form>
</div>