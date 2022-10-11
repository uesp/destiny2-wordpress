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
	uespDestiny2Build_OutputAspects($buildData);
	uespDestiny2Build_OutputFragments($buildData);
	uespDestiny2Build_OutputGear($buildData);
	
	//$tempData = unserialize($buildData["weapons_group"][0]);
	//print_r($tempData);
	
	get_footer();
}


function uespDestiny2Build_CreateDataTable($datas, $constantName, $extraTableDef = "", $colEachItem = false, $idField = null)
{
	if ($datas == null) return "";
	
	$output = '';
	if (!$colEachItem) $output .= "<td $extraTableDef>";
	
	foreach ($datas as $data)
	{
		if ($idField == null)
			$id = $data;
		else
			$id = $data[$idField];
		
		$id = intval($id);
		if ($id <= 0) continue;
		
		$values = CUespDestiny2WordPressPlugin::GetData($constantName, $id, false);
		if ($values === false) continue;
		
		if ($colEachItem) $output .= "<td $extraTableDef>";
		
		$desc = CUespDestiny2WordPressPlugin::EscapeHtml($values['desc']);
		$name = CUespDestiny2WordPressPlugin::EscapeHtml($values['name']);
		
		$iconTag = CUespDestiny2WordPressPlugin::MakeIconImageTag($values['icon'], $values['name']);
		
		$output .= "$iconTag";
		$output .= "<br/>$name";
		
		if ($colEachItem) $output .= "</td>";
	}
	
	if (!$colEachItem) $output .= "</td>";
	return $output;
}


function uespDestiny2Build_CreateDataText($datas, $constantName, $typeName = null, $idField = null, $descField = null)
{
	if ($datas == null) return "";
	
	$output = "";
	if ($typeName) $typeName = CUespDestiny2WordPressPlugin::EscapeHtml($typeName);
	
	foreach ($datas as $data)
	{
		if ($idField == null)
			$id = $data;
		else
			$id = $data[$idField];
		
		$id = intval($id);
		if ($id <= 0) continue;
		
		$values = CUespDestiny2WordPressPlugin::GetData($constantName, $id, false);
		if ($values === false) continue;
		
		$desc = CUespDestiny2WordPressPlugin::EscapeHtml($values['desc']);
		$name = CUespDestiny2WordPressPlugin::EscapeHtml($values['name']);
		
		$extraDesc = '';
		
		if ($descField) 
		{
			$extraDesc = $data[$descField];
			if ($extraDesc == null) $extraDesc = '';
			
			$desc .= ' ' . CUespDestiny2WordPressPlugin::EscapeHtml($extraDesc);
		}
		
		$link = CUespDestiny2WordPressPlugin::MakeLightGGLinkTag($id, $values['name']);
		
		if ($typeName)
			$output .= "<div class=\"uespd2DataText\"><strong>$link</strong> ($typeName): $desc</div>";
		else
			$output .= "<div class=\"uespd2DataText\"><strong>$link</strong>: $desc</div>";
	}
	
	return $output;
}


