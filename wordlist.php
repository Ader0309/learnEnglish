<?php
require_once("./db_connect.php");

if (isset($_GET["status"])) {
    if ($_GET["status"] == 1) {
        $sqlAll = "SELECT * FROM vocab WHERE valid=1 and important=1";
    } else if ($_GET["status"] == 2) {
        $sqlAll = "SELECT * FROM vocab WHERE valid=0";
    }
} else {
    $sqlAll = "SELECT * FROM vocab WHERE valid=1";
}

$result = $conn->query($sqlAll);
$rowCount = $result->num_rows;
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
                        <a class="btn btn-primary" href="./wordlist.php">ALL</a>
                        <a class="btn btn-outline-warning" href="./wordlist.php?status=1"><i class="fa-solid fa-star"></i></a>
                        <a class="btn btn-outline-danger" href="./wordlist.php?status=2"><i class="fa-solid fa-trash-can "></i></a>
                    </div>
                    <div>
                        <a class="btn btn-primary" href="./insert-word.php">加入單字</a>
                        <a class="btn btn-primary">隨機測驗</a>
                    </div>
                </div>
            </div>
            <!-- 內容 -->
            <div class="col-9 d-flex flex-wrap align-items-stretch gap-3">
                <?php foreach ($rows as $row) : ?>
                    <div class="card text-center">
                        <div class="card-body d-flex flex-column align-items-center justify-content-between">
                            <div class="main-text">
                                <a href="./deleteImportant.php?id=<?= $row["id"] ?>"><i class="fa-solid fa-star text-warning" <?php if ($row["important"] == 0) {
                                                                                                                                    echo "style=display:none";
                                                                                                                                } ?>></i></a>
                                <div class="english d-inline-block"><?= $row["english"] ?></div>
                                <div class="chinese my-1 " style="display:none"><?= $row["chinese"] ?></div>
                            </div>
                            <div class="d-flex justify-content-around icon">
                                <a href="#"><i class="fa-solid fa-pen-to-square"></i></a></td>
                                <a href="./doImportant.php?id=<?= $row["id"] ?>"><i class="fa-solid fa-star text-warning" <?php if ($row["important"] == 1) {
                                                                                                                                echo "style=display:none";
                                                                                                                            } ?>></i></a>
                                <a href="./doDelete.php?id=<?= $row["id"] ?>"><i class="fa-solid fa-trash-can text-danger"></i></a>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- 頁碼 -->
        <nav class="my-5">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        $(".card").click(function() {
            $(this).find(".chinese").css("display", "block");
        })
    </script>
</body>

</html>