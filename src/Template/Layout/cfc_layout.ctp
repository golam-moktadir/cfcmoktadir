<!DOCTYPE html>
<html>
<head>
    <title>CFC</title>
    <!-- meta tags start -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Keywords" content="crikey, premium, mobile, template, HTML, Css" />
    <meta name="Description" content="Premium mobile HTML/CSS template." />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <!-- meta tags end -->
    <!-- favorite icon starts -->
    <link href="<?php echo $this->Url->image('fv.png') ?>" rel="icon"/>
    <!-- Google fonts start -->
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css' />
    <!-- CSS files start -->
    <link href="<?php echo $this->Url->css('framework.css') ?>" rel="stylesheet" type="text/css" media="all" />
    <link href="<?php echo $this->Url->css('colorbox.css') ?>" rel="stylesheet" type="text/css" media="all" />
    <link href="<?php echo $this->Url->css('elements.css') ?>" rel="stylesheet" type="text/css" media="all" />
    <link href="<?php echo $this->Url->css('style.css') ?>" rel="stylesheet" type="text/css" media="all" />
    <link href="<?php echo $this->Url->css('responsive.css') ?>" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo $this->Url->css('hidpi.css') ?>" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo $this->Url->css('skin.css') ?>" rel="stylesheet" type="text/css" media="all" />
    <link href="<?php echo $this->Url->css('custom.css') ?>" rel="stylesheet" type="text/css" media="all" />
    <!-- CSS files end -->
    <!-- JavaScript files start -->
    <script type="text/javascript" src="<?php echo $this->Url->script('jquery.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo $this->Url->script('effects.jquery-ui.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo $this->Url->script('jquery.nivo-slider.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo $this->Url->script('jquery.colorbox.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo $this->Url->script('custom.js') ?>"></script>
    <!-- JavaScript files end -->
</head>
<body>
<div>
    <div class="headerOuterWrapper">
        <div class="headerWrapper">
            <a class="mainLogo" href="#">
                <?php echo $this->Html->image('common/mainLogo.png',['width'=>'210', 'height'=>'66', 'align'=>'middle', 'alt'=>'B2M WAP']) ?>
            </a>
            <a href="#" class="mainMenuButton"></a><span class="mainMenuDecoLine"></span> 
        </div>
        <ul class="mainMenuWrapper">
            <li class="currentPage"><?php echo $this->Html->link('Home','/')?></li>
            <li><?php echo $this->Html->link('Wallpaper','/details/content-details/Wallpaper')?></li>
            <li><?php echo $this->Html->link('Animation','/details/content-details/Animation')?></li>
            <li><?php echo $this->Html->link('Video','/details/content-details/Video')?></li>
            <li><?php echo $this->Html->link('News','/details/news-details')?></li>
        </ul>
    <!-- main menu wrapper ends -->
    </div>
    <?= $this->fetch('content') ?>
    <div class="footerWrapper">
    <!-- copyright wrapper starts -->
        <div class="copyrightWrapper">
            <!-- copyright starts -->
            <span class="copyright">B2M &copy All Rights Are Resereved</span>
            <!-- copyright ends -->
            <!-- back to top button starts -->
            <a href="#" class="backToTopButton"></a>
            <!-- back to top button ends -->
        </div>
    <!-- copyright wrapper ends -->
    </div>
</div>
</body>
</html>