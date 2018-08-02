<h2><{$smarty.const._MA_KWCLUB_SETUP_ADMIN}></h2>
<form action="main.php" method="post" id="adminForm" enctype="multipart/form-data" class="myForm form-horizontal" role="form">
    <div class="form-group">
        <label class="sr-only control-label">
            <{$smarty.const._MA_KWCLUB_SETUP_ADMIN}>
        </label>
        <div class="col-sm-12">
            <{includeq file="$xoops_rootpath/modules/kw_club/templates/sub_kw_club_user_picker.tpl"}>
        </div>
    </div>
    <div class="text-center">
        
        <{$admin_token}>

        <input type="hidden" name="op" value="save_club_admin">
        <button type="submit" class="btn btn-primary"><{$smarty.const._TAD_SAVE}></button>
    </div>
</form>