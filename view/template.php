<!DOCTYPE html>
<html lang="fr">
    <head>
    	<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title ?></title>
        
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
        <link href="public/css/style.css" rel="stylesheet" />
    </head>
    <body>
	    <nav class="navbar navbar-expand-sm">
    			<a class="navbar-brand" href="index.php?action=home">Van' à pho</a>
		    	<ul class="navbar-nav mr-auto">
		    		<li><a class="nav-link" href="index.php?action=home">Accueil</a></li>
		    		<li><a class="nav-link" href="index.php?action=booking">Réservation</a></li>
		    		<li><a class="nav-link" href="index.php?action=menu">Menu</a></li>
		    		<li><a class="nav-link" href="#">Livre d'or</a></li>
		    	</ul>
		    	<ul class="navbar-nav">
		    		<li><a class="nav-link" href="index.php?action=register">Inscription</a></li>
		    		<li><a class="nav-link" data-toggle="modal" data-target="#connexionWindow" href="#">Connexion</a></li>
		    	</ul>
	    </nav>
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
        				<form>
        					<div class="form-group">
								<label>Adresse mail</label>
								<input type="text" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Exemple : adresse@domaine.com">
							</div>
							<div class="form-group">
								<label>Mot de passe</label>
								<input type="password" class="form-control" pattern=".{6,}"placeholder="6 caractères minimum">
							</div>
        				</form>
      				</div>
      				<div class="modal-footer">
				        <button type="button" class="btn btn-primary">Connexion</button>
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
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
    </body>
</html>