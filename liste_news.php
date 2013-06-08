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
  $pageURL = 'http';
  if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
  $pageURL .= "://";
  if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
  } else {
  $pageURL .= $_SERVER["SERVER_NAME"];
  }

	$pj_brut = mysql_query("SELECT * FROM pieces_jointes WHERE id_news='{$id_last_news['id']}'")or die(mysql_error());
	if (mysql_num_rows($pj_brut) > 0)
	{
	  $texte_pj = "
	  <hr style='margin:15px;' />
	  <p><em>Pièces jointes:</em>
	  <ul>";
	  while ($pj = mysql_fetch_array($pj_brut))
	  {
		  
		  $texte_pj .= "<li><a href='" . $pageURL ."/fineUploader/uploads/uploads/" . $pj['nom'] . "'>" .  $pj['nom'] . "</a></li>";
		  
	  }
	  
	  $texte_pj .= "</ul></p>";
	  
	}
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
      <body><section>De ". $_SESSION['agorapseudo'] . ".<br />" . $_POST['contenu'] . $texte_pj ."</section></body>
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
       		 $_POST['id_news'] = htmlspecialchars(mysql_real_escape_string(addslashes($_POST['id_news'])));
        	// C'est une modification, on met juste a jour le titre et le contenu
        	mysql_query("UPDATE news SET titre='" . $titre . "', contenu='" . $contenu . "' WHERE id='" . $_POST['id_news'] . "'")or die(mysql_error());
    }
}
 
//
// Verification 2 : est-ce qu'on veut supprimer une news ?
//
if (isset($_GET['supprimer_news']) && $_SESSION['admin'] > 1) // Si on demande de supprimer une news
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

if ($_SESSION['admin'] > 1) { ?> <h2 id="rediger_news_lien_desktop"><a href="#" class="lien_rediger_news">Ajouter une news</a></h2>
<div id="mobile_news_link"><h3><a href="#" class="lien_rediger_news_mobile">Ajouter une news depuis un navigateur mobile</a></h3>
<a href="#" class="lien_rediger_news">(Ce n'est pas le cas?)</a>
</div>
<script>
(function(a){(jQuery.browser=jQuery.browser||{}).mobile=/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))})(navigator.userAgent||navigator.vendor||window.opera);
if (jQuery.browser.mobile == false)
{
	$('#mobile_news_link').hide(0);
}
else
{
	$('#rediger_news_lien_desktop').hide(0);
}
</script>
<?php } ?>
<h2>toutes les news</h2>
<table><thead><tr>
<th>afficher</th>
<th>Titre</th>
<th>Date</th>
	<?php if($_SESSION['admin']>1){ ?>
    <th></th>
    <?php } ?>
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
<tr id="ligne_news_<?php echo $donnees['id'] ?>">
<td><a href="#" onclick="afficher_news (<?php echo $donnees['id']; ?>);">afficher</a></td>
<td><?php echo stripslashes($donnees['titre']); ?></td>
<td><?php echo date('d/m/Y', $donnees['timestamp']); ?></td>
	<?php if($_SESSION['admin']>3 || $_SESSION['agorapseudo'] == $donnees['auteur']){ ?>
    <td><a href="#" onclick="editer_news (<?php echo $donnees['id']; ?>);"><img src="ressources/edit.png" /></a>|<a href="#" onclick="suprimmer_news (<?php echo $donnees['id']; ?>);"><img src="ressources/delete.png" /></a></td>
    <?php } ?>
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

function editer_news (news_id) {
			debut_chargement ()
			history.pushState({page: current_page}, "", "?redir=rediger_news&get_name=news&get_val=" + news_id);
			$('#updater').load('rediger_news.php?edit=1&news=' + news_id, function() {
				current_page = "rediger_news.php?edit=1&news=" + news_id;
				fin_chargement ()		  


			});
    };
	
function suprimmer_news (news_id) {
			if (confirm("Voulez-vous réellement supprimer cette news? Cette action est irréversible."))
			{
				debut_chargement ()
				history.pushState({page: current_page}, "", "?redir=liste_news");
				$('#updater').load('liste_news.php?supprimer_news=' + news_id, function() {
					current_page = "liste_news.php";
					fin_chargement ()		  
				});
			}
			};
</script>
</body>
</html>

