<?php

/*-----------引入檔案區--------------*/
// $isAdmin                      = true;
$xoopsOption['template_main'] = 'adm_main.tpl';
include_once "header.php";
include_once "../function.php";

/*-----------執行動作判斷區----------*/
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op       = system_CleanVars($_REQUEST, 'op', '', 'string');
$class_id = system_CleanVars($_REQUEST, 'class_id', '', 'int');
$reg_sn   = system_CleanVars($_REQUEST, 'reg_sn', '', 'int');

switch ($op) {

    //新增資料
    case "insert_reg":
        $reg_sn = insert_reg();
        header("location: {$_SERVER['PHP_SELF']}?reg_sn=$reg_sn");
        exit;

    //更新資料
    case "update_reg":
        update_reg($reg_sn);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    case "delete_reg":
        delete_reg();
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    // case "reg_form":
    //     reg_form($reg_sn);
    //     break;

    default:
        if (empty($reg_sn)) {
            reg_list();
            //$main .= kw_club_reg_form($reg_sn);
        } else {
            reg_list($reg_sn);
        }
        break;

        /*---判斷動作請貼在上方---*/
}

/*-----------功能函數區--------------*/

//新增資料到kw_club_reg中
function insert_reg()
{
    global $xoopsDB, $xoopsUser, $isAdmin;
    if (!$_SESSION['isclubAdmin']) {
        redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
    }

    //XOOPS表單安全檢查
    if (!$GLOBALS['xoopsSecurity']->check()) {
        $error = implode("<br />", $GLOBALS['xoopsSecurity']->getErrors());
        redirect_header($_SERVER['PHP_SELF'], 3, $error);
    }

    $myts = MyTextSanitizer::getInstance();

    $reg_sn       = $_POST['reg_sn'];
    $reg_year     = $_POST['reg_year'];
    $class_id     = $_POST['class_id'];
    $class_title  = $_POST['class_title'];
    $reg_uid      = $_POST['reg_uid'];
    $reg_name     = $myts->addSlashes($_POST['reg_name']);
    $reg_grade    = $myts->addSlashes($_POST['reg_grade']);
    $reg_class    = $myts->addSlashes($_POST['reg_class']);
    $reg_datetime = $_POST['reg_datetime'];
    $reg_isreg    = $_POST['reg_isreg'];
    $reg_isfee    = $_POST['reg_isfee'];
    $reg_ip       = $_POST['reg_ip'];

    $sql = "insert into `" . $xoopsDB->prefix("kw_club_reg") . "` (
        `reg_year`,
        `class_id`,
        `class_title`,
        `reg_uid`,
        `reg_name`,
        `reg_grade`,
        `reg_class`,
        `reg_datetime`,
        `reg_isreg`,
        `reg_isfee`,
        `reg_ip`
    ) values(
        '{$reg_year}',
        '{$class_id}',
        '{$class_title}',
        '{$reg_uid}',
        '{$reg_name}',
        '{$reg_grade}',
        '{$reg_class}',
        '{$reg_datetime}',
        '{$reg_isreg}',
        '{$reg_isfee}',
        '{$reg_ip}'
    )";
    $xoopsDB->query($sql) or web_error($sql);

    //取得最後新增資料的流水編號
    $reg_sn = $xoopsDB->getInsertId();

    return $reg_sn;
}

