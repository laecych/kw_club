<?php
include_once XOOPS_ROOT_PATH . "/modules/tadtools/language/{$xoopsConfig['language']}/main.php";

//前後台語系
// define('_MD_KWCLUB_CLASS_ID', '社團ID');
define('_MD_KWCLUB_CLASS_YEAR', '社團年度');
define('_MD_KWCLUB_CLASS_TITLE', '社團名稱');
define('_MD_KWCLUB_CLASS_NUM', '編號');
define('_MD_KWCLUB_CATE_ID', '社團類型');
define('_MD_KWCLUB_TEACHER_ID', '講師');
define('_MD_KWCLUB_TEACHER_NAME', '教師姓名');
define('_MD_KWCLUB_TEACHER_EMAIL', '電子信箱');
define('_MD_KWCLUB_CLASS_WEEK', '上課星期');
define('_MD_KWCLUB_CLASS_GRADE', '招收對象');
define('_MD_KWCLUB_CLASS_DATE', '上課日期');
define('_MD_KWCLUB_CLASS_TIME', '上課時間');
define('_MD_KWCLUB_CLASS_DATE_OPEN', '上課起始日');
define('_MD_KWCLUB_CLASS_DATE_CLOSE', '上課終止日');
define('_MD_KWCLUB_CLASS_TIME_START', '起始時間');
define('_MD_KWCLUB_CLASS_TIME_END', '終止時間');
define('_MD_KWCLUB_PLACE_ID', '地點');
define('_MD_KWCLUB_CLASS_MENBER', '招收人數');
define('_MD_KWCLUB_CLASS_MONEY', '社團學費');
define('_MD_KWCLUB_CLASS_FEE', '額外費用');
define('_MD_KWCLUB_CLASS_NOTE', '社團備註');
define('_MD_KWCLUB_CLASS_REGNUM', '報名人數');
define('_MD_KWCLUB_CLASS_REGNUM_FULL', '報名人數已滿！');
define('_MD_KWCLUB_CLASS_REG', '報名');
define('_MD_KWCLUB_CLASS_DATE_START', '報名起始');
define('_MD_KWCLUB_CLASS_DATE_END', '報名終止');
define('_MD_KWCLUB_CLASS_ISOPEN', '是否啟用');
define('_MD_KWCLUB_CLASS_ISCHECKED', '是否開班');
define('_MD_KWCLUB_CLASS_DESC', '社團簡介');
define('_MD_KWCLUB_CLASS_UID', 'UID');
define('_MD_KWCLUB_DOLLAR', '元');
define('_MD_KWCLUB_PEOPLE', '人');

//前台選單
define('_MD_KWCLUB_INDEX_MYCLASS', '我的社團');
define('_MD_KWCLUB_INDEX_TEACHER', '教師簡介');
define('_MD_KWCLUB_INDEX_FORM', '開設課程');
define('_MD_KWCLUB_REG', '報名狀況');

//教師列表
define('_MD_KWCLUB_CATEID', '流水號');
define('_MD_KWCLUB_CATE_TITLE', '名稱');
define('_MD_KWCLUB_CATE_DESC', '簡介');
define('_MD_KWCLUB_CATE_SORT', '排序');
define('_MD_KWCLUB_CATE_ENABLE', '狀態');

define('_MD_KWCLUB_REG_YEAR', '報名年度');
define('_MD_KWCLUB_REG_NAME', '報名者姓名');
define('_MD_KWCLUB_REG_GRADE', '報名者年級');
define('_MD_KWCLUB_REG_CLASS', '報名者班級');
define('_MD_KWCLUB_REG_SN', '報名編號');
define('_MD_KWCLUB_REG_UID', '身分證號');
define('_MD_KWCLUB_REG_DATETIME', '報名日期');
define('_MD_KWCLUB_REG_ISREG', '結果');
define('_MD_KWCLUB_REG_ISFEE', '是否繳費');
define('_MD_KWCLUB_REG_IP', 'IP');

