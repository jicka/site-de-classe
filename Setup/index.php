<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
<!--un titre, un css et un lien vers le rss du site-->
	<title>Mise en place d'un site de classe</title>
	<meta charset="utf-8" />
    <link href="../rasta_new.css" rel="stylesheet" type="text/css" />
    <link rel="icon" type="image/png" href="ressources/icon.png" />
</head>
<body>
<section>
<h2 style="margin:auto; text-align:center;">Installation du site</h2>
<p>Bonjour et bienvenue sur cette page qui va vous guider à travers le processus d'installation de ce site. </p>
<p id="what_is_this_site">Ce site à ppour vocation de vous permettre de rester facilement en contact avec vos élèves, de récupérer, si vous les souhaitez des informations sur leur orientation, et de leur communiquer leurs appréciations du conseil de classe.</p>
<p id="install_bdd_text">Pour commencer la mise en place du site, sachez que ce site nécéssite l'accès à une base de données MySQL. Si vous en possedez-une, veuillez tout d'abord aller dans le fichier "<span style="color:green;">connectionbasededonnee.php</span>" (qui se trouve à la racine du site) et l'éditer de sorte à ce que les réglages correspondent à ceux de votre base de donnée. Une fois que cele est fait, cliquez sur le bouton "suivant". Si une erreur s'affiche, veuillez revérifier vos réglages.</p>
<input type="button" id="check_bdd_start" value="Suivant"><span id="check_bdd_traitement" style="color:#C60;">En cours...</span><span id="check_bdd_resultat"></span><br />
<script type="text/javascript" src="../jquery.js"></script>
<p id="description_install">L'installation se réalisera en trois étapes. Notez bien que si la base de donnée est déjà installée et que vous souhaitez simplement réinitialiser la classe (pour changer d'année par exemple), cliquez sur "<span style="color:green;">Réaliser cette étape manuellement</span>" et poursuivez sans vous préocuper de l'étape. Notez que votre compte administrateur sera lui-aussi réinitialisé.</p>
<div id="etape_1">
Etape 1/3: Installation de la base de donnée: <input type="button" id="etape_1_start" value="Executer"> <a href="#" id="etape_1_manuel">Réaliser cette étape manuellement.</a><span id="etape_1_traitement" style="color:#C60;">En cours...</span><span id="etape_1_resultat"></span><span id="etape_1_finish_manuel">Effectué manuellement.</span>
<br /><span id="explications_manuel">Pour installer la base de données manuellement, il vous suffit d'importer le fichier "<span style="color:green;">setup_tables.sql</span>" (qui se trouve dans le dossier setup) dans votre base de données.</span><br /><input type="button" id="etape_1_manuel_finish" value="C'est fait!">
</div>
<div id="etape_2">
Etape 2/3: Création de votre compte:<span id="etape_2_traitement" style="color:#C60;">En cours...</span><span id="etape_2_resultat"></span><br />
<form id="form_create_admin_account">
    <select name="titre" id="titre">
        <option type="radio" value="eleve" id="type_eleve" >Elève</option>
        <option type="radio" value="prof" id="type_prof" >Professeur</option>
    </select><br />
    <div id="prenom">Prénom: <input type="text" id="prenom_eleve" name="prenom"/></div>
    <div id="civilite_div">Civilité: <select name="civilite" id="civilite">
        <option type="radio" value="M." id="M" >M.</option>
        <option type="radio" value="Mme." id="Mme" >Mme.</option>
    </select></div>
    Nom:<input type="text" name="nom" id="nom" required/><br />
    Mot de passe :  <input type="password" id="pass" name="pass" size="25" /><br />
	Validation : <input type="password" id="repass" name="repass" size="25" /><br />
    <input type="button" id="etape_2_start" value="Executer"></form>
</div>
<br />
<div id="etape_3">
Etape 3/3: Paramétrage du site: <span id="etape_3_traitement" style="color:#C60;">En cours...</span><span id="etape_3_resultat"></span><br />
<form id="param_site">
                    Nom de la classe: <input type="text" name="nom_classe" id="champ_nom_classe" size="5"  required> <span style="color:grey"> Exemple: TS1</span><br />
                    Votre Email de contact (s'activera avec le lien "contact" en bas des pages): <input type="email" name="email_admin" id="champ_email_admin" size="40" required><br />
                    <input type="checkbox" name="mail_actif" id="mail_actif" checked /><label for="mail_actif"> Activer la fonction d'envoi de mails (Il est fortement conseillé d'être hébergé par un site qui active la fonction php <span style="color:green;">mail()</span>, afin que les élèves puissent recevoir les news par mail.)</label><br />
                    </form>
