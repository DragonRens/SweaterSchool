<?php
    require_once("../library/requests_format.php");
    require_once("../library/standard.php");
    require_once("../library/sql.php");

    $seek = new seek();
    // 获取POST请求中的注册数据
    $username = $seek->getValue("username");
    $password = $seek->getValue("password");
    $email = $seek->getValue("email");

    // 判断用户名、密码和邮箱是否为空
    if (empty($username) || empty($password) || empty($email)) {
        $seek->response(array(
            "success" => false,
            "message" => "输入的数据不合法"
        ),"application/json");
        ab_exit();
    }
    // 判断用户名是否含有特殊字符（只允许字母、数字、下划线）
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $seek->response(array(
            "success" => false,
            "message" => "用户名只能包含字母、数字和下划线"
        ),"application/json");
        ab_exit();
    }
    // 判断邮箱格式是否正确
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $seek->response(array(
            "success" => false,
            "message" => "邮箱格式不正确！"
        ),"application/json");
        ab_exit();
    }
    $data_base = new DatabaseHelper();

    // 获取当前时间作为注册日期
    $registration_date = date('Y-m-d H:i:s');

    // 构建插入语句
    $insert_sql = "INSERT INTO school_users (registration_date, birthday, nickname, identity, email, phone_number) VALUES ('$registration_date', '', '', '', '$email', '')";

    try {
        // 执行插入语句
        $data_base->query($insert_sql);

        $seek->response(array(
            "success" => true,
            "message" => "注册成功！"
        ), "application/json");
        ab_exit();
    } catch (Exception $error) {
        $seek->response(array(
            "success" => false,
            "message" => "数据库错误：" . $error->getMessage()
        ), "application/json");
        ab_exit();
    }

?>