<?php $this->load->view('admin/header');?>

<div id="content">
    <h2>Currencies</h2>
    <?php if($action == "view"):?>
        <table id="common">
            <thead>
            <tr>
                <th>Currency Title</th>
                <th>Code</th>
                <th>Symbol</th>
                <th>Value</th>
                <th>Action</th>

            </tr>
            </thead>
            <?php if($currencies):foreach($currencies as $currency):?>

                <tr>
                    <td><?php echo $currency->title;?></td>
                    <td><?php echo $currency->code;?></td>
                    <td><?php echo $currency->symbol;?></td>
                    <td><?php echo $currency->value;?></td>
                    <td>
                        <a class="button button-edit" href="<?php echo base_url().'admin/currencies/edit/'.$currency->currency_id;?>">Edit</a>&nbsp;
                        <a class="button delete_button currency_delete" href="<?php echo base_url().'admin/currencies/delete/'.$currency->currency_id;?>">Delete</a>
                    </td>

                </tr>
            <?php endforeach; endif;?>
        </table>

        <div id="add_new">
            <a class="button" id="addnew" href="<?php echo base_url();?>admin/currencies/add">New Currency</a>
        </div>
    <input type="hidden" value="<?php echo $default_currency_id;?>" id="default_currency_id"/>

</div>
<?php else:?>
    <div id="side_bar">

        <form action="<?php echo base_url().'admin/currencies/'.$action;?>" method="post" id="my_form" >
            <p align="center"><h3>Add New Currency</h3></p>
            <p>Fields marked as * are required.</p>
            <p><label>Currency Title<label><input type="text" id="currency" name="currency_title" value="<?php echo $title;?>"/></p>
            <p><label>Code<label><input type="text" id="code" name="currency_code" value="<?php echo $code;?>"/></p>
            <p><label>Symbol<label><input type="text" id="symbol" name="currency_symbol" value="<?php echo $symbol;?>"/></p>
            <p>
                <label>Symbol Position</label>
                <input type="radio" name="symbol_position" value="L" <?php if($symbol_position == "L"){echo 'checked="checked"';}?>/><span>Left</span><br/>
                <input type="radio" name="symbol_position" value="R" <?php if($symbol_position == "R"){echo 'checked="checked"';}?>/><span>Right</span>

            </p>
            <p>
                <label>Decimal Point</label><input type="text" id="decimal_point" name="decimal_point" value="<?php echo $decimal_point;?>"/>
            </p>
            <p>
                <label>Thousands Point</label><input type="text" id="thousand_point" name="thousand_point" value="<?php echo $thousands_point;?>"/>
            </p>
            <p>
                <label>Decimal Places</label><input type="text" id="decimal_places" name="decimal_places" value="<?php echo $decimal_places;?>"/>
            </p>
            <p>
                <label>Value</label><input type="text" id="value" name="value" value="<?php echo $value;?>"/>
            </p>
            <?php if(isset($show_default_currency_option) && $show_default_currency_option == true):?>
            <p>
                <input type="checkbox" name="default_currency"/>
                <span>Mark it as default currency</span>
            </p>
        <?php endif;?>
            <p><a class="button button-save" id="submit_button">Save</a>&nbsp;<a class="button button-cancel" href="<?php echo base_url();?>admin/currencies">Cancel</a></p>

        </form>


    </div>
<?php endif;?>
<script type="text/javascript">

    $(document).ready(function(){
        $('#adminmenu').accordion({fillSpace : false,active : 5 });

        $("#my_form").validity(function() {
            $("input[type='text']").require();
        });

        $(".currency_delete").click(function(event){
            if(!confirm("Are you sure you want to delete it?"))
            {
                event.preventDefault();
            }
            else
            {

                var url = $(this).attr('href').split('/');

                $currency_id = url[url.length -1];
                $default_currency_id = $("#default_currency_id").val();
                if($default_currency_id == $currency_id)
                {
                    alert("You can't delete the default currency. Make another as default currency then delete it.");
                    event.preventDefault();
                }

            }
           // return false;
        });
    });

</script>
</body>
</html>