<?
if ($HTTP_COOKIE_VARS[cook_userlevel] != 1) {
    echo "관리자가 아닙니다.";
    exit;
}
?>
<img src="logo_share0.gif" border="0">
<br>
<ul>
    <li>DJ 보드는 '배우고 익혀서 나누는 즐거움 <a href="http://www.itmembers.net" target="_blank"><font color=#265E91><b>www.itmembers.net</b></font></a>'에서
        학습용으로 무료 배포합니다.
    <li>DJ는 ITmembers.net 운영자의 사랑스런 딸 이름 이니셜입니다.
    <li>DJ 보드는 Apache/PHP/MySQL 환경에서 작동하는 다중 게시판 프로그램입니다.
        <p>
    <li>DJ 보드의 주요 특징은 다음과 같습니다.
        <ol>
            <li>실제 활용가능할 뿐만 아니라, 소스를 자세하게 설명하고 있습니다.<br>
                <a href="http://www.itmembers.net" target="_blank"><font
                            color=#265E91><b>www.itmembers.net</b></font></a>에서 PHP의 기초부터 DJ 보드 만드는 방법까지 상세하게 설명하고 있습니다.
            <li>쉽게 설치하여 사용할 수 있습니다.<br>
                ① DB 설정 파일(bm_dbconfig.php) 수정<br>
                ② setup.php 실행만으로 설치 OK!
            <li>다중 게시판을 지원합니다.
            <li>회원제 게시판을 지원합니다.
            <li>간단한 답글 달기 기능을 지원합니다(로그인한 경우에만 사용 가능).
            <li>첨부 파일을 3개까지 지정할 수 있으며, 이미지 파일은 본문에 바로 표시됩니다.
            <li>게시판의 생성과 수정, 삭제를 관리자 페이지에서 쉽게 처리할 수 있습니다.
            <li>회원 등록과 정보 수정, 삭제까지 관리자 페이지에서 쉽게 처리할 수 있습니다.
            <li>게시판을 취향에 따라 다양하게 꾸밀 수 있습니다.<br>
                ① 게시판 상/하/좌/우에 반복되는 코드를 삽입하기 위한 상단-하단 파일 설정 기능이 있습니다.<br>
                ② 스킨을 지원합니다. (배포 시에는 default 스킨만 포함하고 있습니다.)<br>
                스킨 제작 규칙에 따라 누구나 자신만의 게시판 디자인을 할 수 있습니다.
        </ol>
        <p>
    <li>다음 버전에서 추가 예정인 기능입니다.
        <ol>
            <li>데이터 백업/복원
            <li>최근 글 뽑아오기 팁, 외부 로그인 팁 등
        </ol>
</ul>