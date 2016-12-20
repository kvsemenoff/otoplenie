<?php get_header(); ?>
<div id="main">
	<div id="content" <?php if( is_front_page() ){?> style="float: left !important; overflow: hidden !important; padding: 10px 20px 30px !important; width: 960px !important;" <?php }?> >
	<?php if (have_posts()) { ?>
		<?php while (have_posts()) { the_post(); ?>    
		<div class="post">

        <?php if( is_front_page() ){
      include('ajax-menu.inc');
} ?>
        
			<h1><?php the_title(); ?></h1>

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