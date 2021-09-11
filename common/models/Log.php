<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%log}}".
 *
 * @property string $log_id
 * @property string|null $title
 * @property string $body
 * @property int|null $status
 * @property string|null $password_hash
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 *
 * @property User $createdBy
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%log}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['log_id', 'body'], 'required'],
            [['body'], 'string'],
            [['status', 'created_at', 'updated_at', 'created_by'], 'default', 'value' => null],
            [['status', 'created_at', 'updated_at', 'created_by'], 'integer'],
            [['log_id'], 'string', 'max' => 512],
            [['title'], 'string', 'max' => 200],
            [['password_hash'], 'string', 'max' => 255],
            [['log_id'], 'unique'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'log_id' => 'Log ID',
            'title' => 'Title',
            'body' => 'Body',
            'status' => 'Status',
            'password_hash' => 'Password Hash',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\LogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\LogQuery(get_called_class());
    }
}
