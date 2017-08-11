<?
if ($HTTP_COOKIE_VARS[cook_userlevel] != 1) {
    echo "관리자가 아닙니다.";
    exit;
}
?>

<?
//include "lib/bm_dbconfig.php"; // DB 연결을 위한 환경 파일
//include "lib/bm_function.php"; // 사용자 정의 함수

//$connect = bm_dbconnect($host, $db_id, $db_passwd, $db_name); // MySQL DB 연결(사용자 정의 함수 bm_dbconnect 이용)
$sql = "select * from member where number='$number'"; // member 테이블에서 해당 레코드 검색
$result = mysql_query($sql) or die (mysql_error() . $sql);
$array = mysql_fetch_array($result);

$color_note = "#008484";
?>
<form name="myForm" method="post" action="modify_member_ok.php">
    <input type="hidden" name="number" value="<?= $number; ?>">
    <img src="logo_share3.gif" border="0">
    <table border="1" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#CCCCCC" bgcolor="#EEEEEE">
        <tr>
            <td width="100" height="30">
                <p><b>ID *<b></p>
            </td>
            <td>
                <p><b><?= $array[userid]; ?></b><font color="<?= $color_note; ?>"> 아이디는 수정할 수 없습니다</font></p>
            </td>
        </tr>
        <tr>
            <td height="30">
                <p><b>Password *</b></font></p>
            </td>
            <td height="30">
                <p><input type="password" name="userpw" size="20" value="<?= $array[userpw]; ?>"><font
                            color="<?= $color_note; ?>"> 필수 입력 사항</font></p>
            </td>
        </tr>
        <tr>
            <td height="30">
                <p><b>이름 *</b></font></p>
            </td>
            <td height="30">
                <p><input type="text" name="username" size="20" value="<?= $array[username]; ?>"><font
                            color="<?= $color_note; ?>"> 필수 입력 사항</font></p>
            </td>
        </tr>
        <tr>
            <td height="30">
                <p>주민등록번호</font></p>
            </td>
            <td height="30">
                <p><input type="text" name="userjumin" size="20" value="<?= $array[userjumin]; ?>"></p>
            </td>
        </tr>
        <tr>
            <td height="30">
                <p><b>이메일 *</b></font></p>
            </td>
            <td height="30">
                <p><input type="text" name="useremail" size="20" value="<?= $array[useremail]; ?>"><font
                            color="<?= $color_note; ?>"> 필수 입력 사항</font></p>
            </td>
        </tr>
        <tr>
            <td height="30">
                <p>홈페이지</font></p>
            </td>
            <td height="30">
                <p><input type="text" name="userhome" size="20" value="<?= $array[userhome]; ?>"></p>
            </td>
        </tr>
        <tr>
            <td height="30">
                <p>우편번호</font></p>
            </td>
            <td height="30">
                <p><input type="text" name="userpost" size="20" value="<?= $array[userpost]; ?>"></p>
            </td>
        </tr>
        <tr>
            <td height="30">
                <p>주소</font></p>
            </td>
            <td height="30">
                <p><input type="text" name="useraddr" size="20" value="<?= $array[useraddr]; ?>"></p>
            </td>
        </tr>
        <tr>
            <td height="30">
                <p>연락처</font></p>
            </td>
            <td height="30">
                <p><input type="text" name="userphone" size="20" value="<?= $array[userphone]; ?>"></p>
            </td>
        </tr>
        <tr>
            <td height="30">
                <p>등급</font></p>
            </td>
            <td height="30">
                <p>
                    <?

                    if ($array[userlevel] == '1') { // 관리자 레벨이면 수정할 수 없게 함
                        echo "		<input type=hidden name=userlevel size=20 value='1'><b>{$array[userlevel]}</b><font color=$color_note> 관리자 등급은 수정할 수 없습니다</font>";
                    } else {
                        ?>
                        <select name="userlevel" size="1">
                            <option value='2' <? if ($array[userlevel] == '2') echo "selected"; ?>>2</option>
                            <option value='3' <? if ($array[userlevel] == '3') echo "selected"; ?>>3</option>
                            <option value='4' <? if ($array[userlevel] == '4') echo "selected"; ?>>4</option>
                            <option value='5' <? if ($array[userlevel] == '5') echo "selected"; ?>>5</option>
                            <option value='6' <? if ($array[userlevel] == '6') echo "selected"; ?>>6</option>
                            <option value='7' <? if ($array[userlevel] == '7') echo "selected"; ?>>7</option>
                            <option value='8' <? if ($array[userlevel] == '8') echo "selected"; ?>>8</option>
                            <option value='9' <? if ($array[userlevel] == '9') echo "selected"; ?>>9</option>
                            <option value='10' <? if ($array[userlevel] == '10') echo "selected"; ?>>10</option>
                        </select>
                        <?
                    }
                    ?>
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <p><input type="submit" name="modifymember" value="수정 완료"></p>
            </td>
        </tr>
    </table>
</form>