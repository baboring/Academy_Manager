        <div>
<?php 
            //require_once ('_server/models/DataResult_EnrollmentInfo.php');
            require_once ('_server/models/DataResult_EnrollmentList.php');
            $res = new DataResult_EnrollmentList('st_uid',SessionManager::GetUuid());
            if(count($res->data) > 0 ) {
                echo '<table width="99%">';
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
                        $firstLine.='<th width="100" align="center">Etc</th>'."\n";
                        echo $firstLine .='</thead>';
                        $firstLine = null;
                    }
                    $szLine.='<td>';
                    $szLine.='</td>';
                    echo $szLine.='</tr>';
                };
                echo '</table>'; 
            }
            else {
                // not yet
                require_once ('_server/modules/Enrollment/EnrollmentAdd.php');
            }
?>
        </div>

<?php /////////////////////////////////////////////////////////

?>