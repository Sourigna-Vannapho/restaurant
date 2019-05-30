<?php $title = 'Van\' à pho - Livre d\'or'; ?>
<?php ob_start(); ?>
<?php 
if(isset($_GET['info'])):
  if ($_GET['info']=='success'):
?>
<div id="notification" class="alert alert-success notification" role="alert">
    Opération effectuée avec succès !
</div>
<?php
  endif;
endif;
?>
<div class="container-fluid background">
	<div class="image">
		<img src="public/img/bg_guestbook.jpg" class="img-fluid" alt="Guestbook Background">
		<div class="blackOverlay"></div>
	</div>
</div>
<div class="container-fluid" id="guestbook">
	<div>
		<h1>Livre d'or</h1>
		<p>Ceci est un espace où vous pouvez partager vos impressions sur votre visite chez nous !</p>
	</div>
	<!-- Form to comment on the guestbook -->
	<form method="POST" action="index.php?action=entry_guestbook">
		<textarea class="form-control col-sm-4 offset-sm-4" name="comment" rows="3" required></textarea>
		<br/>
		<button type="submit" class="btn btn-primary">Valider</button>
	</form>
	<!--Displays guestbook entries -->
	<div id="guestbookEntry">
		<div class="row">
			<div class="col-lg-5 col-sm-5 offset-sm-1">
			<?php 
			$c=1;
			while ($data = $guestbookEntry->fetch()){
				?>
				<p> <?= htmlspecialchars($data['comment']) ?> 
				</p>
				<p> Posté par 
					<?php if ($data['user_id']==0):
						echo ('Visiteur');
				else:
					echo htmlspecialchars($data['first_name'] . ' ' . $data['last_name']);
				endif;
					echo (' le ' . $data['creation_date']); ?> 
				</p>
			<?php if ($c==4):echo ('</div>'); endif;
				  if ($c==4):echo ('<div class="col-md-4 col-sm-5">');endif;?>
			<?php
			$c++;
			}
			$guestbookEntry->closeCursor();
			?>
			</div>
		</div>
	</div>
	<!--Displays the amount of pages available and a next and previous button-->
	<nav>
  		<ul class="pagination justify-content-center">
		    <li class="page-item 
		    <?php 
		    if($_GET['page']==1): 
		    	echo ('disabled');
		    endif;
		    ?> ">
		    <a class="page-link" href="index.php?action=guestbook&page=<?= ($_GET['page']-1)?>">Previous</a></li>
		    <?php
		    $i=1;
		    while ($i<=$guestbookPageNb){ ?>
		    <li class=" page-item <?php if($i == $_GET['page']): echo ('active');endif;?> "><a class="page-link" href="index.php?action=guestbook&page=<?= $i ?>"><?= $i ?></a></li>
		    <?php
		    $i++;
			}
		    ?>
		    <li class="page-item 
		    <?php 
		    if($_GET['page']==$guestbookPageNb):
		    echo ('disabled');
		    endif;
		    ?>">
		    <a class="page-link" href="index.php?action=guestbook&page=<?= ($_GET['page']+1)?>">Next</a></li>
		</ul>
	</nav>
</div>
<?php $content = ob_get_clean(); ?>
<?php ob_start(); ?>
<?php 
if(isset($_GET['info'])):
    if ($_GET['info']=='success'):
?>
<script src="public/scripts/notification.js"></script>
<?php
    endif;
endif;
?>
<?php $calledScript = ob_get_clean(); ?>
<?php require('template.php'); ?>