<?php
/*
 *
 */


function uespDestiny2OutputBuild_Genesis()
{
	global $post;
	
	remove_action('genesis_entry_content', 'genesis_do_post_content');
	add_action( 'genesis_entry_content', 'uespDestiny2OutputBuild_Content' );
	
	genesis();
}


function uespDestiny2OutputBuild_NewsVibrantPro()
{
	global $post;
	
	get_header();
	wp_reset_postdata();
	$post_id = get_the_ID();
	
	if ( has_post_thumbnail() ) the_post_thumbnail( 'full' );
	
	uespDestiny2OutputBuild_Content();
}


function uespDestiny2OutputBuild_Content()
{
	global $post;
	
	$buildData = get_post_custom();
	
	?>	
<h2>Table of Contents</h2>
<ul>
	<li>Testing123
</ul>
<?php

	the_content();
	
	uespDestiny2Build_OutputAbilities($buildData);
	
	get_footer();
}


function uespDestiny2Build_CreateAbilityTable($abilityData, $constantName, $extraTableDef = "")
{
	if ($abilityData == null) return "";
	
	$output = "<td $extraTableDef>";
	
	foreach ($abilityData as $abilityId)
	{
		$abilityId = intval($abilityId);
		if ($abilityId <= 0) continue;
		
		$abilityValues = CUespDestiny2WordPressPlugin::GetData($constantName, $abilityId, false);
		if ($abilityValues === false) continue;
		
		$desc = CUespDestiny2WordPressPlugin::EscapeHtml($abilityValues['desc']);
		$name = CUespDestiny2WordPressPlugin::EscapeHtml($abilityValues['name']);
		
		$iconTag = CUespDestiny2WordPressPlugin::MakeIconImageTag($abilityValues['icon'], $abilityValues['name']);
		
		$output .= "$iconTag";
		$output .= "<br/>$name";
	}
	
	$output .= "</td>";
	return $output;
}


function uespDestiny2Build_CreateAbilityText($abilityData, $constantName, $abilityTypeName)
{
	if ($abilityData == null) return "";
	
	$output = "";
	$abilityTypeName = CUespDestiny2WordPressPlugin::EscapeHtml($abilityTypeName);
	
	foreach ($abilityData as $abilityId)
	{
		$abilityId = intval($abilityId);
		if ($abilityId <= 0) continue;
		
		$abilityValues = CUespDestiny2WordPressPlugin::GetData($constantName, $abilityId, false);
		if ($abilityValues === false) continue;
		
		$desc = CUespDestiny2WordPressPlugin::EscapeHtml($abilityValues['desc']);
		$name = CUespDestiny2WordPressPlugin::EscapeHtml($abilityValues['name']);
		
	
		$output .= "<div class=\"uespd2AbilityText\"><strong>$name</strong> ($abilityTypeName): $desc</div>";
	}
	
	return $output;
}


function uespDestiny2Build_OutputAbilities($buildData)
{
	$output = "<h2 id=\"uespd2Abilities\" class=\"build-header\">Abilities</h2>";

	//Array ( [super_ability_id] => Array ( [0] => ) [class_ability_id] => Array ( [0] => 3636300852 ) [movement_ability_id] => Array ( [0] => 3686638441 ) [arc_grenade_id] => Array ( [0] => 2909720723 ) [arc_melee_id] => Array ( [0] => 2708585279 ) )
	$abilityData = unserialize($buildData["abilities_group"][0]);
	$output .= print_r($abilityData, true);
	
	$output .= "<table class=\"uespd2AbilityTable\">";
	
	$ouptut .= "<tr>";
	$output .= uespDestiny2Build_CreateAbilityTable($abilityData['super_ability_id'], 'SuperAbilities', "colspan=\"100\"");
	$output .= "</tr><tr>";
	
	$output .= uespDestiny2Build_CreateAbilityTable($abilityData['class_ability_id'], 'ClassAbilities');
	$output .= uespDestiny2Build_CreateAbilityTable($abilityData['movement_ability_id'], 'MovementAbilities');
	$output .= uespDestiny2Build_CreateAbilityTable($abilityData['arc_grenade_id'], 'ArcGrenade');
	$output .= uespDestiny2Build_CreateAbilityTable($abilityData['arc_melee_id'], 'ArcMelee');
	
	$output .= "</tr></table>";
	
	$output .= uespDestiny2Build_CreateAbilityText($abilityData['super_ability_id'], 'SuperAbilities', 'Super Ability');
	$output .= uespDestiny2Build_CreateAbilityText($abilityData['class_ability_id'], 'ClassAbilities', 'Class Ability');
	$output .= uespDestiny2Build_CreateAbilityText($abilityData['movement_ability_id'], 'MovementAbilities', 'Movement Ability');
	$output .= uespDestiny2Build_CreateAbilityText($abilityData['arc_grenade_id'], 'ArcGrenade', 'Arc Grenade');
	$output .= uespDestiny2Build_CreateAbilityText($abilityData['arc_melee_id'], 'ArcMelee', 'Arc Melee');
	
	print($output);
}


add_filter( 'body_class', 'uesp_destinybuilds_single_posts_body_class' );

function uesp_destinybuilds_single_posts_body_class( $classes )
{
	$classes[] = 'destiny-build-single';
	return $classes;
}


function uespDestiny2OutputBuild( $theme )
{
	if ($theme === "Genesis") return uespDestiny2OutputBuild_Genesis();
	if ($theme === "News Vibrant Pro") return uespDestiny2OutputBuild_NewsVibrantPro();
	return uespDestiny2OutputBuild_Content();
}

$theme = wp_get_theme();
if ($theme && $theme->exists()) uespDestiny2OutputBuild($theme->name);



