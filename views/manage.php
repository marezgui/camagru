<?php require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/manage.php'; ?>

<?php ob_start(); ?>

<form method="POST" action="">
	<fieldset>
		<legend>Votre pseudo</legend>
		<table>
			<tr>
				<td><label for="login">Pseudo actuel :</label></td>
				<td><input id="login" name="login" value="<?php if (isset($_SESSION['login'])) { echo $_SESSION['login']; } ?>" disabled/></td>
			</tr>

			<tr>
				<td><label for="newLogin">Nouveau pseudo : (4 caractères min.)</label></td>
				<td><input id="newLogin" name="newLogin" type="text" value="<?php if (isset($newLogin)) { echo $newLogin; } ?>" maxlength="15" minlength="3" pattern=".{4,}" required title="4 caractères minimum"/></td>
			</tr>

			<tr>
				<td></td>
				<td><input type="submit" name="submitLogin" value="Modifier mon pseudo"></td>
			</tr>
		</table>
		<?php
			if (isset($errorLogin))
			{
				if ($errorLogin != "OK") {
		?>
					<font color='red'> <?= $errorLogin ?> </font>
		<?php 
				} else { 
		?>

					<font color='green'> Pseudo modifié ! </font>
		<?php
			}}		 
		?>
	</fieldset>
</form>

<form method="POST" action="">
	<fieldset>
		<legend>Votre email</legend>
		<table>
			<tr>
				<td><label for="mail">Adresse e-mail actuelle :</label></td>
				<td><input id="mail" name="mail" value="<?php if (isset($_SESSION['mail'])) { echo $_SESSION['mail']; } ?>" disabled/></td>
			</tr>

			<tr>
				<td><label for="newMail">Nouvel e-mail :</label></td>
				<td><input id="newMail" name="newMail" type="email" value="<?php if (isset($newMail)) { echo $newMail; } ?>" maxlength="40"/></td>
			</tr>

			<tr>
				<td></td>
				<td><input type="submit" name="submitMail" value="Modifier l'e-mail"></td>
			</tr>
		</table>
		<?php
			if (isset($errorMail))
			{
				if ($errorMail != "OK") {
		?>
					<font color='red'> <?= $errorMail ?> </font>
		<?php 
				} else { 
		?>

					<font color='green'> e-mail modifié ! </font>
		<?php
			}}		 
		?>
	</fieldset>
</form>

<form method="POST" action="">
	<fieldset>
		<legend>Changer votre mot de passe</legend>
		<table>
			<tr>
				<td><label for="password">Nouveau mot de passe : </label></td>
				<td><input id="password" name="password" type="password"  maxlength="50" pattern=".{6,}" required title="6 caractères minimum"/></td>
			</tr>

			<tr>
				<td><label for="password2">Confirmation du nouveau mot de passe : </label></td>
				<td><input id="password2" name="password2" type="password"  maxlength="50" pattern=".{6,}" required title="6 caractères minimum"/></td>
			</tr>

			<tr>
				<td></td>
				<td><input type="submit" name="submitPassword" value="Modifier le mot de passe"></td>
			</tr>
		</table>
		<?php
			if (isset($errorPassword))
			{
				if ($errorPassword != "OK") {
		?>
					<font color='red'> <?= $errorPassword ?> </font>
		<?php 
				} else { 
		?>

					<font color='green'> Votre mot de passe a bien été modifié. </font>
		<?php
			}}		 
		?>
	</fieldset>
</form>

<form method="POST" action="">
	<fieldset>
		<legend>Notifications</legend>
		<table id="notifications">
			<tr>
				<td> Nouveau commentaire. </td>
				<td><label for="yes"> Activer </label><input type="checkbox" name="yes" value="1"></td>
				<td><input type="submit" value="OK" name="submitNotifications"></td>
			</tr>
		</table>
	</fieldset>
</form>

<?php 
	$content = ob_get_clean();
	$title = "Mon compte";
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/views/template.php'; 
?>