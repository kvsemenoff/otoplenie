<?php get_header(); ?>
	<div id="content">
	<?php if (have_posts()) { ?>
		<?php while (have_posts()) { the_post(); ?>    
		<div class="post">
			<div class="post-date"><span class="post-month"><?php the_time('M') ?></span> <span class="post-day"><?php the_time('j') ?></span></div>
			<div class="post-title">
				<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
				<span class="post-cat"><a href="#"><?php the_category(', ') ?></a></span> <span class="post-comments"><?php comments_popup_link(); ?></span> 
			</div>
			<div class="entry">
			<?php the_content(); ?>
			</div>
		</div>
        <?php } ?>
		<div class="navigation">
         <span class="previous-entries"><?php next_posts_link('Вперед') ?></span>
          <span class="next-entries"><?php previous_posts_link('Назад') ?></span>
           </div>
      	<?php } else { ?>
		<h2>Ничего не найдено</h2>
	<?php } ?>     
	</div>
	<!--/content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>