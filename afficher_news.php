<?php
session_start(); // On démarre la session AVANT toute chose
?>
<!DOCTYPE html>
<html>
   <head>
       <title>Afficher une news</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   </head>
    
    <body>
<section>
<p style="font-size:.7em;"><a href="index.php">Accueil</a> / <a href="#" class="lien_liste_news">Liste des news</a> / Affichage d'une news</p>
<?php
include('connectionbasededonnee.php');
$news = htmlspecialchars(mysql_real_escape_string($_GET['news']));
$retour = mysql_query("SELECT * FROM news WHERE id='$news'")or die(mysql_error());
$donnees = mysql_fetch_array($retour); // On fait une boucle pour lister les news

if( $donnees['auteur'] == "")
{
	$donnees['auteur']='inconnu';
}
$donnees['titre'] = stripslashes($donnees['titre']);
$donnees['contenu'] = stripslashes($donnees['contenu']);

?>
<h1><?php echo $donnees['titre']; ?></h1>
<p>Date: <?php echo date('d/m/Y à H\hi', $donnees['timestamp']); ?></p>
<p>Auteur: <?php echo $donnees['auteur']; ?></p>
<p> <?php echo $donnees['contenu']; ?></p>
<?php




?>
</section>

</body>



</html>
