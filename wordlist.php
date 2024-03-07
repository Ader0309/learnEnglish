<?php
require_once("./getData.php")
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
    <!-- aos -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

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
                        <a class="btn btn-primary" href="./random-test.php">隨機測驗</a>
                    </div>
                </div>
            </div>
            <div class="col-9 mb-3">
                <div class="row align-items-center">
                    <div class="col-1 text-center text-nowrap offset-9 ">每頁顯示</div>
                    <div class="col-2">
                        <form method="GET">
                            <select name="perP" id="perP" class="form-select">
                                <option value="25" <?php if (isset($_GET["perP"])) {
                                                        if ($_GET["perP"] == 25) {
                                                            echo "selected";
                                                        }
                                                    } ?>>25</option>
                                <option value="50" <?php if (empty($_GET["perP"])) {
                                                        echo "selected";
                                                    } else {
                                                        if ($_GET["perP"] == 50) {
                                                            echo "selected";
                                                        }
                                                    } ?>>50</option>
                                <option value="100" <?php if (isset($_GET["perP"])) {
                                                        if ($_GET["perP"] == 100) {
                                                            echo "selected";
                                                        }
                                                    } ?>>100</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
            <!-- 內容 -->
            <div class="col-9 d-flex flex-wrap align-items-stretch gap-3 justify-content-center" id="content">
                <?php if ($rowCount == 0) : ?>
                    <h1 class="text-center">暫無資料</h1>
                <?php else : ?>
                    <?php foreach ($rows as $row) : ?>
                        <div class="card text-center" data-aos="zoom-in">
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
                    <?php if ($perPage == 25) : ?>
                        <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                            <li class="page-item"><a class="page-link" href="./wordlist.php?perP=25&p=<?= $i ?>"><?= $i ?></a></li>
                        <?php endfor; ?>
                    <?php elseif ($perPage == 100) : ?>
                        <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                            <li class="page-item"><a class="page-link" href="./wordlist.php?perP=100&p=<?= $i ?>"><?= $i ?></a></li>
                        <?php endfor; ?>
                    <?php else : ?>
                        <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                            <li class="page-item"><a class="page-link" href="./wordlist.php?p=<?= $i ?>"><?= $i ?></a></li>
                        <?php endfor; ?>
                    <?php endif; ?>
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
    <!-- aos -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init();
        // 卡片淡入效果
        // $(function() {
        //     $(".card").hide().each(function(index) {
        //         $(this).delay(index * 400).fadeIn(400);
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

        $("#perP").on("change", function() {
            let perP = $(this).val();
            $(this).closest("form").submit();
            // $.ajax({
            //     method: "GET",
            //     data: {
            //         perP: perP
            //     },
            //     url: "getData.php",
            //     success: function(data) {
            //         console.log("success");
            //     }
            // })
        })
    </script>
</body>

</html>