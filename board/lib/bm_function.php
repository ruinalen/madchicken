<?
//MySQL DB 연결
function bm_dbconnect($host, $db_id, $db_passwd, $db_name)
{
    $connect = mysql_connect($host, $db_id, $db_passwd) or die (mysql_error());
    mysql_select_db($db_name);
    return $connect;
}

//오류 처리
function bm_error($msg)
{
    echo "
		<script>
		window.alert('$msg')
		history.go(-1)
		</script>
		";
}

// 메시지 출력하고 페이지 이동하기
function golocation($url, $msg)
{
    echo " <html><head>
		<script name=javascript>
		if('$msg' != '') {
			self.window.alert('$msg');
		}
		location.href='$url';
		</script>
		</head>
		</html> ";
}

function logout($ret_url)
{
// 생성한 쿠키의 값의 유효기간을 생성 1시간 전으로 돌림으로써 쿠키 삭제 효과
    SetCookie("userid", "", time() - 3600, "/");
    SetCookie("username", "", time() - 3600, "/");
    SetCookie("small_sid", "", time() - 3600, "/");
    SetCookie("userlevel", "", time() - 3600, "/");
    golocation($ret_url, "");
}

/*********************************************
 * // 문자열 끊기 (이상의 길이일때는 … 로 표시)
 *********************************************/

function cut_str($msg, $cut_size)
{
    if ($cut_size <= 0) return $msg;
    $point = 1;
    for ($i = 0; $i < strlen($msg); $i++) {
        if ($point > $cut_size) return $pointtmp . "...";

        if (ord($msg[$i]) > 127) {
            if ($point == $cut_size) return $pointtmp . "...";
            $pointtmp .= $msg[$i] . $msg[++$i];
            $point += 0.4;
        } elseif (ord($msg[$i]) == 37 || ord($msg[$i]) == 92 || ord($msg[$i]) == 64) {
            if ($point == $cut_size) return $pointtmp . "...";
            $pointtmp .= $msg[$i];
            $point += 0.4;
        } else {
            if (!(ord($msg[$i]) > 64 && ord($msg[$i]) < 91)) {
                $point -= 0.1;
            }
            $pointtmp .= $msg[$i];
            if ($point == $cut_size) return $pointtmp . "...";
        }

        $point++;
    }
    return $pointtmp;
}

?>