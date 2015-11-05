<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MONIR
 * Date: 9/12/13
 * Time: 12:54 PM
 * To change this template use File | Settings | File Templates.
 */
?>
<div id="main-content" class="float-left fix" xmlns="http://www.w3.org/1999/html">

    <?php $this->load->view('public/'.get_language().'/search_view'); ?>

    <div class="customer-sign-in float-left">

        <h2>Welcome Please Sign in</h2>

        <h3>New Customer</h3>

        <p>I am a new customer.</p>

        <p>By creating an account at Himalaya Fashion House you will be able to shop faster,
            be up to date on an orders status, and keep track of the orders you have previously made.</p>

        <p><span><a class="continue float-right" href="<?php echo base_url() . "public/customer/signup"; ?>">Continue</a> </span>
        </p>
    </div>
    <div class="customer-login float-right">
        <h3>Returning Customer</h3>

        <p>
            I am a Returning Customer
           <span style="color: #cc0000;font-size: 12px;"> <?php echo '<br/>'. $message;?></span>

        <p>

        <form action="<?php echo base_url() . "public/customer/login"; ?>" method="post">
            <ul class="user-login">
                <li><label>Email :</label></li>
                <li>
                    <input type="text" name="email" value="<?php echo set_value('email'); ?>"
                           placeholder="User Email"><br/>
                    <?php echo form_error('email', '<span class="error" style="color: red">', '</span>'); ?>
                </li>
                <li><label>Password:</label></li>
                <li>
                    <input type="password" name="password" value="" placeholder="User Password"><br/>
                    <?php echo form_error('password', '<span class="error" style="color: red">', '</span>'); ?>
                </li>
                <li><a href="#"> Forgot password</a></li>
                <li><input type="submit" name="submit" value="Login"></li>
            </ul>
        </form>
    </div>
</div>