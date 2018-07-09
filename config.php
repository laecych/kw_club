<?php

include_once "header.php";
$xoopsOption['template_main'] = "config.tpl";
include_once XOOPS_ROOT_PATH . "/header.php";

/*-----------執行動作判斷區----------*/
include_once XOOPS_ROOT_PATH . '/class/xoopsform/grouppermform.php';
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op      = system_CleanVars($_REQUEST, 'op', '', 'string');
$kw_club = [];

//check power
if (!isset($_SESSION['isclubAdmin'])) {
    echo "<script language='JavaScript'>alert('您沒有權限!');window.location.href='index.php'; </script>";
    // redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
    exit();
}
//debug

switch ($op) {

    //更新資料
    case "set_config":
        set_config();
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    case "update_config":
        update_config();
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    case "reset_config":
        reset_config();
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    default:
        $arr_num = [];
        for ($i = 0; $i <= 10; $i++) {
            $arr_num[$i] = $i;
        }
        $xoopsTpl->assign('arr_num', $arr_num);
        club_form();

        break;

}

function club_form()
{
    global $xoopsDB, $xoopsTpl, $xoopsUser;

    //引入日期
    include_once XOOPS_ROOT_PATH . "/modules/tadtools/cal.php";
    $cal = new My97DatePicker();
    $cal->render();

    // if (!$_SESSION['isclubAdmin']) {
    //     redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
    // }

    //尚未設定社團期別
    if (!file_exists(XOOPS_ROOT_PATH . "/uploads/kw_club/kw_club_config.json")) {
        $arr_semester = get_semester();
        $xoopsTpl->assign('arr_semester', $arr_semester);
    } else {
        //已設定
        $json    = file_get_contents(XOOPS_URL . "/uploads/kw_club/kw_club_config.json");
        $kw_club = json_decode($json, true);
        $xoopsTpl->assign('semester', $kw_club['0']);
        $xoopsTpl->assign('start_reg', $kw_club['1']);
        $xoopsTpl->assign('end_reg', $kw_club['2']);
        $xoopsTpl->assign('isfree_reg', $kw_club['3']);
        $xoopsTpl->assign('backup_num', $kw_club['4']);
        // $xoopsTpl->assign('pickdate', $pickdate);

        //套用formValidator驗證機制
        if (!file_exists(TADTOOLS_PATH . "/formValidator.php")) {
            redirect_header("index.php", 3, _TAD_NEED_TADTOOLS);
        }
        include_once TADTOOLS_PATH . "/formValidator.php";
        $formValidator = new formValidator("#classform", true);
        $formValidator->render();

        //刪除確認的JS
        if (!file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/sweet_alert.php")) {
            redirect_header("index.php", 3, _MD_NEED_TADTOOLS);
        }
        include_once XOOPS_ROOT_PATH . "/modules/tadtools/sweet_alert.php";
        $sweet_alert_obj  = new sweet_alert();
        $delete_club_func = $sweet_alert_obj->render('delete_club_func', "{$_SERVER['PHP_SELF']}?op=reset_config&id=", 'id');
        $xoopsTpl->assign('delete_club_func', $delete_club_func);

    }

}

function set_config()
{
    global $xoopsDB, $xoopsTpl, $xoopsUser;

    if (!$_SESSION['isclubAdmin']) {
        redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
    }

    $uid          = $xoopsUser->uid();
    $kw_club_year = system_CleanVars($_REQUEST, 'kw_club_year', '', 'int');
    $start_reg    = system_CleanVars($_REQUEST, 'start_reg', '', 'datetime');
    $end_reg      = system_CleanVars($_REQUEST, 'end_reg', '', 'datetime');
    $isfree_reg   = system_CleanVars($_REQUEST, 'isfree_reg', '', '');
    $backup_num   = system_CleanVars($_REQUEST, 'backup_num', '', 'int');
    //db
    $myts         = MyTextSanitizer::getInstance();
    $kw_club_year = $myts->addSlashes($kw_club_year);
    $isfree_reg   = $myts->addSlashes($isfree_reg);
    $sql          = "select `club_year` from `" . $xoopsDB->prefix('kw_club_info') . "` where `club_year` = {$kw_club_year}";
    $result       = $xoopsDB->query($sql) or web_error($sql);

    //check club_year isreset
    if (list($club_year) = $xoopsDB->fetchRow($result)) {
        $sql = "update  `" . $xoopsDB->prefix('kw_club_info') . "` set " . "
        `club_start_date`  =  '{$start_reg}',
        `club_end_date` =  '{$end_reg}',
        `club_uid` = '{$uid}',
        `club_datetime` = NOW(),
        `club_enable` = '1'";
        $xoopsDB->query($sql) or web_error($sql);
    } else {
        //new
        $sql = "insert into `" . $xoopsDB->prefix('kw_club_info') . "` (
            `club_year`,
            `club_start_date`,
            `club_end_date`,
            `club_isfree`,
            `club_backup_num`,
            `club_uid`,
            `club_datetime`,
            `club_enable`
            ) values(
            '{$kw_club_year}',
            '{$start_reg}',
            '{$end_reg}',
            '{$isfree_reg}',
            '{$backup_num}',
            '{$uid}',
            NOW(),
            '1'
            )";
        $xoopsDB->query($sql) or web_error($sql);
    }
    //json
    $kw_club = array('0' => $kw_club_year, '1' => $start_reg, '2' => $end_reg, '3' => $isfree_reg, '4' => $backup_num);
    $json    = json_encode($kw_club, JSON_UNESCAPED_UNICODE);
    file_put_contents(XOOPS_ROOT_PATH . "/uploads/kw_club/kw_club_config.json", $json);

    //設定相關變數
    $_SESSION['club_year']       = $kw_club_year;
    $_SESSION['club_start_date'] = $start_reg;
    $_SESSION['club_end_date']   = $end_reg;
    $_SESSION['club_isfreereg']  = $isfree_reg;
    $_SESSION['club_backup_num'] = $backup_num;

}

