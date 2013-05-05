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
				include("connectionbasededonnee.php");
				$orientation_raw = mysql_query("SELECT * FROM sondage") or die(mysql_error());
				$i = 0;
				echo "<ul>";
				while ($orientation = mysql_fetch_array($orientation_raw))
				{
					if ($orientation['Fait'] == "1")
					{
						 echo "<li>" . $orientation['pseudo'] . ":" . $orientation['orientation'] . "<em>" . $orientation['certitude'] . "</em></li>";
						$i++;
					}
				}
				echo "</ul>";
				if($i == 0)
				{
					?>
					<h3>OOOooooops !</h3>
					<p>Aucun souhait d'orientation n'a été saisi! Il semblerait que l'indécision règne!</p>
					<?php
				}

			}
			else
			{
				?>
                <!--Si on est pas connecté, ba ya le formulaire de connexion.-->
    			<img src="ressources/connexion.png" class="conexion" alt="connexion"/>
    			<p>Il faut être connecté et être autorisé pour voir cette page....</p>
				<?php
			}
			if (!isset($_GET['included']))
{
?>
		</section>
	</div>
</body>
</html>
<?php
}
?>