<?php

use app\models\StatusSiswa;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\StatusSiswaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Status Siswas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-siswa-index">

    <p>
        <?= Html::a(Yii::t('app', 'Create Status Siswa'), ['create'], ['class' => 'btn btn-sm btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            'status',
            [
                'headerOptions' => ['style' => 'width:130px;'],
                'attribute' => 'status_data',
                'filter' => [1 => 'Active', 0 => 'Non Active'],
                'value' => function($model){
                    return ($model->status_data == 1) ? 'Active' : 'Non Active';
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} ',
                'buttons' => [
                    'view' => function($url, $model){
                        return HTML::a("<span class='fas fa-eye'></span>", Url::toRoute(['view', 'id' => $model->id]),[
                            'class' => 'btn btn-info btn-xs',
                        ]);
                    },
                    'update' => function($url, $model){
                        if(!empty(Yii::$app->user->identity->developer) || !empty(Yii::$app->user->identity->getMenu('status_siswa')->update)){
                            return HTML::a("<span class='fas fa-pencil-alt'></span>",Url::toRoute(['update', 'id' => $model->id]), [
                                'class' => 'btn btn-warning btn-xs',
                                'title' => 'Update',
                            ]);
                        }
                    },
                    'delete' => function($url, $model){
                        if(!empty(Yii::$app->user->identity->developer) || !empty(Yii::$app->user->identity->getMenu('status_siswa')->update)){
                            return Html::a("<span class='fas fa-trash'></span>", '#', [
                                'class' => 'btn btn-danger btn-xs',
                                'onclick' => "
                                if (confirm('Are you sure ?')) {
                                    $.ajax('".Url::toRoute(['delete', 'id' => $model->id])."', {
                                        type: 'POST'
                                    }).done(function(data) {
                                        $.pjax.reload({container: '#list_bast_checkin'});
                                    });
                                }
                                return false;
                                ",
                            ]);
                        }
                    },
                ],
                'contentOptions'=> [
                    'style'=>'width: 150px'
                ],
            ],
        ],
    ]); ?>


</div>
