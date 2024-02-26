<?php
require_once("./db_connect.php");

$english = trim($_POST['english']);
$chinese = $_POST['chinese'];

$sqlV1 = "SELECT * FROM vocab WHERE english='$english' and valid=1";
$sqlV2 = "SELECT * FROM vocab WHERE english='$english' and valid=0";
$resultV1 = $conn->query($sqlV1);
$resultV2 = $conn->query($sqlV2);
$rowV1 = $resultV1->num_rows;
$rowV2 = $resultV2->num_rows;
if ($rowV1 != 0) {
    echo "<script>alert('所輸入英文單字已存在');
    window.location.href='insert-word.php';</script>";
} else if ($rowV2 != 0) {
    echo "<script>alert('所輸入英文單字已刪除');
    window.location.href='insert-word.php';</script>";
} else {
    $sql = "INSERT INTO vocab (english,chinese,important,valid) VALUES ('$english','$chinese',0,1)";

    if ($conn->query($sql)) {
        echo "新增資料成功";
    } else {
        echo "新增資料錯誤: " . $conn->error;
    }
    $conn->close();

    header("location:insert-word.php");
}
