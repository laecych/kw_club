<?php
/*-----------引入檔案區--------------*/

include_once "header.php";
$xoopsOption['template_main'] = "kw_club_club.tpl";
include_once XOOPS_ROOT_PATH . "/header.php";

/*-----------執行動作判斷區----------*/
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op         = system_CleanVars($_REQUEST, 'op', '', 'string');
$cate_id    = system_CleanVars($_REQUEST, 'cate_id', '', 'int');
$class_id   = system_CleanVars($_REQUEST, 'class_id', '', 'int');
$place_id   = system_CleanVars($_REQUEST, 'place_id', '', 'int');
$teacher_id = system_CleanVars($_REQUEST, 'teacher_id', '', 'int');
$year       = system_CleanVars($_REQUEST, 'year', '', 'int');

switch ($op) {

    //新增資料
    case "insert_class":
        $class_id = insert_class();
        header("location: index.php?class_id=$class_id");
        exit;

    //更新資料
    case "update_class":
        update_class($class_id);
        header("location: index.php?class_id=$class_id");
        exit;

    case "delete_class":
        delete_class($class_id);
        header("location: index.php");
        exit;

    default:
        if (!empty($class_id)) {
            class_form($class_id);
        } else {
            class_form();
        }
        $op = 'class_form';

        break;

}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign('op', $op);
$xoopsTpl->assign("toolbar", toolbar_bootstrap($interface_menu));
$xoTheme->addStylesheet(XOOPS_URL . '/modules/kw_club/css/module.css');
include_once XOOPS_ROOT_PATH . '/footer.php';

/*-----------功能函數區--------------*/

