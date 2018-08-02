
<table class="table table-bordered table-hover table-striped">
    <thead>
        <tr class="info">
            <!--社團名稱-->
            <{if !$class_id}>
                <th class="text-center">
                    <{$smarty.const._MD_KWCLUB_CLASS_TITLE}>
                </th>
            <{/if}>
            <!--報名者姓名-->
            <th class="text-center">
                <{$smarty.const._MD_KWCLUB_REG_NAME}>
            </th>
            <!--報名者班級-->
            <th class="text-center">
                <{$smarty.const._MD_KWCLUB_REG_CLASS}>
            </th>

            <{if $smarty.session.isclubAdmin}>
                <!--是否後補-->
                <th class="text-center">
                    <{$smarty.const._MD_KWCLUB_REG_ISREG}>
                </th>
                <!--是否繳費-->
                <th class="text-center">
                    <{$smarty.const._MD_KWCLUB_REG_ISFEE}>
                </th>
                <!--報名者ID-->
                <th class="text-center">
                    <{$smarty.const._MD_KWCLUB_REG_UID}>
                </th>
                <th class="text-center">
                    <{$smarty.const._TAD_FUNCTION}>
                </th>
            <{/if}>
        </tr>
    </thead>
    <tbody>
        <{foreach from=$all_reg item=data}>
            <tr>
                <!--社團名稱-->
                <{if !$class_id}>
                    <td>
                        <a href="index.php?class_id=<{$data.class_id}>" data-toggle="tooltip" data-placement="bottom" title="<{$data.class_id}>"><{$data.class_title}></a>
                    </td>
                <{/if}>

                <td class="text-center">
                    <span class="editable" id="reg_name_<{$data.reg_sn}>"><{$data.reg_name}></span>
                </td>

                <td class="text-center">
                    <{if $data.reg_grade==$smarty.const._MD_KWCLUB_KG}>
                        <span class="editable" id="reg_grade_<{$data.reg_sn}>"><{$smarty.const._MD_KWCLUB_KINDERGARTEN}></span><span class="editable" id="reg_class_<{$data.reg_sn}>"><{$data.reg_class}></span>
                    <{else}>
                        <span class="editable" id="reg_grade_<{$data.reg_sn}>"><{$data.reg_grade}><{$smarty.const._MD_KWCLUB_G}></span><span class="editable" id="reg_class_<{$data.reg_sn}>"><{$data.reg_class}></span>
                    <{/if}>
                </td>

                <{if $smarty.session.isclubAdmin}>
                    <td class="text-center">
                        <{ if $data.reg_isreg==$smarty.const._MD_KWCLUB_OFFICIALLY_ENROLL}>
                            <span class="editable" id="reg_isreg_<{$data.reg_sn}>" style='color: rgb(6, 2, 238)'><{$data.reg_isreg}></span>
                        <{else}>
                            <span class="editable" id="reg_isreg_<{$data.reg_sn}>" style='color: rgb(35, 97, 35)'><{$data.reg_isreg}></span>
                        <{/if}>
                    </td>

                    <td class="text-center">
                        <a href="register.php?op=update_reg_isfee&amp;reg_isfee=<{if $data.reg_isfee==1}>0<{else}>1<{/if}>&amp;reg_sn=<{$data.reg_sn}>" data-toggle="tooltip" data-placement="top" title="<{$smarty.const._MD_KWCLUB_CLICK_TO}><{if $data.reg_isfee==1}><{$smarty.const._MD_KWCLUB_NOT_PAY}><{else}><{$smarty.const._MD_KWCLUB_PAID}><{/if}>"><{$data.reg_isfee_pic}></a>

                        <span data-toggle="tooltip" data-placement="bottom" <{if $data.class_fee}>style="color: #ad168a;"  title="<{$smarty.const._MD_KWCLUB_CLASS_MONEY}> <{$data.class_money}> <{$smarty.const._MD_KWCLUB_DOLLAR}> + <{$smarty.const._MD_KWCLUB_CLASS_FEE}> <{$data.class_fee}> <{$smarty.const._MD_KWCLUB_DOLLAR}>"<{/if}>><{$data.class_pay}> <{$smarty.const._MD_KWCLUB_DOLLAR}></span>
                    </td>

                    <td class="text-center">
                        <span class="editable" id="reg_uid_<{$data.reg_sn}>"><{$data.reg_uid}></span>
                    </td>

                    <td class="text-center">
                        <a href="index.php?reg_uid=<{$data.reg_uid}>&op=myclass" class="btn btn-xs btn-info"  data-toggle="tooltip" data-placement="bottom" title="<{$smarty.const._MD_KWCLUB_SIGNUP_STATUS|sprintf:$data.reg_datetime:$data.reg_ip:$data.reg_sn}>"><{$smarty.const._MD_KWCLUB_DETIAL}></a>
                        <a href="javascript:delete_reg_func(<{$data.reg_sn}>);" class="btn btn-xs btn-danger"><{$smarty.const._TAD_DEL}></a>
                    </td>
                <{/if}>
            </tr>
        <{foreachelse}>
            <tr>
                <td colspan=7><{$smarty.const._MD_KWCLUB_EMAPY_REGISTER}></td>
            </tr>
        <{/foreach}>
    </tbody>
</table>

<div class="text-right">
    <{$smarty.const._MD_KWCLUB_CLICK_TO_EDIT_DESC}>
</div>