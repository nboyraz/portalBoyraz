<?php
    Config::set('site_name', 'portalBoyraz');
    Config::set('site_domain', 'https://secret-waters-15848.herokuapp.com/');
    Config::set('languages', array('en','tr'));

    //routes. route name => method prefix
    Config::set('routes', array('default'=>'','login'=>'login_'));

    Config::set('default_route', 'default');
    Config::set('default_language', 'tr');
    Config::set('default_controller', 'welcome');
    Config::set('default_action', 'index');

    //database connection
    Config::set('db.host', 'localhost');
    Config::set('db.user', 'root');
    Config::set('db.password', '');
    Config::set('db.db_name', 'boyrazdb');
?>