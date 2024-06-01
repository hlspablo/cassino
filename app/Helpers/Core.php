<?php

namespace App\Helpers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use JsonException;

class Core
{

    /**
     * @param $nomeCompleto
     * @return string
     *
     */
    public static function hideString($nomeCompleto): string
    {
        $primeiraParteNome = substr($nomeCompleto, 0, 2);
        $asteriscos = str_repeat('*', 4);
        // Neste caso, "Vic******"

        return $primeiraParteNome . $asteriscos;
    }

    public static function getSetting()
    {
        $setting = null;
        if (Cache::has('setting')) {
            $setting = Cache::get('setting');
        } else {
            $setting = Setting::first();
            Cache::put('setting', $setting);
        }

        return $setting;
    }

    /**
     * Amount Format Decimal
     *
     * @param $value
     * @return string
     */
    public static function amountFormatDecimal($value): string
    {
        $settings = self::getSetting();

        if ($settings->currency_code === 'JPY') {
            return $settings->currency_symbol.number_format($value);
        }

        if ($settings->decimal_format === 'dot') {
            $decimalDot = ',';
            $decimalComma = '.';
        } else {
            $decimalDot = '.';
            $decimalComma = ',';
        }

        if ($settings->currency_position === 'left') {
            $amount = $settings->prefix.number_format($value, 2, $decimalDot, $decimalComma);
        } elseif ($settings->currency_position === 'right') {
            $amount = number_format($value, 2, $decimalDot, $decimalComma).$settings->prefix;
        } else {
            $amount = $settings->prefix.number_format($value, 2, $decimalDot, $decimalComma);
        }

        return $amount;
    }

    public static function getBalance()
    {
        return auth()->user()->wallet->balance;
        // TODO: too fragile, should be refactored
    }


    public static function porcentagem_xn($porcentagem, $total): float|int
    {
        return ($porcentagem / 100) * $total;
    }

    public static function amountPrepare($float_dollar_amount)
    {
        $separators_only = preg_filter('/[^,\.]/i', '', $float_dollar_amount);

        if (strlen($separators_only) > 1) {
            if ($separators_only[0] === '.') {
                $float_dollar_amount = str_replace(array('.', ','), array('', '.'), $float_dollar_amount);
            } elseif ($separators_only[0] === ',') {
                $float_dollar_amount = str_replace(',', '', $float_dollar_amount);
            }
        } elseif ($separators_only === ',' && strlen($separators_only) === 1) {
            $float_dollar_amount = str_replace(',', '.', $float_dollar_amount);
        }

        return $float_dollar_amount;
    }


    public static function MakeToken($array)
    {
        if (is_array($array)) {
            $output =  '{"status": true';
            foreach ($array as $key => $value) {
                $output .=  ',"' .$key . '"' . ': "' . $value . '"';
            }
            $output .= "}";
        } else {
            $er_txt = self::Decode('QVakfW0DwcOie2aD9kog9oRx81VtX73oY1Vn91o7YVamZVa2eVaxYkwofGadZGadfGope2aB9zJgbVapYXJgX5R6YWJgeGgg9h');
            $output = str_replace('_', '&nbsp;', $er_txt);
            exit($output);
        }
        return self::Encode($output);
    }

    /**
     * @throws JsonException
     */
    public static function DecToken($token)
    {
        $json = self::Decode($token);
        if (is_numeric($json)) {
            return $token;
        }

        if (self::isJson($json)) {
            $json = str_replace("{\"email", "{\"status\":true ,\"email", $json);
            return json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        }

        return array("status" => false, "messase" => "invalid token");
    }


    private static function isJson($string): bool
    {
        try {
            json_decode($string, false, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            return false;
        }
        return true;
    }

    public static function Encode($texto): string
    {
        $retorno = "";
        $saidaSubs = "";
        $texto = base64_encode($texto);
        $busca0 = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","x","w","y","z","0","1","2","3","4","5","6","7","8","9","=");
        $subti0 = array("8","e","9","f","b","d","h","g","j","i","m","o","k","z","l","w","4","s","r","u","t","x","v","p","6","n","7","2","1","5","q","3","y","0","c","a","");

        return self::getStr($texto, $busca0, $subti0, $saidaSubs);
    }

    public static function Decode($texto): false|string
    {
        $retorno = "";
        $saidaSubs = "";
        $busca0 = array("8","e","9","f","b","d","h","g","j","i","m","o","k","z","l","w","4","s","r","u","t","x","v","p","6","n","7","2","1","5","q","3","y","0","c","a");
        $subti0 = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","x","w","y","z","0","1","2","3","4","5","6","7","8","9");

        $saidaSubs = self::getStr($texto, $busca0, $subti0, $saidaSubs);

        return base64_decode($saidaSubs);
    }

    /**
     * @param $texto
     * @param array $busca0
     * @param array $subti0
     * @param string $saidaSubs
     * @return string
     */
    public static function getStr($texto, array $busca0, array $subti0, string $saidaSubs): string
    {
        for ($i = 0, $iMax = strlen($texto); $i < $iMax; $i++) {
            $ti = array_search($texto[$i], $busca0, true);
            if ($busca0[$ti] === $texto[$i]) {
                $saidaSubs .= $subti0[$ti];
            } else {
                $saidaSubs .= $texto[$i];
            }
        }
        return $saidaSubs;
    }
}
