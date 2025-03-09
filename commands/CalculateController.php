<?php

/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */


namespace app\commands;

use yii\console\Controller;
use yii\helpers\Console;
use yii\console\ExitCode;
use app\components\calculator\queue\ResultRenderer;


class CalculateControler extends Controller
{

    public $month = null;
    public $type = null;
    public $tonnage = null;
    /*
    public function options($actionID): string 
    {
        return ['month'];
    }
    public function options($actionID): string 
    {
        return ['type'];
    }
    public function options($actionID): int 
    {
        return ['tonnage'];
    }
    //ФЛАГ ДЕМОНАЙЗ НУЖЕН ИЛИ НЕТ?????
    public function actionIndex($nameMonth, $quantityTonnage, $type): void
    {
        $basePath = \Yii::getAlias('@runtime') . DIRECTORY_SEPARATOR . 'queue';

        $renderer = new ResultRenderer($this);

        $this->stdout('Задачи отсутствуют. Ожидание задач' . PHP_EOL, Console::FG_CYAN);

        //ВЫВОД ОШИБКИ ЕСЛИ НЕ ОПРЕДЕЛЕНО ХРАНИЛИЩЕ
        while(true)
        {
        if (is_dir($basePath) === false) {

            $this->stdout('Хранилище задач не определено' . PHP_EOL, Console::FG_RED);

            exit(ExitCode::UNSPECIFIED_ERROR);
        }

        // ВЫВОД ОШИБОК ПРИ ОТСУТСТВИИ ОДНОГО ИЗ ПАРАМЕТРОВ
        if($nameMonth === null or $quantityTonnage === null or $type === null){
            if($nameMonth === null){
                $this->stdout('Необходимо указать месяц'. PHP_EOL, Console::FG_RED);
            }
            if($quantityTonnage === null){
                $this->stdout('Необходимо указать тоннаж'. PHP_EOL, Console::FG_RED);
            }
            if($type === null){
                $this->stdout('Необходимо указать тип сырья'. PHP_EOL, Console::FG_RED);
            }
        }

        $jobs = scandir($basePath);

        array_splice($table, 0, 2);
    
        foreach ($jobs as $job) {
            $path = $basePath . DIRECTORY_SEPARATOR . $job;

            $state = json_decode(file_get_contents($path), true);

            $renderer->render($state);

            unlink($path);
        }
        }
    }*/
}
