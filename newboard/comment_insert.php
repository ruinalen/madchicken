<?
include "db_info.php";

if (!trim($HTTP_POST_VARS[comment])) {
?>
<script>
	 alert("내용을 입력하여 주십시오.");
 	 history.back(-1);
</script>
<?
	exit;
}

// 간혹 이름이 넘어오지 않는 경우가 생김 (왜 그런지는 아직 모르겠음)
if (!$name) {
?>
<script>
alert("이름을 입력하여 주십시오."); 
history.back(-1);
</script>
<?
	exit;
}
//코멘트 등록
$sql = " insert into comment VALUES ('','$bid','$name','$passwd','$comment',now(),'$REMOTE_ADDR')";
$result = mysqli_query($conn,$sql);

// 코멘드가 등록되었으니 원문의 comment count 를 하나 증가
$sql = " update threadboard set cmt_cnt=cmt_cnt+1 where id='$bid'";
$result = mysqli_query($conn,$sql);

header("location:$HTTP_REFERER");
?>
