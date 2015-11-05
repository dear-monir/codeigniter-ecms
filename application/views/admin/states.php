<?php
/**
 * Created by PhpStorm.
 * User: Monir
 * Date: 7/3/14
 * Time: 11:40 AM
 */

 $this->load->view('admin/header');
?>

<div id="content">
    <h2>States/Zones</h2>
    <?php if($action == 'view'):?>
        <p>
            Please select a country:
            <select id="country">
                <option value="0">--Select One--</option>
                <?php foreach($countries as $country):?>
                    <option value="<?php echo $country->country_id;?>" <?php if($country_id == $country->country_id){echo 'selected="selected"';}?>>
                        <?php echo $country->country_name;?>
                    </option>
                <?php endforeach;?>
            </select>
        </p>

        <div id="records">
        <?php if(isset($states)):?>
            <table id="common">
                <thead>
                <tr>
                    <th>State/Zone Name</th>
                    <th>Action</th>

                </tr>
                </thead>
                <?php if($states):foreach($states as $state):?>
                    <tr>
                        <td><?php echo $state->name;?></td>
                        <td>
                            <a class="button button-edit" href="<?php echo base_url();?>admin/states/edit/<?php echo $state->country_id.'/'.$state->id;?>">Edit</a>&nbsp;
                            <a class="button delete_button delete" href="<?php echo base_url();?>admin/states/delete/<?php echo $state->country_id.'/'.$state->id;?>">Delete</a>
                        </td>

                    </tr>
                <?php endforeach; endif;?>
            </table>
        <?php endif; ?>
            <?php if($country_id != 0): ?>
            <div id="add_new">
                <a class="button button-add-new" id="addnew" href="<?php echo base_url().'admin/states/add/'.$country_id; ?>">New State/Zone</a>
            </div>
            <?php endif; ?>
        </div>

    <?php endif;?>
    <?php if($action != 'view'):
            $state_messsage = ucfirst($action). ' State/Zone for '. $country_name;
            if($action == 'add')
            {
                $action = "add/$country_id";
            }
            else
            {
                $action = "edit/$country_id/$state_id";
            }
        ?>
        <div id="side_bar">
            <h2><?php echo $state_messsage;?></h2>
            <p>Fields marked as * are required.</p>
            <form action="<?php echo base_url().'admin/states/'.$action?>" method="post"  id="my_form">
                <p><label>State/Zone Name<label><input type="text" id="state_name" name="state_name" value="<?php echo $state_name;?>"/></p>
                <p><a class="button button-save" id="submit_button">Save</a>&nbsp;<a class="button button-cancel" href="<?php echo base_url();?>admin/country">Cancel</a></p>

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
            country_id = $(this).val();
            var url = "<?php  echo base_url().'admin/states/index/';?>";
            if(country_id != "0")
            {
                window.location.href =  url + country_id;
            }
        });
    });

</script>
</body>
</html>