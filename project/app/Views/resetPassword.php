<div class="container">
    <div class="col-4 offset-4">
        <?php echo form_open(base_url().'myprofile/changePassword'); ?>
            <h2 class="text-center">Reset Password</h2><br>
                <div class="form-group">
                    <?php echo $error; ?>
                </div>
                <div class="form-group">
                    <h5>Current Password</h5>
                    <input type="password" class="form-control" placeholder="Current Password" required="required" name="currentPassword">
                </div>
                <div class="form-group">
                    <h5>New Password</h5>
                    <input type="password" class="form-control" placeholder="New Password" required="required" name="newPassword">
                </div>
                <div class="form-group">
                    <h5>Retype New Password</h5>
                    <input type="password" class="form-control" placeholder="Retype New Password" required="required" name="checkPassword">
                </div>
                <div class="form-group">
                    <?php echo $error; ?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    <?php echo form_close(); ?>
                </div>
                <div class="form-group">
                    <a class="mx-4" href="<?php echo base_url(); ?>myprofile"> Cancel </a>
                </div>
        
    </div>
</div>