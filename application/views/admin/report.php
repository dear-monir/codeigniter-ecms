<?php
/**
 * Created by PhpStorm.
 * User: Monir
 * Date: 7/6/14
 * Time: 10:22 PM
 */

$this->load->view('admin/header');
?>

<div id="content">
    <div>
        <div>
            <h2>
                <?php echo $status_type;?> Orders
            </h2>
            <table>
                <thead>

                    <tr>
                        <th>Customer Name</th>
                        <th>Total Purchased</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if(!empty($orders)): foreach($orders as $order):?>
                    <tr>
                        <td><?php echo $order->delivery_fname. ' '. $order->delivery_lname;?></td>
                        <td>$ <?php echo $order->total?></td>
                        <td><a href="<?php echo base_url().'admin/report/details/'.$order->id; ?>">Details</a></td>
                    </tr>
                    <?php endforeach;endif; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function(){
        $('#adminmenu').accordion({fillSpace : false,active : 6 });
    });

</script>
</body>
</html>