<?php

use app\models\Menu;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\MenuSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Menus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Menu', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'table-responsive',
            'style' => 'font-size: 14px;max-height: 500px;'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_menu',
            'nama',
            [
                'attribute' => 'id_header',
                'label' => 'Header Menu',
                'value' => function($model){
                    return !empty($model->getHeader()->nama) ? $model->getHeader()->nama : '';
                }
            ],
            'level',
            'urutan',
            //'posisi',
            //'read',
            //'create',
            //'update',
            //'delete',
            //'akses_menu',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} ',
                'buttons' => [
                    'view' => function($url, $model){
                        return HTML::a("<span class='fas fa-eye'></span>", Url::toRoute(['view', 'id_menu' => $model->id_menu]),[
                            'class' => 'btn btn-info btn-xs',
                        ]);
                    },
                    'update' => function($url, $model){
                            return HTML::a("<span class='fas fa-pencil-alt'></span>",Url::toRoute(['update', 'id_menu' => $model->id_menu]), [
                                'class' => 'btn btn-warning btn-xs',
                                'title' => 'Update',
                            ]);
                    },
                    'delete' => function($url, $model){
                        return Html::a("<span class='fas fa-trash'></span>", '#', [
                            'class' => 'btn btn-danger btn-xs',
                            'onclick' => "
                            if (confirm('Are you sure ?')) {
                                $.ajax('".Url::toRoute(['delete', 'id_menu' => $model->id_menu])."', {
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
