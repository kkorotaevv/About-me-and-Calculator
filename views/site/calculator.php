<?php 

    use app\models\calculation\CalculationForm;
    use app\models\calculation\CalculationRepository;
    use app\assets\AppAsset;
    use yii\widgets\ActiveForm;
    use yii\helpers\Html;
    use Yii;

    /** 
     * @var CalculationForm $model
     * @var CalculationRepository $repository
     * @var bool $showResult
     */
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);

    $this->title = 'Калькулятор';

    AppAsset::register($this);
?>
        <div class="container" id="main_block">
            <div class="text-center mb-4 mt-3">
                <h1>Калькулятор стоимости доставки сырья</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 border rounded-3 p-4 shadow ">
                    <?php $form = ActiveForm::begin(['id' => 'calculation-form']) ?>
                    <div class="mb-3">
                        <?= $form->field($model, 'month')->dropDownList(array_combine($repository->getMonths(), $repository->getMonths()), ['prompt' => 'Выберите значение...', 'class' => 'form-select']) ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($model, 'tonnage')->dropDownList(array_combine($repository->getTonnage(), $repository->getTonnage()), ['prompt' => 'Выберите значение...', 'class' => 'form-select']) ?>
                    </div>
                    <div class="mb-3">
                        <?= $form->field($model, 'type')->dropDownList(array_combine($repository->getType(), $repository->getType()), ['prompt' => 'Выберите значение...', 'class' => 'form-select']) ?>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-1 col-lg-11">
                            <?= Html::submitButton('Рассчитать', ['class' => 'btn btn-success']) ?>
                            <?= Html::a('Сброс', 'calculator', ['class' => 'btn btn-danger', 'type' => 'button']) ?>
                        </div>
                    </div>
                    <?php ActiveForm::end() ?>
                </div>
            </div>
            <?php if(Yii::$app->session->hasFlash('price_error') === true):?>
                <div class="row justify-content-center mt-4">
                    <div class="col-md-6">
                        <div class="alert alert-danger alert-dismissible fade show">
                            <?= Yii::$app->session->getFlash('price_error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            <?php endif ?>
            <?php if($showResult === true): ?>
            <div class="mb-4" id="result">
            <div class="row justify-content-center mt-5">
                    <div class="col-md-3 me-3">
                        <div class="card shadow-lg">
                            <div class="card-header bg-success text-white">
                                Введённые данные:
                            </div>
                            <ul class="list-group list-group-flash">
                                <li class="list-group-item"><strong>Месяц: </strong> <?= $model->month ?></li>
                                <li class="list-group-item"><strong>Тоннаж: </strong> <?= $model->tonnage ?></li>
                                <li class="list-group-item"><strong>Тип сырья: </strong> <?= $model->type ?></li>
                                <li class="list-group-item"><strong>Итог: </strong> <?= $repository->getPrice($model->month, $model->tonnage, $model->type) ?></li>
                            </ul>
                        </div>
                    </div>
                <div class="col-md-6 table-responsive border rounded-1 shadow-lg p-0">
                <table class="table table-hover table-striped text-center mb-0">

                    <thead>
                        <tr>
                            <th>Т/M</th>
                            <?php foreach ($repository->getPriceListTonnagesByRawType($model->type) as $tonnage): ?>
                                <th><?= $tonnage ?></th>
                            <?php endforeach ?>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($repository->getPriceListMonthsByRawType($model->type) as $month): ?>
                            <tr>
                                <td>
                                    <?= mb_convert_case($month, MB_CASE_TITLE, 'UTF-8') ?>
                                </td>
                                <?php foreach ($repository->getPriceListPriceByRawTypeAndMonth($model->type, $month) as $tonnage => $price): ?>

                                    <td
                                        <?php
                                            if ($model->month === $month && (int) $model->tonnage === (int) $tonnage) {
                                                echo 'class="with-border"';
                                            }
                                        ?>
                                    >
                                        <?= $price ?>
                                    </td>
                                <?php endforeach ?>
                            </tr>
                        <?php endforeach ?>
                    </tbody>

                </table>
            </div>
            </div>
                </div>
            <?php endif ?>
        </div>