<?php

namespace app\controllers;

use Yii;
use app\models\Setting;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UploadForm;
use yii\web\UploadedFile;

/**
 * SettingController implements the CRUD actions for Setting model.
 */
class SettingController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
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
     * Lists all Setting models.
     *
     * @return string
     */
    public function actionIndex()
    {
        // $dataProvider = new ActiveDataProvider([
        //     'query' => Setting::find(),
        //     /*
        //     'pagination' => [
        //         'pageSize' => 50
        //     ],
        //     'sort' => [
        //         'defaultOrder' => [
        //             'id_setting' => SORT_DESC,
        //         ]
        //     ],
        //     */
        // ]);

        // return $this->render('index', [
        //     'dataProvider' => $dataProvider,
        // ]);

        return $this->redirect(['setting/update','id_setting' => 1]);
        // $model = $this->findModel(1);
        // return $this->render('update', [
        //     'model' => $model,
        // ]);
    }

    /**
     * Displays a single Setting model.
     * @param int $id_setting Id Setting
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_setting)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_setting),
        ]);
    }

    /**
     * Creates a new Setting model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Setting();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_setting' => $model->id_setting]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Setting model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_setting Id Setting
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_setting)
    {
        $model = $this->findModel($id_setting);
        
        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->file_logo = UploadedFile::getInstance($model, 'file_logo');
            $model->file_background = UploadedFile::getInstance($model, 'file_background');
            if(!empty($model->file_logo)){
                $model->file_logo->saveAs('img/' . $model->file_logo->baseName . '.' . $model->file_logo->extension);
                $model->logo = 'img/' . $model->file_logo->baseName . '.' . $model->file_logo->extension;
            }
            
            if(!empty($model->file_background)){
                $model->file_background->saveAs('img/' . $model->file_background->baseName . '.' . $model->file_background->extension);
                $model->background = 'img/' . $model->file_background->baseName . '.' . $model->file_background->extension;
            }
            if($model->save()){
                Yii::$app->session->setFlash('success','Update Setting Aplikasi Success'); 
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Setting model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_setting Id Setting
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_setting)
    {
        $this->findModel($id_setting)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Setting model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_setting Id Setting
     * @return Setting the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_setting)
    {
        if (($model = Setting::findOne(['id_setting' => $id_setting])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
