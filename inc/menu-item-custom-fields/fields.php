<?php
/**
 * Menu item custom fields example
 *
 * Copy this file into your wp-content/mu-plugins directory.
 *
 * @package Menu_Item_Custom_Fields_Example
 * @version 0.2.0
 * @author Dzikri Aziz <kvcrvt@gmail.com>
 *
 *
 * Plugin name: Menu Item Custom Fields Example
 * Plugin URI: https://github.com/kucrut/wp-menu-item-custom-fields
 * Description: Example usage of Menu Item Custom Fields in plugins/themes
 * Version: 0.2.0
 * Author: Dzikri Aziz
 * Author URI: http://kucrut.org/
 * License: GPL v2
 * Text Domain: menu-item-custom-fields-example
 */


/**
 * Sample menu item metadata
 *
 * This class demonstrate the usage of Menu Item Custom Fields in plugins/themes.
 *
 * @since 0.1.0
 */
class Menu_Item_Custom_Fields_Example {

	/**
	 * Holds our custom fields
	 *
	 * @var    array
	 * @access protected
	 * @since  Menu_Item_Custom_Fields_Example 0.2.0
	 */
	protected static $fields = array();


	/**
	 * Initialize plugin
	 */
	public static function init() {
		add_action( 'wp_nav_menu_item_custom_fields', array( __CLASS__, '_fields' ), 10, 4 );
		add_action( 'wp_update_nav_menu_item', array( __CLASS__, '_save' ), 10, 3 );
		add_filter( 'manage_nav-menus_columns', array( __CLASS__, '_columns' ), 99 );
		
		
		/* -------------------------------------------------------------------------------------------------------------------------- */
		/* EDIT FIELDS HERE 
		/* -------------------------------------------------------------------------------------------------------------------------- */
		self::$fields = array ();
		self::$fields[] = array(
			'id'		=>	'menu-icon',
			'name'		=>	'Menu icon',
			'desc'		=>	'Enter icon name from <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank" title="This link opens in a new tab">this set</a>.',
			'type'		=>	'text',
			'std'		=>	'',
		);
	}


	/**
	 * Save custom field value
	 *
	 * @wp_hook action wp_update_nav_menu_item
	 *
	 * @param int   $menu_id         Nav menu ID
	 * @param int   $menu_item_db_id Menu item ID
	 * @param array $menu_item_args  Menu item data
	 */
	public static function _save( $menu_id, $menu_item_db_id, $menu_item_args ) {
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return;
		}

		$action = isset( $_REQUEST['action'] ) ? $_REQUEST['action'] : 'edit';
		if ($action == 'add-menu-item') check_admin_referer( 'add-menu_item', 'menu-settings-column-nonce' );
		if ($action == 'update') check_admin_referer( 'update-nav_menu', 'update-nav-menu-nonce' );

		foreach ( self::$fields as $k => $v) :
			$_key = isset($v['id']) ? $v['id'] : ''; if (!$_key) continue;
			$key = sprintf( 'menu-item-%s', $_key );

			// Sanitize
			if ( ! empty( $_POST[ $key ][ $menu_item_db_id ] ) ) {
				// Do some checks here...
				$value = $_POST[ $key ][ $menu_item_db_id ];
			}
			else {
				$value = null;
			}

			// Update
			if ( ! is_null( $value ) ) {
				update_post_meta( $menu_item_db_id, $key, $value );
			}
			else {
				delete_post_meta( $menu_item_db_id, $key );
			}
		endforeach;
	}


	/**
	 * Print field
	 *
	 * @param object $item  Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args  Menu item args.
	 * @param int    $id    Nav menu ID.
	 *
	 * @return string Form fields
	 */
	public static function _fields( $id, $item, $depth, $args ) {
		foreach ( self::$fields as $k => $v) :
			$_key = isset($v['id']) ? $v['id'] : ''; if (!$_key) continue;
			$type = isset($v['type']) ? $v['type'] : '';
			$label = isset($v['name']) ? $v['name'] : '';
			$desc = isset($v['desc']) ? $v['desc'] : '';
			$std = isset($v['std']) ? $v['std'] : '';
			$type = isset($v['type']) ? $v['type'] : 'text';
			$options = isset($v['options']) ? $v['options'] : array();
			$key   = sprintf( 'menu-item-%s', $_key );
			$id    = sprintf( 'edit-%s-%s', $key, $item->ID );
			$name  = sprintf( '%s[%s]', $key, $item->ID );
			$value = get_post_meta( $item->ID, $key, true );
			$class = sprintf( 'field-%s', $_key );
			
			switch($type):
				case 'select':
				?>
					<p class="description description-wide <?php echo esc_attr( $class ) ?>">
						<label for="<?php echo esc_attr($id);?>">
							<?php echo esc_html( $label );?><br>
							<select id="<?php echo esc_attr($id);?>" class="widefat" name="<?php echo esc_attr( $name );?>">
								<?php foreach ( $options as $opt_k => $opt_v ):?>
								<option value="<?php echo esc_attr($opt_k);?>" <?php selected($value,esc_attr($opt_k)) ?>><?php echo esc_html($opt_v);?></option>
								<?php endforeach; ?>
							</select>
							<?php if($desc):?>
							<span class="description"><?php echo wp_kses($desc,'');?></span>
							<?php endif;?>
						</label>
					</p>
				<?php
				break;
				case 'textarea':
				?>
					<p class="description description-wide <?php echo esc_attr( $class ) ?>">
						<label for="<?php echo esc_attr($id);?>">
							<?php echo esc_html( $label );?><br>
							<textarea id="<?php echo esc_attr($id);?>" class="widefat" name="<?php echo esc_attr( $name );?>"><?php echo esc_textarea($value);?></textarea>
							<?php if($desc):?>
							<span class="description"><?php echo $desc;?></span>
							<?php endif;?>
						</label>
					</p>
				<?php
				break;
                case 'text':
				?>
					<p class="description description-wide <?php echo esc_attr( $class ) ?>">
						<label for="<?php echo esc_attr($id);?>">
							<?php echo esc_html( $label );?><br>
							<input type="text" id="<?php echo esc_attr($id);?>" class="widefat" name="<?php echo esc_attr( $name );?>" value="<?php echo esc_attr($value);?>" />
							<?php if($desc):?>
							<span class="description"><?php echo $desc;?></span>
							<?php endif;?>
						</label>
					</p>
				<?php
				break;
				case 'checkbox':
				?>
					<input type="checkbox" id="<?php echo esc_attr($id);?>" name="<?php echo esc_attr( $name );?>" <?php echo checked($value,$std);?> />
				<?php
				break;
				default:
				?>	
					<p class="description description-wide <?php echo esc_attr( $class ) ?>">
						<label for="<?php echo esc_attr($id);?>">
							<?php echo esc_html( $label );?><br>
							<input id="<?php echo esc_attr($id);?>" class="widefat" name="<?php echo esc_attr( $name );?>" value="<?php echo esc_attr($value);?>" />
							<?php if($desc):?>
							<span class="description"><?php echo $desc;?></span>
							<?php endif;?>
						</label>
					</p>
				<?php
				break;
			endswitch;
		endforeach;
	}


	/**
	 * Add our fields to the screen options toggle
	 *
	 * @param array $columns Menu item columns
	 * @return array
	 */
	public static function _columns( $columns ) {
		$columns = array_merge( $columns, self::$fields );

		return $columns;
	}
}
Menu_Item_Custom_Fields_Example::init();
