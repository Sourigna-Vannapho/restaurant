<?php 
      if (isset($_GET['information'])):
      ?>
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
    <?php 
    endif; 
    ?>
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
								<input type="password" name="password" class="form-control" pattern=".{6,}" placeholder="6 caractères minimum">
							</div>
        			        <button type="submit" class="btn btn-primary">Connexion</button>
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
      					</form>
      				</div>
    			</div>
  			</div>
		</div>