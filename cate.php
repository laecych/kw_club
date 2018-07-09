<?php
/*-----------引入檔案區--------------*/
include_once "header.php";
$xoopsOption['template_main'] = "cate.tpl";
include_once XOOPS_ROOT_PATH . "/header.php";

/*-----------執行動作判斷區----------*/
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');

if (!isset($_REQUEST['type'])) {
    header("location:" . XOOPS_ROOT_PATH . "/modules/kw_club/index.php");
}
$type    = system_CleanVars($_REQUEST, 'type', '', 'string'); //database name
$op      = system_CleanVars($_REQUEST, 'op', '', 'string');
$cate_id = system_CleanVars($_REQUEST, 'cate_id', '', 'int');
$table   = "kw_club_" . $type; //database name

//check power
if (!isset($_SESSION['isclubAdmin']) ) {
    echo "<script language='JavaScript'>alert('您沒有權限!');window.location.href='index.php'; </script>";
     // redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
    exit();
}


switch ($op) {

    //新增資料
    case "insert_cate":
        insert_cate();
        header("location: {$_SERVER['PHP_SELF']}?type=$type&op=cate_form");
        exit;

    //更新資料
    case "update_cate":
        update_cate($cate_id);
        header("location: {$_SERVER['PHP_SELF']}?type=$type&op=cate_form");
        exit;

    case "delete_cate":
        delete_cate($cate_id);
        header("location: {$_SERVER['PHP_SELF']}?type=$type&op=cate_form");
        exit;

    case "cate_form":
        cate_form($cate_id);
        break;

    default:
        cate_list($type, $table);
       
        break;

}

/*-----------功能函數區--------------*/

