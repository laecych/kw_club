<?php

//引入TadTools的函式庫
if (!file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/tad_function.php")) {
    redirect_header("http://www.tad0616.net/modules/tad_uploader/index.php?of_cat_sn=50", 3, _TAD_NEED_TADTOOLS);
}
include_once XOOPS_ROOT_PATH . "/modules/tadtools/tad_function.php";

$semester_name_arr = array('00' => _MD_KWCLUB_YEAR_TEXT_00, '01' => _MD_KWCLUB_YEAR_TEXT_01, '11' => _MD_KWCLUB_YEAR_TEXT_11, '02' => _MD_KWCLUB_YEAR_TEXT_02);
$grade_name_arr    = array(_MD_KWCLUB_GRADE0, _MD_KWCLUB_GRADE1, _MD_KWCLUB_GRADE2, _MD_KWCLUB_GRADE3, _MD_KWCLUB_GRADE4, _MD_KWCLUB_GRADE5, _MD_KWCLUB_GRADE6, _MD_KWCLUB_GRADE7, _MD_KWCLUB_GRADE8, _MD_KWCLUB_GRADE9);

//其他自訂的共同的函數

//從json中取得社團期別資料（會在header.php中讀取）
function get_club_info($club_year = "")
{
    global $xoopsDB, $xoopsTpl;
    if (empty($_SESSION['club_year']) or $club_year != $_SESSION['club_year']) {
        if ($club_year) {
            $sql = "select * from `" . $xoopsDB->prefix("kw_club_info") . "` where `club_enable`='1' and `club_year`='{$club_year}'";
        } else {
            $sql = "select * from `" . $xoopsDB->prefix("kw_club_info") . "` where `club_enable`='1' order by club_start_date desc limit 0,1";
        }
        // die($sql);
        $result    = $xoopsDB->query($sql) or web_error($sql);
        $club_info = $xoopsDB->fetchArray($result);

        $_SESSION['club_year']          = $club_info['club_year'];
        $_SESSION['club_start_date']    = $club_info['club_start_date'];
        $_SESSION['club_start_date_ts'] = strtotime($club_info['club_start_date']);
        $_SESSION['club_end_date']      = $club_info['club_end_date'];
        $_SESSION['club_end_date_ts']   = strtotime($club_info['club_end_date']);
        $_SESSION['club_isfree']        = $club_info['club_isfree'];
        $_SESSION['club_backup_num']    = $club_info['club_backup_num'];
    } else {
        $club_info['club_year']       = $_SESSION['club_year'];
        $club_info['club_start_date'] = $_SESSION['club_start_date'];
        $club_info['club_end_date']   = $_SESSION['club_end_date'];
        $club_info['club_isfree']     = $_SESSION['club_isfree'];
        $club_info['club_backup_num'] = $_SESSION['club_backup_num'];
    }
    return $club_info;
}

//以流水號取得某筆資料
function get_cate($cate_id, $type)
{
    global $xoopsDB;

    if (empty($cate_id) || empty($type)) {
        return;
    }

    $type_id = $type . "_id";
    $sql     = "select * from `" . $xoopsDB->prefix('kw_club_' . $type) . "`
    where `" . $type . "_id` = '{$cate_id}'";

    $result = $xoopsDB->query($sql) or web_error($sql);
    $data   = $xoopsDB->fetchArray($result);
    return $data;
}

