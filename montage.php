<head>
<link rel="stylesheet" type="text/css" href="test.css">
</head>
<main>
	<video id="video"></video>
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
	<img id="billet" src="public/images/filtre/billet.png">

	<input type="radio" id="Choice2" name="filtre" value="kitten" checked>
	<label for="Choice2">Chaton</label>
	<img id="kitten" src="public/images/filtre/kitten.png">

	<input type="radio" id="Choice3" name="filtre" value="cigare">
	<label for="Choice3">Cigare</label>
	<img id="cigare" src="public/images/filtre/cigare.png">
</form><span id="votre_id1" class="target"></span>


<div class="cadre_diapo">
	<ul class="navigation_diapo">
		<li>
			<a href="#votre_id1">
				<img src="public/images/filtre/kitten.png" alt>
			</a>
		</li>
		<li>
			<a href="#votre_id2">
				<img src="public/images/filtre/kitten.png" alt>
			</a>
		</li>
		<li>
			<a href="#votre_id3">
				<img src="public/images/filtre/cigare.png" alt>
			</a>
		</li>
		<li>
			<a href="#votre_id4">
				<img src="public/images/filtre/billet.png" alt>
			</a>
		</li>
	</ul>
</div>
<script src="public/js/montage.js"></script>
<?php 
	$content = ob_get_clean();
	$title = "Montage";
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/views/template.php'; 
?>