<div class="row">

    <input type="hidden" name="role_id_for_permission" id="role_id_for_permission" value="{{$role_id}}">

    <div class="col-lg-12 col-sm-12 col-xs-12">
        <table class="table table-bordered table-condensed">
            <tr>
                <th>{{ trans('label_word.id') }}</th>
                <th>{{ trans('label_word.module_sidebar') }}</th>
                <th>{{ trans('label_word.no_rights') }}</th>
                <th>{{ trans('label_word.read') }}</th>
                <th>{{ trans('label_word.write') }}</th>
            </tr>
            <?php
            $sr = 1;
            if(isset($module_with_group) && !empty($module_with_group)){
            foreach($module_with_group as $single_group_key=>$single_group_value){
            ?>
            <tr class="style-default" align="center">
                <td colspan="5"><?php echo $single_group_key;?></td>
            </tr>
            <?php
            foreach($single_group_value as $single_module){
            ?>
            <tr>
                <th><?php echo $sr; ?></th>
                <th><?php echo $single_module->mod_title; ?></th>
                <th>
                    <input type="radio" name="rlmdl_<?php echo $single_module->mod_id; ?>"
                           class="role_module_radio_class"
                           data-mod_id="<?php echo $single_module->mod_id; ?>"
                           data-permission="None"
                    <?php if ($single_module->per_permission == 'None') {
                        echo "checked";
                    } ?>
                            >
                </th>
                <th>
                    <input type="radio" name="rlmdl_<?php echo $single_module->mod_id; ?>"
                           class="role_module_radio_class"
                           data-mod_id="<?php echo $single_module->mod_id; ?>"
                           data-permission="Read"
                    <?php if ($single_module->per_permission == 'Read') {
                        echo "checked";
                    } ?>
                            >
                </th>
                <th>
                    <input type="radio" name="rlmdl_<?php echo $single_module->mod_id; ?>"
                           class="role_module_radio_class"
                           data-mod_id="<?php echo $single_module->mod_id; ?>"
                           data-permission="Write"
                    <?php if ($single_module->per_permission == 'Write') {
                        echo "checked";
                    } ?>
                            >
                </th>
            </tr>
            <?php
            $sr++;
            }//end of foreach($single_group_value as $single_module)
            ?>
            <?php
            }//end of foreach($module_with_group as $single_group_key=>$single_group_value)
            }
            ?>

        </table>
    </div>
</div>
<script type="text/javascript">
    $(".role_module_radio_class").click(function () {

        if ($(this).is(":checked") == true) {
            var mod_id = $(this).data('mod_id');
            var permission = $(this).data('permission');
            var rl_id = $("#role_id_for_permission").val();

            if (mod_id != '' && permission != '' && role_id != '') {
                var card = $("#role_module_permission_card");
                // materialadmin.AppCard.addCardLoader(card);
                $.ajax({
                    url: '<?php echo route('assign_module_permission_to_role');?>',
                    method: 'post',
                    data: {
                        '_token': '<?php echo csrf_token();?>',
                        'mod_id': mod_id,
                        'permission': permission,
                        'rl_id': rl_id
                    },
                    success: function (result) {
                        $obj = JSON.parse(result);
                        if ($obj['SUCCESS'] == 'TRUE') {
                            toastr.success($obj['MESSAGE']);
                        } else {
                            toastr.error($obj['MESSAGE']);
                        }
                        // materialadmin.AppCard.removeCardLoader(card);
                    }
                });
            }
        }
    });
</script>