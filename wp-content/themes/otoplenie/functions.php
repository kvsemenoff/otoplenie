<?php
add_filter('show_admin_bar', '__return_false');

remove_action( 'wp_head', 'feed_links_extra', 3 ); 
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); 
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head','adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'wp_generator' );
//remove_action('wp_head','rel_canonical');

//----------------ЧИСТИМ ЗАГОЛОВКИ HTTP------------------------------------------------------------
function ny_remove_x_pingback( $headers ) {
    unset( $headers['X-Pingback'] );
    return $headers;
}
add_filter( 'wp_headers', 'ny_remove_x_pingback' );
remove_action( 'template_redirect', 'wp_shortlink_header', 11, 0 );

header_remove( 'x-powered-by' );
//----------------/ЧИСТИМ ЗАГОЛОВКИ HTTP-----------------------------------------------------------


remove_action( 'wp_head','wp_shortlink_wp_head', 10, 0 ); 
//---------------------------------------------------------------
remove_filter('pre_term_description', 'wp_filter_kses');
remove_filter('pre_term_description', 'wp_kses_data');
//----------------------------------------------------------

//----------------Активировать виджет и динамический сайдбар------------------------------------------
if (function_exists('register_sidebar'))
    register_sidebar(array(
    'name' => 'sidebar',
    'id' => 'sidebar-1',
    'before_widget' => '<div id="%1$s">',
    'after_widget' => '</div>',
    'before_title' => '<p>',
    'after_title' => '</p>',
));
//----------------//Активировать виджет и динамический сайдбар------------------------------------------





function no_children($query) {
    if ( $query->is_category )
        $query->set( 'category__in', array( get_queried_object_id() ) );
}
add_action('pre_get_posts', 'no_children');


function af_titledespacer($title) {
return trim($title);
}

add_filter('wp_title', 'af_titledespacer');

//--------------------------------------------------------
/* Содержание
--------------------------------------------------------------------------- */

add_filter('the_content', 'make_contents',1);
function make_contents($content){
    if( strpos($content, '[содержание')===false )
        return $content;

    $patt = '\[содержание\s*([^\]]*)\]';

    preg_match("@{$patt}(.*)@s", $content, $m);

    $hds = $m[1] ? trim($m[1]) : 'h2';
    $hds = explode(' ', $hds);
    $hds = array_map('trim', $hds);
    $h = implode('|', $hds);

    @preg_match_all('@<(?:'.$h.')[^>]*>(.*?)</('.$h.')>@is', $m[2], $match);
    //echo '<pre>';
    //print_r($match);
    //echo '</pre>';
    if(!$match)
        return $content;

    // заменяем заголовки и строим содержание
   // $g=0;

  //  foreach( $match[0] as $ch ){
   //     $t = &$match[2];
   //     $m = &$match[1];
   //     $anchor = $t[$g].'_'.$g;
        
       
     //     $new_ch ='<'.$t[$g].' id="'.$t[$g].'_'.$g.'">'.$m[$g].'</'.$t[$g].'><p class="clear"></p>';
            
       
        //$new_ch  .= preg_replace("@>(.+?)<@", " id='$anchor'><a href='#a_menu' title='вернуться к содержанию'>|</a><", $ch, 1);
        
        //$content = str_replace($ch, $new_ch, $content);

        //$out .= '<li><a href="#'. $anchor .'">'. strip_tags($match[1][$g]) ."</a></li>\n";
       // $liz = 1;
       // if( $hds[1] && $t[$g]!=$t[$g+1] && isset($t[$g+1]) ){
            
       
         //           if( !$on ){
         //               $on=true;
        //                $out .= "<ul class='a_menu'>";
        //            } else {
        //                $on=false;
        //                $out .= "</ul>";
        //            }
  
 ///       }
 //       $g++;

 //   } 

//$out = '<div class="soderz"><ul class="a_menu">'. $out .'</ul></div>';
    
$content = preg_replace("@{$patt}@", $out, $content, 1);
return $content;

}
//--------------------------------------------------------------------------------------------------------------------------------------
//------------------------- MENU ------------------------------------------
function no_link_current_page( $p ) {
   return preg_replace( '%((current_page_item|current-menu-item)[^<]+)[^>]+>([^<]+)</a>%', '$1<span class="currentNav">$3</span>', $p);
}

add_filter( 'wp_list_pages', 'no_link_current_page' );
add_filter( 'wp_list_categories', 'no_link_current_page' );
add_filter( 'wp_nav_menu', 'no_link_current_page' );
//---------------------------------------------------------------------------------------------------------------

if ( function_exists( 'add_theme_support' ) )
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 150, 99999 );
add_image_size( '150x99999',150, 99999 );
add_image_size( '80x80', 80, 80, true );
add_image_size( '100x100', 100, 100, true );
//--------------------------------------------------------------------------------------------------------
if (function_exists('add_theme_support')) {
    add_theme_support('menus');
}
//--------------------------------------------------------------------------------
function searchExcludePages($query) {
    if ($query->is_search) {
        $query->set('post_type', 'post');
    }
 
    return $query;
}
 
add_filter('pre_get_posts','searchExcludePages');
//------------------------------------------------------------

function yandex_func() {
    return '';
}
add_shortcode('yandex', 'yandex_func');

//--------------------------функция вставки рекламы после заголовков------ ниже
//function ads_h2($content) {
//$ads='[yandex]';
//$content=preg_replace('#<h2(.*?)</h2>#','<h2\1</h2>',$content, 2); return $content; } add_filter('the_content', 'ads_h2');
//----------------------------функция вставки рекламы после заголовков------ конец

//-------отключение RSS -----------------------------
function fb_disable_feed() {
wp_die( __('Нет доступных каналов, пожалуйста, посетите наш сайт <a href="'. get_bloginfo('url') .'">otoplenie-doma.org</a>!') );
}

add_action('do_feed', 'fb_disable_feed', 1);
add_action('do_feed_rdf', 'fb_disable_feed', 1);
add_action('do_feed_rss', 'fb_disable_feed', 1);
add_action('do_feed_rss2', 'fb_disable_feed', 1);
add_action('do_feed_atom', 'fb_disable_feed', 1);

//-------отключение RSS -----------------------------




/* удаляем из админки лишние блоки, которые и так выведены через Advanced Custom Fields */

function remove_custom_taxonomy()
{
    remove_meta_box('org_citydiv', 'company', 'side' );
    remove_meta_box('metro_mskdiv', 'company', 'side' );
    remove_meta_box('metro_spbdiv', 'company', 'side' );
    remove_meta_box('servicediv', 'company', 'side' );
    remove_meta_box('org_citydiv', 'shop', 'side' );
    remove_meta_box('metro_mskdiv', 'shop', 'side' );
    remove_meta_box('metro_spbdiv', 'shop', 'side' );
    remove_meta_box('product_categorydiv', 'shop', 'side' );   
}
add_action( 'admin_menu', 'remove_custom_taxonomy' );


/* Выводим товарные категории для магазинов */
function get_org_product_categories() {
    global $post;
    $taxonomy = 'products'; // change this to your taxonomy
    $terms = wp_get_post_terms( $post->ID, $taxonomy, array( "fields" => "ids" ) );
    if( $terms ) {
        echo '<ul>';
        $terms = trim( implode( ',', (array) $terms ), ' ,' );
        wp_list_categories( 'title_li=&taxonomy=' . $taxonomy . '&include=' . $terms );
        echo '</ul>';
    }
    
}

/* Выводим услуги для организаций */
function get_org_service() {
    global $post;
    $taxonomy = 'service'; // change this to your taxonomy
    $terms = wp_get_post_terms( $post->ID, $taxonomy, array( "fields" => "ids" ) );
    if( $terms ) {
        echo '<ul>';
        $terms = trim( implode( ',', (array) $terms ), ' ,' );
        wp_list_categories( 'title_li=&taxonomy=' . $taxonomy . '&include=' . $terms );
        echo '</ul>';
    }
    
}

/* Выводим город организации */
function get_org_city() {
$post_type_label = post_type_label_small();
$terms = get_the_terms( $post->ID, 'org_city' );
if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
    $count = count( $terms );
    $i = 0;
    $term_list = '<span class="org_city_content">';
    foreach ( $terms as $term ) {
        $term_list .= '<span class="srongCl">г.</span> <a href="'.get_bloginfo('url').'/catalog/'.$term->slug.'/'.get_post_type( $post->ID ).'/" title="Посмотреть другие '.$post_type_label.' в городе '.$term->name.'">' . $term->name . '</a>';

            $term_list .= '</span>';
    }
    return $term_list;
    }
}

/* Выводим ближайшие станции метро в зависимости от города */

function post_type_label_small() {
    $post_type = get_post_type_object( get_post_type($post) );
$post_type_label = $post_type->label;
$post_type_label = mb_strtolower($post_type_label);
return $post_type_label;
}

