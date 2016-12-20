<?php include('header-reklama-na-sajte.php') ?>
<div id="main">
    <div id="content">
    <?php if (have_posts()) { ?>
        <?php while (have_posts()) { the_post(); ?>    
        <div class="post">

       
          <div class="Adv6"><img src="<?php bloginfo('template_directory'); ?>/images/adv/725x100-6.jpg" alt="Реклама на сайте" /></div>
            

            <div class="entry">
            
       <h1 style="font-size: 36px;">Эффективная реклама товаров и услуг связанных с отоплением</h1>
       <p style="margin-top: 20px; font-size: 16px;">В чем преимущества размещения рекламы на нашем ресурсе?</p>
       
<ol style="margin-top: 20px;">
 <li>Абсолютно целевая аудитория т.к. ресурс узкоспециализирован на товарах и услугах связанных с отоплением;</li>
 <li>Полностью структурирована вся рыночная ниша, поэтому вы получаете максимальный охват аудитории;</li>
 <li>Затраты на размещение в 2-3 раза ниже аналогичной по эффективности контекстной рекламной компании;</li>
 <li>Нет проблем со «скликиванием» вашего бюджета на рекламу конкурентами;</li>
</ol>
 
 <div>      
<p><strong>За месяц вашу рекламу увидят более 200 000 посетителей, а за год более 1 500 000</strong></p>
<img src="http://otoplenie-doma.org/wp-content/uploads/2014/05/posetiteli.jpg" alt="posetiteli" width="230" height="247" />
<img src="http://otoplenie-doma.org/wp-content/uploads/2014/05/posetiteli-god.jpg" alt="posetiteli-god" width="190" height="253" />
</div>
<table style="width: 725px;">
<tr>
<td colspan="2"><img src="http://otoplenie-doma.org/wp-content/uploads/2014/05/vse-strany.jpg" alt="vse-strany" width="630" height="423" /></td>
</tr>
<tr>
<td style="width: 419px;" ><img src="http://otoplenie-doma.org/wp-content/uploads/2014/05/istocniki.jpg" alt="istocniki" width="419" height="580" /></td>
    <td style="width: 300px;"><p><strong>Основной источник трафика - поисковые системы.</strong></p>
        <p><strong>Оснвной регион - Россия</strong></p>
    </td>
</tr>
<tr>
<td><img src="http://otoplenie-doma.org/wp-content/uploads/2014/05/vozrast1.jpg" alt="vozrast" width="421" height="491" /></td>
<td><p><strong>Возраст аудитории сайта 25-44 года</strong></p></td>
</tr>

</table>
<table>
<tr>
 <td><img src="http://otoplenie-doma.org/wp-content/uploads/2014/05/interesi.jpg" alt="interesi" width="591" height="419" /></td>
 <td><p><strong>Интересы аудитории преимущественно B2B и B2C направленности</strong></p></td>
</tr>







<!--<img src="http://otoplenie-doma.org/wp-content/uploads/2014/05/geographiya.jpg" alt="geographiya" width="788" height="407" />-->
</table>
<div class="clear"></div>
<div class="Adv6"><img src="<?php bloginfo('template_directory'); ?>/images/adv/725x200-7.jpg" alt="Реклама на сайте" /></div>    
            
            
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
