<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Google Translate API Integration</title>
    <style>
      body {
            background: linear-gradient(to right, #4938fd, #003285);
            font-family: Tahoma, sans-serif;
            color: rgb(10, 10, 10);
            padding: 100px;
            margin: 0;
        }
        .container {
            display: flex;
            justify-content: space-around;
            margin: 20px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10x;
            padding: 5px; /* Adjusted padding */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .textarea-container {
            width: 45%;
        }
        .textarea-container, .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        textarea, select {
            width: 100%;
            margin-top: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 10px;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        textarea {
            height: 200px;
            resize: none;
        }
        button {
            margin-top: 10px;
            padding: 10px 20px;
            cursor: pointer;
            background-color: #f2a284;
            border: none;
            border-radius: 20px;
            color: black; /* Changed font color to green */
            font-size: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        button:hover {
            background-color: #3d2a27;
        }
        label {
            font-weight: bold;
        }
        .button-container {
            justify-content: center;
            width: 100%; /* Adjusted width */
            flex-direction: row; /* Changed to row to align buttons horizontally */
        }
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                align-items: center;
            }
            .textarea-container, .button-container {
                width: 100%;
                margin: 10px 0;
            }
            .button-container {
                flex-direction: row;
                justify-content: space-around;
                width: 100%;
            }
            button {
                margin: 5px;
                width: 45%;
            }
        }
    </style>
</head>
<body>
    <center>
    <h1 class="mt-5 mb-4" style="color: #FFDA78;">Google Translate</h1>
    </center>
    
    <div class="container">
        <div class="textarea-container">
            <label for="inputLanguage" style="color: yellow;">Input Language:</label>
            <select id="inputLanguage">
                <option value="en">English</option>
                <option value="es">Spanish</option>
                <option value="fr">French</option>
                <option value="de">German</option>
                <option value="it">Italian</option>
                <option value="ja">Japanese</option>
                <option value="ko">Korean</option>
                <option value="pt">Portuguese</option>
                <option value="ru">Russian</option>
                <option value="zh-CN">Chinese (Simplified)</option>
                <option value="ar">Arabic</option>
                <option value="bg">Bulgarian</option>
                <option value="cs">Czech</option>
                <option value="da">Danish</option>
                <option value="nl">Dutch</option>
                <option value="fi">Finnish</option>
                <option value="el">Greek</option>
                <option value="hi">Hindi</option>
                <option value="hu">Hungarian</option>
                <option value="id">Indonesian</option>
                <option value="ms">Malay</option>
                <option value="no">Norwegian</option>
                <option value="pl">Polish</option>
                <option value="ro">Romanian</option>
                <option value="sv">Swedish</option>
                <option value="th">Thai</option>
                <option value="tr">Turkish</option>
                <option value="uk">Ukrainian</option>
                <option value="vi">Vietnamese</option>
                <option value="tl">Filipino</option>
                <!-- Add more languages as needed -->
            </select>
            <label for="textInput" style="color: yellow;">Enter text:</label>
            <textarea  id="textInput" placeholder="Type what you like"></textarea>
     
        </div>
        <div class="textarea-container">
            <label for="outputLanguage" style="color: yellow;">Output Language:</label>
            <select id="outputLanguage">
                <option value="en">English</option>
                <option value="es">Spanish</option>
                <option value="fr">French</option>
                <option value="de">German</option>
                <option value="it">Italian</option>
                <option value="ja">Japanese</option>
                <option value="ko">Korean</option>
                <option value="pt">Portuguese</option>
                <option value="ru">Russian</option>
                <option value="zh-CN">Chinese (Simplified)</option>
                <option value="ar">Arabic</option>
                <option value="bg">Bulgarian</option>
                <option value="cs">Czech</option>
                <option value="da">Danish</option>
                <option value="nl">Dutch</option>
                <option value="fi">Finnish</option>
                <option value="el">Greek</option>
                <option value="hi">Hindi</option>
                <option value="hu">Hungarian</option>
                <option value="id">Indonesian</option>
                <option value="ms">Malay</option>
                <option value="no">Norwegian</option>
                <option value="pl">Polish</option>
                <option value="ro">Romanian</option>
                <option value="sv">Swedish</option>
                <option value="th">Thai</option>
                <option value="tr">Turkish</option>
                <option value="uk">Ukrainian</option>
                <option value="vi">Vietnamese</option>
                <option value="tl">Filipino</option>
                <!-- Add more languages as needed -->
            </select>
            
            <label for="translationOutput" style="color: yellow;">Translation:</label>
            <textarea id="translationOutput" readonly></textarea>
          
        </div>
    </div>
</body>
<center>
<button class="btn p-2" id="functions" style="width: 20%;" onclick="translateText()">Translate</button>
<button class="btn p-2" id="functions" style="width: 20%;" onclick="swapLanguages()">Swap</button>
    </center>
<script>
    function translateText() {
        const inputText = document.getElementById('textInput').value;
        if (!inputText) {
            alert('Please enter text to translate.');
            return;
        }
    
        const inputLanguage = document.getElementById('inputLanguage').value;
        const outputLanguage = document.getElementById('outputLanguage').value;
        const data = `q=${encodeURIComponent(inputText)}&source=${inputLanguage}&target=${outputLanguage}`;
        
        const xhr = new XMLHttpRequest();
        xhr.withCredentials = true;

        xhr.addEventListener('readystatechange', function () {
            if (this.readyState === this.DONE) {
                const response = JSON.parse(this.responseText);
                if (response.data && response.data.translations && response.data.translations.length > 0) {
                    const translatedText = response.data.translations[0].translatedText;
                    document.getElementById('translationOutput').value = translatedText;
                } else {
                    document.getElementById('translationOutput').value = 'Translation not available';
                }
            }
        });

        xhr.open('POST', 'https://google-translate1.p.rapidapi.com/language/translate/v2');
        xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
        xhr.setRequestHeader('X-RapidAPI-Key', '42552b6252msh8bb94af1d911540p1673f3jsnb75b2cd3e6f1');
        xhr.setRequestHeader('X-RapidAPI-Host', 'google-translate1.p.rapidapi.com');
        xhr.send(data);
    }

    function swapLanguages() {
        const inputLanguage = document.getElementById('inputLanguage').value;
        const outputLanguage = document.getElementById('outputLanguage').value;
        document.getElementById('inputLanguage').value = outputLanguage;
        document.getElementById('outputLanguage').value = inputLanguage;
    }
</script>
<script src="js/script.js"></script>
</html>
