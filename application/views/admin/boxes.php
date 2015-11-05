<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/21/13
 * Time: 12:27 AM
 * To change this template use File | Settings | File Templates.
 */
?>
<?php $this->load->view('admin/header');?>

<div id="content">
    <h2>Boxes</h2>
    <?php if($action == 'view'):?>
        <div id="records">
            <table id="common">
                <thead>
                <tr>
                    <th>Box Name</th>
                    <th>Sort Order</th>
                    <th>Action</th>

                </tr>
                </thead>
                <?php if(isset($config_id)):foreach($config_id as $con_id):?>
                    <tr>
                        <td><?php echo $con_id->configuration_title;?></td>
                        <td><?php echo $con_id->sort_order;?></td>
                        <td>
                            <a class="button button-edit" href="<?php echo base_url();?>admin/boxes/edit/<?php echo  $con_id->configuration_group_id ."/" .$con_id->configuration_id;?>">Edit</a>
                        </td>

                    </tr>
                <?php endforeach; endif;?>
            </table>

        </div>
    <?php else:?>
        <div id="side_bar">
            <?php
                $config_val = explode('_',$config->configuration_value);
            ?>
            <h2><?php echo $config->configuration_title;?></h2>
            <form action="<?php echo base_url()."admin/boxes/edit/{$config->configuration_group_id}/{$config->configuration_id}";?>" method="post"  id="my_form">
                <p>
                    <b>Do you want to display the box to your shop?</b>
                </p>

                <p>
                    <input type="radio" name="display" value="true" <?php if($config_val[0] == "true"){echo "checked='checked'";}?> />True<br/>
                    <input type="radio" name="display" value="false" <?php if($config_val[0] == "false"){echo "checked='checked'";}?> />False
                </p>

                <p>
                    <b>Which sidebar do you want to display it?</b>
                </p>

                <p>
                    <input type="radio" name="column" value="left" <?php if($config_val[1] == "left"){echo "checked='checked'";}?> />Left<br/>
                    <input type="radio" name="column" value="right" <?php if($config_val[1] == "right"){echo "checked='checked'";}?> />Right
                </p>

                <p>
                    Sort Order:
                    <input type="text" value="<?php echo $config->sort_order;?>" name="sort_order" class="sort_order"/>
                </p>

                <p>
                    <a class="button button-save" id="submit_button">Save</a>&nbsp;
                    <a class="button button-cancel" href="<?php echo base_url()."admin/boxes/index/{$config->configuration_group_id}";?>">Cancel</a>
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