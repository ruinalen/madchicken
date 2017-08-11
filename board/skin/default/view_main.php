<?
/*****************************************
 * 게시판 내용 보기 부분
 * 변수 의미
 * $name : 작성자
 * $datetime : 작성일자
 * $email : 이메일
 * $homepage : 홈페이지
 * $print_filename1 ~ 3 : 첨부 파일명 출력
 * $subject : 제목
 * $up_image1 ~ 3 : 그림 첨부 파일
 * $memo : 내용
 * $cmt_name : 간단한 답글 작성자
 * $cmt_comment : 간단한 답글 내용
 * $cmt_date : 간단한 답글 작성일
 * $cmt_time : 간단한 답글 작성시간
 * $a_write : 게시물 작성 하이퍼링크 </a>로 닫아주어야 함
 * $a_modify : 게시물 수정 하이퍼링크 </a>로 닫아주어야 함
 * $a_delete : 게시물 삭제 하이퍼링크 </a>로 닫아주어야 함
 * $a_list : 게시물 목록 보기 하이퍼링크 </a>로 닫아주어야 함
 * $a_reply : 게시물 답변 하이퍼링크 </a>로 닫아주어야 함
 * <?=$guest_hide_start?> : 회원이 아닐 때 글쓰기 등을 나타나지 않게 하는 부분입니다; 주석(<!--)이 시작됩니다.
 * <?=$guest_hide_end ?>  : 회원이 아닐 때 보이지 않게 하는 부분의 끝입니다. 주석의 끝(-->)입니다.
 * <?=$guest_hide_start?>로 시작하고 <?=$hide_end?> 로 감싸주면 됩니다.
 *****************************************/

?>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td align="left">

        </td>
        <td align="right">
            <?= $a_modify; ?><img src="<?= $skindir ?>/modify.gif" border="0" align=absmiddle></a> <?= $a_delete; ?><img
                    src="<?= $skindir ?>/delete.gif" border="0" align=absmiddle></a>
        </td>
    </tr>
</table>
<table border="0" cellpadding="1" cellspacing="2" width="100%">
    <tr>
        <td colspan=3 height="2" bgcolor="#CCCCCC">
        </td>
    </tr>
    <tr>
        <td width="100" height="20" bgcolor="#EDEDED">
            <p align="right"><b>Name &nbsp;</b></p>
        </td>
        <td>
            <p><?= $name; ?> </p>
        </td>
        <td>
            <p align="right">
                <?
                echo "<span style=font-size:8pt;><font face=Tahoma>({$datetime}, Hit : {$count})</font></span>";
                ?>
                &nbsp;&nbsp;
            </p>
        </td>
    </tr>
    <?
    if ($array[email] != '') { // 이와 같은 조건을 주지 않으면 이메일 정보가 없어도 이메일 타이틀이 보이게 됩니다.
        echo "
    <tr>
        <td width=100 height=20 bgcolor=#EDEDED>
            <p align=right><b>&nbsp;Email &nbsp;</b></p>
        </td>
        <td colspan=2>
            <p>{$email}</p>
        </td>
    </tr>
		";
    }
    if ($array[homepage] != '') { // 이와 같은 조건을 주지 않으면 홈페이지 정보가 없어도 홈페이지 타이틀이 보이게 됩니다.
        echo "
    <tr>
        <td width=100 height=20 bgcolor=#EDEDED>
            <p align=right><b>&nbsp;Homepage &nbsp;</b></p>
        </td>
        <td colspan=2>
            <p>{$homepage}</p>
        </td>
    </tr>
		";
    }
    if ($array[file_name1] != '') { // 이와 같은 조건을 주지 않으면 첨부파일이 없어도 첨부파일 타이틀이 보이게 됩니다.
        echo "
    <tr>
        <td width=100 height=20 bgcolor=#EDEDED>
            <p align=right><b>&nbsp;File1 &nbsp;</b></p>
        </td>
        <td colspan=2>
            <p>{$print_filename1}</p>
        </td>
    </tr>
		";
    }
    if ($array[file_name2] != '') { // 이와 같은 조건을 주지 않으면 첨부파일이 없어도 첨부파일 타이틀이 보이게 됩니다.
        echo "
    <tr>
        <td width=100 height=20 bgcolor=#EDEDED>
            <p align=right><b>&nbsp;File2 &nbsp;</b></p>
        </td>
        <td colspan=2>
            <p>{$print_filename2}</p>
        </td>
    </tr>
		";
    }
    if ($array[file_name3] != '') { // 이와 같은 조건을 주지 않으면 첨부파일이 없어도 첨부파일 타이틀이 보이게 됩니다.
        echo "
    <tr>
        <td width=100 height=20 bgcolor=#EDEDED>
            <p align=right><b>&nbsp;File3 &nbsp;</b></p>
        </td>
        <td colspan=2>
            <p>{$print_filename3}</p>
        </td>
    </tr>
		";
    }
    ?>
    <tr>
        <td width="100" height="20" bgcolor="#EDEDED">
            <p align="right"><b>&nbsp;Subject &nbsp;</b></p>
        </td>
        <td colspan="2">
            <p><b><?= $subject; ?></b></p>
        </td>
    </tr>
    <tr>
        <td colspan=3 height="2" bgcolor="#CCCCCC">
        </td>
    </tr>
</table>
<table cellpadding="10" cellspacing="0" width="100%">
    <tr>
        <td>
            <p><?= $up_image1 ?></p>
            <p><?= $up_image2 ?></p>
            <p><?= $up_image3 ?></p>
            <p><?= $memo; ?></p>
        </td>
    </tr>
</table>