<?
if ($HTTP_COOKIE_VARS[cook_userlevel] != 1) {
    echo "관리자가 아닙니다.";
    exit;
}
?>

<table cellpadding="0" cellspacing="0" width="100%" bgcolor="#E4E4E4">
    <tr>
        <td>
            <a href="admin_page.php?exec=admin_body"><img src="adminlogo2.gif" border="0"></a><br>
            <img src="left_menu1.gif" border="0">
        </td>
    </tr>
    <tr>
        <td align="center" height="25">
            <p align="left">&nbsp;&nbsp;<b><a href="admin_page.php?exec=list_board">게시판 목록
                        보기</a></b></p>
        </td>
    </tr>
    <tr>
        <td align="center" height="1" colspan="2" bgcolor="CCCCCC">
        </td>
    </tr>
    <tr>
        <td align="center" height="30">
            <p align="left">&nbsp;&nbsp;<b><a href="admin_page.php?exec=add_board">게시판 신규
                        등록</a></b></p>
        </td>
    </tr>
    <tr>
        <td>
            <img src="left_menu2.gif" border="0">
        </td>
    </tr>
    <tr>
        <td align="center" height="25">
            <p align="left">&nbsp;&nbsp;<b><a href="admin_page.php?exec=list_member">회원 목록 보기</a></b></p>
        </td>
    </tr>
    <tr>
        <td align="center" height="1" colspan="2" bgcolor="CCCCCC">
        </td>
    </tr>
    <tr>
        <td align="center" height="30">
            <p align="left">&nbsp;&nbsp;<b><a href="admin_page.php?exec=add_member">회원 신규 등록</a></b></p>
        </td>
    </tr>
    <tr>
        <td align="center" height="1" colspan="2" bgcolor="CCCCCC">
        </td>
    </tr>
</table>
<p align="center"><a href="http://www.itmembers.net" target="_blank"><span style="font-size:8pt;"><font color="gray"
                                                                                                        face="Tahoma">copyright(c)
ITmembers.net <br>& Byoungmok Sohn</font></span></a></p>
