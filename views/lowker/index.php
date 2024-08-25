<?php

use app\models\Lowker;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\LowkerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Lowkers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lowker-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a(Yii::t('app', 'Create Lowongan Kerja'), ['create'], ['class' => 'btn btn-sm btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'class' => 'yii\bootstrap4\LinkPager',
            'firstPageLabel' => 'First',
            'lastPageLabel'  => 'Last'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'code_lowker',
            'tgl_post',
            'tgl_last',
            'lowongan',
            'id_perusahaan',
            'nama_perusahaan',
            //'alamat',
            //'kabupaten',
            //'propinsi',
            'kontak',
            'email:email',
            //'requirement:ntext',
            //'keterangan:ntext',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Lowker $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'code_lowker' => $model->code_lowker]);
                 }
            ],
        ],
    ]); ?>


</div>
