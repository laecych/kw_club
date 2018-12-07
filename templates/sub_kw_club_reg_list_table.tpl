
<{if $all_reg}>
    <div class="vtable" style="margin:10px auto 30px;">
        <ul class="vhead">
            <!--社團名稱-->
            <{if !$class_id}>
                <li class="w2">
                    <{$smarty.const._MD_KWCLUB_CLASS_TITLE}>
                </li>
            <{/if}>
            <!--報名者ID-->
            <li class="w1">
                <{$smarty.const._MD_KWCLUB_REG_UID}>
            </li>
            
            <!--報名者姓名-->
            <li class="w1">
                <{$smarty.const._MD_KWCLUB_REG_NAME}>
            </li>
            <!--報名者班級-->
            <li class="w1">
                <{$smarty.const._MD_KWCLUB_REG_CLASS}>
            </li>

            <!--是否候補-->
            <li class="w1">
                <{$smarty.const._MD_KWCLUB_REG_ISREG}>
            </li>

            <{if $smarty.session.isclubAdmin || $uid == $class_uid }>
                <!--是否繳費-->
                <li>
                    <{$smarty.const._MD_KWCLUB_REG_ISFEE}>
                </li>
              
                <!--家長-->
                <li class="w1">
                    <{$smarty.const._MD_KWCLUB_REG_PARENT}>
                </li>
                <!--電話-->
                <li class="w1">
                    <{$smarty.const._MD_KWCLUB_REG_TEL}>
                </li>
                <li class="w1">
                    <{$smarty.const._TAD_FUNCTION}>
                </li>
            <{/if}>
        </ul>

        <{foreach from=$all_reg item=data}>
            <ul>
                <!--社團名稱-->
                <{if !$class_id}>
                    <li class="vcell"><{$smarty.const._MD_KWCLUB_CLASS_TITLE}></li>
                    <li class="vm w2">
                        <a href="index.php?class_id=<{$data.class_id}>" data-toggle="tooltip" data-placement="bottom" title="<{$data.class_id}>"><{$data.class_title}></a>
                    </li>
                <{/if}>
                <!--報名者ID-->
                <li class="vm w1 text-center">
                     <span class="editable" id="reg_uid_<{$data.reg_sn}>"><{$data.reg_uid}></span>
                </li>
                <!--報名者姓名-->
                <li class="vcell text-center"><{$smarty.const._MD_KWCLUB_REG_NAME}></li>
                <li class="vm w1 text-center">
                    <{if $smarty.session.isclubAdmin || $uid == $class_uid }>
                        <span class="editable" id="reg_name_<{$data.reg_sn}>"><{$data.reg_name}></span>
                    <{else}>
                        <span><{$data.reg_part_name}></span>
                    <{/if}>
                </li>

                <!--報名者班級-->
                <li class="vm w1 text-center">
                    <{if $data.reg_grade==$smarty.const._MD_KWCLUB_KG}>
                        <span <{if $smarty.session.isclubAdmin || $uid == $class_uid }>class="editable" id="reg_grade_<{$data.reg_sn}><{/if}>"><{$smarty.const._MD_KWCLUB_KINDERGARTEN}></span><span class="editable" id="reg_class_<{$data.reg_sn}>"><{$data.reg_class}></span>
                    <{else}>
                        <span <{if $smarty.session.isclubAdmin || $uid == $class_uid }>class="editable" id="reg_grade_<{$data.reg_sn}><{/if}>"><{$data.reg_grade}><{$smarty.const._MD_KWCLUB_G}></span><span <{if $smarty.session.isclubAdmin || $uid == $class_uid }>class="editable" id="reg_class_<{$data.reg_sn}>"<{/if}>><{$data.reg_class}></span>
                    <{/if}>
                </li>

                <!--是否候補-->
                <li class="vm w1 text-center">
                    <{if $smarty.session.isclubAdmin || $uid == $class_uid}>
                        <span class="editable" id="reg_isreg_<{$data.reg_sn}>" style='color:<{ if $data.reg_isreg==$smarty.const._MD_KWCLUB_OFFICIALLY_ENROLL}> rgb(6, 2, 238)<{else}>rgb(35, 97, 35)<{/if}>'><{$data.reg_isreg}></span>
                    <{else}>
                        <{if $chk_time}>
                            <{if $data.reg_isfee==1}>
                                <{$smarty.const._MD_KWCLUB_PAID}>
                            <{else}>
                                <{$smarty.const._MD_KWCLUB_NOT_PAY}>
                            <{/if}>
                        <{else}>
                            <span style='color:<{ if $data.reg_isreg==$smarty.const._MD_KWCLUB_OFFICIALLY_ENROLL}> rgb(6, 2, 238)<{else}>rgb(35, 97, 35)<{/if}>'><{$data.reg_isreg}></span>
                        <{/if}>
                    <{/if}>

                </li>

                <{if $smarty.session.isclubAdmin || $uid == $class_uid }>
                    <!--是否繳費-->
                    <li class="vm text-center">
                        <a href="register.php?op=update_reg_isfee&amp;reg_isfee=<{if $data.reg_isfee==1}>0<{else}>1<{/if}>&amp;reg_sn=<{$data.reg_sn}>" data-toggle="tooltip" data-placement="top" title="<{$smarty.const._MD_KWCLUB_CLICK_TO}><{if $data.reg_isfee==1}><{$smarty.const._MD_KWCLUB_NOT_PAY}><{else}><{$smarty.const._MD_KWCLUB_PAID}><{/if}>"><{$data.reg_isfee_pic}></a>

                        <span data-toggle="tooltip" data-placement="bottom" <{if $data.class_fee}>style="color: #ad168a;"  title="<{$smarty.const._MD_KWCLUB_CLASS_MONEY}> <{$data.class_money}> <{$smarty.const._MD_KWCLUB_DOLLAR}> + <{$smarty.const._MD_KWCLUB_CLASS_FEE}> <{$data.class_fee}> <{$smarty.const._MD_KWCLUB_DOLLAR}>"<{/if}>><{$data.class_money}><{if $data.class_fee}> (<{$data.class_fee}>) <{/if}><{$smarty.const._MD_KWCLUB_DOLLAR}></span>
                    </li>

                
                    <!--家長-->
                    <li class="vm w1 text-center">
                        <span class="editable" id="reg_parent_<{$data.reg_sn}>"><{$data.reg_parent}></span>
                    </li>
                    <!--電話-->
                    <li class="vm w1 text-center">
                        <span class="editable" id="reg_tel_<{$data.reg_sn}>"><{$data.reg_tel}></span>
                    </li>

                    <!--功能-->
                    <li class="vm w1 text-center">
                        <a href="index.php?reg_uid=<{$data.reg_uid}>&op=myclass" class="btn btn-xs btn-info"  data-toggle="tooltip" data-placement="bottom" title="<{$smarty.const._MD_KWCLUB_SIGNUP_STATUS|sprintf:$data.reg_datetime:$data.reg_ip:$data.reg_sn}>"><{$smarty.const._MD_KWCLUB_DETIAL}></a>
                        <{if !$data.reg_isfee}>
                        <a href="javascript:delete_reg_func(<{$data.reg_sn}>);" class="btn btn-xs btn-danger"><{$smarty.const._TAD_DEL}></a>
                        <{/if}>
                    </li>
                <{/if}>
            </ul>
        <{/foreach}>
    </div>

    <{if $smarty.session.isclubAdmin || $uid == $class_uid }>
        <div class="text-right" style="font-size:0.9em;margin: 2px auto 30px;color:rgb(97, 29, 63);">
            <i class="fa fa-lightbulb-o" aria-hidden="true"></i>
            <{$smarty.const._MD_KWCLUB_CLICK_TO_EDIT_DESC}>
        </div>
    <{/if}>
<{else}>
    <div class="alert alert-danger">
        <{$smarty.const._MD_KWCLUB_EMAPY_REGISTER}>
    </div>
<{/if}>