function class_form($class_id = '')
{
    global $xoopsDB, $xoopsTpl, $xoopsUser, $xoopsModuleConfig, $grade_name_arr;

    //安全性表單
    include_once XOOPS_ROOT_PATH . "/class/xoopsformloader.php";
    $token = new XoopsFormHiddenToken('XOOPS_TOKEN', 360);
    $xoopsTpl->assign('token', $token->render());

    //引入日期
    include_once XOOPS_ROOT_PATH . "/modules/tadtools/cal.php";
    $cal = new My97DatePicker();
    $cal->render();

    if (!$_SESSION['isclubAdmin'] && !$_SESSION['isclubUser']) {
        redirect_header("index.php", 3, _MD_KWCLUB_FORBBIDEN);
    }

    $club_info = get_club_info();
    if (!isset($club_info['club_year'])) {
        redirect_header("index.php", 3, _MD_KWCLUB_NEED_CONFIG);
    }

    $class_num = system_CleanVars($_REQUEST, 'class_num', '', 'int');

    //取得此期已有的class_num
    $arr_num = get_class_num();

    //判斷修改or新增(取預設值)
    if (!empty($class_id)) {
        $DBV = get_club_class($class_id);
        //設定 class_id 欄位的預設值

        $class_num = $DBV['class_num'];

    } else if (!empty($class_num)) {
        $DBV      = js_class($class_num);
        $class_id = "";
    } else {
        $DBV       = array();
        $class_id  = "";
        $class_num = "";
    }
    $xoopsTpl->assign('class_id', $class_id);
    $xoopsTpl->assign('class_num', $class_num);

    //挑選課程
    $js_class   = array();
    $class_json = array();
    $class_dir  = XOOPS_ROOT_PATH . "/uploads/kw_club/class/";
    $dh         = opendir($class_dir);
    if (is_dir($class_dir) && $dh = opendir($class_dir)) {
        while (($file = readdir($dh)) !== false) {
            if ($file != "." && $file != "..") {
                $file_name = str_replace(".json", "", $file);
                if (!in_array($file_name, $arr_num)) {
                    array_push($arr_num, $file_name);
                    $class_json                         = json_decode(file_get_contents(XOOPS_ROOT_PATH . "/uploads/kw_club/class/" . $file), true);
                    $js_class[$class_json['class_num']] = $class_json['class_title'];
                }
            }
        }
        closedir($dh);
    }
    //自動設定課程編號
    $num = 1;
    while (in_array($num, $arr_num)) {
        $num++;
    }

    $xoopsTpl->assign('js_class', $js_class);
    $xoopsTpl->assign('num', $num);

    //設定 cate_id 欄位的預設值
    $cate_id = !isset($DBV['cate_id']) ? "" : $DBV['cate_id'];
    $xoopsTpl->assign('cate_id', $cate_id);

    //設定 club_year 欄位的預設值
    $club_year = !isset($DBV['club_year']) ? $club_info['club_year'] : $DBV['club_year'];
    $xoopsTpl->assign('club_year', $club_year);
    $xoopsTpl->assign('club_year_text', club_year_to_text($club_year));

    //設定 class_title 欄位的預設值
    $class_title = !isset($DBV['class_title']) ? "" : $DBV['class_title'];
    $xoopsTpl->assign('class_title', $class_title);
    //設定 teacher_id 欄位的預設值
    $teacher_id = !isset($DBV['teacher_id']) ? "" : $DBV['teacher_id'];
    $xoopsTpl->assign('teacher_id', $teacher_id);
    //設定 class_week 欄位的預設值
    $class_week     = !isset($DBV['class_week']) ? "" : $DBV['class_week'];
    $class_week_arr = explode("、", $class_week);
    // $class_week_arr = str_split($class_week);
    $xoopsTpl->assign('class_week', $class_week_arr);
    $xoopsTpl->assign('c_week', array(_MD_KWCLUB_W0, _MD_KWCLUB_W1, _MD_KWCLUB_W2, _MD_KWCLUB_W3, _MD_KWCLUB_W4, _MD_KWCLUB_W5, _MD_KWCLUB_W6));

    //設定 class_grade 欄位的預設值
    $class_grade     = !isset($DBV['class_grade']) ? "" : $DBV['class_grade'];
    $class_grade_arr = explode("、", $class_grade);
    $xoopsTpl->assign('class_grade', $class_grade_arr);
    $xoopsTpl->assign('c_grade', $xoopsModuleConfig['school_grade']);
    $xoopsTpl->assign('grade_name_arr', $grade_name_arr);

    //設定 class_date_open 欄位的預設值
    $class_date_open = !isset($DBV['class_date_open']) ? date("Y-m-d") : $DBV['class_date_open'];
    $xoopsTpl->assign('class_date_open', $class_date_open);

    //設定 class_date_close 欄位的預設值
    $class_date_close = !isset($DBV['class_date_close']) ? date("Y-m-d") : $DBV['class_date_close'];
    $xoopsTpl->assign('class_date_close', $class_date_close);

    //設定 class_time_start 欄位的預設值
    $class_time_start = !isset($DBV['class_time_start']) ? date("H:i") : $DBV['class_time_start'];
    $xoopsTpl->assign('class_time_start', $class_time_start);

    //設定 class_time_end 欄位的預設值
    $class_time_end = !isset($DBV['class_time_end']) ? date("H:i") : $DBV['class_time_end'];
    $xoopsTpl->assign('class_time_end', $class_time_end);

    //設定 place_id 欄位的預設值
    $place_id = !isset($DBV['place_id']) ? "" : $DBV['place_id'];
    $xoopsTpl->assign('place_id', $place_id);

    //設定 class_member 欄位的預設值
    $class_member = !isset($DBV['class_member']) ? "" : $DBV['class_member'];
    $xoopsTpl->assign('class_member', $class_member);

    //設定 class_money 欄位的預設值
    $class_money = !isset($DBV['class_money']) ? "" : $DBV['class_money'];
    $xoopsTpl->assign('class_money', $class_money);

    //設定 class_fee 欄位的預設值
    $class_fee = !isset($DBV['class_fee']) ? "" : $DBV['class_fee'];
    $xoopsTpl->assign('class_fee', $class_fee);

    //設定 class_regnum 欄位的預設值
    $class_regnum = !isset($DBV['class_regnum']) ? "" : $DBV['class_regnum'];
    $xoopsTpl->assign('class_regnum', $class_regnum);

    //設定 class_note 欄位的預設值
    $class_note = !isset($DBV['class_note']) ? "" : $DBV['class_note'];
    $xoopsTpl->assign('class_note', $class_note);

    //設定 class_date_start 欄位的預設值
    $class_date_start = !isset($DBV['class_date_start']) ? date("Y-m-d H:i") : $DBV['class_date_start'];
    $xoopsTpl->assign('class_date_start', $class_date_start);

    //設定 class_date_end 欄位的預設值
    $class_date_end = !isset($DBV['class_date_end']) ? date("Y-m-d H:i") : $DBV['class_date_end'];
    $xoopsTpl->assign('class_date_end', $class_date_end);

    //設定 class_ischecked 欄位的預設值
    $class_ischecked = !isset($DBV['class_ischecked']) ? "" : $DBV['class_ischecked'];
    $xoopsTpl->assign('class_ischecked', $class_ischecked);

    //設定 class_isopen 欄位的預設值
    $class_isopen = !isset($DBV['class_isopen']) ? "1" : $DBV['class_isopen'];
    $xoopsTpl->assign('class_isopen', $class_isopen);

    //設定 class_desc 欄位的預設值
    $class_desc = !isset($DBV['class_desc']) ? "" : $DBV['class_desc'];
    $xoopsTpl->assign('class_desc', $class_desc);
    //所見即所得編輯器
    include_once XOOPS_ROOT_PATH . "/modules/tadtools/ck.php";
    $ck = new CKEditor("kw_club", "class_desc", $class_desc);
    $ck->setHeight(250);
    $ck->setToolbarSet('tadSimple');
    $editor = $ck->render();
    $xoopsTpl->assign('class_desc_editor', $editor);

    //semester
    $arr_semester = get_semester();
    $xoopsTpl->assign('arr_semester', $arr_semester);

    //get the forigner key
    $sql    = "select `cate_id`, `cate_title`  from `" . $xoopsDB->prefix("kw_club_cate") . "` where `cate_enable`='1' order by `cate_sort`";
    $result = $xoopsDB->query($sql) or web_error($sql);
    while (list($id, $title) = $xoopsDB->fetchRow($result)) {
        $options_array_cate[$id] = $title;
    }
    $xoopsTpl->assign('arr_cate', $options_array_cate);

    //開課教師
    $xoopsTpl->assign('arr_teacher', get_teacher_all());

    $sql    = "select `place_id`, `place_title` from `" . $xoopsDB->prefix("kw_club_place") . "` where `place_enable`='1' order by `place_sort`";
    $result = $xoopsDB->query($sql) or web_error($sql);
    while (list($place_id, $place_title) = $xoopsDB->fetchRow($result)) {
        $options_array_place[$place_id] = $place_title;
    }
    $xoopsTpl->assign('arr_place', $options_array_place);

    //套用formValidator驗證機制
    if (!file_exists(TADTOOLS_PATH . "/formValidator.php")) {
        redirect_header("index.php", 3, _TAD_NEED_TADTOOLS);
    }
    include_once TADTOOLS_PATH . "/formValidator.php";
    $formValidator = new formValidator("#classform", true);
    $formValidator->render();

    $xoopsTpl->assign('uid', $xoopsUser->uid());
}

