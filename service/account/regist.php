<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 获取POST请求中的注册数据
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    // TODO: 在此处添加注册数据的处理逻辑
    // 可以将数据保存到数据库，进行验证等操作

    $response = array(
        "success" => true,
        "message" => "注册成功！",
        "data" => array(
            "username" => $username,
            "email" => $email
        )
    );

    // 将数据转换为JSON格式并输出
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>