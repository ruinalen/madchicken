<!doctype html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8" />
    <title>로그인</title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.1.0.min.js" ></script>
    <script type="text/javascript" src="../js/mySignInForm.js"></script>
    <link rel="stylesheet" href="../css/mySignInForm.css" />
    <script type="text/javascript">

        $(document).ready(function () {
            // Handler for .ready() called.
            $('html, body').animate({
                scrollTop: $('#login').offset().top
            }, 'slow');
        });

    </script>
</head>
<body>
<div id="wrap">
    <div id="container">
        <h1 class="title">로그인</h1>
        <form name="singIn" action="./signIn.php" method="post" onsubmit="return checkSubmit()">
            <div class="line">
                <div class="inputArea">
                    <input autocomplete="new-password"  type="text" name="memberId" class="memberId" />
                </div>
            </div>
            <div class="line">
                <div class="inputArea">
                    <input autocomplete="new-password"  type="password" name="memberPw" class="memberPw"  autocomplete=off />
                </div>
            </div>
            <div class="line">
                <input type="submit" value="로그인" class="submit" />
            </div>
        </form>
        <h1 class="title"><a href="./signUpForm.php">회원가입 하기</a></h1>
    </div>
</div>
</body>
</html>