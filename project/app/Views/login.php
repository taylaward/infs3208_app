<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<div class="container">
    <div class="col-4 offset-4">
        <?php echo form_open(base_url().'login/check_login'); ?>
            <h2 class="text-center">Login</h2>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" required="required" name="username" value="<?php echo (get_cookie("username"))?get_cookie("username"):'';?>">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" required="required" name="password">
                </div>
                <div class="form-group">
                    <?php echo $error; ?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Log in</button>
                </div>
                <div class="clearfix">
                    <label class="float-left form-check-label"><input type="checkbox" name="remember"> Remember me</label>
                    <a href="<?php echo base_url(); ?>login/forgotPasswordPage" class="float-right">Forgot Password?</a>
                </div>
        <?php echo form_close(); ?>
    </div>
</div>


