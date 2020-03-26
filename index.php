<?php

ini_set( 'display_errors','On' );
include "include/config.php";
include "include/Func.php";
include "include/Class/Menu.php";

$menu = new Menu();
$page = $menu->GetPage();
$echoMenu = $menu->Show( $page );

Debug( $page );

include "include/page/header.php";
echo $echoMenu;
include "include/page/$page.php";
include "include/page/footer.php";

?>