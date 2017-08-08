<?
include "db_info.php";

// 코멘트 출력
$sql = " select count(*) from comment where id = '$id' and pass='$passwd'";
$result = mysql_query($sql,$conn);
$row = mysql_fetch_row($result);

if ($row[0] = 0) { 
?>			
	<script>
		alert("비밀번호가 틀리므로 삭제할 수 없습니다."); 
		history.back(-1);
	</script>
<?
//	exit;
	}

$result = mysql_query(" delete from comment where id = '$id' ",$conn);

// 코멘드가 삭제되었으니 원문의 comment count 를 하나 감소
$sql = " update threadboard set cmt_cnt=cmt_cnt-1 where id='$bid'";
$result = mysql_query($sql,$conn);

header("location:$HTTP_REFERER");
?>
