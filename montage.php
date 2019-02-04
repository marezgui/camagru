<?php 
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/session.php'; 
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/models/Gallery.php';
?>
<?php ob_start(); ?>

<section id="main_montage">
	<section id="pannel">
		<main id="camera">
			<video id="video"></video>
			<canvas id="canvas"></canvas>		
			<button id="take">Prendre une photo</button>
		</main>	
		<aside id="myImages">
				<?php
					$gallery = new Gallery();
					$img = $gallery->getUserImage($_SESSION['login']);
				?>
				<h1> Mes images </h1>
				<?php 
					for ($i= 0; $i < count($img); $i++)
					{
				?>
						<img width="120px" height="120px" src='<?= "./public/images/gallery/". $img[$i]['path'] ?>' />
				<?php
					}
				?>
		</aside>
	</section>
	<div >
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
</section>

<script src="public/js/montage.js"></script>

<?php 
	$content = ob_get_clean();
	$title = "Montage";
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/views/template.php'; 
?>