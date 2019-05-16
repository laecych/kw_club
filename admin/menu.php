<?php

use XoopsModules\Kw_club;
use XoopsModules\Kw_club\Helper;

require dirname(__DIR__) . '/preloads/autoloader.php';

$moduleDirName      = basename(dirname(__DIR__));
$moduleDirNameUpper = mb_strtoupper($moduleDirName);

/** @var Kw_club\Helper $helper */
$helper = Kw_club\Helper::getInstance();
$helper->loadLanguage('common');

$pathIcon32 = \Xmf\Module\Admin::menuIconPath('');
if (is_object($helper->getModule())) {
    $pathModIcon32 = $helper->getModule()->getInfo('modicons32');
}

//$adminmenu[$i]['title'] = _MI_TAD_ADMIN_HOME;
//$adminmenu[$i]['link']  = 'admin/index.php';
//$adminmenu[$i]['desc']  = _MI_TAD_ADMIN_HOME_DESC;
//$adminmenu[$i]['icon']  = 'assets/images/admin/home.png';
//
//$i++;
//$adminmenu[$i]['title'] = _MI_KWCLUB_SETUP_ADMIN;
//$adminmenu[$i]['link']  = 'admin/main.php';
//$adminmenu[$i]['desc']  = _MI_KWCLUB_SETUP_ADMIN;
//$adminmenu[$i]['icon']  = 'assets/images/admin/button.png';
//
//$i++;
//$adminmenu[$i]['title'] = _MI_TAD_ADMIN_ABOUT;
//$adminmenu[$i]['link']  = 'admin/about.php';
//$adminmenu[$i]['desc']  = _MI_TAD_ADMIN_ABOUT_DESC;
//$adminmenu[$i]['icon']  = 'assets/images/admin/about.png';

$adminmenu[] = [
    'title' => _MI_TAD_ADMIN_HOME,
    'desc'  => _MI_TAD_ADMIN_HOME_DESC,
    'link'  => 'admin/index.php',
    'icon'  => 'assets/images/admin/home.png',
];

$adminmenu[] = [
    'title' => _MI_KWCLUB_SETUP_ADMIN,
    'desc'  => _MI_KWCLUB_SETUP_ADMIN,
    'link'  => 'admin/main.php',
    'icon'  => 'assets/images/admin/button.png',
];

// $adminmenu[] = [
//     'title' =>_MI_KWCLUB_SETUP_ADMENU3,
//     'desc' => _MI_KWCLUB_SETUP_ADMIN,
//     'link'  => 'admin/items.php',
//     'icon'  => "{$pathIcon32}/content.png",
// ];

$adminmenu[] = [
    'title' => _MI_TAD_ADMIN_ABOUT,
    'desc'  => _MI_TAD_ADMIN_ABOUT_DESC,
    'link'  => 'admin/about.php',
    'icon'  => "{$pathIcon32}/about.png",
];
