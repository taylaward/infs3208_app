<style>
	.files input {
    outline: 2px dashed #92b0b3;
    outline-offset: -10px;
    -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
    transition: outline-offset .15s ease-in-out, background-color .15s linear;
    padding: 120px 0px 85px 35%;
    text-align: center !important;
    margin: 0;
    width: 100% !important;
}
.files input:focus{     outline: 2px dashed #92b0b3;  outline-offset: -10px;
    -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
    transition: outline-offset .15s ease-in-out, background-color .15s linear; border:1px solid #92b0b3;
 }
.files{ position:relative}
.files:after {  pointer-events: none;
    position: absolute;
    top: 60px;
    left: 0;
    width: 50px;
    right: 0;
    height: 56px;
    content: "";
    background-image: url(https://image.flaticon.com/icons/png/128/109/109612.png);
    margin: 0 auto;
    background-size: 100%;
    background-repeat: no-repeat;
}
.color input{ background-color:#f1f1f1;}
.files:before {
    position: absolute;
    bottom: 10px;
    left: 0;  pointer-events: none;
    width: 100%;
    right: 0;
    height: 57px;
    content: " or drag it here. ";
    margin: 0 auto;
    color: #2ea591;
    font-weight: 600;
    text-transform: capitalize;
    text-align: center;
}
</style>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<script>
	function hideBtn() {
		document.getElementById('saveBtn').style.display = 'none';
		document.getElementById('cancelBtn').style.display = 'none';
		document.getElementById('imgLabel').style.display = 'none';
		document.getElementById('image').style.display = 'none';
		document.getElementById('imgDiv').style.display = 'none';
	}
	
	function editForm() {
		document.getElementById("firstName").removeAttribute("readonly");
		document.getElementById("lastName").removeAttribute("readonly");
		document.getElementById("mobileNumber").removeAttribute("readonly");
		document.getElementById("email").removeAttribute("readonly");
		document.getElementById('editBtn').style.display = 'none';
		document.getElementById('saveBtn').style.display = 'block';
		document.getElementById('cancelBtn').style.display = 'block';
		document.getElementById('imgLabel').style.display = 'block';
		document.getElementById('image').style.display = 'block';
		document.getElementById('resetPwdBtn').style.display = 'none';
		document.getElementById('imgDiv').style.display = 'block';
	}

	function cancelForm() {
		document.getElementById("firstName").setAttribute("readonly", "readonly");
		document.getElementById("lastName").setAttribute("readonly", "readonly");
		document.getElementById("mobileNumber").setAttribute("readonly", "readonly");
		document.getElementById("email").setAttribute("readonly", "readonly");
		document.getElementById('editBtn').style.display = 'block';
		document.getElementById('saveBtn').style.display = 'none';
		document.getElementById('cancelBtn').style.display = 'none';
		document.getElementById('imgLabel').style.display = 'none';
		document.getElementById('image').style.display = 'none';
		document.getElementById('resetPwdBtn').style.display = 'block';
		document.getElementById('imgDiv').style.display = 'none';
	}

	window.onload = hideBtn;

</script>
<div class="container-fluid">
	<div class="row">

		<div class="col-md-12">
			<h3>My Profile</h3>
			<div class="row">
				<div class="col-md-4">
					<img src="<?php echo (!$profile['pfp_filename'] == NULL)?$profile['pfp_filename']:'/project/writable/pfp/nullPFP.png';?>" >
					
				</div>
				<div class="col-md-6">
					<div class="p-3 jumbotron">
					<h5>Account Status:</h5>
					<p><?php if ($profile['status'] == 0) {
						echo 'Student';
					} else {
						echo 'Staff';
					}?></p>
					<h5>Number of Posts Made:</h5>
					<p><?= $post_data['numPosts'];?></p>
					<h5>Number of Replies Made:</h5>
					<p><?= $post_data['numReplies'];?></p>

					</div>
				</div>
				<div class="col-md-4">
				</div>
			</div>

			<!-- Profile Form -->
			<?= validation_list_errors() ?>
			<?php echo form_open_multipart(base_url().'myprofile/updateProfile'); ?>
				<div class="form-group">
					<div id="imgDiv" class="form-group files" style="display:none">
						<label id="imgLabel">Upload Your File </label>
						<input type="file" name="image" class="form-control" id="image">
					</div>
					<!-- <label for="image" id="imgLabel">Select an image</label>
					<input  type="file" name="files[]" id="image"/> -->
					<!-- box__input <input class="box__file" type="file" name="image" id="image"> -->
				</div>
				<div class="form-group">
					<h5>Username:</h5>
					<input type="text" class="form-control" placeholder="Username" name="username" id="username" value="<?php echo (isset($profile['username']))?$profile['username']:'';?>" readonly>
				</div>
				<div class="form-group">
					<h5>First Name:</h5>
					<input type="text" class="form-control" placeholder="First Name" name="firstName" id="firstName" value="<?php echo (isset($profile['first_name']))?$profile['first_name']:'';?>" readonly>
				</div>
				<div class="form-group">
					<h5>Last Name:</h5>
					<input type="text" class="form-control" placeholder="Last Name" name="lastName" id="lastName" value="<?php echo (isset($profile['last_name']))?$profile['last_name']:'';?>" readonly>
				</div>
				<div class="form-group">
					<h5>Email:</h5> 
					
					<?php if (!$valid) {?>
						<p class="text-danger">Email has not been Validated!
						<a class="mx-4" href="<?php echo base_url(); ?>signup/reVerify">Send Verification</a></p> 
						<?php } ?>
					<input type="text" class="form-control" placeholder="Email" name="email" id="email" value="<?php echo (isset($profile['email']))?$profile['email']:'';?>" readonly>
				</div>
				<div class="form-group">
					<h5>Mobile Number:</h5>
					<input type="text" class="form-control" placeholder="Mobile Number" name="mobileNumber" id="mobileNumber" value="<?php echo (isset($profile['mobile_number']))?$profile['mobile_number']:'';?>" readonly>
				</div>
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<button type="button" class="btn btn-primary" onClick="editForm()" id="editBtn">Edit Account</button>
							<button type="submit" class="btn btn-primary" id="saveBtn" >Save Changes</button>
							<button type="reset" class="btn btn-secondary" id="cancelBtn" onClick="cancelForm()" >Cancel</button>
						</div>
					</div>
			<?php echo form_close(); ?>
					<div class="col-1">
						
					</div>
					<div class="col-5">
						<?php echo form_open_multipart(base_url().'myprofile/resetPassword'); ?>
						<button type="submit" class="btn btn-danger" id="resetPwdBtn">Reset Password</button>
						<?php echo form_close(); ?>
					</div>
				
				
				
				</div>
			
		</div>
	</div>
</div>
