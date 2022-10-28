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
	
	get_footer();
}


function uespDestiny2OutputBuild_Content()
{
	global $post;
	
	$buildData = get_post_custom();
	
?>
<h2>Table of Contents</h2>
<ul class="ez-toc-list ez-toc-list-level-1">
	<li class="ez-toc-page-1 ez-toc-heading-level-3"><a class="ez-toc-link ez-toc-heading-1 __mPS2id _mPS2id-h mPS2id-highlight" href="#Should_you_play_this_build" title="Should you play this build?">Should you play this build?</a></li>
	<li class="ez-toc-page-1 ez-toc-heading-level-3"><a class="ez-toc-link ez-toc-heading-4 __mPS2id _mPS2id-h" href="#Subclass" title="Subclass">Subclass</a>
		<ul class="ez-toc-list-level-4">
			<li class="ez-toc-page-1 ez-toc-heading-level-4"><a class="ez-toc-link ez-toc-heading-6 __mPS2id _mPS2id-h" href="#Abilities" title="Abilities">Abilities</a></li>
			<li class="ez-toc-page-1 ez-toc-heading-level-4"><a class="ez-toc-link ez-toc-heading-7 __mPS2id _mPS2id-h" href="#Aspects" title="Aspects">Aspects</a></li>
			<li class="ez-toc-page-1 ez-toc-heading-level-4"><a class="ez-toc-link ez-toc-heading-8 __mPS2id _mPS2id-h" href="#Fragments" title="Fragments:">Fragments:</a></li>
		</ul>
	</li>
	<li class="ez-toc-page-1 ez-toc-heading-level-3"><a class="ez-toc-link ez-toc-heading-9 __mPS2id _mPS2id-h" href="#Gear" title="Gear">Gear</a>
		<ul class="ez-toc-list-level-4">
			<li class="ez-toc-heading-level-4"><a class="ez-toc-link ez-toc-heading-10 __mPS2id _mPS2id-h" href="#Kinetic_Weapons" title="Kinetic Weapons">Kinetic Weapons</a></li>
			<li class="ez-toc-page-1 ez-toc-heading-level-4"><a class="ez-toc-link ez-toc-heading-11 __mPS2id _mPS2id-h" href="#Energy_Weapons" title="Energy Weapons">Energy Weapons</a></li>
			<li class="ez-toc-page-1 ez-toc-heading-level-4"><a class="ez-toc-link ez-toc-heading-12 __mPS2id _mPS2id-h" href="#Heavy_Weapons" title="Heavy Weapons">Heavy Weapons</a></li>
			<li class="ez-toc-page-1 ez-toc-heading-level-4"><a class="ez-toc-link ez-toc-heading-13 __mPS2id _mPS2id-h" href="#Exotic_Armor" title="Exotic Armor">Exotic Armor</a></li>
			<li class="ez-toc-page-1 ez-toc-heading-level-4"><a class="ez-toc-link ez-toc-heading-14 __mPS2id _mPS2id-h" href="#Armor_Stats" title="Armor Stats">Armor Stats</a></li>
			<li class="ez-toc-page-1 ez-toc-heading-level-4"><a class="ez-toc-link ez-toc-heading-15 __mPS2id _mPS2id-h" href="#Important_Mods" title="Important Mods">Important Mods</a></li>
		</ul>
	</li>
	<li class="ez-toc-page-1 ez-toc-heading-level-3"><a class="ez-toc-link ez-toc-heading-16 __mPS2id _mPS2id-h" href="#Playstyle" title="Playstyle">Playstyle</a></li>
</ul>

<?php

	the_content();
	
	uespDestiny2Build_OutputAbilities($buildData);
	uespDestiny2Build_OutputAspects($buildData);
	uespDestiny2Build_OutputFragments($buildData);
	uespDestiny2Build_OutputGear($buildData);
	
}



function uespDestiny2Build_CreateDataTableGroupId($buildData, $groupId, $constantName, $extraTableDef = "", $colEachItem = false, $idField = null)
{
	//return "$groupId::". print_r($buildData[$groupId], true) . "\n";
	
	$abilityData = unserialize($buildData[$groupId][0]);
	if ($abilityData == null) return '';
	
	//return "$groupId::". print_r($abilityData, true) . "<br/>\n";
	
	return uespDestiny2Build_CreateDataTable($abilityData, $constantName, $extraTableDef, $colEachItem, $idField);
}


