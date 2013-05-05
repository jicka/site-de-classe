<?php session_start(); 
if (!isset($_GET['included']))
{
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
</head>
<body>
		<section>
        
			<?php
}
			if(isset($_SESSION['agorapseudo']) && $_SESSION['admin'] > 2)
			{
				?>
                <ul>
                <?php
				include("connectionbasededonnee.php");
				$remarque_raw = mysql_query("SELECT * FROM remarques") or die(mysql_error());
				$i = 0;
				while ($remarque = mysql_fetch_array($remarque_raw))
				{
					echo "<li>" . $remarque['remarque'] . "</li>";
					$i++;
				}
				?>
                </ul>
                <?php
				if($i == 0)
				{
					?>
                    <h3>OOOooooops !</h3>
                    <p>Aucune remarque n'a été saisie! Il semblerait que tout aille pour le mieux!</p>
                    <?php
				}
				
			}
			else
			{
				?>
    			<p>Il faut être connecté et être autorisé pour voir cette page....</p>
				<?php
			}
if (!isset($_GET['included']))
{
?>            
</section>
</body>
</html>
<?php
}
?>