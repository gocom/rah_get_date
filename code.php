<?php	##################
	#
	#	rah_get_date-plugin for Textpattern
	#	version 0.1
	#	by Jukka Svahn
	#	http://rahforum.biz
	#
	###################

	function rah_get_date($atts) {
		extract(lAtts(array(
			'format' => '%Y %B'
		),$atts));
		$date = (gps('month')) ? gps('month') : gps('date');
		$out = ($date) ? safe_strftime($format,strtotime($date)) : '';
		return $out;
	}
?>