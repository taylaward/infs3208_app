<div class="container">
    <div class="col-4 offset-4">
        <?= validation_list_errors() ?>
        <?php echo form_open(base_url().'signup/register'); ?>
            <h2 class="text-center">Sign Up</h2>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" required="required" name="username">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Email" required="required" name="email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" required="required" name="password">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" required="required" name="passwordCheck">
                </div>
                <div class="form-group">
                    <?php echo $error; ?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                </div>
        <?php echo form_close(); ?>
    </div>
</div>