//by tad
if ($_SESSION['isclubAdmin']) {
    define('_MD_KWCLUB_NEED_CONFIG', '目前沒有可報名的社團期別，<a href="config.php?op=kw_club_info_form">請先進行社團報名期別設定</a>後，再新增課程！');
} else {
    define('_MD_KWCLUB_NEED_CONFIG', '目前沒有可報名的社團期別，請通知管理員，進行社團報名期別設定！');
}
define('_MD_KWCLUB_SELECT_YEAR', '請選擇社團期別：');
define('_MD_KWCLUB_EMPTY_YEAR', '目前沒有任何社團期別');
define('_MD_KWCLUB', '社團報名');
define('_MD_KWCLUB_LIST', '社團列表');
define('_MD_KWCLUB_APPLY_DATE', '開放報名期間');
define('_MD_KWCLUB_APPLY_FROM_TO', '起至');
define('_MD_KWCLUB_EMPTY_CLUB', '此期尚未新增社團！');
define('_MD_KWCLUB_FORBBIDEN', '您沒有執行此動作的權限！');
define('_MD_KWCLUB_INFO_SETUP', '社團期別設定');
define('_MD_KWCLUB_YEAR', '社團期別');
define('_MD_KWCLUB_NOW_YEAR', '目前設定的期數是：');
define('_MD_KWCLUB_ADMIN', '期別設定');
define('_MD_KWCLUB_BACKUP_NUM', '候補人數');
define('_MD_KWCLUB_STATISTICS', '報名統計');
define('_MD_KWCLUB_ADD_CLUB', '新增社團');
define('_MD_KWCLUB_ADD_CLUB_INFO', '新增社團期別');
define('_MD_KWCLUB_NEED_CLUB_YEAR', '錯誤！未指定社團期數');

define('_MD_KWCLUB_START_DATE', '報名起始日');
define('_MD_KWCLUB_END_DATE', '報名終止日');
define('_MD_KWCLUB_ISFREE', '報名方式');
define('_MD_KWCLUB_UID', '設定者');
define('_MD_KWCLUB_DATETIME', '設定時間');
define('_MD_KWCLUB_ENABLE', '是否啟用');

define('_MD_KWCLUB_ID', '流水號');
define('_MD_KWCLUB_Y', '期');
define('_MD_KWCLUB_CLUB', '社團');
define('_MD_KWCLUB_PICK_CLUB', '挑選社團');
define('_MD_KWCLUB_ADD_CLASS', '新增課程');
define('_MD_KWCLUB_MODIFY_CLUB', '修改社團');

define('_MD_KWCLUB_SELECT', '請選擇');
define('_MD_KWCLUB_SETUP', '報名設定');

define('_MD_KWCLUB_PLACE_TITLE', '地點');
define('_MD_KWCLUB_PLACE_DESC', '說明');
define('_MD_KWCLUB_PLACE_SORT', '排序');
define('_MD_KWCLUB_PLACE_ENABLE', '狀態');

define('_MD_KWCLUB_ADMIN_GROUP', '社團管理');
define('_MD_KWCLUB_TEACHER_GROUP', '社團老師');
define('_MD_KWCLUB_GROUP_NOTE', '：為社團報名模組用，勿刪，勿修改');

define('_MD_KWCLUB_SETUP_TEACHER', '社團老師設定');

define('_MD_KWCLUB_SORTBY_REG_NAME', '依報名者姓名排序');
define('_MD_KWCLUB_SORTBY_REG_DATETIME', '依報名時間排序');
define('_MD_KWCLUB_SORTBY_CLASS_TITLE', '依社團名稱排序');
define('_MD_KWCLUB_SORTBY_REG_GRADE', '依報名者年級排序');

define('_MD_KWCLUB_TODAY', '今天');
define('_MD_KWCLUB_IS_BACKUP', '是否候補');

define('_MD_KWCLUB_PAY_PDF', '社團報名繳費單');
define('_MD_KWCLUB_TOTAL_PAY', '總學費金額：');
define('_MD_KWCLUB_OTHER_PAY', '額外加收：');
define('_MD_KWCLUB_SIGN', '簽名：');
define('_MD_KWCLUB_PAY_TOTAL', '總繳費金額');

define('_MD_KWCLUB_NEED_CATE_ID', '沒有指定的編號');
define('_MD_KWCLUB_NEED_CLASS_ID', '沒有指定的社團課程編號');
define('_MD_KWCLUB_CLASS_SAME_TIME', '錯誤！社團課程衝堂，請再確認！');