//取得所有報名者的uid
function get_reg_uid_all($club_year)
{
    global $xoopsDB;
    if (empty($club_year)) {
        redirect_header($_SERVER['PHP_SELF'], 3, _MD_KWCLUB_NEED_CLUB_YEAR);
    } else {

        // $data['money'] = $data['in_money'] = $data['un_money'] = 0;

        $myts = MyTextSanitizer::getInstance();
        $sql  = "select a.*, b.*, c.`club_end_date` from `" . $xoopsDB->prefix("kw_club_reg") . "` as a
        join `" . $xoopsDB->prefix("kw_club_class") . "` as b on a.`class_id` = b.`class_id`
        join `" . $xoopsDB->prefix("kw_club_info") . "` as c on b.`club_year` = c.`club_year`
        where b.`club_year`={$club_year}";
        $result = $xoopsDB->query($sql) or web_error($sql);

        while ($data = $xoopsDB->fetchArray($result)) {
            $reg_uid  = $data['reg_uid']  = strtoupper($data['reg_uid']);
            $class_id = $data['class_id'];

            if (!isset($arr_reg[$reg_uid]['money'])) {
                $arr_reg[$reg_uid]['in_money'] = $arr_reg[$reg_uid]['un_money'] = $arr_reg[$reg_uid]['money'] = 0;
            }

            $data['end_date'] = strtotime($data['club_end_date']);

            $class_pay         = $data['class_money'] + $data['class_fee'];
            $data['class_pay'] = $class_pay;
            $arr_reg[$reg_uid]['money'] += $class_pay;

            if ($data['reg_isfee'] == '1') {
                $arr_reg[$reg_uid]['in_money'] += $class_pay;
            } else {
                $arr_reg[$reg_uid]['un_money'] += $class_pay;
            }
            $arr_reg[$reg_uid]['name'] = $data['reg_name'];

            if ($data['reg_grade'] == _MD_KWCLUB_KG) {
                $grade = _MD_KWCLUB_KINDERGARTEN;
            } else {
                $grade = $data['reg_grade'] . '年';
            }

            $arr_reg[$reg_uid]['class'] = $grade.$data['reg_class'];

            $arr_reg[$reg_uid]['data'][$class_id] = $data;
        }

        return $arr_reg;
    }
}


//取得期別的所有社團編號
function get_class_num()
{
    global $xoopsDB;
    //確認期別
    if (!isset($_SESSION['club_year'])) {
        return false;
    } else {
        $year = $_SESSION['club_year'];
        $sql  = "select `class_num` from `" . $xoopsDB->prefix("kw_club_class") . "`  where `club_year` = '{$year}'";
        // echo $sql;
        $result = $xoopsDB->query($sql) or web_error($sql);
        while (list($class_num) = $xoopsDB->fetchRow($result)) {
            $data[] = $class_num;
        }

        //  die($data[0]);
        return $data;
    }

}

//以流水號取得某筆社團資料
function get_club_class($class_id = '')
{
    global $xoopsDB;

    if (empty($class_id)) {
        return false;
        exit;
    }

    $sql    = "select * from `" . $xoopsDB->prefix("kw_club_class") . "`  where `class_id` = '{$class_id}'";
    $result = $xoopsDB->query($sql) or web_error($sql);
    $data   = $xoopsDB->fetchArray($result);
    return $data;
}

//以class_id取得多筆kw_club_reg資料(報名人數)
function check_class_reg($class_id = '')
{
    global $xoopsDB;

    if (empty($class_id)) {
        return;
    }
    $sql    = "select * from `" . $xoopsDB->prefix("kw_club_reg") . "`  where `class_id` = '{$class_id}'";
    $result = $xoopsDB->query($sql) or web_error($sql);
    $data   = $xoopsDB->fetchArray($result);
    return true;
}

//以流水號取得某筆kw_club_reg報名資料
function get_reg($reg_sn = '')
{
    global $xoopsDB;

    if (empty($reg_sn)) {
        return;
    }

    $sql    = "select * from `" . $xoopsDB->prefix("kw_club_reg") . "`  where `reg_sn` = '{$reg_sn}'";
    $result = $xoopsDB->query($sql) or web_error($sql);
    $data   = $xoopsDB->fetchArray($result);
    return $data;
}

//取得所有社團類型陣列
function get_cate_all()
{
    global $xoopsDB;
    $sql      = "select * from `" . $xoopsDB->prefix("kw_club_cate") . "`";
    $result   = $xoopsDB->query($sql) or web_error($sql);
    $data_arr = array();
    while ($data = $xoopsDB->fetchArray($result)) {
        $cate_id            = $data['cate_id'];
        $data_arr[$cate_id] = $data;
    }
    return $data_arr;
}