function get_org_metro() {
$post_type_label = post_type_label_small();
$terms = get_the_terms( $post->ID, 'org_city' );
if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
    $count = count( $terms );
    if ($count==1) {
    };
           foreach ( $terms as $term ) {
            $city = $term->slug;
            $city_name = $term->name;
            $metro_city = 'metro_'.$term->slug;
            $terms = get_the_terms( $post->ID, $metro_city );        
            if ( $terms && ! is_wp_error( $terms ) ) : 
                $metro_links = array();
                foreach ( $terms as $term ) {
                $metro_links[] = '<a href="'.get_bloginfo('url').'/catalog/'.$city.'/metro_'.$term->slug.'/'.get_post_type( $post->ID ).'/" title="Просмотреть другие '.$post_type_label.' у станции метро '.$term->name.' в городе '.$city_name.'">'.$term->name.'</a>';
    }
                        
    $org_metro = join( ", ", $metro_links );
?>
<span class="org_metro_content <?php echo $metro_city; ?>"><span class="srongCl">Метро:</span> <?php echo $org_metro;?></span>
<?php endif; ?>
        <?php    
            
        }
    }
}


/* Выводим адрес организации */
function get_org_address() {
    $n=1;
    $org_address = ''; 
    if( have_rows('address') ): 
    while( have_rows('address') ): the_row(); 
 $address_type_field = get_sub_field_object('address_type');
$address_type_value = get_sub_field('address_type');
$address_type = $address_type_field['choices'][ $address_type_value ];
        $address_name = get_sub_field('address_name');
        $address_number = get_sub_field('address_number');
        $address_litera = get_sub_field('address_litera');
        $address_korpus = get_sub_field('address_korpus');
        $address_stroenie = get_sub_field('address_stroenie');
        $address_etazh = get_sub_field('address_etazh');
        $address_office = get_sub_field('address_office');
        $address_info = get_sub_field('address_info');
        if ($address_type && $address_name) {
$org_address .='<span class="addr_number">'.$n.'. ';            
if ($address_name) { $org_address .= $address_name.' '; }; 
if ($address_type) { $org_address .= $address_type.', '; };  
if ($address_number) { $org_address .= $address_number.''; }; 
if ($address_litera) { $org_address .= $address_litera.''; }; 
if ($address_korpus) { $org_address .= ' корп. '.$address_korpus.''; }; 
if ($address_stroenie) { $org_address .= ' стр. '.$address_stroenie.''; }; 
if ($address_etazh) { $org_address .= ', этаж '.$address_etazh.''; }; 
if ($address_office) { $org_address .= ', офис '.$address_office.''; }; 
if ($address_info) { $org_address .= ' ('.$address_info.')';}; 
$org_address .='</span><br />';
$n=$n+1;
 }  
    endwhile;
    endif;
    
return $org_address;

};


/* Выводим адрес организации для карты*/
function get_org_address_map() {
    $org_address = ''; 
    if( have_rows('address') ): 
    while( have_rows('address') ): the_row(); 
 $address_type_field = get_sub_field_object('address_type');
$address_type_value = get_sub_field('address_type');
$address_type = $address_type_field['choices'][ $address_type_value ];
        $address_name = get_sub_field('address_name');
        $address_number = get_sub_field('address_number');
        $address_litera = get_sub_field('address_litera');
        $address_korpus = get_sub_field('address_korpus');
        $address_stroenie = get_sub_field('address_stroenie');
        $address_etazh = get_sub_field('address_etazh');
        $address_office = get_sub_field('address_office');
        $address_info = get_sub_field('address_info');
        if ($address_type && $address_name) {
//$org_address .='<span class="addr_number">';            
if ($address_name) { $org_address .= $address_name.' '; }; 
if ($address_type) { $org_address .= $address_type.', '; };  
if ($address_number) { $org_address .= $address_number.''; }; 
if ($address_litera) { $org_address .= $address_litera.''; }; 
if ($address_korpus) { $org_address .= ' корп. '.$address_korpus.''; }; 
if ($address_stroenie) { $org_address .= ' стр. '.$address_stroenie.''; }; 
if ($address_etazh) { $org_address .= ', этаж '.$address_etazh.''; }; 
if ($address_office) { $org_address .= ', офис '.$address_office.''; }; 
if ($address_info) { $org_address .= ' ('.$address_info.')';}; 
//$org_address .='</span><br />';
 } 
 break; 
    endwhile;
    endif;
    
return $org_address;

};

/* Выводим номера телефонов организации */
function get_org_phones() { if( have_rows('phones') ): ?>
    <?php while( have_rows('phones') ): the_row(); 
        $phone_country = get_sub_field('phone_country');
        $phone_city = get_sub_field('phone_city');
        $phone_number = get_sub_field('phone_number');
        $phone_add = get_sub_field('phone_add');
        $phone_comment = get_sub_field('phone_comment');
        if ($phone_country && $phone_city && $phone_number) {
        $org_phone = '<span class="org_phone_content">+'.$phone_country.' ('.$phone_city.') '.$phone_number; 
        if ($phone_add) { 
        $org_phone .=  ' доб. '.$phone_add; }; 
        if ($phone_comment) { 
        $org_phone .= ' &mdash; '.$phone_comment; }; 
        $org_phone .= '</span>';
        echo $org_phone;
        } 
        endwhile;  endif;
}

/* Выводим логотип организации */
function get_org_logo($size) {
$logo = get_field('logo');
if( !empty($logo) ): 
    // thumbnail
    $thumb = $logo['sizes'][ $size ];
    $width = $logo['sizes'][ $size . '-width' ];
    $height = $logo['sizes'][ $size . '-height' ];
    return '<img src="'.$thumb.'" alt="'.get_the_title().'" width="'.$width.'" height="'.$height.'" />' ;
    else :
    return '<img src="'.get_bloginfo('template_url').'/images/org_default_'.$size.'.jpg" alt="'.get_the_title().'" />' ;
endif; 
}

/* Выводим карту для карточки конкретной организации */

function get_org_map_single() { 
?>
<script type='text/javascript' src='http://maps.googleapis.com/maps/api/js?libraries=places&#038;sensor=false&#038;language=ru&#038;ver=4.2.2'></script>
<div class="organization_map"><div id="map" style="width:100%; height: 300px;"></div>
<?php
                $key_google_api='AIzaSyCkEyXTcDs7Tsv_YSisIq7DTLiNDLV4kek';
                $terms = get_the_terms(get_the_ID(), 'org_city');
                $termID = array();
                foreach ($terms as $term) {
                    $termID[] = $term->name;
                }
                
                $org_address = get_org_address_map();
                $address = $termID[0] . ', '.$org_address.''; // Google HQ
                $prepAddr = str_replace(' ', '+', $address);
                $geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $prepAddr . '&key=' . $key_google_api);
                $output = json_decode($geocode);
                $lat = $output->results[0]->geometry->location->lat; 
                $latInt = (int)$output->results[0]->geometry->location->lat;
                $long = $output->results[0]->geometry->location->lng;
                $longInt = (int)$output->results[0]->geometry->location->lng;

                if ($lat && $long) {
                    $latlong = $lat . ',' . $long;
                }
               
?>
<script type="text/javascript">
    // Define your locations: HTML content for the info window, latitude, longitude
    var locations = [
      ['<strong><?php the_title(); ?></strong><br /><?php echo $org_address ?> ', <?=$latlong;  ?>]
    ];
    
    // Setup the different icons and shadows
        var iconURLPrefix = '<?php echo get_bloginfo('template_url').'/images/'; ?>';

            var icons = [
                iconURLPrefix + 'google_pointer.png'
            ];
            var icons_length = icons.length;
    
    
    var shadow = {
      anchor: new google.maps.Point(15,33),
      url: iconURLPrefix + 'msmarker.shadow.png'
    };

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 11,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      mapTypeControl: false,
      streetViewControl: false,
      panControl: false,
      zoomControlOptions: {
         position: google.maps.ControlPosition.RIGHT_TOP
      }
    });

    var infowindow = new google.maps.InfoWindow({
      maxWidth: 160
    });

    var marker;
    var markers = new Array();
    
    var iconCounter = 0;
    
    // Add the markers and infowindows to the map
    for (var i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon : icons[iconCounter],
        shadow: shadow
      });

      markers.push(marker);

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
      
      iconCounter++;
      // We only have a limited number of possible icon colors, so we may have to restart the counter
      if(iconCounter >= icons_length){
          iconCounter = 0;
      }
    }

    function AutoCenter() {
      var pt = new google.maps.LatLng(<?php if(get_field('latlong')) { echo $latlong; } else {echo $lat.','.$long; }; ?>);
        map.setCenter(pt);
        map.setZoom(14);
    }
    AutoCenter();
  </script> </div>
<?php
};


/* Выводим режим работы организации */

/* функция, которая превращает 1 цифру в 2 */
function format2($number){
   if($number>9){$number=$number;}
     elseif($number<10){
         $number="0".$number;
     }
  return $number;
} 

