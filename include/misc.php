<?php
	function redirect ($url)
	{
		if (function_exists ('db_disconnect'))
			db_disconnect ();
		header ('Location: '.$url);
		die ();
	}

	function show_error ($error, $severity = 1)
	{
		if ($severity < 1 || $severity > 3)
			$heading_level = 1;
		else
			$heading_level = $severity;
		return '<h'.$heading_level.' class="error-message">'.$error.'</h'.$heading_level.">\n";
	}

	function sanitise_username ($str)
	{
		$o = $str;

		$o = preg_replace ('/[^A-Za-z0-9.\-_]/u', '', $o);
		$o = preg_replace ('/\.+/u', '.', $o);
		$o = preg_replace ('/-+/u', '-', $o);
		$o = preg_replace ('/_+/u', '_', $o);
		$o = preg_replace ('/[^A-Za-z0-9][^A-Za-z0-9]+/', '', $o);
		$o = preg_replace ('/^[^A-Za-z0-9]*/', '', $o);
		$o = preg_replace ('/[^A-Za-z0-9]*$/', '', $o);

		if ($o == $str)
			return $o;
	}

	function sanitise_email ($str)
	{
		$o = $str;

		$o = filter_var ($str, FILTER_VALIDATE_EMAIL);

		if ($o == $str)
			return $o;
	}

	function local_url ($url)
	{
		$base_url = 'http'.(!empty ($_SERVER['HTTPS']) ? 's' : '').'://'.$_SERVER['HTTP_HOST'].'/?p=';
		if (!empty ($url) && strpos ($url, $base_url) === 0)
			return strstr ($url, '/?p=');
	}
?>