define('_MD_KWCLUB_OFFICIALLY_ENROLL', '正取');
define('_MD_KWCLUB_CANDIDATE', '備取');
define('_MD_KWCLUB_APPLY_SUCCESS', '報名成功！');
define('_MD_KWCLUB_REPEAT_APPLY', '錯誤！重複報名！');

define('_MD_KWCLUB_SURE_CANCEL_APPLY', '確定要取消嗎？');
define('_MD_KWCLUB_CANCEL', '取消');
define('_MD_KWCLUB_CANCEL_APPLY', '是！含淚取消報名！');
define('_MD_KWCLUB_DELETE_APPLY', '取消報名');

define('_MD_KWCLUB_GRADE0', '幼');
define('_MD_KWCLUB_GRADE1', '一');
define('_MD_KWCLUB_GRADE2', '二');
define('_MD_KWCLUB_GRADE3', '三');
define('_MD_KWCLUB_GRADE4', '四');
define('_MD_KWCLUB_GRADE5', '五');
define('_MD_KWCLUB_GRADE6', '六');
define('_MD_KWCLUB_GRADE7', '七');
define('_MD_KWCLUB_GRADE8', '八');
define('_MD_KWCLUB_GRADE9', '九');

define('_MD_KWCLUB_YEAR_TEXT_00', '暑假');
define('_MD_KWCLUB_YEAR_TEXT_01', '第一學期');
define('_MD_KWCLUB_YEAR_TEXT_11', '寒假');
define('_MD_KWCLUB_YEAR_TEXT_02', '第二學期');

define('_MD_KWCLUB_KINDERGARTEN', '幼兒園');
define('_MD_KWCLUB_KG', '幼');

define('_MD_KWCLUB_GRADE', '年級');
define('_MD_KWCLUB_G', '年');
define('_MD_KWCLUB_CLICK_TO_EDIT', '點擊編輯');
define('_MD_KWCLUB_CLICK_TO_EDIT_DESC', '上表中有標<span class="editable">藍色底線</span>者，可直接點擊編輯修改');

define('_MD_KWCLUB_APPLY_EXCEL', '社團報名統計表');
define('_MD_KWCLUB_TOTAL', '共');
define('_MD_KWCLUB_REGISTER_DATA', '報名資料');
define('_MD_KWCLUB_REGISTER_LIST', '社團報名列表');

define('_MD_KWCLUB_NEED_REG_SN', '錯誤！無報名編號');
define('_MD_KWCLUB_NOT_REG_TIME', '目前不是報名時間喔！<br>報名期間為');
define('_MD_KWCLUB_SCHOOL_YEAR', '學年度');

define('_MD_KWCLUB_FREE_APPLY', '自由報名');
define('_MD_KWCLUB_FREE_APPLY_DESC', '（不登入可報名）');
define('_MD_KWCLUB_LOGIN_APPLY', '登入報名');
define('_MD_KWCLUB_LOGIN_APPLY_DESC', '（須安裝單位名冊模組，上傳報名者相關資料）');

define('_MD_KWCLUB_W0', '日');
define('_MD_KWCLUB_W1', '一');
define('_MD_KWCLUB_W2', '二');
define('_MD_KWCLUB_W3', '三');
define('_MD_KWCLUB_W4', '四');
define('_MD_KWCLUB_W5', '五');
define('_MD_KWCLUB_W6', '六');
define('_MD_KWCLUB_ALL_WEEK', '一、二、三、四、五');
define('_MD_KWCLUB_1_5', '每星期<span class="text_g">一到五</span>的');
define('_MD_KWCLUB_W', '每星期<span class="text_g">%s</span>的');
// <{$smarty.const._MD_KWCLUB_W|sprintf:$data.class_week}>
define('_MD_KWCLUB_WEEK', '星期');

define('_MD_KWCLUB_NOT_EMPTY_CLASS', '警告！！此課程已有學生報名，無法刪除！！');

define('_MD_KWCLUB_ALL_USERS', '所有使用者');
define('_MD_KWCLUB_PICKED_USERS', '已選擇使用者');
define('_MD_KWCLUB_SEARCH_KEY', '請輸入姓名、Email或帳號...');
define('_MD_KWCLUB_SEARCH', '搜尋');

define('_MD_KWCLUB_NOT_PAY', '未繳費');
define('_MD_KWCLUB_PAID', '已繳費');
define('_MD_KWCLUB_CLICK_TO', '點此改為：');

