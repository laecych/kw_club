<?php
require dirname(dirname(__DIR__)) . '/mainfile.php';
$sort = '';
$op   = $_GET['op'];
if ('update_kw_club_cate_sort' === $op) {
    foreach ($_POST['cateli'] as $cate_id) {
        $sql = 'update ' . $xoopsDB->prefix('kw_club_cate') . " set `cate_sort`='{$sort}' where `cate_id`='{$cate_id}'";
        $xoopsDB->queryF($sql) or die(_TAD_SORT_FAIL . ' (' . date('Y-m-d H:i:s') . ')');
        $sort++;
    }
} elseif ('update_kw_club_place_sort' === $op) {
    foreach ($_POST['placeli'] as $place_id) {
        $sql = 'update ' . $xoopsDB->prefix('kw_club_place') . " set `place_sort`='{$sort}' where `place_id`='{$place_id}'";
        $xoopsDB->queryF($sql) or die(_TAD_SORT_FAIL . ' (' . date('Y-m-d H:i:s') . ')');
        $sort++;
    }
} else {
    foreach ($_POST['teacherli'] as $teacher_id) {
        $sql = 'update ' . $xoopsDB->prefix('kw_club_teacher') . " set `teacher_sort`='{$sort}' where `teacher_id`='{$teacher_id}'";
        $xoopsDB->queryF($sql) or die(_TAD_SORT_FAIL . ' (' . date('Y-m-d H:i:s') . ')');
        $sort++;
    }
}
$sort = 1;

echo 'Sort saved! (' . date('Y-m-d H:i:s') . ')';
