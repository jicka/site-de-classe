<?php
session_start();


			
if(isset($_SESSION['agorapseudo']) && $_SESSION['admin'] > 3)
{
	include("connectionbasededonnee.php");
	if(isset($_GET['delete_single_account']))
	{
		if (isset($_POST['id']))
		{
			$id = htmlspecialchars(mysql_real_escape_string($_POST['id']));
			$pseudo = htmlspecialchars(mysql_real_escape_string($_POST['pseudo']));
			mysql_query("DELETE FROM comptes WHERE id='$id'")or die(mysql_error());
			if (isset($_GET['eleve']))
			{
				mysql_query("DELETE FROM apprec WHERE pseudo='$pseudo'")or die(mysql_error());
				mysql_query("DELETE FROM sondage WHERE pseudo='$pseudo'")or die(mysql_error());
			}
			?>
			<p style="color:green;">Compte supprimé avec succès.</p>
			<?php
		}
		else
			echo "Erreur!";

	}

	if(isset($_GET['delete_pj']))
	{
		if (isset($_POST['id']))
		{
			$id = htmlspecialchars(mysql_real_escape_string($_POST['id']));
			$retour = mysql_query("SELECT * FROM pieces_jointes WHERE id='$id'")or die(mysql_error());
			$retour = mysql_fetch_array($retour);
			$chemin = "fineUploader/uploads/uploads/" . $retour['nom'];
			unlink($chemin);
			mysql_query("DELETE FROM pieces_jointes WHERE id='$id'")or die(mysql_error());
			?>
			<p style="color:green;">Pièce jointe supprimée avec succès.</p>
			<?php
		}
		else
			echo "Erreur!";

	}
	
	elseif(isset($_GET['reset_rq']))
	{
			mysql_query("DELETE FROM remarques")or die(mysql_error());
			?>
			<section><p style="color:green;">Remarques correctement supprimées.</p></section>
			<?php
	}
	
	elseif(isset($_GET['edit_param_conseils']))
	{
		$exploded_date = explode("/", htmlspecialchars(mysql_real_escape_string($_POST['prochain_conseil'])));
		$prochain_conseil = mktime(0, 0, 0, $exploded_date[1], $exploded_date[0], $exploded_date[2]);
		$peremption_data = mktime(0, 0, 0, $exploded_date[1], ($exploded_date[0]+7), $exploded_date[2]);
		if (htmlspecialchars(mysql_real_escape_string($_POST['orientation_possible'])) == "true")
		{
			$orientation_possible = 1;
		}
		else
		{
			$orientation_possible = 0;
		}
		if (htmlspecialchars(mysql_real_escape_string($_POST['orientation_obligatoire'])) == "true")
		{
			$orientation_obligatoire = 1;
		}
		else
		{
			$orientation_obligatoire = 0;
		}
		if (htmlspecialchars(mysql_real_escape_string($_POST['easter_egg'])) == "true")
		{
			$easter_egg = 1;
		}
		else
		{
			$easter_egg = 0;
		}

		mysql_query("UPDATE param_conseils SET prochain_conseil='$prochain_conseil', orientation_possible='$orientation_possible', orientation_obligatoire='$orientation_obligatoire', peremption_data='$peremption_data', easter_egg='$easter_egg' WHERE id='1'")or die(mysql_error());
		
			?>
			<section><p style="color:green;">Les paramètres ont bien étés enregistrés.</p></section>
			<?php

	}
	elseif (isset($_GET['reset_sondage_counter']))
	{
		mysql_query("UPDATE sondage SET Fait='0'")or die(mysql_error());
		?>
			<span style="color:green;"> Fait !</span>
		<?php
	}
	elseif(isset($_GET['edit_param_site']))
	{
		if (isset($_POST['classe']) && isset($_POST['mail']))
		{
			if (htmlspecialchars(mysql_real_escape_string($_POST['mail_actif'])) == "true")
			{
				$mail_actif = 1;
			}
			else
			{
				$mail_actif = 0;
			}
			$classe = htmlspecialchars(mysql_real_escape_string($_POST['classe']));
			$mail = htmlspecialchars(mysql_real_escape_string($_POST['mail']));
			mysql_query("UPDATE param_site SET classe='$classe', mail='$mail', mail_actif='$mail_actif' WHERE id='1'")or die(mysql_error());
			?>
			<section><p style="color:green;">Les paramètres ont bien étés enregistrés.</p></section>
			<?php
		}
		else
			echo "Erreur!";

	}
	elseif(isset($_GET['reinit_account']))
	{
		if (isset($_POST['id']))
		{
			$id = htmlspecialchars(mysql_real_escape_string($_POST['id']));
			mysql_query("UPDATE comptes SET pass='', first='0' WHERE id='$id'")or die(mysql_error());
			?>
			<p style="color:green;">Compte réinitialisé correctement.</p>
			<?php
		}
		else
			echo "Erreur!";

	}
	elseif(isset($_GET['add_account']))
	{
		$nom = htmlspecialchars(mysql_real_escape_string(ucfirst($_POST['nom'])));
		if (htmlspecialchars(mysql_real_escape_string($_POST['titre'])) == "eleve")
		{
			$prenom = htmlspecialchars(mysql_real_escape_string(ucfirst($_POST['prenom'])));
			$civilite = "";
			$pseudo = $prenom . " " . $nom;
			$admin_level=0;
			mysql_query("INSERT INTO apprec (id, pseudo, felicitations, compliments, encouragements, avert_travail, avert_conduite, apprec, moyenne) VALUES ('', '$pseudo', '', '', '', '', '', '', '')")or die(mysql_error());
			mysql_query("INSERT INTO sondage (id, pseudo, Fait, orientation, certitude) VALUES ('', '$pseudo', '', '', '')")or die(mysql_error());
		}
		else
		{
			$prenom = "";
			$civilite = $_POST['civilite'];
			$pseudo = $civilite . " " . $nom;
			$admin_level=2;
		}
		$titre = htmlspecialchars(mysql_real_escape_string($_POST['titre']));
		mysql_query("INSERT INTO comptes (id, prenom, nom, mail, type, admin, numero, pass, first, pseudo, news, mail_ok, mail_public) VALUES ('', '$prenom', '$nom', '', '$titre', '$admin_level', '0', '', '0', '$pseudo', '0', '0', '')")or die(mysql_error());
		echo "<p style='color:green'>Vous avez ajouté le compte de " . $pseudo . " avec succès</p>";
	}
	if(isset($_GET['edit_base']))
	{
		if(isset($_POST['id']))
		{
			$prenom = "";
			$nom = "";
			$mail = "";
			$pseudo = "";
			$mail_public = "";
			$admin = 0;
			if(isset($_POST['prenom']))
			{
				$prenom = mysql_real_escape_string($_POST['prenom']);
			}
			if(isset($_POST['nom']))
			{
				$nom = mysql_real_escape_string($_POST['nom']);
			}
			if(isset($_POST['mail']))
			{
				$mail = mysql_real_escape_string($_POST['mail']);
			}
			if(isset($_POST['mail_public']))
			{
				$mail_public = mysql_real_escape_string($_POST['mail_public']);
			}
			if(isset($_POST['admin']))
			{
				$admin = htmlspecialchars(mysql_real_escape_string($_POST['admin']));
			}
			if(isset($_POST['pseudo']))
			{
				$pseudo = mysql_real_escape_string($_POST['pseudo']);
			}
			$type = htmlspecialchars(mysql_real_escape_string($_POST['type']));
			$id = htmlspecialchars(mysql_real_escape_string($_POST['id']));
			mysql_query("UPDATE comptes SET prenom='$prenom', nom='$nom', mail='$mail', admin='$admin', mail_public='$mail_public', type='$type', pseudo='$pseudo' WHERE id='$id'")or die(mysql_error());
			if (htmlspecialchars(mysql_real_escape_string($_POST['type'])) == "eleve")
			{
				$old_pseudo = htmlspecialchars(mysql_real_escape_string($_POST['old_pseudo']));
				mysql_query("UPDATE sondage SET pseudo='$pseudo' WHERE pseudo='$old_pseudo'")or die(mysql_error());
				mysql_query("UPDATE apprec SET pseudo='$pseudo' WHERE pseudo='$old_pseudo'")or die(mysql_error());
			}
			?>
			<p style="color:green;">Modifications enregistrées.</p>
			<?php
		}
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