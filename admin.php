<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
</head>
<body>
		<section style="width:1270px;">
			<?php
			
			if(isset($_SESSION['agorapseudo']) && $_SESSION['admin'] > 3)
			{
				?>
				<?php
				include("connectionbasededonnee.php");
				// Chargement des différentes pages
				if(isset($_GET['add_page']))
				{
					?>
                    <p style="font-size:.7em;"><a href="index.php">Accueil</a> / <a href="#" class="lien_accueil_admin">Gestion du site</a> / Ajouter des comptes</p>
                    <p>Note: Le site ne supporte qu'une classe à la fois. Pour ajouter une nouvelle classe, ajoutez tous les fichiers du site sur un autre serveur indépendant, avec sa propre base de donnée.</p>
                    <p style="color:red">Attention: les comptes respectent la casse et les caractère accentués. Veillez donc bien à mettre les accents et les majuscules en début de mot, notemment pour les noms composés. </p>
                    <form action="admin.php?add_account=1" id="add_acount_form" method="post">
                    	<select name="titre" id="titre">
							<option type="radio" value="eleve" id="type_eleve" >Elève</option>
							<option type="radio" value="prof" id="type_prof" >Professeur</option>
                        </select><br />
                        <div id="prenom">Prénom: <input type="text" id="prenom_eleve" name="prenom"/></div>
                        <div id="civilite_div">Civilité: <select name="civilite" id="civilite">
							<option type="radio" value="M." id="M" >M.</option>
							<option type="radio" value="Mme." id="Mme" >Mme.</option>
                        </select></div>
                        Nom:<input type="text" name="nom" id="nom" required/><br />
                        <input type="reset" value="Envoyer" />
                    </form>
                    
                    
                    <?php
				}
				elseif(isset($_GET['edit_site']))
				{
					?><p style="font-size:.7em;"><a href="index.php">Accueil</a> / <a href="#" class="lien_accueil_admin">Gestion du site</a> / Modifier les paramètres du site</p><?php
					$retour = mysql_query("SELECT * FROM param_site WHERE id='1'")or die(mysql_error());
					$retour = mysql_fetch_array($retour);
					?>
                    <p>Page d'édition du site</p>
                    <p>Note: Pour modifier vos informations personelles, veuillez passer par la rubrique "mon compte".</p>
                    <form action="admin.php?manage_settings=1" id="manage_settings_form" method="post">
                    Nom de la classe: <input type="text" name="nom_classe" id="champ_nom_classe" size="5" value="<?php echo $retour['classe']; ?>"> <span style="color:grey"> Exemple: TS1</span><br />
                    Email de contact de l'administrateur: <input type="email" name="email_admin" id="champ_email_admin" size="40" value="<?php echo $retour['mail']; ?>"><br />
                    <input type="checkbox" name="mail_actif" id="mail_actif" <?php if ($retour['mail_actif'] == "1"){?> checked <?php } ?>><label for="mail_actif"> Activer la fonction d'envoi de mails (La fonction est-elle activée par votre hébergeur?)</label><br />

                        <input type="button" value="Envoyer" id="admin_edit_param_site"/>
                    </form>
                    
                    
                    <?php
				}
				elseif(isset($_GET['voir_rq_conseil']))
				{
					?>
                    <p style="font-size:.7em;"><a href="index.php">Accueil</a> / <a href="#" class="lien_accueil_admin">Gestion du site</a> / Remarques pour le conseil de classe</p>
                        <input type="button" value="Supprimer toutes les remarques." id="admin_reset_rq"/><span id="traitement" style="color:#C60;">En cours...</span><span id="resultat"></span><br />
                        <a href="voir_remarques.php" target="_blank">Version imprimable</a>
                        <div class="wait_during_process">
                		<img src="ressources/rotating_circle.gif" alt="Chargement" class="wait_during_process"> Chargement en cours...
                		</div>
                        <div id="show_rqs"></div>
                    <script type="text/javascript">
					$('#show_rqs').hide();
					$('#wait_during_process').show();
					$('#show_rqs').load('voir_remarques.php?included=1', function(){
						$('.wait_during_process').hide(400);
						$('#show_rqs').show(400);
					});
					</script>
                    
                    <?php
				}
				elseif(isset($_GET['voir_orientations']))
				{
					?>
                    <p style="font-size:.7em;"><a href="index.php">Accueil</a> / <a href="#" class="lien_accueil_admin">Gestion du site</a> / Voir les choix d'orientation</p>
                        <a href="voir_orientation.php" target="_blank">Version imprimable</a>
                        <div class="wait_during_process">
                		<img src="ressources/rotating_circle.gif" alt="Chargement" class="wait_during_process"> Chargement en cours...
                		</div>
                        <div id="show_rqs"></div>
                    <script type="text/javascript">
					$('#show_rqs').hide();
					$('#wait_during_process').show();
					$('#show_rqs').load('voir_orientation.php?included=1', function(){
						$('.wait_during_process').hide(400);
						$('#show_rqs').show(400);
					});
					</script>
                    
                    <?php
				}
				elseif(isset($_GET['page_conseils']))
				{
					?><p style="font-size:.7em;"><a href="index.php">Accueil</a> / <a href="#" class="lien_accueil_admin">Gestion du site</a> / Paramètres des conseils et de l'orientation</p><?php
					$retour = mysql_query("SELECT * FROM param_conseils WHERE id='1'")or die(mysql_error());
					$retour = mysql_fetch_array($retour);
					?>
                    <p>Page d'édition des paramètres liés à l'orientation et aux conseils de classe</p>
                    <form action="admin.php?manage_settings=1" id="manage_settings_form" method="post">
                    Date du prochain conseil: <input type="text" name="prochain_conseil" id="prochain_conseil" value="<?php echo date("d/m/Y", $retour['prochain_conseil']); ?>"><br />
                    <input type="checkbox" name="orientation_possible" id="orientation_possible" <?php if ($retour['orientation_possible'] == "1"){?> checked <?php } ?>><label for="orientation_possible"> Les élèves <b>peuvent</b> saisir leur orientation sur le site.</label><br />
                    <input type="checkbox" name="orientation_obligatoire" id="orientation_obligatoire" <?php if ($retour['orientation_obligatoire'] == "1"){?> checked <?php } ?>> <label for="orientation_obligatoire">Les élèves <b>doivent</b> saisir leur orientation pour voir leur appréciation.</label> <input type="button" value="Forcer les élèves à revalider leur orientation" id="admin_edit_conseils_button_plus_reset_sondage"/><span id="traitement" style="color:#C60;">En cours...</span><span id="resultat"></span><br />
                    <input type="checkbox" name="easter_egg" id="easter_egg" <?php if ($retour['easter_egg'] == "1"){?> checked <?php } ?>> <label for="easter_egg">Activer le "easter egg" du site (petit message humoristique sur la page de visionnage des appréciations avec la possibilité d'activer un pacman caché)</label><br />
                        <input type="button" value="Envoyer" id="admin_edit_conseils_button"/>
                        
                    </form>
                    
                    
                    <?php
				}
				elseif(isset($_GET['delete_page']))
				{
					?><p style="font-size:.7em;"><a href="index.php">Accueil</a> / <a href="#" class="lien_accueil_admin">Gestion du site</a> / Supprimer des comptes</p><?php
					$retour = mysql_query("SELECT * FROM comptes ORDER BY type, nom")or die(mysql_error());
					?>
                    <p>Note: Pour supprimer la classe (pour changer d'année par exemple), il est nécéssaire de repasser par la page d'instalation du site.</p>
                    <input type="button" value="Afficher les boutons de suppression (Afin d'éviter un clic malheureux)" id="admin_show_deletion_buttons" />
					
                    <table style="width:700px;"><thead>
                    <tr>
                    <th>Pseudo</th>
                    <th>Admin</th>
                    <th>Suppression</th>
                    </tr></thead>
                    <tbody>
                    <?php
					while ($donnees = mysql_fetch_array($retour))
					{
						?>
						<tr id="ligne_suppression_<?php echo $donnees['id']; ?>">
                            <td>
								<?php echo $donnees['pseudo']; ?>
                            </td>
                            <td>
                            <?php if($donnees['admin']== "0"){ ?> Utilisateur <?php }  if($donnees['admin']== "2"){ ?> <div style="color:#F60;">Modérateur</div> <?php } if($donnees['admin']== "3"){ ?> <div style="color:#F60;">Délégué</div> <?php }  if($donnees['admin']== "4"){ ?> <div style="color:red;">Administrateur </div><?php } ?>
                            </td>
                            <td>
                                <div class="admin_see_all_editable_form"><input type="button" value="Supprimer" onclick="delete_single_account(<?php echo $donnees['id']; ?>, '<?php echo $donnees['type']; ?>', '<?php echo $donnees['pseudo']; ?>');"/></div>
                            </td>
                        </tr>
                    <?php
					}
                    ?>
                    </tbody></table>
                    <?php
					
					
					
					
				}
				elseif(isset($_GET['see_pj']))
				{
					?><p style="font-size:.7em;"><a href="index.php">Accueil</a> / <a href="#" class="lien_accueil_admin">Gestion du site</a> / Voir les pièces jointes</p><?php
					$retour = mysql_query("SELECT * FROM pieces_jointes")or die(mysql_error());
					?>
                    <table style="width:700px;"><thead>
                    <tr>
                    <th>Nom du fichier</th>
                    <th>Utilisateur</th>
                    <th>Suppression</th>
                    </tr></thead>
                    <tbody>
                    <?php
					while ($donnees = mysql_fetch_array($retour))
					{
						?>
						<tr id="ligne_pj_<?php echo $donnees['id']; ?>">
                            <td>
								<?php echo $donnees['nom']; ?>
                            </td>
                            <td>
								<?php echo $donnees['pseudo']; ?>
                            </td>
                            <td>
                                <input type="button" value="Supprimer" onclick="delete_pj(<?php echo $donnees['id']; ?>);"/>
                            </td>
                        </tr>
                    <?php
					}
                    ?>
                    </tbody></table>
                    <?php
					
					
					
					
				}
				elseif(isset($_GET['admin_see_all_db']))
				{
					
					?>
                    <p style="font-size:.7em;"><a href="index.php">Accueil</a> / <a href="#" class="lien_accueil_admin">Gestion du site</a> / Gestion des comptes</p>
                    <?php
					$retour = mysql_query("SELECT * FROM comptes ORDER BY type, nom")or die(mysql_error());
					?>
                    <input type="button" value="Editer le contenu" id="admin_modifier_all_db" />
                    <input type="button"  value="Voir sous forme de texte" id="admin_text_only_all_db" />
                    <table><thead><tr>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Mail</th>
                    <th>Admin</th>
                    <th>Première Connexion</th>
                    <th>Type</th>
                    <th>News</th>
                    <th>Mail Public</th>
                    <th></th>
                    <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
					while ($donnees = mysql_fetch_array($retour))
					{
						?>
						<tr id="admin_all_db_ligne_<?php echo $donnees['id']; ?>">
                        <form>
                        <td><?php if($donnees['type']== "eleve"){ ?> <div class="admin_see_all_only_text_hidabble"><?php echo $donnees['prenom']; ?></div><div class="admin_see_all_editable_form"><input type="text"  name="prenom_<?php echo $donnees['id']; ?>" value="<?php echo $donnees['prenom']; ?>" id="prenom_<?php echo $donnees['id']; ?>" /></div><?php } else { ?> <div class="admin_see_all_only_text_hidabble"><?php echo strtok($donnees['pseudo'], " "); ?></div><div class="admin_see_all_editable_form"><select id="titre_<?php echo $donnees['id']; ?>" name="titre_<?php echo $donnees['id']; ?>" >
								<option type="radio" value="M." id="M_<?php echo $donnees['id']; ?>">M.</option>
							<option type="radio" value="Mme." id="Mme_<?php echo $donnees['id']; ?>" <?php if (strtok($donnees['pseudo'], " ") == "Mme."){ ?> selected <?php } ?>>Mme.</option>
                                </select>
                                <input type="hidden" id="prenom_<?php echo $donnees['id']; ?>" value=""</div> <?php } ?></td>
                        <td><div class="admin_see_all_only_text_hidabble"><?php echo $donnees['nom']; ?></div><div class="admin_see_all_editable_form"><input type="text" id="nom_<?php echo $donnees['id']; ?>" name="nom_<?php echo $donnees['id']; ?>" value="<?php echo $donnees['nom']; ?>" /></div></td>
                        <td><div class="admin_see_all_only_text_hidabble"><?php echo $donnees['mail']; ?></div><div class="admin_see_all_editable_form"><input type="text" id="mail_<?php echo $donnees['id']; ?>" name="mail_<?php echo $donnees['id']; ?>" value="<?php echo $donnees['mail']; ?>" /></div></td>
                        <td><div class="admin_see_all_only_text_hidabble"><?php if($donnees['admin']== "0"){ ?> Elève <?php }  if($donnees['admin']== "2"){ ?> <div style="color:#F60;">Professeur</div> <?php } if($donnees['admin']== "3"){ ?> <div style="color:#F60;">Délégué</div> <?php }  if($donnees['admin']== "4"){ ?> <div style="color:red;">Administrateur </div><?php } ?></div><div class="admin_see_all_editable_form"><select id="admin_<?php echo $donnees['id']; ?>" name="admin_<?php echo $donnees['id']; ?>" >
								<option type="radio" value="0" <?php if($donnees['admin']== "0"){ ?> selected="selected" <?php } ?>>Utilisateur</option>
								<option type="radio" value="2" <?php if($donnees['admin']== "2"){ ?> selected="selected" <?php } ?>><div style="color:#F60;">Professeur</div></option>
								<option type="radio" value="3" <?php if($donnees['admin']== "3"){ ?> selected="selected" <?php } ?>><div style="color:#F60;">Délégué</div></option>
								<option type="radio" value="4"<?php if($donnees['admin']== "4"){ ?> selected="selected" <?php } ?>><div style="color:red;">Administrateur </div></option>
							  </select></div></td>
                              <td><?php if($donnees['first'] == "1") { echo "<div style='color:green;'>Effectuée</div>"; } else { echo "<div style='color:red;'>En attente</div>"; } ?></td>
                              <td><?php echo $donnees['type']; ?><div class="hidden"><select id="type_<?php echo $donnees['id']; ?>" name="type_<?php echo $donnees['id']; ?>" >
								<option type="radio" value="eleve" <?php if($donnees['type']== "eleve"){ ?> selected="selected" <?php } ?>>Elève</option>
								<option type="radio" value="prof" <?php if($donnees['type']== "prof"){ ?> selected="selected" <?php } ?>>Prof</option></select></div></td>
                              <td><?php if($donnees['news'] == "1") { echo "<div style='color:green;'>Oui</div>"; } else { echo "<div style='color:red;'>Non</div>"; } ?></td>
                              <td><div class="admin_see_all_only_text_hidabble"><?php echo $donnees['mail_public']; ?></div><div class="admin_see_all_editable_form"><input type="text" name="mail_public_<?php echo $donnees['id']; ?>" id="mail_public_<?php echo $donnees['id']; ?>" value="<?php echo $donnees['mail_public']; ?>" /></div></td>
                              <td><div class="admin_see_all_editable_form"><input type="button" value="Réinitialiser" onclick="admin_reinit_account(<?php echo $donnees['id']; ?>);"/></div></td>
                              <td><input type="hidden" value="<?php echo $donnees['pseudo']; ?>" id="old_pseudo_<?php echo $donnees['id']; ?>"/><div class="admin_see_all_editable_form"><input type="button" value="Envoyer" onclick="admin_edit_db(<?php echo $donnees['id']; ?>);"/>
</div></td>

						</form>
						</tr>
						<?php
					}
					?>

					</tbody>
                    </table>
                    <?php
				}
				else
				{
					?>
					<p style="font-size:.7em;"><a href="index.php">Accueil</a> / Gestion du site</p>
					<ul style="line-height:30px;">
					<li>Généralités:
                    	<ul>
                        <li><a href="#" id="admin_edit_site">Modifier les paramètres généraux du site</a></li>
                        <li><a href="#" id="admin_see_all_db">Voir les informations de la classe (Mails, abonnements,...)</a></li>
                        <li><a href="#" id="admin_see_pj">Voir les pièces jointes ajoutées dans les news</a></li>
                        </ul></li>
					<li>Conseils de classe et orientation:
                        <ul>
                        <li><a href="#" id="admin_edit_conseils">Editer les paramètres concernant l'orientation et les conseils</a></li>
                        <li><a href="#" id="admin_voir_rq_conseil">Voir les remarques pour le conseil de classe</a></li>
                        <li><a href="#" id="admin_voir_orientations">Voir les choix d'orientation des élèves</a></li>
                        <li><a href="#" class="remplir_apprec">Remplir les appréciations des élèves</a></li>
                        </ul></li>
					<li>Comptes:
                    <ul>
                        <li><a href="#" id="admin_add_accounts">Ajouter des comptes</a></li>
                        <li><a href="#" id="admin_delete_accounts" style="color:red">Supprimer des comptes</a></li>
					</ul></li>
                    </ul>
				<?php
				}
			}
			else
			{
				?>
    			<img src="ressources/connexion.png" class="conexion" alt="connexion"/>
    			<?php
				include('connection.php');
			}
			?>
                            <div id="wait_during_process">
                <img src="ressources/rotating_circle.gif" alt="Chargement"> Envoi en cours...
                </div>
                <div id="submission_confirmation"></div>

		</section>
        <script type="text/javascript" src="jquery_color.js"></script>
        <script type="text/javascript">
		$('#civilite_div').hide();
		$('#wait_during_process').hide(0);
		<?php
		if (isset($_GET['show_editable']))
		{
		?>
			$(function() { $('#admin_modifier_all_db').hide(0);});
			$(function() { $('.admin_see_all_only_text_hidabble').hide(0);});
		<?php
		}
		else
		{
			?>
			$(function() { $('.admin_see_all_editable_form').hide(0);});
			$(function() { $('#admin_text_only_all_db').hide(0);});
			<?php
		}
		?>
			function admin_edit_db (id) {
			$('#wait_during_process').fadeIn(500);
			$('#admin_all_db_ligne_' + id).animate({backgroundColor : 'red'}, 400);
			$('#submission_confirmation').hide(0, function() {
				if($('#type_'+id).val() == "eleve")
				{
					
					$('#submission_confirmation').load('admin_traitement.php?edit_base=1',{prenom:$('#prenom_'+id).val(), old_pseudo:$('#old_pseudo_'+id).val(), nom:$('#nom_'+id).val(),mail:$('#mail_'+id).val(), admin:$('#admin_'+id).val(), mail_public:$('#mail_public_'+id).val(), id: id, type: 'eleve', pseudo:$('#prenom_'+id).val()+ ' ' + $('#nom_'+id).val()}, function() {
					$('#wait_during_process').fadeOut(500);
					$('#submission_confirmation').show(1750);
					$('#admin_all_db_ligne_' + id).animate({backgroundColor : 'green'}, 400);
					});
				}
				else
				{
					$('#submission_confirmation').load('admin_traitement.php?edit_base=1',{prenom:'', nom:$('#nom_'+id).val(),mail:$('#mail_'+id).val(), admin:$('#admin_'+id).val(), mail_public:$('#mail_public_'+id).val(), id: id, type: 'prof', pseudo:$('#titre_'+id).val()+ ' ' +$('#nom_'+id).val()}, function() {
					$('#wait_during_process').fadeOut(500);
					$('#submission_confirmation').show(1750);
					$('#admin_all_db_ligne_' + id).animate({backgroundColor : 'green'}, 400);

					});
				}
				});};
				
			function admin_reinit_account (id) {
			$('#wait_during_process').fadeIn(500);
			$('#admin_all_db_ligne_' + id).animate({backgroundColor : 'red'}, 400);
			$('#submission_confirmation').hide(0, function() {
					$('#submission_confirmation').load('admin_traitement.php?reinit_account=1',{id: id}, function() {
					$('#wait_during_process').fadeOut(500);
					$('#admin_all_db_ligne_' + id).animate({backgroundColor : 'green'}, 400);
					$('#submission_confirmation').show(1750);
					});
				});};
				
			function delete_single_account (id, type, pseudo) {
			$('#wait_during_process').fadeIn(500);
			$('#ligne_suppression_' + id).hide(500);			
			$('#submission_confirmation').hide(0, function() {
				if(type == "eleve")
				{
					$('#submission_confirmation').load('admin_traitement.php?delete_single_account=1&eleve=1',{id: id, pseudo: pseudo}, function() {
					$('#wait_during_process').fadeOut(500);
					$('#submission_confirmation').show(1750);
					});
				}
				else
				{
					$('#submission_confirmation').load('admin_traitement.php?delete_single_account=1',{id: id}, function() {
					$('#wait_during_process').fadeOut(500);
					$('#submission_confirmation').show(1750);
					});
				}
				});};


			function delete_pj (id) {
				$('#wait_during_process').fadeIn(500);
				$('#ligne_pj_' + id).hide(500);			
				$('#submission_confirmation').hide(0, function() {
				$('#submission_confirmation').load('admin_traitement.php?delete_pj=1',{id: id}, function() {
				$('#wait_during_process').fadeOut(500);
				$('#submission_confirmation').show(1750);
				});
			});};
			
				<?php
				if(isset($_GET['page_conseils']))
				{
					?>
					$('#prochain_conseil').datepicker( $.datepicker.regional[ "fr" ] );
					if ($('#orientation_possible').is(':checked') == false)
					{
						$('#orientation_obligatoire').attr('disabled', true)
					}
					if ($('#orientation_obligatoire').is(':checked') == false)
					{
						$('#admin_edit_conseils_button_plus_reset_sondage').hide();
					}
					$(function() {
	  					$('#updater').on('click', '#orientation_possible',function() {
							if ($(this).is(':checked') == false)
							{
								$('#orientation_obligatoire').attr('disabled', true);
								$('#orientation_obligatoire').removeAttr('checked', true);
								$('#admin_edit_conseils_button_plus_reset_sondage').hide(400);
							}
							else
							{
								$('#orientation_obligatoire').removeAttr('disabled');
							}
	  				});});
					$(function() {
	  					$('#updater').on('click', '#orientation_obligatoire',function() {
							if ($(this).is(':checked') == false)
							{
								$('#admin_edit_conseils_button_plus_reset_sondage').hide(400);
							}
							else
							{
								$('#admin_edit_conseils_button_plus_reset_sondage').show(400);
							}
	  				});});

					<?php
				}
				
				?>
				
				 $(function(){
          $("#titre").change(function(){
            $("option:selected", $(this)).each(function(){
                var obj = document.getElementById('titre').value;
                if (obj == "prof")
				{
					$('#prenom').hide(750);
					$('#civilite_div').show(750);
				}
				else
				{
					$('#prenom').show(750);
					$('#civilite_div').hide(750);
				}

            });
          });
        });
	$('#resultat').hide();
	$('#traitement').hide();
	$('.hidden').hide();

		</script>
	</div>
</body>
</html>