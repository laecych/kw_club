<div class="row">
        <div class="col-sm-10">
                <h2><{$smarty.const._MD_KWCLUB_MYCLASS}></h2>
        </div>
        <div class="col-sm-2" style="padding-top: 40px;">
           <{if $language=="english"}>
            <a href="index.php?op=myclass&language=tchinese_utf8" class="btn btn-primary btn-block" ><i class="fa fa-refresh" aria-hidden="true"></i>
            <{else}>
            <a href="index.php?op=myclass&language=english" class="btn btn-primary btn-block" ><i class="fa fa-refresh" aria-hidden="true"></i>
            <{/if}>    
               <{$smarty.const._MD_KWCLUB_LANGUAGE}></a>
        </div>   
    </div>

<form action="index.php" method="post" id="myForm" class="myForm form-horizontal" role="form" style="margin: 20px auto 50px;">
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon3"><{$smarty.const._MD_KWCLUB_SELECT_YEAR}></span>
        <select name="club_year" class="form-control">
            <{if $arr_year}>
                <{foreach from=$arr_year item=year}>
                    <option value="<{$year}>" <{if $club_year==$year}>selected<{/if}>><{$year}></option>
                <{/foreach}>
            <{else}>
                <option value=""><{$smarty.const._MD_KWCLUB_EMPTY_YEAR}></option>
            <{/if}>
        </select>
        <span class="input-group-addon" id="basic-addon3"><{$smarty.const._MD_KWCLUB_KEYIN}><{$smarty.const._MD_KWCLUB_REG_UID}></span>
        <input type="text" name="reg_uid" class="form-control" placeholder="<{$smarty.const._MD_KWCLUB_KEYIN}><{$smarty.const._MD_KWCLUB_REG_UID}>" value="<{$reg_uid}>">
        <span class="input-group-btn">
            <input type="hidden" name="op" value="myclass">
            <button class="btn btn-primary" type="submit"><{$smarty.const._TAD_SEARCH}></button>
        </span>
    </div>
</form>

<{if $reg_uid}>
    <{if $reg_name}>
        <h3>
            <span style="color: rgb(124, 58, 58);"><{$reg_name}></span><span class="club_year_text"><{$club_year}></span><{$smarty.const._MD_KWCLUB_MY_ALL_CLASS}>
            <small><{$smarty.const._MD_KWCLUB_PAGEBAR_TOTAL|sprintf:$total}></small>
        </h3>

        <div class="vtable">
            <ul class="vhead">
                <li class="w2 text-center"><{$smarty.const._MD_KWCLUB_CLASS_TITLE}></li>
                <li class="w3 text-center"><{$smarty.const._MD_KWCLUB_CLASS_TIME}></li>
                <li class="w2 text-center"><{$smarty.const._MD_KWCLUB_CLASS_MONEY}></li>
                <li class="w1 text-center"><{$smarty.const._MD_KWCLUB_REG_DATETIME}></li>
                <li class="w1 text-center"><{$smarty.const._MD_KWCLUB_REG_ISREG}></li>
                <li class="w1 text-center"><{$smarty.const._TAD_FUNCTION}></li>
            </ul>
            <{foreach from=$arr_reg key=sn item=data}>
                <ul>
                    <li class="vcell"><{$smarty.const._MD_KWCLUB_CLASS_TITLE}></li>
                    <li class="vm w2">
                        <a href="index.php?class_id=<{$data.class_id}>"><{$data.class_title}></a>
                    </li>
                    <li class="vm w3">
                        <div>
                            <span class="number_b">
                                <{$data.class_date_open|date_format:"%Y/%m/%d"}>
                            </span>
                            <{$smarty.const._MD_KWCLUB_APPLY_FROM_TO}>
                            <span class="number_b">
                                <{$data.class_date_close|date_format:"%Y/%m/%d"}>
                            </span>
                        </div>
                        <div>
                            <{if $data.class_week==$smarty.const._MD_KWCLUB_ALL_WEEK}>
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

                    <!-- 學費 -->
                    <li class="vm w2 text-center">
                        <span data-toggle="tooltip" data-placement="bottom" <{if $data.class_fee}>style="color: #ad168a;"  title="<{$smarty.const._MD_KWCLUB_CLASS_MONEY}> <{$data.class_money}> <{$smarty.const._MD_KWCLUB_DOLLAR}> + <{$smarty.const._MD_KWCLUB_CLASS_FEE}> <{$data.class_fee}> <{$smarty.const._MD_KWCLUB_DOLLAR}>"<{/if}>><{$data.class_money}><{if $data.class_fee}> (<{$data.class_fee}>) <{/if}><{$smarty.const._MD_KWCLUB_DOLLAR}></span>
                        <div>
                            <{ if $data.reg_isfee==1}>
                                <span class="label label-success"><{$smarty.const._MD_KWCLUB_PAID}></span>
                            <{else}>
                                <span class="label label-danger"><{$smarty.const._MD_KWCLUB_NOT_PAY}></span>
                            <{/if}>
                        </div>
                    </li>

                    <!--報名時間-->
                    <li class="vm w1 text-center">
                        <{$data.reg_datetime}>
                    </li>

                    <!-- 結果是否候補 -->
                    <li class="vm w1 text-center">
                        <{ if $data.reg_isreg==$smarty.const._MD_KWCLUB_OFFICIALLY_ENROLL}>
                            <span style='color: rgb(6, 2, 238)'><{$data.reg_isreg}></span>
                        <{else}>
                            <span style='color: rgb(35, 97, 35)'><{$data.reg_isreg}></span>
                        <{/if}>
                    </li>

                    <li class="vm w1 text-center">
                    <{if !($today > $data.end_date ) || !$data.reg_isfee}>
                        <{$smarty.const._MD_KWCLUB_DELETE_NOT}>
                    <{else}>
                            <a href="#" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="bottom" title="<{$smarty.const._MD_KWCLUB_OVER_END_TIME}>" disabled><i class="fa fa-times-circle" aria-hidden="true"></i>
                            <{$smarty.const._MD_KWCLUB_DELETE_APPLY}></a>
                    <{/if}>
                    </li>
                </ul>
            <{/foreach}>
        </div>
        <div class="text-right" style="margin-bottom:30px;">
            <{$smarty.const._MD_KWCLUB_PAY_TOTAL}><{$smarty.const._MD_KWCLUB_PAY_STATUS|sprintf:$money:$in_money:$un_money}>
        </div>
    <{else}>
        <div class="alert alert-danger">
            <span class="club_year_text"><{$club_year}></span><{$smarty.const._MD_KWCLUB_NOT_FOUND|sprintf:$reg_uid}></div>
    <{/if}>
<{/if}>
