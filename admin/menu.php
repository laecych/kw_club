<?php
$adminmenu = array();
$i         = 1;
$icon_dir  = substr(XOOPS_VERSION, 6, 3) == '2.6' ? "" : "images/admin/";

$adminmenu[$i]['title'] = _MI_TAD_ADMIN_HOME;
$adminmenu[$i]['link']  = 'admin/index.php';
$adminmenu[$i]['desc']  = _MI_TAD_ADMIN_HOME_DESC;
$adminmenu[$i]['icon']  = 'images/admin/home.png';

$i++;
$adminmenu[$i]['title'] = "設定社團資料";
$adminmenu[$i]['link']  = 'admin/config.php';
$adminmenu[$i]['desc']  = _MI_KWCLUB_ADMENU2_DESC;
$adminmenu[$i]['icon']  = "{$icon_dir}button.png";

$i++;
$adminmenu[$i]['title'] = _MI_KWCLUB_ADMENU5;
$adminmenu[$i]['link']  = 'admin/register.php';
$adminmenu[$i]['desc']  = _MI_KWCLUB_ADMENU5_DESC;
$adminmenu[$i]['icon']  = "{$icon_dir}button.png";

// $i++;
// $adminmenu[$i]['title'] = _MI_KWCLUB_ADMENU2;
// $adminmenu[$i]['link']  = 'admin/cate.php?type=teacher';
// $adminmenu[$i]['desc']  = _MI_KWCLUB_ADMENU2_DESC;
// $adminmenu[$i]['icon']  = "{$icon_dir}button.png";

// $i++;
// $adminmenu[$i]['title'] = _MI_KWCLUB_ADMENU3;
// $adminmenu[$i]['link']  = 'admin/cate.php?type=cate';
// $adminmenu[$i]['desc']  = _MI_KWCLUB_ADMENU3_DESC;
// $adminmenu[$i]['icon']  = "{$icon_dir}button.png";

// $i++;
// $adminmenu[$i]['title'] = _MI_KWCLUB_ADMENU4;
// $adminmenu[$i]['link']  = 'admin/cate.php?type=place';
// $adminmenu[$i]['desc']  = _MI_KWCLUB_ADMENU4_DESC;
// $adminmenu[$i]['icon']  = "{$icon_dir}button.png";

// $i++;
// $adminmenu[$i]['title'] = _MI_KWCLUB_ADMENU1;
// $adminmenu[$i]['link']  = 'admin/main.php';
// $adminmenu[$i]['desc']  = _MI_KWCLUB_ADMENU1_DESC;
// $adminmenu[$i]['icon']  = "{$icon_dir}button.png";

$i++;
$adminmenu[$i]['title'] = _MI_TAD_ADMIN_ABOUT;
$adminmenu[$i]['link']  = 'admin/about.php';
$adminmenu[$i]['desc']  = _MI_TAD_ADMIN_ABOUT_DESC;
$adminmenu[$i]['icon']  = 'images/admin/about.png';
