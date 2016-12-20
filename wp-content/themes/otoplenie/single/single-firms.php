<?php get_header(); ?>
  <div id="main">
    <div id="content">
    <?php if (have_posts()) { ?>
        <?php while (have_posts()) { the_post(); ?>    
        <div class="post">
            <div class="entry">
                 <div id="logo-cat"> 
         <?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
                 <?php the_post_thumbnail(array( 9999999,150)); ?>
                <?php endif; ?>
        </div>    
        <h1><?php the_title(); ?></h1>

        
        <div id="mainFeathers">
            <?php $c_address = get_field(c_address); ?>
            <?php if($c_address!='') { echo '<p class="cat"><span>Адрес</span>: '.$c_address.'</p>'; } ?>

            <?php $c_tel = get_field(c_tel); ?>
            <?php if($c_tel!='') { echo '<p class="cat"><span>Телефон(-ы)</span>: '.$c_tel.'</p>'; } ?>          

            <?php $c_fax = get_field(c_fax); ?>
            <?php if($c_fax!='') { echo '<p class="cat"><span>Факс</span>: '.$c_fax.'</p>'; } ?>
            
            <div id="cat-links"></div>
            
            <?php $c_name = get_field(c_name); ?>
            <?php if($c_name!='') { echo '<p class="cat"><span>Наименование компании</span>: '.$c_name.'</p>'; } ?>  
            
            <?php $c_ogrn = get_field(c_ogrn); ?>
            <?php if($c_ogrn!='') { echo '<p class="cat"><span>ОГРН(ИП)</span>: '.$c_ogrn.'</p>'; } ?>  
        </div>
        
        <div id="cat_cont">
        <!--noindex-->
           <?php the_content(); ?>
        <!--/noindex-->
        </div>
            

            </div>
            
          <div id="marks">
           <?php
                   $jobs_list = get_the_term_list( $post->ID, 'job', '<span>Виды деятельности:</span> ', ', ', '' );
                   $cities_list = get_the_term_list( $post->ID, 'city', '<span>Города и регионы:</span> ', ', ', '' );   
                   $product_list = get_the_term_list( $post->ID, 'product', '<span>Товарные группы:</span> ', ', ', '' );   
                   
                   echo '<p>'.$jobs_list.'</p>'; 
                   echo '<p>'.$cities_list.'</p>'; 
                   echo '<p>'.$product_list.'</p>'; 
                   ?>
          
          </div>  
            
                  <div class="clear"></div> 
          <div class="backUrl">
          <?php
          if ($_SESSION["url"]) {
          ?>
          <!--noindex--><a href="<?=$_SESSION["url"]?>">&larr; Вернуться назад</a><!--/noindex-->
          <?php    
          } else {
          ?>
           <!--noindex--><a title="Каталог организаций" href="/firms">&larr; Вернуться на главную страницу каталога</a><!--/noindex--> 
          <?php    
          }   
          ?>
          </div>
          <!--noindex-->
          <div id="social">
            <div id="socialText">Поделитесь с друзьями полезным контактом</div>   <div class="yashare-auto-init" data-yashareLink="" data-yashareTitle="" data-yashareDescription="" data-yashareImage="" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir,gplus" data-yashareTheme="counter" data-yashareType="big"></div>
          </div>
          <!--/noindex-->
          <div class="clear"></div> 
        </div>
        <?php } ?>

          <?php } else { ?>
        <h2>Ничего не найдено</h2>
    <?php } ?>     
    </div><!--/content -->
    <?php get_sidebar(); ?>
 </div><!--/main -->
 <script type="text/javascript"> 
(function($) { $(function() {
 $.ajax({
                 type: 'POST',
                 url: 'http://centro-pol.ru/wp-content/themes/centro/cat-links.php',
                 async: false,
                 data: {'id': '<?php the_ID(); ?>' },
                 //cache: false,
                 success: function(html){
                     $('#cat-links').html(html);
                 } 
   });

}) })(jQuery)
</script>
<?php get_footer();?>