function update_config()
{
    global $xoopsDB, $xoopsTpl, $xoopsUser;

    if (!$_SESSION['isclubAdmin']) {
        redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
    }
    //update json
    $json    = file_get_contents(XOOPS_URL . "/uploads/kw_club/kw_club_config.json");
    $kw_club = json_decode($json, true);

    $start_reg = system_CleanVars($_REQUEST, 'start_reg', '', 'datetime');
    $end_reg   = system_CleanVars($_REQUEST, 'end_reg', '', 'datetime');
    $kw_club   = array('0' => $kw_club['0'], '1' => $start_reg, '2' => $end_reg, '3' => $kw_club['3'], '4' => $kw_club['4']);
    $json      = json_encode($kw_club, JSON_UNESCAPED_UNICODE);
    file_put_contents(XOOPS_ROOT_PATH . "/uploads/kw_club/kw_club_config.json", $json);

    //update db
    $uid = $xoopsUser->uid();
    $sql = "update  `" . $xoopsDB->prefix('kw_club_info') . "` set " . "
    `club_start_date`  =  '{$start_reg}',
    `club_end_date` =  '{$end_reg}',
    `club_uid` = '{$uid}',
    `club_datetime` = NOW()";
    $xoopsDB->query($sql) or web_error($sql);

    //update session
    $_SESSION['club_start_date'] = $start_reg;
    $_SESSION['club_end_date']   = $end_reg;

}

//重設期別
function reset_config()
{
    global $xoopsDB, $xoopsTpl, $xoopsUser;

    if (!$_SESSION['isclubAdmin']) {
        redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
    }
    if (!isset($_SESSION['club_year'])) {
        echo "<script language='JavaScript'>alert('尚未設定社團期別，請先設定社團資料!');window.location.href='config.php'; </script>";
        exit();
    } else {
        $year = $_SESSION['club_year'];
    }

    // $sql = "delete from `" . $xoopsDB->prefix('kw_club_info') . "`
    // where `" . $type . "club_year` = '{$year}'";
    $sql = "update  `" . $xoopsDB->prefix('kw_club_info') . "` set " . "
    `club_enable`  =  '0',
    `club_uid` = '{$uid}',
    `club_datetime` = NOW()";
    $xoopsDB->queryF($sql) or web_error($sql);

    if (file_exists(XOOPS_ROOT_PATH . "/uploads/kw_club/kw_club_config.json")) {
        unlink(XOOPS_ROOT_PATH . "/uploads/kw_club/kw_club_config.json");
    }

}

//權限項目陣列（編號超級重要！設定後，以後切勿隨便亂改。）
$item_list = array(
    '1' => "新增社團",
    '2' => "管理社團",
);

$mid       = $xoopsModule->mid();
$perm_name = $xoopsModule->dirname();
$formi     = new XoopsGroupPermForm('細部權限設定', $mid, $perm_name, '請勾選欲開放給群組使用的權限：<br>');
foreach ($item_list as $item_id => $item_name) {
    $formi->addItem($item_id, $item_name);
}
echo $formi->render();

/*-----------秀出結果區--------------*/
include_once XOOPS_ROOT_PATH . '/footer.php';
