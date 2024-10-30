<?php

use app\modules\curiculumvitae\models\CvSiswa;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\modules\curiculumvitae\models\CvSiswaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Curiculum Vitae Siswa';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cv-siswa-index">
    <!-- <p>
        <?= Html::a('Create Cv Siswa', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'code',
                'nik',
                [
                    'label' => 'Nama Siswa',
                    'attribute' => 'nama',
                    'value' => function($model){
                        return isset($model->dataSiswa->nama) ? $model->dataSiswa->nama : '';
                    },
                ],
                [
                    'label' => 'Jurusan',
                    'attribute' => 'jurusan',
                    'value' => function($model){
                        return isset($model->dataSiswa->jurusan->nama) ? $model->dataSiswa->jurusan->nama : '';
                    },
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {delete} ',
                    'buttons' => [
                        'view' => function($url, $model){
                            return HTML::a("<span class='fas fa-eye'></span>", Url::toRoute(['view', 'code' => $model->code]),[
                                'class' => 'btn btn-info btn-xs',
                            ]);
                        },
                    ],
                    'contentOptions'=> [
                        'style'=>'width: 150px'
                    ],
                ],
            ],
        ]); ?>
    <?php Pjax::end(); ?>

</div>
