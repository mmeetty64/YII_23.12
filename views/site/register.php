<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var ActiveForm $form */
$this->title = 'Логин';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-register">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
    'id' => 'register-form',
    ]); ?>

        <?= $form->field($model, 'fio') ?>
        <?= $form->field($model, 'login', ['enableAjaxValidation' => true]) ?>
        <?= $form->field($model, 'email', ['enableAjaxValidation' => true]) ?>
        <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::class, [
            'mask' => '+7 (999) 999-99-99',
        ]) ?>
        <?= $form->field($model, 'password')->passwordInput() ?>   
        <?= $form->field($model, 'password_repeat')->passwordInput() ?>
        <?= $form->field($model, 'check')->checkbox() ?>
    
        <div class="form-group">
            <?= Html::submitButton('Зарегестрироваться', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-register -->
