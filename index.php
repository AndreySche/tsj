<?php

ini_set( 'display_errors','On' );

include "include/config.php";
include "include/function.php";
include "include/Class/Sql.trait";
include "include/Class/Content.php";
include "include/Class/Menu.php";

$menu = new Menu( $menuSql, $tabsSql );
$content = new Content();

//Debug( $page );
echo $menu->ShowHead();

include $menu->PageInclude();	// set => $file, $params
if( !isset($params) )	$params = $menu->MultInclude();
//Debug( $params );
echo ReplaceFile( $file, $params );

include "include/page/html/footer.html";

?>