/* основная функция для вывода режима работы организации */
function org_hours() {
    /* Круглосуточный режим работы */
    if (get_field('hours') && get_field('hours') == "all24") {
        echo '<span class="org_hours_day hours_24">Ежедневно, круглосуточно</span>';
    } 
    /* Все остальные варианты */
    else {
        /* Каждый день одинаково */
        if (get_field('hours_individual') && get_field('hours_individual') == "everydaysame") {
            
            /* Устанавливаем время на каждый день */
            $hours_everyday ='';    
            if( have_rows('hours_everyday') ): 
                while( have_rows('hours_everyday') ): the_row(); 
                    $hours_everyday_start_hour = get_sub_field('hours_everyday_start_hour');
                    $hours_everyday_start_minutes = get_sub_field('hours_everyday_start_minutes');
                    $hours_everyday_stop_hour = get_sub_field('hours_everyday_stop_hour');
                    $hours_everyday_stop_minutes = get_sub_field('hours_everyday_stop_minutes');
                    if($hours_everyday_start_hour !='' && $hours_everyday_start_minutes !='' && $hours_everyday_stop_hour !='' && $hours_everyday_stop_minutes !='') {
                        $hours_everyday .= 'Ежедневно, с ';
                        $hours_everyday .= format2($hours_everyday_start_hour);
                        $hours_everyday .= '-';
                        $hours_everyday .= format2($hours_everyday_start_minutes);
                        $hours_everyday .= ' до ';
                        $hours_everyday .= format2($hours_everyday_stop_hour);
                        $hours_everyday .= '-';
                        $hours_everyday .= format2($hours_everyday_stop_minutes);
                    } else {
                        /* Если кто-то забыл указать часы и минуты начала и/или окончания рабочего дня */
                        $hours_everyday = "Время работы не указано";
                    };                
                endwhile;
             endif;
            echo '<span class="org_hours_day hours_everyday">'.$hours_everyday .'</span>';
    
        } 
        /* Отдельно будни и выходные */
        elseif (get_field('hours_individual') && get_field('hours_individual') == "weekends") {
            
            /* Будни */
            
            /* Если в будни не работает */
            if (get_field('hours_if_budni') && get_field('hours_if_budni') == "budninotwork") {
                $hours_budni = "Пн-Пт &mdash; выходной";
                echo '<span class="org_hours_day hours_budni">'.$hours_budni .'</span>';
            } 
            /* Если в будни работает круглосуточно */
            elseif (get_field('hours_if_budni') && get_field('hours_if_budni') == "budni24") {
                $hours_budni = "Пн-Пт &mdash; круглосуточно";
                echo '<span class="org_hours_day hours_budni">'.$hours_budni .'</span>';
            } 
            /* Если указано время работы в будни */
            elseif (get_field('hours_if_budni') && get_field('hours_if_budni') == "budniset") {
                $hours_budni ='';    
                if( have_rows('hours_budni') ): 
                    while( have_rows('hours_budni') ): the_row(); 
                        $hours_budni_start_hour = get_sub_field('hours_budni_start_hour');
                        $hours_budni_start_minutes = get_sub_field('hours_budni_start_minutes');
                        $hours_budni_stop_hour = get_sub_field('hours_budni_stop_hour');
                        $hours_budni_stop_minutes = get_sub_field('hours_budni_stop_minutes');
                        if($hours_budni_start_hour !='' && $hours_budni_start_minutes !='' && $hours_budni_stop_hour !='' && $hours_budni_stop_minutes !='') {
                            $hours_budni .= 'Пн-Пт &mdash; с ';
                            $hours_budni .= format2($hours_budni_start_hour);
                            $hours_budni .= '-';
                            $hours_budni .= format2($hours_budni_start_minutes);
                            $hours_budni .= ' до ';
                            $hours_budni .= format2($hours_budni_stop_hour);
                            $hours_budni .= '-';
                            $hours_budni .= format2($hours_budni_stop_minutes);    
                        } else {
                            /* Если кто-то забыл указать часы и минуты начала и/или окончания рабочего дня */
                            $hours_budni = "Время работы в будни не указано";
                        };
                    endwhile;
                endif;
                echo '<span class="org_hours_day hours_budni">'.$hours_budni .'</span>';
            };
            if (get_field('hours_if_weekend') && get_field('hours_if_weekend') == "weekendnotwork") {
                $hours_weekend = "Сб-Вс &mdash; выходной";
                echo '<span class="org_hours_day hours_weekend">'.$hours_weekend .'</span>';
            }
            elseif (get_field('hours_if_weekend') && get_field('hours_if_weekend') == "weekend24") {
                $hours_weekend = "Сб-Вс &mdash; круглосуточно";
                echo '<span class="org_hours_day hours_weekend">'.$hours_weekend .'</span>';
            } elseif (get_field('hours_if_weekend') && get_field('hours_if_weekend') == "weekendset") {
                $hours_weekend ='';    
                if( have_rows('hours_weekend') ): 
                    while( have_rows('hours_weekend') ): the_row(); 
                        $hours_weekend_start_hour = get_sub_field('hours_weekend_start_hour');
                        $hours_weekend_start_minutes = get_sub_field('hours_weekend_start_minutes');
                        $hours_weekend_stop_hour = get_sub_field('hours_weekend_stop_hour');
                        $hours_weekend_stop_minutes = get_sub_field('hours_weekend_stop_minutes');
                        if($hours_weekend_start_hour !='' && $hours_weekend_start_minutes !='' && $hours_weekend_stop_hour !='' && $hours_weekend_stop_minutes !='') {
                            $hours_weekend .= 'Сб-Вс &mdash; с ';
                            $hours_weekend .= format2($hours_weekend_start_hour);
                            $hours_weekend .= '-';
                            $hours_weekend .= format2($hours_weekend_start_minutes);
                            $hours_weekend .= ' до ';
                            $hours_weekend .= format2($hours_weekend_stop_hour);
                            $hours_weekend .= '-';
                            $hours_weekend .= format2($hours_weekend_stop_minutes);        
                        } else {
                            /* Если кто-то забыл указать часы и минуты начала и/или окончания рабочего дня */
                            $hours_weekend = "Время работы в выходные не указано";
                        };        
                    endwhile;
                endif;
                echo '<span class="org_hours_day hours_weekend">'.$hours_weekend .'</span>';
            };
    
        } 
        /* Отдельно будни, суббота и воскресенье */
        elseif (get_field('hours_individual') && get_field('hours_individual') == "weekends2") {
            
            /* Будни */
            
            /* Если в будни не работает */
            if (get_field('hours_if_budni_2') && get_field('hours_if_budni_2') == "budninotwork_2") {
                $hours_budni_2 = "Пн-Пт &mdash; выходной";
                echo '<span class="org_hours_day hours_if_budni">'.$hours_budni_2 .'</span>';
            } 
            /* Если в будни работает круглосуточно */
            elseif (get_field('hours_if_budni_2') && get_field('hours_if_budni_2') == "budni24_2") {
                $hours_budni_2 = "Пн-Пт &mdash; круглосуточно";
                echo '<span class="org_hours_day hours_if_budni">'.$hours_budni_2 .'</span>';
            } 
            /* Если указано время работы в будни */
            elseif (get_field('hours_if_budni_2') && get_field('hours_if_budni_2') == "budniset_2") {
                $hours_budni_2 ='';    
                if( have_rows('hours_budni_2') ): 
                    while( have_rows('hours_budni_2') ): the_row(); 
                        $hours_budni_start_hour = get_sub_field('hours_budni_start_hour');
                        $hours_budni_start_minutes = get_sub_field('hours_budni_start_minutes');
                        $hours_budni_stop_hour = get_sub_field('hours_budni_stop_hour');
                        $hours_budni_stop_minutes = get_sub_field('hours_budni_stop_minutes');
                        if($hours_budni_start_hour !='' && $hours_budni_start_minutes !='' && $hours_budni_stop_hour !='' && $hours_budni_stop_minutes !='') {
                            $hours_budni_2 .= 'Пн-Пт &mdash; с ';
                            $hours_budni_2 .= format2($hours_budni_start_hour);
                            $hours_budni_2 .= '-';
                            $hours_budni_2 .= format2($hours_budni_start_minutes);
                            $hours_budni_2 .= ' до ';
                            $hours_budni_2 .= format2($hours_budni_stop_hour);
                            $hours_budni_2 .= '-';
                            $hours_budni_2 .= format2($hours_budni_stop_minutes);    
                        } else {
                            /* Если кто-то забыл указать часы и минуты начала и/или окончания рабочего дня */
                            $hours_budni_2 = "Время работы в будни не указано";
                        };
                    endwhile;
                endif;
                echo '<span class="org_hours_day hours_budni">'.$hours_budni_2 .'</span>';
            };
            
            /* Суббота */
            
            /* Если в субботу не работает */
            if (get_field('hours_if_sat') && get_field('hours_if_sat') == "satnotwork") {
                $hours_sat_2 = "Сб &mdash; выходной";
                echo '<span class="org_hours_day hours_sat">'.$hours_sat_2 .'</span>';
            }
            /* Если в субботу работает круглосуточно */
            elseif (get_field('hours_if_sat') && get_field('hours_if_sat') == "sat24") {
                $hours_sat_2 = "Сб &mdash; круглосуточно";
                echo '<span class="org_hours_day hours_sat">'.$hours_sat_2 .'</span>';
            } 
            /* Если указано время работы в субботу */
            elseif (get_field('hours_if_sat') && get_field('hours_if_sat') == "satset") {
                $hours_sat_2 ='';    
                if( have_rows('hours_sat_2') ): 
                    while( have_rows('hours_sat_2') ): the_row(); 
                        $hours_sat_start_hour = get_sub_field('hours_sat_start_hour');
                        $hours_sat_start_minutes = get_sub_field('hours_sat_start_minutes');
                        $hours_sat_stop_hour = get_sub_field('hours_sat_stop_hour');
                        $hours_sat_stop_minutes = get_sub_field('hours_sat_stop_minutes');
                        if($hours_sat_start_hour !='' && $hours_sat_start_minutes !='' && $hours_sat_stop_hour !='' && $hours_sat_stop_minutes !='') {
                            $hours_sat_2 .= 'Сб &mdash; с ';
                            $hours_sat_2 .= format2($hours_sat_start_hour);
                            $hours_sat_2 .= '-';
                            $hours_sat_2 .= format2($hours_sat_start_minutes);
                            $hours_sat_2 .= ' до ';
                            $hours_sat_2 .= format2($hours_sat_stop_hour);
                            $hours_sat_2 .= '-';
                            $hours_sat_2 .= format2($hours_sat_stop_minutes);        
                        } else {
                            /* Если кто-то забыл указать часы и минуты начала и/или окончания рабочего дня */
                            $hours_sat_2 = "Время работы в субботу не указано";
                        };        
                    endwhile;
                endif;
                echo '<span class="org_hours_day hours_sat">'.$hours_sat_2 .'</span>';
            };
            
            /* Воскресенье */
            
            /* Если в воскресенье не работает */
            if (get_field('hours_if_sun') && get_field('hours_if_sun') == "sunnotwork") {
                $hours_sun_2 = "Вс &mdash; выходной";
                echo '<span class="org_hours_day hours_sun">'.$hours_sun_2 .'</span>';
            }
            /* Если в воскресенье работает круглосуточно */
            elseif (get_field('hours_if_sun') && get_field('hours_if_sun') == "sun24") {
                $hours_sun_2 = "Вс &mdash; круглосуточно";
                echo '<span class="org_hours_day hours_sun">'.$hours_sun_2 .'</span>';
            } 
            /* Если указано время работы в воскресенье */
            elseif (get_field('hours_if_sun') && get_field('hours_if_sun') == "sunset") {
                $hours_sun_2 ='';    
                if( have_rows('hours_sun_2') ): 
                    while( have_rows('hours_sun_2') ): the_row(); 
                        $hours_sun_start_hour = get_sub_field('hours_sun_start_hour');
                        $hours_sun_start_minutes = get_sub_field('hours_sun_start_minutes');
                        $hours_sun_stop_hour = get_sub_field('hours_sun_stop_hour');
                        $hours_sun_stop_minutes = get_sub_field('hours_sun_stop_minutes');
                        if($hours_sun_start_hour !='' && $hours_sun_start_minutes !='' && $hours_sun_stop_hour !='' && $hours_sun_stop_minutes !='') {
                            $hours_sun_2 .= 'Вс &mdash; с ';
                            $hours_sun_2 .= format2($hours_sun_start_hour);
                            $hours_sun_2 .= '-';
                            $hours_sun_2 .= format2($hours_sun_start_minutes);
                            $hours_sun_2 .= ' до ';
                            $hours_sun_2 .= format2($hours_sun_stop_hour);
                            $hours_sun_2 .= '-';
                            $hours_sun_2 .= format2($hours_sun_stop_minutes);        
                        } else {
                            /* Если кто-то забыл указать часы и минуты начала и/или окончания рабочего дня */
                            $hours_sun_2 = "Время работы в воскресенье не указано";
                        };        
                    endwhile;
                endif;
                echo '<span class="org_hours_day hours_sun">'.$hours_sun_2 .'</span>';
            };
    
        } 
        /* Если каждый день по-разному */
        elseif (get_field('hours_individual') && get_field('hours_individual') == "weekends3") {
            /* Выводим режим работы в соответствии с рабочими днями */        
            
            /* Время работы в понедельник */
            
            /* Если понедельник - рабочий день */    
            if( in_array( 'mon', get_field('hours_working_days') ) ) {
                
                /* Указываем время работы в понедельник */
                $hours_mon ='';    
                if( have_rows('hours_mon') ): 
                    while( have_rows('hours_mon') ): the_row(); 
                        $hours_mon_start_hour = get_sub_field('hours_mon_start_hour');
                        $hours_mon_start_minutes = get_sub_field('hours_mon_start_minutes');
                        $hours_mon_stop_hour = get_sub_field('hours_mon_stop_hour');
                        $hours_mon_stop_minutes = get_sub_field('hours_mon_stop_minutes');
                        if($hours_mon_start_hour !='' && $hours_mon_start_minutes !='' && $hours_mon_stop_hour !='' && $hours_mon_stop_minutes !='') {
                            $hours_mon .= 'Пн &mdash; с ';
                            $hours_mon .= format2($hours_mon_start_hour);
                            $hours_mon .= '-';
                            $hours_mon .= format2($hours_mon_start_minutes);
                            $hours_mon .= ' до ';
                            $hours_mon .= format2($hours_mon_stop_hour);
                            $hours_mon .= '-';
                            $hours_mon .= format2($hours_mon_stop_minutes);        
                        } else {
                            /* Если кто-то забыл указать часы и минуты начала и/или окончания рабочего дня */
                            $hours_mon = "Время работы в понедельник не указано";
                        };        
                    endwhile;
                endif;
                echo '<span class="org_hours_day hours_mon">'.$hours_mon .'</span>';        
            } 
            /* Если понедельник - выходной */
            else {
                echo '<span class="org_hours_day hours_mon">Пн &mdash; выходной</span>';
            }
    
            /* Если вторник - рабочий день */    
            if( in_array( 'tue', get_field('hours_working_days') ) ) {
                
                /* Указываем время работы во вторник */
                $hours_tue ='';    
                if( have_rows('hours_tue') ): 
                    while( have_rows('hours_tue') ): the_row(); 
                        $hours_tue_start_hour = get_sub_field('hours_tue_start_hour');
                        $hours_tue_start_minutes = get_sub_field('hours_tue_start_minutes');
                        $hours_tue_stop_hour = get_sub_field('hours_tue_stop_hour');
                        $hours_tue_stop_minutes = get_sub_field('hours_tue_stop_minutes');
                        if($hours_tue_start_hour !='' && $hours_tue_start_minutes !='' && $hours_tue_stop_hour !='' && $hours_tue_stop_minutes !='') {
                            $hours_tue .= 'Вт &mdash; с ';
                            $hours_tue .= format2($hours_tue_start_hour);
                            $hours_tue .= '-';
                            $hours_tue .= format2($hours_tue_start_minutes);
                            $hours_tue .= ' до ';
                            $hours_tue .= format2($hours_tue_stop_hour);
                            $hours_tue .= '-';
                            $hours_tue .= format2($hours_tue_stop_minutes);        
                        } else {
                            /* Если кто-то забыл указать часы и минуты начала и/или окончания рабочего дня */
                            $hours_tue = "Время работы во вторник не указано";
                        };        
                    endwhile;
                endif;
                echo '<span class="org_hours_day hours_tue">'.$hours_tue .'</span>';        
            } 
            /* Если вторник - выходной */
            else {
                echo '<span class="org_hours_day hours_tue">Вт &mdash; выходной</span>';
            }
            
            /* Если среда - рабочий день */    
            if( in_array( 'wen', get_field('hours_working_days') ) ) {
                
                /* Указываем время работы в среду */
                $hours_wen ='';    
                if( have_rows('hours_wen') ): 
                    while( have_rows('hours_wen') ): the_row(); 
                        $hours_wen_start_hour = get_sub_field('hours_wen_start_hour');
                        $hours_wen_start_minutes = get_sub_field('hours_wen_start_minutes');
                        $hours_wen_stop_hour = get_sub_field('hours_wen_stop_hour');
                        $hours_wen_stop_minutes = get_sub_field('hours_wen_stop_minutes');
                        if($hours_wen_start_hour !='' && $hours_wen_start_minutes !='' && $hours_wen_stop_hour !='' && $hours_wen_stop_minutes !='') {
                            $hours_wen .= 'Ср &mdash; с ';
                            $hours_wen .= format2($hours_wen_start_hour);
                            $hours_wen .= '-';
                            $hours_wen .= format2($hours_wen_start_minutes);
                            $hours_wen .= ' до ';
                            $hours_wen .= format2($hours_wen_stop_hour);
                            $hours_wen .= '-';
                            $hours_wen .= format2($hours_wen_stop_minutes);        
                        } else {
                            /* Если кто-то забыл указать часы и минуты начала и/или окончания рабочего дня */
                            $hours_wen = "Время работы в среду не указано";
                        };        
                    endwhile;
                endif;
                echo '<span class="org_hours_day hours_wen">'.$hours_wen .'</span>';        
            } 
            /* Если среда - выходной */
            else {
                echo '<span class="org_hours_day hours_wen">Ср &mdash; выходной</span>';
            }
            
            /* Если четверг - рабочий день */    
            if( in_array( 'thu', get_field('hours_working_days') ) ) {
                
                /* Указываем время работы в четверг */
                $hours_thu ='';    
                if( have_rows('hours_thu') ): 
                    while( have_rows('hours_thu') ): the_row(); 
                        $hours_thu_start_hour = get_sub_field('hours_thu_start_hour');
                        $hours_thu_start_minutes = get_sub_field('hours_thu_start_minutes');
                        $hours_thu_stop_hour = get_sub_field('hours_thu_stop_hour');
                        $hours_thu_stop_minutes = get_sub_field('hours_thu_stop_minutes');
                        if($hours_thu_start_hour !='' && $hours_thu_start_minutes !='' && $hours_thu_stop_hour !='' && $hours_thu_stop_minutes !='') {
                            $hours_thu .= 'Чт &mdash; с ';
                            $hours_thu .= format2($hours_thu_start_hour);
                            $hours_thu .= '-';
                            $hours_thu .= format2($hours_thu_start_minutes);
                            $hours_thu .= ' до ';
                            $hours_thu .= format2($hours_thu_stop_hour);
                            $hours_thu .= '-';
                            $hours_thu .= format2($hours_thu_stop_minutes);        
                        } else {
                            /* Если кто-то забыл указать часы и минуты начала и/или окончания рабочего дня */
                            $hours_thu = "Время работы в четверг не указано";
                        };        
                    endwhile;
                endif;
                echo '<span class="org_hours_day hours_thu">'.$hours_thu .'</span>';        
            } 
            /* Если четверг - выходной */
            else {
                echo '<span class="org_hours_day hours_thu">Чт &mdash; выходной</span>';
            }
            
            /* Если пятница - рабочий день */    
            if( in_array( 'fri', get_field('hours_working_days') ) ) {
                
                /* Указываем время работы в пятницу */
                $hours_fri ='';    
                if( have_rows('hours_fri') ): 
                    while( have_rows('hours_fri') ): the_row(); 
                        $hours_fri_start_hour = get_sub_field('hours_fri_start_hour');
                        $hours_fri_start_minutes = get_sub_field('hours_fri_start_minutes');
                        $hours_fri_stop_hour = get_sub_field('hours_fri_stop_hour');
                        $hours_fri_stop_minutes = get_sub_field('hours_fri_stop_minutes');
                        if($hours_fri_start_hour !='' && $hours_fri_start_minutes !='' && $hours_fri_stop_hour !='' && $hours_fri_stop_minutes !='') {
                            $hours_fri .= 'Пт &mdash; с ';
                            $hours_fri .= format2($hours_fri_start_hour);
                            $hours_fri .= '-';
                            $hours_fri .= format2($hours_fri_start_minutes);
                            $hours_fri .= ' до ';
                            $hours_fri .= format2($hours_fri_stop_hour);
                            $hours_fri .= '-';
                            $hours_fri .= format2($hours_fri_stop_minutes);        
                        } else {
                            /* Если кто-то забыл указать часы и минуты начала и/или окончания рабочего дня */
                            $hours_fri = "Время работы в пятницу не указано";
                        };        
                    endwhile;
                endif;
                echo '<span class="org_hours_day hours_fri">'.$hours_fri .'</span>';        
            } 
            /* Если пятница - выходной */
            else {
                echo '<span class="org_hours_day hours_fri">Пт &mdash; выходной</span>';
            }
            
            /* Если суббота - рабочий день */    
            if( in_array( 'sat', get_field('hours_working_days') ) ) {
                
                /* Указываем время работы в субботу */
                $hours_sat ='';    
                if( have_rows('hours_sat') ): 
                    while( have_rows('hours_sat') ): the_row(); 
                        $hours_sat_start_hour = get_sub_field('hours_sat_start_hour');
                        $hours_sat_start_minutes = get_sub_field('hours_sat_start_minutes');
                        $hours_sat_stop_hour = get_sub_field('hours_sat_stop_hour');
                        $hours_sat_stop_minutes = get_sub_field('hours_sat_stop_minutes');
                        if($hours_sat_start_hour !='' && $hours_sat_start_minutes !='' && $hours_sat_stop_hour !='' && $hours_sat_stop_minutes !='') {
                            $hours_sat .= 'Сб &mdash; с ';
                            $hours_sat .= format2($hours_sat_start_hour);
                            $hours_sat .= '-';
                            $hours_sat .= format2($hours_sat_start_minutes);
                            $hours_sat .= ' до ';
                            $hours_sat .= format2($hours_sat_stop_hour);
                            $hours_sat .= '-';
                            $hours_sat .= format2($hours_sat_stop_minutes);        
                        } else {
                            /* Если кто-то забыл указать часы и минуты начала и/или окончания рабочего дня */
                            $hours_sat = "Время работы в субботу не указано";
                        };        
                    endwhile;
                endif;
                echo '<span class="org_hours_day hours_sat">'.$hours_sat .'</span>';        
            } 
            /* Если суббота - выходной */
            else {
                echo '<span class="org_hours_day hours_sat">Сб &mdash; выходной</span>';
            }
            
            /* Если воскресенье - рабочий день */    
            if( in_array( 'sun', get_field('hours_working_days') ) ) {
                
                /* Указываем время работы в воскресенье */
                $hours_sun ='';    
                if( have_rows('hours_sun') ): 
                    while( have_rows('hours_sun') ): the_row(); 
                        $hours_sun_start_hour = get_sub_field('hours_sun_start_hour');
                        $hours_sun_start_minutes = get_sub_field('hours_sun_start_minutes');
                        $hours_sun_stop_hour = get_sub_field('hours_sun_stop_hour');
                        $hours_sun_stop_minutes = get_sub_field('hours_sun_stop_minutes');
                        if($hours_sun_start_hour !='' && $hours_sun_start_minutes !='' && $hours_sun_stop_hour !='' && $hours_sun_stop_minutes !='') {
                            $hours_sun .= 'Вс &mdash; с ';
                            $hours_sun .= format2($hours_sun_start_hour);
                            $hours_sun .= '-';
                            $hours_sun .= format2($hours_sun_start_minutes);
                            $hours_sun .= ' до ';
                            $hours_sun .= format2($hours_sun_stop_hour);
                            $hours_sun .= '-';
                            $hours_sun .= format2($hours_sun_stop_minutes);        
                        } else {
                            /* Если кто-то забыл указать часы и минуты начала и/или окончания рабочего дня */
                            $hours_sun = "Время работы в воскресенье не указано";
                        };        
                    endwhile;
                endif;
                echo '<span class="org_hours_day hours_sun">'.$hours_sun .'</span>';        
            } 
            /* Если воскресенье - выходной */
            else {
                echo '<span class="org_hours_day hours_sun">Вс &mdash; выходной</span>';
            }
    
        
        }
        
        
        

    }
};