//取得所有社團地點陣列
function get_place_all()
{
    global $xoopsDB;
    $sql      = "select * from `" . $xoopsDB->prefix("kw_club_place") . "`";
    $result   = $xoopsDB->query($sql) or web_error($sql);
    $data_arr = array();
    while ($data = $xoopsDB->fetchArray($result)) {
        $cate_id            = $data['place_id'];
        $data_arr[$cate_id] = $data;
    }
    return $data_arr;
}

//取得所有社團老師陣列
function get_teacher_all()
{
    global $xoopsDB;
    $member_handler = xoops_gethandler('member');
    //開課教師
    $groupid = group_id_from_name(_MD_KWCLUB_TEACHER_GROUP);
    $sql     = "select b.* from `" . $xoopsDB->prefix("groups_users_link") . "` as a
   join " . $xoopsDB->prefix("users") . " as b on a.`uid`=b.`uid`
   where a.`groupid`='{$groupid}' order by b.`name`";
    $result      = $xoopsDB->query($sql) or web_error($sql);
    $arr_teacher = array();
    while ($teacher = $xoopsDB->fetchArray($result)) {
        $uid            = $teacher['uid'];
        $user           = $member_handler->getUser($uid);
        $user_avatar    = $user->user_avatar();
        $teacher['pic'] = ($user_avatar != 'blank.gif') ? XOOPS_URL . "/uploads/" . $user_avatar : XOOPS_URL . "/uploads/avatars/blank.gif";

        $arr_teacher[$uid] = $teacher;
    }
    return $arr_teacher;
}

//取得所有社團資料陣列
function get_class_all()
{
    global $xoopsDB;

    if (isset($_SESSION['club_year'])) {
        $year = $_SESSION['club_year'];

        $sql      = "select * from `" . $xoopsDB->prefix("kw_club_class") . "` where `club_year`= {$year}";
        $result   = $xoopsDB->query($sql) or web_error($sql);
        $data_arr = array();
        while ($data = $xoopsDB->fetchArray($result)) {
            $class_id            = $data['class_id'];
            $data_arr[$class_id] = $data;
        }
        return $data_arr;
    } else {
        return _MD_KWCLUB_NEED_CLUB_YEAR;
    }
}

//取得社團開課所有期別
function get_all_year($only_enable = true)
{
    global $xoopsDB;
    $and_enable = $only_enable ? "and club_enable='1'" : '';
    $sql        = "select club_year from `" . $xoopsDB->prefix("kw_club_info") . "` where 1 $and_enable order by `club_year` desc";
    $result     = $xoopsDB->query($sql) or web_error($sql);
    $arr_year   = array();
    while (list($club_year) = $xoopsDB->fetchRow($result)) {
        $club_year_text       = club_year_to_text($club_year);
        $arr_year[$club_year] = $club_year_text;
    }
    return $arr_year;
}

//取得學期
function get_semester()
{
    global $semester_name_arr, $xoopsDB;

    $sql    = "select club_year, club_start_date, club_end_date from `" . $xoopsDB->prefix("kw_club_info") . "` order by club_year desc";
    $result = $xoopsDB->query($sql) or web_error($sql);
    while (list($club_year, $club_start_date, $club_end_date) = $xoopsDB->fetchRow($result)) {
        $all_semester[$club_year] = substr($club_start_date, 0, 10) . '~' . substr($club_end_date, 0, 10);
    }

    //semester and year
    $arr_time  = getdate();
    $this_week = $arr_time['wday'];

    if ($arr_time['mon'] >= 1 && $arr_time['mon'] <= 4) // 2 3 4 (第二學期)
    {
        $this_semester = '02';
        $this_year     = $arr_time['year'] - 1912;

    } else if ($arr_time['mon'] > 7 && $arr_time['mon'] <= 11) //8-11 (第一學期)
    {
        $this_semester = '01';
        $this_year     = $arr_time['year'] - 1911;

    } else if ($arr_time['mon'] == 12) //12-01 (寒假)
    {
        $this_semester = '11';
        $this_year     = $arr_time['year'] - 1911;

    } else if ($arr_time['mon'] > 4 && $arr_time['mon'] <= 7) //5-7 (暑假)
    {
        $this_semester = '00';
        $this_year     = $arr_time['year'] - 1911;

    }

    $last_year = $this_year - 1;
    $next_year = $this_year + 1;
    // $summer_semester='00';
    // $first_semester='01';
    // $winter_semester='11';
    // $second_semester='02';

    foreach ($semester_name_arr as $k => $v) {
        $semester[$this_year . $k]['opt'] = $this_year . " " . $v;
        if (isset($all_semester[$this_year . $k])) {
            $semester[$this_year . $k]['opt'] .= " ({$all_semester[$this_year . $k]})";
            $semester[$this_year . $k]['disabled'] = true;
        }
    }
    foreach ($semester_name_arr as $k => $v) {
        $semester[$next_year . $k]['opt'] = $next_year . " " . $v;
        if (isset($all_semester[$next_year . $k])) {
            $semester[$next_year . $k]['opt'] .= " ({$all_semester[$next_year . $k]})";
            $semester[$next_year . $k]['disabled'] = true;
        }
    }

    return $semester;

}

