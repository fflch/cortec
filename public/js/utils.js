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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/utils.js":
/*!**************************************!*\
  !*** ./resources/assets/js/utils.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.createOption = function (target, obj) {
  var opt = document.createElement('option');
  opt.value = obj.value;
  opt.innerHTML = obj.text;
  target.appendChild(opt);
};

window.clearOptions = function (select, expFirst) {
  end = expFirst ? 1 : 0;

  for (i = select.options.length - 1; i >= end; i--) {
    select.remove(i);
  }
};

window.toggleElm = function (target, toggle) {
  target.style.display = toggle;
};

window.readTxt = function (file, callback) {
  if (window.FileReader) {
    //the browser does support the FileReader Object, so do this
    var reader = new FileReader();
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

    xhr.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        callback(xhr.responseText);
      }
    };

    xhr.open('POST', '/api/corpus/corpus/upload', true);
    xhr.send(formData);
  }
};

/***/ }),

/***/ "./vendor/uspdev/laravel-comet-theme/resources/assets/sass/app.scss":
/*!**************************************************************************!*\
  !*** ./vendor/uspdev/laravel-comet-theme/resources/assets/sass/app.scss ***!
  \**************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

throw new Error("Module build failed (from ./node_modules/css-loader/index.js):\nModuleBuildError: Module build failed (from ./node_modules/sass-loader/lib/loader.js):\n\n@import '../../../node_modules/bootstrap/scss/bootstrap';\n       ^\n      Can't find stylesheet to import.\n@import '../../../node_modules/bootstrap/scss/bootstrap';\n        ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^\n  stdin 5:9  root stylesheet\n      in /home/thiago/repos/cortec/vendor/uspdev/laravel-comet-theme/resources/assets/sass/app.scss (line 5, column 9)\n    at runLoaders (/home/thiago/repos/cortec/node_modules/webpack/lib/NormalModule.js:316:20)\n    at /home/thiago/repos/cortec/node_modules/loader-runner/lib/LoaderRunner.js:367:11\n    at /home/thiago/repos/cortec/node_modules/loader-runner/lib/LoaderRunner.js:233:18\n    at context.callback (/home/thiago/repos/cortec/node_modules/loader-runner/lib/LoaderRunner.js:111:13)\n    at render (/home/thiago/repos/cortec/node_modules/sass-loader/lib/loader.js:52:13)\n    at Function.$2 (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:24231:48)\n    at vC.$2 (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:15402:16)\n    at tz.vc (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:8914:42)\n    at tz.vb (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:8916:32)\n    at ie.ul (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:8222:46)\n    at t6.$0 (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:8367:7)\n    at Object.ex (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:1533:80)\n    at ah.ba (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:8285:3)\n    at iu.ba (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:8215:25)\n    at iu.cC (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:8202:6)\n    at oy.cC (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:7992:35)\n    at Object.m (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:1406:19)\n    at /home/thiago/repos/cortec/node_modules/sass/sass.dart.js:5043:51\n    at w1.a (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:1417:71)\n    at w1.$2 (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:8007:23)\n    at uC.$2 (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:8002:25)\n    at tz.vc (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:8914:42)\n    at tz.vb (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:8916:32)\n    at ie.ul (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:8222:46)\n    at t6.$0 (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:8367:7)\n    at Object.ex (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:1533:80)\n    at ah.ba (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:8285:3)\n    at iu.ba (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:8215:25)\n    at iu.cC (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:8202:6)\n    at Object.eval (eval at Bj (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:651:15), <anonymous>:3:37)\n    at tz.vc (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:8914:42)\n    at tz.vb (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:8916:32)\n    at ie.ul (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:8222:46)\n    at t6.$0 (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:8367:7)\n    at Object.ex (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:1533:80)\n    at ah.ba (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:8285:3)\n    at iu.ba (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:8215:25)\n    at iu.cC (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:8202:6)\n    at oy.cC (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:7992:35)\n    at Object.m (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:1406:19)\n    at /home/thiago/repos/cortec/node_modules/sass/sass.dart.js:5826:51\n    at w1.a (/home/thiago/repos/cortec/node_modules/sass/sass.dart.js:1417:71)");

/***/ }),

/***/ 0:
/*!***************************************************************************************************************!*\
  !*** multi ./resources/assets/js/utils.js ./vendor/uspdev/laravel-comet-theme/resources/assets/sass/app.scss ***!
  \***************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /home/thiago/repos/cortec/resources/assets/js/utils.js */"./resources/assets/js/utils.js");
module.exports = __webpack_require__(/*! /home/thiago/repos/cortec/vendor/uspdev/laravel-comet-theme/resources/assets/sass/app.scss */"./vendor/uspdev/laravel-comet-theme/resources/assets/sass/app.scss");


/***/ })

/******/ });