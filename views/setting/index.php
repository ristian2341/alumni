<?php

use app\models\Setting;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Settings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Setting', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'pager' => [
            'class' => 'yii\bootstrap4\LinkPager',
            'firstPageLabel' => 'First',
            'lastPageLabel'  => 'Last'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_setting',
            'instansi',
            'alamat_instansi',
            'kabupaten',
            'profinsi',
            //'nama_aplikasi',
            //'logo',
            //'background',
            //'icon',
            //'email_notif:email',
            //'password_email:email',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Setting $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_setting' => $model->id_setting]);
                 }
            ],
        ],
    ]); ?>


</div>