//新增資料到kw_club_class中
function insert_class()
{
    global $xoopsDB, $xoopsUser;

    //檢查權限
    if (!$_SESSION['isclubAdmin'] && !$_SESSION['isclubUser']) {
        redirect_header("index.php", 3, _MD_KWCLUB_FORBBIDEN);
    }

    //XOOPS表單安全檢查
    if (!$GLOBALS['xoopsSecurity']->check()) {
        $error = implode("<br />", $GLOBALS['xoopsSecurity']->getErrors());
        redirect_header($_SERVER['PHP_SELF'], 3, $error);
    }

    //檢查期別
    if (!isset($_POST['club_year'])) {
        redirect_header("config.php", 3, _MD_KWCLUB_NEED_CONFIG);
    }

    $myts = MyTextSanitizer::getInstance();

    $class_id         = (int) $_POST['class_id'];
    $club_year        = (int) $_POST['club_year'];
    $class_num        = (int) $_POST['class_num'];
    $class_title      = $myts->addSlashes($_POST['class_title']);
    $cate_id          = (int) $_POST['cate_id'];
    $teacher_id       = (int) $_POST['teacher_id'];
    $place_id         = (int) $_POST['place_id'];
    $class_week_arr   = $_POST['class_week'];
    $class_grade_arr  = $_POST['class_grade'];
    $class_week       = implode("、", $class_week_arr);
    $class_grade      = implode("、", $class_grade_arr);
    $class_date_open  = $myts->addSlashes($_POST['class_date_open']);
    $class_date_close = $myts->addSlashes($_POST['class_date_close']);
    $class_time_start = $myts->addSlashes($_POST['class_time_start']);
    $class_time_end   = $myts->addSlashes($_POST['class_time_end']);
    $class_member     = (int) $_POST['class_member'];
    $class_money      = (int) $_POST['class_money'];
    $class_fee        = (int) $_POST['class_fee'];
    $class_note       = $myts->addSlashes($_POST['class_note']);
    $class_isopen     = (int) $_POST['class_isopen'];
    $class_desc       = $myts->addSlashes($_POST['class_desc']);
    $uid              = $xoopsUser->uid();
    $today            = date("Y-m-d H:i:s");
    $ip               = get_ip();

    $sql = "insert into `" . $xoopsDB->prefix("kw_club_class") . "` (
        `club_year`,
        `class_num`,
        `cate_id`,
        `class_title`,
        `teacher_id`,
        `class_week`,
        `class_grade`,
        `class_date_open`,
        `class_date_close`,
        `class_time_start`,
        `class_time_end`,
        `place_id`,
        `class_member`,
        `class_money`,
        `class_fee`,
        `class_note`,
        `class_isopen`,
        `class_desc`,
        `class_uid`,
        `class_datetime`,
        `class_ip`
    ) values(
        '{$club_year}',
        '{$class_num}',
        '{$cate_id}',
        '{$class_title}',
        '{$teacher_id}',
        '{$class_week}',
        '{$class_grade}',
        '{$class_date_open}',
        '{$class_date_close}',
        '{$class_time_start}',
        '{$class_time_end}',
        '{$place_id}',
        '{$class_member}',
        '{$class_money}',
        '{$class_fee}',
        '{$class_note}',
        '{$class_isopen}',
        '{$class_desc}',
        '{$uid}',
        '{$today}',
        '{$ip}'
    )";
    $xoopsDB->query($sql) or web_error($sql);

    //取得最後新增資料的流水編號
    $class_id = $xoopsDB->getInsertId();

    mk_json($class_id);
    return $class_id;
}

