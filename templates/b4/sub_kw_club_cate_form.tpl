<!--套用formValidator驗證機制-->
<form action="config.php" method="post" id="cateForm" enctype="multipart/form-data" class="myForm form-horizontal" role="form">

    <!--類型標題-->
    <div class="form-group">
        <label class="col-sm-2 control-label">
            <{$smarty.const._MD_KWCLUB_CATE_TITLE}>
        </label>
        <div class="col-sm-10">
            <input type="text" name="cate_title" id="cate_title" class="form-control validate[required]" value="<{$cate_title}>" placeholder="<{$smarty.const._MD_KWCLUB_CATE_TITLE}>">
        </div>
    </div>

    <!--類型說明-->
    <div class="form-group">
        <label class="col-sm-2 control-label">
            <{$smarty.const._MD_KWCLUB_CATE_DESC}>
        </label>
        <div class="col-sm-10">
            <input type="text" name="cate_desc" id="cate_desc" class="form-control " value="<{$cate_desc}>" placeholder="<{$smarty.const._MD_KWCLUB_CATE_DESC}>">
        </div>
    </div>



    <!--狀態-->
    <div class="form-group">
        <label class="col-sm-2 control-label">
            <{$smarty.const._MD_KWCLUB_CATE_ENABLE}>
        </label>
        <div class="col-sm-10">
            
            <label class="radio-inline">
                <input type="radio" name="cate_enable" id="cate_enable_1" value="1" <{if $cate_enable != "0"}>checked="checked"<{/if}>><{$smarty.const._YES}>
            </label>
            <label class="radio-inline">
                <input type="radio" name="cate_enable" id="cate_enable_0" value="0" <{if $cate_enable == "0"}>checked="checked"<{/if}>><{$smarty.const._NO}>
            </label>
        </div>
    </div>

    <div class="text-center">
        
        <{$cate_token}>

    <!--類型排序-->
        <input type="hidden" name="cate_sort"  value="<{$cate_sort}>" >
        <input type="hidden" name="type" value="cate">
        <input type="hidden" name="op" value="<{$cate_op}>">
        <input type="hidden" name="cate_id" value="<{$cate_id}>">
        <button type="submit" class="btn btn-primary"><{$smarty.const._TAD_SAVE}></button>
    </div>
</form>
