<?
/********************
 * 게시판 목록 출력 부분입니다.
 *
 * $cur_num // 글 번호. 반드시 써야 함
 * $file1 // 첨부파일 아이콘. 그림파일 i_zip.gif i_doc.gif i_img.gif i_xls.gif i_etc.gif 이 있어야 함.
 * $name //글쓴 사람 이름
 * $subject // 글 제목
 * $date // 글쓴 일시
 * $count // 조회수
 * $simplereply_cnt // 간단 답글 갯수
 *********************/
?>

<?
// 간단 답변 글이 없을 때에 표시하지 않기 위함.
if ($simplereply_cnt == 0) {
    $simplereply_cnt = "";
} else {
    $simplereply_cnt = "[" . $simplereply_cnt . "]";
}
?>
<tr>
    <td width=30 height=22>
        <p align=center><?= $cur_num; ?></p>
    </td>
    <td width=490>
        <?= $subject; ?> <span style="font-size:7pt;"><font color="gray"
                                                            face="Tahoma"><?= $simplereply_cnt ?></font></span>
    </td>
    <td width=30>
        <p align=center><?= $file1; ?></p>
    </td>
    <td width=60>
        <p align=center><?= $name; ?></p>
    </td>
    <td width=70>
        <p align=center><?= $date; ?></p>
    </td>
    <td width=30>
        <p align=center><?= $count; ?></p>
    </td>
</tr>
<tr>
    <td colspan=6 height=1 bgcolor=#CCCCCC>
    </td>
</tr>