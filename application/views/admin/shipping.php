<?php
/**
 * Created by PhpStorm.
 * User: Monir
 * Date: 7/2/14
 * Time: 10:42 PM
 */
?>
<?php $this->load->view('admin/header');?>

<div id="content">
    <h2>Shipping Methods</h2>
    <?php if($action == 'view'):?>
        <div id="records">
            <table id="common">
                <thead>
                <tr>
                    <th>Shipping Method Name</th>
                    <th>Display</th>
                    <th>Action</th>
                </tr>
                </thead>
                <?php if(isset($shipping_methods)):foreach($shipping_methods as $shipping_method):?>
                    <tr>
                        <td><?php echo $shipping_method->configuration_title;?></td>
                        <td><?php echo $shipping_method->configuration_value;?></td>
                        <td>
                            <a class="button button-edit" href="<?php echo base_url().'admin/shipping/edit/'. $shipping_method->configuration_group_id. '/' .$shipping_method->configuration_id;?>">Edit</a>
                        </td>

                    </tr>
                <?php endforeach; endif;?>
            </table>

        </div>
    <?php else:?>
        <div id="side_bar">
            <h2><?php echo $configuration_title;?></h2>
            <form action="<?php echo base_url()."admin/shipping/edit/{$config_group_id}/{$config_id}";?>" method="post"  id="my_form">
                <p>
                    <b>Do you want to display this shipping method?</b>
                </p>

                <p>
                    <input type="radio" name="display" value="true" <?php if($config_value == "true"){echo "checked='checked'";}?> />True<br/>
                    <input type="radio" name="display" value="false" <?php if($config_value == "false"){echo "checked='checked'";}?> />False
                </p>

                <p>
                    <a class="button button-save" id="submit_button">Save</a>&nbsp;
                    <a class="button button-cancel" href="<?php echo base_url()."admin/shipping/index/{$config_group_id}";?>">Cancel</a>
                </p>

            </form>

        </div>
    <?php endif;?>

</div>
<script type="text/javascript">

    $(document).ready(function(){
        $('#adminmenu').accordion({fillSpace : false,active : 2 });
        $("#my_form").validity(function() {
            $(".sort_order").require();
        });
    });

</script>
</body>
</html>