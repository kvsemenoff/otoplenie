<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php wp_title();?></title>
<?php wp_head(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="/favicon.ico" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link href="https://plus.google.com/117066684890485410859" rel="publisher" />
<script type="text/javascript" src="//vk.com/js/api/openapi.js?115"></script>
</head>
<body>
<?php if( is_front_page() ){?>
<?php set_post_thumbnail_size( 50, 99999 ); ?>
<?php }?>
<div id="page">
    <div id="header">
       
    <div id="headerimg">
      <div id="inheaderimg">
        <?php if( is_front_page() ){?>
        <img src="<?php bloginfo('template_directory'); ?>/images/logo.png" alt="Отопление дома" title="Отопление"  /> 
        <?php  } else {  ?>
        <span id="ajax-logo"></span>    
            
       <?php }?>
       
       <p id="slogan">Современные системы отопления</p>    
        </div>
        
        <div class="HeaderAdv"><img src="<?php bloginfo('template_directory'); ?>/images/adv/350x100-1.jpg" alt="Реклама на сайте" /></div>
        <div class="HeaderAdv"><img src="<?php bloginfo('template_directory'); ?>/images/adv/350x100-2.jpg" alt="Реклама на сайте" /></div>
     
      </div>
    </div>
    <div class="clear"></div>
    <!--/header -->