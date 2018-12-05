<h2><{$smarty.const._MD_KWCLUB_SETUP_TEACHER}></h2>
<form action="config.php" method="post" id="teacherForm" enctype="multipart/form-data" class="myForm form-horizontal" role="form">
    <div class="form-group">
        <label class="sr-only control-label">
            <{$smarty.const._MD_KWCLUB_SETUP_TEACHER}>
        </label>
        <div class="col-sm-12">
            <{includeq file="$xoops_rootpath/modules/kw_club/templates/sub_kw_club_user_picker.tpl"}>
        </div>
    </div>
    <div class="text-center">
        
        <{$teacher_token}>

        <input type="hidden" name="op" value="save_club_teacher">
        <button type="submit" class="btn btn-primary"><{$smarty.const._TAD_SAVE}></button>
    </div>
</form>