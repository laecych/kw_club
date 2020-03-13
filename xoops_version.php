<?php

/**
 * Kw Club module
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright  The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license    http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package    Kw Club
 * @since      2.5
 * @author     kawaki
 * @version    $Id $
 **/

//require_once __DIR__ . '/function.php';

$moduleDirName      = basename(__DIR__);
$moduleDirNameUpper = mb_strtoupper($moduleDirName);

// ------------------- Informations ------------------- //
$modversion = [
    'version'             => 1.6,
    'module_status'       => 'release',
    'release_date'        => '2019/09/06',
    'name'                => _MI_KWCLUB_NAME,
    'description'         => _MI_KWCLUB_DESC,
    'official'            => 0,
    //1 indicates official XOOPS module supported by XOOPS Dev Team, 0 means 3rd party supported
    'author'              => _MI_KWCLUB_AUTHOR,
    'credits'             => _MI_KWCLUB_CREDITS . ', XOOPS Development Team',
    'author_mail'         => 'tad0616@gmail.com',
    'author_website_url'  => 'https://xoops.org',
    'author_website_name' => _MI_KWCLUB_AUTHOR_WEB,
    'license'             => 'GPL 2.0 or later',
    'license_url'         => 'www.gnu.org/licenses/gpl-2.0.html/',
    'help'                => 'page=help',
    // ------------------- Folders & Files -------------------
    'release_info'        => 'Changelog',
    'release_file'        => XOOPS_URL . "/modules/$moduleDirName/docs/changelog.txt",

    'manual'              => 'link to manual file',
    'manual_file'         => XOOPS_URL . "/modules/$moduleDirName/docs/install.txt",
    // images
    'image'               => 'assets/images/logoModule.png',
    'iconsmall'           => 'assets/images/iconsmall.png',
    'iconbig'             => 'assets/images/iconbig.png',
    'dirname'             => $moduleDirName,
    // Local path icons
    'modicons16'          => 'assets/images/icons/16',
    'modicons32'          => 'assets/images/icons/32',
    //About
    'demo_site_url'       => 'https://xoops.org',
    'demo_site_name'      => 'XOOPS Demo Site',
    'support_url'         => 'https://xoops.org/modules/newbb/viewforum.php?forum=28/',
    'support_name'        => 'Support Forum',
    'submit_bug'          => 'https://github.com/XoopsModules25x/' . $moduleDirName . '/issues',
    'module_website_url'  => 'www.xoops.org',
    'module_website_name' => 'XOOPS Project',
    // ------------------- Min Requirements -------------------
    'min_php'             => '5.6',
    'min_xoops'           => '2.5.9',
    'min_admin'           => '1.2',
    'min_db'              => ['mysql' => '5.5'],
    // ------------------- Admin Menu -------------------
    'system_menu'         => 1,
    'hasAdmin'            => 1,
    'adminindex'          => 'admin/index.php',
    'adminmenu'           => 'admin/menu.php',
    // ------------------- Main Menu -------------------
    'hasMain'             => 1,
    'sub'                 => [
        [
            'name' => _MI_KWCLUB_SMNAME2,
            'url'  => 'index.php?op=teacher',
        ],
        [
            'name' => _MI_KWCLUB_SMNAME3,
            'url'  => 'index.php?op=myclass',
        ],
        //        [
        //            'name' => _MI_KWCLUB_SMNAME4,
        //            'url' => 'index.php?op=statistic',
        //        ],
    ],
    // ------------------- Install/Update -------------------
    'onInstall'           => 'include/onInstall.php',
    'onUpdate'            => 'include/onUpdate.php',
    'onUninstall'         => 'include/onUninstall.php',
    // -------------------  PayPal ---------------------------
    'paypal'              => [
        'business'      => 'tad0616@gmail.com',
        'item_name'     => 'Donation : ' . _MI_KWCLUB_AUTHOR,
        'amount'        => 0,
        'currency_code' => 'USD',
    ],
    // ------------------- Search ---------------------------
    'hasSearch'           => 1,
    'search'              => [
        'file' => 'include/search.inc.php',
        'func' => 'kw_club_search',
    ],
];

//---資料表架構---//
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables']           = [
    $moduleDirName . '_' . 'info',
    $moduleDirName . '_' . 'cate',
    $moduleDirName . '_' . 'place',
    $moduleDirName . '_' . 'teacher',
    $moduleDirName . '_' . 'class',
    $moduleDirName . '_' . 'reg',
    $moduleDirName . '_' . 'files_center',
];

