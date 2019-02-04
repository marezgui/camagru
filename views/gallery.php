<?php require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/gallery.php'; ?>

<?php ob_start(); ?>

<div class="backdrop" onclick="closeModal(document.querySelectorAll('.modal'));"></div>

<section id="gallery">
		<header>
			<h1>Galerie</h1>
		</header>

		<div id="content">
			<?php 
				for ($i=0; $i < $imgToPrint; $i++) 
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
							<form id='f-<?= $img[$i]['id'] ?>' method="POST" action="/camagru/controllers/galleryLike.php">
								<a href="javascript:{}" class="like" onclick="like(document.querySelector('#f-<?= $img[$i]['id'] ?>'), document.querySelector('#l-<?= $img[$i]['id'] ?>'));"> 
									
									<span id='l-<?= $img[$i]['id'] ?>'><i class='<?php echo likeStatus($_SESSION['id'], $img[$i]['id']) ? "fas fa-heart" : "far fa-heart";?>' ></i> <?= getLikes($img[$i]['id']) ?></span>
									
									<input type="hidden" name="like" value="like">
									<input type="hidden" name="id_img" value="<?= $img[$i]['id']?>">
								</a>
							</form>
								<a class="comments" onclick="openModal(document.querySelector('#modal-<?= $img[$i]['id'] ?>'));" href="javascript:{}" >
									<i class="fas fa-bolt"></i> <?= getNbComments($img[$i]['id']) ?>
								</a>
						</div>
					</div>
					<div class="modal" id='modal-<?= $img[$i]['id'] ?>'>
						<h1>Commentaire</h1>
						<textarea placeholder="Commentaire..." rows="5" cols="60"></textarea>
						<a href="javascript:{}"> Ajouter </a>
						<?php 
							$comments = getComments($img[$i]['id']);
							foreach ($comments as $comment) 
							{
						?>
								<p><?= $comment['comment'] ?></p>
						<?php
							}
						?>
					</div>
			<?php 
				}
			?>
		</div>

		<div id="nbPage"> <em>Page </em>
			<?php
				for($i = 1; $i <= $totalPage; $i++)
				{
					if ($i == $actualPage)
					{
						echo " " . $i . " ";
					}
					else 
					{
						echo '<a href="gallery.php?page=' . $i .'">' . $i . '</a>';
					}
				}
			?>
		</div>
</section>

<script src="../public/js/oXHR.js"></script>
<script src="../public/js/galleryLike.js"></script>
<script src="../public/js/modals.js"></script>

<?php 
/*onclick="document.getElementById('f-'+<?= $img[$i]['id'] ?>).submit(); return false;
id='c-<?= $img[$i]['id'] ?>' onclick="openModal(document.querySelector('#c-<?= $img[$i]['id'] ?>'));"
*/
	$content = ob_get_clean();
	$title = "Galerie";
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/views/template.php'; 
?>