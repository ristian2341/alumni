<?php

namespace app\controllers;

use Yii;
use app\models\GroupMenu;
use app\models\GroupMenuDetail;
use app\models\Menu;
use app\models\GroupMenuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * GroupMenuController implements the CRUD actions for GroupMenu model.
 */
class GroupMenuController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        if(!isset(Yii::$app->user->identity)){
            return $this->redirect(['site/login']);
        }
        return array_merge(
            parent::behaviors(),
            [
               'access' => [
                'class' => AccessControl::class,
                'rules' => [
                        [
                            'allow' => !empty(Yii::$app->user->identity->developer)  || !empty(Yii::$app->user->identity->getMenu('group_menu')->create),
                            'actions' => ['create'],
                            'roles' => ['@'],
                        ],
                        [
                            'allow' => !empty(Yii::$app->user->identity->developer)  || !empty(Yii::$app->user->identity->getMenu('group_menu')->read),
                            'actions' => ['index', 'view'],
                            'roles' => ['@'],
                        ],
                        [
                            'allow' => !empty(Yii::$app->user->identity->developer)  || !empty(Yii::$app->user->identity->getMenu('group_menu')->update),
                            'actions' => ['update'],
                            'roles' => ['@'],
                        ],
                        [
                            'allow' => !empty(Yii::$app->user->identity->developer)  || !empty(Yii::$app->user->identity->getMenu('group_menu')->delete),
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
            ]
        );
    }

    /**
     * Lists all GroupMenu models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new GroupMenuSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GroupMenu model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new GroupMenu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new GroupMenu();

        if ($this->request->isPost) {
            $success = true; $message = "";
            $conn = Yii::$app->db;
            $trans = $conn->beginTransaction();
            try {
                
                if ($model->load($this->request->post())) {
                    if(!$model->save()){
                        $success = false;
                        $message .= (count($model->errors) > 0) ? 'ERROR Create Kasbon: ' : '';
                        foreach ($model->errors as $key => $val) {
                            $message .= $value[0].', ';
                        }
                    }

                    // get data menu //
                    $menu = Menu::find()->all();
                    if(!empty($menu)){
                        foreach ($menu as $key => $val) {
                            if(isset($_POST['menu'][$val->id_menu])){
                                $modelDetail = new GroupMenuDetail();
                                $modelDetail->id_group = $model->id;
                                $modelDetail->id_menu = isset($_POST['menu'][$val->id_menu]) ? $_POST['menu'][$val->id_menu] : '';
                                $modelDetail->read = isset($_POST['view'][$val->id_menu]) ? $_POST['view'][$val->id_menu] : 0;
                                $modelDetail->create = isset($_POST['create'][$val->id_menu]) ? $_POST['create'][$val->id_menu] : 0;
                                $modelDetail->update = isset($_POST['update'][$val->id_menu]) ? $_POST['update'][$val->id_menu] : 0;
                                $modelDetail->delete = isset($_POST['delete'][$val->id_menu]) ? $_POST['delete'][$val->id_menu] : 0;
                                if(!$modelDetail->save()){
                                    $success = false;
                                    $message .= (count($modelDetail->errors) > 0) ? 'ERROR Create Kasbon: ' : '';
                                    foreach ($modelDetail->errors as $key => $val) {
                                        $message .= $value[0].', ';
                                    }
                                }
                            }
                        }
                    }

                    if($success){
                        $trans->commit();
                        Yii::$app->session->setFlash('success',"Input Lowongan Kerja Success"); 
                        return $this->redirect(['view', 'id' => $model->id]);
                    }else{
                        $trans->rollBack();
                        Yii::$app->session->setFlash('error',$message); 
                    }
                }
            } catch (\Exception $e) {
                $trans->rollBack();
                Yii::$app->session->setFlash('error',$e->getMessage());
            }
        } else {
            $model->loadDefaultValues();
        }

        $menu = Menu::find()->all();
        $detail = $this->renderPartial("table_detail",[
            'menu' => $menu,
        ]);

        return $this->render('create', [
            'model' => $model,
            'detail' => $detail
        ]);
    }

    /**
     * Updates an existing GroupMenu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) 
        {
            $success = true; $message = "";
            $conn = Yii::$app->db;
            $trans = $conn->beginTransaction();
            try {
                
                if ($model->load($this->request->post())) {
                    if(!$model->save()){
                        $success = false;
                        $message .= (count($model->errors) > 0) ? 'ERROR Create Kasbon: ' : '';
                        foreach ($model->errors as $key => $val) {
                            $message .= $value[0].', ';
                        }
                    }

                    // hapus data Group Menu Detail //
                    GroupMenuDetail::deleteAll(['id_group' => $model->id]);
                    // get data menu //
                    $menu = Menu::find()->all();
                    if(!empty($menu)){
                        foreach ($menu as $key => $val) {
                            if(isset($_POST['menu'][$val->id_menu])){
                                $modelDetail = new GroupMenuDetail();
                                $modelDetail->id_group = $model->id;
                                $modelDetail->id_menu = isset($_POST['menu'][$val->id_menu]) ? $_POST['menu'][$val->id_menu] : '';
                                $modelDetail->read = isset($_POST['view'][$val->id_menu]) ? $_POST['view'][$val->id_menu] : 0;
                                $modelDetail->create = isset($_POST['create'][$val->id_menu]) ? $_POST['create'][$val->id_menu] : 0;
                                $modelDetail->update = isset($_POST['update'][$val->id_menu]) ? $_POST['update'][$val->id_menu] : 0;
                                $modelDetail->delete = isset($_POST['delete'][$val->id_menu]) ? $_POST['delete'][$val->id_menu] : 0;
                                if(!$modelDetail->save()){
                                    $success = false;
                                    $message .= (count($modelDetail->errors) > 0) ? 'ERROR Create Kasbon: ' : '';
                                    foreach ($modelDetail->errors as $key => $val) {
                                        $message .= $value[0].', ';
                                    }
                                }
                            }
                        }
                    }

                    if($success){
                        $trans->commit();
                        Yii::$app->session->setFlash('success',"Input Lowongan Kerja Success"); 
                        return $this->redirect(['view', 'id' => $model->id]);
                    }else{
                        $trans->rollBack();
                        Yii::$app->session->setFlash('error',$message); 
                    }
                }
            } catch (\Exception $e) {
                $trans->rollBack();
                Yii::$app->session->setFlash('error',$e->getMessage());
            }
        }

        $menu = Menu::find()->all();
        $detail = $this->renderPartial("table_detail",[
            'menu' => $menu,
            'id_group' => $id,
        ]);

        return $this->render('update', [
            'model' => $model,
            'detail' => $detail,
        ]);
    }

    /**
     * Deletes an existing GroupMenu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = 0;
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GroupMenu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return GroupMenu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GroupMenu::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