/* Выводим примеры работ для строительных компаний */

function get_org_portfolio($size) { 
if( have_rows('portfolio') ): ?>
    <ul class="org_portfolio_images">
    <?php while( have_rows('portfolio') ): the_row(); 

        // vars
        $image = get_sub_field('image');
        $content = get_sub_field('image_description');
        ?>
        <li class="org_portfolio_image">
       <?php 
       if( !empty($image) ):
           $thumb = $image['sizes'][ $size ];
           $width = $image['sizes'][ $size . '-width' ];
           $height = $image['sizes'][ $size . '-height' ];
               echo '<a href="'.$image['url'].'" rel="org_portfolio"><img src="'.$thumb.'" alt="'.$content.'" width="'.$width.'" height="'.$height.'" /></a>' ;
        endif; ?>
        </li>
    <?php endwhile; ?>
    
    </ul>
    <div class="clear"></div>   
<?php endif;
};

/* Настраиваем вывод карточки организации в архивах */
function org_archive_loop() {  ?>
    <div class="org_archive_block" id="post-<?php the_ID(); ?>">
    <div class="org_archive_title"><a href="<?php the_permalink(); ?>" title="<?php the_title() ?>"><?php the_title(); ?></a></div>
    <?php if (get_org_logo()) { ?><div class="org_archive_logo"><a href="<?php the_permalink(); ?>" title="<?php the_title() ?>" ><?php echo get_org_logo('150x99999'); ?></a></div><?php }; ?>
    <div class="clear"></div>
    <div class="org_archive_content">      
        <div class="org_archive_city"><?php echo get_org_city(); ?></div>
        <?php if (get_org_address() !="") { ?><div class="org_archive_address"><span class="org_address_content"><span class="srongCl">Адрес (-а):</span> <?php echo get_org_address();?></span></div><?php }; ?>
        <div class="org_archive_meto"><?php get_org_metro(); ?></div>
        <div class="org_archive_hours"><?php org_hours(); ?></div>
        <div class="clear"></div>
    </div>
    </div>  
<?php }

