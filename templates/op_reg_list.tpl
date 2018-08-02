<{$smarty.const._MD_KWCLUB_TODAY}><{$smarty.const._TAD_FOR}><{$today}> <{$title}>

<{if $arr_year}>
    <div class="alert alert-info" style="margin: 10px auto;"><{$smarty.const._MD_KWCLUB_SELECT_YEAR}>
        <select name="club_year" id="club_year" onChange="location.href='register.php?club_year=' + $('#club_year').val() + '&review=' + $('#review').val() ;">
            <!-- <option value=""><{$smarty.const._MD_KWCLUB_SELECT_YEAR}></option> -->
            <{foreach from=$arr_year key=year item=year_txt}>
                <option value="<{$year}>" <{if $club_year==$year}>selected<{/if}>><{$year_txt}></option>
            <{/foreach}>
        </select>
        <select name="review" id="review" onChange="location.href='register.php?club_year=' + $('#club_year').val() + '&review=' + $('#review').val() ;">
            <option value="reg_sn" <{if $review=='reg_sn'}>selected<{/if}>><{$smarty.const._MD_KWCLUB_SORTBY_REG_DATETIME}></option>
            <option value="class_id" <{if $review=='class_id'}>selected<{/if}>><{$smarty.const._MD_KWCLUB_SORTBY_CLASS_TITLE}></option>
            <option value="grade" <{if $review=='grade'}>selected<{/if}>><{$smarty.const._MD_KWCLUB_SORTBY_REG_GRADE}></option>
            <option value="reg_uid" <{if $review=='reg_uid'}>selected<{/if}>><{$smarty.const._MD_KWCLUB_SORTBY_REG_NAME}></option>
        </select>
    </div>
<{else}>
    <div class="alert alert-danger">
        <{$smarty.const._MD_KWCLUB_NEED_CONFIG}>
    </div>
<{/if}>


<div align="right">
    <a href="register.php?op=reg_uid&club_year=<{$club_year}>" class="btn btn-primary"><i class="fa fa-money" aria-hidden="true"></i>
        <{$smarty.const._MD_KWCLUB_PAY_MODE}></a>
    <a href="excel.php?club_year=<{$club_year}>&review=<{$review}>" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i>
        <{$smarty.const._MD_KWCLUB_EXPORT_EXCEL}></a>
</div>


<h3>
    <{if $club_year_text}><span class="club_year_text"><{$club_year_text}></span><{/if}><{$smarty.const._MD_KWCLUB_REGISTER_LIST}>
    <small><{$smarty.const._MD_KWCLUB_PAGEBAR_TOTAL|sprintf:$total}></small>
</h3>

<{includeq file="$xoops_rootpath/modules/kw_club/templates/sub_kw_club_reg_list_table.tpl"}>

<{$bar}>
