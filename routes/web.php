<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {





/*
Input: s = "()"
Output: 1

Input: s = "(())"
Output: 2

Input: s = "( ( (  ) ) )"
Output: 6

Input: s = "( ( ( ( ) ) ) )"
Output: 24
*/


$groupString = explode(")", $str);
$groupString = array_filter($groupString);

$total = 1;
$totalSum = 0;

foreach($groupString as $strVal){
    $strlegn = strlen($strVal);
    if($strlegn > 1) {
        for($i=0;$i<$strlegn;$i++){
            $total = $total * ($i+1);
        }
    }else{
        $totalSum++;
    }
}

return $total+$totalSum;






return $arr_str;





return "dddddddddddddddd";











    $arr = [1,2,3,4,5,6];
    $n = 6;
    $p = 2;



    $data['straght'] = floor($p/2) ;
    $data['rev'] = $n - ceil($p/2) ;

    return min($data);

/*
    $container = [

        [3, 3, 1],
        [2, 1, 2],
        [3, 3, 3]

    ];


    $container = [
        [
    
            [1, 3, 1],
            [2, 1, 2],
            [3, 3, 3]
    
        ],
        [
             r  g  b
           0 [0, 2, 1],
           1 [1, 1, 1],
           2 [2, 0, 0]

             r  g  b
           0 [0, 3, 0],
           1 [1, 0, 2],
           2 [2, 0, 0]
    
        ],
    ];*/





    // $status = "Impossible";
    // foreach($container as $mainKey=>$arrayOfTyps){
    //     $typs1 = $container[$mainKey];//array_column($container, $mainKey);
    //     if (isset($container[$mainKey+1])) {
    //         $typs2 = $container[$mainKey+1];//array_column($container, $mainKey+1);

    //         foreach($typs1 as $subKey=>$type){
    //             if (count(array_flip($typs1)) === 1 && end($typs1) === $typs1[0]) {
    //                 $status = "Possible";
    //                 continue;
    //             }
    //             if (isset($typs1[$subKey+1])) {
    //                 $typs1[$subKey] = $typs1[$subKey] + 1;
    //                 $typs1[$subKey+1] = $typs1[$subKey+1] - 1;

    //                 $typs2[$subKey] = $typs2[$subKey] - 1;
    //                 $typs2[$subKey+1] = $typs2[$subKey+1] + 1;
                    
    //                 if (count(array_flip($typs1)) === 1 && end($typs1) === $typs1[0]) {
    //                     $status = "Possible";
    //                 }
    //             }
    //         }
    //     }
    // }


    // return $status;    

    // foreach($container as $mainKey=>$arrayOfTyps){

    //     $arr1 = array_column($container, $mainKey);
    //     $arr2 = array_column($container, $mainKey+1);
    //     $samilerValSum = array_count_values($arr1);
    //     $samilerValSumMax = max($samilerValSum);
    //     $mainArrCount = count($arr1);
    //     $check = (int)($mainArrCount - $samilerValSumMax);

    //     if( $check > 0 && $check < 2) {
    //         continue;
    //     } else {
            
    //         foreach($arr1 as $subKey => $arr){
    //             if ( isset($arr2[$subKey+1])) {

    //                 $oldVal = $arr2[$subKey+1];
    //                 $arr2[$subKey+1] = $arr;
    //                 $mainArrCount2 = count($arr2);
    //                 $samilerValSum2 = array_count_values($arr2);
    //                 $samilerValSumMax2 = max($samilerValSum2);
    //                 $check2 = (int)($mainArrCount2 - $samilerValSumMax2);
    //                 if ($check2 == 0 or $check == 0) {
    //                     $status = "Possible";
    //                 }
    //                 $arr2[$subKey+1] = $oldVal;
    //             }
    //         }
    //     }

    // }
    
    
    $sum = array();
    foreach($container as $mainKey=>$conts){
        $col_sum = array_sum(array_column($container, $mainKey));
        array_push($sum, $col_sum);

        /*foreach($sum as $key=>$summ){
            if (isset($sum[$key+1])) {
                if ($summ == $sum[$key+1]) {
                    $status =  "Possible";
                }
            }
        }*/
    }



    $arrMax = max(array_count_values($sum));
    if ($arrMax > 1) {
        $status = "Possible";
    }

    return $status;
















    return view('welcome');
    
});




















Route::get('array', function () {

    $arr = [ 1, 2, 2, 2, 3, 3, 3, 8, 8, 8, 8, 8, 8, 8, 8];
    $arr = [ 4, 5, 5, 5, 6, 6, 4, 1, 4, 4, 3, 6, 6, 3, 6, 1, 4, 5, 5, 5 ];



    $arr = array_count_values($arr);
    $arr = array_values($arr);




    $sum_pairs = 0;
    foreach($arr as $ar){
        $log_count_vals = floor($ar / 2);
        $sum_pairs = $sum_pairs + $log_count_vals;
    }

    return $sum_pairs;


    ////////very important
    //$log_count_vals = floor(log10($ar) / log10(2));



});







Route::get('string', function () {

    $string = "aaaaaa";

    return substr_count($string, "aa");


    $arr = [];
    $arr_sub_count = [];


    for($i=0;$i<strlen($string);$i++){
        $arr[] = substr($string, $i);
        $needle = substr($string, $i);
        $arr_sub_count[] =substr_count($string, $needle);
    }





    return $arr_sub_count;



});