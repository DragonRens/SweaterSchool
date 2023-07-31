<?php
class seek_method {
    public static $POST = 1;
    public static $GET = 2;
}

class seek {
    private $method = null;
    private $request_form;

    public function __construct() {
        switch ($_SERVER["REQUEST_METHOD"]) {
            case "POST":
                $this->method = seek_method::$POST;
                $this->request_form = json_decode(file_get_contents('php://input'), true);
                $this->request_form = $this->request_form === null ? $_POST : $this->request_form;
                break;
            case "GET":
                $this->method = seek_method::$GET;
                break;
        }
    }

    /**
     * 获取请求参数的值
     * 
     * @param string $paramName 参数名
     * @param mixed $default 默认值（可选）
     * @return mixed 请求参数的值
     */
    public function getValue($paramName, $default = null) {
        if (isset($this->request_form[$paramName])) {
            return $this->request_form[$paramName];
        } else {
            return $default;
        }
    }

    /**
     * 获取所有请求参数的键值对
     * 
     * @return array 请求参数的键值对数组
     */
    public function getParamList() {
        return $this->request_form;
    }

    /**
     * 获取请求的方法
     * 
     * @return int 请求方法，seek_method::$POST 或 seek_method::$GET
     */
    public function getRequestMethod() {
        return $this->method;
    }
    /**
     * 根据参数输出 HTTP 响应
     * 
     * @param mixed $data 响应数据，可以是字符串或 JSON 对象
     * @param string $contentType 响应的 Content-Type，可选，默认值为 "text/plain"
     */
    public function response($data, $contentType = "text/plain") {
        // 设置响应的 Content-Type 头
        header("Content-Type: $contentType");

        // 输出响应数据
        if (is_array($data) || is_object($data)) {
            // 如果是数组或对象，则将其转换为 JSON 字符串
            echo json_encode($data);
        } else {
            // 如果是字符串，则直接输出
            echo $data;
        }
    }
}
?>