function uespDestiny2Build_OutputAbilities($buildData)
{
	$output = "<h2 id=\"uespd2Abilities\" class=\"build-header\">Abilities</h2>";
	
	//Array ( [super_ability_id] => Array ( [0] => ) [class_ability_id] => Array ( [0] => 3636300852 ) [movement_ability_id] => Array ( [0] => 3686638441 ) [arc_grenade_id] => Array ( [0] => 2909720723 ) [arc_melee_id] => Array ( [0] => 2708585279 ) )
	$abilityData = unserialize($buildData["abilities_group"][0]);
	//$output .= print_r($abilityData, true);
	
	$output .= "<table class=\"uespd2DataTable\">";
	
	$ouptut .= "<tr>";
	$output .= uespDestiny2Build_CreateDataTable($abilityData['super_ability_id'], 'SuperAbilities', "colspan=\"100\"");
	$output .= "</tr><tr>";
	
	$output .= uespDestiny2Build_CreateDataTable($abilityData['class_ability_id'], 'ClassAbilities');
	$output .= uespDestiny2Build_CreateDataTable($abilityData['movement_ability_id'], 'MovementAbilities');
	$output .= uespDestiny2Build_CreateDataTable($abilityData['arc_grenade_id'], 'ArcGrenade');
	$output .= uespDestiny2Build_CreateDataTable($abilityData['arc_melee_id'], 'ArcMelee');
	
	$output .= "</tr></table>";
	
	$output .= uespDestiny2Build_CreateDataText($abilityData['super_ability_id'], 'SuperAbilities', 'Super Ability');
	$output .= uespDestiny2Build_CreateDataText($abilityData['class_ability_id'], 'ClassAbilities', 'Class Ability');
	$output .= uespDestiny2Build_CreateDataText($abilityData['movement_ability_id'], 'MovementAbilities', 'Movement Ability');
	$output .= uespDestiny2Build_CreateDataText($abilityData['arc_grenade_id'], 'ArcGrenade', 'Arc Grenade');
	$output .= uespDestiny2Build_CreateDataText($abilityData['arc_melee_id'], 'ArcMelee', 'Arc Melee');
	
	print($output);
}


function uespDestiny2Build_OutputAspects($buildData)
{
	$output = "<h2 id=\"uespd2Aspects\" class=\"build-header\">Aspects</h2>";
	
	$aspectData = unserialize($buildData["aspects_group"][0]);
	
	$output .= "<table class=\"uespd2DataTable\">";
	
	$ouptut .= "<tr>";
	$output .= uespDestiny2Build_CreateDataTable($aspectData, 'Aspect', '', true, 'aspect_id');
	$output .= "</tr></table>";
	
	$output .= uespDestiny2Build_CreateDataText($aspectData, 'Aspect', '', 'aspect_id', 'aspect_desc');
	
	print($output);
}


function uespDestiny2Build_OutputFragments($buildData)
{
	$output = "<h2 id=\"uespd2Fragments\" class=\"build-header\">Fragments</h2>";
	
	$fragmentData = unserialize($buildData["fragments_group"][0]);
	
	$output .= "<table class=\"uespd2DataTable\">";
	
	$ouptut .= "<tr>";
	$output .= uespDestiny2Build_CreateDataTable($fragmentData, 'Fragment', '', true, 'fragment_id');
	$output .= "</tr></table>";
	
	$output .= uespDestiny2Build_CreateDataText($fragmentData, 'Fragment', '', 'fragment_id', 'fragment_desc');
	
	print($output);
}


function uespDestiny2Build_OutputGear($buildData)
{
	$output = "<h2 id=\"uespd2Gear\" class=\"build-header\">Gear</h2>";
	
	$output .= uespDestiny2Build_CreateWeaponHtml($buildData, 'Kinetic Weapons', 'kinetic');
	$output .= uespDestiny2Build_CreateWeaponHtml($buildData, 'Energy Weapons', 'energy');
	$output .= uespDestiny2Build_CreateWeaponHtml($buildData, 'Heavy Weapons', 'power');
	
	print($output);
}


function uespDestiny2Build_CreateWeaponHtml($buildData, $weaponType, $dataType)
{
	$output = "<h3 class=\"build-header\">$weaponType</h3>";
	
	$weaponData = unserialize($buildData[$dataType . "_weapons_group"][0]);
	if ($weaponData == null) return $output;
	
	$output .= uespDestiny2Build_CreateWeaponTableHtml($weaponData, $weaponType, $dataType);
	$output .= uespDestiny2Build_CreateWeaponTextHtml($weaponData, $weaponType, $dataType);
	
	return $output;
}


