<?php $this->load->view('admin/header');?>

<div id="content">
    <h2>Languages</h2>
    <?php if($action == 'view'):?>
    <div id="records">
        <table id="common">
            <thead>
            <tr>
                <th>Language</th>
                <th>Code</th>
                <th>Sort Order</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            </thead>
            <?php if($rows):foreach($rows as $r):?>
                <tr>
                    <td><?php echo $r->name;?></td>
                    <td><?php echo $r->code;?></td>
                    <td><?php echo $r->sort_order;?></td>
                    <td>
                        <img width="50" height="35" src="<?php echo base_url();?>images/languages/<?php echo $r->language_id;?>.<?php echo $r->image_ext;?>"/>
                    </td>
                    <td>
                        <a class="button button-edit" href="<?php echo base_url();?>admin/language/edit/<?php echo $r->language_id;?>">Edit</a>&nbsp;
                        <a class="button delete_button language_delete" href="<?php echo base_url();?>admin/language/delete/<?php echo $r->language_id;?>">Delete</a>
                    </td>

                </tr>
            <?php endforeach; endif;?>
        </table>
        <input type="hidden" value="<?php echo $default_language_id;?>" id="default_language_id"/>
            <div id="add_new">
                <a class="button button-add-new" id="addnew" href="<?php echo base_url();?>admin/language/add">New Language</a>
            </div>

    </div>
    <?php else:?>
        <div id="side_bar">
            <p>Fields marked as * are required.</p>
            <form action="<?php echo base_url().'admin/language/'.$action;?>" method="post" enctype="multipart/form-data" id="my_form">
                <p><label>Language Name<label><input class="text" type="text" id="language" name="language_name" value="<?php echo $language_name;?>"/></p>
                <p><label>Code<label><input type="text" class="text" id="code" name="code" value="<?php echo $code;?>"/></p>
                <p><label>Sort Order<label><input class="digit" type="text" id="sort_order" name="sort_order" value="<?php echo $sort_order;?>"/></p>
                <p><label>Flag(image)</label><input type="file" id="image_file" name="image_file"/></p>
                <input type="hidden" name="save"/>
                <p class="error">*Allowed types are jpg,jpeg,png,gif.</p>
                <p><a class="button button-save" id="submit_button">Save</a>&nbsp;<a class="button button-cancel" href="<?php echo base_url();?>admin/language">Cancel</a></p>

            </form>
        </div>
    <?php endif;?>

</div>
<script type="text/javascript">

    $(document).ready(function(){
        $('#adminmenu').accordion({fillSpace : false,active : 5 });

        $("#my_form").validity(function() {
            $("input[type='text']").require();
            $(".digit").match('integer');
            $(".text").minLength(2, "Must contain at least 2 character.");
        });

        $(".language_delete").click(function(event){
            if(!confirm("Are you sure you want to delete it?"))
            {
                event.preventDefault();
            }
            else
            {

                var url = $(this).attr('href').split('/');

                language_id = url[url.length -1];
                default_language_id = $("#default_language_id").val();
                if(default_language_id == language_id)
                {
                    alert("You can't delete this language because it is the admin interface language as well as default language.");
                    event.preventDefault();
                }
            }
        });

    });

</script>
</body>
</html>