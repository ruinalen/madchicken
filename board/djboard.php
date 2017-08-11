<?
include "lib/bm_dbconfig.php"; // DB 연결을 위한 환경 파일
include "lib/bm_function.php"; // 사용자 정의 함수

if ($id == '') {
    bm_error("게시판 이름이 지정되지 않았습니다 \\n[예]djboard.php?id=게시판이름");
    return;
}

$connect = bm_dbconnect($host, $db_id, $db_passwd, $db_name); // MySQL DB 연결(사용자 정의 함수 bm_dbconnect 이용)
$sql = "select * from multiconfig where id = '$id'"; // djboard.php?id=xxx 와 같은 식으로 호출
$result = mysql_query($sql) or die (mysql_error() . $sql);
$array = mysql_fetch_array($result);
$skindir = "skin/" . $array[skin] . "/"; // 스킨 디렉토리
$membership = $array[membership]; // 회원제 여부

$simplereply_yn = $array[simplereply]; // 간단 답글 사용 유무

if ($array[authlist] != '10') { // 사용자 등급이 10이 아니면, 즉 회원가입을 해야 볼 수 있다면...
    if ($HTTP_COOKIE_VARS[cook_userlevel] > $array[authlist] || $HTTP_COOKIE_VARS[cook_userlevel] == '') {
        bm_error("접근 권한이 없습니다.");
        return;
    }
}

$tablename = $id; // 테이블 이름

if ($page == '') $page = 1; //페이지 번호가 없으면 1

$list_num = $array[list_num]; // 한 페이지에 보여줄 목록 갯수
$page_num = $array[page_num]; // 한 화면에 보여줄 페이지 링크(묶음) 갯수

$offset = $list_num * ($page - 1); //한 페이지의 시작 글 번호(listnum 수만큼 나누었을 때 시작하는 글의 번호)

$title = $array[title];//"다중 게시판" ;
$head_file = $array[head_file];//게시판 상단 꾸미기
$head = stripslashes($array[head]);
$foot_file = $array[foot_file];//게시판 하단 꾸미기
$foot = stripslashes($array[foot]);
$tbwidth = $array[tbwidth];// 게시판 테이블 가로
$tbalign = $array[tbalign];// 게시판 테이블 정렬 방식
$background = $array[background]; // 전체 배경 그림
$strlen = $array[strlen]; // 제목 글자수

//검색을 위한 SQL where 문 만들기
if ($src_value != '') {
    $where = "where $src_name like '%$src_value%'";
}

//전체 글 수를 구합니다. (쿼리문을 사용하여 결과를 배열로 저장하는 일반적인 방법)
$query = "select count(*) from $tablename $where"; // SQL 쿼리문을 문자열 변수에 일단 저장하고
$result = mysql_query($query) or die (mysql_error() . $sql); // 위의 쿼리문을 실제로 실행하여 결과를 result에 저장한 다음
$row = mysql_fetch_row($result); //위 결과 값을 하나하나 배열로 저장합니다.
$total_no = $row[0]; //배열의 첫번째 요소의 값, 즉 테이블의 전체 글 수를 저장합니다.

//전체 페이지 수와 현재 글 번호를 구합니다.
$total_page = ceil($total_no / $list_num); // 전체글수를 페이지당글수로 나눈 값의 올림 값을 구합니다.
$cur_num = $total_no - $list_num * ($page - 1); //현재 글번호

//테이블에서 목록을 가져옵니다. (위의 쿼리문 사용예와 비슷합니다.)
//$query="select * from $tablename $where order by number desc limit $offset, $list_num"; // SQL 쿼리문. where 문은 order by 문 앞에
$query = "select * from $tablename $where order by replyno desc, replyst limit $offset, $list_num"; // 답변형 게시판일 경우
$result = mysql_query($query) or die (mysql_error() . $sql); // 쿼리문을 실행 결과

$ret_url = "$PHP_SELF?id=$id";

?>

<? include "copyright.txt"; // 저작권 ?>
<html>
<head>
    <meta http-equiv=content-type content=text/html; charset=euc-kr>
    <title><?= $title; ?></title>
    <? include $skindir . "style.css"; ?>
