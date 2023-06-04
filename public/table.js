/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/table/fetch.js":
/*!*******************************!*\
  !*** ./assets/table/fetch.js ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "get": () => (/* binding */ get),
/* harmony export */   "load": () => (/* binding */ load),
/* harmony export */   "post": () => (/* binding */ post)
/* harmony export */ });
// Copyright (c) 2022. | David Annebicque | IUT de Troyes  - All Rights Reserved
// @file /Users/davidannebicque/Sites/intranetV3/assets/js/fetch.js
// @author davidannebicque
// @project intranetV3
// @lastUpdate 27/09/2022 10:25

var request = function request(_url) {
  var params = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
  var method = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'GET';
  var url = _url;
  var options = {
    method: method
  };
  if (method === 'GET') {
    url += "?".concat(new URLSearchParams(params).toString());
  } else {
    options.body = JSON.stringify(params);
    options.headers = {
      'Content-Type': 'application/json;charset=utf-8'
    };
  }
  return fetch(url, options).then(function (response) {
    return response.json();
  });
};
var get = function get(url, params) {
  return request(url, params, 'GET');
};
var post = function post(url, params) {
  return request(url, params, 'POST');
};
var load = function load(url, _objet) {
  var objet = _objet;
  // todo: a tester. window.da.loader.display = 'block'
  objet.innerHTML = '';
  fetch(url).then(function (response) {
    return response.text();
  }).then(function (body) {
    objet.innerHTML = body;
    // window.da.loader.display = 'none'
  });
};

/***/ }),

/***/ "./assets/table/table.js":
/*!*******************************!*\
  !*** ./assets/table/table.js ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Table)
/* harmony export */ });
/* harmony import */ var _fetch__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./fetch */ "./assets/table/fetch.js");
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); Object.defineProperty(subClass, "prototype", { writable: false }); if (superClass) _setPrototypeOf(subClass, superClass); }
function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }
function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } else if (call !== void 0) { throw new TypeError("Derived constructors may only return object or undefined"); } return _assertThisInitialized(self); }
function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }
function _wrapNativeSuper(Class) { var _cache = typeof Map === "function" ? new Map() : undefined; _wrapNativeSuper = function _wrapNativeSuper(Class) { if (Class === null || !_isNativeFunction(Class)) return Class; if (typeof Class !== "function") { throw new TypeError("Super expression must either be null or a function"); } if (typeof _cache !== "undefined") { if (_cache.has(Class)) return _cache.get(Class); _cache.set(Class, Wrapper); } function Wrapper() { return _construct(Class, arguments, _getPrototypeOf(this).constructor); } Wrapper.prototype = Object.create(Class.prototype, { constructor: { value: Wrapper, enumerable: false, writable: true, configurable: true } }); return _setPrototypeOf(Wrapper, Class); }; return _wrapNativeSuper(Class); }
function _construct(Parent, args, Class) { if (_isNativeReflectConstruct()) { _construct = Reflect.construct.bind(); } else { _construct = function _construct(Parent, args, Class) { var a = [null]; a.push.apply(a, args); var Constructor = Function.bind.apply(Parent, a); var instance = new Constructor(); if (Class) _setPrototypeOf(instance, Class.prototype); return instance; }; } return _construct.apply(null, arguments); }
function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }
function _isNativeFunction(fn) { return Function.toString.call(fn).indexOf("[native code]") !== -1; }
function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }
function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }
// Copyright (c) 2022. | David Annebicque | IUT de Troyes  - All Rights Reserved
// @file /Users/davidannebicque/Sites/intranetV3/assets/components/table.js
// @author davidannebicque
// @project intranetV3
// @lastUpdate 21/10/2022 14:50


