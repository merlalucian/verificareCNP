<?php
function verificareCNP(string $cnp) :bool
{

    if (preg_match('#[^0-9]#', $cnp)) {
        return false;
    }

    $cnp = str_split($cnp);

    if (count($cnp) != 13) {
        return false;
    }

    if ($cnp[0] < 1 || $cnp[0] > 9) {
        return false;
    }

    $luna_nasterii = $cnp[3] . $cnp[4];

    if ($cnp[4] == 0 || $cnp[3] > 1) {
        return false;
    }

    if ($luna_nasterii > 12) {
        return false;
    }

    if ($cnp[5] > 3 || $cnp[6] == 0) {
        return false;
    }

    $ziua_nasterii = $cnp[5] . $cnp[6];

    if ($ziua_nasterii > 31) {

        return false;
    }

    $judet = $cnp[7] . $cnp[8];
    if ($judet > 52) {

        return false;
    }

    if ($cnp[8] == 0) {

        return false;
    }

    $numar_control = 279146358279;
    $suma_totala = 0;
    $numar_control = str_split($numar_control);

    if ($cnp[11] == 0) {
        return false;
    }

    $cnp_temp = $cnp;
    unset($cnp_temp[12]);

    foreach ($numar_control as $key => $value) {

        $suma_totala += intval($value) * intval($cnp_temp[$key]);
    }

    $control = $suma_totala % 11;

    if($control == 10){
        $control = 1;
    }

    if ($control != $cnp[12]) {

        return false;
    }

    return true;
}

$cnp = '';
$check =  verificareCNP($cnp);
if (empty($check)) {
    echo "CNP Invalid";
} else {
    echo "CNP Valid";
}
