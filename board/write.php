<?php
require_once("./dbconfig.php");

$uploads_dir = "uploads/";

// 변수 정리
$error = $_FILES['myfile']['error'];
$name = $_FILES['myfile']['name'];
$ext = array_pop(explode('.', $name));

// 오류 확인
if( $error != UPLOAD_ERR_OK ) {
    switch( $error ) {
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            echo "파일이 너무 큽니다. ($error)";
            break;
        case UPLOAD_ERR_NO_FILE:
            echo "파일이 첨부되지 않았습니다. ($error)";
            break;
        default:
            echo "파일이 제대로 업로드되지 않았습니다. ($error)";
    }
    exit;
}

// 파일 이동
move_uploaded_file( $_FILES['myfile']['tmp_name'], "$uploads_dir/$name");

// 파일 정보 출력
echo "<h2>파일 정보</h2>
	<ul>
		<li>파일명: $name</li>
		<li>확장자: $ext</li>
		<li>파일형식: {$_FILES['myfile']['type']}</li>
		<li>파일크기: {$_FILES['myfile']['size']} 바이트</li>
	</ul>";





if (isset($_GET["id"]))
{
    $id = $_GET["id"];
}

if (isset($id))
{
    $sql = "select id, title, content, date, hit, writer, password, myfile from board where id=" . $id;


    $result = $db->query($sql);
    $row = $result->fetch_assoc();
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8" />
    <title>Free Board</title>
    <link rel="stylesheet" href="./css/normalize.css" />
    <link rel="stylesheet" href="./css/board.css" />
</head>
<body>
<article class="boardArticle">
    <h3>Free Board</h3>
    <div id="boardWrite">
        <form action="./write_update.php" method="post" enctype="multipart/form-data">
            <?php
            if(isset($id)) {
                echo '<input type="hidden" name="id" value="' . $id . '">';
            }
            ?>
            <table id="boardWrite">
                <caption class="readHide">Q&A</caption>
                <tbody>
                <tr>
                    <th scope="row"><label for="id">WRITER</label></th>
                    <td class="writer">
                    <?php
                    if(isset($id)) {
                        echo $row["writer"];
                    } else { ?>
                        <input type="text" name="writer" id="writer"></td>
                    <?php } ?>
                </tr>
                <tr>
                    <th scope="row"><label for="password">PASSWORD</label></th>
                    <td class="password"><input type="text" name="password" id="password"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="title">TITLE</label></th>
                    <td class="title"><input type="text" name="title" id="title"
                                             value="<?php echo isset($row["title"])?$row["title"]:null?>"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="content">CONTENTS</label></th>
                    <td class="content">
                        <textarea name="content" id="content"><?php echo isset($row['content'])?$row['content']:null?></textarea>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="title">FILE</label></th>
                    <td class="title"><input type="file" name="myfile" id="myfile"
                                             value="<?php echo isset($row["myfile"])?$row["myfile"]:null?>"></td>
                </tr>
                </tbody>
            </table>
            <div class="btnSet">
                <button type="submit" class="btnSubmit btn"><?php echo isset($id)?'수정':'작성'?></button>
                <a href="./board/index.php" class="btnList btn">list</a>
            </div>
        </form>
    </div>
</article>
</body>
</html>

