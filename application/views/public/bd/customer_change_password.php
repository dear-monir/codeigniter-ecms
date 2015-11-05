<div id="main-content" class="float-left fix" xmlns="http://www.w3.org/1999/html">
    <?php $this->load->view('public/'.get_language().'/search_view'); ?>

    <form action="<?php echo base_url() . "public/customer/change_password"; ?>" method="post">

            <fieldset>
                <legend>Your Personal Details</legend>
                <h4><span class="star">*Required fields</span></h4>
                <table>
                    <tr>
                        <td>Current Password <span class="star">*</span></td>
                        <td>
                            <input type="password" name="current_password" id="current_password"
                                   value=""></br>
                            <?php echo form_error('current_password', '<span class="error" style="color: red">', '</span>'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>New Password <span class="star">*</span></td>
                        <td>
                            <input type="password" name="new_password" id="new_password"
                                   value=""></br>
                            <?php echo form_error('new_password', '<span class="error" style="color: red">', '</span>'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Conform Password<span class="star">*</span></td>
                        <td>
                            <input type="password" name="conform_password" id="conform_password"
                                   value=""></br>
                            <?php echo form_error('conform_password', '<span class="error" style="color: red">', '</span>'); ?>
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
                            <input type="submit" class="next-previous" name="change_password" value="change"/>
                        </td>
                        </td>
                    </tr>
                </table>
            </fieldset>
    </form>
</div>