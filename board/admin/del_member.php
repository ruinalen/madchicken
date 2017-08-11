<?
if ($HTTP_COOKIE_VARS[cook_userlevel] != 1) {
    echo "관리자가 아닙니다.";
    exit;
}
?>
<img src="logo_share3.gif" border="0">
<br><br><br><br>
<center><b><font color=red><?= $id; ?></font></b> 선택한 회원 정보를 삭제하려 합니다.<br>
    삭제를 하시려면 관리자 ID와 Password를 한번 더 입력해주세요
</center>
<form name="myForm" method="post" action="del_member_ok.php">
    <input type="hidden" name="number" value="<?= $number; ?>">

    <table align="center" cellpadding="1" cellspacing="0" width="200" bgcolor="teal">
        <tr>
            <td>
                <table cellpadding="0" cellspacing="0" width="100%" align="center" bgcolor="white">
                    <tr>
                        <td width="75" height="30">
                            <p align="right"><font size="2">ID</font></p>
                        </td>
                        <td height="30">
                            <p align="center"><input type="text" name="userid" size="15"></p>
                        </td>
                    </tr>
                    <tr>
                        <td width="75" height="30">
                            <p align="right"><font size="2">Password</font></p>
                        </td>
                        <td height="30">
                            <p align="center"><input type="password" name="userpw" size="15"></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table align="center">
        <tr>
            <td>
                <input type="submit" name="delboardform" value="삭제">
</form>
</td>
<td>
    <form name="Form_cancel" method="post" action="javascript:history.go(-1);">
        <input type="submit" name="cancel" value="취소">
    </form>
</td>
</tr>
</table>