<?php
/*
Title: Aspects
Description: Controls the details about the aspects for the build
Post Type: dg_destiny_builds
*/

piklist('field', array(
	'type' => 'group',
	'field' => 'aspects_group',
	'label' => 'Aspects',
	'list' => false,
	'disable_label' => false,
	'add_more' => true,
	'fields' => array(
		array(
			'type' => 'select',
			'field' => 'aspect_id',
			'required' => false,
			'label' => 'Aspect',
			'columns' => 4,
			'choices' => CUespDestiny2WordPressPlugin::CreateChoices('Aspect', 'Aspects'),
			'add_more' => false,
			'attributes' => array(
				'placeholder' => 'Aspect',
			),
		),
		array(
			'type' => 'text',
			'field' => 'aspect_desc',
			'required' => false,
			'label' => 'Aspect Description',
			'columns' => 4,
			'add_more' => false,
			'attributes' => array(
					'placeholder' => 'Put any extra description text here...',
			),
		),
		array(		// Need this here otherwise a single select box doesn't work ?
			'type' => 'hidden',
			'field' => 'aspect_hidden_id',
			'value' => 'none',
		),
	),
) );

?>