<h1><{$smarty.const._MD_KWCLUB}></h1>

<!-- 社團期別下拉選單 -->
<{if $arr_year}>
    <div class="alert alert-info" style="margin: 10px auto;"><{$smarty.const._MD_KWCLUB_SELECT_YEAR}>
        <select name="club_year" onChange="location.href='index.php?club_year='+this.value">
            <!-- <option value=""><{$smarty.const._MD_KWCLUB_SELECT_YEAR}></option> -->
            <{foreach from=$arr_year key=year item=year_txt}>
                <option value="<{$year}>" <{if $club_year==$year}>selected<{/if}>><{$year_txt}></option>
            <{/foreach}>
        </select>
    </div>
<{else}>
    <div class="alert alert-danger">
        <{$smarty.const._MD_KWCLUB_NEED_CONFIG}>
    </div>
<{/if}>


<{if $club_year}>
    <div class="row">
        <div class="col-sm-10">
            <h2>
                <span class="club_year_text"><{$club_year_text}></span><{$smarty.const._MD_KWCLUB_LIST}>
                <small><{$smarty.const._MD_KWCLUB_PAGEBAR_TOTAL|sprintf:$total}></small>
            </h2>
            <h4>
                <{$smarty.const._MD_KWCLUB_APPLY_DATE}><{$smarty.const._TAD_FOR}>
                <span style="color:rgb(190, 63, 4);"><{$club_info.club_start_date|date_format:"%Y/%m/%d %H:%M"}> ~ <{$club_info.club_end_date|date_format:"%Y/%m/%d %H:%M"}></span>
                <{if !$chk_time}>
                    <span class="label label-danger"><{$smarty.const._MD_KWCLUB_NON_REGISTRATION_TIME}></span>
                <{/if}>
            </h4>
        </div>
        <div class="col-sm-2" style="padding-top: 40px;">
            <{if $smarty.session.isclubAdmin || $smarty.session.isclubUser}>
                <a href="club.php" class="btn btn-primary btn-block" <{if !$can_operate}>data-toggle="tooltip" data-placement="bottom" title="<{$smarty.const._MD_KWCLUB_OVER_END_TIME}>" disabled<{/if}>><i class="fa fa-plus" aria-hidden="true"></i>
                    <{$smarty.const._MD_KWCLUB_ADD_CLUB}></a>
            <{/if}>

        </div>
    </div>

    <{if $all_class_content}>
        <table class="table table-bordered table-hover table-condensed">
            <thead>
                <tr class="success">
                    <!--社團編號-->
                    <th class="text-center">
                        <{$smarty.const._MD_KWCLUB_CLASS_NUM}>
                    </th>

                    <!--社團名稱-->
                    <th class="text-center">
                        <{$smarty.const._MD_KWCLUB_CLASS_TITLE}>
                    </th>

                    <!--上課日期-->
                    <th class="text-center">
                        <{$smarty.const._MD_KWCLUB_CLASS_DATE}>
                    </th>

                    <!--招收對象-->
                    <th class="text-center">
                        <{$smarty.const._MD_KWCLUB_CLASS_GRADE}>
                    </th>

                    <!--社團學費-->
                    <th nowrap class="text-center">
                        <{$smarty.const._MD_KWCLUB_CLASS_MONEY}>
                    </th>

                    <!--招收人數-->
                    <th nowrap class="text-center">
                        <{$smarty.const._MD_KWCLUB_NUMBER_OF_RECRUITED}>
                    </th>

                    <!--已報名人數-->
                    <th nowrap class="text-center">
                        <{$smarty.const._MD_KWCLUB_NUMBER_OF_APPLICANTS}>
                    </th>

                    <th class="text-center">
                        <{$smarty.const._TAD_FUNCTION}>
                    </th>
                </tr>
            </thead>
            <tbody id="kw_club_class_sort">
                <{foreach from=$all_class_content item=data}>
                    <tr id="tr_<{$data.class_id}>">
                        <td title="<{$data.class_id}>" class="text-center" <{if $data.class_note or $data.class_regnum >= $data.class_member}>rowspan="2"<{/if}>>
                            <!--社團編號-->
                            <{$data.class_num}>
                            <div>
                                <span class="label label-info"><{$data.cate_id}></span>
                            </div>
                        </td>

                        <!--社團名稱-->
                        <td>
                            <!--是否啟用-->
                            <{if !$can_operate and $data.class_ischecked==1}>
                                <span class="badge"><{$smarty.const._MD_KWCLUB_CLASS_ENABLE}></span>
                            <{elseif !$can_operate and $data.class_ischecked!=0}>
                                <span class="badge"><{$smarty.const._MD_KWCLUB_CLASS_UNABLE}></span>
                            <{else}>
                                <{$data.class_isopen}>
                            <{/if}>
                            <a href="index.php?class_id=<{$data.class_id}>"><{$data.class_title}></a>
                            <div style="font-size: 0.9em;">
                                <i class="fa fa-user-circle-o" aria-hidden="true" title="<{$smarty.const._MD_KWCLUB_TEACHER_ID}>"></i>
                                <a href="index.php?op=teacher#<{$data.teacher_id}>"><{$data.teacher_id_title}></a>
                                <i class="fa fa-map-marker" aria-hidden="true" title="<{$smarty.const._MD_KWCLUB_PLACE_ID}>"></i>
                                <{$data.place_id}>
                            </div>
                        </td>


                        <!--上課日-->
                        <td nowrap>
                            <span class="number_b">
                                <{$data.class_date_open|date_format:"%Y/%m/%d"}>
                            </span>
                            <{$smarty.const._MD_KWCLUB_APPLY_FROM_TO}>
                            <span class="number_b">
                                <{$data.class_date_close|date_format:"%Y/%m/%d"}>
                            </span>
                            <!--起始時間-->
                            <div>
                                <!--上課星期-->
                                <{if $data.class_week==_MD_KWCLUB_ALL_WEEK}>
                                    <{$smarty.const._MD_KWCLUB_1_5}>
                                <{else}>
                                    <{$smarty.const._MD_KWCLUB_W|sprintf:$data.class_week}>
                                <{/if}>
                                <span class="number_o">
                                    <{$data.class_time_start|date_format:"%H:%M"}>
                                </span>
                                <{$smarty.const._MD_KWCLUB_APPLY_FROM_TO}>
                                <span class="number_o">
                                    <{$data.class_time_end|date_format:"%H:%M"}>
                                </span>
                            </div>
                        </td>

                        <!--招收對象-->
                        <td>
                            <{$data.class_grade}>
                        </td>

                        <!--社團學費-->
                        <td nowrap class="text-center">
                            <span data-toggle="tooltip" data-placement="bottom" <{if $data.class_fee}>style="color: #ad168a;"  title="<{$smarty.const._MD_KWCLUB_CLASS_MONEY}> <{$data.class_money}> <{$smarty.const._MD_KWCLUB_DOLLAR}> + <{$smarty.const._MD_KWCLUB_CLASS_FEE}> <{$data.class_fee}> <{$smarty.const._MD_KWCLUB_DOLLAR}>"<{/if}>><{$data.class_money}><{if $data.class_fee}> (<{$data.class_fee}>) <{/if}><{$smarty.const._MD_KWCLUB_DOLLAR}></span>
                        </td>

                        <!--招收人數-->
                        <td class="text-center">
                            <{$data.class_member}>
                        </td>

                        <!--已報名人數-->
                        <td class="text-center">
                            <{if $data.class_regnum >= $data.class_member}>
                                <span class="circle" data-toggle="tooltip" data-placement="bottom" title="<{$smarty.const._MD_KWCLUB_NUMBER_OF_APPLICANTS}> <{$data.class_regnum}> <{$smarty.const._MD_KWCLUB_PEOPLE}>"><{$smarty.const._MD_KWCLUB_FULL}></span>
                            <{else}>
                                <{$data.class_regnum}>
                            <{/if}>
                        </td>

                        <td class="text-center">
                            <{if $smarty.session.isclubAdmin and !$can_operate}>
                                <{if $data.class_ischecked!=1}>
                                    <a href="club.php?op=class_enable&class_id=<{$data.class_id}>" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="bottom" title="<{$smarty.const._MD_KWCLUB_CLASS_ENABLE_DESC}>"><{$smarty.const._MD_KWCLUB_CLASS_ENABLE}></a>
                                <{else}>
                                    <a href="club.php?op=class_unable&class_id=<{$data.class_id}>" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="bottom" title="<{$smarty.const._MD_KWCLUB_CLASS_UNABLE_DESC}>"><{$smarty.const._MD_KWCLUB_CLASS_UNABLE}></a>
                                <{/if}>
                            <{/if}>

                            <{if $smarty.session.isclubAdmin || $uid == $data.class_uid}>
                                <a href="club.php?class_id=<{$data.class_id}>" class="btn btn-xs btn-warning" <{if !$can_operate}>data-toggle="tooltip" data-placement="bottom" title="<{$smarty.const._MD_KWCLUB_OVER_END_TIME}>" disabled<{/if}>><{$smarty.const._TAD_EDIT}></a>
                                <{if $data.class_regnum == 0}>
                                    <div>
                                        <a href="javascript:delete_class_func(<{$data.class_id}>);" class="btn btn-xs btn-danger" <{if !$can_operate}>data-toggle="tooltip" data-placement="bottom" title="<{$smarty.const._MD_KWCLUB_OVER_END_TIME}>" disabled<{/if}>><{$smarty.const._TAD_DEL}></a>
                                    </div>
                                <{/if}>
                            <{else}>
                                <{if $data.is_full}>
                                    <a href="#" class="btn btn-danger btn-xs disabled" data-toggle="tooltip" data-placement="bottom" title="<{$smarty.const._MD_KWCLUB_NUMBER_OF_APPLICANTS}> <{$data.class_regnum}> <{$smarty.const._MD_KWCLUB_PEOPLE}>"><i class="fa fa-user-plus" aria-hidden="true"></i>
                                        <{$smarty.const._MD_KWCLUB_FULL_REGISTRATION}></a>
                                <{elseif $data.class_regnum >= $data.class_member}>
                                    <a href="index.php?op=reg_form&class_id=<{$data.class_id}>&is_full=1" class="btn btn-warning btn-xs"><i class="fa fa-user-plus" aria-hidden="true"></i>
                                        <{$smarty.const._MD_KWCLUB_SIGNUP_TO_MAKE_UP}></a>
                                <{elseif $chk_time}>
                                    <a href="index.php?op=reg_form&class_id=<{$data.class_id}>" class="btn btn-primary btn-xs"><i class="fa fa-user-plus" aria-hidden="true"></i>
                                        <{$smarty.const._MD_KWCLUB_SIGNUP}></a>
                                <{else}>
                                    <a href="#" class="btn btn-danger btn-xs disabled"><i class="fa fa-user-plus" aria-hidden="true"></i>
                                        <{$smarty.const._MD_KWCLUB_NON_REGISTRATION_TIME}></a>
                                <{/if}>
                            <{/if}>
                        </td>
                    </tr>
                    <!--社團備註-->
                    <{if $data.class_note or $data.class_regnum >= $data.class_member}>
                        <tr>
                            <td colspan=11 style="font-size: 0.9em; color: rgb(151, 3, 107)">
                                <i class="fa fa-commenting" aria-hidden="true"></i>
                                <{$data.class_note}>
                                <{if $data.class_regnum >= $data.class_member}>
                                    <span style="color:red;"><{$smarty.const._MD_KWCLUB_AFTER_REGISTRATION}></span>
                                <{/if}>
                            </td>
                        </tr>
                    <{/if}>
                <{/foreach}>
            </tbody>
        </table>

        <{$bar}>
    <{else}>
        <div class="alert alert-warning">
            <{$smarty.const._MD_KWCLUB_EMPTY_CLUB}>
        </div>
    <{/if}>
<{/if}>
