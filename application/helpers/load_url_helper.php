<?php

// function asset_url($path=false){
//     $ci         =&  get_instance();
//     $basePath   =   $ci->config->item('assetPath');
//     if($path==false){
//         return $basePath;
//     }else{
//         return $basePath.$path;
//     }
// }
function api_url($path = false){
    // $ci         =&  get_instance();
    $basePath   =  "http://localhost/fire_station/api/";
    if($path==false){
//    	die("wa");
        return $basePath;
    }else{
    	die($basePath.$path);
        return $basePath.$path;
    }
}


