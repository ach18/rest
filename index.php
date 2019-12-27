<?php
//отключить кэширование на время отладки
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s")." GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Cache-Control: post-check=0,pre-check=0", false);
header("Cache-Control: max-age=0", false);
header("Pragma: no-cache");

include __DIR__ . '/autoload.php';
spl_autoload_register('autoloader');

if(isset($_SERVER['HTTP_USER_AGENT']) && ($_SERVER['HTTP_USER_AGENT'] != "PostmanRuntime/7.21.0") && ($_SERVER['HTTP_USER_AGENT'] != "curl/7.55.1")
&& ($_SERVER['HTTP_USER_AGENT'] != "curl/7.67.0") && !(isset($_SERVER['HTTP_X_REQUESTED_WITH'])))
    include __DIR__ . '/views/page.php';
else include __DIR__ . '/data.php';