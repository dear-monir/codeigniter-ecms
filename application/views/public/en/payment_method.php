<?php
/**
 * Created by PhpStorm.
 * User: Monir
 * Date: 7/4/14
 * Time: 8:30 PM
 */
$user_currency_info = getUserCurrencyInfo();
?>
<div id="main-content" class="float-left fix">
    <?php $this->load->view('public/'.get_language().'/search_view'); ?>


    <h2>Payment Methods</h2>
    <b>Please select the preferred payment method to use on this order.</b>
    <form method="post" action="<?php echo base_url().'public/order/confirm'; ?>">
        <table>
            <tbody>
                <tr>
                    <td>
                        Pay On Delivery
                    </td>
                    <td>
                        <input type="radio" value="PAY_ON_DELIVERY" checked name="payment_method">
                    </td>
                </tr>
                <tr>
                    <td>
                        Paypal
                    </td>
                    <td>
                        <input type="radio" value="PAYPAL" name="payment_method">
                    </td>
                </tr>
            </tbody>
        </table>
        <input type="submit" value="Continue" name="continue">
    </form>
</div>