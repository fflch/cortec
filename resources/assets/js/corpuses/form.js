//Exibe ou esconde campos para inserção de corpus
    var radios = document.forms["corpus"].modo;
    for(radio in radios) {
        radios[radio].onclick = function() {
          LibComet.showHideFields([this.getAttribute("data-show")]);
        }
    }

    document.getElementById('upload_field').addEventListener('change', function(evt) {
      var file = document.getElementById('upload_field').files[0];

      readTxt(file, insertResult);

    }, false);

    //insere corpus no campo de digitação
    function insertResult(result){
        document.getElementById("campo").checked = true;
        document.getElementById('conteudo').value = result;
        document.getElementById('upload_field').value = '';
        LibComet.showHideFields(['#div_conteudo']);
    }
