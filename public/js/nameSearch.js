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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 44);
/******/ })
/************************************************************************/
/******/ ({

/***/ 44:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(45);


/***/ }),

/***/ 45:
/***/ (function(module, exports) {


$.fn.nameSearch = function (setting) {

  $input = $(this).find('.input-group-name').find('input');
  $results = $(this).find('.results');

  // console.log($input);
  var url = setting.url;

  $(document).click(function (e) {

    if ($(e.target)[0] !== $input[0]) {

      $results.removeClass("active");
    }
  });

  $input.on("paste keyup focus", function (e) {
    val = $(this).val();
    console.log(val);
    var query = $(this).val();;

    axios.get(url + ('?search=' + query)).then(function (response) {
      data = response.data.data;
      console.log(data.length);

      $results.empty();
      $results.addClass("active");
      if (data.length > 0) {
        data.forEach(function (ele) {
          // console.log(ele);
          $child = $('<div class="result" data-doc-id="' + ele.id + '"> ' + ele.full_name + ' </div>');
          $results.append($child);
          $child.click(function (e) {
            // $child = $(`<div class="col-12 mb-1">`) ;
            $link = $('<a href="">' + ele.full_name + '</a>');
            // $deleteBtn = $(`
            // <button type="button" class="btn btn-danger btn-sm rounded-circle float-right" >
            //   <i class="fa fa-times"></i>
            // </button>`)
            // $child.append($link);
            // $child.append($value);
            // $child.append($deleteBtn);            
            $deleteBtn = $('<a class="rm-tag" href="#" data-refer="' + ele.id + '" > <i class="fa fa-times"> </i></a>');
            $value = $('<input type="hidden" name="users[]" value="' + ele.id + '" >');
            $tag = $('<span class="badge badge-info mr-1" > ' + ele.full_name + '</span>');

            $('input[name="title"]').val(ele.full_name);
            // $("#referItem").append($child);
            $tag.append($deleteBtn);
            $tag.append($value);
            $deleteBtn.click(function (e) {
              e.preventDefault();
              $(this).parent().remove();
            });
            $("#tagged").append($tag);
          });
        });
      } else {
        child = $('<div class="result" > \u0E44\u0E21\u0E48\u0E1E\u0E1A\u0E02\u0E49\u0E2D\u0E21\u0E39\u0E25 </div>');
        $results.append(child);
      }
    }).catch(function (error) {
      console.log(error);
    });
  });
};

/***/ })

/******/ });