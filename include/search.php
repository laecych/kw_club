<?php
//搜尋程式

function snews_search($queryarray, $andor, $limit, $offset, $userid)
{
    global $xoopsDB;
    if (get_magic_quotes_gpc()) {
        foreach ($queryarray as $k => $v) {
            $arr[$k] = addslashes($v);
        }
        $queryarray = $arr;
    }
    $sql = 'SELECT `class_id`,`class_title`,`class_uid` FROM ' . $xoopsDB->prefix('kw_club_class') . ' WHERE 1';
    if (0 != $userid) {
        $sql .= ' AND uid=' . $userid . ' ';
    }
    if (is_array($queryarray) && $count = count($queryarray)) {
        $sql .= " AND ((`class_title` LIKE '%{$queryarray[0]}%'  OR `class_desc` LIKE '%{$queryarray[0]}%' )";
        for ($i = 1; $i < $count; $i++) {
            $sql .= " $andor ";
            $sql .= "(`class_title` LIKE '%{$queryarray[$i]}%' OR  `class_desc` LIKE '%{$queryarray[$i]}%' )";
        }
        $sql .= ') ';
    }
    $sql    .= 'ORDER BY  `class_datetime` DESC';
    $result = $xoopsDB->query($sql, $limit, $offset);
    $ret    = [];
    $i      = 0;
    while ($myrow = $xoopsDB->fetchArray($result)) {
        $ret[$i]['image'] = 'images/text-lines.png';
        $ret[$i]['link']  = 'index.php?class_id=' . $myrow['class_id'];
        $ret[$i]['title'] = $myrow['class_title'];
        $ret[$i]['time']  = strtotime($myrow['class_datetime']);
        $ret[$i]['uid']   = $myrow['class_uid'];
        $i++;
    }

    return $ret;
}