// ------------------- Help files ------------------- //
$modversion['helpsection'] = [
    ['name' => _MI_KWCLUB_OVERVIEW, 'link' => 'page=help'],
    ['name' => _MI_KWCLUB_DISCLAIMER, 'link' => 'page=disclaimer'],
    ['name' => _MI_KWCLUB_LICENSE, 'link' => 'page=license'],
    ['name' => _MI_KWCLUB_SUPPORT, 'link' => 'page=support'],
];

//---樣板設定---//

$modversion['templates'] = [
    ['file' => 'kw_club_config.tpl', 'description' => 'kw_club_config.tpl'],
    ['file' => 'kw_club_register.tpl', 'description' => 'kw_club_register.tpl'],
    ['file' => 'kw_club_index.tpl', 'description' => 'kw_club_index.tpl'],
    ['file' => 'kw_club_club.tpl', 'description' => 'kw_club_club.tpl'],
    ['file' => 'kw_club_cate.tpl', 'description' => 'kw_club_cate.tpl'],
    ['file' => 'kw_club_adm_main.tpl', 'description' => 'kw_club_adm_main.tpl'],
];

$modversion['blocks'][] = [
    'file'        => 'kw_club_show.php',
    'name'        => _MI_KWCLUB_SHOW_BLOCK_NAME,
    'description' => _MI_KWCLUB_SHOW_BLOCK_DESC,
    'show_func'   => 'kw_club_show',
    'template'    => 'kw_club_show.tpl',
];

//---偏好設定---//

$modversion['config'][] = [
    'name'        => 'school_grade',
    'title'       => '_MI_KWCLUB_SCHOOL_GRADE',
    'description' => '_MI_KWCLUB_SCHOOL_GRADE_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'default'     => [_MI_KWCLUB_SCHOOL_GV0, _MI_KWCLUB_SCHOOL_GV1, _MI_KWCLUB_SCHOOL_GV2, _MI_KWCLUB_SCHOOL_GV3, _MI_KWCLUB_SCHOOL_GV4, _MI_KWCLUB_SCHOOL_GV5, _MI_KWCLUB_SCHOOL_GV6],
    'options'     => [
        _MI_KWCLUB_SCHOOL_GK0  => _MI_KWCLUB_SCHOOL_GV0,
        _MI_KWCLUB_SCHOOL_GK1  => _MI_KWCLUB_SCHOOL_GV1,
        _MI_KWCLUB_SCHOOL_GK2  => _MI_KWCLUB_SCHOOL_GV2,
        _MI_KWCLUB_SCHOOL_GK3  => _MI_KWCLUB_SCHOOL_GV3,
        _MI_KWCLUB_SCHOOL_GK4  => _MI_KWCLUB_SCHOOL_GV4,
        _MI_KWCLUB_SCHOOL_GK5  => _MI_KWCLUB_SCHOOL_GV5,
        _MI_KWCLUB_SCHOOL_GK6  => _MI_KWCLUB_SCHOOL_GV6,
        _MI_KWCLUB_SCHOOL_GK7  => _MI_KWCLUB_SCHOOL_GV7,
        _MI_KWCLUB_SCHOOL_GK8  => _MI_KWCLUB_SCHOOL_GV8,
        _MI_KWCLUB_SCHOOL_GK9  => _MI_KWCLUB_SCHOOL_GV9,
        _MI_KWCLUB_SCHOOL_GK10 => _MI_KWCLUB_SCHOOL_GV10,
        _MI_KWCLUB_SCHOOL_GK11 => _MI_KWCLUB_SCHOOL_GV11,
        _MI_KWCLUB_SCHOOL_GK12 => _MI_KWCLUB_SCHOOL_GV12,
    ],
];

$modversion['config'][] = [
    'name'        => 'school_class',
    'title'       => '_MI_KWCLUB_SCHOOL_CLASS',
    'description' => '_MI_KWCLUB_SCHOOL_CLASS_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => _MI_KWCLUB_SCHOOL_CLASS_DEFAULT,
];

/**
 * Make Sample button visible?
 */
// $modversion['config'][] = [
//     'name'        => 'displaySampleButton',
//     'title'       => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLE_BUTTON',
//     'description' => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_SAMPLE_BUTTON_DESC',
//     'formtype'    => 'yesno',
//     'valuetype'   => 'int',
//     'default'     => 1,
// ];

// /**
//  * Show Developer Tools?
//  */
// $modversion['config'][] = [
//     'name'        => 'displayDeveloperTools',
//     'title'       => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_DEV_TOOLS',
//     'description' => 'CO_' . $moduleDirNameUpper . '_' . 'SHOW_DEV_TOOLS_DESC',
//     'formtype'    => 'yesno',
//     'valuetype'   => 'int',
//     'default'     => 0,
// ];
