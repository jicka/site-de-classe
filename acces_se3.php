<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
  <head>
    <title>Accéder au serveur du lycée de chez soi</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  </head>
  
  <body>

<section>
<?php
if(isset($_SESSION['agorapseudo']))
{
	include("connectionbasededonnee.php");
	$infos_classe = mysql_query("SELECT * FROM param_site WHERE id='1'") or die(mysql_error());
	$infos_classe = mysql_fetch_array($infos_classe);
	?>
    <p style="font-size:.7em;"><a href="index.php">Accueil</a> / Accès au serveur</p>
<p>Pour accéder au serveur:
<ul>
<li><a href="http://lyc-prevert-longjumeau.ac-versailles.fr/lcs/">http://lyc-prevert-longjumeau.ac-versailles.fr/lcs/</a>.</li>
<li>Cliquez sur &quot;se connecter&quot; (bouton en haut à gauche), puis connectez vous en utilisant les mêmes identifiants qu'au lycée.</li>
<li>Cliquez sur &quot;Accès au serveur de fichiers &laquo;Se3&raquo;&quot;.</li>
</ul>
Une fois sur la page suivante (voir tableau ci-dessous), vous avez accès à tous les fichiers présents sur votre session au lycée. Par exemple, pour accéder aux dossiers "travail" et "échange", vous devez séléctionner le dossier "Classes", puis" Classe_<?php echo $infos_classe['classe']; ?>". Pour accéder à votre bureau, c'est le dossier "Home" qui est à séléctionner.<br />
  <table cellpadding="0" cellspacing="0">
   <tr>
    <th ><input name="chkall" style="font-size: 8pt; " type="checkbox" /></th>
    <th style="white-space: nowrap; background-color: rgb(238, 234, 216); border-bottom-width: 3px; border-bottom-style: solid; border-bottom-color: rgb(214, 210, 194); border-left-width: 1px; border-left-style: solid; border-left-color: white; border-right-width: 1px; border-right-style: solid; border-right-color: rgb(214, 210, 194); padding-left: 10px; padding-right: 3px; padding-top: 3px; font-weight: normal; ">Nom</th>
    <th style="white-space: nowrap; background-color: rgb(238, 234, 216); border-bottom-width: 3px; border-bottom-style: solid; border-bottom-color: rgb(214, 210, 194); border-left-width: 1px; border-left-style: solid; border-left-color: white; border-right-width: 1px; border-right-style: solid; border-right-color: rgb(214, 210, 194); padding-left: 10px; padding-right: 3px; padding-top: 3px; font-weight: normal; ">Commentaires</th>
   </tr>
   <tr>
    <td style="white-space: nowrap; padding: 0px; vertical-align: middle; width: 20px; text-align: right; "><input name="selected[]" style="font-size: 8pt; " type="checkbox" value="antivir" /></td>
    <td style="white-space: nowrap; padding: 0px 10px 0px 5px; vertical-align: middle; "><nobr><img align="absmiddle" alt="#" border="0" height="18" src="http://lyc-prevert-longjumeau.ac-versailles.fr/smbwebclient/smbwebclient.php?path=style%2Fdisk.png" width="18" />&nbsp;antivir</nobr></td>
    <td style="white-space: nowrap; padding: 0px 10px 0px 5px; vertical-align: middle; "><nobr></nobr></td>
   </tr>
   <tr>
    <td style="white-space: nowrap; padding: 0px; vertical-align: middle; width: 20px; text-align: right; "><input name="selected[]" style="font-size: 8pt; " type="checkbox" value="Classes" /></td>
    <td style="white-space: nowrap; padding: 0px 10px 0px 5px; vertical-align: middle; "><nobr><img align="absmiddle" alt="#" border="0" height="18" src="http://lyc-prevert-longjumeau.ac-versailles.fr/smbwebclient/smbwebclient.php?path=style%2Fdisk.png" width="18" />&nbsp;Classes</nobr></td>
    <td style="white-space: nowrap; padding: 0px 10px 0px 5px; vertical-align: middle; "><nobr>Partage classes</nobr></td>
   </tr>
   <tr>
    <td style="white-space: nowrap; padding: 0px; vertical-align: middle; width: 20px; text-align: right; "><input name="selected[]" style="font-size: 8pt; " type="checkbox" value="Docs" /></td>
    <td style="white-space: nowrap; padding: 0px 10px 0px 5px; vertical-align: middle; "><nobr><img align="absmiddle" alt="#" border="0" height="18" src="http://lyc-prevert-longjumeau.ac-versailles.fr/smbwebclient/smbwebclient.php?path=style%2Fdisk.png" width="18" />&nbsp;</nobr>Docs
    <td style="white-space: nowrap; padding: 0px 10px 0px 5px; vertical-align: middle; "><nobr>Partage Documents</nobr></td>
   </tr>
   <tr>
    <td style="white-space: nowrap; padding: 0px; vertical-align: middle; width: 20px; text-align: right; "><input name="selected[]" style="font-size: 8pt; " type="checkbox" value="drivers" /></td>
    <td style="white-space: nowrap; padding: 0px 10px 0px 5px; vertical-align: middle; "><nobr><img align="absmiddle" alt="#" border="0" height="18" src="http://lyc-prevert-longjumeau.ac-versailles.fr/smbwebclient/smbwebclient.php?path=style%2Fdisk.png" width="18" />&nbsp;drivers</nobr></td>
    <td style="white-space: nowrap; padding: 0px 10px 0px 5px; vertical-align: middle; "><nobr>Pilotes d&#39;imprimante</nobr></td>
   </tr>
   <tr>
    <td style="white-space: nowrap; padding: 0px; vertical-align: middle; width: 20px; text-align: right; "><input name="selected[]" style="font-size: 8pt; " type="checkbox" value="home" /></td>
    <td style="white-space: nowrap; padding: 0px 10px 0px 5px; vertical-align: middle; "><nobr><img align="absmiddle" alt="#" border="0" height="18" src="http://lyc-prevert-longjumeau.ac-versailles.fr/smbwebclient/smbwebclient.php?path=style%2Fdisk.png" width="18" />&nbsp;home</nobr></td>
    <td style="white-space: nowrap; padding: 0px 10px 0px 5px; vertical-align: middle; "><nobr>Home de nomp</nobr></td>
   </tr>
   <tr>
    <td style="white-space: nowrap; padding: 0px; vertical-align: middle; width: 20px; text-align: right; "><input name="selected[]" style="font-size: 8pt; " type="checkbox" value="le_monde" /></td>
    <td style="white-space: nowrap; padding: 0px 10px 0px 5px; vertical-align: middle; "><nobr><img align="absmiddle" alt="#" border="0" height="18" src="http://lyc-prevert-longjumeau.ac-versailles.fr/smbwebclient/smbwebclient.php?path=style%2Fdisk.png" width="18" />&nbsp;le_monde</nobr></td>
    <td style="white-space: nowrap; padding: 0px 10px 0px 5px; vertical-align: middle; "><nobr>Le_Monde_sur_CD-ROM</nobr></td>
   </tr>
   <tr>
    <td style="white-space: nowrap; padding: 0px; vertical-align: middle; width: 20px; text-align: right; "><input name="selected[]" style="font-size: 8pt; " type="checkbox" value="Progs" /></td>
    <td style="white-space: nowrap; padding: 0px 10px 0px 5px; vertical-align: middle; "><nobr><img align="absmiddle" alt="#" border="0" height="18" src="http://lyc-prevert-longjumeau.ac-versailles.fr/smbwebclient/smbwebclient.php?path=style%2Fdisk.png" width="18" />&nbsp;Progs</nobr></td>
    <td style="white-space: nowrap; padding: 0px 10px 0px 5px; vertical-align: middle; "><nobr>Partage programmes</nobr></td>
   </tr>
</table>
<br />
Merci à Mme Dubarry pour cette page.</p>
 <?php
}
?>
</section>
</body>

</html>