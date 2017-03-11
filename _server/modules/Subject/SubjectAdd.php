<?php
    //////////////////////////////////////////////////////////////////////////
    require_once ('_server/models/DataResult_ProgramList.php');
    require_once ('_server/models/DataResult_ProfessorList.php');
    $inp_guid = GUIDv4();
    
?>
    <div>
    <form action="<?=Navi::GetUrl(Navi::Subject,'try_insert');?>" method="post">
        <input type="hidden" name="uuid" value="<?=$inp_guid?>">
            <h1> Register Subject</h1>
        <div class="box left_float">
            <fieldset>
                <legend>Subject Information</legend>
                <label>Program: </label>
                <select name="program_id" >
                <?php 
                    foreach((new DataResult_ProgramList())->data as $key=>$value) {
                        echo '<option value="'.$value['p_id'].'">'.$value['p_name'].'</option>';
                    }; ?>
                </select><br>
                
                <label>Subject Title : </label><input type="text"  name="subject_title" size="35"><br>
                <label>Projessor: </label>
                <select name="professor_id" >
                <?php 
                    foreach((new DataResult_ProfessorList())->data as $key=>$value) {
                        echo '<option value="'.$value['fa_uid'].'">'.$value['first name'].' '.$value['last name'].'</option>';
                    }; ?>
                </select><br>

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