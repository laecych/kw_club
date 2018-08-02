<h2><{$smarty.const._MD_KWCLUB_MYCLASS}></h2>

<form action="index.php" method="post" id="myForm" class="myForm form-horizontal" role="form" style="margin: 20px auto 50px;">
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon3"><{$smarty.const._MD_KWCLUB_SELECT_YEAR}></span>
        <select name="club_year" class="form-control">
            <{if $arr_year}>
                <{foreach from=$arr_year key=year item=year_txt}>
                    <option value="<{$year}>" <{if $club_year==$year}>selected<{/if}>><{$year_txt}></option>
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
            <span style="color: rgb(124, 58, 58);"><{$reg_name}></span><span class="club_year_text"><{$club_year_text}></span><{$smarty.const._MD_KWCLUB_MY_ALL_CLASS}>
            <small><{$smarty.const._MD_KWCLUB_PAGEBAR_TOTAL|sprintf:$total}></small>
        </h3>

        <table class="table table-bordered table-hover table-condensed">
            <thead>
                <tr class="success">
                    <th class="text-center"><{$smarty.const._MD_KWCLUB_CLASS_TITLE}></th>
                    <th class="text-center"><{$smarty.const._MD_KWCLUB_CLASS_TIME}></th>
                    <th class="text-center"><{$smarty.const._MD_KWCLUB_CLASS_MONEY}></th>
                    <th class="text-center"><{$smarty.const._MD_KWCLUB_REG_DATETIME}></th>
                    <th class="text-center"><{$smarty.const._MD_KWCLUB_REG_ISREG}></th>
                    <th class="text-center"><{$smarty.const._TAD_FUNCTION}></th>
                </tr>
            </thead>
            <tbody>
                <{foreach from=$arr_reg key=sn item=data}>
                    <tr>
                        <td>
                            <a href="index.php?class_id=<{$data.class_id}>"><{$data.class_title}></a>
                        </td>
                        <td nowrap>
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
                        </td>

                        <!-- 學費 -->
                        <td nowrap class="text-center">
                            <span data-toggle="tooltip" data-placement="bottom" <{if $data.class_fee}>style="color: #ad168a;"  title="<{$smarty.const._MD_KWCLUB_CLASS_MONEY}> <{$data.class_money}> <{$smarty.const._MD_KWCLUB_DOLLAR}> + <{$smarty.const._MD_KWCLUB_CLASS_FEE}> <{$data.class_fee}> <{$smarty.const._MD_KWCLUB_DOLLAR}>"<{/if}>>
                                <{$data.class_pay}> <{$smarty.const._MD_KWCLUB_DOLLAR}>
                            </span>
                            （<{ if $data.reg_isfee==1}><span style='color: green'><{$smarty.const._MD_KWCLUB_PAID}></span> <{else}><span style='color: red'><{$smarty.const._MD_KWCLUB_NOT_PAY}></span><{/if}>）
                        </td>

                        <!--報名時間-->
                        <td class="text-center">
                            <{$data.reg_datetime}>
                        </td>

                        <!-- 是否後補 -->
                        <td nowrap class="text-center">
                            <{ if $data.reg_isreg==$smarty.const._MD_KWCLUB_OFFICIALLY_ENROLL}>
                                <span style='color: rgb(6, 2, 238)'><{$data.reg_isreg}></span>
                            <{else}>
                                <span style='color: rgb(35, 97, 35)'><{$data.reg_isreg}></span>
                            <{/if}>
                        </td>
                        <td class="text-center">
                            <{if $today < $data.end_date }>
                                <a href="javascript:delete_reg_func(<{$data.reg_sn}>);" class="btn btn-danger btn-xs"><i class="fa fa-times-circle" aria-hidden="true"></i>
                                    <{$smarty.const._MD_KWCLUB_DELETE_APPLY}></a>
                            <{/if}>
                        </td>
                    </tr>
                <{/foreach}>
                <tr>
                    <td colspan="2" align='center'><{$smarty.const._MD_KWCLUB_PAY_TOTAL}></td>
                    <td  colspan="6" align='right'>
                        <{$smarty.const._MD_KWCLUB_PAY_STATUS|sprintf:$money:$in_money:$un_money}>
                    </td>
                </tr>
            </tbody>
        </table>
    <{else}>
        <div class="alert alert-danger">
            <span class="club_year_text"><{$club_year_text}></span><{$smarty.const._MD_KWCLUB_NOT_FOUND|sprintf:$reg_uid}></div>
    <{/if}>
<{/if}>
