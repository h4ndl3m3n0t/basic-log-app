<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Reset password';
?>
<div class="site-reset-password">

    <div class="row justify-content-center pt-2">
        <div class="col-lg-5">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>Please choose your new password:</p>
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'confirm_password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
