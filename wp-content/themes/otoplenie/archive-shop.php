<?php get_header(); ?>
   <div id="main">
    <div id="content" class="companyAll">
    <div>
    <?php if ( function_exists('yoast_breadcrumb') ) {
    yoast_breadcrumb('<p id="breadcrumbs">','</p>');
    } ?>
    </div>
   <h1><?php get_org_archive_h1(); ?></h1>
   
   <div class="org_find">
   <div class="org_find_text">Поиск магазинов по отоплению в Вашем городе</div>
        <?php echo get_terms_dropdown('org_city', 'metro_', false, 'shop'); ?>
        </div>
  
        
       <?php get_org_archive_map(); ?>
   
  <div class="clear"></div>       
    <?php if (have_posts()) { ?>
        <?php while (have_posts()) { the_post(); ?>    
 
         <?php org_archive_loop(); ?>
         
         
 
        <?php } ?>     
    <div class="clear"></div>
    <?php if ( $paged < 2 ) { ?>
                        <div class="desc">
                        <?php echo category_description(); ?></div>
                      <?php } ?>           
   
            <div class="navigation">
                 <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
             </div>
  <div class="clear"></div>       
    
   <div class="vkcomCat">
       

        <!-- VK Widget -->
        <div id="vk_groups"></div>
        <script type="text/javascript">
        VK.Widgets.Group("vk_groups", {mode: 0, width: "725", height: "200", color1: 'FFFFFF', color2: '2B587A', color3: '5B7FA6'}, 76403901);
        </script>
       
       </div>
  <div class="clear"></div>          
<?php } else { ?>
         
    <?php } ?>     
    </div><!--/content -->
    <?php get_sidebar(); ?>
 </div><!--/main -->

<?php get_footer(); ?>