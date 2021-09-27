<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categorias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-index">

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
                'content' => Html::button('<span class="fa fa-plus"></span> Criar Categoria', [
                    'value' => Url::to(['categoria/create']),
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
            'descricao',
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
