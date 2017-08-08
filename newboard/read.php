<html>
<head>
<title>계층형 게시판</title>
<LINK REL="stylesheet" TYPE="text/css" HREF="style.css">
</head>

<body topmargin=0 leftmargin=0 >
<center>
<BR>
<?
//데이터 베이스 연결하기
include "db_info.php";

// 조회수 업데이트
$result=mysqli_query("update $board set see=see+1 where id=$_GET[id]", $conn);

// 글 정보 가져오기
$result=mysqli_query("select * from $board where id=$_GET[id]", $conn);
$row=mysqli_fetch_array($result);

?>

<table width=580 border=0  cellpadding=2 cellspacing=1 bgcolor=#777777>
<tr>
	<td height=20 colspan=4 align=center bgcolor=#555555>
		<font color=white><B><?=strip_tags($row[title], '<b><i>');?></B></font>
	</td>
</tr>
<tr>
	<td width=50 height=20 align=center bgcolor=#EEEEEE>글쓴이</td><td width=240 bgcolor=white><?=strip_tags($row[name], '<b><i>');?></td>
	<td width=50 height=20 align=center bgcolor=#EEEEEE>이메일</td><td width=240 bgcolor=white><?=strip_tags($row[email], '<b><i>');?></td>
</tr>
<tr>
	<td width=50 height=20 align=center bgcolor=#EEEEEE>날&nbsp;&nbsp;&nbsp;짜</td><td width=240 bgcolor=white><?=date("Y-m-d",$row[wdate])?></td>
	<td width=50 height=20 align=center bgcolor=#EEEEEE>조회수</td><td width=240 bgcolor=white><?=$row[see]?></td>
</tr>
<tr>
	<td bgcolor=white colspan=4 style="word-break:break-all;">
		<font color=black>
			<? 
				if ($row[filename]) {
					$temp_name = explode('||',$row[filename]); 
					$save_file_name = $temp_name[0];
					$original_file_name = $temp_name[1];

					echo "첨부된 파일 : <a href='download.php?filename=$row[filename]'>$original_file_name</a><BR><BR>";
				}
				
				echo nl2br(strip_tags($row[comment], '<b><i><img><a>'));
			?>
		</font>
		<BR><BR>
		<? include "comment.php"; ?>
	</td>				
</tr>
<!-- 기타 버튼 들 -->
<tr>
	<td colspan=4 bgcolor=#555555>
		<table width=100%>
			<tr>
				<td width=280 align=left height=20>
					<a href=list.php?no=<?=$_GET[no]?>&field=<?=$_GET[field]?>&search_word=<?=$_GET[search_word]?>><font color=white>[목록보기]</font></a>
					<a href=reply.php?id=<?=$_GET[id]?>><font color=white>[답글달기]</font></a>
					<a href=write.php><font color=white>[글쓰기]</font></a>
					<a href=edit.php?id=<?=$_GET[id]?>><font color=white>[수정]</font></a>
					<a href=predel.php?id=<?=$_GET[id]?>><font color=white>[삭제]</font></a>
				</td>
			</tr>
		  </table>
