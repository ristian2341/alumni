<?php

use app\models\Perusahaan;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\PerusahaanSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Perusahaans');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perusahaan-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a(Yii::t('app', 'Create Perusahaan'), ['create'], ['class' => 'btn btn-sm btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
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
            // 'id_perusahaan',
            'nama',
            // 'alamat',
            // 'kota',
            // 'propinsi',
            'email:email',
            'phone',
            'pic1',
            'email_pic1:email',
            'pic2',
            // 'phone_pic2',
            // 'email_pic2:email',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} ',
                'buttons' => [
                    'view' => function($url, $model){
                        return HTML::a("<span class='fas fa-eye'></span>", Url::toRoute(['view', 'id_perusahaan' => $model->id_perusahaan]),[
                            'class' => 'btn btn-info btn-xs',
                        ]);
                    },
                    'update' => function($url, $model){
                        if(!empty(Yii::$app->user->identity->developer) || !empty(Yii::$app->user->identity->getMenu('perusahaan')->update)){
                            return HTML::a("<span class='fas fa-pencil-alt'></span>",Url::toRoute(['update', 'id_perusahaan' => $model->id_perusahaan]), [
                                'class' => 'btn btn-warning btn-xs',
                                'title' => 'Update',
                            ]);
                        }
                    },
                    'delete' => function($url, $model){
                        if(!empty(Yii::$app->user->identity->developer) || !empty(Yii::$app->user->identity->getMenu('perusahaan')->delete)){
                            return Html::a("<span class='fas fa-trash'></span>", '#', [
                                'class' => 'btn btn-danger btn-xs',
                                'onclick' => "
                                if (confirm('Are you sure ?')) {
                                    $.ajax('".Url::toRoute(['delete', 'id_perusahaan' => $model->id_perusahaan])."', {
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