//更新kw_club_class某一筆資料
function update_class($class_id = '')
{
    global $xoopsDB, $xoopsUser;

    //檢查權限
    if (!$_SESSION['isclubAdmin'] && !$_SESSION['isclubUser']) {
        redirect_header("index.php", 3, _MD_KWCLUB_FORBBIDEN);
    }

    //XOOPS表單安全檢查
    if (!$GLOBALS['xoopsSecurity']->check()) {
        $error = implode("<br />", $GLOBALS['xoopsSecurity']->getErrors());
        redirect_header($_SERVER['PHP_SELF'], 3, $error);
    }

    //檢查期別
    if (!isset($_POST['club_year'])) {
        redirect_header("config.php", 3, _MD_KWCLUB_NEED_CONFIG);
    }

    $myts = MyTextSanitizer::getInstance();

    $class_id         = (int) $_POST['class_id'];
    $club_year        = (int) $_POST['club_year'];
    $class_num        = (int) $_POST['class_num'];
    $class_title      = $myts->addSlashes($_POST['class_title']);
    $cate_id          = (int) $_POST['cate_id'];
    $teacher_id       = (int) $_POST['teacher_id'];
    $place_id         = (int) $_POST['place_id'];
    $class_week_arr   = $_POST['class_week'];
    $class_week       = implode("、", $class_week_arr);
    $class_grade_arr  = $_POST['class_grade'];
    $class_grade      = implode("、", $class_grade_arr);
    $class_date_open  = $myts->addSlashes($_POST['class_date_open']);
    $class_date_close = $myts->addSlashes($_POST['class_date_close']);
    $class_time_start = $myts->addSlashes($_POST['class_time_start']);
    $class_time_end   = $myts->addSlashes($_POST['class_time_end']);
    $class_member     = (int) $_POST['class_member'];
    $class_money      = (int) $_POST['class_money'];
    $class_fee        = (int) $_POST['class_fee'];
    $class_note       = $myts->addSlashes($_POST['class_note']);
    $class_isopen     = (int) $_POST['class_isopen'];
    $class_desc       = $myts->addSlashes($_POST['class_desc']);
    $uid              = $xoopsUser->uid();
    $today            = date("Y-m-d H:i:s");
    $ip               = get_ip();

    $sql = "update `" . $xoopsDB->prefix("kw_club_class") . "` set
    `club_year` = '{$club_year}',
    `class_num` = '{$class_num}',
    `cate_id` = '{$cate_id}',
    `class_title` = '{$class_title}',
    `teacher_id` = '{$teacher_id}',
    `class_week` = '{$class_week}',
    `class_grade` = '{$class_grade}',
    `class_date_open` = '{$class_date_open}',
    `class_date_close` = '{$class_date_close}',
    `class_time_start` = '{$class_time_start}',
    `class_time_end` = '{$class_time_end}',
    `place_id` = '{$place_id}',
    `class_member` = '{$class_member}',
    `class_money` = '{$class_money}',
    `class_fee` = '{$class_fee}',
    `class_note` = '{$class_note}',
    `class_isopen` = '{$class_isopen}',
    `class_desc` = '{$class_desc}',
    `class_datetime` = '{$today}',
    `class_ip` = '{$ip}'
    where `class_id` = '$class_id'";
    $xoopsDB->queryF($sql) or web_error($sql);

    //紀錄課程編號資訊
    mk_json($class_id);
    return $class_id;
}

// 刪除kw_club_class某筆資料資料
function delete_class($class_id)
{
    global $xoopsDB, $xoopsUser;

    //檢查權限
    if (!$_SESSION['isclubAdmin'] && !$_SESSION['isclubUser']) {
        redirect_header("index.php", 3, _MD_KWCLUB_FORBBIDEN);
    }

    if (empty($class_id)) {
        redirect_header("index.php", 3, _MD_KWCLUB_NEED_CLASS_ID);
    } else if (check_class_reg($class_id)) {
        redirect_header("club.php", 3, _MD_KWCLUB_NOT_EMPTY_CLASS);
    } else {
        $and_uid = '';
        if ($_SESSION['isclubUser']) {
            // 只能刪除自己的
            $uid     = $xoopsUser->uid();
            $and_uid = "and `class_uid = '{$uid}'";
        }

        $sql = "delete from `" . $xoopsDB->prefix('kw_club_class') . "` where `class_id`='{$class_id}' {$and_uid}";
        $xoopsDB->queryF($sql) or web_error($sql);
    }
}
