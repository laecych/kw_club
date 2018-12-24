<div class="row">
        <div class="col-sm-10">
            <h1><{$smarty.const._MD_KWCLUB}></h1>
        </div>
        <div class="col-sm-1" style="padding-top: 40px;">
           <{if $language=="english"}>
            <a href="index.php?language=tchinese_utf8" class="btn btn-primary btn-block" ><i class="fa fa-plus" aria-hidden="true"></i>
            <{else}>
            <a href="index.php?language=english" class="btn btn-primary btn-block" ><i class="fa fa-plus" aria-hidden="true"></i>
            <{/if}>    
               <{$smarty.const._MD_KWCLUB_LANGUAGE}></a>
        </div>   
</div> 

<!-- 社團期別下拉選單 -->
<{if $arr_year}>
    <div class="alert alert-info" style="margin: 10px auto;"><{$smarty.const._MD_KWCLUB_SELECT_YEAR}>
        <select name="club_year" onChange="location.href='index.php?club_year='+this.value">
            <!-- <option value=""><{$smarty.const._MD_KWCLUB_SELECT_YEAR}></option> -->
            <{foreach from=$arr_year item=year}>
                <option value="<{$year}>" <{if $club_year==$year}>selected<{/if}>><{$year}></option>
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
                <span class="club_year_text"><{$club_year}></span><{$smarty.const._MD_KWCLUB_LIST}>
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
                <a href="club.php?club_year=<{$club_year}>" class="btn btn-primary btn-block" <{if !$can_operate}>data-toggle="tooltip" data-placement="bottom" title="<{$smarty.const._MD_KWCLUB_OVER_END_TIME}>" disabled<{/if}>><i class="fa fa-plus" aria-hidden="true"></i>
                    <{$smarty.const._MD_KWCLUB_ADD_CLUB}></a>
            <{/if}>
        </div>
    </div>

    <{if $all_class_content}>
        <div class="vtable" style="margin: 10px auto 30px;">
            <ul class="vhead">
                <!--社團名稱-->
                <li class="w2 text-center">
                    <{$smarty.const._MD_KWCLUB_CLASS_TITLE}>
                </li>

                <!--上課日期-->
                <li class="w2 text-center">
                    <{$smarty.const._MD_KWCLUB_CLASS_DATE}>
                </li>

                <!--招收對象-->
                <li class="w1 text-center">
                    <{$smarty.const._MD_KWCLUB_CLASS_GRADE}>
                </li>

                <!--社團學費-->
                <li class="w1 text-center">
                    <{$smarty.const._MD_KWCLUB_CLASS_MONEY}>
                </li>

                <!--已報名人數-->
                <li class="w1 text-center">
                    <{$smarty.const._MD_KWCLUB_NUMBER_OF_APPLICANTS}> /
                    <{$smarty.const._MD_KWCLUB_NUMBER_OF_RECRUITED}>
                </li>

                <li class="w1 text-center">
                    <{$smarty.const._TAD_FUNCTION}>
                </li>
            </ul>

            <{foreach from=$all_class_content item=data}>
                <ul id="tr_<{$data.class_id}>">

                    <!--社團名稱-->
                    <li class="vcell"><{$smarty.const._MD_KWCLUB_CLASS_TITLE}></li>
                    <li class="vm w2">
                        <!--社團編號-->
                        <span class="badge alert-info"><{$data.class_num}></span>

                        <{if $smarty.session.isclubAdmin}>
                            <a href="index.php?op=update_enable&class_enable=<{if $data.class_isopen==1}>0<{else}>1<{/if}>&class_id=<{$data.class_id}>" data-toggle="tooltip" data-placement="top" title="<{$smarty.const._MD_KWCLUB_CLICK_TO}><{if $data.class_isopen==1}><{$smarty.const._MD_KWCLUB_ENABLE_0}><{else}><{$smarty.const._MD_KWCLUB_ENABLE_1}><{/if}>">
                                <{$data.class_isopen_pic}>
                            </a>
                        <{/if}>
                        <a href="index.php?class_id=<{$data.class_id}>"><{$data.class_title}></a>
                        <div style="font-size: 0.9em;">
                            <span class="label label-info"><{$data.cate_id}></span>
                            <i class="fa fa-user-circle-o" aria-hidden="true" title="<{$smarty.const._MD_KWCLUB_TEACHER_ID}>"></i>
                            <a href="index.php?op=teacher#<{$data.teacher_id}>"><{$data.teacher_id_title}></a>
                            <i class="fa fa-map-marker" aria-hidden="true" title="<{$smarty.const._MD_KWCLUB_PLACE_ID}>"></i>
                            <{$data.place_id}>
                        </div>

                        <!--社團備註-->
                        <{if $data.class_note or ($data.class_regnum >= $data.class_member and !$data.is_full)}>
                            <div style="font-size: 0.9em; color: rgb(151, 3, 107);">
                                <i class="fa fa-commenting" aria-hidden="true"></i>
                                <{$data.class_note}>
                                <{if $data.class_regnum >= $data.class_member and !$data.is_full}>
                                    <span style="color:red;"><{$smarty.const._MD_KWCLUB_AFTER_REGISTRATION}></span>
                                <{/if}>
                            </div>
                        <{/if}>
                    </li>


                    <!--上課日-->
                    <li class="vm w2">
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
                    </li>

                    <!--招收對象-->
                    <li class="vm w1">
                        <{$data.class_grade}>
                    </li>

                    <!--社團學費-->
                    <li class="vm w1 text-center">
                        <span data-toggle="tooltip" data-placement="bottom" <{if $data.class_fee}>style="color: #ad168a;"  title="<{$smarty.const._MD_KWCLUB_CLASS_MONEY}> <{$data.class_money}> <{$smarty.const._MD_KWCLUB_DOLLAR}> + <{$smarty.const._MD_KWCLUB_CLASS_FEE}> <{$data.class_fee}> <{$smarty.const._MD_KWCLUB_DOLLAR}>"<{/if}>><{$data.class_money}><{if $data.class_fee}> (<{$data.class_fee}>) <{/if}><{$smarty.const._MD_KWCLUB_DOLLAR}></span>
                    </li>

                    <!--已報名人數-->
                    <li class="vm w1 text-center">
                        <{if $data.class_regnum >= $data.class_member}>
                            <span class="circle" data-toggle="tooltip" data-placement="bottom" title="<{$smarty.const._MD_KWCLUB_NUMBER_OF_APPLICANTS}> <{$data.class_regnum}> <{$smarty.const._MD_KWCLUB_PEOPLE}>"><{$smarty.const._MD_KWCLUB_FULL}></span>
                        <{else}>
                            <{$data.class_regnum}> /
                            <{$data.class_member}>
                        <{/if}>
                        
                        <!--是否開班-->
                        <{if $data.class_ischecked==''}>
                        <{elseif $data.class_ischecked==1}>
                            <div>
                                <span class="badge alert-success"><{$smarty.const._MD_KWCLUB_CLASS_ENABLE}></span>
                            </div>
                        <{elseif $data.class_ischecked==0}>
                            <div>
                                <span class="badge alert-danger"><{$smarty.const._MD_KWCLUB_CLASS_UNABLE}></span>
                            </div>
                        <{/if}>
                    </li>

                    <li class="vm w1 text-center">
                        <{if $smarty.session.isclubAdmin}>
                            <{if $data.class_ischecked!=1}>
                                <a href="club.php?op=class_enable&class_id=<{$data.class_id}>" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="bottom" title="<{$smarty.const._MD_KWCLUB_CLASS_ENABLE_DESC}>"><{$smarty.const._MD_KWCLUB_CLASS_ENABLE}></a>
                            <{else}>
                                <a href="club.php?op=class_unable&class_id=<{$data.class_id}>" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="bottom" title="<{$smarty.const._MD_KWCLUB_CLASS_UNABLE_DESC}>"><{$smarty.const._MD_KWCLUB_CLASS_UNABLE}></a>
                            <{/if}>
                            <a href="club.php?op=class_blank&class_id=<{$data.class_id}>" class="btn btn-xs btn-default" data-toggle="tooltip" data-placement="bottom" title="<{$smarty.const._MD_KWCLUB_CLASS_BLANK_DESC}>"><{$smarty.const._MD_KWCLUB_CLASS_BLANK}></a>
                        <{/if}>

                        <{if $smarty.session.isclubAdmin || $uid == $data.class_uid}>
                            <a href="club.php?class_id=<{$data.class_id}>" class="btn btn-xs btn-warning" <{if !$can_operate}>data-toggle="tooltip" data-placement="bottom" title="<{$smarty.const._MD_KWCLUB_OVER_END_TIME}>" disabled<{/if}>><{$smarty.const._TAD_EDIT}></a>
                            <{if $data.class_regnum == 0}>
                                <a href="javascript:delete_class_func(<{$data.class_id}>);" class="btn btn-xs btn-danger" <{if !$can_operate}>data-toggle="tooltip" data-placement="bottom" title="<{$smarty.const._MD_KWCLUB_OVER_END_TIME}>" disabled<{/if}>><{$smarty.const._TAD_DEL}></a>
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
                    </li>
                </ul>
            <{/foreach}>
        </div>

    <{else}>
        <div class="alert alert-warning">
            <{$smarty.const._MD_KWCLUB_EMPTY_CLUB}>
        </div>
    <{/if}>
<{/if}>
