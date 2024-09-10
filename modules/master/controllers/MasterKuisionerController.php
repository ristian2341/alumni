<?php

namespace app\modules\master\controllers;

use Yii;
use app\modules\master\models\MasterKuisioner;
use app\modules\master\models\MasterKuisionerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use app\models\User;
/**
 * MasterKuisionerController implements the CRUD actions for MasterKuisioner model.
 */
class MasterKuisionerController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        if(empty(Yii::$app->user->identity)){
            return $this->redirect(['site/login']);
        }
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' =>  (!empty(Yii::$app->user->identity->developer)  || !empty(Yii::$app->user->identity->getMenu('master-kuisioner')->create)),
                        'actions' => ['create'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => (!empty(Yii::$app->user->identity->developer)  || !empty(Yii::$app->user->identity->getMenu('master-kuisioner')->read)),
                        'actions' => ['index', 'view'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => (!empty(Yii::$app->user->identity->developer)  || !empty(Yii::$app->user->identity->getMenu('master-kuisioner')->update)),
                        'actions' => ['update'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => (!empty(Yii::$app->user->identity->developer)  || !empty(Yii::$app->user->identity->getMenu('master-kuisioner')->delete)),
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
     * Lists all MasterKuisioner models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MasterKuisionerSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MasterKuisioner model.
     * @param string $code Code
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($code)
    {
        return $this->render('view', [
            'model' => $this->findModel($code),
        ]);
    }

    /**
     * Creates a new MasterKuisioner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new MasterKuisioner();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $success = true;$message = "";
                $conn = Yii::$app->db;
                $trans = $conn->beginTransaction();
                try {
                    if ($model->load($this->request->post())){
                        $model->code = $model->getCode();
                        $model->status_data = 1;                       
                        if(!$model->save()){
                            $success = false;
                            $message .= (count($model->errors) > 0) ? 'ERROR Create Jurusan: ' : '';
                            foreach ($model->errors as $key => $val) {
                                $message .= $value[0].', ';
                            }
                        }

                        if($success){
                            $trans->commit();
                            Yii::$app->session->setFlash('success',"Input Jurusan Success"); 
                            return $this->redirect(['view', 'code' => $model->code]);
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
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MasterKuisioner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $code Code
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($code)
    {
        $model = $this->findModel($code);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'code' => $model->code]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MasterKuisioner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $code Code
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($code)
    {
        $this->findModel($code)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the MasterKuisioner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $code Code
     * @return MasterKuisioner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($code)
    {
        if (($model = MasterKuisioner::findOne(['code' => $code])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
