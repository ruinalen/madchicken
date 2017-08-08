<script language="javascript">

function showPassword(ob){
var x,y;

	x = (document.body.offsetWidth-200)/2 + document.body.scrollLeft;
	y = (document.body.offsetHeight)/2 + document.body.scrollTop;

	document.all.divPasswd.style.top = y;
     document.all.divPasswd.style.left = x;

	document.all.divPasswd.style.display=""
	document.pwForm.id.value=ob;
	document.pwForm.passwd.focus();		
}

function submit_Passwd()
{
	var val = document.pwForm.passwd.value;
	if (CheckStr(val, " ", "")==0) 
    {
      alert("패스워드를 입력해 주세요");
      document.pwForm.passwd.value="";
      document.pwForm.passwd.focus();
      return;
    }
        
	document.pwForm.submit();
}
function CheckStr(strOriginal, strFind, strChange){
    var position, strOri_Length;
    position = strOriginal.indexOf(strFind);  
    
    while (position != -1){
      strOriginal = strOriginal.replace(strFind, strChange);
      position    = strOriginal.indexOf(strFind);
    }
  
    strOri_Length = strOriginal.length;
    return strOri_Length;
}
</script>
<?
    $sql_cmt = " select id,name,comment,ip,DATE_FORMAT(wdate,'%Y-%m-%d') as date from comment where bid = '$id'";
    $result_cmt = mysql_query($sql_cmt,$conn);

	while($row_cmt=mysql_fetch_array($result_cmt)) {
        $str = $row_cmt[comment];
        $comment = strip_tags($str,"");
		$str = $row_cmt[name];
        $name = strip_tags($str,"");

//커멘트 리스트
?>
<table width=100% border=0 align=center cellpadding=0 cellspacing=1 style="border-width:1; border-color:rgb(234,234,234); border-style:solid;">
<tr bgcolor=fafafa >
    <td >
        <table width=100%>
        <tr >
            <td valign=top width=60 align=right><?=$name?> | </td>
            <td valign=top style='word-break:break-all;'><?=nl2br($comment)?></td>
            <td align=right width=90>
                <?=$row_cmt[date]?> <a href="javascript:showPassword(<?=$row_cmt[id]?>);">x</a>
            </td>
        </tr>
        </table>
    </td>
</tr>
</table>
<?
//-- END

	}

// 코멘트 입력
?>
<table width=100% align=center border=0 cellpadding=3 cellspacing=1 style="border-width:1; border-color:rgb(234,234,234); border-style:solid;" >
<tr>
    <td>
        <table width=100% cellpadding=3 cellspacing=0>
        <form  name=comment_insert method=post action='comment_insert.php'>
        <input type=hidden name=bid value='<?=$id?>'>
        <tr>
            <td>
                이름 <input type=text name=name size=20 maxlength=10 style="BORDER-RIGHT: #cccccc 1px solid; BORDER-TOP: #cccccc 1px solid; BORDER-LEFT: #cccccc 1px solid; BORDER-BOTTOM: #cccccc 1px solid" tabindex=1>
                비밀번호 <input type=password name=passwd maxlength=20 size=20 style="BORDER-RIGHT: #cccccc 1px solid; BORDER-TOP: #cccccc 1px solid; BORDER-LEFT: #cccccc 1px solid; BORDER-BOTTOM: #cccccc 1px solid" tabindex=2>
				<input type=submit value=' 등 록 ' style="width:80px;background:f3f3f3;BORDER-RIGHT: #cccccc 1px solid; BORDER-TOP: #cccccc 1px solid; BORDER-LEFT: #cccccc 1px solid;  BORDER-BOTTOM: #cccccc 1px solid" tabindex=4>
            </td>
			</tr>
			<tr>
            <td valign=bottom width=90%><textarea name=comment rows=5 style="width:100%; line-height:150%;BORDER-RIGHT: #cccccc 1px solid; BORDER-TOP: #cccccc 1px solid; BORDER-LEFT: #cccccc 1px solid; BORDER-BOTTOM: #cccccc 1px solid" tabindex=3></textarea></td>
        </tr>
        </form>
        </table>
    </td>
</tr>
</table>
<!--  패스워드 창 -->
<div id="divPasswd" style="display:none;position:absolute;">
<form name="pwForm" method="post" action="comment_delete.php">
	<table width=260 cellpadding="0" cellspacing="1" bgcolor="#999999">
		<tr height="18">
			<td align="left" style="padding-left:56;"><font color=white>패스워드를 입력하세요.</td>
			<td align=right  style="padding-right:5;">	<img src="/images/x.gif" style="cursor:hand" onClick="javascript:document.all.divPasswd.style.display='none';" WIDTH="12" HEIGHT="11">
			</td>
		</tr>
		<tr>	
			<td bgcolor="white" colspan=2 style="padding-left:30;padding-right:30;padding-bottom:10;padding-top:5">
			<input name="passwd" class="verdana" type="password" style="width:120; height:18; padding:2; border:1 solid slategray">  
			<input type="hidden" name="bid"size="10" value="<?=$id?>">
			<input type="hidden" name="id" size="10" value="">
			<img src="/images/submit.gif" style="cursor:hand" align="absmiddle" onClick="submit_Passwd(this);" WIDTH="57" HEIGHT="17">&nbsp;
			</td>
		</tr>
	</table>
</div>
</form>
</div><!-- 패스워드 창 -->
