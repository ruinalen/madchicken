<?
include "../lib/bm_dbconfig.php"; // DB 연결을 위한 환경 파일
include "../lib/bm_function.php"; // 사용자 정의 함수

if ($HTTP_COOKIE_VARS[cook_userlevel] != '1') { // 로그인 체크
    $url = "../logon.php?ret_url=admin/admin_page.php";
    $msg = "관리자가 아닙니다. 관리자 ID로 로그인하세요";
    golocation($url, $msg);
}

$connect = bm_dbconnect($host, $db_id, $db_passwd, $db_name); // MySQL DB 연결(사용자 정의 함수 bm_dbconnect 이용)

if ($exec != '') {
    $body_file = $exec . ".php";
} else {
    $body_file = "admin_body.php";
}

?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=euc-kr">
    <title>DJ 보드 관리자 페이지</title>
    <STYLE TYPE=text/css>
        BODY, TD, SELECT, input, DIV, form, TEXTAREA, center, option, pre, blockquote {
            font-family: 굴림;
            font-size: 9pt;
            color: #555555;
        }

        OL, UL {
            line-height: 180%;
        }

        A:link {
            color: black;
            text-decoration: none;
        }

        A:visited {
            color: black;
            text-decoration: none;
        }

        A:active {
            color: black;
            text-decoration: none;
        }

        A:hover {
            color: gray;
            text-decoration: none;
        }
    </STYLE>
</head>
<body text="black" link="blue" vlink="purple" alink="red" leftmargin="0" marginwidth="0" topmargin="0" marginheight="0"
      background="body_bg.gif">
<table cellpadding="0" cellspacing="0" width="800">
    <tr>
        <td width="170" height="70" valign="center" align="center" bgcolor="#265E91">
            <p><a href="admin_page.php?exec=admin_body"><img src="adminlogo.gif" border="0"></a></p>
        </td>
        <td valign="center" bgcolor="#265E91">
            <? include "admin_top.php"; ?>
        </td>
    </tr>
    <tr>
        <td width="170" valign="top">
            <? include "admin_left.php"; ?>
        </td>
        <td valign="top">
            <? include $body_file; ?>
        </td>
    </tr>
</table>
</body>
</html>