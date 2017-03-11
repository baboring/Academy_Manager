<?php
    //////////////////////////////////////////////////////////////////////////
    require_once ("_server/models/DataResult_MemberProfile.php");
    $userData = new DataResult_MemberProfile('uid',SessionManager::GetUuid());
    $userData = $userData->data;
    //var_dump($userData);
?>
        <div class="data_account">
        <form name="frmMember" action="<?=Navi::GetUrl(Navi::Member,'MyInfo');?>" onsubmit="return validateForm()" method="post">
            <input type="hidden" name="confirm" value="">
            <input type="hidden" name="uuid" value="<?=$userData['uid']?>">
            <input type="hidden" name="type" value="<?=$userData['type']?>">
            <h1>Member Profile</h1>
            <fieldset class="left_float">
                <legend>Account Information</legend>
                <label>User ID : </label><input type="hidden" name="user_id" value="<?=$userData['userid']?>"><?=$userData['userid']?><br>
                <label>Password(curr)</label><input type="text" id="password_cur" name="password_cur"><br>
                <label>Password(new) : </label><input type="password" id="password" name="password"> <br>
                <label>Password(confirm) : </label><input type="password" id="password_cfm" name="password_cfm"><br>
                <label>Reg Date : </label><span><?=$userData['reg_date']?></span><br>
            </fieldset>

            </div>
            <div class="center_row">
                <button type="submit"> Update</button> <br><br>
            </div>
        </form>
    </div>

<!-- local script functions -->
<script>

function validateForm() {
    var x = document.forms["frmMember"]["password"].value;
    if (x == null || x == "") {
        alert("Name must be filled out");
        return false;
    }
    document.forms["frmMember"]["confirm"].value = "1";
}
</script>

<?php /////////////////////////////////////////////////////////

?>