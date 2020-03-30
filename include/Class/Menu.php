<?php
class Menu{

	function __construct( $menu, $tabs ){
		$this->ar = $menu;
		$this->tabs = $tabs;
		$this->page = null;
	}

	function ShowHead(){

		$params["{menu}"] = '';
		foreach( $this->ar as $key=>$val ){
			$_link = isset($val['link']) ? $val['link'] : $key ;
			$params["{menu}"] .= '<li>';
			$params["{menu}"] .= '<a href="'.$_link.'">'.$val['title'].'</a>';
			$params["{menu}"] .= $this->SubMenu( $val );
			$params["{menu}"] .= "</li>\n";
		}
		$params["{title}"] = $this->SetTitle();

		$file = file_get_contents( "include/page/html/header.html" );
		$htmlPage = ReplaceFile( $file, $params );

		return $htmlPage;
	}

	function TabsMenu(){
		$page = $this->GetPage();
		if( !isset($this->tabs[$page]) )	return null;

		$res = '<div class="tabsMenu">'."\n";
		$count = count($this->tabs[$page]);
		$i = 0;
		foreach( $this->tabs[$page] as $key=>$val ){
			$class = $count > ++$i ? '' : ' class="last"';
			$res .= "<div$class>"."\n";
			$res .= '<a href="'.$page.'?tab='.$key.'">'.$val.'</a>'."\n";
			$res .= '</div>'."\n";
		}
		$res .= '</div>'."\n";
		return $res;
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

	function PageInclude(){
		$page = $this->GetPage();

//		$path = "include/page/$page/$tab.php";
		$path = "include/page/$page.php";
		if( !file_exists($path) )	$path = "include/page/404.php";
		return $path;
	}

	function MultInclude(){
		$page = $this->GetPage();
		$tabs = $this->GetTabs( $page );

		$params['{left_content}'] = $this->TabsMenu();

		$path = "include/page/$page/$tabs.php";
		if( !file_exists($path) )	$path = "include/page/html/404.html";
		$params['{right_content}'] = file_get_contents( $path );

		return $params;
	}

	private function GetPage(){
		if( isset($this->page) )	return $this->page;

		$page = $this->page = 'main';
		if( !isset($_GET['page']) )	return $page;
		if( empty($_GET['page']) )	return $page;

		$page = $this->page = $_GET['page'];
		return $page;
	}

	private function GetTabs( $page ){
		$tab =	isset($_GET['tab'])		? $_GET['tab']	: 'index' ;
		if( !isset($this->tabs[$page][$tab]) )	return 'error';

		return $tab;
	}
/*	private function GetTabs( $page ){
		if( isset($this->tabs[$page]) ) 	return $this->tabs[$page];
		return [ 'index' ];
	}*/

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
/*		else {
			$title = " $_symbol $title";
		}*/

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