<?php
    class Webparts{
        public static function getStandartHeader(){
            ob_start(); ?>
           <nav class="navbar navbar-inverse navbar-fixed-top">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span> 
                            </button>
                            <a class="navbar-brand" href="/portalboyrazv2/"><span id="logo"><?=Config::get('site_name')?></span></a>
                        </div>
                        <div id="myNavbar" class="collapse navbar-collapse">
                            <ul class="nav navbar-nav">
                                <li><a <?php if(App::getRouter()->getController()=='Mains'){ echo 'class="active"'; }?> href="/portalboyrazv2/mains/">Ana Sayfa</a></li>
                                <li><a <?php if(App::getRouter()->getController()=='Photos'){ echo 'class="active"'; }?> href="/portalboyrazv2/photos/">Resimler</a></li>
                                <li><a <?php if(App::getRouter()->getController()=='Ftrees'){ echo 'class="active"'; }?> href="/portalboyrazv2/ftrees/">Soy Ağacı</a></li>
                                <li><a <?php if(App::getRouter()->getController()=='Events'){ echo 'class="active"'; }?> href="/portalboyrazv2/events/">Duyurular</a></li>
                                <li><a <?php if(App::getRouter()->getController()=='contacts'){ echo 'class="active"'; }?> href="/portalboyrazv2/contacts/">İletişim</a></li>
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

        public static function getLeftSiteMenu(){
            ob_start();  ?>
            
                        <div id="LeftSidebarContainer">
                            <div class='col-sm-3 sidebar mainSideBars' id="LeftSidebar">
                                <p/>
                                <h3 style="color: white;">Güncel Başlıklar</h3>
                                <ul class="nav nav-tabs nav-stacked">
                                <li><a href='#'>portalBoyraz Açıldı!!!</a></li>
                                <li><a href='#'>Nuh Boyraz'dan "Almanak" Çalışması</a></li>
                                <li><a href='#'>Duyuru İlan Bölümünde Sizler İçin Ne Var?</a></li>
                                <li><a href='#'>Kimle Nasıl Akrabayım? Soyağacı Tam Size Göre</a></li>
                                <li><a href='#'>Yazılımla İlgilenen Boyraz Bireyleri Buraya...</a></li>
                                </ul>
                            </div>
                        </div>
            
            <?php return  ob_get_clean();
        }

        public static function getRigthSiteBar(){
            ob_start(); ?>
                        <div id="RightSidebarContainer">
                            <div class='col-sm-2 sidebar mainSideBars' id="RightSidebar">
                                <h3>Duyuru/Haber/İlan</h3>
                                <ul class="nav nav-tabs nav-stacked">
                                <li><a href='#' class="RightSidebarItem">Ahmet Selim Boyraz Evleniyor</a></li>
                                <li><a href='#' class="RightSidebarItem">Tahsin Boyraz'dan Satılık 3+1 Ev</a></li>
                                <li><a href='#' class="RightSidebarItem">İstanbul'da Erkek Öğrenci İçin Ev Arkadaşı Aranıyor</a></li>
                                <li><a href='#' class="RightSidebarItem">Temiz Scoda Octavia!!!</a></li>
                                <li><a href='#' class="RightSidebarItem">Guvenlik Elemani Araniyor</a></li>
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
                            <img src="//127.0.0.1/portalboyrazv2/webroot/img/footer_developer.png" class="img-circle" alt="the-brains">
                            <br>
                            <h4 class="footertext">Yazılım Geliştirici</h4>
                            <p class="footertext">Necip Fazıl Boyraz<br>
                            </center>
                        </div>
                        <div class="col-md-4">
                            <center>
                            <img src="//127.0.0.1/portalboyrazv2/webroot/img/footer_designer.png" class="img-circle" alt="...">
                            <br>
                            <h4 class="footertext">Site Tasarım</h4>
                            <p class="footertext">Necip Fazıl Boyraz<br>
                            </center>
                        </div>
                        <div class="col-md-4">
                            <center>
                            <img src="//127.0.0.1/portalboyrazv2/webroot/img/footer_moderator.png" class="img-circle" alt="...">
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
    }
?>