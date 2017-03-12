<?php
 //////////////////////////////////////////////////////////////////////////
    if(empty($display_contents))
        $display_contents = "";
    if(empty($display_title))
        $display_title = "";
    if(empty($button))
        $button = "Button";

    $myinfo = SessionManager::GetClientInfo();

    if(SessionManager::GetUserTypeCode() != 100)
        return;

?>
<!-- views ---------------------------------------------- -->
<div style="padding-top:10px;">
    <div class="box">
        <div style="padding-bottom: 20px;">
        <h5 style="float:right;">SI : <?=SessionManager::GetUuid();?></h5>
        <h1>My Program</h1><hr>
<?php 
            //require_once ('_server/models/DataResult_EnrollmentInfo.php');
            require_once ('_server/models/DataResult_EnrollmentList.php');
            $res = new DataResult_EnrollmentList('st_uid',SessionManager::GetUuid());
            if(count($res->data) > 0 ) {
                $row = $res->data[0];
                echo '<b>'.$row["p_name"].'</b><br>';
                require_once ('_server/models/DataResult_SubjectList.php');
                $subjects = (new DataResult_SubjectList($row["p_id"]))->data;
                echo '<lu>';
                    foreach($subjects as $key=>$row)
                        echo '<li>'.$row['s_title'].'</li>';
                echo '</lu>';
            }
            else {
                // not yet
                echo 'Not Enroled';
            }
?>
        </div>
        <h1>Time Table</h1><hr>
        <div style="padding-bottom: 20px;">
        <?php
        echo '<table class="TimeTable"><thead><tr><th>Time</th>';
        foreach($daysofweek as $key=>$val)
            echo '<th width="130" >'.$val.'</th>';
        $found_class = false;
        for($i=8;$i<20;$i++) {
            $html_tag = '<tr height="80"><td style="border: 1px solid black">'.$i.':00</td>';
            foreach($daysofweek as $key=>$val) {
                $td_tag = null;
                if(isset($subjects)) {
                    foreach($subjects as $key2=>$row) {
                        if( $key == $row['day'] && $row['hour'] > 0) {
                            if( $i == $row['hour'] ) {
                                $found_class = true;
                                $td_tag = '<td class="TimeActived">';
                                $td_tag .= '<h1>'.$row['time'].'</h1>'.$row['s_title'].'<br>';
                            }
                            else {

                                if( $i > $row['hour'] && ($i - floor($row['hour'] + ($row['term']+59)/60)) < 0) {
                                    $found_class = true;
                                    $td_tag = '<td class="TimeActived">';
                                    //echo '('.$i.')'.($i - floor($row['hour'] + ($row['term']+59)/60)).',';
                                }
                            }
                        }

                    }
                }
                if($td_tag == null)
                    $td_tag = '<td class="TimeRecord">';
                $td_tag .= '</td>';
                $html_tag .= $td_tag;
            }
            $html_tag .= '</tr>';
            if($found_class)
                echo $html_tag;
        }
        ?>
        </div>
    </div>
</div>