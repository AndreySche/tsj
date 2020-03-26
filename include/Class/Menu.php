<?php
class Menu{

	function __construct( $menu, $tabs ){
		$this->ar = $menu;
		$this->tabs = $tabs;
	}

	function Show(){
		$echo = '<nav class="navigation"><ul class="navigation__list">';
		foreach( $this->ar as $key=>$val ){
			$echo .= '<li class="navigation__item">';
			$echo .= '<a href="'.$val['link'].'" class="navigation__link">'.$val['title'].'</a>';
			$echo .= $this->SubMenu( $val );
			$echo .= '</li>';
		}
		$title = $this->SetTitle();
		$echo .= "</ul></nav>";

		return [ "menu" => $echo, "title" => $title ];
	}

	private function SubMenu( $row ){
		if( !isset($row['submenu']) ) 	return '';
		$echo = '<ul class="drop-menu">';
		foreach( $row['submenu'] as $key => $val ){
			$link = isset( $val['link'] ) ? $val['link'] : $key ;
			$echo .= '
			<li class="drop-menu__item">
				<a href="'.$link.'" class="drop-menu__link">'.$val['title'].'</a>
			</li>';
		}
		$echo .= '</ul>';
		return $echo;
	}

	function GetTabs( $page ){
		if( isset($this->tabs[$page]) ) 	return $this->tabs[$page];
		return [ 'empty' ];
	}

	private function SetTitle(){
		$title = 'Главная';
		$page =	isset($_GET['page'])	? $_GET['page']	: 'main' ;
		$tab =	isset($_GET['tab'])		? $_GET['tab']	: 'index' ;

		$_symbol = "β";

		if( isset($this->ar[$page]['title']) )
			$title = $this->ar[$page]['title'];
		else if( isset($this->tabs[$page]['index']) ){
			$title = $this->FindHeadTitle( $page );
		}

		if( isset($tab) 
				and isset($this->tabs[$page][$tab]) 
				and $title != $this->tabs[$page][$tab] ){
			$title = $this->tabs[$page][$tab] . " $_symbol $title";
		}
		else {
			$title = " $_symbol $title";
		}

		return $title;
	}

	private function FindHeadTitle( $page ){
		foreach( $this->ar as $key=>$val ){
			if( isset($val['submenu'][$page]) ){
				return $val['submenu'][$page]['title'];
			}
		}
		return $this->tabs[$page]['index'];
	}

}
?>