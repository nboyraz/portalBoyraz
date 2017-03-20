<?php
define('DS',DIRECTORY_SEPARATOR);
define('ROOT',dirname(dirname(__FILE__)));
define('VIEWS_PATH',ROOT.DS.'views');

require_once (ROOT.DS.'lib'.DS.'init.php');

if($_POST){ 
    /*isset($_POST['method_type']) && $_POST['method_type'] == "ajax" && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'*/
    /*$ajax_res = App::routeAjaxCall($_SERVER['REQUEST_URI']);
    $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
    fwrite($myfile,'sonuc:'.$ajax_res);
    fclose($myfile);
    echo $ajax_res;*/
}
else{
    App::run($_SERVER['REQUEST_URI']);
}

/*
yapilacaklar
1-session baslatilacak
2-login olmus druumlar icin router classin route ozelligi ayarlanacak(otomatik admin/login olarak)
3-app::run fonksiyonunda router static, birden fazla cagridaki durumuna bakilacak, gerekirse statik olmayacak
4-db ayarları yenıden yapılacak(app.class.php icinde commentlendi)
*/
?>