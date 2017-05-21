<?php
	$db_link = null;

	function db_connect ()
	{
		$config = require ('../include/config.php');
		global $db_link;

		if ($db_link)
			return $db_link;

		$db_link = mysqli_connect ($config['db_server'], $config['db_user'], $config['db_password'], $config['db_database']);
		if (!$db_link || mysqli_connect_errno ())
		{
			echo mysqli_connect_error ()."\n";
			$db_link = null;
		}

		return $db_link;
	}

	function db_disconnect ()
	{
		global $db_link;

		mysqli_close ($db_link);
		$db_link = null;
	}

	function db_query ($sql)
	{
		global $db_link;

		return mysqli_query ($db_link, $sql);
	}

	function db_escape ($s)
	{
		global $db_link;

		return mysqli_real_escape_string ($db_link, $s);
	}

	function db_error ()
	{
		global $db_link;

		return mysqli_error ($db_link);
	}

	function db_errno ()
	{
		global $db_link;

		return mysqli_errno ($db_link);
	}

	function db_fetch_row ($result)
	{
		if ($result)
			return mysqli_fetch_row ($result);
	}

	function db_fetch_assoc ($result)
	{
		if ($result)
			return mysqli_fetch_assoc ($result);
	}

	function db_num_rows ($result)
	{
		if ($result)
			return mysqli_num_rows ($result);
	}
?>
