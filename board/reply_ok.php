<?
include "lib/bm_dbconfig.php"; // DB 연결을 위한 환경 파일
include "lib/bm_function.php"; // 사용자 정의 함수

$tablename = $id;

$connect = bm_dbconnect($host, $db_id, $db_passwd, $db_name); // MySQL DB 연결(사용자 정의 함수 bm_dbconnect 이용)

//답변 폼(reply.php)에서 전송된 내용을 변수에 담습니다.
$name = addslashes($name);
$password = addslashes($password);
$email = addslashes($email);
$homepage = addslashes($homepage);
$subject = addslashes($subject);
$memo = addslashes($memo);

//디폴트 값이 필요한 변수에는 디폴트 값을 넣습니다.
$writetime = time();
$ip = getenv("REMOTE_ADDR");
$count = 0;

################파일 업로드를 위해 추가된 부분 : 시작 ######################### 

// 업로드한 파일이 저장될 디렉토리 정의
$target_dir = "up";  // 서버에 up 이라는 디렉토리가 있어야 한다.

// if(strcmp($upfile,"none")) {   // 파일이 업로드되었을 경우
if ($upfile != '' && strcmp($upfile, "none")) {   // 파일이 업로드되었을 경우

// 업로드 금지 파일 식별 부분
    $filename = explode(".", $upfile_name);
    $extension = $filename[sizeof($filename) - 1];

    if (!strcmp($extension, "html") ||
        !strcmp($extension, "htm") ||
        !strcmp($extension, "php") ||
        !strcmp($extension, "inc")) {
        $msg = "업로드가 금지된 파일입니다.";
    }

// 동일한 파일이 있는지 확인하는 부분
    $target = $target_dir . "/" . $upfile_name;
    if (file_exists($target)) {
        $msg = "동일한 파일이 있습니다.";
    }

// 지정된 디렉토리에 파일 저장하는 부분
    if (!copy($upfile, $target)) {   // false일 경우
        $msg = "파일 저장 실패";
    }

// 임시 파일을 삭제하는 부분
    if (!unlink($upfile)) { // false일 경우
        $msg = "임시 파일 삭제 실패";
    }

}

################파일 업로드를 위해 추가된 부분 : 끝 ######################### 

// 답변 원글 찾기
$sql = "select * from $tablename where number='$number'";
$result = mysql_query($sql) or die (mysql_error() . $sql);
$array = mysql_fetch_array($result);

$depth = strpos($array[replyst], "A");

if (!is_int($depth)) {
    echo "오류 : 이 글에 대해서는 더 이상 답변을 입력할 수 없습니다.";
}

$likestr = $array[replyst];
$likestr[$depth] = "_";

$sql = "select replyst from $tablename where replyno = $array[replyno] and replyst like '$likestr' order by replyst desc limit 1";

$reply_result = mysql_query($sql) or die (mysql_error . $sql);
$reply_array = mysql_fetch_array($reply_result);
$reply = $reply_array[replyst];

$reply_str = $reply[depth];
$reply_str = ++$reply_str;

$reply[$depth] = $reply_str;


//SQL 명령을 이용해 입력받은 내용과 디폴트값 등을 MySQL에 입력(insert)합니다.

$sql = "insert into $tablename (number,memberid,name,password,email,homepage,subject,memo,count,ip,writetime,file_name1,s_file_name1,replyno,replyst,html,br) 
        values('','$memberid','$name','$password','$email','$homepage',
        '$subject','$memo',$count,'$ip',$writetime,'$target','$upfile_name',$array[replyno],'$reply','$html','$br')";
// $target : 첨부파일 이름(디렉토리 포함), $upfile_name 첨부파일 이름만.

mysql_query($sql) or die (mysql_error() . $sql);

//글 입력이 완료되면 목록 보기 페이지로 자동 이동하도록 합니다 

if ($msg == '') {
    $msg = "성공적으로 등록되었습니다";
    echo " <html><head> 
                 <script name=javascript> 
                  if('$msg' != '') { 
                         self.window.alert('$msg'); 
                 } 
                 location.href='djboard.php?id=$id&page=$page&src_name=$src_name&src_value=$src_value'; 
                 </script> 
                 </head> 
                 </html> ";
//	mysql_query($sql) or die (mysql_error());
} else {
    echo " <html><head> 
                 <script name=javascript> 
                 if('$msg' != '') { 
                         self.window.alert('$msg'); 
                 } 
                 history.go(-1);
                 </script> 
                 </head> 
                 </html> ";
}

?>