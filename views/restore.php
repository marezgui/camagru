<?php require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/restore.php'; ?>

<?php ob_start(); ?>

<form method="POST" action="">
	<fieldset>
		<legend>Réinitialiser votre mot de passe</legend>
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
				<td><input type="submit" name="submit" value="Réinitialiser mon mot de passe"></td>
			</tr>
		</table>
		<?php
			if (isset($error))
			{
				if ($error != "OK") {
		?>
					<font color='red'> <?= $error ?> </font>
		<?php 
				} else { 
		?>

					<font color='green'> Votre mot de passe a bien été réinitialiser. </font>
		<?php
			}}		 
		?>
	</fieldset>
</form>

<?php 
	$content = ob_get_clean();
	$title = "Réinitialisation";
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/views/template.php'; 
?>