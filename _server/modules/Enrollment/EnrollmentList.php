<?php
    require_once ('_server/modules/Enrollment/EnrollmentHandler.php');
    $search_key = GetSafeValueGet('search_key','');
    $search_val = GetSafeValueGet('search_val','');
    
?>
        <div style="height:300px;">
        <table width="99%">
            <?php 
            $res = EnrollmentHandler::ReqData_EnrollmentList($search_key,$search_val);
            $thead['ap_id'] = 'IDX';
            $thead['p_name'] = 'Program';
            $thead['first_name'] = 'First Name';
            $thead['last_name'] = 'Last Name';
            $thead['ap_status'] = 'Status';
            $thead['ap_reg_date'] = 'Date';

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
                    $firstLine.='<th width="110" align="center">Etc</th>'."\n";
                    echo $firstLine .='</thead>';
                    $firstLine = null;
                }
                $szLine.='<td>';
                switch($row['ap_status']) {
                    case 0:
                        $szLine.='<button class="btnAccept" id="'.$row['ap_id'].'" name="'.$row['ap_id'].'">Accept</button>&nbsp';
                        $szLine.='<button class="btnReject" id="'.$row['ap_id'].'" name="'.$row['ap_id'].'">Reject</button>';
                        break;
                    case 1:
                        $szLine.='<button class="btnEnroll" id="'.$row['ap_id'].'" name="'.$row['ap_id'].'">Enroll</button>&nbsp';
                        $szLine.='<button class="btnReject" id="'.$row['ap_id'].'" name="'.$row['ap_id'].'">Reject</button>';
                        break;
                    case 2:
                        $szLine.='<button class="btnReject" id="'.$row['ap_id'].'" name="'.$row['ap_id'].'">Reject</button>';
                        break;
                    default:
                        $szLine.='<button class="btnReject" disabled id="'.$row['ap_id'].'" name="'.$row['ap_id'].'">Reject</button>';
                        break;
                }
                $szLine.='</td>';
                echo $szLine.='</tr>';
            };
?>
        </table> 
        </div>
        <div style="text-align:center;">
            <?php //print
                echo $res->pageNumbers();
                //echo $res->itemsPerPage(); ?>
        </div>
    </div>

<!-- local script functions -->
<script>
function Callback_Application_Accept(i1, i2) {
    alert(i1);
    document.location.reload();
}
function Callback_Application_Enroll(i1, i2) {
    alert(i1);
    document.location.reload();
}
function Callback_Application_Reject(i1, i2) {
    alert(i1);
    document.location.reload();
}


window.onload = function() {

    function clickAccept( uid, user_name ) {
        call_API('/Application_Accept/' + uid);
    }
    function clickEnroll( uid, user_name ) {
        call_API('/Application_Enroll/' + uid);
    }
    function clickReject( uid, user_name ) {
        call_API('/Application_Reject/' + uid);
    }

    var buttons = document.getElementsByClassName("btnAccept");
    for(var i=0; i<buttons.length; i++) {
        (function(n) {
            buttons[n].addEventListener('click',function(event) {
                clickAccept(buttons[n].id, buttons[n].name);
            });
        })(i);
    }    
    var buttons = document.getElementsByClassName("btnEnroll");
    for(var i=0; i<buttons.length; i++) {
        (function(n) {
            buttons[n].addEventListener('click',function(event) {
                clickEnroll(buttons[n].id, buttons[n].name);
            });
        })(i);
    }    
    var buttons = document.getElementsByClassName("btnReject");
    for(var i=0; i<buttons.length; i++) {
        (function(n) {
            buttons[n].addEventListener('click',function(event) {
                clickReject(buttons[n].id, buttons[n].name);
            });
        })(i);
    }    
};
</script>
<?php /////////////////////////////////////////////////////////

?>