/* Заменяем обработку desc`ов плагином Wordpress SEO от Yoast на собственные правила */
add_filter('wpseo_metadesc', 'filter_catalog_wpseo_metadesc');

function filter_catalog_wpseo_metadesc($desc) {
$uri = $_SERVER["REQUEST_URI"];
$uri_array = split("/",$uri);
$uri_1 = $uri_array[1];
$uri_2 = $uri_array[2];
$uri_3 = $uri_array[3];
$uri_4 = $uri_array[4];
    /* Если открыт архив со всеми компаниями */
    if (is_post_type_archive('company') && $uri_1 == 'company') {
        $desc = 'Каталог компаний по отоплению. Выбор по городу и станции метро. Предоставляемые услуги.';
        
    }
    /* Если открыт архив со всеми магазинами */
    elseif (is_post_type_archive('shop') && $uri_1 == 'shop') {
        $desc = 'Каталог магазинов по продаже отопительного оборудования. Выбор по городу и станции метро. Ассортимент товара.';
        
    }
    /* Если открыт архив со всеми частными мастерами */
    if (is_post_type_archive('master') && $uri_1 == 'master') {
        $desc = 'Каталог частных мастеров по отоплению. Выбор по городу. Предоставляемые услуги.';
        
    }
    
    return $desc;    
}



