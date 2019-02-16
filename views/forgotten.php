<?php ob_start(); ?>
<section class="form-wrap">
	<form id="form" method="POST" action="/camagru/controllers/forgotten.php">
			<h2 class="form-heading" >Mot de passe oublié</h2>		
				
			<input id="mail" name="mail" type="email" value="<?php if (isset($mail)) { echo $mail; } ?>" maxlength="40" placeholder="Adresse e-mail :"/>

			<button type="submit" name="submit" >Envoyer</button>

			<div id="error"></div>
			<div id="success"></div>
	</form>
</section>

<script src="../public/js/ajax/forgotten.js"></script>

<?php 
	$content = ob_get_clean();
	$title = "Mot de passe oublié";
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/views/template.php'; 
?>