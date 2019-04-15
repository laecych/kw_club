<?php
include_once '../../../../../mainfile.php';

$aResponse['error']   = false;
$_SESSION['iQaptcha'] = false;

if (isset($_POST['action'])) {
    if ('qaptcha' == htmlentities($_POST['action'], ENT_QUOTES, 'UTF-8')) {
        $_SESSION['iQaptcha'] = true;
        if ($_SESSION['iQaptcha']) {
            echo jsonencode($aResponse);
        } else {
            $aResponse['error'] = true;
            echo jsonencode($aResponse);
        }
    } else {
        $aResponse['error'] = true;
        echo jsonencode($aResponse);
    }
} else {
    $aResponse['error'] = true;
    echo jsonencode($aResponse);
}

function jsonencode($a = false)
{
    if (null === $a) {
        return 'null';
    }
    if (false === $a) {
        return 'false';
    }
    if (true === $a) {
        return 'true';
    }
    if (is_scalar($a)) {
        if (is_float($a)) {
            // Always use "." for floats.
            return (float)str_replace(',', '.', (string)$a);
        }

        if (is_string($a)) {
            static $jsonReplaces = [['\\', '/', "\n", "\t", "\r", "\b", "\f", '"'], ['\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"']];

            return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
        }

        return $a;
    }
    $isList = true;
    for ($i = 0, reset($a); $i < count($a); $i++, next($a)) {
        if (key($a) !== $i) {
            $isList = false;
            break;
        }
    }
    $result = [];
    if ($isList) {
        foreach ($a as $v) {
            $result[] = jsonencode($v);
        }

        return '[' . implode(',', $result) . ']';
    }
    foreach ($a as $k => $v) {
        $result[] = jsonencode($k) . ':' . jsonencode($v);
    }

    return '{' . implode(',', $result) . '}';
}
