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
    if(isset($_SESSION['agorapseudo']) && $_SESSION['admin'] > 2)
    {
        include('connectionbasededonnee.php');
        if(isset($_POST['envoyer']))
        {
            $felicitations = 0;
            $compliments = 0;
            $encouragements = 0;
            $avert_travail = 0;
            $avert_conduite = 0;
            if (htmlspecialchars(mysql_real_escape_string($_POST['felicitations'])) == "true")
            {
                $felicitations = 1;
            }
            if (htmlspecialchars(mysql_real_escape_string($_POST['compliments'])) == "true")
            {
                $compliments = 1;
            }
            if (htmlspecialchars(mysql_real_escape_string($_POST['encouragements'])) == "true")
            {
                $encouragements = 1;
            }
            if (htmlspecialchars(mysql_real_escape_string($_POST['avert_travail'])) == "true")
            {
                $avert_travail = 1;
            }
            if (htmlspecialchars(mysql_real_escape_string($_POST['avert_conduite'])) == "true")
            {
                $avert_conduite = 1;
            }
			$moyenne = htmlspecialchars(mysql_real_escape_string($_POST['moyenne']));
			$apprec = mysql_real_escape_string($_POST['apprec']);
			$pseudo = htmlspecialchars(mysql_real_escape_string($_POST['envoyer']));
            mysql_query("UPDATE apprec SET apprec='$apprec', felicitations='$felicitations', compliments='$compliments', encouragements='$encouragements', avert_conduite='$avert_conduite', avert_travail='$avert_travail', moyenne='$moyenne' WHERE pseudo='$pseudo'")or die(mysql_error());
			?>
            <p style="color:green;">Enregistrement effectué avec succès.</p>
            <?php
        }
        elseif(isset($_GET['apprec_text']))
        {
			$pseudo = mysql_real_escape_string($_POST['pseudo']);
            $tmp = mysql_query("SELECT * FROM apprec WHERE pseudo='$pseudo'")or die(mysql_error());
            $tmp = mysql_fetch_array($tmp);
			echo $tmp['apprec'];
			if ($tmp['felicitations'] == "1")
			{
				echo "<div style='color:green'> Félicitations</div>";
			}
			if ($tmp['compliments'] == "1")
			{
				echo "<div style='color:green'> Compliments</div>";
			}
			if ($tmp['encouragements'] == "1")
			{
				echo "<div style='color:green'>Encouragements</div>";
			}
			if ($tmp['avert_conduite'] == "1")
			{
				echo "<div style='color:red'>Avertissements conduite</div>";
			}
			if ($tmp['avert_travail'] == "1")
			{
				echo "<div style='color:red'>Avertissements travail</div>";
			}
        }
        elseif(isset($_GET['emails']))
        {
			$tmp = mysql_query("SELECT * FROM apprec") or die(mysql_error());
			while ($apprec = mysql_fetch_array($tmp))
			{
				if ($apprec['apprec'] != "")
				{
					$apprec_complete = "Voici en quelques mots l'appréciation du conseil de classe:<br />" . $apprec['apprec'] . "<br />";
					if ($apprec['felicitations'] == "1")
					{
						$apprec_complete .= "<div style='color:green'>Vous avez eu les félicitations du conseil de classe!</div>";
					}
					if ($apprec['compliments'] == "1")
					{
						$apprec_complete .= "<div style='color:green'>Vous avez eu les compliments du conseil de classe!</div>";
					}
					if ($apprec['encouragements'] == "1")
					{
						$apprec_complete .= "<div style='color:green'>Vous avez eu les encouragements du conseil de classe!</div>";
					}
					if ($apprec['avert_conduite'] == "1")
					{
						$apprec_complete .= "<div style='color:red'>Vous avez eu un avertissement concernant votre conduite!</div>";
					}
					if ($apprec['avert_travail'] == "1")
					{
						$apprec_complete .= "<div style='color:red'>Vous avez eu un avertissement concernant votre travail!</div>";
					}
					$apprec_complete .= "<br /><div style='color:grey'>Ces informations n'ont rien de définitif, il est possible qu'elles soient érronnées. Pour plus d'infos, rendez vous demain avec vos délégués.</div>";
				//=====Les variables
			$sujet = "Appreciation au conseil de classe";
			$message_html = "<html>
				  <head>
				  <meta charset='utf-8' />
				  <style>
				  body
					{
						font-family: 'Arbutus Slab', serif;
					}
					
					</style>
				   <title>". $sujet."</title>
				  </head>
				  <body>" . $apprec_complete ."</body>
				 </html>";
			
			//==========
			$temp_data = mysql_query("SELECT * FROM comptes WHERE pseudo='{$apprec['pseudo']}'")or die (mysql_error());
			$data = mysql_fetch_array($temp_data);
			$destinataire = $data['mail'];
			$infos_classe = mysql_query("SELECT * FROM param_site WHERE id='1'") or die(mysql_error());
			$infos_classe = mysql_fetch_array($infos_classe);

			
			//=====Création du header de l'e-mail
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
			
				// En-têtes additionnels
				$headers .= 'From: '. $infos_classe['mail'] . "\r\n";
				//==========
				if ($destinataire != "")
				{
				 	mail($destinataire, $sujet, $message_html, $headers);
				}
				}
			}

			
        }
        elseif (isset($_POST['pseudo']))
        {
			$pseudo = htmlspecialchars(mysql_real_escape_string($_POST['pseudo']));
            $tmp = mysql_query("SELECT * FROM apprec WHERE pseudo='$pseudo'")or die(mysql_error());
            $tmp = mysql_fetch_array($tmp);
            ?>
                <div class="texte_center">
                    
                    <form>
                    <textarea name="apprec_<?php echo htmlspecialchars(mysql_real_escape_string($_POST['id'])); ?>" id="apprec_<?php echo htmlspecialchars(mysql_real_escape_string($_POST['id'])); ?>" class="editor"><?php echo $tmp['apprec']; ?></textarea>
                    <br/>
                    <input type="checkbox" name="felicitations_<?php echo htmlspecialchars(mysql_real_escape_string($_POST['id'])); ?>" id="felicitations_<?php echo htmlspecialchars(mysql_real_escape_string($_POST['id'])); ?>" <?php if($tmp['felicitations']){?> checked="checked" <?php } ?>/><label for="felicitations_<?php echo htmlspecialchars(mysql_real_escape_string($_POST['id'])); ?>">Félicitations</label>
                    <input type="checkbox" name="compliments_<?php echo htmlspecialchars(mysql_real_escape_string($_POST['id'])); ?>" id="compliments_<?php echo htmlspecialchars(mysql_real_escape_string($_POST['id'])); ?>" <?php if($tmp['compliments']){?> checked="checked" <?php } ?>/><label for="compliments_<?php echo htmlspecialchars(mysql_real_escape_string($_POST['id'])); ?>">Compliments</label>
                    <input type="checkbox" name="encouragements_<?php echo htmlspecialchars(mysql_real_escape_string($_POST['id'])); ?>" id="encouragements_<?php echo htmlspecialchars(mysql_real_escape_string($_POST['id'])); ?>" <?php if($tmp['encouragements']){?> checked="checked" <?php } ?>/><label for="encouragements_<?php echo htmlspecialchars(mysql_real_escape_string($_POST['id'])); ?>">Encouragements</label><br />
                    <input type="checkbox" name="avert_travail_<?php echo htmlspecialchars(mysql_real_escape_string($_POST['id'])); ?>" id="avert_travail_<?php echo htmlspecialchars(mysql_real_escape_string($_POST['id'])); ?>"<?php if($tmp['avert_travail']){?> checked="checked" <?php } ?>/><label for="avert_travail_<?php echo htmlspecialchars(mysql_real_escape_string($_POST['id'])); ?>">Avertissement Travail</label>
                    <input type="checkbox" name="avert_conduite_<?php echo htmlspecialchars(mysql_real_escape_string($_POST['id'])); ?>" id="avert_conduite_<?php echo htmlspecialchars(mysql_real_escape_string($_POST['id'])); ?>"<?php if($tmp['avert_conduite']){?> checked="checked" <?php } ?>/><label for="avert_conduite_<?php echo htmlspecialchars(mysql_real_escape_string($_POST['id'])); ?>">Avertissement Conduite</label><br />
                    Moyenne: <input type="number" name="moyenne_<?php echo htmlspecialchars(mysql_real_escape_string($_POST['id'])); ?>" min="0" max="20" size="4" value="<?php echo $tmp['moyenne']; ?>" id="moyenne_<?php echo htmlspecialchars(mysql_real_escape_string($_POST['id'])); ?>" /><br />
                    <input type="button" value="Enregistrer" onClick="envoyer_donnees(<?php echo htmlspecialchars(mysql_real_escape_string($_POST['id'])); ?>, '<?php echo htmlspecialchars(mysql_real_escape_string($_POST['pseudo'])); ?>', CKEDITOR.instances.apprec_<?php echo htmlspecialchars(mysql_real_escape_string($_POST['id'])); ?>.getData())"/>
                    </form>
                </div>
            <?php
        }
    }
    ?>
            
		</section>
        <?php
		if (isset($_POST['pseudo']))
        {
?>
<script type="text/javascript">
	CKEDITOR.replace( 'apprec_<?php echo htmlspecialchars(mysql_real_escape_string($_POST['id'])); ?>' );

</script>
<?php
		}
		?>
</body>
</html>