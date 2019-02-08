<?php ob_start(); ?>

<section class="form-wrap">
	<h2 class="form-heading">Connexion</h2>
	<form id="form" method="POST" action="/camagru/controllers/connexion.php">  
		<input id="login" name="login" type="text" value="<?php if (isset($login)) { echo $login; } ?>" maxlength="15" minlength="3" pattern=".{4,}" placeholder="Pseudo" required title="4 caractères minimum"/>

		<input id="password" name="password" type="password"  maxlength="50" pattern=".{6,}" placeholder="Mot de passe" required title="6 caractères minimum"/>

		<button name="submit" type="submit">Se connecter</button>

		<div id="error"></div>

		<a href="forgotten.php">
		<p>Mot de passe oublié</p>
		</a>
	</form>
</section>

<script src="../public/js/oXHR.js"></script>
<script src="../public/js/AjaxConnexion.js"></script>

<?php 
	$content = ob_get_clean();
	$title = "Connexion";
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/views/template.php'; 
?>