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
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class seo extends BE_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
    public function seo(){
        parent::__construct();
    }
	public function index($id)
	{
        $this->load->model('users');

		$this->show->frontend('welcome_message');

	}
    function dispatch($string)
    {
        $data = explode("-", $string, 2);

        $this->load->model('users');

        if(!isset($data[1]))
        	$data[1] = "index";
        

        $output = Modules::run($data[0].'/seo', $data[1]);

        if(strlen($output) == 0)
            show_404();
        else
            echo $output;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */