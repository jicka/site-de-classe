<script type="text/javascript">
  function debut_chargement () {
	$('#AJAX_loading_animation').show();
	$('.griseur').fadeIn(200);
	};
  function fin_chargement () {
	$('#AJAX_loading_animation').fadeOut(200);
	$('.griseur').fadeOut(200);
	};
	<?php
if(isset($_SESSION['agorapseudo']))
{
  ?>
  
  
		// REDIRECTIONS SUPPLEMENTAIRES
		
		
		
		
		
//	$(function() {
//		$('#updater').on('click', '.CLASS_DU_LIEN', function() {
//			debut_chargement ();		  
//			history.pushState({page: current_page}, "", "?redir=NOM_DE_LA_PAGE_SANS_EXTENSION");
//			$('#updater').load('NOM_DE_LA_PAGE', function() {
//				fin_chargement ()	;	  
//				current_page = "NOM_DE_LA_PAGE";  
//			  });
//	  });
//	});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	// REDIRECTIONS DU SITE
	
	
	
	$(function() {
	  $('.lien_liste_mails').click(function() {
			  debut_chargement ();
			  history.pushState({page: current_page}, "", "?redir=liste_mails");
			  $('#updater').load('liste_mails.php', function() {
			  fin_chargement ();  
			  current_page = "liste_mails.php";
		  });
	  });
	});
	$(function() {
	  $('.lien_acces_se3').click(function() {
			  debut_chargement ()	;	  
			  history.pushState({page: current_page}, "", "?redir=acces_se3");
				$('#updater').load('acces_se3.php', function() {
			  fin_chargement ()	;	  
			  current_page = "acces_se3.php";	  
			  });
		  });
	});
	$(function() {
	  $('.lien_liste_news').click(function() {
			  debut_chargement ();		  
			  history.pushState({page: current_page}, "", "?redir=liste_news");
				$('#updater').load('liste_news.php', function() {
			  fin_chargement ();		  
			  current_page = "liste_news.php";
	});
	  });
	});
	$(function() {
	  $('.lien_modifier_profil').click(function() {
			  debut_chargement ();		  
				history.pushState({page: current_page}, "", "?redir=modifier_profil&get_name=modifier_profil&get_val=1");
				$('#updater').load('modifier_profil.php', "modifier_profil=1", function() {
			  fin_chargement ();		  
			 current_page = "modifier_profil.php?modifier_profil=1";

			  });
	  });
	});
					  
		  $(function() {
	  $('#updater').on('click', '.lien_rediger_news', function() {
			  debut_chargement ();		  
			  history.pushState({page: current_page}, "", "?redir=rediger_news");
				$('#updater').load('rediger_news.php', function() {
			  fin_chargement ()	;	  
			  current_page = "rediger_news.php";  
			  });
	  });
	});
	
		  $(function() {
	  $('#updater').on('click', '.lien_liste_news', function() {
			  debut_chargement ();		  
			  history.pushState({page: current_page}, "", "?redir=liste_news");
				$('#updater').load('liste_news.php', function() {
			  fin_chargement ()	;	  
			  current_page = "liste_news.php";  
			  });
		  });
	});
		  $(function() {
	  $('#updater').on('click', '.retour_liste_news', function() {
			  debut_chargement ();		  
			  history.pushState({page: current_page}, "", "?redir=liste_news");
			  $('#updater').load('liste_news.php', function() {
			  fin_chargement ()	;	  
			  current_page = "liste_news.php";  
			  });
	  });
	});
	$(function() {
	  $('#updater').on('click', '.rediger_news_form_submit', function() {
			  debut_chargement ();		  
			  history.pushState({page: current_page}, "", "?redir=liste_news");
				  $('#updater').load('liste_news.php',{ titre: $('#rediger_news_form_titre').val(), contenu: (CKEDITOR.instances.rediger_news_form_contenu.getData()), id_news: $('#rediger_news_form_id_news').val(), valide: $('#rediger_news_form_valide').val(), rediger_news_form_mail: $('#rediger_news_form_mail').prop('checked')}, function() {
			  fin_chargement ()	;	  
			  current_page = "liste_news.php";
  
				  });
	  });
	});
	$(function() {
	  $('#updater').on('click', '.modifier_profil_form_submit', function() {
			  debut_chargement ();		  
				history.pushState({page: current_page}, "", "?redir=modifier_profil&get_name=modifier_profil&get_val=1");
				  $('#updater').load('modifier_profil.php',{ pass: $('#modifier_profil_form_pass').val(), repass: $('#modifier_profil_form_repass').val(), mail: $('#modifier_profil_form_mail').val(), mail_public: $('#modifier_profil_form_mail_public').val(), mail_ok: $('#modifier_profil_form_mail_ok').prop('checked'), news: $('#modifier_profil_form_news').prop('checked')}, function() {
			  fin_chargement ()	;	  
			  current_page = "modifier_profil.php?modifier_profil=1";  
			  });
	  });
	});
	$(function() {
	  $('#updater').on('click', '#voir_apprec_form', function() {
			  debut_chargement ()	;	  
				history.pushState({page: current_page}, "", "?redir=voir_apprec");
				  $('#updater').load('voir_apprec.php?submit=1',{ pass: $('#voir_apprec_form_pass').val(), check: 'NfdhDujg5276' }, function() {
			  fin_chargement ()	;	  
			  current_page = "voir_apprec.php";  
			  });
	  });
	});
	$(function() {
	  $('#updater').on('click', '.lien_voir_apprec', function() {
			  debut_chargement ();		  
				history.pushState({page: current_page}, "", "?redir=voir_apprec");
				  $('#updater').load('voir_apprec.php', function() {
			  fin_chargement ()	;	  
			  current_page = "voir_apprec.php";  
				  });
			  });
	});
	$(function() {
	  $('#updater').on('click', '.lien_remarques', function() {
			  debut_chargement ()	;	  
				history.pushState({page: current_page}, "", "?redir=sondage&get_name=submit&get_val=1");
				  $('#updater').load('sondage.php?submit=1&saute=1', function() {
			  fin_chargement ()	;	  
			  current_page = "sondage.php?submit=1&saute=1";
				  });});});
				  
	$(function() {
	  $('#updater').on('click', '.lien_sondage', function() {
			  debut_chargement ()	;	  
				history.pushState({page: current_page}, "", "?redir=sondage");
				  $('#updater').load('sondage.php', function() {
			  fin_chargement ()	;	  
			  current_page = "sondage.php";
				  });});});
				  
		$(function() {
	  $('#updater').on('click', '.sondage_form_submit', function() {
			  debut_chargement ();		  
				history.pushState({page: current_page}, "", "?redir=sondage");
				  $('#updater').load('sondage.php?submit=1',{ orientation: (CKEDITOR.instances.sondage_form_orientation.getData()), certitude: $('#sondage_form_certitude_orientation').val() }, function() {
			  fin_chargement ()	;	  
			  current_page = "sondage.php";    
				  });
	  });
	});
		$(function() {
	  $('#updater').on('click', '.remarque_form_submit', function() {
			  debut_chargement ()	;	  
				history.pushState({page: current_page}, "", "");
				  $('#updater').load('sondage.php?submit=2',{ remarque: (CKEDITOR.instances.sondage_form_remarque.getData())}, function() {
			  fin_chargement ()	;	  
  			  current_page = "";  

			  });
	  });
	});
		$(function() {
	  $('#updater').on('click', '.actualiser_apprec', function() {
			  debut_chargement ();		  
				history.pushState({page: current_page}, "", "?redir=voir_apprec");
				  $('#updater').load('voir_apprec.php?submit=1',{ pass:pass, already_md5: "1"}, function() {
			  fin_chargement ()	;	  
  
				  });
	  });
	});
		$(function() {
	  $('#updater').on('click', '#afficher_pacman', function() {
			  $('#surprise_pacman').show(20000);
			  
	  });
	});

	<?php
	// Affichage des redirections admin uniquement si nécéssaire...
	if ($_SESSION['admin'] > 3)
	{
		?>
		$(function() {
			$('#updater').on('click', '#admin_see_all_db', function() {
			  debut_chargement ();		  
				history.pushState({page: current_page}, "", "?redir=admin&get_name=admin_see_all_db&get_val=1");
					$('#updater').load('admin.php?admin_see_all_db=1',function() {
			  fin_chargement ()	;	  
			  current_page = "admin.php?admin_see_all_db=1";  		
		});});});

		$(function() {
			$('#updater').on('click', '.remplir_apprec', function() {
			  debut_chargement ();		  
				history.pushState({page: current_page}, "", "?redir=remplir_apprec");
					$('#updater').load('remplir_apprec.php?admin_see_all_db=1',function() {
			  fin_chargement ()	;	  
			  current_page = "remplir_apprec.php";  		
		});});});

		$(function() {
			$('#updater').on('click', '#admin_voir_orientations', function() {
			  debut_chargement ();		  
				history.pushState({page: current_page}, "", "?redir=admin&get_name=voir_orientations&get_val=1");
					$('#updater').load('admin.php?voir_orientations=1',function() {
			  fin_chargement ()	;	  
			  current_page = "admin.php?voir_orientations=1";  		
		});});});

		$(function() {
			$('#updater').on('click', '#admin_voir_rq_conseil', function() {
			  debut_chargement ();		  
				history.pushState({page: current_page}, "", "?redir=admin&get_name=voir_rq_conseil&get_val=1");
					$('#updater').load('admin.php?voir_rq_conseil=1',function() {
			  fin_chargement ()	;	  
			  current_page = "admin.php?voir_rq_conseil=1";  		
		});});});

		$(function() {
			$('#updater').on('click', '#admin_edit_site', function() {
			  debut_chargement ();		  
				history.pushState({page: current_page}, "", "?redir=admin&get_name=edit_site&get_val=1");
					$('#updater').load('admin.php?edit_site=1',function() {
			  fin_chargement ()	;	  
			  current_page = "admin.php?edit_site=1";  		
		});});});
		
		$(function() {
			$('#updater').on('click', '#admin_edit_param_site', function() {
			  debut_chargement ();		  
					$('#updater').load('admin_traitement.php?edit_param_site=1', { classe: $('#champ_nom_classe').val(), mail: $('#champ_email_admin').val(), mail_actif:$('#mail_actif').prop('checked') },function() {
						fin_chargement ();
						setTimeout(function() {
			  debut_chargement ();		  
				history.pushState({page: current_page}, "", "?redir=admin&get_name=edit_site&get_val=1");
					$('#updater').load('admin.php?edit_site=1',function() {
			  fin_chargement ()	;});
			current_page = "admin.php?edit_site=1";  		
}, 3000);
		});});});
		
		$(function() {
			$('#updater').on('click', '#admin_edit_conseils_button', function() {
			  debut_chargement ();		  
					$('#updater').load('admin_traitement.php?edit_param_conseils=1', { prochain_conseil: $('#prochain_conseil').val(), orientation_possible: $('#orientation_possible').prop('checked'), orientation_obligatoire: $('#orientation_obligatoire').prop('checked'), easter_egg: $('#easter_egg').prop('checked') },function() {
						fin_chargement ();
						setTimeout(function() {
			  debut_chargement ();		  
				history.pushState({page: current_page}, "", "?redir=admin&get_name=page_conseils&get_val=1");
					$('#updater').load('admin.php?page_conseils=1',function() {
			  fin_chargement ()	;});
			current_page = "admin.php?page_conseils=1";  		
}, 3000);
});});});
		$(function() {
			$('#updater').on('click', '#admin_reset_rq', function() {
			  debut_chargement ();		  
					$('#updater').load('admin_traitement.php?reset_rq=1',function() {
						fin_chargement ();
						setTimeout(function() {
			  debut_chargement ();		  
				history.pushState({page: current_page}, "", "?redir=admin&get_name=voir_rq_conseil&get_val=1");
					$('#updater').load('admin.php?voir_rq_conseil=1',function() {
			  fin_chargement ()	;});
			current_page = "admin.php?voir_rq_conseil=1";  		
}, 3000);

		});});});
		$(function() {
			$('#updater').on('click', '#admin_edit_conseils_button_plus_reset_sondage', function() {
				$('#traitement').show(400);
				$('#admin_edit_conseils_button_plus_reset_sondage').hide(400);
				$('#resultat').load('admin_traitement.php?reset_sondage_counter=1',function() {
				$('#resultat').show(400);
				$('#traitement').hide(400);
			});});});
			
		$(function() {
			$('#updater').on('click', '.lien_accueil_admin', function() {
			  debut_chargement ();		  
				history.pushState({page: current_page}, "", "?redir=admin");
				$('#updater').load('admin.php', function() {
			  fin_chargement ();		  
			  current_page = "admin.php";  		
			});});});
			
		$(function() {
	  		$('#lien_accueil_admin').click(function() {
			  debut_chargement ();		  
				history.pushState({page: current_page}, "", "?redir=admin");
				$('#updater').load('admin.php', function() {
			  fin_chargement ();		  
			  current_page = "admin.php";  		
		});});});

		$(function() {
			$('#updater').on('click', '#admin_delete_accounts', function() {
			  debut_chargement ();		  
				history.pushState({page: current_page}, "", "?redir=admin&get_name=delete_page&get_val=1");
					$('#updater').load('admin.php?delete_page=1',function() {
			  fin_chargement ()	;	  
			  current_page = "admin.php?delete_page=1";  		
		});});});

		$(function() {
			$('#updater').on('click', '#admin_add_accounts', function() {
			  debut_chargement ()	;	  
				history.pushState({page: current_page}, "", "?redir=admin&get_name=add_page&get_val=1");
					$('#updater').load('admin.php?add_page=1',function() {
			  fin_chargement ()	;	  
			  current_page = "admin.php?add_page=1";  		
		});});});

		$(function() {
			$('#updater').on('click', '#admin_edit_conseils', function() {
			  debut_chargement ()	;	  
				history.pushState({page: current_page}, "", "?redir=admin&get_name=page_conseils&get_val=1");
					$('#updater').load('admin.php?page_conseils=1',function() {
			  fin_chargement ()	;	  
			  current_page = "admin.php?page_conseils=1";  		
		});});});

		$(function() {
			$('#updater').on('reset', '#add_acount_form', function() {
				$('#wait_during_process').show(600);
					$('#submission_confirmation').load('admin_traitement.php?add_account=1', {prenom: $('#prenom_eleve').val(), nom: $('#nom').val(), titre:$('#titre').val(), civilite: $('#civilite').val() },function() {
						$('#wait_during_process').hide(500);
					$('#prenom').show(750);
					$('#civilite_div').hide(750);
					$('#submission_confirmation').fadeIn(1000);
					setTimeout(function() {
						$('#submission_confirmation').fadeOut(500, function(){
							$('#submission_confirmation').fadeIn(500, function(){
								$('#submission_confirmation').hide(1000)})})}, 3000);
		});});});

		$(function() {
			$('#updater').on('click', '#admin_modifier_all_db', function() {
			$(function() { $('.admin_see_all_only_text_hidabble').hide(0);});
			$(function() { $('.admin_see_all_editable_form').show(0);});
			$(function() { $('#admin_modifier_all_db').hide(500);});
			$(function() { $('#admin_text_only_all_db').show(500);});
			});});
		
		$(function() {
			$('#updater').on('click', '#admin_text_only_all_db', function() {
			$(function() { $('.admin_see_all_only_text_hidabble').show(0);});
			$(function() { $('.admin_see_all_editable_form').hide(0);});
			$(function() { $('#admin_text_only_all_db').hide(500);});
			$(function() { $('#admin_modifier_all_db').show(500);});
			});});
		
		$(function() {
			$('#updater').on('click', '#admin_show_deletion_buttons', function() {
			$(function() { $('.admin_see_all_editable_form').show(500);});
			$(function() { $('#admin_show_deletion_buttons').hide(500);});
			});});
		
	<?php
	}
	elseif ($_SESSION['admin'] > 2)
	{
		?>
		$(function() {
	  		$('#lien_accueil_delegues').click(function() {
			  debut_chargement ();		  
				history.pushState({page: current_page}, "", "?redir=delegues");
				$('#updater').load('delegues.php', function() {
			  fin_chargement ();		  
			  current_page = "delegues.php";  	
			  	
		});});});
				$(function() {
			$('#updater').on('click', '#delegues_see_all_db', function() {
			  debut_chargement ();		  
				history.pushState({page: current_page}, "", "?redir=delegues&get_name=admin_see_all_db&get_val=1");
					$('#updater').load('delegues.php?admin_see_all_db=1',function() {
			  fin_chargement ()	;	  
			  current_page = "delegues.php?admin_see_all_db=1";  		
		});});});

		$(function() {
			$('#updater').on('click', '#delegues_voir_orientations', function() {
			  debut_chargement ();		  
				history.pushState({page: current_page}, "", "?redir=delegues&get_name=voir_orientations&get_val=1");
					$('#updater').load('delegues.php?voir_orientations=1',function() {
			  fin_chargement ()	;	  
			  current_page = "delegues.php?voir_orientations=1";  		
		});});});

		$(function() {
			$('#updater').on('click', '#delegues_voir_rq_conseil', function() {
			  debut_chargement ();		  
				history.pushState({page: current_page}, "", "?redir=delegues&get_name=voir_rq_conseil&get_val=1");
					$('#updater').load('delegues.php?voir_rq_conseil=1',function() {
			  fin_chargement ()	;	  
			  current_page = "delegues.php?voir_rq_conseil=1";  		
		});});});


<?php
	}

	}
?>
	
	
	
	// Redirection. Si on fait index.php?redir=mapage , on est directement renvoyé vers mapage.php!
	<?php
	if (isset($_GET["redir"]))
	{
		?>
		debut_chargement ();
			$('#updater').load('<?php echo htmlspecialchars($_GET["redir"]); ?>.php<?php if(isset($_GET['get_name'])){ ?>?<?php echo htmlspecialchars($_GET['get_name']); ?>=<?php echo htmlspecialchars($_GET['get_val']); } ?>', function() {
		fin_chargement ();
			});
		<?php
	}
	?>

</script>