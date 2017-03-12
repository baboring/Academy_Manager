<?php
    //////////////////////////////////////////////////////////////////////////
    require_once ('_server/models/DataResult_ProgramList.php');
    if(empty($p_id))
        $p_id = '';
    
?>
    <form name="myForm" action="<?=Navi::GetUrl(Navi::Enrollment,'try_apply');?>" onsubmit="return validateForm(this)" method="post">
        <input type="hidden" name="student_id" value="<?=SessionManager::GetUuid();?>">
            <h1> Enrollment for Program</h1>
        <div class="box left_float">
            <fieldset>
                <legend>Application</legend>
                <h4>You have no program. If you want to learn a program, you should apply the program that you want. Please choice a program and apply it to us. </h4><br>

                <label>Program : </label>
                <select name="program_id" >
                <?php 
                    foreach((new DataResult_ProgramList())->data as $key=>$value) {
                        echo '<option value="'.$value['p_id'].'"';
                        echo ($p_id == $value['p_id'])? ' selected >': '>';
                        echo $value['p_name'].'</option>';
                    }; ?>
                </select><br>
                <label class="checkboxes" style="width:100%" for="terms"><input type="checkbox" id="terms" /><span>I Accept this terms and conditions.</span></label><br>
            </fieldset>

        <div style="text-align:center;">
            <button type="submit">Submit</button> <br>
        </div> 
    </form>

<!-- local script functions -->
<script>
function validateForm(form) {
    if (form.terms.checked == false) {
        alert("It must be checked the accept checkbox");
        form.terms.focus();
        return false;
    }
    return true;
}
</script>
