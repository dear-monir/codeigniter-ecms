<?php
/**
 * Created by PhpStorm.
 * User: Monir
 * Date: 7/6/14
 * Time: 11:04 PM
 */

$this->load->view('admin/header');
?>

<div id="content">
    <div>
        <div>
            <h2>
                Order Details
            </h2>
            <table>

                <tbody>
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td>
                                         Customer
                                    </td>
                                    <td>
                                        <?php echo $customer_info->customer_firstname . ' '. $customer_info->customer_lastname; ?>
                                        <br/>
                                        <?php echo $customer_info->customer_street; ?>
                                        <br/>
                                        <?php echo $customer_info->customer_city.', '.$customer_info->customer_postcode; ?>
                                        <br/>
                                        <?php echo $customer_info->name.', '.$customer_info->country_name; ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        Contanct No
                                    </td>
                                    <td>
                                        <?php echo $customer_info->customer_mobile_no; ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        Email
                                    </td>
                                    <td>
                                        <?php echo $customer_info->customer_email; ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td>
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
                        </td>
                    </tr>
                </tbody>

            </table>

            <table>
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
                                echo "<b>{$option->product_option}</b>: {$option->product_option_value}({$option->product_option_value_prefix} &dollar;{$option->product_option_value_price})";
                            endforeach; endif;
                            ?>
                        </td>
                        <td><?php echo $details->product_quantity;?></td>
                        <td>&dollar;<?php echo $details->product_price;?></td>
                        <td>&dollar;<?php echo $details->product_tax;?></td>
                        <td>&dollar;<?php echo $details->total_price;?></td>
                    </tr>
                <?php endforeach; endif; ?>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                        <td>Shipping Cost</td>
                        <td>
                            &dollar;<?php echo $order_info->shipping_cost;?>
                        </td>
                    </tr>
                <tr>
                    <td colspan="3">&nbsp;</td>
                    <td>Total</td>
                    <td>
                        &dollar;<?php echo $order_info->total;?>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <form action="<?php echo base_url().'admin/report/update_status/'.$order_info->id; ?>" method="post">
            Status:
            <select name="status">
                <option value="1" <?php if($order_info->status == '1'){echo 'selected="selected"';}?>>Pending</option>
                <option value="2" <?php if($order_info->status == '2'){echo 'selected="selected"';}?>>Delivered</option>
            </select>
            <input type="submit" value="Update">
        </form>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function(){
        $('#adminmenu').accordion({fillSpace : false,active : 6 });
    });

</script>
</body>
</html>