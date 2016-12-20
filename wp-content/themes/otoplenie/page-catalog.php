<?php get_header(); ?>
<div id="main">
    <div id="content" class="companyAll" >
    <?php if (have_posts()) { ?>
        <?php while (have_posts()) { the_post(); ?>    
        <div class="post">
        <h1><?php the_title(); ?></h1>
          <div class="baseCat">
            <div class="baseCatUrl catCompany"><a title="Организации по отоплению" href="/company">Организации</a></div>
            <div class="baseCatUrl catMaster"><a title="Частные мастера по отоплению" href="/master">Частные мастера</a></div>
            <div class="baseCatUrl catShop"><a title="Магазины по продаже оборудования и комплеткрующих для отопления" href="/shop">Магазины</a></div>
         </div>
         
         <div>
            <div class="baseCatReg"><a title="Регистрация организации в каталоге" href="/registraciya-organizacii">Регистрация организации</a></div>
            <div class="baseCatReg"><a title="Регистрация частного мастера в каталоге" href="/registraciya-chastnogo-mastera">Регистрация частного мастера</a></div>
            <div class="baseCatReg"><a title="Регистрация магазина в каталоге" href="/registraciya-magazina">Регистрация магазина</a></div>
         </div>
         <div class="clear"></div>
         <div>
            <p>В данный момент каталог находится в тестовом режиме и идет процесс отладки.</p>
         </div>
            

            <div class="entry">
                <?php the_content(); ?>
            </div>
            
        </div>

        <?php } ?>

          <?php } else { ?>
        <h2>Ничего не найдено</h2>
    <?php } ?>     
    </div>
    <!--/content -->
<?php if( !is_front_page() ){
     get_sidebar(); 
} ?>
</div><!--/main -->  
<?php get_footer(); ?>