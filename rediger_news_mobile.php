<?php
session_start();
?>
<!DOCTYPE html>
<html>
   <head>
<meta charset="utf-8" />
 </head>
    
    <body>
<section>
<p style="font-size:.7em;"><a href="index.php">Accueil</a> / <a href="#" class="lien_liste_news">Liste des news</a> / Rédiger une news</p>
<h3><a href="#" class="retour_liste_news">Retour à la liste des news</a></h3>
<?php
if ($_SESSION['admin'] > 1)
{
include('connectionbasededonnee.php');
    $id_news = 0; // La variable vaut 0, donc on se souviendra que ce n'est pas une modification
$infos_classe = mysql_query("SELECT * FROM param_site WHERE id='1'") or die(mysql_error());
$infos_classe = mysql_fetch_array($infos_classe);
?>
	<div class="texte_center">
<form id="rediger_news_form" action="liste_news.php" method="post">
<p>Titre : <input type="text" size="50" id="rediger_news_form_titre" name="titre" /></p>
<p>
    Contenu :
<br />

    
    <textarea name="rediger_news_form_contenu" id="rediger_news_form_contenu" rows="5" cols="40" spellcheck="true"></textarea><br />
    
    <input type="hidden" name="id_news" id="rediger_news_form_id_news" value="<?php echo $id_news; ?>" />
		<input type="hidden" id="rediger_news_form_valide" name="valide" value="oui" />
        <input type="checkbox" id="rediger_news_form_mail" <?php if($infos_classe['mail_actif'] == "1" && !isset($_GET['news'])){ ?>checked="checked"<?php } else { ?> disabled<?php } ?> /><label for="rediger_news_form_mail">Envoyer un mail?</label><br />
        
          
     	<input class="rediger_news_mobile_form_submit" id="bouton_publier_news" type="button" value="Enregistrer"/>
          <?php
}
else
{
	?>
    <p style="color:red">Vous n'êtes pas autorisés à rédiger des news.</p>
    <?php
}
    ?>
</p>
</form></div>
</section>
<script src="jquery.js" type="text/javascript"></script>
</body>
</html>
