<?php require $_SERVER['DOCUMENT_ROOT'] . '/camagru/controllers/gallery.php'; ?>

<?php ob_start(); ?>

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
						<a href="javascript:{}" onclick="openModal(document.querySelector('#modal-<?= $img[$i]['id'] ?>'));">
							<img src='<?= "../public/images/gallery/". $img[$i]['path'] ?>' alt="" title="" />
							<input type="hidden" name="id_img" value='<?= $img[$i]['id']?>'>
						</a>
						<div class="underImg">
							<div class="details">
								<span class="author"><?= ucfirst($img[$i]['login']) ?></span>
								<span class="date"><?= $img[$i]['date'] ?></span>
							</div>
							<form id='f-<?= $img[$i]['id'] ?>' method="POST" action="/camagru/controllers/galleryLike.php">
								<?php 
									if (isset($_SESSION['login'])) 
									{ 
								?> 
										<a href="javascript:{}" class="like" onclick="like(document.querySelector('#f-<?= $img[$i]['id'] ?>'), document.querySelector('#l-<?= $img[$i]['id'] ?>'));"> 
								<?php 
									} else 
									{  
								?>	
										<a href="javascript:{}" class="like" >
								<?php
									} 
								?> 
									<span id='l-<?= $img[$i]['id'] ?>'><i class='<?php echo likeStatus($_SESSION['id'], $img[$i]['id']) ? "fas fa-heart" : "far fa-heart";?>' ></i> <?= getLikes($img[$i]['id']) ?></span>
									
									<input type="hidden" name="like" value="like">
									<input type="hidden" name="id_img" value="<?= $img[$i]['id']?>">
								</a>
							</form>
								<a class="comments" onclick="openModal(document.querySelector('#modal-<?= $img[$i]['id'] ?>'));" href="javascript:{}" >
									<i class="far fa-comment"></i> 
									<span id='c-<?= $img[$i]['id'] ?>'><?= getNbComments($img[$i]['id']) ?></span>
								</a>
						</div>
					</div>
					<div class="modal" id='modal-<?= $img[$i]['id'] ?>'>
						<div class="modal-content">
							<div class="modal-header">
						    	<span onclick="closeModal(document.querySelector('#modal-<?= $img[$i]['id'] ?>'))" class="close">&times; </span>
						      	<h2>Commentaire</h2>
						    </div>
							<div class="modal-body">
								<img src='<?= "../public/images/gallery/". $img[$i]['path'] ?>' alt="" title="" />
								<?php 
									if (isset($_SESSION['id']))
									{
								?>
										<h2>Ajouter un commentaire</h2>
										<form id='fc-<?= $img[$i]['id'] ?>' method="POST" action="/camagru/controllers/galleryComment.php">
											<div class="add-cmt">
												<textarea name="newCmt" ></textarea>
												<input type="hidden" name="id_img" value="<?= $img[$i]['id']?>">
												<button class="cmt-button" type="button" onclick="comment(document.querySelector('#fc-<?= $img[$i]['id'] ?>'), document.querySelector('#cmt-<?= $img[$i]['id'] ?>'), document.querySelector('#c-<?= $img[$i]['id'] ?>'), document.querySelector('#error-<?= $img[$i]['id'] ?>'));"> Ajouter ! </button>
											</div>
										</form>
										<div class="error" id='error-<?= $img[$i]['id'] ?>'></div>
								<?php
									}
								?>
								<?php 
									$comments = getComments($img[$i]['id']);
								?>
										<div class="cmt-content" id='cmt-<?= $img[$i]['id'] ?>'>
										<?php
											foreach ($comments as $comment) 
											{
										?>
												<p class="cmt-user" ><?= $comment['login'] ?></p>
												<p class="cmt"><?= $comment['comment'] ?></p>
												<p class="cmt-date"><?= $comment['date'] ?></p>
												
										<?php
											}
										?>
										</div>
							</div>
						</div>
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
						echo '<a href="gallery.php?page=' . $i .'">' . $i . '</a>' . '&nbsp;';
					}
				}
			?>
		</div>
</section>

<script src="../public/js/oXHR.js"></script>
<script src="../public/js/AjaxLike.js"></script>
<script src="../public/js/AjaxComment.js"></script>
<script src="../public/js/modals.js"></script>

<?php 
	$content = ob_get_clean();
	$title = "Galerie";
	require $_SERVER['DOCUMENT_ROOT'] . '/camagru/views/template.php'; 
?>