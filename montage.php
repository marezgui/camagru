<?php ob_start(); ?>

<main>
	<video id="video"></video>
	<button id="startbutton">Start</button>
	<canvas id="canvas"></canvas>		
	<button id="take">Prendre une photo</button>
</main>
<aside></aside>
<form>
	<input type="radio" id="Choice0" name="filtre" value="none" >
	<label for="Choice0">None</label>
	<img id="none" src="">

	<input type="radio" id="Choice1" name="filtre" value="billet">
	<label for="Choice1">Billet</label>
	<img id="billet" src="billet.png">

	<input type="radio" id="Choice2" name="filtre" value="kitten" checked>
	<label for="Choice2">Chaton</label>
	<img id="kitten" src="kitten.png">

	<input type="radio" id="Choice3" name="filtre" value="cigare">
	<label for="Choice3">Cigare</label>
	<img id="cigare" src="cigare.png">

	<div>
	    <button type="submit">Envoyer</button>
	</div>
</form>

<script src="public/js/montage.js"></script>

<?php 
	$content = ob_get_clean();
	$title = "Montage";
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/views/template.php'; 
?>