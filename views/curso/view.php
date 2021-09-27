<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Curso */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cursos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="curso-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_categoria',
            'descricao',
            'data_inicio:date',
            'data_fim:date',
            'qtd_alunos_turma',
        ],
    ]) ?>

</div>
