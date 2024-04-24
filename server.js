const express = require('express');
const fs = require('fs');
const app = express();
const port = 3000;

app.use(express.json());

app.post('/match', async (req, res) => {
  try {
    const regexFilePath = './regex.txt'; // 假设正则表达式文件名为 regex.txt
    const regexContent = await fs.promises.readFile(regexFilePath, 'utf8');
    const regex = new RegExp(regexContent, 'g'); // 'g' 表示全局匹配
    const inputText = req.body.text;
    const matches = inputText.matchAll(regex);
    const results = [];
    for (const match of matches) {
      results.push({
        match: match[0],
        text: inputText.slice(match.index, match.index + match[0].length)
      });
    }
    res.json(results);
  } catch (error) {
    console.error('Error matching text:', error);
    res.status(500).send('Error matching text');
  }
});

app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
});
