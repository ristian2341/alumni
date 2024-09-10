<?php

use app\modules\magang\models\JawabanKuisioner;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\modules\magang\models\JawabanKuisionerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Jawaban Kuisioners';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jawaban-kuisioner-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'headerOptions' => ['style' => 'width: 100px;'],
                'class' => 'yii\grid\SerialColumn'
            ],
            [
                'headerOptions' => ['style' => 'width: 200px;'],
                'attribute' => 'code',
            ],
            [
                'headerOptions' => ['style' => 'width: 250px;'],
                'attribute' => 'nisn',
            ],
            'nama',
            [
                'headerOptions' => ['style' => 'width: 180px;'],
                'attribute'=>'status_data',
                'filter' => [0 => 'Unpost',1 => 'Post'],
                'value' => function($model){
                    return ($model->status_data == 1) ? 'Post' : 'Unpost';
                }
            ],
            // 'created_at',
            // 'created_by',
            //'updated_at',
            //'updated_by',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} ',
                'buttons' => [
                    'view' => function($url, $model){
                        return HTML::a("<span class='fas fa-eye'></span>", Url::toRoute(['view', 'code' => $model->code]),[
                            'class' => 'btn btn-info btn-xs',
                        ]);
                    },
                    'update' => function($url, $model){
                        if(!empty(Yii::$app->user->identity->developer) || !empty(Yii::$app->user->identity->getMenu('magang')->update)){
                            return HTML::a("<span class='fas fa-pencil-alt'></span>",Url::toRoute(['update', 'code' => $model->code]), [
                                'class' => 'btn btn-warning btn-xs',
                                'title' => 'Update',
                            ]);
                        }
                    },
                    // 'delete' => function($url, $model){
                    //     if(!empty(Yii::$app->user->identity->developer) || !empty(Yii::$app->user->identity->getMenu('magang')->delete)){
                    //         return Html::a("<span class='fas fa-trash'></span>", '#', [
                    //             'class' => 'btn btn-danger btn-xs',
                    //             'onclick' => "
                    //             if (confirm('Are you sure ?')) {
                    //                 $.ajax('".Url::toRoute(['delete', 'code' => $model->code])."', {
                    //                     type: 'POST'
                    //                 }).done(function(data) {
                    //                     $.pjax.reload({container: '#list_bast_checkin'});
                    //                 });
                    //             }
                    //             return false;
                    //             ",
                    //         ]);
                    //     }
                    // },
                ],
                'contentOptions'=> [
                    'style'=>'width: 150px'
                ],
            ],  
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
