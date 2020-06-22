<?php
include_once ('../config-init.php');
include_once (ABSOLUTE_PATH.'/user/header.php');
?>

<?php
if ($_GET['action']=='exit') {
	session_destroy();
}
else if ($_POST['email'] && $_POST['password']) {
	$q=$sql->executeSQL("SELECT `id` FROM `data` WHERE `content`->'$.email'='".$_POST['email']."' && `content`->'$.password'='".md5($_POST['password'])."' && `content`->'$.type'='user'");
	if ($q[0]['id']) {
		$user=$dash->get_content($q[0]['id']);
		$roleslug=$user['role_slug'];

		//for admin and crew (staff)
		if ($types['user']['roles'][$roleslug]['role']=='admin' || $types['user']['roles'][$roleslug]['role']=='crew') {
			$_SESSION['user_id']=$user['user_id'];
			$_SESSION['email']=$user['email'];
			$_SESSION['user']=$user;
			$_SESSION['wildfire_dashboard_access']=1;
			header('Location: /admin');
		}

		//for members
		else if ($types['user']['roles'][$roleslug]['role']=='member') {
			$_SESSION['user_id']=$user['user_id'];
			$_SESSION['email']=$user['email'];
			$_SESSION['user']=$user;
			$_SESSION['wildfire_dashboard_access']=0;
			header('Location: /user');
		}

		//for visitors and anybody else
		else 
			header('Location: /');
	}
}
?>

<form class="form-signin" method="post" action="/user/login"><h2><?php echo $menus['main']['logo']['name']; ?></h2>
	<h4 class="my-3 font-weight-normal"><span class="fas fa-lock"></span>&nbsp;Sign in</h4>
	<label for="inputEmail" class="sr-only">Email address</label>
	<input type="email" name="email" id="inputEmail" class="form-control my-1" placeholder="Email address" required autofocus>
	<label for="inputPassword" class="sr-only">Password</label>
	<input type="password" name="password" id="inputPassword" class="form-control my-1" placeholder="Password" required>
	<div class="checkbox my-1 small"><label><input type="checkbox" class="my-0" value="remember-me"> Remember me</label></div>
	<button type="submit" class="btn btn-sm btn-primary btn-block my-1">Sign in</button>
	<a class="btn btn-sm btn-outline-primary btn-block my-1" href="/admin/auth?section=register">Register</a>
	<p class="text-muted small my-2"><a href="/admin/auth?section=forgot-password"><span class="fas fa-key"></span>&nbsp;Forgot password?</a></p>
	<p class="text-muted small my-5"><?php echo '<a href="'.BASE_URL.'"><span class="fas fa-angle-double-left"></span>&nbsp;'.$menus['main']['logo']['name'].'</a>'; ?></p>
	<p class="text-muted small my-5">&copy; <?php echo (date('Y')=='2020'?date('Y'):'2020 - '.date('Y')); ?> Wildfire</p>
</form>

<?php include_once (ABSOLUTE_PATH.'/user/footer.php'); ?>