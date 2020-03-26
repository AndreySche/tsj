<?php

ini_set('display_errors','On');
include "include/Func.php";
include "include/CRM.php";

$crm = new CRM();
$page = $crm->GetPage();
$menu = $crm->GetMenu( $page );

include "include/pages/header.php";
echo $menu;
include "include/pages/$page.php";
include "inc/footer.php";

Debug( $page );

?>