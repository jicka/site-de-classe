<?php
	session_start();
?>
<!-- Session démarée, on commence le HTML(5)!-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
</head>
<body>
		<section>
        <p style="font-size:.7em;"><a href="index.php">Accueil</a> / Voir son appréciation</p>
			<?php
			
			if(isset($_SESSION['agorapseudo']))
			{	
				$bouya = 0;
				if (isset($_GET['submit']))
				{
					include("connectionbasededonnee.php");
					
					$comptes = mysql_query("SELECT * FROM comptes") or die(mysql_error());
					$pass = htmlspecialchars(mysql_real_escape_string($_POST['pass']));
					if (!isset($_POST['already_md5']))
					{
						$pass = hash("sha512", md5($pass));
					}
					while ($comptes_array = mysql_fetch_array($comptes))
					{
						if ($comptes_array['pseudo']== $_SESSION['pseudo'] )
						{
							if ($pass == $comptes_array['pass'])
							{
								$bouya = 1;
							}
						}
					}
					if ($bouya == 1)
					{
						$apprec = mysql_query("SELECT * FROM apprec WHERE pseudo='{$_SESSION['pseudo']}'") or die(mysql_error());
						$apprec = mysql_fetch_array($apprec);
						if ($apprec['apprec'] != "")
						{
							?>
                            <p>Voici en quelques mots l'appréciation du conseil de classe:<br />
                            <?php
							echo $apprec['apprec'];
							if ($apprec['felicitations'] == "1")
							{
								echo "<div style='color:green'>Vous avez eu les félicitations du conseil de classe!</div>";
							}
							if ($apprec['compliments'] == "1")
							{
								echo "<div style='color:green'>Vous avez eu les compliments du conseil de classe!</div>";
							}
							if ($apprec['encouragements'] == "1")
							{
								echo "<div style='color:green'>Vous avez eu les encouragements du conseil de classe!</div>";
							}
							if ($apprec['avert_conduite'] == "1")
							{
								echo "<div style='color:red'>Vous avez eu un avertissement concernant votre conduite!</div>";
							}
							if ($apprec['avert_travail'] == "1")
							{
								echo "<div style='color:red'>Vous avez eu un avertissement concernant votre travail!</div>";
							}
							if ($apprec['moyenne'] != "")
							{
								echo "Moyenne indicative: " . $apprec['moyenne'];
							}
							?>
                            <br /><br />
                        <br /><br />
                        <div style="color:grey">Ces informations n'ont rien de définitif, il est possible qu'elles soient érronnées. Pour plus d'infos, rendez vous demain avec vos délégués.</div>
                        </p>
						<?php
						}
						else
						{
							$easter_egg = mysql_query("SELECT * FROM param_conseils WHERE id='1'") or die(mysql_error());
							$easter_egg = mysql_fetch_array($easter_egg);
							?>
                            <p class="texte_center">
                            <input type="button" class="actualiser_apprec" value="Actualiser"/><br />
                            <script type="text/javascript">
							var pass = "<?php echo $pass; ?>";
							</script>
                            <img src="ressources/pacman.gif" alt="" class="tournee"/>OOOooooops!<img src="ressources/pacman.gif" alt="" /><br />
                            Il semblerait que l'appréciations n'ait pas encore été saisie...</p>
                            <?php 
							if ($easter_egg['easter_egg'])
							{
							?>
                                <p>Vous avez probablement encore le temps de vous faire une orangeade avant que les appréciations ne soient saisies!<br />Si vous vous ennuyez, occupez vous <a href="#" id="afficher_pacman">!</a><br /> <div style="font-size:0.7em;">(Attention, l'abus d'orangeade est dangereux pour la santé, à consommer avec modération...)</div></p>
								<div id="surprise_pacman"><?php
								include("pacman.html");
								?>
                                </div>
								<script type="text/javascript">
  									$('#surprise_pacman').hide();
								</script>
								<?php
							}
						}
						?>
                        
                        <?php
					}
					else
					{
						?>
                        <p style="color:red;">Une erreur est survenue dans les tuyaux! Le plombier est contacté. Vous avez peut-être entré le mauvais mot de passe...</p>
                        <?php
					}
				}
					
				if ($bouya == 0)
				{
					?>
					<p>Bienvenue! Vous pouver accéder à vos appréciations!</p>
					<form>
					<p>Veuillez retaper votre mot de passe: <input type="password" id="voir_apprec_form_pass"/></p>
					<input type="button" value="Voir l'appréciation" id="voir_apprec_form"/>
					</form>
					<?php
					include("connectionbasededonnee.php");
                    $tmp = mysql_query("SELECT * FROM apprec")or die(mysql_error());
					$fels = 0;
					$encouragements = 0;
					$compliments = 0;
					$averts = 0;
					$completed = 0;
					$i = 0;
					$u = 0;
					while ($eleve = mysql_fetch_array($tmp))
					{
						$i++;
						if ($eleve['felicitations'] == '1')
						{
							$fels++;
						}
						if ($eleve['encouragements'] == '1')
						{
							$encouragements++;
						}
						if ($eleve['compliments'] == '1')
						{
							$compliments++;
						}
						if ($eleve['avert_conduite'] == '1' || $eleve['avert_travail'] == '1')
						{
							$averts++;
						}
						if ($eleve['apprec'] != "")
						{
							$completed = 1;
							$u++;
						}
					}
					if ($completed == 1)
					{
						?>
                    	<p>Statistiques sur le conseil:
                    	<br />En tout, lors du conseil, et sur le total d'appréciations saisies pour l'instant (<?php echo $u . "/" . $i; ?>), il y a:<br />
                        <ul>
                        <li><?php echo $fels; ?> félicitation<?php if ($fels != 1){ ?>s<?php } ?> (<?php echo round((($fels)/($u))*100); ?>%)</li>
                        <li><?php echo $encouragements; ?> encouragement<?php if ($encouragements != 1){ ?>s<?php } ?> (<?php echo round((($encouragements)/($u))*100); ?>%)</li>
                        <li><?php echo $compliments; ?> compliment<?php if ($compliments != 1){ ?>s<?php } ?> (<?php echo round((($compliments)/($u))*100); ?>%)</li>
                        <li><?php echo $averts; ?> avertissement<?php if ($averts != 1){ ?>s<?php } ?> (<?php echo round((($averts)/($u))*100); ?>%)</li>
                        </ul>
                    	</p>
                    	<?php
					}
				}
			}
			else
			{
				?>
                <!--Si on est pas connecté, ba ya le formulaire de connexion.-->
    			<img src="ressources/connexion.png" class="conexion" alt="connexion"/>
    			<?php
				include('connection.php');
			}
			?>
            
		</section>
	</div>
</body>
</html>