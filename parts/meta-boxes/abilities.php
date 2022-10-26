<?php
/*
Title: Abilities
Description: Controls the details about the abilities for the build
Post Type: dg_destiny_builds
*/

piklist('field', array(
	'type' => 'group',
	'field' => 'abilities_group',
	'label' => 'Abilities',
	'list' => false,
	'disable_label' => false,
	'add_more' => false,
	'fields' => array(
		array(
			'type' => 'editor',
			'field' => 'ability_desc',
			'required' => false,
			'label' => 'Ability Description',
			'columns' => 12,
			'add_more' => false,
			'attributes' => array(
				'placeholder' => 'Place extra ability description here...',
			),
		),
		array(
			'type' => 'select',
			'field' => 'super_ability_id',
			'required' => false,
			'label' => 'Super Ability',
			'columns' => 4,
			'choices' => CUespDestiny2WordPressPlugin::CreateChoices('SuperAbilities', 'Super Abilities'),
			'add_more' => true,
			'attributes' => array(
				'placeholder' => 'Super Ability',
			),
		),
		array(
			'type' => 'select',
			'field' => 'class_ability_id',
			'required' => false,
			'label' => 'Class Ability',
			'columns' => 4,
			'add_more' => true,
			'choices' => CUespDestiny2WordPressPlugin::CreateChoices('ClassAbilities', 'Class Abilities'),
			'attributes' => array(
				'placeholder' => 'Class Ability',
			),
		),
		array(
			'type' => 'select',
			'field' => 'movement_ability_id',
			'required' => false,
			'label' => 'Movement Ability',
			'columns' => 4,
			'add_more' => true,
			'choices' => CUespDestiny2WordPressPlugin::CreateChoices('MovementAbilities', 'Movement Abilities'),
			'attributes' => array(
				'placeholder' => 'Movement Ability',
			),
		),
		array(
			'type' => 'select',
			'field' => 'arc_grenade_id',
			'required' => false,
			'label' => 'Arc Grenade',
			'columns' => 4,
			'add_more' => true,
			'choices' => CUespDestiny2WordPressPlugin::CreateChoices('ArcGrenade', 'Arc Grenade'),
			'attributes' => array(
				'placeholder' => 'Arc Grenade',
			),
		),
		array(
			'type' => 'select',
			'field' => 'arc_melee_id',
			'required' => false,
			'label' => 'Arc Melee',
			'columns' => 4,
			'add_more' => true,
			'choices' => CUespDestiny2WordPressPlugin::CreateChoices('ArcMelee', 'Arc Melee'),
			'attributes' => array(
				'placeholder' => 'Arc Melee',
			),
		),
	),
) );

?>