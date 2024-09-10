<?php

use app\models\SendMail;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\SendMailSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Send Mails';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="send-mail-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Send Mail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'code',
            'type_email:email',
            'subject',
            'from',
            'to',
            //'cc',
            //'bcc',
            //'body:ntext',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, SendMail $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'code' => $model->code]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
