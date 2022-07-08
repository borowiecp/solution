<?php

function countConsBusyHours(array $arr): int
  {
    $maxConsBusyHours = 0;
    $tmpMaxConsBusyHours = 0;
    foreach ($arr as $isBusy) {

      if ($isBusy === 1) {
        $tmpMaxConsBusyHours++;

        if ($tmpMaxConsBusyHours > $maxConsBusyHours) {
          $maxConsBusyHours = $tmpMaxConsBusyHours;
        }

      } else {
        $tmpMaxConsBusyHours = 0;
      }

    }
    return $maxConsBusyHours;
}

function getConsBusyHoursWithExtraBusyHours(array $arr, int $extraBusyHours, int $currentIndex): int 
{

    for ($secondIndex = $currentIndex; $secondIndex < count($arr); $secondIndex++) { 
        if ($extraBusyHours > 0) {
            if ($arr[$secondIndex] === 0 ) {
                $arr[$secondIndex] = 1;
                $extraBusyHours--;
            }
        } else {
            break;
        }
    }

    return countConsBusyHours($arr);
}

function findMaxBusyHours(array $arr, int $extraBusyHours): int
{
    $maxConsBusyHours = countConsBusyHours($arr);

	for ($i=0; $i < count($arr) - $extraBusyHours; $i++) { 
        $arrayCloneMaxCons = getConsBusyHoursWithExtraBusyHours($arr, $extraBusyHours, $i);

        if ($maxConsBusyHours < $arrayCloneMaxCons) {
            $maxConsBusyHours = $arrayCloneMaxCons;
        }

    }

    return $maxConsBusyHours;
}



var_dump(findMaxBusyHours([1,0,1,0,1,0,0,1,0,1], 2));

?>