</head>
<body leftmargin="0" topmargin="0" background="<?= $background; ?>">

<? if ($head_file != '') include $head_file; ?>
<? echo "$head"; ?>

<table border=0 cellspacing=0 width=<?= $tbwidth; ?> align=<?= $tbalign; ?>>

    <?
    if ($membership == "Y") { // 회원제 게시판이면
        ?>
        <tr>
            <td align=right>
                <font face="Tahoma"><b><span style="font-size:7pt;">
	<?
    if (!$HTTP_COOKIE_VARS[cook_userid]) { // 로그인 하지 않은 경우
        echo "<a href=signon.php?ret_url=$ret_url&id=$id>SIGN ON</a> | <a href=logon.php?ret_url=$ret_url&id=$id>LOG IN</a>"; // id=$id를 한번 더씀.

    } else { // 로그인 했을 경우
        echo "{$HTTP_COOKIE_VARS[cook_userid]}(Level {$HTTP_COOKIE_VARS[cook_userlevel]}) LOGGED IN | <ahref=modifyinfo.php?ret_url=$ret_url&id=$id>MODIFY INFO</a> | <a href=logout.php?ret_url=$ret_url&id=$id>LOG OUT</a>";

    }
    if ($HTTP_COOKIE_VARS[cook_userlevel] == '1') { // 관리자이면
        echo " | <a href=admin/admin_page.php target=_blank>ADMIN PAGE</a>";
    }
    ?>
	</span></b></font>
            </td>
        </tr>
        <?
    } // 회원제 게시판 조건 끝.
    ?>

    <tr>
        <td>
            <? include $skindir . "list_head.php"; // 게시판 타이틀 출력 ?>

            <?

            $simplereply_id = $id . "_simplereply"; // 간단 답글 테이블 이름

            while ($array = mysql_fetch_array($result)) {

                $sql2 = "select count(number) from $simplereply_id where parent = $array[number]"; // 게시물에 해당되는 간단 답글 갯수 구함
                $result2 = mysql_query($sql2);
                $row = mysql_fetch_row($result2);
                $simplereply_cnt = $row[0];// 간단 답글 갯수

                $date = date("Y/m/d", $array[writetime]); //글쓴시각을 Y/m/d 형식에 맞게 문자열로 바꿉니다.
                $name = stripslashes($array[name]);
                if ($array[memberid] != '') {
                    $name = "<b>$name</b>"; // 회원이 쓴 글은 굵게 표시
                }
                $count = $array[count];
                $subject = stripslashes($array[subject]);
                $subject = cut_str($subject, $strlen); // 제목 자르기
                $subject = "<a href='view.php?id=$id&page=$page&number=$array[number]&src_name=$src_name&src_value=$src_value'>" . $subject . "</a>";
                // 제목을따로 뺌
                $depth = strpos($array[replyst], "A"); // [RE] 앞에 답변 깊이에 따라 공백을 추가하기 위해
                if ($depth > 0) {
                    for ($temp = 0; $temp < $depth - 1; $temp++) {
                        $nbsp = "&nbsp;" . $nbsp;
                    }
                    $subject = $nbsp . "<img src='{$skindir}re.gif' align='absmiddle'>" . $subject;
                }

                $ext = explode(".", $array[file_name1]); // 파일 이름을 . 를 기준으로 나누어 배열에 저장
                $file1 = '';
                if ($array[file_name1]) $file1 = "<img src=" . $skindir . "i_etc.gif border=0 alt='기타파일'>";
                if ($ext[sizeof($ext) - 1] == 'jpg' || $ext[sizeof($ext) - 1] == 'gif' || $ext[sizeof($ext) - 1] == 'png') $file1 = "<img src=" . $skindir . "i_img.gif border=0 alt='그림파일'>";
                if ($ext[sizeof($ext) - 1] == 'xls') $file1 = "<img src=" . $skindir . "i_xls.gif border=0 alt='엑셀파일'>";
                if ($ext[sizeof($ext) - 1] == 'ppt') $file1 = "<img src=" . $skindir . "i_ppt.gif border=0 alt='파워포인트파일'>";
                if ($ext[sizeof($ext) - 1] == 'doc') $file1 = "<img src=" . $skindir . "i_doc.gif border=0 alt='워드파일'>";
                if ($ext[sizeof($ext) - 1] == 'zip' || $ext[sizeof($ext) - 1] == 'rar' || $ext[sizeof($ext) - 1] == 'lzh' || $ext[sizeof($ext) - 1] == 'tar') $file1 = "<img src=" . $skindir . "i_zip.gif border=0 alt='압축파일'>";
                if ($ext[sizeof($ext) - 1] == 'hwp') $file1 = "<img src=" . $skindir . "i_hwp.gif border=0 alt='한글파일'>";


                if ($simplereply_yn != "Y") { // 간단 답글 유무 체크
                    $simplereply_cnt = 0;
                }

                include $skindir . "list_main.php"; // 게시판 목록 출력

                $cur_num--;

            }
            ?>

            <?
            //여기서부터 각종 페이지 링크
            //먼저, 한 화면에 보이는 블록($page_num 기본값 이상일 때 블록으로 나뉘어짐)
            $total_block = ceil($total_page / $page_num);
            $block = ceil($page / $page_num); //현재 블록

            $first = ($block - 1) * $page_num; // 페이지 블록이 시작하는 첫 페이지
            $last = $block * $page_num; //페이지 블록의 끝 페이지

            // 스킨에서 사용할 변수 정의 시작. 해당 사항이 없을 경우 가리기 위해 임의의 태그 <Hide 기본값으로 설정

            $a_link_first = "<Hide ";
            $a_link_jump_pre = "<Hide ";
            $a_link_pre = "<Hide ";
            $a_link_next = "<Hide ";
            $a_link_jump_next = "<Hide ";
            $a_link_end = "<Hide ";

            if ($block >= $total_block) {
                $last = $total_page;
            }


            //[처음][*개앞]
            if ($block > 1) {
                $prev = $first - 1;
                $a_link_first = "<a onfocus='blur();' href='$PHP_SELF?id=$id&page=1&src_name={$src_name}&src_value={$src_value}'>";
                $a_link_jump_pre = "<a onfocus='blur();' href='$PHP_SELF?id=$id&page=$prev&src_name=$src_name&src_value=$src_value'>";
            }

            //[이전]
            if ($page > 1) {
                $pre_page = $page - 1;
                $a_link_pre = "<a onfocus='blur();' href='$PHP_SELF?id=$id&page=$pre_page&src_name=$src_name&src_value=$src_value'>";
            }

            //페이지 링크
            for ($page_link = $first + 1; $page_link <= $last; $page_link++) {
                if ($page_link == $page) {
                    $print_link_page .= "<b>$page_link</b>";
                } else {
                    $print_link_page .= "<a onfocus='blur();'href=$PHP_SELF?id=$id&page=$page_link&src_name=$src_name&src_value=$src_value>[$page_link]</a>";

                }
            }

            //[다음]
            if ($total_page > $page) {
                $next_page = $page + 1;
                $a_link_next = "<a onfocus='blur();' href='$PHP_SELF?id=$id&page=$next_page&src_name=$src_name&src_value=$src_value'>";
            }

            //[*개뒤][마지막]
            if ($block < $total_block) {
                $next = $last + 1;
                $a_link_jump_next = "<a onfocus='blur();' href='$PHP_SELF?id=$id&page=$next&src_name=$src_name&src_value=$src_value'>";
                $a_link_end = "<a onfocus='blur();' href='$PHP_SELF?id=$id&page=$total_page&src_name=$src_name&src_value=$src_value'>";
            }

            $a_write = "<a onfocus='blur();' href='write.php?id=$id&page=$page&src_name=$src_name&src_value=$src_value'>";

            ?>

            <? include $skindir . "list_foot.php"; ?>

            <p align="right">
                <? include $skindir . "copyright.php"; // 저작권?>
            </p>

        </td>
    </tr>
</table>

<? if ($foot_file != '') include $foot_file; ?>
<? echo "$foot"; ?>
</body>
</html>