<?php
/*
Title: Weapons
Description: Controls the details about the weapons for the build
Post Type: dg_destiny_builds
*/

piklist('field', array(
	'type' => 'group',
	'field' => 'kinetic_weapons_group',
	'label' => 'Kinetic Weapons',
	'list' => false,
	'disable_label' => false,
	'add_more' => true,
	'fields' => array(
		array(
			'type' => 'select',
			'field' => 'kinetic_weapon_id',
			'required' => false,
			'label' => 'Kinetic Weapons',
			'columns' => 2,
			'choices' => CUespDestiny2WordPressPlugin::CreateChoices('KineticWeapons', 'Kinetic Weapons'),
			'add_more' => false,
		),
		array(
			'type' => 'select',
			'field' => 'kinetic_weapon_perk1_id',
			'required' => false,
			'label' => 'Perk 1',
			'columns' => 2,
			'choices' => [ '' => 'Select Perk' ],
			'add_more' => false,
		),
		array(
			'type' => 'select',
			'field' => 'kinetic_weapon_perk2_id',
			'required' => false,
			'label' => 'Perk 2',
			'columns' => 2,
			'choices' => [ '' => 'Select Perk' ],
			'add_more' => false,
		),
		array(
			'type' => 'text',
			'field' => 'kinetic_weapon_desc',
			'required' => false,
			'label' => 'Kinetic Weapons Description',
			'columns' => 4,
			'add_more' => false,
			'attributes' => array(
					'placeholder' => 'Put any extra description text here...',
			),
		),
		array(
			'type' => 'hidden',
			'field' => 'kinetic_weapon_perk1_id_hidden',
			'value' => '',
		),
		array(
			'type' => 'hidden',
			'field' => 'kinetic_weapon_perk2_id_hidden',
			'value' => '',
		),
	),
) );

piklist('field', array(
	'type' => 'group',
	'field' => 'energy_weapons_group',
	'label' => 'Energy Weapons',
	'list' => false,
	'disable_label' => false,
	'add_more' => true,
	'fields' => array(
		array(
			'type' => 'select',
			'field' => 'energy_weapon_id',
			'required' => false,
			'label' => 'Energy Weapons',
			'columns' => 2,
			'choices' => CUespDestiny2WordPressPlugin::CreateChoices('EnergyWeapons', 'Energy Weapons'),
			'add_more' => false,
		),
		array(
			'type' => 'select',
			'field' => 'energy_weapon_perk1_id',
			'required' => false,
			'label' => 'Perk 1',
			'columns' => 2,
			'choices' => [ '' => 'Select Perk' ],
			'add_more' => false,
		),
		array(
			'type' => 'select',
			'field' => 'energy_weapon_perk2_id',
			'required' => false,
			'label' => 'Perk 2',
			'columns' => 2,
			'choices' => [ '' => 'Select Perk' ],
			'add_more' => false,
		),
		array(
			'type' => 'text',
			'field' => 'energy_weapon_desc',
			'required' => false,
			'label' => 'Energy Weapons Description',
			'columns' => 4,
			'add_more' => false,
			'attributes' => array(
					'placeholder' => 'Put any extra description text here...',
			),
		),
		array(
			'type' => 'hidden',
			'field' => 'energy_weapon_perk1_id_hidden',
			'value' => '',
		),
		array(
			'type' => 'hidden',
			'field' => 'energy_weapon_perk2_id_hidden',
			'value' => '',
		),
	),
) );

piklist('field', array(
	'type' => 'group',
	'field' => 'power_weapons_group',
	'label' => 'Heavy Weapons',
	'list' => false,
	'disable_label' => false,
	'add_more' => true,
	'fields' => array(
		array(
			'type' => 'select',
			'field' => 'power_weapon_id',
			'required' => false,
			'label' => 'Heavy Weapons',
			'columns' => 2,
			'choices' => CUespDestiny2WordPressPlugin::CreateChoices('PowerWeapons', 'Heavy Weapons'),
			'add_more' => false,
		),
		array(
			'type' => 'select',
			'field' => 'power_weapon_perk1_id',
			'required' => false,
			'label' => 'Perk 1',
			'columns' => 2,
			'choices' => [ '' => 'Select Perk' ],
			'add_more' => false,
		),
		array(
			'type' => 'select',
			'field' => 'power_weapon_perk2_id',
			'required' => false,
			'label' => 'Perk 2',
			'columns' => 2,
			'choices' => [ '' => 'Select Perk' ],
			'add_more' => false,
		),
		array(
			'type' => 'text',
			'field' => 'power_weapon_desc',
			'required' => false,
			'label' => 'Heavy Weapons Description',
			'columns' => 4,
			'add_more' => false,
			'attributes' => array(
					'placeholder' => 'Put any extra description text here...',
			),
		),
		array(
			'type' => 'hidden',
			'field' => 'power_weapon_perk1_id_hidden',
			'value' => '',
		),
		array(
			'type' => 'hidden',
			'field' => 'power_weapon_perk2_id_hidden',
			'value' => '',
		),
	),
) );

?>