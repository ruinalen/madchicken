<?
if ($HTTP_COOKIE_VARS[cook_userlevel] != 1) {
    echo "관리자가 아닙니다.";
    exit;
}
?>

<?
$sql = "select * from multiconfig where id='$id'";
$result = mysql_query($sql) or die(mysql_error() . $sql);
$array = mysql_fetch_array($result);
$color_note = "#008484";
?>

<form name="adminform" method="post" action="admin_addboard.php">
    <img src="logo_share2.gif" border="0">
    <table border="1" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#CCCCCC" bgcolor="#EEEEEE">
        <tr>
            <td width="150">
                <p><b>게시판 ID<b></p>
            </td>
            <td>

                <p><input type="text" name="id" size="15"> <font color="<?= $color_note; ?>"> 게시판 이름은 <b><u>영문</u></b>만
                        가능합니다</font></p>
            </td>
        </tr>
        <tr>
            <td width="150">
                <p><b>게시판 제목</b></p>
            </td>
            <td>
                <p><input type="text" name="title" size="50">&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td width="150">
                <p><b>게시판 유형</b></p>
            </td>
            <td>
                <p>회원제 게시판<input type="radio" name="membership" value="Y" checked> &nbsp;비회원제(공개형) 게시판<input
                            type="radio" name="membership" value="N"></p>
            </td>
        </tr>
        <tr>
            <td width="150">
                <p><b>게시판 접근 권한</b></p>
            </td>
            <td>
                <select name="authlist" size="1">
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10" selected>10</option>
                </select>
                <font color="<?= $color_note; ?>"> 게시판 리스트를 볼 수 있는 사용자 레벨을 설정합니다 </font>
            </td>
        </tr>
        <tr>
            <td width="150">
                <p><b>글 읽기 권한</b></p>
            </td>
            <td>
                <select name="authread" size="1">
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10" selected>10</option>
                </select>
                <font color="<?= $color_note; ?>"> 게시판의 글을 읽을 수 있는 사용자 레벨을 설정합니다 </font>
            </td>
        </tr>
        <tr>
            <td width="150">
                <p><b>글 쓰기 권한</b></p>
            </td>
            <td>
                <select name="authwrite" size="1">
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10" selected>10</option>
                </select>
                <font color="<?= $color_note; ?>"> 게시판에 글을 등록할 수 있는 사용자 레벨을 설정합니다 </font>
            </td>
        </tr>
        <tr>
            <td width="150">
                <p><b>첨부파일 사용</b></p>
            </td>
            <td>
                <p>사용함<input type="radio" name="upload" value="Y"> &nbsp;사용안함 <input type="radio" name="upload"
                                                                                     value="N" checked></p>
            </td>
        </tr>
        <tr>
            <td width="150">
                <p><b>간단답변(코멘트) 기능</b></p>
            </td>
            <td>
                <p>사용함<input type="radio" name="simplereply" value="Y"> &nbsp;사용안함 <input type="radio"
                                                                                          name="simplereply" value="N"
                                                                                          checked></p>
            </td>
        </tr>
        <!--
    <tr>
        <td width="150">
            <p><b>이미지 파일 사용</b></p>
        </td>
        <td>
            <p>사용함<input type="radio" name="img_file" value="Y"> &nbsp;사용안함 <input type="radio" name="img_file" value="N" checked> <font color="<?= $color_note; ?>"> 현재 버전에서 사용 불가</font></p>
        </td>
    </tr>
    <tr>
        <td width="150">
            <p><b>한 줄 답변 기능 사용</b></p>
        </td>
        <td>
            <p>사용함<input type="radio" name="simplereply" value="Y"> &nbsp;사용안함 <input type="radio" name="simplereply" value="N" checked> <font color="<?= $color_note; ?>"> 현재 버전에서 사용 불가</font></p>
        </td>
    </tr>
-->
        <tr>
            <td width="150">
                <p><b>게시판 가로 길이</b></p>
            </td>
            <td>
                <p><input type="text" name="tbwidth" size="15" value="95%"></p>
            </td>
        </tr>
        <tr>
            <td width="150">
                <p><b>게시판 정렬 방식</b></p>
            </td>
            <td>
                <p>
                    <select name="tbalign" size="1">
                        <option value="left">-왼쪽 정렬-</option>
                        <option value="center" selected>-가운데 정렬-</option>
                        <option value="right">-오른쪽 정렬-</option>
                    </select>
                </p>
            </td>
        </tr>
        <tr>
            <td width="150">
                <p><b>한 페이지의 목록 수</b></p>
            </td>
            <td>
                <p><input type="text" name="list_num" size="15" value="10"></p>
            </td>
        </tr>
        <tr>
            <td width="150">
                <p><b>한 페이지 링크 수</b></p>
            </td>
            <td>
                <p><input type="text" name="page_num" size="15" value="10"></p>
            </td>
        </tr>
        <tr>
            <td width="150">
                <p><b>스킨 이름</b></p>
            </td>
            <td>
                <p>
                    <select name="skin" size="1">
                        <?
                        // 스킨 디렉토리를 읽어서 스킨 이름 출력
                        $dirhanddle = opendir("../skin/");
                        $i = 0;
                        while ($filename = readdir($dirhanddle)) {
                            if ($filename != '.' && $filename != '..') {
                                echo "<option value='{$filename}'>{$filename}</option>";
                            }
                            $i++;
                        }
                        closedir($dirhanddle);
                        ?>
                    </select>
                    <font color="<?= $color_note; ?>"> 스킨은 직접 제작하여 사용하실 수 있습니다</font>
                </p>
            </td>
        </tr>
        <tr>
            <td width="150">
                <p><b>배경 그림</b></p>
            </td>
            <td>
                <p><input type="text" name="background" size="50"></p>
            </td>
        </tr>
        <tr>
            <td width="150">
                <p><b>제목 길이</b></p>
            </td>
            <td>
                <p><input type="text" name="strlen" size="15" value="100"></p>
            </td>
        </tr>
        <tr>
            <td width="150">
                <p><b>게시판 상단 - 파일</b></p>
            </td>
            <td>
                <p><input type="text" name="head_file" size="50"></p>
            </td>
        </tr>
        <tr>
            <td width="150">
                <p><b>게시판 상단 - 내용</b></p>
            </td>
            <td>
                <p><textarea name="head" cols="74" rows="5"></textarea></p>
            </td>
        </tr>
        <tr>
            <td width="150">
                <p><b>게시판 하단 - 파일</b></p>
            </td>
            <td>
                <p><input type="text" name="foot_file" size="50"></p>
            </td>
        </tr>
        <tr>
            <td width="150">
                <p><b>게시판 하단 - 내용</b></p>
            </td>
            <td>
                <p><textarea name="foot" cols="74" rows="5"></textarea></p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p align="center"><input type="submit" name="formbutton1" value="새 게시판 만들기">
            </td>
        </tr>
</form>
</table>