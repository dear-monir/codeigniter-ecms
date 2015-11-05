<?php
/**
 * Created by PhpStorm.
 * User: Monir
 * Date: 7/3/14
 * Time: 2:14 PM
 */
$this->load->view('admin/header');
?>
<div id="content">
    <h2>Shipping Region</h2>

    <div>
        Select a country:
        <select id="country">
            <option value="0">--Select One--</option>
            <?php foreach($countries as $country):?>
                <option value="<?php echo $country->country_id;?>" <?php if($country_id == $country->country_id){echo 'selected="selected"';}?>>
                    <?php echo $country->country_name;?>
                </option>
            <?php endforeach;?>
        </select>
        &nbsp;&nbsp;
        Select a shipping method:
        <select id="shipping_method">
            <option value="0">--Select One--</option>
            <?php foreach($shipping_methods as $s_m):?>
                <option value="<?php echo $s_m->configuration_id;?>" <?php if($shippping_method_id == $s_m->configuration_id){echo 'selected="selected"';}?>>
                    <?php echo $s_m->configuration_title;?>
                </option>
            <?php endforeach;?>
        </select>
    </div>

    <?php if($action == 'view'):?>
        <div id="records">
            <?php if(isset($shipping_regions)):?>
                <table id="common">
                    <thead>
                    <tr>
                        <th>State/Zone Name</th>
                        <th>Shipping Cost</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    <?php if($shipping_regions):foreach($shipping_regions as $region):?>
                        <tr>
                            <td><?php echo $region->name;?></td>
                            <td><?php echo $region->shipping_cost;?></td>
                            <td>
                                <a class="button button-edit" href="<?php echo base_url();?>admin/shipping_region/edit/<?php echo $country_id.'/'.$shippping_method_id.'/'.$region->id;?>">Edit</a>&nbsp;
                                <a class="button delete_button delete" href="<?php echo base_url();?>admin/shipping_region/delete/<?php echo $country_id.'/'.$shippping_method_id.'/'.$region->id;?>">Delete</a>
                            </td>

                        </tr>
                    <?php endforeach; endif;?>
                </table>
            <?php endif; ?>
            <?php if($country_id != 0 && $shippping_method_id != 0): ?>
                <div id="add_new">
                    <a class="button button-add-new" id="addnew" href="<?php echo base_url().'admin/shipping_region/add/'.$country_id.'/'.$shippping_method_id; ?>">New Shipping Region</a>
                </div>
            <?php endif; ?>
        </div>

    <?php endif;?>
    <?php if($action != 'view'):
        if($action == 'add')
        {
            $action = "add/$country_id/$shippping_method_id";
        }
        else
        {
            $action = "edit/$country_id/$shippping_method_id/$rid";
        }
        ?>
        <div id="side_bar">
            <p>Fields marked as * are required.</p>
            <form action="<?php echo base_url().'admin/shipping_region/'.$action?>" method="post"  id="my_form">
                <p>
                    <label>Shipping Region:<label>

                    <select name="shipping_region">
                        <?php foreach($shipable_regions as $region):?>
                        <option value="<?php echo $region->id;?>" <?php if($region->id == $region_id){echo 'selected="selected"';}?>>
                            <?php echo $region->name;?>
                        </option>
                        <?php endforeach;?>
                    </select>
                </p>

                <p>
                    <label>Shipping Cost:</label>
                    <input type="text" id="shipping_cost" name="shipping_cost" value="<?php echo $shipping_cost;?>"/>
                </p>
                <p><a class="button button-save" id="submit_button">Save</a>&nbsp;<a class="button button-cancel" href="<?php echo base_url().'admin/shipping_region/index/'.$country_id.'/'.$shippping_method_id; ?>">Cancel</a></p>

            </form>
        </div>
    <?php endif;?>

</div>

<script type="text/javascript">

    $(document).ready(function(){
        $('#adminmenu').accordion({fillSpace : false,active : 4 });


        $("#my_form").validity(function() {
            $("input[type='text']").require();
        });

        $("#country").change(function(){
           change();
        });

        $("#shipping_method").change(function(){
            change();
        });

        function change()
        {
            country_id = $("#country").val();
            shipping_method_id = $("#shipping_method").val();
            var url = "<?php  echo base_url().'admin/shipping_region/index/';?>";
            if(country_id != "0" && shipping_method_id != "0")
            {
                window.location.href =  url + country_id + "/" + shipping_method_id;
            }
        }
    });

</script>
</body>
</html>