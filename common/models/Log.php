<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\StringHelper;

/**
 * This is the model class for table "{{%log}}".
 *
 * @property string $log_id
 * @property string|null $title
 * @property string $body
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 *
 * @property User $createdBy
 */
class Log extends \yii\db\ActiveRecord
{
    const STATUS_UNLOCK = 0;
    const STATUS_LOCK = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%log}}';
    }

    /**
     * {@inheritDoc}
     */
    public function behaviors(){
        return [
            TimestampBehavior::class,
            [
                'class' => BlameableBehavior::class,
                'updatedByAttribute' => false
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['log_id', 'body'], 'required'],
            [['body'], 'string'],
            [['status'], 'default', 'value' => self::STATUS_UNLOCK],
            [['status', 'created_at', 'updated_at', 'created_by'], 'integer'],
            [['log_id'], 'string', 'max' => 512],
            [['title'], 'string', 'max' => 200],
            [['log_id'], 'unique'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'log_id' => 'Log ID',
            'title' => 'Title (optional)',
            'body' => 'Body (required)',
            'status' => 'Status',
            'created_at' => 'Created',
            'updated_at' => 'Modified',
            'created_by' => 'Created By',
        ];
    }

    public function getStatusLabels(){
        return [
            self::STATUS_LOCK => '<i class="fas fa-lock"></i> (Lock)',
            self::STATUS_UNLOCK => '<i class="fas fa-lock-open"></i> (Unlock)'
        ];
    }

    public function getLogId(){
        return StringHelper::truncate($this->log_id,25);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\LogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\LogQuery(get_called_class());
    }

    /**
     * Generate Log ID
     * @return void
     */
    public function generateLogId(){
        $this->log_id = time().'_'.Yii::$app->security->generateRandomString(255);
    }
}
