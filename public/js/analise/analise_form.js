//Funcões para marcar os corpus de acordo com a marcação na respectiva categoria de corpus

checks_cats = Array.from(document.step1.querySelectorAll('[id^="check_cat_"]'));

checks_cats.map(function (elm){
  checks_corps = Array.from(document.step1.querySelectorAll('[id^="check_'+elm.value+'_"]'));

  checks_corps.map(function (elm_corp){
    elm_corp.onclick = function (elmcorp){
      checks_corps = Array.from(document.step1.querySelectorAll('[id^="check_'+elm.value+'_"]'));

      //verifica se está visível
      checks_corps = checks_corps.filter( function( elem, i, array) {
          return !(elem.offsetParent === null);
      } );

      var checkedCount = document.step1.querySelectorAll('[id^="check_'+elm.value+'_"]:checked').length;

      (checkedCount > 0 & checkedCount < checks_corps.length) ? (elm.indeterminate = true) : (elm.indeterminate = false);
      elm.checked = !(checkedCount == 0);
    }
  });

  elm.onclick = function () {
    checks_corps = Array.from(document.step1.querySelectorAll('[id^="check_'+elm.value+'_"]'));
    checks_corps.map(function (elm_corp){
      (elm_corp.parentElement.classList.contains("d-none")) ? (null) : (elm_corp.checked = elm.checked);
    });
  }

});

//Função para exibir os corpus de acordo com a língua
function showCorpuses(evt){
  let show = document.step1.querySelector("input[name=language]:checked").value;

  showElms = Array.from(document.step1.querySelectorAll('li[data-lang*="'+show+'"]'));
  hideFields = Array.from(document.step1.querySelectorAll('li[data-lang]'));
  cards_categoria = Array.from(document.getElementById("div_corpuses").children);

  cards_categoria.map( function( card ) {
      let cat_id = card.getAttribute('data-cat');
      let lis_card = Array.from(card.querySelectorAll('li[id*="li_'+cat_id+'"]'));

      (lis_card.some(li => showElms.indexOf(li) > -1)) ? showElms.push(card) : hideFields.push(card);

  } );

  hideFields.map( function( hideField ) {
      hideField.classList.add("d-none");
  } );


  showElms.map( function( showElm ) {
      showElm.classList.remove("d-none");
  } );
}

//Função para desmarcar todas categorias e corpus
function uncheckAll(){
  let checkboxes = Array.from(document.step1.querySelectorAll('[id^="check_"]'));

  checkboxes.map(function (checkbox) {
      checkbox.indeterminate = false;
      checkbox.checked = false;
  });
}

var radios = document.step1.language;

//Event handler para exibir e desmarcar de acordo com a lingua escolhida
for(var i = radios.length; i--; ) {
    radios[i].onchange = function() {
      showCorpuses();
      uncheckAll();
    };
}

showCorpuses();

//Validation
window.validation = function validation(){
  var validate = true;

  if (document.step1.querySelectorAll('[id^="check_"]:checked').length < 1){
    validate = false;
  }

  if (document.step1.lanaguage == ''){
    validate = false;
  }

  (!validate) ? modal.show() : null;

  return validate;
}
