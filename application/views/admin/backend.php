<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Adminium - Login</title>
	<meta name="description" content="">

	<meta name="viewport" content="width=device-width">

	<link rel="stylesheet" href="<?php echo $base; ?>newadmin/css/style_login.css">
	<link rel="stylesheet" href="<?php echo $base; ?>newadmin/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo $base; ?>newadmin/css/bootstrap-responsive.css">
</head>
<?php
$class_login='';
$class_pass='';
$error_login = form_error('login');
$error_password = form_error('password');

if($error_login != '') { $class_login = 'error'; } else { $class_login='email'; }

if($error_password != '') { $class_pass = 'error'; } else { $class_pass='pw'; }
?>
<body>
	<div class="container" id="wrap">
		<form action="" method="post" class='form' id="login_part">
		<div class="head">
				<i class="icon-white icon-share"></i>
				Admin Login Section
			</div>
		<div class="login_wrap">			
				<label for="email">Email</label>
				<div class="input-prepend">
					<span class="add-on"><i class='icon-envelope'></i></span>
					<input type="text" value="<?php echo set_value('login'); ?>" name='login' id="email" class='<?php echo $class_pass;?>' placeholder="Your Email..." />
					<?php echo form_error('login'); ?><?php echo isset($errors['login'])?$errors['login']:''; ?>
				</div>
				<label for="password">Password</label>
				<div class="input-prepend">
					<span class="add-on"><i class='icon-lock'></i></span>
					<input type="password" value="<?php echo set_value('password'); ?>" name="password" id="password" placeholder="Password" class='<?php echo $class_pass;?>' />
					<?php echo form_error('password'); ?><?php echo isset($errors['password'])?$errors['password']:''; ?>
				</div>
				<!--<label class="checkbox"><input type="checkbox" name="remember" value="1"> Remember me</label>-->
		</div>
		<div class="bottom clearfix">
			<input type="hidden" name="user_type" id="user_type" value="admin" >
			<button type="submit" class='btn btn-darkgrey pull-right'>Login</button>
			
			<!--<a href="#" class='pull-left lost-pw'>Lost password?</a>-->
		</div>
		</form>
	</div>
</body>
</html>