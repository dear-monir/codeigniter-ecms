<?php $this->load->view('admin/header');?>

<div id="content">
    <h2>Countries</h2>
    <?php if($action == 'view'):?>
    <div id="records">
        <table id="common">
            <thead>
            <tr>
                <th>Country Name</th>
                <th>Country Code</th>
                <th>Action</th>

            </tr>
            </thead>
            <?php if($rows):foreach($rows as $r):?>
                <tr>
                    <td><?php echo $r->country_name;?></td>
                    <td><?php echo $r->country_code;?></td>

                    <td>
                        <a class="button button-edit" href="<?php echo base_url();?>admin/country/edit/<?php echo $r->country_id;?>">Edit</a>&nbsp;
                        <a class="button delete_button delete" href="<?php echo base_url();?>admin/country/delete/<?php echo $r->country_id;?>">Delete</a>
                    </td>

                </tr>
            <?php endforeach; endif;?>
        </table>

            <div id="add_new">
                <a class="button button-add-new" id="addnew" href="<?php echo base_url();?>admin/country/add">New Country</a>
            </div>

    </div>
    <?php endif;?>
    <?php if($action != 'view'):?>
        <div id="side_bar">
            <p>Fields marked as * are required.</p>
            <form action="<?php echo base_url().'admin/country/'.$action;?>" method="post"  id="my_form">
                <p><label>Country Name<label><input type="text" id="country" name="country_name" value="<?php echo $country_name;?>"/></p>
                <p><label>Country Code<label><input type="text" id="code" name="country_code" value="<?php echo $country_code;?>"/></p>

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
    });

</script>
</body>
</html>