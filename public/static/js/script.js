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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/script.js":
/*!********************************!*\
  !*** ./resources/js/script.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval("\n\nvar isMobile = {\n  Android: function Android() {\n    return navigator.userAgent.match(/Android/i);\n  },\n  BlackBerry: function BlackBerry() {\n    return navigator.userAgent.match(/BlackBerry/i);\n  },\n  iOS: function iOS() {\n    return navigator.userAgent.match(/iPhone|iPad|iPod/i);\n  },\n  Opera: function Opera() {\n    return navigator.userAgent.match(/Opera Mini/i);\n  },\n  Windows: function Windows() {\n    return navigator.userAgent.match(/IEMobile/i);\n  },\n  any: function any() {\n    return isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows();\n  }\n};\nvar body = document.querySelector('body');\nvar arrow = document.querySelectorAll('.arrow'); // creates array(NodeList) with elements of all span.arrow\n\nif (isMobile.any()) {\n  body.classList.add('touch');\n  arrow.forEach(function (arrowElement) {\n    var thisArrow = arrowElement;\n    var subMenu = arrowElement.nextElementSibling;\n    var thisLink = arrowElement.previousElementSibling;\n    thisLink.classList.add('parent'); // add rigth margin for <a>\n\n    arrowElement.addEventListener('click', function () {\n      subMenu.classList.toggle('open'); // display sub-menu\n\n      thisArrow.classList.toggle('active'); // rotate arrow\n    });\n  });\n} else {\n  body.classList.add('mouse');\n  arrow.forEach(function (arrowElement) {\n    var thisLink = arrowElement.previousElementSibling;\n    thisLink.classList.add('parent'); // add rigth margin \n  });\n} // if (isMobile.any()) {\n//    body.classList.add('touch');\n//    for (let i = 0; i < arrow.length; i++) {\n//       let thisLink = arrow[i].previousElementSibling;\n//       let subMenu = arrow[i].nextElementSibling;\n//       let thisArrow = arrow[i];\n//       thisLink.classList.add('parent');\n//       arrow[i].addEventListener('click', function() {\n//          subMenu.classList.toggle('open');\n//          thisArrow.classList.toggle('active')\n//       })\n//    }\n// } else {\n//    body.classList.add('mouse')\n//    for (let i = 0; i < arrow.length; i++) {\n//       let thisLink = arrow[i].previousElementSibling;\n//       let subMenu = arrow[i].nextElementSibling;\n//       let thisArrow = arrow[i];\n//       thisLink.classList.add('parent');\n//       arrow[i].addEventListener('click', function() {\n//          subMenu.classList.toggle('open');\n//          thisArrow.classList.toggle('active')\n//       })\n//    }\n// }//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvc2NyaXB0LmpzPzg3MzMiXSwibmFtZXMiOlsiaXNNb2JpbGUiLCJBbmRyb2lkIiwibmF2aWdhdG9yIiwidXNlckFnZW50IiwibWF0Y2giLCJCbGFja0JlcnJ5IiwiaU9TIiwiT3BlcmEiLCJXaW5kb3dzIiwiYW55IiwiYm9keSIsImRvY3VtZW50IiwicXVlcnlTZWxlY3RvciIsImFycm93IiwicXVlcnlTZWxlY3RvckFsbCIsImNsYXNzTGlzdCIsImFkZCIsImZvckVhY2giLCJhcnJvd0VsZW1lbnQiLCJ0aGlzQXJyb3ciLCJzdWJNZW51IiwibmV4dEVsZW1lbnRTaWJsaW5nIiwidGhpc0xpbmsiLCJwcmV2aW91c0VsZW1lbnRTaWJsaW5nIiwiYWRkRXZlbnRMaXN0ZW5lciIsInRvZ2dsZSJdLCJtYXBwaW5ncyI6IkFBQWE7O0FBRWIsSUFBSUEsUUFBUSxHQUFHO0VBQ2RDLE9BQU8sRUFBRSxtQkFBVztJQUFDLE9BQU9DLFNBQVMsQ0FBQ0MsU0FBVixDQUFvQkMsS0FBcEIsQ0FBMEIsVUFBMUIsQ0FBUDtFQUE4QyxDQURyRDtFQUVkQyxVQUFVLEVBQUUsc0JBQVc7SUFBQyxPQUFPSCxTQUFTLENBQUNDLFNBQVYsQ0FBb0JDLEtBQXBCLENBQTBCLGFBQTFCLENBQVA7RUFBaUQsQ0FGM0Q7RUFHZEUsR0FBRyxFQUFFLGVBQVc7SUFBQyxPQUFPSixTQUFTLENBQUNDLFNBQVYsQ0FBb0JDLEtBQXBCLENBQTBCLG1CQUExQixDQUFQO0VBQXVELENBSDFEO0VBSWRHLEtBQUssRUFBRSxpQkFBVztJQUFDLE9BQU9MLFNBQVMsQ0FBQ0MsU0FBVixDQUFvQkMsS0FBcEIsQ0FBMEIsYUFBMUIsQ0FBUDtFQUFpRCxDQUp0RDtFQUtkSSxPQUFPLEVBQUUsbUJBQVc7SUFBQyxPQUFPTixTQUFTLENBQUNDLFNBQVYsQ0FBb0JDLEtBQXBCLENBQTBCLFdBQTFCLENBQVA7RUFBK0MsQ0FMdEQ7RUFNZEssR0FBRyxFQUFFLGVBQVc7SUFBQyxPQUFRVCxRQUFRLENBQUNDLE9BQVQsTUFBc0JELFFBQVEsQ0FBQ0ssVUFBVCxFQUF0QixJQUErQ0wsUUFBUSxDQUFDTSxHQUFULEVBQS9DLElBQWlFTixRQUFRLENBQUNPLEtBQVQsRUFBakUsSUFBcUZQLFFBQVEsQ0FBQ1EsT0FBVCxFQUE3RjtFQUFrSDtBQU5ySCxDQUFmO0FBU0EsSUFBTUUsSUFBSSxHQUFHQyxRQUFRLENBQUNDLGFBQVQsQ0FBdUIsTUFBdkIsQ0FBYjtBQUNBLElBQU1DLEtBQUssR0FBR0YsUUFBUSxDQUFDRyxnQkFBVCxDQUEwQixRQUExQixDQUFkLEMsQ0FBbUQ7O0FBRW5ELElBQUlkLFFBQVEsQ0FBQ1MsR0FBVCxFQUFKLEVBQW9CO0VBQ2pCQyxJQUFJLENBQUNLLFNBQUwsQ0FBZUMsR0FBZixDQUFtQixPQUFuQjtFQUVBSCxLQUFLLENBQUNJLE9BQU4sQ0FBYyxVQUFVQyxZQUFWLEVBQXdCO0lBQ25DLElBQUlDLFNBQVMsR0FBR0QsWUFBaEI7SUFDQSxJQUFJRSxPQUFPLEdBQUdGLFlBQVksQ0FBQ0csa0JBQTNCO0lBQ0EsSUFBSUMsUUFBUSxHQUFHSixZQUFZLENBQUNLLHNCQUE1QjtJQUVBRCxRQUFRLENBQUNQLFNBQVQsQ0FBbUJDLEdBQW5CLENBQXVCLFFBQXZCLEVBTG1DLENBS0Q7O0lBQ2xDRSxZQUFZLENBQUNNLGdCQUFiLENBQThCLE9BQTlCLEVBQXVDLFlBQVc7TUFDL0NKLE9BQU8sQ0FBQ0wsU0FBUixDQUFrQlUsTUFBbEIsQ0FBeUIsTUFBekIsRUFEK0MsQ0FDYjs7TUFDbENOLFNBQVMsQ0FBQ0osU0FBVixDQUFvQlUsTUFBcEIsQ0FBMkIsUUFBM0IsRUFGK0MsQ0FFVjtJQUN2QyxDQUhEO0VBSUYsQ0FWRDtBQVlGLENBZkQsTUFlTztFQUNKZixJQUFJLENBQUNLLFNBQUwsQ0FBZUMsR0FBZixDQUFtQixPQUFuQjtFQUVBSCxLQUFLLENBQUNJLE9BQU4sQ0FBYyxVQUFVQyxZQUFWLEVBQXdCO0lBQ25DLElBQUlJLFFBQVEsR0FBR0osWUFBWSxDQUFDSyxzQkFBNUI7SUFDQUQsUUFBUSxDQUFDUCxTQUFULENBQW1CQyxHQUFuQixDQUF1QixRQUF2QixFQUZtQyxDQUVEO0VBQ3BDLENBSEQ7QUFLRixDLENBR0Q7QUFDQTtBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EiLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvc2NyaXB0LmpzLmpzIiwic291cmNlc0NvbnRlbnQiOlsiJ3VzZSBzdHJpY3QnO1xyXG5cclxubGV0IGlzTW9iaWxlID0ge1xyXG5cdEFuZHJvaWQ6IGZ1bmN0aW9uKCkge3JldHVybiBuYXZpZ2F0b3IudXNlckFnZW50Lm1hdGNoKC9BbmRyb2lkL2kpO30sXHJcblx0QmxhY2tCZXJyeTogZnVuY3Rpb24oKSB7cmV0dXJuIG5hdmlnYXRvci51c2VyQWdlbnQubWF0Y2goL0JsYWNrQmVycnkvaSk7fSxcclxuXHRpT1M6IGZ1bmN0aW9uKCkge3JldHVybiBuYXZpZ2F0b3IudXNlckFnZW50Lm1hdGNoKC9pUGhvbmV8aVBhZHxpUG9kL2kpO30sXHJcblx0T3BlcmE6IGZ1bmN0aW9uKCkge3JldHVybiBuYXZpZ2F0b3IudXNlckFnZW50Lm1hdGNoKC9PcGVyYSBNaW5pL2kpO30sXHJcblx0V2luZG93czogZnVuY3Rpb24oKSB7cmV0dXJuIG5hdmlnYXRvci51c2VyQWdlbnQubWF0Y2goL0lFTW9iaWxlL2kpO30sXHJcblx0YW55OiBmdW5jdGlvbigpIHtyZXR1cm4gKGlzTW9iaWxlLkFuZHJvaWQoKSB8fCBpc01vYmlsZS5CbGFja0JlcnJ5KCkgfHwgaXNNb2JpbGUuaU9TKCkgfHwgaXNNb2JpbGUuT3BlcmEoKSB8fCBpc01vYmlsZS5XaW5kb3dzKCkpO31cclxufTtcclxuXHJcbmNvbnN0IGJvZHkgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCdib2R5Jyk7XHJcbmNvbnN0IGFycm93ID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvckFsbCgnLmFycm93Jyk7IC8vIGNyZWF0ZXMgYXJyYXkoTm9kZUxpc3QpIHdpdGggZWxlbWVudHMgb2YgYWxsIHNwYW4uYXJyb3dcclxuXHJcbmlmIChpc01vYmlsZS5hbnkoKSkge1xyXG4gICBib2R5LmNsYXNzTGlzdC5hZGQoJ3RvdWNoJyk7XHJcblxyXG4gICBhcnJvdy5mb3JFYWNoKGZ1bmN0aW9uIChhcnJvd0VsZW1lbnQpIHtcclxuICAgICAgbGV0IHRoaXNBcnJvdyA9IGFycm93RWxlbWVudDtcclxuICAgICAgbGV0IHN1Yk1lbnUgPSBhcnJvd0VsZW1lbnQubmV4dEVsZW1lbnRTaWJsaW5nO1xyXG4gICAgICBsZXQgdGhpc0xpbmsgPSBhcnJvd0VsZW1lbnQucHJldmlvdXNFbGVtZW50U2libGluZztcclxuXHJcbiAgICAgIHRoaXNMaW5rLmNsYXNzTGlzdC5hZGQoJ3BhcmVudCcpOyAvLyBhZGQgcmlndGggbWFyZ2luIGZvciA8YT5cclxuICAgICAgYXJyb3dFbGVtZW50LmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgIHN1Yk1lbnUuY2xhc3NMaXN0LnRvZ2dsZSgnb3BlbicpOyAvLyBkaXNwbGF5IHN1Yi1tZW51XHJcbiAgICAgICAgIHRoaXNBcnJvdy5jbGFzc0xpc3QudG9nZ2xlKCdhY3RpdmUnKSAvLyByb3RhdGUgYXJyb3dcclxuICAgICAgfSlcclxuICAgfSk7XHJcblxyXG59IGVsc2Uge1xyXG4gICBib2R5LmNsYXNzTGlzdC5hZGQoJ21vdXNlJylcclxuXHJcbiAgIGFycm93LmZvckVhY2goZnVuY3Rpb24gKGFycm93RWxlbWVudCkge1xyXG4gICAgICBsZXQgdGhpc0xpbmsgPSBhcnJvd0VsZW1lbnQucHJldmlvdXNFbGVtZW50U2libGluZztcclxuICAgICAgdGhpc0xpbmsuY2xhc3NMaXN0LmFkZCgncGFyZW50Jyk7IC8vIGFkZCByaWd0aCBtYXJnaW4gXHJcbiAgIH0pO1xyXG5cclxufVxyXG5cclxuXHJcbi8vIGlmIChpc01vYmlsZS5hbnkoKSkge1xyXG4vLyAgICBib2R5LmNsYXNzTGlzdC5hZGQoJ3RvdWNoJyk7XHJcblxyXG4vLyAgICBmb3IgKGxldCBpID0gMDsgaSA8IGFycm93Lmxlbmd0aDsgaSsrKSB7XHJcbi8vICAgICAgIGxldCB0aGlzTGluayA9IGFycm93W2ldLnByZXZpb3VzRWxlbWVudFNpYmxpbmc7XHJcbi8vICAgICAgIGxldCBzdWJNZW51ID0gYXJyb3dbaV0ubmV4dEVsZW1lbnRTaWJsaW5nO1xyXG4vLyAgICAgICBsZXQgdGhpc0Fycm93ID0gYXJyb3dbaV07XHJcblxyXG4vLyAgICAgICB0aGlzTGluay5jbGFzc0xpc3QuYWRkKCdwYXJlbnQnKTtcclxuLy8gICAgICAgYXJyb3dbaV0uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBmdW5jdGlvbigpIHtcclxuLy8gICAgICAgICAgc3ViTWVudS5jbGFzc0xpc3QudG9nZ2xlKCdvcGVuJyk7XHJcbi8vICAgICAgICAgIHRoaXNBcnJvdy5jbGFzc0xpc3QudG9nZ2xlKCdhY3RpdmUnKVxyXG4vLyAgICAgICB9KVxyXG4vLyAgICB9XHJcbi8vIH0gZWxzZSB7XHJcbi8vICAgIGJvZHkuY2xhc3NMaXN0LmFkZCgnbW91c2UnKVxyXG5cclxuLy8gICAgZm9yIChsZXQgaSA9IDA7IGkgPCBhcnJvdy5sZW5ndGg7IGkrKykge1xyXG4vLyAgICAgICBsZXQgdGhpc0xpbmsgPSBhcnJvd1tpXS5wcmV2aW91c0VsZW1lbnRTaWJsaW5nO1xyXG4vLyAgICAgICBsZXQgc3ViTWVudSA9IGFycm93W2ldLm5leHRFbGVtZW50U2libGluZztcclxuLy8gICAgICAgbGV0IHRoaXNBcnJvdyA9IGFycm93W2ldO1xyXG5cclxuLy8gICAgICAgdGhpc0xpbmsuY2xhc3NMaXN0LmFkZCgncGFyZW50Jyk7XHJcbi8vICAgICAgIGFycm93W2ldLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24oKSB7XHJcbi8vICAgICAgICAgIHN1Yk1lbnUuY2xhc3NMaXN0LnRvZ2dsZSgnb3BlbicpO1xyXG4vLyAgICAgICAgICB0aGlzQXJyb3cuY2xhc3NMaXN0LnRvZ2dsZSgnYWN0aXZlJylcclxuLy8gICAgICAgfSlcclxuLy8gICAgfVxyXG4vLyB9XHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG4iXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/script.js\n");

/***/ }),

/***/ 1:
/*!**************************************!*\
  !*** multi ./resources/js/script.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/sharkpiko/PhpstormProjects/rmv/resources/js/script.js */"./resources/js/script.js");


/***/ })

/******/ });