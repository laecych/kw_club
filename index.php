<?php
/*-----------引入檔案區--------------*/
require_once __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'kw_club_index.tpl';
require_once XOOPS_ROOT_PATH . '/header.php';

/*-----------執行動作判斷區----------*/
require_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op           = system_CleanVars($_REQUEST, 'op', '', 'string');
$class_id     = system_CleanVars($_REQUEST, 'class_id', '0', 'int');
$class_enable = system_CleanVars($_REQUEST, 'class_enable', '', 'int');
$cate_id      = system_CleanVars($_REQUEST, 'cate_id', '0', 'int');
$uid          = system_CleanVars($_REQUEST, 'uid', '', 'string');
$club_year    = system_CleanVars($_REQUEST, 'club_year', '', 'string');
$reg_sn       = system_CleanVars($_REQUEST, 'reg_sn', '', 'int');
$reg_uid      = system_CleanVars($_REQUEST, 'reg_uid', '', 'string');

$today = date('Y-m-d');
switch ($op) {
    case 'teacher':
        teacher_list($club_year);
        break;
    case 'myclass':
        myclass($reg_uid, $club_year);
        break;
    case 'reg_form':
        reg_form($class_id);
        break;
    case 'insert_reg':
        insert_reg();
        break;
    case 'delete_reg':
        $class_id = delete_reg();
        if ($_SESSION['isclubAdmin'] || $_SESSION['isclubUser']) {
            //管理者刪
            header("location: {$_SERVER['PHP_SELF']}?class_id={$class_id}");
        } else {
            //自己刪
            header("location: {$_SERVER['PHP_SELF']}?op=myclass&reg_uid={$reg_uid}&club_year={$club_year}");
        }
        exit;

    case 'update_enable':
        update_class_enable($class_id, $class_enable);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    default:
        if ($class_id) {
            class_show($class_id);
            $op = 'class_show';
        } else {
            club_class_list($club_year);
            $op = 'class_list';
        }

        break;
}

/*-----------秀出結果區--------------*/
$xoopsTpl->assign('op', $op);
$xoopsTpl->assign('toolbar', toolbar_bootstrap($interface_menu));
$xoTheme->addStylesheet(XOOPS_URL . '/modules/kw_club/assets/css/module.css');
$xoTheme->addStylesheet(XOOPS_URL . '/modules/tadtools/css/vtable.css');
require_once XOOPS_ROOT_PATH . '/footer.php';

/*-----------function區--------------*/

//報名表單
/**
 * @param string $class_id
 */
function reg_form($class_id = '')
{
    global $xoopsDB, $xoopsTpl, $xoopsUser, $xoopsModuleConfig;

    if (empty($class_id)) {
        redirect_header($_SERVER['PHP_SELF'], 3, _MD_KWCLUB_NEED_CLASS_ID);
    } elseif ('1' == $_SESSION['club_isfree']) { //自由報名
        $class = get_club_class($class_id);
        $xoopsTpl->assign('class', $class);
        $class_grade_arr = explode('、', $class['class_grade']);
        $xoopsTpl->assign('class_grade_arr', $class_grade_arr);
        $xoopsTpl->assign('class_id', $class_id);
        $xoopsTpl->assign('language', $_SESSION['language']);

        $class_arr = explode(';', $xoopsModuleConfig['school_class']);
        foreach ($class_arr as $class_name) {
            $school_class[] = trim($class_name);
        }
        $xoopsTpl->assign('school_class', $school_class);

        //安全性表單
        require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
        $token = new \XoopsFormHiddenToken('XOOPS_TOKEN', 360);
        $xoopsTpl->assign('reg_token', $token->render());

        //套用formValidator驗證機制
        if (!file_exists(TADTOOLS_PATH . '/formValidator.php')) {
            redirect_header('index.php', 3, _TAD_NEED_TADTOOLS);
        }
        require_once TADTOOLS_PATH . '/formValidator.php';
        $formValidator = new formValidator('#regForm', true);
        $formValidator->render();
    }
}

