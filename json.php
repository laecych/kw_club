<?php
include_once "header.php";

include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');
$op       = system_CleanVars($_REQUEST, 'op', '', 'string');
$class_id = system_CleanVars($_REQUEST, 'class_id', 0, 'int');

if (!file_exists(XOOPS_ROOT_PATH . "/uploads/kw_club/{$class_id}.html")) {
    $html = mk_html($class_id);
} else {
    $html = file_get_contents(XOOPS_ROOT_PATH . "/uploads/kw_club/{$class_id}.html");
}

// if ($op == "online") {
header("location: " . XOOPS_URL . "/uploads/kw_club/{$class_id}.html");
// } else {

//     header("Content-type: text/html");
//     header("Content-Disposition: attachment; filename={$sn}.html");
//     echo $html;
// }
exit;
