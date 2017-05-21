<?php
	if (user_id ())
		redirect ('/');
	if (isset ($_POST['submit']))
	{
		$success = false;
		global $bad_field;
		$fields = array ('ime', 'prezime', 'email', 'email-confirm', 'password', 'password-confirm');
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

		if (empty ($_POST['password']) || empty ($_POST['password-confirm']))
			$password_no_match = false;
		else if ($_POST['password'] != $_POST['password-confirm'])
			$password_no_match = true;
		if (isset ($password_no_match))
		{
			array_push ($bad_field, 'password');
			array_push ($bad_field, 'password-confirm');
		}

		foreach ($fields as $f)
		{
			if ((empty ($_POST[$f]) || (($_POST[$f] != htmlspecialchars ($_POST[$f]) || $_POST[$f] != db_escape ($_POST[$f])) && substr ($f, 0, 8) != 'password')) && !in_array ($f, $bad_field))
				array_push ($bad_field, $f);
		}

		if (!$bad_field)
		{
			if (db_query (sprintf ("INSERT INTO `Korisnik` (`ime`, `prezime`, `email`, `password`) VALUES (NULLIF('%s', ''), NULLIF('%s', ''), NULLIF('%s', ''), NULLIF('%s', ''))",
				db_escape ($_POST['ime']),
				db_escape ($_POST['prezime']),
				db_escape ($email),
				db_escape (password_hash ($_POST['password'], PASSWORD_DEFAULT))
			)))
			{
				$success = true;
			}
			else
			{
				if (db_errno () == 1062) /* ER_DUP_ENTRY */
				{
					$email_exists = true;
					array_push ($bad_field, 'email');
					array_push ($bad_field, 'email-confirm');
				}
			}
		}
	}
	if (empty ($success))
	{
		function form_check_valid ($field_name)
		{
			global $bad_field;
			return (!empty ($bad_field) && in_array ($field_name, $bad_field)) ? " class=\"invalid-input\"" : "";
		}
		function form_save_selection ($field_name, $value)
		{
			global $bad_field;
			if (!isset ($_POST[$field_name]) || in_array ($field_name, $bad_field))
				return $value == '' ? ' selected' : '';
			else
				return $value == $_POST[$field_name] ? ' selected' : '';
		}
		function form_save_input ($field_name)
		{
			global $bad_field;
			return (!empty ($_POST[$field_name]) && substr ($field_name, 0, 8) != "password") ? " value=\"".htmlspecialchars ($_POST[$field_name])."\"" : "";
		}
?>
<h1><em>Autotrolej</em> <?=_('registration')?></h1>
<?php
	if (isset ($success))
	{
		echo '<h2 class="error-message">'._('There was an error during the registration process.')."</h2>\n";
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
<form action="/?p=register" method="post">
	<table class="form-fields">
		<tr>
			<td>
				<label for="ime"><?=_('First name')?></label>
				<input type="text" name="ime"<?=form_check_valid ('firstname')?><?=form_save_input ('ime')?> />
			</td>
			<td>
				<label for="prezime"><?=_('Last name')?></label>
				<input type="text" name="prezime"<?=form_check_valid ('lastname')?><?=form_save_input ('prezime')?> />
			</td>
		</tr>
		<tr>
			<td>
				<label for="email"><?=_('E-mail address')?></label>
				<input type="text" name="email"<?=form_check_valid ('email')?><?=form_save_input ('email')?> />
			</td>
			<td>
				<label for="email-confirm"><?=_('Confirm e-mail address')?></label>
				<input type="text" name="email-confirm"<?=form_check_valid ('email-confirm')?><?=form_save_input ('email-confirm')?> />
			</td>
		</tr>
		<tr>
			<td>
				<label for="password"><?=_('Password')?></label>
				<input type="password" name="password"<?=form_check_valid ('password')?><?=form_save_input ('password')?> />
			</td>
			<td>
				<label for="password-confirm"><?=_('Confirm password')?></label>
				<input type="password" name="password-confirm"<?=form_check_valid ('password-confirm')?><?=form_save_input ('password-confirm')?> />
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" name="submit" value="<?=_('Register')?>" />
			</td>
		</tr>
	</table>
</form>
<?php
	}
	else
	{
?>
<h1><?=_('Registration successful!')?></h1>
<h2><?=sprintf (_('You can now %slog in%s.'), '<a href="/?p=login">', '</a>')?></h2>
<?php
	}
?>
