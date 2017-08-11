<?
/***********************************
 * $a로 시작하는 것은 <a href로 시작하는 것입니다. 따라서 반드시 뒤에 </a> 태그가 필요합니다.
 *
 * $a_submit 글쓰기 버튼 링크
 * $a_list 목록 보기 버튼 링크
 *
 * <?=$hide_start?> : 회원일 때 글쓰기 등을 나타나지 않게 하는 부분입니다; 주석(<!--)이 시작됩니다.
 * <?=$hide_end ?>  : 회원일 때 보이지 않게 하는 부분의 끝입니다. 주석의 끝(-->)입니다.
 * <?=$hide_start?>로 시작하고 <?=$hide_end?> 로 감싸주면 됩니다.
 * $attach 파일 첨부 여부
 ***********************************/
?>

<table border=0 width=550 cellspacing=0 cellpadding=0 bgcolor=#F0F0F0 align=<?= $tbalign; ?>>
    <col width=80></col>
    <col width=></col>
    <tr>
        <td bgcolor=#CCCCCC height=2 colspan=2></td>
    </tr>
    <?= $hide_start ?>
    <tr>
        <td colspan=2>
            <table border=0 cellspacing=0 cellpadding=0 width=100%>
                <tr>
                    <td width=80 align=right><b>이름&nbsp;</b></td>
                    <td><input type=text name=name size=20 maxlength=20></td>
                    <td width=150 align=right><b>비밀번호&nbsp;</b></td>
                    <td><input type=password name=password size=20 maxlength=20></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor=white height=1 colspan=2></td>
    </tr>
    <tr>
        <td align=right><b>전자우편&nbsp;</b></td>
        <td>
            <input type=text name=email size=40 maxlength=200>
            &nbsp;&nbsp;&nbsp;
        </td>
    </tr>
    <tr>
        <td bgcolor=white height=1 colspan=2></td>
    </tr>
    <tr>
        <td align=right><b>홈페이지&nbsp;</b></td>
        <td><input type=text name=homepage size=40 maxlength=200></td>
    </tr>
    <tr>
        <td bgcolor=white height=1 colspan=2></td>
    </tr>
    <?= $hide_end ?>
    <tr>
        <td align=right><b>HTML 사용&nbsp;</b></td>
        <td><input type=checkbox name=html value='Y'> HTML 사용함
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=checkbox name=br value='Y' checked> 엔터 →
            &lt;br&gt;처리
        </td>
    </tr>
    <tr>
        <td bgcolor=white height=1 colspan=2></td>
    </tr>
    <tr>
        <td align=right><b>제목&nbsp;</b></td>
        <td><input type=text name=subject size=72 maxlength=200></td>
    </tr>
    <tr>
        <td bgcolor=white height=1 colspan=2></td>
    </tr>
    <tr>
        <td align=right><b>내용&nbsp;</b></td>
        <td valign=top>
            <textarea name=memo cols=70 rows=20></textarea>
        </td>
    </tr>
    <?
    if ($attach == 'Y') { // 파일 첨부 기능이 있을 경우에 사용함. 이 조건문은 그대로 사용해야 합니다.
// 첨부 파일은 3개까지 사용할 수 있습니다.
        ?>
        <tr>
            <td align=right><b>파일1&nbsp;</b></td>
            <td><input type='file' name='upfile1' size='56'></td>
        </tr>
        <tr>
            <td align=right><b>파일2&nbsp;</b></td>
            <td><input type='file' name='upfile2' size='56'></td>
        </tr>
        <tr>
            <td align=right><b>파일3&nbsp;</b></td>
            <td><input type='file' name='upfile3' size='56'></td>
        </tr>
        <?
    } // if문 닫기
    ?>
    <tr>
        <td bgcolor=#CCCCCC height=2 colspan=2></td>
    </tr>
</table>
<br>
<center>
    <?= $a_submit; ?><img src="<?= $skindir ?>/write.gif" border="0" align=absmiddle></a> &nbsp;&nbsp;
    <?= $a_list; ?><img src="<?= $skindir ?>/list.gif" border="0" align=absmiddle></a>
</center>