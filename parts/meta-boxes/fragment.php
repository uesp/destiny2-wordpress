<?php
/*
Title: Fragments
Description: Controls the details about the fragments for the build
Post Type: dg_destiny_builds
*/

piklist('field', array(
	'type' => 'group',
	'field' => 'fragments_group',
	'label' => 'Fragments',
	'list' => false,
	'disable_label' => false,
	'add_more' => true,
	'fields' => array(
		array(
			'type' => 'select',
			'field' => 'fragment_id',
			'required' => false,
			'label' => 'Fragment',
			'columns' => 4,
			'choices' => CUespDestiny2WordPressPlugin::CreateChoices('Fragment', 'Fragments'),
			'add_more' => false,
		),
		array(
			'type' => 'text',
			'field' => 'fragment_desc',
			'required' => false,
			'label' => 'Fragment Description',
			'columns' => 4,
			'add_more' => false,
			'attributes' => array(
					'placeholder' => 'Put any extra description text here...',
			),
		),
		array(		// Need this here otherwise a single select box doesn't work ?
			'type' => 'hidden',
			'field' => 'fragment_hidden_id',
			'value' => 'none',
		),
	),
) );

?>