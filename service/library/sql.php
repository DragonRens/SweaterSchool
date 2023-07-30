<?php
/**
 * DatabaseHelper类用于简化与数据库的交互，封装了连接数据库和执行查询的方法
 */
class DatabaseHelper {
    // 数据库连接所需的私有属性

    /**
     * 数据库服务器的主机名
     * @var string
     */
    private $server_name;

    /**
     * 数据库用户名
     * @var string
     */
    private $username;

    /**
     * 数据库密码
     * @var string
     */
    private $password;

    /**
     * 数据库名
     * @var string
     */
    private $dbname;

    /**
     * 数据库连接对象
     * @var mysqli|null
     */
    private $conn;

    /**
     * 构造函数，在创建DatabaseHelper对象时执行
     */
    public function __construct() {
        // 导入数据库配置文件
        require_once('../config/sql.php');
        // 初始化属性
        $this->server_name = $server_name; // 设置数据库服务器的主机名
        $this->username = $username; // 设置数据库用户名
        $this->password = $password; // 设置数据库密码
        $this->dbname = $dbname; // 设置数据库名

        // 连接数据库
        $this->connect();
    }

    /**
     * 私有方法，用于连接数据库
     */
    private function connect() {
        // 创建一个mysqli连接对象
        $this->conn = new mysqli($this->server_name, $this->username, $this->password, $this->dbname);

        // 检查是否连接成功
        if ($this->conn->connect_error) {
            die("数据库连接失败: " . $this->conn->connect_error);
        }

        // 设置字符集为UTF-8，防止乱码
        $this->conn->set_charset("utf8");
    }

    /**
     * 公有方法，用于执行SQL查询语句
     * @param string $sql 要执行的SQL查询语句
     * @return mixed 查询结果（可能是mysqli_result对象，也可能是布尔值或其他数据类型）
     * @throws Exception 如果查询失败，抛出异常
     */
    public function query($sql) {
        // 执行SQL查询，并将结果赋值给$result
        $result = $this->conn->query($sql);

        // 检查查询是否出错
        if ($result === false) {
            throw new Exception("查询错误: " . $this->conn->error);
        }

        // 返回查询结果
        return $result;
    }

    // 如果有其他常用的查询方法，可以继续在这里添加

    /**
     * 关闭数据库连接的方法
     */
    public function close() {
        // 关闭数据库连接
        if ($this->conn) {
            $this->conn->close();
        }
    }

    /**
     * 获取上一次插入操作生成的自增ID
     * @return int|null 返回自增ID，如果没有自增ID，则返回null
     */
    public function getLastInsertId() {
        if ($this->conn) {
            return $this->conn->insert_id;
        }
        return null;
    }
}
?>