function uespDestiny2Build_CreateDataTable($datas, $constantName, $extraTableDef = "", $colEachItem = false, $idField = null)
{
	if ($datas == null) return "";
	
	$output = '';
	if (!$colEachItem) $output .= "<td $extraTableDef>";
	
	foreach ($datas as $data)
	{
		//$output .=  "::". print_r($data, true) . "<br/>\n";
		
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
		$output .= "<br/>$name<br style='clear:both;' />";
		
		if ($colEachItem) $output .= "</td>";
	}
	
	if (!$colEachItem) $output .= "</td>";
	return $output;
}


function uespDestiny2Build_CreateDataTextGroupId($buildData, $groupId, $constantName, $typeName = null, $idField = null, $descField = null)
{
	$abilityData = unserialize($buildData[$groupId][0]);
	if ($abilityData == null) return '';
	
	return uespDestiny2Build_CreateDataText($abilityData, $constantName, $typeName, $idField, $descField);
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
	$output = "<a name=\"Abilities\"></a>";
	$output .= "<h2 id=\"uespd2Abilities\">Abilities</h2>";
	
	//Array ( [super_ability_id] => Array ( [0] => ) [class_ability_id] => Array ( [0] => 3636300852 ) [movement_ability_id] => Array ( [0] => 3686638441 ) [arc_grenade_id] => Array ( [0] => 2909720723 ) [arc_melee_id] => Array ( [0] => 2708585279 ) )
	$abilityData = unserialize($buildData["abilities_group"][0]);
	//$output .= print_r($abilityData, true);
	
	$extraDesc = $abilityData['ability_desc'];
	
	if ($extraDesc) 
	{
		$extraDesc = apply_filters( 'the_content', $extraDesc );
		$output .= "<div class=\"uespd2DataText\">$extraDesc</div>";
	}
	
	$output .= "<table class=\"uespd2DataTable\">";
	
	$ouptut .= "<tr>";
	$output .= uespDestiny2Build_CreateDataTableGroupId($buildData, 'super_abilities_group', 'SuperAbilities', "colspan=\"100\"", false, 'super_ability_id');
	$output .= "</tr><tr>";
	
	$output .= uespDestiny2Build_CreateDataTableGroupId($buildData, 'class_abilities_group', 'ClassAbilities', '', false, 'class_ability_id');
	$output .= uespDestiny2Build_CreateDataTableGroupId($buildData, 'movement_abilities_group', 'MovementAbilities', '', false, 'movement_ability_id');
	$output .= uespDestiny2Build_CreateDataTableGroupId($buildData, 'arc_grenade_abilities_group', 'ArcGrenade', '', false, 'arc_grenade_id');
	$output .= uespDestiny2Build_CreateDataTableGroupId($buildData, 'arc_melee_abilities_group', 'ArcMelee', '', false, 'arc_melee_id');
	
	$output .= "</tr></table>";
	
	$output .= uespDestiny2Build_CreateDataTextGroupId($buildData, 'super_abilities_group', 'SuperAbilities', 'Super Ability', 'super_ability_id', 'super_ability_desc');
	$output .= uespDestiny2Build_CreateDataTextGroupId($buildData, 'class_abilities_group', 'ClassAbilities', 'Class Ability', 'class_ability_id', 'class_ability_desc');
	$output .= uespDestiny2Build_CreateDataTextGroupId($buildData, 'movement_abilities_group', 'MovementAbilities', 'Movement Ability', 'movement_ability_id', 'movement_ability_desc');
	$output .= uespDestiny2Build_CreateDataTextGroupId($buildData, 'arc_grenade_abilities_group', 'ArcGrenade', 'Arc Grenade', 'arc_grenade_id', 'arc_grenade_desc');
	$output .= uespDestiny2Build_CreateDataTextGroupId($buildData, 'arc_melee_abilities_group', 'ArcMelee', 'Arc Melee', 'arc_melee_id', 'arc_melee_desc');
	
	print($output);
}


function uespDestiny2Build_OutputAspects($buildData)
{
	$output = "<a name=\"Aspects\"></a>";
	$output .= "<h2 id=\"uespd2Aspects\">Aspects</h2>";
	
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
	$output = "<a name=\"Fragments\"></a>";
	$output .= "<h2 id=\"uespd2Fragments\">Fragments</h2>";
	
	$fragmentData = unserialize($buildData["fragments_group"][0]);
	
	$output .= "<table class=\"uespd2DataTable\">";
	
	$ouptut .= "<tr>";
	$output .= uespDestiny2Build_CreateDataTable($fragmentData, 'Fragment', '', true, 'fragment_id');
	$output .= "</tr></table>";
	
	$output .= uespDestiny2Build_CreateDataText($fragmentData, 'Fragment', '', 'fragment_id', 'fragment_desc');
	
	print($output);
}