//更新kw_club_reg某一筆資料
function update_reg($reg_sn = '')
{
    global $xoopsDB, $isAdmin, $xoopsUser;
    if (!$_SESSION['isclubAdmin']) {
        redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
    }

    //XOOPS表單安全檢查
    // if (!$GLOBALS['xoopsSecurity']->check()) {
    //     $error = implode("<br />", $GLOBALS['xoopsSecurity']->getErrors());
    //     redirect_header($_SERVER['PHP_SELF'], 3, $error);
    // }

    $myts = MyTextSanitizer::getInstance();

    $reg_sn      = $_POST['reg_sn'];
    $reg_year    = $_POST['reg_year'];
    $class_id    = $_POST['class_id'];
    $class_title = $myts->addSlashes($_POST['class_title']);
    $reg_uid     = $myts->addSlashes($_POST['reg_uid']);
    $reg_name    = $myts->addSlashes($_POST['reg_name']);
    $reg_grade   = $myts->addSlashes($_POST['reg_grade']);
    $reg_class   = $myts->addSlashes($_POST['reg_class']);
    $reg_isreg   = $_POST['reg_isreg'];
    $reg_isfee   = $_POST['reg_isfee'];

    $sql = "update `" . $xoopsDB->prefix("kw_club_reg") . "` set
       `reg_year` = '{$reg_year}',
       `class_id` = '{$class_id}',
       `class_title` = '{$class_title}',
       `reg_uid` = '{$reg_uid}',
       `reg_name` = '{$reg_name}',
       `reg_grade` = '{$reg_grade}',
       `reg_class` = '{$reg_class}',
       `reg_isreg` = '{$reg_isreg}',
       `reg_isfee` = '{$reg_isfee}'
    where `reg_sn` = '$reg_sn'";
    $xoopsDB->queryF($sql) or web_error($sql);

    // return $reg_sn;
}

// //刪除kw_club_reg某筆資料資料
// function delete_reg($reg_sn = '')
// {
//     global $xoopsDB;
//     if (!$_SESSION['isclubAdmin']) {
//         redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
//     }

//     if (empty($reg_sn)) {
//         return;
//     }

//     $sql = "delete from `" . $xoopsDB->prefix("kw_club_reg") . "`
//     where `reg_sn` = '{$reg_sn}'";
//     $xoopsDB->queryF($sql) or web_error($sql);

// }

//以流水號秀出某筆kw_club_reg資料內容
// function reg_show($reg_sn = '')
// {
//     global $xoopsDB, $xoopsTpl, $isAdmin;

//     if (empty($reg_sn)) {
//         return;
//     } else {
//         $reg_sn = intval($reg_sn);
//     }

//     $myts = MyTextSanitizer::getInstance();

//     $sql = "select * from `" . $xoopsDB->prefix("kw_club_reg") . "`
//     where `reg_sn` = '{$reg_sn}' ";
//     $result = $xoopsDB->query($sql) or web_error($sql);
//     $all    = $xoopsDB->fetchArray($result);

//     //以下會產生這些變數： $reg_sn, $reg_year, $class_id, $class_title, $reg_uid, $reg_name, $reg_grade, $reg_class, $reg_datetime, $reg_isreg, $reg_isfee, $reg_ip
//     foreach ($all as $k => $v) {
//         $$k = $v;
//     }

//     //取得分類資料()
//     $class_arr = get_class($class_id);

//     //過濾讀出的變數值
//     $reg_name  = $myts->htmlSpecialChars($reg_name);
//     $reg_grade = $myts->htmlSpecialChars($reg_grade);
//     $reg_class = $myts->htmlSpecialChars($reg_class);

//     $xoopsTpl->assign('reg_sn', $reg_sn);
//     $xoopsTpl->assign('reg_year', $reg_year);
//     $xoopsTpl->assign('class_id', $class_id);
//     $xoopsTpl->assign('class_id_title', $_arr['']);
//     $xoopsTpl->assign('class_title', $class_title);
//     $xoopsTpl->assign('class_title_title', $_arr['']);
//     $xoopsTpl->assign('reg_uid', $reg_uid);
//     $xoopsTpl->assign('reg_name', $reg_name);
//     $xoopsTpl->assign('reg_grade', $reg_grade);
//     $xoopsTpl->assign('reg_class', $reg_class);
//     $xoopsTpl->assign('reg_datetime', $reg_datetime);
//     $xoopsTpl->assign('reg_isreg', $reg_isreg);
//     $xoopsTpl->assign('reg_isfee', $reg_isfee);
//     $xoopsTpl->assign('reg_ip', $reg_ip);

//     if (!file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/sweet_alert.php")) {
//         redirect_header("index.php", 3, _MA_NEED_TADTOOLS);
//     }

