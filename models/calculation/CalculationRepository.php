<?php

namespace app\models\calculation;

class CalculationRepository 
{
    public function __construct
    (
        private array $listConfig,
        private array $pricesConfig
    ){
        
    }

    public function getMonths(): array 
    {
        return $this->listConfig['months'];
    }

    public function getTonnage(): array 
    {
        return $this->listConfig['tonnages'];
    }

    public function getType(): array 
    {
        return $this->listConfig['raw_types'];
    }

    public function getPrice
    (
        string $monthName,
        int $tonnage,
        string $type
    ): int {
        return $this->pricesConfig[$type][$monthName][$tonnage];
    }

    public function isPriceExists
    (
        string $monthName,
        int $tonnage,
        string $type
    ): bool {
        //dd($monthName, $tonnage, $type);
        return isset($this->pricesConfig[$type][$monthName][$tonnage]);
    }

    public function getPriceListTonnagesByRawType(string $type): array 
    {
        $firstMonth = array_key_first($this->pricesConfig[$type]);
        return array_keys($this->pricesConfig[$type][$firstMonth]);
    }

    public function getPriceListMonthsByRawType(string $type): array 
    {
        return array_keys($this->pricesConfig[$type]);
    }

    public function getPriceListPriceByRawTypeAndMonth(string $type, string $month): array 
    {
        return $this->pricesConfig[$type][$month];
    }

    public function getPriceListByRawType(string $type): array 
    {
        return $this->pricesConfig[$type];
    }
}