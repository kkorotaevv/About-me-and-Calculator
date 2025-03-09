<?php

namespace app\controllers;

use app\components\calculator\CalculationResultsService;
use yii\web\Controller;
use yii\web\ErrorAction;
use app\models\calculation\CalculationForm;
use app\models\calculation\CalculationRepository;
use Yii;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = 'blanc';

        return $this->render('index');
    }

    public function actionCalculator()
    {
        $model = new CalculationForm();

        $repository = new CalculationRepository(Yii::$app->params['lists'], Yii::$app->params['prices']);

        $showResult = false;

        if($model->load(Yii::$app->request->post()) && $model->validate()) {
            (new CalculationResultsService($repository))->handle($model);
            if($repository->isPriceExists($model->month, $model->tonnage, $model->type) === True) {
                $showResult = true;
            }
            if($showResult === false) {
                Yii::$app->session->setFlash('price_error', 'Стоймость для указанных параметров отсутствует');
                Yii::$app->response->statusCode = 404;
            }
        }

        return $this->render('calculator', compact('model', 'repository', 'showResult'));
    }
}
