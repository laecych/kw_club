<?php
/*-----------引入檔案區--------------*/
include_once "header.php";
$xoopsOption['template_main'] = "kw_club_index.tpl";
include_once XOOPS_ROOT_PATH . "/header.php";

/*-----------執行動作判斷區----------*/
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op        = system_CleanVars($_REQUEST, 'op', '', 'string');
$class_id  = system_CleanVars($_REQUEST, 'class_id', '0', 'int');
$cate_id   = system_CleanVars($_REQUEST, 'cate_id', '0', 'int');
$uid       = system_CleanVars($_REQUEST, 'uid', '', 'string');
$club_year = system_CleanVars($_REQUEST, 'club_year', '', 'int');
$reg_sn    = system_CleanVars($_REQUEST, 'reg_sn', '', 'int');
$reg_uid   = system_CleanVars($_REQUEST, 'reg_uid', '', 'string');

$today = date('Y-m-d');
switch ($op) {

    case "teacher":
        teacher_list($club_year);
        break;

    case "myclass":
        myclass($reg_uid, $club_year);
        break;

    case "reg_form":
        reg_form($class_id);
        break;

    case "insert_reg":
        insert_reg();
        break;

    case "delete_reg":
        $class_id = delete_reg();
        if ($_SESSION['isclubAdmin'] or $_SESSION['isclubUser']) {
            header("location: {$_SERVER['PHP_SELF']}?class_id={$class_id}");
        } else {
            header("location: {$_SERVER['PHP_SELF']}?op=myclass&reg_uid={$reg_uid}&club_year={$club_year}");
        }
        exit;

    default:
        if ($class_id) {
            class_show($class_id);
            $op = 'class_show';
        } else {
            class_list($club_year);
            $op = 'class_list';
        }

        break;
}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign('op', $op);
$xoopsTpl->assign("toolbar", toolbar_bootstrap($interface_menu));
$xoTheme->addStylesheet(XOOPS_URL . '/modules/kw_club/css/module.css');
include_once XOOPS_ROOT_PATH . '/footer.php';

/*-----------function區--------------*/

//報名表單
function reg_form($class_id = "")
{
    global $xoopsDB, $xoopsTpl, $xoopsUser, $xoopsModuleConfig;

    if (empty($class_id)) {
        redirect_header($_SERVER['PHP_SELF'], 3, _MD_KWCLUB_NEED_CLASS_ID);
    } elseif ($_SESSION['club_isfree'] == '0') {
        $class = get_club_class($class_id);
        $xoopsTpl->assign('class', $class);
        $class_grade_arr = explode("、", $class['class_grade']);
        $xoopsTpl->assign('class_grade_arr', $class_grade_arr);
        $xoopsTpl->assign('class_id', $class_id);

        $class_arr = explode(';', $xoopsModuleConfig['school_class']);
        foreach ($class_arr as $class_name) {
            $school_class[] = trim($class_name);
        }
        $xoopsTpl->assign('school_class', $school_class);

        //安全性表單
        include_once XOOPS_ROOT_PATH . "/class/xoopsformloader.php";
        $token = new XoopsFormHiddenToken('XOOPS_TOKEN', 360);
        $xoopsTpl->assign('reg_token', $token->render());

    }
}

