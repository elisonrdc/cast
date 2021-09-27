<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Curso */

$this->title = 'Create Curso';
$this->params['breadcrumbs'][] = ['label' => 'Cursos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curso-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
