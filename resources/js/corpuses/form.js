// 
    var radios = document.forms["corpus"].modo;
    for(radio in radios) {
        radios[radio].onclick = function() {
          LibComet.showHideFields([this.getAttribute("data-show")]);
        }
    }

//

    document.getElementById('upload_field').addEventListener('change', function(evt) {
      var file = document.getElementById('upload_field').files[0];

      if(window.FileReader) {
        //the browser does support the FileReader Object, so do this
        var reader  = new FileReader();
        reader.addEventListener("load", function () {
          insertResult(reader.result);
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
               insertResult(xhr.responseText);
            }
        };
        xhr.open('POST', '/api/corporas/corpus/upload', true);
        xhr.send(formData);

      }

    }, false);

    function insertResult(result){
        document.getElementById("campo").checked = true;
        document.getElementById('conteudo').value = result;
        document.getElementById('upload_field').value = '';
        LibComet.showHideFields(['#div_conteudo']);
    }
