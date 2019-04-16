<?php

xoops_loadLanguage('blocks', 'kw_club');
xoops_loadLanguage('main', 'kw_club');

require_once __DIR__ . '/function.php';

$semester_name_arr = ['00' => _MD_KWCLUB_YEAR_TEXT_00, '01' => _MD_KWCLUB_YEAR_TEXT_01, '11' => _MD_KWCLUB_YEAR_TEXT_11, '02' => _MD_KWCLUB_YEAR_TEXT_02];
$grade_name_arr    = [_MD_KWCLUB_GRADE0, _MD_KWCLUB_GRADE1, _MD_KWCLUB_GRADE2, _MD_KWCLUB_GRADE3, _MD_KWCLUB_GRADE4, _MD_KWCLUB_GRADE5, _MD_KWCLUB_GRADE6, _MD_KWCLUB_GRADE7, _MD_KWCLUB_GRADE8, _MD_KWCLUB_GRADE9, _MD_KWCLUB_GRADE10, _MD_KWCLUB_GRADE11, _MD_KWCLUB_GRADE12];

//列出所有社團資料
if (!function_exists('club_class_list')) {
    function club_class_list($club_year = '', $mode = '')
    {
        global $xoopsDB, $xoopsUser, $xoopsTpl, $today;
        $arr_year = get_all_year();
        //這要在前面，才能產生 $_SESSION['club_year']
        $club_info = get_club_info($club_year);
        $club_year = empty($club_year) ? $club_info['club_year'] : $club_year;
        // die(var_export($club_year));
        $chk_time = chk_time('return');
        //已有設定社團期別
        if (!empty($club_year)) {
            //社團列表
            $and_enable = $_SESSION['isclubAdmin'] ? '' : "and class_isopen='1'";
            $myts       = MyTextSanitizer::getInstance();
            $sql        = 'select * from `' . $xoopsDB->prefix('kw_club_class') . "` where `club_year`= '{$club_year}' $and_enable order by class_num ";
            $result = $xoopsDB->query($sql) or web_error($sql);
            $total = $xoopsDB->getRowsNum($result);

            //取得分類所有資料陣列
            $all_cate_arr      = get_cate_all();
            $all_place_arr     = get_place_all();
            $all_teacher_arr   = get_teacher_all();
            $all_class_content = [];
            $i                 = 0;
            while (false !== ($all = $xoopsDB->fetchArray($result))) {
                //以下會產生這些變數： $class_id, $club_year, $class_num, $cate_id, $class_title, $teacher_id, $class_week, $class_date_open, $class_date_close, $class_time_start, $class_time_end, $place_id, $class_member, $class_money, $class_fee, $class_regnum, $class_note, $class_date_start, $class_date_end, $class_ischecked, $class_isopen, $class_desc
                foreach ($all as $k => $v) {
                    $$k = $v;
                }

                $all_class_content[$i]['class_id']         = (int)$class_id;
                $all_class_content[$i]['club_year']        = $myts->htmlSpecialChars($club_year);
                $all_class_content[$i]['class_num']        = (int)$class_num;
                $all_class_content[$i]['class_title']      = $myts->htmlSpecialChars($class_title);
                $all_class_content[$i]['class_week']       = $myts->htmlSpecialChars($class_week);
                $all_class_content[$i]['class_grade']      = $myts->htmlSpecialChars($class_grade);
                $all_class_content[$i]['class_date_open']  = $myts->htmlSpecialChars($class_date_open);
                $all_class_content[$i]['class_date_close'] = $myts->htmlSpecialChars($class_date_close);
                $all_class_content[$i]['class_time_start'] = $myts->htmlSpecialChars($class_time_start);
                $all_class_content[$i]['class_time_end']   = $myts->htmlSpecialChars($class_time_end);
                $all_class_content[$i]['cate_id']          = $myts->htmlSpecialChars($all_cate_arr[$cate_id]);
                $all_class_content[$i]['teacher_id']       = (int)$teacher_id;
                $all_class_content[$i]['teacher_id_title'] = $myts->htmlSpecialChars($all_teacher_arr[$teacher_id]);
                $all_class_content[$i]['place_id']         = $myts->htmlSpecialChars($all_place_arr[$place_id]);
                $all_class_content[$i]['class_member']     = (int)$class_member;
                $all_class_content[$i]['class_money']      = (int)$class_money;
                $all_class_content[$i]['class_fee']        = (int)$class_fee;
                $all_class_content[$i]['class_pay']        = $class_money + $class_fee;
                $all_class_content[$i]['class_regnum']     = (int)$class_regnum;
                $all_class_content[$i]['class_note']       = $myts->htmlSpecialChars($class_note);
                $all_class_content[$i]['class_date_start'] = $myts->htmlSpecialChars($class_date_start);
                $all_class_content[$i]['class_date_end']   = $myts->htmlSpecialChars($class_date_end);
                $all_class_content[$i]['class_ischecked']  = (int)$class_ischecked;
                $all_class_content[$i]['class_isopen']     = (int)$class_isopen;
                $all_class_content[$i]['class_isopen_pic'] = $class_isopen ? '<img src="' . XOOPS_URL . '/modules/kw_club/images/yes.gif" alt="' . _YES . '" title="' . _YES . '">' : '<img src="' . XOOPS_URL . '/modules/kw_club/images/no.gif" alt="' . _NO . '" title="' . _NO . '">';
                $all_class_content[$i]['class_desc']       = $myts->displayTarea($class_desc, 1, 1, 0, 1, 0);
                $all_class_content[$i]['class_uid']        = (int)$class_uid;
                //是否報名額滿
                $all_class_content[$i]['is_full'] = (($class_member + $club_info['club_backup_num']) <= $class_regnum) ? true : false;
                $i++;
            }

            //刪除確認的JS
            if (!file_exists(XOOPS_ROOT_PATH . '/modules/tadtools/sweet_alert.php')) {
                redirect_header('index.php', 3, _MD_NEED_TADTOOLS);
            }
            require_once XOOPS_ROOT_PATH . '/modules/tadtools/sweet_alert.php';
            $sweet_alert_obj = new sweet_alert();
            $sweet_alert_obj->render('delete_class_func', 'club.php?op=delete_class&class_id=', 'class_id');
        } else {
            if ('return' === $mode) {
                return;
            }
            $xoopsTpl->assign('error', _MD_KWCLUB_NEED_CONFIG);
        }

        if ('return' === $mode) {
            $block['arr_year']  = $arr_year;
            $block['club_info'] = $club_info;
            $block['club_year'] = $club_year;
            // $block['club_year_text']    = $club_year_text;
            $block['chk_time']          = $chk_time;
            $block['can_operate']       = true;
            $block['all_class_content'] = $all_class_content;
            $block['total']             = $total;

            return $block;
        }
        $uid = $xoopsUser ? $xoopsUser->uid() : '';
        $xoopsTpl->assign('uid', $uid);

        //取得社團期別陣列
        $xoopsTpl->assign('arr_year', $arr_year);
        $xoopsTpl->assign('club_info', $club_info);
        $xoopsTpl->assign('club_year', $club_year);
        // $xoopsTpl->assign('club_year_text', club_year_text($club_year));
        //檢查報名是否可行
        $xoopsTpl->assign('chk_time', $chk_time);
        $xoopsTpl->assign('language', $_SESSION['language']);

        //超過報名截止時間即停止報名及修改
        // $xoopsTpl->assign('can_operate', chk_time('return', true));
        $xoopsTpl->assign('can_operate', true);
        $xoopsTpl->assign('all_class_content', $all_class_content);
        $xoopsTpl->assign('total', $total);
    }
}

