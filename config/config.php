<?php
    Config::set('site_domain', 'https://secret-waters-15848.herokuapp.com/');//site domain ile dosya eklerken bu kullanilir
    Config::set('site_prefix_folder', '');//site request uri de bir on dosya varsa(ornek http://localhost/portalboyraz/contacts)
    Config::set('site_name', 'portalBoyraz');
    Config::set('languages', array('en','tr'));

    //routes. route name => method prefix
    Config::set('routes', array('default'=>'','login'=>'login_'));
    Config::set('default_route', 'default');
    Config::set('default_language', 'tr');
    Config::set('default_controller', 'welcome');
    Config::set('default_action', 'index');
    Config::set('view_mode_pages', array('ftrees'));

    //database connection
    Config::set('db.host', 'localhost');
    Config::set('db.user', 'root');
    Config::set('db.password', '');
    Config::set('db.db_name', 'boyrazdb');
?>