function get_ip()
{

    if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    } elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    } elseif (!empty($_SERVER["REMOTE_ADDR"])) {
        $ip = $_SERVER["REMOTE_ADDR"];
    } else {
        $ip = "noip";
    }
    return $ip;
}

function mk_json($class_id)
{
    global $xoopsDB, $TadUpFiles;
    if (empty($class_id)) {
        return flase;
    } else {
        $myts = MyTextSanitizer::getInstance();

        $tbl       = $xoopsDB->prefix('kw_club_class');
        $sql       = "SELECT * FROM `$tbl` where `class_id`={$class_id} ";
        $result    = $xoopsDB->query($sql) or web_error($sql);
        $class     = $xoopsDB->fetchArray($result);
        $class_num = $class['class_num'];
        $json      = json_encode($class, JSON_UNESCAPED_UNICODE);
        file_put_contents(XOOPS_ROOT_PATH . "/uploads/kw_club/class/{$class_num}.json", $json);

        return true;
    }
}

//取得某一篇js_class
function js_class($class_num)
{
    global $xoopsDB, $xoopsTpl;

    if (file_exists(XOOPS_ROOT_PATH . "/uploads/kw_club/class/$class_num.json")) {
        $json = file_get_contents(XOOPS_URL . "/uploads/kw_club/class/$class_num.json");
        $arr  = json_decode($json, true);
        return $arr;
    } else {
        return false;
    }

}


//列出所有kw_club_cate資料
function cate_list($type)
{
    global $xoopsDB, $xoopsTpl;

    $myts = MyTextSanitizer::getInstance();

    $sql    = "select * from `" . $xoopsDB->prefix('kw_club_' . $type) . "` order by " . $type . "_sort";
    $result = $xoopsDB->query($sql) or web_error($sql);

    $all_content = array();
    while ($all = $xoopsDB->fetchArray($result)) {

        //過濾讀出的變數值
        $all["{$type}_title"] = $myts->htmlSpecialChars($all["{$type}_title"]);
        $all["{$type}_desc"]  = $myts->htmlSpecialChars($all["{$type}_desc"]);
        $all_content[]        = $all;
    }

    //刪除確認的JS
    if (!file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/sweet_alert.php")) {
        redirect_header("index.php", 3, _MD_NEED_TADTOOLS);
    }
    include_once XOOPS_ROOT_PATH . "/modules/tadtools/sweet_alert.php";
    $sweet_alert_obj = new sweet_alert();
    $sweet_alert_obj->render("delete_{$type}_func", "{$_SERVER['PHP_SELF']}?type={$type}&op=delete_{$type}&{$type}_id=", "{$type}_id");

    $xoopsTpl->assign('action', "{$_SERVER['PHP_SELF']}?type={$type}");
    $xoopsTpl->assign("all_{$type}_content", $all_content);
}

