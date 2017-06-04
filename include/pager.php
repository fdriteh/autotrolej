<?php
	$pagepath = '../page';
	$csspath = '../htdocs/css';
	$pages = array ();
	if ($pagedir = @opendir ($pagepath))
	{
		while (($entry = readdir ($pagedir)) !== false)
		{
			if (substr ($entry, -4) == '.php')
				$pages[] = strtolower (substr ($entry, 0, -4));
		}
		closedir ($pagedir);
	}

	function make_page_title ($pagename)
	{
		global $pagepath;

		include ($pagepath.'/'.$pagename.'.config.php');

		return $page_title;
	}

	function make_page ($pagename)
	{
		global $pagepath, $pages;
		if (in_array (strtolower ($pagename), $pages))
		{
			ob_start ();
			require ($pagepath.'/'.$pagename.'.php');
			$page_body_ob = ob_get_contents ();
			ob_end_clean ();
			if (!empty ($page_body_ob))
				$page_body = "\t\t\t".str_replace ("\n", "\n\t\t\t", preg_replace ('/[\r\n]*$/', '', $page_body_ob))."\n";
		}
		if (empty ($page_body))
		{
			$page_body = "\t\t\t<h1>"._('Error: Page not found.')."</h1>\n";
			if (!empty ($_SERVER['HTTP_REFERER']) && local_url ($_SERVER['HTTP_REFERER']))
				$page_body .= "\t\t\t<h2>".sprintf (_('Return to %sprevious page%s.'), '<a href="'.local_url ($_SERVER['HTTP_REFERER']).'">', '</a>')."</h2>\n";
			else
				$page_body .= "\t\t\t<h2>".sprintf (_('Return to %shome page%s.'), '<a href="/">', '</a>')."</h2>\n";
		}
		return $page_body;
	}

	function get_css_file ($pagename, $fallback)
	{
		global $csspath;

		if (!file_exists ($csspath.'/'.$pagename.'.css'))
			return $fallback;
		return $pagename;
	}
?>
