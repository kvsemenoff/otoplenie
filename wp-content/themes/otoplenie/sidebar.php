<?php //get_search_form(); ?>
    <div id="sidebar">
       <?php if (is_single()|| is_404() || is_page()) { ?>
        <?php
           if (is_page('reklama-na-sajte')) {
            ?>
              <div class="sidebarAdv">
                <div class="inSidebarAdv"><img src="<?php bloginfo('template_directory'); ?>/images/adv/215x100-3.jpg" alt="Реклама на сайте" /></div>
                <div class="inSidebarAdv"><img src="<?php bloginfo('template_directory'); ?>/images/adv/215x100-4.jpg" alt="Реклама на сайте" /></div>
                <div class="inSidebarAdv"><img src="<?php bloginfo('template_directory'); ?>/images/adv/215x250-5.jpg" alt="Реклама на сайте" /></div>
              </div>
            <?php   
           } 
        ?>
       <div class="vkcomSide">
            <!-- VK Widget -->
            <div id="vk_groups"></div>
            <script type="text/javascript">
            VK.Widgets.Group("vk_groups", {mode: 0, width: "215", height: "250", color1: 'FFFFFF', color2: '2B587A', color3: '5B7FA6'}, 76403901);
            </script>
       </div>
       <?php } ?>
       <div class="polls">
      <?php get_poll(-2);?>
        
    </div>
        <?php        
          wp_nav_menu('menu=rightm');  
        ?>
        <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
        <?php dynamic_sidebar( 'sidebar-1' ); ?>
        
        <?php endif; ?>
        <?php if (function_exists('get_most_viewed')): ?>
    

<?php endif; ?>
     
	<!--/sidebar -->
