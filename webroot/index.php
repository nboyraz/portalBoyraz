<?php
define('DS',DIRECTORY_SEPARATOR);
define('ROOT',dirname(dirname(__FILE__)));
define('VIEWS_PATH',ROOT.DS.'views');

require_once (ROOT.DS.'lib'.DS.'init.php');

App::run($_SERVER['REQUEST_URI']);
/*
yapilacaklar
1-session baslatilacak
2-login olmus druumlar icin router classin route ozelligi ayarlanacak(otomatik admin/login olarak)
3-app::run fonksiyonunda router static, birden fazla cagridaki durumuna bakilacak, gerekirse statik olmayacak
4-sayfalarda view ksmina bir mod eklenecek ve sayfanin hangi containerda acildigini belli edecek, sayfalar buna gore acilacak
5-db ayarları yenıden yapılacak(app.class.php icinde commentlendi)
*/
?>