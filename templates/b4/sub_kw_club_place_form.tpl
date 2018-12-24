<!--套用formValidator驗證機制-->
<form action="config.php" method="post" id="placeForm" enctype="multipart/form-data" class="myForm " role="form">

    <!--類型標題-->
    <div class="form-group row">
        <label class="col-sm-2 col-form-label text-sm-right">
            <{$smarty.const._MD_KWCLUB_PLACE_TITLE}>
        </label>
        <div class="col-sm-10">
            <input type="text" name="place_title" id="place_title" class="form-control validate[required]" value="<{$place_title}>" placeholder="<{$smarty.const._MD_KWCLUB_PLACE_TITLE}>">
        </div>
    </div>

    <!--類型說明-->
    <div class="form-group row">
        <label class="col-sm-2 col-form-label text-sm-right">
            <{$smarty.const._MD_KWCLUB_PLACE_DESC}>
        </label>
        <div class="col-sm-10">
            <input type="text" name="place_desc" id="place_desc" class="form-control " value="<{$place_desc}>" placeholder="<{$smarty.const._MD_KWCLUB_PLACE_DESC}>">
        </div>
    </div>

    <!--狀態-->
    <div class="form-group row">
        <label class="col-sm-2 col-form-label text-sm-right">
            <{$smarty.const._MD_KWCLUB_PLACE_ENABLE}>
        </label>
        <div class="col-sm-10">
            <div class="form-check form-check-inline">           
                <input type="radio" name="place_enable" id="place_enable_1" value="1" <{if $place_enable != "0"}>checked="checked"<{/if}>> <label class="form-check-label" for="place_enable_1"><{$smarty.const._YES}></label>
                <input type="radio" name="place_enable" id="place_enable_0" value="0" <{if $place_enable == "0"}>checked="checked"<{/if}>><label class="form-check-label" for="place_enable_0"><{$smarty.const._NO}></label>
           </div>
        </div>
    </div>

    <div class="text-center">      

        <{$place_token}>

        <!--類型排序-->
        <input type="hidden" name="place_sort"  value="<{$place_sort}>" >
        <input type="hidden" name="type" value="place">
        <input type="hidden" name="op" value="<{$place_op}>">
        <input type="hidden" name="place_id" value="<{$place_id}>">
        <button type="submit" class="btn btn-primary"><{$smarty.const._TAD_SAVE}></button>
    </div>
</form>
