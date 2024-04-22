document.addEventListener('DOMContentLoaded', function() {
    const inputArea = document.getElementById('input-area');
    const outputArea = document.getElementById('output-area');

    const colorCodes = {
        '0': 'black',
        '1': 'dark_gray',
        '2': 'dark_green',
        '3': 'dark_aqua',
        '4': 'dark_red',
        '5': 'dark_purple',
        '6': 'gold',
        '7': 'gray',
        '8': 'dark_blue',
        '9': 'light_purple',
        'a': 'cyan',
        'b': 'light_quartz',
        'c': 'light_red',
        'd': 'pink',
        'e': 'yellow',
        'f': 'white',
        'k': 'magic',
        'l': 'wave',
        'm': 'strikethrough',
        'n': 'underline',
        'o': 'italic',
        'r': 'reset'
    };

    function renderText(text) {
        let result = '';
        let inColorCode = false;
        let currentColor = '';

        for (let i = 0; i < text.length; i++) {
            const char = text[i];

            if (char === '§') {
                inColorCode = true;
            } else if (inColorCode) {
                if (colorCodes.hasOwnProperty(char)) {
                    currentColor = colorCodes[char];
                    if (currentColor === 'reset') {
                        currentColor = '';
                    }
                } else {
                    result += '<span class="transparent">' + char + '</span>';
                }
                inColorCode = false;
            } else {
                result += `<span style="color: ${currentColor}">${char}</span>`;
            }
        }

        outputArea.innerHTML = result;
    }

    inputArea.addEventListener('input', function() {
        renderText(this.value);
    });

    // Initial render on page load
    renderText(inputArea.value);
});
