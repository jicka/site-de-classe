<?php
session_start(); // On démarre la session AVANT toute chose
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Modifier son profil</title>
</head>
<body>
<section>
<p style="font-size:.7em;"><a href="index.php">Accueil</a> / Modifier son profil</p>
<?php
include('connectionbasededonnee.php');
//--------------------------------------------------------
// Verification : est-ce qu'on veut modofier ses données?
//--------------------------------------------------------
if (isset($_POST['mail'], $_POST['pass'], $_POST['repass']))
{
		$pseudo=$_SESSION['agorapseudo'];
		$mail = mysql_real_escape_string($_POST['mail']);
		$pass = mysql_real_escape_string($_POST['pass']);
		$repass = mysql_real_escape_string($_POST['repass']);
		if(htmlspecialchars(mysql_real_escape_string($_POST['news'])) == "true")
		{
			$news = 1;
		}
		else
		{
			$news = 0;
		}
		if(isset($_POST['mail_ok']) && htmlspecialchars(mysql_real_escape_string($_POST['mail_ok'])) == "true")
		{
			$mail_ok = "on";
		}
		else
		{
			$mail_ok = "";
		}
		if(isset($_POST['mail_public']))
		{
			$mail_public = htmlspecialchars(mysql_real_escape_string($_POST['mail_public']));
		}
		else
		{
			$mail_public = "";
		}
		if ($pass==NULL)
		{
			mysql_query("UPDATE comptes SET mail='$mail', mail_ok='$mail_ok', news='$news', mail_public='$mail_public'  WHERE pseudo='$pseudo' ")or die(mysql_error());
		}
		elseif ($pass==$repass)
		{
			$pass = hash("sha512", md5($pass));
			mysql_query("UPDATE comptes SET mail='$mail', pass='$pass', mail_ok='$mail_ok', news='$news', mail_public='$mail_public' WHERE pseudo='$pseudo' ")or die(mysql_error());
		}
		else
		{
			echo "<p class='rouge'>Le mot de passe et le mot de passe de vérification ne correspondent pas!.</p>";
			$error = 1;
		}
		if (!isset($error) || $error ==0)
		{
		?>
        <p class="vert">Les modifications ont correctement été enregistrées.</p>
        <?php
		}
}
if (isset($_GET['modifier_profil'], $_GET['afficher_profil']))
{
	if ($_SESSION['agorapseudo']!=NULL)
	{
		echo 'Acceder à vos données : ';
		echo $_SESSION['agorapseudo'];
		?>
		    <form action="modifier_profil.php?pseudo=<?php echo $_SESSION['agorapseudo']; ?>&modifier=1" method="post">
            <input type="submit" value="Accéder" />
            </form>
        <?php
	}
	?>
	<p>
		<form action="modifier_profil.php?" method="get">
        voir les infos de: <input type="text" name="pseudo" /><input type="hidden" name="afficher" value="1" />
        <input type="submit" value="Voir" />
        </form>
		</p>
    <?php

}
else
{


	if (isset ($_GET['afficher']) && $_GET['afficher']!=NULL)
	{
		$donnees=mysql_query('SELECT * FROM comptes WHERE pseudo=\'' . htmlspecialchars(mysql_real_escape_string($_GET['pseudo'])) . '\' ')or die(mysql_error());
		$donnees=mysql_fetch_array($donnees);
		$donnees['prenom']=stripslashes($donnees['prenom']);
		$donnees['nom']=stripslashes($donnees['nom']);
		$donnees['mail']=stripslashes($donnees['mail']);
		?>
    	<p>pseudo: <?php echo $donnees['pseudo'];?><br />
    	prenom: <?php
		echo $donnees['prenom'];
   	 	?>
   	 	<br />nom: <?php
		echo $donnees['nom'];
    	?>
    	<br />mail: <?php if($donnees['mail_ok']=='on')
		{
			echo $donnees['mail'];
		}
		else
		{
			echo 'Ne souhaite pas la rendre publique';
		}
		?>
	
    	</p>
    	<?php
		}
	else
	{
		$donnees=mysql_query('SELECT * FROM comptes WHERE pseudo=\'' . $_SESSION['pseudo'] . '\' ')or die(mysql_error());
		$donnees=mysql_fetch_array($donnees);
		?>
        
        	<form action="modifier_profil.php?poster=parametres" method="post" id="modifier_profil_form">
			<p>Nom : <?php echo $donnees['pseudo'];?></p>
			<p>nouveau mot de passe : <input type="password" size="30" name="pass"id="modifier_profil_form_pass" /></p>
			<p>retapez le mot de passe : <input type="password" size="30" name="repass" id="modifier_profil_form_repass"/></p>
			<p>mail : <input type="email" size="35" id="modifier_profil_form_mail" name="mail" value="<?php echo $donnees['mail'];?>" />
			<?php 
			if ($donnees['mail_ok'] == "on" && $donnees['admin'] > 1)
			{ ?>
            <p>mail public : <input type="email" size="35" id="modifier_profil_form_mail_public" name="mail_public" value="<?php echo $donnees['mail_public'];?>" />
            <input type="checkbox" name="mail_ok" id="modifier_profil_form_mail_ok" checked="checked" /> <label for="modifier_profil_form_mail_ok">Activé</label><br /></p>
                            Le mail public, si activé, sera disponible sur la page de contact, à la vue de tous les élèves et professeurs de la classe. Le mail "normal" n'est utilisé que pour recevoir les news, si vous le souhaitez.

            <?php } 
			elseif ($donnees['admin'] > 1)
			{
				?>
                <p>mail public : <input type="email" size="35" id="modifier_profil_form_mail_public" name="mail_public" value="<?php echo $donnees['mail_public'];?>" />
                <input type="checkbox" name="mail_ok" id="modifier_profil_form_mail_ok" /> <label for="modifier_profil_form_mail_ok">Activé</label><br /></p>
                Le mail public, si activé, sera disponible sur la page de contact, à la vue de tous les élèves et professeurs de la classe. Le mail "normal" n'est utilisé que pour recevoir les news, si vous le souhaitez.
                
<?php
			}
			
			
			if ($donnees['news'] == 1)
			{ ?>
            <p><input type="checkbox" name="news" id="modifier_profil_form_news" checked="checked"/> <label for="modifier_profil_form_news">Recevoir les news par mail.</label><br /></p>
            <?php } 
			else
			{
				?>
            <p><input type="checkbox" name="news" id="modifier_profil_form_news" /> <label for="modifier_profil_form_news">Recevoir les news par mail.</label><br /></p>
				<?php
			}
			?>
            <input type="button" value="Enregistrer" class="modifier_profil_form_submit"/>
    		</form>
        <?php
	}
}
?>
</section>


</body>

</html>
