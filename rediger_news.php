<?php
session_start();
?>
<!DOCTYPE html>
<html>
   <head>
<meta charset="utf-8" />
 <link href="fineUploader/fineuploader-3.5.0.css" rel="stylesheet">
 </head>
    
    <body>
<section>
<p style="font-size:.7em;"><a href="index.php">Accueil</a> / <a href="#" class="lien_liste_news">Liste des news</a> / Rédiger une news</p>
<h3><a href="#" class="retour_liste_news">Retour à la liste des news</a></h3>
<?php
if ($_SESSION['admin'] > 1)
{
include('connectionbasededonnee.php');
if (isset($_GET['news'])) // Si on demande de modifier une news
{
    // On protège la variable "modifier_news" pour éviter une faille SQL
    $_GET['news'] = mysql_real_escape_string(htmlspecialchars($_GET['news']));
    // On récupère les infos de la news correspondante
    $retour = mysql_query('SELECT * FROM news WHERE id=\'' . $_GET['news'] . '\'');
    $donnees = mysql_fetch_array($retour);
    
    // On place le titre et le contenu dans des variables simples
    $titre = stripslashes($donnees['titre']);
    $contenu = stripslashes($donnees['contenu']);
    $id_news = $donnees['id']; // Cette variable va servir pour se souvenir que c'est une modification
}
else // C'est qu'on rédige une nouvelle news
{
    // Les variables $titre et $contenu sont vides, puisque c'est une nouvelle news
    $titre = '';
    $contenu = '';
    $id_news = 0; // La variable vaut 0, donc on se souviendra que ce n'est pas une modification
}
$infos_classe = mysql_query("SELECT * FROM param_site WHERE id='1'") or die(mysql_error());
$infos_classe = mysql_fetch_array($infos_classe);
?>
	<div class="texte_center">
<form id="rediger_news_form" action="liste_news.php" method="post">
<p>Titre : <input type="text" size="50" id="rediger_news_form_titre" name="titre" value="<?php echo $titre; ?>" /></p>
<p>
    Contenu :
<br />

    <textarea name="rediger_news_form_contenu" id="rediger_news_form_contenu" class="editor" cols="90" rows="10"><?php echo $contenu; ?></textarea>

    <input type="hidden" name="id_news" id="rediger_news_form_id_news" value="<?php echo $id_news; ?>" />
		<input type="hidden" id="rediger_news_form_valide" name="valide" value="oui" />
        <input type="checkbox" id="rediger_news_form_mail" <?php if($infos_classe['mail_actif'] == "1"){ ?>checked="checked"<?php } else { ?> disabled<?php } ?> /><label for="rediger_news_form_mail">Envoyer un mail?</label><br />
        
        <?php
		if (!isset($_GET['news'])) // Si on demande de modifier une news
		{
			?>
            <div id="uploader"></div>
     		<?php
		}
		?>
          
     	<input class="rediger_news_form_submit" id="bouton_publier_news" type="button" value="Enregistrer"/>
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
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<?php
		if (isset($_GET['news'])) // Si on demande de modifier une news
		{
			?>
 <script src="fineUploader/jquery.fineuploader-3.5.0.js"></script>
<script>
var numUploads = 0;
$(document).ready(function() {
	
    var errorHandler = function(event, id, fileName, reason, xhr) {
        qq.log("id: " + id + ", fileName: " + fileName + ", reason: " + reason);
    };

    var fileNum = 0;

    $('#uploader').fineUploader({
        debug: true,
        request: {
            endpoint: "fineUploader/uploads/index.php",
            paramsInBody: true
        },
		text: {
			uploadButton: 'Joindre un fichier'
		},
        chunking: {
            enabled: true
        },
        resume: {
            enabled: true
        },
        retry: {
            enableAuto: false,
            showButton: true
        },
        deleteFile: {
            enabled: false,
            endpoint: 'fineUploader/uploads/index.php',
            forceConfirm: false,
            params: {foo: "bar"}
        },
        display: {
            fileSizeOnSubmit: true
        },
        paste: {
            targetElement: $(document)
        }
    })
        
  		.on('error', errorHandler)
        .on('uploadChunk resume', function(event, id, fileName, chunkData) {
            qq.log('on' + event.type + ' -  ID: ' + id + ", FILENAME: " + fileName + ", PARTINDEX: " + chunkData.partIndex + ", STARTBYTE: " + chunkData.startByte + ", ENDBYTE: " + chunkData.endByte + ", PARTCOUNT: " + chunkData.totalParts);
        })
        .on("upload", function(event, id, filename) { 
            $(this).fineUploader('setParams', {"hey": "ho"}, id);
			 
        });
		
});
$('#uploader').on('complete', function(event, id, name, responseJSON){
    numUploads++;
	$('#bouton_publier_news').removeAttr("disabled");
	if (numUploads > 4)
	{
		$('.qq-upload-button').hide();
	}
  });
  $('#uploader').on('upload', function(event, id, name, responseJSON){
	$('#bouton_publier_news').attr("disabled", "disabled");
  });
<?php
}
?>
</script>
<script type="text/javascript">
	CKEDITOR.replace( 'rediger_news_form_contenu' );

</script>
</body>
</html>
