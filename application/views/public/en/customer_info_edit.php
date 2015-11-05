<div id="main-content" class="float-left fix" xmlns="http://www.w3.org/1999/html">
    <?php $this->load->view('public/'.get_language().'/search_view'); ?>

    <form action="<?php echo base_url() . "public/customer/change_my_account"; ?>" method="post">
        <ul class="user-login">
            <fieldset>
                <legend>Your Personal Details</legend>
                <h4><span class="star">*Required fields</span></h4>
                <table>
                    <tr>
                        <td>Gender <span class="star">*</span></td>
                        <td>
                            <input type="radio" id="male" name="gender"
                                   value="male" <?php echo $customer_gender==='male'? set_radio('gender', 'male', TRUE):set_radio('gender', 'male'); ?>> <label
                                for="male">Male</label>
                            <input type="radio" id="female" name="gender"
                                   value="female" <?php echo $customer_gender==='female'? set_radio('gender', 'female', TRUE):set_radio('gender', 'female'); ?>> <label for="female">Female</label>
                        </td>
                    </tr>
                    <tr>
                        <td>First Name <span class="star">*</span></td>
                        <td>
                            <input type="text" name="firstname" id="firstname"
                                   value=" <?php echo $customer_firstname;?>"></br>
                            <?php echo form_error('firstname', '<span class="error" style="color: red">', '</span>'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Last Name <span class="star">*</span></td>
                        <td>
                            <input type="text" name="lastname" id="lastname"
                                   value=" <?php echo $customer_lastname;?>"></br>
                            <?php echo form_error('lastname', '<span class="error" style="color: red">', '</span>'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Dath of Birth <span class="star">*</span></td>
                        <td>
                            <input type="text" name="dob" id="dob" value="<?php echo $customer_dob;?>"></br>
                            <?php echo form_error('dob', '<span class="error" style="color: red">', '</span>'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Email Address <span class="star">*</span></td>
                        <td>
                            <input type="text" name="email" id="email" value="<?php echo $customer_email;?>"></br>
                            <?php echo form_error('email', '<span class="error" style="color: red">', '</span>'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Mobile No <span class="star">*</span></td>
                        <td>
                            <input type="text" name="mobile" id="mobile" value="<?php echo $customer_mobile_no;?>"></br>
                            <?php echo form_error('mobile', '<span class="error" style="color: red">', '</span>'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td><a class="next-previous" href="<?php echo base_url() . "public/customer/account"; ?>">Back</a></td>
                        <td>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </td>
                        <td>
                            &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                        </td>
                        <td>
                          <input type="submit" class="next-previous" name="edit_customer_address" value="Continue"/>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </ul>
    </form>
</div>