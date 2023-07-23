<?php
$default_sql = mysqli_connect("127.0.0.1", "root", "", "main");

if (!$default_sql) {
    die("数据库连接失败: " . mysqli_connect_error());
}

// 查询表是否存在
$sql = "SHOW TABLES LIKE 'school_users'";

$result = $default_sql->query($sql);

if ($result->num_rows == 0) {
    $Create_string = "CREATE TABLE school_users (
        user_id INT PRIMARY KEY AUTO_INCREMENT,
        registration_date DATETIME NOT NULL,
        birthday DATE,
        nickname VARCHAR(50),
        identity VARCHAR(50),
        email VARCHAR(100),
        phone_number VARCHAR(20)
    );";
    if(mysqli_query($default_sql,$Create_string)==true){
        echo "数据表创建成功";
    }
}else{
    echo "数据表已经存在";
}

?>