//新增報名資料到reg中
function insert_reg()
{
    global $xoopsDB, $xoopsUser, $today;

    //XOOPS表單安全檢查
    if (!$GLOBALS['xoopsSecurity']->check()) {
        $error = implode("<br />", $GLOBALS['xoopsSecurity']->getErrors());
        redirect_header($_SERVER['PHP_SELF'], 3, $error);
    }

    $myts = MyTextSanitizer::getInstance();

    $class_id  = (int) $_POST['class_id'];
    $class     = get_club_class($class_id);
    $club_year = $class['club_year'];

    //檢查是否設定期別
    if (empty($club_year)) {
        redirect_header("index.php?class_id={$class_id}", 3, _MD_KWCLUB_NEED_CONFIG);
    }

    $club_info = get_club_info($club_year);

    //檢查報名是否可行
    chk_time('', $club_info['club_start_date'], $club_info['club_end_date']);

    //是否報名額滿
    $is_full = false;
    if (($class['class_member'] + $club_info['club_backup_num']) <= $class['class_regnum']) {
        $is_full = true;
        redirect_header("index.php?class_id={$class_id}", 3, _MD_KWCLUB_CLASS_REGNUM_FULL);
    }

    //檢查是否衝堂
    if (check_class_date($reg_uid, $class_id)) {
        redirect_header("index.php?class_id={$class_id}", 3, _MD_KWCLUB_CLASS_SAME_TIME);
    }

    $reg_uid   = $myts->addSlashes($_POST['reg_uid']);
    $reg_name  = $myts->addSlashes($_POST['reg_name']);
    $reg_grade = $myts->addSlashes($_POST['reg_grade']);
    $reg_class = $myts->addSlashes($_POST['reg_class']);
    $reg_isreg = $class['class_member'] < $class['class_regnum'] ? _MD_KWCLUB_OFFICIALLY_ENROLL : _MD_KWCLUB_CANDIDATE;
    $reg_ip    = get_ip();

    $sql = "INSERT INTO `" . $xoopsDB->prefix("kw_club_reg") . "` (
        `class_id`,`reg_uid`, `reg_name`, `reg_grade`, `reg_class`, `reg_isreg`, `reg_datetime`,  `reg_ip`) VALUES
        (
            '{$class_id}',
            '{$reg_uid}',
            '{$reg_name}',
            '{$reg_grade}',
            '{$reg_class}',
            '{$reg_isreg}',
            NOW(),
            '{$reg_ip}'
        )";

    if ($xoopsDB->query($sql)) {
        $update_sql = "update `" . $xoopsDB->prefix("kw_club_class") . "` set `class_regnum`=`class_regnum`+1 where `class_id`={$class_id}";
        $xoopsDB->query($update_sql);

        redirect_header("index.php?op=myclass&reg_uid={$reg_uid}&club_year={$club_year}", 3, _MD_KWCLUB_APPLY_SUCCESS);

    } else {
        redirect_header("index.php?op=myclass&reg_uid={$reg_uid}&club_year={$club_year}", 3, _MD_KWCLUB_REPEAT_APPLY);
    }

}

function check_class_date($reg_uid, $class_id)
{
    global $xoopsDB;

    $arr_reg     = array();
    $check_class = 0;
    $class_new   = get_club_class($class_id);
    $year        = $_SESSION['club_year'];
    $sql         = "select a.* from `" . $xoopsDB->prefix("kw_club_reg") . "`  as a
    join `" . $xoopsDB->prefix("kw_club_class") . "` as b on a.`class_id` = b.`class_id`
    where a.`reg_uid`='{$reg_uid}' and b.`club_year` = '{$year}'";

    $result = $xoopsDB->query($sql) or web_error($sql);
    while ($arr = $xoopsDB->fetchArray($result)) {
        $class_reg = get_club_class($arr['class_id']);
        //check the date repeat

        if (!(strtotime($class_reg['class_date_close']) < strtotime($class_new['class_date_open'])) &&
            !(strtotime($class_reg['class_date_open']) > strtotime($class_new['class_date_close']))) {
            //check the week repeat

            $class_week_reg = explode("、", $class_reg['class_week']);
            $class_week_new = explode("、", $class_new['class_week']);
            foreach ($class_week_new as &$value) {
                if (in_array($value, $class_week_reg)) {
                    // check the time repeat
                    if (!(strtotime($class_reg['class_time_end']) < strtotime($class_new['class_time_start'])) &&
                        !(strtotime($class_reg['class_time_start']) > strtotime($class_new['class_time_end']))) {
                        $check_class++;
                    }
                }
            }
        }
    }

    if ($check_class > 0) {
        return ture;
    } else {
        return false;
    }
}

