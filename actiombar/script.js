function sendActionBar() {
    var actionBarInput = document.getElementById('actionBarInput');
    var actionBarDisplay = document.getElementById('actionBarDisplay');
    var inputText = actionBarInput.value;
    var formattedText = formatActionBarText(inputText);
    actionBarDisplay.innerHTML = formattedText;
}

function formatActionBarText(text) {
    // 解析颜色代码并应用相应的样式类
    var colorRegex = /§([0-9a-fA-Fl])/g;
    var formatted = text.replace(colorRegex, function(match, colorCode) {
        return `<span class="color-${colorCode.toLowerCase()}">${match}</span>`;
    });
    return formatted;
}
