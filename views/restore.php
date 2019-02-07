<?php require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/restore.php'; ?>

<?php ob_start(); ?>

<section class="form-wrap">
	<form method="POST" action="">
			<h2 class="form-heading">Réinitialiser votre mot de passe</h2>
					<input id="password" name="password" type="password"  maxlength="50" pattern=".{6,}" required title="6 caractères minimum" placeholder="Nouveau mot de passe :"/>
				
					<input id="password2" name="password2" type="password"  maxlength="50" pattern=".{6,}" required title="6 caractères minimum" placeholder=" Confirmation du nouveau mot de passe :"/>
				
					<button type="submit" name="submit" >Réinitialiser mon mot de passe</button>
				
			<?php
				if (isset($error))
				{
					if ($error != "OK") {
			?>
						<div id="error"> <?= $error ?> </div>
			<?php 
					} else { 
			?>

						<div id="success"> Votre mot de passe a bien été réinitialiser. </div>
			<?php
				}}		 
			?>
	</form>
</section>
<?php 
	$content = ob_get_clean();
	$title = "Réinitialisation";
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/views/template.php'; 
?>