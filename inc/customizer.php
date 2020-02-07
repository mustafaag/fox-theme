<?php
// CUSTOMIZER
if (!class_exists('Wi_Customize')):
class Wi_Customize {

	public static function register( $wp_customize ) {
        
        /* -------------------------------------------------------------------- */
        /* ADD OPTIONS
        /* -------------------------------------------------------------------- */
        
        $wp_customize->add_section(
					 'wi_header', array(
							 'title'    => __( 'Header', 'wi' ),
							 'priority' => 924,
						 )
		);
        
        $wp_customize->add_section(
					 'wi_typography', array(
							 'title'    => __( 'Select fonts', 'wi' ),
							 'priority' => 930,
						 )
		);
        
        $wp_customize->add_section(
					 'wi_fontsize', array(
							 'title'    => __( 'Font size', 'wi' ),
							 'priority' => 932,
						 )
		);
        
        $wp_customize->add_section(
					 'wi_style', array(
							 'title'    => __( 'Theme Style', 'wi' ),
							 'priority' => 933,
						 )
		);
        
        $wp_customize->add_section(
					 'wi_blog', array(
							 'title'    => __( 'Blog', 'wi' ),
							 'priority' => 935,
						 )
		);
        
        $wp_customize->add_section(
					 'wi_single', array(
							 'title'    => __( 'Single', 'wi' ),
							 'priority' => 936,
						 )
		);
        
        $wp_customize->add_section(
					 'wi_page', array(
							 'title'    => __( 'Page', 'wi' ),
							 'priority' => 937,
						 )
		);
        
        $wp_customize->add_section(
					 'wi_social', array(
							 'title'    => __( 'Social Media', 'wi' ),
							 'priority' => 938,
						 )
		);
        
        $wp_customize->add_section(
					 'wi_footer', array(
							 'title'    => __( 'Footer', 'wi' ),
							 'priority' => 939,
						 )
		);
        
        $wp_customize->add_section(
					 'wi_icon', array(
							 'title'    => __( 'Icons', 'wi' ),
							 'priority' => 940,
						 )
		);
        
        $wp_customize->add_section(
					 'wi_css', array(
							 'title'    => __( 'Custom CSS', 'wi' ),
							 'priority' => 944,
						 )
		);
        
        $wp_customize->add_section(
					 'wi_translation', array(
							 'title'    => __( 'Quick Translation', 'wi' ),
							 'priority' => 946,
						 )
		);
        
        /* -------------------------------------------------------------------- */
        /* ICONS
        /* -------------------------------------------------------------------- */
        // favicon
        $wp_customize->add_setting(
                     "wi_favicon"
        );
        $wp_customize->add_control(
           new WP_Customize_Image_Control(
               $wp_customize,
               "wi_favicon",
               array(
                   'label'      => __( 'Upload a favicon for your site (16px 16px)', 'wi' ),
                   'section'    => 'wi_icon',
                   'settings'   => "wi_favicon",
                   'description'=>  __('Favicon is a small image on the address bar of your browser','wi'),
               )
           )
       );
        
        $sizes = array(57, 72, 76, 114, 144, 152, 180);
        foreach ($sizes as $size){
            // icon
            $wp_customize->add_setting(
                         "wi_apple_$size"
            );
            $wp_customize->add_control(
               new WP_Customize_Image_Control(
                   $wp_customize,
                   "apple_$size",
                   array(
                       'label'      => sprintf(__( 'Apple icon with size %s', 'wi' ),$size .'px '.$size . 'px'),
                       'section'    => 'wi_icon',
                       'settings'   => "wi_apple_$size",
                       'description'=>  __('This icon used for your website on some Apple device (iPhone 5, iPhone 6, iPad...)','wi'),
                   )
               )
           );
            
        }
        
        /* -------------------------------------------------------------------- */
        /* HOMEPAGE BUILDER
        /* -------------------------------------------------------------------- */
        // register panel
        $wp_customize->add_panel( 'homepage', array(
            'priority'    => 10,
            'title'       => 'Homepage Builder',
            'description' => 'Using this module, you can enable 1 - 10 sections that appear before main stream.',
        ) );
        
        // disable main content stream
        $wp_customize->add_section( 'disable_main_stream' , array(
                'title' => 'Disable Main Stream',
                'panel' => 'homepage',
                'description'=> 'Check this to disable main posts stream on your homepage. This will make your site looks like a magazine instead of a blog.'
            ) );
        
        // sidebar state
        $wp_customize->add_setting(
                     'wi_disable_main_stream'
        );
        $wp_customize->add_control(
                     'disable_main_stream', array (
                             'label'    => 'Disable main posts stream?',
                             'settings' => 'wi_disable_main_stream',
                             'section'  => 'disable_main_stream',
                             'type'     => 'checkbox',
                         )
        );
        
        // cat array
        $cat_arr = array(
            ''          =>  '...',
            'all'       =>  'All categories',
            'featured'  =>  'Posts marked by "star"',
            'sticky'    =>  'Sticky posts',
        );
        $cats = get_categories();
        foreach ($cats as $cat) {
            $cat_arr[strval($cat->term_id)] = sprintf('Category: %s',$cat->name);
        }
        
        // orderby array
        $orderby_arr = array('date'=>'Date','comment'=>'Comment count','view'=>'View count');
        
        $sections = array();
        for ($i=1; $i<=10;$i++):
            // add section
            $cat = get_theme_mod('bf_' . $i . '_cat');
            $title = 'Section '. $i;
            if ($cat == 'featured') $title .= ': Featured posts';
            elseif ($cat == 'all') $title .= ': All posts';
            elseif ($cat == 'sticky') $title .= ': Sticky posts';
            elseif ($cat != '') $title .= ': ' . get_cat_name($cat);
            $wp_customize->add_section( 'bf_'.$i , array(
                'title' => $title,
                'panel' => 'homepage',
            ) );
        
            // select from category
            $wp_customize->add_setting(
                'bf_' . $i . '_cat'
            );
            $wp_customize->add_control(
                         'bf_' . $i . '_cat', array(
                                 'label'    => 'Display posts from?',
                                 'settings' => 'bf_' . $i . '_cat',
                                 'section'  => 'bf_'.$i,
                                 'type'     => 'select',
                                 'choices'  => $cat_arr,
                                 'description'=>'If you wanna learn about Sticky post, read <a href="http://www.wpbeginner.com/beginners-guide/how-to-make-sticky-posts-in-wordpress/" target="_blank">this article</a>.'
                             )
            );
        
            // number
            $wp_customize->add_setting(
                'bf_' . $i . '_number', array('default'=>4)
            );
            $wp_customize->add_control(
                         'bf_' . $i . '_number', array(
                                 'label'    => 'Number of posts to show?',
                                 'settings' => 'bf_' . $i . '_number',
                                 'section'  => 'bf_'.$i,
                                 'type'     => 'number',
                                 'input_attrs'=>array('min'=>-1,'max'=>30)
                             )
            );
        
            // orderby
            $wp_customize->add_setting(
                'bf_' . $i . '_orderby', array('default'=>'date')
            );
            $wp_customize->add_control(
                         'bf_' . $i . '_orderby', array(
                                 'label'    => 'Order by?',
                                 'settings' => 'bf_' . $i . '_orderby',
                                 'section'  => 'bf_'.$i,
                                 'type'     => 'select',
                                 'choices'  => $orderby_arr,
                             )
            );
        
            // block type
            $wp_customize->add_setting(
                'bf_' . $i . '_layout'
            );
            $wp_customize->add_control(
                         'bf_' . $i . '_layout', array(
                                 'label'    => 'Displaying as',
                                 'settings' => 'bf_' . $i . '_layout',
                                 'section'  => 'bf_'.$i,
                                 'type'     => 'select',
                                 'choices'  => wi_block_array(),
                             )
            );
        
            // Heading
            $wp_customize->add_setting(
                         'bf_' . $i . '_heading', array(
                             'sanitize_callback' => 'sanitize_text_field',
                         )
            );
            $wp_customize->add_control(
                         'bf_' . $i . '_heading', array(
                                 'label'    => 'Heading text',
                                 'settings' => 'bf_' . $i . '_heading',
                                 'section'  => 'bf_'.$i,
                                 'type'     => 'text'
                             )
            );
        
            // View all link?
            $wp_customize->add_setting(
                         'bf_' . $i . '_viewall_link'
            );
            $wp_customize->add_control(
                         'bf_' . $i . '_viewall_link', array(
                                 'label'    => '"View all" URL',
                                 'settings' => 'bf_' . $i . '_viewall_link',
                                 'section'  => 'bf_'.$i,
                                 'type'     => 'url'
                             )
            );
        
            // View all text?
            $wp_customize->add_setting(
                         'bf_' . $i . '_viewall_text'
            );
            $wp_customize->add_control(
                         'bf_' . $i . '_viewall_text', array(
                                 'label'    => '"View all" text',
                                 'settings' => 'bf_' . $i . '_viewall_text',
                                 'section'  => 'bf_'.$i,
                                 'type'     => 'text'
                             )
            );
        
        
        endfor;
       
        /* -------------------------------------------------------------------- */
        /* LAYOUT
        /* -------------------------------------------------------------------- */
        // register panel
        $wp_customize->add_panel( 'layout', array(
            'priority'    => 11,
            'title'       => 'Layout'
        ) );
        
        // ARCHIVE LAYOUTS
        $elements = array(
            'home'          =>  array('Homepage','Customize layout for main posts stream on front page'),
            'category'      =>  array('Category','Customize layout for categories. You can still select layout for each individual category when edit category'),
            'archive'       =>  'Archive page',
            'tag'           =>  array('Tag','Customize layout for tags. You can still select layout for each individual tag when edit tag'),
            'author'        =>  'Author page',
            'search'        =>  'Search page',
            'all-featured'  =>  'All featured posts page',
        );
        
        foreach ($elements as $ele => $name ) {
            if (is_array($name)) {$desc = $name[1]; $name = $name[0];} else {$desc = '';}
            
            $wp_customize->add_section( 'wi_layout_'.$ele, array(
                'title'       => $name . ' Layout',
                'panel'       => 'layout',
                'description' => $desc,

            ) );
            
            // layout
            $wp_customize->add_setting(
                         'wi_'.$ele.'_layout'
            );
            $wp_customize->add_control(
                         $ele. '_layout', array (
                                 'label'    => 'Select Layout',
                                 'settings' => 'wi_'.$ele.'_layout',
                                 'section'  => 'wi_layout_'.$ele,
                                 'type'     => 'select',
                                 'choices'  => wi_layout_array(),
                             )
            );
            
            // sidebar state
            $wp_customize->add_setting(
                         'wi_'.$ele.'_sidebar_state', array('default'=>'sidebar-right')
            );
            $wp_customize->add_control(
                         $ele. '_sidebar_state', array (
                                 'label'    => 'Sidebar?',
                                 'settings' => 'wi_'.$ele.'_sidebar_state',
                                 'section'  => 'wi_layout_'.$ele,
                                 'type'     => 'radio',
                                 'choices'  => wi_sidebar_array(),
                             )
            );
            
        } // foreach
        
        // SINGLE LAYOUT
        $wp_customize->add_section( 'wi_layout_single', array(
            'title'       => 'Single post Layout',
            'panel'       => 'layout',
        ) );
        
        // sidebar state
        $wp_customize->add_setting(
                     'wi_single_sidebar_state', array('default'=>'sidebar-right')
        );
        $wp_customize->add_control(
                     'single_sidebar_state', array (
                             'label'    => 'Sidebar?',
                             'settings' => 'wi_single_sidebar_state',
                             'section'  => 'wi_layout_single',
                             'type'     => 'radio',
                             'choices'  => wi_sidebar_array(),
                         )
        );
        
        // PAGE LAYOUT
        $wp_customize->add_section( 'wi_layout_page', array(
            'title'       => 'Page Layout',
            'panel'       => 'layout',
        ) );
        
        // sidebar state
        $wp_customize->add_setting(
                     'wi_page_sidebar_state', array('default'=>'sidebar-right')
        );
        $wp_customize->add_control(
                     'page_sidebar_state', array (
                             'label'    => 'Sidebar?',
                             'settings' => 'wi_page_sidebar_state',
                             'section'  => 'wi_layout_page',
                             'type'     => 'radio',
                             'choices'  => wi_sidebar_array(),
                         )
        );
        
        /* -------------------------------------------------------------------- */
        /* HEADER SETTING
        /* -------------------------------------------------------------------- */
        // logo
        $wp_customize->add_setting(
					 'wi_logo'
		);
        $wp_customize->add_control(
           new WP_Customize_Image_Control(
               $wp_customize,
               'logo',
               array(
                   'label'      => __( 'Upload a logo', 'wi' ),
                   'section'    => 'wi_header',
                   'settings'   => 'wi_logo',
               )
           )
       );
        
        
        // logo retina
        $wp_customize->add_setting(
					 'wi_logo_retina'
		);
        $wp_customize->add_control(
           new WP_Customize_Image_Control(
               $wp_customize,
               'logo_retina',
               array(
                   'label'      => __( 'Upload retina version of the logo', 'wi' ),
                   'section'    => 'wi_header',
                   'settings'   => 'wi_logo_retina',
                   'description'=> __('2x times logo dimensions','wi'), 
               )
           )
        );
        
        // logo width
        $wp_customize->add_setting(
					 'wi_logo_width'
		);
		$wp_customize->add_control(
					 'logo_width', array(
							 'label'    => 'Logo width (px)',
							 'settings' => 'wi_logo_width',
							 'section'  => 'wi_header',
							 'type'     => 'number',
						 )
		);
        
        // Margin top
        $wp_customize->add_setting(
                     'wi_logo_margin_top', array(
                             'sanitize_callback' => 'sanitize_text_field',
                         )
        );
        $wp_customize->add_control(
                     'logo_margin_top', array(
                             'label'    => __( 'Logo margin top (px)', 'wi' ),
                             'settings' => 'wi_logo_margin_top',
                             'section'  => 'wi_header',
                             'type'     => 'text',
                         )
        );
        
        // Margin bottom
        $wp_customize->add_setting(
                     'wi_logo_margin_bottom', array(
                             'sanitize_callback' => 'sanitize_text_field',
                         )
        );
        $wp_customize->add_control(
                     'logo_margin_bottom', array(
                             'label'    => __( 'Logo margin bottom (px)', 'wi' ),
                             'settings' => 'wi_logo_margin_bottom',
                             'section'  => 'wi_header',
                             'type'     => 'text',
                         )
        );
        
        
        // Header social icons
		$wp_customize->add_setting(
					 'wi_disable_header_social', array(
							 'default'           => false,
							 'sanitize_callback' => 'wi_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'disable_header_social', array(
							 'label'    => __( 'Disable header social icons', 'wi' ),
							 'settings' => 'wi_disable_header_social',
							 'section'  => 'wi_header',
							 'type'     => 'checkbox',
						 )
		);
        
        // Header search
		$wp_customize->add_setting(
					 'wi_disable_header_search', array(
							 'default'           => false,
							 'sanitize_callback' => 'wi_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'disable_header_search', array(
							 'label'    => 'Disable header search',
							 'settings' => 'wi_disable_header_search',
							 'section'  => 'wi_header',
							 'type'     => 'checkbox',
						 )
		);
        
        // Header slogan
		$wp_customize->add_setting(
					 'wi_disable_header_slogan', array(
							 'default'           => false,
							 'sanitize_callback' => 'wi_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'disable_header_slogan', array(
							 'label'    => __( 'Disable header slogan?', 'wi' ),
							 'settings' => 'wi_disable_header_slogan',
							 'section'  => 'wi_header',
							 'type'     => 'checkbox',
						 )
		);
        
        // Submenu style
		$wp_customize->add_setting(
					 'wi_submenu_style', array(
							 'default'           => 'light',
						 )
		);
		$wp_customize->add_control(
					 'submenu_style', array(
							 'label'    => 'Select submenu style',
							 'settings' => 'wi_submenu_style',
							 'section'  => 'wi_header',
							 'type'     => 'select',
                             'choices'  =>  array('light'=>'Light','dark'=>'Dark'),
						 )
		);
        
        // Header Code
        $wp_customize->add_setting(
                     'wi_header_code'
        );
        $wp_customize->add_control(
                     'header_code', array(
                             'label'    => __( 'Add custom code to header', 'wi' ),
                             'settings' => 'wi_header_code',
                             'section'  => 'wi_header',
                             'type'     => 'textarea',
                             'description'=>  __('Add any code inside <head> tag. Don\'t write anything unless you understand what you\'re doing.','wi'),
                         )
        );
        
        /* -------------------------------------------------------------------- */
        /* FOOTER
        /* -------------------------------------------------------------------- */
        
        // footer logo
        $wp_customize->add_setting(
					 'wi_footer_logo'
		);
        $wp_customize->add_control(
           new WP_Customize_Image_Control(
               $wp_customize,
               'footer_logo',
               array(
                   'label'      => __( 'Upload footer logo', 'wi' ),
                   'section'    => 'wi_footer',
                   'settings'   => 'wi_footer_logo',
               )
           )
       );
        
        // logo retina
        $wp_customize->add_setting(
					 'wi_footer_logo_retina'
		);
        $wp_customize->add_control(
           new WP_Customize_Image_Control(
               $wp_customize,
               'footer_logo_retina',
               array(
                   'label'      => __( 'Upload retina version of the footer logo', 'wi' ),
                   'section'    => 'wi_footer',
                   'settings'   => 'wi_footer_logo_retina',
                   'description'=> __('2x times footer logo dimensions','wi'), 
               )
           )
       );
        
        // footer logo width
        $wp_customize->add_setting(
					 'wi_footer_logo_width'
		);
		$wp_customize->add_control(
					 'footer_logo_width', array(
							 'label'    => 'Footer logo width (px)',
							 'settings' => 'wi_footer_logo_width',
							 'section'  => 'wi_footer',
							 'type'     => 'number',
						 )
		);
        
        // Footer social icons
		$wp_customize->add_setting(
					 'wi_disable_footer_social', array(
							 'default'           => false,
							 'sanitize_callback' => 'wi_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'disable_footer_social', array(
							 'label'    => __( 'Disable footer social icons', 'wi' ),
							 'settings' => 'wi_disable_footer_social',
							 'section'  => 'wi_footer',
							 'type'     => 'checkbox',
						 )
		);
        
        // Footer search
		$wp_customize->add_setting(
					 'wi_disable_footer_search', array(
							 'default'           => false,
							 'sanitize_callback' => 'wi_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'disable_footer_search', array(
							 'label'    => __( 'Disable footer seachbox?', 'wi' ),
							 'settings' => 'wi_disable_footer_search',
							 'section'  => 'wi_footer',
							 'type'     => 'checkbox',
						 )
		);
        
        // Copyright text
        $wp_customize->add_setting(
                     'wi_copyright', array(
                            'default'           => '',
                         )
        );
        $wp_customize->add_control(
                     'copyright', array(
                             'label'    => __( 'Copyright text', 'wi' ),
                             'settings' => 'wi_copyright',
                             'section'  => 'wi_footer',
                             'type'     => 'textarea',
                         )
        );
        
        // Scroll up button
		$wp_customize->add_setting(
					 'wi_disable_backtotop', array(
							 'default'           => false,
							 'sanitize_callback' => 'wi_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'disable_backtotop', array(
							 'label'    => __( 'Disable "back to top" button', 'wi' ),
							 'settings' => 'wi_disable_backtotop',
							 'section'  => 'wi_footer',
							 'type'     => 'checkbox',
						 )
		);
      
        /* -------------------------------------------------------------------- */
        /* SELECT FONTS
        /* -------------------------------------------------------------------- */
        
        $types = array(
            'body'=> __('Body text','wi'),
            'heading' => __('Heading text','wi'),
            'nav' => __('Menu','wi')
        );
        
        $default_fonts = array(
            'body'          =>  'Merriweather',
            'heading'       =>  'Oswald',
            'nav'           =>  'Oswald',
        );
        
        $default_fallback = array(
            'body'          =>  'Georgia, serif',
            'heading'       =>  'sans-serif',
            'nav'           =>  'sans-serif',
        );
        
        foreach ($types as $type => $element ) {
            // font
            $wp_customize->add_setting(
                         'wi_'.$type.'_font', array('default' => $default_fonts[$type])
            );
            $wp_customize->add_control(
                         $type.'_font', array(
                                 'label'    => sprintf(__( 'Select "%s" font?', 'wi' ), $element),
                                 'settings' => 'wi_'.$type.'_font',
                                 'section'  => 'wi_typography',
                                 'type'     => 'select',
                                 'choices'  => wi_font_array(),
                             )
            );
            
            
            // custom font name
            $wp_customize->add_setting(
                         'wi_'.$type.'_custom_font', array(
                                 'sanitize_callback' => 'sanitize_text_field',
                             )
            );
            $wp_customize->add_control(
                         $type.'_custom_font', array(
                                 'label'    => sprintf(__( 'Custom font name for "%s" if it\'s not in Google fonts', 'wi' ), $element),
                                 'settings' => 'wi_'.$type.'_custom_font',
                                 'section'  => 'wi_typography',
                                 'type'     => 'text',
                             )
            );
            
            // fallback font
            $wp_customize->add_setting(
                         'wi_'.$type.'_fallback_font', array('default'=>$default_fallback[$type])
            );
            $wp_customize->add_control(
                         $type.'_fallback_font', array(
                                 'label'    => sprintf(__( 'Fallback font for "%s"?', 'wi' ), $element),
                                 'settings' => 'wi_'.$type.'_fallback_font',
                                 'section'  => 'wi_typography',
                                 'type'     => 'select',
                                 'choices'  => wi_fallback_font_array(),
                             )
            );
            
        } // foreach
        
        /* -------------------------------------------------------------------- */
        /* FONT SIZE
        /* -------------------------------------------------------------------- */
        
        $elements = array(
            'body'  =>  'Body',
            'nav'   =>  'Menu item',
            'nav-sub'=>  'Submenu item',
            'section-heading'   =>  'Section Heading',
            'slider-title'      =>  'Slider post title',
            'big-title'         =>  'Big post title',
            'post-title'        =>  'Standard-layout post title',
            'grid-title'        =>  'Grid-layout post title',
            'masonry-title'     =>  'Masonry-layout post title',
            'newspaper-title'   =>  'Newspaper-layout post title',
            'list-title'        =>  'List-layout post title',
            'page-title'        =>  'Single page title',
            'archive-title'     =>  'Archive (category, tag...) page title',
            'widget-title'      =>  'Widget title',
            'h1'    =>  'H1',
            'h2'    =>  'H2',
            'h3'    =>  'H3',
            'h4'    =>  'H4',
            'h5'    =>  'H5',
            'h6'    =>  'H6',
        );
        
        $defaults = array(
            'body'  =>  '16',
            'nav'   =>  '26',
            'nav-sub'=>  '12',
            'section-heading'   =>  '80',
            'slider-title'      =>  '60',
            'big-title'         =>  '60',
            'post-title'        =>  '52',
            'grid-title'        =>  '26',
            'masonry-title'     =>  '32',
            'newspaper-title'   =>  '36',
            'list-title'        =>  '36',
            'page-title'        =>  '70',
            'archive-title'     =>  '80',
            'widget-title'      =>  '12',
            'h1'    =>  '40',
            'h2'    =>  '32',
            'h3'    =>  '26',
            'h4'    =>  '22',
            'h5'    =>  '18',
            'h6'    =>  '14',
        );
        
        foreach ($elements as $ele => $label) {
        
            // Size
            $wp_customize->add_setting(
                         'wi_'.$ele.'_size', array(
                                 'sanitize_callback' => 'sanitize_text_field',
                                 'default'            => $defaults[$ele],
                             )
            );
            $wp_customize->add_control(
                         ''.$ele.'_size', array(
                                 'label'    => sprintf(__( '%s font size', 'wi' ), $label),
                                 'settings' => 'wi_'.$ele.'_size',
                                 'section'  => 'wi_fontsize',
                                 'type'     => 'text',
                             )
            );
        
        }
        
        // Slogan letter spacing
        $wp_customize->add_setting(
                     'wi_slogan_spacing', array(
                             'sanitize_callback' => 'sanitize_text_field',
                             'default'            => '12',
                         )
        );
        $wp_customize->add_control(
                     'slogan_spacing', array(
                             'label'    => __( 'Slogan letter spacing', 'wi' ),
                             'settings' => 'wi_slogan_spacing',
                             'section'  => 'wi_fontsize',
                             'type'     => 'text',
                         )
        );
        
        
        /* -------------------------------------------------------------------- */
        /* STYLE
        /* -------------------------------------------------------------------- */
        // Line Style
        $wp_customize->add_setting(
                     'wi_enable_hand_lines', array(
                             'sanitize_callback' => 'wi_sanitize_checkbox',
                             'default'            => false,
                         )
        );
        $wp_customize->add_control(
                     'wi_enable_hand_lines', array(
                             'label'    => __( 'Enable hand-drawn lines instead of straight lines', 'wi' ),
                             'settings' => 'wi_enable_hand_lines',
                             'section'  => 'wi_style',
                             'type'     => 'checkbox',
                         )
        );
        
        // Content width
		$wp_customize->add_setting(
					 'wi_content_width', array(
							 'default'           => '',
						 )
		);
		$wp_customize->add_control(
					 'content_width', array(
							 'label'    => 'Content width (px)',
							 'settings' => 'wi_content_width',
							 'section'  => 'wi_style',
							 'type'     => 'number',
                             'description'   => 'Enter a number. Default is 1020px.',
						 )
		);
        
        // Sidebar width
		$wp_customize->add_setting(
					 'wi_sidebar_width', array(
							 'default'           => '',
						 )
		);
		$wp_customize->add_control(
					 'sidebar_width', array(
							 'label'    => 'Sidebar width (px)',
							 'settings' => 'wi_sidebar_width',
							 'section'  => 'wi_style',
							 'type'     => 'number',
                             'description'   => 'Enter a number. Default is 265px.',
						 )
		);
        
		$colors = array();
        
        $colors[] = array(
			'slug'    => 'primary_color',
			'default' => '#db4a37',
			'label'   => __( 'Accent color', 'wi' )
		);

		$colors[] = array(
			'slug'    => 'text_color',
			'default' => '#000000',
			'label'   => __( 'Text Color', 'wi' )
		);
        
		$colors[] = array(
			'slug'    => 'link_color',
			'default' => '#db4a37',
			'label'   => __( 'Link Color', 'wi' )
		);
        
		$colors[] = array(
			'slug'    => 'link_hover_color',
			'default' => '#db4a37',
			'label'   => __( 'Link hover color', 'wi' )
		);
		$colors[] = array(
			'slug'    => 'active_nav_color',
			'default' => '#fff',
			'label'   => __( 'Menu active color', 'wi' )
		);
        $colors[] = array(
			'slug'    => 'widget_title_bg_color',
			'default' => '#000',
			'label'   => __( 'Widget title background color', 'wi' )
		);
		$colors[] = array(
			'slug'    => 'selection_color',
			'default' => '',
			'label'   => __( 'Selection color', 'wi' )
		);
        $colors[] = array(
			'slug'    => 'selection_text_color',
			'default' => '#fff',
			'label'   => __( 'Selection text color', 'wi' )
		);
        
        $colors[] = array(
			'slug'    => 'body_background_color',
			'default' => '#fff',
			'label'   => __( 'Body background color', 'wi' )
		);
        
		foreach ( $colors as $color ) {
			// SETTINGS
			$wp_customize->add_setting(
						 'wi_' . $color['slug'], array(
								 'default'    => $color['default'],
								 'type'       => 'theme_mod',
								 'capability' =>
									 'edit_theme_options'
							 )
			);
			// CONTROLS
			$wp_customize->add_control(
						 new WP_Customize_Color_Control(
							 $wp_customize,
							 $color['slug'],
							 array(
								 'label'    => $color['label'],
								 'section'  => 'wi_style',
								 'settings' => 'wi_' . $color['slug']
							 )
						 )
			);
		}
        
        // Body background image
        $wp_customize->add_setting(
                     'wi_body_background'
        );
        $wp_customize->add_control(
           new WP_Customize_Image_Control(
               $wp_customize,
               'body_background',
               array(
                   'label'      => __( 'Body background image', 'wi' ),
                   'section'    => 'wi_style',
                   'settings'   => 'wi_body_background',
               )
           )
        );
        
        // Body background position
		$wp_customize->add_setting(
					 'wi_body_background_position', array(
							 'default'           => '',
							 'sanitize_callback' => 'sanitize_text_field',
						 )
		);
		$wp_customize->add_control(
					 'body_background_position', array(
							 'label'    => __( 'Background position', 'wi' ),
							 'settings' => 'wi_body_background_position',
							 'section'  => 'wi_style',
							 'type'     => 'text',
                             'description'    => __( 'Default is "center top"', 'wi' ),
						 )
		);
        
        // Body background size
		$wp_customize->add_setting(
					 'wi_body_background_size', array(
							 'default'           => '',
							 'sanitize_callback' => 'sanitize_text_field',
						 )
		);
		$wp_customize->add_control(
					 'body_background_size', array(
							 'label'    => __( 'Background size', 'wi' ),
							 'settings' => 'wi_body_background_size',
							 'section'  => 'wi_style',
							 'type'     => 'text',
                             'description'    => __( 'Default is "cover"', 'wi' ),
						 )
		);
        
        // Body background repeat
		$wp_customize->add_setting(
					 'wi_body_background_repeat'
		);
		$wp_customize->add_control(
					 'body_background_repeat', array(
							 'label'    => __( 'Background repeat', 'wi' ),
							 'settings' => 'wi_body_background_repeat',
							 'section'  => 'wi_style',
							 'type'     => 'select',
                             'choices'  =>  array(
                                 'no-repeat' =>  'No repeat',
                                 'repeat' =>  'Repeat',
                                 'repeat-x' =>  'Repeat x',
                                 'repeat-y' =>  'Repeat y',
                             ),
                             'description'    => __( 'Default is "No Repeat"', 'wi' ),
						 )
		);
        
        // Body background attachment
		$wp_customize->add_setting(
					 'wi_body_background_attachment'
		);
		$wp_customize->add_control(
					 'body_background_attachment', array(
							 'label'    => __( 'Background attachment', 'wi' ),
							 'settings' => 'wi_body_background_attachment',
							 'section'  => 'wi_style',
							 'type'     => 'select',
                             'choices'  =>  array(
                                 'fixed' =>  'Fixed',
                                 'scroll' =>  'Scroll',
                             ),
                             'description'    => __( 'Default is "fixed"', 'wi' ),
						 )
		);
        
        // Content Background Opacity
		$wp_customize->add_setting(
					 'wi_content_background_opacity'
		);
		$wp_customize->add_control(
					 'wi_content_background_opacity', array(
							 'label'    => __( 'Content background opacity', 'wi' ),
							 'settings' => 'wi_content_background_opacity',
							 'section'  => 'wi_style',
							 'type'     => 'text',
                             'description'    => __( 'Enter a number from 0 - 100. Default is 100%. The lower this number, the more background image affects content.', 'wi' ),
						 )
		);
        
        /* -------------------------------------------------------------------- */
        /* BLOG
        /* -------------------------------------------------------------------- */
        // single featured image
		$wp_customize->add_setting(
					 'wi_disable_blog_image', array(
							 'default'           => false,
							 'sanitize_callback' => 'wi_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'disable_blog_image', array(
							 'label'    => 'Hide featured image on standard blog post',
							 'settings' => 'wi_disable_blog_image',
							 'section'  => 'wi_blog',
							 'type'     => 'checkbox',
						 )
		);
        
        // Blog date
		$wp_customize->add_setting(
					 'wi_disable_blog_date', array(
							 'default'           => false,
							 'sanitize_callback' => 'wi_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'disable_blog_date', array(
							 'label'    => __( 'Hide post date?', 'wi' ),
							 'settings' => 'wi_disable_blog_date',
							 'section'  => 'wi_blog',
							 'type'     => 'checkbox',
						 )
		);
        
        // Blog cats
		$wp_customize->add_setting(
					 'wi_disable_blog_categories', array(
							 'default'           => false,
							 'sanitize_callback' => 'wi_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'disable_blog_categories', array(
							 'label'    => __( 'Hide post categories?', 'wi' ),
							 'settings' => 'wi_disable_blog_categories',
							 'section'  => 'wi_blog',
							 'type'     => 'checkbox',
						 )
		);
        
        // Blog author
		$wp_customize->add_setting(
					 'wi_disable_blog_author', array(
							 'default'           => false,
							 'sanitize_callback' => 'wi_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'disable_blog_author', array(
							 'label'    => __( 'Hide post author?', 'wi' ),
							 'settings' => 'wi_disable_blog_author',
							 'section'  => 'wi_blog',
							 'type'     => 'checkbox',
						 )
		);
        
        // Blog comment link
		$wp_customize->add_setting(
					 'wi_disable_blog_comment', array(
							 'default'           => false,
							 'sanitize_callback' => 'wi_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'disable_blog_comment', array(
							 'label'    => __( 'Hide post comment link?', 'wi' ),
							 'settings' => 'wi_disable_blog_comment',
							 'section'  => 'wi_blog',
							 'type'     => 'checkbox',
						 )
		);
        
        
        // Blog share
		$wp_customize->add_setting(
					 'wi_disable_blog_share', array(
							 'default'           => false,
							 'sanitize_callback' => 'wi_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'disable_blog_share', array(
							 'label'    => __( 'Hide post share icons?', 'wi' ),
							 'settings' => 'wi_disable_blog_share',
							 'section'  => 'wi_blog',
							 'type'     => 'checkbox',
						 )
		);
        
        
        // Blog related
		$wp_customize->add_setting(
					 'wi_disable_blog_related', array(
							 'default'           => false,
							 'sanitize_callback' => 'wi_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'disable_blog_related', array(
							 'label'    => __( 'Hide related posts area?', 'wi' ),
							 'settings' => 'wi_disable_blog_related',
							 'section'  => 'wi_blog',
							 'type'     => 'checkbox',
						 )
		);
        
        // Display excerpt/content
		$wp_customize->add_setting(
					 'wi_blog_standard_display', array('default'=>'content')
		);
		$wp_customize->add_control(
					 'blog_standard_display', array(
							 'label'    => 'Display Content or Excerpt on Standard blog?',
							 'settings' => 'wi_blog_standard_display',
							 'section'  => 'wi_blog',
							 'type'     => 'select',
                             'choices'  => array('content' => 'Content', 'excerpt' => 'Excerpt'),
						 )
		);
        
        // Excerpt length
		$wp_customize->add_setting(
					 'wi_excerpt_length', array(
							 'sanitize_callback' => 'sanitize_text_field',
						 )
		);
		$wp_customize->add_control(
					 'excerpt_length', array(
							 'label'    => __( 'Excerpt length?', 'wi' ),
							 'settings' => 'wi_excerpt_length',
							 'section'  => 'wi_blog',
							 'type'     => 'text',
                             'description'=> __( 'Enter a number of words that you wanna display on post excerpt? Default is 55.', 'wi' ),
						 )
		);
        
        // Grid Excerpt length
		$wp_customize->add_setting(
					 'wi_grid_excerpt_length', array(
							 'sanitize_callback' => 'sanitize_text_field',
						 )
		);
		$wp_customize->add_control(
					 'grid_excerpt_length', array(
							 'label'    => 'Excerpt length for Grid layout - W-P-L-O-C-K-E-R-.-C-O-M',
							 'settings' => 'wi_grid_excerpt_length',
							 'section'  => 'wi_blog',
							 'type'     => 'text',
                             'description'=> 'This option applied to grid layout while the above one applied to other layouts',
						 )
		);
        
        // disable read more button
		$wp_customize->add_setting(
					 'wi_disable_blog_readmore', array(
							 'default'           => false,
							 'sanitize_callback' => 'wi_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'disable_blog_readmore', array(
							 'label'    => 'Disable "Read more" button in excerpt mode',
							 'settings' => 'wi_disable_blog_readmore',
							 'section'  => 'wi_blog',
							 'type'     => 'checkbox',
						 )
		);
        
        // 2 columns mode
		$wp_customize->add_setting(
					 'wi_disable_blog_2_columns', array(
							 'default'           => false,
							 'sanitize_callback' => 'wi_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'disable_blog_2_columns', array(
							 'label'    => __( 'Disable 2-columns mode', 'wi' ),
							 'settings' => 'wi_disable_blog_2_columns',
							 'section'  => 'wi_blog',
							 'type'     => 'checkbox',
						 )
		);
        
        // First letter dropcap
		$wp_customize->add_setting(
					 'wi_disable_blog_dropcap', array(
							 'default'           => false,
							 'sanitize_callback' => 'wi_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'disable_blog_dropcap', array(
							 'label'    => __( 'Disable "big first letter"', 'wi' ),
							 'settings' => 'wi_disable_blog_dropcap',
							 'section'  => 'wi_blog',
							 'type'     => 'checkbox',
						 )
		);
        
        /* -------------------------------------------------------------------- */
        /* SINGLE
        /* -------------------------------------------------------------------- */
        // single featured image
		$wp_customize->add_setting(
					 'wi_disable_single_image', array(
							 'default'           => false,
							 'sanitize_callback' => 'wi_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'disable_single_image', array(
							 'label'    => 'Hide featured image on single post',
							 'settings' => 'wi_disable_single_image',
							 'section'  => 'wi_single',
							 'type'     => 'checkbox',
						 )
		);
        
        // single share
		$wp_customize->add_setting(
					 'wi_disable_single_share', array(
							 'default'           => false,
							 'sanitize_callback' => 'wi_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'disable_single_share', array(
							 'label'    => __( 'Hide post share icons?', 'wi' ),
							 'settings' => 'wi_disable_single_share',
							 'section'  => 'wi_single',
							 'type'     => 'checkbox',
						 )
		);
        
        // single tags
		$wp_customize->add_setting(
					 'wi_disable_single_tag', array(
							 'default'           => false,
							 'sanitize_callback' => 'wi_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'disable_single_tag', array(
							 'label'    => __( 'Hide post tags?', 'wi' ),
							 'settings' => 'wi_disable_single_tag',
							 'section'  => 'wi_single',
							 'type'     => 'checkbox',
						 )
		);
        
        // single related
		$wp_customize->add_setting(
					 'wi_disable_single_related', array(
							 'default'           => false,
							 'sanitize_callback' => 'wi_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'disable_single_related', array(
							 'label'    => __( 'Hide "related posts" area?', 'wi' ),
							 'settings' => 'wi_disable_single_related',
							 'section'  => 'wi_single',
							 'type'     => 'checkbox',
						 )
		);
        
        
        // single author
		$wp_customize->add_setting(
					 'wi_disable_single_author', array(
							 'default'           => false,
							 'sanitize_callback' => 'wi_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'disable_single_author', array(
							 'label'    => __( 'Hide authorbox?', 'wi' ),
							 'settings' => 'wi_disable_single_author',
							 'section'  => 'wi_single',
							 'type'     => 'checkbox',
						 )
		);
        
        // single comment
		$wp_customize->add_setting(
					 'wi_disable_single_comment', array(
							 'default'           => false,
							 'sanitize_callback' => 'wi_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'disable_single_comment', array(
							 'label'    => __( 'Hide comment area for all posts?', 'wi' ),
							 'settings' => 'wi_disable_single_comment',
							 'section'  => 'wi_single',
							 'type'     => 'checkbox',
						 )
		);
        
        // single nav
		$wp_customize->add_setting(
					 'wi_disable_single_nav', array(
							 'default'           => false,
							 'sanitize_callback' => 'wi_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'disable_single_nav', array(
							 'label'    => __( 'Hide post navigation?', 'wi' ),
							 'settings' => 'wi_disable_single_nav',
							 'section'  => 'wi_single',
							 'type'     => 'checkbox',
						 )
		);
        
        // single same category
		$wp_customize->add_setting(
					 'wi_disable_single_same_category', array(
							 'default'           => false,
							 'sanitize_callback' => 'wi_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'disable_single_same_category', array(
							 'label'    => __( 'Hide "same category posts" area?', 'wi' ),
							 'settings' => 'wi_disable_single_same_category',
							 'section'  => 'wi_single',
							 'type'     => 'checkbox',
						 )
		);
        
        /* -------------------------------------------------------------------- */
        /* PAGE
        /* -------------------------------------------------------------------- */
        
        // page share
		$wp_customize->add_setting(
					 'wi_disable_page_share', array(
							 'default'           => false,
							 'sanitize_callback' => 'wi_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'disable_page_share', array(
							 'label'    => __( 'Hide share icons on page', 'wi' ),
							 'settings' => 'wi_disable_page_share',
							 'section'  => 'wi_page',
							 'type'     => 'checkbox',
						 )
		);
        
        // page comment
		$wp_customize->add_setting(
					 'wi_disable_page_comment', array(
							 'default'           => false,
							 'sanitize_callback' => 'wi_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'disable_page_comment', array(
							 'label'    => __( 'Hide comment area all pages', 'wi' ),
							 'settings' => 'wi_disable_page_comment',
							 'section'  => 'wi_page',
							 'type'     => 'checkbox',
						 )
		);
        
        
        // exclude pages from search
		$wp_customize->add_setting(
					 'wi_exclude_pages_from_search', array(
							 'default'           => false,
							 'sanitize_callback' => 'wi_sanitize_checkbox',
						 )
		);
		$wp_customize->add_control(
					 'exclude_pages_from_search', array(
							 'label'    => __( 'Exclude pages from search', 'wi' ),
							 'settings' => 'wi_exclude_pages_from_search',
							 'section'  => 'wi_page',
							 'type'     => 'checkbox',
						 )
		);
        
        /* -------------------------------------------------------------------- */
        /* SOCIAL ICONS
        /* -------------------------------------------------------------------- */
        $social_arr = wi_social_array();
        foreach ($social_arr as $s => $c):
            // Social icon
            $wp_customize->add_setting(
                         'wi_social_'.$s, array(
                                 'default'           => '',
                                 'sanitize_callback' => 'sanitize_text_field',
                             )
            );
            $wp_customize->add_control(
                         'social'.$s, array(
                                 'label'    => $c,
                                 'settings' => 'wi_social_'.$s,
                                 'section'  => 'wi_social',
                                 'type'     => 'text',
                             )
            );
        endforeach;
        
        
        /* -------------------------------------------------------------------- */
        /* CUSTOM CSS
        /* -------------------------------------------------------------------- */
        // CUSTOM CSS
        $wp_customize->add_setting(
                     'wi_custom_css'
        );
        $wp_customize->add_control(
                     'custom_css', array(
                             'label'    => __( 'Insert custom CSS', 'wi' ),
                             'settings' => 'wi_custom_css',
                             'section'  => 'wi_css',
                             'type'     => 'textarea',
                         )
        );
        
        /* -------------------------------------------------------------------- */
        /* QUICK TRANSLATION
        /* -------------------------------------------------------------------- */
        
        $options = array(
            'more_link'             =>  'Keep Reading',
            'previous'               =>  'Previous',
            'next'                  =>  'Next',
            'next_story'            =>  'Next Story',
            'previous_story'        =>  'Previous Story',
            'search'                =>  'Search...',
            'category'              =>  'in %s',
            'author'                =>  'by %s',
            'date'                  =>  'Published on %s',
            'latest_posts'          =>  'Latest posts',
            'viewall'                   =>  'View all',
            'related'               =>  'You might be interested in',
            'latest'                   =>  'Latest from %s',
            'go'                    =>  'Go to',
            'top'                   =>  'Top',
        );
        
        // Quick Translation
        foreach ($options as $k => $v) {
            $wp_customize->add_setting(
                         'wi_translate_'.$k, array('sanitize_callback' => 'sanitize_text_field')
            );
            $wp_customize->add_control(
                         'translate_'.$k, array(
                                 'label'    => sprintf('Translation for "%s"',$v),
                                 'settings' => 'wi_translate_'.$k,
                                 'section'  => 'wi_translation',
                                 'type'     => 'text',
                             )
            );
            
        }
        
        
        // Remove sections
        //$wp_customize->remove_section( 'title_tagline');
        $wp_customize->remove_section( 'nav');
        $wp_customize->remove_section( 'static_front_page');
        $wp_customize->remove_section( 'colors');
        $wp_customize->remove_section( 'background_image');
        
        $wp_customize->remove_panel( 'widgets' );

	}

}

endif; // class_exists

/**
 * Callback function for sanitizing checkbox settings.
 *
 * Used by Wi_Customize
 *
 * @param $input
 *
 * @return int|string
 */
function wi_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

/**
 * Callback function for sanitizing select menu for Excerpt Options.
 *
 * Used by Wi_Customize
 *
 * @param $input
 *
 * @return string
 */
function wi_sanitize_select_excerpt_options( $input ) {
	$valid = array( '0' => 'Disabled',
					'1' => 'Enabled', );

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register', array( 'Wi_Customize', 'register' ) );