<?
/***********************************
 * <?=$hide_start?> : 회원일 때 글쓰기 등을 나타나지 않게 하는 부분입니다; 주석(<!--)이 시작됩니다.
 * <?=$hide_end ?>  : 회원일 때 보이지 않게 하는 부분의 끝입니다. 주석의 끝(-->)입니다.
 * <?=$hide_start?>로 시작하고 <?=$hide_end?> 로 감싸주면 됩니다.
 * $attach 파일 첨부 여부
 ***********************************/
?>

<br><br><br>
<table align="center" border="1" cellspacing="0" width="200" bordercolordark="white" bordercolorlight="#CCCCCC">
    <tr>
        <td>
            <p align="center">글 삭제 비밀번호</p>
        </td>
    </tr>
    <?= $hide_start ?>
    <tr>
        <td align="center">
            <input type="password" name="password" maxlength="12" size="12">
        </td>
    </tr>
    <?= $hide_end ?>
</table>

<p align="center">
    <?= $a_ok; ?><img src="<?= $skindir ?>/ok.gif" border="0" align=absmiddle></a> <?= $a_cancel; ?><img
            src="<?= $skindir ?>cancel.gif" border="0" align=absmiddle></a>
</p>