//刪除reg某筆資料資料
function delete_reg()
{
    global $xoopsDB;
    if (!$_SESSION['isclubAdmin'] and !$_SESSION['isclubUser']) {
        redirect_header($_SERVER['PHP_SELF'], 3, _TAD_PERMISSION_DENIED);
    }
    $reg_sn   = system_CleanVars($_REQUEST, 'reg_sn', '0', 'int');
    $class_id = system_CleanVars($_REQUEST, 'class_id', '0', 'int');
    $uid      = system_CleanVars($_REQUEST, 'uid', '0', 'string');

    if (empty($reg_sn)) {
        redirect_header("{$_SERVER['PHP_SELF']}?op=myclass&uid={$uid}", 3, _MD_KWCLUB_NEED_REG_SN);
    } else {
        $arr      = get_reg($reg_sn);
        $class_id = $arr['class_id'];
    }

    $sql = "update `" . $xoopsDB->prefix("kw_club_class") . "`
    set `class_regnum` =`class_regnum`-1   where `class_id` = '{$class_id}'";
    $xoopsDB->queryF($sql);

    $sql = "delete from `" . $xoopsDB->prefix("kw_club_reg") . "`  where `reg_sn` = '{$reg_sn}'";
    $xoopsDB->queryF($sql) or web_error($sql);
    return $class_id;
}

//根據名稱找群組編號
function group_id_from_name($group_name = "")
{
    global $xoopsDB;
    $sql           = "select groupid from " . $xoopsDB->prefix("groups") . " where `name`='{$group_name}'";
    $result        = $xoopsDB->queryF($sql) or web_error($sql);
    list($groupid) = $xoopsDB->fetchRow($result);
    return $groupid;
}

//判斷身份
function isclub($group_name = '')
{
    global $xoopsUser;
    if ($xoopsUser) {
        $groupid = group_id_from_name($group_name);
        var_dump($groupid);
        if ($groupid) {
            $groups = $xoopsUser->getGroups();
            var_dump($groups);
            if (in_array($groupid, $groups)) {
                return true;
            }
        }
    }
    return false;
}

//檢查是否為報名時間
function chk_time($mode = '', $club_start_date = '', $club_end_date = '')
{
    $today              = time();
    $club_start_date_ts = empty($club_start_date) ? $_SESSION['club_start_date_ts'] : strtotime($club_start_date);
    $club_end_date_ts   = empty($club_end_date) ? $_SESSION['club_end_date_ts'] : strtotime($club_end_date);

    if ($club_start_date_ts > $today || $club_end_date_ts < $today) {
        if ($mode == 'return') {
            return false;
        } else {
            redirect_header("index.php", 5, _MD_KWCLUB_NOT_REG_TIME." {$club_start_date} ~ {$club_end_date}");
        }
    }
    return true;
}

//將期別編號轉為文字
function club_year_to_text($club_year = '')
{
    global $semester_name_arr;
    $year          = substr($club_year, 0, 3);
    $st            = substr($club_year, -2);
    $club_year_txt = $year . _MD_KWCLUB_SCHOOL_YEAR . $semester_name_arr[$st];
    return $club_year_txt;
}

