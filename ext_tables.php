<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');
$tempColumns = Array (
	'tx_rssdisplay_feed' => Array (
		'exclude' => 0,
		'label' => 'LLL:EXT:rss_display/locallang_db.xml:tt_content.tx_rssdisplay_feed',
		'config' => Array (
			'type' => 'input',
			'size' => '15',
			'max' => '255',
			'checkbox' => '',
			'eval' => 'trim',
			'wizards' => Array(
				'_PADDING' => 2,
				'link' => Array(
					'type' => 'popup',
					'title' => 'Link',
					'icon' => 'link_popup.gif',
					'script' => 'browse_links.php?mode=wizard',
					'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
				)
			)
		)
	),
	'tx_rssdisplay_quantity' => Array (
		'exclude' => 0,
		'label' => 'LLL:EXT:rss_display/locallang_db.xml:tt_content.tx_rssdisplay_quantity',
		'config' => Array (
			'type' => 'input',
			'size' => '30',
			'default' => '10',
			'eval' => 'int',
		)
	),
	'tx_rssdisplay_descriptiondisplay' => Array (
		'exclude' => 0,
		'label' => 'LLL:EXT:rss_display/locallang_db.xml:tt_content.tx_rssdisplay_descriptiondisplay',
		'config' => Array (
			'type' => 'check',
		)
	),
	'tx_rssdisplay_descriptionlength' => Array(
		'exclude' => 0,
		'label' => 'LLL:EXT:rss_display/locallang_db.xml:tt_content.tx_rssdisplay_descriptionlength',
		'config' => Array (
			'type' => 'input',
			'size' => '30',
			'eval' => 'int',
		)

	),
);

t3lib_div::loadTCA('tt_content');
t3lib_extMgm::addTCAcolumns('tt_content',$tempColumns,1);

$extensionName = t3lib_div::underscoredToUpperCamelCase($_EXTKEY);
$pluginSignature = strtolower($extensionName) . '_pi1';
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature]='layout,select_key';
#$TCA['tt_content']['types']['list']['subtypes_addlist']['rssdisplay_pi1']='tx_rssdisplay_feed, tx_rssdisplay_quantity, tx_rssdisplay_descriptiondisplay, tx_rssdisplay_descriptionlength';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature]='pi_flexform';

t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForm/feed.xml');

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Pi1',
	'Fetch and display a RSS feed'
);

t3lib_extMgm::addPlugin(Array('LLL:EXT:rss_display/locallang_db.xml:tt_content.list_type_pi1', $_EXTKEY.'_pi1'),'list_type');
#if (TYPO3_MODE=='BE')	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_rssdisplay_pi1_wizicon'] = t3lib_extMgm::extPath($_EXTKEY).'pi1/class.tx_rssdisplay_pi1_wizicon.php';
?>