// 我的社團
function myclass($reg_uid = "", $club_year = "")
{
    global $xoopsDB, $xoopsTpl;
    //查詢年度
    $club_year = (empty($club_year) && isset($_SESSION['club_year'])) ? $_SESSION['club_year'] : $club_year;
    $xoopsTpl->assign('club_year', $club_year);
    $xoopsTpl->assign('club_year_text', club_year_to_text($club_year));

    //取得社團期別陣列
    $xoopsTpl->assign('arr_year', get_all_year());

    if (empty($reg_uid)) {
        $arr_reg = "";
    } else {
        $money = $in_money = $un_money = 0;

        $myts = MyTextSanitizer::getInstance();
        $sql  = "select a.*, b.*, c.`club_end_date` from `" . $xoopsDB->prefix("kw_club_reg") . "` as a
        join `" . $xoopsDB->prefix("kw_club_class") . "` as b on a.`class_id` = b.`class_id`
        join `" . $xoopsDB->prefix("kw_club_info") . "` as c on b.`club_year` = c.`club_year`
        where a.`reg_uid` = '{$reg_uid}'  and b.`club_year`={$club_year}";
        $result = $xoopsDB->query($sql) or web_error($sql);
        $total  = $xoopsDB->getRowsNum($result);

        while ($data = $xoopsDB->fetchArray($result)) {

            $data['end_date'] = strtotime($data['club_end_date']);

            $class_pay         = $data['class_money'] + $data['class_fee'];
            $data['class_pay'] = $class_pay;

            $arr_reg[] = $data;

            if ($data['reg_isfee'] == '1') {
                $in_money += $class_pay;
            } else {
                $un_money += $class_pay;
            }
            $money += $class_pay;

            if (!isset($reg_name)) {
                $reg_name = $data['reg_name'];
            }
        }

        $xoopsTpl->assign('today', time());
        $xoopsTpl->assign('reg_name', $reg_name);
        $xoopsTpl->assign('money', $money);
        $xoopsTpl->assign('in_money', $in_money);
        $xoopsTpl->assign('un_money', $un_money);
        $xoopsTpl->assign('arr_reg', $arr_reg);

        include_once XOOPS_ROOT_PATH . "/modules/tadtools/sweet_alert.php";
        $sweet_alert = new sweet_alert();
        if ($_SESSION['isclubAdmin']) {
            $sweet_alert->render("delete_reg_func", "{$_SERVER['PHP_SELF']}?op=delete_reg&reg_sn=", 'reg_sn');
        } else {
            $sweet_alert->render("delete_reg_func", "{$_SERVER['PHP_SELF']}?op=delete_reg&uid={$reg_uid}&reg_sn=", 'reg_sn', _MD_KWCLUB_SURE_CANCEL_APPLY, _MD_KWCLUB_CANCEL, _MD_KWCLUB_CANCEL_APPLY);
        }

    }

    $xoopsTpl->assign('total', $total);
    $xoopsTpl->assign('reg_uid', $reg_uid);
}

//顯示某一個社團
function class_showjson($class_id = '')
{
    global $xoopsTpl, $today;
    if (!file_exists(XOOPS_ROOT_PATH . "/uploads/kw_club/{$class_id}.json")) {
        $json = mk_json($class_id);
    } else {
        $json = file_get_contents(XOOPS_URL . "/uploads/kw_club/{$class_id}.json");
    }
    $all = json_decode($json, true);

    //檢查報名是否可行
    chk_time();

    if (($all['class_member'] + $_SESSION['club_backup_num']) <= $all['class_regnum']) {
        $xoopsTpl->assign('is_full', 'yes');
    }

    // 取得分類資料()
    $cate_arr    = get_cate($all['cate_id'], 'cate');
    $teacher_arr = get_teacher_all();
    $place_arr   = get_cate($all['place_id'], 'place');

    $xoopsTpl->assign('class_id', $all['class_id']);
    $xoopsTpl->assign('club_year', $all['club_year']);
    $xoopsTpl->assign('class_num', $all['class_num']);
    $xoopsTpl->assign('cate_id', $cate_arr['cate_id']);
    $xoopsTpl->assign('cate_id_title', $cate_arr['cate_title']);
    $xoopsTpl->assign('class_title', $all['class_title']);
    $xoopsTpl->assign('teacher_id', $teacher_arr['teacher_id']);
    $xoopsTpl->assign('teacher_id_title', $teacher_arr['teacher_title']);
    $xoopsTpl->assign('class_week', $all['class_week']);
    $xoopsTpl->assign('class_grade', $all['class_grade']);
    $xoopsTpl->assign('class_date_open', $all['class_date_open']);
    $xoopsTpl->assign('class_date_close', $all['class_date_close']);
    $xoopsTpl->assign('class_time_start', $all['class_time_start']);
    $xoopsTpl->assign('class_time_end', $all['class_time_end']);
    $xoopsTpl->assign('place_id', $place_arr['place_id']);
    $xoopsTpl->assign('place_id_title', $place_arr['place_title']);
    $xoopsTpl->assign('class_member', $all['class_member']);
    $xoopsTpl->assign('class_money', $all['class_money']);
    $xoopsTpl->assign('class_fee', $all['class_fee']);
    $xoopsTpl->assign('class_regnum', $all['class_regnum']);
    $xoopsTpl->assign('class_note', $all['class_note']);
    $xoopsTpl->assign('class_date_start', $all['class_date_start']);
    $xoopsTpl->assign('class_date_end', $all['class_date_end']);
    $xoopsTpl->assign('class_ischecked', $all['class_ischecked']);
    $xoopsTpl->assign('class_isopen', $all['class_isopen']);
    $xoopsTpl->assign('class_desc', $all['class_desc']);

    // $xoopsTpl->assign('op', 'class_show');
    $xoopsTpl->assign('action', $_SERVER['PHP_SELF']);

}

