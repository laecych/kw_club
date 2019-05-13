<?php

if (!isset($_SESSION['language']) && empty($_REQUEST['language'])) {
    $_SESSION['language'] = 'tchinese_utf8';
} elseif (isset($_SESSION['language']) && !empty($_REQUEST['language'])) {
    $_SESSION['language'] = $_REQUEST['language'];
}

if ('english' === $_SESSION['language']) {
    require_once XOOPS_ROOT_PATH . '/modules/kw_club/language/english/modinfo.php';
}
xoops_loadLanguage('modinfo_common', 'tadtools');

// define("_MI_XXX_ADMENU1", "主管理頁");
// define("_MI_XXX_ADMENU1_DESC", "後台主管理頁");

define('_MI_KWCLUB_NAME', '社團報名系統');
define('_MI_KWCLUB_AUTHOR', '社團報名系統');
define('_MI_KWCLUB_CREDITS', '');
define('_MI_KWCLUB_DESC', '國小社團報名系統');
define('_MI_KWCLUB_AUTHOR_WEB', 'https://github.com/laecych');

define('_MI_KWCLUB_SMNAME2', '教師簡介');
define('_MI_KWCLUB_SMNAME3', '我的社團');
define('_MI_KWCLUB_SMNAME4', '報名統計');

define('_MI_KWCLUB_SHOW_BLOCK_NAME', '社團報名系統區塊');
define('_MI_KWCLUB_SHOW_BLOCK_DESC', '社團報名系統區塊區塊 (kw_club_show)');

define('_MI_KWCLUB_ADMIN_GROUP', '社團管理');
define('_MI_KWCLUB_TEACHER_GROUP', '社團老師');
define('_MI_KWCLUB_GROUP_NOTE', '：為社團報名模組用，勿刪，勿修改');
define('_MI_KWCLUB_SETUP_ADMIN', '社團管理設定');
define('_MI_KWCLUB_SETUP_TEACHER', '社團老師設定');
define('_MI_KWCLUB_SCHOOL_GRADE', '年級設定');
define('_MI_KWCLUB_SCHOOL_GRADE_DESC', '設定學校可報名的年級');
define('_MI_KWCLUB_SCHOOL_GK0', '幼兒園');
define('_MI_KWCLUB_SCHOOL_GK1', '一年級');
define('_MI_KWCLUB_SCHOOL_GK2', '二年級');
define('_MI_KWCLUB_SCHOOL_GK3', '三年級');
define('_MI_KWCLUB_SCHOOL_GK4', '四年級');
define('_MI_KWCLUB_SCHOOL_GK5', '五年級');
define('_MI_KWCLUB_SCHOOL_GK6', '六年級');
define('_MI_KWCLUB_SCHOOL_GK7', '七年級');
define('_MI_KWCLUB_SCHOOL_GK8', '八年級');
define('_MI_KWCLUB_SCHOOL_GK9', '九年級');
define('_MI_KWCLUB_SCHOOL_GK10', '十年級');
define('_MI_KWCLUB_SCHOOL_GK11', '十一年級');
define('_MI_KWCLUB_SCHOOL_GK12', '十二年級');

define('_MI_KWCLUB_SCHOOL_GV0', '幼');
define('_MI_KWCLUB_SCHOOL_GV1', '一');
define('_MI_KWCLUB_SCHOOL_GV2', '二');
define('_MI_KWCLUB_SCHOOL_GV3', '三');
define('_MI_KWCLUB_SCHOOL_GV4', '四');
define('_MI_KWCLUB_SCHOOL_GV5', '五');
define('_MI_KWCLUB_SCHOOL_GV6', '六');
define('_MI_KWCLUB_SCHOOL_GV7', '七');
define('_MI_KWCLUB_SCHOOL_GV8', '八');
define('_MI_KWCLUB_SCHOOL_GV9', '九');
define('_MI_KWCLUB_SCHOOL_GV10', '十');
define('_MI_KWCLUB_SCHOOL_GV11', '十一');
define('_MI_KWCLUB_SCHOOL_GV12', '十二');

define('_MI_KWCLUB_SCHOOL_CLASS', '班級設定');
define('_MI_KWCLUB_SCHOOL_CLASS_DESC', '設定學校可報名的班級名稱（請用 ; 隔開）');
define('_MI_KWCLUB_SCHOOL_CLASS_DEFAULT', '1班;2班;3班;4班');

//Help
define('_MI_KWCLUB_DIRNAME', basename(dirname(dirname(__DIR__))));
define('_MI_KWCLUB_HELP_HEADER', __DIR__ . '/help/helpheader.tpl');
define('_MI_KWCLUB_BACK_2_ADMIN', 'Back to Administration of ');
define('_MI_KWCLUB_OVERVIEW', 'Overview');
//help multi-page
define('_MI_KWCLUB_DISCLAIMER', 'Disclaimer');
define('_MI_KWCLUB_LICENSE', 'License');
define('_MI_KWCLUB_SUPPORT', 'Support');
