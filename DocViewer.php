<?php


if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'This file is a MediaWiki extension, it is not a valid entry point' );
}

$GLOBALS['wgExtensionCredits']['parserhook'][] = array(
	'path' => __FILE__,
	'name' => 'DocViewer',
	'version' => '0.1',
	'url' => 'https://github.com/SimilisTools/mediawiki-DocViewer',
	'author' => array( 'Toniher' ),
	'descriptionmsg' => 'docviewer-desc',
);

$GLOBALS['wgAutoloadClasses']['DocViewer'] = __DIR__.'/DocViewer_body.php';
$GLOBALS['wgMessagesDirs']['DocViewer'] = __DIR__ . '/i18n';
$GLOBALS['wgExtensionMessagesFiles']['DocViewer'] = __DIR__ . '/DocViewer.i18n.php';
$GLOBALS['wgExtensionMessagesFiles']['DocViewerMagic'] = __DIR__ . '/DocViewer.i18n.magic.php';

$wgHooks['ParserFirstCallInit'][] = 'wfRegisterDocViewer';

// Path wrapup for ViewerJS -> This could be improved
$GLOBALS['wgDocViewerViewerJSPath'] = '/w/extensions/DocViewer/libs/ViewerJS#../../../../..';

/**
 * @param $parser Parser
 * @return bool
 */
function wfRegisterDocViewer( $parser ) {
	$parser->setFunctionHook( 'docviewer', 'DocViewer::generateViewer', SFH_OBJECT_ARGS );
	return true;
}
