<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Site de la classe!</title>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <link href="rasta_new.css" rel="stylesheet" type="text/css" />
    <link rel="icon" type="image/png" href="ressources/icon.png" />
    <script type="text/javascript" src="jquery.js"></script>
     <?php
	if (isset($_SESSION['agorapseudo']) && $_SESSION['admin'] > 3)
	{
		?>
		<script src="Jquery_ui/js/jquery-ui.min.js"></script>
		<link href="Jquery_ui/css/smoothness/jquery-ui.min.css" rel="stylesheet" type="text/css" />
		<?php
	}
	?>
</head>
<body>
    <?php
		include("menu_haut.php");
	?>
	    <div class="griseur"></div>
<section id="AJAX_loading_animation">

        	<?php
			if(!isset($_SESSION['agorapseudo']))
			{
				?>
                <p>Si ce message ne disparait pas une fois la page chargée, votre navigateur ne pourra probablement pas afficher correctement le site. Si vous utilisez internet explorer, changez tout de suite vers <a href="https://www.mozilla.org/fr/firefox/">Firefox</a>, <a href="http://www.opera.com/">Opera</a> ou encore <a href="https://www.google.com/intl/fr/chrome/browser/">Chrome</a>, trois navigateurs gratuits!</p>
                <?php
			}
			?>
		<div class="texte_center"><img src="ressources/ajax-loader.gif" alt="Chargement..."/></div>
	</section>

	<div id="updater">
		<section>
			<?php
			if(isset($_SESSION['agorapseudo']))
			{
				include("connectionbasededonnee.php");
				$infos_classe = mysql_query("SELECT * FROM param_site WHERE id='1'") or die(mysql_error());
				$infos_classe = mysql_fetch_array($infos_classe);
				?>
				<div class="texte_center">
                <h1>Bienvenue sur le site de la classe de <?php echo $infos_classe['classe']; ?>!</h1>
                <hr style="margin:20px;" />
                <h2>Conseil de classe:</h2><br />
                <?php
                $sondage_necessaire = mysql_query("SELECT * FROM param_conseils WHERE id='1'")or die (mysql_error());
                $sondage_necessaire = mysql_fetch_array($sondage_necessaire);
				$ok_pour_conseil = false;
                if ($sondage_necessaire['orientation_possible'])
                {
                    $sondage = mysql_query("SELECT * FROM sondage WHERE pseudo='{$_SESSION['agorapseudo']}'")or die (mysql_error());
                    $sondage = mysql_fetch_array($sondage);
					if ($sondage_necessaire['orientation_obligatoire'])
					{
						if($sondage['Fait'])
						{
							$ok_pour_conseil = true;
						}
					}
					else
					{
						$ok_pour_conseil = true;
					}
					if($sondage_necessaire['orientation_obligatoire'] == "0" ||time() < $sondage_necessaire['prochain_conseil'] || time() > $sondage_necessaire['peremption_data'])
					{
						?>
						<a href="#" class="lien_sondage">Saisir ou modifier son orientation.</a><br />
						<?php
					}
                }
				else
				{
					$ok_pour_conseil = true;
				}
                if(time() > $sondage_necessaire['prochain_conseil'] && $ok_pour_conseil == true && time() < $sondage_necessaire['peremption_data'])
                {
                    ?>
                        <a href="#" class="lien_voir_apprec" style="color:green;">Voir son appréciation au conseil de classe.</a><br /><br />
                    <?php
                }
                if(time() > $sondage_necessaire['prochain_conseil'] && $_SESSION['admin'] > 2 && time() < $sondage_necessaire['peremption_data'])
                {
                    ?>
                        <a href="#" class="remplir_apprec" style="color:green;">Saisir les appréciations</a><br /><br />
                    <?php
                }
                if(time() > $sondage_necessaire['peremption_data'] && $sondage_necessaire['peremption_data'] > $sondage_necessaire['last_deletion'])
                {
                    mysql_query("UPDATE apprec SET apprec='', felicitations='0', compliments='0', encouragements='0', avert_conduite='0', avert_travail='0', moyenne=''")or die(mysql_error());
                    mysql_query("UPDATE param_conseils SET last_deletion='{time()}' ")or die(mysql_error());
                }
				
				?>
                <a href="#" class="lien_remarques">Poster une remarque pour le conseil de classe.</a>
				<hr style="margin:20px;" />
                <a href="#" class="lien_liste_mails">Consulter les adresses mail de vos professeurs et délégués.</a><br /><br />
				<a href="#" class="lien_acces_se3">Savoir comment accéder aux fichier présents sur sa session au lycée de chez soi.</a><br />
				</div>
				<hr style="margin:20px;" />
				<div class="texte_center"><h2>Dernière news:</h2></div>
				<?php
				include("connectionbasededonnee.php");
				$retour = mysql_query('SELECT * FROM news ORDER BY id DESC LIMIT 0, 1')or die (mysql_error());
				while ($donnees = mysql_fetch_array($retour))
				{
					?>
    				<h3 class="h3">
    				<?php
        			$donnees['titre'] = nl2br(stripslashes($donnees['titre'])); echo $donnees['titre']; ?>
        			</h3><h5>Le 
					<?php 
					echo date('d/m/Y', $donnees['timestamp']);
					echo " A ";
					echo date('H\hi', $donnees['timestamp']); 
					echo " par ";
        			echo $donnees['auteur']; ?></h5>
    				<?php
    				$contenu = stripslashes($donnees['contenu']);
    				echo $contenu;
					$pj_brut = mysql_query("SELECT * FROM pieces_jointes WHERE id_news='{$donnees['id']}'")or die(mysql_error());
					if (mysql_num_rows($pj_brut) > 0)
					{
						?>
						<hr style="margin:15px;" />
						<p><em>Pièces jointes:</em>
						<ul>
						<?php
						while ($pj = mysql_fetch_array($pj_brut))
						{
							?>
							<li><a href="fineUploader/uploads/uploads/<?php echo $pj['nom']; ?>"><?php echo $pj['nom']; ?></a></li>
							<?php
						}
						?>
						</ul></p>
						<?php
					}


				} // Fin de la boucle des news
			}
			else
			{
				?>
    			<img src="ressources/connexion.png" class="conexion" alt="connexion"/>
    			<?php
				if (isset($_GET['redir']))
				{
					?><p style="color:orange;">Veuillez vous connecter avant d'accéder à la page souhaitée.</p><?php
				}
					include('connection.php');
			}
			?>
            
		</section>
	</div>
	<?php include("footer.php"); ?>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
  $('#AJAX_loading_animation').hide();
  $('.griseur').hide();
