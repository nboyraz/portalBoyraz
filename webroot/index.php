<?php
define('DS',DIRECTORY_SEPARATOR);
define('ROOT',dirname(dirname(__FILE__)));
define('VIEWS_PATH',ROOT.DS.'views');

require_once (ROOT.DS.'lib'.DS.'init.php');

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['method_type']) && $_POST['method_type'] == "ajax"){ 
    $ajax_res = App::routeAjaxCall($_SERVER['REQUEST_URI']);
    echo json_encode($ajax_res);
}
else{
    App::run($_SERVER['REQUEST_URI']);
}

/*
yapilacaklar
1-session baslatilacak
2-login olmus druumlar icin router classin route ozelligi ayarlanacak(otomatik admin/login olarak)
3-app::run fonksiyonunda router static, birden fazla cagridaki durumuna bakilacak, gerekirse statik olmayacak
*/
?>