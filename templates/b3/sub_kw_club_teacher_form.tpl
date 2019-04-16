<!--套用formValidator驗證機制-->
<form action="config.php" method="post" id="teacherForm" enctype="multipart/form-data" class="myForm form-horizontal" role="form">

    <!--類型標題-->
    <div class="form-group">
        <label class="col-sm-2 control-label">
            <{$smarty.const._MD_KWCLUB_TEACHER_TITLE}>
        </label>
        <div class="col-sm-10">
            <input type="text" name="teacher_title" id="teacher_title" class="form-control validate[required]" value="<{$teacher_title}>" placeholder="<{$smarty.const._MD_KWCLUB_TEACHER_TITLE}>">
        </div>
    </div>

    <!--類型說明-->
    <div class="form-group">
        <label class="col-sm-2 control-label">
            <{$smarty.const._MD_KWCLUB_TEACHER_DESCS}>
        </label>
        <div class="col-sm-10">
            <input type="text" name="teacher_desc" id="teacher_desc" class="form-control " value="<{$teacher_desc}>" placeholder="<{$smarty.const._MD_KWCLUB_TEACHER_DESCS}>">
        </div>
    
    </div>

    <!--狀態-->
    <div class="form-group">
        <label class="col-sm-2 control-label">
            <{$smarty.const._MD_KWCLUB_TEACHER_ENABLE}>
        </label>
        <div class="col-sm-10">

            <label class="radio-inline">
                <input type="radio" name="teacher_enable" id="teacher_enable_1" value="1" <{if $teacher_enable != "0"}>checked<{/if}>><{$smarty.const._YES}>
            </label>
            <label class="radio-inline">
                <input type="radio" name="teacher_enable" id="teacher_enable_0" value="0" <{if $teacher_enable == "0"}>checked<{/if}>><{$smarty.const._NO}>
            </label>
        </div>
    </div>

    <div class="text-center">

        <{$teacher_token}>

            <!--類型排序-->
            <input type="hidden" name="teacher_sort" value="<{$teacher_sort}>">
            <input type="hidden" name="type" value="teacher">
            <input type="hidden" name="op" value="<{$teacher_op}>">
            <input type="hidden" name="teacher_id" value="<{$teacher_id}>">
            <button type="submit" class="btn btn-primary"><{$smarty.const._TAD_SAVE}></button>
    </div>
</form>