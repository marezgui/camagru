<?php require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/session.php'; ?>
<?php if (!isset($_SESSION['id'])) header ('location: ../index.php'); ?>

<?php ob_start(); ?>

<section id="manage-wrap">
	<section class="form-wrap">
		<form id="form1" method="POST" action="/camagru/controllers/manage.php">
			<h2 class="form-heading">Votre pseudo</h2>

			<input id="login" name="login" value="<?php if (isset($_SESSION['login'])) { echo $_SESSION['login']; } ?>" disabled/>
		
			<input id="newLogin" name="newLogin" type="text" maxlength="15" minlength="3" pattern=".{4,}" required title="4 caractères minimum" placeholder="Nouveau pseudo : (4 caractères min.)"/>
			
			<button type="submit" name="submitLogin"  >Modifier mon pseudo</button>

			<div class='error'></div>
			<div class='success'></div>
		</form>
	</section>

	<section class="form-wrap">
		<form id="form2" method="POST" action="/camagru/controllers/manage.php">
			<h2 class="form-heading">Votre email</h2>
					
				<input id="mail" name="mail" value="<?php if (isset($_SESSION['mail'])) { echo $_SESSION['mail']; } ?>" disabled/>
			
				<input id="newMail" name="newMail" type="email" maxlength="40" placeholder="Nouvel e-mail :"/>
			
				<button type="submit" name="submitMail" >Modifier l'e-mail</button>
				
				<div class='error'></div>
				<div class='success'></div>
			</fieldset>
		</form>
	</section>

	<section class="form-wrap">
		<form id="form3" method="POST" action="/camagru/controllers/manage.php">
				<h2 class="form-heading">Changer votre mot de passe</h2>
				
				<input id="password" name="password" type="password"  maxlength="50" pattern=".{6,}" required title="6 caractères minimum" placeholder="Nouveau mot de passe :"/>
			
				<input id="password2" name="password2" type="password"  maxlength="50" pattern=".{6,}" required title="6 caractères minimum" placeholder="Confirmation du nouveau mot de passe :"/>
			
				<button type="submit" name="submitPassword" >Modifier le mot de passe</button>

				<div class='error'></div>
				<div class='success'></div>
		</form>
	</section>

	<section class="notif-wrap">
		<form id="form4" method="POST" action="/camagru/controllers/manageNotifications.php" id="notifications">
				<h2 class="form-heading">Notifications</h2>
					
				<p> Nouveau commentaire. </p> 
				<center>
					<label for="activate"> Activer </label>
					<input type="checkbox" name="activate" onclick="change(document.querySelector('#form4'));" <?php if ($_SESSION['notifications']) echo "checked";?>/>
				</center>

		</form>
	</section>
</section>

<script src="../public/js/AjaxManage.js"></script>

<?php 
	$content = ob_get_clean();
	$title = "Mon compte";
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/views/template.php'; 
?>