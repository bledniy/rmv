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

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
eval("\n\nvar isMobile = {\n  Android: function Android() {\n    return navigator.userAgent.match(/Android/i);\n  },\n  BlackBerry: function BlackBerry() {\n    return navigator.userAgent.match(/BlackBerry/i);\n  },\n  iOS: function iOS() {\n    return navigator.userAgent.match(/iPhone|iPad|iPod/i);\n  },\n  Opera: function Opera() {\n    return navigator.userAgent.match(/Opera Mini/i);\n  },\n  Windows: function Windows() {\n    return navigator.userAgent.match(/IEMobile/i);\n  },\n  any: function any() {\n    return isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows();\n  }\n};\nvar body = document.querySelector('body');\nvar arrow = document.querySelectorAll('.arrow'); // creates array(NodeList) with elements of all span.arrow\n\nif (isMobile.any()) {\n  body.classList.add('touch');\n  arrow.forEach(function (arrowElement) {\n    var thisArrow = arrowElement;\n    var subMenu = arrowElement.nextElementSibling;\n    var thisLink = arrowElement.previousElementSibling;\n    thisLink.classList.add('parent'); // add rigth margin for <a>\n\n    arrowElement.addEventListener('click', function () {\n      subMenu.classList.toggle('open'); // display sub-menu\n\n      thisArrow.classList.toggle('active'); // rotate arrow\n    });\n  });\n} else {\n  body.classList.add('mouse');\n  arrow.forEach(function (arrowElement) {\n    var thisLink = arrowElement.previousElementSibling;\n    thisLink.classList.add('parent'); // add rigth margin \n  });\n} // Burger Menu\n\n\nvar btnBurger = document.querySelector('.menu-burger');\nvar menu = btnBurger.nextElementSibling;\nbtnBurger.addEventListener('click', function () {\n  btnBurger.classList.toggle('burger-active');\n  menu.classList.toggle('menu-active');\n}); // if (isMobile.any()) {\n//    body.classList.add('touch');\n//    for (let i = 0; i < arrow.length; i++) {\n//       let thisLink = arrow[i].previousElementSibling;\n//       let subMenu = arrow[i].nextElementSibling;\n//       let thisArrow = arrow[i];\n//       thisLink.classList.add('parent');\n//       arrow[i].addEventListener('click', function() {\n//          subMenu.classList.toggle('open');\n//          thisArrow.classList.toggle('active')\n//       })\n//    }\n// } else {\n//    body.classList.add('mouse')\n//    for (let i = 0; i < arrow.length; i++) {\n//       let thisLink = arrow[i].previousElementSibling;\n//       let subMenu = arrow[i].nextElementSibling;\n//       let thisArrow = arrow[i];\n//       thisLink.classList.add('parent');\n//       arrow[i].addEventListener('click', function() {\n//          subMenu.classList.toggle('open');\n//          thisArrow.classList.toggle('active')\n//       })\n//    }\n// }//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvYXBwLmpzPzZkNDAiXSwibmFtZXMiOlsiaXNNb2JpbGUiLCJBbmRyb2lkIiwibmF2aWdhdG9yIiwidXNlckFnZW50IiwibWF0Y2giLCJCbGFja0JlcnJ5IiwiaU9TIiwiT3BlcmEiLCJXaW5kb3dzIiwiYW55IiwiYm9keSIsImRvY3VtZW50IiwicXVlcnlTZWxlY3RvciIsImFycm93IiwicXVlcnlTZWxlY3RvckFsbCIsImNsYXNzTGlzdCIsImFkZCIsImZvckVhY2giLCJhcnJvd0VsZW1lbnQiLCJ0aGlzQXJyb3ciLCJzdWJNZW51IiwibmV4dEVsZW1lbnRTaWJsaW5nIiwidGhpc0xpbmsiLCJwcmV2aW91c0VsZW1lbnRTaWJsaW5nIiwiYWRkRXZlbnRMaXN0ZW5lciIsInRvZ2dsZSIsImJ0bkJ1cmdlciIsIm1lbnUiXSwibWFwcGluZ3MiOiJBQUFhOztBQUViLElBQUlBLFFBQVEsR0FBRztFQUNkQyxPQUFPLEVBQUUsbUJBQVc7SUFBQyxPQUFPQyxTQUFTLENBQUNDLFNBQVYsQ0FBb0JDLEtBQXBCLENBQTBCLFVBQTFCLENBQVA7RUFBOEMsQ0FEckQ7RUFFZEMsVUFBVSxFQUFFLHNCQUFXO0lBQUMsT0FBT0gsU0FBUyxDQUFDQyxTQUFWLENBQW9CQyxLQUFwQixDQUEwQixhQUExQixDQUFQO0VBQWlELENBRjNEO0VBR2RFLEdBQUcsRUFBRSxlQUFXO0lBQUMsT0FBT0osU0FBUyxDQUFDQyxTQUFWLENBQW9CQyxLQUFwQixDQUEwQixtQkFBMUIsQ0FBUDtFQUF1RCxDQUgxRDtFQUlkRyxLQUFLLEVBQUUsaUJBQVc7SUFBQyxPQUFPTCxTQUFTLENBQUNDLFNBQVYsQ0FBb0JDLEtBQXBCLENBQTBCLGFBQTFCLENBQVA7RUFBaUQsQ0FKdEQ7RUFLZEksT0FBTyxFQUFFLG1CQUFXO0lBQUMsT0FBT04sU0FBUyxDQUFDQyxTQUFWLENBQW9CQyxLQUFwQixDQUEwQixXQUExQixDQUFQO0VBQStDLENBTHREO0VBTWRLLEdBQUcsRUFBRSxlQUFXO0lBQUMsT0FBUVQsUUFBUSxDQUFDQyxPQUFULE1BQXNCRCxRQUFRLENBQUNLLFVBQVQsRUFBdEIsSUFBK0NMLFFBQVEsQ0FBQ00sR0FBVCxFQUEvQyxJQUFpRU4sUUFBUSxDQUFDTyxLQUFULEVBQWpFLElBQXFGUCxRQUFRLENBQUNRLE9BQVQsRUFBN0Y7RUFBa0g7QUFOckgsQ0FBZjtBQVNBLElBQU1FLElBQUksR0FBR0MsUUFBUSxDQUFDQyxhQUFULENBQXVCLE1BQXZCLENBQWI7QUFDQSxJQUFNQyxLQUFLLEdBQUdGLFFBQVEsQ0FBQ0csZ0JBQVQsQ0FBMEIsUUFBMUIsQ0FBZCxDLENBQW1EOztBQUVuRCxJQUFJZCxRQUFRLENBQUNTLEdBQVQsRUFBSixFQUFvQjtFQUNqQkMsSUFBSSxDQUFDSyxTQUFMLENBQWVDLEdBQWYsQ0FBbUIsT0FBbkI7RUFFQUgsS0FBSyxDQUFDSSxPQUFOLENBQWMsVUFBVUMsWUFBVixFQUF3QjtJQUNuQyxJQUFJQyxTQUFTLEdBQUdELFlBQWhCO0lBQ0EsSUFBSUUsT0FBTyxHQUFHRixZQUFZLENBQUNHLGtCQUEzQjtJQUNBLElBQUlDLFFBQVEsR0FBR0osWUFBWSxDQUFDSyxzQkFBNUI7SUFFQUQsUUFBUSxDQUFDUCxTQUFULENBQW1CQyxHQUFuQixDQUF1QixRQUF2QixFQUxtQyxDQUtEOztJQUNsQ0UsWUFBWSxDQUFDTSxnQkFBYixDQUE4QixPQUE5QixFQUF1QyxZQUFXO01BQy9DSixPQUFPLENBQUNMLFNBQVIsQ0FBa0JVLE1BQWxCLENBQXlCLE1BQXpCLEVBRCtDLENBQ2I7O01BQ2xDTixTQUFTLENBQUNKLFNBQVYsQ0FBb0JVLE1BQXBCLENBQTJCLFFBQTNCLEVBRitDLENBRVY7SUFDdkMsQ0FIRDtFQUlGLENBVkQ7QUFZRixDQWZELE1BZU87RUFDSmYsSUFBSSxDQUFDSyxTQUFMLENBQWVDLEdBQWYsQ0FBbUIsT0FBbkI7RUFFQUgsS0FBSyxDQUFDSSxPQUFOLENBQWMsVUFBVUMsWUFBVixFQUF3QjtJQUNuQyxJQUFJSSxRQUFRLEdBQUdKLFlBQVksQ0FBQ0ssc0JBQTVCO0lBQ0FELFFBQVEsQ0FBQ1AsU0FBVCxDQUFtQkMsR0FBbkIsQ0FBdUIsUUFBdkIsRUFGbUMsQ0FFRDtFQUNwQyxDQUhEO0FBS0YsQyxDQUlEOzs7QUFFQSxJQUFJVSxTQUFTLEdBQUdmLFFBQVEsQ0FBQ0MsYUFBVCxDQUF1QixjQUF2QixDQUFoQjtBQUNBLElBQUllLElBQUksR0FBR0QsU0FBUyxDQUFDTCxrQkFBckI7QUFDQUssU0FBUyxDQUFDRixnQkFBVixDQUEyQixPQUEzQixFQUFvQyxZQUFXO0VBQzVDRSxTQUFTLENBQUNYLFNBQVYsQ0FBb0JVLE1BQXBCLENBQTJCLGVBQTNCO0VBQ0FFLElBQUksQ0FBQ1osU0FBTCxDQUFlVSxNQUFmLENBQXNCLGFBQXRCO0FBQ0YsQ0FIRCxFLENBNkVBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBIiwiZmlsZSI6Ii4vcmVzb3VyY2VzL2pzL2FwcC5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbIid1c2Ugc3RyaWN0JztcclxuXHJcbmxldCBpc01vYmlsZSA9IHtcclxuXHRBbmRyb2lkOiBmdW5jdGlvbigpIHtyZXR1cm4gbmF2aWdhdG9yLnVzZXJBZ2VudC5tYXRjaCgvQW5kcm9pZC9pKTt9LFxyXG5cdEJsYWNrQmVycnk6IGZ1bmN0aW9uKCkge3JldHVybiBuYXZpZ2F0b3IudXNlckFnZW50Lm1hdGNoKC9CbGFja0JlcnJ5L2kpO30sXHJcblx0aU9TOiBmdW5jdGlvbigpIHtyZXR1cm4gbmF2aWdhdG9yLnVzZXJBZ2VudC5tYXRjaCgvaVBob25lfGlQYWR8aVBvZC9pKTt9LFxyXG5cdE9wZXJhOiBmdW5jdGlvbigpIHtyZXR1cm4gbmF2aWdhdG9yLnVzZXJBZ2VudC5tYXRjaCgvT3BlcmEgTWluaS9pKTt9LFxyXG5cdFdpbmRvd3M6IGZ1bmN0aW9uKCkge3JldHVybiBuYXZpZ2F0b3IudXNlckFnZW50Lm1hdGNoKC9JRU1vYmlsZS9pKTt9LFxyXG5cdGFueTogZnVuY3Rpb24oKSB7cmV0dXJuIChpc01vYmlsZS5BbmRyb2lkKCkgfHwgaXNNb2JpbGUuQmxhY2tCZXJyeSgpIHx8IGlzTW9iaWxlLmlPUygpIHx8IGlzTW9iaWxlLk9wZXJhKCkgfHwgaXNNb2JpbGUuV2luZG93cygpKTt9XHJcbn07XHJcblxyXG5jb25zdCBib2R5ID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignYm9keScpO1xyXG5jb25zdCBhcnJvdyA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3JBbGwoJy5hcnJvdycpOyAvLyBjcmVhdGVzIGFycmF5KE5vZGVMaXN0KSB3aXRoIGVsZW1lbnRzIG9mIGFsbCBzcGFuLmFycm93XHJcblxyXG5pZiAoaXNNb2JpbGUuYW55KCkpIHtcclxuICAgYm9keS5jbGFzc0xpc3QuYWRkKCd0b3VjaCcpO1xyXG5cclxuICAgYXJyb3cuZm9yRWFjaChmdW5jdGlvbiAoYXJyb3dFbGVtZW50KSB7XHJcbiAgICAgIGxldCB0aGlzQXJyb3cgPSBhcnJvd0VsZW1lbnQ7XHJcbiAgICAgIGxldCBzdWJNZW51ID0gYXJyb3dFbGVtZW50Lm5leHRFbGVtZW50U2libGluZztcclxuICAgICAgbGV0IHRoaXNMaW5rID0gYXJyb3dFbGVtZW50LnByZXZpb3VzRWxlbWVudFNpYmxpbmc7XHJcblxyXG4gICAgICB0aGlzTGluay5jbGFzc0xpc3QuYWRkKCdwYXJlbnQnKTsgLy8gYWRkIHJpZ3RoIG1hcmdpbiBmb3IgPGE+XHJcbiAgICAgIGFycm93RWxlbWVudC5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uKCkge1xyXG4gICAgICAgICBzdWJNZW51LmNsYXNzTGlzdC50b2dnbGUoJ29wZW4nKTsgLy8gZGlzcGxheSBzdWItbWVudVxyXG4gICAgICAgICB0aGlzQXJyb3cuY2xhc3NMaXN0LnRvZ2dsZSgnYWN0aXZlJykgLy8gcm90YXRlIGFycm93XHJcbiAgICAgIH0pXHJcbiAgIH0pO1xyXG5cclxufSBlbHNlIHtcclxuICAgYm9keS5jbGFzc0xpc3QuYWRkKCdtb3VzZScpXHJcblxyXG4gICBhcnJvdy5mb3JFYWNoKGZ1bmN0aW9uIChhcnJvd0VsZW1lbnQpIHtcclxuICAgICAgbGV0IHRoaXNMaW5rID0gYXJyb3dFbGVtZW50LnByZXZpb3VzRWxlbWVudFNpYmxpbmc7XHJcbiAgICAgIHRoaXNMaW5rLmNsYXNzTGlzdC5hZGQoJ3BhcmVudCcpOyAvLyBhZGQgcmlndGggbWFyZ2luIFxyXG4gICB9KTtcclxuXHJcbn1cclxuXHJcblxyXG5cclxuLy8gQnVyZ2VyIE1lbnVcclxuXHJcbmxldCBidG5CdXJnZXIgPSBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcubWVudS1idXJnZXInKTtcclxubGV0IG1lbnUgPSBidG5CdXJnZXIubmV4dEVsZW1lbnRTaWJsaW5nO1xyXG5idG5CdXJnZXIuYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBmdW5jdGlvbigpIHtcclxuICAgYnRuQnVyZ2VyLmNsYXNzTGlzdC50b2dnbGUoJ2J1cmdlci1hY3RpdmUnKVxyXG4gICBtZW51LmNsYXNzTGlzdC50b2dnbGUoJ21lbnUtYWN0aXZlJylcclxufSlcclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcbi8vIGlmIChpc01vYmlsZS5hbnkoKSkge1xyXG4vLyAgICBib2R5LmNsYXNzTGlzdC5hZGQoJ3RvdWNoJyk7XHJcblxyXG4vLyAgICBmb3IgKGxldCBpID0gMDsgaSA8IGFycm93Lmxlbmd0aDsgaSsrKSB7XHJcbi8vICAgICAgIGxldCB0aGlzTGluayA9IGFycm93W2ldLnByZXZpb3VzRWxlbWVudFNpYmxpbmc7XHJcbi8vICAgICAgIGxldCBzdWJNZW51ID0gYXJyb3dbaV0ubmV4dEVsZW1lbnRTaWJsaW5nO1xyXG4vLyAgICAgICBsZXQgdGhpc0Fycm93ID0gYXJyb3dbaV07XHJcblxyXG4vLyAgICAgICB0aGlzTGluay5jbGFzc0xpc3QuYWRkKCdwYXJlbnQnKTtcclxuLy8gICAgICAgYXJyb3dbaV0uYWRkRXZlbnRMaXN0ZW5lcignY2xpY2snLCBmdW5jdGlvbigpIHtcclxuLy8gICAgICAgICAgc3ViTWVudS5jbGFzc0xpc3QudG9nZ2xlKCdvcGVuJyk7XHJcbi8vICAgICAgICAgIHRoaXNBcnJvdy5jbGFzc0xpc3QudG9nZ2xlKCdhY3RpdmUnKVxyXG4vLyAgICAgICB9KVxyXG4vLyAgICB9XHJcbi8vIH0gZWxzZSB7XHJcbi8vICAgIGJvZHkuY2xhc3NMaXN0LmFkZCgnbW91c2UnKVxyXG5cclxuLy8gICAgZm9yIChsZXQgaSA9IDA7IGkgPCBhcnJvdy5sZW5ndGg7IGkrKykge1xyXG4vLyAgICAgICBsZXQgdGhpc0xpbmsgPSBhcnJvd1tpXS5wcmV2aW91c0VsZW1lbnRTaWJsaW5nO1xyXG4vLyAgICAgICBsZXQgc3ViTWVudSA9IGFycm93W2ldLm5leHRFbGVtZW50U2libGluZztcclxuLy8gICAgICAgbGV0IHRoaXNBcnJvdyA9IGFycm93W2ldO1xyXG5cclxuLy8gICAgICAgdGhpc0xpbmsuY2xhc3NMaXN0LmFkZCgncGFyZW50Jyk7XHJcbi8vICAgICAgIGFycm93W2ldLmFkZEV2ZW50TGlzdGVuZXIoJ2NsaWNrJywgZnVuY3Rpb24oKSB7XHJcbi8vICAgICAgICAgIHN1Yk1lbnUuY2xhc3NMaXN0LnRvZ2dsZSgnb3BlbicpO1xyXG4vLyAgICAgICAgICB0aGlzQXJyb3cuY2xhc3NMaXN0LnRvZ2dsZSgnYWN0aXZlJylcclxuLy8gICAgICAgfSlcclxuLy8gICAgfVxyXG4vLyB9XHJcblxyXG5cclxuXHJcblxyXG5cclxuXHJcblxyXG4iXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/app.js\n");

/***/ }),

/***/ 1:
/*!***********************************!*\
  !*** multi ./resources/js/app.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/sharkpiko/PhpstormProjects/rmv/resources/js/app.js */"./resources/js/app.js");


/***/ })

/******/ });