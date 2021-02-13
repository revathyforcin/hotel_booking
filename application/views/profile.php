<?php include('includes/header.php'); ?>
<?php
	date_default_timezone_set('Asia/Kolkata');
  	$today = date('Y-m-d');
?>
<style type="text/css">
	.contact-form input {
		margin-bottom: 20px;
	}
  .error
  {
    color: red!important;
    margin-bottom: 20px;
  }
  .required_star
  {
    color: red!important;
  }
</style>

<section class="contact-section spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-2"></div>
			<div class="col-lg-8">
				<h2 class="text-center mb-5">Profile</h2>
        <?php
    if ($this->session->flashdata('success')) {
    
        echo '<section class="content-header"><div class="alert alert-success alert-dismissible"> 
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <p><i class="icon fa fa-check"></i>';
        echo $this->session->flashdata('success');
        echo '</p></div></section>';
    }
    ?> 
				<div class="card">
					<div class="card-body" style="padding: 50px;">
						<form action="<?=base_url('profile')?>" method="post" class="contact-form" id="form" enctype="multipart/form-data">
							<div class="row">
								<div class="col-lg-6">
									<input type="text" name="fname" placeholder="First Name" onkeypress="return /[a-z]/i.test(event.key)" value="<?php echo $details[0]->ud_fname;?>">
								</div>
								<div class="col-lg-6">
									<input type="text" name="lname" placeholder="Last Name" onkeypress="return /[a-z]/i.test(event.key)" value="<?php echo $details[0]->ud_lname;?>">
								</div>
								<div class="col-lg-6">
									<input type="text" name="designation" placeholder="Designation" onkeypress="return /[a-z]/i.test(event.key)" value="<?php echo $details[0]->ud_designation;?>">
								</div>
								<div class="col-lg-6">
									<input type="date" name="dob" placeholder="" max="<?=$today?>" value="<?php echo $details[0]->ud_dob;?>">
								</div>
								<div class="col-lg-6">
									<input type="text" name="email" placeholder="Email ID" value="<?php echo $details[0]->ud_email;?>">
								</div>
								<div class="col-lg-6">
									<input type="text" name="mobile" placeholder="Mobile No" onkeypress="return /[0-9]/i.test(event.key)" value="<?php echo $details[0]->ud_phone;?>">
								</div>
                <div class="col-lg-6">
                  <?php if($details[0]->ud_image) { ?>
                    <img src="<?=base_url().$details[0]->ud_image?>" width="200">
                    <input type="hidden" name="oldphoto" value="<?=$details[0]->ud_image?>">
                  <?php } ?>
                  <br><br>
									<input type="file" name="profile" placeholder="Profile Image">
								</div>
								<div class="col-lg-12 text-center">
									<button type="submit">Update</button>
								</div>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>

	</div>
</section>

<?php include('includes/footer.php'); ?>
<script src="<?php echo STYLE_URL; ?>js/jquery.validate.js"></script>
<script src="<?php echo STYLE_URL; ?>js/additional-methods.min.js"></script>
<script type="text/javascript">
$(document).ready(function() { 

	$.validator.addMethod('filesize', function (value, element, param) {
	    return this.optional(element) || (element.files[0].size <= param)
	}, 'File size must be less than {0}');

	"use strict";
    $("#form").validate({ 
      rules: {
          fname: 'required',
          lname: 'required',
          designation: 'required',
          dob: 'required',
          email: {
             required: true,
             email: true,//add an email rule that will ensure the value entered is valid email id.
             remote: {
              url: '<?php echo base_url(); ?>User/email_exists',
              type: "post"
           },
          },
          mobile: {
            required: true,
            number: true,
            minlength:'9',
            maxlength:'12',
            remote: {
              url: '<?php echo base_url(); ?>User/mobile_exists',
              type: "post"
           },
          },
          password:
          	{ 
          		required : true,
          	},
          cpassword:
          	{ 
          		required : true,
          		equalTo : "#password",
          	},
          	profile: {
                // required: true,
                extension: "jpg,jpeg,png",
                filesize: 2000000   //max size 2000 kb,
            }
        },
        messages: {
        fname: 'First Name is required',
        lname: 'Last Name is required',
        designation: 'Designation is required',
        dob: 'DOB required',
        email:  {
             required: 'Email Id required',
             email: 'Enter a valid email id',
             remote: "Email already exists!",
          },
          mobile: {
            required: 'Enter mobile No',
            number: 'Only numbers allowed',
            minlength:'Minimum 9 numbers required',
            maxlength:'Maximum 12 numbers allowed',
            remote: "Number already exists!",
          },
          password:
          	{ 
          		required : 'Password is required',
          	},
          cpassword:
          	{ 
          		required : 'Confirm Password is required',
          		equalTo : "Password do not matching",
          	},
          profile: {
                // required: 'Profile Image is required',
                extension: "Allowed extensions are jpg,jpeg,png",
                filesize: "Allowed file size is upto 2MB",
            }
    },
    });
});
</script>