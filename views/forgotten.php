<?php require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/forgotten.php'; ?>

<?php ob_start(); ?>
<section class="form-wrap">
	<form method="POST" action="">
			<h2 class="form-heading" >Mot de passe oublié</h2>		
				
			<input id="mail" name="mail" type="email" value="<?php if (isset($mail)) { echo $mail; } ?>" maxlength="40" placeholder="Adresse e-mail :"/>

			<button type="submit" name="submit" >Envoyer</button>

			<?php
				if (isset($error)) 
				{
					if ($error != "OK")
					{
			?>
					<div id="error"> <?= $error ?> </div>
			<?php 
					} 
					else
					{
			?>
					<div id="success"> Un mail de réinitialisation de mot de passe vient de vous être envoyé ! </div>
			<?php 
					}
				}
			?>
	</form>
</section>

<?php 
	$content = ob_get_clean();
	$title = "Mot de passe oublié";
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/views/template.php'; 
?>