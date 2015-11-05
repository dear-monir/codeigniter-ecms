<?php $this->load->view('admin/header');?>

<div id="content">
    <h2>Tax Classes</h2>
    <?php if($action == 'view'):?>
    <div id="records">
        <table id="common">
            <thead>
            <tr>
                <th>Tax Class Title</th>
                <th>Description</th>
                <th>Last Modified(YYYY-MM-DD H:M:S)</th>
                <th>Action</th>

            </tr>
            </thead>
            <?php if($rows):foreach($rows as $r):?>
                <tr>
                    <td><?php echo $r->tax_class_title;?></td>
                    <td><?php echo $r->tax_class_description;?></td>
                    <td><?php echo $r->last_modified;?></td>

                    <td>
                        <a class="button button-edit" href="<?php echo base_url();?>admin/tax_class/edit/<?php echo $r->tax_class_id;?>">Edit</a>&nbsp;
                        <a class="button delete_button delete" href="<?php echo base_url();?>admin/tax_class/delete/<?php echo $r->tax_class_id;?>">Delete</a>
                    </td>

                </tr>
            <?php endforeach; endif;?>
        </table>

            <div id="add_new">
                <a class="button button-add-new" id="addnew" href="<?php echo base_url();?>admin/tax_class/add">New Tax Class</a>
            </div>

    </div>
    <?php endif;?>
    <?php if($action != 'view'):?>
        <div id="side_bar">
            <p>Fields marked as * are required.</p>
            <form action="<?php echo base_url().'admin/tax_class/'.$action;?>" method="post"  id="my_form">
                <p><label>Tax Class name<label><input class="tax-title" type="text" id="tax_class_title" name="tax_class_title" value="<?php echo $tax_class_title;?>"/></p>
                <p>
                    <label>Description</label>
                    <textarea id="tax_class_description" name="tax_class_description" rows="10" cols="25">
                        <?php echo $tax_class_description;?>
                    </textarea>
                </p>

                <p><a class="button button-save" id="submit_button">Save</a>&nbsp;<a class="button button-cancel" href="<?php echo base_url();?>admin/tax_class">Cancel</a></p>

            </form>
        </div>
    <?php endif;?>

</div>
<script type="text/javascript">

    $(document).ready(function(){
        $('#adminmenu').accordion({fillSpace : false,active : 4 });


        $("#my_form").validity(function() {
            $(".tax-title").require();
        });
    });

</script>
</body>
</html>