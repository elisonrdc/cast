<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Aluno */

$this->title = 'Create Aluno';
$this->params['breadcrumbs'][] = ['label' => 'Alunos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aluno-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
