<?php
use yii\helpers\Html;
use yii\helpers\Url;

if(!empty($model->path_foto) and file_exists($model->path_foto))
{
    $picture_cv = $model->path_foto;
}else{
    $picture_cv = "";
}

$background = file_exists(url::To("background_cv.png")) ? url::To("background_cv.png") : '';

?>
<style>
    .profile_img {
        position: absolute;
        width: 120px;
        height: 120px;
        border-radius: 120px;
        border-style: solid;
        border-color: white;
        border-width: medium;

        overflow: hidden;

        background-size: 150px 150px;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center; 
    }
</style>

<div class="row">
    <table cellspacing=0 cellpadding=0 width="100%" style="color: white;border-style:solid;border-color: #000000;">
        <tr>
            <td style="width: 50%;">
                <table cellspacing=0 cellpadding=0 width="100%" style="color: white;text-align: center;vertical-align: middle;font-weight: bold;margin-right: 40;margin-bottom: 40;">
                    <tr>
                        <td>
                            <?php 
                                if(!empty($picture_cv)){
                                    echo "<img src=".$picture_cv." style='width: 200px;border-radius: 50%;'>";
                                }
                            ?> 
                        </td>
                    </tr>
                </table>                
            </td>
            <td  style="width: 50%;height: 415px;">
                <table cellspacing=10 cellpadding=0 width="100%" height="350px" style="color: white;text-align: center;vertical-align: bottom;font-weight: bold;margin-right: 50;">
                    <tr>
                        <td style="font-size: 16pt;">
                            <?= isset($model->nama) ? $model->nama : '-' ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?= isset($data_siswa->jurusan->nama) ? $data_siswa->jurusan->nama : '-' ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>   
</div>