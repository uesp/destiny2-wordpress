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
	'child_add_more' => true,
	'fields' => array(
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


/*
piklist('field', array(
    'type' => 'text'
    ,'field' => 'demo_text'
    ,'label' => 'Text Box'
    ,'description' => 'Field Description'
    ,'value' => 'Default text'
    ,'help' => 'This is help text.'
    ,'attributes' => array(
      'class' => 'text'
    )
  ));

piklist('field', array(
    'type' => 'select'
    ,'field' => 'demo_select'
    ,'label' => 'Select Box'
    ,'description' => 'Choose from the drop-down.'
    ,'help' => 'This is help text.'
    ,'attributes' => array(
      'class' => 'text'
    )
    ,'choices' => array(
      'option1' => 'Option 1'
      ,'option2' => 'Option 2'
      ,'option3' => 'Option 3'
    )
  )); */


?>