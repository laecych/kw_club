<{if $smarty.session.isclubAdmin}>
    <{if $arr_year}>
        <div class="alert alert-info" style="margin: 10px auto;"><{$smarty.const._MD_KWCLUB_SELECT_YEAR}>
            <select name="club_year" onChange="location.href='register.php?op=reg_uid&club_year='+this.value;">
                <{if $arr_year}>
                    <{foreach from=$arr_year key=year item=year_txt}>
                        <option value="<{$year}>" <{if $club_year==$year}>selected<{/if}>><{$year_txt}></option>
                    <{/foreach}>
                <{else}>
                    <option value=""><{$smarty.const._MD_KWCLUB_EMPTY_YEAR}></option>
                <{/if}>
            </select>
        </div>
    <{else}>
        <div class="alert alert-danger">
            <{$smarty.const._MD_KWCLUB_NEED_CONFIG}>
        </div>
    <{/if}>

    <div align="right">
        <a href="register.php" class="btn btn-primary"><i class="fa fa-table" aria-hidden="true"></i>
            <{$smarty.const._MD_KWCLUB_LIST_MODE}></a>
        <a href="pdf.php?club_year=<{$smarty.session.club_year}>" class="btn btn-success"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>
            <{$smarty.const._MD_KWCLUB_EXPORT_PDF}></a>
    </div>

    <h3>
        <span class="club_year_text"><{$club_year_text}></span><{$smarty.const._MD_KWCLUB_PAID_LIST}>
        <small><{$smarty.const._MD_KWCLUB_PAGEBAR_TOTAL|sprintf:$total}></small>
    </h3>

    <table class="table table-bordered table-hover table-condensed">
        <thead>
            <tr class="success">
                <th><{$smarty.const._MD_KWCLUB_CLASS_YEAR}></th>
                <th><{$smarty.const._MD_KWCLUB_CLASS_TITLE}></th>
                <th><{$smarty.const._MD_KWCLUB_CLASS_MONEY}></th>
                <th><{$smarty.const._MD_KWCLUB_REG_DATETIME}></th>
                <th><{$smarty.const._MD_KWCLUB_REG_ISREG}></th>
                <th><{$smarty.const._MD_KWCLUB_REG_ISFEE}></th>
                <th><{$smarty.const._TAD_FUNCTION}></th>
            </tr>
        </thead>
        <{foreach from=$reg_all key=reg_uid item=reg}>
            <tbody>
                <tr>
                    <th colspan=7>
                        <span style="color:blue"><{$reg.name}></span><{$smarty.const._MD_KWCLUB_APPLY_RESULT}><small> (<{$reg_uid}>) </small>
                    </th>
                </tr>

                <{foreach from=$reg.data key=class_id item=data}>
                    <tr>
                        <!--社團年度-->
                        <td>
                            <{$data.club_year}>
                        </td>

                        <td>
                            <a href="index.php?class_id=<{$data.class_id}>"> <{$data.class_title}></a>
                        </td>

                        <!--學費-->
                        <td>
                            <{$data.class_money}>(<{$smarty.const._MD_KWCLUB_CLASS_FEE}> <{$data.class_fee}>)
                        </td>

                        <!--報名時間-->
                        <td>
                            <{$data.reg_datetime}>
                        </td>

                        <td>
                            <{ if $data.reg_isreg==$smarty.const._MD_KWCLUB_OFFICIALLY_ENROLL}>
                                <span style='color: rgb(6, 2, 238)'><{$data.reg_isreg}></span>
                            <{else}>
                                <span style='color: rgb(35, 97, 35)'><{$data.reg_isreg}></span>
                            <{/if}>
                        </td>

                        <td>
                            <{ if $data.reg_isfee==1}>
                                <span style='color: green'><{$smarty.const._MD_KWCLUB_PAID}></span>
                            <{else}>
                                <span style='color: red'><{$smarty.const._MD_KWCLUB_NOT_PAY}></span>
                            <{/if}>
                        </td>

                        <td>
                            <{if !($today > $end_day) }>
                                <a href="javascript:delete_reg_func(<{$data.reg_sn}>);" class="btn btn-xs btn-danger"><i class="fa fa-times-circle" aria-hidden="true"></i>
                                    <{$smarty.const._MD_KWCLUB_DELETE_APPLY}></a>
                            <{/if}>
                        </td>
                    </tr>
                <{/foreach}>
                <tr>
                    <td colspan="7" align='right'>
                        <{$smarty.const._MD_KWCLUB_PAY_STATUS|sprintf:$reg.money:$reg.in_money:$reg.un_money}>
                    </td>
                </tr>
            </tbody>
        <{/foreach}>
    </table>
<{/if}>