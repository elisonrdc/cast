<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Categoria */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="categoria-form">

    <?php $form = ActiveForm::begin([
        'id' => 'categoria-form',
        'enableAjaxValidation' => true,
        'validateOnBlur' => false,
        'validateOnChange' => false,
    ]); ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