var ASC = 'ASC';
var DESC = 'DESC';
var ICON_DESC = '&#9660;';
var ICON_ASC = '&#9650;';
var ICON_NONE = '&#9650;&#9660;';
var Table = /*#__PURE__*/function (_HTMLElement) {
  _inherits(Table, _HTMLElement);
  var _super = _createSuper(Table);
  function Table() {
    var _this;
    _classCallCheck(this, Table);
    _this = _super.call(this);
    _this.div = _assertThisInitialized(_this);
    _this.options = JSON.parse(_this.dataset.options);
    _this.base_url = _this.options.ajax.url;
    _this.table = _this.querySelector('table.datable');
    _this.tableBody = _this.table.querySelector('tbody');
    _this.pageActive = _this.options.pageActive; // par défaut on récupère
    _this.nbElementPerPage = _this.options.pageLength;
    _this.order = [];
    _this.filter = {};
    _this.tableBody.innerHTML = '';
    _this.options.columns.forEach(function (column) {
      if (column.orderable === true) {
        if (column.order != null) {
          _this.order = [{
            column: column.id,
            order: column.order
          }];
        }
        document.getElementById(column.id).style.cursor = 'pointer';
        document.getElementById(column.id).addEventListener('click', function (elem) {
          _this.order = [{
            column: elem.target.id,
            order: elem.target.dataset.order
            // todo: ordre actuel... a inverser dans la requete? Mettre les deux fleches
            // si pas trié ? si defaultorder = false?
          }];
          // todo: mettre à jour le sens de la fleche...
          _this._updateHeader();
          _this._buildArray();
        });
      }
    });
    _this.form = _this.getElementsByTagName('form');
    var btnErase = document.getElementById('eraseFiltre');
    if (btnErase != null) {
      btnErase.addEventListener('click', function (elem) {
        elem.preventDefault();
        _this.filter = {};
        _this._clearForm();
        _this._buildArray();
      });
    }
    // ajout des events sur le form
    _this.inputs = _this.form[0].getElementsByTagName('input');
    _this.selects = _this.form[0].getElementsByTagName('select');
    Array.from(_this.inputs).forEach(function (input) {
      if (input.type === 'text') {
        input.addEventListener('keyup', function (event) {
          if (event.target.type === 'text' && event.target.value.length < 3) {
            // on ne déclenche rien si moins de 3 caractères
            return;
          }
          _this._getFilterFromField(event.target);
          _this._buildArray();
        });
      }
      if (input.type === 'radio' || input.type === 'checkbox') {
        input.addEventListener('change', function (elem) {
          _this._getFilterFromField(elem.target);
          _this._filterArray();
        });
      }
    });
    Array.from(_this.selects).forEach(function (select) {
      select.addEventListener('change', function (elem) {
        _this._getFilterFromField(elem.target);
        _this._filterArray();
      });
    });
    if (_this.options.paging === true) {
      var selectHaut = document.getElementById("".concat(_this.options.paging_id, "_select_haut"));
      var selectBas = document.getElementById("".concat(_this.options.paging_id, "_select_bas"));
      selectHaut.addEventListener('change', function (e) {
        e.preventDefault();
        _this.nbElementPerPage = e.target.value;
        _this._buildArray();
      });
      selectBas.addEventListener('change', function (e) {
        e.preventDefault();
        _this.nbElementPerPage = e.target.value;
        _this._buildArray();
      });
    }
    _this._initHeader();
    _this._buildArray();
    return _this;
  }
  _createClass(Table, [{
    key: "_filterArray",
    value: function _filterArray() {
      this._buildArray();
    }
  }, {
    key: "_updateHeader",
    value: function _updateHeader() {
      // mise à jour du header après un tri
      this.order.forEach(function (order) {
        var column = document.getElementById(order.column);
        if (order.order === ASC) {
          column.innerHTML = "".concat(column.dataset.originalName, " ").concat(ICON_ASC);
          column.dataset.order = 'DESC';
        } else if (order.order === DESC) {
          column.innerHTML = "".concat(column.dataset.originalName, " ").concat(ICON_DESC);
          column.dataset.order = 'ASC';
        } else {
          column.innerHTML = "".concat(column.dataset.originalName, " ").concat(ICON_NONE);
          column.dataset.order = 'ASC';
        }
      });
    }
  }, {
    key: "_buildArray",
    value: function _buildArray() {
      var _this2 = this;
      this.tableBody.innerHTML = '';
      (0,_fetch__WEBPACK_IMPORTED_MODULE_0__.post)(this.base_url, {
        paging: {
          pageLength: this.nbElementPerPage,
          pageActive: this.pageActive
        },
        order: this.order,
        filter: this.filter
      }).then(function (data) {
        if (data.data.length > 0) {
          data.data.forEach(function (item) {
            var html = '<tr>';
            _this2.options.columns.forEach(function (column) {
              html += "<td>".concat(item[column.id], "</td>");
            });
            html += '</tr>';
            _this2.tableBody.innerHTML += html;
          });
        } else {
          var html = '<tr>';
          html += "<td colspan=\"".concat(_this2.options.columns.length, "\" class=\"text-center\">Pas de donn\xE9es.</td>");
          html += '</tr>';
          _this2.tableBody.innerHTML = html;
        }
        _this2._updatePagination(data.paging);
      });
    }
  }, {
    key: "_initHeader",
    value: function _initHeader() {
      this.options.columns.forEach(function (column) {
        var texte = document.getElementById(column.id).innerText;
        document.getElementById(column.id).dataset.originalName = texte;
        if (column.orderable === true) {
          if (column.order === DESC) {
            document.getElementById(column.id).innerHTML = "".concat(texte, " ").concat(ICON_DESC);
            document.getElementById(column.id).dataset.order = DESC;
          } else if (column.order === ASC) {
            document.getElementById(column.id).innerHTML = "".concat(texte, " ").concat(ICON_ASC);
            document.getElementById(column.id).dataset.order = ASC;
          } else {
            document.getElementById(column.id).innerHTML = "".concat(texte, " ").concat(ICON_NONE);
            document.getElementById(column.id).dataset.order = ASC;
          }
        }
      });
    }
  }, {
    key: "_updatePagination",
    value: function _updatePagination(paging) {
      var _this3 = this;
      var nav = document.querySelectorAll(".".concat(this.options.paging_id, "_nav"));
      var previousDisabled = paging.firstPage === true ? 'disabled' : '';
      var nextDisabled = paging.lastPage === true ? 'disabled' : '';
      var pageCutLow = paging.numActivePage - 1;
      var pageCutHigh = paging.numActivePage + 1;
      var html = "<ul class=\"pagination justify-content-end\">\n                        <li class=\"page-item ".concat(previousDisabled, "\">\n                            <a class=\"page-link\" href=\"#\">\n                                <span class=\"fas fa-arrow-left\"></span>\n                            </a>\n                        </li>");
      // 10 pages, on affiche tout
      if (paging.nbPages <= 10) {
        for (var i = 1; i <= paging.nbPages; i += 1) {
          var pageActive = i === paging.numActivePage ? 'active' : '';
          html += "<li class=\"page-item ".concat(pageActive, "\">\n                  <a class=\"page-link\" href=\"#\">").concat(i, "</a>\n               </li>");
        }
      } else {
        // Show the very first page followed by a "..." at the beginning of the
        // pagination section (after the Previous button)
        if (paging.numActivePage > 2) {
          html += '<li class="page-item"><a class="page-link" href="#">1</a></li>';
          if (paging.numActivePage > 3) {
            var pag = paging.numActivePage - 2;
            html += "<li class=\"page-item\"><a class=\"page-link\" href=\"#\" data-page=\"".concat(pag, "\">...</a></li>");
          }
        }
        // Determine how many pages to show after the current page index
        if (paging.numActivePage === 1) {
          pageCutHigh += 2;
        } else if (paging.numActivePage === 2) {
          pageCutHigh += 1;
        }
        // Determine how many pages to show before the current page index
        if (paging.numActivePage === paging.nbPages) {
          pageCutLow -= 2;
        } else if (paging.numActivePage === paging.nbPages - 1) {
          pageCutLow -= 1;
        }
        // Output the indexes for pages that fall inside the range of pageCutLow
        // and pageCutHigh
        for (var p = pageCutLow; p <= pageCutHigh; p++) {
          if (p === 0) {
            p += 1;
          }
          if (p > paging.nbPages) {
            continue;
          }
          var _pageActive = p === paging.numActivePage ? 'active' : '';
          html += "<li class=\"page-item ".concat(_pageActive, "\"><a class=\"page-link\" href=\"#\">").concat(p, "</a></li>");
        }
        // Show the very last page preceded by a "..." at the end of the pagination
        // section (before the Next button)
        if (paging.numActivePage < paging.nbPages - 1) {
          if (paging.numActivePage < paging.nbPages - 2) {
            var _pag = 0;
            if (paging.numActivePage === 1) {
              _pag = paging.numActivePage + 4;
            } else {
              _pag = paging.numActivePage + 2;
            }
            html += "<li class=\"page-item\"><a class=\"page-link\" href=\"#\" data-page=\"".concat(_pag, "\">...</a></li>");
          }
          html += "<li class=\"page-item\"><a class=\"page-link\" href=\"#\">".concat(paging.nbPages, "</a></li>");
        }
      }
      html += "<li class=\"page-item ".concat(nextDisabled, "\">\n                  <a class=\"page-link\" href=\"#\">\n                      <span class=\"fas fa-arrow-right\"></span>\n                  </a>\n              </li>\n          </ul>");
      nav.forEach(function (element) {
        element.innerHTML = html;
      });
      this.div.querySelectorAll('.page-link').forEach(function (element) {
        element.addEventListener('click', function (e) {
          var page = e.target.innerText;
          if (page === '...') {
            page = e.target.dataset.page;
          }
          _this3.pageActive = page;
          _this3._buildArray();
        });
      });
    }
  }, {
    key: "_getFilterFromField",
    value: function _getFilterFromField(input) {
      var name = Table._extractNameFromForm(input.name);
      switch (input.type) {
        case 'checkbox':
          if (input.checked === true) {
            if (!(name in this.filter)) {
              this.filter[name] = [];
            }
            this.filter[name].push(input.value);
          }
          break;
        default:
          this.filter[name] = input.value;
          break;
      }
    }
  }, {
    key: "_clearForm",
    value: function _clearForm() {
      Array.from(this.inputs).forEach(function (input) {
        if (input.type === 'text') {
          input.value = '';
        }
        if (input.type === 'radio' || input.type === 'checkbox') {
          input.checked = false;
        }
      });
      Array.from(this.selects).forEach(function (select) {
        select.value = '';
      });
    }
  }], [{
    key: "_extractNameFromForm",
    value: function _extractNameFromForm(name) {
      var t = name.split('[');
      return t[1].substr(0, t[1].length - 1);
    }
  }]);
  return Table;
}( /*#__PURE__*/_wrapNativeSuper(HTMLElement));


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!*******************************!*\
  !*** ./assets/tableBundle.js ***!
  \*******************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _table_table__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./table/table */ "./assets/table/table.js");

customElements.define('my-table', _table_table__WEBPACK_IMPORTED_MODULE_0__["default"]);
})();

