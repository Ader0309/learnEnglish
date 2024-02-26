<!doctype html>
<html lang="en">

<head>
    <title>加入單字</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="icon" href="./favicon.svg">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <?php include("./style.php") ?>

</head>

<body>
    <div class="container text-center my-3 bm">
        <div class="newbox">
            <h1>新增單字</h1>
            <div class="row justify-content-end">
                <div class="col-4">
                    <form action="doInsert.php" method="post">
                        <div class="row justify-content-center my-2">
                            <div class="col-8">
                                <input type="text" class="form-control" name="english" placeholder="請輸入英文" required>
                            </div>
                        </div>
                        <div class="row justify-content-center my-2">
                            <div class="col-8">
                                <input type="text" class="form-control" name="chinese" placeholder="請輸入翻譯" required>
                            </div>
                        </div>
                        <button class="btn btn-primary my-2" type="submit">新增</button>
                    </form>
                </div>
                <div class="col-2 offset-2">
                    <div class="row">
                        <div class="col-7">
                            <a class="btn btn-primary mb-2" href="./wordlist.php">單字列表</a>
                        </div>
                        <div class="col-7">
                            <a class="btn btn-primary">隨機測驗</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>