<?php
function isLogin(){
    $cookie = ""; $data = ""; $var = false;
    if(session()->has('isLoggin')){
        $var = true;
    }
    
    return $var;
}
