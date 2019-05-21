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
    		<a class="navbar-brand" href="index.php?action=home"><i class="fas fa-home"></i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    		 	<ul class="navbar-nav mr-auto">
    		 		<li>
              <a class="nav-link" href="index.php?action=home"> Accueil</a>
            </li>
    		 		<li>
              <a class="nav-link
              <?php 
              if (isset($_SESSION['authority'])): 
                  if($_SESSION['authority']>=1): 
                    echo ('active'); 
                  endif; 
              else: echo ('disabled ');
              endif;?>" href="index.php?action=booking">Réservation</a>
            </li>
            <li>
              <div class="dropdown show">
    		        <a class="nav-link dropdown-toggle" href="#" id="menuDropdown" data-toggle="dropdown" >Menu</a>
                <div class="dropdown-menu" aria-labelledby="menuDropdown">
                  <a class="dropdown-item" href="index.php?action=menu&category=1&page=1">Entrée</a>
                  <a class="dropdown-item" href="index.php?action=menu&category=2&page=1">Plat</a>
                  <a class="dropdown-item" href="index.php?action=menu&category=3&page=1">Dessert</a>
                  <a class="dropdown-item" href="index.php?action=menu&category=4&page=1">Boisson</a>
                </div>
              </div>
            </li>
    		    <li>
              <a class="nav-link" href="index.php?action=guestbook&page=1">Livre d'or</a>
            </li>
              <?php 
              if (isset($_SESSION['authority'])):
                if($_SESSION['authority']>=2):
              ?>
            <li>
              <div class="dropdown show">
                <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" data-toggle="dropdown">Panneau administrateur</a>
                <div class="dropdown-menu" aria-labelledby="adminDropdown">
                  <a class="dropdown-item" href="index.php?action=admin_blog">Blog</a>
                  <a class="dropdown-item" href="index.php?action=admin_guestbook">Livre d'or</a>
                  <a class="dropdown-item" href="index.php?action=admin_booking">Réservations</a>
                  <?php if($_SESSION['authority']>=3): 
                  ?>
                  <a class="dropdown-item" href="index.php?action=admin_users">Gérer les accès</a>
                  <a class="dropdown-item" href="index.php?action=admin_menu">Modifier la carte</a>
                  <?php 
                  endif;
                  ?>
                </div>
              </div>
            </li>
              <?php
                endif;
              endif;
              ?>
    		  </ul>
    		  <ul class="navbar-nav justify-content-end">
            <li><a class="nav-link" href="index.php?action=user_profile">
    		  	<?php 
    		  	if (isset($_SESSION['authority'])):
    		  		echo ('Bonjour' . ' ' . $_SESSION['first_name'] . ' ' . $_SESSION['last_name']);
    		  	?></a></li>
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
        </div>
  	  </nav>
    <section>
	   	<?= $content ?>
	  </section>
  <?php require('modal.php'); ?>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	
	<script src="public/scripts/ajax.js"></script>
	<script src="public/scripts/script.js"></script>
  <?= $calledScript ?>
	
	<script></script>
	
    </body>
</html>