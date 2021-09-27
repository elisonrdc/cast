<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CursoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cursos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curso-index">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Filtros</h3>
        </div>
        <div class="panel-body">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
    </div>

    <?= GridView::widget([
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => 'Listagem',
            'after' => false,
        ],
        'toolbar' => [
            [
                'content' => Html::button('<span class="fa fa-plus"></span> Criar Curso', [
                    'value' => Url::to(['curso/create']),
                    'class' => 'btn btn-success btn-modal-gridview',
                    'data-title_modal' => 'Criar',
                ]),
            ],
            '{toggleData}',
            '{export}'
        ],
        'dataProvider' => $dataProvider,
        'responsiveWrap' => true,
        'pager' => [
            'prevPageLabel' => '<',
            'nextPageLabel' => '>',
            'firstPageLabel' => '<<',
            'lastPageLabel' => '>>',
            'maxButtonCount' => 3
        ],
        'columns' => [
            'id',
            [
                'label' => $searchModel->getAttributeLabel('id_categoria'),
                'attribute' => 'categoria.descricao',
            ],
            'descricao',
            'data_inicio:date',
            'data_fim:date',
            'qtd_alunos_turma',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Ações',
                'headerOptions' => ['style' => 'width:150px; text-align: center;'],
                'contentOptions' => ['style' => 'white-space: normal; text-align: center;'],
                'template' => '{view} {update} {delete}',
                'urlCreator' => function($action, $model, $key, $index) {
                    return Url::to([$action,'id' => $key]);
                },
                'buttons' => [
                    'view' => function($url, $model, $key) {
                        return Html::button('<span class="fa fa-eye"></span>', [
                            'value' => $url,
                            'class' => 'btn btn-success btn-sm btn-modal-gridview',
                            'title' => 'Visualizar',
                            'data-title_modal' => 'Visualizar',
                        ]);
                    },
                    'update' => function($url, $model, $key) {
                        return Html::button('<span class="fa fa-edit"></span>', [
                            'value' => $url,
                            'class' => 'btn btn-primary btn-sm btn-modal-gridview',
                            'title' => 'Editar',
                            'data-title_modal' => 'Editar',
                        ]);
                    },
                    'delete' => function($url, $model, $key) {
                        return Html::button('<span class="fa fa-trash"></span>', [
                            'value' => $url,
                            'class' => 'btn btn-danger btn-sm btn-delete-gridview',
                            'title' => 'Excluir'
                        ]);
                    },
                ],
            ]
        ],
    ]); ?>

</div>