function uespDestiny2Build_CreateWeaponTableHtml($weaponDatas, $weaponType, $dataType)
{
	$output = '<table class="uespd2DataTable">';
	
	$output .= '<tr>';
	$output .= "<th>Recommended $weaponType</th>";
	$output .= "<th>Suggested Perk 1</th>";
	$output .= "<th>Suggested Perk 2</th>";
	$output .= "</tr>\n";
	
	$constantName = strtoupper($dataType) . "WEAPONS";
	
	foreach ($weaponDatas as $weaponData)
	{
		$weaponId = intval($weaponData[$dataType . '_weapon_id']);
		$perk1Id = intval($weaponData[$dataType . '_weapon_perk1_id']);
		$perk2Id = intval($weaponData[$dataType . '_weapon_perk2_id']);
		$extraDesc = $weaponData[$dataType . '_weapon_desc'];
		if ($weaponId <= 0) continue;
		
		$values = CUespDestiny2WordPressPlugin::GetData($constantName, $weaponId, false);
		if ($values === false) continue;
		
		$desc = CUespDestiny2WordPressPlugin::EscapeHtml($values['desc']);
		$name = CUespDestiny2WordPressPlugin::EscapeHtml($values['name']);
		$iconTag = CUespDestiny2WordPressPlugin::MakeIconImageTag($values['icon'], $values['name']);
		
		$output .= '<tr><td>';
		$output .= "$iconTag";
		$output .= "<br/>$name</td>";
		
		$perk1Values = $values['sockets'][$perk1Id];
		$perk2Values = $values['sockets'][$perk2Id];
		
		if ($perk1Values)
		{
			$name = CUespDestiny2WordPressPlugin::EscapeHtml($perk1Values['name']);
			$iconTag = CUespDestiny2WordPressPlugin::MakeIconImageTag($perk1Values['icon'], $perk1Values['name']);
			
			$output .= "<td>$iconTag<br/>$name</td>";
		}
		else
		{
			$output .= "<td></td>";
		}
		
		if ($perk2Values)
		{
			$name = CUespDestiny2WordPressPlugin::EscapeHtml($perk2Values['name']);
			$iconTag = CUespDestiny2WordPressPlugin::MakeIconImageTag($perk2Values['icon'], $perk2Values['name']);
			
			$output .= "<td>$iconTag<br/>$name</td>";
		}
		else
		{
			$output .= "<td></td>";
		}
		
		$output .= "</tr>\n";
	}
	
	$output .= '</table>';
	return $output;
}


function uespDestiny2Build_CreateWeaponTextHtml($weaponDatas, $weaponType, $dataType)
{
	$output = '';
	$constantName = strtoupper($dataType) . "WEAPONS";
	
	foreach ($weaponDatas as $weaponData)
	{
		$weaponId = intval($weaponData[$dataType . '_weapon_id']);
		$perk1Id = intval($weaponData[$dataType . '_weapon_perk1_id']);
		$perk2Id = intval($weaponData[$dataType . '_weapon_perk2_id']);
		$extraDesc = $weaponData[$dataType . '_weapon_desc'];
		if ($weaponId <= 0) continue;
		
		$values = CUespDestiny2WordPressPlugin::GetData($constantName, $weaponId, false);
		error_log("uespDestiny2Build_CreateWeaponTableHtml: $values");
		if ($values === false) continue;
		
		$output = '<div class="uespd2DataText">';
		
		$desc = CUespDestiny2WordPressPlugin::EscapeHtml($values['desc']);
		$name = CUespDestiny2WordPressPlugin::EscapeHtml($values['name']);
		if ($extraDesc != "") $desc .= ' ' . CUespDestiny2WordPressPlugin::EscapeHtml($extraDesc);
		
		$link = CUespDestiny2WordPressPlugin::MakeLightGGLinkTag($weaponId, $values['name']);
		$output .= "<strong>$link</strong>: $desc";
		
		$output .= "</div>\n";
	}
	
	return $output;
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



