<?php
/*
Plugin Name: UESP Destiny2 Utils
Plugin URI: https://uesp.net
Description: Loads and displays Destiny2 tooltips from UESP.net (among other things). 
Version: 0.1
Author: Daveh
Author URI: https://uesp.net/wiki/User:Daveh
License: Apache 2
Plugin Type: Piklist
*/


require(__DIR__ . '/data/data.php');


class CUespDestiny2WordPressPlugin extends CUespDestiny2WordPressData
{
	
	
	public static function EnqueueResources()
	{
		wp_enqueue_style( 'uespd2tooltipcss', plugin_dir_url(__FILE__) . 'css/tooltip.css' );
		wp_enqueue_style( 'uespd2buildcss', plugin_dir_url(__FILE__) . 'css/build.css' );
		
		wp_enqueue_script( 'uespd2tooltipjs', plugin_dir_url(__FILE__) . 'js/tooltip.js', array( 'jquery' ) );
		wp_enqueue_script( 'uespd2buildjs', plugin_dir_url(__FILE__) . 'js/builds.js', array( 'jquery' ) );
		
		wp_add_inline_script( 'uespd2buildjs', self::GetBuildDataJs(), 'before'); 
	}
	
	
	public static function GetBuildDataJs()
	{
		$output = 'const UESPD2_KINETICWEAPON_DATA = ';
		$output .= json_encode(self::DATA_KINETICWEAPONS) . ";\n";
		
		$output .= 'const UESPD2_ENERGYWEAPON_DATA = ';
		$output .= json_encode(self::DATA_ENERGYWEAPONS) . ";\n";
		
		$output .= 'const UESPD2_POWERWEAPON_DATA = ';
		$output .= json_encode(self::DATA_POWERWEAPONS) . ";\n";
		
		$output .= 'const UESPD2_EXOTICARMOR_DATA = ';
		$output .= json_encode(self::DATA_EXOTICARMOR) . ";\n";

		$output .= 'const UESPD2_LEGARMORMOD_DATA = ';
		$output .= json_encode(self::DATA_LEGARMORMODS) . ";\n";
		
		$output .= 'const UESPD2_HEADARMORMOD_DATA = ';
		$output .= json_encode(self::DATA_HEADARMORMODS) . ";\n";
		
		$output .= 'const UESPD2_ARMARMORMOD_DATA = ';
		$output .= json_encode(self::DATA_ARMARMORMODS) . ";\n";
		
		$output .= 'const UESPD2_CHESTARMORMOD_DATA = ';
		$output .= json_encode(self::DATA_CHESTARMORMODS) . ";\n";
		
		$output .= 'const UESPD2_CLASSARMORMOD_DATA = ';
		$output .= json_encode(self::DATA_CLASSARMORMODS) . ";\n";
		
		return $output;
	}
	
	
	public static function SortChoices($a, $b)
	{
		return strcasecmp($a, $b);
	}
	
	
	public static function EscapeHtml($text)
	{
		return htmlspecialchars($text);
	}
	
	
	public static function MakeIconImageTag($icon, $name)
	{
		if ($icon == null || $icon == "") return "";
		
		$name = self::EscapeHtml($text);
		
		return "<img src=\"https://www.bungie.net$icon\" title=\"$name\">";
	}
	
	
	public static function MakeLightGGLinkTag($id, $title)
	{
		$id = intval($id);
		if ($id <= 0) return $title;
		
		$title = self::EscapeHtml($title);
		
		return "<a href=\"https://light.gg/db/items/$id/\">$title</a>";
	}
	
	
	public static function GetData($type, $key, $default = '')
	{
		$name = "CUespDestiny2WordPressPlugin::DATA_" . strtoupper($type);
		if (!defined($name)) return $default;
		
		$data = constant($name);
		$value = $data[$key];
		
		if ($value == null) return $default;
		return $value;
	}
	
	
	public static function CreateChoices($type, $blankName)
	{
		$name = "CUespDestiny2WordPressPlugin::DATA_" . strtoupper($type);
		if (!defined($name)) return [];
		
		$data = constant($name);
		$choices = [];
		
		foreach ($data as $id => $row)
		{
			$choices[$id] = $row['name'];
		}
		
		uasort($choices, ['CUespDestiny2WordPressPlugin', 'SortChoices']);
		$choices = ['' => "$blankName" ] + $choices;
		return $choices;
	}
	
	
	public static function PikListPostTypes($post_types)
	{
		//error_log("CUespDestiny2WordPressPlugin::PikListPostTypes");
		
		$post_types['dg_destiny_builds'] = array(
				'labels' => piklist('post_type_labels', 'Destiny Builds'),
				'title' => 'Enter a new Destiny Build Title',
				'supports' => array(
						'title',
						'content',
						'editor',
						'excerpt',
						'thumbnail',
				),
				'public' => true,
				'has_archive' => true,
				'rewrite' => array(
						'slug' => 'destinybuilds',
				),
				'capability_type' => 'post',
				'hide_meta_box' => array(
						'author',
				),
		);
		
		return $post_types;
	}
	
	
	public static function RegisterTaxonomies()
	{
		register_taxonomy( 'destiny_build_type', array( 'dg_destiny_builds' ), array(
				'hierarchical'      => true,
				'public'            => true,
				'show_in_nav_menus' => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => true,
				'capabilities'      => array(
						'manage_terms'  => 'edit_posts',
						'edit_terms'    => 'edit_posts',
						'delete_terms'  => 'edit_posts',
						'assign_terms'  => 'edit_posts'
				),
				'labels' => array(
						'name'                       =>  'Destiny Build Type',
						'singular_name'              =>  'Destiny Build Type',
						'search_items'               =>  'Search Destiny Build Type',
						'popular_items'              =>  'Popular Destiny Build Type',
						'all_items'                  =>  'All Destiny Build Types',
						'parent_item'                =>  'Parent Destiny Build Type',
						'parent_item_colon'          =>  'Parent Destiny Build Type:',
						'edit_item'                  =>  'Edit Destiny Build Type',
						'update_item'                =>  'Update Destiny Build Type',
						'add_new_item'               =>  'New Destiny Build Type',
						'new_item_name'              =>  'New Destiny Build Type',
						'separate_items_with_commas' =>  'Destiny Build Types separated by comma',
						'add_or_remove_items'        =>  'Add or remove Destiny build type',
						'choose_from_most_used'      =>  'Choose from the most used Destiny build types',
						'menu_name'                  =>  'Destiny Build Types',
				),
		) );
		
	}
	
};


add_action( 'wp_enqueue_scripts', 'CUespDestiny2WordPressPlugin::EnqueueResources' );
add_action( 'admin_enqueue_scripts', 'CUespDestiny2WordPressPlugin::EnqueueResources' );
add_filter( 'piklist_post_types', 'CUespDestiny2WordPressPlugin::PikListPostTypes' );
add_action( 'init', 'CUespDestiny2WordPressPlugin::RegisterTaxonomies' );

