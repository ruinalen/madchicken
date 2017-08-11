<?
$sql = "select * from multiconfig where id='$id'";
$result = mysql_query($sql) or die(mysql_error() . $sql);
$array = mysql_fetch_array($result);
$color_note = "#008484";

$array[title] = stripslashes($array[title]);
$array[head] = stripslashes($array[head]);
$array[foot] = stripslashes($array[foot]);

?>

<form name="adminform" method="post" action="admin_modify.php">
    <input type="hidden" name="id" value="<?= $array[id]; ?>">
    <img src="logo_share1.gif" border="0">
    <table border="1" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#CCCCCC" bgcolor="#EEEEEE">
        <tr>
            <td width="150">
                <p><b>게시판 ID<b></p>
            </td>
            <td>

                <p><b><?= $array[id]; ?></b> <font color="<?= $color_note; ?>"> 게시판 이름은 수정할 수 없습니다</font></p>
            </td>
        </tr>
        <tr>
            <td width="150">
                <p><b>게시판 제목</b></p>
            </td>
            <td>
                <p><input type="text" name="title" size="50" value="<?= $array[title]; ?>">&nbsp;</p>
            </td>
        </tr>
        <tr>
            <td width="150">
                <p><b>게시판 유형</b></p>
            </td>
            <td>
                <p>회원제 게시판<input type="radio" name="membership"
                                 value="Y" <? if ($array[membership] == 'Y') echo "checked"; ?>> &nbsp;비회원제(공개형)
                    게시판<input type="radio" name="membership"
                              value="N" <? if ($array[membership] != 'Y') echo "checked"; ?>></p>
            </td>
        </tr>
        <tr>
            <td width="150">
                <p><b>게시판 접근 권한</b></p>
            </td>
            <td>
                <select name="authlist" size="1">
                    <option value="2" <? if ($array[authlist] == '2') echo "selected"; ?>>2</option>
                    <option value="3" <? if ($array[authlist] == '3') echo "selected"; ?>>3</option>
                    <option value="4" <? if ($array[authlist] == '4') echo "selected"; ?>>4</option>
                    <option value="5" <? if ($array[authlist] == '5') echo "selected"; ?>>5</option>
                    <option value="6" <? if ($array[authlist] == '6') echo "selected"; ?>>6</option>
                    <option value="7" <? if ($array[authlist] == '7') echo "selected"; ?>>7</option>
                    <option value="8" <? if ($array[authlist] == '8') echo "selected"; ?>>8</option>
                    <option value="9" <? if ($array[authlist] == '9') echo "selected"; ?>>9</option>
                    <option value="10" <? if ($array[authlist] == '10') echo "selected"; ?>>10</option>
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
                    <option value="2" <? if ($array[authread] == '2') echo "selected"; ?>>2</option>
                    <option value="3" <? if ($array[authread] == '3') echo "selected"; ?>>3</option>
                    <option value="4" <? if ($array[authread] == '4') echo "selected"; ?>>4</option>
                    <option value="5" <? if ($array[authread] == '5') echo "selected"; ?>>5</option>
                    <option value="6" <? if ($array[authread] == '6') echo "selected"; ?>>6</option>
                    <option value="7" <? if ($array[authread] == '7') echo "selected"; ?>>7</option>
                    <option value="8" <? if ($array[authread] == '8') echo "selected"; ?>>8</option>
                    <option value="9" <? if ($array[authread] == '9') echo "selected"; ?>>9</option>
                    <option value="10" <? if ($array[authread] == '10') echo "selected"; ?>>10</option>
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
                    <option value="2" <? if ($array[authwrite] == '2') echo "selected"; ?>>2</option>
                    <option value="3" <? if ($array[authwrite] == '3') echo "selected"; ?>>3</option>
                    <option value="4" <? if ($array[authwrite] == '4') echo "selected"; ?>>4</option>
                    <option value="5" <? if ($array[authwrite] == '5') echo "selected"; ?>>5</option>
                    <option value="6" <? if ($array[authwrite] == '6') echo "selected"; ?>>6</option>
                    <option value="7" <? if ($array[authwrite] == '7') echo "selected"; ?>>7</option>
                    <option value="8" <? if ($array[authwrite] == '8') echo "selected"; ?>>8</option>
                    <option value="9" <? if ($array[authwrite] == '9') echo "selected"; ?>>9</option>
                    <option value="10" <? if ($array[authwrite] == '10') echo "selected"; ?>>10</option>
                </select>
                <font color="<?= $color_note; ?>"> 게시판에 글을 등록할 수 있는 사용자 레벨을 설정합니다 </font>
            </td>
        </tr>
        <tr>
            <td width="150">
                <p><b>첨부파일 사용</b></p>
            </td>
            <td>
                <p>사용함<input type="radio" name="upload" value="Y" <? if ($array[upload] == "Y") echo "checked"; ?>>
                    &nbsp;사용안함 <input type="radio" name="upload"
                                      value="N" <? if ($array[upload] != "Y") echo "checked"; ?>></p>
            </td>
        </tr>
        <tr>
            <td width="150">
                <p><b>간단답변(코멘트) 기능</b></p>
            </td>
            <td>
                <p>사용함<input type="radio" name="simplereply"
                             value="Y" <? if ($array[simplereply] == "Y") echo "checked"; ?>> &nbsp;사용안함 <input
                            type="radio" name="simplereply"
                            value="N" <? if ($array[simplereply] != "Y") echo "checked"; ?>></p>
            </td>
        </tr>
        <!--
    <tr>
        <td width="150">
            <p><b>이미지 파일 사용</b></p>
        </td>
        <td>
            <p>사용함<input type="radio" name="img_file" value="Y" <? if ($array[img_file] == "Y") echo "checked"; ?>> &nbsp;사용안함 <input type="radio" name="img_file" value="N" <? if ($array[img_file] == "N") echo "checked"; ?>> <font color="<?= $color_note; ?>"> 현재 버전에서 사용 불가</font></p>
        </td>
    </tr>
