<?php

namespace app\models\calculation;

use yii\base\Model;

class CalculationForm extends Model
{

    public string|null $month = null;

    public int|null $tonnage = null;

    public string|null $type = null;

    public function attributeLabels(): array 
    {
        return [
            'month' => 'Месяц',
            'tonnage' => 'Тоннаж',
            'type' => 'Тип сырья'
        ];
    }

    public function rules(): array 
    {
        return [
            [
                [
                    'month',
                    'tonnage',
                    'type'
                ],
                'required',
                'message' => 'Ошибка поля {attribute}'
            ]
            ];
    }

}