//新增報名資料到reg中
function insert_reg()
{
    global $xoopsDB, $xoopsUser, $today;

    //XOOPS表單安全檢查
    if (!$GLOBALS['xoopsSecurity']->check()) {
        $error = implode('<br>', $GLOBALS['xoopsSecurity']->getErrors());
        redirect_header($_SERVER['PHP_SELF'], 3, $error);
    }

    $myts = MyTextSanitizer::getInstance();

    $class_id  = (int)$_POST['class_id'];
    $class     = get_club_class($class_id);
    $club_year = $class['club_year'];

    //檢查是否設定期別
    if (empty($club_year)) {
        redirect_header("index.php?class_id={$class_id}", 3, _MD_KWCLUB_NEED_CONFIG);
    }

    $club_info = get_club_info($club_year);

    //檢查報名是否可行（但管理員不在此限）
    if (!$_SESSION['isclubAdmin']) {
        chk_time('', false, $club_info['club_start_date'], $club_info['club_end_date']);

        //是否報名額滿
        $is_full = false;
        if ($class['class_regnum'] >= ($class['class_member'] + $club_info['club_backup_num'])) {
            $is_full = true;
            redirect_header("index.php?op=reg_form&class_id={$class_id}", 3, _MD_KWCLUB_CLASS_REGNUM_FULL);
        }

        //驗正是否通過
        // if (isset($_POST['iQapTcha']) && empty($_POST['iQapTcha']) && isset($_SESSION['iQaptcha']) && $_SESSION['iQaptcha']) {
        // } else {
        //     redirect_header("index.php?op=reg_form&class_id={$class_id}", 3, _MD_KWCLUB_CAPTCHA_ERROR);
        // }
    }
    //檢查身分證字號或居留證
    $reg_uid = $myts->addSlashes($_POST['reg_uid']);
    if (!pid_check($reg_uid)) {
        redirect_header("index.php?op=reg_form&class_id={$class_id}", 3, _MD_KWCLUB_PID_WRONG);
    }

    //檢查是否衝堂
    if (check_class_date($reg_uid, $class_id)) {
        redirect_header("index.php?op=reg_form&class_id={$class_id}", 3, _MD_KWCLUB_CLASS_SAME_TIME);
    }

    //檢查其他班級或年級資料値
    if (empty($_POST['reg_grade']) && empty($_POST['reg_class'])) {
        redirect_header("index.php?op=reg_form&class_id={$class_id}", 3, _MD_KWCLUB_GC_WRONG);
    }

    $reg_name   = $myts->addSlashes($_POST['reg_name']);
    $reg_grade  = $myts->addSlashes($_POST['reg_grade']);
    $reg_class  = $myts->addSlashes($_POST['reg_class']);
    $reg_parent = $myts->addSlashes($_POST['reg_parent']);
    $reg_tel    = (int)$myts->addSlashes($_POST['reg_tel']);
    $reg_isreg  = $class['class_member'] > $class['class_regnum'] ? _MD_KWCLUB_OFFICIALLY_ENROLL : _MD_KWCLUB_CANDIDATE;
    $reg_ip     = get_ip();

    $sql = 'INSERT INTO `' . $xoopsDB->prefix('kw_club_reg') . "` (
        `class_id`,`reg_uid`, `reg_name`, `reg_grade`, `reg_class`, `reg_parent`, `reg_tel`, `reg_isreg`, `reg_datetime`,  `reg_ip`) VALUES
        (
            '{$class_id}',
            '{$reg_uid}',
            '{$reg_name}',
            '{$reg_grade}',
            '{$reg_class}',
            '{$reg_parent}',
            '{$reg_tel}',
            '{$reg_isreg}',
            NOW(),
            '{$reg_ip}'
        )";

    if ($xoopsDB->query($sql)) {
        $update_sql = 'update `' . $xoopsDB->prefix('kw_club_class') . "` set `class_regnum`=`class_regnum`+1 where `class_id`={$class_id}";
        $xoopsDB->query($update_sql);

        redirect_header("index.php?op=myclass&reg_uid={$reg_uid}&club_year={$club_year}", 3, _MD_KWCLUB_APPLY_SUCCESS);
    } else {
        redirect_header("index.php?op=myclass&reg_uid={$reg_uid}&club_year={$club_year}", 3, _MD_KWCLUB_REPEAT_APPLY);
    }
}

