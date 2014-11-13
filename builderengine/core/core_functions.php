<?php

    
    function includeRecurse($dirName) { 
        if(!is_dir($dirName)) 
            return false;          
        $dirHandle = opendir($dirName); 
        while(false !== ($incFile = readdir($dirHandle))) { 
            if($incFile != "." && $incFile != "..") { 
                if(is_file("$dirName/$incFile")) 
                    include_once("$dirName/$incFile"); 
                elseif(is_dir("$dirName/$incFile")) 
                    includeRecurse("$dirName/$incFile"); 
            } 
        } 
        closedir($dirHandle); 
    }
    
    function check_writable_recurse($dirName) {
        if($dirName[0] == ".")
            return true;
        if(!is_dir($dirName)) 
            return false;          
        $dirHandle = opendir($dirName); 
        while(false !== ($incFile = readdir($dirHandle))) { 

            if($incFile != "." && $incFile != "..") { 
                if(is_file("$dirName/$incFile")) 
                    if(!is_writable("$dirName/$incFile"))
                        return false; 
                elseif(is_dir("$dirName/$incFile")) 
                    if(!check_writable_recurse("$dirName/$incFile"))
                        return false; 
            } 
        }
        echo $incFile; 
        return true;
    }
    function check_php_version($required_version)
    {
        $current_version = phpversion();

        return version_compare($current_version, $required_version, '>=');
    }

    function get_php_version()
    {
        return phpversion();
    }
?>
