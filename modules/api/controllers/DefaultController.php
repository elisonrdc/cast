<?php

namespace app\modules\api\controllers;

use yii\web\Controller;

class DefaultController extends Controller {

    public function actionIndex() {
        $this->layout = false;
        return '';//$this->render('index');
    }
}