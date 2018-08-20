<h2><{$smarty.const._MD_KWCLUB_CLUB_YEAR_LIST}></h2>
<{if $all_kw_club_info}>
    <{if $smarty.session.isclubAdmin}>
        <{$delete_kw_club_info_func}>
    <{/if}>

    <div id="kw_club_info_save_msg"></div>

    <div class="vtable" style="margin: 10px;">
        <ul class="vhead">
            <!--社團年度-->
            <li class="w2">
                <{$smarty.const._MD_KWCLUB_ENABLE}>
            </li>
            <!--報名起始日-->
            <li>
                <{$smarty.const._MD_KWCLUB_START_DATE}>
            </li>
            <!--報名終止日-->
            <li>
                <{$smarty.const._MD_KWCLUB_END_DATE}>
            </li>
            <!--報名方式-->
            <li class="w1">
                <{$smarty.const._MD_KWCLUB_ISFREE}>
            </li>
            <!--候補人數-->
            <li class="w1">
                <{$smarty.const._MD_KWCLUB_BACKUP_NUM}>
            </li>

            <{if $smarty.session.isclubAdmin}>
                <li class="w1"><{$smarty.const._TAD_FUNCTION}></li>
            <{/if}>
        </ul>

        <{foreach from=$all_kw_club_info item=data}>
            <ul id="tr_<{$data.club_id}>">

                <!--社團年度-->
                <li class="vcell"><{$smarty.const._MD_KWCLUB_YEAR}></li>
                <li class="vm w2">
                    <a href="config.php?op=update_enable&club_enable=<{if $data.club_enable==1}>0<{else}>1<{/if}>&club_id=<{$data.club_id}>" data-toggle="tooltip" data-placement="top" title="<{$smarty.const._MD_KWCLUB_CLICK_TO}><{if $data.club_enable==1}><{$smarty.const._MD_KWCLUB_ENABLE_0}><{else}><{$smarty.const._MD_KWCLUB_ENABLE_1}><{/if}>"><{$data.club_enable_pic}></a>
                    <span data-toggle="tooltip" data-placement="bottom" title="<{$data.club_year}>"><{$data.club_year_text}></span>
                </li>

                <!--報名起始日-->
                <li class="vcell"><{$smarty.const._MD_KWCLUB_START_DATE}></li>
                <li class="vm text-center">
                    <span style="color:rgb(190, 63, 4);"><{$data.club_start_date|date_format:"%Y/%m/%d %H:%M"}></span>
                </li>

                <!--報名終止日-->
                <li class="vcell"><{$smarty.const._MD_KWCLUB_END_DATE}></li>
                <li class="vm text-center">
                    <span style="color:rgb(190, 63, 4);"><{$data.club_end_date|date_format:"%Y/%m/%d %H:%M"}></span>
                </li>

                <!--報名方式-->
                <li class="vcell"><{$smarty.const._MD_KWCLUB_ISFREE}></li>
                <li class="vm w1 text-center">
                    <{$data.club_isfree_text}>
                </li>

                <!--候補人數-->
                <li class="vcell"><{$smarty.const._MD_KWCLUB_BACKUP_NUM}></li>
                <li class="vm w1 text-center ">
                    <{$data.club_backup_num}>
                </li>


                <{if $smarty.session.isclubAdmin}>
                    <li class="vcell"><{$smarty.const._TAD_FUNCTION}></li>
                    <li class="vm w1 text-center">
                        <a href="javascript:delete_kw_club_info_func(<{$data.club_id}>);" class="btn btn-xs btn-danger"><{$smarty.const._TAD_DEL}></a>
                        <a href="<{$xoops_url}>/modules/kw_club/config.php?op=kw_club_info_form&club_id=<{$data.club_id}>" class="btn btn-xs btn-warning"><{$smarty.const._TAD_EDIT}></a>
                    </li>
                <{/if}>
            </ul>
        <{/foreach}>
    </div>


    <{if $smarty.session.isclubAdmin}>
        <div class="text-right">
            <a href="<{$xoops_url}>/modules/kw_club/config.php?op=kw_club_info_form" class="btn btn-info"><{$smarty.const._MD_KWCLUB_ADD_CLUB_INFO}></a>
        </div>
    <{/if}>

    <{$bar}>
<{else}>
    <div class="jumbotron text-center">
        <{if $smarty.session.isclubAdmin}>
            <a href="<{$xoops_url}>/modules/kw_club/config.php?op=kw_club_info_form" class="btn btn-info"><{$smarty.const._MD_KWCLUB_ADD_CLUB_INFO}></a>
        <{else}>
            <h3><{$smarty.const._MD_KWCLUB_EMPTY_YEAR}></h3>
        <{/if}>
    </div>
<{/if}>
