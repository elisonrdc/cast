<?php

use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CategoriaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categoria-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">

        <div class="col-md-2">
            <?= $form->field($model, 'id') ?>
        </div>

        <div class="col-md-3">
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
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'descricao') ?>
        </div>

        <div class="col-md-2">
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
        </div>

        <div class="col-md-2">
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
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Limpar', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
