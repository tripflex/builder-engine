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

    class admin_install extends BE_Controller
    {
        function admin_install()
        {
            parent::__construct();

            if($this->is_installed())
                redirect("/", 'location');

        }


        function index()
        {
            $this->step_one();
        }

        function create_admin()
        {
            $this->load->database();
            $this->load->model("users");

            $username   = $_POST['admin_username'];
            $password   = $_POST['admin_password'];
            $email      = $_POST['admin_email'];

            $admin['name']      = "";
            $admin['username']  = urldecode($username);
            $admin['password']  = urldecode($password);
            $admin['email']     = urldecode($email);
            $admin['groups']    = "Members,Administrators,Frontend Editor,Frontend Manager";

            $this->users->register_user($admin);
            echo "success";
        }
        function install_db()
        {
            $this->show->disable_full_wrapper();
            $host = urldecode($_POST['host']);
            $user = urldecode($_POST['user']);
            $password = urldecode($_POST['password']);
            $db = urldecode($_POST['db']);


            error_reporting(0);
            mysql_connect($host, $user, $password) or die ("Could not connect to MySQL server. Please go back and check your settings.");
            mysql_select_db($db) or die ("Could not connect to MySQL database. Please go back and check your settings.");

            $queries = file_get_contents(APPPATH."install/database.sql");

            if($queries === null)
                die("PHP function <a href='http://php.net/file_get_contents'>file_get_contents()</a> is disabled by your server administrator");
                
            if($queries === false)
                die("Could not read database import file.");
                
            
            
                
            foreach(explode(";", $queries) as $query)
            {
                if($query == '')
                    continue;
                    
                mysql_query($query) or die("Database Error: ".mysql_error()."<br>Query: '$query'");
            }
            /*
            $command = 'mysql'
                    . ' --host=' . $host
                    . ' --user=' . $user
                    . ' --password=' . $password
                    . ' --database=' . $db
                    . ' --execute="SOURCE ' . APPPATH."install"
            ;
            $output = shell_exec($command . '/database.sql"');*/

            $config = file_get_contents(APPPATH."config/database_template.php");
            $config = str_replace("##DB_HOST##", $host, $config);
            $config = str_replace("##DB_USER##", $user, $config);
            $config = str_replace("##DB_PASS##", $password, $config);
            $config = str_replace("##DB_NAME##", $db, $config);

            file_put_contents(APPPATH."config/database.php", $config) or die("Could not create database configuration file.");

            echo "success";
        }
        function finish()
        {
            $config = file_get_contents(APPPATH."config/config.php");
            $config = str_replace('$config[\'site_installed\'] = false;', '$config[\'site_installed\'] = true;', $config);

            file_put_contents(APPPATH."config/config.php", $config);
            echo "success";
        }
        function configure(){
            $sitename   = urldecode($_POST['sitename']);
            $host       = urldecode($_POST['host']);
            $user       = urldecode($_POST['user']);
            $password   = urldecode($_POST['password']);
            $db         = urldecode($_POST['db']);

            $this->load->database();
            $this->BuilderEngine->load_settings();
            $this->BuilderEngine->set_option("website_name", urldecode($sitename));
            echo "success";
        }
        function step_one()
        {

            $requirements = array();
            if(array_key_exists('HTTP_MOD_REWRITE', $_SERVER))
                $requirements['mod_rewrite'] = true;
            else
                $requirements['mod_rewrite'] = false;

            $requirements['short_tags'] = ini_get('short_open_tag') == "1";

            $requirements['writable'] = check_writable_recurse(".") ;
            $requirements['php_version'] = check_php_version("5.0") ;
            $requirements['mysql_available'] = function_exists("mysql_connect") && function_exists("mysql_select_db") && function_exists("mysql_query") ;
            


            $data['requirements'] = $requirements; 
            $this->show->backend('maintenance/step_one', $data);




        }

    }
?>