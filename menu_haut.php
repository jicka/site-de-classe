<?php if (isset ($_SESSION['agorapseudo']) && $_SESSION['agorapseudo'] != NULL)
{
	?>
    <header>
	<table class="menu_haut">
    <thead>
    <tr>
		<th><a href="index.php"><img src="ressources/home.png" alt="Accueil"/></a></th>
		<th><a href="#" class="lien_modifier_profil">Mon compte</a></th>
		<th><?php if ($_SESSION['admin'] == 4){?> <a href="#" id="lien_accueil_admin" style="color:#F60;">Gérer le site</a> <?php } elseif ($_SESSION['admin'] == 3){ ?><a href="#" id="lien_accueil_delegues" style="color:#F60;">Page de délégué</a><?php } ?></th>
		<th><a href="#" class="lien_liste_news">News</a></th>
	</tr>
    </thead>
    </table>
    </header>
	<?php
}
?>