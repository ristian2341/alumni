<?php


use app\modules\magang\models\Magang;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\modules\magang\models\MagangSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Magangs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="magang-index">

    <p>
        <?= Html::a('Create Magang', ['create'], ['class' => 'btn btn-sm btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'headerOptions' => ['style' => 'width: 50px;'],
                'class' => 'yii\grid\SerialColumn'
            ],
            [
                'headerOptions' => ['style' => 'width: 180px;'],
                'attribute'=>'code'
            ],
            [
                'attribute'=>'nama_perusahaan',
            ],
            [
                'attribute'=>'pic',
                'headerOptions' => ['style' => 'width: 350px;'],
            ],
            [
                'attribute'=>'tgl_mulai',
                'headerOptions' => ['style' => 'width: 150px;'],
                'value' => function($model){
                   return isset($model->tgl_mulai) ? date('d M Y',strtotime($model->tgl_mulai)) : '';
                },
            ],
            [
                'attribute'=>'tgl_akhir',
                'headerOptions' => ['style' => 'width: 150px;'],
                'value' => function($model){
                   return isset($model->tgl_akhir) ? date('d M Y',strtotime($model->tgl_akhir)) : '';
                },
            ],
            [
                'label'=>'Jumlah Siswa',
                'headerOptions' => ['style' => 'width: 150px;color:#007bff;'],
                'value' => function($model){
                   return isset($model->dataDetail) ? count($model->dataDetail) : 0;
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
                    'update' => function($url, $model){
                        if(!empty(Yii::$app->user->identity->developer) || !empty(Yii::$app->user->identity->getMenu('magang')->update)){
                            return HTML::a("<span class='fas fa-pencil-alt'></span>",Url::toRoute(['update', 'code' => $model->code]), [
                                'class' => 'btn btn-warning btn-xs',
                                'title' => 'Update',
                            ]);
                        }
                    },
                    'delete' => function($url, $model){
                        if(!empty(Yii::$app->user->identity->developer) || !empty(Yii::$app->user->identity->getMenu('magang')->delete)){
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
                        }
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
