<head>
<link rel="stylesheet" type="text/css" href="test.css">
</head>
<main>
	<video id="video"></video>
	<canvas id="canvas"></canvas>		
	<button id="take">Prendre une photo</button>
</main>
<aside></aside>
<div>
	<ul class="navigation_diapo">
		<li>
			<a>
				<img id="kitten" src="public/images/filtre/kitten.png" alt>
			</a>
		</li>
		<li>
			<a>
				<img id="dog" src="public/images/filtre/dog.png" alt>
			</a>
		</li>
		<li>
			<a>
				<img id="cigare" src="public/images/filtre/cigare.png" alt>
			</a>
		</li>
		<li>
			<a>
				<img id="billet" src="public/images/filtre/billet.png" alt>
			</a>
		</li>
		<li>
			<a>
				<img id="piercing" src="public/images/filtre/piercing.png" alt>
			</a>
		</li>
		<li>
			<a>
				<img id="ours" src="public/images/filtre/ours.png" alt>
			</a>
		</li>
		<li>
			<a>
				<img id="nuage" src="public/images/filtre/nuage.png" alt>
			</a>
		</li>
	</ul>
</div>
<section class="card">
  <div class="card--content"></div>
  <div class="card--content"></div>
  <div class="card--content"></div>
  <div class="card--content"></div>
  <div class="card--content"></div>
  <div class="card--content"></div>
  <div class="card--content"></div>
  <div class="card--content"></div>
  <div class="card--content"></div>
  <div class="card--content"></div>
</section>
<script src="public/js/montage.js"></script>
<?php 
	$content = ob_get_clean();
	$title = "Montage";
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/views/template.php'; 
?>