<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/27/13
 * Time: 7:33 PM
 * To change this template use File | Settings | File Templates.
 */
?>
<?php $this->load->view('admin/header');?>

<div id="content">
    <h2>My Store</h2>
    <?php if($action == 'view'):?>
        <div id="records">
            <table id="common">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Value</th>
                    <th>Action</th>

                </tr>
                </thead>
                <?php if($rows):foreach($rows as $r):?>
                    <tr>
                        <td><?php echo $r->configuration_title;?></td>
                        <td><?php echo htmlentities($r->configuration_value);?></td>

                        <td>
                            <a class="button button-edit" href="<?php echo base_url();?>admin/mystore/edit/<?php echo $r->configuration_id;?>">Edit</a>
                        </td>

                    </tr>
                <?php endforeach; endif;?>
            </table>

        </div>
    <?php endif;?>
    <?php if($action != 'view'):?>
        <div id="side_bar">
            <p>Fields marked as * are required.</p>
            <form action="<?php echo base_url()."admin/mystore/$action/$config_id";?>" method="post"  id="my_form">
                <?php foreach($rows as $r):?>
                <h3><?php echo $r->configuration_title;?></h3>
                <p><?php echo $r->configuration_description;?></p>
                <?php if($r->configuration_key == 'SHOW_CATEGORY_COUNT'): ?>
                    <p>
                        <input type="radio" name="configuration_value" value="true" <?php if($r->configuration_value == "true"){echo "checked='checked'";}?> />True<br/>
                        <input type="radio" name="configuration_value" value="false" <?php if($r->configuration_value == "false"){echo "checked='checked'";}?> />False
                    </p>
                <?php elseif ($r->configuration_key == 'PREV_NEXT_NAV_LOCATION'): ?>
                       <select name="configuration_value">
                           <option value="top" <?php if($r->configuration_value == "top"){echo "selected='selected'";}?> >
                               top
                           </option>
                           <option value="bottom" <?php if($r->configuration_value == "bottom"){echo "selected='selected'";}?> >
                               bottom
                           </option>
                           <option value="both" <?php if($r->configuration_value == "both"){echo "selected='selected'";}?> >
                               both
                           </option>
                       </select>
                 <?php else: ?>
                        <p>
                            <input type="text" name="configuration_value" value="<?php echo htmlentities($r->configuration_value); ?>" size="40" />
                        </p>
                 <?php endif; ?>
                <p><a class="button button-save" id="submit_button">Save</a>&nbsp;<a class="button button-cancel" href="<?php echo base_url();?>admin/mystore">Cancel</a></p>
                <?php endforeach;?>
            </form>
        </div>
    <?php endif;?>

</div>

<script type="text/javascript">

    $(document).ready(function(){
        $('#adminmenu').accordion({fillSpace : false,active : 0 });


        $("#my_form").validity(function() {
            $("input[type='text']").require();
        });
    });

</script>
</body>
</html>