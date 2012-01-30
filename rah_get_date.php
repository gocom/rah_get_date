<?php	##################
	#
	#	rah_get_date-plugin for Textpattern
	#	version 0.3
	#	by Jukka Svahn
	#	http://rahforum.biz
	#
	#	Copyright (C) 2011 Jukka Svahn <http://rahforum.biz>
	#	Licensed under GNU Genral Public License version 2
	#	http://www.gnu.org/licenses/gpl-2.0.html
	#
	###################

	function rah_get_date($atts) {
		extract(lAtts(array(
			'format' => '%Y %B',
			'format_year' => '',
			'format_month' => '',
			'format_date' => '',
			'format_hour' => '',
			'format_minute' => '',
			'format_second' => '',
			'format_now' => '',
			'now_condition' => '%Y-%m-%d',
			'date' => ''
		),$atts));
		
		$date = htmlspecialchars(trim($date ? $date : (gps('month') ? gps('month') : gps('date'))));
		
		if(!$date || ($valid = strtotime($date)) == -1 || $valid === false)
			return;
		
		$udate = safe_strtotime($date);
		
		if(
			$format_now && $now_condition &&
			safe_strftime($now_condition, safe_strtotime('now')) === 
			safe_strftime($now_condition, $udate)
		)
			$format = $format_now;
		else {
		
			$ds = 
				substr_count($date, '-') + 
				substr_count($date, ' ') + 
				substr_count($date, ':');
		
			$formats = 
				array(
					0 => 'year',
					1 => 'month',
					2 => 'date',
					3 => 'hour',
					4 => 'minute',
					5 => 'second'
				);
		
			if(isset($formats[$ds]) && isset($atts['format_'.$formats[$ds]]))
				$format = $atts['format_'.$formats[$ds]];
		}
		
		return $format ? safe_strftime($format, $udate) : '';
	}
?>