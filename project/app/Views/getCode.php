<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<div class="container">
    <div class="col-4 offset-4">
        <?php echo form_open(base_url().'login/checkCode'); ?>
            <h2 class="text-center">Type the code from your email</h2>
                <div class="form-group">
                    <h3>Code:</h3><br>
                    <input type="text" class="form-control" placeholder="Code" required="required" name="code">
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </div>
        <?php echo form_close(); ?>
    </div>
</div>