/**
 * @param $reg_uid
 * @param $class_id
 * @return bool
 */
function check_class_date($reg_uid, $class_id)
{
    global $xoopsDB;

    $arr_reg     = [];
    $check_class = 0;
    $class_new   = get_club_class($class_id);
    $year        = $_SESSION['club_year'];
    $sql         = 'select a.* from `' . $xoopsDB->prefix('kw_club_reg') . '`  as a
    join `' . $xoopsDB->prefix('kw_club_class') . "` as b on a.`class_id` = b.`class_id`
    where a.`reg_uid`='{$reg_uid}' and b.`club_year` = '{$year}'";

    $result = $xoopsDB->query($sql) or web_error($sql);
    while (false !== ($arr = $xoopsDB->fetchArray($result))) {
        $class_reg = get_club_class($arr['class_id']);
        //check the date repeat

        if (!(strtotime($class_reg['class_date_close']) < strtotime($class_new['class_date_open']))
            && !(strtotime($class_reg['class_date_open']) > strtotime($class_new['class_date_close']))) {
            //check the week repeat

            $class_week_reg = explode('、', $class_reg['class_week']);
            $class_week_new = explode('、', $class_new['class_week']);
            foreach ($class_week_new as &$value) {
                if (in_array($value, $class_week_reg)) {
                    // check the time repeat
                    if (!(strtotime($class_reg['class_time_end']) < strtotime($class_new['class_time_start']))
                        && !(strtotime($class_reg['class_time_start']) > strtotime($class_new['class_time_end']))) {
                        $check_class++;
                    }
                }
            }
        }
    }

    if ($check_class > 0) {
        return true;
    }

    return false;
}

// 我的社團
/**
 * @param string $reg_uid
 * @param string $club_year
 */
function myclass($reg_uid = '', $club_year = '')
{
    global $xoopsDB, $xoopsTpl;
    //查詢年度
    $club_year = (empty($club_year) && isset($_SESSION['club_year'])) ? $_SESSION['club_year'] : $club_year;
    $xoopsTpl->assign('club_year', $club_year);
    $xoopsTpl->assign('language', $_SESSION['language']);
    // $xoopsTpl->assign('club_year_text', club_year_text($club_year));
    $reg_name = $arr_reg = '';
    $total = 0;

    //取得社團期別陣列
    $xoopsTpl->assign('arr_year', get_all_year());

    if (empty($reg_uid)) {
        $arr_reg = '';
    } else {
        $money = $in_money = $un_money = 0;

        $myts = MyTextSanitizer::getInstance();
        $sql  = 'select a.*, b.*, c.`club_end_date` from `' . $xoopsDB->prefix('kw_club_reg') . '` as a
        join `' . $xoopsDB->prefix('kw_club_class') . '` as b on a.`class_id` = b.`class_id`
        join `' . $xoopsDB->prefix('kw_club_info') . "` as c on b.`club_year` = c.`club_year`
        where a.`reg_uid` = '{$reg_uid}'  and b.`club_year`='{$club_year}'";
        $result = $xoopsDB->query($sql) or web_error($sql);
        $total = $xoopsDB->getRowsNum($result);

        while (false !== ($data = $xoopsDB->fetchArray($result))) {
            $data['end_date'] = strtotime($data['club_end_date']);

            $class_pay         = $data['class_money'] + $data['class_fee'];
            $data['class_pay'] = $class_pay;

            $arr_reg[] = $data;

            if ('1' == $data['reg_isfee']) {
                $in_money += $class_pay;
            } else {
                $un_money += $class_pay;
            }
            $money += $class_pay;

            // if (!isset($reg_name)) {
            //     $reg_name = $data['reg_name'];
            // }
            $reg_name = $data['reg_name'];
        }
       
        $xoopsTpl->assign('today', time());
        $xoopsTpl->assign('reg_name', $reg_name);
        $xoopsTpl->assign('money', $money);
        $xoopsTpl->assign('in_money', $in_money);
        $xoopsTpl->assign('un_money', $un_money);
        $xoopsTpl->assign('arr_reg', $arr_reg);

        require_once XOOPS_ROOT_PATH . '/modules/tadtools/sweet_alert.php';
        $sweet_alert = new sweet_alert();
        if ($_SESSION['isclubAdmin']) {
            $sweet_alert->render('delete_reg_func', "{$_SERVER['PHP_SELF']}?op=delete_reg&reg_sn=", 'reg_sn');
        } else {
            $sweet_alert->render('delete_reg_func', "{$_SERVER['PHP_SELF']}?op=delete_reg&club_year={$club_year}&reg_uid={$reg_uid}&reg_sn=", 'reg_sn', _MD_KWCLUB_SURE_CANCEL_APPLY, _MD_KWCLUB_CANCEL, _MD_KWCLUB_CANCEL_APPLY);
        }
    }

    $xoopsTpl->assign('total', $total);
    $xoopsTpl->assign('reg_uid', $reg_uid);

    //超過報名截止時間即停止報名及修改
    // $xoopsTpl->assign('can_operate', chk_time('return', true));
    $xoopsTpl->assign('can_operate', true);
}

