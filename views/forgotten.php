<?php require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/forgotten.php'; ?>

<?php ob_start(); ?>

<form method="POST" action="">
	<fieldset>
		<legend>Mot de passe oublié</legend>
		<table>			
			<tr>
				<td><label for="mail">Adresse e-mail :</label></td>
				<td><input id="mail" name="mail" type="email" value="<?php if (isset($mail)) { echo $mail; } ?>" maxlength="40"/></td>
			</tr>

			<tr>
				<td></td>
				<td><input type="submit" name="submit" value="Envoyer"></td>
			</tr>
		</table>
		<?php
			if (isset($error)) 
			{
				if ($error != "OK")
				{
		?>
				<font color='red'> <?= $error ?> </font>
		<?php 
				} 
				else
				{
		?>
				<font color='green'> Un mail de réinitialisation de mot de passe vient de vous être envoyé ! </font>
		<?php 
				}
			}
		?>
	</fieldset>
</form>

<?php 
	$content = ob_get_clean();
	$title = "Mot de passe oublié";
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/views/template.php'; 
?>