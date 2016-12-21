<?php get_header(); ?>
  <div id="main" class="sing">
    <div id="content-single">
    <div>
    <?php if ( function_exists('yoast_breadcrumb') ) {
    yoast_breadcrumb('<p id="breadcrumbs">','</p>');
    } ?>
    </div>
    <?php if (have_posts()) { ?>
    <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
        <?php while (have_posts()) { the_post(); ?>    
        <div class="post singCompany">
            <div class="entry">
        <h1><?php the_title(); ?></h1>
        
    <div class="org_info">
    <?php if (get_org_logo()) { ?><div class="org_logo"><?php echo get_org_logo('150x99999'); ?></div><?php }; ?>
    <?php if(get_field('short_description')) { ?><div class="org_description"><?php the_field('short_description'); ?></div><?php }; ?>
    <div class="clear"></div>
    </div>
    <h3>Контактная информация</h3>
    <div class="org_contacts">
    <div class="org_phones"><?php get_org_phones(); ?></div>
    <div class="org_info_dop">
        <div class="org_city"><?php echo get_org_city(); ?></div>
        <?php if (get_org_address() !="") { ?><div class="org_address"><span class="org_address_content">Адрес: <?php echo get_org_address(); ?></span></div><?php }; ?>
        <div class="org_meto"><?php get_org_metro(); ?></div>
    </div>    
    </div>


    <h3>Предоставляемые услуги</h3>
    <div class="org_categories"><?php get_org_service(); ?></div>
    <h2>Примеры работ</h2>
    <div class="org_portfolio"><?php get_org_portfolio('100x100'); ?></div>
    <div class="clear"></div>
          
    <h2>Отзывы о частном мастере</h2>
    <?php comments_template( '', true ); ?> 
                  
            <?php //the_content(); ?>
      
            </div>
                  <div class="clear"></div>
          <?='<noindex>'?>
          <div id="social">
            <div id="socialText">Поделись с друзьями в социальных сетях!</div>
            <div class="social">
                    <div
                    class="yashare-auto-init"
                    data-yashareLink=""
                    data-yashareL10n="ru"
                    data-yashareType="big"
                    data-yashareQuickServices="vkontakte,facebook,twitter,moimir"
                    data-yashareTheme="counter"
                    ></div>    
            </div> 
          </div>
          <?='</noindex>'?>
          <div class="clear"></div>
           <?php
             related_posts();      
               ?>     
          <div class="clear"></div>
          <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- otoplenie-netboard -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:580px;height:400px"
                 data-ad-client="ca-pub-7071017073406853"
                 data-ad-slot="7514615572"></ins>
            <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
          <div class="clear"></div>
          <div class="vkComments">
            <!-- Put this script tag to the <head> of your page -->
            <script type="text/javascript" src="//vk.com/js/api/openapi.js?115"></script>

            <script type="text/javascript">
              VK.init({apiId: 4530830, onlyWidgets: true});
            </script>

            <!-- Put this div tag to the place, where the Comments block will be -->
            <div id="vk_comments"></div>
            <script type="text/javascript">
            VK.Widgets.Comments("vk_comments", {limit: 10, width: "725", attach: "graffiti,photo,video,audio"});
            </script>
          </div>
          <div class="clear"></div>
          <?php edit_post_link('Редактировать', '<p>', '</p>');?> 
        </div>
        <?php } ?>

          <?php } else { ?>
        <h2>Ничего не найдено</h2>
    <?php } ?>     
    </div><!--/content -->
    <?php get_sidebar(); ?>
 </div><!--/main -->

<?php get_footer(); ?>