<?
include "lib/bm_dbconfig.php"; // DB 연결을 위한 환경 파일
include "lib/bm_function.php"; // 사용자 정의 함수

$tablename = $id;

$connect = bm_dbconnect($host, $db_id, $db_passwd, $db_name); // MySQL DB 연결(사용자 정의 함수 bm_dbconnect 이용)

//입력폼(write.php)에서 전송된 내용을 변수에 담습니다.
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
// if($upfile != '' ) {   // 파일이 업로드되었을 경우
// if(strcmp($upfile,"none") && $upfile !='') {   // 파일이 업로드되었을 경우

for ($num = 1; $num <= 3; $num++) { // 업로드한 파일이 최대 3개까지

    $upfile = ${"upfile" . $num}; // 업로드된 임시 파일 이름
    $upfile_name = ${"upfile" . $num . "_name"}; // 실제 파일 이름

    if (!(strcmp($upfile, "") && strcmp($upfile, "none"))) {    //$upfile이 ""이면 0, 아니면 1이 됨. 따라서 업로드되지 않았을 경우에 strcmp 결과는 0이 되고, !strcmp 이므로 if 조건문은 1이 되어 참이 됨. 으~ 복잡해라. 한마디로 파일이 업로드되지 않았을 경우 아래 코드를 실행하라는 뜻.
        continue; // 아래 코드를 실행하지 말고 for 문으로 다시 돌아가라는 뜻.
    } else { // 파일이 업로드되었다면...
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
        ${"target" . $num} = $target; // $num의 값에 따라 변하는 변수명 만들기
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
    } // 36행의 if문 닫기

} // 31행의 for문 닫기

################파일 업로드를 위해 추가된 부분 : 끝 ######################### 

//SQL 명령을 이용해 입력받은 내용과 디폴트값 등을 MySQL에 입력(insert)합니다.

$sql = "insert into $tablename (number,memberid,name,password,email,homepage,subject,memo,count,ip,writetime,file_name1,s_file_name1,file_name2,s_file_name2,file_name3,s_file_name3,replyno,replyst,html,br) 
        values('','$memberid','$name','$password','$email','$homepage',
        '$subject','$memo',$count,'$ip',$writetime,'$target1','$upfile1_name','$target2','$upfile2_name','$target3','$upfile3_name','','AAAAA','$html','$br')";
// $target : 첨부파일 이름(디렉토리 포함), $upfile_name 첨부파일 이름만.

mysql_query($sql) or die (mysql_error() . $sql);

############# 답변형 게시판을 위해 추가한 부분 ##################

$sql = "select number from $tablename where ip='$ip' and writetime=$writetime"; // 방금 입력한 글 번호를 찾습니다.
$result = mysql_query($sql) or die (mysql_error() . $sql);
$row = mysql_fetch_array($result);
$number = $row[0];

$sql = "update $tablename set replyno = $number where number = $number"; // 답글이 아니기 때문에 replyno에 원글의 number 값을 대입합니다.
mysql_query($sql) or die (mysql_error());


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