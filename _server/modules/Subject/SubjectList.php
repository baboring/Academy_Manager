<?php
    require_once ('_server/modules/Subject/SubjectHandler.php');
    $search_key = GetSafeValueGet('search_key','');
    $search_val = GetSafeValueGet('search_val','');
    if(empty($p_id))
        $p_id = null;
?>
        <div>
        <table width="99%" >
            <?php 
            $res = SubjectHandler::ReqData_SubjectList($p_id,$search_key,$search_val);
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
                $szLine.='<button class="btnEdit" id="'.$row['s_id'].'" name="'.$row['s_title'].'">Edit</button>';
                $szLine.='</td>';
                echo $szLine.='</tr>';
            }; ?>
        </table> </div>
        
        <hr><a href="<?=Navi::GetUrl(Navi::Subject,'Add');?>" ><button>Add Subject</button></a>
        <div style="text-align:center;">
            <?php //print
                echo $res->pageNumbers();
                //echo $res->itemsPerPage(); ?>
        </div>
    </div>

<!-- local script functions -->
<script>
function DeleteClient(res, uid, user_name) {

    var obj = document.location.reload();
}

window.onload = function() {

    function clickSelect( uid, user_name ) {
        GoUrl('/Subject/Edit/' + uid);
        //call_API('?func=SetClientInfo&uid=' + uid + '&name=' + user_name);
    }

    var buttons = document.getElementsByClassName("btnEdit");
    for(var i=0; i<buttons.length; i++) {
        (function(n) {
            buttons[n].addEventListener('click',function(event) {
                clickSelect(buttons[n].id, buttons[n].name);
            });
        })(i);
    }    
};
</script>
<?php /////////////////////////////////////////////////////////

?>