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
$simplereply_yn = $array[simplereply]; // 간단 답글 사용 유무

/*
$name = '손님'; // 사용자 아이디. 로그인하지 않은 경우 디폴트로 게스트 이름 지정
$userid = 'guest'; // 사용자 아이디. 로그인하지 않은 경우 디폴트로 게스트 아이디 지정
$password = 'guest'; // 사용자 패스워드. 로그인하지 않은 경우 디폴트로 게스트 비밀번호 지정
*/
$simplereply_id = $id."_simplereply"; // 간단한 답글 테이블 이름 지정
if(!$HTTP_COOKIE_VARS[cook_userid]) { $guest_hide_start="<!--"; $guest_hide_end="-->"; } // 회원이 아닐 경우 가릴 때 사용

if($array[authread] != '10') { // 사용자 등급이 10이 아니면, 즉 회원가입을 해야 볼 수 있다면...
	if($HTTP_COOKIE_VARS[cook_userlevel] > $array[authread] || $HTTP_COOKIE_VARS[cook_userlevel]=='') {
		bm_error("로그인하지 않았거나 이 게시물을 읽을 권한이 없습니다.");
		return;
	}
}

//테이블에서 글을 가져옵니다.
$query = "select * from $tablename where number='$number'"; // 글 번호를 가지고 조회를 합니다.
$result = mysql_query($query) or die (mysql_error());
$array = mysql_fetch_array($result);

$query2 = "select * from $simplereply_id where parent=$number order by number"; // 간단한 답글을 불러옴
$result2 = mysql_query($query2) or die (mysql_error());
// $array2 = mysql_fetch_array($result); // 스킨으로 옮김

//백슬래쉬 제거, 특수문자 변환(HTML용), 개행(<br>)처리 등
$name = stripslashes($array[name]);
$subject = stripslashes($array[subject]);
$memo = stripslashes($array[memo]);
$email = $array[email];
$homepage = $array[homepage];
$datetime = DATE("Y-m-d H:m:s",$array[writetime]);

if($array[html]!="Y") { // HTML 태그 사용 가능 여부
	$subject = htmlspecialchars($subject);
	$memo = htmlspecialchars($memo);
}

if($array[br]=="Y") { // 엔터 부분 <br>태그 처리
	$memo = nl2br($memo);
}

$count = $array[count];

$replyno= $array[replyno]; // 변수를 단순화하기 위해...스킨 제작땜시.

// 첨부 파일이 있을 경우
if($array[file_name1]!='') {
	$file_size1 = round(filesize($array[file_name1])/1024,2);
// 파일 사이즈를 KB 단위로
	$print_filename1 = "<a href={$array[file_name1]}>{$array[s_file_name1]}</a>({$file_size1}KB)";
	$ext = explode(".",$array[file_name1]); // 파일 이름을 . 를 기준으로 나누어 배열에 저장
	$up_image1 = '';
	if($ext[sizeof($ext)-1]=='jpg' || $ext[sizeof($ext)-1]=='gif' || $ext[sizeof($ext)-1]=='png') {// 첨부파일이 그림파일일 경우
		$up_image1 = "<img src={$array[file_name1]}><br>";
	}
}
if($array[file_name2]!='') {
	$file_size2 = round(filesize($array[file_name2])/1024,2);
// 파일 사이즈를 KB 단위로
	$print_filename2 = "<a href={$array[file_name2]}>{$array[s_file_name2]}</a>({$file_size2}KB)";
	$ext = explode(".",$array[file_name1]); // 파일 이름을 . 를 기준으로 나누어 배열에 저장
	$up_image2 = '';
	if($ext[sizeof($ext)-1]=='jpg' || $ext[sizeof($ext)-1]=='gif' || $ext[sizeof($ext)-1]=='png') {// 첨부파일이 그림파일일 경우
		$up_image2 = "<img src={$array[file_name2]}><br>";
	}
}
if($array[file_name3]!='') {
	$file_size3 = round(filesize($array[file_name3])/1024,2);
// 파일 사이즈를 KB 단위로
	$print_filename3 = "<a href={$array[file_name3]}>{$array[s_file_name3]}</a>({$file_size3}KB)";
	$ext = explode(".",$array[file_name3]); // 파일 이름을 . 를 기준으로 나누어 배열에 저장
	$up_image3 = '';
	if($ext[sizeof($ext)-1]=='jpg' || $ext[sizeof($ext)-1]=='gif' || $ext[sizeof($ext)-1]=='png') {// 첨부파일이 그림파일일 경우
		$up_image3 = "<img src={$array[file_name3]}><br>";
	}
}

