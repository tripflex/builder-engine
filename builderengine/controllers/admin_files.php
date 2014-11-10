<?php
/***********************************************************
* BuilderEngine v2.0.12
* ---------------------------------
* BuilderEngine CMS Platform - Radian Enterprise Systems Limited
* Copyright Radian Enterprise Systems Limited 2012-2014. All Rights Reserved.
*
* http://www.builderengine.com
* Email: info@builderengine.com
* Time: 2014-23-04 | File version: 2.0.12
*
***********************************************************/

ini_set('max_file_uploads', 50);   // allow uploading up to 50 files at once

function access($attr, $path, $data, $volume) {
	return strpos(basename($path), '.') === 0       // if file/folder begins with '.' (dot)
		? !($attr == 'read' || $attr == 'write')    // set read+write to false, other (locked+hidden) set to true
		:  null;                                    // else elFinder decide it itself
}

class Admin_files extends BE_Controller {
	function Admin_files()
	{
		parent::__construct();
		if(!$this->user->is_member_of("Administrators"))
			die();
		
	}
	function show($embedded = false) {
		$data['embedded'] = $embedded;
		$this->show->backend("files", $data);  
	}
	
	function connector()
	{
		

		include_once APPPATH.'third_party/finder/elFinderConnector.class.php';
		include_once APPPATH.'third_party/finder/elFinder.class.php';
		include_once APPPATH.'third_party/finder/elFinderVolumeDriver.class.php';
		include_once APPPATH.'third_party/finder/elFinderVolumeLocalFileSystem.class.php';

		$opts = array(
			 'debug' => true,
			'uploadMaxSize'	=> "5M",
					'uploadTotalSize'	=> "5000000000",
					'uploadFileSize'	=> "5M",
					'uploadAllow' => array('image'),
			'roots' => array(
				
				array(
					'uploadMaxSize'	=> "5M",
					'uploadTotalSize'	=> "5M",
					'uploadFileSize'	=> "5M",
					'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
					'path'          => APPPATH.'../files/',         // path to files (REQUIRED)
					'URL'           => '/files/', // URL to files (REQUIRED)
					'accessControl' => 'access'  ,           // disable and hide dot starting files (OPTIONAL)
					'defaults'     => array(        // default permisions
						'read'   => true,
						'write'  => true,
						'rm'     => true
					),
					'perms' => array( // individual folders/files permisions 
					   '/^test_dir\/.*/' => array(
						  'read'  => true,
						  'write' => true,
						  'rm'    => true
						)
					),
				)
			)
		);

		// run elFinder
		$connector = new elFinderConnector(new elFinder($opts));
		$connector->run();
	}
}