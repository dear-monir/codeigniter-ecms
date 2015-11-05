<?php $this->load->view('admin/header');?>

<div id="content">
    <h2>Tax Rates</h2>
    <?php if($action == 'view'):?>
    <div id="records">
        <table id="common">
            <thead>
            <tr>
                <th>Tax Class</th>
                <th>Country</th>
                <th>Tax Rate</th>
                <th>Last Modified(YYYY-MM-DD H:M:S)</th>
                <th>Action</th>

            </tr>
            </thead>
            <?php if($rows):foreach($rows as $r):?>
                <tr>
                    <td><?php echo $r->tax_class_title;?></td>
                    <td><?php echo $r->country_name;?></td>
                    <td><?php echo $r->tax_rate;?></td>
                    <td><?php echo $r->last_modified;?></td>

                    <td>
                        <a class="button button-edit" href="<?php echo base_url();?>admin/tax_rate/edit/<?php echo $r->tax_rate_id;?>">Edit</a>&nbsp;
                        <a class="button delete_button delete" href="<?php echo base_url();?>admin/tax_rate/delete/<?php echo $r->tax_rate_id;?>">Delete</a>
                    </td>

                </tr>
            <?php endforeach; endif;?>
        </table>

            <div id="add_new">
                <a class="button button-add-new" id="addnew" href="<?php echo base_url();?>admin/tax_rate/add">New Tax Class</a>
            </div>

    </div>
    <?php endif;?>
    <?php if($action != 'view'):?>
        <div id="side_bar">
            <p>Fields marked as * are required.</p>
            <form action="<?php echo base_url().'admin/tax_rate/'.$action;?>" method="post"  id="my_form">
                <p>
                    <label>Tax Class Title<label>
                    <select name="tax_class_id">

                        <?php if($tax_class):foreach($tax_class as $t):?>
                            <?php if($t->tax_class_id == $tax_class_id):?>
                                <option value="<?php echo $t->tax_class_id;?>" selected="selected">
                                    <?php echo $t->tax_class_title;?>
                                </option>
                            <?php else:?>
                                <option value="<?php echo $t->tax_class_id;?>">
                                    <?php echo $t->tax_class_title;?>
                                </option>
                            <?php endif;?>
                        <?php endforeach;endif;?>

                    </select>
                </p>
                <p>
                    <label>Country</label>
                    <select name="country_id">
                        <?php if($country):foreach($country as $c):?>
                            <?php if($c->country_id == $country_id):?>
                                <option value="<?php echo $c->country_id;?>" selected="selected">
                                    <?php echo $c->country_name;?>
                                </option>
                             <?php else:?>
                                <option value="<?php echo $c->country_id;?>">
                                    <?php echo $c->country_name;?>
                                </option>
                            <?php endif;?>
                        <?php endforeach;endif;?>
                    </select>
                </p>
                <p>
                    <label>Tax Rate(%)</label>
                    <input type="text" id="tax_rate" name="tax_rate" value="<?php echo $tax_rate;?>"/>
                </p>
                <p><a class="button button-save" id="submit_button">Save</a>&nbsp;<a class="button button-cancel" href="<?php echo base_url();?>admin/tax_rate">Cancel</a></p>

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