//顯示某一個社團
/**
 * @param string $class_id
 */
function class_showjson($class_id = '')
{
    global $xoopsTpl, $today;
    if (!file_exists(XOOPS_ROOT_PATH . "/uploads/kw_club/{$class_id}.json")) {
        $json = mk_club_json($class_id);
    } else {
        $json = file_get_contents(XOOPS_URL . "/uploads/kw_club/{$class_id}.json");
    }
    $all = json_decode($json, true);

    //檢查報名是否可行
    chk_time();

    if ($all['class_regnum'] >= ($all['class_member'] + $_SESSION['club_backup_num'])) {
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
/**
 * @param string $class_id
 */
function class_show($class_id = '')
{
    global $xoopsDB, $xoopsUser, $xoopsTpl, $today;

    if (empty($class_id)) {
        redirect_header('index.php', 3, _MD_KWCLUB_NEED_CLASS_ID);
    }

    $uid = $xoopsUser ? $xoopsUser->uid() : '';
    $xoopsTpl->assign('uid', $uid);

    $myts = MyTextSanitizer::getInstance();

    $sql = 'select * from `' . $xoopsDB->prefix('kw_club_class') . "`
    where `class_id` = '{$class_id}' ";
    $result = $xoopsDB->query($sql) or web_error($sql);
    $all = $xoopsDB->fetchArray($result);

    //檢查報名是否可行
    $xoopsTpl->assign('chk_time', chk_time('return'));
    //超過報名截止時間即停止報名及修改
    // $xoopsTpl->assign('can_operate', chk_time('return', true));
    $xoopsTpl->assign('can_operate', true);

    $is_full = false;
    if ($all['class_regnum'] >= ($all['class_member'] + $_SESSION['club_backup_num'])) {
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
    $class_isopen_pic = (1 == $class_isopen) ? '<img src="' . XOOPS_URL . '/modules/kw_club/assets/images/yes.gif" alt="' . _YES . '" title="' . _YES . '">' : '<img src="' . XOOPS_URL . '/modules/kw_club/assets/images/no.gif" alt="' . _NO . '" title="' . _NO . '">';

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
    // $xoopsTpl->assign('club_year_text', club_year_text($club_year));
    $xoopsTpl->assign('class_num', $class_num);
    $xoopsTpl->assign('cate_id', $cate_id);
    $xoopsTpl->assign('cate_id_title', $cate_arr['cate_title']);
    $xoopsTpl->assign('class_title', $class_title);
    $xoopsTpl->assign('teacher_id', $teacher_id);
    $xoopsTpl->assign('teacher_id_title', $teacher_arr[$teacher_id]);
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
    if (isset($class_date_start)) {
        $xoopsTpl->assign('class_date_start', $class_date_start);
    }
    if (isset($class_date_end)) {
        $xoopsTpl->assign('class_date_end', $class_date_end);
    }
    $xoopsTpl->assign('class_ischecked', $class_ischecked);
    $xoopsTpl->assign('class_isopen', $class_isopen);
    $xoopsTpl->assign('class_isopen_pic', $class_isopen_pic);
    $xoopsTpl->assign('class_desc', $class_desc);
    $xoopsTpl->assign('class_uid', $class_uid);

    //已有人報名 報名列表
    if ($class_regnum > 0) {
        //取得報名資料
        $all_reg = get_club_class_reg($club_year, $class_id);
        $xoopsTpl->assign('all_reg', $all_reg);
        $xoopsTpl->assign('total', count($all_reg));
    }

    if ($_SESSION['isclubAdmin'] or $uid == $class_uid) {
        //刪除訊息警告
        if (!file_exists(XOOPS_ROOT_PATH . '/modules/tadtools/sweet_alert.php')) {
            redirect_header('index.php', 3, _MD_NEED_TADTOOLS);
        }
        //刪除班級
        require_once XOOPS_ROOT_PATH . '/modules/tadtools/sweet_alert.php';
        $sweet_alert_obj = new sweet_alert();
        $sweet_alert_obj->render('delete_class_func', 'club.php?op=delete_class&class_id=', 'class_id');

        //刪除報名
        $sweet_alert_obj = new sweet_alert();
        $sweet_alert_obj->render('delete_reg_func', "{$_SERVER['PHP_SELF']}?op=delete_reg&reg_sn=", 'reg_sn');
    }
}

//教師列表
/**
 * @param string $club_year
 */
function teacher_list($club_year = '')
{
    global $xoopsTpl, $xoopsDB;

    $sql = 'select * from `' . $xoopsDB->prefix('kw_club_teacher') . "` where `teacher_enable`='1' order by `teacher_sort`";
    $result = $xoopsDB->query($sql) or web_error($sql);
    $teachers_arr = [];
    while (false !== ($data = $xoopsDB->fetchArray($result))) {
        $id                = $data['teacher_id'];
        $teachers_arr[$id] = $data;
    }
    $xoopsTpl->assign('teachers', $teachers_arr);

    $sql = 'select * from `' . $xoopsDB->prefix('kw_club_class') . "`
    where `class_isopen`='1' order by club_year desc";
    $result = $xoopsDB->query($sql) or web_error($sql);
    $tea_class = [];
    while (false !== ($class = $xoopsDB->fetchArray($result))) {
        $uid                        = $class['teacher_id'];
        $class_id                   = $class['class_id'];
        $tea_class[$uid][$class_id] = $class;
    }
    $xoopsTpl->assign('tea_class', $tea_class);

    if ($_SESSION['isclubAdmin']) {
        require_once XOOPS_ROOT_PATH . '/modules/tadtools/jeditable.php';
        $file      = 'save.php';
        $jeditable = new jeditable();
        //此處加入欲直接點擊編輯的欄位設定
        $file = 'ajax.php';
        //大量文字框
        foreach ($teachers_arr as $uid => $teacher) {
            $jeditable->setTextAreaCol("#bio_{$uid}", $file, '390px', '70px', "{uid: {$uid} ,op : 'update_bio'}", _MD_KWCLUB_CLICK_TO_EDIT);
        }
        $jeditable->render();
    }
}

/**
 * @param $cardid
 * @return bool
 */
function pid_check($cardid)
{
    //先將字母數字存成陣列
    $cardid = mb_strtoupper($cardid); //若輸入英文字母為小寫則轉大寫

    $alphabet = [
        'A' => '10',
        'B' => '11',
        'C' => '12',
        'D' => '13',
        'E' => '14',
        'F' => '15',
        'G' => '16',
        'H' => '17',
        'I' => '34',
        'J' => '18',
        'K' => '19',
        'L' => '20',
        'M' => '21',
        'N' => '22',
        'O' => '35',
        'P' => '23',
        'Q' => '24',
        'R' => '25',
        'S' => '26',
        'T' => '27',
        'U' => '28',
        'V' => '29',
        'W' => '32',
        'X' => '30',
        'Y' => '31',
        'Z' => '33',
    ];
    //檢查字元長度
    if (10 != mb_strlen(trim($cardid))) {
        return false;
    }//長度不對

    //驗證英文字母正確性
    $alpha = mb_substr($cardid, 0, 1); //英文字母
    if (!preg_match('/[A-Za-z]/', $alpha)) {
        return false;
    }
    //計算字母總和
    $nx = $alphabet[$alpha];
    $ns = $nx[0] + $nx[1] * 9; //十位數+個位數x9

    //驗證男女性別
    $gender = mb_substr($cardid, 1, 1); //取性別位置
    if ('1' != $gender && '2' != $gender && 'A' !== $gender && 'B' !== $gender && 'C' !== $gender && 'D' !== $gender) {
        return false;
    }//驗證性別

    //N2x8+N3x7+N4x6+N5x5+N6x4+N7x3+N8x2+N9+N10
    if ('' == $err) {
        $i  = 8;
        $j  = 1;
        $ms = 0;
        //先算 N2x8 + N3x7 + N4x6 + N5x5 + N6x4 + N7x3 + N8x2
        while ($i >= 2) {
            if (1 == $j) {
                $g = mb_substr($cardid, $j, 1);
                switch ($g) {
                    case 'A':
                        $mx = 0;
                        break;
                    case 'B':
                        $mx = 1;
                        break;
                    case 'C':
                        $mx = 2;
                        break;
                    case 'D':
                        $mx = 3;
                        break;
                    default:
                        $mx = $g;
                        break;
                }
            } else {
                $mx = mb_substr($cardid, $j, 1); //由第j筆每次取一個數字
            }

            $my = $mx * $i; //N*$i
            $ms += $my; //ms為加總
            $j++;
            $i--;
        }
        //最後再加上 N9 及 N10
        $ms = $ms + mb_substr($cardid, 8, 1) + mb_substr($cardid, 9, 1);
        //最後驗證除10
        $total = $ns + $ms; //上方的英文數字總和 + N2~N10總和

        return (0 == $total % 10) ? true : false;
    }
}

// function pid_check($pid)
// {
//     $iPidLen = strlen(trim($pid));
//     if (!preg_match('/^[A-Za-z][1-2][0-9]{8}$/', $pid) && $iPidLen != 10) {
//         return false;
//     }
//     $head = array('A' => 1, 'B' => 0, 'C' => 9, 'D' => 8, 'E' => 7, 'F' => 6, 'G' => 5, 'H' => 4, 'I' => 9, 'J' => 3, 'K' => 2, 'M' => 1, 'N' => 0, 'O' => 8, 'P' => 9, 'Q' => 8, 'T' => 5, 'U' => 4, 'V' => 3, 'W' => 1, 'X' => 3, 'Z' => 0, 'L' => 2, 'R' => 7, 'S' => 6, 'Y' => 2);
//     $pid  = strtoupper($pid);
//     $iSum = 0;
//     for ($i = 0; $i < $iPidLen; $i++) {
//         $sIndex = substr($pid, $i, 1);
//         $iSum += (empty($i)) ? $head[$sIndex] : intval($sIndex) * abs(9 - base_convert($i, 10, 9));
//     }
// return ($iSum % 10 == 0) ? true : false;
// }

//改變啟用狀態
/**
 * @param $class_id
 * @param $class_enable
 */
function update_class_enable($class_id, $class_enable)
{
    global $xoopsDB;

    $sql = 'update `' . $xoopsDB->prefix('kw_club_class') . "` set
    `class_isopen` = '{$class_enable}'
    where `class_id` = '$class_id'";
    $xoopsDB->queryF($sql) or web_error($sql);
}
