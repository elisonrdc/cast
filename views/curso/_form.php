<?php

use kartik\widgets\Select2;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Curso */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="curso-form">

    <?php $form = ActiveForm::begin([
        'id' => 'curso-form',
        'enableAjaxValidation' => true,
        'validateOnBlur' => false,
        'validateOnChange' => false,
    ]); ?>

    <?= $form->field($model, 'id_categoria')->widget(Select2::className(), [
        'data' => ArrayHelper::map(\app\models\Categoria::find()->orderBy('descricao')->all(), 'id', 'descricao'),
        'theme' => Select2::THEME_DEFAULT,
        'options' => [
            'placeholder' => ''
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'descricao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_inicio')->widget(jino5577\daterangepicker\DateRangePicker::className(), [
        'locale' => 'pt-br',
        'pluginOptions' => [
            'autoUpdateInput' => false,
            'singleDatePicker' => true,
            'autoApply' => true,
            'showDropdowns' => true,
            'locale' => [
                'customRangeLabel' => 'Personalizado',
                'applyLabel' => 'Aplicar',
                'cancelLabel' => 'Cancelar',
            ]
        ],
        'maskOptions' => [
            'mask' => '99/99/9999',
            'clientOptions' => ['clearIncomplete' => true]
        ],
    ]) ?>

    <?= $form->field($model, 'data_fim')->widget(jino5577\daterangepicker\DateRangePicker::className(), [
        'locale' => 'pt-br',
        'pluginOptions' => [
            'autoUpdateInput' => false,
            'singleDatePicker' => true,
            'autoApply' => true,
            'showDropdowns' => true,
            'locale' => [
                'customRangeLabel' => 'Personalizado',
                'applyLabel' => 'Aplicar',
                'cancelLabel' => 'Cancelar',
            ]
        ],
        'maskOptions' => [
            'mask' => '99/99/9999',
            'clientOptions' => ['clearIncomplete' => true]
        ],
    ]) ?>

    <?= $form->field($model, 'qtd_alunos_turma')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
