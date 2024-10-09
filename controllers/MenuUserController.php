<?php

namespace app\controllers;

use Yii;
use app\models\MenuUser;
use app\models\MenuUserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * MenuUserController implements the CRUD actions for MenuUser model.
 */
class MenuUserController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => !empty(Yii::$app->user->identity->developer)  || (!empty(Yii::$app->user->identity) && !empty(Yii::$app->user->identity->getMenu('hak_akses_user')->create)),
                        'actions' => ['create'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' =>  !empty(Yii::$app->user->identity->developer)  || (!empty(Yii::$app->user->identity) && !empty(Yii::$app->user->identity->getMenu('hak_akses_user')->read)),
                        'actions' => ['index', 'view'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' =>  !empty(Yii::$app->user->identity->developer)  || (!empty(Yii::$app->user->identity) && !empty(Yii::$app->user->identity->getMenu('hak_akses_user')->update)),
                        'actions' => ['update'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' =>  !empty(Yii::$app->user->identity->developer)  || (!empty(Yii::$app->user->identity) && !empty(Yii::$app->user->identity->getMenu('hak_akses_user')->delete)),
                        'actions' => ['delete'],
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all MenuUser models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MenuUserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MenuUser model.
     * @param int $id_user_menu Id User Menu
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_user_menu)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_user_menu),
        ]);
    }

    /**
     * Creates a new MenuUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new MenuUser();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_user_menu' => $model->id_user_menu]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MenuUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_user_menu Id User Menu
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_user_menu)
    {
        $model = $this->findModel($id_user_menu);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_user_menu' => $model->id_user_menu]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MenuUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_user_menu Id User Menu
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_user_menu)
    {
        $this->findModel($id_user_menu)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MenuUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_user_menu Id User Menu
     * @return MenuUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_user_menu)
    {
        if (($model = MenuUser::findOne(['id_user_menu' => $id_user_menu])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