function uespDestiny2Build_OutputGeneral($buildData)
{
	$generalData = unserialize($buildData["general_group"][0]);
	if ($generalData == null) return $output;
	
	$introHtml = $generalData['introduction_id'];
	
	$output = "<a name=\"Should_you_play_this_build\"></a>";
	$output .= $introHtml;
	
	print($output);
}


function uespDestiny2Build_OutputGear($buildData)
{
	$output = "<a name=\"Gear\"></a>";
	$output .= "<h2 id=\"uespd2Gear\">Gear</h2>";
	
	$output .= uespDestiny2Build_CreateWeaponHtml($buildData, 'Kinetic Weapons', 'kinetic', 'kinetic_weapon_desc');
	$output .= uespDestiny2Build_CreateWeaponHtml($buildData, 'Energy Weapons', 'energy', 'energy_weapon_desc');
	$output .= uespDestiny2Build_CreateWeaponHtml($buildData, 'Heavy Weapons', 'power', 'heavy_weapon_desc');
	
	$output .= uespDestiny2Build_CreateExoticArmorHtml($buildData);
	$output .= uespDestiny2Build_CreateArmorStatsHtml($buildData);
	$output .= uespDestiny2Build_CreateArmorModsHtml($buildData);
	
	print($output);
}


function uespDestiny2Build_CreateArmorModsHtml($buildData)
{
	$output = '';
	
	$modData = unserialize($buildData["armor_mods_group"][0]);
	if ($modData == null) return "";
	
	$output .= "<a name=\"Important_Mods\"></a>";
	$output .= "<h3 id=\"uespd2ImportantMods\">Important Mods</h3>";
	
	$intro = $modData['armor_mods_intro'];
	
	if ($intro)
	{
		$intro = apply_filters( 'the_content', $intro );
		$output .= $intro;
	}
	
	$output .= '<table class="uespd2DataTable">';
	
	$output .= uespDestiny2Build_CreateArmorModTable($buildData, 'arm', 'Arms', 'ARMARMORMODS');
	$output .= uespDestiny2Build_CreateArmorModTable($buildData, 'chest', 'Chest', 'CHESTARMORMODS');
	$output .= uespDestiny2Build_CreateArmorModTable($buildData, 'leg', 'Legs', 'LEGARMORMODS');
	$output .= uespDestiny2Build_CreateArmorModTable($buildData, 'head', 'Head', 'HEADARMORMODS');
	$output .= uespDestiny2Build_CreateArmorModTable($buildData, 'class', 'Class', 'CLASSARMORMODS');
	
	$output .= '</table>';
	
	$addt = $modData['armor_mods_additional'];
	
	if ($addt) 
	{
		$addt = apply_filters( 'the_content', $addt );
		$output .= $addt;
	}
	
	return $output;
}


function uespDestiny2Build_CreateArmorModTable($buildData, $dataType, $modName, $dataConstant)
{
	$output = '';
	
	$modData = unserialize($buildData[$dataType . '_armor_mods_group'][0]);
	if ($modData == null) return "";
	
	foreach ($modData as $mod)
	{
		$modId = intval($mod[$dataType . '_armor_mod_id']);
		$extraDesc = $mod[$dataType . '_armor_mod_desc'];
		if ($modId <= 0) continue;
		
		$values = CUespDestiny2WordPressPlugin::GetData($dataConstant, $modId, false);
		if ($values === false) continue;
		
		$desc = CUespDestiny2WordPressPlugin::EscapeHtml($values['desc']);
		$name = CUespDestiny2WordPressPlugin::EscapeHtml($values['name']);
		$iconTag = CUespDestiny2WordPressPlugin::MakeIconImageTag($values['icon'], $values['name']);
		if ($extraDesc != "") $desc .= ' ' . CUespDestiny2WordPressPlugin::EscapeHtml($extraDesc);
		
		$output .= "<tr>";
		$output .= "<td class='uespd2NoWrap'>$modName</td>";
		$output .= "<td>$iconTag<br/>$name<br/>$desc</td>";
		$output .= "</tr>";
	}
	
	return $output;
}


