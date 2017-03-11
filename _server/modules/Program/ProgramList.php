<?php
    require_once ('_server/modules/Program/ProgramHandler.php');
    $search_key = GetSafeValueGet('search_key','');
    $search_val = GetSafeValueGet('search_val','');
    
?>
        <div style="height:300px;">
        <table width="99%">
            <?php 
            $res = ProgramHandler::ReqData_ProgramList($search_key,$search_val);
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
                if(SessionManager::GetUserTypeCode() == 200) {
                    $szLine.='<button class="btnSelect" id="'.$row['p_id'].'" name="'.$row['p_name'].'">Select</button> &nbsp;';
                    $szLine.='<button class="btnEdit" id="'.$row['p_id'].'" name="'.$row['p_name'].'">Edit</button>';
                }
                $szLine.='</td>';
                echo $szLine.='</tr>';
            }; ?>
        </table> 
        </div>
        <hr><a href="<?=Navi::GetUrl(Navi::Program,'Add');?>" ><button>Add Program</button></a>
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
        GoUrl('/Subject/SubjectList/' + uid);
    }

    var buttons = document.getElementsByClassName("btnSelect");
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