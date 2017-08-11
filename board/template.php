<?
include "lib/bm_dbconfig.php"; // DB 연결을 위한 환경 파일
include "lib/bm_function.php"; // 사용자 정의 함수

if ($id == '') {
    bm_error("게시판 이름이 지정되지 않았습니다.");
}

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

?>


<? include "copyright.txt"; // 저작권 ?>

<html>
<head>
    <meta http-equiv=content-type content=text/html; charset=euc-kr>
    <title><?= $title; ?></title>
    <? include $skindir . "style.css"; ?>
</head>
<body leftmargin="0" topmargin="0" background="<?= $background; ?>">

<? if ($head_file != '') include $head_file; ?>
<? echo "$head"; ?>

<table border=0 cellspacing=0 width=<?= $tbwidth; ?> align=<?= $tbalign; ?>>
    <tr>
        <td>

            <!-- 여기서부터 본문 // 스킨
<?
            /*************
             *여기에 스킨 *
             **************/
            // include $skindir."xxxx.php";
            ?>
여기까지 본문 // 스킨-->

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