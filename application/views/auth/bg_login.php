<html>
<head>
	<title>Login Administrator</title>
	<link rel="shortcut icon" href="<?php echo base_url();?>assets/img/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/font-awesome.css">
</head>
<body class="account-bg">
	<div class="account-wrapper">
			<img src="<?php echo base_url();?>assets/img/logo.png" alt="Target Admin">

		<div class="account-body">
		<h3 class="account-body-title">Selamat Datang Administrator</h3>
		<h5 class="account-body-subtitle">Silahkan Login</h5>

		<form class="form account-form" method="POST" action="<?php echo site_url('auth');?>">
	        <div class="form-group">
	          <label for="login-username" class="placeholder-hidden">Username</label>
	          <input type="text" class="form-control" name="username" id="login-username" placeholder="Username" tabindex="1">
	        </div> <!-- /.form-group -->

	        <div class="form-group">
	          <label for="login-password" class="placeholder-hidden">Password</label>
	          <input type="password" class="form-control" name="password" id="login-password" placeholder="Password" tabindex="2">
	        </div> <!-- /.form-group -->

	         <div class="form-group">
	          <label for="login-password" class="placeholder-hidden">Password</label>
	          <select name="tipe_login" class="form-control">
	          	<option value="">--Pilih Menu--</option>
	          	<option value="user">User</option>
	          	<option value="administrator">Administrator</option>
	          </select>
	        </div> <!-- /.form-group -->


	        <div class="form-group">
	          <button type="submit" name="submit" class="btn btn-success btn-block btn-lg" tabindex="4">
	            Login &nbsp; <i class="fa fa-sign-in"></i>
	          </button>
	        </div> <!-- /.form-group -->
      	</form>
	      <?php echo validation_errors(); ?>
	      <?php echo $this->session->flashdata('result_login') ?>
		</div>
	</div>

</body>
</html>