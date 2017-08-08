<html>
<head>
<title>계층형 게시판</title>
<LINK REL="stylesheet" TYPE="text/css" HREF="style.css">
</head>

<body topmargin=0 leftmargin=0 >

<center>
<BR>

<!-- 입력된 값을 다음 페이지로 넘기기 위해 FORM을 만든다. -->
<form action=update.php?id=<?=$_GET[id]?> method=post  enctype=multipart/form-data>


<table width=580 border=0  cellpadding=2 cellspacing=1 bgcolor=#777777>
<tr>
	<td height=20 align=center bgcolor=#555555>
		<font color=white><B>글 수 정 하 기</B></font>
	</td>
</tr>
<?
//데이터 베이스 연결하기
include "db_info.php";

// 먼저 쓴 글의 정보를 가져온다.
$result=mysql_query("select id,name,email,title,comment,ip,filename from $board where id=$_GET[id]", $conn);
$row=mysql_fetch_array($result);
?>

<!-- 입력 부분 -->
<tr>
	<td  bgcolor=white>&nbsp;
		<table width=100%>
			<tr>
				<td width=60 align=right>이름</td>
				<td align=left >
					<INPUT type=text name=name size=20 maxlength=10 value="<?=$row[name]?>">
				</td>
			</tr>
			<tr>
				<td width=60 align=right>이메일</td>
				<td align=left >
					<INPUT type=text name=email size=20 maxlength=25 value="<?=$row[email]?>">
				</td>
			</tr>
			<tr>
				<td width=60 align=right>비밀번호</td>
				<td align=left >
					<INPUT type=password name=pass size=20 maxlength=20> (비밀번호가 맞아야 수정가능)
				</td>
			</tr>
			<tr>
				<td width=60 align=right>제 목</td>
				<td align=left >
					<INPUT type=text name=title size=60 maxlength=35 value="<?=$row[title]?>">
				</td>
			</tr>
			<tr>
				<td width=60 align=right>내용</td>
				<td align=left >
					<TEXTAREA name=comment cols=70 rows=15><?=$row[comment]?></TEXTAREA>
				</td>
			</tr>
			<tr>
				<td width=60 align=right>파일</td>
				<td align=left >
					<?
					if ($row[filename]) {
						$temp_name = explode('||',$row[filename]); 
						$original_file_name = $temp_name[1];

						echo "첨부된 파일 : $original_file_name</font><BR>";
					}
					?>
				<input type="file" size=20 name="upfile">

				</td>
			</tr>

			<tr>
				<td colspan=10 align=center>
				<BR>
					<INPUT type=submit value="글 저장하기">
					&nbsp;&nbsp;
					<INPUT type=reset value="다시 쓰기">
					&nbsp;&nbsp;
					<INPUT type=button value="되돌아가기" onclick="history.back(-1)">
					<BR><BR>
				</td>
			</tr>
		</TABLE>
	</td>				
</tr>
<!-- 입력 부분 끝 -->
</table>
</form>
</center>
</body>
</html>