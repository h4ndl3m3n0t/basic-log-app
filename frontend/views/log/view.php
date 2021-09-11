<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Log */

$this->title = $model->title;
\yii\web\YiiAsset::register($this);
?>
<div class="log-view pt-5">

    <h2><?= Html::encode($this->title) ?></h2>
    <h6><?= Yii::$app->formatter->asDateTime($model->created_at) ?></h6>
    <div class="d-flex justify-content-center">
        <p>
            <?= Html::encode($model->body) ?>
        </p>
    </div>
    <div>
        <p>
            <?= Html::a('Delete', ['delete', 'log_id' => $model->log_id], [
                'class' => 'btn btn-danger btn-block',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this log?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    </div>

</div>
