/**
 * Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	var CKEDITOR_BASEPATH = '/ckeditor/';
	// Define changes to default configuration here. For example:
config.language = "fr.js";
config.toolbar_Basic =
[
	{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
	{ name: 'paragraph',   items : [ 'NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock', 'Outdent','Indent' ] },
	{ name: 'links',       items : [ 'Link' ] },
	{ name: 'insert',      items : [ 'Image','Table','HorizontalRule','Smiley','SpecialChar' ] },
	{ name: 'styles',      items : [ 'Format','FontSize', 'TextColor', 'BGColor' ] },
	{ name: 'editing',     groups: [ 'spellchecker' ] }
	];
config.toolbar = 'Basic';
config.toolbarCanCollapse = false;
config.removePlugins = 'elementspath';
// config.scayt_autoStartup = true;
// config.scayt_sLang = 'fr_FR';


};