//kw_club_cate編輯表單
function cate_form($cate_id = '')
{
    global $xoopsDB, $xoopsTpl, $xoopsUser, $type, $table;

    // if (!power_chk("", 2) && !power_chk("", 1)) {
    //     echo "<script language='JavaScript'>alert('您沒有權限!');window.location.href='index.php'; </script>";
    //     exit();
    // }

    include_once XOOPS_ROOT_PATH . "/class/xoopsformloader.php";
    include_once XOOPS_ROOT_PATH . "/class/xoopseditor/xoopseditor.php";

    //抓取預設值
    if (!empty($cate_id)) {
        $DBV = get_cate($cate_id, $table, $type);

    } else {
        $DBV = array();
    }

    //預設值設定

    //設定 cate_id 欄位的預設值
    $cate_id = !isset($DBV[$type . '_id']) ? "" : $DBV[$type . '_id'];
    $xoopsTpl->assign('cate_id', $cate_id);
    //設定 cate_title 欄位的預設值
    $cate_title = !isset($DBV[$type . '_title']) ? "" : $DBV[$type . '_title'];
    $xoopsTpl->assign('cate_title', $cate_title);
    //設定 cate_desc 欄位的預設值
    $cate_desc = !isset($DBV[$type . '_desc']) ? "" : $DBV[$type . '_desc'];
    $xoopsTpl->assign('cate_desc', $cate_desc);
    //設定 cate_sort 欄位的預設值
    $cate_sort = !isset($DBV[$type . '_sort']) ? "" : $DBV[$type . '_sort'];
    $xoopsTpl->assign('cate_sort', $cate_sort);
    //設定 cate_enable 欄位的預設值
    $cate_enable = !isset($DBV[$type . '_enable']) ? "" : $DBV[$type . '_enable'];
    $xoopsTpl->assign('cate_enable', $cate_enable);

    $op     = empty($cate_id) ? "insert_cate" : "update_cate";
    $enable = empty($cate_enable) ? "1" : $cate_enable;
    //$op="replace_kw_club_cate";

    $span = $_SESSION['bootstrap'] == '3' ? 'form-control col-sm-' : 'span';
    $form = new XoopsThemeForm('', 'form', $_SERVER['PHP_SELF'], 'post', true);
    $form->setExtra('enctype = "multipart/form-data"');

    //類型標題
    $cate_titleText = new XoopsFormText(_MD_KWCLUB_CATE_TITLE, "cate_title", 30, 255, $cate_title);
    $cate_titleText->setExtra("class = '{$span}6'");
    $form->addElement($cate_titleText, true);

    //類型排序
    $cate_sortText = new XoopsFormText(_MD_KWCLUB_CATE_SORT, "cate_sort", 30, 255, $cate_sort);
    $cate_sortText->setExtra("class = '{$span}6'");
    $form->addElement($cate_sortText, true);

    //類型說明
    $cate_descText = new XoopsFormText(_MD_KWCLUB_CATE_DESC, "cate_desc", 30, 255, $cate_desc);
    $cate_descText->setExtra("class = '{$span}6'");
    $form->addElement($cate_descText, false);

    //是否啟用

    $cate_isopenRadio          = new XoopsFormRadio(_MD_KWCLUB_CATE_ENABLE, 'cate_enable', $enable);
    $options_array_isshow['1'] = '啟用';
    $options_array_isshow['0'] = '停用';
    $cate_isopenRadio->addOptionArray($options_array_isshow);
    $form->addElement($cate_isopenRadio, true);

    //hidden
    $form->addElement(new XoopsFormHidden("op", $op));
    $form->addElement(new XoopsFormHidden("type", $type));
    $form->addElement(new XoopsFormHidden("cate_id", $cate_id));
    $form->addElement(new XoopsFormHiddenToken());

    $SubmitTray = new XoopsFormElementTray('', '', '', true);
    $SubmitTray->addElement(new XoopsFormButton('', '', _TAD_SUBMIT, 'submit'));
    $form->addElement($SubmitTray);
    $xoopsform = $form->render();
    $xoopsTpl->assign('xoopsform', $xoopsform);

    //列表
    $myts = MyTextSanitizer::getInstance();
    $sql  = "select * from `" . $xoopsDB->prefix($table) . "` order by " . $type . "_sort";
    //getPageBar($原sql語法, 每頁顯示幾筆資料, 最多顯示幾個頁數選項);
    $PageBar = getPageBar($sql, 20, 10);
    $bar     = $PageBar['bar'];
    $sql     = $PageBar['sql'];
    $total   = $PageBar['total'];

    $result = $xoopsDB->query($sql) or web_error($sql);

    $all_content = '';
    $i           = 0;
    while ($all = $result->fetch_row()) {
        $all_content[$i] = $all;
        $i++;
    }

    //刪除確認的JS
    if (!file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/sweet_alert.php")) {
        redirect_header("index.php", 3, _MD_NEED_TADTOOLS);
    }
    include_once XOOPS_ROOT_PATH . "/modules/tadtools/sweet_alert.php";
    $sweet_alert_obj  = new sweet_alert();
    $delete_cate_func = $sweet_alert_obj->render('delete_cate_func', "{$_SERVER['PHP_SELF']}?type={$type}&op=delete_cate&cate_id=", "cate_id");
    $xoopsTpl->assign('delete_cate_func', $delete_cate_func);

    $xoopsTpl->assign('bar', $bar);
    $xoopsTpl->assign('action', "{$_SERVER['PHP_SELF']}");
    $xoopsTpl->assign('isAdmin', $_SESSION['isclubAdmin']);
    $xoopsTpl->assign('all_content', $all_content);

    $xoopsTpl->assign('op', 'cate_form');

}

//新增資料到kw_club_cate中
function insert_cate()
{
    global $xoopsDB, $xoopsTpl, $error, $type, $table;

    // if (!$_SESSION['isclubAdmin']) {
    //     redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
    // }

    // if (!power_chk("", 2) && !power_chk("", 1)) {
    //     echo "<script language='JavaScript'>alert('您沒有權限!');window.location.href='index.php'; </script>";
    //     exit();
    // }

    //XOOPS表單安全檢查
    if (!$GLOBALS['xoopsSecurity']->check()) {
        $error = implode("<br />", $GLOBALS['xoopsSecurity']->getErrors());
        redirect_header($_SERVER['PHP_SELF'], 3, $error);
    }

    $myts = MyTextSanitizer::getInstance();

    $cate_id     = $_POST['cate_id'];
    $cate_title  = $myts->addSlashes($_POST['cate_title']);
    $cate_desc   = $myts->addSlashes($_POST['cate_desc']);
    $cate_sort   = $_POST['cate_sort'];
    $cate_enable = $_POST['cate_enable'];
    // $type        = $_POST['type'];

    $sql    = "select * from `" . $xoopsDB->prefix($table) . "` where `{$type}_sort`={$cate_sort}";
    $result = $xoopsDB->query($sql) or web_error($sql);
    $num    = $result->num_rows;

    if ($num > 0) {
        $error = "排序的數字已存在，請輸入其他阿拉伯數字";
        // $xoopsTpl->assign('error', $error);

        header("location: {$_SERVER['PHP_SELF']}?type=$type&op=cate_form");
        exit;
    } else {

        $sql = "insert into `" . $xoopsDB->prefix($table) . "` (" .
            "`" . $type . "_title`, " .
            "`" . $type . "_desc`, " .
            "`" . $type . "_sort`, " .
            "`" . $type . "_enable` " .
            ") values(
        '{$cate_title}',
        '{$cate_desc}',
        '{$cate_sort}',
        '{$cate_enable}'
    )";
        $xoopsDB->query($sql) or web_error($sql);

        //取得最後新增資料的流水編號
        $cate_id = $xoopsDB->getInsertId();

        // $xoopsTpl->assign('type', $type);

        return $cate_id;
    }
}

