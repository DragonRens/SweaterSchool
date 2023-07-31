<?php
/**
 * 标准的因为已知的异常所结束请求的方法
 * 
 * @param int $code 返回的状态码.默认是400
 */
function ab_exit($code = 400){
    http_response_code($code);
    exit();
}
?>