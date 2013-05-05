<?php
session_start();
?>
<!DOCTYPE html>
<html>
   <head>
       <title>Liste d'adresses mail!</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   </head>
    
    <body>

<section>
<p style="font-size:.7em;"><a href="index.php">Accueil</a> / Liste des mails</p>
<p>
<?php
if(isset($_SESSION['agorapseudo']))
{
	
	?>
    <!--     !!!!!     !!!!!     DEBUT DU CODE     !!!!!     !!!!!     -->
    <h1>Liste d'adresses mail utiles</h1>
	<?php
	include("connectionbasededonnee.php");
	$donnees=mysql_query("SELECT * FROM comptes WHERE mail_ok='on' AND admin > 1 ")or die(mysql_error());
	while ($reponse = mysql_fetch_array($donnees))
	{
	 	?>
        <?php echo $reponse['pseudo']; ?>: <div style="color:blue; text-decoration:underline;"><?php echo $reponse['mail_public']; ?></div><br />
        <?php
	}
	?>
    </p>
    
    
    
    
    
    
    
    
    
    <!--     !!!!!     !!!!!     FIN DU CODE     !!!!!     !!!!!     -->
    
    <?php
}
?>

</section>
</body>

</html>