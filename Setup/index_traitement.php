<?php
				include("../connectionbasededonnee.php");
				if(isset($_GET['step']) && $_GET['step'] == "1")
				{
					function run_sql_file($location){
					//load file
					$commands = file_get_contents($location);
										
					//convert to array
					$commands = explode(";", $commands);
					
					//run commands
					$total = $success = 0;
					foreach($commands as $command){
						if(trim($command)){
							$success += (@mysql_query($command)==false ? 0 : 1);
							$total += 1;
						}
					}
					
					//return number of successful queries and total number of queries found
					return array(
						"success" => $success,
						"total" => $total
					);
					}
					run_sql_file("setup_tables.sql");
					?>
                    <span style="color:green;">Terminé !</span>
                    <?php
				}
				elseif(isset($_GET['step']) && $_GET['step'] == "2")
				{
					// Avant d'ajouter le compte, on vide bien toutes les tables:
					mysql_query("TRUNCATE TABLE apprec") or die(mysql_error());
					mysql_query("TRUNCATE TABLE sondage") or die(mysql_error());
					mysql_query("TRUNCATE TABLE comptes") or die(mysql_error());
					mysql_query("TRUNCATE TABLE news") or die(mysql_error());
					mysql_query("TRUNCATE TABLE remarques") or die(mysql_error());
					mysql_query("TRUNCATE TABLE param_site") or die(mysql_error());
					mysql_query("TRUNCATE TABLE param_conseils") or die(mysql_error());
					$time = time() - 60*60*24*7;
					$time_peremption = time();
					mysql_query("INSERT INTO param_conseils (id, prochain_conseil, orientation_possible, orientation_obligatoire, peremption_data, easter_egg, last_deletion) VALUES ('1', '$time', '0', '0', '$time_peremption', '1', '0')") or die(mysql_error());
					mysql_query("INSERT INTO param_site (id, is_conf_ok, classe, mail, mail_actif) VALUES ('1', '0', '', '', '1')") or die(mysql_error());
					// On crée le premier compte admin
					$admin_level=4;
					$nom = ucfirst($_POST['nom']);
					$pass = hash("sha512", md5($_POST['pass']));
					if ($_POST['titre'] == "eleve")
					{
						$prenom = ucfirst($_POST['prenom']);
						$civilite = "";
						$pseudo = $prenom . " " . $nom;
						mysql_query("INSERT INTO apprec (id, pseudo, felicitations, compliments, encouragements, avert_travail, avert_conduite, apprec, moyenne) VALUES ('', '$pseudo', '', '', '', '', '', '', '')")or die(mysql_error());
						mysql_query("INSERT INTO sondage (id, pseudo, Fait, orientation, certitude) VALUES ('', '$pseudo', '', '', '')")or die(mysql_error());
					}
					else
					{
						$prenom = "";
						$civilite = $_POST['civilite'];
						$pseudo = $civilite . " " . $nom;
					}
					mysql_query("INSERT INTO comptes (id, prenom, nom, mail, type, admin, numero, pass, first, pseudo, news, mail_ok, mail_public) VALUES ('', '$prenom', '$nom', '', '{$_POST['titre']}', '$admin_level', '0', '$pass', '1', '$pseudo', '0', '0', '')")or die(mysql_error());
					?>
                    <span style="color:green">Terminé !</span>
                    <?php
				}
				elseif(isset($_GET['step']) && $_GET['step'] == "3")
				{
					if ($_POST['mail_actif'] == "true")
					{
						$mail_actif = 1;
					}
					else
					{
						$mail_actif = 0;
					}

					mysql_query("UPDATE param_site SET is_conf_ok='1', classe='{$_POST['classe']}', mail='{$_POST['mail_admin']}', mail_actif='$mail_actif'")or die(mysql_error());
					?>
                    <span style="color:green">Terminé !</span>
                    <?php
				}
			?>
            
