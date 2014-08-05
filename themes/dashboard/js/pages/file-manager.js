
function initialize_file_manager(){


	//------------- Elfinder file manager  -------------//
    var elf = $('#elfinder').elfinder({
		url : '/admin/files/connector'  // connector URL (REQUIRED)
		// lang: 'ru',             // language (OPTIONAL)
		,
		
 
        commandsOptions : {
			// configure value for "getFileCallback" used for editor integration
			getfile : {
				// send only URL or URL+path if false
				onlyURL  : true,

				// allow to return multiple files info
				multiple : false,

				// allow to return folders info
				folders  : false,

				// action after callback (close/destroy)
				oncomplete : ''
			},

			// "upload" command options.
			upload : {
				ui : 'uploadbutton'
			},

			// "quicklook" command options. For additional extensions
			quicklook : {
				autoplay : true,
				jplayer  : 'extensions/jplayer'
			},

			// configure custom editor for file editing command
			edit : {
				// list of allowed mimetypes to edit
				// if empty - any text files can be edited
				mimes : [],

				// edit files in wysisyg's
				editors : [
					// {
					// 	/**
					// 	 * files mimetypes allowed to edit in current wysisyg
					// 	 * @type  Array
					// 	 */
					// 	mimes : ['text/html'], 
					// 	/**
					// 	 * Called when "edit" dialog loaded.
					// 	 * Place to init wysisyg.
					// 	 * Can return wysisyg instance
					// 	 *
					// 	 * @param  DOMElement  textarea node
					// 	 * @return Object
					// 	 */
					// 	load : function(textarea) { },
					// 	/**
					// 	 * Called before "edit" dialog closed.
					// 	 * Place to destroy wysisyg instance.
					// 	 *
					// 	 * @param  DOMElement  textarea node
					// 	 * @param  Object      wysisyg instance (if was returned by "load" callback)
					// 	 * @return void
					// 	 */
					// 	close : function(textarea, instance) { },
					// 	/**
					// 	 * Called before file content send to backend.
					// 	 * Place to update textarea content if needed.
					// 	 *
					// 	 * @param  DOMElement  textarea node
					// 	 * @param  Object      wysisyg instance (if was returned by "load" callback)
					// 	 * @return void
					// 	 */
					// 	save : function(textarea, editor) {}
					// 
					// }
				]
			},

			// help dialog tabs
			help : { view : ['about', 'shortcuts', 'help'] }
		}
	}).elfinder('instance');


	//-------------  Plupload uploader -------------//
	$("#uploader").pluploadQueue({
		// General settings
		runtimes : 'html5,html4', 
		url : '/finder/upload.php',
		max_file_size : '10mb',
		max_file_count: 15, // user can add no more then 15 files at a time
		chunk_size : '1mb',
		unique_names : true,
		multiple_queues : true,

		// Resize images on clientside if we can
		resize : {width : 320, height : 240, quality : 80},
		
		// Rename files by clicking on their titles
		rename: true,
		
		// Sort files
		sortable: true,

		// Specify what files to browse for
		filters : [
			{title : "Image files", extensions : "jpg,gif,png"}
			/*{title : "Zip files", extensions : "zip,avi"}*/
		]
	});
}
