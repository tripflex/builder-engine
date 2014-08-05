CKEDITOR.dialog.add( 'simpleLinkDialog', function( editor )
{
	return {
		title : 'Link Properties',
		minWidth : 400,
		minHeight : 200,
		contents :
		[
			{
				id : 'general',
				label : 'Settings',
				elements :
				[
				 	// UI elements of the Settings tab.
				]
			}
		]
	};
});