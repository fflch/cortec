checks_cats = Array.from(document.querySelectorAll('[id^="check_cat_"]'));

checks_cats.map(function (elm){
  checks_corps = Array.from(document.querySelectorAll('[id^="check_'+elm.value+'_"]'));

  checks_corps.map(function (elm_corp){
    elm_corp.onclick = function (elmcorp){
      checks_corps = Array.from(document.querySelectorAll('[id^="check_'+elm.value+'_"]'));
      var checkedCount = document.querySelectorAll('[id^="check_'+elm.value+'_"]:checked').length;

      (checkedCount > 0 & checkedCount < checks_corps.length) ? (elm.indeterminate = true) : (elm.indeterminate = false);
      elm.checked = !(checkedCount == 0);
    }
  });

  elm.onclick = function () {
    checks_corps = Array.from(document.querySelectorAll('[id^="check_'+elm.value+'_"]'));
    checks_corps.map(function (elm_corp){
      elm_corp.checked = elm.checked;
    });
  }

});

function showCorpuses(evt){
  let show = document.querySelector("input[name=check_lingua]:checked").value;

  showElms = Array.from(document.querySelectorAll('li[data-lang*="'+show+'"]'));
  hideFields = Array.from(document.querySelectorAll('li[data-lang]'));

  hideFields.map( function( hideField ) {
      hideField.classList.add("d-none");
  } );

  showElms.map( function( showElm ) {
      showElm.classList.remove("d-none");
  } );
}

var radios = document.getElementsByName('check_lingua');

for(var i = radios.length; i--; ) {
    radios[i].onchange = showCorpuses;
}

showCorpuses();
