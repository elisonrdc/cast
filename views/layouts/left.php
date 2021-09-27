<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Categorias', 'icon' => 'circle-o', 'url' => ['/categoria']],
                    ['label' => 'Cursos', 'icon' => 'circle-o', 'url' => ['/curso']],
                    ['label' => 'Alunos', 'icon' => 'circle-o', 'url' => ['/aluno']],
                    //['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                ]
            ]
        ) ?>

    </section>

</aside>
