<?php
if (isset($_SESSION['ruser']))
{
	echo '<form action="index.php';
	if (isset($_GET['page'])) echo '?page='.$_GET['page'];
	echo '"method="post">';
	echo '<div class="users">Привет, <span>'.$_SESSION['ruser'].'</span>&nbsp;';
	echo '<input type="submit" value="Logout" id="ex" name="ex"></div>';
	echo '</form>';
	if (isset($_POST['ex'])) 
	{
		unset($_SESSION['ruser']);
		unset($_SESSION['radmin']);
		echo '<script>window.location.reload()</script>';
	}
}
else
{
	if (isset($_POST['press'])) 
	{
		if(login($_POST['login'],$_POST['pass']))
		{
			echo '<script>window.location.reload()</script>';
		}
	}
	else
	{
		echo '<form action="index.php';
		if (isset($_GET['page'])) echo '?page='.$_GET['page'];
		echo '"method="post">';
		echo '<input type="text" name="login" size="10" class=""
 placeholder="login">
		<input type="password" name="pass" size="10" class=""
  placeholder="password">
		<input type="submit" id="press" value="Login" name="press">
		</form>';
	}
}
