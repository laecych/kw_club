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
include_once "function.php";
$modversion = array();

//---模組基本資訊---//
$modversion['name']        = _MI_KWCLUB_NAME;
$modversion['version']     = '1.0';
$modversion['description'] = _MI_KWCLUB_DESC;
$modversion['author']      = _MI_KWCLUB_AUTHOR;
$modversion['credits']     = _MI_KWCLUB_CREDITS;
$modversion['help']        = 'page=help';
$modversion['license']     = 'GPL see LICENSE';
$modversion['image']       = "images/logo.png";
$modversion['dirname']     = basename(__DIR__);

//---模組狀態資訊---//
$modversion['status_version']      = '1.0';
$modversion['release_date']        = '2018-04-17';
$modversion['module_website_url']  = 'http://localhost';
$modversion['module_website_name'] = _MI_KWCLUB_AUTHOR_WEB;
$modversion['module_status']       = 'release';
$modversion['author_website_url']  = 'http://localhost';
$modversion['author_website_name'] = _MI_KWCLUB_AUTHOR_WEB;
$modversion['min_php']             = '5.2';
$modversion['min_xoops']           = '2.5';

//---paypal資訊---//
$modversion['paypal']                  = array();
$modversion['paypal']['business']      = 'tad0616@gmail.com';
$modversion['paypal']['item_name']     = 'Donation :' . _MI_KWCLUB_AUTHOR;
$modversion['paypal']['amount']        = 0;
$modversion['paypal']['currency_code'] = 'USD';

//---安裝設定---//
$modversion['onInstall']   = "include/onInstall.php";
$modversion['onUpdate']    = "include/onUpdate.php";
$modversion['onUninstall'] = "include/onUninstall.php";

//---啟動後台管理界面選單---//
$modversion['system_menu'] = 1;

//---資料表架構---//
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
$modversion['tables'][1]        = "kw_club_cate";
$modversion['tables'][2]        = "kw_club_class";
$modversion['tables'][3]        = "kw_club_place";
$modversion['tables'][4]        = "kw_club_teacher";
$modversion['tables'][5]        = "kw_club_reg";
$modversion['tables'][6]        = "kw_club_info";

//---管理介面設定---//
$modversion['hasAdmin']   = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu']  = "admin/menu.php";

//---前台主選單設定---//
$modversion['hasMain'] = 1;
$i                     = 0;
$i++;
$modversion['sub'][$i]['name'] = _MI_KWCLUB_SMNAME2;
$modversion['sub'][$i]['url']  = "teacher.php";
$i++;
$modversion['sub'][$i]['name'] = _MI_KWCLUB_SMNAME3;
$modversion['sub'][$i]['url']  = "myclass.php";
$i++;
$modversion['sub'][$i]['name'] = _MI_KWCLUB_SMNAME4;
$modversion['sub'][$i]['url']  = "statistic.php";

//---樣板設定---//
$modversion['templates'] = array();
$i                       = 1;

$modversion['templates'][$i]['file']        = 'config.tpl';
$modversion['templates'][$i]['description'] = 'config.tpl';

$i++;
$modversion['templates'][$i]['file']        = 'register.tpl';
$modversion['templates'][$i]['description'] = 'register.tpl';

$i++;
$modversion['templates'][$i]['file']        = 'index.tpl';
$modversion['templates'][$i]['description'] = 'index.tpl';

$i++;
$modversion['templates'][$i]['file']        = 'main.tpl';
$modversion['templates'][$i]['description'] = 'main.tpl';

$i++;
$modversion['templates'][$i]['file']        = 'cate.tpl';
$modversion['templates'][$i]['description'] = 'cate.tpl for bootstrap3';

//---區塊設定---//
$i = 0;
$i++;
$modversion['blocks'][$i]['file']        = 'kw_club_show.php';
$modversion['blocks'][$i]['name']        = _MI_KW_CLUB_SHOW_BLOCK_NAME;
$modversion['blocks'][$i]['description'] = _MI_KW_CLUB_SHOW_BLOCK_DESC;
$modversion['blocks'][$i]['show_func']   = 'kw_club_show';
$modversion['blocks'][$i]['template']    = 'kw_club_show.tpl';

//---搜尋設定---//
$modversion['hasSearch']      = 1;
$modversion['search']['file'] = "include/search.php";
$modversion['search']['func'] = "kw_club_search";

//---偏好設定---//
$modversion['config'] = array();
$i                    = 0;
// $modversion['config'][$i]['name']        = 'kw_club_sn';
// $modversion['config'][$i]['title']       = '設定社團期數';
// $modversion['config'][$i]['description'] = '_MI_KW_CLUB_SHOW_NUM_DESC';
// $modversion['config'][$i]['formtype']    = 'select';
// $modversion['config'][$i]['valuetype']   = 'int';
// $modversion['config'][$i]['options']     = get_semester();
// $modversion['config'][$i]['default']     = '';
// $i++;

// $modversion['config'][$i]['name']        = 'kw_club_start_reg';
// $modversion['config'][$i]['title']       = '_MI_KW_CLUB_START_DATE';
// $modversion['config'][$i]['description'] = '_MI_KW_CLUB_START_DATE_DESC';
// $modversion['config'][$i]['formtype']    = 'text';
// $modversion['config'][$i]['valuetype']   = 'datetime';
// $modversion['config'][$i]['options']     = "";
// $modversion['config'][$i]['default']     = Date("Y-m-d H:m:s");
// $i++;
// $modversion['config'][$i]['name']         = 'kw_club_end_reg';
// $modversion['config'][$i]['title']        = '_MI_KW_CLUB_START_DATE';
// $modv8ersion['config'][$i]['description'] = '_MI_KW_CLUB_START_DATE_DESC';
// $modversion['config'][$i]['formtype']     = 'text';
// $modversion['config'][$i]['valuetype']    = 'datetime';
// $modversion['config'][$i]['options']      = "";
// $modversion['config'][$i]['default']      = Date("Y-m-d H:m:s");
// $i++;
$modversion['config'][$i]['name']        = 'show_num';
$modversion['config'][$i]['title']       = '_MI_KW_CLUB_SHOW_NUM';
$modversion['config'][$i]['description'] = '_MI_KW_CLUB_SHOW_NUM_DESC';
$modversion['config'][$i]['formtype']    = 'select';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['options']     = array('10篇' => 10, '15篇' => 15, '20篇' => 20, '25篇' => 25, '30篇' => 30, '35篇' => 35, '40篇' => 40, '45篇' => 45, '50篇' => 50);
$modversion['config'][$i]['default']     = 30;
$i++;
