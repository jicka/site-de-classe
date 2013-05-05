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
			<?php
			
			if(isset($_SESSION['agorapseudo']))
			{
				include("connectionbasededonnee.php");
				if (isset ($_GET['submit']) && htmlspecialchars(mysql_real_escape_string($_GET['submit'])) =="1")
				{
					if (!isset($_GET['saute']))
					{
						$certitude = 0;
						if (isset($_POST['certitude']) && htmlspecialchars(mysql_real_escape_string($_POST['certitude'])) == "Certain")
						{
							$certitude = "Toute à fait certain(e).";
						}
						elseif (isset($_POST['certitude']) && htmlspecialchars(mysql_real_escape_string($_POST['certitude'])) == "jaienvie")
						{
							$certitude = "A bien envie de faire cela.";
						}
						elseif (isset($_POST['certitude']) && htmlspecialchars(mysql_real_escape_string($_POST['certitude'])) == "jesaispas")
						{
							$certitude = "Ne sait pas trop.";
						}
						elseif (isset($_POST['certitude']) && htmlspecialchars(mysql_real_escape_string($_POST['certitude'])) == "passur")
						{
							$certitude = "Aucune certitude.";
						}
						$orientation = mysql_real_escape_string($_POST['orientation']);
						mysql_query("UPDATE sondage SET orientation='$orientation', certitude='$certitude', fait='1' WHERE pseudo='{$_SESSION['agorapseudo']}'")or die(mysql_error());
						?>
						<p style="color:green">Vos choix ont bien étés enregistrés. Merci.</p>
                        <?php
                    }
					?>
                    <p>Si vous avez des remarques ou des questions à poser au conseil, vous avez la possibilité de nous en faire part. Ces remarques sont anonymes.</p>
                            <form id="sondage_form" method="post" action="sondage.php">
							<textarea name="sondage_form_remarque" id="sondage_form_remarque" class="editor" cols="90" rows="10"></textarea>
							  <br />
							  <input type="button" value="Envoyer" class="remarque_form_submit" />
						</form>

                    <?php
				}
				elseif(isset ($_GET['submit']) && htmlspecialchars(mysql_real_escape_string($_GET['submit'] =="2")))
				{
					$remarque = mysql_real_escape_string($_POST['remarque']);
					mysql_query("INSERT INTO remarques VALUES ('', '$remarque')")or die(mysql_error());
					?>
					<p style="color:green">Votre remarque à correctement été enregistrée. Nous en tiendrons compte!</p>
                    <p>Retour à la page <a href="index.php">d'accueil</a> dans 5 secondes...</p>
                    <script type="text/javascript">
                    	$(function() {fin_chargement (); setTimeout(function() {window.location.replace("index.php");}, 6000);});
					</script>
					
					<?php
                }
				else
				{
					$sondage = mysql_query("SELECT * FROM sondage WHERE pseudo='{$_SESSION['agorapseudo']}'")or die(mysql_error());
					$sondage = mysql_fetch_array($sondage);
					?>
						<div class="center">
						<h1>Questionnaire par rapport au conseil de classe</h1>
						</div>
						<form id="sondage_form" method="post" action="sondage.php">
														A quel point êtes vous sur de ce/ces choix d'orientation? <br />
							  <select name="certitude_orientation" id="sondage_form_certitude_orientation">
								<option type="radio" value="Certain" <?php if($sondage['certitude']== "Il est certain."){ ?> selected="selected" <?php } ?>>Certain!</option>
								<option type="radio" value="jaienvie" <?php if($sondage['certitude']== "Il a bien envie de faire cela."){ ?> selected="selected" <?php } ?>>J'ai bien envie de le faire.</option>
								<option type="radio" value="jesaispas"<?php if($sondage['certitude']== "Il ne sait pas trop."){ ?> selected="selected" <?php } ?>>Je ne sais pas trop.</option>
								<option type="radio" value="passur"<?php if($sondage['certitude']== "Il n est pas sur du tout."){ ?> selected="selected" <?php } ?>>Je ne suis pas sûr du tout.</option>
							  </select> <br />
Quel est votre choix d'orientation? (mettez autant d'informations que possible!)
							<textarea name="sondage_form_orientation" id="sondage_form_orientation" class="editor" cols="90" rows="10"><?php echo $sondage['orientation']; ?></textarea>
							 
							  <input type="button" value="Envoyer" class="sondage_form_submit" />
						</form>
						
					<?php
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
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
	<?php
	if (isset ($_GET['submit']) && htmlspecialchars(mysql_real_escape_string($_GET['submit'] =="1")))
	{
		?>
		CKEDITOR.replace( 'sondage_form_remarque' );
		<?php
	}
	else
	{
		?>
		CKEDITOR.replace( 'sondage_form_orientation' );
		<?php
	}
	?>
</script>
</body>
</html>