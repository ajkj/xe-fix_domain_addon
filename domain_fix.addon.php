<?php

if(!defined('__XE__')) exit();

if( $called_position !== 'before_module_init' ) return;

if(isset($addon_info->enabled) === false){
    $addon_info->enabled = 'N';
}


/*
애드온을 강제로 중지하려면
아래의

//$addon_info->enabled = 'N'; 을
$addon_info->enabled = 'N'; 로 바꿔주세요.

다시 사용하시려면 거꾸로 하시면 됩니다.
*/

//$addon_info->enabled = 'N';

$xe_default_url = Context::getDefaultUrl();
$default_http_host = parse_url(Context::getDefaultUrl(), PHP_URL_HOST);

if($addon_info->enabled === 'Y'  && (empty($_SERVER['HTTP_HOST']) || $default_http_host !== $_SERVER['HTTP_HOST']) ) {
    Context::close();
    header('Location: '.$xe_default_url, true, 301);
    exit('301 Moved Permanently : '.htmlspecialchars($xe_default_url));
}else{
    return;
}