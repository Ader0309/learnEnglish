<style>
    :root {
        font-size: 16px !important;
    }

    body {
        background: repeating-linear-gradient(45deg, pink, lightblue);
    }

    h1 {
        color: peru;
    }

    /* ------------單字列表頁面-------------- */
    .card {
        width: 180px;
        box-shadow: 2px 3px 15px #555;
        cursor: pointer;
        transition: .3s;

        &:hover {
            scale: 1.1;
            box-shadow: 0 0 5px 5px peru;
        }

        .card-body {
            height: 100%;

            /* padding: 10px; */
            .main-text {
                & .english {
                    font-size: 20px;
                    color: peru;
                    font-weight: 900;
                    border-bottom: 3px solid peru;
                }

                & .chinese {
                    display: none;

                    &.dblock {
                        display: block;
                    }
                }
            }
        }
    }

    .icon {
        width: 80px;
        padding-top: 5px;
        /* border-top: 3px solid peru; */
    }

    /* ------------新增單字頁面-------------- */
    /* 新增單字margin */
    .bm {
        margin-top: 9rem !important;
        margin-bottom: 20rem !important;
    }

    /* 新增單字毛玻璃 */
    .newbox {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 20px
    }


    /* ---------------隨機測驗-------------------- */
    #start {
        margin-top: 150px;
    }

    .ans {
        width: 700px;
    }

    .ans-o {
        width: 40px;
        height: 30px;
        /* background: red; */
        border-bottom: 3px solid red;
    }

    .wrap {
        margin-top: 100px;

        & .ans {
            margin-top: 30px;
        }
    }
</style>