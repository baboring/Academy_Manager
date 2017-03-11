<?php
 //////////////////////////////////////////////////////////////////////////
 if(empty($display_contents))
    $display_contents = "";
 if(empty($display_title))
    $display_title = "";
 if(empty($button))
    $button = "Button";

    $daysofweek[1] = 'Monday';
    $daysofweek[2] = 'Tuesday';
    $daysofweek[3] = 'Wednesday';
    $daysofweek[4] = 'Thursday';
    $daysofweek[5] = 'Friday';
    $daysofweek[6] = 'Saturday';

    $myinfo = SessionManager::GetClientInfo();

?>
<!-- views ---------------------------------------------- -->
<div>
    <aside class="sm-side">
        <div class="user-head">
            <div class="user-name">
                <h5><?=$myinfo['name'];?></h5>
                <span><?=$myinfo['email'];?></span>
            </div>
            <a class="mail-dropdown pull-right" href="javascript:;">
                <i class="fa fa-chevron-down"></i>
            </a>
        </div>
    </aside>

    <div class="box">
        <div style="padding-bottom: 30px;">
        <h1>My Program</h1><hr>
<?php 
            //require_once ('_server/models/DataResult_EnrollmentInfo.php');
            require_once ('_server/models/DataResult_EnrollmentList.php');
            $res = new DataResult_EnrollmentList('st_uid',SessionManager::GetUuid());
            if(count($res->data) > 0 ) {
                echo '<b>'.$res->data[0]["p_name"].'</b><br>';
                require_once ('_server/modules/Subject/SubjectHandler.php');
                $subjects = SubjectHandler::ReqData_SubjectList($res->data[0]["p_id"],null,null)->data;
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
        <div style="padding-bottom: 30px;">
        <?php
        echo '<table class="TimeTable"><thead><tr><th>Time</th>';
        foreach($daysofweek as $key=>$val)
            echo '<th width="130" >'.$val.'</th>';
        $found_class = false;
        for($i=8;$i<22;$i++) {
            $html_tag = '<tr height="80"><td style="border: 1px solid black">'.$i.':00</td>';
            foreach($daysofweek as $key=>$val) {
                $td_tag = null;
                if(isset($subjects)) {
                    foreach($subjects as $key2=>$row) {
                        if( $key == $row['day'] && $i == $row['hour'] ) {
                            $found_class = true;
                            $td_tag = '<td class="TimeActived">';
                            $td_tag .= '<h1>'.$row['time'].'</h1>'.$row['s_title'].'<br>';
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