<link href="<{$xoops_url}>/modules/tadtools/css/vtable.css" media="all" rel="stylesheet">
<link href="<{$xoops_url}>/modules/kw_club/assets/css/module.css" media="all" rel="stylesheet">

<{if $block.club_year}>
    <div class="row">
        <div class="col-sm-10">
            <h2>
                <span class="club_year_text"><{$block.club_year_text}></span><{$smarty.const._MB_KWCLUB_LIST}>
                <small><{$smarty.const._MB_KWCLUB_PAGEBAR_TOTAL|sprintf:$block.total}></small>
            </h2>
            <h4>
                <{$smarty.const._MB_KWCLUB_APPLY_DATE}><{$smarty.const._TAD_FOR}>
                <span style="color:rgb(190, 63, 4);"><{$block.club_info.club_start_date|date_format:"%Y/%m/%d %H:%M"}> ~ <{$block.club_info.club_end_date|date_format:"%Y/%m/%d %H:%M"}></span>
                <{if !$block.chk_time}>
                    <span class="badge badge-danger"><{$smarty.const._MB_KWCLUB_NON_REGISTRATION_TIME}></span>
                <{/if}>
            </h4>
        </div>
        <div class="col-sm-2" style="padding-top: 40px;">
            <{if $smarty.session.isclubAdmin || $smarty.session.isclubUser}>
                <a href="<{$xoops_url}>/modules/kw_club/club.php?club_year=<{$block.club_year}>" class="btn btn-primary btn-block" <{if !$block.can_operate}>data-toggle="tooltip" data-placement="bottom" title="<{$smarty.const._MB_KWCLUB_OVER_END_TIME}>" disabled<{/if}>><i class="fa fa-plus" aria-hidden="true"></i>
                    <{$smarty.const._MB_KWCLUB_ADD_CLUB}></a>
            <{/if}>

        </div>
    </div>

    <{if $block.all_class_content}>
        <div class="vtable" style="margin: 10px auto 30px;">
            <ul class="vhead">
                <!--社團名稱-->
                <li class="w2 text-center">
                    <{$smarty.const._MB_KWCLUB_CLASS_TITLE}>
                </li>

                <!--上課日期-->
                <li class="w2 text-center">
                    <{$smarty.const._MB_KWCLUB_CLASS_DATE}>
                </li>

                <!--招收對象-->
                <li class="w1 text-center">
                    <{$smarty.const._MB_KWCLUB_CLASS_GRADE}>
                </li>

                <!--社團學費-->
                <li class="w1 text-center">
                    <{$smarty.const._MB_KWCLUB_CLASS_MONEY}>
                </li>

                <!--已報名人數-->
                <li class="w1 text-center">
                    <{$smarty.const._MB_KWCLUB_NUMBER_OF_APPLICANTS}> /
                    <{$smarty.const._MB_KWCLUB_NUMBER_OF_RECRUITED}>
                </li>

                <li class="w1 text-center">
                    <{$smarty.const._TAD_FUNCTION}>
                </li>
            </ul>

            <{foreach from=$block.all_class_content item=data}>
                <ul id="tr_<{$block.data.class_id}>">

                    <!--社團名稱-->
                    <li class="vcell"><{$smarty.const._MB_KWCLUB_CLASS_TITLE}></li>
                    <li class="vm w2">
                        <!--社團編號-->
                        <span class="badge alert-info"><{$data.class_num}></span>

                        <{if $smarty.session.isclubAdmin}>
                            <{$data.class_isopen}>
                        <{/if}>
                        <a href="<{$xoops_url}>/modules/kw_club/index.php?class_id=<{$data.class_id}>"><{$data.class_title}></a>
                        <div style="font-size: 0.9em;">
                            <span class="badge badge-info"><{$data.cate_id}></span>
                            <i class="fa fa-user-circle-o" aria-hidden="true" title="<{$smarty.const._MB_KWCLUB_TEACHER_ID}>"></i>
                            <a href="<{$xoops_url}>/modules/kw_club/index.php?op=teacher#<{$data.teacher_id}>"><{$data.teacher_id_title}></a>
                            <i class="fa fa-map-marker" aria-hidden="true" title="<{$smarty.const._MB_KWCLUB_PLACE_ID}>"></i>
                            <{$data.place_id}>
                        </div>

                        <!--社團備註-->
                        <{if $data.class_note or ($data.class_regnum >= $data.class_member and !$data.is_full)}>
                            <div style="font-size: 0.9em; color: rgb(151, 3, 107);">
                                <i class="fa fa-commenting" aria-hidden="true"></i>
                                <{$data.class_note}>
                                <{if $data.class_regnum >= $data.class_member and !$data.is_full}>
                                    <span style="color:red;"><{$smarty.const._MB_KWCLUB_AFTER_REGISTRATION}></span>
                                <{/if}>
                            </div>
                        <{/if}>
                    </li>


                    <!--上課日-->
                    <li class="vm w2">
                        <span class="number_b">
                            <{$data.class_date_open|date_format:"%Y/%m/%d"}>
                        </span>
                        <{$smarty.const._MB_KWCLUB_APPLY_FROM_TO}>
                        <span class="number_b">
                            <{$data.class_date_close|date_format:"%Y/%m/%d"}>
                        </span>
                        <!--起始時間-->
                        <div>
                            <!--上課星期-->
                            <{if $data.class_week==_MD_KWCLUB_ALL_WEEK}>
                                <{$smarty.const._MB_KWCLUB_1_5}>
                            <{else}>
                                <{$smarty.const._MB_KWCLUB_W|sprintf:$data.class_week}>
                            <{/if}>
                            <span class="number_o">
                                <{$data.class_time_start|date_format:"%H:%M"}>
                            </span>
                            <{$smarty.const._MB_KWCLUB_APPLY_FROM_TO}>
                            <span class="number_o">
                                <{$data.class_time_end|date_format:"%H:%M"}>
                            </span>
                        </div>
                    </li>

                    <!--招收對象-->
                    <li class="vm w1">
                        <{$data.class_grade}>
                    </li>

                    <!--社團學費-->
                    <li class="vm w1 text-center">
                        <span data-toggle="tooltip" data-placement="bottom" <{if $data.class_fee}>style="color: #ad168a;"  title="<{$smarty.const._MB_KWCLUB_CLASS_MONEY}> <{$data.class_money}> <{$smarty.const._MB_KWCLUB_DOLLAR}> + <{$smarty.const._MB_KWCLUB_CLASS_FEE}> <{$data.class_fee}> <{$smarty.const._MB_KWCLUB_DOLLAR}>"<{/if}>><{$data.class_money}><{if $data.class_fee}> (<{$data.class_fee}>) <{/if}><{$smarty.const._MB_KWCLUB_DOLLAR}></span>
                    </li>

                    <!--已報名人數-->
                    <li class="vm w1 text-center">
                        <{if $data.class_regnum >= $data.class_member}>
                            <span class="circle" data-toggle="tooltip" data-placement="bottom" title="<{$smarty.const._MB_KWCLUB_NUMBER_OF_APPLICANTS}> <{$data.class_regnum}> <{$smarty.const._MB_KWCLUB_PEOPLE}>"><{$smarty.const._MB_KWCLUB_FULL}></span>
                        <{else}>
                            <{$data.class_regnum}> /
                            <{$data.class_member}>
                        <{/if}>
                        
                        <!--是否開班-->
                        <{if $data.class_ischecked==''}>
                        <{elseif $data.class_ischecked==1}>
                            <div>
                                <span class="badge alert-success"><{$smarty.const._MB_KWCLUB_CLASS_ENABLE}></span>
                            </div>
                        <{elseif $data.class_ischecked==0}>
                            <div>
                                <span class="badge alert-danger"><{$smarty.const._MB_KWCLUB_CLASS_UNABLE}></span>
                            </div>
                        <{/if}>
                    </li>

                    <li class="vm w1 text-center">
                        <{if $smarty.session.isclubAdmin}>
                            <{if $data.class_ischecked!=1}>
                                <a href="<{$xoops_url}>/modules/kw_club/club.php?op=class_enable&class_id=<{$data.class_id}>" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="<{$smarty.const._MB_KWCLUB_CLASS_ENABLE_DESC}>"><{$smarty.const._MB_KWCLUB_CLASS_ENABLE}></a>
                            <{else}>
                                <a href="<{$xoops_url}>/modules/kw_club/club.php?op=class_unable&class_id=<{$data.class_id}>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="<{$smarty.const._MB_KWCLUB_CLASS_UNABLE_DESC}>"><{$smarty.const._MB_KWCLUB_CLASS_UNABLE}></a>
                            <{/if}>
                            <a href="<{$xoops_url}>/modules/kw_club/club.php?op=class_blank&class_id=<{$data.class_id}>" class="btn btn-sm btn-secondary" data-toggle="tooltip" data-placement="bottom" title="<{$smarty.const._MB_KWCLUB_CLASS_BLANK_DESC}>"><{$smarty.const._MB_KWCLUB_CLASS_BLANK}></a>
                        <{/if}>

                        <{if $smarty.session.isclubAdmin || $block.uid == $data.class_uid}>
                            <a href="<{$xoops_url}>/modules/kw_club/club.php?class_id=<{$data.class_id}>" class="btn btn-sm btn-warning" <{if !$block.can_operate}>data-toggle="tooltip" data-placement="bottom" title="<{$smarty.const._MB_KWCLUB_OVER_END_TIME}>" disabled<{/if}>><{$smarty.const._TAD_EDIT}></a>
                            <{if $data.class_regnum == 0}>
                                <a href="javascript:delete_class_func(<{$data.class_id}>);" class="btn btn-sm btn-danger" <{if !$block.can_operate}>data-toggle="tooltip" data-placement="bottom" title="<{$smarty.const._MB_KWCLUB_OVER_END_TIME}>" disabled<{/if}>><{$smarty.const._TAD_DEL}></a>
                            <{/if}>
                        <{else}>
                            <{if $data.is_full}>
                                <a href="#" class="btn btn-danger btn-sm disabled" data-toggle="tooltip" data-placement="bottom" title="<{$smarty.const._MB_KWCLUB_NUMBER_OF_APPLICANTS}> <{$data.class_regnum}> <{$smarty.const._MB_KWCLUB_PEOPLE}>"><i class="fa fa-user-plus" aria-hidden="true"></i>
                                    <{$smarty.const._MB_KWCLUB_FULL_REGISTRATION}></a>
                            <{elseif $data.class_regnum >= $data.class_member}>
                                <a href="<{$xoops_url}>/modules/kw_club/index.php?op=reg_form&class_id=<{$data.class_id}>&is_full=1" class="btn btn-warning btn-sm"><i class="fa fa-user-plus" aria-hidden="true"></i>
                                    <{$smarty.const._MB_KWCLUB_SIGNUP_TO_MAKE_UP}></a>
                            <{elseif $block.chk_time}>
                                <a href="<{$xoops_url}>/modules/kw_club/index.php?op=reg_form&class_id=<{$data.class_id}>" class="btn btn-primary btn-sm"><i class="fa fa-user-plus" aria-hidden="true"></i>
                                    <{$smarty.const._MB_KWCLUB_SIGNUP}></a>
                            <{else}>
                                <a href="#" class="btn btn-danger btn-sm disabled"><i class="fa fa-user-plus" aria-hidden="true"></i>
                                    <{$smarty.const._MB_KWCLUB_NON_REGISTRATION_TIME}></a>
                            <{/if}>
                        <{/if}>
                    </li>
                </ul>
            <{/foreach}>
        </div>

    <{else}>
        <div class="alert alert-warning">
            <{$smarty.const._MB_KWCLUB_EMPTY_CLUB}>
        </div>
    <{/if}>
<{/if}>
