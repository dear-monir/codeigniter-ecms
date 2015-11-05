<div id="content">
    <h2>Currencies</h2>

    <table id="common">
        <thead>
        <tr>
            <th>Currency</th>
            <th>Code</th>
            <th>Symbol</th>
            <th>Action</th>

        </tr>
        </thead>
        <?php if($rows):foreach($rows as $r):?>

            <tr>
                <td><?php echo $r->title;?></td>
                <td><?php echo $r->code;?></td>
                <td><?php echo $r->symbol;?></td>
            <td><a class="button" href="<?php echo base_url().'admin/currencies/edit/'.$r->currency_id;?>">Edit</a>&nbsp;<a class="button">Delete</a></td>

        </tr>
        <?php endforeach; endif;?>
    </table>

    <div id="add_new">
        <a class="button" id="addnew" href="<?php echo base_url();?>admin/currencies/add">New Currency</a>
    </div>

</div>
<?php if($action =='add' || $action =='edit'):?>
<div id="form_currency_add">

   <form action="<?php base_url().'admin/currencies/'.$action;?>" method="post" >
    <p align="center"><h3>Add New Currency</h3></p>
    <p><label>Currency Title<label><input type="text" id="currency" name="currency" value=""/></p>
    <p><label>Code<label><input type="text" id="code" name="code" value=""/></p>
    <p><label>Symbol<label><input type="text" id="symbol" name="symbol" value=""/></p>
    <p><label>Symbol Position</label><input type="text" id="symbol_position" name="symbol_position" value=""/></p>
    <p><label>Value<label><input type="text" id="value" name="value" value=""/></p>
    <p><label>Added Date<label><input type="text" id="date" name="date" value=""/></p>
    <p class="error">*</p>
    <p><input type="submit" value="Save" name="save"/><a class="button" href="<?php echo base_url();?>admin/currencies">Cancel</a></p>

    </form>

</div>
<?php endif;?>
</body>
</html>