<?php 
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/session.php'; 
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/Gallery.php';
?>
<?php ob_start(); ?>

<section id="montage-wrap">
	<main id="camera" >
		<video id="video"></video>
		<canvas width="100%" height="100%" id="canvas"></canvas>		
		<button id="take"><i class="fas fa-camera"></i> Prendre une photo</button>
		<button id="addfiltre">Ajouter filtre</button>
		<button id="nofiltre">Enlever filtre</button>
		<i>Ajouter Photo</i>
		<input id="imageLoader" type="file"/>
		<div id="prev"></div>

		<i>Ajouter Filtre</i>
		<form method="post" id="form" enctype="multipart/form-data">
		    <input type="file" id="add_filtre" name="files[]" multiple>
		    <input type="submit" value="Upload File" name="submit">
		</form>
	</main>

	<div >
		<ul class="navigation_diapo" id="listfiltre">
			<?php
				$path = $_SERVER['DOCUMENT_ROOT']."/camagru/public/images/filtre";
				$dir = array_diff(scandir($path), array('..', '.'));
				foreach ($dir as $key => $value) 
				{
					$filtre = explode('.', $value);
			?>
					<li>
						<a>
							<img class='filtre' id='<?= $filtre[0] ?>' src='<?= "/camagru/public/images/filtre/". $value ?>'alt>
						</a>
					</li>
			<?php				
				}
			?>
		</ul>
	</div>
</section>

<aside id="myImages">
	<?php
		$gallery = new Gallery();
		$img = $gallery->getUserImage($_SESSION['login']);

		for ($i= 0; $i < count($img); $i++)
		{
	?>
			<div class="container">
				<img src='<?= "/camagru/public/images/gallery/". $img[$i]['path'] ?>' />
				<button class="btn" id='<?= $img[$i]['path'] ?>'>Supprimer</button>
			</div>
	<?php
		}
	?>
</aside>

<script src="/camagru/public/js/montage.js"></script>

<?php 
	$content = ob_get_clean();
	$title = "Montage";
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/views/template.php'; 
?>