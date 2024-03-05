<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <style>
        .ans {
            width: 300px;
        }

        .ans-o {
            width: 40px;
            height: 30px;
            /* background: red; */
            border-bottom: 3px solid red;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center">
        <div class="box">
            <ul class="list-unstyled hstack h2 mb-5">
                <li class="me-3">a</li>
                <li class="me-3">p</li>
                <li class="me-3">p</li>
                <li class="me-3">l</li>
                <li class="me-3">e</li>
            </ul>
            <div class="ans d-flex justify-content-between h3">
                <div class="ans-o text-center"></div>
                <div class="ans-o text-center"></div>
                <div class="ans-o text-center"></div>
                <div class="ans-o text-center"></div>
                <div class="ans-o text-center"></div>
            </div>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        let currentAnswerIndex = 0;

        $(window).keyup(function(e) {
            let currentAns = $(".ans-o").eq(currentAnswerIndex);
            // Check if the pressed key is an English letter
            // console.log(e.key);
            if (e.key == "Backspace") {
                if (currentAnswerIndex > 0) {
                    currentAnswerIndex--;
                    currentAns.text();
                }
            }
            if (e.keyCode >= 65 && e.keyCode <= 90) {
                // Get the current ans-o element


                // Set the text of the current ans-o element to the pressed key
                currentAns.text(e.key);

                // Move to the next ans-o element if available
                if (currentAnswerIndex < $(".ans-o").length - 1) {
                    currentAnswerIndex++;
                }
            }
        })
    </script>
</body>

</html>