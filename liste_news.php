<?php
session_start();
?>
<!DOCTYPE html>
<html>
   <head>
   
<title>Liste des news</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

   </head>
    
    <body>
<section>
<p style="font-size:.7em;"><a href="index.php">Accueil</a> / Liste des news</p>
<?php
include('connectionbasededonnee.php');
$infos_classe = mysql_query("SELECT * FROM param_site WHERE id='1'") or die(mysql_error());
$infos_classe = mysql_fetch_array($infos_classe);
//
// Verification 1 : est-ce qu'on veut poster une news ?
//
if (isset($_POST['titre']) AND isset($_POST['contenu']))
{
    $titre = addslashes(htmlspecialchars(mysql_real_escape_string($_POST['titre'])));
    $contenu = mysql_real_escape_string($_POST['contenu']);
    // On verifie si c'est une modification de news ou pas
    if (htmlspecialchars(mysql_real_escape_string($_POST['id_news'])) == 0)
    {
        // Ce n'est pas une modification, on cree une nouvelle entree dans la table
		$time = time();
          mysql_query("INSERT INTO news(id,titre,contenu,timestamp,auteur,valide) VALUES('', '$titre', '$contenu', '$time', '{$_SESSION['pseudo']}', '1')")or die(mysql_error());
		// Ajout des pièces jointes
		 $id_last_news = mysql_query("SELECT * FROM news WHERE auteur='{$_SESSION['pseudo']}' AND titre='$titre' ORDER BY id DESC LIMIT 0, 1") or die(mysql_error());
		 $id_last_news = mysql_fetch_array($id_last_news);
		 $pieces_jointes_brut = mysql_query("SELECT * FROM pieces_jointes WHERE id_news='0'") or die(mysql_error());
		 while ($pieces_jointes = mysql_fetch_array($pieces_jointes_brut))
		 {
			 mysql_query("UPDATE pieces_jointes SET id_news='{$id_last_news['id']}' WHERE id='{$pieces_jointes['id']}' ")or die(mysql_error());
		 }
		 
		 
		 
		$retour = mysql_query("SELECT id FROM news WHERE titre='$titre' ")or die(mysql_error());
$donnees = mysql_fetch_array($retour); // On fait une boucle pour lister les news
?>
<br />
<?php
if (isset($_POST["rediger_news_form_mail"]) && htmlspecialchars(mysql_real_escape_string($_POST["rediger_news_form_mail"])) =="true")
{
	
// ...................................................................................................
// ...................................................................................................
// ...................................................................................................
// ...................................................................................................
?>
<br />

<?php
$temp_data = mysql_query("SELECT * FROM comptes WHERE news=1")or die (mysql_error());
$i = 0;
while ($data = mysql_fetch_array($temp_data))
{
	if ($i == 0)
	{
		$destinataire = $data['mail'];
		$i++;
	}
	else
	{
		$destinataire .= ", " . $data['mail'];
	}
}
$i=0;
//=====Les variables
$sujet = utf8_decode(stripcslashes($titre));
$message_html = "<html>
      <head>
	  <meta charset='utf-8' />
	  <style>
	  body
		{
			font-family: 'Arbutus Slab', serif;
		}
		
        </style>
       <title>". htmlspecialchars($_POST['titre']) ."</title>
      </head>
      <body><div class='corps1'>De ". $_SESSION['agorapseudo'] . ".<br />" . $_POST['contenu'] . "</div></body>
     </html>";

//==========


//=====Création du header de l'e-mail
	$headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

    // En-têtes additionnels
    $headers .= 'From: '. $infos_classe['mail'] . "\r\n";
	//==========
	 mail($destinataire, $sujet, $message_html, $headers);
}
	}
    else
    {
	    if((htmlspecialchars(mysql_real_escape_string($_POST['valide'])))=='oui')
	    {
			// On protege la variable "id_news" pour eviter une faille SQL
       		 $_POST['id_news'] = htmlspecialchars(mysql_real_escape_string(addslashes($_POST['id_news'])));
        	// C'est une modification, on met juste a jour le titre et le contenu
        	mysql_query("UPDATE news SET valide='oui', titre='" . $titre . "', contenu='" . $contenu . "' WHERE id='" . $_POST['id_news'] . "'")or die(mysql_error());

	    }
	    else
	    {
        // On protege la variable "id_news" pour eviter une faille SQL
        $_POST['id_news'] = addslashes(htmlspecialchars(mysql_real_escape_string($_POST['id_news'])));
        // C'est une modification, on met juste a jour le titre et le contenu
        mysql_query("UPDATE news SET titre='" . $titre . "', contenu='" . $contenu . "' WHERE id='" . $_POST['id_news'] . "'")or die(mysql_error());
	    }
    }
}
 
//
// Verification 2 : est-ce qu'on veut supprimer une news ?
//
if (isset($_GET['supprimer_news'])) // Si on demande de supprimer une news
{
    // Alors on supprime la news correspondante
    // On protege la variable "id_news" pour eviter une faille SQL
    $_GET['supprimer_news'] = addslashes(htmlspecialchars(mysql_real_escape_string($_GET['supprimer_news'])));
    mysql_query('DELETE FROM news WHERE id=\'' . $_GET['supprimer_news'] . '\'')or die(mysql_error());
}
?>
<?php
//
//           affichage de toutes les news
//

if ($_SESSION['admin'] > 1) { ?> <h2><a href="#" class="lien_rediger_news">Ajouter une news</a></h2><?php } ?>
<h2>toutes les news</h2>
<table><thead><tr>
<th>afficher</th>
<th>Titre</th>
<th>Date</th>
</tr>
</thead>
<tbody>
<?php
$pseudo=$_SESSION['pseudo'];
$retour = mysql_query('SELECT * FROM news ORDER BY id DESC')or die(mysql_error());
$i=0;
while ($donnees = mysql_fetch_array($retour)) // On fait une boucle pour lister les news
{
	$i++;
?>
<tr>
<td><a href="#" onclick="afficher_news (<?php echo $donnees['id']; ?>);">afficher</a></td>
<td><?php echo stripslashes($donnees['titre']); ?></td>
<td><?php echo date('d/m/Y', $donnees['timestamp']); ?></td>

</tr>
<?php
} // Fin de la boucle qui liste toutes les news
?>
</tbody>
</table>
<div id="afficher_news_nombre_news" style="visibility:hidden"><?php echo $i; ?></div>
<br />
</section>
<script type="text/javascript">
function afficher_news (news_id) {
			debut_chargement ()
			history.pushState({page: current_page}, "", "?redir=afficher_news&get_name=news&get_val=" + news_id);
			$('#updater').load('afficher_news.php?news=' + news_id, function() {
				current_page = "afficher_news.php?news=" + news_id;
				fin_chargement ()		  


			});
    };
</script>
</body>
</html>

