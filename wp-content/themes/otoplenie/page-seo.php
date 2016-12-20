<?php
function get_seo_keyss() {
   $args = array(
    'post_type' => 'post',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    
    'meta_query' => array(
        'nullKeys' => array(
            'key'     => 'Keys',
            'value'   => '0',
            'compare' => '!=',
        ),
),
'orderby' => 'nullKeys',
'order'   => 'ASC',
    
  );
  
  
    
?>

<div class="wrap">
<div>
    <p>Убрана рубрика "Вопрос-ответ"</p>
    <p>Убраны материалы без ключей</p>
    <p>Вывод по ТРИ первых ключа</p>
</div>
<table style="font-size: 14px; border-collapse: collapse;">         
<?php
    $query = new WP_Query( $args );
      $n = 1;
    
      while ( $query->have_posts() ) {
      ?>
      
           
   <?php      
      $query->the_post();
       
      $key_1_value = get_post_meta(($query->post->ID), 'Keys', true);
      $expl = nl2br ($key_1_value);
      $ress = explode ('<br />', $expl);
      $i = 0;
      foreach ($ress as $res) {
          $res = str_replace('-', ' ', $res); 
          //$res = str_replace('ё', 'е', $res); 
          
          //if ($i == 3) {
          //    break;
              
           
              
              
        //  }
       echo '<tr>';
           echo '<td style="border: 1px solid #000; border-collapse: collapse;">'.$res.'</td>';
           echo '<td style="border: 1px solid #000; border-collapse: collapse;">';
           the_permalink();
           echo '</td>';
          
       echo '</tr>';
           
          $i=$i+1;
      }
      //print_r($key_1_value);

     
       
           
       $n = $n+1;
     ?>
    
     <?php   
    } 
 ?>
 </table>
 </div>
<div class="clear"></div>
 <?php
   wp_reset_postdata();  
}

get_seo_keyss();

//function seo_keys_admin_menu(){
//        add_options_page('Ссылки на посты с SEO ключами', 'Статья - Ключи', 8, basename(__FILE__), 'get_seo_keys');
    //add_options_page('Ссылки и названия статей', 'Статья - Ссылка', 8, basename(__FILE__), 'get_post_url');

//}
//add_filter('the_title', 'hello_world');
//add_action('admin_menu', 'post_url_admin_menu');
//add_action('admin_menu', 'seo_keys_admin_menu');
?>