//更新kw_club_cate某一筆資料
function update_cate($cate_id = '')
{
    global $xoopsDB, $xoopsTpl, $error, $type, $table;

    // if (!$_SESSION['isclubAdmin']) {
    //     redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
    // }

    // if (!power_chk("", 2) && !power_chk("", 1)) {
    //     echo "<script language='JavaScript'>alert('您沒有權限!');window.location.href='index.php'; </script>";
    //     exit();
    // }

    //XOOPS表單安全檢查
    if (!$GLOBALS['xoopsSecurity']->check()) {
        $error = implode("<br />", $GLOBALS['xoopsSecurity']->getErrors());
        redirect_header($_SERVER['PHP_SELF'], 3, $error);
    }

    $myts = MyTextSanitizer::getInstance();

    $cate_id     = $_POST['cate_id'];
    $cate_title  = $myts->addSlashes($_POST['cate_title']);
    $cate_desc   = $myts->addSlashes($_POST['cate_desc']);
    $cate_sort   = $_POST['cate_sort'];
    $cate_enable = $_POST['cate_enable'];

    // //check sort
    $sql    = "select * from `" . $xoopsDB->prefix($table) . "` where `{$type}_sort`={$cate_sort}";
    $result = $xoopsDB->query($sql) or web_error($sql);
    $num    = $result->num_rows;

    if ($num > 0) {
        $error = "排序的數字已存在，請輸入其他阿拉伯數字";
        // $xoopsTpl->assign('error', $error);
        header("location: {$_SERVER['PHP_SELF']}?type=$type&op=cate_form");
        exit;
    } else {

        $sql = "update `" . $xoopsDB->prefix($table) . "` set" .
            "`" . $type . "_title` = '{$cate_title}'," .
            "`" . $type . "_desc` = '{$cate_desc}'," .
            "`" . $type . "_sort` = '{$cate_sort}'," .
            "`" . $type . "_enable` = '{$cate_enable}'
    where `" . $type . "_id` = '$cate_id'";
        $xoopsDB->queryF($sql) or web_error($sql);

        return $cate_id;
    }

}

//刪除kw_club_cate某筆資料資料
function delete_cate($cate_id = '')
{
    global $xoopsDB, $type, $table;

    // if (!power_chk("", 2) && !power_chk("", 1)) {
    //     echo "<script language='JavaScript'>alert('您沒有權限!');window.location.href='index.php'; </script>";
    //     exit();
    // }

    if (empty($cate_id)) {
        echo "<script language='JavaScript'>alert('刪除錯誤!沒有id!');history.back(); </script>";
        exit();
    }

    $sql = "delete from `" . $xoopsDB->prefix($table) . "`
    where `" . $type . "_id` = '{$cate_id}'";
    $xoopsDB->queryF($sql) or web_error($sql);

}

/*-----------秀出結果區--------------*/

$xoopsTpl->assign('type', $type);
$xoopsTpl->assign('error', $error);
$xoopsTpl->assign("toolbar", toolbar_bootstrap($interface_menu));
$xoTheme->addStylesheet(XOOPS_URL . '/modules/tadtools/css/xoops_adm3.css');
include_once XOOPS_ROOT_PATH . '/footer.php';