/* Заменяем обработку titl'ов плагином Wordpress SEO от Yoast на собственные правила */

add_filter('wpseo_title', 'filter_catalog_wpseo_title');
function filter_catalog_wpseo_title($title) {
$uri = $_SERVER["REQUEST_URI"];
$uri_array = split("/",$uri);
$uri_1 = $uri_array[1];
$uri_2 = $uri_array[2];
$uri_3 = $uri_array[3];
$uri_4 = $uri_array[4];
    /* Если открыт архив со всеми компаниями */
    if (is_post_type_archive('company') && $uri_1 == 'company') {
        $title = 'Каталог компаний по отоплению: адреса, телефоны и отзывы';
        if (is_paged()) { $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
        $title .= ' &mdash; страница '.$paged;
        };
    }
    /* Если открыт архив со всеми магазинами */
    elseif (is_post_type_archive('shop') && $uri_1 == 'shop' ) { 
        $title = 'Каталог магазинов по отоплению: адреса, телефоны, отзывы';
        if (is_paged()) { $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
        $title .= ' &mdash; страница '.$paged;
        };
    }
    
     /* Если открыт архив со всеми магазинами */
    elseif (is_post_type_archive('master') && $uri_1 == 'master' ) { 
        $title = 'Каталог частных мастеров по отоплению: адреса, телефоны и отзывы';
        if (is_paged()) { $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
        $title .= ' &mdash; страница '.$paged;
        };
    }
    
//------------------------------------------------------------------------------------------------------------------       
    /* Если открыт архив с магазинами города */
    elseif ($uri_3 == 'shop' && !is_single() && $uri_2 !='' ) {  
        $city = get_term_by('slug', $uri_2, 'org_city'); 
        $title = 'Магазины отопительного оборудования г. '.$city->name; 
        $title .= ': адреса, телефоны, отзывы';
        if (is_paged()) { $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  
        $title .= ' &mdash; страница '.$paged;};
    }
    /* Если открыт архив с магазинами города рядом с какой-либо станцией метро */
    elseif ($uri_4 == 'shop' && !is_single() && $uri_2 !='' ) {  
        $metro_tax = 'metro_'.$uri_2;
        $metro_name = str_replace('metro_','',$uri_3);
        $city = get_term_by('slug', $uri_2, 'org_city'); 
        $metro = get_term_by('slug', $metro_name, $metro_tax); 
        $title = 'Магазины отопительного оборудования г. '.$city->name.' у метро '.$metro->name; 
        $title .= ': адреса, телефоны, отзывы';
        if (is_paged()) { $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  
        $title .= ' &mdash; страница '.$paged;};
    } 
    /* Если открыт архив с организациями города */
    elseif ($uri_3 == 'company' && !is_single()) { 
        $city = get_term_by('slug', $uri_2, 'org_city'); 
        $title = 'Организации по отоплению г. '.$city->name; 
        $title .= ': адреса, телефоны, отзывы';
        if (is_paged()) { $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  
        $title .= ' &mdash; страница '.$paged;};
    }
    /* Если открыт архив с организациями города рядом с какой-либо станцией метро */
    elseif ($uri_4 == 'company' && !is_single()) {  
        $metro_tax = 'metro_'.$uri_2;
        $metro_name = str_replace('metro_','',$uri_3);
        $city = get_term_by('slug', $uri_2, 'org_city'); 
        $metro = get_term_by('slug', $metro_name, $metro_tax); 
        $title = 'Организации по отоплению г. '.$city->name.' у метро '.$metro->name; 
        $title .= ': адреса, телефоны, отзывы';
        if (is_paged()) { $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  
        $title .= ' &mdash; страница '.$paged;};
    }
   /* Открыта главная страница */  
    elseif ($uri_1 == 'catalog' && $uri_2 =='' && $uri_3 =='' && $uri_4 =='') {
      
    }
     
    /* Если открыт архив города и с организациями и с магазинами */
    elseif ( $uri_1 == 'catalog' && $uri_3 != 'company' && $uri_3 != 'shop' && $uri_3 =='' || $uri_1 == 'catalog' && $uri_3 != 'company' && $uri_3 != 'shop' && $uri_3 =='page') { 
        $city = get_term_by('slug', $uri_2, 'org_city'); 
        $title = 'Каталог компаний по отоплению г. '.$city->name;
        $title .= ': адреса, телефоны, отзывы';
        if (is_paged()) { $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  
        $title .= ' &mdash; страница '.$paged;};
    }
    /* Если открыт архив станции метро и с организациями и с магазинами */
    elseif ($uri_1 == 'catalog' && $uri_4 != 'company' && $uri_4 != 'shop' ) {  
        $metro_tax = 'metro_'.$uri_2;
        $metro_name = str_replace('metro_','',$uri_3);
        $city = get_term_by('slug', $uri_2, 'org_city'); 
        $metro = get_term_by('slug', $metro_name, $metro_tax); 
        $title = 'Каталог компаний по отоплению г. '.$city->name.' у метро '.$metro->name; 
        $title .= ': адреса, телефоны, отзывы';
        if (is_paged()) { $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  
        $title .= ' &mdash; страница '.$paged;};
    } 
    
    return $title;
    
}

/* Настраиваем h1 для различных архивов с организациями */
function get_org_archive_h1() {
$uri = $_SERVER["REQUEST_URI"];
$uri_array = split("/",$uri);
$uri_1 = $uri_array[1];
$uri_2 = $uri_array[2];
$uri_3 = $uri_array[3];
$uri_4 = $uri_array[4];

if ($uri_1 == 'company') { 
        echo 'Каталог компаний по отоплению'; if (is_paged()) { $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  echo ' &mdash; страница '.$paged.' из '; global $wp_query; echo $wp_query->max_num_pages;};
    }
    elseif ($uri_1 == 'shop') { 
        echo 'Каталог магазинов по отопительному оборудованию'; if (is_paged()) { $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  echo ' &mdash; страница '.$paged.' из '; global $wp_query; echo $wp_query->max_num_pages;};
    }
    
   elseif ($uri_1 == 'master') { 
        echo 'Каталог частных мастеров по отоплению'; if (is_paged()) { $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  echo ' &mdash; страница '.$paged.' из '; global $wp_query; echo $wp_query->max_num_pages;};
    }    
    /* Если открыт архив с магазинами города */
    elseif ($uri_3 == 'shop') {  
        $city = get_term_by('slug', $uri_2, 'org_city'); 
        echo 'Магазины по отопительному оборудованию города '.$city->name; if (is_paged()) { $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  echo ' &mdash; страница '.$paged.' из '; global $wp_query; echo $wp_query->max_num_pages;};
    }
    /* Если открыт архив с магазинами города рядом с какой-либо станцией метро */
    elseif ($uri_4 == 'shop') {  
        $metro_tax = 'metro_'.$uri_2;
        $metro_name = str_replace('metro_','',$uri_3);
        $city = get_term_by('slug', $uri_2, 'org_city'); 
        $metro = get_term_by('slug', $metro_name, $metro_tax); 
        echo 'Магазины по отопительному оборудованию города '.$city->name.' рядом со станцией метро '.$metro->name; if (is_paged()) { $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  echo ' &mdash; страница '.$paged.' из '; global $wp_query; echo $wp_query->max_num_pages;};
    } 
    /* Если открыт архив с организациями города */
    elseif ($uri_3 == 'company') { 
        $city = get_term_by('slug', $uri_2, 'org_city'); 
        echo 'Организации по отопительному оборудованию города '.$city->name; if (is_paged()) { $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  echo ' &mdash; страница '.$paged.' из '; global $wp_query; echo $wp_query->max_num_pages;};
    }
    /* Если открыт архив с организациями города рядом с какой-либо станцией метро */
    elseif ($uri_4 == 'company') {  
        $metro_tax = 'metro_'.$uri_2;
        $metro_name = str_replace('metro_','',$uri_3);
        $city = get_term_by('slug', $uri_2, 'org_city'); 
        $metro = get_term_by('slug', $metro_name, $metro_tax); 
        echo 'Организации по отопительному оборудованию города '.$city->name.' рядом со станцией метро '.$metro->name; if (is_paged()) { $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  echo ' &mdash; страница '.$paged.' из '; global $wp_query; echo $wp_query->max_num_pages;};
    } 
 //---------------------------------------------------------------------------------------------------
    /* Если открыт архив с мастерами города */
    elseif ($uri_3 == 'master') { 
        $city = get_term_by('slug', $uri_2, 'org_city'); 
        echo 'Частные мастера по отоплению города '.$city->name; if (is_paged()) { $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  echo ' &mdash; страница '.$paged.' из '; global $wp_query; echo $wp_query->max_num_pages;};
    }
    /* Если открыт архив с мастерами города рядом с какой-либо станцией метро */
    elseif ($uri_4 == 'master') {  
        $metro_tax = 'metro_'.$uri_2;
        $metro_name = str_replace('metro_','',$uri_3);
        $city = get_term_by('slug', $uri_2, 'org_city'); 
        $metro = get_term_by('slug', $metro_name, $metro_tax); 
        echo 'Частные мастера по отоплению города '.$city->name.' рядом со станцией метро '.$metro->name; if (is_paged()) { $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  echo ' &mdash; страница '.$paged.' из '; global $wp_query; echo $wp_query->max_num_pages;};
    }
 //---------------------------------------------------------------------------------------------------         
    /* Если открыт архив города и с организациями и с магазинами */
    elseif ($uri_3 != 'company' && $uri_3 != 'shop' && $uri_3 =='' || $uri_3 != 'company' && $uri_3 != 'shop' && $uri_3 =='page') { 
        $city = get_term_by('slug', $uri_2, 'org_city'); 
        echo 'Каталог компаний по отоплению г. '.$city->name; if (is_paged()) { $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  echo ' &mdash; страница '.$paged.' из '; global $wp_query; echo $wp_query->max_num_pages;};
    }
    /* Если открыт архив станции метро и с организациями и с магазинами */
    elseif ($uri_4 != 'company' && $uri_4 != 'shop') {  
        $metro_tax = 'metro_'.$uri_2;
        $metro_name = str_replace('metro_','',$uri_3);
        $city = get_term_by('slug', $uri_2, 'org_city'); 
        $metro = get_term_by('slug', $metro_name, $metro_tax); 
        echo 'Каталог компаний по отоплению г. '.$city->name.' рядом со станцией метро '.$metro->name; if (is_paged()) { $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;  echo ' &mdash; страница '.$paged.' из '; global $wp_query; echo $wp_query->max_num_pages;};
    } 

};

/* Создаем функционал для вывода организаций в виджетах */

function org_widget_archive($post_type,$posts_per_page) { ?>

<?php
// The Query
$org_widget_archive_query = new WP_Query('post_type='.$post_type.'&posts_per_page='.$posts_per_page.'&orderby=rand');
 if ($org_widget_archive_query->have_posts()) :
// The Loop
while ( $org_widget_archive_query->have_posts() ) : $org_widget_archive_query->the_post(); 
$org_widget_address = get_org_city();
if (get_org_address() !="") {
$org_widget_address .= ', '.get_org_address(); 
};
?>
<div class="org_widget_block" id="post-<?php the_ID(); ?>">
    <div class="org_widget_title"><a href="<?php the_permalink(); ?>" title="Карточка организации: <?php the_title() ?>"><?php the_title(); ?></a></div>
    <div class="org_widget_content">
    <?php if (get_org_logo()) { ?><div class="org_widget_logo"><a href="<?php the_permalink(); ?>" title="<?php the_title() ?>"><?php echo get_org_logo('150x99999'); ?></a></div><?php }; ?>
    <div class="org_widget_address"><?php echo $org_widget_address; ?></div>
    <div class="org_widget_meto"><?php get_org_metro(); ?></div>
    <div class="org_widget_hours"><?php org_hours(); ?></div>
    <div class="clear"></div>
    </div>
    </div>
<?php
endwhile; // Reset Post Data wp_reset_postdata(); ?>
<?php else: ?>
<?php endif; wp_reset_query(); 

};


/* Создаем функционал фильтра */

/*
Параметры функции:

taxonomies - системное название таксономии с городами, например 'org_city'
metro_prefix - префикс таксономии с метро, если он у вас есть, например 'metro_'
general - если поставить true - то ссылки будут просто на города и станции метро без привязки к типу записей, если же поставить true, то необходимо указать следующий параметр
post_type - тип записей, например 'shop'

Пример вызовы функции: 

echo get_terms_dropdown('org_city', 'metro_', false, 'shop');
или
echo get_terms_dropdown('org_city', 'metro_', true);

*/

function get_terms_dropdown($taxonomies, $metro_prefix, $general, $post_type){
    $uri = $_SERVER["REQUEST_URI"];
    $uri_array = split("/",$uri);
    $uri_1 = $uri_array[1];
    $uri_2 = $uri_array[2];
    $uri_3 = $uri_array[3];
    $uri_4 = $uri_array[4];
    $args = array('orderby'=>'name','hide_empty'=>true);
    $myterms = get_terms($taxonomies, $args);
    
    if ($general == true) {
    $output ='<div class="selector"><span class="select_title">Город:</span><label><select onchange="if (this.value) window.location.href=this.value"><option value="">- Выберите город -</option>';
        foreach($myterms as $term){
            $root_url = get_bloginfo('url');
            $term_taxonomy=$term->taxonomy;
            $term_slug=$term->slug;
            $term_name =$term->name;
            $link = '/'.$term_slug;
            $output .='<option value="'.$root_url.'/catalog'.$link.'/"';
            if($uri_2==$term_slug) { $output .=' selected';};
            $output .= '>'.$term_name.'</option>';
        }
        $output .="</select></label></div>";
        $metro_city =$metro_prefix.''.$uri_2;
        $metro_exists = taxonomy_exists($metro_city );
    if ($metro_exists) {
            $metro_terms = get_terms($metro_city, $args);
            $output .='<div class="selector"><span class="select_title">Метро:</span><label><select onchange="if (this.value) window.location.href=this.value"><option value="">- Выберите станцию -</option>';
            foreach($metro_terms as $metro_term){
                $root_url = get_bloginfo('url');
                $term_taxonomy=$metro_term->taxonomy;
                $term_slug=$metro_prefix.''.$metro_term->slug;
                $term_name =$metro_term->name;
                $link = '/'.$uri_2.'/'.$term_slug;
                $output .='<option value="'.$root_url.'/catalog'.$link.'/"';
                if($uri_3==$term_slug) { $output .=' selected';};
                $output .= '>'.$term_name.'</option>';
            } 
        $output .="</select></label></div>";
        }
        return $output;    
    }    
    
    
    elseif ($general ==false) {
        $output ='<div class="selector"><span class="select_title">Город:</span><label><select onchange="if (this.value) window.location.href=this.value"><option value="">- Выберите город -</option>';
        foreach($myterms as $term){
            $root_url = get_bloginfo('url');
            $term_taxonomy=$term->taxonomy;
            $term_slug=$term->slug;
            $term_name =$term->name;
            $link = '/'.$term_slug;
            $output .='<option value="'.$root_url.'/catalog'.$link.'/'.$post_type.'/"';
            if($uri_2==$term_slug && $post_type ==$uri_3 || $uri_2==$term_slug && $post_type ==$uri_4) { $output .=' selected';};
            $output .= '>'.$term_name.'</option>';
        }
        $output .="</select></label></div>";
        $metro_city =$metro_prefix.''.$uri_2;
        $metro_exists = taxonomy_exists($metro_city );
        if ($metro_exists && $post_type ==$uri_3 || $metro_exists && $post_type ==$uri_4) {
            $metro_terms = get_terms($metro_city, $args);
            $output .='<div class="selector"><span class="select_title">Метро:</span><label><select onchange="if (this.value) window.location.href=this.value"><option value="">- Выберите станцию -</option>';
            foreach($metro_terms as $metro_term){
                $root_url = get_bloginfo('url');
                $term_taxonomy=$metro_term->taxonomy;
                $term_slug=$metro_prefix.''.$metro_term->slug;
                $term_name =$metro_term->name;
                $link = '/'.$uri_2.'/'.$term_slug;
                $output .='<option value="'.$root_url.'/catalog'.$link.'/'.$post_type.'/"';
                if($uri_3==$term_slug && $post_type ==$uri_4) { $output .=' selected';};
                $output .= '>'.$term_name.'</option>';
            } 
        $output .="</select></label></div>";
        }
        
        return $output;
    }

}


/* Виджет магазинов */

function widget_org_shop() { ?>

<li class="widget">
<!--noindex-->
<div class="widget_title"><span>Строительные магазины</span></div>
<div class="widget_org_content"><?php org_widget_archive('shop',3); ?></div>
<?php };


/* Виджет организаций */

function widget_org_company() { ?>

<li class="widget">
<!--noindex-->
<div class="widget_title"><span>Строительные компании</span></div>
<div class="widget_org_content"><?php org_widget_archive('company',3); ?></div>
<!--/noindex-->
</li>
<?php 
};

/* Виджет поиска магазинов */

function widget_org_find_shop() { ?>
<div class="org_find">
<div class="org_find_text">Поиск строительного магазина в Вашем городе</div>
<?php echo get_terms_dropdown('org_city', 'metro_', false, 'shop'); ?>
</div>
<?php
}

/* Виджет поиска организаций */

function widget_org_find_company() { ?>
<div class="org_find">
<div class="org_find_text">Поиск строительной организации в Вашем городе</div>
<?php echo get_terms_dropdown('org_city', 'metro_', false, 'company'); ?>
</div>
<?php
}


/* Регистрируем виджеты */

function register_my_widget() {
    wp_register_sidebar_widget('w_org_shop','Строительные магазины', 'widget_org_shop');
    wp_register_sidebar_widget('w_org_company','Строительные компании', 'widget_org_company');
    wp_register_sidebar_widget('w_org_find_shop','Поиск магазина', 'widget_org_find_shop');
    wp_register_sidebar_widget('w_org_find_company','Поиск организации', 'widget_org_find_company');
}
add_action('init', 'register_my_widget');

/* Создаем шорткод для вывода поиска в тех или иных страницах */

