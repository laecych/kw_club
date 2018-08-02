<h2><{$smarty.const._MD_KWCLUB_CLUB_YEAR_LIST}></h2>
<{if $all_kw_club_info}>
    <{if $smarty.session.isclubAdmin}>
        <{$delete_kw_club_info_func}>
    <{/if}>

    <div id="kw_club_info_save_msg"></div>

    <table class="table table-striped table-hover">
        <thead>
            <tr class="success">
                <!--社團年度-->
                <th>
                    <{$smarty.const._MD_KWCLUB_YEAR}>
                </th>
                <!--報名起始日-->
                <th>
                    <{$smarty.const._MD_KWCLUB_START_DATE}>
                </th>
                <!--報名終止日-->
                <th>
                    <{$smarty.const._MD_KWCLUB_END_DATE}>
                </th>
                <!--報名方式-->
                <th>
                    <{$smarty.const._MD_KWCLUB_ISFREE}>
                </th>
                <!--候補人數-->
                <th>
                    <{$smarty.const._MD_KWCLUB_BACKUP_NUM}>
                </th>

                <!--是否啟用-->
                <th>
                    <{$smarty.const._MD_KWCLUB_ENABLE}>
                </th>
                <{if $smarty.session.isclubAdmin}>
                    <th><{$smarty.const._TAD_FUNCTION}></th>
                <{/if}>
            </tr>
        </thead>

        <tbody id="kw_club_info_sort">
            <{foreach from=$all_kw_club_info item=data}>
                <tr id="tr_<{$data.club_id}>">

                    <!--社團年度-->
                    <td>
                        <{$data.club_year}>
                    </td>

                    <!--報名起始日-->
                    <td>
                        <{$data.club_start_date}>
                    </td>

                    <!--報名終止日-->
                    <td>
                        <{$data.club_end_date}>
                    </td>

                    <!--報名方式-->
                    <td>
                        <{$data.club_isfree_text}>
                    </td>

                    <!--候補人數-->
                    <td>
                        <{$data.club_backup_num}>
                    </td>


                    <!--是否啟用-->
                    <td>
                        <{$data.club_enable_pic}>
                    </td>

                    <{if $smarty.session.isclubAdmin}>
                        <td>
                            <a href="javascript:delete_kw_club_info_func(<{$data.club_id}>);" class="btn btn-xs btn-danger"><{$smarty.const._TAD_DEL}></a>
                            <a href="<{$xoops_url}>/modules/kw_club/config.php?op=kw_club_info_form&club_id=<{$data.club_id}>" class="btn btn-xs btn-warning"><{$smarty.const._TAD_EDIT}></a>
                        </td>
                    <{/if}>
                </tr>
            <{/foreach}>
        </tbody>
    </table>


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
