fetch('/static/import/tool_bar-v1.html')
    .then(response => response.text())
    .then(data => {
        // 将tool-bar的内容插入到占位符元素中
        document.getElementById('toolbar-placeholder').innerHTML = data;
    })
    .catch(error => {
        console.error('无法加载tool-bar:', error);
    });