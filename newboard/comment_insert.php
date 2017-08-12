<?
include "db_info.php";
?>
<?
//코멘트 등록
$sql = " insert into comment VALUES ('','$bid','$name','$passwd','$comment',now(),'$REMOTE_ADDR')";
$result = mysqli_query($conn,$sql);

// 코멘드가 등록되었으니 원문의 comment count 를 하나 증가
$sql = " update threadboard set cmt_cnt=cmt_cnt+1 where id='$bid'";
$result = mysqli_query($conn,$sql);

header("location:$HTTP_REFERER");
?>
