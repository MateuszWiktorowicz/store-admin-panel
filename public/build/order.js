(self["webpackChunk"] = self["webpackChunk"] || []).push([["order"],{

/***/ "./assets/js/order.js":
/*!****************************!*\
  !*** ./assets/js/order.js ***!
  \****************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

__webpack_require__(/*! core-js/modules/es.array.for-each.js */ "./node_modules/core-js/modules/es.array.for-each.js");
__webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
__webpack_require__(/*! core-js/modules/es.regexp.exec.js */ "./node_modules/core-js/modules/es.regexp.exec.js");
__webpack_require__(/*! core-js/modules/es.string.replace.js */ "./node_modules/core-js/modules/es.string.replace.js");
__webpack_require__(/*! core-js/modules/web.dom-collections.for-each.js */ "./node_modules/core-js/modules/web.dom-collections.for-each.js");
document.querySelectorAll('.add_item_link').forEach(function (btn) {
  btn.addEventListener("click", addFormToCollection);
});
function addFormToCollection(e) {
  var collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);
  var card = document.createElement('div');
  card.className = 'card text-white bg-success mb-3';
  var cardHeader = document.createElement('div');
  cardHeader.className = 'card-header';
  cardHeader.textContent = 'Order Item';
  var cardBody = document.createElement('div');
  cardBody.className = 'card-body';
  cardBody.innerHTML = collectionHolder.dataset.prototype.replace(/__name__/g, collectionHolder.dataset.index);
  card.appendChild(cardHeader);
  card.appendChild(cardBody);
  collectionHolder.appendChild(card);
  collectionHolder.dataset.index++;
}

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_core-js_modules_es_array_for-each_js-node_modules_core-js_modules_es_obj-651634"], () => (__webpack_exec__("./assets/js/order.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoib3JkZXIuanMiLCJtYXBwaW5ncyI6Ijs7Ozs7Ozs7Ozs7OztBQUFBQSxRQUFRLENBQ0xDLGdCQUFnQixDQUFDLGdCQUFnQixDQUFDLENBQ2xDQyxPQUFPLENBQUMsVUFBQUMsR0FBRyxFQUFJO0VBQ1pBLEdBQUcsQ0FBQ0MsZ0JBQWdCLENBQUMsT0FBTyxFQUFFQyxtQkFBbUIsQ0FBQztBQUN0RCxDQUFDLENBQUM7QUFHRixTQUFTQSxtQkFBbUJBLENBQUNDLENBQUMsRUFBRTtFQUM5QixJQUFNQyxnQkFBZ0IsR0FBR1AsUUFBUSxDQUFDUSxhQUFhLENBQUMsR0FBRyxHQUFHRixDQUFDLENBQUNHLGFBQWEsQ0FBQ0MsT0FBTyxDQUFDQyxxQkFBcUIsQ0FBQztFQUdwRyxJQUFNQyxJQUFJLEdBQUdaLFFBQVEsQ0FBQ2EsYUFBYSxDQUFDLEtBQUssQ0FBQztFQUMxQ0QsSUFBSSxDQUFDRSxTQUFTLEdBQUcsaUNBQWlDO0VBR2xELElBQU1DLFVBQVUsR0FBR2YsUUFBUSxDQUFDYSxhQUFhLENBQUMsS0FBSyxDQUFDO0VBQ2hERSxVQUFVLENBQUNELFNBQVMsR0FBRyxhQUFhO0VBQ3BDQyxVQUFVLENBQUNDLFdBQVcsR0FBRyxZQUFZO0VBR3JDLElBQU1DLFFBQVEsR0FBR2pCLFFBQVEsQ0FBQ2EsYUFBYSxDQUFDLEtBQUssQ0FBQztFQUM5Q0ksUUFBUSxDQUFDSCxTQUFTLEdBQUcsV0FBVztFQUdoQ0csUUFBUSxDQUFDQyxTQUFTLEdBQUdYLGdCQUFnQixDQUFDRyxPQUFPLENBQUNTLFNBQVMsQ0FBQ0MsT0FBTyxDQUMzRCxXQUFXLEVBQ1hiLGdCQUFnQixDQUFDRyxPQUFPLENBQUNXLEtBQzdCLENBQUM7RUFHRFQsSUFBSSxDQUFDVSxXQUFXLENBQUNQLFVBQVUsQ0FBQztFQUM1QkgsSUFBSSxDQUFDVSxXQUFXLENBQUNMLFFBQVEsQ0FBQztFQUcxQlYsZ0JBQWdCLENBQUNlLFdBQVcsQ0FBQ1YsSUFBSSxDQUFDO0VBR2xDTCxnQkFBZ0IsQ0FBQ0csT0FBTyxDQUFDVyxLQUFLLEVBQUU7QUFDcEMiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvanMvb3JkZXIuanMiXSwic291cmNlc0NvbnRlbnQiOlsiZG9jdW1lbnRcclxuICAucXVlcnlTZWxlY3RvckFsbCgnLmFkZF9pdGVtX2xpbmsnKVxyXG4gIC5mb3JFYWNoKGJ0biA9PiB7XHJcbiAgICAgIGJ0bi5hZGRFdmVudExpc3RlbmVyKFwiY2xpY2tcIiwgYWRkRm9ybVRvQ29sbGVjdGlvbilcclxuICB9KTtcclxuXHJcblxyXG4gIGZ1bmN0aW9uIGFkZEZvcm1Ub0NvbGxlY3Rpb24oZSkge1xyXG4gICAgY29uc3QgY29sbGVjdGlvbkhvbGRlciA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy4nICsgZS5jdXJyZW50VGFyZ2V0LmRhdGFzZXQuY29sbGVjdGlvbkhvbGRlckNsYXNzKTtcclxuXHJcblxyXG4gICAgY29uc3QgY2FyZCA9IGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoJ2RpdicpO1xyXG4gICAgY2FyZC5jbGFzc05hbWUgPSAnY2FyZCB0ZXh0LXdoaXRlIGJnLXN1Y2Nlc3MgbWItMyc7IFxyXG5cclxuXHJcbiAgICBjb25zdCBjYXJkSGVhZGVyID0gZG9jdW1lbnQuY3JlYXRlRWxlbWVudCgnZGl2Jyk7XHJcbiAgICBjYXJkSGVhZGVyLmNsYXNzTmFtZSA9ICdjYXJkLWhlYWRlcic7XHJcbiAgICBjYXJkSGVhZGVyLnRleHRDb250ZW50ID0gJ09yZGVyIEl0ZW0nOyBcclxuXHJcblxyXG4gICAgY29uc3QgY2FyZEJvZHkgPSBkb2N1bWVudC5jcmVhdGVFbGVtZW50KCdkaXYnKTtcclxuICAgIGNhcmRCb2R5LmNsYXNzTmFtZSA9ICdjYXJkLWJvZHknO1xyXG5cclxuXHJcbiAgICBjYXJkQm9keS5pbm5lckhUTUwgPSBjb2xsZWN0aW9uSG9sZGVyLmRhdGFzZXQucHJvdG90eXBlLnJlcGxhY2UoXHJcbiAgICAgICAgL19fbmFtZV9fL2csXHJcbiAgICAgICAgY29sbGVjdGlvbkhvbGRlci5kYXRhc2V0LmluZGV4XHJcbiAgICApO1xyXG5cclxuXHJcbiAgICBjYXJkLmFwcGVuZENoaWxkKGNhcmRIZWFkZXIpO1xyXG4gICAgY2FyZC5hcHBlbmRDaGlsZChjYXJkQm9keSk7XHJcblxyXG5cclxuICAgIGNvbGxlY3Rpb25Ib2xkZXIuYXBwZW5kQ2hpbGQoY2FyZCk7XHJcblxyXG5cclxuICAgIGNvbGxlY3Rpb25Ib2xkZXIuZGF0YXNldC5pbmRleCsrO1xyXG59XHJcbiJdLCJuYW1lcyI6WyJkb2N1bWVudCIsInF1ZXJ5U2VsZWN0b3JBbGwiLCJmb3JFYWNoIiwiYnRuIiwiYWRkRXZlbnRMaXN0ZW5lciIsImFkZEZvcm1Ub0NvbGxlY3Rpb24iLCJlIiwiY29sbGVjdGlvbkhvbGRlciIsInF1ZXJ5U2VsZWN0b3IiLCJjdXJyZW50VGFyZ2V0IiwiZGF0YXNldCIsImNvbGxlY3Rpb25Ib2xkZXJDbGFzcyIsImNhcmQiLCJjcmVhdGVFbGVtZW50IiwiY2xhc3NOYW1lIiwiY2FyZEhlYWRlciIsInRleHRDb250ZW50IiwiY2FyZEJvZHkiLCJpbm5lckhUTUwiLCJwcm90b3R5cGUiLCJyZXBsYWNlIiwiaW5kZXgiLCJhcHBlbmRDaGlsZCJdLCJzb3VyY2VSb290IjoiIn0=