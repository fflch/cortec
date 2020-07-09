/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/analise/analise_form.js":
/*!*****************************************************!*\
  !*** ./resources/assets/js/analise/analise_form.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

//Funcões para marcar os corpus de acordo com a marcação na respectiva categoria de corpus
checks_cats = Array.from(document.step1.querySelectorAll('[id^="check_cat_"]'));
checks_cats.map(function (elm) {
  checks_corps = Array.from(document.step1.querySelectorAll('[id^="check_' + elm.value + '_"]'));
  checks_corps.map(function (elm_corp) {
    elm_corp.onclick = function (elmcorp) {
      checks_corps = Array.from(document.step1.querySelectorAll('[id^="check_' + elm.value + '_"]')); //verifica se está visível

      checks_corps = checks_corps.filter(function (elem, i, array) {
        return !(elem.offsetParent === null);
      });
      var checkedCount = document.step1.querySelectorAll('[id^="check_' + elm.value + '_"]:checked').length;
      checkedCount > 0 & checkedCount < checks_corps.length ? elm.indeterminate = true : elm.indeterminate = false;
      elm.checked = !(checkedCount == 0);
    };
  });

  elm.onclick = function () {
    checks_corps = Array.from(document.step1.querySelectorAll('[id^="check_' + elm.value + '_"]'));
    checks_corps.map(function (elm_corp) {
      elm_corp.parentElement.classList.contains("d-none") ? null : elm_corp.checked = elm.checked;
    });
  };
}); //Função para exibir os corpus de acordo com a língua

function showCorpuses(evt) {
  var show = document.step1.querySelector("input[name=language]:checked").value;
  showElms = Array.from(document.step1.querySelectorAll('li[data-lang*="' + show + '"]'));
  hideFields = Array.from(document.step1.querySelectorAll('li[data-lang]'));
  cards_categoria = Array.from(document.getElementById("div_corpuses").children);
  cards_categoria.map(function (card) {
    var cat_id = card.getAttribute('data-cat');
    var lis_card = Array.from(card.querySelectorAll('li[id*="li_' + cat_id + '"]'));
    lis_card.some(function (li) {
      return showElms.indexOf(li) > -1;
    }) ? showElms.push(card) : hideFields.push(card);
  });
  hideFields.map(function (hideField) {
    hideField.classList.add("d-none");
  });
  showElms.map(function (showElm) {
    showElm.classList.remove("d-none");
  });
} //Função para desmarcar todas categorias e corpus


function uncheckAll() {
  var checkboxes = Array.from(document.step1.querySelectorAll('[id^="check_"]'));
  checkboxes.map(function (checkbox) {
    checkbox.indeterminate = false;
    checkbox.checked = false;
  });
}

var radios = document.step1.language; //Event handler para exibir e desmarcar de acordo com a lingua escolhida

for (var i = radios.length; i--;) {
  radios[i].onchange = function () {
    showCorpuses();
    uncheckAll();
  };
}

showCorpuses(); //Validation

window.validation = function validation() {
  var validate = true;

  if (document.step1.querySelectorAll('[id^="check_"]:checked').length < 1) {
    validate = false;
  }

  if (document.step1.lanaguage == '') {
    validate = false;
  }

  !validate ? modal.show() : null;
  return validate;
};

/***/ }),

/***/ 3:
/*!***********************************************************!*\
  !*** multi ./resources/assets/js/analise/analise_form.js ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/thiago/repos/cortec/resources/assets/js/analise/analise_form.js */"./resources/assets/js/analise/analise_form.js");


/***/ })

/******/ });