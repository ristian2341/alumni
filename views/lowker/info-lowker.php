<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Url;    
use yii\web\JsExpression;


/** @var yii\web\View $this */
/** @var app\models\Lowker $model */
/** @var yii\widgets\ActiveForm $form */

$this->title ="Info Lowongan Kerja";

?>
<style>
    .rg-product-container {
        border: 1px solid red;
        padding: 4px;
    }

</style>
<div class="lowker-form">
    <?php if(!empty($model)): 
            foreach ($model as $key => $data) {
                $tglpost = isset($data['tgl_post']) ? date_create($data['tgl_post']) : '';
                $tglNow = date_create();
                $hari = isset($data['tgl_post']) ? date_diff($tglpost,$tglNow) : '';
                echo "<div class='row rg-product-container'>";
                    echo "<div class='col-sm-12'><h5>Informasi Lowongan</h5></div>";
                    echo "<div class='col-sm-2'>".(isset($data['lowongan']) ? $data['lowongan'] : '')."</div>";
                    echo "<div class='col-sm-2'>".(isset($data['nama_perusahaan']) ? $data['nama_perusahaan'] : '')."</div>";
                    echo "<div class='col-sm-4'>".(!empty($hari) ? $hari->days." Hari, " : '')." Berakhir Tanggal : ".(isset($data['tgl_post']) ? date('d/m/Y',strtotime($data['tgl_last'])) : '')."</div>";
                    echo "<div class='col-sm-2'>".(isset($data['kabupaten']) ? $data['kabupaten'] : '')." ".(isset($data['propinsi']) ? $data['propinsi'] : '')."</div>";
                    echo "<div class='col-sm-2'></div>";
                echo "</div>";
            } 
        else:
            echo "
            <div class='row  rg-product-container'>
                <div class='col-sm-12'>
                    Info Lowongan Belum tersedia
                </div>
            </div>
        ";
        endif;
    ?>

</div>