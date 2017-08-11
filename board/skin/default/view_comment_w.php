<!-- 코멘트 등록하기 폼 시작-->
<?= $guest_hide_start ?>
<table border=0 cellspacing=1 cellpadding=1 width=100% bgcolor=cccccc>
    <tr>
        <td bgcolor=white>
            <table border=0 cellspacing=1 cellpadding=8 width=100% height=100>
                <col width=85 align=right style=padding-right:10px bgcolor=ededed></col>
                <col width=></col>
                <tr>
                    <td onclick="document.write.comment.rows=document.write.comment.rows+4" style=cursor:hand>
                        <b>Comment</b><br>▼
                    </td>
                    <td>
                        <table border=0 cellspacing=2 cellpadding=0 width=100% height=100%>
                            <col width=></col>
                            <col width=100></col>
                            <tr>
                                <td width=100%><textarea name=comment cols=20 rows=5 style=width:100%></textarea></td>
                                <td width=100><input type=submit rows=5 value='  글쓰기  ' accesskey="s" style=height:100%>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<?= $guest_hide_end ?>
<!-- 코멘트 등록하기 폼 끝-->