function uespDestiny2Build_CreateArmorStatsHtml($buildData)
{
	$output = '';
	
	$armorData = unserialize($buildData["armor_stats_group"][0]);
	if ($armorData == null) return "";
	
	$output .= "<a name=\"Armor_Stats\"></a>";
	$output .= "<h3 id=\"uespd2ExoticArmor\">Armor Stats</h3>";
	
	$armorStats = $armorData['armor_stats'];
	$output .= $armorStats;
	
	return $output;
}


function uespDestiny2Build_CreateExoticArmorHtml($buildData)
{
	$armorDatas = unserialize($buildData["exotic_armor_group"][0]);
	if ($armorDatas == null) return "";
	
	$output = "<a name=\"Exotic_Armor\"></a>";
	$output .= "<h3 id=\"uespd2ExoticArmor\">Exotic Armor</h3>";
	
	$extraDesc = $buildData["exotic_armor_desc"][0];
	
	if ($extraDesc) 
	{
		$extraDesc = apply_filters( 'the_content', $extraDesc );
		$output .= "<div class=\"uespd2DataText\">$extraDesc</div>";
	}
	
	$output .= '<table class="uespd2DataTable">';
	$output .= '<tr>';
	$output .= "<th>Exotic Armor</th>";
	$output .= "<th>Exotic Perk</th>";
	$output .= "</tr>\n";
	
	$textOutput = '';
	
	foreach ($armorDatas as $armorData)
	{
		$armorId = intval($armorData['exotic_armor_id']);
		$perkId = intval($armorData['exotic_armor_perk_id']);
		$extraDesc = $armorData['exotic_armor_desc'];
		if ($armorId <= 0) continue;
		
		$values = CUespDestiny2WordPressPlugin::GetData('EXOTICARMOR', $armorId, false);
		if ($values === false) continue;
		
		$desc = CUespDestiny2WordPressPlugin::EscapeHtml($values['desc']);
		$name = CUespDestiny2WordPressPlugin::EscapeHtml($values['name']);
		$iconTag = CUespDestiny2WordPressPlugin::MakeIconImageTag($values['icon'], $values['name']);
		if ($extraDesc != "") $desc .= ' ' . CUespDestiny2WordPressPlugin::EscapeHtml($extraDesc);
		
		$output .= '<tr><td>';
		$output .= "$iconTag";
		$output .= "<br/>$name</td>";
		
		$textOutput .= "<div class=\"uespd2DataText\">";
		$textOutput .= "<strong>$name</strong> : $desc";
		$textOutput .= "</div>";
		
		$perkValues = $values['sockets'][$perkId];
		
		if ($perkValues)
		{
			$name = CUespDestiny2WordPressPlugin::EscapeHtml($perkValues['name']);
			$iconTag = CUespDestiny2WordPressPlugin::MakeIconImageTag($perkValues['icon'], $perkValues['name']);
			
			$output .= "<td>$iconTag<br/>$name</td>";
		}
		else
		{
			$output .= "<td></td>";
		}
	}
	
	$output .= "</table>\n";
	$output .= $textOutput;
	
	$stats = $values['armor_stats'];
	
	if ($stats != null && $stats != "")
	{
		$output .= "<a name=\"Armor_Stats\"></a>";
		$output .= "<h3 id=\"uespd2ArmorStats\">Armor Stats</h3>";
		
		$stats = apply_filters( 'the_content', $stats );
		$output .= $stats;
	}
	
	return $output;
}


function uespDestiny2Build_CreateWeaponHtml($buildData, $weaponType, $dataType, $descId)
{
	$label = str_replace(' ', '_', $weaponType);
	$output = "<a name=\"$label\"></a>";
	$output .= "<h3>$weaponType</h3>";
	
	$extraDesc = $buildData[$descId][0];
	
	if ($extraDesc) 
	{
		$extraDesc = apply_filters( 'the_content', $extraDesc );
		$output .= "<div class=\"uespd2DataText\">$extraDesc</div>";
	}
	
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
		if ($values === false) continue;
		
		$output .= '<div class="uespd2DataText">';
		
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
	if ($theme === "Altitude Pro") return uespDestiny2OutputBuild_Genesis();
	if ($theme === "News Vibrant Pro") return uespDestiny2OutputBuild_NewsVibrantPro();
	return uespDestiny2OutputBuild_Content();
}

$theme = wp_get_theme();
if ($theme && $theme->exists()) uespDestiny2OutputBuild($theme->name);



