 <?php require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/session.php'; ?>
 <?php if (isset($_SESSION['id'])) header ('location: ../index.php'); ?>


<?php ob_start(); ?>
<section class="form-wrap">
	<form id="form" method="POST" action="/camagru/controllers/inscription.php">
		<h2 class="form-heading">Inscription</h2>
			
				<input id="firstName" name="firstName" type="text" value="<?php if (isset($firstName)) { echo $firstName; } ?>" maxlength="15" minlength="2" placeholder="Nom :"/>
			
				<input id="lastName" name="lastName" type="text" value="<?php if (isset($lastName)) { echo $lastName; } ?>" maxlength="15" minlength="2" placeholder="Prenom :"/>
			
				<input id="mail" name="mail" type="email" value="<?php if (isset($mail)) { echo $mail; } ?>" maxlength="40" placeholder="E-Mail" />
			
				<input id="mail2" name="mail2" type="email" value="<?php if (isset($mail2)) { echo $mail2; } ?>" maxlength="40" placeholder="Confirmation de l'e-Mail" />

				<input id="login" name="login" type="text" value="<?php if (isset($login)) { echo $login; } ?>" maxlength="15" minlength="3" pattern=".{4,}" required title="4 caractères minimum" placeholder="Pseudo : (4 caractères min.)"/>
			
				<input id="password" name="password" type="password"  maxlength="50" pattern=".{6,}" required title="6 caractères minimum" placeholder="Mot de passe : (6 caractères min.)" />
			
				<input id="password2" name="password2" type="password"  maxlength="50" pattern=".{6,}" required title="6 caractères minimum" placeholder="Confirmation du mot de passe"/>
			
				<button type="submit" name="submit" >Je m'incris!</button>
				
				<div id="error"></div>
				<div id="success"></div>
	</form>
</section>

<script src="../public/js/ajax/inscription.js"></script>

<?php 
	$content = ob_get_clean();
	$title = "Inscription";
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/views/template.php'; 
?>