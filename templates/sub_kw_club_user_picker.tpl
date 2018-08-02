<script type="text/javascript" src="<{$xoops_url}>/modules/kw_club/class/tmt_core.js"></script>
<script type="text/javascript" src="<{$xoops_url}>/modules/kw_club/class/tmt_spry_linkedselect.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#search_user').click(function () {
            search_user();
        });

        $('#keyman').change(function () {
            search_user();
        });
    });

    function search_user(){
        $.post("ajax.php", {op: "keyman" , keyman: $('#keyman').val()}, function(theResponse){
            $('#adm_repository').html(theResponse);
        });
    }

    function getOptions(destination , val_col){

        var values = [];
        var sel = document.getElementById(destination);
        for (var i=0, n=sel.options.length;i<n;i++) {
            if (sel.options[i].value) values.push(sel.options[i].value);
        }
        document.getElementById(val_col).value=values.join(',');
    }

</script>

<div class="row">
    <div class="col-sm-6 text-center">
        <h4><{$smarty.const._MD_KWCLUB_ALL_USERS}></h4>
    </div>
    <div class="col-sm-1"></div>
    <div class="col-sm-5 text-center">
        <h4><{$smarty.const._MD_KWCLUB_PICKED_USERS}></h4>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">

        <div class="input-group">
            <input type="text" name="keyman" id="keyman" placeholder="<{$smarty.const._MD_KWCLUB_SEARCH_KEY}>" class="form-control" onkeypress="if (event.keyCode == 13) {return false;}">
            <span class="input-group-btn">
            <button type="button" id="search_user" class="btn btn-success"><{$smarty.const._MD_KWCLUB_SEARCH}></button>
            </span>
        </div>

        <select name="adm_repository" id="adm_repository" size="8" multiple="multiple" tmt:linkedselect="true" class="form-control">
        <{$user_yet}>
        </select>
    </div>
    <div class="col-sm-1 text-center">
        <img src="<{$xoops_url}>/modules/kw_club/images/right.png" onclick="tmt.spry.linkedselect.util.moveOptions('adm_repository', 'adm_destination');getOptions('adm_destination','users_uid');"><br>
        <img src="<{$xoops_url}>/modules/kw_club/images/left.png" onclick="tmt.spry.linkedselect.util.moveOptions('adm_destination' , 'adm_repository');getOptions('adm_destination','users_uid');"><br><br>

        <img src="<{$xoops_url}>/modules/kw_club/images/up.png" onclick="tmt.spry.linkedselect.util.moveOptionUp('adm_destination');getOptions('adm_destination','users_uid');"><br>
        <img src="<{$xoops_url}>/modules/kw_club/images/down.png" onclick="tmt.spry.linkedselect.util.moveOptionDown('adm_destination');getOptions('adm_destination','users_uid');">
    </div>
    <div class="col-sm-5">
        <select id="adm_destination" size="10"" multiple="multiple" tmt:linkedselect="true" class="form-control">
        <{$user_ok}>
        </select>
    </div>
</div>

<input type="hidden" name="users_uid" id="users_uid" value="<{$users_uid}>">
