<?
/*********************
 * $a로 시작하는 것은 <a href로 시작하는 것입니다. 따라서 반드시 뒤에 </a> 태그가 필요합니다.
 *
 * $a_link_first 페이지 목록 처음으로
 * $a_link_end 페이지 목록 마지막으로
 *
 * $a_link_jump_pre 이전 페이지 블록으로
 * $a_link_jump_next 다음 페이지 블록으로
 *
 * $a_link_pre 현재 보이는 페이지 이전 페이지로
 * $a_link_next 현재 보이는 페이지 다음 페이지로
 *
 * $print_link_page : 페이지 링크를 표시합니다. 이건 그대로 사용하고 뒤에 </a>를 붙이지 않습니다.
 ***********************/
?>

<tr>
    <td colspan=6 height=3 bgcolor=#CCCCCC>
    </td>
</tr>

</table>
<br>
<table border=0 cellspacing=0 width=100% bordercolordark=white bordercolorlight=#999999>
    <tr>
        <td width=100% colspan=5 align=center>
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td align="left" valign="top" width="200">
                        <?= $a_link_pre; ?><img src="<?= $skindir ?>/prev.gif" border="0" align=absmiddle></a>
                        <?= $a_link_jump_pre; ?><img src="<?= $skindir ?>/prev_list.gif" border="0" align=absmiddle></a>
                        <?= $a_link_first; ?><img src="<?= $skindir ?>/first.gif" border="0" align=absmiddle></a>
                    </td>
                    <td align="center" valign="top">
                        <?= $print_link_page; ?><br>
                        <?= $a_write; ?><img src="<?= $skindir ?>/write.gif" border="0" align=absmiddle></a>
                    </td>
                    <td align="right" valign="top" width="200">
                        <?= $a_link_end; ?><img src="<?= $skindir ?>/end.gif" border="0" align=absmiddle></a>
                        <?= $a_link_jump_next; ?><img src="<?= $skindir ?>/next_list.gif" border="0"
                                                      align=absmiddle></a>
                        <?= $a_link_next; ?><img src="<?= $skindir ?>/next.gif" border="0" align=absmiddle></a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td height=5></td>
    </tr>

    <!-- 검색 입력 폼 // 왠만하면 수정하지 마세요...-->

    <form method=get action='<?= $PHP_SELF ?>'>
        <tr>
            <td width=100% colspan=5 align=center>
                <input type=hidden name=page value=<?= $page; ?>>
                <input type=hidden name=id value=<?= $id; ?>>

                <select name=src_name>
                    <option value=name>이름</option>
                    <option value=subject selected>제목</option>
                    <option value=memo>내용</option>
                </select>

                <input type=text name=src_value size=30>
                <input type=submit value=검색>

            </td>
        </tr>
    </form>
    <!-- 검색 입력 폼 끝 -->

</table>