<?php

class DocViewer {
	
	/**
	 * @param $parser Parser
	 * @param $frame PPFrame
	 * @param $args array
	 * @return string
	 */
	public static function generateViewer( &$parser, $frame, $args ) {

		global $wgDocViewerViewerJSPath;

		$attrs = array();
		# First value is File in wiki format

		if ( count( $args ) > 0 ) {

			$fileName = array_shift( $args );

			$fileName = trim( $frame->expand( $fileName ) ); // Clean file
			
			// Wer may need to remove namespace here
			$file = wfFindFile( $fileName );
			if ( $file && $file->exists() ) {
				$filepath = $file->getUrl();
				$attrs["src"] = $wgDocViewerViewerJSPath.$filepath;
			}

			foreach ( $args as $arg ) {
				$arg_clean = trim( $frame->expand( $arg ) );
				$arg_proc = explode( "=", $arg_clean, 2 );
				
				if ( count( $arg_proc ) == 1 ){
					// kind of disabled = disabled
					$attrs[ trim( $arg_proc[0] ) ] = trim( $arg_proc[0] );
				} else {
					if  ( count( $arg_proc ) == 2 ) {
						$attrs[ trim( $arg_proc[0] ) ] = trim( $arg_proc[1] );
					}
				}
			}
		}
		// Default params
		$attrs["id"] = "viewer";

		// <iframe style="float:right;" id="viewer" src = "/ViewerJS/#../demo/ohm2013.odp" width='400' height='300' allowfullscreen webkitallowfullscreen></iframe> 
		$tag = 	Html::element(
			'iframe',
			$attrs
		);
		
		return $parser->insertStripItem( $tag, $parser->mStripState );
	}
	
	

}
