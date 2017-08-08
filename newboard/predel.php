<html>
<head>
<title>계층형 게시판</title>
<LINK REL="stylesheet" TYPE="text/css" HREF="style.css">
</head>

<body topmargin=0 leftmargin=0>

<center>
<BR>
<BR>
<!-- 입력된 값을 다음 페이지로 넘기기 위해 FORM을 만든다. -->
<form action=del.php?id=<?=$_GET[id]?> method=post>

<table width=300 border=0  cellpadding=2 cellspacing=1 bgcolor=#555555>
<tr>
	<td height=20 align=center>
		<B><font color=white>비 밀 번 호 확 인</font></B>
	</td>
</tr>
<tr>
	<td align=center bgcolor=white>
		<B>비밀번호 : </b>
		<INPUT type=password name=pass size=20 maxlength=20>
		<INPUT type=submit value="확 인">
		<INPUT type=button value="취 소" onclick="history.back(-1)">
	</td>
</tr>
</table>
