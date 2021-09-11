<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My Logs';
?>
<div class="log-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Log', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'pager' => [
            'class' => 'yii\bootstrap4\LinkPager'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            [
                'attribute' => 'log_id',
                'content' => function($model){
                    return Html::a($model->getLogId(),[
                        'log/view',
                        'log_id' => $model->log_id
                    ],['class' => 'text-dark']);
                }
            ],
            // 'title',
            // 'body:ntext',
            // 'password_hash',
            [
                'attribute' => 'created_at',
                'content' => function($model){
                    return Yii::$app->formatter->asRelativeTime($model->created_at);
                }
            ],
            //'updated_at',
            //'created_by',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
