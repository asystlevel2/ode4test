<?php

/*
 * $dimensi = ['weight' => '', 'height' => '', 'length' => '']
 * $satuan = mastervolume model
 * $option = configuration user setting
 */
function dimensionalWeight(array $dimensi, array $satuan, array $option)
{
    $actualKg = 0;
    for ($i = 0; $i < count($dimensi); $i++) {
        $volumeWeight = ($dimensi[$i]['width'] * $dimensi[$i]['height'] * $dimensi[$i]['length']) / $satuan['volumeSatuan'];
        if ($option['custWeightActual'] OR $dimensi[$i]['weight'] > $volumeWeight) {
            if ($option['custWeightRound'] AND $option['custWeightRoundValue']) {
                $actualKg = custom_rounding($dimensi[$i]['weight'], $option['custWeightRoundValue']);
            } else if ($option['custWeightRound']) {
                $actualKg = round($dimensi[$i]['weight']);
            } else {
                $actualKg = $dimensi[$i]['weight'];
            }
        } else {
            if ($option['custWeightRound'] AND $option['custWeightRoundValue']) {
                $actualKg = custom_rounding($volumeWeight, $option['custWeightRoundValue']);
            } else if ($option['custWeightRound']) {
                $actualKg = round($volumeWeight);
            } else {
                $actualKg = $volumeWeight;
            }
        }
    }
    return $actualKg;
}

/*
 * The function is build for custom round by specific digit
 */

function custom_rounding($numbers, $initialdigit)
{
    $nilai = $numbers;
    $nilai_integer = intval($nilai);
    $nilai_decimal = floatval($nilai - $nilai_integer);
    $nilai_akhir = $nilai_decimal <= $initialdigit ? 0 : 1;
    $total = $nilai_akhir === 0 ? intval($nilai) : intval($nilai) + 1;
    return $nilai < 1 ? 1 : $total;
}