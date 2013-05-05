<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
</head>
<body>
		<section style="width:1270px;">
			<?php
			if(isset($_SESSION['agorapseudo']) && $_SESSION['admin'] > 2)
			{
				include('connectionbasededonnee.php');
					$tmp = mysql_query("SELECT * FROM apprec")or die(mysql_error());
					?>
                    <p style="font-size:.7em;"><a href="index.php">Accueil</a> / Saisie des appréciations</p>
                    <p><input type="button" id="send_emails" value="Envoyer un mail aux élèves" /><span id="if_no_email">Une fois toutes les appréciations saisies, actualisez la page. Vous pourrez alors envoyer un mail contenant leur appréciation par mail.<br />Ne cliquez qu'une seule fois!</span></p>
						<table>
						<thead>
						<tr>
							<th>Nom</th>
							<th>Saisir</th>
						</tr>
						</thead>
						<tbody>
						<?php
						$i = 0;
						$nbre_apprec_remplies = 0;
							while ($eleve = mysql_fetch_array($tmp))
							{
								$i++;
								if ($eleve['apprec'] != "")
								{
									$nbre_apprec_remplies++;
								}
								?><tr><td style="vertical-align:middle;"><?php echo $eleve['pseudo']; ?></td>
                                <td id="saisir_apprec_th_<?php echo $eleve['id']; ?>">
                                <input type="button" href='#' id='saisir_apprec_link_<?php echo $eleve['id']; ?>' value="Saisir" onClick="afficher_champ_saisie_apprec(<?php echo $eleve['id']; ?>, '<?php echo $eleve['pseudo']; ?>')"><br />
                                <span id="apprec_just_text_<?php echo $eleve['id']; ?>"><?php echo $eleve['apprec'];
								if ($eleve['felicitations'] == "1")
								{
									echo "<div style='color:green'> Félicitations</div>";
								}
								if ($eleve['compliments'] == "1")
								{
									echo "<div style='color:green'> Compliments</div>";
								}
								if ($eleve['encouragements'] == "1")
								{
									echo "<div style='color:green'>Encouragements</div>";
								}
								if ($eleve['avert_conduite'] == "1")
								{
									echo "<div style='color:red'>Avertissements conduite</div>";
								}
								if ($eleve['avert_travail'] == "1")
								{
									echo "<div style='color:red'>Avertissements travail</div>";
								}?></span>
                                <span class="wait_during_process_<?php echo $eleve['id']; ?>"><img src="ressources/rotating_circle.gif" alt="Chargement" class="wait_during_process"> Chargement en cours...</span><script type="text/javascript">$('.wait_during_process_<?php echo $eleve['id']; ?>').hide();</script>
                                <div class="zone_de_saisie_<?php echo $eleve['id']; ?>"></div>
                                </td>
                                </tr>
                                <?php
							}
						?>
						</tbody>
						</table>
					<?php
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
<script type="text/javascript">
$('#send_emails').hide();
<?php
$infos_classe = mysql_query("SELECT * FROM param_site WHERE id='1'") or die(mysql_error());
$infos_classe = mysql_fetch_array($infos_classe);
	if ($i == $nbre_apprec_remplies && $infos_classe['mail_actif'] == "1")
	{
		?>
			$('#send_emails').show();
			$('#if_no_email').hide();
		<?php
	}

?>
function afficher_champ_saisie_apprec (id, pseudo) {
	$('#saisir_apprec_link_' + id).hide(0);
	$('#apprec_just_text_' + id).hide(0);
	$('.zone_de_saisie_' + id).hide();
	$('.wait_during_process_' + id).show(400);
	$('.zone_de_saisie_' + id).load('remplir_apprec_traitement.php', {pseudo: pseudo, id:id}, function() {
		$('.zone_de_saisie_' + id).show(400);
		$('.wait_during_process_' + id).hide(400);
	});
};
function envoyer_donnees (id, pseudo, ckInstance) {
	$('.zone_de_saisie_' + id).hide(400);
	$('.wait_during_process_' + id).show(400);
	$('.zone_de_saisie_' + id).load('remplir_apprec_traitement.php', {envoyer: pseudo, apprec: (ckInstance), moyenne:$('#moyenne_' + id).val(), felicitations:$('#felicitations_' + id).prop('checked'), compliments:$('#compliments_' + id).prop('checked'), encouragements:$('#encouragements_' + id).prop('checked'), avert_travail:$('#avert_travail_' + id).prop('checked'), avert_conduite:$('#avert_conduite_' + id).prop('checked')}, function() {
	$('#apprec_just_text_' + id).load('remplir_apprec_traitement.php?apprec_text=1', {id : id, pseudo : pseudo});
	$('#apprec_just_text_' + id).show();
		$('.zone_de_saisie_' + id).show(400);
		$('.wait_during_process_' + id).hide(400);
		$('#saisir_apprec_link_' + id).show(400);
	});
};

	$(function() {
	  $('#updater').on('click', '#send_emails', function() {
		  $('#send_emails').hide(400);
				  $('#updater').load('remplir_apprec_traitement.php?emails=1', function() {
			  });
	  });
	});

</script>
</body>
</html>