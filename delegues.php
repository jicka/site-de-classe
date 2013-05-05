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
			
			if(isset($_SESSION['agorapseudo']) && $_SESSION['admin'] > 2)
			{
				include("connectionbasededonnee.php");
				// Chargement des différentes pages
				if(isset($_GET['voir_rq_conseil']))
				{
					?>
                   <p style="font-size:.7em;"><a href="index.php">Accueil</a> / <a href="#" class="lien_accueil_delegues">Page de délégués</a> / Remarques pour le conseil de classe</p>
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
                    <p style="font-size:.7em;"><a href="index.php">Accueil</a> / <a href="#" class="lien_accueil_delegues">Page de délégués</a> / Souhaits d'orientation</p>
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
				elseif(isset($_GET['admin_see_all_db']))
				{
					
					?>
                    <p style="font-size:.7em;"><a href="index.php">Accueil</a> / <a href="#" class="lien_accueil_delegues">Page de délégués</a> / Informations sur les comptes</p>
                    <?php
					$retour = mysql_query("SELECT * FROM comptes")or die(mysql_error());
					?>
                    <table><thead><tr>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Mail</th>
                    <th>Première Connexion</th>
                    <th>Type</th>
                    <th>Mail Public</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
					while ($donnees = mysql_fetch_array($retour))
					{
						?>
						<tr>
                        <td><?php if($donnees['type']== "eleve"){  echo $donnees['prenom'];  } else {  echo strtok($donnees['pseudo'], " "); } ?></td>
                        <td><?php echo $donnees['nom']; ?></td>
                        <td><?php echo $donnees['mail']; ?></td>
                        <td><?php if($donnees['first'] == "1"){ echo "<div style='color:green;'>Effectuée</div>"; } else { echo "<div style='color:red;'>En attente</div>"; } ?></td>
                        <td><?php echo $donnees['type']; ?></td>
                        <td><?php echo $donnees['mail_public']; ?></td>
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
                    <p style="font-size:.7em;"><a href="index.php">Accueil</a> / Page de délégués</p>
					<p>De cette page, il vous est possible d'accéder à certaines informations utiles pour les délégués. Vous pouvez:</p>
					<ul>
                    <li><a href="#" id="remplir_apprec">Remplir les appréciations des élèves</a></li>
					<li><a href="#" id="delegues_see_all_db">Voir les informations de la classe (Mails, abonnements,...)</a></li>
					<li><a href="#" id="delegues_voir_rq_conseil">Voir les remarques pour le conseil de classe</a></li>
					<li><a href="#" id="delegues_voir_orientations">Voir les choix d'orientation des élèves</a></li>
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

		</section>
	</div>
</body>
</html>