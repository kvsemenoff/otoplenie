<?php get_header(); ?>
  <div id="main" class="sing">
	<div id="content-single">
   <div>
    <?php if ( function_exists('yoast_breadcrumb') ) {
    yoast_breadcrumb('<p id="breadcrumbs">','</p>');
    } ?>
    </div>
	<?php if (have_posts()) { ?>
		<?php while (have_posts()) { the_post(); ?>    
		<div class="post">
			<div class="entry">
        <h1><?php the_title(); ?></h1>
          <?php
             //if (is_single(2360)) { ?>
            
           <?php
//             } else if (is_single(4122)) {
//             ?>
            
             <?php
//             } else { 
          ?>
            <div class="rekl">
            <!-- Яндекс.Директ -->
            <script type="text/javascript">
            yandex_partner_id = 136856;
            yandex_stat_id = 999;
            yandex_site_bg_color = 'FFFFFF';
            yandex_ad_format = 'direct';
            yandex_font_size = 1.2;
            yandex_font_family = 'tahoma';
            yandex_direct_type = 'flat';
            yandex_direct_border_type = 'ad';
            yandex_direct_limit = 2;
            yandex_direct_title_font_size = 3;
            yandex_direct_links_underline = true;
            yandex_direct_title_color = 'FF0000';
            yandex_direct_border_color = 'FEEBC8';
            yandex_direct_url_color = '000000';
            yandex_direct_text_color = '000000';
            yandex_direct_hover_color = '006DB5';
            yandex_direct_favicon = true;
            yandex_no_sitelinks = true;
            document.write('<scr'+'ipt type="text/javascript" src="//an.yandex.ru/system/context.js"></scr'+'ipt>');
            </script>
          </div>
          <?php
           //  }       
                ?>      
			<?php the_content(); ?>
          <div class="rekl">
            <script type="text/javascript">
                    yandex_partner_id = 136856;
                    yandex_site_bg_color = 'FFFFFF';
                    yandex_stat_id = 50;
                    yandex_ad_format = 'direct';
                    yandex_font_size = 1.2;
                    yandex_direct_type = 'flat';
                    yandex_direct_border_type = 'ad';
                    yandex_direct_limit = 4;
                    yandex_direct_title_font_size = 3;
                    yandex_font_family = 'arial';
                    yandex_direct_title_color = 'FF0000';
                    yandex_direct_border_color = 'FEEBC8';
                    yandex_direct_url_color = '000000';
                    yandex_direct_text_color = '333333';
                    yandex_direct_hover_color = '0FACEA';
                    yandex_direct_favicon = true;
                    yandex_no_sitelinks = false;
                    document.write('<scr'+'ipt type="text/javascript" src="//an.yandex.ru/system/context.js"></scr'+'ipt>');
            </script>
          </div>  
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
          <div class="commentForm">
              <?php comments_template(); ?>
          </div>
          <div class="clear"></div>
          <?= do_shortcode('[block id="2"]');?>
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