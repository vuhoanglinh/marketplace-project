/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.filebrowserBrowseUrl = 'http://localhost:81/chon/public/js/plugins/ckfinder/ckfinder.html';
	config.filebrowserUploadUrl = 'http://localhost:81/chon/public/js/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserImageBrowseUrl = 'http://localhost:81/chon/public/js/plugins/ckfinder/ckfinder.html?type=Images';
	config.filebrowserImageUploadUrl = 'http://localhost:81/chon/public/js/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserFlashUploadUrl = 'http://localhost:81/chon/public/js/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
	config.filebrowserFlashBrowseUrl = 'http://localhost:81/chon/public/js/plugins/ckfinder/ckfinder.html?type=Flash';		
			 
			 
};