//     include_once XOOPS_ROOT_PATH . "/modules/tadtools/sweet_alert.php";
//     $sweet_alert_obj         = new sweet_alert();
//     $delete_kw_club_reg_func = $sweet_alert_obj->render('delete_kw_club_reg_func', "{$_SERVER['PHP_SELF']}?op=delete_kw_club_reg&reg_sn=", "reg_sn");
//     $xoopsTpl->assign('delete_kw_club_reg_func', $delete_kw_club_reg_func);

//     $xoopsTpl->assign('action', $_SERVER['PHP_SELF']);
//     $xoopsTpl->assign('now_op', 'show_one_kw_club_reg');
// }

//列出所有kw_club_reg資料
function reg_list()
{
    global $xoopsDB, $xoopsTpl, $xoopsModuleConfig;

    $review = system_CleanVars($_REQUEST, 'review', '', 'string');
    $year   = system_CleanVars($_REQUEST, 'year', '0', 'int');
    $reg_sn = system_CleanVars($_REQUEST, 'reg_sn', '0', 'int');
    // $review = 'reg_sn';

    //報名年度
    if (empty($year) && isset($_SESSION['club_year'])) {
        $reg_year = $_SESSION['club_year'];
    } else {
        $reg_year = $year;
    }
    if (empty($review)) {$review = 'reg_sn';}

    //取得社團期別
    $arr_year = get_all_year();
    $xoopsTpl->assign('arr_year', $arr_year);

    $xoopsTpl->assign('review', $review);
    $xoopsTpl->assign('year', $reg_year);

    if (!empty($reg_sn)) {
        $arr_class = get_class_all();
        $xoopsTpl->assign('arr_class', $arr_class);
    }

    $myts = MyTextSanitizer::getInstance();
    if ($review == 'grade') {
        $sql = "select * from `" . $xoopsDB->prefix("kw_club_reg") . "` where `reg_year`={$reg_year} ORDER BY `reg_grade`, `reg_class`";
    } else {
        $sql = "select * from `" . $xoopsDB->prefix("kw_club_reg") . "` where `reg_year`={$reg_year} ORDER BY {$review} DESC";
    }

    //getPageBar($原sql語法, 每頁顯示幾筆資料, 最多顯示幾個頁數選項);
    $PageBar = getPageBar($sql, $xoopsModuleConfig['show_num'], 10);
    $bar     = $PageBar['bar'];
    $sql     = $PageBar['sql'];
    $total   = $PageBar['total'];

    $result = $xoopsDB->query($sql) or web_error($sql);

    //取得分類所有資料陣列
    $class_arr = get_class_all();

    $all_content = [];
    $i           = 0;
    while ($all = $xoopsDB->fetchArray($result)) {

        $all_content[$i] = $all;
        $i++;
    }

    //刪除確認的JS
    if (!file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/sweet_alert.php")) {
        redirect_header("index.php", 3, _MD_NEED_TADTOOLS);
    }
    include_once XOOPS_ROOT_PATH . "/modules/tadtools/sweet_alert.php";
    $sweet_alert_obj         = new sweet_alert();
    $delete_kw_club_reg_func = $sweet_alert_obj->render('delete_reg_func',
        "{$_SERVER['PHP_SELF']}?op=delete_reg&reg_sn=", "reg_sn");
    $xoopsTpl->assign('delete_kw_club_reg_func', $delete_kw_club_reg_func);

    $xoopsTpl->assign('bar', $bar);
    $xoopsTpl->assign('total', $total);
    $xoopsTpl->assign('reg_sn', $reg_sn);
    $xoopsTpl->assign('action', $_SERVER['PHP_SELF']);
    $xoopsTpl->assign('isAdmin', $_SESSION['isclubAdmin']);
    $xoopsTpl->assign('all_content', $all_content);
    $xoopsTpl->assign('op', 'reg_list');
    $xoopsTpl->assign('action', $_SERVER['PHP_SELF']);
}

/*-----------秀出結果區--------------*/
// $xoopsTpl->assign("isAdmin", true);
$xoTheme->addStylesheet(XOOPS_URL . '/modules/tadtools/css/xoops_adm3.css');
include_once 'footer.php';
