<?php

namespace humanized\useraccesstoken\models;

use Yii;

/**
 * This is the model class for table "user_access_token".
 *
 * @property integer $id
 * @property string $type
 * @property integer $user_id
 * @property string $token
 */
class UserAccessToken extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_access_token';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $userClass = Yii::$app->user->identityClass;
        return [
            [['type'], 'string'],
            [['type'], 'in', 'range' => ['default', 'facebook', 'google', 'live'],], //Todo: sync from config
            [['user_id'], 'integer'],
            [['token'], 'required'],
            [['token'], 'string', 'max' => 64],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => $userClass::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'user_id' => Yii::t('app', 'User ID'),
            'token' => Yii::t('app', 'Token'),
        ];
    }

}
