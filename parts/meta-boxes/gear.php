<?php
/*
Title: Gear
Description: Controls the details about the weapons and armor for the build
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
			'type' => 'editor',
			'field' => 'kinetic_weapon_desc',
			'required' => false,
			'label' => 'Kinetic Weapon Description',
			'columns' => 12,
			'add_more' => false,
			'options' => $options,
			'attributes' => array(
				'placeholder' => 'Place extra kinetic weapon description here...',
			),
		)
);

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
			'type' => 'editor',
			'field' => 'energy_weapon_desc',
			'required' => false,
			'label' => 'Energy Weapon Description',
			'columns' => 12,
			'add_more' => false,
			'options' => $options,
			'attributes' => array(
				'placeholder' => 'Place extra energy weapon description here...',
			),
		)
);

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
			'type' => 'editor',
			'field' => 'heavy_weapon_desc',
			'required' => false,
			'label' => 'Heavy Weapon Description',
			'columns' => 12,
			'add_more' => false,
			'options' => $options,
			'attributes' => array(
				'placeholder' => 'Place extra heavy weapon description here...',
			),
		)
);

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

piklist('field', array(
			'type' => 'editor',
			'field' => 'exotic_armor_desc',
			'required' => false,
			'label' => 'Armor Description',
			'columns' => 12,
			'add_more' => false,
			'options' => $options,
			'attributes' => array(
				'placeholder' => 'Place extra armor description here...',
			),
		)
);

piklist('field', array(
	'type' => 'group',
	'field' => 'exotic_armor_group',
	'label' => 'Exotic Armor',
	'list' => false,
	'disable_label' => false,
	'add_more' => true,
	'fields' => array(
		array(
			'type' => 'select',
			'field' => 'exotic_armor_id',
			'required' => false,
			'label' => 'Exotic Armor',
			'columns' => 2,
			'choices' => CUespDestiny2WordPressPlugin::CreateChoices('ExoticArmor', 'Exotic Armor'),
			'add_more' => false,
		),
		array(
			'type' => 'select',
			'field' => 'exotic_armor_perk_id',
			'required' => false,
			'label' => 'Perk',
			'columns' => 2,
			'choices' => [ '' => 'Select Perk' ],
			'add_more' => false,
		),
		array(
			'type' => 'text',
			'field' => 'exotic_armor_desc',
			'required' => false,
			'label' => 'Exotic Armor Description',
			'columns' => 4,
			'add_more' => false,
			'attributes' => array(
					'placeholder' => 'Put any extra description text here...',
			),
		),
		array(
			'type' => 'hidden',
			'field' => 'exotic_armor_perk_id_hidden',
			'value' => '',
		),
	),
) );


piklist('field', array(
	'type' => 'group',
	'field' => 'armor_stats_group',
	'label' => 'Armor Stats',
	'list' => false,
	'disable_label' => false,
	'add_more' => false,
	'fields' => array(
		array(
			'type' => 'editor',
			'field' => 'armor_stats',
			'required' => false,
			'label' => 'Armor Stats',
			'columns' => 12,
			'add_more' => false,
			'options' => $options,
			'attributes' => array(
					'placeholder' => 'Put any extra description text here...',
			),
		),
		array(
			'type' => 'hidden',
			'field' => 'armor_stats_hidden',
			'value' => '',
		),
	),
) );


piklist('field', array(
	'type' => 'group',
	'field' => 'armor_mods_group',
	'label' => 'Armor Mods',
	'list' => false,
	'disable_label' => false,
	'add_more' => false,
	'fields' => array(
		array(
			'type' => 'editor',
			'field' => 'armor_mods_intro',
			'required' => false,
			'label' => 'Introduction',
			'columns' => 12,
			'add_more' => false,
			'options' => $options,
			'attributes' => array(
					'placeholder' => 'Put any introduction...',
			),
		),
		array(
			'type' => 'hidden',
			'field' => 'armor_mods_hidden',
			'value' => '',
		),
	),
) );


piklist('field', array(
	'type' => 'group',
	'field' => 'arm_armor_mods_group',
	'label' => 'Arm Armor Mods',
	'list' => false,
	'disable_label' => false,
	'add_more' => true,
	'fields' => array(
		array(
			'type' => 'select',
			'field' => 'arm_armor_mod_id',
			'required' => false,
			'label' => 'Arm Armor Mod',
			'columns' => 2,
			'choices' => CUespDestiny2WordPressPlugin::CreateChoices('ArmArmorMods', 'Arm Armor Mod'),
			'add_more' => false,
		),
		array(
			'type' => 'text',
			'field' => 'arm_armor_mod_desc',
			'required' => false,
			'label' => 'Description',
			'columns' => 4,
			'add_more' => false,
			'attributes' => array(
					'placeholder' => 'Put any extra description here...',
			),
		),
	),
) );


piklist('field', array(
	'type' => 'group',
	'field' => 'chest_armor_mods_group',
	'label' => 'Chest Armor Mods',
	'list' => false,
	'disable_label' => false,
	'add_more' => true,
	'fields' => array(
		array(
			'type' => 'select',
			'field' => 'chest_armor_mod_id',
			'required' => false,
			'label' => 'Chest Armor Mod',
			'columns' => 2,
			'choices' => CUespDestiny2WordPressPlugin::CreateChoices('ChestArmorMods', 'Chest Armor Mod'),
			'add_more' => false,
		),
		array(
			'type' => 'text',
			'field' => 'chest_armor_mod_desc',
			'required' => false,
			'label' => 'Description',
			'columns' => 4,
			'add_more' => false,
			'attributes' => array(
					'placeholder' => 'Put any extra description here...',
			),
		),
	),
) );


piklist('field', array(
	'type' => 'group',
	'field' => 'head_armor_mods_group',
	'label' => 'Head Armor Mods',
	'list' => false,
	'disable_label' => false,
	'add_more' => true,
	'fields' => array(
		array(
			'type' => 'select',
			'field' => 'head_armor_mod_id',
			'required' => false,
			'label' => 'Head Armor Mod',
			'columns' => 2,
			'choices' => CUespDestiny2WordPressPlugin::CreateChoices('HeadArmorMods', 'Head Armor Mod'),
			'add_more' => false,
		),
		array(
			'type' => 'text',
			'field' => 'head_armor_mod_desc',
			'required' => false,
			'label' => 'Description',
			'columns' => 4,
			'add_more' => false,
			'attributes' => array(
					'placeholder' => 'Put any extra description here...',
			),
		),
	),
) );


piklist('field', array(
	'type' => 'group',
	'field' => 'leg_armor_mods_group',
	'label' => 'Leg Armor Mods',
	'list' => false,
	'disable_label' => false,
	'add_more' => true,
	'fields' => array(
		array(
			'type' => 'select',
			'field' => 'leg_armor_mod_id',
			'required' => false,
			'label' => 'Leg Armor Mod',
			'columns' => 2,
			'choices' => CUespDestiny2WordPressPlugin::CreateChoices('LegArmorMods', 'Leg Armor Mod'),
			'add_more' => false,
		),
		array(
			'type' => 'text',
			'field' => 'leg_armor_mod_desc',
			'required' => false,
			'label' => 'Description',
			'columns' => 4,
			'add_more' => false,
			'attributes' => array(
					'placeholder' => 'Put any extra description here...',
			),
		),
	),
) );


piklist('field', array(
	'type' => 'group',
	'field' => 'class_armor_mods_group',
	'label' => 'Class Armor Mods',
	'list' => false,
	'disable_label' => false,
	'add_more' => true,
	'fields' => array(
		array(
			'type' => 'select',
			'field' => 'class_armor_mod_id',
			'required' => false,
			'label' => 'Class Armor Mod',
			'columns' => 2,
			'choices' => CUespDestiny2WordPressPlugin::CreateChoices('ClassArmorMods', 'Class Armor Mod'),
			'add_more' => false,
		),
		array(
			'type' => 'text',
			'field' => 'class_armor_mod_desc',
			'required' => false,
			'label' => 'Description',
			'columns' => 4,
			'add_more' => false,
			'attributes' => array(
					'placeholder' => 'Put any extra description here...',
			),
		),
	),
) );


piklist('field', array(
	'type' => 'group',
	'field' => 'armor_mods_group',
	'label' => 'Additional Gear Mods',
	'list' => false,
	'disable_label' => false,
	'add_more' => false,
	'fields' => array(
		array(
			'type' => 'editor',
			'field' => 'armor_mods_additional',
			'required' => false,
			'label' => 'Additional Gear Mods',
			'columns' => 12,
			'add_more' => false,
			'options' => $options,
			'attributes' => array(
					'placeholder' => 'Put any extra description text here...',
			),
		),
		array(
			'type' => 'hidden',
			'field' => 'additional_armor_mods_hidden',
			'value' => '',
		),
	),
) );

?>