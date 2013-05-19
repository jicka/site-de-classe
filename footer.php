<?php
include("connectionbasededonnee.php");
$infos_classe = mysql_query("SELECT * FROM param_site WHERE id='1'") or die(mysql_error());
$infos_classe = mysql_fetch_array($infos_classe);
?>
<footer>
<table style="border:none; padding:none; margin:none;" class="footer_table">
<tr style="border:none; padding:none; margin:none;">
<td style="border:none; padding:none; margin:none;"><a href="deconection.php">Déconnexion</a></td>
<td style="border:none; padding:none; margin:none;"><a href="mailto:<?php echo $infos_classe['mail']; ?>">Contact</a></td>
<td style="border:none; padding:none; margin:none;">Jonas Kanafani</td>
</tr>
</table>
</footer>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
			//  WEB FONT LOADER
  WebFontConfig = {
    google: { families: [ 'Arbutus+Slab::latin' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })();
			//  END OF WEB FONT LOADER
  </script>
