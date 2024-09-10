<?php

use app\modules\master\models\MasterKuisioner;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\modules\master\models\MasterKuisionerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Master Kuisioners';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-kuisioner-index">

    <p>
        <?= Html::a('Create Master Kuisioner', ['create'], ['class' => 'btn btn-sm btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'headerOptions' => ['style' => 'width:150px;'],
                'attribute' =>  'code',
            ],
           
            'code_jurusan',
            'type',
            'pertanyaan',
            // 'created_at',
            [
                'attribute' => 'created_by',
                'value' => function($model){
                    return !empty($model->getCreated()) ? $model->getCreated(): $model->created_by;
                }
            ],
            [
                'attribute' => 'updated_by',
                'value' => function($model){
                    return !empty($model->getUpdated()) ? $model->getUpdated(): $model->updated_by;
                }
            ],
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
