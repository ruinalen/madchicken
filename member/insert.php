<?php
echo "query()함수를 이용한 테이블 생성 <br />";

$host = 'localhost';
$user = 'root';
$pw = 'rtemd513';
$dbName = 'madchicken';
$mysqli = new mysqli($host, $user, $pw, $dbName);

$sql = "CREATE TABLE member (";
$sql = $sql."id varchar(12) not null,";
$sql = $sql."name varchar(8) not null,";
$sql = $sql."sex char(2),";
$sql = $sql."age int,";
$sql = $sql."point int,";
$sql = $sql."address varchar(7),";
$sql = $sql."primary key(id));";

if($mysqli->query($sql)){
    echo '테이블 생성 완료';
}else{
    echo '테이블 생성 실패';
}


$sql = "insert into myclass_tb values";
$sql = $sql."('dooly', '둘리', '남', 10, 100, 'korea')";
$mysqli->query($sql);

$sql = "insert into myclass_tb values";
$sql = $sql."('asimo', '아시모', '남', 18, 200, 'honda')";
$mysqli->query($sql);

$sql = "insert into myclass_tb values";
$sql = $sql."('partner', '파트너', '남', 8, 180, 'toyota')";
$mysqli->query($sql);

$sql = "insert into myclass_tb values";
$sql = $sql."('hades', '하데스', '남', 45, 350, 'greece')";
$mysqli->query($sql);

$sql = "insert into myclass_tb values";
$sql = $sql."('lee', '이연희', '여', 20, 600, 'korea')";
$mysqli->query($sql);
?>