//以流水號秀出某筆kw_club_class資料內容
function class_show($class_id = '')
{
    global $xoopsDB, $xoopsUser, $xoopsTpl, $today;

    if (empty($class_id)) {
        redirect_header("index.php", 3, _MD_KWCLUB_NEED_CLASS_ID);
    }

    $uid = ($xoopsUser) ? $xoopsUser->uid() : '';
    $xoopsTpl->assign('uid', $uid);

    $myts = MyTextSanitizer::getInstance();

    $sql = "select * from `" . $xoopsDB->prefix("kw_club_class") . "`
    where `class_id` = '{$class_id}' ";
    $result = $xoopsDB->query($sql) or web_error($sql);
    $all    = $xoopsDB->fetchArray($result);

    //檢查報名是否可行
    $xoopsTpl->assign('chk_time', chk_time('return'));

    $is_full = false;
    if (($all['class_member'] + $_SESSION['club_backup_num']) <= $all['class_regnum']) {
        $is_full = true;
    }
    $xoopsTpl->assign('is_full', $is_full);

    //以下會產生這些變數： $class_id, $club_year, $class_num, $cate_id, $class_title, $teacher_id, $class_week, $class_date_open, $class_date_close, $class_time_start, $class_time_end, $place_id, $class_member, $class_money, $class_fee, $class_regnum, $class_note, $class_date_start, $class_date_end, $class_ischecked, $class_isopen, $class_desc
    foreach ($all as $k => $v) {
        $$k = $v;
    }

    //這要在前面，才能產生 $_SESSION['club_year']
    $club_info = get_club_info($club_year);
    $xoopsTpl->assign('club_info', $club_info);

    //取得分類資料()
    $cate_arr    = get_cate($cate_id, 'cate');
    $teacher_arr = get_teacher_all();
    $place_arr   = get_cate($place_id, 'place');

    //將是/否選項轉換為圖示
    $class_isopen = ($class_isopen == 1) ? '<img src="' . XOOPS_URL . '/modules/kw_club/images/yes.gif" alt="' . _YES . '" title="' . _YES . '">' : '<img src="' . XOOPS_URL . '/modules/kw_club/images/no.gif" alt="' . _NO . '" title="' . _NO . '">';

    //過濾讀出的變數值
    $class_num   = $myts->htmlSpecialChars($class_num);
    $class_title = $myts->htmlSpecialChars($class_title);

    $class_member     = $myts->htmlSpecialChars($class_member);
    $class_money      = $myts->htmlSpecialChars($class_money);
    $class_fee        = $myts->htmlSpecialChars($class_fee);
    $class_note       = $myts->htmlSpecialChars($class_note);
    $class_date_open  = $myts->htmlSpecialChars($class_date_open);
    $class_date_close = $myts->htmlSpecialChars($class_date_close);
    $class_time_start = $myts->htmlSpecialChars($class_time_start);
    $class_time_end   = $myts->htmlSpecialChars($class_time_end);
    $class_desc       = $myts->displayTarea($class_desc, 1, 1, 0, 1, 0);

    $xoopsTpl->assign('class_id', $class_id);
    $xoopsTpl->assign('club_year', $club_year);
    $xoopsTpl->assign('club_year_text', club_year_to_text($club_year));
    $xoopsTpl->assign('class_num', $class_num);
    $xoopsTpl->assign('cate_id', $cate_id);
    $xoopsTpl->assign('cate_id_title', $cate_arr['cate_title']);
    $xoopsTpl->assign('class_title', $class_title);
    $xoopsTpl->assign('teacher_id', $teacher_id);
    $xoopsTpl->assign('teacher_id_title', $teacher_arr[$teacher_id]['name']);
    $xoopsTpl->assign('class_week', $class_week);
    $xoopsTpl->assign('class_grade', $class_grade);
    $xoopsTpl->assign('class_date_open', $class_date_open);
    $xoopsTpl->assign('class_date_close', $class_date_close);
    $xoopsTpl->assign('class_time_start', $class_time_start);
    $xoopsTpl->assign('class_time_end', $class_time_end);
    $xoopsTpl->assign('place_id', $place_id);
    $xoopsTpl->assign('place_id_title', $place_arr['place_title']);
    $xoopsTpl->assign('class_member', $class_member);
    $xoopsTpl->assign('class_money', $class_money);
    $xoopsTpl->assign('class_fee', $class_fee);
    $xoopsTpl->assign('class_regnum', $class_regnum);
    $xoopsTpl->assign('class_note', $class_note);
    $xoopsTpl->assign('class_date_start', $class_date_start);
    $xoopsTpl->assign('class_date_end', $class_date_end);
    $xoopsTpl->assign('class_ischecked', $class_ischecked);
    $xoopsTpl->assign('class_isopen', $class_isopen);
    $xoopsTpl->assign('class_desc', $class_desc);
    $xoopsTpl->assign('class_uid', $class_uid);

    //已有人報名 報名列表
    if ($class_regnum > 0) {
        //取得報名資料
        $all_reg = get_class_reg($club_year, $class_id);
        $xoopsTpl->assign('all_reg', $all_reg);
    }

    if ($_SESSION['isclubAdmin'] or $uid == $class_uid) {

        //刪除訊息警告
        if (!file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/sweet_alert.php")) {
            redirect_header("index.php", 3, _MA_NEED_TADTOOLS);
        }
        //刪除班級
        include_once XOOPS_ROOT_PATH . "/modules/tadtools/sweet_alert.php";
        $sweet_alert_obj = new sweet_alert();
        $sweet_alert_obj->render('delete_class_func', "club.php?op=delete_class&class_id=", "class_id");

        //刪除報名
        $sweet_alert_obj = new sweet_alert();
        $sweet_alert_obj->render('delete_reg_func',
            "{$_SERVER['PHP_SELF']}?op=delete_reg&reg_sn=", "reg_sn");
    }

}

