<?php

use app\models\GroupMenu;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\GroupMenuSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Group Menus');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-menu-index">
    <p>
        <?= Html::a(Yii::t('app', 'Create Group Menu'), ['create'], ['class' => 'btn btn-sm btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'nama',
            [
                'attribute' => 'status',
                'filter' => [1 => "Active",0 => "Non Active"],
                'value' => function($model){
                    return $model->status == 1 ? "Active" : "Non Active";
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
                            return HTML::a("<span class='fas fa-pencil-alt'></span>",Url::toRoute(['update', 'id' => $model->id]), [
                                'class' => 'btn btn-warning btn-xs',
                                'title' => 'Update',
                            ]);
                    },
                    'delete' => function($url, $model){
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
                    },
                ],
                'contentOptions'=> [
                    'style'=>'width: 150px'
                ],
            ],
        ],
    ]); ?>


</div>
