<?
include "lib/bm_dbconfig.php"; // DB 연결을 위한 환경 파일
include "lib/bm_function.php"; // 사용자 정의 함수

if ($id != '') { // 특정 게시판과 관련된 로그인

    $connect = bm_dbconnect($host, $db_id, $db_passwd, $db_name); // MySQL DB 연결(사용자 정의 함수 bm_dbconnect 이용)
    $sql = "select * from multiconfig where id = '$id'"; // 0000.php?id=xxx 와 같은 식으로 호출
    $result = mysql_query($sql) or die (mysql_error() . $sql);
    $array = mysql_fetch_array($result);
    $skindir = "skin/" . $array[skin] . "/"; // 스킨 디렉토리
    $tablename = $id; // 테이블 이름
    $title = $array[title];//"다중 게시판" ;
    $head_file = $array[head_file];//게시판 상단 꾸미기
    $head = stripslashes($array[head]);
    $foot_file = $array[foot_file];//게시판 하단 꾸미기
    $foot = stripslashes($array[foot]);
    $tbwidth = $array[tbwidth];// 게시판 테이블 가로
    $tbalign = $array[tbalign];// 게시판 테이블 정렬 방식
    $background = $array[background]; // 전체 배경 그림
    $strlen = $array[strlen]; // 제목 글자수

} else { // 특정 게시판과 관련이 없는 로그인

    $skindir = "skin/default/"; // 디폴트 스킨 지정
    $tbwidth = "100%";
    $tbalign = "center"; // 로그인 화면 가운데 정렬

}

if ($ret_url == '') $ret_rul = "/";

$a_submit = "<a href='javascript:check_submit();'>";
$a_signon = "<a href='signon.php?id=$id'>";

?>


<? include "copyright.txt"; // 저작권 ?>

<html>
<head>
    <meta http-equiv=content-type content=text/html; charset=euc-kr>
    <title><?= $title; ?></title>
    <? include $skindir . "style.css"; ?>
    <script language="javascript">
        function check_submit() {
            if (document.myForm.userid.value == "") {
                alert('ID를 입력하세요');
                document.myForm.userid.focus();
                return false;
            }
            if (document.myForm.userpw.value == "") {
                alert('비밀번호를 입력하세요.');
                document.myForm.userpw.focus();
                return false;
            }
            document.myForm.submit();
        }
    </script>
</head>
<body leftmargin="0" topmargin="0" background="<?= $background; ?>" onload="javascript:document.myForm.userid.focus();">

<? if ($head_file != '') include $head_file; ?>
<? echo "$head"; ?>

<form name="myForm" method="post" action="logon_ok.php" onsubmit="return check_submit();">
    <input type="hidden" name="ret_url" value="<?= $ret_url; ?>">

    <table border=0 cellspacing=0 width=<?= $tbwidth; ?> align=<?= $tbalign; ?>>
        <tr>
            <td>

                <?
                include $skindir . "logon_main.php";
                ?>

                <p align="right">
                    <? include $skindir . "copyright.php"; // 저작권?>
                </p>

            </td>
        </tr>
    </table>

    <? if ($foot_file != '') include $foot_file; ?>
    <? echo "$foot"; ?>
</body>
</html>