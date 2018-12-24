<{if $smarty.session.isclubAdmin}>
    <{if $arr_year}>
        <div class="alert alert-info" style="margin: 10px auto;"><{$smarty.const._MD_KWCLUB_SELECT_YEAR}>
            <select name="club_year" onChange="location.href='register.php?op=reg_uid&club_year='+this.value;">
                <{if $arr_year}>
                    <{foreach from=$arr_year item=year}>
                        <option value="<{$year}>" <{if $club_year==$year}>selected<{/if}>><{$year}></option>
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
        <a href="register.php?club_year=<{$club_year}>" class="btn btn-primary"><i class="fa fa-table" aria-hidden="true"></i>
            <{$smarty.const._MD_KWCLUB_LIST_MODE}></a>
        <a href="excel.php?club_year=<{$club_year}>" class="btn btn-default"><i class="fa fa-file-excel-o" aria-hidden="true"></i>
            <{$smarty.const._MD_KWCLUB_EXPORT_EXCEL}></a>
        <a href="pdf.php?club_year=<{$club_year}>" class="btn btn-default"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>
            <{$smarty.const._MD_KWCLUB_EXPORT_PDF}></a>
    </div>

    <h3>
        <span class="club_year_text"><{$club_year}></span><{$smarty.const._MD_KWCLUB_PAID_LIST}>
        <small><{$smarty.const._MD_KWCLUB_PAGEBAR_TOTAL|sprintf:$total}></small>
    </h3>


        <{foreach from=$reg_all key=reg_uid item=reg}>

            <h4>
                <span style="color:blue"><{$reg.class}></span>
                <span style="color:blue"><{$reg.name}></span>
                <{$smarty.const._MD_KWCLUB_APPLY_RESULT}><small> (<{$reg_uid}>) </small>
            </h4>

            <div class="vtable">
                <ul class="vhead">
                    <li class="w3"><{$smarty.const._MD_KWCLUB_CLASS_TITLE}></li>
                    <li class="w2"><{$smarty.const._MD_KWCLUB_CLASS_MONEY}></li>
                    <li class="w2"><{$smarty.const._MD_KWCLUB_REG_DATETIME}></li>
                    <li class="w1"><{$smarty.const._MD_KWCLUB_REG_ISREG}></li>
                    <li class="w1"><{$smarty.const._MD_KWCLUB_REG_ISFEE}></li>
                    <li class="w1"><{$smarty.const._TAD_FUNCTION}></li>
                </ul>
                <{foreach from=$reg.data key=class_id item=data}>
                    <ul>
                        <li class="vcell"><{$smarty.const._MD_KWCLUB_CLASS_TITLE}></li>
                        <li class="vm w3"">
                            <a href="index.php?class_id=<{$data.class_id}>"> <{$data.class_title}></a>
                        </li>

                        <!--學費-->
                        <li class="vm w2 text-center">
                            <span data-toggle="tooltip" data-placement="bottom" <{if $data.class_fee}>style="color: #ad168a;"  title="<{$smarty.const._MD_KWCLUB_CLASS_MONEY}> <{$data.class_money}> <{$smarty.const._MD_KWCLUB_DOLLAR}> + <{$smarty.const._MD_KWCLUB_CLASS_FEE}> <{$data.class_fee}> <{$smarty.const._MD_KWCLUB_DOLLAR}>"<{/if}>><{$data.class_money}><{if $data.class_fee}> (<{$data.class_fee}>) <{/if}><{$smarty.const._MD_KWCLUB_DOLLAR}></span>
                        </li>

                        <!--報名時間-->
                        <li class="vm w2 text-center">
                            <{$data.reg_datetime}>
                        </li>

                        <li class="vm w1 text-center">
                            <{ if $data.reg_isreg==$smarty.const._MD_KWCLUB_OFFICIALLY_ENROLL}>
                                <span style='color: rgb(6, 2, 238)'><{$data.reg_isreg}></span>
                            <{else}>
                                <span style='color: rgb(35, 97, 35)'><{$data.reg_isreg}></span>
                            <{/if}>
                        </li>

                        <li class="vm w1 text-center">
                            <{ if $data.reg_isfee==1}>
                                <span style='color: green'><{$smarty.const._MD_KWCLUB_PAID}></span>
                            <{else}>
                                <span style='color: red'><{$smarty.const._MD_KWCLUB_NOT_PAY}></span>
                            <{/if}>
                        </li>

                        <li class="vm w1 text-center">
                            <{if  !$data.reg_isfee}>
                                <a href="javascript:delete_reg_func(<{$data.reg_sn}>);" class="btn btn-xs btn-danger"><i class="fa fa-times-circle" aria-hidden="true"></i>
                                    <{$smarty.const._MD_KWCLUB_DELETE_APPLY}></a>
                             <{else}>
                                    <a href="#" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="bottom" title="<{$smarty.const._MD_KWCLUB_OVER_END_TIME}>" disabled><i class="fa fa-times-circle" aria-hidden="true"></i>
                                        <{$smarty.const._MD_KWCLUB_DELETE_APPLY}></a>
                            <{/if}>
                        </li>
                    </ul>
                <{/foreach}>
            </div>
                <div class="text-right">
                    <{$smarty.const._MD_KWCLUB_PAY_STATUS|sprintf:$reg.money:$reg.in_money:$reg.un_money}>
                </div>

        <{/foreach}>
<{/if}>

