<?php
    class Webparts{
        public static function getStandartHeader(){
            ob_start(); ?>
           <nav class="navbar navbar-inverse navbar-fixed-top" id="MainNavBar">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span> 
                            </button>
                            <a class="navbar-brand" href="<?php echo Config::get('site_domain'); ?>"><span id="logo"><?=Config::get('site_name')?></span></a>
                        </div>
                        <div id="myNavbar" class="collapse navbar-collapse">
                            <ul class="nav navbar-nav">
                                <li><a <?php if(App::getRouter()->getController()=='Mains'){ echo 'class="active"'; }?> href="<?php echo Config::get('site_domain'); ?>mains/">Ana Sayfa</a></li>
                                <li><a <?php if(App::getRouter()->getController()=='Photos'){ echo 'class="active"'; }?> href="<?php echo Config::get('site_domain'); ?>photos/">Resimler</a></li>
                                <li><a <?php if(App::getRouter()->getController()=='Ftrees'){ echo 'class="active"'; }?> href="<?php echo Config::get('site_domain'); ?>ftrees?vmod=full">Soy Ağacı</a></li>
                                <li><a <?php if(App::getRouter()->getController()=='Events'){ echo 'class="active"'; }?> href="<?php echo Config::get('site_domain'); ?>events/">Duyurular</a></li>
                                <li><a <?php if(App::getRouter()->getController()=='contacts'){ echo 'class="active"'; }?> href="<?php echo Config::get('site_domain'); ?>contacts/">İletişim</a></li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                              <li><a href="#"><span class="glyphicon glyphicon-user"></span> Üye Olun</a></li>
                              <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Üye Girişi</a></li>
                            </ul>
                        </div>
                </div>
            </nav>                
            <?php return  ob_get_clean();
        }

        public static function getLeftSiteMenu($leftMenu){
            ob_start();  ?>
            
                        <div id="LeftSidebarContainer">
                            <div class='col-sm-3 sidebar mainSideBars' id="LeftSidebar">
                                <p/>
                                <h3 style="color: white;">Güncel Başlıklar</h3>
                                <ul class="nav nav-tabs nav-stacked">
                                <?php
                                    if(isset($leftMenu) && count($leftMenu) > 0){
                                        for($i=0;$i<count($leftMenu);$i++){
                                            echo "<li><a target='_blank' href='http://www.google.com.tr'>".$leftMenu[$i]->MenuContent."</a></li>";
                                        }
                                    }
                                ?>
                                </ul>
                            </div>
                        </div>
            
            <?php return  ob_get_clean();
        }

        public static function getRigthSiteBar($rightMenu){
            ob_start(); ?>
                        <div id="RightSidebarContainer">
                            <div class='col-sm-2 sidebar mainSideBars' id="RightSidebar">
                                <h3>Duyuru/Haber/İlan</h3>
                                <ul class="nav nav-tabs nav-stacked">
                                <?php
                                    if(isset($rightMenu) && count($rightMenu) > 0){
                                        for($i=0;$i<count($rightMenu);$i++){
                                            echo '<li><a target="_blank" href="http://www.google.com.tr" class="RightSidebarItem">'.$rightMenu[$i]->MenuContent.'</a></li>';
                                        }
                                    }
                                ?>
                                </ul>
                            </div>  
                        </div>            
            <?php return  ob_get_clean();
        }

        public static function getStandartFooter(){
            ob_start(); ?>
            <div id="footer">
                <div class="container">
                    <div class="row">
                        <h3 class="footertext">Site Hakkında:</h3>
                        <br>
                        <div class="col-md-4">
                            <center>
                            <img src="<?php echo Config::get('site_domain'); ?>webroot/img/footer_developer.png" class="img-circle" alt="the-brains">
                            <br>
                            <h4 class="footertext">Yazılım Geliştirici</h4>
                            <p class="footertext">Necip Fazıl Boyraz<br>
                            </center>
                        </div>
                        <div class="col-md-4">
                            <center>
                            <img src="<?php echo Config::get('site_domain'); ?>webroot/img/footer_designer.png" class="img-circle" alt="...">
                            <br>
                            <h4 class="footertext">Site Tasarım</h4>
                            <p class="footertext">Necip Fazıl Boyraz<br>
                            </center>
                        </div>
                        <div class="col-md-4">
                            <center>
                            <img src="<?php echo Config::get('site_domain'); ?>webroot/img/footer_moderator.png" class="img-circle" alt="...">
                            <br>
                            <h4 class="footertext">Site Moderatorler</h4>
                            <p class="footertext">Necip Fazıl Boyraz<br>
                            </center>
                        </div>
                    </div>
                    <div class="row">
                        <p><center><a href="#">Site geliştiricileri ile irtibata geçin</a> <p class="footertext">Telif Hakkı 2017</p></center></p>
                    </div>
                </div>
            </div>            
            <?php return  ob_get_clean();
        }

        public static function getStandartContent($data){
            $content = $data['content'];
            ob_start(); ?>
            <div id="Content">
                <div class="container">
                    <div class="row">
                        <?php echo Webparts::getLeftSiteMenu(isset($data['leftMenu']) ? $data['leftMenu'] : null); ?>
                        <div class="col-sm-7 main">
                            <div class="starter-template">
                                <?php if(Session::hasFlash()){ ?>
                                <div class="alert alert-info" role="alert">
                                    <?php Session::flash(); ?>
                                </div>
                                <?php } ?>
                                <?php echo $content; ?>
                            </div>
                        </div> 
                        <?php echo Webparts::getRigthSiteBar(isset($data['rightMenu']) ? $data['rightMenu'] : null); ?>
                    </div> 
                </div> 
            </div>
            <?php return  ob_get_clean();
        }

        public static function getLargeContent($data){
            $content = $data['content'];
            ob_start(); ?>
            <div id="Content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 main">
                            <div class="starter-template">
                                <?php if(Session::hasFlash()){ ?>
                                <div class="alert alert-info" role="alert">
                                    <?php Session::flash(); ?>
                                </div>
                                <?php } ?>
                                <?php echo $content; ?>
                            </div>
                        </div> 
                    </div> 
                </div> 
            </div>
            <?php return  ob_get_clean();
        }

        public static function getFullContent($data){
            $content = $data['content'];
            echo $content;
        }
    }
?>