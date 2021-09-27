<?php

use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Aluno */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="aluno-form">

    <?php $form = ActiveForm::begin([
        'id' => 'aluno-form',
        'enableAjaxValidation' => true,
        'validateOnBlur' => false,
        'validateOnChange' => false,
    ]); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'matricula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefone')->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => ['(99) 9999-9999', '(99) 99999-9999'],
        'clientOptions' => ['clearIncomplete' => true]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
