// alert_v1.js

// 动态创建link元素，用于引入alert_v1.css样式
var link = document.createElement("link");
link.rel = "stylesheet";
link.href = "/static/css/alert_v1.css";
document.head.appendChild(link);

// 弹窗函数
function showAlert(message, type) {
    // 创建弹窗元素
    var alertElement = document.createElement("div");
    alertElement.className = "custom-alert " + type;
    alertElement.textContent = message;

    // 将弹窗元素添加到页面中
    document.body.appendChild(alertElement);

    // 设置定时器，3秒后删除弹窗
    setTimeout(function() {
        alertElement.remove();
    }, 3000);
}
