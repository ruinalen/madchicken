<?
if ($HTTP_COOKIE_VARS[cook_userlevel] != 1) {
    echo "관리자가 아닙니다.";
    exit;
}
?>

<?
$sql = "select count(id) from multiconfig";
$result = mysql_query($sql) or die(mysql_error() . $sql);
$row = mysql_fetch_row($result);
$cur_num = $row[0];

$sql = "select * from multiconfig order by reg_date desc";
$result = mysql_query($sql) or die(mysql_error() . $sql);
?>
<img src="logo_share1.gif" border="0">
<table border="0" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#CCCCCC">
    <tr height="25">
        <td width="50" bgcolor="#CCCCCC">
            <p align="center"><b><font color="black">번호</font></b></p>
        </td>
        <td width="150" bgcolor="#CCCCCC">
            <p align="center"><b><font color="black">게시판 이름</font></b></p>
        </td>
        <td bgcolor="#CCCCCC">
            <p align="center"><b><font color="black">전체 글 수</font></b></p>
        </td>
        <td bgcolor="#CCCCCC">
            <p align="center"><b><font color="black">미리보기</font></b></p>
        </td>
        <td bgcolor="#CCCCCC">
            <p align="center"><b><font color="black">설정 변경</font></b></p>
        </td>
        <td bgcolor="#CCCCCC">
            <p align="center"><b><font color="black">삭제</font></b></p>
        </td>
    </tr>
    <?
    while ($array = mysql_fetch_array($result)) {
        $row = mysql_fetch_row(mysql_query("select count(number) from $array[id]"));

        ?>
        <tr height="25">
            <td>
                <p align="center"><?= $cur_num; ?></p>
            </td>
            <td>
                <p align="center"><?= $array[id]; ?></p>
            </td>
            <td>
                <p align="center"><?= $row[0]; ?></p>
            </td>
            <td>
                <p align="center"><a href="../djboard.php?id=<?= $array[id]; ?>" target="_blank">View</a></p>
            </td>
            <td>
                <p align="center"><a href="admin_page.php?id=<?= $array[id]; ?>&exec=view_board">Setup</a></p>
            </td>
            <td>
                <p align="center"><a href="admin_page.php?id=<?= $array[id]; ?>&exec=del_board">Delete</p>
            </td>
        </tr>
        <?
        $cur_num--;
    }
    ?>
</table>