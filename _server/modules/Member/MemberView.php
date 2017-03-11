<?php
    require_once ('_server/modules/Member/MemberHandler.php');
    $search_key = GetSafeValueGet('search_key','');
    $search_val = GetSafeValueGet('search_val','');
    
?>
        <div>
        <table width="99%" height="300px">
            <?php 
            $res = MemberHandler::ReqData_MemberList($search_key,$search_val);
            $firstLine = "<thead>";
            foreach($res->data as $key=>$row) {
                $szLine = "<tr>";
                foreach($row as $key=>$value) {
                    if($key != 'u_uid') {
                        $szLine .=" <td>".$value."</td>\n";
                        if(null != $firstLine)
                            $firstLine .=" <th>".$key."</th>\n";
                    }
                }
                // end of column                    
                if(null != $firstLine) {
                    $firstLine.='<th width="100" align="center">Etc</th>'."\n";
                    echo $firstLine .='</thead>';
                    $firstLine = null;
                }
                $szLine.='<td>';
                $szLine.='<button class="btnSelect" id="'.$row['uid'].'" userid="'.$row['userid'].'">Select</button>';
                $szLine.='</td>';
                echo $szLine.='</tr>';
            }; ?>
        </table></div>

        <div style="text-align:center;">
        <table width="100%">
        <tr><td width="20%"></td>
        <td style="text-align:center"><?php echo $res->pageNumbers(); ?></td>
        <td width="20%"><?php //echo $res->itemsPerPage(); ?></td></tr><table>
        </div>
    </div>

<!-- local script functions -->
<script>
function DeleteClient(res, uid, user_name) {

    var obj = document.location.reload();
}

window.onload = function() {

    var btnSearch = document.getElementsByName("btnSearch");
    btnSearch[0].addEventListener('click',function(event) {

        var group = "phone";
        var keyword = document.getElementsByName("search_key")[0].value;
        var params = {};
        params['search'] = keyword;
        params['group'] = group;
        post("<?=Navi::GetUrl(Navi::Member);?>",params,"get");
        
    });
    //btnSearch.addEventListener('click',function (event) {});
    
    function clickDelete( uid, user_name ) {
        if(confirm("[Delete] Are you sure '" + user_name + "' ?")) {
            // var params = {};
            // params['uid'] = uid;
            // params['name'] = user_name;
            // post("<?=Navi::GetUrl(Navi::Member,'Delete');?>",params,"post");

            call_API('?func=DeleteClient&uid=' + uid + '&name=' + user_name);
            
        }
    }
    function clickSelect( uid, user_name ) {
        call_API('?func=SetClientInfo&uid=' + uid + '&name=' + user_name);
    }

    function clickJoinMembership( uid, bid  ) {
        call_API('?func=JoinMembership&uid=' + uid + '&bid=' + bid);
    }

    var buttons = document.getElementsByClassName("btnDelete");
    for(var i=0; i<buttons.length; i++) {
        (function(n) {
            buttons[n].addEventListener('click',function(event) {
                clickDelete(buttons[n].id, buttons[n].name);
            });
        })(i);
    }
    var buttons = document.getElementsByClassName("btnSelect");
    for(var i=0; i<buttons.length; i++) {
        (function(n) {
            buttons[n].addEventListener('click',function(event) {
                clickSelect(buttons[n].id, buttons[n].name);
            });
        })(i);
    }

    var buttons = document.getElementsByClassName("btnJoinMembership");
    for(var i=0; i<buttons.length; i++) {
        (function(n) {
            buttons[n].addEventListener('click',function(event) {
                clickJoinMembership(buttons[n].id, buttons[n].name);
            });
        })(i);
    }

    
};
</script>
<?php /////////////////////////////////////////////////////////

?>