<?php $this->load->view('admin/header');?>


<div id="content">
    <table>
        <thead>
            <td>Title</td>
            <td>Value</td>
            <td>Action</td>
        </thead>
    <?php if(isset($config_options)): foreach($config_options as $con_opt):?>
        <tr>
            <td><?php echo $con_opt->configuration_title;?></td>
            <td>
                <?php if(isset($config_id) && $config_id == $con_opt->configuration_id):?>
                <form id="my_form" method="post" action="<?php echo base_url().'admin/configure/edit/'.$config_group_id.'/'.$con_opt->configuration_id;?>" >
                    <?php if($con_opt->configuration_value == 'true' || $con_opt->configuration_value == 'false'): ?>
                        <input type="radio" name="config_value" value="true" <?php if($con_opt->configuration_value == 'true'){echo 'selected="selected"';}?> />true
                        <input type="radio" name="config_value" value="false" <?php if($con_opt->configuration_value == 'false'){echo 'selected="selected"';}?> />false
                        <?php else: ?>
                    <input type="text" name="config_value"  value="<?php echo htmlentities($con_opt->configuration_value);?>"/>
                        <?php endif;?>
                </form>
                <?php else: echo htmlentities($con_opt->configuration_value); endif;?>
            </td>
            <td>
                <?php if(isset($config_id) && $config_id == $con_opt->configuration_id):?>
                    <a class="button" id="submit_button">Save</a>
                    <a class="button" href="<?php echo base_url().'admin/configure/index/'.$config_group_id;?>">Cancel</a>
                <?php else:?>
                    <a href="<?php echo base_url().'admin/configure/index/'.$config_group_id.'/'.$con_opt->configuration_id;?>">Edit</a>
               <?php endif;?>

            </td>
        </tr>
        <?php endforeach;endif;?>
    </table>
</div>
<script type="text/javascript">

    $(document).ready(function(){
        $('#adminmenu').accordion({fillSpace : false,active : 0 });
        $('table#common').Sortables();
    });

</script>
</body>
</html>