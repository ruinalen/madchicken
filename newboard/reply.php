<? 
	include "db_info.php";
	$select_parent = mysqli_query("select thread,depth,title,comment from $board where id='$_GET[id]'",$conn);
	echo $select_parent;
	$parent_fetch = mysqli_fetch_row($select_parent);
	$parent_thread = $parent_fetch[0];
	$parent_depth = $parent_fetch[1];
	$parent_title = $parent_fetch[2];
	$parent_comment = "\n" . $parent_fetch[3];
	$parent_comment = "\n" . str_replace("\n","\n>",$parent_comment);
?>
<html>
<head>
<title>계층형 게시판</title>
<LINK REL="stylesheet" TYPE="text/css" HREF="style.css">
</head>

<body topmargin=0 leftmargin=0 >

<center>
<BR>

<!-- 입력된 값을 다음 페이지로 넘기기 위해 FORM을 만든다. -->
<form action=insert_reply.php method=post enctype=multipart/form-data>
<input type=hidden name=parent value=<?=$_GET[id]?>>
<input type=hidden name=parent_depth value=<?=$parent_depth?>>
<input type=hidden name=parent_thread value=<?=$parent_thread?>>

<table width=580 border=0  cellpadding=2 cellspacing=1 bgcolor=#777777>
<tr>
	<td height=20 align=center bgcolor=#555555>
		<font color=white><B>글 쓰 기</B></font>
	</td>
</tr>

<!-- 입력 부분 -->
<tr>
	<td  bgcolor=white>&nbsp;
		<table width=100%>
			<tr>
				<td width=60 align=right >이름</td>
				<td align=left >
					<INPUT type=text name=name size=20 maxlength=10  value="<?=$Form_name?>">
				</td>
			</tr>
			<tr>
				<td width=60 align=right >이메일</td>
				<td align=left >
					<INPUT type=text name=email size=20 maxlength=25>
				</td>
			</tr>
			<tr>
				<td width=60 align=right >비밀번호</td>
				<td align=left >
					<INPUT type=password name=pass size=20 maxlength=20 value="<?=$Form_pass?>"> (수정,삭제시 반드시 필요)
				</td>
			</tr>
			<tr>
				<td width=60 align=right >제 목</td>
				<td align=left >
					<INPUT type=text name=title size=60 maxlength=35 value="RE:<?=$parent_title?>">
				</td>
			</tr>
			<tr>
				<td width=60 align=right >내용</td>
				<td align=left >
					<TEXTAREA name=comment cols=65 rows=15><?=$parent_comment?></TEXTAREA>
				</td>
			</tr>
			<tr>
				<td width=60 align=right >파일</td>
				<td align=left >
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
