<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use app\models\User;
use app\models\GroupMenuDetail;

/** @var yii\web\View $this */
/** @var app\modules\deliveryorder\model_details\DeliveryOrder $model_detail */
/** @var yii\widgets\ActiveForm $form */

?>
<style>
    thead th {
        vertical-align: middle;
        font-size: 12px;
    }

    .btn {
        border-radius: 10px;
        padding: 5px 6px;
    }

    .table {
        width: 100%;
    }

    .table thead tr th {
        padding: 5px 5px;
        color : #dfd1d1;    
    }

    .table tbody tr td {
        background-color: #FFFFFF;
        padding: 3px 0px;
        vertical-align: middle;
    }
</style>

<table class="table table-striped table-bordered" id="tabel_detail" cellspacing="0" cellpadding="0" >
    <thead>
        <th style='width: 5%;vertical-align: middle;'>No.</th>
        <th style='vertical-align: middle;'>Menu</th>
        <th style='width: 30%;vertical-align: middle;text-align:center;' colspan="4">Action</th>
    </thead>
    <tbody>
        <?php if(!empty($menu)): 
            $no = 1;
            foreach ($menu as $key => $val) {
                if(isset($id_group)){
                    $GroupDetail = GroupMenuDetail::find()->where(['id_menu' => $val->id_menu,'id_group' => $id_group])->one();
                }
        ?>
            <tr>
                <td style='text-align: center;'><?= $no++ ?></td>
                <td><input type="checkbox" id="menu_<?= $val->id_menu ?>" class="menuChk" name="menu[<?= $val->id_menu ?>]" value="<?= $val->id_menu ?>" data-id="<?= $val->id_menu ?>" <?= isset($GroupDetail->id_menu) ? "checked" : "" ?> ><label for="menu_<?= $val->id_menu ?>" >&nbsp;<?= $val->nama ?></label></td>
                <td style='text-align: center;'><input type="checkbox" id="view_<?= $val->id_menu ?>" name="view[<?= $val->id_menu ?>]" value="1" data-id="<?= $val->id_menu ?>" <?= !empty($GroupDetail->read) ? "checked" : "" ?>><label for="view_<?= $val->id_menu ?>" >&nbsp;View</label></td>
                <td style='text-align: center;'><input type="checkbox" id="create_<?= $val->id_menu ?>" name="create[<?= $val->id_menu ?>]" value="1" data-id="<?= $val->id_menu ?>" <?= !empty($GroupDetail->create) ? "checked" : "" ?>><label for="create_<?= $val->id_menu ?>">&nbsp;Create</label></td>
                <td style='text-align: center;'><input type="checkbox" id="update_<?= $val->id_menu ?>" name="update[<?= $val->id_menu ?>]" value="1" data-id="<?= $val->id_menu ?>" <?= !empty($GroupDetail->update) ? "checked" : "" ?>><label for="update_<?= $val->id_menu ?>">&nbsp;Update</label></td>
                <td style='text-align: center;'><input type="checkbox" id="delete_<?= $val->id_menu ?>" name="delete[<?= $val->id_menu ?>]" value="1" data-id="<?= $val->id_menu ?>" <?= !empty($GroupDetail->delete) ? "checked" : "" ?>><label for="delete_<?= $val->id_menu ?>">&nbsp;Delete</label></td>
            </tr>
        <?php
            }
         endif; ?>
    </tbody>
</table>

<script>
    $("body").off("change",".menuChk").on("change",".menuChk",function(){
        var num = $(this).attr("data-id");
        if($(this).is(':checked')){
            $("#view_"+num).prop("checked",true);
            $("#create_"+num).prop("checked",true);
            $("#update_"+num).prop("checked",true);
            $("#delete_"+num).prop("checked",true);
        }else{
            $("#view_"+num).prop("checked",false);
            $("#create_"+num).prop("checked",false);
            $("#update_"+num).prop("checked",false);
            $("#delete_"+num).prop("checked",false);
        }
    });
</script>