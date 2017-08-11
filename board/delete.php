<?
include "lib/bm_dbconfig.php"; // DB 연결을 위한 환경 파일
include "lib/bm_function.php"; // 사용자 정의 함수

if($id == '') {
	bm_error("게시판 이름이 지정되지 않았습니다.");
}

$connect = bm_dbconnect($host, $db_id, $db_passwd, $db_name); // MySQL DB 연결(사용자 정의 함수 bm_dbconnect 이용)
$sql = "select * from multiconfig where id = '$id'" ; // 0000.php?id=xxx 와 같은 식으로 호출
$result = mysql_query($sql) or die (mysql_error().$sql);
$array = mysql_fetch_array($result);
$skindir = "skin/".$array[skin]."/"; // 스킨 디렉토리
$tablename = $id; // 테이블 이름
$title = $array[title] ;//"다중 게시판" ;
$head_file = $array[head_file];//게시판 상단 꾸미기
$head = stripslashes($array[head]);
$foot_file = $array[foot_file];//게시판 하단 꾸미기
$foot = stripslashes($array[foot]);
$tbwidth = $array[tbwidth];// 게시판 테이블 가로
$tbalign = $array[tbalign];// 게시판 테이블 정렬 방식
$background = $array[background]; // 전체 배경 그림
$strlen = $array[strlen]; // 제목 글자수

//테이블에서 글을 가져옵니다. 
$query = "select * from $tablename where number='$number'"; // 글 번호를 가지고 조회를 합니다.
$result = mysql_query($query) or die (mysql_error());
$array = mysql_fetch_array($result);

// 스킨에서 사용할 변수
$a_ok = "<a href='javascript:check_submit();'>";
$a_cancel = "<a href='javascript:history.go(-1)'>";

if($HTTP_COOKIE_VARS[cook_userid] != '') { $hide_start="<!--"; $hide_end="-->"; } // 회원일 경우 가릴 때 사용

?>


<? include "copyright.txt"; // 저작권 ?>

<html>
<head>
<meta http-equiv=content-type content=text/html; charset=euc-kr>
<title><?=$title;?></title>
<? include $skindir."style.css"; ?>
<?
if (!$HTTP_COOKIE_VARS[cook_userid]) { // 로그인하지 않은 상태이면
echo "
<script language='javascript'>
function check_submit() {
	if (document.myForm.password.value == '') {
		alert('비밀번호를 입력해야 글을 삭제할 수 있습니다.');
		document.myForm.password.focus();
		return;
	} else {
		document.myForm.action = 'delete_ok.php';
		document.myForm.submit();
	}
}
</script>
";
} else {
echo "
<script language='javascript'>
function check_submit() {
	document.myForm.action = 'delete_ok.php';
	document.myForm.submit();
}
</script>
";
}
?>
</head>
<body leftmargin="0" topmargin="0" background="<?=$background; ?>">

<? if ($head_file != '') include $head_file ; ?>
<? echo "$head"; ?>

<form name="myForm" method="get">
<input type="hidden" name="id" value="<? echo $id; ?>">
<input type="hidden" name="page" value="<? echo $page; ?>">
<input type="hidden" name="number" value="<? echo $number; ?>">
<input type=hidden name=src_name value='<? echo $src_name; ?>'>
<input type=hidden name=src_value value='<? echo $src_value; ?>'>

<table border=0 cellspacing=0 width=<?=$tbwidth;?> align=<?=$tbalign;?>>
<tr><td>

<!-- 여기서부터 스킨-->

<? include $skindir."delete_main.php"; ?>

<!-- 여기까지 스킨 -->

<p align="right">
<? include $skindir."copyright.php"; // 저작권?>
</p>

</td></tr>
</table>

</form>

<? if ($foot_file != '') include $foot_file ; ?>
<? echo "$foot"; ?>
</body>
</html>