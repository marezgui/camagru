<?php require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/connexion.php'; ?>

<?php ob_start(); ?>

<section id="connexion">
	<div class="login-wrap">
		<h2 class="form-signin-heading">Connexion</h2>
		<form class="form" method="POST" action="">  
			<input id="login" name="login" type="text" value="<?php if (isset($login)) { echo $login; } ?>" maxlength="15" minlength="3" pattern=".{4,}" placeholder="Pseudo" required title="4 caractères minimum"/>
			<input id="password" name="password" type="password"  maxlength="50" pattern=".{6,}" placeholder="Mot de passe" required title="6 caractères minimum"/>

			<button name="submit" type="submit">Se connecter</button>
			<?php
				if (isset($error))
				{
			?>
					<font color='red'> <?= $error ?> </font>
			<?php 
				} 
			?>
			<a href="forgotten.php">
			<p>Mot de passe oublié</p>
			</a>
		</form>
	</div>
</section>

<?php 
	$content = ob_get_clean();
	$title = "Connexion";
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/views/template.php'; 
?>