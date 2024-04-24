from flask import Flask, request, jsonify
import re

app = Flask(__name__)

# 读取服务器目录中的正则表达式文本文件
def read_regex_from_file():
    with open('regex_patterns.txt', 'r', encoding='utf-8') as file:
        return file.read().splitlines()

# 匹配文本
def match_text(text):
    regex_patterns = read_regex_from_file()
    match_indices = []
    for pattern in regex_patterns:
        matches = re.finditer(pattern, text)
        for match in matches:
            match_indices.append(match.span())
    return match_indices

# 处理匹配请求
@app.route('/match', methods=['POST'])
def match():
    data = request.json
    text = data['text']
    match_indices = match_text(text)
    return jsonify(match_indices)

if __name__ == '__main__':
    app.run(debug=True)
