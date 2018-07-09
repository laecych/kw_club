<?php
include_once "header.php";
require_once TADTOOLS_PATH . '/tcpdf/tcpdf.php';
include_once $GLOBALS['xoops']->path('/modules/system/include/functions.php');

$pdf = new TCPDF("P", "mm", "A4");
$pdf->setPrintHeader(false); //不要頁首
$pdf->setPrintFooter(false); //不要頁尾
$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM); //設定自動分頁
$pdf->setFontSubsetting(true); //產生字型子集（有用到的字才放到文件中）
$pdf->SetMargins(15, 15); //設定頁面邊界，

$year        = system_CleanVars($_REQUEST, 'year', '0', 'int');
$reg_uid_all = get_reg_uid_all($year);

// $json = json_encode($reg_uid_all, JSON_UNESCAPED_UNICODE);
// die($json);

foreach ($reg_uid_all as $value) {
    $myts = MyTextSanitizer::getInstance();

    $tbl    = $xoopsDB->prefix('kw_club_reg');
    $sql    = "SELECT * FROM `$tbl` WHERE `reg_uid`='{$value}' and `reg_year`={$year}  ORDER BY `reg_uid` DESC";
    $result = $xoopsDB->query($sql) or web_error($sql);

// $pdf->Cell($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = 0, $link = nil, $stretch = 0, $ignore_min_height = false, $calign = 'T', $valign = 'M')
    //$pdf->MultiCell( $w, $h, $txt, $border = 0, $align = 'J', $fill = false, $ln = 1, $x = '', $y = '', $reseth = true, $stretch = 0, $ishtml = false, $autopadding = true, $maxh = 0, $valign = 'T', $fitcell = false );

    $pdf->AddPage(); //新增頁面，一定要有，否則內容出不來
    $pdf->SetFont('droidsansfallback', '', 20, '', true); //設定字型
    $pdf->Cell(180, 12, "{$value}社團繳費列表", 0, 1, 'C', 0);
    $pdf->SetFont('droidsansfallback', '', 12, '', true); //設定字型

    $height = 10;
    //標題
    $pdf->MultiCell(30, $height, "社團名稱", 1, 'C', false, 0, '', '', false, 0, false, false, $height, 'M', true);
    $pdf->MultiCell(30, $height, "報名者", 1, 'C', false, 0, '', '', false, 0, false, false, $height, 'M', true);
    $pdf->MultiCell(20, $height, "社團學費", 1, 'C', false, 0, '', '', false, 0, false, false, $height, 'M', true);
    $pdf->MultiCell(20, $height, "額外費用", 1, 'C', false, 0, '', '', false, 0, false, false, $height, 'M', true);
    $pdf->MultiCell(20, $height, "是否候補", 1, 'C', false, 0, '', '', false, 0, false, false, $height, 'M', true);
    $pdf->MultiCell(20, $height, "是否繳費", 1, 'C', false, 0, '', '', false, 0, false, false, $height, 'M', true);
    $pdf->MultiCell(50, $height, "報名日期", 1, 'C', false, 1, '', '', false, 0, false, false, $height, 'M', true);

    $money = 0;

    while ($uid = $xoopsDB->fetchArray($result)) {

        $reg_name     = $myts->htmlSpecialChars($uid['reg_name']);
        $class_title  = $myts->htmlSpecialChars($uid['class_title']);
        $class_money  = $myts->htmlSpecialChars($uid['class_money']);
        $class_fee    = $myts->htmlSpecialChars($uid['class_fee']);
        $reg_isreg    = $myts->htmlSpecialChars($uid['reg_isreg']);
        $reg_isfee    = $myts->htmlSpecialChars($uid['reg_money']);
        $reg_datetime = $myts->htmlSpecialChars($uid['reg_datetime']);

        $pdf->MultiCell(30, $height, $class_title, 1, 'C', false, 0, '', '', false, 0, false, false, $height, 'M', true);
        $pdf->MultiCell(30, $height, $reg_name, 1, 'C', false, 0, '', '', false, 0, false, false, $height, 'M', true);
        $pdf->MultiCell(20, $height, $class_money, 1, 'C', false, 0, '', '', false, 0, false, false, $height, 'M', true);
        $pdf->MultiCell(20, $height, $class_fee, 1, 'C', false, 0, '', '', false, 0, false, false, $height, 'M', true);
        $pdf->MultiCell(20, $height, $class_isreg ? '是' : '否', 1, 'C', false, 0, '', '', false, 0, false, false, $height, 'M', true);
        $pdf->MultiCell(20, $height, $class_isfee ? '是' : '否', 1, 'C', false, 0, '', '', false, 0, false, false, $height, 'M', true);
        $pdf->MultiCell(50, $height, $reg_datetime, 1, 'C', false, 1, '', '', false, 0, false, false, $height, 'M', true);

        $money += $class_money;
        $fee += $class_fee;
        // $pdf->Cell(50, $height, $username, 1, 0,'C',0,'',1);
        // $pdf->Cell(36, $height, $snews['update_time'], 1, 1,'C',0,'',1);
    }
    $pdf->Cell(25, 10, '總學費金額：', 0, 0);
    $pdf->Cell(30, 10, $money, 'B', 0, 0);
    $pdf->Cell(20, 10, '額外加收：', 0, 0);
    $pdf->Cell(30, 10, $fee, 'B', 0, 0);
    // $pdf->Image('images/aa.png', 180, 250, 20, 20, 'png');
    $pdf->SetXY(120, 255);

    $pdf->SetFont('droidsansfallback', '', 16, '', true); //設定字型
    $pdf->Cell(20, 10, '簽名：', 0, 0);
    $pdf->Cell(50, 10, '', 'B', 0, 0);

}

//PDF內容設定
$pdf->Output('club_reg.pdf', 'I');
