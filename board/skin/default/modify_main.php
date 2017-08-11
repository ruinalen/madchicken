<?
/***********************************
 * $a로 시작하는 것은 <a href로 시작하는 것입니다. 따라서 반드시 뒤에 </a> 태그가 필요합니다.
 *
 * $a_submit 글쓰기 버튼 링크
 * $a_list 목록 보기 버튼 링크
 *
 * $name 이름
 * $email 이메일
 * $homepage 홈페이지
 * $subject 제목
 * $memo 내용
 * $finelname 첨부파일 이름
 *
 * <?=$hide_start?> : 회원일 때 글쓰기 등을 나타나지 않게 하는 부분입니다; 주석(<!--)이 시작됩니다.
 * <?=$hide_end ?>  : 회원일 때 보이지 않게 하는 부분의 끝입니다. 주석의 끝(-->)입니다.
 * <?=$hide_start?>로 시작하고 <?=$hide_end?> 로 감싸주면 됩니다.
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
                    <td><input type=text name=name size=20 maxlength=20 value='<?= $name; ?>'></td>
                    <td width=150 align=right><b>비밀번호&nbsp;</b></td>
                    <td><input type=password name=password size=20 maxlength=20 value=''></td>
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
            <input type=text name=email size=40 maxlength=200 value='<?= $email; ?>'>
        </td>
    </tr>
    <tr>
        <td bgcolor=white height=1 colspan=2></td>
    </tr>
    <tr>
        <td align=right><b>홈페이지&nbsp;</b></td>
        <td><input type=text name=homepage size=40 maxlength=200 value='<?= $homepage; ?>'></td>
    </tr>
    <tr>
        <td bgcolor=white height=1 colspan=2></td>
    </tr>
    <?= $hide_end ?>
    <tr>
        <td align=right><b>HTML 사용&nbsp;</b></td>
        <td><input type=checkbox name=html value='Y' <? if ($array[html] == "Y") echo "checked"; ?>> HTML 사용함
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=checkbox name=br
                                                                         value='Y' <? if ($array[br] == "Y") echo "checked"; ?>>
            엔터 → &lt;br&gt;처리
        </td>
    </tr>
    <tr>
        <td bgcolor=white height=1 colspan=2></td>
    </tr>
    <tr>
        <td align=right><b>제목&nbsp;</b></td>
        <td><input type=text name=subject size=72 maxlength=200 value='<?= $subject; ?>'></td>
    </tr>
    <tr>
        <td bgcolor=white height=1 colspan=2></td>
    </tr>
    <tr>
        <td align=right><b>내용&nbsp;</b></td>
        <td valign=top>
            <textarea name=memo cols=70 rows=20><?= $memo; ?></textarea>
        </td>
    </tr>
    <?
    if ($attach == 'Y') { // 파일 첨부 기능이 있을 경우에 사용함. 이 조건문은 그대로 사용해야 합니다.
// 업로드 파일 갯수 지정($num) : 여기서는 3개로 지정함
        for ($num = 1; $num <= 3; $num++) {
            $selectfile = "upfile" . $num; // input 태그의 name 속성 값을 inputname1, inputname2, inputname3으로 설정하기 위함
            ?>
            <tr>
                <td align=right><b>파일<?= $num ?>&nbsp;</b></td>
                <td><input type="file" name="<?= $selectfile ?>" size="56"><br>
                    <?
                    $temp = "s_file_name" . $num; // $array[첨자] 첨자로 사용될 변수
                    $uploaded = $array[$temp]; //이 두 줄을 합치면, $array[s_file_name1] $array[s_file_name2] $array[s_file_name3]
                    if (!($uploaded == '' || $uploaded == 'none')) { // 이 줄은 그대로 쓰세요
                        echo "<b>{$uploaded}</b> 파일이 등록되어 있습니다. ";
                    }
                    ?>
                </td>
            </tr>
            <?
        } // for문
    } // if문
    ?>
    <tr>
        <td bgcolor=#CCCCCC height=2 colspan=2></td>
    </tr>
</table>
<br>
<center>
    <?= $a_submit; ?><img src="<?= $skindir ?>/modify.gif" border="0" align=absmiddle></a> &nbsp;&nbsp;
    <?= $a_list; ?><img src="<?= $skindir ?>/list.gif" border="0" align=absmiddle></a>
</center>