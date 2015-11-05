<div id="main-content" class="float-left fix" xmlns="http://www.w3.org/1999/html">
    <?php $this->load->view('public/'.get_language().'/search_view'); ?>
    <form action="<?php echo base_url()."public/customer/validate_customer";?>" method="post">
    <?php
    // echo validation_errors('<div class="error">', '</div>');
    ?>
    <style>
        .error{
            font-size: 10px;
        }
    </style>
        <fieldset>
            <legend>Your Personal Details</legend>
           <h4> <span class="star">*Required fields</span></h4>
            <table>
                <tr>
                    <td>Gender <span class="star">*</span></td>
                    <td>
                        <input type="radio" id="male" name="gender" value="male" <?php echo set_radio('gender', 'male', TRUE); ?>> <label for="male">Male</label>
                        <input type="radio" id="female" name="gender" value="female" <?php echo set_radio('gender', 'female'); ?>> <label for="female">Female</label>
                    </td>
                </tr>
                <tr>
                    <td>First Name <span class="star">*</span></td>
                    <td>
                        <input type="text" name="firstname" id="firstname" value="<?php echo set_value('firstname');?>"></br>
                        <?php echo form_error('firstname', '<span class="error" style="color: red">', '</span>'); ?>
                    </td>
                </tr>
                <tr>
                    <td>Last Name <span class="star">*</span></td>
                    <td>
                        <input type="text" name="lastname" id="lastname" value="<?php echo set_value('lastname');?>"></br>
                        <?php echo form_error('lastname', '<span class="error" style="color: red">', '</span>'); ?>
                    </td>
                </tr>
                <tr>
                    <td>Dath of Birth <span class="star">*</span></td>
                    <td>
                        <input type="text" name="dob" id="dob" value="<?php echo set_value('dob');?>"></br>
                        <?php echo form_error('dob', '<span class="error" style="color: red">', '</span>'); ?>
                    </td>
                </tr>
                <tr>
                    <td>Email Address <span class="star">*</span> </td>
                    <td>
                        <input type="text" name="email" id="email" value="<?php echo set_value('email');?>"></br>
                        <?php echo form_error('email', '<span class="error" style="color: red">', '</span>'); ?>
                    </td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <legend>Company Details </legend>
            <table
            <tr>
                <td>Company Name</td>
                <td>
                    <input type="text" name="company" id="company" value="<?php echo set_value('company');?>"></br>
                    <?php echo form_error('company', '<span class="error" style="color: red">', '</span>'); ?>
                </td>
            </tr>

            </table>
        </fieldset>
        <fieldset>
            <legend>Your Address <span class="star">*</span></legend>
            <table
            <tr>
                <td>Street Address <span class="star">*</span></td>
                <td>
                    <input type="text" name="street" id="street" value="<?php echo set_value('street');?>"></br>
                    <?php echo form_error('street', '<span class="error" style="color: red">', '</span>'); ?>
                </td>
            </tr>
            <tr>
                <td>Suburb <span class="star">*</span></td>
                <td>
                    <input type="text" name="suburb" id="suburb" value="<?php echo set_value('suburb');?>"></br>
                    <?php echo form_error('suburb', '<span class="error" style="color: red">', '</span>'); ?>
                </td>
            </tr>
            <tr>
                <td>Post Code <span class="star">*</span></td>
                <td>
                    <input type="text" name="post" id="post" value="<?php echo set_value('post');?>"></br>
                    <?php echo form_error('post', '<span class="error" style="color: red">', '</span>'); ?>
                </td>
            </tr>
            <tr>
                <td>City <span class="star">*</span></td>
                <td>
                    <input type="text" name="city" id="city" value="<?php echo set_value('city');?>"></br>
                    <?php echo form_error('city', '<span class="error" style="color: red">', '</span>'); ?>
                </td>
            </tr>
            <tr>
                <td>State/Province <span class="star">*</span></td>
                <td>
                    <select name="state" id="state" disabled>
                    </select>
                    <?php echo form_error('state', '<span class="error" style="color: red">', '</span>'); ?>
                </td>
            </tr>
            <tr>
                <td>Country <span class="star">*</span></td>
                <td>
                    <select name="country" id="country">
                        <option value="0">--Select One--</option>
                        <?php if(count($countries) >0): foreach($countries as $country): ?>
                        <option value="<?php echo $country->country_id;?>">
                            <?php echo $country->country_name;?>
                        </option>
                        <?php endforeach;endif; ?>
                    </select></br>
                    <?php echo form_error('country', '<span class="error" style="color: red">', '</span>'); ?>
                </td>
            </tr>

            </table>
        </fieldset>
        <fieldset>
            <legend>Your Contact Information</legend>
            <table
            <tr>
                <td>Telephone no</td>
                <td>
                    <input type="text" name="telephone" id="telephone" value="<?php echo set_value('telephone');?>"></br>
                    <?php echo form_error('telephone', '<span class="error" style="color: red">', '</span>'); ?>
                </td>
            </tr>
            <tr>
                <td>Mobile no <span class="star">*</span></td>
                <td>
                    <input type="text" name="mobile" id="mobile" value="<?php echo set_value('mobile');?>"></br>
                    <?php echo form_error('mobile', '<span class="error" style="color: red">', '</span>'); ?>
                </td>
            </tr>

            </table>
        </fieldset>
        <fieldset>
            <legend>Your Password </legend>
            <table
            <tr>
                <td>Password <span class="star">*</span></td>
                <td>
                    <input type="password" name="password" id="password"></br>
                    <?php echo form_error('password', '<span class="error" style="color: red">', '</span>'); ?>
                </td>
            </tr>
            <tr>
                <td>Password Confirmation <span class="star">*</span></td>
                <td>
                    <input type="password" name="conform_password" id="conform_password"></br>
                    <?php echo form_error('conform_password', '<span class="error" style="color: red">', '</span>'); ?>
                </td>
            </tr>
            <tr></tr>
            <tr>
                <td></td> <td>&nbsp;&nbsp;</td> <td>&nbsp;&nbsp;</td>
                <td>
                    <input type="submit" name="submit" id="Continue" value="Continue">
                </td>
            </tr>

            </table>
        </fieldset>

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