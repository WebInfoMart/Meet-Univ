<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

	<meta http-equiv="X-UA-Compatible" content="IE=7" />

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
	<title>Adminium - Login</title>
	
	<meta name="description" content="." />
	<meta name="keywords" content="." />
		
	<link href="../<?php echo $admin_css ?>/style.css" rel="stylesheet">
	
	
	<!--[if lt IE 9]>
	<style type="text/css" media="all"> @import url("css/ie.css"); </style>
	<![endif]-->

</head>




<body class="loginpage">


	<div id="header">
	
	<a href="#"><img src="<?php echo "$base$img_path"?>/logo.png" alt="" height="50px;" width="180px" /></a>
			
		
		<a href="<?php echo $base; ?>" class="backlink">&laquo; Back to the site</a>			
	</div>			<!-- #header ends -->
	
	
	
	
	
	
	<div id="content" class="loginbox">
	
		<div class="message info"><p>Admin Login Section</p></div>
		<form action="" method="post">
			<div>
				<label>Username:</label> <br />
				<input type="text" class="text" name="login" id="login" placeholder="Username" value="<?php echo set_value('login'); ?>">
				<span style="color:red;"> <?php echo form_error('login'); ?><?php echo isset($errors['login'])?$errors['login']:''; ?> </span>			
			</div>
			
			<div>
				<label>Password:</label> <br />
				<input type="password" class="text" name="password" id="password" placeholder="Password" value="<?php echo set_value('password'); ?>" >
				<span style="color:red;"> <?php echo form_error('password'); ?><?php echo isset($errors['password'])?$errors['password']:''; ?></td> </span>
							
			</div>
			
			<div class="formend">
				<input type="hidden" name="user_type" id="user_type" value="admin" >
				<input type="submit" class="submit" value="Login" /> &nbsp; 
				<!--<input type="checkbox" class="checkbox" checked="checked" id="rememberme" /> <label for="rememberme">Remember me</label>-->
			</div>
		</form>
	</div>		<!-- .loginbox ends -->
	
	
	
	
	


</body>
</html>
