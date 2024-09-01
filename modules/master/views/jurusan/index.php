<?php

use app\modules\master\models\Jurusan;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\modules\master\models\JurusanSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Jurusans');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurusan-index">
    <p>
        <?= Html::a(Yii::t('app', 'Create Jurusan'), ['create'], ['class' => 'btn btn-sm btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'headerOptions' => ['style' => 'width: 80px;'],
                'class' => 'yii\grid\SerialColumn'
            ],
            [
                'headerOptions' => ['style' => 'width:200px;'],
                'attribute' =>  'code',
            ],
            'nama',
            [
                'headerOptions' => ['style' => 'width:130px;'],
                'attribute' => 'status_data',
                'filter' => [1=>'Active',0  => 'Non Active'],
                'value' => function($model){
                    return ($model->status_data == 1) ? 'Active' : 'Non Active';
                },
            ],
            // 'created_by',
            // 'created_at',
            //'updated_by',
            //'updated_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} ',
                'buttons' => [
                    'view' => function($url, $model){
                        return HTML::a("<span class='fas fa-eye'></span>", Url::toRoute(['view', 'code' => $model->code]),[
                            'class' => 'btn btn-info btn-xs',
                        ]);
                    },
                    'update' => function($url, $model){
                            return HTML::a("<span class='fas fa-pencil-alt'></span>",Url::toRoute(['update', 'code' => $model->code]), [
                                'class' => 'btn btn-warning btn-xs',
                                'title' => 'Update',
                            ]);
                    },
                    'delete' => function($url, $model){
                        return Html::a("<span class='fas fa-trash'></span>", '#', [
                            'class' => 'btn btn-danger btn-xs',
                            'onclick' => "
                            if (confirm('Are you sure ?')) {
                                $.ajax('".Url::toRoute(['delete', 'code' => $model->code])."', {
                                    type: 'POST'
                                }).done(function(data) {
                                    $.pjax.reload({container: '#list_bast_checkin'});
                                });
                            }
                            return false;
                            ",
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
