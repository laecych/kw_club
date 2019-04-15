<?php
function kw_club_show()
{
    include_once XOOPS_ROOT_PATH . '/modules/kw_club/function_block.php';
    $block = club_class_list('', 'return');

    return $block;
}
