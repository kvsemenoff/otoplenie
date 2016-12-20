<?php
IF($_SERVER['REQUEST_METHOD'] !=='POST') {
    die(); 
 }   
(int)$id = $_POST['id'];    
?>
<?php require_once("../../../wp-config.php"); ?>

<?php //$firms = new WP_Query( array( 'post_type' => 'firms', 'posts_per_page' => 24 ) );


 
//print_r($firms);
$postCat = get_post( $id );

?>

<?php
$firms = new WP_Query( array( 'post_type' => 'firms', 'post__in' => array( $id ) ) );    
?>




                 <?php while ( $firms->have_posts() ) : $firms->the_post(); ?>

       

<?php


$c_site = get_field(c_site);
$c_email = get_field(c_email);

if($c_site!='') { echo '<p class="cat"><span>Сайт</span>: <a target="_blank" rel="nofollow" href="http://'.$c_site.'">'.$c_site.'</a></p>'; } 
if($c_email!='') { echo '<p class="cat"><span>Электронный адрес</span>: <a href="mailto:'.$c_email.'">'.$c_email.'</a></p>'; } 
?>
          
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
