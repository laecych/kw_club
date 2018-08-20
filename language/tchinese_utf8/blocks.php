<?php
define('_MB_KWCLUB', '社團報名');
define('_MB_KWCLUB_SELECT_YEAR', '請選擇社團期別：');
if ($_SESSION['isclubAdmin']) {
    define('_MB_KWCLUB_NEED_CONFIG', '目前沒有可報名的社團期別，<a href="config.php?op=kw_club_info_form">請先進行社團報名期別設定</a>後，再新增課程！');
} else {
    define('_MB_KWCLUB_NEED_CONFIG', '目前沒有可報名的社團期別，請通知管理員，進行社團報名期別設定！');
}

define('_MB_KWCLUB_LIST', '社團列表');

define('_MB_KWCLUB_PAGEBAR_TOTAL', '（共 %s 筆）');

define('_MB_KWCLUB_APPLY_DATE', '開放報名期間');

define('_MB_KWCLUB_NON_REGISTRATION_TIME', '現在非報名時間');

define('_MB_KWCLUB_OVER_END_TIME', '超過報名截止時間即停止報名及修改');

define('_MB_KWCLUB_ADD_CLUB', '新增社團');

define('_MB_KWCLUB_CLASS_TITLE', '社團名稱');

define('_MB_KWCLUB_CLASS_DATE', '上課日期');
define('_MB_KWCLUB_CLASS_GRADE', '招收對象');

define('_MB_KWCLUB_CLASS_MONEY', '社團學費');
define('_MB_KWCLUB_CLASS_FEE', '額外費用');

define('_MB_KWCLUB_NUMBER_OF_RECRUITED', '招收');
define('_MB_KWCLUB_NUMBER_OF_APPLICANTS', '已報');
define('_MB_KWCLUB_AFTER_REGISTRATION', '候補報名中...');

define('_MB_KWCLUB_APPLY_FROM_TO', '起至');
define('_MB_KWCLUB_1_5', '每星期<span class="text_g">一到五</span>的');
define('_MB_KWCLUB_W', '每星期<span class="text_g">%s</span>的');
define('_MB_KWCLUB_DOLLAR', '元');
define('_MB_KWCLUB_PEOPLE', '人');
define('_MB_KWCLUB_CLASS_ENABLE', '開班');
define('_MB_KWCLUB_CLASS_UNABLE', '不開班');
define('_MB_KWCLUB_CLASS_ENABLE_DESC', '點擊按鈕後，狀態變成正式開班');
define('_MB_KWCLUB_CLASS_UNABLE_DESC', '點擊按鈕後，狀態改成不開班');
define('_MB_KWCLUB_CLASS_BLANK', '未定');
define('_MB_KWCLUB_CLASS_BLANK_DESC', '點擊按鈕後，狀態改成空白');

define('_MB_KWCLUB_OVER_END_TIME', '超過報名截止時間即停止報名及修改');

define('_MB_KWCLUB_FULL_REGISTRATION', '報名額滿');

define('_MB_KWCLUB_SIGNUP_TO_MAKE_UP', '我要報名候補');

define('_MB_KWCLUB_SIGNUP', '我要報名');
define('_MB_KWCLUB_NON_REGISTRATION_TIME', '現在非報名時間');

define('_MB_KWCLUB_EMPTY_CLUB', '此期尚未新增社團！');
