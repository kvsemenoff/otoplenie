<?php session_start();?>
<!DOCTYPE html>
<html lang="ru">
<head>
<title><?php wp_title();?></title>
<meta charset="utf-8" />
<!--[if IE]><meta http-equiv="X-UA-Compatable" content="IE=edge" /><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>

<link rel="shortcut icon" href="/favicon.ico" />
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
        
        <div id="HeaderSearch">
            
            <div id="advb1">
            <!-- Yandex.RTB R-A-136856-2 -->
                <div id="yandex_rtb_R-A-136856-2"></div>
                <script type="text/javascript">
                    (function(w, n) {
                        w[n] = w[n] || [];
                        w[n].push(function() {
                            Ya.Context.AdvManager.render({
                                blockId: "R-A-136856-2",
                                renderTo: "yandex_rtb_R-A-136856-2",
                                async: false
                            });
                        });
                        document.write('<sc'+'ript type="text/javascript" src="//an.yandex.ru/system/context.js"></sc'+'ript>');
                    })(this, "yandexContextSyncCallbacks");
                </script>
            </div>
        </div>
     
      </div>
	</div>
    <div class="clear"></div>
     <div class="menuTop">
        <?php wp_nav_menu('menu=top');   ?>
     </div>
    <div class="clear"></div>
    <div class="searchCenter">
        <?php include('ya-search.inc'); ?>
    </div>
    <!--/header -->