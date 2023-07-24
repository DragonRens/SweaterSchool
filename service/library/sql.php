<?php
class DatabaseHelper {
    private $server_name;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    public function __construct() {
        require_once('../config/sql.php');
        $this->server_name = $server_name;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->connect();
    }

    private function connect() {
        $this->conn = new mysqli($this->server_name, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("数据库连接失败: " . $this->conn->connect_error);
        }
    }

    public function query($sql) {
        $result = $this->conn->query($sql);
        if (!$result) {
            die("查询错误: " . $this->conn->error);
        }
        return $result;
    }

    // 如果有其他常用的查询方法，可以继续在这里添加

    public function close() {
        $this->conn->close();
    }
}
?>
