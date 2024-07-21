<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\UploadForm;
use yii\web\UploadedFile;

use app\models\User;
use app\models\Menu;

// add modal setting //
use app\models\Setting;
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
				'only' => ['logout','index','contact','about'],
                'rules' => [
                    [
                        'actions' => ['logout','index','contact','about'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['profile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        /* setting menu user */
        if(Yii::$app->user->id){
            if(!Yii::$app->user->identity->developer){
                $menu = Menu::find()->where(['user_id' => Yii::$app->user->id])->all();
            }else{
                $menu = Menu::find()->where(['user_id' => Yii::$app->user->id])->all();

            }
        }
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
		
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
		$model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

		$setting = Setting::find()->where(['id_setting' => 1])->one();
		$this->layout = 'main-login';
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
			'setting' => $setting,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionProfile()
    {
        $message = "";$success = true;
        $model = User::find()->where(['user_id' => Yii::$app->user->identity->user_id])->one();
       
        if($model->load(Yii::$app->request->post())) {
          
            if(!empty($model->password_old) && !empty($model->password_new)){               
                $model->password = Yii::$app->getSecurity()->generatePasswordHash($model->password_new);
            }  
            $model->file = UploadedFile::getInstance($model, 'file');
            if(!empty($model->file)){
                $model->file->saveAs('img/user_picture/' . $model->file->baseName . '.' . $model->file->extension);
                $model->picture = 'img/user_picture/' . $model->file->baseName . '.' . $model->file->extension;
            }

            if($success){
                if(!$model->save()){
                    Yii::$app->session->setFlash('error', "Save profile error.");
                }else{
                    Yii::$app->session->setFlash('success', "Save profile Success.");
                }
            }
            return $this->refresh();
        }
        return $this->render('profile', [
            'model' => $model,
        ]);
    }
}
