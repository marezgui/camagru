<?php ob_start(); ?>

<section class="form-wrap">
	<form id="form" method="POST" action="/camagru/controllers/restore.php">
			<h2 class="form-heading">Réinitialiser votre mot de passe</h2>
					<input id="password" name="password" type="password"  maxlength="50" pattern=".{6,}" required title="6 caractères minimum" placeholder="Nouveau mot de passe :"/>
				
					<input id="password2" name="password2" type="password"  maxlength="50" pattern=".{6,}" required title="6 caractères minimum" placeholder=" Confirmation du nouveau mot de passe :"/>
				
					<input type="hidden" name="login" value='<?= $_GET['login']?>'>
					<input type="hidden" name="key" value='<?= $_GET['key']?>'>

					<button type="submit" name="submit" >Réinitialiser mon mot de passe</button>
	
					<div id="error"></div>
					<div id="success"></div>
	</form>
</section>

<script src="../public/js/ajax/restore.js"></script>

<?php 
	$content = ob_get_clean();
	$title = "Réinitialisation";
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/views/template.php'; 
?>