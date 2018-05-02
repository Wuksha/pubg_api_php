<?php
class Cookie {


    static function Exists($cookie_name)
    {
        if(!isset($_COOKIE[''.$cookie_name.'']))
        {
            return false;
        }
        return true;
    }

    static function checkValue($array, $value)
    {
        foreach($array as $key => $val)
        {
            if($val == $value)
            {
                return true;
                break;
            }
        }
    
        return false;
    }


}


?>