define('_MD_KWCLUB_DETIAL', '詳情');
define('_MD_KWCLUB_EMAPY_REGISTER', '此期沒有人報名！');

define('_MD_KWCLUB_PLACE_SETUP', '上課地點設定');
define('_MD_KWCLUB_PLACE_LIST', '上課場地列表');
define('_MD_KWCLUB_CLUB_YEAR_LIST', '期別列表');
define('_MD_KWCLUB_CATE_SETUP', '社團類型設定');
define('_MD_KWCLUB_CATE_LIST', '社團類型列表');

define('_MD_KWCLUB_LIST_MODE', '報名列表模式');
define('_MD_KWCLUB_EXPORT_PDF', '匯出PDF繳費單');
define('_MD_KWCLUB_PAID_LIST', '所有報名繳費列表');
define('_MD_KWCLUB_PAY_MODE', '繳費統計模式');
define('_MD_KWCLUB_EXPORT_EXCEL', '匯出 Excel');

define('_MD_KWCLUB_PAGEBAR_TOTAL', '（共 %s 筆）');
// <{$smarty.const._MD_KWCLUB_PAGEBAR_TOTAL|sprintf:$total}>

define('_MD_KWCLUB_APPLY_RESULT', '的報名結果');
define('_MD_KWCLUB_MY_ALL_CLASS', '的報名社團列表');

define('_MD_KWCLUB_PAY_STATUS', "總共 %s 元，已繳 <span style='color: green'>%s</span> 元，未繳 <span style='color: red'>%s</span> 元");
// <{$smarty.const._MD_KWCLUB_PAY_STATUS|sprintf:$money:$in_money:$un_money}>

define('_MD_KWCLUB_APPLY_CLASS', '報名「%s」');
// <{$smarty.const._MD_KWCLUB_APPLY_CLASS|sprintf:$class.class_title}>

define('_MD_KWCLUB_APPLY_NOTE', '為維護您的報名權益，請務必填寫正確資訊！！否則將取消錄取！');

define('_MD_KWCLUB_KEYIN', '請輸入');
define('_MD_KWCLUB_CHECK_OK', '以上資料無誤，確定報名！');
define('_MD_KWCLUB_MYCLASS', '查詢我報名過的社團');

define('_MD_KWCLUB_NOT_FOUND', '中，查無任何 %s 的報名資料）');
// <{$smarty.const._MD_KWCLUB_NOT_FOUND|sprintf:$reg_uid}>

define('_MD_KWCLUB_CLASS_ENABLE', '開班');
define('_MD_KWCLUB_CLASS_UNABLE', '不開班');
define('_MD_KWCLUB_CLASS_UNDONE', '尚未報名完成');

define('_MD_KWCLUB_FULL_REGISTRATION', '報名額滿');
define('_MD_KWCLUB_SIGNUP_TO_MAKE_UP', '我要報名後補');
define('_MD_KWCLUB_SIGNUP', '我要報名');
define('_MD_KWCLUB_NON_REGISTRATION_TIME', '非報名時間');
define('_MD_KWCLUB_REGISTERED_LIST', '已報名名單');

define('_MD_KWCLUB_NUMBER_OF_RECRUITED', '招收');
define('_MD_KWCLUB_NUMBER_OF_APPLICANTS', '已報');
define('_MD_KWCLUB_FULL', '滿');
define('_MD_KWCLUB_AFTER_REGISTRATION', '後補報名中...');
define('_MD_KWCLUB_EDIT_TAECHER_NOTE', '欲修改教師名單，請至<a href="config.php#setupTab2" target="_blank">社團老師設定</a>頁面設定');

define('_MD_KWCLUB_EDIT_CATE_NOTE', '欲修改社團類型，請至<a href="config.php#setupTab3" target="_blank">社團類型設定</a>頁面設定');
define('_MD_KWCLUB_EDIT_PLACE_NOTE', '欲修改上課地點，請至<a href="config.php#setupTab4" target="_blank">上課地點設定</a>頁面設定');

define('_MD_KWCLUB_SIGNUP_STATUS', '報名於 %s，從 %s，報名編號：%s');
// <{$smarty.const._MD_KWCLUB_SIGNUP_STATUS|sprintf:$data.reg_datetime:$data.reg_ip:$data.reg_sn}>
