<?php
	function user_login ($user_id)
	{
		session_regenerate_id ();

		db_query (sprintf ("DELETE FROM `Sesija` WHERE `id_korisnik` = '%s' AND `vrijeme` < NOW() - INTERVAL 1 DAY",
			db_escape ($user_id)));

		return db_query (sprintf ("INSERT INTO `Sesija` (`id`, `id_korisnik`) VALUES ('%s', '%s')",
			db_escape (session_id ()),
			db_escape ($user_id)));
	}

	function user_logout ()
	{
		return db_query (sprintf ("DELETE FROM `Sesija` WHERE `id` = '%s'",
			db_escape (session_id ())));

		session_regenerate_id ();
	}

	function user_id ()
	{
		global $user_id_cached;

		if (isset ($user_id_cached))
			return $user_id_cached;

		$result = db_fetch_row (db_query (sprintf ("SELECT `id_korisnik` FROM `Sesija` WHERE `id` = '%s'",
			db_escape (session_id ()))));

		if ($result)
			$user_id_cached = $result[0];
		else
			return 0;

		return $user_id_cached;
	}

	function user_id_from_email ($u)
	{
		$email = sanitise_email ($u);

		if (empty ($email))
			return 0;

		$result = db_fetch_row (db_query (sprintf ("SELECT `id` FROM `Korisnik` WHERE `email` = '%s'",
			db_escape ($email))));

		if ($result)
			return $result[0];
		else
			return 0;
	}

	function user_prop ($key, $uid = 0)
	{
		global $user_props;

		$user_id = $uid;
		if (!$user_id)
			$user_id = user_id ();
		if (!$user_id)
			return;

		if (!isset ($user_props))
			$user_props = array ();
		if (!isset ($user_props[$user_id]))
		{
			$user_props[$user_id] = db_fetch_assoc (db_query ("SELECT * FROM `Korisnik` WHERE `id` = ".$user_id));
			if (!$user_props[$user_id])
				return;
			$user_props[$user_id]['admin'] = db_fetch_row (db_query ("SELECT COUNT(*) FROM `admin` WHERE `id_korisnik` = ".$user_id))[0] > 0;
		}

		if (isset ($user_props[$user_id][$key]))
			return $user_props[$user_id][$key];
	}
?>
