<?php $this->load->view('admin/header');?>

<div id="content">
    <h2>Manufacturers</h2>
    <div id="records">
        <?php if($action == 'view'):?>
        <table id="common">
            <thead>
            <tr>
                <th>Manufacturer Name</th>
                <th>Image</th>
                <th>Last Modified(YYYY-MM-DD H:M:S)</th>
                <th>Action</th>

            </tr>
            </thead>
            <?php if($rows):foreach($rows as $r):?>
                <tr>
                    <td><?php echo $r->manufacturer_name;?></td>
                    <td><img width="50" height="30" src="<?php echo base_url()."images/manufacturers/".$r->manufacturer_id . "." . $r->image_ext;?>"/></td>
                    <td><?php echo $r->last_modified;?></td>

                    <td>
                        <a class="button button-edit" href="<?php echo base_url();?>admin/manufacturer/edit/<?php echo $r->manufacturer_id;?>">Edit</a>&nbsp;
                        <a class="button delete_button delete" href="<?php echo base_url();?>admin/manufacturer/delete/<?php echo $r->manufacturer_id;?>">Delete</a>
                    </td>

                </tr>
            <?php endforeach; endif;?>
        </table>

            <div id="add_new">
                <a class="button button-add-new" id="addnew" href="<?php echo base_url();?>admin/manufacturer/add">New Manufacturer</a>
            </div>
    </div>
    <?php endif;?>


    <?php if($action != 'view'):?>
        <div id="side_bar">
            <p>Fields marked as * are required.</p>
            <form action="<?php echo base_url().'admin/manufacturer/'.$action;?>" method="post"  id="my_form" enctype="multipart/form-data">
                <p>
                    <label>Manufacturer Name<label>
                    <input type="text" id="manufacturer_name" name="manufacturer_name" value="<?php echo $manufacturer_name;?>"/>
                </p>
                <p>
                    <label>Flag(image)</label>
                    <input type="file" id="image_file" name="image_file"/>
                </p>
                <p><a class="button button-save" id="submit_button">Save</a>&nbsp;<a class="button button-cancel" href="<?php echo base_url();?>admin/manufacturer">Cancel</a></p>

            </form>
        </div>
    <?php endif;?>

</div>
<script type="text/javascript">

    $(document).ready(function(){
        $('#adminmenu').accordion({fillSpace : false,active : 1 });

        $("#my_form").validity(function() {
            $("input[type='text']").require()
                                   .minLength(2, "Must contain at least 2 character.");
        });
    });

</script>
</body>
</html>