<?php $this->load->view('includes/header.php'); ?>
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
			<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<h2 class="text-center mb-5">Login</h2>
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
						<form action="<?=base_url('Auth/authenticate')?>" method="post" class="contact-form" id="form" enctype="multipart/form-data">
							<div class="row">
								<div class="col-lg-12">
									<input type="text" name="email" placeholder="Email ID">
								</div>
								<div class="col-lg-12">
									<input type="password" name="password" id="password" placeholder="Password">
								</div>
								<div class="col-lg-12 text-center">
									<button type="submit">Login</button>
								</div>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>

	</div>
</section>

<?php $this->load->view('includes/footer.php'); ?>
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
          email: {
             required: true,
          },
          password:
          	{ 
          		required : true,
          	},
        },
        messages: {
        email:  {
             required: 'Email Id required',
            },
          password:
          	{ 
          		required : 'Password is required',
          	},
    },
    });
});
</script>