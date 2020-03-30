<?php

class Content{
	use Sql;

//	function __construct(){}

	function ReadNews( $ar ){

		$res = '';
		foreach( $ar as $key=>$val ){
			$res .= '<p>';
			$res .= '<b class="green">'.ShowDateLong( ToTimestamp($val['date']) ).'г.</b><br>';
			$res .= txtBR($val['body']);
			$res .= '</p>';
		}
		return $res;
	}

	function TabsMenu( $ar, $page ){
		
	}
}
?>