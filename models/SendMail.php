<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "send_mail".
 *
 * @property int $code
 * @property string|null $type_email
 * @property string|null $subject
 * @property string $from
 * @property string $to
 * @property string|null $cc
 * @property string|null $bcc
 * @property string|null $body
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $created_by
 * @property string|null $updated_by
 */
class SendMail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'send_mail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['from', 'to'], 'required'],
            [['body'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['type_email', 'from'], 'string', 'max' => 150],
            [['subject'], 'string', 'max' => 255],
            [['to'], 'string', 'max' => 250],
            [['cc', 'bcc'], 'string', 'max' => 200],
            [['created_by', 'updated_by'], 'string', 'max' => 16],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Code',
            'type_email' => 'Type Email',
            'subject' => 'Subject',
            'from' => 'From',
            'to' => 'To',
            'cc' => 'Cc',
            'bcc' => 'Bcc',
            'body' => 'Body',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