-->
        <tr>
            <td width="150">
                <p><b>게시판 가로 길이</b></p>
            </td>
            <td>
                <p><input type="text" name="tbwidth" size="15" value="<?= $array[tbwidth]; ?>"></p>
            </td>
        </tr>
        <tr>
            <td width="150">
                <p><b>게시판 정렬 방식</b></p>
            </td>
            <td>
                <p>
                    <select name="tbalign">
                        <option value="left" <? if ($array[tbalign] == 'left') echo "selected"; ?>>-왼쪽 정렬-</option>
                        <option value="center" <? if ($array[tbalign] == 'center') echo "selected"; ?>>-가운데 정렬-</option>
                        <option value="right" <? if ($array[tbalign] == 'right') echo "selected"; ?>>-오른쪽 정렬-</option>
                    </select>
                </p>
            </td>
        </tr>
        <tr>
            <td width="150">
                <p><b>한 페이지의 목록 수</b></p>
            </td>
            <td>
                <p><input type="text" name="list_num" size="15" value="<?= $array[list_num]; ?>"></p>
            </td>
        </tr>
        <tr>
            <td width="150">
                <p><b>한 페이지 링크 수</b></p>
            </td>
            <td>
                <p><input type="text" name="page_num" size="15" value="<?= $array[page_num]; ?>"></p>
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
                <p><input type="text" name="background" size="50" value="<?= $array[background]; ?>"></p>
            </td>
        </tr>
        <tr>
            <td width="150">
                <p><b>제목 길이</b></p>
            </td>
            <td>
                <p><input type="text" name="strlen" size="15" value="<?= $array[strlen]; ?>"></p>
            </td>
        </tr>
        <tr>
            <td width="150">
                <p><b>게시판 상단 - 파일</b></p>
            </td>
            <td>
                <p><input type="text" name="head_file" size="50" value="<?= $array[head_file]; ?>"></p>
            </td>
        </tr>
        <tr>
            <td width="150">
                <p><b>게시판 상단 - 내용</b></p>
            </td>
            <td>
                <p><textarea name="head" cols="74" rows="5"><?= $array[head]; ?></textarea></p>
            </td>
        </tr>
        <tr>
            <td width="150">
                <p><b>게시판 하단 - 파일</b></p>
            </td>
            <td>
                <p><input type="text" name="foot_file" size="50" value="<?= $array[foot_file]; ?>"></p>
            </td>
        </tr>
        <tr>
            <td width="150">
                <p><b>게시판 하단 - 내용</b></p>
            </td>
            <td>
                <p><textarea name="foot" cols="74" rows="5"><?= $array[foot]; ?></textarea></p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p align="center"><input type="submit" name="formbutton1" value="설정 완료">
            </td>
        </tr>
</form>
</table>
