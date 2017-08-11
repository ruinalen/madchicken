<?
include "../lib/bm_dbconfig.php"; // DB 연결을 위한 환경 파일
include "../lib/bm_function.php"; // 사용자 정의 함수

$connect = bm_dbconnect($host, $db_id, $db_passwd, $db_name); // MySQL DB 연결(사용자 정의 함수 bm_dbconnect 이용)
$sql = "select count(number) from member where userlevel='1'"; // member 테이블에서 관리자 등록 여부 확인
$result = mysql_query($sql) or die (mysql_error() . $sql);
$row = mysql_fetch_row($result);

if ($row[0] > 0) {
    bm_error("이미 등록된 관리자가 있습니다.");
} else {

    ?>
    <html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=euc-kr">
        <title>DJ 보드 관리자 등록</title>
        <script language="javascript">
            function check_submit() {
                if (document.myForm.userid.value == "") {
                    alert('ID를 입력하세요');
                    document.myForm.userid.focus();
                    return;
                } else if (document.myForm.userpw.value == "") {
                    alert('비밀번호를 입력하세요.');
                    document.myForm.userpw.focus();
                    return;
                } else if (document.myForm.username.value == "") {
                    alert('이름을 입력하세요.');
                    document.myForm.username.focus();
                    return;
                } else if (document.myForm.useremail.value == "") {
                    alert('이메일을 입력하세요.');
                    document.myForm.useremail.focus();
                    return;
                } else {
                    document.myForm.action = "admin_reg_ok.php";
                    document.myForm.submit();
                }

            }
        </script>

    </head>

    <body bgcolor="white" text="black" link="blue" vlink="purple" alink="red">

    <form name="myForm" method="post">

        <table border="0" width="550" align="center">
            <tr>
                <td height="30" colspan="4" bgcolor="#C3C3C3">
                    <img src="admin_reg.gif">
                </td>
            </tr>
            <tr>
                <td height="10" colspan="4" bgcolor="#FFFFFF">
                </td>
            </tr>
            <tr>
                <td height="20" colspan="4" bgcolor="#FFFFFF">
                    <img src="info1.gif">
                </td>
            </tr>
            <tr>
                <td height="3" colspan="4" bgcolor="#CCCCCC">
                </td>
            </tr>
            <tr>
                <td width="10" height="20">
                </td>
                <td width="77">
                    <p><img src="sign_id.gif" width="77" height="14" border="0"></p>
                </td>
                <td width="20">
                    <p><img src="sign_etc.gif" width="3" height="15" border="0"></p>
                </td>
                <td>
                    <p><input type="text" name="userid" size="20"
                              style="border-color:rgb(237,237,237); border-style:solid;"><span
                                style="font-size:9pt;"><font color="#996600">
            </font></span><font face="굴림" color="#996600"><span style="font-size:9pt;"> 반드시 영문자로 시작해야 합니다</span></font>
                    </p>
                </td>
            </tr>
            <tr>
                <td height="1" colspan="4" bgcolor="#E4E4E4">
                </td>
            </tr>
            <tr>
                <td width="10" height="20">
                </td>
                <td width="77">
                    <p><img src="sign_pw.gif" width="77" height="14" border="0"></p>
                </td>
                <td width="20">
                    <p><img src="sign_etc.gif" width="3" height="15" border="0"></p>
                </td>
                <td>
                    <p><input type="password" name="userpw" size="20"
                              style="border-color:rgb(237,237,237); border-style:solid;"><span
                                style="font-size:9pt;"><font color="#996600">
            </font></span></p>
                </td>
            </tr>
            <tr>
                <td height="1" colspan="4" bgcolor="#E4E4E4">
                </td>
            </tr>
            <tr>
                <td width="10" height="20">
                </td>
                <td width="77">
                    <p><img src="sign_pw2.gif" width="77" height="14" border="0"></p>
                </td>
                <td width="20">
                    <p><img src="sign_etc.gif" width="3" height="15" border="0"></p>
                </td>
                <td>
                    <p><input type="password" name="userpw2" size="20"
                              style="border-color:rgb(237,237,237); border-style:solid;"><span
                                style="font-size:9pt;"><font color="#996600">
            </font></span></p>
                </td>
            </tr>
            <tr>
                <td height="1" colspan="4" bgcolor="#E4E4E4">
                </td>
            </tr>
            <tr>
                <td width="10" height="20">
                </td>
                <td width="77">
                    <p><img src="sign_name.gif" width="77" height="14" border="0"></p>
                </td>
                <td width="20">
                    <p><img src="sign_etc.gif" width="3" height="15" border="0"></p>
                </td>
                <td>
                    <p><input type="text" name="username" size="20"
                              style="border-color:rgb(237,237,237); border-style:solid;"><span
                                style="font-size:9pt;"><font color="#996600">
            </font></span></p>
                </td>
            </tr>
            <tr>
                <td height="1" colspan="4" bgcolor="#E4E4E4">
                </td>
            </tr>
            <tr>
                <td width="10" height="20">
                </td>
                <td width="77">
                    <p><img src="sign_email.gif" width="77" height="15" border="0"></p>
                </td>
                <td width="20">
                    <p><img src="sign_etc.gif" width="3" height="15" border="0"></p>
                </td>
                <td>
                    <p><input type="text" name="useremail" size="20"
                              style="border-color:rgb(237,237,237); border-style:solid;"><span
                                style="font-size:9pt;"><font color="#996600">
            </font></span></p>
                </td>
            </tr>
            <tr>
                <td height="1" colspan="4" bgcolor="#E4E4E4">
                </td>
            </tr>
            <tr>
                <td height="10" colspan="4" bgcolor="#FFFFFF">
                </td>
            </tr>
            <tr>
                <td height="20" colspan="4" bgcolor="#FFFFFF">
                    <img src="info2.gif">
                </td>
            </tr>
            <tr>
                <td height="3" colspan="4" bgcolor="#CCCCCC">
                </td>
            </tr>
            <tr>
                <td width="10" height="20">
                </td>
                <td width="77">
                    <p><img src="sign_jumin.gif" width="77" height="15" border="0"></p>
                </td>
                <td width="20">
                    <p><img src="sign_etc.gif" width="3" height="15" border="0"></p>
                </td>
                <td>
                    <p><input type="text" name="userjumin" size="20"
                              style="border-color:rgb(237,237,237); border-style:solid;"><span
                                style="font-size:9pt;"><font color="silver">
            </font></span><font face="굴림" color="#996600"><span style="font-size:9pt;">예) 
            851231-1234567</span></font></p>
                </td>
            </tr>
            <tr>
                <td height="1" colspan="4" bgcolor="#E4E4E4">
                </td>
            </tr>
            <tr>
                <td width="10" height="20">
                </td>
                <td width="77">
                    <p><img src="sign_home.gif" width="77" height="15" border="0"></p>
                </td>
                <td width="20">
                    <p><img src="sign_etc.gif" width="3" height="15" border="0"></p>
                </td>
                <td>
                    <p><input type="text" name="userhome" size="20"
                              style="border-color:rgb(237,237,237); border-style:solid;"><span
                                style="font-size:9pt;"><font color="silver">
            </font></span></p>
                </td>
            </tr>
            <tr>
                <td height="1" colspan="4" bgcolor="#E4E4E4">
                </td>
            </tr>
            <tr>
                <td width="10" height="20">
                </td>
                <td width="77">
                    <p><img src="sign_local.gif" width="77" height="15" border="0"></p>
                </td>
                <td width="20">
                    <p><img src="sign_etc.gif" width="3" height="15" border="0"></p>
                </td>
                <td>
                    <p><input type="text" name="useraddr" size="20"
                              style="border-color:rgb(237,237,237); border-style:solid;"><span
                                style="font-size:9pt;"><font color="silver">
            </font></span></p>
                </td>
            </tr>
            <tr>
                <td height="1" colspan="4" bgcolor="#E4E4E4">
                </td>
            </tr>
            <tr>
                <td width="10" height="20">
                </td>
                <td width="77">
                    <p><img src="sign_phone.gif" width="77" height="15" border="0"></p>
                </td>
                <td width="20">
                    <p><img src="sign_etc.gif" width="3" height="15" border="0"></p>
                </td>
                <td>
                    <p><input type="text" name="userphone" size="20"
                              style="border-color:rgb(237,237,237); border-style:solid;"><span
                                style="font-size:9pt;"><font color="silver">
            </font></span></font></p>
                </td>
            </tr>
            <tr>
                <td height="25" colspan="4" bgcolor="#CCCCCC">
                    <p align="right"><a href="javascript:check_submit();"><img src="sign_ok.gif" align="middle"
                                                                               width="36" height="29" border="0"></a>
                        &nbsp;&nbsp;&nbsp;<a href="/"><img src="sign_cancel.gif" align="middle" border="0"></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
        </table>
    </form>
    </body>
    </html>
    <?
}
?>