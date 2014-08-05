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


class Admin_main extends BE_Controller {

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

     public function Admin_main(){
         parent::__construct();


         if($this->uri->segment(3) != 'login' && $this->uri->segment(3) != 'recover_password' && $this->uri->segment(3) != 'logout'){

             $this->user->require_group("Administrators");
         }else if($this->uri->segment(3) == 'login')
            if($this->user->is_logged_in())
                redirect("/admin/main/dashboard", 'location');


     }
     public function dashboard(){

        $this->show->set_default_breadcrumb(0, "Dashboard", "");

        $current_version = $this->BuilderEngine->get_option('version');

        $remote_version = $this->cache->fetch("latest_be_version");
        if($remote_version == null)
        {
            $remote_version = file_get_contents("http://update-server.builderengine.com/check.php?version=".$current_version);
            $this->cache->insert("latest_be_version", $remote_version, 120);    
        }
        

        if($current_version != $remote_version){
            $data['update_available'] = true;
            $this->user->alert("Website Update is available.", "/admin/update/index", "i-download-4", "be-update");
        }else    
            $data['update_available'] = false;

        $location_cache_id = "be_visitor_location_".$_SERVER['REMOTE_ADDR'];
        $location = $this->cache->fetch($location_cache_id);
        if($location == null){
            $location = $this->getLocation($_SERVER['REMOTE_ADDR']);
            $this->cache->insert($location_cache_id, $location, 2678400);
        }
            
        $weather_cache_id = "be_admin_weather_forecast_".md5(serialize($location));
        $weather = $this->cache->fetch($weather_cache_id);
        if($weather == null && $weather = $this->getWeather($location)){
            $this->cache->insert($weather_cache_id, $weather, 3600);    
        }
            
        $data['news'] = $this->getNews();
        $data['weather'] = $weather;

        $this->show->backend('dashboard', $data);
     }
    public function login()
    {
        if(isset($_POST['forgot']))
        {
            $this->users->send_password_reset_email(urldecode($_POST['email']));
        }
        $data['login'] = true;
        $this->show->backend('index', $data);

    }
    public function recover_password($token = FALSE)
    {
        $this->users->validate_password_reset_token($token);
        if($_POST && $token)
            $this->users->reset_password($token, $_POST['password']);

        $data['token'] = $token;
        $data['login'] = true;
        $this->show->backend('recover_password', $data);

    }

    public function settings()
    {
        $this->show->set_default_breadcrumb(0, "Settings", "");
        $this->show->set_default_breadcrumb(1, "General", "");
        $this->load->model("builderengine");

        if($_POST)
            foreach($_POST as $key=>$value)
            {
                $this->builderengine->set_option($key, $value);
            }


        $data['builderengine'] = &$this->builderengine;
        $this->show->backend('settings', $data);
    }

    public function logout()
    {
        $this->user->logout();
        redirect("/admin/main/login", 'location');

    }
    public function verify_login($user, $pass){
        $user = $this->users->verify_admin_login($user, $pass);
        if($user != 0){
            $this->user->initialize($user);
            echo "success";
        }else
            echo "fail";
    }
    function getCurrentWeather($city)
    {
        $url = "http://api.openweathermap.org/data/2.5/weather?q=$city&mode=json&units=metric";
        $json = @file_get_contents($url);
        $weatherData = json_decode($json, true);

        return $weatherData;
    }
    function getWeatherIconClass($weather)
    {

        switch(substr($weather, 0, 2))
        {
            case "01":
                if($weather == "01d")
                    return "i-sun-2 orange";
                else
                    return "i-moon ";
            break;
            case "02":
                return "i-cloud";
            break;

            case "03":
                return "i-cloud-2 dark";
            break;

            case "04":
                return "i-cloud-2 dark";
            break;

            case "09":
                return "i-weather-rain dark";
            break;

            case "10":
                return "i-weather-rain blue";
            break;
            case "11":
                return "i-weather-lightning red-smooth";
            break;

            case "13":
                return "i-weather-snow blue";
            break;


            default:
                return "";
            break;
        }
    }
    function getNews()
    {
        $url = 'http://builderengine.com/client/ajax/news';

        $json = file_get_contents($url);

        return json_decode($json, true);  
    }
    function getLocation($ip)
    {
        $url = "http://ip-api.com/json/".$ip;
        $json = file_get_contents($url);

        $ip_data = json_decode($json, true);
        return $ip_data;
    }
    function getWeather($id)
    {
        if(!empty($id))
        {
            $current_weather = $this->getCurrentWeather($id['city'].",".$id['countryCode']);
            $result['location'] = $id['city'].", ".$id['country'];
            $result['now']['temp'] = round($current_weather['main']['temp']);
            $result['now']['code'] = $current_weather['weather'][0]['icon'];
            $result['now']['icon_class'] = $this->getWeatherIconClass($result['now']['code']);

            $url = 'http://api.openweathermap.org/data/2.5/forecast/daily?q='.$id['city'].",".$id['countryCode'].'&mode=json&units=metric&cnt=7';

            $json = @file_get_contents($url);

            $weatherData = json_decode($json, true);

            for($i = 1; $i < 7; $i++){
                //echo "<pre>";
               // print_r($weatherData);
                $result[$i]['time'] = $weatherData['list'][$i]['dt'];
                $result[$i]['temp']['min'] = ceil($weatherData['list'][$i]['temp']['min']);
                $result[$i]['temp']['max'] = floor($weatherData['list'][$i]['temp']['max']);
                $result[$i]['code'] = $weatherData['list'][$i]['weather'][0]['icon'];
                $result[$i]['icon_class'] = $this->getWeatherIconClass($result[$i]['code']);

            }

            //$result['now']['type'] = $weatherData['list'][0]
            return $result;
        }
    }
    function weather()
    {

        error_reporting(0);
        Header('Content-Type: text/html; charset=utf-8');



        $weather = $this->getWeather('Sofia'); // id нужного города
        file_put_contents('weather.png', file_get_contents($weather['img'])); // сохраним картинку погоды для вывода в качество иконки для notify-send.

        echo $weather['name']."\n";
        echo $weather['now']['temp']." °C\n";
        echo "Now: \n";
        echo "Clouds: ".$weather['clouds']."% \n";
        echo "Pressure: ".$weather['pressure']." hpa \n";
        echo "Humidity: ".$weather['humidity']."% \n";

    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */