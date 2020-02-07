<?php

function wi_get_catid($slug){
    $category = get_category_by_slug($slug);
    if ($category)
        return $category->term_id;
    else return;
}

// filter
for ($i=1; $i<=1; $i++):

add_filter('theme_mod_bf_1_cat', function($ele){if (wi_valid()) {$return = wi_demo(); return $return['sections'][1]['cat'];} return $ele;});
add_filter('theme_mod_bf_1_number', function($ele){if (wi_valid()) {$return = wi_demo(); return $return['sections'][1]['number'];} return $ele;});
add_filter('theme_mod_bf_1_orderby', function($ele){if (wi_valid()) {$return = wi_demo(); return $return['sections'][1]['orderby'];} return $ele;});
add_filter('theme_mod_bf_1_layout', function($ele){if (wi_valid()) {$return = wi_demo(); return $return['sections'][1]['layout'];} return $ele;});
add_filter('theme_mod_bf_1_heading', function($ele){if (wi_valid()) {$return = wi_demo(); return $return['sections'][1]['heading'];} return $ele;});
add_filter('theme_mod_bf_1_viewall_link', function($ele){if (wi_valid()) {$return = wi_demo(); return $return['sections'][1]['viewall_link'];} return $ele;});

add_filter('theme_mod_bf_2_cat', function($ele){if (wi_valid()) {$return = wi_demo(); return $return['sections'][2]['cat'];} return $ele;});
add_filter('theme_mod_bf_2_number', function($ele){if (wi_valid()) {$return = wi_demo(); return $return['sections'][2]['number'];} return $ele;});
add_filter('theme_mod_bf_2_orderby', function($ele){if (wi_valid()) {$return = wi_demo(); return $return['sections'][2]['orderby'];} return $ele;});
add_filter('theme_mod_bf_2_layout', function($ele){if (wi_valid()) {$return = wi_demo(); return $return['sections'][2]['layout'];} return $ele;});
add_filter('theme_mod_bf_2_heading', function($ele){if (wi_valid()) {$return = wi_demo(); return $return['sections'][2]['heading'];} return $ele;});
add_filter('theme_mod_bf_2_viewall_link', function($ele){if (wi_valid()) {$return = wi_demo(); return $return['sections'][2]['viewall_link'];} return $ele;});

add_filter('theme_mod_bf_3_cat', function($ele){if (wi_valid()) {$return = wi_demo(); return $return['sections'][3]['cat'];} return $ele;});
add_filter('theme_mod_bf_3_number', function($ele){if (wi_valid()) {$return = wi_demo(); return $return['sections'][3]['number'];} return $ele;});
add_filter('theme_mod_bf_3_orderby', function($ele){if (wi_valid()) {$return = wi_demo(); return $return['sections'][3]['orderby'];} return $ele;});
add_filter('theme_mod_bf_3_layout', function($ele){if (wi_valid()) {$return = wi_demo(); return $return['sections'][3]['layout'];} return $ele;});
add_filter('theme_mod_bf_3_heading', function($ele){if (wi_valid()) {$return = wi_demo(); return $return['sections'][3]['heading'];} return $ele;});
add_filter('theme_mod_bf_3_viewall_link', function($ele){if (wi_valid()) {$return = wi_demo(); return $return['sections'][3]['viewall_link'];} return $ele;});

add_filter('theme_mod_bf_4_cat', function($ele){if (wi_valid()) {$return = wi_demo(); return $return['sections'][4]['cat'];} return $ele;});
add_filter('theme_mod_bf_4_number', function($ele){if (wi_valid()) {$return = wi_demo(); return $return['sections'][4]['number'];} return $ele;});
add_filter('theme_mod_bf_4_orderby', function($ele){if (wi_valid()) {$return = wi_demo(); return $return['sections'][4]['orderby'];} return $ele;});
add_filter('theme_mod_bf_4_layout', function($ele){if (wi_valid()) {$return = wi_demo(); return $return['sections'][4]['layout'];} return $ele;});
add_filter('theme_mod_bf_4_heading', function($ele){if (wi_valid()) {$return = wi_demo(); return $return['sections'][4]['heading'];} return $ele;});
add_filter('theme_mod_bf_4_viewall_link', function($ele){if (wi_valid()) {$return = wi_demo(); return $return['sections'][4]['viewall_link'];} return $ele;});

add_filter('theme_mod_bf_5_cat', function($ele){if (wi_valid()) {$return = wi_demo(); return $return['sections'][5]['cat'];} return $ele;});
add_filter('theme_mod_bf_5_number', function($ele){if (wi_valid()) {$return = wi_demo(); return $return['sections'][5]['number'];} return $ele;});
add_filter('theme_mod_bf_5_orderby', function($ele){if (wi_valid()) {$return = wi_demo(); return $return['sections'][5]['orderby'];} return $ele;});
add_filter('theme_mod_bf_5_layout', function($ele){if (wi_valid()) {$return = wi_demo(); return $return['sections'][5]['layout'];} return $ele;});
add_filter('theme_mod_bf_5_heading', function($ele){if (wi_valid()) {$return = wi_demo(); return $return['sections'][5]['heading'];} return $ele;});
add_filter('theme_mod_bf_5_viewall_link', function($ele){if (wi_valid()) {$return = wi_demo(); return $return['sections'][5]['viewall_link'];} return $ele;});

endfor;

// main layout + sidebar
add_filter('theme_mod_wi_home_layout',function($ele){if(wi_valid()) {$return = wi_demo(); return $return['main']['layout'];} return $ele;});
add_filter('theme_mod_wi_home_sidebar_state',function($ele){if(wi_valid()) {$return = wi_demo(); return $return['main']['sidebar'];} return $ele;});
add_filter('theme_mod_wi_disable_main_stream',function($ele){if(wi_valid()) {$return = wi_demo(); return $return['main']['disable'];} return $ele;});
add_filter('pre_option_posts_per_page',function($ele){if(wi_valid()) {$return = wi_demo(); return $return['main']['number'];} return $ele;});

// background
add_filter('theme_mod_wi_body_background',function($ele){
    global $demo; 
    if ($demo=='old') {
        return 'http://withemes.com/fox/wp-content/uploads/2015/04/bgnoise_lg.png';
    } elseif($demo=='background_image') {
        return 'http://withemes.com/fox/wp-content/uploads/2015/04/girleye.jpg';
    } else {
        return $ele;
    }
}
          );
add_filter('theme_mod_wi_body_background_repeat',function($ele){global $demo; if ($demo=='old') return 'repeat'; return $ele;});
add_filter('theme_mod_wi_body_background_size',function($ele){global $demo; if ($demo=='old') return 'auto'; return $ele;});
add_filter('theme_mod_wi_enable_hand_lines',function($ele){global $demo; if ($demo=='old') return true; return $ele;});

// background color
add_filter('theme_mod_wi_body_background_color',function($ele){global $demo; if ($demo=='background_black') {return '#000';} return $ele;});

// font
add_filter('theme_mod_wi_body_font',function($ele){global $demo; if ($demo=='font') {return 'Lato';} return $ele;});
add_filter('theme_mod_wi_body_fallback_font',function($ele){global $demo; if ($demo=='font') {return 'sans-serif';} return $ele;});
add_filter('theme_mod_wi_heading_font',function($ele){global $demo; if ($demo=='font') {return 'Francois One';} return $ele;});
add_filter('theme_mod_wi_nav_font',function($ele){global $demo; if ($demo=='font') {return 'Francois One';} return $ele;});

// single layout
add_filter('theme_mod_wi_single_sidebar_state',function($ele){global $demo; if ($demo=='fullwidth') return 'no-sidebar'; return $ele;});

/* ===== DEMO DESCRIPTION ==== *
 * Demo 1
 - [Standard]: Big post + 4 columns + standard + sidebar left
 - [Pinterest-like]: Masonry 3 columns, 2 columns + sidebar, Masonry 4 columns
 - [Grid]: 3 columns, 4 columns, 2 colums + sidebar
 - [Newspaper]: Slider + 4 columns + Newspaper
 - [Magazine]: Slider + 3 columns + Sidebar + Grid 3 columns
 - [Background]

 */
global $demo;
$demo = isset($_GET['demo']) ? esc_html(trim($_GET['demo'])) : '';

function wi_demo(){
    global $demo;
    $sections = array(1=>array(), 2=>array(), 3=>array(), 4=>array(), 5=>array());
    $main = array();
    $return = array();
    
    $defaults = array(
        'cat'       =>  '',
        'number'    =>  3,
        'orderby'   =>  'date',
        'layout'    =>  'grid-3',
        'heading'   =>  '',
        'viewall_link'=>'',
    );
    
    $defaults_main = array(
        'layout'    =>  'standard',
        'sidebar'   =>  'sidebar-left',
        'number'    =>  10,
        'disable'   =>  false,
    );
    
    /* ====================         SLIDER       ====================  */
    if ($demo == 'slider'){
        
        // first slider
        $sections[1] = array(
            'cat'       =>  wi_get_catid('photography'),
            'number'    =>  3,
            'orderby'   =>  'date',
            'layout'    =>  'slider',
            'heading'   =>  '',
            'viewall_link'=>'',
        );
        
        // then 4 posts
        $sections[2] = array(
            'cat'       =>  'all',
            'number'    =>  4,
            'orderby'   =>  'view',
            'layout'    =>  'grid-4',
            'heading'   =>  'Popular posts',
        );
        
        // then standard
        $main['layout'] = 'standard';
        $main['sidebar'] = 'sidebar-left';
    }
    
    /* ====================         PINTEREST       ====================  */
    if ($demo == 'masonry'){
        
        // first slider
        $sections[1] = array(
            'cat'       =>  '',
            'number'    =>  2,
            'orderby'   =>  'date',
            'layout'    =>  'slider',
            'heading'   =>  '',
            'viewall_link'=>'',
        );
        
        // then 4 posts
        $sections[2] = array(
            'cat'       =>  '',
            'number'    =>  4,
            'orderby'   =>  'view',
            'layout'    =>  'grid-4',
            'heading'   =>  'Popular posts',
            'viewall_link'=>'#',
        );
        
        // then standard
        $main = array(
            'layout'    =>  'masonry-3',
            'sidebar'   =>  'no-sidebar',
            'number'    =>  15,
        );
    }
    
    /* ====================         PINTEREST & SIDEBAR       ====================  */
    if ($demo == 'masonry_2') {
        
        // first slider
        $sections[1] = array(
            'cat'       =>  wi_get_catid('photography'),
            'number'    =>  3,
            'orderby'   =>  'date',
            'layout'    =>  'slider',
            'heading'   =>  '',
            'viewall_link'=>'',
        );
        
        // then 4 posts
        $sections[2] = array(
            'cat'       =>  wi_get_catid('lifestyle'),
            'number'    =>  4,
            'orderby'   =>  'date',
            'layout'    =>  'grid-4',
            //'heading'   =>  'Photography',
            'viewall_link'=>'#',
        );
        
        // then masonry-2
        $main = array(
            'layout'    =>  'masonry-2',
            'sidebar'   =>  'sidebar-left',
            'number'    =>  12
        );
    }
    
    /* ====================         DENSITY NEWS       ====================  */
    if ($demo == 'masonry_4'){
        
        // first slider
        $sections[1] = array(
            'cat'       =>  '',
            'number'    =>  4,
            'orderby'   =>  'date',
            'layout'    =>  'grid-4',
            'heading'   =>  '',
            'viewall_link'=>'',
        );
        
        // then masonry-2
        $main = array(
            'layout'    =>  'masonry-4',
            'sidebar'   =>  'no-sidebar',
            'number'    =>  16
        );
    }
    
    /* ====================         NEWSPAPER       ====================  */
    if ($demo == 'newspaper'){
        
        // first slider
        $sections[1] = array(
            'cat'       =>  wi_get_catid('photography'),
            'number'    =>  3,
            'orderby'   =>  'date',
            'layout'    =>  'slider',
            'heading'   =>  '',
            'viewall_link'=>'',
        );
        
        // then 4 posts
        $sections[2] = array(
            'cat'       =>  '',
            'number'    =>  4,
            'orderby'   =>  'view',
            'layout'    =>  'grid-4',
            'heading'   =>  'Popular posts',
            'viewall_link'=>'#',
        );
        
        // then standard
        $main = array(
            'layout'    =>  'newspaper',
            'sidebar'   =>  'no-sidebar',
            'number'    =>  9,
        );
    }
    
    /* ====================         SIDEBAR RIGHT       ====================  */
    if ($demo == 'sidebar_right'){
        
        // then standard
        $main = array(
            'layout'    =>  'standard',
            'sidebar'   =>  'sidebar-right',
        );
    }
    
    /* ====================         FULLWIDTH       ====================  */
    if ($demo == 'fullwidth'){
        
        // then standard
        $main = array(
            'layout'    =>  'standard',
            'sidebar'   =>  'no-sidebar',
        );
    }
    
    /* ====================         LIST       ====================  */
    if ($demo == 'list'){
        
        // first slider
        $sections[1] = array(
            'cat'       =>  wi_get_catid('photography'),
            'number'    =>  3,
            'orderby'   =>  'date',
            'layout'    =>  'slider',
            'heading'   =>  '',
            'viewall_link'=>'',
        );
        
        // then standard
        $main = array(
            'layout'    =>  'list',
            'sidebar'   =>  'sidebar-left',
        );
    }
    
    /* ====================         GRID       ====================  */
    if ($demo == 'grid'){
        
        // first slider
        $sections[1] = array(
            'cat'       =>  wi_get_catid('photography'),
            'number'    =>  3,
            'orderby'   =>  'date',
            'layout'    =>  'slider',
            'heading'   =>  '',
            'viewall_link'=>'',
        );
        
        // then standard
        $main = array(
            'layout'    =>  'grid-4',
            'sidebar'   =>  'no-sidebar',
            'number'    =>  12,
        );
    }
    
    /* ====================         GRID 3 COLUMNS      ====================  */
    if ($demo == 'grid_3'){
        
        // first slider
        $sections[1] = array(
            'cat'       =>  'sticky',
            'number'    =>  1,
            'orderby'   =>  'date',
            'layout'    =>  'big-post',
            'heading'   =>  '',
            'viewall_link'=>'',
        );
        
        // then standard
        $main = array(
            'layout'    =>  'grid-3',
            'sidebar'   =>  'no-sidebar',
            'number'    =>  9,
        );
    }
    
    /* ====================         GRID 2 COLUMNS      ====================  */
    if ($demo == 'grid_2'){
        
        // first slider
        $sections[1] = array(
            'cat'       =>  'sticky',
            'number'    =>  1,
            'orderby'   =>  'date',
            'layout'    =>  'big-post',
            'heading'   =>  '',
            'viewall_link'=>'',
        );
        
        // then standard
        $main = array(
            'layout'    =>  'grid-2',
            'sidebar'   =>  'sidebar-left',
            'number'    =>  14,
        );
    }
    
    /* ====================         OLD NEWSPAPER      ====================  */
    if ($demo == 'old'){
        
        // first slider
        $sections[1] = array(
            'cat'       =>  'sticky',
            'number'    =>  1,
            'orderby'   =>  'date',
            'layout'    =>  'big-post',
            'heading'   =>  '',
            'viewall_link'=>'',
        );
        
    }
    
    /* ====================         BIG POSTS      ====================  */
    if ($demo == 'big_posts'){
        
        // first slider
        $sections[1] = array(
            'cat'       =>  'sticky',
            'number'    =>  1,
            'orderby'   =>  'date',
            'layout'    =>  'big-post',
            'heading'   =>  '',
            'viewall_link'=>'',
        );
        
        $main = array(
            'layout'    =>  'grid-2',
            'sidebar'   =>  'no-sidebar',
            'number'    =>  10,
        );
        
    }
    
    /* ====================         FONTS      ====================  */
    if ($demo == 'font'){
        
        // first slider
        $sections[1] = array(
            'cat'       =>  'sticky',
            'number'    =>  1,
            'orderby'   =>  'date',
            'layout'    =>  'big-post',
            'heading'   =>  '',
            'viewall_link'=>'',
        );
        
    }
    
    // parse args
    foreach ($sections as $i => $section) {
        $section = wp_parse_args($section, $defaults);
        $sections[$i] = $section;
    }
    $main = wp_parse_args($main, $defaults_main);
    
    $return['sections'] = $sections;
    $return['main'] = $main;
    
    return $return;
    
}

function wi_valid() {
    global $demo;
    $list_demo = 'slider, masonry, masonry_2, masonry_4, newspaper, grid, grid_2, grid_3, list, fullwidth, sidebar_right, old, background_black, background_image, big_posts,font';
    $list_demo = explode(',',$list_demo);
    $list_demo = array_map('trim',$list_demo);
    if ( !in_array($demo,$list_demo) ) return false;
    else return true;
}