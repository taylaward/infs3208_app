<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<div class="container">
    <div class="col-4 offset-4">
        <?php echo form_open(base_url().'login/getCode'); ?>
            <h2 class="text-center">Forgot Password</h2>
                <div class="form-group">
                    <h3>Email:</h3><br>
                    <input type="text" class="form-control" placeholder="Email" required="required" name="email">
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </div>
        <?php echo form_close(); ?>
    </div>
</div>


