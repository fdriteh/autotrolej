<?php
	if (user_id ())
		redirect ('/');
	if (isset ($_POST['submit']))
	{
		$success = false;
		$result = db_fetch_row (db_query (sprintf ("SELECT `id`, `password` FROM `Korisnik` WHERE `email` = '%s'",
			db_escape ($_POST['email']))));
		if ($result)
		{
			$user_id = $result[0];
			if (password_verify (db_escape ($_POST['password']), $result[1]))
				$success = true;
		}
		if ($success)
		{
			user_login ($user_id);
			redirect ('/');
		}
	}
?>
<h1><em>Autotrolej</em> <?=_('login')?></h1>
<?php
	if (isset ($success))
	{
		echo show_error (_('Error: Invalid username or password.'));
	}
?>
<form action="/?p=login" method="post">
	<table class="form-fields">
		<tr>
			<td>
				<label for="email"><?=_('E-mail')?></label>
				<input type="text" name="email" />
			</td>
			<td>
				<label for="password"><?=_('Password')?></label>
				<input type="password" name="password" />
			</td>
		</tr>
		<tr>
			<td>
				<input type="submit" name="submit" value="<?=_('Log In')?>" />
			</td>
		</tr>
	</table>
</form>
