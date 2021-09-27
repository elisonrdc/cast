<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AlunoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aluno-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, 'id') ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'nome') ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'matricula') ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'email') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Limpar', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
