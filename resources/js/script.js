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