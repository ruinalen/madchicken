<?
if ($HTTP_COOKIE_VARS[cook_userlevel] != 1) {
    echo "관리자가 아닙니다.";
    exit;
}
?>

<?
$tablename = "member";
$sql = "select count(number) from $tablename";
$result = mysql_query($sql) or die(mysql_error() . $sql);
$row = mysql_fetch_row($result);
$cur_num = $row[0];

$sql = "select * from $tablename order by userdate desc";
$result = mysql_query($sql) or die(mysql_error() . $sql);
?>
<img src="logo_share3.gif" border="0">
<table border="1" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#CCCCCC">
    <tr height="25">
        <td width="50" bgcolor="#CCCCCC" height="21">
            <p align="center"><b><font color="black">번호</font></b></p>
        </td>
        <td width="100" bgcolor="#CCCCCC" height="21">
            <p align="center"><b><font color="black">사용자ID</font></b></p>
        </td>
        <td bgcolor="#CCCCCC" width="150" height="21">
            <p align="center"><b><font color="black">사용자 이름</font></b></p>
        </td>
        <td bgcolor="#CCCCCC" width="70" height="21">
            <p align="center"><b><font color="black">레벨</font></b></p>
        </td>
        <td bgcolor="#CCCCCC" height="21">
            <p align="center"><b><font color="black">가입일자</font></b></p>
        </td>
        <td bgcolor="#CCCCCC" height="21">
            <p align="center"><b><font color="black">수정</font></b></p>
        </td>
        <td bgcolor="#CCCCCC" height="21">
            <p align="center"><b><font color="black">삭제</font></b></p>
        </td>
    </tr>
    <?
    while ($array = mysql_fetch_array($result)) {
        $row = mysql_fetch_row(mysql_query("select count(number) from $tablename"));
        $date = date("Y/m/d", $array[userdate]); //가입일시를 Y/m/d 형식에 맞게 문자열로 바꿉니다.
        ?>
        <tr height="25">
            <td>
                <p align="center"><?= $cur_num; ?></p>
            </td>
            <td>
                <p align="center"><?= $array[userid]; ?></p>
            </td>
            <td>
                <p align="center"><?= $array[username]; ?></p>
            </td>
            <td>
                <p align="center"><?= $array[userlevel]; ?>
                    <?
                    if ($array[userlevel] == '1') echo "(Admin)";
                    ?>
                </p>
            </td>
            <td>
                <p align="center"><?= $date; ?></p>
            </td>
            <td>
                <p align="center"><a href="<?= $PHP_SELF ?>?exec=modify_member&number=<?= $array[number]; ?>">Modify</a>
                </p>
            </td>
            <td>
                <p align="center"><a href="<?= $PHP_SELF ?>?exec=del_member&number=<?= $array[number]; ?>">Delete</a>
                </p>
            </td>
        </tr>
        <?
        $cur_num--;
    }
    ?>
</table>