</script>

	<?php if (isset($_SESSION['agorapseudo']))
	{
		include("redirections.php");
	?>

<script type="text/javascript">
var current_page = "";
window.onpopstate = function(event) {
if(event.state != null)
{
	if (event.state.page != "")
	{
		$('#AJAX_loading_animation').show();
		$('.griseur').fadeIn(200, function() {
			$('#updater').load(event.state.page, function() {
		$('#AJAX_loading_animation').fadeOut(200);
		$('.griseur').fadeOut(200);
		});});
	}
	else
	{
		window.location.replace("index.php");
	}
  }
};
$.datepicker.regional['fr'] = {clearText: 'Effacer', clearStatus: '',
    closeText: 'Fermer', closeStatus: 'Fermer sans modifier',
    prevText: '<Préc', prevStatus: 'Voir le mois précédent',
    nextText: 'Suiv>', nextStatus: 'Voir le mois suivant',
    currentText: 'Courant', currentStatus: 'Voir le mois courant',
    monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin',
    'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
    monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun',
    'Jul','Aoû','Sep','Oct','Nov','Déc'],
    monthStatus: 'Voir un autre mois', yearStatus: 'Voir un autre année',
    weekHeader: 'Sm', weekStatus: '',
    dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
    dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
    dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
    dayStatus: 'Utiliser DD comme premier jour de la semaine', dateStatus: 'Choisir le DD, MM d',
    dateFormat: 'dd/mm/yy', firstDay: 0, 
    initStatus: 'Choisir la date', isRTL: false};
 $.datepicker.setDefaults($.datepicker.regional['fr']);
 
 </script>
<?php
	}
	?>
    </body>
</html>