//列出所有社團資料
function class_list($club_year = '')
{
    global $xoopsDB, $xoopsUser, $xoopsTpl, $today, $xoopsModuleConfig;

    $uid = ($xoopsUser) ? $xoopsUser->uid() : '';
    $xoopsTpl->assign('uid', $uid);

    //取得社團期別陣列
    $xoopsTpl->assign('arr_year', get_all_year());

    //這要在前面，才能產生 $_SESSION['club_year']
    $club_info = get_club_info($club_year);
    $xoopsTpl->assign('club_info', $club_info);

    $club_year = empty($club_year) ? $_SESSION['club_year'] : $club_year;
    $xoopsTpl->assign('club_year', $club_year);
    $xoopsTpl->assign('club_year_text', club_year_to_text($club_year));

    //檢查報名是否可行
    $xoopsTpl->assign('chk_time', chk_time('return'));

    //已有設定社團期別
    if (!empty($club_year)) {
        //社團列表
        $myts   = MyTextSanitizer::getInstance();
        $sql    = "select * from `" . $xoopsDB->prefix("kw_club_class") . "` where `club_year`= '{$club_year}' order by class_num ";
        $result = $xoopsDB->query($sql) or web_error($sql);
        $total  = $xoopsDB->getRowsNum($result);
        $xoopsTpl->assign('total', $total);

        //取得分類所有資料陣列
        $all_cate_arr      = get_cate_all();
        $all_place_arr     = get_place_all();
        $all_teacher_arr   = get_teacher_all();
        $all_class_content = array();
        $i                 = 0;
        while ($all = $xoopsDB->fetchArray($result)) {
            //以下會產生這些變數： $class_id, $club_year, $class_num, $cate_id, $class_title, $teacher_id, $class_week, $class_date_open, $class_date_close, $class_time_start, $class_time_end, $place_id, $class_member, $class_money, $class_fee, $class_regnum, $class_note, $class_date_start, $class_date_end, $class_ischecked, $class_isopen, $class_desc
            foreach ($all as $k => $v) {
                $$k = $v;
            }

            $all_class_content[$i]['class_id']         = (int) $class_id;
            $all_class_content[$i]['club_year']        = $club_year;
            $all_class_content[$i]['class_num']        = $class_num;
            $all_class_content[$i]['class_title']      = $myts->htmlSpecialChars($class_title);
            $all_class_content[$i]['class_week']       = $myts->htmlSpecialChars($class_week);
            $all_class_content[$i]['class_grade']      = $myts->htmlSpecialChars($class_grade);
            $all_class_content[$i]['class_date_open']  = $myts->htmlSpecialChars($class_date_open);
            $all_class_content[$i]['class_date_close'] = $myts->htmlSpecialChars($class_date_close);
            $all_class_content[$i]['class_time_start'] = $myts->htmlSpecialChars($class_time_start);
            $all_class_content[$i]['class_time_end']   = $myts->htmlSpecialChars($class_time_end);
            $all_class_content[$i]['cate_id']          = $myts->htmlSpecialChars($all_cate_arr[$cate_id]['cate_title']);
            $all_class_content[$i]['teacher_id']       = $myts->htmlSpecialChars($all_teacher_arr[$teacher_id]['name']);
            $all_class_content[$i]['place_id']         = $myts->htmlSpecialChars($all_place_arr[$place_id]['place_title']);
            $all_class_content[$i]['class_member']     = (int) $class_member;
            $all_class_content[$i]['class_money']      = (int) $class_money;
            $all_class_content[$i]['class_fee']        = (int) $class_fee;
            $all_class_content[$i]['class_pay']        = $class_money + $class_fee;
            $all_class_content[$i]['class_regnum']     = (int) $class_regnum;
            $all_class_content[$i]['class_note']       = $myts->htmlSpecialChars($class_note);
            $all_class_content[$i]['class_date_start'] = $myts->htmlSpecialChars($class_date_start);
            $all_class_content[$i]['class_date_end']   = $myts->htmlSpecialChars($class_date_end);
            $all_class_content[$i]['class_ischecked']  = (int) $class_ischecked;
            $all_class_content[$i]['class_isopen']     = $class_isopen ? '<img src="' . XOOPS_URL . '/modules/kw_club/images/yes.gif" alt="' . _YES . '" title="' . _YES . '">' : '<img src="' . XOOPS_URL . '/modules/kw_club/images/no.gif" alt="' . _NO . '" title="' . _NO . '">';
            $all_class_content[$i]['class_desc']       = $myts->displayTarea($class_desc, 1, 1, 0, 1, 0);
            $all_class_content[$i]['class_uid']        = (int) $class_uid;
            //是否報名額滿
            $all_class_content[$i]['is_full'] = (($class_member + $club_info['club_backup_num']) <= $class_regnum) ? true : false;
            $i++;

        }
        $xoopsTpl->assign('all_class_content', $all_class_content);

        //刪除確認的JS
        if (!file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/sweet_alert.php")) {
            redirect_header("index.php", 3, _MD_NEED_TADTOOLS);
        }
        include_once XOOPS_ROOT_PATH . "/modules/tadtools/sweet_alert.php";
        $sweet_alert_obj = new sweet_alert();
        $sweet_alert_obj->render('delete_class_func', "club.php?op=delete_class&class_id=", "class_id");

    } else {
        $xoopsTpl->assign('error', _MD_KWCLUB_NEED_CONFIG);
    }

}

//教師列表
function teacher_list($club_year = "")
{
    global $xoopsTpl;
    $teachers = get_teacher_all();
    $xoopsTpl->assign('teachers', $teachers);
}
