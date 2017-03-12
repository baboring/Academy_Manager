<?php
    require_once ('_server/modules/Program/ProgramHandler.php');
    $search_key = GetSafeValueGet('search_key','');
    $search_val = GetSafeValueGet('search_val','');

    if(SessionManager::IsAdmin()) {
        echo '<div style="padding:10px 10px 0 0;text-align:right;">';
        echo '<a href="'.Navi::GetUrl(Navi::Program,'Add').'" ><button style="background-color:#d2d2f2">Add Program</button></a>';
        echo '</div>';
    }

?>
        <div style="height:365px;">
        <table width="99%">
            <?php 
            $res = ProgramHandler::ReqData_ProgramList($search_key,$search_val);
            $thead['p_id'] = 'IDX';
            $thead['p_name'] = 'Program Name';
            $thead['p_reg_date'] = 'Date';
            $thead['subjects'] = 'Subjects';

            $firstLine = "<thead>";
            foreach($res->data as $key=>$row) {
                $szLine = "<tr>";
                foreach($thead as $key=>$value) {
                    $szLine .=" <td>".$row[$key]."</td>\n";
                    if(null != $firstLine)
                        $firstLine .=" <th>".$value."</th>\n";
                }
                // end of column                    
                if(null != $firstLine) {
                    $firstLine.='<th width="100" align="center">Etc</th>'."\n";
                    echo $firstLine .='</thead>';
                    $firstLine = null;
                }
                $szLine.='<td>';
                if(SessionManager::IsAdmin()) {
                    $szLine.='<button class="btnSelect" id="'.$row['p_id'].'" name="'.$row['p_name'].'">Select</button> &nbsp;';
                    $szLine.='<button class="btnEdit" id="'.$row['p_id'].'" name="'.$row['p_name'].'">Edit</button>';
                }
                else {
                    $szLine.='<button class="btnApply" id="'.$row['p_id'].'" name="'.$row['p_name'].'">Apply</button> &nbsp;';
                }
                $szLine.='</td>';
                echo $szLine.='</tr>';
            }; ?>
        </table> 
        </div>
        <div style="text-align:center;">
            <?php //print
                echo $res->pageNumbers();
                //echo $res->itemsPerPage(); ?>
        <hr>
        </div>
    </div>

<!-- local script functions -->
<script>
window.onload = function() {

    function clickSelect( uid, user_name ) {
        GoUrl('/Subject/SubjectList/' + uid);
    }
    function clickAppy( uid, user_name ) {
        GoUrl('/Enrollment/apply/' + uid);
    }

    var btnSelect = document.getElementsByClassName("btnSelect");
    for(var i=0; i<btnSelect.length; i++) {
        (function(n) {
            btnSelect[n].addEventListener('click',function(event) {
                clickSelect(btnSelect[n].id, btnSelect[n].name);
            });
        })(i);
    }    
    var btnApply = document.getElementsByClassName("btnApply");
    for(var i=0; i<btnApply.length; i++) {
        (function(n) {
            btnApply[n].addEventListener('click',function(event) {
                clickAppy(btnApply[n].id, btnApply[n].name);
            });
        })(i);
    }    
};
</script>
<?php /////////////////////////////////////////////////////////

?>