<?php

// --------------------
function Debug( $ar ){
	echo '<pre style="white-space: pre-wrap;">';
	print_r( $ar );
	echo '</pre>';
}

// --------------------
function ColorName( $search, $name, $color="grey" ){
	if( !isset($search) )	return $name;


	return preg_replace_callback( 
		"/$search/iu", 
		function($match) use ($color){	return '<span class="'.$color.'">'. $match[0] .'</span>';	}, 
		$name 
	);
}

// --------------------
function TenDigit( $ph ){		return substr( preg_replace("/\D+/","",$ph),-10 );		}

// --------------------
function ShowPhone( $num ){
	$num = substr( $num, -10 );
	if ( strlen( $num ) < 10 )	return $num;
	return preg_replace("#(\d{3})(\d{3})(\d{2})(\d{2})#", "+7 ($1) $2-$3-$4", $num );
}

// --------------------
function DaysWord( $num ){
	$title = [ 'день','дня','дней' ];
	$cases = array( 2,0,1,1,1,2 );
	return $num.' '.$title[($num % 100 > 4 && $num % 100 < 20) ? 2 : $cases[min($num % 10, 5)]];
}

// --------------------
function ReplaceFile( $file, $params ){
	return str_replace( array_keys($params), array_values($params), $file );
}

// --------------------
function ShowDateLong( $ti, $one=false, $week=false ){
	if ( $ti < 1 )	return '-';
//	$ar = array( 'вс.', 'пн.', 'вт.', 'ср.', 'чт.', 'пт.', 'сб.' );
	$ar = array( 'воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота' );
	$week = $week ? $ar[ date ( "w", $ti ) ].', ' : '' ;
	$date = date ( "m", $ti );
	$row_month = array('', 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');
	$row_month_2 = array('', 'январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь');
	if ( $one ) 
		return $week.$row_month_2[($date-0)].' '.date ( "Y", $ti );
	return $week.date ( "d", $ti ).' '.$row_month[($date-0)].' '.date ( "Y", $ti );
}

// --------------------
function ShowDate( $data, $short=false, $seconds=true ){
	if ( $data < 1 )	return "-";
	if( $short )	return date( "d-m-Y", $data );
	$seconds = $seconds ? "<sub>.".date( "s", $data )."</sub>" : '' ;
	return date( "d-m-Y H:i", $data ).$seconds;
}

// --------------------
function ShowTechDate( $data ){
	if ( $data < 1 )	return "0";
	return date( "d-m-Y H-i-s", $data );
}

// --------------------
function ToTimestamp( $data ){
	if ( strlen($data) < 1 or $data == 0 or $data == '0' )	return "0";
	$tmp_1 = explode(" ", $data);
	$tmp_date = explode("-", isset( $tmp_1[0] ) ? $tmp_1[0] : '01-01-1970' );
	$tmp_hour = explode("-", isset( $tmp_1[1] ) ? $tmp_1[1] : '00-00-00' );

	$result = mktime($tmp_hour[0], $tmp_hour[1], $tmp_hour[2], $tmp_date[1], $tmp_date[0], $tmp_date[2] );

	return ( (int)$result );
}
// --------------------
function Dot( $numb, $dot=null ){
	if ( ( round( $numb, 2 ) - round( $numb ) ) == 0 )	$dot = null;
	return number_format( $numb, isset($dot) ? 2 : 0 , '.', ' ' );
}

// --------------------
function EmailValidate( $email ){
	$v = "/[a-zA-Z0-9_\-.+]+@[a-zA-Z0-9-]+\.[a-zA-Z]+/";
	return (bool)preg_match( $v, $email );
}

// --------------------
function DropWrong( $txt, $no_html=true ){
	$txt = str_replace( ['--'], ['—'], $txt );
	if( $no_html ){
		$txt = preg_replace( '/\"([^\"]*)\"/', '«$1»', $txt );
		$txt = htmlspecialchars ( $txt );
	}
	return $txt;
}

// --------------------
function txtBR( $text ){
	$text = str_replace( "\r\n", "<br>", $text);
	$text = str_replace( "\n\r", "<br>", $text);
	$text = nl2br($text);
	return $text;
}
?>
