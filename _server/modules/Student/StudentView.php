<?php
    require_once ('_server/modules/Student/StudentHandler.php');
    $search_key = GetSafeValueGet('search_key','');
    $search_val = GetSafeValueGet('search_val','');
    
?>
        <div style="height:300px;">
        <table width="99%">
            <?php 
            $res = StudentHandler::ReqData_StudentList($search_key,$search_val);
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
                $szLine.='<button class="btnSelect" id="'.$row['st_uid'].'">Select</button>';
                $szLine.='</td>';
                echo $szLine.='</tr>';
            }; ?>
        </table> </div>
        <div style="text-align:center;">
            <?php //print
                echo $res->pageNumbers();
                //echo $res->itemsPerPage(); ?>
        </div>
    </div>

<!-- local script functions -->
<script>

window.onload = function() {
    
};
</script>
<?php /////////////////////////////////////////////////////////

?>