<!-- 기타 버튼 끝 -->
</td>
</tr>
</table>
<!-- 이전 다음 표시 -->
<?
	
	//  현재 글보다 id 값이 큰 글 중 가장 작은 것을 가져온다. 즉 바로 이전 글
	$query=mysqli_query("select title,name,id from $board where thread > $row[thread] and depth=0 limit 1", $conn);
	$prev_id=mysqli_fetch_array($query);

		if ($prev_id[id]) // 이전 글이 있을 경우
		{
?>
<table  width=580 bgcolor=white style="border-bottom-width:1; border-bottom-style:solid;border-bottom-color:cccccc;">
	<tr>
		<td>
		<a href="read.php?id=<?=$prev_id[id]?>&field=<?=$_GET[field]?>&search_word=<?=$_GET[search_word]?>">
		[이전] &nbsp;<?=$prev_id[title]?></a>
		</td>
		<td width=100 align=right><?=$prev_id[name]?></td>
	</tr>
</table><?
		}

	$query=mysqli_query("select max(thread) from $board where thread > " . ($row[thread]-100000) . " and thread < $row[thread]", $conn);
	$next_thread=mysqli_fetch_row($query);

	$query=mysqli_query("select title,name,id from $board where thread = '$next_thread[0]'", $conn);
	$next_id=mysqli_fetch_array($query);

		if ($next_id[id])
		{
?><table  width=580 bgcolor=white style="border-bottom-width:1; border-bottom-style:solid;border-bottom-color:cccccc;">
	<tr>
		<td>
		<a href="read.php?id=<?=$next_id[id]?>&field=<?=$_GET[field]?>&search_word=<?=$_GET[search_word]?>">
		[다음] &nbsp;<?=$next_id[title]?></a>
		</td>
		<td width=100 align=right><?=$next_id[name]?></td>
	</tr>
	</table>
<?
		}
?>
<BR>
<?
$thread_end = ceil($row[thread]/1000)*1000;
$thread_start = (ceil($row[thread]/1000)-1)*1000;
$query = "select * from $board where thread <= $thread_end and thread > $thread_start order by thread desc";
$result = mysqli_query($query, $conn);
?>
<!-- 게시물 리스트를 보이기 위한 테이블 -->
<table width=580 border=0  cellpadding=2 cellspacing=1 bgcolor=#777777>
<!-- 리스트 타이틀 부분 -->
<tr height=20 bgcolor=#555555>
	<td width=30 align=center>
		<font color=white>번호</font>
	</td>
	<td width=370  align=center>
		<font color=white>제 목</font>
	</td>
	<td width=50 align=center>
		<font color=white>글쓴이</font>
	</td>		
	<td width=80 align=center>
		<font color=white>날 짜</font>
	</td>
	<td width=40 align=center>
		<font  color=white>조회수</font>
	</td> 	
</tr>
<!-- 리스트 타이틀 끝 -->
<!-- 리스트 부분 시작 -->
<?
while($row=mysqli_fetch_array($result))
{

?>
<!-- 행 시작 -->
<tr>
	<!-- 번호 -->
	<td height=20  bgcolor=white align=center>
		<a href=read.php?id=<?=$row[id]?>&no=<?=$_GET[no]?>&field=<?=$_GET[field]?>&search_word=<?=$_GET[search_word]?>><?=$row[id]?></a>
	</td>
	<!-- 번호 끝 -->
	<!-- 제목 -->
	<td height=20  bgcolor=white>&nbsp;
		<? if ($row[depth] > 0) echo "<img src=img/dot.gif height=1 width=" . $row[depth]*7 . ">->"?><a href=read.php?id=<?=$row[id]?>&no=<?=$_GET[no]?>&field=<?=$_GET[field]?>&search_word=<?=$_GET[search_word]?>><?=strip_tags($row[title], '<b><i>');?></a>
	</td>
	<!-- 제목 끝 -->
	<!-- 이름 -->
	<td align=center height=20 bgcolor=white>
		<font  color=black>
			<a href="mailto:<?=$row[email]?>"><?=$row[name]?></a>
		</font>
	</td>
	<!-- 이름 끝 -->
	<!-- 날짜 -->
	<td align=center height=20 bgcolor=white>
		<font  color=black><?=date("Y-m-d",$row[wdate])?></font>
	</td>
	<!-- 날짜 끝 -->
	<!-- 조회수 -->
	<td align=center height=20 bgcolor=white>
		<font  color=black><?=$row[see]?></font>
	</td>
	<!-- 조회수 끝 -->
</tr>
<!-- 행 끝 -->
<?
} // end While
mysqli_close($conn);
?>

</center>
</body>
</html>
