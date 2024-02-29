<?php
require_once("./db_connect.php");

// 設定一頁幾筆資料
// $perPage = $_GET["perP"];
$perPage = 25;
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
        $sql = "SELECT * FROM vocab WHERE valid=1 and important=1 $pageLimit";
    } else if ($_GET["status"] == 2) {
        $sql = "SELECT * FROM vocab WHERE valid=0 $pageLimit";
    }
} else {
    $sql = "SELECT * FROM vocab WHERE valid=1 $pageLimit";
}
$result = $conn->query($sql);
$rowCount = $result->num_rows;


// 取得符合狀態的所有資料筆數
if (isset($_GET["status"])) {
    if ($_GET["status"] == 1) {
        $sqlAll = "SELECT * FROM vocab WHERE valid=1 and important=1";
    } else if ($_GET["status"] == 2) {
        $sqlAll = "SELECT * FROM vocab WHERE valid=0";
    }
} else {
    $sqlAll = "SELECT * FROM vocab WHERE valid=1";
}
$resultAll = $conn->query($sqlAll);
$rowAllCount = $resultAll->num_rows;

// 計算共有幾頁
$pageCount = ceil($rowAllCount / $perPage);
if ($rowCount > 0) {
    $rows = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>單字清單</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" href="./favicon.svg">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php include("./style.php") ?>

</head>

<body>
    <div class="container my-3">
        <h1 class="text-center">單字列表</h1>
        <!-- 搜尋 -->
        <div class="row justify-content-center my-2">
            <div class="col-8">
                <form action="">
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-2">
                            <button class="btn btn-primary" type="submit">搜尋</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- 篩選 -->
        <div class="row justify-content-center">
            <div class="col-9">
                <div class="my-2 d-flex justify-content-between">
                    <div>
                        篩選:
                        <a class="btn btn-outline-primary <?php if (empty($_GET["status"])) {
                                                                echo "active";
                                                            } ?>" href="./wordlist.php" id="all">ALL</a>
                        <a class="btn btn-outline-warning <?php if (isset($_GET["status"])) {
                                                                if ($_GET["status"] == 1) {
                                                                    echo "active";
                                                                }
                                                            } ?>" href="./wordlist.php?status=1"><i class="fa-solid fa-star"></i></a>
                        <a class="btn btn-outline-danger <?php if (isset($_GET["status"])) {
                                                                if ($_GET["status"] == 2) {
                                                                    echo "active";
                                                                }
                                                            } ?>" href="./wordlist.php?status=2"><i class="fa-solid fa-trash-can "></i></a>
                    </div>
                    <div>
                        <a class="btn btn-primary" href="./insert-word.php">加入單字</a>
                        <a class="btn btn-primary">隨機測驗</a>
                    </div>
                </div>
            </div>
            <div class="col-9 mb-3">
                <div class="row align-items-center">
                    <div class="col-1 text-center text-nowrap offset-9 ">每頁顯示</div>
                    <div class="col-2">
                        <select name="perP" id="" class="form-select">
                            <option value="25">25</option>
                            <option value="50" selected>50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- 內容 -->
            <div class="col-9 d-flex flex-wrap align-items-stretch gap-3 justify-content-center">
                <?php if ($rowCount == 0) : ?>
                    <h1 class="text-center">暫無資料</h1>
                <?php else : ?>
                    <?php foreach ($rows as $row) : ?>
                        <div class="card text-center">
                            <div class="card-body d-flex flex-column align-items-center justify-content-between">
                                <div class="main-text">
                                    <a href="./deleteImportant.php?id=<?= $row["id"] ?>">
                                        <!-- 判斷是否有加入星號，才顯示 -->
                                        <i class="fa-solid fa-star text-warning" <?php if ($row["important"] == 0) {
                                                                                        echo "style=display:none";
                                                                                    } ?>></i></a>
                                    <div class="english d-inline-block"><?= $row["english"] ?></div>
                                    <div class="chinese my-1"><?= $row["chinese"] ?></div>
                                </div>
                                <!-- ICON -->
                                <div class="d-flex justify-content-around icon">
                                    <a href="#"><i class="fa-solid fa-pen-to-square"></i></a></td>
                                    <a href="./doImportant.php?id=<?= $row["id"] ?>">
                                        <!-- 若已加星號或已刪除，不顯示星號 -->
                                        <i class="fa-solid fa-star 
                                    text-warning" <?php if ($row["important"] == 1 || $row["valid"] == 0) {
                                                        echo "style=display:none";
                                                    } ?>></i></a>
                                    <a href="./doDelete.php?id=<?= $row["id"] ?>">
                                        <!-- 若已刪除，不顯示垃圾桶 -->
                                        <i class="fa-solid fa-trash-can 
                                    text-danger" <?php if ($row["valid"] == 0) {
                                                        echo "style=display:none";
                                                    } ?>></i></a>
                                    <a href="./doRefresh.php?id=<?= $row["id"] ?>">
                                        <!-- 若已刪除，才顯示加回 -->
                                        <i class="fa-solid fa-rotate-left" <?php if ($row["valid"] == 1) {
                                                                                echo "style=display:none";
                                                                            } ?>></i></a>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <!-- 頁碼 -->
        <nav class="my-5">
            <ul class="pagination justify-content-center">
                <!-- <li class="page-item disabled">
                    <a class="page-link">Previous</a>
                </li> -->
                <!-- 若有篩選，網址加status -->
                <?php if (isset($_GET["status"])) : ?>
                    <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                        <li class="page-item"><a class="page-link" href="./wordlist.php?status=<?= $_GET["status"] ?>&p=<?= $i ?>"><?= $i ?></a></li>
                    <?php endfor; ?>
                    <!-- 所有資料直接加page -->
                <?php else : ?>
                    <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                        <li class="page-item"><a class="page-link" href="./wordlist.php?p=<?= $i ?>"><?= $i ?></a></li>
                    <?php endfor; ?>
                <?php endif; ?>
                <!-- <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li> -->
            </ul>
        </nav>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        // 卡片淡入效果
        // $(function() {
        //     $(".card").hide().each(function(index) {
        //         $(this).delay(index * 50).fadeIn(100);
        //     })
        // })

        // 卡片點擊顯示/隱藏中文
        $(".card").click(function() {
            $(this).find(".chinese").toggleClass("dblock");
        })

        // 點擊icon時，阻止發泡事件(卡片點擊顯示)
        $(".icon a").click(function(e) {
            e.stopPropagation()
        })
    </script>
</body>

</html>