//取得報名資料
function get_class_reg($club_year, $class_id = '', $order = '', $show_PageBar = false)
{
    global $xoopsDB, $xoopsTpl,$xoopsModuleConfig;

    $myts = MyTextSanitizer::getInstance();

    $and_class_id = $class_id ? " and a.`class_id`='{$class_id}'" : '';

    $sql = "select a.*,b.* from `" . $xoopsDB->prefix("kw_club_reg") . "` as a
    join `" . $xoopsDB->prefix("kw_club_class") . "` as b on a.`class_id` = b.`class_id`
    where b.`club_year`={$club_year} {$and_class_id} {$order}";

    if ($show_PageBar) {
        //getPageBar($原sql語法, 每頁顯示幾筆資料, 最多顯示幾個頁數選項);
        $PageBar = getPageBar($sql, 20, 10);
        $bar     = $PageBar['bar'];
        $sql     = $PageBar['sql'];
        $total   = $PageBar['total'];

        if ($xoopsTpl) {
            $xoopsTpl->assign('bar', $bar);
            $xoopsTpl->assign('total', $total);
        }
    }
    $result = $xoopsDB->query($sql) or web_error($sql);

    include_once XOOPS_ROOT_PATH . "/modules/tadtools/jeditable.php";
    $file      = "save.php";
    $jeditable = new jeditable();
    //此處加入欲直接點擊編輯的欄位設定
    $file = "ajax.php";

    //製作年級選單
    foreach ($xoopsModuleConfig['school_grade'] as $grade) {
        if ($grade == _MD_KWCLUB_KG) {
            $grade_name = _MD_KWCLUB_KINDERGARTEN;
        } else {
            $grade_name = $grade . _MD_KWCLUB_GRADE;
        }
        $g_arr[$grade] = $grade_name;

    }
    $grade_opt = json_encode($g_arr, 256);
    $grade_opt = substr(str_replace('"', "'", $grade_opt), 1, -1);

    //製作班級選單
    $reg_class_arr = explode(';', $xoopsModuleConfig['school_class']);
    foreach ($reg_class_arr as $class_name) {
        $class_name         = trim($class_name);
        $c_arr[$class_name] = $class_name;
    }
    $class_opt = json_encode($c_arr, 256);
    $class_opt = substr(str_replace('"', "'", $class_opt), 1, -1);

    $all_reg = array();
    while ($all = $xoopsDB->fetchArray($result)) {

        //將是/否選項轉換為圖示
        $all['reg_isfee_pic'] = $all['reg_isfee'] == 1 ? '<img src="' . XOOPS_URL . '/modules/kw_club/images/yes.gif" alt="' . _YES . '" title="' . _YES . '">' : '<img src="' . XOOPS_URL . '/modules/kw_club/images/no.gif" alt="' . _NO . '" title="' . _NO . '">';
        $all['class_pay']     = $all['class_money'] + $all['class_fee'];

        $all_reg[] = $all;

        $jeditable->setTextCol("#reg_name_{$all['reg_sn']}", $file, '80px', '1em', "{reg_sn: {$all['reg_sn']} ,op : 'update_reg'}", _MD_KWCLUB_CLICK_TO_EDIT);
        $jeditable->setSelectCol("#reg_isreg_{$all['reg_sn']}", $file, "{'"._MD_KWCLUB_OFFICIALLY_ENROLL."':'"._MD_KWCLUB_OFFICIALLY_ENROLL."' , '"._MD_KWCLUB_CANDIDATE."':'"._MD_KWCLUB_CANDIDATE."' , 'selected':'"._MD_KWCLUB_OFFICIALLY_ENROLL."'}", "{reg_sn: {$all['reg_sn']} ,op : 'update_reg'}", _MD_KWCLUB_CLICK_TO_EDIT);
        $jeditable->setSelectCol("#reg_grade_{$all['reg_sn']}", $file, "{ $grade_opt , 'selected':'{$all['reg_grade']}'}", "{reg_sn: {$all['reg_sn']} ,op : 'update_reg'}", _MD_KWCLUB_CLICK_TO_EDIT);
        $jeditable->setSelectCol("#reg_class_{$all['reg_sn']}", $file, "{ $class_opt , 'selected':'{$all['reg_grade']}'}", "{reg_sn: {$all['reg_sn']} ,op : 'update_reg'}", _MD_KWCLUB_CLICK_TO_EDIT);
        $jeditable->setTextCol("#reg_uid_{$all['reg_sn']}", $file, '100px', '1em', "{reg_sn: {$all['reg_sn']} ,op : 'update_reg'}", _MD_KWCLUB_CLICK_TO_EDIT);
    }
    $jeditable->render();

    //刪除確認的JS
    {
        if (!file_exists(XOOPS_ROOT_PATH . "/modules/tadtools/sweet_alert.php")) {
            redirect_header("index.php", 3, _MD_NEED_TADTOOLS);
        }
    }

    include_once XOOPS_ROOT_PATH . "/modules/tadtools/sweet_alert.php";
    $sweet_alert_obj = new sweet_alert();
    $sweet_alert_obj->render('delete_reg_func', "{$_SERVER['PHP_SELF']}?op=delete_reg&reg_sn=", "reg_sn");

    return $all_reg;
}
