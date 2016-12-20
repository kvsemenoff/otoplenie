<?php require_once("../../../wp-config.php"); ?>
 <?php if (have_posts()) { ?>
        <?php while (have_posts()) { the_post(); ?>  
<a href="<?php the_permalink(); ?>">
                <?php
                 if ( has_post_thumbnail() ) {
                          the_post_thumbnail();
                    } else {
                       //echo catch_that_image();
                    }       
                 ?>
                
</a>
 <?php } ?>
 
 <?php } else { ?>
         <div class="desc"><?php echo category_description(); ?></div>
    <?php } ?> 