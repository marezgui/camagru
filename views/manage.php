<?php require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/manage.php'; ?>

<?php ob_start(); ?>

<section id="manage-wrap">
	<section class="form-wrap">
		<form method="POST" action="">
			<h2 class="form-heading">Votre pseudo</h2>

			<input id="login" name="login" value="<?php if (isset($_SESSION['login'])) { echo $_SESSION['login']; } ?>" disabled/>
		
			<input id="newLogin" name="newLogin" type="text" value="<?php if (isset($newLogin)) { echo $newLogin; } ?>" maxlength="15" minlength="3" pattern=".{4,}" required title="4 caractères minimum" placeholder="Nouveau pseudo : (4 caractères min.)"/>
			
			<button type="submit" name="submitLogin" >Modifier mon pseudo</button>
			<?php
				if (isset($errorLogin))
				{
					if ($errorLogin != "OK") {
			?>
						<div id='error'> <?= $errorLogin ?> </div>
			<?php 
					} else { 
			?>

						<div id='success'> Pseudo modifié ! </div>
			<?php
				}}		 
			?>
		</form>
	</section>

	<section class="form-wrap">
		<form method="POST" action="">
			<h2 class="form-heading">Votre email</h2>
					
						<input id="mail" name="mail" value="<?php if (isset($_SESSION['mail'])) { echo $_SESSION['mail']; } ?>" disabled/>
					
						<input id="newMail" name="newMail" type="email" value="<?php if (isset($newMail)) { echo $newMail; } ?>" maxlength="40" placeholder="Nouvel e-mail :"/>
					
						<button type="submit" name="submitMail" >Modifier l'e-mail</button>
				<?php
					if (isset($errorMail))
					{
						if ($errorMail != "OK") {
				?>
							<div id='error'> <?= $errorMail ?> </div>
				<?php 
						} else { 
				?>

							<div id='success'> e-mail modifié ! </div>
				<?php
					}}		 
				?>
			</fieldset>
		</form>
	</section>

	<section class="form-wrap">
		<form method="POST" action="">
				<h2 class="form-heading">Changer votre mot de passe</h2>
				
						<input id="password" name="password" type="password"  maxlength="50" pattern=".{6,}" required title="6 caractères minimum" placeholder="Nouveau mot de passe :"/>
					
						<input id="password2" name="password2" type="password"  maxlength="50" pattern=".{6,}" required title="6 caractères minimum" placeholder="Confirmation du nouveau mot de passe :"/>
					
						<button type="submit" name="submitPassword" >Modifier le mot de passe</button>
					
				
				<?php
					if (isset($errorPassword))
					{
						if ($errorPassword != "OK") {
				?>
							<div id='error'> <?= $errorPassword ?> </div>
				<?php 
						} else { 
				?>

							<div id='success'> Votre mot de passe a bien été modifié. </div>
				<?php
					}}		 
				?>
		</form>
	</section>

	<section class="form-wrap notif-wrap">
		<form method="POST" action="" id="notifications">
			<fieldset>
				<h2 class="form-heading">Notifications</h2>
					
				 Nouveau commentaire. 
				<label for="yes"> Activer </label><input type="checkbox" name="yes" value="1">
				<button type="submit" name="submitNotifications">OK</button>
			</fieldset>
		</form>
	</section>
</section>

<?php 
	$content = ob_get_clean();
	$title = "Mon compte";
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/views/template.php'; 
?>