<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function geraCodigoBarra($valor) {
    $impar=0;
    $par=0;
    $numero=str_pad($valor, 12, "0", STR_PAD_LEFT);
    $aa1=substr($numero,1,1);
    $a1= intval(substr($numero,0,1));
    $a3=intval(substr($numero,2,1));
    $a5=intval(substr($numero,4,1));
    $a7=intval(substr($numero,6,1));
    $a9=intval(substr($numero,8,1));
    $a11=intval(substr($numero,10,1));
    $impar=$impar+$a1+$a3+$a5+$a7+$a9+$a11;
    $b2=intval(substr($numero,1,1));
    $b4=intval(substr($numero,3,1));
    $b6=intval(substr($numero,5,1));
    $b8=intval(substr($numero,7,1));
    $b10=intval(substr($numero,9,1));
    $b12=intval(substr($numero,11,1));
    $par=$par+$b2+$b4+$b6+$b8+$b10+$b12;
    $par=$par*3;
    $vsoma=$impar+$par;
    $valor2=$vsoma;
    $numero2=str_pad($valor2, 3, "0", STR_PAD_LEFT);
    $digito=intval(substr($numero2,2,1));
    $digito=10-$digito;
    $codigo_barra=$valor.$digito;
    $codigo_barra=str_pad($codigo_barra, 13, "0", STR_PAD_LEFT);
    return $codigo_barra;
}
