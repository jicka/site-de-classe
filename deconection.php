<?php
session_start(); // On demarre la session AVANT toute chose
session_destroy(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Déconection</title>
<link href="rasta.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="corps1">

<p> Vous êtes maintenant déconnecté.</p><a href="index.php">accueil</a>
<script language="javascript" type="text/javascript">
<!--
window.location.replace("index.php");
-->
</script>
</div>
</body>
</html>
