<?php
include "../../mainfile.php";
if ($_GET['op'] == "update_kw_club_cate_sort") {
    foreach ($_POST['cateli'] as $cate_id) {
        $sql = "update " . $xoopsDB->prefix("kw_club_cate") . " set `cate_sort`='{$sort}' where `cate_id`='{$cate_id}'";
        $xoopsDB->queryF($sql) or die(_TAD_SORT_FAIL . " (" . date("Y-m-d H:i:s") . ")");
        $sort++;
    }
} else {
    foreach ($_POST['placeli'] as $place_id) {
        $sql = "update " . $xoopsDB->prefix("kw_club_place") . " set `place_sort`='{$sort}' where `place_id`='{$place_id}'";
        $xoopsDB->queryF($sql) or die(_TAD_SORT_FAIL . " (" . date("Y-m-d H:i:s") . ")");
        $sort++;
    }
}
$sort = 1;

echo "Sort saved! (" . date("Y-m-d H:i:s") . ")";
