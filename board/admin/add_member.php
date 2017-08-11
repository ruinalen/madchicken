<?
if ($HTTP_COOKIE_VARS[cook_userlevel] != 1) {
    echo "관리자가 아닙니다.";
    exit;
}

$color_note = "#008484";
?>

<form name="myForm" method="post" action="add_member_ok.php">
    <img src="logo_share4.gif" border="0">
    <table border="1" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#CCCCCC" bgcolor="#EEEEEE">
        <tr>
            <td width="100" height="30">
                <p><b>ID *<b></p>
            </td>
            <td>
                <p><input type="text" name="userid" size="30"> <font color="<?= $color_note; ?>"> 회원 ID 첫 자는 반드시 <b><u>영문</u></b>을
                        쓰세요.</font></p>
            </td>
        </tr>
        <tr>
            <td height="30">
                <p><b>Password *</b></font></p>
            </td>
            <td>
                <p><input type="password" name="userpw" size="30"><font color="<?= $color_note; ?>"> 필수 입력 사항</font></p>
            </td>
        </tr>
        <tr>
            <td height="30">
                <p><b>이름 *</b></font></p>
            </td>
            <td height="30">
                <p><input type="text" name="username" size="30"><font color="<?= $color_note; ?>"> 필수 입력 사항</font></p>
            </td>
        </tr>
        <tr>
            <td height="30">
                <p>주민등록번호</font></p>
            </td>
            <td height="30">
                <p><input type="text" name="userjumin" size="30"></p>
            </td>
        </tr>
        <tr>
            <td height="30">
                <p><b>이메일 *</b></font></p>
            </td>
            <td height="30">
                <p><input type="text" name="useremail" size="30"><font color="<?= $color_note; ?>"> 필수 입력 사항</font></p>
            </td>
        </tr>
        <tr>
            <td height="30">
                <p>홈페이지</font></p>
            </td>
            <td height="30">
                <p><input type="text" name="userhome" size="30"></p>
            </td>
        </tr>
        <tr>
            <td height="30">
                <p>우편번호</font></p>
            </td>
            <td height="30">
                <p><input type="text" name="userpost" size="30"></p>
            </td>
        </tr>
        <tr>
            <td height="30">
                <p>주소</font></p>
            </td>
            <td height="30">
                <p><input type="text" name="useraddr" size="30"></p>
            </td>
        </tr>
        <tr>
            <td height="30">
                <p>연락처</font></p>
            </td>
            <td height="30">
                <p><input type="text" name="userphone" size="30"></p>
            </td>
        </tr>
        <tr>
            <td height="30">
                <p>등급*</font></p>
            </td>
            <td height="30">
                <select name="userlevel" size="1">
                    <option value='2'>2</option>
                    <option value='3'>3</option>
                    <option value='4'>4</option>
                    <option value='5'>5</option>
                    <option value='6'>6</option>
                    <option value='7'>7</option>
                    <option value='8'>8</option>
                    <option value='9'>9</option>
                    <option value='10' selected>10</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <p><input type="submit" name="addmember" value="회원 등록"></p>
            </td>
        </tr>
    </table>
</form>