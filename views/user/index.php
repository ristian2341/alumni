<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
    </p>

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
            'user_id',
            'nis',
            'username',
            'full_name',
            'email:email',
            'type_user',
            // 'password',
            //'type_akun',
            //'device_id',
            //'fire_base',
            //'last_login',
            //'long',
            //'lat',
            //'id_telegram',
            //'generate_code',
            //'developer',
            //'approval',
            //'admin',
            //'status',
            //'authKey',
            //'accessToken',
            //'picture',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{register} {view} {update} {delete} ',
                'buttons' => [
                    'register' => function($url, $model){
                        if(empty($model->username)){
                            return HTML::a("<span class='fas fa-paper-plane'></span>",Url::toRoute(['send-register', 'user_id' => $model->user_id]), [
                                'class' => 'btn btn-success btn-xs',
                                'title' => 'Send Register',
                            ]);
                        }
                    },
                    'view' => function($url, $model){
                        return HTML::a("<span class='fas fa-eye'></span>", Url::toRoute(['view', 'user_id' => $model->user_id]),[
                            'class' => 'btn btn-info btn-xs',
                        ]);
                    },
                    'update' => function($url, $model){
                            return HTML::a("<span class='fas fa-pencil-alt'></span>",Url::toRoute(['update', 'user_id' => $model->user_id]), [
                                'class' => 'btn btn-warning btn-xs',
                                'title' => 'Update',
                            ]);
                    },
                    'delete' => function($url, $model){
                        return Html::a("<span class='fas fa-trash'></span>", '#', [
                            'class' => 'btn btn-danger btn-xs',
                            'onclick' => "
                            if (confirm('Are you sure ?')) {
                                $.ajax('".Url::toRoute(['delete', 'user_id' => $model->user_id])."', {
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
