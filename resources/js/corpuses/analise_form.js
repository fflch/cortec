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
