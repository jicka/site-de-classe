<?php
if(isset ($_GET['connect']))
{
	if (isset($_POST['prenom']) AND isset($_POST['nom'])) // Si les variables existent
	{
		include("connectionbasededonnee.php");
		$comptes = mysql_query("SELECT * FROM comptes") or die(mysql_error());
		while ($comptes_array = mysql_fetch_array($comptes))
		{
			if (strtoupper($comptes_array['prenom'])== strtoupper(mysql_real_escape_string($_POST['prenom'])) && strtoupper($comptes_array['nom'])== strtoupper(mysql_real_escape_string($_POST['nom'])) )
			{
				if ($comptes_array['first'] == 0 AND !isset($_GET['add']))
				{
					?><div class="noir">
                    <div style="text-align:center; margin:auto;">
                    Comme il s'agit de ta première connexion, choisis ton mot de passe.<br />
  
  <form action="connection.php?add=pass&connect=1" method="post" id="form_premiere_connexion">
					Nom :  <input type="text" disabled="disabled" value="<?php echo htmlspecialchars(mysql_real_escape_string($_POST['nom'])); ?>"/><br />
					Prénom :  <input type="text" disabled="disabled" value="<?php echo htmlspecialchars(mysql_real_escape_string($_POST['prenom'])); ?>"/>
					<input type="hidden" value="<?php echo mysql_real_escape_string($_POST['nom']); ?>" name="nom" />
					<input type="hidden" value="<?php echo mysql_real_escape_string($_POST['prenom']); ?>" name="prenom" /><br />
					mot de passe :  <input type="password" id="pass" name="pass" /><br />
					validation     :  <input type="password" id="repass" name="repass" /><br />
                    <input type="hidden" value="12345688" name="ahahaha" /><br />
					<input type="submit" value="Envoyer" />
                    
					</form>
					  </div></div>
<?php					  $termine=1;

				}
				elseif (isset($_GET['add']))
				{
					if (mysql_real_escape_string($_POST['pass']) == mysql_real_escape_string($_POST['repass']) AND htmlspecialchars(mysql_real_escape_string($_POST['ahahaha'])) == 12345688)
					{
					  session_start(); // On démarre la session AVANT toute chose
					  $_SESSION['prenom'] = $comptes_array['prenom'];
					  $_SESSION['pseudo'] = $comptes_array['pseudo'];
					  $_SESSION['agorapseudo'] = $comptes_array['pseudo'];
					  $_SESSION['nom'] = $comptes_array['nom'];
					  $_SESSION['admin'] = $comptes_array['admin'];
					  if (isset($_POST['souvenir']))
					  {
					  	setcookie('prenom_classe_ts1', "{$comptes_array['prenom']}", time() + 30*24*3600, null, null, false, true);
					  	setcookie('nom_classe_ts1', "{$comptes_array['nom']}", time() + 30*24*3600, null, null, false, true);
					  }
					  else
					  {
					  	setcookie('prenom_classe_ts1', "", time() + 30*24*3600, null, null, false, true);
					  	setcookie('nom_classe_ts1', "", time() + 30*24*3600, null, null, false, true);
					  }
					  $pass = hash("sha512", md5(htmlspecialchars(mysql_real_escape_string($_POST['pass']))));
					  mysql_query("UPDATE comptes SET pass='$pass', first=1 WHERE id='{$comptes_array['id']}' ") or die(mysql_error());
					  echo"Vous vous connectez au compte: ";
					  echo $comptes_array['prenom'] . " " . $comptes_array['nom'] . " ...";
					  $termine=1;
					  echo "<br />OK";
					  
					  ?>
						  <script language="javascript" type="text/javascript">
                          <!--
                          window.location.replace("index.php");
                          -->
                          </script>
					  <?php
					}
					else
					{
						echo "<section style='color:red;'>Le mot de passe de vérification ne correspond pas!</section>";
					}
				}
				else
				{
					if (hash("sha512", md5(htmlspecialchars(mysql_real_escape_string($_POST['pass'])))) == $comptes_array['pass'])
					{
					  session_start(); // On démarre la session AVANT toute chose
					  $_SESSION['prenom'] = $comptes_array['prenom'];
					  $_SESSION['pseudo'] = $comptes_array['pseudo'];
					  $_SESSION['agorapseudo'] = $comptes_array['pseudo'];
					  $_SESSION['nom'] = $comptes_array['nom'];
					  $_SESSION['admin'] = $comptes_array['admin'];
					  if (isset($_POST['souvenir']))
					  {
					  	setcookie('prenom_classe_ts1', "{$comptes_array['prenom']}", time() + 30*24*3600, null, null, false, true);
					  	setcookie('nom_classe_ts1', "{$comptes_array['nom']}", time() + 30*24*3600, null, null, false, true);
					  }
					  else
					  {
					  	setcookie('prenom_classe_ts1', "", time() + 30*24*3600, null, null, false, true);
					  	setcookie('nom_classe_ts1', "", time() + 30*24*3600, null, null, false, true);
					  }
					echo"Vous vous connectez au compte: ";
					echo $comptes_array['prenom'] . " " . $comptes_array['nom'] ;
					$termine=1;
					$redir = '';
					if (isset($_GET['redir']))
					{
						if (isset($_GET['get_name']))
						{
							$redir = "?redir=" . $_GET['redir'] . "&get_name=" . $_GET['get_name'] . "&get_val=" . $_GET['get_val'];
						}
						else
						{
							$redir = "?redir=" . $_GET['redir'];
						}
					}
					?>
						<script language="javascript" type="text/javascript">
                        <!--
                        window.location.replace("index.php<?php echo $redir; ?>");
                        -->
                        </script>
					<?php
					}
					else
					{
						?> <section style="color:red">Erreur de mot de passe!</section> <?php
					}
				}
			}
		}	
	mysql_close();
	}
}
// Et SEULEMENT MAINTENANT, on peut commencer à écrire du code html
if (!isset($_GET['included']))
{
	?>
    <!DOCTYPE html>
	<html>
	<head>
	<title>Site de la classe!</title>
	<meta charset="utf-8" />
    <link href="rasta_new.css" rel="stylesheet" type="text/css" />
    <link rel="icon" type="image/png" href="ressources/icon.png" />
	</head>
	<body>
    <section>

    <?php
}
?>
<div class="noir">
<div class="center">
<?php
if (!isset($_SESSION['agorapseudo']) AND !isset($termine))
{
	if (isset($_COOKIE['nom_classe_ts1']))
	{
		$cookie_nom = $_COOKIE['nom_classe_ts1'];
		$cookie_prenom = $_COOKIE['prenom_classe_ts1'];
	}
	else
	{
		$cookie_nom = "";
		$cookie_prenom = "";
	}
		?><div class="noir">
        <?php
		$redir = '';
		if (isset($_GET['redir']))
		{
			
			if (isset($_GET['get_name']))
			{
				$redir = "&redir=" . $_GET['redir'] . "&get_name=" . $_GET['get_name'] . "&get_val=" . $_GET['get_val'];
			}
			else
			{
				$redir = "&redir=" . $_GET['redir'];
			}
		}
		?>
		<form action="connection.php?connect=1<?php echo $redir; ?>" method="post">
		<div style="text-align:center; margin:auto;">
        <?php
		if (!isset($_COOKIE['nom_classe_ts1']))
		{
			?>
            S'il s'agit de votre première connexion, n'entrez pas de mot de passe.<br />
			<?php
		}
		?>
        Type de compte: <select name="titre" id="titre">
			<option value="eleve">Elève</option>
			<option value="prof">Professeur</option>
        </select><br />

		<div id="prenom">Prenom : <input type="text" value="<?php echo $cookie_prenom; ?>" id="champ_prenom" name="prenom" /><br /></div>
        Nom : <input type="text" id="nom" name="nom"  required="required" value="<?php echo $cookie_nom; ?>" /><br />
		Mot de passe :  <input type="password" name="pass"/><br />
        <input type="checkbox" name="souvenir" id="souvenir" checked /><label for="souvenir"> Se souvenir de l'identifiant.</label><br />
		<input type="submit" value="Envoyer" />
		</div>
		</form></div>
        
        <div class="help">Pensez à mettre des majuscules, notemment si votre nom est composé.<br />
        Enfin, si vous ne connaissez plus votre mot de passe, demandez à celui qui s'occupe du site de réinitialiser le mot de passe.</div>
        <a href="#" id="connexion_help"><img src="ressources/help.png" alt="Problèmes lors de la connexion?"/></a>
		<?php
}
?>
</div>
</div>
	<script src="jquery.js"></script>

<script type="text/javascript">
$('.help').hide();
	$(function() {
		$('#connexion_help').click(function() {
			$('#connexion_help').hide(500);
			$('.help').show(700);
			
		  });
});

 $(function(){
          $("#titre").change(function(){
            $("option:selected", $(this)).each(function(){
                var obj = document.getElementById('titre').value;
                if (obj == "prof")
				{
					$('#prenom').hide(750);
					$('#champ_prenom').val('');
				}
				else
				{
					$('#prenom').show(750);
				}

            });
          });
        });
</script>
<div id="noRedir" style="visibility:hidden">BlaBlabla</div>

<?php
if (!isset($_GET['included']))
{
	?>
    </section>
    </body>
    </html>
	<?php
}
?>