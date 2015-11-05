<div id="container">

    <form method="post" action="<?php echo base_url() . 'admin/account/update_password' ?>">
        <h4 style="text-align: center;margin: 0;padding: 5px;color: #F2F2F2;">Change Password</h4>
        <ul id="admin_login">
            <li><span style="color: #8A0000"><?php echo isset($message) ? $message : '';?></span></li>
            <li>
                <label style="color: #F2F2F2;font-weight: bold">Key:</label>
                <input type="text" name="key" value="<?php echo $key; ?><?php echo set_value('key');?>" placeholder="Key">
            </li>
            <li><?php echo form_error('key', '<span class="error" style="color: #8A0000">', '</span>'); ?>
            <li>
                <label style="color: #F2F2F2;font-weight: bold">Password:</label> <input type="password" name="password" value="<?php echo ''; ?>"
                                                placeholder="password">
            </li>
            <li><?php echo form_error('password', '<span class="error" style="color: #8A0000">', '</span>'); ?>
            </li>
            <li>
                <label style="color: #F2F2F2;font-weight: bold">Conform Password:</label> <input type="password" name="cpassword" value="<?php echo ''; ?>"
                                                        placeholder="password">
            </li>
            <li><?php echo form_error('cpassword', '<span class="error" style="color: #8A0000">', '</span>'); ?>
            </li>
            <li>
                <input class="submit" type="submit" name="login" value="Reset Password">
            </li>
        </ul>

    </form>
</div>