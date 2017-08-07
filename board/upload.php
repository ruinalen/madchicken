<?php

if(!$_FILES['file']['name'])
{
    echo "<script>alert('업로드 할 파일이 입력되지 않았습니다.');";
    echo "history.back();</script>";
    exit;
}

if(strlen($_FILES['file']['name']) > 255)
{
    echo "<script>alert('파일 이름이 너무 깁니다.');";
    echo "history.back();</script>";
    exit;
}

$date = date("YmdHis", time());
$dir = "./files/";
$file_hash = $date.$_FILES['file']['name'];
$file_hash = md5($file_hash);
$upfile = $dir.$file_hash;

if(is_uploaded_file($_FILES['file']['tmp_name']))
{
    if(!move_uploaded_file($_FILES['file']['tmp_name'], $upfile))
    {
        echo "upload error";
        exit;
    }
}

$query = "insert into ftp (name, hash, time) 
              values('".$_FILES['file']['name']."', 
              '".$file_hash."', '".$date."')";
$result = $db->query($query);
if(!$result)
{
    echo "DB upload error";
    exit;
}

$db->close();

echo "<script>alert('업로드 성공');";
echo "history.back();</script>";

?>