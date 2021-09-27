<?php

use app\utils\Utils;

/* @var $this yii\web\View */
/* @var $model app\models\Curso */

$this->title = 'Update Curso: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cursos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

if($model->data_inicio) { $model->data_inicio = Utils::getData($model->data_inicio); }
if($model->data_fim) { $model->data_fim = Utils::getData($model->data_fim); }

?>
<div class="curso-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
