<?php
	if (!user_id ())
	{
		echo show_error (_('You must be logged in to view this page.'));
		return;
	}

	global $user_id;
	if (empty ($_GET['u']))
		$user_id = user_id ();
	else
		$user_id = user_id_from_email ($_GET['u']);
	if (!$user_id)
	{
		echo show_error (_("Error: Username doesn't exist."));
		return;
	}
	if ($user_id != user_id () && !user_prop ('admin'))
	{
		echo show_error (_("Error: Only an administrator can modify other users' profiles."));
		return;
	}

	if (isset ($_POST['submit']))
	{
		$success = false;
		global $bad_field;
		$fields = array ('ime', 'prezime', 'email', 'email-confirm');
		$bad_field = array ();

		if (empty ($_POST['email']) || empty ($_POST['email-confirm']))
			$email_no_match = false;
		else if ($_POST['email'] != $_POST['email-confirm'])
			$email_no_match = true;
		$email = sanitise_email ($_POST['email']);
		if (isset ($email_no_match) || empty ($email))
		{
			array_push ($bad_field, 'email');
			array_push ($bad_field, 'email-confirm');
		}

		if ($_POST['password'] != $_POST['password-confirm'])
		{
			$password_no_match = true;
			array_push ($bad_field, 'password');
			array_push ($bad_field, 'password-confirm');
		}

		foreach ($fields as $f)
		{
			if ((empty ($_POST[$f]) || (($_POST[$f] != htmlspecialchars ($_POST[$f]) || $_POST[$f] != db_escape ($_POST[$f])) && substr ($f, 0, 8) != 'password')) && !in_array ($f, $bad_field))
				array_push ($bad_field, $f);
		}

		if (!$bad_field && db_fetch_row (db_query (sprintf ("SELECT COUNT(*) FROM `Korisnik` WHERE `email` = '%s' AND `id` != ".$user_id,
			db_escape ($email))))[0])
		{
			$email_exists = true;
			array_push ($bad_field, 'email');
			array_push ($bad_field, 'email-confirm');
		}

		if (!$bad_field)
		{
			$success = true;
			$modified = false;
			foreach (array ('ime', 'prezime', 'email') as $f)
			{
				if (db_escape ($_POST[$f]) != user_prop ($f, $user_id))
				{
					$modified = true;
					break;
				}
			}
			if ($modified && !db_query (sprintf ("UPDATE `Korisnik` SET `email` = '%s', `ime` = '%s', `prezime` = '%s' WHERE `id` = ".$user_id,
				db_escape ($email),
				db_escape ($_POST['ime']),
				db_escape ($_POST['prezime'])
			)))
				$success = false;
			if (!empty ($_POST['password'] && !db_query (sprintf ("UPDATE `Korisnik` SET `password` = '%s' WHERE `id` = ".$user_id,
				db_escape (password_hash ($_POST['password'], PASSWORD_DEFAULT))
			))))
				$success = false;
		}
	}
	if (empty ($success))
	{
		function form_check_valid ($field_name)
		{
			global $bad_field;
			return (!empty ($bad_field) && in_array ($field_name, $bad_field)) ? " class=\"invalid-input\"" : "";
		}
?>
<h1>Editing profile for <?=user_prop ('ime', $user_id)?> <?=user_prop ('prezime', $user_id)?></h1>
<?php
	if (isset ($success))
	{
		echo '<h2 class="error-message">'._('An error occurred while updating the profile.')."</h2>\n";
		echo '<h2 class="error-message">'._('Please check your input and try again.')."</h2>\n";
		if (!empty ($bad_field))
			echo '<h3 class="error-message">'._('Fields marked in red require a valid input.')."</h3>\n";
		if (!empty ($email_exists))
			echo '<h3 class="error-message">'._('Email already exists.')."</h3>\n";
		if (!empty ($email_no_match))
			echo '<h3 class="error-message">'._('Entered e-mail addresses do not match.')."</h3>\n";
		if (!empty ($password_no_match))
			echo '<h3 class="error-message">'._('Entered passwords do not match.')."</h3>\n";
	}
?>
<form action="/?p=editprofile<?=user_make_get_var ()?>" method="post" enctype="multipart/form-data">
	<table class="form-fields">
		<tr>
			<td>
				<label for="ime"><?=_('First name')?></label>
				<input type="text" name="ime"<?=form_check_valid ('ime')?> value="<?=user_prop ('ime', $user_id)?>" />
			</td>
			<td>
				<label for="prezime"><?=_('Last name')?></label>
				<input type="text" name="prezime"<?=form_check_valid ('prezime')?> value="<?=user_prop ('prezime', $user_id)?>" />
			</td>
		</tr>
		<tr>
			<td>
				<label for="email"><?=_('E-mail address')?></label>
				<input type="text" name="email"<?=form_check_valid ('email')?> value="<?=user_prop ('email', $user_id)?>" />
			</td>
			<td>
				<label for="email-confirm"><?=_('Confirm e-mail address')?></label>
				<input type="text" name="email-confirm"<?=form_check_valid ('email-confirm')?> value="<?=user_prop ('email', $user_id)?>" />
			</td>
		</tr>
		<tr>
			<td>
				<label for="password"><?=_('Password')?></label>
				<input type="password" name="password"<?=form_check_valid ('password')?> />
			</td>
			<td>
				<label for="password-confirm"><?=_('Confirm password')?></label>
				<input type="password" name="password-confirm"<?=form_check_valid ('password-confirm')?> />
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" name="submit" value="<?=_('Save changes')?>" />
			</td>
		</tr>
	</table>
</form>
<?php
	}
	else
		redirect ('/?p=profile'.user_make_get_var (false));
?>