//將期別編號轉為文字
if (!function_exists('club_year_text')) {
    function club_year_text($club_year = '')
    {
        global $semester_name_arr;
        $year           = mb_substr($club_year, 0, 3);
        $st             = mb_substr($club_year, -2);
        $club_year_text = $year . _MD_KWCLUB_SCHOOL_YEAR . $semester_name_arr[$st];

        return $club_year_text;
    }
}

//取得社團開課所有期別
if (!function_exists('get_all_year')) {
    function get_all_year($only_enable = true)
    {
        global $xoopsDB;
        $and_enable = $only_enable ? "and club_enable='1'" : '';
        $sql        = 'select club_year from `' . $xoopsDB->prefix('kw_club_info') . "` where 1 $and_enable order by `club_id` desc";
        $result = $xoopsDB->query($sql) or web_error($sql);
        $arr_year = [];
        while (list($club_year) = $xoopsDB->fetchRow($result)) {
            // $club_year_text       = club_year_text($club_year);
            $arr_year[$club_year] = $club_year;
        }

        return $arr_year;
    }
}

//從json中取得社團期別資料（會在header.php中讀取）
if (!function_exists('get_club_info')) {
    function get_club_info($club_year = '')
    {
        global $xoopsDB, $xoopsTpl;
        if (empty($_SESSION['club_year']) or $club_year != $_SESSION['club_year']) {
            if ($club_year) {
                $sql = 'select * from `' . $xoopsDB->prefix('kw_club_info') . "` where `club_enable`='1' and `club_year`='{$club_year}'";
            } else {
                $sql = 'select * from `' . $xoopsDB->prefix('kw_club_info') . "` where `club_enable`='1' order by club_start_date desc limit 0,1";
            }
            // die($sql);
            $result = $xoopsDB->query($sql) or web_error($sql);
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
}

//檢查是否為報名時間
if (!function_exists('chk_time')) {
    function chk_time($mode = '', $only_end = false, $club_start_date = '', $club_end_date = '')
    {
        $today              = time();
        $club_start_date_ts = empty($club_start_date) ? $_SESSION['club_start_date_ts'] : strtotime($club_start_date);
        $club_end_date_ts   = empty($club_end_date) ? $_SESSION['club_end_date_ts'] : strtotime($club_end_date);

        if (($only_end and $club_end_date_ts < $today) or ($club_start_date_ts > $today || $club_end_date_ts < $today)) {
            if ('return' === $mode) {
                return false;
            }
            if ($only_end) {
                redirect_header(XOOPS_URL . '/modules/kw_club/index.php', 5, _MD_KWCLUB_OVER_END_TIME);
            } else {
                redirect_header(XOOPS_URL . '/modules/kw_club/index.php', 5, _MD_KWCLUB_NOT_REG_TIME . " {$club_start_date} ~ {$club_end_date}");
            }
        } else {
            return true;
        }
    }
}

//取得所有社團類型陣列
if (!function_exists('get_cate_all')) {
    function get_cate_all()
    {
        global $xoopsDB;
        $sql = 'select `cate_id`, `cate_title` from `' . $xoopsDB->prefix('kw_club_cate') . "` where `cate_enable`='1' order by `cate_sort`";
        $result = $xoopsDB->query($sql) or web_error($sql);
        while (list($cate_id, $cate_title) = $xoopsDB->fetchRow($result)) {
            $options_array_cate[$cate_id] = $cate_title;
        }

        return $options_array_cate;
        // global $xoopsDB;
        // $sql      = "select * from `" . $xoopsDB->prefix("kw_club_cate") . "`";
        // $result   = $xoopsDB->query($sql) or web_error($sql);
        // $data_arr = array();
        // while (false !== ($data = $xoopsDB->fetchArray($result))) {
        //     $cate_id            = $data['cate_id'];
        //     $data_arr[$cate_id] = $data;
        // }
        // return $data_arr;
    }
}

//取得所有社團地點陣列
if (!function_exists('get_place_all')) {
    function get_place_all()
    {
        global $xoopsDB;
        $sql = 'select `place_id`, `place_title` from `' . $xoopsDB->prefix('kw_club_place') . "` where `place_enable`='1' order by `place_sort`";
        $result = $xoopsDB->query($sql) or web_error($sql);
        while (list($place_id, $place_title) = $xoopsDB->fetchRow($result)) {
            $options_array_place[$place_id] = $place_title;
        }

        return $options_array_place;
        // $sql      = "select * from `" . $xoopsDB->prefix("kw_club_place") . "`";
        // $result   = $xoopsDB->query($sql) or web_error($sql);
        // $data_arr = array();
        // while (false !== ($data = $xoopsDB->fetchArray($result))) {
        //     $cate_id            = $data['place_id'];
        //     $data_arr[$cate_id] = $data;
        // }
        // return $data_arr;
    }
}

//取得所有社團老師陣列
if (!function_exists('get_teacher_all')) {
    function get_teacher_all()
    {
        global $xoopsDB;
        $sql = 'select `teacher_id`, `teacher_title` from `' . $xoopsDB->prefix('kw_club_teacher') . "` where `teacher_enable`='1' order by `teacher_sort`";
        $result = $xoopsDB->query($sql) or web_error($sql);
        while (list($teacher_id, $teacher_title) = $xoopsDB->fetchRow($result)) {
            $options_array_teacher[$teacher_id] = $teacher_title;
        }

        return $options_array_teacher;
    }
}

//取得所有社團老師陣列
if (!function_exists('get_innerteacher_all')) {
    function get_innerteacher_all()
    {
        global $xoopsDB;
        /* @var XoopsMemberHandler $memberHandler */
        $memberHandler = xoops_getHandler('member');
        //開課教師
        $groupid = group_id_from_name(_MD_KWCLUB_TEACHER_GROUP);
        $sql     = 'select b.* from `' . $xoopsDB->prefix('groups_users_link') . '` as a
    join ' . $xoopsDB->prefix('users') . " as b on a.`uid`=b.`uid`
    where a.`groupid`='{$groupid}' order by b.`name`";
        $result = $xoopsDB->query($sql) or web_error($sql);
        $arr_teacher = [];
        while (false !== ($teacher = $xoopsDB->fetchArray($result))) {
            $uid            = $teacher['uid'];
            $user           = $memberHandler->getUser($uid);
            $user_avatar    = $user->user_avatar();
            $teacher['bio'] = $teacher['bio'];
            $teacher['pic'] = ('blank.gif' !== $user_avatar) ? XOOPS_URL . '/uploads/' . $user_avatar : XOOPS_URL . '/uploads/avatars/blank.gif';

            $arr_teacher[$uid] = $teacher;
        }

        return $arr_teacher;
    }
}

//根據名稱找群組編號
if (!function_exists('group_id_from_name')) {
    function group_id_from_name($group_name = '')
    {
        global $xoopsDB;
        $sql = 'select groupid from ' . $xoopsDB->prefix('groups') . " where `name`='{$group_name}'";
        $result = $xoopsDB->queryF($sql) or web_error($sql);
        list($groupid) = $xoopsDB->fetchRow($result);

        return $groupid;
    }
}
