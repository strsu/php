<!-- 
bcadd — 두 개의 임의의 정밀도 숫자 추가
bccomp — 두 개의 임의의 정밀도 숫자 비교
bcdiv — 두 개의 임의의 정밀도 숫자를 나누기
bcmod — 임의의 정밀도 숫자의 계수 가져오기
bcmul — 두 개의 임의의 정밀도 숫자 곱하기
bcpow — 임의의 정밀도 숫자를 다른 숫자로 올리기
bcpowmod — 지정된 계수만큼 감소된 임의의 정밀도 숫자를 다른 정밀도로 올리기
bcscale — 모든 bc 수학 함수에 대한 기본 스케일 매개변수 설정 또는 가져오기
bcsqrt — 임의의 정밀도 숫자의 제곱근 가져오기
bcsub — 임의의 정밀도 숫자를 다른 숫자에서 빼기 
-->


<?php

class Decimal {
    /*
        Usage: Decimal::add(1.244, 2.33);
    */

    public static function truncate($val, $precision = 3) {
        return bcdiv((string)$val, '1', $precision);  // 소수점 아래 precision자리까지 계산
    }

    public static function round($val, $precision=3) {
        return round($val, $precision, PHP_ROUND_HALF_UP);
    }

    public static function add($v1, $v2, $precision=6) {
        return bcadd((string)$v1, (string)$v2, $precision);
    }

    public static function sum($array, $precision=6) {
        $sum = '0';  // BCMath는 문자열을 사용하여 숫자를 다룬다.

        foreach ($array as $number) {
            $sum = Decimal::add($sum, $number, $precision);
        }

        return $sum;
    }

}
?>