/******/ })()
;
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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QTtBQUFBLGlDQTFRZ0N1QyxXQUFXOzs7Ozs7O1VDZjlDO1VBQ0E7O1VBRUE7VUFDQTtVQUNBO1VBQ0E7VUFDQTtVQUNBO1VBQ0E7VUFDQTtVQUNBO1VBQ0E7VUFDQTtVQUNBO1VBQ0E7O1VBRUE7VUFDQTs7VUFFQTtVQUNBO1VBQ0E7Ozs7O1dDdEJBO1dBQ0E7V0FDQTtXQUNBO1dBQ0EseUNBQXlDLHdDQUF3QztXQUNqRjtXQUNBO1dBQ0E7Ozs7O1dDUEE7Ozs7O1dDQUE7V0FDQTtXQUNBO1dBQ0EsdURBQXVELGlCQUFpQjtXQUN4RTtXQUNBLGdEQUFnRCxhQUFhO1dBQzdEOzs7Ozs7Ozs7Ozs7QUNOaUM7QUFFakNDLGNBQWMsQ0FBQ0MsTUFBTSxDQUFDLFVBQVUsRUFBRWxGLG9EQUFLLENBQUMsQyIsInNvdXJjZXMiOlsid2VicGFjazovL3RhYmxlYnVuZGxlLy4vYXNzZXRzL3RhYmxlL2ZldGNoLmpzIiwid2VicGFjazovL3RhYmxlYnVuZGxlLy4vYXNzZXRzL3RhYmxlL3RhYmxlLmpzIiwid2VicGFjazovL3RhYmxlYnVuZGxlL3dlYnBhY2svYm9vdHN0cmFwIiwid2VicGFjazovL3RhYmxlYnVuZGxlL3dlYnBhY2svcnVudGltZS9kZWZpbmUgcHJvcGVydHkgZ2V0dGVycyIsIndlYnBhY2s6Ly90YWJsZWJ1bmRsZS93ZWJwYWNrL3J1bnRpbWUvaGFzT3duUHJvcGVydHkgc2hvcnRoYW5kIiwid2VicGFjazovL3RhYmxlYnVuZGxlL3dlYnBhY2svcnVudGltZS9tYWtlIG5hbWVzcGFjZSBvYmplY3QiLCJ3ZWJwYWNrOi8vdGFibGVidW5kbGUvLi9hc3NldHMvdGFibGVCdW5kbGUuanMiXSwic291cmNlc0NvbnRlbnQiOlsiLy8gQ29weXJpZ2h0IChjKSAyMDIyLiB8IERhdmlkIEFubmViaWNxdWUgfCBJVVQgZGUgVHJveWVzICAtIEFsbCBSaWdodHMgUmVzZXJ2ZWRcbi8vIEBmaWxlIC9Vc2Vycy9kYXZpZGFubmViaWNxdWUvU2l0ZXMvaW50cmFuZXRWMy9hc3NldHMvanMvZmV0Y2guanNcbi8vIEBhdXRob3IgZGF2aWRhbm5lYmljcXVlXG4vLyBAcHJvamVjdCBpbnRyYW5ldFYzXG4vLyBAbGFzdFVwZGF0ZSAyNy8wOS8yMDIyIDEwOjI1XG5cbmNvbnN0IHJlcXVlc3QgPSAoX3VybCwgcGFyYW1zID0ge30sIG1ldGhvZCA9ICdHRVQnKSA9PiB7XG4gIGxldCB1cmwgPSBfdXJsXG4gIGNvbnN0IG9wdGlvbnMgPSB7XG4gICAgbWV0aG9kLFxuICB9XG4gIGlmIChtZXRob2QgPT09ICdHRVQnKSB7XG4gICAgdXJsICs9IGA/JHsobmV3IFVSTFNlYXJjaFBhcmFtcyhwYXJhbXMpKS50b1N0cmluZygpfWBcbiAgfSBlbHNlIHtcbiAgICBvcHRpb25zLmJvZHkgPSBKU09OLnN0cmluZ2lmeShwYXJhbXMpXG4gICAgb3B0aW9ucy5oZWFkZXJzID0ge1xuICAgICAgJ0NvbnRlbnQtVHlwZSc6ICdhcHBsaWNhdGlvbi9qc29uO2NoYXJzZXQ9dXRmLTgnLFxuICAgIH1cbiAgfVxuXG4gIHJldHVybiBmZXRjaCh1cmwsIG9wdGlvbnMpLnRoZW4oKHJlc3BvbnNlKSA9PiByZXNwb25zZS5qc29uKCkpXG59XG5cbmV4cG9ydCBjb25zdCBnZXQgPSAodXJsLCBwYXJhbXMpID0+IHJlcXVlc3QodXJsLCBwYXJhbXMsICdHRVQnKVxuZXhwb3J0IGNvbnN0IHBvc3QgPSAodXJsLCBwYXJhbXMpID0+IHJlcXVlc3QodXJsLCBwYXJhbXMsICdQT1NUJylcblxuZXhwb3J0IGNvbnN0IGxvYWQgPSAodXJsLCBfb2JqZXQpID0+IHtcbiAgY29uc3Qgb2JqZXQgPSBfb2JqZXRcbiAgLy8gdG9kbzogYSB0ZXN0ZXIuIHdpbmRvdy5kYS5sb2FkZXIuZGlzcGxheSA9ICdibG9jaydcbiAgb2JqZXQuaW5uZXJIVE1MID0gJydcbiAgZmV0Y2godXJsKVxuICAgIC50aGVuKChyZXNwb25zZSkgPT4gcmVzcG9uc2UudGV4dCgpKVxuICAgIC50aGVuKChib2R5KSA9PiB7XG4gICAgICBvYmpldC5pbm5lckhUTUwgPSBib2R5XG4gICAgICAvLyB3aW5kb3cuZGEubG9hZGVyLmRpc3BsYXkgPSAnbm9uZSdcbiAgICB9KVxufVxuIiwiLy8gQ29weXJpZ2h0IChjKSAyMDIyLiB8IERhdmlkIEFubmViaWNxdWUgfCBJVVQgZGUgVHJveWVzICAtIEFsbCBSaWdodHMgUmVzZXJ2ZWRcbi8vIEBmaWxlIC9Vc2Vycy9kYXZpZGFubmViaWNxdWUvU2l0ZXMvaW50cmFuZXRWMy9hc3NldHMvY29tcG9uZW50cy90YWJsZS5qc1xuLy8gQGF1dGhvciBkYXZpZGFubmViaWNxdWVcbi8vIEBwcm9qZWN0IGludHJhbmV0VjNcbi8vIEBsYXN0VXBkYXRlIDIxLzEwLzIwMjIgMTQ6NTBcblxuaW1wb3J0IHsgcG9zdCB9IGZyb20gJy4vZmV0Y2gnXG5cbmNvbnN0IEFTQyA9ICdBU0MnXG5jb25zdCBERVNDID0gJ0RFU0MnXG5cbmNvbnN0IElDT05fREVTQyA9ICcmIzk2NjA7J1xuY29uc3QgSUNPTl9BU0MgPSAnJiM5NjUwOydcbmNvbnN0IElDT05fTk9ORSA9ICcmIzk2NTA7JiM5NjYwOydcblxuZXhwb3J0IGRlZmF1bHQgY2xhc3MgVGFibGUgZXh0ZW5kcyBIVE1MRWxlbWVudCB7XG4gIGNvbnN0cnVjdG9yKCkge1xuICAgIHN1cGVyKClcbiAgICB0aGlzLmRpdiA9IHRoaXNcblxuICAgIHRoaXMub3B0aW9ucyA9IEpTT04ucGFyc2UodGhpcy5kYXRhc2V0Lm9wdGlvbnMpXG4gICAgdGhpcy5iYXNlX3VybCA9IHRoaXMub3B0aW9ucy5hamF4LnVybFxuXG4gICAgdGhpcy50YWJsZSA9IHRoaXMucXVlcnlTZWxlY3RvcigndGFibGUuZGF0YWJsZScpXG4gICAgdGhpcy50YWJsZUJvZHkgPSB0aGlzLnRhYmxlLnF1ZXJ5U2VsZWN0b3IoJ3Rib2R5JylcbiAgICB0aGlzLnBhZ2VBY3RpdmUgPSB0aGlzLm9wdGlvbnMucGFnZUFjdGl2ZSAvLyBwYXIgZMOpZmF1dCBvbiByw6ljdXDDqHJlXG4gICAgdGhpcy5uYkVsZW1lbnRQZXJQYWdlID0gdGhpcy5vcHRpb25zLnBhZ2VMZW5ndGhcbiAgICB0aGlzLm9yZGVyID0gW11cbiAgICB0aGlzLmZpbHRlciA9IHt9XG5cbiAgICB0aGlzLnRhYmxlQm9keS5pbm5lckhUTUwgPSAnJ1xuICAgIHRoaXMub3B0aW9ucy5jb2x1bW5zLmZvckVhY2goKGNvbHVtbikgPT4ge1xuICAgICAgaWYgKGNvbHVtbi5vcmRlcmFibGUgPT09IHRydWUpIHtcbiAgICAgICAgaWYgKGNvbHVtbi5vcmRlciAhPSBudWxsKSB7XG4gICAgICAgICAgdGhpcy5vcmRlciA9IFt7XG4gICAgICAgICAgICBjb2x1bW46IGNvbHVtbi5pZCxcbiAgICAgICAgICAgIG9yZGVyOiBjb2x1bW4ub3JkZXIsXG4gICAgICAgICAgfV1cbiAgICAgICAgfVxuXG4gICAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKGNvbHVtbi5pZCkuc3R5bGUuY3Vyc29yID0gJ3BvaW50ZXInXG4gICAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKGNvbHVtbi5pZCkuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCAoZWxlbSkgPT4ge1xuICAgICAgICAgIHRoaXMub3JkZXIgPSBbe1xuICAgICAgICAgICAgY29sdW1uOiBlbGVtLnRhcmdldC5pZCxcbiAgICAgICAgICAgIG9yZGVyOiBlbGVtLnRhcmdldC5kYXRhc2V0Lm9yZGVyLFxuICAgICAgICAgICAgLy8gdG9kbzogb3JkcmUgYWN0dWVsLi4uIGEgaW52ZXJzZXIgZGFucyBsYSByZXF1ZXRlPyBNZXR0cmUgbGVzIGRldXggZmxlY2hlc1xuICAgICAgICAgICAgLy8gc2kgcGFzIHRyacOpID8gc2kgZGVmYXVsdG9yZGVyID0gZmFsc2U/XG4gICAgICAgICAgfV1cbiAgICAgICAgICAvLyB0b2RvOiBtZXR0cmUgw6Agam91ciBsZSBzZW5zIGRlIGxhIGZsZWNoZS4uLlxuICAgICAgICAgIHRoaXMuX3VwZGF0ZUhlYWRlcigpXG4gICAgICAgICAgdGhpcy5fYnVpbGRBcnJheSgpXG4gICAgICAgIH0pXG4gICAgICB9XG4gICAgfSlcblxuICAgIHRoaXMuZm9ybSA9IHRoaXMuZ2V0RWxlbWVudHNCeVRhZ05hbWUoJ2Zvcm0nKVxuICAgIGNvbnN0IGJ0bkVyYXNlID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2VyYXNlRmlsdHJlJylcbiAgICBpZiAoYnRuRXJhc2UgIT0gbnVsbCkge1xuICAgICAgYnRuRXJhc2UuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCAoZWxlbSkgPT4ge1xuICAgICAgICBlbGVtLnByZXZlbnREZWZhdWx0KClcbiAgICAgICAgdGhpcy5maWx0ZXIgPSB7fVxuICAgICAgICB0aGlzLl9jbGVhckZvcm0oKVxuICAgICAgICB0aGlzLl9idWlsZEFycmF5KClcbiAgICAgIH0pXG4gICAgfVxuICAgIC8vIGFqb3V0IGRlcyBldmVudHMgc3VyIGxlIGZvcm1cbiAgICB0aGlzLmlucHV0cyA9IHRoaXMuZm9ybVswXS5nZXRFbGVtZW50c0J5VGFnTmFtZSgnaW5wdXQnKVxuICAgIHRoaXMuc2VsZWN0cyA9IHRoaXMuZm9ybVswXS5nZXRFbGVtZW50c0J5VGFnTmFtZSgnc2VsZWN0JylcbiAgICBBcnJheS5mcm9tKHRoaXMuaW5wdXRzKS5mb3JFYWNoKChpbnB1dCkgPT4ge1xuICAgICAgaWYgKGlucHV0LnR5cGUgPT09ICd0ZXh0Jykge1xuICAgICAgICBpbnB1dC5hZGRFdmVudExpc3RlbmVyKCdrZXl1cCcsIChldmVudCkgPT4ge1xuICAgICAgICAgIGlmIChldmVudC50YXJnZXQudHlwZSA9PT0gJ3RleHQnICYmIGV2ZW50LnRhcmdldC52YWx1ZS5sZW5ndGggPCAzKSB7XG4gICAgICAgICAgICAvLyBvbiBuZSBkw6ljbGVuY2hlIHJpZW4gc2kgbW9pbnMgZGUgMyBjYXJhY3TDqHJlc1xuICAgICAgICAgICAgcmV0dXJuXG4gICAgICAgICAgfVxuXG4gICAgICAgICAgdGhpcy5fZ2V0RmlsdGVyRnJvbUZpZWxkKGV2ZW50LnRhcmdldClcbiAgICAgICAgICB0aGlzLl9idWlsZEFycmF5KClcbiAgICAgICAgfSlcbiAgICAgIH1cblxuICAgICAgaWYgKGlucHV0LnR5cGUgPT09ICdyYWRpbycgfHwgaW5wdXQudHlwZSA9PT0gJ2NoZWNrYm94Jykge1xuICAgICAgICBpbnB1dC5hZGRFdmVudExpc3RlbmVyKCdjaGFuZ2UnLCAoZWxlbSkgPT4ge1xuICAgICAgICAgIHRoaXMuX2dldEZpbHRlckZyb21GaWVsZChlbGVtLnRhcmdldClcbiAgICAgICAgICB0aGlzLl9maWx0ZXJBcnJheSgpXG4gICAgICAgIH0pXG4gICAgICB9XG4gICAgfSlcblxuICAgIEFycmF5LmZyb20odGhpcy5zZWxlY3RzKS5mb3JFYWNoKChzZWxlY3QpID0+IHtcbiAgICAgIHNlbGVjdC5hZGRFdmVudExpc3RlbmVyKCdjaGFuZ2UnLCAoZWxlbSkgPT4ge1xuICAgICAgICB0aGlzLl9nZXRGaWx0ZXJGcm9tRmllbGQoZWxlbS50YXJnZXQpXG4gICAgICAgIHRoaXMuX2ZpbHRlckFycmF5KClcbiAgICAgIH0pXG4gICAgfSlcblxuICAgIGlmICh0aGlzLm9wdGlvbnMucGFnaW5nID09PSB0cnVlKSB7XG4gICAgICBjb25zdCBzZWxlY3RIYXV0ID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoYCR7dGhpcy5vcHRpb25zLnBhZ2luZ19pZH1fc2VsZWN0X2hhdXRgKVxuICAgICAgY29uc3Qgc2VsZWN0QmFzID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoYCR7dGhpcy5vcHRpb25zLnBhZ2luZ19pZH1fc2VsZWN0X2Jhc2ApXG4gICAgICBzZWxlY3RIYXV0LmFkZEV2ZW50TGlzdGVuZXIoJ2NoYW5nZScsIChlKSA9PiB7XG4gICAgICAgIGUucHJldmVudERlZmF1bHQoKVxuICAgICAgICB0aGlzLm5iRWxlbWVudFBlclBhZ2UgPSBlLnRhcmdldC52YWx1ZVxuICAgICAgICB0aGlzLl9idWlsZEFycmF5KClcbiAgICAgIH0pXG4gICAgICBzZWxlY3RCYXMuYWRkRXZlbnRMaXN0ZW5lcignY2hhbmdlJywgKGUpID0+IHtcbiAgICAgICAgZS5wcmV2ZW50RGVmYXVsdCgpXG4gICAgICAgIHRoaXMubmJFbGVtZW50UGVyUGFnZSA9IGUudGFyZ2V0LnZhbHVlXG4gICAgICAgIHRoaXMuX2J1aWxkQXJyYXkoKVxuICAgICAgfSlcbiAgICB9XG5cbiAgICB0aGlzLl9pbml0SGVhZGVyKClcbiAgICB0aGlzLl9idWlsZEFycmF5KClcbiAgfVxuXG4gIF9maWx0ZXJBcnJheSgpIHtcbiAgICB0aGlzLl9idWlsZEFycmF5KClcbiAgfVxuXG4gIF91cGRhdGVIZWFkZXIoKSB7XG4gICAgLy8gbWlzZSDDoCBqb3VyIGR1IGhlYWRlciBhcHLDqHMgdW4gdHJpXG4gICAgdGhpcy5vcmRlci5mb3JFYWNoKChvcmRlcikgPT4ge1xuICAgICAgY29uc3QgY29sdW1uID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQob3JkZXIuY29sdW1uKVxuICAgICAgaWYgKG9yZGVyLm9yZGVyID09PSBBU0MpIHtcbiAgICAgICAgY29sdW1uLmlubmVySFRNTCA9IGAke2NvbHVtbi5kYXRhc2V0Lm9yaWdpbmFsTmFtZX0gJHtJQ09OX0FTQ31gXG4gICAgICAgIGNvbHVtbi5kYXRhc2V0Lm9yZGVyID0gJ0RFU0MnXG4gICAgICB9IGVsc2UgaWYgKG9yZGVyLm9yZGVyID09PSBERVNDKSB7XG4gICAgICAgIGNvbHVtbi5pbm5lckhUTUwgPSBgJHtjb2x1bW4uZGF0YXNldC5vcmlnaW5hbE5hbWV9ICR7SUNPTl9ERVNDfWBcbiAgICAgICAgY29sdW1uLmRhdGFzZXQub3JkZXIgPSAnQVNDJ1xuICAgICAgfSBlbHNlIHtcbiAgICAgICAgY29sdW1uLmlubmVySFRNTCA9IGAke2NvbHVtbi5kYXRhc2V0Lm9yaWdpbmFsTmFtZX0gJHtJQ09OX05PTkV9YFxuICAgICAgICBjb2x1bW4uZGF0YXNldC5vcmRlciA9ICdBU0MnXG4gICAgICB9XG4gICAgfSlcbiAgfVxuXG4gIF9idWlsZEFycmF5KCkge1xuICAgIHRoaXMudGFibGVCb2R5LmlubmVySFRNTCA9ICcnXG4gICAgcG9zdCh0aGlzLmJhc2VfdXJsLCB7XG4gICAgICBwYWdpbmc6IHtcbiAgICAgICAgcGFnZUxlbmd0aDogdGhpcy5uYkVsZW1lbnRQZXJQYWdlLFxuICAgICAgICBwYWdlQWN0aXZlOiB0aGlzLnBhZ2VBY3RpdmUsXG4gICAgICB9LFxuICAgICAgb3JkZXI6IHRoaXMub3JkZXIsXG4gICAgICBmaWx0ZXI6IHRoaXMuZmlsdGVyLFxuICAgIH0pLnRoZW4oKGRhdGEpID0+IHtcbiAgICAgIGlmIChkYXRhLmRhdGEubGVuZ3RoID4gMCkge1xuICAgICAgICBkYXRhLmRhdGEuZm9yRWFjaCgoaXRlbSkgPT4ge1xuICAgICAgICAgIGxldCBodG1sID0gJzx0cj4nXG4gICAgICAgICAgdGhpcy5vcHRpb25zLmNvbHVtbnMuZm9yRWFjaCgoY29sdW1uKSA9PiB7XG4gICAgICAgICAgICBodG1sICs9IGA8dGQ+JHtpdGVtW2NvbHVtbi5pZF19PC90ZD5gXG4gICAgICAgICAgfSlcbiAgICAgICAgICBodG1sICs9ICc8L3RyPidcbiAgICAgICAgICB0aGlzLnRhYmxlQm9keS5pbm5lckhUTUwgKz0gaHRtbFxuICAgICAgICB9KVxuICAgICAgfSBlbHNlIHtcbiAgICAgICAgbGV0IGh0bWwgPSAnPHRyPidcbiAgICAgICAgaHRtbCArPSBgPHRkIGNvbHNwYW49XCIke3RoaXMub3B0aW9ucy5jb2x1bW5zLmxlbmd0aH1cIiBjbGFzcz1cInRleHQtY2VudGVyXCI+UGFzIGRlIGRvbm7DqWVzLjwvdGQ+YFxuICAgICAgICBodG1sICs9ICc8L3RyPidcbiAgICAgICAgdGhpcy50YWJsZUJvZHkuaW5uZXJIVE1MID0gaHRtbFxuICAgICAgfVxuICAgICAgdGhpcy5fdXBkYXRlUGFnaW5hdGlvbihkYXRhLnBhZ2luZylcbiAgICB9KVxuICB9XG5cbiAgX2luaXRIZWFkZXIoKSB7XG4gICAgdGhpcy5vcHRpb25zLmNvbHVtbnMuZm9yRWFjaCgoY29sdW1uKSA9PiB7XG4gICAgICBjb25zdCB0ZXh0ZSA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKGNvbHVtbi5pZCkuaW5uZXJUZXh0XG4gICAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChjb2x1bW4uaWQpLmRhdGFzZXQub3JpZ2luYWxOYW1lID0gdGV4dGVcbiAgICAgIGlmIChjb2x1bW4ub3JkZXJhYmxlID09PSB0cnVlKSB7XG4gICAgICAgIGlmIChjb2x1bW4ub3JkZXIgPT09IERFU0MpIHtcbiAgICAgICAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChjb2x1bW4uaWQpLmlubmVySFRNTCA9IGAke3RleHRlfSAke0lDT05fREVTQ31gXG4gICAgICAgICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoY29sdW1uLmlkKS5kYXRhc2V0Lm9yZGVyID0gREVTQ1xuICAgICAgICB9IGVsc2UgaWYgKGNvbHVtbi5vcmRlciA9PT0gQVNDKSB7XG4gICAgICAgICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoY29sdW1uLmlkKS5pbm5lckhUTUwgPSBgJHt0ZXh0ZX0gJHtJQ09OX0FTQ31gXG4gICAgICAgICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoY29sdW1uLmlkKS5kYXRhc2V0Lm9yZGVyID0gQVNDXG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoY29sdW1uLmlkKS5pbm5lckhUTUwgPSBgJHt0ZXh0ZX0gJHtJQ09OX05PTkV9YFxuICAgICAgICAgIGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKGNvbHVtbi5pZCkuZGF0YXNldC5vcmRlciA9IEFTQ1xuICAgICAgICB9XG4gICAgICB9XG4gICAgfSlcbiAgfVxuXG4gIF91cGRhdGVQYWdpbmF0aW9uKHBhZ2luZykge1xuICAgIGNvbnN0IG5hdiA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoYC4ke3RoaXMub3B0aW9ucy5wYWdpbmdfaWR9X25hdmApXG4gICAgY29uc3QgcHJldmlvdXNEaXNhYmxlZCA9IHBhZ2luZy5maXJzdFBhZ2UgPT09IHRydWUgPyAnZGlzYWJsZWQnIDogJydcbiAgICBjb25zdCBuZXh0RGlzYWJsZWQgPSBwYWdpbmcubGFzdFBhZ2UgPT09IHRydWUgPyAnZGlzYWJsZWQnIDogJydcbiAgICBsZXQgcGFnZUN1dExvdyA9IHBhZ2luZy5udW1BY3RpdmVQYWdlIC0gMVxuICAgIGxldCBwYWdlQ3V0SGlnaCA9IHBhZ2luZy5udW1BY3RpdmVQYWdlICsgMVxuXG4gICAgbGV0IGh0bWwgPSBgPHVsIGNsYXNzPVwicGFnaW5hdGlvbiBqdXN0aWZ5LWNvbnRlbnQtZW5kXCI+XG4gICAgICAgICAgICAgICAgICAgICAgICA8bGkgY2xhc3M9XCJwYWdlLWl0ZW0gJHtwcmV2aW91c0Rpc2FibGVkfVwiPlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIDxhIGNsYXNzPVwicGFnZS1saW5rXCIgaHJlZj1cIiNcIj5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPHNwYW4gY2xhc3M9XCJmYXMgZmEtYXJyb3ctbGVmdFwiPjwvc3Bhbj5cbiAgICAgICAgICAgICAgICAgICAgICAgICAgICA8L2E+XG4gICAgICAgICAgICAgICAgICAgICAgICA8L2xpPmBcbiAgICAvLyAxMCBwYWdlcywgb24gYWZmaWNoZSB0b3V0XG4gICAgaWYgKHBhZ2luZy5uYlBhZ2VzIDw9IDEwKSB7XG4gICAgICBmb3IgKGxldCBpID0gMTsgaSA8PSBwYWdpbmcubmJQYWdlczsgaSArPSAxKSB7XG4gICAgICAgIGNvbnN0IHBhZ2VBY3RpdmUgPSBpID09PSBwYWdpbmcubnVtQWN0aXZlUGFnZSA/ICdhY3RpdmUnIDogJydcbiAgICAgICAgaHRtbCArPSBgPGxpIGNsYXNzPVwicGFnZS1pdGVtICR7cGFnZUFjdGl2ZX1cIj5cbiAgICAgICAgICAgICAgICAgIDxhIGNsYXNzPVwicGFnZS1saW5rXCIgaHJlZj1cIiNcIj4ke2l9PC9hPlxuICAgICAgICAgICAgICAgPC9saT5gXG4gICAgICB9XG4gICAgfSBlbHNlIHtcbiAgICAgIC8vIFNob3cgdGhlIHZlcnkgZmlyc3QgcGFnZSBmb2xsb3dlZCBieSBhIFwiLi4uXCIgYXQgdGhlIGJlZ2lubmluZyBvZiB0aGVcbiAgICAgIC8vIHBhZ2luYXRpb24gc2VjdGlvbiAoYWZ0ZXIgdGhlIFByZXZpb3VzIGJ1dHRvbilcbiAgICAgIGlmIChwYWdpbmcubnVtQWN0aXZlUGFnZSA+IDIpIHtcbiAgICAgICAgaHRtbCArPSAnPGxpIGNsYXNzPVwicGFnZS1pdGVtXCI+PGEgY2xhc3M9XCJwYWdlLWxpbmtcIiBocmVmPVwiI1wiPjE8L2E+PC9saT4nXG4gICAgICAgIGlmIChwYWdpbmcubnVtQWN0aXZlUGFnZSA+IDMpIHtcbiAgICAgICAgICBjb25zdCBwYWcgPSBwYWdpbmcubnVtQWN0aXZlUGFnZSAtIDJcbiAgICAgICAgICBodG1sICs9IGA8bGkgY2xhc3M9XCJwYWdlLWl0ZW1cIj48YSBjbGFzcz1cInBhZ2UtbGlua1wiIGhyZWY9XCIjXCIgZGF0YS1wYWdlPVwiJHtwYWd9XCI+Li4uPC9hPjwvbGk+YFxuICAgICAgICB9XG4gICAgICB9XG4gICAgICAvLyBEZXRlcm1pbmUgaG93IG1hbnkgcGFnZXMgdG8gc2hvdyBhZnRlciB0aGUgY3VycmVudCBwYWdlIGluZGV4XG4gICAgICBpZiAocGFnaW5nLm51bUFjdGl2ZVBhZ2UgPT09IDEpIHtcbiAgICAgICAgcGFnZUN1dEhpZ2ggKz0gMlxuICAgICAgfSBlbHNlIGlmIChwYWdpbmcubnVtQWN0aXZlUGFnZSA9PT0gMikge1xuICAgICAgICBwYWdlQ3V0SGlnaCArPSAxXG4gICAgICB9XG4gICAgICAvLyBEZXRlcm1pbmUgaG93IG1hbnkgcGFnZXMgdG8gc2hvdyBiZWZvcmUgdGhlIGN1cnJlbnQgcGFnZSBpbmRleFxuICAgICAgaWYgKHBhZ2luZy5udW1BY3RpdmVQYWdlID09PSBwYWdpbmcubmJQYWdlcykge1xuICAgICAgICBwYWdlQ3V0TG93IC09IDJcbiAgICAgIH0gZWxzZSBpZiAocGFnaW5nLm51bUFjdGl2ZVBhZ2UgPT09IHBhZ2luZy5uYlBhZ2VzIC0gMSkge1xuICAgICAgICBwYWdlQ3V0TG93IC09IDFcbiAgICAgIH1cbiAgICAgIC8vIE91dHB1dCB0aGUgaW5kZXhlcyBmb3IgcGFnZXMgdGhhdCBmYWxsIGluc2lkZSB0aGUgcmFuZ2Ugb2YgcGFnZUN1dExvd1xuICAgICAgLy8gYW5kIHBhZ2VDdXRIaWdoXG4gICAgICBmb3IgKGxldCBwID0gcGFnZUN1dExvdzsgcCA8PSBwYWdlQ3V0SGlnaDsgcCsrKSB7XG4gICAgICAgIGlmIChwID09PSAwKSB7XG4gICAgICAgICAgcCArPSAxXG4gICAgICAgIH1cbiAgICAgICAgaWYgKHAgPiBwYWdpbmcubmJQYWdlcykge1xuICAgICAgICAgIGNvbnRpbnVlXG4gICAgICAgIH1cbiAgICAgICAgY29uc3QgcGFnZUFjdGl2ZSA9IHAgPT09IHBhZ2luZy5udW1BY3RpdmVQYWdlID8gJ2FjdGl2ZScgOiAnJ1xuICAgICAgICBodG1sICs9IGA8bGkgY2xhc3M9XCJwYWdlLWl0ZW0gJHtwYWdlQWN0aXZlfVwiPjxhIGNsYXNzPVwicGFnZS1saW5rXCIgaHJlZj1cIiNcIj4ke3B9PC9hPjwvbGk+YFxuICAgICAgfVxuICAgICAgLy8gU2hvdyB0aGUgdmVyeSBsYXN0IHBhZ2UgcHJlY2VkZWQgYnkgYSBcIi4uLlwiIGF0IHRoZSBlbmQgb2YgdGhlIHBhZ2luYXRpb25cbiAgICAgIC8vIHNlY3Rpb24gKGJlZm9yZSB0aGUgTmV4dCBidXR0b24pXG4gICAgICBpZiAocGFnaW5nLm51bUFjdGl2ZVBhZ2UgPCBwYWdpbmcubmJQYWdlcyAtIDEpIHtcbiAgICAgICAgaWYgKHBhZ2luZy5udW1BY3RpdmVQYWdlIDwgcGFnaW5nLm5iUGFnZXMgLSAyKSB7XG4gICAgICAgICAgbGV0IHBhZyA9IDBcbiAgICAgICAgICBpZiAocGFnaW5nLm51bUFjdGl2ZVBhZ2UgPT09IDEpIHtcbiAgICAgICAgICAgIHBhZyA9IHBhZ2luZy5udW1BY3RpdmVQYWdlICsgNFxuICAgICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICBwYWcgPSBwYWdpbmcubnVtQWN0aXZlUGFnZSArIDJcbiAgICAgICAgICB9XG4gICAgICAgICAgaHRtbCArPSBgPGxpIGNsYXNzPVwicGFnZS1pdGVtXCI+PGEgY2xhc3M9XCJwYWdlLWxpbmtcIiBocmVmPVwiI1wiIGRhdGEtcGFnZT1cIiR7cGFnfVwiPi4uLjwvYT48L2xpPmBcbiAgICAgICAgfVxuICAgICAgICBodG1sICs9IGA8bGkgY2xhc3M9XCJwYWdlLWl0ZW1cIj48YSBjbGFzcz1cInBhZ2UtbGlua1wiIGhyZWY9XCIjXCI+JHtwYWdpbmcubmJQYWdlc308L2E+PC9saT5gXG4gICAgICB9XG4gICAgfVxuICAgIGh0bWwgKz0gYDxsaSBjbGFzcz1cInBhZ2UtaXRlbSAke25leHREaXNhYmxlZH1cIj5cbiAgICAgICAgICAgICAgICAgIDxhIGNsYXNzPVwicGFnZS1saW5rXCIgaHJlZj1cIiNcIj5cbiAgICAgICAgICAgICAgICAgICAgICA8c3BhbiBjbGFzcz1cImZhcyBmYS1hcnJvdy1yaWdodFwiPjwvc3Bhbj5cbiAgICAgICAgICAgICAgICAgIDwvYT5cbiAgICAgICAgICAgICAgPC9saT5cbiAgICAgICAgICA8L3VsPmBcblxuICAgIG5hdi5mb3JFYWNoKChlbGVtZW50KSA9PiB7XG4gICAgICAgIGVsZW1lbnQuaW5uZXJIVE1MID0gaHRtbFxuICAgIH0pXG5cbiAgICB0aGlzLmRpdi5xdWVyeVNlbGVjdG9yQWxsKCcucGFnZS1saW5rJykuZm9yRWFjaCgoZWxlbWVudCkgPT4ge1xuICAgICAgZWxlbWVudC5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIChlKSA9PiB7XG4gICAgICAgIGxldCBwYWdlID0gZS50YXJnZXQuaW5uZXJUZXh0XG4gICAgICAgIGlmIChwYWdlID09PSAnLi4uJykge1xuICAgICAgICAgIHBhZ2UgPSBlLnRhcmdldC5kYXRhc2V0LnBhZ2VcbiAgICAgICAgfVxuXG4gICAgICAgIHRoaXMucGFnZUFjdGl2ZSA9IHBhZ2VcbiAgICAgICAgdGhpcy5fYnVpbGRBcnJheSgpXG4gICAgICB9KVxuICAgIH0pXG4gIH1cblxuICBzdGF0aWMgX2V4dHJhY3ROYW1lRnJvbUZvcm0obmFtZSkge1xuICAgIGNvbnN0IHQgPSBuYW1lLnNwbGl0KCdbJylcbiAgICByZXR1cm4gdFsxXS5zdWJzdHIoMCwgdFsxXS5sZW5ndGggLSAxKVxuICB9XG5cbiAgX2dldEZpbHRlckZyb21GaWVsZChpbnB1dCkge1xuICAgIGNvbnN0IG5hbWUgPSBUYWJsZS5fZXh0cmFjdE5hbWVGcm9tRm9ybShpbnB1dC5uYW1lKVxuICAgIHN3aXRjaCAoaW5wdXQudHlwZSkge1xuICAgICAgY2FzZSAnY2hlY2tib3gnOlxuICAgICAgICBpZiAoaW5wdXQuY2hlY2tlZCA9PT0gdHJ1ZSkge1xuICAgICAgICAgIGlmICghKG5hbWUgaW4gdGhpcy5maWx0ZXIpKSB7XG4gICAgICAgICAgICB0aGlzLmZpbHRlcltuYW1lXSA9IFtdXG4gICAgICAgICAgfVxuICAgICAgICAgIHRoaXMuZmlsdGVyW25hbWVdLnB1c2goXG4gICAgICAgICAgICBpbnB1dC52YWx1ZSxcbiAgICAgICAgICApXG4gICAgICAgIH1cbiAgICAgICAgYnJlYWtcbiAgICAgIGRlZmF1bHQ6XG4gICAgICAgIHRoaXMuZmlsdGVyW25hbWVdID0gaW5wdXQudmFsdWVcbiAgICAgICAgYnJlYWtcbiAgICB9XG4gIH1cblxuICBfY2xlYXJGb3JtKCkge1xuICAgIEFycmF5LmZyb20odGhpcy5pbnB1dHMpLmZvckVhY2goKGlucHV0KSA9PiB7XG4gICAgICBpZiAoaW5wdXQudHlwZSA9PT0gJ3RleHQnKSB7XG4gICAgICAgIGlucHV0LnZhbHVlID0gJydcbiAgICAgIH1cblxuICAgICAgaWYgKGlucHV0LnR5cGUgPT09ICdyYWRpbycgfHwgaW5wdXQudHlwZSA9PT0gJ2NoZWNrYm94Jykge1xuICAgICAgICBpbnB1dC5jaGVja2VkID0gZmFsc2VcbiAgICAgIH1cbiAgICB9KVxuXG4gICAgQXJyYXkuZnJvbSh0aGlzLnNlbGVjdHMpLmZvckVhY2goKHNlbGVjdCkgPT4ge1xuICAgICAgc2VsZWN0LnZhbHVlID0gJydcbiAgICB9KVxuICB9XG59XG4iLCIvLyBUaGUgbW9kdWxlIGNhY2hlXG52YXIgX193ZWJwYWNrX21vZHVsZV9jYWNoZV9fID0ge307XG5cbi8vIFRoZSByZXF1aXJlIGZ1bmN0aW9uXG5mdW5jdGlvbiBfX3dlYnBhY2tfcmVxdWlyZV9fKG1vZHVsZUlkKSB7XG5cdC8vIENoZWNrIGlmIG1vZHVsZSBpcyBpbiBjYWNoZVxuXHR2YXIgY2FjaGVkTW9kdWxlID0gX193ZWJwYWNrX21vZHVsZV9jYWNoZV9fW21vZHVsZUlkXTtcblx0aWYgKGNhY2hlZE1vZHVsZSAhPT0gdW5kZWZpbmVkKSB7XG5cdFx0cmV0dXJuIGNhY2hlZE1vZHVsZS5leHBvcnRzO1xuXHR9XG5cdC8vIENyZWF0ZSBhIG5ldyBtb2R1bGUgKGFuZCBwdXQgaXQgaW50byB0aGUgY2FjaGUpXG5cdHZhciBtb2R1bGUgPSBfX3dlYnBhY2tfbW9kdWxlX2NhY2hlX19bbW9kdWxlSWRdID0ge1xuXHRcdC8vIG5vIG1vZHVsZS5pZCBuZWVkZWRcblx0XHQvLyBubyBtb2R1bGUubG9hZGVkIG5lZWRlZFxuXHRcdGV4cG9ydHM6IHt9XG5cdH07XG5cblx0Ly8gRXhlY3V0ZSB0aGUgbW9kdWxlIGZ1bmN0aW9uXG5cdF9fd2VicGFja19tb2R1bGVzX19bbW9kdWxlSWRdKG1vZHVsZSwgbW9kdWxlLmV4cG9ydHMsIF9fd2VicGFja19yZXF1aXJlX18pO1xuXG5cdC8vIFJldHVybiB0aGUgZXhwb3J0cyBvZiB0aGUgbW9kdWxlXG5cdHJldHVybiBtb2R1bGUuZXhwb3J0cztcbn1cblxuIiwiLy8gZGVmaW5lIGdldHRlciBmdW5jdGlvbnMgZm9yIGhhcm1vbnkgZXhwb3J0c1xuX193ZWJwYWNrX3JlcXVpcmVfXy5kID0gKGV4cG9ydHMsIGRlZmluaXRpb24pID0+IHtcblx0Zm9yKHZhciBrZXkgaW4gZGVmaW5pdGlvbikge1xuXHRcdGlmKF9fd2VicGFja19yZXF1aXJlX18ubyhkZWZpbml0aW9uLCBrZXkpICYmICFfX3dlYnBhY2tfcmVxdWlyZV9fLm8oZXhwb3J0cywga2V5KSkge1xuXHRcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KGV4cG9ydHMsIGtleSwgeyBlbnVtZXJhYmxlOiB0cnVlLCBnZXQ6IGRlZmluaXRpb25ba2V5XSB9KTtcblx0XHR9XG5cdH1cbn07IiwiX193ZWJwYWNrX3JlcXVpcmVfXy5vID0gKG9iaiwgcHJvcCkgPT4gKE9iamVjdC5wcm90b3R5cGUuaGFzT3duUHJvcGVydHkuY2FsbChvYmosIHByb3ApKSIsIi8vIGRlZmluZSBfX2VzTW9kdWxlIG9uIGV4cG9ydHNcbl9fd2VicGFja19yZXF1aXJlX18uciA9IChleHBvcnRzKSA9PiB7XG5cdGlmKHR5cGVvZiBTeW1ib2wgIT09ICd1bmRlZmluZWQnICYmIFN5bWJvbC50b1N0cmluZ1RhZykge1xuXHRcdE9iamVjdC5kZWZpbmVQcm9wZXJ0eShleHBvcnRzLCBTeW1ib2wudG9TdHJpbmdUYWcsIHsgdmFsdWU6ICdNb2R1bGUnIH0pO1xuXHR9XG5cdE9iamVjdC5kZWZpbmVQcm9wZXJ0eShleHBvcnRzLCAnX19lc01vZHVsZScsIHsgdmFsdWU6IHRydWUgfSk7XG59OyIsImltcG9ydCBUYWJsZSBmcm9tICcuL3RhYmxlL3RhYmxlJ1xuXG5jdXN0b21FbGVtZW50cy5kZWZpbmUoJ215LXRhYmxlJywgVGFibGUpXG4iXSwibmFtZXMiOlsicmVxdWVzdCIsIl91cmwiLCJwYXJhbXMiLCJtZXRob2QiLCJ1cmwiLCJvcHRpb25zIiwiVVJMU2VhcmNoUGFyYW1zIiwidG9TdHJpbmciLCJib2R5IiwiSlNPTiIsInN0cmluZ2lmeSIsImhlYWRlcnMiLCJmZXRjaCIsInRoZW4iLCJyZXNwb25zZSIsImpzb24iLCJnZXQiLCJwb3N0IiwibG9hZCIsIl9vYmpldCIsIm9iamV0IiwiaW5uZXJIVE1MIiwidGV4dCIsIkFTQyIsIkRFU0MiLCJJQ09OX0RFU0MiLCJJQ09OX0FTQyIsIklDT05fTk9ORSIsIlRhYmxlIiwiZGl2IiwicGFyc2UiLCJkYXRhc2V0IiwiYmFzZV91cmwiLCJhamF4IiwidGFibGUiLCJxdWVyeVNlbGVjdG9yIiwidGFibGVCb2R5IiwicGFnZUFjdGl2ZSIsIm5iRWxlbWVudFBlclBhZ2UiLCJwYWdlTGVuZ3RoIiwib3JkZXIiLCJmaWx0ZXIiLCJjb2x1bW5zIiwiZm9yRWFjaCIsImNvbHVtbiIsIm9yZGVyYWJsZSIsImlkIiwiZG9jdW1lbnQiLCJnZXRFbGVtZW50QnlJZCIsInN0eWxlIiwiY3Vyc29yIiwiYWRkRXZlbnRMaXN0ZW5lciIsImVsZW0iLCJ0YXJnZXQiLCJfdXBkYXRlSGVhZGVyIiwiX2J1aWxkQXJyYXkiLCJmb3JtIiwiZ2V0RWxlbWVudHNCeVRhZ05hbWUiLCJidG5FcmFzZSIsInByZXZlbnREZWZhdWx0IiwiX2NsZWFyRm9ybSIsImlucHV0cyIsInNlbGVjdHMiLCJBcnJheSIsImZyb20iLCJpbnB1dCIsInR5cGUiLCJldmVudCIsInZhbHVlIiwibGVuZ3RoIiwiX2dldEZpbHRlckZyb21GaWVsZCIsIl9maWx0ZXJBcnJheSIsInNlbGVjdCIsInBhZ2luZyIsInNlbGVjdEhhdXQiLCJwYWdpbmdfaWQiLCJzZWxlY3RCYXMiLCJlIiwiX2luaXRIZWFkZXIiLCJvcmlnaW5hbE5hbWUiLCJkYXRhIiwiaXRlbSIsImh0bWwiLCJfdXBkYXRlUGFnaW5hdGlvbiIsInRleHRlIiwiaW5uZXJUZXh0IiwibmF2IiwicXVlcnlTZWxlY3RvckFsbCIsInByZXZpb3VzRGlzYWJsZWQiLCJmaXJzdFBhZ2UiLCJuZXh0RGlzYWJsZWQiLCJsYXN0UGFnZSIsInBhZ2VDdXRMb3ciLCJudW1BY3RpdmVQYWdlIiwicGFnZUN1dEhpZ2giLCJuYlBhZ2VzIiwiaSIsInBhZyIsInAiLCJlbGVtZW50IiwicGFnZSIsIm5hbWUiLCJfZXh0cmFjdE5hbWVGcm9tRm9ybSIsImNoZWNrZWQiLCJwdXNoIiwidCIsInNwbGl0Iiwic3Vic3RyIiwiSFRNTEVsZW1lbnQiLCJjdXN0b21FbGVtZW50cyIsImRlZmluZSJdLCJzb3VyY2VSb290IjoiIn0=