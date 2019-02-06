<?php require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/connexion.php'; ?>

<?php ob_start(); ?>

<form method="POST" action="">
	<fieldset>
		<legend>Connexion</legend>
		<table>
			<tr>
				<td><label for="login">Pseudo : </label></td>
			</tr>
			<tr>
				<td><input id="login" name="login" type="text" value="<?php if (isset($login)) { echo $login; } ?>" maxlength="15" minlength="3" pattern=".{4,}" required title="4 caractères minimum"/></td>
			</tr>
			<tr>
				<td><label for="password">Mot de passe : </label></td>
			</tr>
			<tr>
				<td><input id="password" name="password" type="password"  maxlength="50" pattern=".{6,}" required title="6 caractères minimum"/></td>
			</tr>
			<tr>
				<td><input class="btn-1" type="submit" name="submit" value="Se connecter"></td>
			</tr>
			<tr>
				<td colspan="2"> <a href="forgotten.php">Mot de passe oublié</a></td>
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
	$content = ob_get_clean();
	$title = "Connexion";
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/views/template.php'; 
?>