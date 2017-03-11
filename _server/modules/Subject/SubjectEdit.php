<?php
    //////////////////////////////////////////////////////////////////////////
    require_once ('_server/models/DataResult_ProgramList.php');
    require_once ('_server/models/DataResult_ProfessorList.php');
    require_once ('_server/models/DataResult_SubjectInfo.php');

    $info = (new DataResult_SubjectInfo($c_id))->data;
    if(empty($info)) {
        echo 'no data';
        return;
    }
    $daysofweek[1] = 'Monday';
    $daysofweek[2] = 'Tuesday';
    $daysofweek[3] = 'Wednesday';
    $daysofweek[4] = 'Thursday';
    $daysofweek[5] = 'Friday';
    $daysofweek[6] = 'Saturday';
?>
    <div>
    <form action="<?=Navi::GetUrl(Navi::Subject,'try_update');?>" method="post">
        <input type="hidden" name="s_id" value="<?=$info['s_id'];?>">
            <h1> Edit Subject</h1>
        <div class="box left_float">
            <fieldset>
                <legend>Subject Information</legend>
                <label>Program: </label>
                <select name="program_id" >
                <?php 
                    foreach((new DataResult_ProgramList())->data as $key=>$value) {
                        $html_tag = '<option value="'.$value['p_id'].'" ';
                        $html_tag .= $info['s_program_id'] == $value['p_id'] ? ' selected >':'>';
                        $html_tag .= $value['p_name'].'</option>'."\n";
                        echo $html_tag;
                    }; ?>
                </select><br>
                
                <label>Subject Title : </label><input type="text"  name="subject_title" value="<?=$info['s_title']?>" size="35"><br>
                <label>Projessor: </label>
                <select name="professor_id" >
                <?php 
                    foreach((new DataResult_ProfessorList())->data as $key=>$value) {
                        $html_tag = '<option value="'.$value['fa_uid'].'" ';
                        $html_tag .= $info['s_professor_id'] == $value['fa_uid'] ? ' selected >':'>';
                        $html_tag .= $value['first name'].' '.$value['last name'].'</option>'."\n";
                        echo $html_tag;
                    }; ?>
                </select><br>
                <label>Day of week: </label>
                <select name="begin_dayofweek" >
                <?php 
                    foreach($daysofweek as $key=>$value) {
                        $html_tag = '<option value="'.$key.'" ';
                        $html_tag .= $info['s_begin_dayofweek'] == $key ? ' selected >':'>';
                        $html_tag .= $value.'</option>'."\n";
                        echo $html_tag;
                    }; ?>
                </select><br>
                <label>Begin Time : </label>
                <input type="text"  name="begin_time_hour" value="<?=$info['s_begin_time_hour'];?>" size="10"> : <input type="text"  name="begin_time_min" value="<?=$info['s_begin_time_min'];?>" size="10"> ex) 16:30<br>
                <label>Term Time : </label><input type="text"  name="take_minutes" value="<?=$info['s_take_minutes'];?>" size="10"> Min  ex) 60 Min<br>

            </fieldset>

        <div style="text-align:center;">
            <button type="submit">Submit</button> <br>
        </div> 
        <?php if(isset($error_msg)) echo "<h2>".$error_msg.'</h2>';?>
    </form>
    </div>

<!-- local script functions -->
<script>

window.onload = function() {
    var objBack = document.getElementById("back");
    if(objBack) {
        objBack.addEventListener('click', function () {
            document.location.href = "<?=Navi::GetUrl(Navi::Login);?>";
        });
    }

};
</script>

<?php /////////////////////////////////////////////////////////

?>