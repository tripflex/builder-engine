/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';asdasd
	config.extraPlugins = "sourcedialog";
   config.filebrowserBrowseUrl = '/admin/files/show/embedded';
   config.filebrowserImageBrowseUrl = '/admin/files/show/embedded/?type=Images';
   config.filebrowserFlashBrowseUrl = '/admin/files/show/embedded/?type=Flash';
   /*config.filebrowserUploadUrl = '/admin/files/connector?cmd=upload&type=Files';
   config.filebrowserImageUploadUrl = '/admin/files/connector?cmd=upload&type=Images';
   config.filebrowserFlashUploadUrl = '/admin/files/connector?cmd=upload&type=Flash';*/
   config.allowedContent = true;
   config.protectedSource.push(/<i[^>]*><\/i>/g);
   config.protectedSource.push(/<img[^>]*><\/img>/g);
   CKEDITOR.dtd.$removeEmpty['i'] = false;
};

