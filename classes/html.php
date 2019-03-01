<?php
class HTML{
    public static function selected($var1, $var2){
        return ($var1==$var2) ? 'selected="selected"' : '';
    }
}
