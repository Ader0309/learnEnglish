<?php
require_once("./db_connect.php");

// 取資料庫valid=1的資料，供random函數使用
$sql = "SELECT * FROM vocab WHERE valid=1";
$result = $conn->query($sql);
$rowCount = $result->num_rows;
$row = $result->fetch_assoc();


if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sqlQ = "SELECT * FROM vocab WHERE id=$id and valid=1";
    $resultQ = $conn->query($sqlQ);
    $rowQ = $resultQ->fetch_assoc();
    $ans = $rowQ["english"];
    $ansArr = str_split($ans);
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>隨機測驗</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" href="./favicon.svg">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <?php include("./style.php") ?>
</head>

<body>
    <div class="container my-3">
        <h1 class="text-center">隨機測驗</h1>
        <div class="row d-flex justify-content-center">
            <div class="col-9 d-flex justify-content-between">
                <div class="d-flex  <?php if (empty($_GET["id"])) {
                                        echo "d-none";
                                    } ?>">
                    <button type="button" class="btn btn-primary me-1" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="<?= $rowQ["english"][0] ?>">提示一字</button>
                    <form method="GET">
                        <input type="text" class="d-flex d-none" name="id" id="nextVal">
                        <button class="btn btn-primary" id="next">下一題</button>
                    </form>
                </div>
                <div>
                    <a class="btn btn-primary" href="./insert-word.php">加入單字</a>
                    <a class="btn btn-primary" href="./wordlist.php">單字列表</a>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center <?php if (isset($_GET["id"])) {
                                                        echo "d-none";
                                                    } ?>">
            <form method="GET">
                <input type="text" class="d-flex d-none" name="id" id="passVal">
                <button type="button" class="btn btn-primary" id="start">點我開始</button>
            </form>
        </div>
        <div class="wrap d-flex justify-content-center <?php if (empty($_GET["id"])) {
                                                            echo "d-none";
                                                        } ?>" id="questBox">
            <div class="box">
                <h1 class="text-center" id="question"><?= $rowQ["chinese"] ?></h1>
                <h1 class="h1 mb-5 text-center d-flex d-none" id="answer"><?= $rowQ["english"] ?></h1>
                <div class="ans d-flex justify-content-center h3">
                    <?php foreach ($ansArr as $ansarr) : ?>
                        <div class="ans-o text-center ms-3"></div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script>
        // 初始化彈出視窗(popup)
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))

        // 取隨機id
        function random() {
            let random = Math.random() * <?= $rowCount ?>;
            let ans = Math.ceil(random);
            return ans;
        }
        // 按下開始，傳送id給php
        $("#start").click(function() {
            $("#passVal").val(random())
            $(this).closest("form").submit();
        })
        // 下一題
        $("#next").click(function() {
            $("#nextVal").val(random())
            $(this).closest("form").submit();
        })


        // 作答列運作
        let currentAnswerIndex = 0;
        let ans = [];
        $(window).keyup(function(e) {
            let currentAns = $(".ans-o").eq(currentAnswerIndex);
            let lastAns = $(".ans-o").eq(currentAnswerIndex - 1);

            if (e.key == "Backspace") {
                if (currentAnswerIndex > 0) {
                    lastAns.text("");
                    currentAnswerIndex--;
                    ans.pop();
                }
            }
            // 按鍵為英文才輸入
            if (e.keyCode >= 65 && e.keyCode <= 90) {
                if (currentAnswerIndex < $(".ans-o").length) {
                    currentAns.text(e.key);
                    ans.push(e.key);
                    currentAnswerIndex++;
                }
            }
            if (e.key == "Enter") {
                finalAns = ans.join('');
                if (finalAns == $("#answer").text()) {
                    alert("恭喜答對")

                } else {
                    alert("答錯，請繼續")
                }

                $(".ans-o").each(function() {
                    $(this).text("")
                })
                currentAnswerIndex = 0;
                ans = [];
            }
        })
    </script>
</body>

</html>