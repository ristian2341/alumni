<?php

use app\models\MenuUser;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\MenuUserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Menu Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Menu User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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

            'id_user_menu',
            'user_id',
            'id_menu',
            'create',
            'update',
            //'read',
            //'delete',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, MenuUser $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_user_menu' => $model->id_user_menu]);
                 }
            ],
        ],
    ]); ?>


</div>
