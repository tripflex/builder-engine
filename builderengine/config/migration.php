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
 defined('BASEPATH') OR exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Enable/Disable Migrations
|--------------------------------------------------------------------------
|
| Migrations are disabled by default but should be enabled
| whenever you intend to do a schema migration.
|
*/
$config['migration_enabled'] = FALSE;


/*
|--------------------------------------------------------------------------
| Migrations version
|--------------------------------------------------------------------------
|
| This is used to set migration version that the file system should be on.
| If you run $this->migration->latest() this is the version that schema will
| be upgraded / downgraded to.
|
*/
$config['migration_version'] = 0;


/*
|--------------------------------------------------------------------------
| Migrations Path
|--------------------------------------------------------------------------
|
| Path to your migrations folder.
| Typically, it will be within your application path.
| Also, writing permission is required within the migrations path.
|
*/
$config['migration_path'] = APPPATH . 'migrations/';


/* End of file migration.php */
/* Location: ./application/config/migration.php */