<input type="button" id="etape_3_start" value="Executer">
</div>
<div id="finish">
<h2 style="margin:auto; text-align:center; color:green;">Installation terminée</h2>
<p>Vous pouvez allez vous faire un café, le plus dur est fait. Il ne vous reste plus que le plus long: Créer tous les comptes des élèves. Pour cela, connectez-vous directement sur le site, allez dans la rubrique "gestion du site" et cliquez sur "ajouter des comptes".</p>
<p style="color:red">Attention: Le contenu de ce dossier n'est plus utile. Supprimez-le, au moins du serveur. En effet, cette page peut-être utilisée pour réinitialiser le site. Merci.</p>
<a href="../index.php">Aller sur le site</a>
</div>
</section>
	</div>
    <script type="text/javascript">
	$('#etape_1').hide();
	$('#check_bdd_traitement').hide();
	$('#check_bdd_resultat').hide();
	$('#etape_1_finish_manuel').hide();
	$('#description_install').hide();
	$('#etape_1_manuel_finish').hide();
	$('#explications_manuel').hide();
	$('#etape_1_resultat').hide();
	$('#etape_1_traitement').hide();
	$('#etape_2_resultat').hide();
	$('#etape_2_traitement').hide();
	$('#civilite_div').hide();
	$('#etape_2').hide();
	$('#etape_3_resultat').hide();
	$('#etape_3_traitement').hide();
	$('#etape_3').hide();
	$('#finish').hide();
	
	
	
	$(function() {
	  $('#check_bdd_start').click(function() {
			$('#check_bdd_start').hide(400);
			$('#check_bdd_traitement').show(400);
			$('#check_bdd_resultat').load('index_traitement.php', function() {
			$('#check_bdd_traitement').hide(400);
			$('#check_bdd_resultat').show(400);
			$('#description_install').show(400);
			$('#etape_1').show(400);
	});});});
	
	$(function() {
	  $('#etape_1_start').click(function() {
			$('#etape_1_start').hide(400);
			$('#etape_1_manuel').hide(400);
			$('#etape_1_traitement').show(400);
			$('#etape_1_resultat').load('index_traitement.php?step=1', function() {
			$('#etape_1_traitement').hide(400);
			$('#etape_1_resultat').show(400);
			$('#etape_2').show(400);
	});});});
	
	$(function() {
	  $('#etape_1_manuel').click(function() {
			$('#etape_1_start').hide(400);
			$('#etape_1_manuel').hide(400);
			$('#etape_1_traitement').show(400);
			$('#explications_manuel').show(400);
			$('#etape_1_manuel_finish').show(400);
	});});
	
	
	$(function() {
	  $('#etape_1_manuel_finish').click(function() {
			$('#etape_1_traitement').hide(400);
			$('#explications_manuel').hide(400);
			$('#etape_1_manuel_finish').hide(400);
			$('#etape_2').show(400);
			$('#etape_1_finish_manuel').show(400);
	});});

	
	$(function() {
	  $('#etape_2_start').click(function() {
		  if ($('#pass').val() == $('#repass').val())
		  {
			$('#etape_2_start').hide(400);
			$('#form_create_admin_account').hide(400);
			$('#etape_2_traitement').show(400);
			$('#etape_2_resultat').load('index_traitement.php?step=2', {prenom: $('#prenom_eleve').val(), nom: $('#nom').val(), titre:$('#titre').val(), civilite: $('#civilite').val(), pass: $('#pass').val()}, function() {
			$('#etape_2_traitement').hide(400);
			$('#etape_2_resultat').show(400);
			$('#etape_3').show(400);
			});
		  }
		  else
		  {
			alert ("Les mots de passe ne correspondent pas.");  
		  }
			});});
	
	
	$(function() {
	  $('#etape_3_start').click(function() {
		  if ($('#champ_nom_classe').val() != "" && $('#champ_email_admin').val() != "")
		  {
			$('#etape_3_start').hide(400);
			$('#param_site').hide(400);
			$('#etape_3_traitement').show(400);
			$('#etape_3_resultat').load('index_traitement.php?step=3', {classe: $('#champ_nom_classe').val(), mail_admin: $('#champ_email_admin').val(), mail_actif:$('#mail_actif').prop('checked')}, function() {
			$('#etape_3_traitement').hide(400);
			$('#etape_3_resultat').show(400);
			$('#finish').show(400);
			});
		  }
		  else
		  {
			  alert("Un des champs n'a pas été correctement rempli.");
		  }
		  });});
	
	
	
	$(function(){
		$("#titre").change(function(){
			$("option:selected", $(this)).each(function(){
				var obj = document.getElementById('titre').value;
				if (obj == "prof")
				{
					$('#prenom').hide(750);
					$('#prenom_eleve').val("");
					$('#civilite_div').show(750);
				}
				else
				{
					$('#prenom').show(750);
					$('#civilite_div').hide(750);
				}
	});});});

	</script>
</body>
</html>