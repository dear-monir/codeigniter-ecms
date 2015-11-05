<?php
/**
 * Created by PhpStorm.
 * User: Monir
 * Date: 7/1/14
 * Time: 8:39 PM
 */
$user_currency_info = getUserCurrencyInfo();
?>
<div id="main-content" class="float-left fix">
    <?php $this->load->view('public/'.get_language().'/search_view'); ?>
    <h1>New Shipping Address</h1>
    <b>Please use the following form to create a new shipping address to use for this order</b>

    <form method="post" action="<?php echo base_url().'public/shipping/new_shipping_address';?>">
    <table>
        <tr>
            <td>Gender:</td>
            <td>
                <input type="radio" value="m" name="gender" checked>
                Male
                <input type="radio" value="f" name="gender">
                Female
            </td>
        </tr>
        <tr>
            <td>First Name:</td>
            <td>
                <input type="text" name="fname">
            </td>
        </tr>
        <tr>
            <td>Last Name:</td>
            <td>
                <input type="text" name="lname">
            </td>
        </tr>
        <tr>
            <td>Street Address:</td>
            <td>
                <input type="text" name="saddress">
            </td>
        </tr>
        <tr>
            <td>Post Code:</td>
            <td>
                <input type="text" name="postcode">
            </td>
        </tr>
        <tr>
            <td>City:</td>
            <td>
                <input type="text" name="city">
            </td>
        </tr>
        <tr>
            <td>State:</td>
            <td>
                <!--<input type="text" name="state">-->
                <select name="state" id="state" disabled>

                </select>
            </td>
        </tr>
        <tr>
            <td>Country:</td>
            <td>
                <select name="country" id="country">
                    <option value="0">--Select One--</option>
                    <?php if(count($countries)):foreach($countries as $country): ?>
                    <option value="<?php echo $country->country_id; ?>">
                        <?php echo $country->country_name; ?>
                    </option>
                    <?php  endforeach; endif; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <input type="submit" value="Continue">
            </td>
        </tr>
    </table>
    </form>
</div>

<script type="text/javascript">

    $(document).ready(function(){


        $("#country").change(function(){
            country_id = $(this).val();
            var url = "<?php  echo base_url().'public/states/index/';?>";
            if(country_id != "0")
            {
                url =  url + country_id;
                $.getJSON(url, function(data){
                    $("#state").removeAttr('disabled').html('');
                    if(data!=null)
                    {
                        for (var i=0, len=data.length; i < len; i++) {
                            option = '<option value="'+data[i].id+'">'+data[i].name+'</option>'
                            $("#state").append(option);
                        }
                    }

                });
            }
        });
    });

</script>