<!DOCTYPE html>
<html lang="fr">
    <head>
    	<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title ?></title>
        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
        <link href="public/css/style.css" rel="stylesheet" />
    </head>
    <body>
	    <nav class="navbar navbar-expand-sm">
    			<a class="navbar-brand" href="index.php?action=home">Van' à pho</a>
		    	<ul class="navbar-nav mr-auto">
		    		<li><a class="nav-link" href="index.php?action=home"><i class="fas fa-home"></i> Accueil</a></li>
		    		<li><a class="nav-link" href="index.php?action=booking">Réservation</a></li>
		    		<li><a class="nav-link" href="index.php?action=menu">Menu</a></li>
		    		<li><a class="nav-link" href="index.php?action=guestbook&page=1">Livre d'or</a></li>
		    	</ul>
		    	<ul class="navbar-nav">
		    		<?php 
		    		if (isset($_SESSION['authority'])):
		    			echo ('Bonjour' . ' ' . $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] . ' (' . $_SESSION['mail'] . ')');
		    		?>
		    		<li><a class="nav-link" href="index.php?action=logout"><i class="fas fa-sign-out-alt"></i>Déconnexion</a></li>
		    		<?php
		    		else:
		    		?>
		    		<li><a class="nav-link" href="index.php?action=register">Inscription</a></li>
		    		<li><a class="nav-link" data-toggle="modal" data-target="#connexionWindow" href="#"><i class="fas fa-sign-in-alt"></i> Connexion</a></li>
		    		<?php
		    		endif;
		    		?>
		    		
		    	</ul>
	    </nav>
	    <div class="modal fade" id="information" tabindex="-1" role="dialog">
  			<div class="modal-dialog" role="document">
   				<div class="modal-content">
    				<div class="modal-header">
     					<h2 class="modal-title">Information</h2>
        				<button type="button" class="close" data-dismiss="modal">
          				<span>&times;</span>
        				</button>
      				</div>
      				<div class="modal-body">
      					<?php 
      					if (isset($_GET['information'])) :
      						switch($_GET['information']) :
      							case "register" : ?>
      					<h3>Inscription complète !</h3>
        				<p>
        					Un mail à été envoyé dans votre boîte mail, cliquez sur le lien à l'intérieur pour finaliser votre inscription et pouvoir ensuite réserver une table chez nous !
        				</p>
        				<?php 
        							break;
        						case "booking" :
        				?>
        				<h3>Réservation complète !</h3>
        				<p>
        					Votre réservation à bien été prise en compte !
        				</p>
        				<?php
        							break;
        					endswitch;
        				endif;
        				?>
      				</div>
      				<div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      				</div>
    			</div>
  			</div>
		</div>
	    <div class="modal fade" id="connexionWindow" tabindex="-1" role="dialog">
  			<div class="modal-dialog" role="document">
   				<div class="modal-content">
    				<div class="modal-header">
     					<h2 class="modal-title">Connexion</h2>
        				<button type="button" class="close" data-dismiss="modal">
          				<span>&times;</span>
        				</button>
      				</div>
      				<div class="modal-body">
        				<form method="POST" action="index.php?action=login_confirm">
        					<div class="form-group">
								<label>Adresse mail</label>
								<input type="text" name="mail" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Exemple : adresse@domaine.com">
							</div>
							<div class="form-group">
								<label>Mot de passe</label>
								<input type="password" name="password" class="form-control" pattern=".{6,}"placeholder="6 caractères minimum">
							</div>
        			        <button type="submit" class="btn btn-primary">Connexion</button>
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
      					</form>
      				</div>
    			</div>
  			</div>
		</div>
	    <section>
	    	<?= $content ?>
	    </section>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="public/scripts/map.js"></script>
	<script src="public/scripts/ajax.js"></script>
	<script src="public/scripts/script.js"></script>
	<script src="public/scripts/main.js"></script>
	<?php 
	if (isset($_GET['information'])):
	?>
	<script>var test = $("#information").modal('show')</script>
	<?php 
	endif; 
	?>

    </body>
</html>