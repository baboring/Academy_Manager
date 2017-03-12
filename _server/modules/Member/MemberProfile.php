<?php
    //////////////////////////////////////////////////////////////////////////
    require_once ("_server/models/DataResult_MemberProfile.php");
    $userData = new DataResult_MemberProfile('uid',SessionManager::GetUuid());
    $userData = $userData->data;
    //var_dump($userData);
?>
    <div class="box left_float">
        <div class="data_account">
        <form name="frmMember" action="<?=Navi::GetUrl(Navi::Profile,'try_update');?>" onsubmit="return validateForm()" method="post">
            <input type="hidden" name="confirm" value="">
            <input type="hidden" name="uuid" value="<?=$userData['uid']?>">
            <h1>Edit Profile</h1>
            <fieldset>
                <legend>Account Information</legend>
                <label>Reg Date : </label><p><?=$userData['reg_date']?></p><br>
                <label>Name : </label><input type="text" id="first_name" name="first_name" value="<?=$userData['first_name']?>"> &nbsp;
                                <input type="text" id="last_name" name="last_name" value="<?=$userData['last_name']?>" size="12"><br>
                <label>User ID : </label><p><?=$userData['userid']?></p> <br>
                <!--label>Password(curr):</label><input type="text" id="password_cur" name="password_cur"><br>
                <label>Password(new) : </label><input type="password" id="password" name="password"> <br-->
                <label>Password(confirm) : </label><input type="password" id="password_cfm" name="password_cfm"><br>
                <label>E-Mail : </label><input type="text" id="email" name="email" value="<?=$userData['email']?>"><br>
                <label>Phone : </label><input type="text" id="tel" name="tel" value="<?=$userData['tel']?>"><br>
                <label>Address : </label><input type="text" id="address" name="address" size="40" value="<?=$userData['address']?>" ><br>
            </fieldset>

            </div>
            <div class="center_row">
                <button type="submit"> Submit</button> <br><br>
            </div>
        </form>
    </div>
</div>

<!-- local script functions -->
<script>

function validateForm() {
    var x = document.forms["frmMember"]["password_cfm"].value;
    if (x == null || x == "") {
        alert("Password must be filled out");
        return false;
    }
    document.forms["frmMember"]["confirm"].value = "1";
}
</script>

<?php /////////////////////////////////////////////////////////

?>