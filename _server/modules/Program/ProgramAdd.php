<?php
    //////////////////////////////////////////////////////////////////////////
    $inp_guid = GUIDv4();
    
?>
    <div>
    <form action="<?=Navi::GetUrl(Navi::Program,'try_insert');?>" method="post">
        <input type="hidden" name="uuid" value="<?=$inp_guid?>">
            <h1>New Program Information</h1>
        <div class="box left_float">
            <fieldset>
                <legend>Program Information</legend>
                <label>Program Name : </label><input type="text"  name="program_name" size="35"><br>
                <label>Program Memo : </label><input type="text"  name="program_memo" size="35"><br>
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