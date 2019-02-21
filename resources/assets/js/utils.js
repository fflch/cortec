window.createOption = function(target, obj){
    let opt = document.createElement('option');
    opt.value = obj.value;
    opt.innerHTML = obj.text;
    target.appendChild(opt);
}

window.clearOptions = function(select, expFirst){
    end = (expFirst) ? 1 : 0;
    for (i = select.options.length - 1 ; i >= end ; i--) {
        select.remove(i);
    }
}

window.toggleElm = function(target, toggle) {
    target.style.display = toggle;
}

window.readTxt = function(file, callback) {
    if(window.FileReader) {
        //the browser does support the FileReader Object, so do this
        var reader  = new FileReader();
        reader.addEventListener("load", function () {
            callback(reader.result);
        }, false);
        reader.addEventListener("error", function () {
            alert('Erro!');
        }, false);
        if (file) {
            reader.readAsText(file);
        }
    } else {
        //the browser doesn't support the FileReader Object, so do this
        var formData = new FormData();
        formData.append('file', file);
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                callback(xhr.responseText);
            }
        };
        xhr.open('POST', '/api/corpus/corpus/upload', true);
        xhr.send(formData);
    }
}
