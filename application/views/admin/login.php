<div id="container">
    <div class="content">
        <form method="post" action="<?php echo base_url() . 'admin/account/validate_credential' ?>">
            <h4 style="text-align: center;margin: 0;padding: 5px;color: #F2F2F2;">Login</h4>
            <ul id="admin_login">
                <li><span style="color: #8A0000"><?php echo isset($message) ? $message : '';?></span></li>
                <li>
                    <label style="color: #F2F2F2;font-weight: bold">E-mail:</label>
                    <input type="email" name="email" value="<?php echo ''; ?>" placeholder=" example@gmail.com">
                </li>
                <li><?php echo form_error('email', '<span class="error" style="color: #8A0000">', '</span>'); ?>
                </li>
                <li>
                    <label style="color: #F2F2F2;font-weight: bold">Password:</label>
                    <input type="password" name="password" value="<?php echo ''; ?>" placeholder=" password">
                </li>
                <li><?php echo form_error('password', '<span class="error" style="color: #8A0000">', '</span>'); ?>
                </li>
                <li>
                    <a class="forget" style="font-size: 14px;color: #F2F2F2;"
                       href="<?php echo base_url() . 'admin/account/verify_email' ?>">Forget Password</a>
                </li>
                <li>
                    <input class="submit" type="submit" name="login" value="Login">
                </li>
            </ul>
        </form>
    </div>
</div>