<?php
/*
Title: Abilities
Description: Controls the details about the abilities for the build
Post Type: dg_destiny_builds
*/

$options = array( // Pass any option that is accepted by wp_editor()
      'wpautop' => true,
      'media_buttons' => true,
      'shortcode_buttons' => true,
      'teeny' => false,
      'dfw' => false,
      'quicktags' => true,
      'drag_drop_upload' => true,
      'tinymce' => array(
        'resize' => false,
        'wp_autoresize_on' => true
      )
);

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
			'options' => $options,
			'attributes' => array(
				'placeholder' => 'Place extra ability description here...',
			),
		),
		array(
			'type' => 'hidden',
			'field' => 'ability_desc_id_hidden',
			'value' => '1234',
		),
	),
) );

piklist('field', array(
	'type' => 'group',
	'field' => 'super_abilities_group',
	'label' => 'Super Abilities',
	'list' => false,
	'disable_label' => false,
	'add_more' => true,
	'fields' => array(
		array(
			'type' => 'select',
			'field' => 'super_ability_id',
			'required' => false,
			'label' => 'Super Ability',
			'columns' => 4,
			'choices' => CUespDestiny2WordPressPlugin::CreateChoices('SuperAbilities', 'Super Abilities'),
			'add_more' => false,
			'attributes' => array(
				'placeholder' => 'Super Ability',
			),
		),
		array(
			'type' => 'text',
			'field' => 'super_ability_desc',
			'required' => false,
			'label' => 'Super Ability Description',
			'columns' => 4,
			'add_more' => false,
			'attributes' => array(
				'placeholder' => 'Place extra super ability description here...',
			),
		),
	),
));

piklist('field', array(
	'type' => 'group',
	'field' => 'class_abilities_group',
	'label' => 'Class Abilities',
	'list' => false,
	'disable_label' => false,
	'add_more' => true,
	'fields' => array(
		array(
			'type' => 'select',
			'field' => 'class_ability_id',
			'required' => false,
			'label' => 'Class Ability',
			'columns' => 4,
			'add_more' => false,
			'choices' => CUespDestiny2WordPressPlugin::CreateChoices('ClassAbilities', 'Class Abilities'),
			'attributes' => array(
				'placeholder' => 'Class Ability',
			),
		),
		array(
			'type' => 'text',
			'field' => 'class_ability_desc',
			'required' => false,
			'label' => 'Class Ability Description',
			'columns' => 4,
			'add_more' => false,
			'attributes' => array(
				'placeholder' => 'Place extra class ability description here...',
			),
		),
	),
));

piklist('field', array(
	'type' => 'group',
	'field' => 'movement_abilities_group',
	'label' => 'Movement Abilities',
	'list' => false,
	'disable_label' => false,
	'add_more' => true,
	'fields' => array(
		array(
			'type' => 'select',
			'field' => 'movement_ability_id',
			'required' => false,
			'label' => 'Movement Ability',
			'columns' => 4,
			'add_more' => false,
			'choices' => CUespDestiny2WordPressPlugin::CreateChoices('MovementAbilities', 'Movement Abilities'),
			'attributes' => array(
				'placeholder' => 'Movement Ability',
			),
		),
		array(
			'type' => 'text',
			'field' => 'movement_ability_desc',
			'required' => false,
			'label' => 'Class Movement Description',
			'columns' => 4,
			'add_more' => false,
			'attributes' => array(
				'placeholder' => 'Place extra class movement description here...',
			),
		),
	),
));

piklist('field', array(
	'type' => 'group',
	'field' => 'arc_grenade_abilities_group',
	'label' => 'Grenade Abilities',
	'list' => false,
	'disable_label' => false,
	'add_more' => true,
	'fields' => array(
		array(
			'type' => 'select',
			'field' => 'arc_grenade_id',
			'required' => false,
			'label' => 'Grenade',
			'columns' => 4,
			'add_more' => false,
			'choices' => CUespDestiny2WordPressPlugin::CreateChoices('ArcGrenade', 'Grenade'),
			'attributes' => array(
				'placeholder' => 'Grenade',
			),
		),
		array(
			'type' => 'text',
			'field' => 'arc_grenade_desc',
			'required' => false,
			'label' => 'Grenade Description',
			'columns' => 4,
			'add_more' => false,
			'attributes' => array(
				'placeholder' => 'Place extra grenade description here...',
			),
		),
	),
));

piklist('field', array(
	'type' => 'group',
	'field' => 'arc_melee_abilities_group',
	'label' => 'Melee Abilities',
	'list' => false,
	'disable_label' => false,
	'add_more' => true,
	'fields' => array(
		array(
			'type' => 'select',
			'field' => 'arc_melee_id',
			'required' => false,
			'label' => 'Melee',
			'columns' => 4,
			'add_more' => false,
			'choices' => CUespDestiny2WordPressPlugin::CreateChoices('ArcMelee', 'Melee'),
			'attributes' => array(
				'placeholder' => 'Melee',
			),
		),
		array(
			'type' => 'text',
			'field' => 'arc_melee_desc',
			'required' => false,
			'label' => 'Melee Description',
			'columns' => 4,
			'add_more' => false,
			'attributes' => array(
				'placeholder' => 'Place extra melee description here...',
			),
		),
	),
));

