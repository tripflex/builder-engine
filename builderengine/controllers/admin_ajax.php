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
//

class Admin_ajax extends BE_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -  
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    
    public function Admin_ajax(){
        parent::__construct();

        $this->load->model('users');
        //$this->load->model('blocks');
        //$this->load->model('versions');
        $this->user = &$this->users->get_current_user();
    }

    public function get_server_load()
    {
        $load = sys_getloadavg();
        $load = $load[0] * 100 / 4;
        echo (string)$load;
   
    }
    public function set_user_edit_mode($bool)
    {
        $this->user->editor_mode($bool == "true");
    }
    public function get_site_visitors()
    {
        echo $this->BuilderEngine->get_online_site_visitors();
    }
    public function test($block)
    {
        $latest_name = "Version (1)";

        $number = (int)preg_replace('/[^\-\d]*(\-?\d*).*/','$1',$latest_name);
        if($number > 0)
        {
            $old_number = $number;
            $number++;
            $new_name = str_replace($old_number, $number,$latest_name);
        }else
        {
            $new_name = str_replace($number, "",$latest_name);
            $new_name = trim($new_name, " ");
            $new_name .= " (1)";
        }

        echo $new_name;
        echo "Block active version: ".$this->blocks->get_active_version($block)."<br>";
        echo "Block pending version: ".$this->blocks->get_pending_version($block)."<br>";
    }
    
    public function copy_block($block_id = 0)
    {
        $copied_block = array(
            "block_id"  => $block_id,
            "version"   => $this->blocks->get_active_version($block_id)
            );

        //print_r( $this->user->get_session_data("copied_block"));
        $this->user->set_session_data("copied_block", $copied_block);

        
    }
    public function add_block()
    {
        $area_id = $_REQUEST['area'];
        $page = $_REQUEST['page_path'];

        echo $this->blocks->add($area_id, $page);
    }

    public function paste_block()
    {
        $copied_block = $this->user->get_session_data("copied_block");
        print_r($copied_block);
        if(!$copied_block){
            echo "No block";
            return;
        }
            
        $area_id = $_REQUEST['area'];
        $page = $_REQUEST['page_path'];

        $new_block = $this->blocks->add($area_id, $page);
        $this->blocks->copy($copied_block['block_id'], $copied_block['version'], $new_block, $this->blocks->get_pending_version($new_block), $area_id);
        $this->user->set_session_data("copied_block", false);
    }
    public function delete_block($id)
    {
        
        $this->blocks->delete($id);
    }
    public function save_block()
    {
        
        $id = $_REQUEST['id'];
        $style = (isset($_REQUEST['style'])) ? urldecode($_REQUEST['style']) : null;
        $classes = (isset($_REQUEST['classes'])) ? urldecode($_REQUEST['classes']) : null;
        $contents = (isset($_REQUEST['contents'])) ? urldecode($_REQUEST['contents']) : null;

        $this->blocks->save($id, $contents, $style, $classes);
    }
    public function is_valid_avatar($username)
    {
        if(file_exists("files/avatars/".$username.".jpg"))
            echo "true";
        else
            echo "false";
    }
    public function verify_login()
    {
        $user = urldecode($_POST['user']);
        $pass = urldecode($_POST['pass']);

        $user = $this->users->verify_login($user, $pass);
        if($user != 0){
            $this->user->initialize($user);
            $this->user->notify('success', "Login successful!");
            echo "success";
        }else
            echo "fail";
    }
    public function load_icon_selector(){
        $cssClassName = urldecode($_POST['base_class_name']);
        $html_tag = urldecode($_POST['html_tag']);
        $css_file = APPPATH."../".urldecode($_POST['css_file']);
        $data['target'] = $_POST['target'];

        $input = file_get_contents($css_file);

        preg_match_all('/([a-z0-9]*?\.?'.addcslashes($cssClassName, '-').'.*?)\s?\{/', $input, $matches);
        
        
        foreach($matches[1] as $key => &$class)
        {
            if(strpos($class, ":before") !== FALSE)
            {
                $class = substr($class,0,strpos($class, ":before"));
            }
            if($class[0] != "." || strpos($class, "+") !== FALSE || strpos($class, "[") !== FALSE || strpos($class, "\"" !== FALSE)){
                unset($matches[1][$key]);
                continue;
            }

            $matches[1][$key] = substr($class,1);
        }
        $icons = array_reverse($matches[1]);
        //print_r($matches[1]);
        $data['classes'] = $icons;
        $this->load->view("icon_selector", $data);

    }

    public function load_bg_selector(){

        $data['target'] = $_POST['target'];


        $this->load->view("bg_selector", $data);

    }

    public function load_block_editor() { ?>
        <div id="block-editor" style="position: relative; width: 640px;">
            <div class="block-editor"  style="width: 640px; position: absolute">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget second">
                            <div class="widget-title">
                                <div class="icon"><i class="icon20 i-menu-6"></i></div>
                                <h4>Block Editor</h4>
                                <a href="#" class="minimize"></a>
                            </div><!-- End .widget-title -->
                            <div class="widget-content">
                                <form class="form-horizontal">
                                    <div class="control-group">
                                        <div class="controls-row">
                                            <textarea id="text-editor" name="text-editor" class="span24" rows="4"></textarea>
                                        </div>
                                    </div><!-- End .control-group  -->
                                </form>
                                <button id="save-button" class="btn btn-primary">Save</button>
                                <button id="cancel-button" class="btn btn-primary">Cancel</button>
                            </div><!-- End .widget-content -->
                        </div><!-- End .widget -->
                    </div><!-- End .span6  -->
                </div>
            </div>
        </div>
<?php   }

    function load_versions_manager($mode){
        $page_path = urldecode($_POST['page_path']);

        if($mode == "page")
            $page_versions = $this->get_page_versions($page_path);
        else
            $page_versions = $this->get_page_versions("layout");
        foreach($page_versions as &$version)
        {

            if($version->author == 0)
                $version->author = "System";
            else
            {
                $author = $this->users->get_by_id($version->author);

                $version->author = ($author->name != "") ? $author->name : $author->username;
            }

            if($version->approver == 0)
                $version->approver = "System";
            else if($version->approver == -1)
            {
                $version->approver = "N/A";
            }else
            {
                $approver = $this->users->get_by_id($version->approver);
                $version->approver = ($approver->name != "") ? $approver->name : $approver->username;
            }


        }
        $data['mode'] = $mode;
        $data['page_versions'] = $page_versions;


        $this->load->view("versions_manager", $data);
    }

    

    public function publish_version()
    {
        //$this->db->query("LOCK TABLE be_blocks WRITE, be_page_versions WRITE, be_user_groups WRITE");
        $page_path = mysql_real_escape_string($_REQUEST['page']);
        $version_id = $this->versions->get_pending_page_version_id($page_path);
        if($version_id)
        {  
            $this->toggle_version_approved($version_id);
            $this->version_activate($version_id);
        }
        $page_path = "layout";
        $version_id = $this->versions->get_pending_page_version_id($page_path);
        if($version_id)
        {
            $this->toggle_version_approved($version_id);
            $this->version_activate($version_id);
        }


        //$this->db->query("UNLOCK TABLES");
    }
    function toggle_version_approved($id)
    {
        $this->user->require_group("Frontend Manager");
        if($this->versions->is_version_approved($id))
            echo "Approved";
        else
            echo "Not Approved";
        ($this->versions->is_version_approved($id)) ? $this->versions->disapprove_version($id) : $this->versions->approve_version($id);
    }

    function version_activate($id)
    {
        $this->user->require_group("Frontend Manager");
        $this->versions->activate_version($id);
    }
    function version_set_name()
    {
        $this->user->require_group("Frontend Manager");
        $version    = $_REQUEST['id'];
        $new_name   = urldecode($_REQUEST['new_name']);
        $this->versions->rename($version, $new_name);
    }
    function dashboard_get_date_before_now_visits($type, $days = 0)
    {
        $visits = $this->BuilderEngine->get_site_visits($type, $days, true);
        echo $visits;
    }
    function dashboard_get_visitors_graph($days)
    {
        $all_visits = $this->BuilderEngine->get_site_visits("all", $days, false);
        $unique_visits = $this->BuilderEngine->get_site_visits("unique", $days, false);

        $visits['all'] = json_encode( $all_visits);
        $visits['unique'] = json_encode( $unique_visits);
        echo json_encode($visits);
    }
    public function validate_unique_field($table, $field, $original_value = ""){
        $table = mysql_real_escape_string(urldecode($table));
        $field = mysql_real_escape_string(urldecode($field));

        $original_value = urldecode($original_value);


        foreach($_POST as $post_value) // Hackfix, I know
        {
           $value = $post_value; 
        }
        $value = urldecode($value);
        $value = mysql_real_escape_string($value);

        $this->db->where(array($field => $value));
        $this->db->from($table);

        $count = $this->db->count_all_results();
        $exists = $count != 0;

        if($exists && $value != $original_value)
            echo "false";
        else
            echo "true";
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */