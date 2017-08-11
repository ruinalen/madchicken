<?
if ($HTTP_COOKIE_VARS[cook_userlevel] != 1) {
    echo "관리자가 아닙니다.";
    exit;
}
?>

<p align="right"><span style="font-size:8pt;"><font color="white" face="Tahoma">Ver 1.01</font>&nbsp;<a
                href="http://www.itmembers.net/djboard/index.php" target="_blank"><font color="yellow" face="Tahoma"><b>MANUAL</b></font></a><br>
<font color="white" face="Tahoma">
<?
if ($HTTP_COOKIE_VARS[cook_sid]) { // 로그인 체크 (세션 아이디 존재 여부 확인)
    echo "관리자 <b>{$HTTP_COOKIE_VARS[cook_username]}</b>님({$HTTP_COOKIE_VARS[cook_userid]})께서 사용중입니다</font>&nbsp;&nbsp;";
}
?>
    <a href="../logout.php?ret_url=logon.php?ret_url=admin/admin_page.php"><font color="white"
                                                                                 face="Tahoma"><b>[LogOut]</b></font></a></font></span>&nbsp;
</p>