// 조회수 카운터 증가
$query = "update $tablename set count = count + 1 where number='$number'";
mysql_query($query);

?>

<? include "copyright.txt"; // 저작권 ?>

<html>
<head>
<meta http-equiv=content-type content=text/html; charset=euc-kr>
<title><?=$title;?></title>
<? include $skindir."style.css"; ?>
</head>
<body leftmargin="0" topmargin="0" background="<?=$background; ?>">

<? if ($head_file != '') include $head_file ; ?>
<? echo "$head"; ?>

<?
$a_list = "<a onfocus='blur();' href=djboard.php?id=$id&page=$page&src_name=$src_name&src_value=$src_value>";
$a_write = "<a onfocus='blur();' href=write.php?id=$id&page=$page&src_name=$src_name&src_value=$src_value>";
$a_modify = "<a onfocus='blur();' href=modify.php?id=$id&number=$number&page=$page&src_name=$src_name&src_value=$src_value>";
$a_delete = "<a onfocus='blur();' href=delete.php?id=$id&number=$number&page=$page&src_name=$src_name&src_value=$src_value>";
$a_reply = "<a onfocus='blur();' href=reply.php?id=$id&number=$number&page=$page&replyno=$replyno&src_name=$src_name&src_value=$src_value>";
?>

<table border=0 cellspacing=0 width=<?=$tbwidth;?> align=<?=$tbalign;?>>
<tr><td>

<? include $skindir."view_main.php"; // 글 내용 보여주기 스킨?>

<?
if ($simplereply_yn == "Y") { // 간단 답글 유무 체크
?>

<!-- 코멘트 보기 / 등록하기 시작 -->

<script>
	function check_comment_submit(obj) {
		if(obj.comment.value.length<5) {
			alert("코멘트는 5자 이상 적어주세요");
			obj.comment.focus();
			return false;
		}
		return true;
	}
</script>

<form method=post name=write action=simplereply_ok.php onsubmit="return check_comment_submit(this)"><input type=hidden name=page value=1><input type=hidden name=id value=p_html><input type=hidden name=no value=873><input type=hidden name=select_arrange value=headnum><input type=hidden name=desc value=asc><input type=hidden name=page_num value=20><input type=hidden name=keyword value=""><input type=hidden name=category value=""><input type=hidden name=sn value="off"><input type=hidden name=ss value="on"><input type=hidden name=sc value="off"><input type=hidden name=mode value="">

<input type=hidden name=simplereply_id value='<?=$simplereply_id?>'>
<input type=hidden name=id value='<?=$id?>'>
<input type=hidden name=page value='<?=$page?>'>
<input type=hidden name=number value='<?=$number?>'>
<input type=hidden name=parent value='<?=$number?>'>
<input type=hidden name=src_name value='<?=$src_name?>'>
<input type=hidden name=src_value value='<?=$src_value?>'>

<?
while($array2 = mysql_fetch_array($result2)) {
	$cmt_number = $array2[number]; // 글 번호
	$cmt_name = stripslashes($array2[name]); // 간단한 답글 내용
	$cmt_comment = nl2br(stripslashes($array2[comment])); // 간단한 답글 내용
	$cmt_date = date('Y-m-d',$array2[writetime]); // 글쓴 날짜
	$cmt_time = date('H:i:s',$array2[writetime]); // 글쓴 시간
	$a_simple_del = "<a onfocus='blur();' href=simplereply_del.php?id=$id&number=$number&page=$page&replyno=$replyno&src_name=$src_name&src_value=$src_value&cmt_number=$cmt_number>";
	$img_del = "";
	if($HTTP_COOKIE_VARS[cook_userid]==$array2[userid] || $HTTP_COOKIE_VARS[cook_userlevel] == '1') {
		$img_del = "<img src=".$skindir."/delete_s.gif border=0 align=absmiddle>";
	}
?>

<? include $skindir."view_comment.php"; // 코멘트 스킨?>

<?
} // while문 닫기
?>

<? include $skindir."view_comment_w.php"; // 코멘트 등록하기 스킨?>

<!-- 코멘트 보기 / 등록하기 끝 -->

<?
} // if문 닫기(간단 답글 유무 체크)
?>

<? include $skindir."view_foot.php"; // 리스트,글쓰기 등 버튼 스킨?>



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