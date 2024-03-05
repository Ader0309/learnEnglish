<?php
require_once("./db_connect.php");

// 設定一頁幾筆資料
if (isset($_GET["perP"])) {
    $perPage = $_GET["perP"];
    // echo $perPage;
} else {
    $perPage = 50;
    // echo $perPage;
}

if (!isset($_GET["p"])) {
    $p = 1;
    $pageLimit = "LIMIT $perPage";
} else {
    $p = $_GET["p"];
    $offset = (intval($p) - 1) * $perPage;
    $pageLimit = " LIMIT $offset, $perPage";
}

// 取得單頁的資料
if (isset($_GET["status"])) {
    if ($_GET["status"] == 1) {
        $sql = "SELECT * FROM vocab WHERE valid=1 and important=1 ORDER BY english ASC $pageLimit";
    } else if ($_GET["status"] == 2) {
        $sql = "SELECT * FROM vocab WHERE valid=0 ORDER BY english ASC $pageLimit";
    }
} else {
    $sql = "SELECT * FROM vocab WHERE valid=1 ORDER BY english ASC $pageLimit";
}
$result = $conn->query($sql);
$rowCount = $result->num_rows;


// 取得符合狀態的所有資料筆數
if (isset($_GET["status"])) {
    if ($_GET["status"] == 1) {
        $sqlAll = "SELECT * FROM vocab WHERE valid=1 and important=1 ORDER BY english ASC";
    } else if ($_GET["status"] == 2) {
        $sqlAll = "SELECT * FROM vocab WHERE valid=0 ORDER BY english ASC";
    }
} else {
    $sqlAll = "SELECT * FROM vocab WHERE valid=1 ORDER BY english ASC";
}
$resultAll = $conn->query($sqlAll);
$rowAllCount = $resultAll->num_rows;

// 計算共有幾頁
$pageCount = ceil($rowAllCount / $perPage);
if ($rowCount > 0) {
    $rows = $result->fetch_all(MYSQLI_ASSOC);
}
