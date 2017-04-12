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
    Config::set('event_page_size', 5);

    //database connection
    //Config::set('db.host', 'mysql8.db4free.net:3307');
    Config::set('db.host', '85.10.205.173:3307');//mysql8.db4free.net:3307
    Config::set('db.user', 'lord_strider');
    Config::set('db.password', '20122001');
    Config::set('db.db_name', 'nfb_pb');
?>