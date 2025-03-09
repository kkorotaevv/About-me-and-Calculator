<?php
function getSelectedAtributeOnInputCondition(array $input, string $inputName, mixed $condition,bool $asInt = false): null|string 
{
    if (isset($input[$inputName]) === false) {
        return null;
    }

    $condition = $asInt === true ? (int)$condition : (string)$condition;

    if ($input[$inputName] !== $condition) {
        return null;
    }

    return 'selected';
}

function getClassForHighlighting(
    int $tablePrice,
    int $chosenPrice,
    string $tableMonth,
    string $chosenMonth
): string {
    if ($chosenPrice === $tablePrice AND $chosenMonth === $tableMonth) {
        return "width-border";
    }
    return "";
}