/*
taxonomies - системное название таксономии с городами, например 'org_city'
metro_prefix - префикс таксономии с метро, если он у вас есть, например 'metro_'
general - если поставить true - то ссылки будут просто на города и станции метро без привязки к типу записей, если же поставить true, то необходимо указать следующий параметр
post_type - тип записей, например 'shop'
*/
function org_find_shortcode($atts) {
    $atts = shortcode_atts( array(
        'taxonomies' => 'org_city',
        'metro_prefix' => 'metro_',
        'general' =>'true',
        'title' => 'Поиск организации в Вашем городе',
        'post_type' => ''
    ), $atts, 'org_find' );
    if ($atts['general'] =='true' ) {$get_general = true; } elseif ($atts['general'] =='false') { $get_general = false; };
    $output ='<div class="org_find"><div class="org_find_text">'.$atts['title'].'</div>';
    $output .=get_terms_dropdown($atts['taxonomies'], $atts['metro_prefix'], $get_general, $atts['post_type']);
    $output .='</div>';
    return $output;
}
add_shortcode('org_find', 'org_find_shortcode');


/* Выводим карту для архива организаций */

function get_org_archive_map() { ?>
<div id="map"></div>
     <?php
    global $query_string;
    query_posts($query_string . '&posts_per_page=-1');
    ?>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&#038;sensor=false&#038;language=ru&#038;ver=4.2.2"></script>
    <script type="text/javascript" src="/js/markerclusterer.js"></script>
    <?PHP if (have_posts()) : ?>
        <script type="text/javascript">
            jQuery.noConflict();
            var locations = [
                <?php
                $key_google_api='AIzaSyCkEyXTcDs7Tsv_YSisIq7DTLiNDLV4kek';
                 while (have_posts()) : the_post(); ?>
                <?php
                $terms = get_the_terms(get_the_ID(), 'org_city');
                $termID = array();
                foreach ($terms as $term) {
                    $termID[] = $term->name;
                }
                $org_address = get_org_address();
                $address = $termID[0] . ', '.$org_address.''; // Google HQ
                $prepAddr = str_replace(' ', '+', $address);
                $geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . $prepAddr . '&key=' . $key_google_api);
                $output = json_decode($geocode);
                
                $lat = $output->results[0]->geometry->location->lat;
                $latInt = (int)$output->results[0]->geometry->location->lat;
                $long = $output->results[0]->geometry->location->lng;
                $longInt = (int)$output->results[0]->geometry->location->lng;

                if ($lat && $long) {
                    $latlong = $lat . ',' . $long;
                }
                if ($latlong) {
                ?>
                ['<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br /><span class="map_address"><?php echo $org_address ?></span>', <?=$latlong;  ?>],
                <?php }
                $latlong=null;
                 endwhile; ?>
            ];

                        // Setup the different icons and shadows
            var iconURLPrefix = '<?php echo get_bloginfo('template_url').'/images/'; ?>';

            var icons = [
                iconURLPrefix + 'google_pointer.png'
            ];
            var icons_length = icons.length;

            var shadow = {
                anchor: new google.maps.Point(15, 33),
                url: iconURLPrefix + 'msmarker.shadow.png'
            };

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 10,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                mapTypeControl: false,
                streetViewControl: false,
                panControl: false,
                zoomControlOptions: {
                    position: google.maps.ControlPosition.LEFT_BOTTOM
                }
            });

            var infowindow = new google.maps.InfoWindow({
                maxWidth: 240
            });

            var marker;
            var markers = new Array();

            var iconCounter = 0;

            // Add the markers and infowindows to the map
            for (var i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map,
                    icon: icons[iconCounter],
                    shadow: shadow
                });

                markers.push(marker);


                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                    return function () {
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));

                iconCounter++;
                // We only have a limited number of possible icon colors, so we may have to restart the counter
                if (iconCounter >= icons_length) {
                    iconCounter = 0;
                }
            }
            markerClusterer = new MarkerClusterer(map, markers,
                {
                    maxZoom: 13,
                    gridSize: 50,
                    styles: null
                });

            function AutoCenter() {
                //  Create a new viewpoint bound
                var bounds = new google.maps.LatLngBounds();
                //  Go through each...
                $.each(markers, function (index, marker) {
                    bounds.extend(marker.position);
                });
                //  Fit these bounds to the map
                map.fitBounds(bounds);
            }
            AutoCenter();
        </script>
    <?php endif; wp_reset_query(); 
    
}
//---------------------------------rewrite для каталога--------------------------------------------------------------------------
function add_org_rules() {   

    add_rewrite_rule(  
        "catalog/(.+?)/metro_(.+?)/shop/?$",  
        'index.php?post_type=shop&org_city=$matches[1]&metro_$matches[1]=$matches[2]',  
        "top");

        add_rewrite_rule(  
        "catalog/(.+?)/metro_(.+?)/shop/page/?([0-9]{1,})/?$",  
        'index.php?post_type=shop&org_city=$matches[1]&metro_$matches[1]=$matches[2]&paged=$matches[3]',  
        "top");

        add_rewrite_rule(  
        "catalog/(.+?)/metro_(.+?)/company/page/?([0-9]{1,})/?$",  
        'index.php?post_type=company&org_city=$matches[1]&metro_$matches[1]=$matches[2]&paged=$matches[3]',  
        "top");

        add_rewrite_rule(  
        "catalog/(.+?)/metro_(.+?)/master/page/?([0-9]{1,})/?$",  
        'index.php?post_type=master&org_city=$matches[1]&metro_$matches[1]=$matches[2]&paged=$matches[3]',  
        "top");        

    add_rewrite_rule(  
        "catalog/(.+?)/metro_(.+?)/company/?$",  
        'index.php?post_type=company&org_city=$matches[1]&metro_$matches[1]=$matches[2]',  
        "top");
    
     add_rewrite_rule(  
        "catalog/(.+?)/metro_(.+?)/master/?$",  
        'index.php?post_type=master&org_city=$matches[1]&metro_$matches[1]=$matches[2]',  
        "top");

add_rewrite_rule(  
        "catalog/(.+?)/metro_(.+?)/page/?([0-9]{1,})/?$",  
        'index.php?org_city=$matches[1]&metro_$matches[1]=$matches[2]&paged=$matches[3]',  
        "top");
    add_rewrite_rule(  
        "catalog/(.+?)/metro_(.+?)/?$",  
        'index.php?org_city=$matches[1]&metro_$matches[1]=$matches[2]',  
        "top");

    add_rewrite_rule(  
        "catalog/(.+?)/shop/page/?([0-9]{1,})/?$",  
        'index.php?org_city=$matches[1]&post_type=shop&paged=$matches[2]',  
        "top"); 

    add_rewrite_rule(  
        "catalog/(.+?)/shop/?$",  
        'index.php?org_city=$matches[1]&post_type=shop',  
        "top");

    add_rewrite_rule(  
        "catalog/(.+?)/company/page/?([0-9]{1,})/?$",  
        'index.php?org_city=$matches[1]&post_type=company&paged=$matches[2]',  
        "top"); 

    add_rewrite_rule(  
        "catalog/(.+?)/master/page/?([0-9]{1,})/?$",  
        'index.php?org_city=$matches[1]&post_type=master&paged=$matches[2]',  
        "top");     

    add_rewrite_rule(  
        "catalog/(.+?)/page/?([0-9]{1,})/?$",  
        'index.php?org_city=$matches[1]&paged=$matches[2]',  
        "top");  
 
    add_rewrite_rule(  
            "catalog/(.+?)/company/?$",  
            'index.php?org_city=$matches[1]&post_type=company',  
            "top");

    add_rewrite_rule(  
            "catalog/(.+?)/master/?$",  
            'index.php?org_city=$matches[1]&post_type=master',  
            "top");   

        add_rewrite_rule(  
        "catalog/(.+?)/?$",  
        'index.php?org_city=$matches[1]',  
        "top"); 
         
    }    
add_action( 'init', 'add_org_rules' );
//---------------------------------/rewrite для каталога--------------------------------------------------------------------------


//---------------------ОТКЛЮЧАЕМ REST API НАЧАЛО--------------------------------------------------------------------------------------
// Отключаем сам REST API
add_filter('rest_enabled', '__return_false');

// Отключаем фильтры REST API
remove_action( 'xmlrpc_rsd_apis',            'rest_output_rsd' );
remove_action( 'wp_head',                    'rest_output_link_wp_head', 10, 0 );
remove_action( 'template_redirect',          'rest_output_link_header', 11, 0 );
remove_action( 'auth_cookie_malformed',      'rest_cookie_collect_status' );
remove_action( 'auth_cookie_expired',        'rest_cookie_collect_status' );
remove_action( 'auth_cookie_bad_username',   'rest_cookie_collect_status' );
remove_action( 'auth_cookie_bad_hash',       'rest_cookie_collect_status' );
remove_action( 'auth_cookie_valid',          'rest_cookie_collect_status' );
remove_filter( 'rest_authentication_errors', 'rest_cookie_check_errors', 100 );

// Отключаем события REST API
remove_action( 'init',          'rest_api_init' );
remove_action( 'rest_api_init', 'rest_api_default_filters', 10, 1 );
remove_action( 'parse_request', 'rest_api_loaded' );

// Отключаем Embeds связанные с REST API
remove_action( 'rest_api_init',          'wp_oembed_register_route'              );
remove_filter( 'rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4 );

remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
// если собираетесь выводить вставки из других сайтов на своем, то закомментируйте след. строку.
remove_action( 'wp_head',                'wp_oembed_add_host_js'                 );

//---------------------ОТКЛЮЧАЕМ REST API КОНЕЦ--------------------------------------------------------------------------------------

?>