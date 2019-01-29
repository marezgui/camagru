<?php require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/inscription.php'; ?>

<?php ob_start(); ?>
<form method="POST" action="">
	<fieldset>
		<legend>Inscription</legend>
		<table>
			<tr>
				<td><label for="firstName">Nom :</label></td>
				<td><input id="firstName" name="firstName" type="text" value="<?php if (isset($firstName)) { echo $firstName; } ?>" maxlength="15" minlength="2"/></td>
			</tr>

			<tr>
				<td><label for="lastName">Prenom :</label></td>
				<td><input id="lastName" name="lastName" type="text" value="<?php if (isset($lastName)) { echo $lastName; } ?>" maxlength="15" minlength="2"/></td>
			</tr>

			<tr>
				<td><label for="mail">E-Mail :</label></td>
				<td><input id="mail" name="mail" type="email" value="<?php if (isset($mail)) { echo $mail; } ?>" maxlength="40"/></td>
			</tr>

			<tr>
				<td><label for="mail2">Confirmation E-Mail :</label></td>
				<td><input id="mail2" name="mail2" type="email" value="<?php if (isset($mail2)) { echo $mail2; } ?>" maxlength="40"/></td>
			</tr>

			<tr>
				<td><label for="login">Pseudo : (4 caractères min.)</label></td>
				<td><input id="login" name="login" type="text" value="<?php if (isset($login)) { echo $login; } ?>" maxlength="15" minlength="3" pattern=".{4,}" required title="4 caractères minimum"/></td>
			</tr>

			<tr>
				<td><label for="password">Mot de passe : (6 caractères min.)</label></td>
				<td><input id="password" name="password" type="password"  maxlength="50" pattern=".{6,}" required title="6 caractères minimum"/></td>
			</tr>

			<tr>
				<td><label for="password2">Confirmation du mot de passe :</label></td>
				<td><input id="password2" name="password2" type="password"  maxlength="50" pattern=".{6,}" required title="6 caractères minimum"/></td>
			</tr>

			<tr>
				<td></td>
				<td><input type="submit" name="submit" value="Je m'incris!"></td>
			</tr>
		</table>
		<?php
			if (isset($error))
			{
		?>
				<font color='red'> <?= $error ?> </font>
		<?php 
			} 
		?>
	</fieldset>
</form>

<?php 
	if (isset($sendMail) && $sendMail)
	{
		ob_clean();
?>
	<p>Un mail de confirmation vient de vous être envoyer.</p>
<?php
	}
?>

<?php 
	$content = ob_get_clean();
	$title = "Inscription";
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/views/template.php'; 
?>