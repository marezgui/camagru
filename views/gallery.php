<?php require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/gallery.php'; ?>

<?php ob_start(); ?>

<section id="gallery">
		<header>
			<h1>Galerie</h1>
		</header>

		<div id="content">
			<?php 
				for ($i=0; $i < count($img); $i++) 
				{
			?>
					<div class="media">
						<a href="#">
							<img src='<?= "../public/images/gallery/". $img[$i]['path'] ?>' alt="" title="" />
							<input type="hidden" name="id_img" value='<?= $img[$i]['id']?>'>
						</a>
						<div class="underImg">
							<div class="details">
								<span class="author"><?= ucfirst($img[$i]['login']) ?></span>
								<span class="date"><?= $img[$i]['date'] ?></span>
							</div>
							<a href="#" class="like" > 
								<i class="fas fa-heart"></i> <?= $gallery->getLikes($img[$i]['id']) ?> 
							</a>

							<a class="comments" href="#" >
								<i class="fas fa-bolt"></i> <?= (int) $gallery->getNbComments($img[$i]['id']) ?>
							</a>
						</div>
					</div>
			<?php 
				}
			?>
		</div>
</section>

<script src="../public/js/oXHR.js"></script>

<?php 
	$content = ob_get_clean();
	$title = "Galerie";
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/views/template.php'; 
?>