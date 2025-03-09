<?php

namespace app\controllers\api\v1;

class PricesController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;

    public function behaviors(): array
    {
        return [
            'class' => \app\components\filters\TokenAuthMiddleware::class,
            'verbFilter' => [
                'class' => \yii\filters\VerbFilter::class,
                'actions' => [
                    'index' => ['GET'],
                ],
            ],
        ];
    }

    public function actionIndex(): array
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (isset(\Yii::$app->params['prices'][$_GET['type']][$_GET['month']][$_GET['tonnage']])) {
            return [
                'price' => \Yii::$app->params['prices'][$_GET['type']][$_GET['month']][$_GET['tonnage']],
                'price_list' => [$_GET['type'] => 
                    \Yii::$app->params['prices'][$_GET['type']]]
            ];
        } else {
            return [
                'error' => 'Стоимость для выбранных параметров отсутствует'
            ];
        }
    }
}