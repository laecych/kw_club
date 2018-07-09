<?php
//載入XOOPS主設定檔（必要）
include_once "../../mainfile.php";
//載入自訂的共同函數檔
include_once "function.php";
//載入工具選單設定檔（亦可將 interface_menu.php 的內容複製到此檔下方，並刪除 interface_menu.php）
include_once "interface_menu.php";

// session_start();
$_SESSION['isActive'] = get_club_info();
