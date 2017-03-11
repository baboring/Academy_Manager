<?php
    //////////////////////////////////////////////////////////////////////////
    require_once ('_server/models/DataResult_UserTypes.php');
    $inp_guid = GUIDv4();
    
?>
    <div class="signup">
    <form action="<?=Navi::GetUrl(Navi::Join,'try_join');?>" method="post">
        <input type="hidden" name="uuid" value="<?=$inp_guid?>">
            <h1>Register</h1>
        <div class="box left_float">

            <fieldset>
                <legend>Type Information</legend>
                <label>Type : </label>
                <select id="memberType" name="type" style="width:160px">
                <?php 
                    foreach((new DataResult_UserTypes(PDO::FETCH_ASSOC, 99))->data as $key=>$value) {
                        echo '<option value="'.$value['m_code'].'">'.$value['m_display'].'</option>';
                    }; ?>
                </select><br>
                <div id="opt_1" class="hide" name="forStudent">         
                    <label>Token# : </label><input type="text" class= name="token"><br>
                </div>
                <div id="opt_2" class="hide" name="forProfessor">         
                    <label>token# : </label><input type="text" name="token"><br>
                </div>
                <div id="opt_3" class="hide" name="forStaff">         
                    <label>Secure# : </label><input type="text" name="secure"><br>
                </div>
            </fieldset>

            <fieldset>
                <legend>Member Information</legend>
                <label>User ID : </label><input type="text"  name="user_id"><br>
                <label>Password : </label><input type="password" id="password" name="password" value="<?=$inp_password?>"> <br>
                <label>Pwd Confirm : </label><input type="password" id="password_cfm" name="password_cfm" value="<?=$inp_password?>"> 
                <div class="hide" name="forProfessor">
                    <label>Business Name : </label><input type="text" name="businessName"><br></div>
                <label>First Name : </label><input type="text" name="first_name"><br>
                <label>Last Name : </label><input type="text" name="last_name"><br>
                <label>Tel Number : </label><input type="text" name="tel"><br>
                <label>Email : </label><input type="text" name="email"><br>
            </fieldset>

        <div style="text-align:center;">
            <button type="submit"> register</button> <br>
        </div> 
        <?php if(isset($error_msg)) echo "<h2>".$error_msg.'</h2>';?>
    </form>
    </div>

<!-- local script functions -->
<script>
function selectOne(curr) {
    for(i=1;i<=3;++i) {
        if( i == curr)
            show('opt_'+i);
        else
            hide('opt_'+i);
    }
}
// toggle between hiding and showing the dropdown content
function OnSelected(sel) {
    // using dictionary
    var lstTypes = {
        1:"forStudent",
        2:"forStaff",
        3:"forProfessor"
    };

    for(var val in lstTypes) {
            var divs = document.getElementsByName(lstTypes[val]);
        for(var i=0;i<divs.length;++i) {
            divs[i].style.display = (sel == val)? "block" : "none";
        }
    }
}

window.onload = function() {
    var myselect = document.getElementById("memberType");
    if(myselect) {
       OnSelected(myselect.selectedIndex + 1);
        myselect.addEventListener('change', function () {
            OnSelected(myselect.selectedIndex + 1);
        });
    }
    
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