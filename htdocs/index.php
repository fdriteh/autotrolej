<?php
	session_start ();

	require_once ('../include/locale.php');
	require_once ('../include/pager.php');
	require_once ('../include/db_functions.php');
	db_connect ();
	require_once ('../include/user.php');
	require_once ('../include/misc.php');

	$page = isset ($_GET['p']) ? $_GET['p'] : 'home';
	$page_body = make_page ($page);
?>
<!doctype html>
<html>
	<head>
		<title>Autotrolej<?=($page_title = make_page_title ($page)) ? ' | '.$page_title : ''?></title>
		<link rel="stylesheet" href="css/<?=get_css_file ($page, 'autotrolej')?>.css">
	</head>
	<body>
<?php
	if (!user_id ())
	{
?>
		<a href="/?p=login"><?=_('Log In')?></a>
		<a href="/?p=register"><?=_('Register')?></a>
<?php
	}
	else
	{
?>
		<a href="/?p=profile"><?=_('My Profile')?></a>
		<a href="/?p=logout"><?=_('Log Out')?> (<?=user_prop ('ime')?> <?=user_prop ('prezime')?>)</a>
<?php
	}
?>
		<div class="content">
<?php
	echo $page_body;
?>
		</div>
	</body>
</html>
<?php
	db_disconnect ();
?>
