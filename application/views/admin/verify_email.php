<div id="container">

    <form method="post" action="<?php echo base_url() . 'admin/account/check_email_exist' ?>">
        <h4 style="text-align: center;margin: 0;padding: 5px;color: #F2F2F2;">Verify Email</h4>
        <ul id="admin_login">
            <li><span style="color: #8A0000"><?php echo isset($message) ? $message : '';?></span></li>
            <li>
                <label style="text-align: center;margin: 0;padding: 5px;color: #F2F2F2;">E-mail</label> <input
                    type="email" name="email" placeholder="example@gmail.com">
            </li>
            <li>
                <?php echo form_error('email', '<span class="error" style="color: #8A0000">', '</span>'); ?>
            </li>

            <li>
                <input class="submit" type="submit" name="verify" value="Verify">
            </li>
        </ul>
    </form>
</div>