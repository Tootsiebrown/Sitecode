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

/***/ "./node_modules/@ericblade/quagga2/dist/quagga.min.js":
/*!************************************************************!*\
  !*** ./node_modules/@ericblade/quagga2/dist/quagga.min.js ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

!function(t,e){ true?module.exports=e():undefined}(window,(function(){return function(t){var e={};function n(r){if(e[r])return e[r].exports;var i=e[r]={i:r,l:!1,exports:{}};return t[r].call(i.exports,i,i.exports,n),i.l=!0,i.exports}return n.m=t,n.c=e,n.d=function(t,e,r){n.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:r})},n.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},n.t=function(t,e){if(1&e&&(t=n(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var i in t)n.d(r,i,function(e){return t[e]}.bind(null,i));return r},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="/",n(n.s=67)}([function(t,e){t.exports=function(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}},function(t,e){t.exports=function(t){if(void 0===t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return t}},function(t,e){function n(e){return t.exports=n=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)},n(e)}t.exports=n},function(t,e){t.exports=function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}},function(t,e){function n(t,e){for(var n=0;n<e.length;n++){var r=e[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}t.exports=function(t,e,r){return e&&n(t.prototype,e),r&&n(t,r),t}},function(t,e,n){var r=n(19),i=n(1);t.exports=function(t,e){return!e||"object"!==r(e)&&"function"!=typeof e?i(t):e}},function(t,e,n){var r=n(140);t.exports=function(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&r(t,e)}},function(t,e,n){t.exports={EPSILON:n(36),create:n(37),clone:n(72),fromValues:n(73),copy:n(74),set:n(75),equals:n(76),exactEquals:n(77),add:n(78),subtract:n(38),sub:n(79),multiply:n(39),mul:n(80),divide:n(40),div:n(81),inverse:n(82),min:n(83),max:n(84),rotate:n(85),floor:n(86),ceil:n(87),round:n(88),scale:n(89),scaleAndAdd:n(90),distance:n(41),dist:n(91),squaredDistance:n(42),sqrDist:n(92),length:n(43),len:n(93),squaredLength:n(44),sqrLen:n(94),negate:n(95),normalize:n(96),dot:n(97),cross:n(98),lerp:n(99),random:n(100),transformMat2:n(101),transformMat2d:n(102),transformMat3:n(103),transformMat4:n(104),forEach:n(105),limit:n(106)}},function(t,e,n){"use strict";n.r(e),n.d(e,"imageRef",(function(){return l})),n.d(e,"computeIntegralImage2",(function(){return h})),n.d(e,"computeIntegralImage",(function(){return d})),n.d(e,"thresholdImage",(function(){return p})),n.d(e,"computeHistogram",(function(){return v})),n.d(e,"sharpenLine",(function(){return g})),n.d(e,"determineOtsuThreshold",(function(){return y})),n.d(e,"otsuThreshold",(function(){return _})),n.d(e,"computeBinaryImage",(function(){return m})),n.d(e,"cluster",(function(){return b})),n.d(e,"Tracer",(function(){return w})),n.d(e,"DILATE",(function(){return x})),n.d(e,"ERODE",(function(){return E})),n.d(e,"dilate",(function(){return A})),n.d(e,"erode",(function(){return R})),n.d(e,"subtract",(function(){return S})),n.d(e,"bitwiseOr",(function(){return O})),n.d(e,"countNonZero",(function(){return k})),n.d(e,"topGeneric",(function(){return C})),n.d(e,"grayArrayFromImage",(function(){return j})),n.d(e,"grayArrayFromContext",(function(){return M})),n.d(e,"grayAndHalfSampleFromCanvasData",(function(){return T})),n.d(e,"computeGray",(function(){return I})),n.d(e,"loadImageArray",(function(){return D})),n.d(e,"halfSample",(function(){return P})),n.d(e,"hsv2rgb",(function(){return L})),n.d(e,"_computeDivisors",(function(){return U})),n.d(e,"calculatePatchSize",(function(){return z})),n.d(e,"_parseCSSDimensionValues",(function(){return B})),n.d(e,"_dimensionsConverters",(function(){return N})),n.d(e,"computeImageArea",(function(){return W}));var r=n(7),i=n(63),o={clone:r.clone,dot:r.dot},a=function(t,e){var n=[],r={rad:0,vec:o.clone([0,0])},i={};function a(t){i[t.id]=t,n.push(t)}function u(){var t,e=0;for(t=0;t<n.length;t++)e+=n[t].rad;r.rad=e/n.length,r.vec=o.clone([Math.cos(r.rad),Math.sin(r.rad)])}return a(t),u(),{add:function(t){i[t.id]||(a(t),u())},fits:function(t){return Math.abs(o.dot(t.point.vec,r.vec))>e},getPoints:function(){return n},getCenter:function(){return r}}},u=function(t,e,n){return{rad:t[n],point:t,id:e}},c=n(9),s={clone:r.clone},f={clone:i.clone};function l(t,e){return{x:t,y:e,toVec2:function(){return s.clone([this.x,this.y])},toVec3:function(){return f.clone([this.x,this.y,1])},round:function(){return this.x=this.x>0?Math.floor(this.x+.5):Math.floor(this.x-.5),this.y=this.y>0?Math.floor(this.y+.5):Math.floor(this.y-.5),this}}}function h(t,e){var n,r,i=t.data,o=t.size.x,a=t.size.y,u=e.data,c=0,s=0,f=0,l=0,h=0;for(f=o,c=0,r=1;r<a;r++)c+=i[s],u[f]+=c,s+=o,f+=o;for(s=0,f=1,c=0,n=1;n<o;n++)c+=i[s],u[f]+=c,s++,f++;for(r=1;r<a;r++)for(s=r*o+1,f=(r-1)*o+1,l=r*o,h=(r-1)*o,n=1;n<o;n++)u[s]+=i[s]+u[f]+u[l]-u[h],s++,f++,l++,h++}function d(t,e){for(var n=t.data,r=t.size.x,i=t.size.y,o=e.data,a=0,u=0;u<r;u++)a+=n[u],o[u]=a;for(var c=1;c<i;c++){a=0;for(var s=0;s<r;s++)a+=n[c*r+s],o[c*r+s]=a+o[(c-1)*r+s]}}function p(t,e,n){n||(n=t);for(var r=t.data,i=r.length,o=n.data;i--;)o[i]=r[i]<e?1:0}function v(t,e){e||(e=8);for(var n=t.data,r=n.length,i=8-e,o=new Int32Array(1<<e);r--;)o[n[r]>>i]++;return o}function g(t){var e,n,r=t.length,i=t[0],o=t[1];for(e=1;e<r-1;e++)n=t[e+1],t[e-1]=2*o-i-n&255,i=o,o=n;return t}function y(t){var e,n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:8,r=8-n;function i(t,n){for(var r=0,i=t;i<=n;i++)r+=e[i];return r}function o(t,n){for(var r=0,i=t;i<=n;i++)r+=i*e[i];return r}function a(){var r,a,u,s,f=[0],l=(1<<n)-1;e=v(t,n);for(var h=1;h<l;h++)0===(u=(r=i(0,h))*(a=i(h+1,l)))&&(u=1),s=o(0,h)*a-o(h+1,l)*r,f[h]=s*s/u;return c.a.maxIndex(f)}var u=a();return u<<r}function _(t,e){var n=y(t);return p(t,n,e),n}function m(t,e,n){d(t,e),n||(n=t);var r,i,o,a,u,c,s=t.data,f=n.data,l=t.size.x,h=t.size.y,p=e.data;for(r=0;r<=3;r++)for(i=0;i<l;i++)f[r*l+i]=0,f[(h-1-r)*l+i]=0;for(r=3;r<h-3;r++)for(i=0;i<=3;i++)f[r*l+i]=0,f[r*l+(l-1-i)]=0;for(r=4;r<h-3-1;r++)for(i=4;i<l-3;i++)o=p[(r-3-1)*l+(i-3-1)],a=p[(r-3-1)*l+(i+3)],u=p[(r+3)*l+(i-3-1)],c=(p[(r+3)*l+(i+3)]-u-a+o)/49,f[r*l+i]=s[r*l+i]>c+5?0:1}function b(t,e,n){var r,i,o,c,s=[];function f(t){var e=!1;for(i=0;i<s.length;i++)(o=s[i]).fits(t)&&(o.add(t),e=!0);return e}for(n||(n="rad"),r=0;r<t.length;r++)f(c=u(t[r],r,n))||s.push(a(c,e));return s}var w={trace:function(t,e){var n,r=[],i=[],o=0,a=0;function u(n,r){var i,o,a,u=Math.abs(e[1]/10),c=!1;var s,f,l=t[n];for(a=r?{x:l.x+e[0],y:l.y+e[1]}:{x:l.x-e[0],y:l.y-e[1]},i=t[o=r?n+1:n-1];i&&!0!=(f=a,c=(s=i).x>f.x-1&&s.x<f.x+1&&s.y>f.y-u&&s.y<f.y+u)&&Math.abs(i.y-l.y)<e[1];)i=t[o=r?o+1:o-1];return c?o:null}for(n=0;n<10;n++){for(a=o=Math.floor(Math.random()*t.length),(r=[]).push(t[a]);null!==(a=u(a,!0));)r.push(t[a]);if(o>0)for(a=o;null!==(a=u(a,!1));)r.push(t[a]);r.length>i.length&&(i=r)}return i}},x=1,E=2;function A(t,e){var n,r,i,o,a,u,c,s=t.data,f=e.data,l=t.size.y,h=t.size.x;for(n=1;n<l-1;n++)for(r=1;r<h-1;r++)a=n+1,c=r+1,i=s[(o=n-1)*h+(u=r-1)]+s[o*h+c]+s[n*h+r]+s[a*h+u]+s[a*h+c],f[n*h+r]=i>0?1:0}function R(t,e){var n,r,i,o,a,u,c,s=t.data,f=e.data,l=t.size.y,h=t.size.x;for(n=1;n<l-1;n++)for(r=1;r<h-1;r++)a=n+1,c=r+1,i=s[(o=n-1)*h+(u=r-1)]+s[o*h+c]+s[n*h+r]+s[a*h+u]+s[a*h+c],f[n*h+r]=5===i?1:0}function S(t,e,n){n||(n=t);for(var r=t.data.length,i=t.data,o=e.data,a=n.data;r--;)a[r]=i[r]-o[r]}function O(t,e,n){n||(n=t);for(var r=t.data.length,i=t.data,o=e.data,a=n.data;r--;)a[r]=i[r]||o[r]}function k(t){for(var e=t.data.length,n=t.data,r=0;e--;)r+=n[e];return r}function C(t,e,n){var r,i,o,a,u=0,c=0,s=[];for(r=0;r<e;r++)s[r]={score:0,item:null};for(r=0;r<t.length;r++)if((i=n.apply(this,[t[r]]))>c)for((o=s[u]).score=i,o.item=t[r],c=Number.MAX_VALUE,a=0;a<e;a++)s[a].score<c&&(c=s[a].score,u=a);return s}function j(t,e,n,r){n.drawImage(t,e,0,t.width,t.height),I(n.getImageData(e,0,t.width,t.height).data,r)}function M(t,e,n,r){I(t.getImageData(n.x,n.y,e.x,e.y).data,r)}function T(t,e,n){for(var r,i=0,o=e.x,a=Math.floor(t.length/4),u=e.x/2,c=0,s=e.x;o<a;){for(r=0;r<u;r++)n[c]=(.299*t[4*i+0]+.587*t[4*i+1]+.114*t[4*i+2]+(.299*t[4*(i+1)+0]+.587*t[4*(i+1)+1]+.114*t[4*(i+1)+2])+(.299*t[4*o+0]+.587*t[4*o+1]+.114*t[4*o+2])+(.299*t[4*(o+1)+0]+.587*t[4*(o+1)+1]+.114*t[4*(o+1)+2]))/4,c++,i+=2,o+=2;i+=s,o+=s}}function I(t,e,n){var r=t.length/4|0;if(n&&!0===n.singleChannel)for(var i=0;i<r;i++)e[i]=t[4*i+0];else for(var o=0;o<r;o++)e[o]=.299*t[4*o+0]+.587*t[4*o+1]+.114*t[4*o+2]}function D(t,e){var n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:document&&document.createElement("canvas"),r=new Image;r.callback=e,r.onload=function(){n.width=this.width,n.height=this.height;var t=n.getContext("2d");t.drawImage(this,0,0);var e=new Uint8Array(this.width*this.height);t.drawImage(this,0,0),I(t.getImageData(0,0,this.width,this.height).data,e),this.callback(e,{x:this.width,y:this.height},this)},r.src=t}function P(t,e){for(var n=t.data,r=t.size.x,i=e.data,o=0,a=r,u=n.length,c=r/2,s=0;a<u;){for(var f=0;f<c;f++)i[s]=Math.floor((n[o]+n[o+1]+n[a]+n[a+1])/4),s++,o+=2,a+=2;o+=r,a+=r}}function L(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:[0,0,0],n=t[0],r=t[1],i=t[2],o=i*r,a=o*(1-Math.abs(n/60%2-1)),u=i-o,c=0,s=0,f=0;return n<60?(c=o,s=a):n<120?(c=a,s=o):n<180?(s=o,f=a):n<240?(s=a,f=o):n<300?(c=a,f=o):n<360&&(c=o,f=a),e[0]=255*(c+u)|0,e[1]=255*(s+u)|0,e[2]=255*(f+u)|0,e}function U(t){for(var e=[],n=[],r=1;r<Math.sqrt(t)+1;r++)t%r==0&&(n.push(r),r!==t/r&&e.unshift(Math.floor(t/r)));return n.concat(e)}function z(t,e){var n,r=U(e.x),i=U(e.y),o=Math.max(e.x,e.y),a=function(t,e){for(var n=0,r=0,i=[];n<t.length&&r<e.length;)t[n]===e[r]?(i.push(t[n]),n++,r++):t[n]>e[r]?r++:n++;return i}(r,i),u=[8,10,15,20,32,60,80],c={"x-small":5,small:4,medium:3,large:2,"x-large":1},s=c[t]||c.medium,f=u[s],l=Math.floor(o/f);function h(t){for(var e=0,n=t[Math.floor(t.length/2)];e<t.length-1&&t[e]<l;)e++;return e>0&&(n=Math.abs(t[e]-l)>Math.abs(t[e-1]-l)?t[e-1]:t[e]),l/n<u[s+1]/u[s]&&l/n>u[s-1]/u[s]?{x:n,y:n}:null}return(n=h(a))||(n=h(U(o)))||(n=h(U(l*f))),n}function B(t){return{value:parseFloat(t),unit:(t.indexOf("%"),t.length,"%")}}var N={top:function(t,e){return"%"===t.unit?Math.floor(e.height*(t.value/100)):null},right:function(t,e){return"%"===t.unit?Math.floor(e.width-e.width*(t.value/100)):null},bottom:function(t,e){return"%"===t.unit?Math.floor(e.height-e.height*(t.value/100)):null},left:function(t,e){return"%"===t.unit?Math.floor(e.width*(t.value/100)):null}};function W(t,e,n){var r={width:t,height:e},i=Object.keys(n).reduce((function(t,e){var i=B(n[e]),o=N[e](i,r);return t[e]=o,t}),{});return{sx:i.left,sy:i.top,sw:i.right-i.left,sh:i.bottom-i.top}}},function(t,e,n){"use strict";e.a={init:function(t,e){for(var n=t.length;n--;)t[n]=e},shuffle:function(t){for(var e=t.length-1;e>=0;e--){var n=Math.floor(Math.random()*e),r=t[e];t[e]=t[n],t[n]=r}return t},toPointList:function(t){var e=t.reduce((function(t,e){var n="[".concat(e.join(","),"]");return t.push(n),t}),[]);return"[".concat(e.join(",\r\n"),"]")},threshold:function(t,e,n){return t.reduce((function(r,i){return n.apply(t,[i])>=e&&r.push(i),r}),[])},maxIndex:function(t){for(var e=0,n=0;n<t.length;n++)t[n]>t[e]&&(e=n);return e},max:function(t){for(var e=0,n=0;n<t.length;n++)t[n]>e&&(e=t[n]);return e},sum:function(t){for(var e=t.length,n=0;e--;)n+=t[e];return n}}},function(t,e,n){"use strict";var r=n(25),i=n.n(r),o=n(3),a=n.n(o),u=n(4),c=n.n(u),s=n(0),f=n.n(s),l=n(7),h=n(8),d=n(9),p={clone:l.clone};function v(t){if(t<0)throw new Error("expected positive number, received ".concat(t))}var g=function(){function t(e,n){var r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:Uint8Array,i=arguments.length>3?arguments[3]:void 0;a()(this,t),f()(this,"data",void 0),f()(this,"size",void 0),f()(this,"indexMapping",void 0),n?this.data=n:(this.data=new r(e.x*e.y),i&&d.a.init(this.data,0)),this.size=e}return c()(t,[{key:"inImageWithBorder",value:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:0;return v(e),t.x>=0&&t.y>=0&&t.x<this.size.x+2*e&&t.y<this.size.y+2*e}},{key:"subImageAsCopy",value:function(t,e){v(e.x),v(e.y);for(var n=t.size,r=n.x,i=n.y,o=0;o<r;o++)for(var a=0;a<i;a++)t.data[a*r+o]=this.data[(e.y+a)*this.size.x+e.x+o];return t}},{key:"get",value:function(t,e){return this.data[e*this.size.x+t]}},{key:"getSafe",value:function(t,e){if(!this.indexMapping){this.indexMapping={x:[],y:[]};for(var n=0;n<this.size.x;n++)this.indexMapping.x[n]=n,this.indexMapping.x[n+this.size.x]=n;for(var r=0;r<this.size.y;r++)this.indexMapping.y[r]=r,this.indexMapping.y[r+this.size.y]=r}return this.data[this.indexMapping.y[e+this.size.y]*this.size.x+this.indexMapping.x[t+this.size.x]]}},{key:"set",value:function(t,e,n){return this.data[e*this.size.x+t]=n,delete this.indexMapping,this}},{key:"zeroBorder",value:function(){for(var t=this.size,e=t.x,n=t.y,r=0;r<e;r++)this.data[r]=this.data[(n-1)*e+r]=0;for(var i=1;i<n-1;i++)this.data[i*e]=this.data[i*e+(e-1)]=0;return delete this.indexMapping,this}},{key:"moments",value:function(t){var e,n,r,i,o,a,u,c,s,f,l=this.data,h=this.size.y,d=this.size.x,v=[],g=[],y=Math.PI,_=y/4;if(t<=0)return g;for(o=0;o<t;o++)v[o]={m00:0,m01:0,m10:0,m11:0,m02:0,m20:0,theta:0,rad:0};for(n=0;n<h;n++)for(i=n*n,e=0;e<d;e++)(r=l[n*d+e])>0&&((a=v[r-1]).m00+=1,a.m01+=n,a.m10+=e,a.m11+=e*n,a.m02+=i,a.m20+=e*e);for(o=0;o<t;o++)a=v[o],isNaN(a.m00)||0===a.m00||(c=a.m10/a.m00,s=a.m01/a.m00,u=a.m11/a.m00-c*s,f=(a.m02/a.m00-s*s-(a.m20/a.m00-c*c))/(2*u),f=.5*Math.atan(f)+(u>=0?_:-_)+y,a.theta=(180*f/y+90)%180-90,a.theta<0&&(a.theta+=180),a.rad=f>y?f-y:f,a.vec=p.clone([Math.cos(f),Math.sin(f)]),g.push(a));return g}},{key:"getAsRGBA",value:function(){for(var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:1,e=new Uint8ClampedArray(4*this.size.x*this.size.y),n=0;n<this.size.y;n++)for(var r=0;r<this.size.x;r++){var i=n*this.size.x+r,o=this.get(r,n)*t;e[4*i+0]=o,e[4*i+1]=o,e[4*i+2]=o,e[4*i+3]=255}return e}},{key:"show",value:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:1,n=t.getContext("2d");if(!n)throw new Error("Unable to get canvas context");var r=n.getImageData(0,0,t.width,t.height),i=this.getAsRGBA(e);t.width=this.size.x,t.height=this.size.y;var o=new ImageData(i,r.width,r.height);n.putImageData(o,0,0)}},{key:"overlay",value:function(t,e,n){var r=e<0||e>360?360:e,o=[0,1,1],a=[0,0,0],u=[255,255,255],c=[0,0,0],s=t.getContext("2d");if(!s)throw new Error("Unable to get canvas context");for(var f=s.getImageData(n.x,n.y,this.size.x,this.size.y),l=f.data,d=this.data.length;d--;){o[0]=this.data[d]*r;var p=4*d,v=o[0]<=0?u:o[0]>=360?c:Object(h.hsv2rgb)(o,a),g=i()(v,3);l[p]=g[0],l[p+1]=g[1],l[p+2]=g[2],l[p+3]=255}s.putImageData(f,n.x,n.y)}}]),t}();e.a=g},function(t,e,n){(function(t,r){var i;
/**
 * @license
 * Lodash <https://lodash.com/>
 * Copyright OpenJS Foundation and other contributors <https://openjsf.org/>
 * Released under MIT license <https://lodash.com/license>
 * Based on Underscore.js 1.8.3 <http://underscorejs.org/LICENSE>
 * Copyright Jeremy Ashkenas, DocumentCloud and Investigative Reporters & Editors
 */(function(){var o="Expected a function",a="__lodash_placeholder__",u=[["ary",128],["bind",1],["bindKey",2],["curry",8],["curryRight",16],["flip",512],["partial",32],["partialRight",64],["rearg",256]],c="[object Arguments]",s="[object Array]",f="[object Boolean]",l="[object Date]",h="[object Error]",d="[object Function]",p="[object GeneratorFunction]",v="[object Map]",g="[object Number]",y="[object Object]",_="[object RegExp]",m="[object Set]",b="[object String]",w="[object Symbol]",x="[object WeakMap]",E="[object ArrayBuffer]",A="[object DataView]",R="[object Float32Array]",S="[object Float64Array]",O="[object Int8Array]",k="[object Int16Array]",C="[object Int32Array]",j="[object Uint8Array]",M="[object Uint16Array]",T="[object Uint32Array]",I=/\b__p \+= '';/g,D=/\b(__p \+=) '' \+/g,P=/(__e\(.*?\)|\b__t\)) \+\n'';/g,L=/&(?:amp|lt|gt|quot|#39);/g,U=/[&<>"']/g,z=RegExp(L.source),B=RegExp(U.source),N=/<%-([\s\S]+?)%>/g,W=/<%([\s\S]+?)%>/g,F=/<%=([\s\S]+?)%>/g,q=/\.|\[(?:[^[\]]*|(["'])(?:(?!\1)[^\\]|\\.)*?\1)\]/,V=/^\w*$/,Y=/[^.[\]]+|\[(?:(-?\d+(?:\.\d+)?)|(["'])((?:(?!\2)[^\\]|\\.)*?)\2)\]|(?=(?:\.|\[\])(?:\.|\[\]|$))/g,G=/[\\^$.*+?()[\]{}|]/g,H=RegExp(G.source),$=/^\s+|\s+$/g,X=/^\s+/,Z=/\s+$/,Q=/\{(?:\n\/\* \[wrapped with .+\] \*\/)?\n?/,K=/\{\n\/\* \[wrapped with (.+)\] \*/,J=/,? & /,tt=/[^\x00-\x2f\x3a-\x40\x5b-\x60\x7b-\x7f]+/g,et=/\\(\\)?/g,nt=/\$\{([^\\}]*(?:\\.[^\\}]*)*)\}/g,rt=/\w*$/,it=/^[-+]0x[0-9a-f]+$/i,ot=/^0b[01]+$/i,at=/^\[object .+?Constructor\]$/,ut=/^0o[0-7]+$/i,ct=/^(?:0|[1-9]\d*)$/,st=/[\xc0-\xd6\xd8-\xf6\xf8-\xff\u0100-\u017f]/g,ft=/($^)/,lt=/['\n\r\u2028\u2029\\]/g,ht="\\u0300-\\u036f\\ufe20-\\ufe2f\\u20d0-\\u20ff",dt="\\xac\\xb1\\xd7\\xf7\\x00-\\x2f\\x3a-\\x40\\x5b-\\x60\\x7b-\\xbf\\u2000-\\u206f \\t\\x0b\\f\\xa0\\ufeff\\n\\r\\u2028\\u2029\\u1680\\u180e\\u2000\\u2001\\u2002\\u2003\\u2004\\u2005\\u2006\\u2007\\u2008\\u2009\\u200a\\u202f\\u205f\\u3000",pt="[\\ud800-\\udfff]",vt="["+dt+"]",gt="["+ht+"]",yt="\\d+",_t="[\\u2700-\\u27bf]",mt="[a-z\\xdf-\\xf6\\xf8-\\xff]",bt="[^\\ud800-\\udfff"+dt+yt+"\\u2700-\\u27bfa-z\\xdf-\\xf6\\xf8-\\xffA-Z\\xc0-\\xd6\\xd8-\\xde]",wt="\\ud83c[\\udffb-\\udfff]",xt="[^\\ud800-\\udfff]",Et="(?:\\ud83c[\\udde6-\\uddff]){2}",At="[\\ud800-\\udbff][\\udc00-\\udfff]",Rt="[A-Z\\xc0-\\xd6\\xd8-\\xde]",St="(?:"+mt+"|"+bt+")",Ot="(?:"+Rt+"|"+bt+")",kt="(?:"+gt+"|"+wt+")"+"?",Ct="[\\ufe0e\\ufe0f]?"+kt+("(?:\\u200d(?:"+[xt,Et,At].join("|")+")[\\ufe0e\\ufe0f]?"+kt+")*"),jt="(?:"+[_t,Et,At].join("|")+")"+Ct,Mt="(?:"+[xt+gt+"?",gt,Et,At,pt].join("|")+")",Tt=RegExp("['’]","g"),It=RegExp(gt,"g"),Dt=RegExp(wt+"(?="+wt+")|"+Mt+Ct,"g"),Pt=RegExp([Rt+"?"+mt+"+(?:['’](?:d|ll|m|re|s|t|ve))?(?="+[vt,Rt,"$"].join("|")+")",Ot+"+(?:['’](?:D|LL|M|RE|S|T|VE))?(?="+[vt,Rt+St,"$"].join("|")+")",Rt+"?"+St+"+(?:['’](?:d|ll|m|re|s|t|ve))?",Rt+"+(?:['’](?:D|LL|M|RE|S|T|VE))?","\\d*(?:1ST|2ND|3RD|(?![123])\\dTH)(?=\\b|[a-z_])","\\d*(?:1st|2nd|3rd|(?![123])\\dth)(?=\\b|[A-Z_])",yt,jt].join("|"),"g"),Lt=RegExp("[\\u200d\\ud800-\\udfff"+ht+"\\ufe0e\\ufe0f]"),Ut=/[a-z][A-Z]|[A-Z]{2}[a-z]|[0-9][a-zA-Z]|[a-zA-Z][0-9]|[^a-zA-Z0-9 ]/,zt=["Array","Buffer","DataView","Date","Error","Float32Array","Float64Array","Function","Int8Array","Int16Array","Int32Array","Map","Math","Object","Promise","RegExp","Set","String","Symbol","TypeError","Uint8Array","Uint8ClampedArray","Uint16Array","Uint32Array","WeakMap","_","clearTimeout","isFinite","parseInt","setTimeout"],Bt=-1,Nt={};Nt[R]=Nt[S]=Nt[O]=Nt[k]=Nt[C]=Nt[j]=Nt["[object Uint8ClampedArray]"]=Nt[M]=Nt[T]=!0,Nt[c]=Nt[s]=Nt[E]=Nt[f]=Nt[A]=Nt[l]=Nt[h]=Nt[d]=Nt[v]=Nt[g]=Nt[y]=Nt[_]=Nt[m]=Nt[b]=Nt[x]=!1;var Wt={};Wt[c]=Wt[s]=Wt[E]=Wt[A]=Wt[f]=Wt[l]=Wt[R]=Wt[S]=Wt[O]=Wt[k]=Wt[C]=Wt[v]=Wt[g]=Wt[y]=Wt[_]=Wt[m]=Wt[b]=Wt[w]=Wt[j]=Wt["[object Uint8ClampedArray]"]=Wt[M]=Wt[T]=!0,Wt[h]=Wt[d]=Wt[x]=!1;var Ft={"\\":"\\","'":"'","\n":"n","\r":"r","\u2028":"u2028","\u2029":"u2029"},qt=parseFloat,Vt=parseInt,Yt="object"==typeof t&&t&&t.Object===Object&&t,Gt="object"==typeof self&&self&&self.Object===Object&&self,Ht=Yt||Gt||Function("return this")(),$t=e&&!e.nodeType&&e,Xt=$t&&"object"==typeof r&&r&&!r.nodeType&&r,Zt=Xt&&Xt.exports===$t,Qt=Zt&&Yt.process,Kt=function(){try{var t=Xt&&Xt.require&&Xt.require("util").types;return t||Qt&&Qt.binding&&Qt.binding("util")}catch(t){}}(),Jt=Kt&&Kt.isArrayBuffer,te=Kt&&Kt.isDate,ee=Kt&&Kt.isMap,ne=Kt&&Kt.isRegExp,re=Kt&&Kt.isSet,ie=Kt&&Kt.isTypedArray;function oe(t,e,n){switch(n.length){case 0:return t.call(e);case 1:return t.call(e,n[0]);case 2:return t.call(e,n[0],n[1]);case 3:return t.call(e,n[0],n[1],n[2])}return t.apply(e,n)}function ae(t,e,n,r){for(var i=-1,o=null==t?0:t.length;++i<o;){var a=t[i];e(r,a,n(a),t)}return r}function ue(t,e){for(var n=-1,r=null==t?0:t.length;++n<r&&!1!==e(t[n],n,t););return t}function ce(t,e){for(var n=null==t?0:t.length;n--&&!1!==e(t[n],n,t););return t}function se(t,e){for(var n=-1,r=null==t?0:t.length;++n<r;)if(!e(t[n],n,t))return!1;return!0}function fe(t,e){for(var n=-1,r=null==t?0:t.length,i=0,o=[];++n<r;){var a=t[n];e(a,n,t)&&(o[i++]=a)}return o}function le(t,e){return!!(null==t?0:t.length)&&we(t,e,0)>-1}function he(t,e,n){for(var r=-1,i=null==t?0:t.length;++r<i;)if(n(e,t[r]))return!0;return!1}function de(t,e){for(var n=-1,r=null==t?0:t.length,i=Array(r);++n<r;)i[n]=e(t[n],n,t);return i}function pe(t,e){for(var n=-1,r=e.length,i=t.length;++n<r;)t[i+n]=e[n];return t}function ve(t,e,n,r){var i=-1,o=null==t?0:t.length;for(r&&o&&(n=t[++i]);++i<o;)n=e(n,t[i],i,t);return n}function ge(t,e,n,r){var i=null==t?0:t.length;for(r&&i&&(n=t[--i]);i--;)n=e(n,t[i],i,t);return n}function ye(t,e){for(var n=-1,r=null==t?0:t.length;++n<r;)if(e(t[n],n,t))return!0;return!1}var _e=Re("length");function me(t,e,n){var r;return n(t,(function(t,n,i){if(e(t,n,i))return r=n,!1})),r}function be(t,e,n,r){for(var i=t.length,o=n+(r?1:-1);r?o--:++o<i;)if(e(t[o],o,t))return o;return-1}function we(t,e,n){return e==e?function(t,e,n){var r=n-1,i=t.length;for(;++r<i;)if(t[r]===e)return r;return-1}(t,e,n):be(t,Ee,n)}function xe(t,e,n,r){for(var i=n-1,o=t.length;++i<o;)if(r(t[i],e))return i;return-1}function Ee(t){return t!=t}function Ae(t,e){var n=null==t?0:t.length;return n?ke(t,e)/n:NaN}function Re(t){return function(e){return null==e?void 0:e[t]}}function Se(t){return function(e){return null==t?void 0:t[e]}}function Oe(t,e,n,r,i){return i(t,(function(t,i,o){n=r?(r=!1,t):e(n,t,i,o)})),n}function ke(t,e){for(var n,r=-1,i=t.length;++r<i;){var o=e(t[r]);void 0!==o&&(n=void 0===n?o:n+o)}return n}function Ce(t,e){for(var n=-1,r=Array(t);++n<t;)r[n]=e(n);return r}function je(t){return function(e){return t(e)}}function Me(t,e){return de(e,(function(e){return t[e]}))}function Te(t,e){return t.has(e)}function Ie(t,e){for(var n=-1,r=t.length;++n<r&&we(e,t[n],0)>-1;);return n}function De(t,e){for(var n=t.length;n--&&we(e,t[n],0)>-1;);return n}function Pe(t,e){for(var n=t.length,r=0;n--;)t[n]===e&&++r;return r}var Le=Se({"À":"A","Á":"A","Â":"A","Ã":"A","Ä":"A","Å":"A","à":"a","á":"a","â":"a","ã":"a","ä":"a","å":"a","Ç":"C","ç":"c","Ð":"D","ð":"d","È":"E","É":"E","Ê":"E","Ë":"E","è":"e","é":"e","ê":"e","ë":"e","Ì":"I","Í":"I","Î":"I","Ï":"I","ì":"i","í":"i","î":"i","ï":"i","Ñ":"N","ñ":"n","Ò":"O","Ó":"O","Ô":"O","Õ":"O","Ö":"O","Ø":"O","ò":"o","ó":"o","ô":"o","õ":"o","ö":"o","ø":"o","Ù":"U","Ú":"U","Û":"U","Ü":"U","ù":"u","ú":"u","û":"u","ü":"u","Ý":"Y","ý":"y","ÿ":"y","Æ":"Ae","æ":"ae","Þ":"Th","þ":"th","ß":"ss","Ā":"A","Ă":"A","Ą":"A","ā":"a","ă":"a","ą":"a","Ć":"C","Ĉ":"C","Ċ":"C","Č":"C","ć":"c","ĉ":"c","ċ":"c","č":"c","Ď":"D","Đ":"D","ď":"d","đ":"d","Ē":"E","Ĕ":"E","Ė":"E","Ę":"E","Ě":"E","ē":"e","ĕ":"e","ė":"e","ę":"e","ě":"e","Ĝ":"G","Ğ":"G","Ġ":"G","Ģ":"G","ĝ":"g","ğ":"g","ġ":"g","ģ":"g","Ĥ":"H","Ħ":"H","ĥ":"h","ħ":"h","Ĩ":"I","Ī":"I","Ĭ":"I","Į":"I","İ":"I","ĩ":"i","ī":"i","ĭ":"i","į":"i","ı":"i","Ĵ":"J","ĵ":"j","Ķ":"K","ķ":"k","ĸ":"k","Ĺ":"L","Ļ":"L","Ľ":"L","Ŀ":"L","Ł":"L","ĺ":"l","ļ":"l","ľ":"l","ŀ":"l","ł":"l","Ń":"N","Ņ":"N","Ň":"N","Ŋ":"N","ń":"n","ņ":"n","ň":"n","ŋ":"n","Ō":"O","Ŏ":"O","Ő":"O","ō":"o","ŏ":"o","ő":"o","Ŕ":"R","Ŗ":"R","Ř":"R","ŕ":"r","ŗ":"r","ř":"r","Ś":"S","Ŝ":"S","Ş":"S","Š":"S","ś":"s","ŝ":"s","ş":"s","š":"s","Ţ":"T","Ť":"T","Ŧ":"T","ţ":"t","ť":"t","ŧ":"t","Ũ":"U","Ū":"U","Ŭ":"U","Ů":"U","Ű":"U","Ų":"U","ũ":"u","ū":"u","ŭ":"u","ů":"u","ű":"u","ų":"u","Ŵ":"W","ŵ":"w","Ŷ":"Y","ŷ":"y","Ÿ":"Y","Ź":"Z","Ż":"Z","Ž":"Z","ź":"z","ż":"z","ž":"z","Ĳ":"IJ","ĳ":"ij","Œ":"Oe","œ":"oe","ŉ":"'n","ſ":"s"}),Ue=Se({"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#39;"});function ze(t){return"\\"+Ft[t]}function Be(t){return Lt.test(t)}function Ne(t){var e=-1,n=Array(t.size);return t.forEach((function(t,r){n[++e]=[r,t]})),n}function We(t,e){return function(n){return t(e(n))}}function Fe(t,e){for(var n=-1,r=t.length,i=0,o=[];++n<r;){var u=t[n];u!==e&&u!==a||(t[n]=a,o[i++]=n)}return o}function qe(t){var e=-1,n=Array(t.size);return t.forEach((function(t){n[++e]=t})),n}function Ve(t){var e=-1,n=Array(t.size);return t.forEach((function(t){n[++e]=[t,t]})),n}function Ye(t){return Be(t)?function(t){var e=Dt.lastIndex=0;for(;Dt.test(t);)++e;return e}(t):_e(t)}function Ge(t){return Be(t)?function(t){return t.match(Dt)||[]}(t):function(t){return t.split("")}(t)}var He=Se({"&amp;":"&","&lt;":"<","&gt;":">","&quot;":'"',"&#39;":"'"});var $e=function t(e){var n,r=(e=null==e?Ht:$e.defaults(Ht.Object(),e,$e.pick(Ht,zt))).Array,i=e.Date,ht=e.Error,dt=e.Function,pt=e.Math,vt=e.Object,gt=e.RegExp,yt=e.String,_t=e.TypeError,mt=r.prototype,bt=dt.prototype,wt=vt.prototype,xt=e["__core-js_shared__"],Et=bt.toString,At=wt.hasOwnProperty,Rt=0,St=(n=/[^.]+$/.exec(xt&&xt.keys&&xt.keys.IE_PROTO||""))?"Symbol(src)_1."+n:"",Ot=wt.toString,kt=Et.call(vt),Ct=Ht._,jt=gt("^"+Et.call(At).replace(G,"\\$&").replace(/hasOwnProperty|(function).*?(?=\\\()| for .+?(?=\\\])/g,"$1.*?")+"$"),Mt=Zt?e.Buffer:void 0,Dt=e.Symbol,Lt=e.Uint8Array,Ft=Mt?Mt.allocUnsafe:void 0,Yt=We(vt.getPrototypeOf,vt),Gt=vt.create,$t=wt.propertyIsEnumerable,Xt=mt.splice,Qt=Dt?Dt.isConcatSpreadable:void 0,Kt=Dt?Dt.iterator:void 0,_e=Dt?Dt.toStringTag:void 0,Se=function(){try{var t=Ji(vt,"defineProperty");return t({},"",{}),t}catch(t){}}(),Xe=e.clearTimeout!==Ht.clearTimeout&&e.clearTimeout,Ze=i&&i.now!==Ht.Date.now&&i.now,Qe=e.setTimeout!==Ht.setTimeout&&e.setTimeout,Ke=pt.ceil,Je=pt.floor,tn=vt.getOwnPropertySymbols,en=Mt?Mt.isBuffer:void 0,nn=e.isFinite,rn=mt.join,on=We(vt.keys,vt),an=pt.max,un=pt.min,cn=i.now,sn=e.parseInt,fn=pt.random,ln=mt.reverse,hn=Ji(e,"DataView"),dn=Ji(e,"Map"),pn=Ji(e,"Promise"),vn=Ji(e,"Set"),gn=Ji(e,"WeakMap"),yn=Ji(vt,"create"),_n=gn&&new gn,mn={},bn=Oo(hn),wn=Oo(dn),xn=Oo(pn),En=Oo(vn),An=Oo(gn),Rn=Dt?Dt.prototype:void 0,Sn=Rn?Rn.valueOf:void 0,On=Rn?Rn.toString:void 0;function kn(t){if(Va(t)&&!Ia(t)&&!(t instanceof Tn)){if(t instanceof Mn)return t;if(At.call(t,"__wrapped__"))return ko(t)}return new Mn(t)}var Cn=function(){function t(){}return function(e){if(!qa(e))return{};if(Gt)return Gt(e);t.prototype=e;var n=new t;return t.prototype=void 0,n}}();function jn(){}function Mn(t,e){this.__wrapped__=t,this.__actions__=[],this.__chain__=!!e,this.__index__=0,this.__values__=void 0}function Tn(t){this.__wrapped__=t,this.__actions__=[],this.__dir__=1,this.__filtered__=!1,this.__iteratees__=[],this.__takeCount__=4294967295,this.__views__=[]}function In(t){var e=-1,n=null==t?0:t.length;for(this.clear();++e<n;){var r=t[e];this.set(r[0],r[1])}}function Dn(t){var e=-1,n=null==t?0:t.length;for(this.clear();++e<n;){var r=t[e];this.set(r[0],r[1])}}function Pn(t){var e=-1,n=null==t?0:t.length;for(this.clear();++e<n;){var r=t[e];this.set(r[0],r[1])}}function Ln(t){var e=-1,n=null==t?0:t.length;for(this.__data__=new Pn;++e<n;)this.add(t[e])}function Un(t){var e=this.__data__=new Dn(t);this.size=e.size}function zn(t,e){var n=Ia(t),r=!n&&Ta(t),i=!n&&!r&&Ua(t),o=!n&&!r&&!i&&Ka(t),a=n||r||i||o,u=a?Ce(t.length,yt):[],c=u.length;for(var s in t)!e&&!At.call(t,s)||a&&("length"==s||i&&("offset"==s||"parent"==s)||o&&("buffer"==s||"byteLength"==s||"byteOffset"==s)||ao(s,c))||u.push(s);return u}function Bn(t){var e=t.length;return e?t[Lr(0,e-1)]:void 0}function Nn(t,e){return Ao(yi(t),Xn(e,0,t.length))}function Wn(t){return Ao(yi(t))}function Fn(t,e,n){(void 0!==n&&!Ca(t[e],n)||void 0===n&&!(e in t))&&Hn(t,e,n)}function qn(t,e,n){var r=t[e];At.call(t,e)&&Ca(r,n)&&(void 0!==n||e in t)||Hn(t,e,n)}function Vn(t,e){for(var n=t.length;n--;)if(Ca(t[n][0],e))return n;return-1}function Yn(t,e,n,r){return tr(t,(function(t,i,o){e(r,t,n(t),o)})),r}function Gn(t,e){return t&&_i(e,bu(e),t)}function Hn(t,e,n){"__proto__"==e&&Se?Se(t,e,{configurable:!0,enumerable:!0,value:n,writable:!0}):t[e]=n}function $n(t,e){for(var n=-1,i=e.length,o=r(i),a=null==t;++n<i;)o[n]=a?void 0:vu(t,e[n]);return o}function Xn(t,e,n){return t==t&&(void 0!==n&&(t=t<=n?t:n),void 0!==e&&(t=t>=e?t:e)),t}function Zn(t,e,n,r,i,o){var a,u=1&e,s=2&e,h=4&e;if(n&&(a=i?n(t,r,i,o):n(t)),void 0!==a)return a;if(!qa(t))return t;var x=Ia(t);if(x){if(a=function(t){var e=t.length,n=new t.constructor(e);e&&"string"==typeof t[0]&&At.call(t,"index")&&(n.index=t.index,n.input=t.input);return n}(t),!u)return yi(t,a)}else{var I=no(t),D=I==d||I==p;if(Ua(t))return li(t,u);if(I==y||I==c||D&&!i){if(a=s||D?{}:io(t),!u)return s?function(t,e){return _i(t,eo(t),e)}(t,function(t,e){return t&&_i(e,wu(e),t)}(a,t)):function(t,e){return _i(t,to(t),e)}(t,Gn(a,t))}else{if(!Wt[I])return i?t:{};a=function(t,e,n){var r=t.constructor;switch(e){case E:return hi(t);case f:case l:return new r(+t);case A:return function(t,e){var n=e?hi(t.buffer):t.buffer;return new t.constructor(n,t.byteOffset,t.byteLength)}(t,n);case R:case S:case O:case k:case C:case j:case"[object Uint8ClampedArray]":case M:case T:return di(t,n);case v:return new r;case g:case b:return new r(t);case _:return function(t){var e=new t.constructor(t.source,rt.exec(t));return e.lastIndex=t.lastIndex,e}(t);case m:return new r;case w:return i=t,Sn?vt(Sn.call(i)):{}}var i}(t,I,u)}}o||(o=new Un);var P=o.get(t);if(P)return P;o.set(t,a),Xa(t)?t.forEach((function(r){a.add(Zn(r,e,n,r,t,o))})):Ya(t)&&t.forEach((function(r,i){a.set(i,Zn(r,e,n,i,t,o))}));var L=x?void 0:(h?s?Gi:Yi:s?wu:bu)(t);return ue(L||t,(function(r,i){L&&(r=t[i=r]),qn(a,i,Zn(r,e,n,i,t,o))})),a}function Qn(t,e,n){var r=n.length;if(null==t)return!r;for(t=vt(t);r--;){var i=n[r],o=e[i],a=t[i];if(void 0===a&&!(i in t)||!o(a))return!1}return!0}function Kn(t,e,n){if("function"!=typeof t)throw new _t(o);return bo((function(){t.apply(void 0,n)}),e)}function Jn(t,e,n,r){var i=-1,o=le,a=!0,u=t.length,c=[],s=e.length;if(!u)return c;n&&(e=de(e,je(n))),r?(o=he,a=!1):e.length>=200&&(o=Te,a=!1,e=new Ln(e));t:for(;++i<u;){var f=t[i],l=null==n?f:n(f);if(f=r||0!==f?f:0,a&&l==l){for(var h=s;h--;)if(e[h]===l)continue t;c.push(f)}else o(e,l,r)||c.push(f)}return c}kn.templateSettings={escape:N,evaluate:W,interpolate:F,variable:"",imports:{_:kn}},kn.prototype=jn.prototype,kn.prototype.constructor=kn,Mn.prototype=Cn(jn.prototype),Mn.prototype.constructor=Mn,Tn.prototype=Cn(jn.prototype),Tn.prototype.constructor=Tn,In.prototype.clear=function(){this.__data__=yn?yn(null):{},this.size=0},In.prototype.delete=function(t){var e=this.has(t)&&delete this.__data__[t];return this.size-=e?1:0,e},In.prototype.get=function(t){var e=this.__data__;if(yn){var n=e[t];return"__lodash_hash_undefined__"===n?void 0:n}return At.call(e,t)?e[t]:void 0},In.prototype.has=function(t){var e=this.__data__;return yn?void 0!==e[t]:At.call(e,t)},In.prototype.set=function(t,e){var n=this.__data__;return this.size+=this.has(t)?0:1,n[t]=yn&&void 0===e?"__lodash_hash_undefined__":e,this},Dn.prototype.clear=function(){this.__data__=[],this.size=0},Dn.prototype.delete=function(t){var e=this.__data__,n=Vn(e,t);return!(n<0)&&(n==e.length-1?e.pop():Xt.call(e,n,1),--this.size,!0)},Dn.prototype.get=function(t){var e=this.__data__,n=Vn(e,t);return n<0?void 0:e[n][1]},Dn.prototype.has=function(t){return Vn(this.__data__,t)>-1},Dn.prototype.set=function(t,e){var n=this.__data__,r=Vn(n,t);return r<0?(++this.size,n.push([t,e])):n[r][1]=e,this},Pn.prototype.clear=function(){this.size=0,this.__data__={hash:new In,map:new(dn||Dn),string:new In}},Pn.prototype.delete=function(t){var e=Qi(this,t).delete(t);return this.size-=e?1:0,e},Pn.prototype.get=function(t){return Qi(this,t).get(t)},Pn.prototype.has=function(t){return Qi(this,t).has(t)},Pn.prototype.set=function(t,e){var n=Qi(this,t),r=n.size;return n.set(t,e),this.size+=n.size==r?0:1,this},Ln.prototype.add=Ln.prototype.push=function(t){return this.__data__.set(t,"__lodash_hash_undefined__"),this},Ln.prototype.has=function(t){return this.__data__.has(t)},Un.prototype.clear=function(){this.__data__=new Dn,this.size=0},Un.prototype.delete=function(t){var e=this.__data__,n=e.delete(t);return this.size=e.size,n},Un.prototype.get=function(t){return this.__data__.get(t)},Un.prototype.has=function(t){return this.__data__.has(t)},Un.prototype.set=function(t,e){var n=this.__data__;if(n instanceof Dn){var r=n.__data__;if(!dn||r.length<199)return r.push([t,e]),this.size=++n.size,this;n=this.__data__=new Pn(r)}return n.set(t,e),this.size=n.size,this};var tr=wi(cr),er=wi(sr,!0);function nr(t,e){var n=!0;return tr(t,(function(t,r,i){return n=!!e(t,r,i)})),n}function rr(t,e,n){for(var r=-1,i=t.length;++r<i;){var o=t[r],a=e(o);if(null!=a&&(void 0===u?a==a&&!Qa(a):n(a,u)))var u=a,c=o}return c}function ir(t,e){var n=[];return tr(t,(function(t,r,i){e(t,r,i)&&n.push(t)})),n}function or(t,e,n,r,i){var o=-1,a=t.length;for(n||(n=oo),i||(i=[]);++o<a;){var u=t[o];e>0&&n(u)?e>1?or(u,e-1,n,r,i):pe(i,u):r||(i[i.length]=u)}return i}var ar=xi(),ur=xi(!0);function cr(t,e){return t&&ar(t,e,bu)}function sr(t,e){return t&&ur(t,e,bu)}function fr(t,e){return fe(e,(function(e){return Na(t[e])}))}function lr(t,e){for(var n=0,r=(e=ui(e,t)).length;null!=t&&n<r;)t=t[So(e[n++])];return n&&n==r?t:void 0}function hr(t,e,n){var r=e(t);return Ia(t)?r:pe(r,n(t))}function dr(t){return null==t?void 0===t?"[object Undefined]":"[object Null]":_e&&_e in vt(t)?function(t){var e=At.call(t,_e),n=t[_e];try{t[_e]=void 0;var r=!0}catch(t){}var i=Ot.call(t);r&&(e?t[_e]=n:delete t[_e]);return i}(t):function(t){return Ot.call(t)}(t)}function pr(t,e){return t>e}function vr(t,e){return null!=t&&At.call(t,e)}function gr(t,e){return null!=t&&e in vt(t)}function yr(t,e,n){for(var i=n?he:le,o=t[0].length,a=t.length,u=a,c=r(a),s=1/0,f=[];u--;){var l=t[u];u&&e&&(l=de(l,je(e))),s=un(l.length,s),c[u]=!n&&(e||o>=120&&l.length>=120)?new Ln(u&&l):void 0}l=t[0];var h=-1,d=c[0];t:for(;++h<o&&f.length<s;){var p=l[h],v=e?e(p):p;if(p=n||0!==p?p:0,!(d?Te(d,v):i(f,v,n))){for(u=a;--u;){var g=c[u];if(!(g?Te(g,v):i(t[u],v,n)))continue t}d&&d.push(v),f.push(p)}}return f}function _r(t,e,n){var r=null==(t=go(t,e=ui(e,t)))?t:t[So(Bo(e))];return null==r?void 0:oe(r,t,n)}function mr(t){return Va(t)&&dr(t)==c}function br(t,e,n,r,i){return t===e||(null==t||null==e||!Va(t)&&!Va(e)?t!=t&&e!=e:function(t,e,n,r,i,o){var a=Ia(t),u=Ia(e),d=a?s:no(t),p=u?s:no(e),x=(d=d==c?y:d)==y,R=(p=p==c?y:p)==y,S=d==p;if(S&&Ua(t)){if(!Ua(e))return!1;a=!0,x=!1}if(S&&!x)return o||(o=new Un),a||Ka(t)?qi(t,e,n,r,i,o):function(t,e,n,r,i,o,a){switch(n){case A:if(t.byteLength!=e.byteLength||t.byteOffset!=e.byteOffset)return!1;t=t.buffer,e=e.buffer;case E:return!(t.byteLength!=e.byteLength||!o(new Lt(t),new Lt(e)));case f:case l:case g:return Ca(+t,+e);case h:return t.name==e.name&&t.message==e.message;case _:case b:return t==e+"";case v:var u=Ne;case m:var c=1&r;if(u||(u=qe),t.size!=e.size&&!c)return!1;var s=a.get(t);if(s)return s==e;r|=2,a.set(t,e);var d=qi(u(t),u(e),r,i,o,a);return a.delete(t),d;case w:if(Sn)return Sn.call(t)==Sn.call(e)}return!1}(t,e,d,n,r,i,o);if(!(1&n)){var O=x&&At.call(t,"__wrapped__"),k=R&&At.call(e,"__wrapped__");if(O||k){var C=O?t.value():t,j=k?e.value():e;return o||(o=new Un),i(C,j,n,r,o)}}if(!S)return!1;return o||(o=new Un),function(t,e,n,r,i,o){var a=1&n,u=Yi(t),c=u.length,s=Yi(e).length;if(c!=s&&!a)return!1;var f=c;for(;f--;){var l=u[f];if(!(a?l in e:At.call(e,l)))return!1}var h=o.get(t),d=o.get(e);if(h&&d)return h==e&&d==t;var p=!0;o.set(t,e),o.set(e,t);var v=a;for(;++f<c;){l=u[f];var g=t[l],y=e[l];if(r)var _=a?r(y,g,l,e,t,o):r(g,y,l,t,e,o);if(!(void 0===_?g===y||i(g,y,n,r,o):_)){p=!1;break}v||(v="constructor"==l)}if(p&&!v){var m=t.constructor,b=e.constructor;m==b||!("constructor"in t)||!("constructor"in e)||"function"==typeof m&&m instanceof m&&"function"==typeof b&&b instanceof b||(p=!1)}return o.delete(t),o.delete(e),p}(t,e,n,r,i,o)}(t,e,n,r,br,i))}function wr(t,e,n,r){var i=n.length,o=i,a=!r;if(null==t)return!o;for(t=vt(t);i--;){var u=n[i];if(a&&u[2]?u[1]!==t[u[0]]:!(u[0]in t))return!1}for(;++i<o;){var c=(u=n[i])[0],s=t[c],f=u[1];if(a&&u[2]){if(void 0===s&&!(c in t))return!1}else{var l=new Un;if(r)var h=r(s,f,c,t,e,l);if(!(void 0===h?br(f,s,3,r,l):h))return!1}}return!0}function xr(t){return!(!qa(t)||(e=t,St&&St in e))&&(Na(t)?jt:at).test(Oo(t));var e}function Er(t){return"function"==typeof t?t:null==t?Gu:"object"==typeof t?Ia(t)?Cr(t[0],t[1]):kr(t):ec(t)}function Ar(t){if(!lo(t))return on(t);var e=[];for(var n in vt(t))At.call(t,n)&&"constructor"!=n&&e.push(n);return e}function Rr(t){if(!qa(t))return function(t){var e=[];if(null!=t)for(var n in vt(t))e.push(n);return e}(t);var e=lo(t),n=[];for(var r in t)("constructor"!=r||!e&&At.call(t,r))&&n.push(r);return n}function Sr(t,e){return t<e}function Or(t,e){var n=-1,i=Pa(t)?r(t.length):[];return tr(t,(function(t,r,o){i[++n]=e(t,r,o)})),i}function kr(t){var e=Ki(t);return 1==e.length&&e[0][2]?po(e[0][0],e[0][1]):function(n){return n===t||wr(n,t,e)}}function Cr(t,e){return co(t)&&ho(e)?po(So(t),e):function(n){var r=vu(n,t);return void 0===r&&r===e?gu(n,t):br(e,r,3)}}function jr(t,e,n,r,i){t!==e&&ar(e,(function(o,a){if(i||(i=new Un),qa(o))!function(t,e,n,r,i,o,a){var u=_o(t,n),c=_o(e,n),s=a.get(c);if(s)return void Fn(t,n,s);var f=o?o(u,c,n+"",t,e,a):void 0,l=void 0===f;if(l){var h=Ia(c),d=!h&&Ua(c),p=!h&&!d&&Ka(c);f=c,h||d||p?Ia(u)?f=u:La(u)?f=yi(u):d?(l=!1,f=li(c,!0)):p?(l=!1,f=di(c,!0)):f=[]:Ha(c)||Ta(c)?(f=u,Ta(u)?f=au(u):qa(u)&&!Na(u)||(f=io(c))):l=!1}l&&(a.set(c,f),i(f,c,r,o,a),a.delete(c));Fn(t,n,f)}(t,e,a,n,jr,r,i);else{var u=r?r(_o(t,a),o,a+"",t,e,i):void 0;void 0===u&&(u=o),Fn(t,a,u)}}),wu)}function Mr(t,e){var n=t.length;if(n)return ao(e+=e<0?n:0,n)?t[e]:void 0}function Tr(t,e,n){e=e.length?de(e,(function(t){return Ia(t)?function(e){return lr(e,1===t.length?t[0]:t)}:t})):[Gu];var r=-1;return e=de(e,je(Zi())),function(t,e){var n=t.length;for(t.sort(e);n--;)t[n]=t[n].value;return t}(Or(t,(function(t,n,i){return{criteria:de(e,(function(e){return e(t)})),index:++r,value:t}})),(function(t,e){return function(t,e,n){var r=-1,i=t.criteria,o=e.criteria,a=i.length,u=n.length;for(;++r<a;){var c=pi(i[r],o[r]);if(c){if(r>=u)return c;var s=n[r];return c*("desc"==s?-1:1)}}return t.index-e.index}(t,e,n)}))}function Ir(t,e,n){for(var r=-1,i=e.length,o={};++r<i;){var a=e[r],u=lr(t,a);n(u,a)&&Wr(o,ui(a,t),u)}return o}function Dr(t,e,n,r){var i=r?xe:we,o=-1,a=e.length,u=t;for(t===e&&(e=yi(e)),n&&(u=de(t,je(n)));++o<a;)for(var c=0,s=e[o],f=n?n(s):s;(c=i(u,f,c,r))>-1;)u!==t&&Xt.call(u,c,1),Xt.call(t,c,1);return t}function Pr(t,e){for(var n=t?e.length:0,r=n-1;n--;){var i=e[n];if(n==r||i!==o){var o=i;ao(i)?Xt.call(t,i,1):Jr(t,i)}}return t}function Lr(t,e){return t+Je(fn()*(e-t+1))}function Ur(t,e){var n="";if(!t||e<1||e>9007199254740991)return n;do{e%2&&(n+=t),(e=Je(e/2))&&(t+=t)}while(e);return n}function zr(t,e){return wo(vo(t,e,Gu),t+"")}function Br(t){return Bn(Cu(t))}function Nr(t,e){var n=Cu(t);return Ao(n,Xn(e,0,n.length))}function Wr(t,e,n,r){if(!qa(t))return t;for(var i=-1,o=(e=ui(e,t)).length,a=o-1,u=t;null!=u&&++i<o;){var c=So(e[i]),s=n;if("__proto__"===c||"constructor"===c||"prototype"===c)return t;if(i!=a){var f=u[c];void 0===(s=r?r(f,c,u):void 0)&&(s=qa(f)?f:ao(e[i+1])?[]:{})}qn(u,c,s),u=u[c]}return t}var Fr=_n?function(t,e){return _n.set(t,e),t}:Gu,qr=Se?function(t,e){return Se(t,"toString",{configurable:!0,enumerable:!1,value:qu(e),writable:!0})}:Gu;function Vr(t){return Ao(Cu(t))}function Yr(t,e,n){var i=-1,o=t.length;e<0&&(e=-e>o?0:o+e),(n=n>o?o:n)<0&&(n+=o),o=e>n?0:n-e>>>0,e>>>=0;for(var a=r(o);++i<o;)a[i]=t[i+e];return a}function Gr(t,e){var n;return tr(t,(function(t,r,i){return!(n=e(t,r,i))})),!!n}function Hr(t,e,n){var r=0,i=null==t?r:t.length;if("number"==typeof e&&e==e&&i<=2147483647){for(;r<i;){var o=r+i>>>1,a=t[o];null!==a&&!Qa(a)&&(n?a<=e:a<e)?r=o+1:i=o}return i}return $r(t,e,Gu,n)}function $r(t,e,n,r){var i=0,o=null==t?0:t.length;if(0===o)return 0;for(var a=(e=n(e))!=e,u=null===e,c=Qa(e),s=void 0===e;i<o;){var f=Je((i+o)/2),l=n(t[f]),h=void 0!==l,d=null===l,p=l==l,v=Qa(l);if(a)var g=r||p;else g=s?p&&(r||h):u?p&&h&&(r||!d):c?p&&h&&!d&&(r||!v):!d&&!v&&(r?l<=e:l<e);g?i=f+1:o=f}return un(o,4294967294)}function Xr(t,e){for(var n=-1,r=t.length,i=0,o=[];++n<r;){var a=t[n],u=e?e(a):a;if(!n||!Ca(u,c)){var c=u;o[i++]=0===a?0:a}}return o}function Zr(t){return"number"==typeof t?t:Qa(t)?NaN:+t}function Qr(t){if("string"==typeof t)return t;if(Ia(t))return de(t,Qr)+"";if(Qa(t))return On?On.call(t):"";var e=t+"";return"0"==e&&1/t==-1/0?"-0":e}function Kr(t,e,n){var r=-1,i=le,o=t.length,a=!0,u=[],c=u;if(n)a=!1,i=he;else if(o>=200){var s=e?null:Ui(t);if(s)return qe(s);a=!1,i=Te,c=new Ln}else c=e?[]:u;t:for(;++r<o;){var f=t[r],l=e?e(f):f;if(f=n||0!==f?f:0,a&&l==l){for(var h=c.length;h--;)if(c[h]===l)continue t;e&&c.push(l),u.push(f)}else i(c,l,n)||(c!==u&&c.push(l),u.push(f))}return u}function Jr(t,e){return null==(t=go(t,e=ui(e,t)))||delete t[So(Bo(e))]}function ti(t,e,n,r){return Wr(t,e,n(lr(t,e)),r)}function ei(t,e,n,r){for(var i=t.length,o=r?i:-1;(r?o--:++o<i)&&e(t[o],o,t););return n?Yr(t,r?0:o,r?o+1:i):Yr(t,r?o+1:0,r?i:o)}function ni(t,e){var n=t;return n instanceof Tn&&(n=n.value()),ve(e,(function(t,e){return e.func.apply(e.thisArg,pe([t],e.args))}),n)}function ri(t,e,n){var i=t.length;if(i<2)return i?Kr(t[0]):[];for(var o=-1,a=r(i);++o<i;)for(var u=t[o],c=-1;++c<i;)c!=o&&(a[o]=Jn(a[o]||u,t[c],e,n));return Kr(or(a,1),e,n)}function ii(t,e,n){for(var r=-1,i=t.length,o=e.length,a={};++r<i;){var u=r<o?e[r]:void 0;n(a,t[r],u)}return a}function oi(t){return La(t)?t:[]}function ai(t){return"function"==typeof t?t:Gu}function ui(t,e){return Ia(t)?t:co(t,e)?[t]:Ro(uu(t))}var ci=zr;function si(t,e,n){var r=t.length;return n=void 0===n?r:n,!e&&n>=r?t:Yr(t,e,n)}var fi=Xe||function(t){return Ht.clearTimeout(t)};function li(t,e){if(e)return t.slice();var n=t.length,r=Ft?Ft(n):new t.constructor(n);return t.copy(r),r}function hi(t){var e=new t.constructor(t.byteLength);return new Lt(e).set(new Lt(t)),e}function di(t,e){var n=e?hi(t.buffer):t.buffer;return new t.constructor(n,t.byteOffset,t.length)}function pi(t,e){if(t!==e){var n=void 0!==t,r=null===t,i=t==t,o=Qa(t),a=void 0!==e,u=null===e,c=e==e,s=Qa(e);if(!u&&!s&&!o&&t>e||o&&a&&c&&!u&&!s||r&&a&&c||!n&&c||!i)return 1;if(!r&&!o&&!s&&t<e||s&&n&&i&&!r&&!o||u&&n&&i||!a&&i||!c)return-1}return 0}function vi(t,e,n,i){for(var o=-1,a=t.length,u=n.length,c=-1,s=e.length,f=an(a-u,0),l=r(s+f),h=!i;++c<s;)l[c]=e[c];for(;++o<u;)(h||o<a)&&(l[n[o]]=t[o]);for(;f--;)l[c++]=t[o++];return l}function gi(t,e,n,i){for(var o=-1,a=t.length,u=-1,c=n.length,s=-1,f=e.length,l=an(a-c,0),h=r(l+f),d=!i;++o<l;)h[o]=t[o];for(var p=o;++s<f;)h[p+s]=e[s];for(;++u<c;)(d||o<a)&&(h[p+n[u]]=t[o++]);return h}function yi(t,e){var n=-1,i=t.length;for(e||(e=r(i));++n<i;)e[n]=t[n];return e}function _i(t,e,n,r){var i=!n;n||(n={});for(var o=-1,a=e.length;++o<a;){var u=e[o],c=r?r(n[u],t[u],u,n,t):void 0;void 0===c&&(c=t[u]),i?Hn(n,u,c):qn(n,u,c)}return n}function mi(t,e){return function(n,r){var i=Ia(n)?ae:Yn,o=e?e():{};return i(n,t,Zi(r,2),o)}}function bi(t){return zr((function(e,n){var r=-1,i=n.length,o=i>1?n[i-1]:void 0,a=i>2?n[2]:void 0;for(o=t.length>3&&"function"==typeof o?(i--,o):void 0,a&&uo(n[0],n[1],a)&&(o=i<3?void 0:o,i=1),e=vt(e);++r<i;){var u=n[r];u&&t(e,u,r,o)}return e}))}function wi(t,e){return function(n,r){if(null==n)return n;if(!Pa(n))return t(n,r);for(var i=n.length,o=e?i:-1,a=vt(n);(e?o--:++o<i)&&!1!==r(a[o],o,a););return n}}function xi(t){return function(e,n,r){for(var i=-1,o=vt(e),a=r(e),u=a.length;u--;){var c=a[t?u:++i];if(!1===n(o[c],c,o))break}return e}}function Ei(t){return function(e){var n=Be(e=uu(e))?Ge(e):void 0,r=n?n[0]:e.charAt(0),i=n?si(n,1).join(""):e.slice(1);return r[t]()+i}}function Ai(t){return function(e){return ve(Nu(Tu(e).replace(Tt,"")),t,"")}}function Ri(t){return function(){var e=arguments;switch(e.length){case 0:return new t;case 1:return new t(e[0]);case 2:return new t(e[0],e[1]);case 3:return new t(e[0],e[1],e[2]);case 4:return new t(e[0],e[1],e[2],e[3]);case 5:return new t(e[0],e[1],e[2],e[3],e[4]);case 6:return new t(e[0],e[1],e[2],e[3],e[4],e[5]);case 7:return new t(e[0],e[1],e[2],e[3],e[4],e[5],e[6])}var n=Cn(t.prototype),r=t.apply(n,e);return qa(r)?r:n}}function Si(t){return function(e,n,r){var i=vt(e);if(!Pa(e)){var o=Zi(n,3);e=bu(e),n=function(t){return o(i[t],t,i)}}var a=t(e,n,r);return a>-1?i[o?e[a]:a]:void 0}}function Oi(t){return Vi((function(e){var n=e.length,r=n,i=Mn.prototype.thru;for(t&&e.reverse();r--;){var a=e[r];if("function"!=typeof a)throw new _t(o);if(i&&!u&&"wrapper"==$i(a))var u=new Mn([],!0)}for(r=u?r:n;++r<n;){var c=$i(a=e[r]),s="wrapper"==c?Hi(a):void 0;u=s&&so(s[0])&&424==s[1]&&!s[4].length&&1==s[9]?u[$i(s[0])].apply(u,s[3]):1==a.length&&so(a)?u[c]():u.thru(a)}return function(){var t=arguments,r=t[0];if(u&&1==t.length&&Ia(r))return u.plant(r).value();for(var i=0,o=n?e[i].apply(this,t):r;++i<n;)o=e[i].call(this,o);return o}}))}function ki(t,e,n,i,o,a,u,c,s,f){var l=128&e,h=1&e,d=2&e,p=24&e,v=512&e,g=d?void 0:Ri(t);return function y(){for(var _=arguments.length,m=r(_),b=_;b--;)m[b]=arguments[b];if(p)var w=Xi(y),x=Pe(m,w);if(i&&(m=vi(m,i,o,p)),a&&(m=gi(m,a,u,p)),_-=x,p&&_<f){var E=Fe(m,w);return Pi(t,e,ki,y.placeholder,n,m,E,c,s,f-_)}var A=h?n:this,R=d?A[t]:t;return _=m.length,c?m=yo(m,c):v&&_>1&&m.reverse(),l&&s<_&&(m.length=s),this&&this!==Ht&&this instanceof y&&(R=g||Ri(R)),R.apply(A,m)}}function Ci(t,e){return function(n,r){return function(t,e,n,r){return cr(t,(function(t,i,o){e(r,n(t),i,o)})),r}(n,t,e(r),{})}}function ji(t,e){return function(n,r){var i;if(void 0===n&&void 0===r)return e;if(void 0!==n&&(i=n),void 0!==r){if(void 0===i)return r;"string"==typeof n||"string"==typeof r?(n=Qr(n),r=Qr(r)):(n=Zr(n),r=Zr(r)),i=t(n,r)}return i}}function Mi(t){return Vi((function(e){return e=de(e,je(Zi())),zr((function(n){var r=this;return t(e,(function(t){return oe(t,r,n)}))}))}))}function Ti(t,e){var n=(e=void 0===e?" ":Qr(e)).length;if(n<2)return n?Ur(e,t):e;var r=Ur(e,Ke(t/Ye(e)));return Be(e)?si(Ge(r),0,t).join(""):r.slice(0,t)}function Ii(t){return function(e,n,i){return i&&"number"!=typeof i&&uo(e,n,i)&&(n=i=void 0),e=nu(e),void 0===n?(n=e,e=0):n=nu(n),function(t,e,n,i){for(var o=-1,a=an(Ke((e-t)/(n||1)),0),u=r(a);a--;)u[i?a:++o]=t,t+=n;return u}(e,n,i=void 0===i?e<n?1:-1:nu(i),t)}}function Di(t){return function(e,n){return"string"==typeof e&&"string"==typeof n||(e=ou(e),n=ou(n)),t(e,n)}}function Pi(t,e,n,r,i,o,a,u,c,s){var f=8&e;e|=f?32:64,4&(e&=~(f?64:32))||(e&=-4);var l=[t,e,i,f?o:void 0,f?a:void 0,f?void 0:o,f?void 0:a,u,c,s],h=n.apply(void 0,l);return so(t)&&mo(h,l),h.placeholder=r,xo(h,t,e)}function Li(t){var e=pt[t];return function(t,n){if(t=ou(t),(n=null==n?0:un(ru(n),292))&&nn(t)){var r=(uu(t)+"e").split("e");return+((r=(uu(e(r[0]+"e"+(+r[1]+n)))+"e").split("e"))[0]+"e"+(+r[1]-n))}return e(t)}}var Ui=vn&&1/qe(new vn([,-0]))[1]==1/0?function(t){return new vn(t)}:Qu;function zi(t){return function(e){var n=no(e);return n==v?Ne(e):n==m?Ve(e):function(t,e){return de(e,(function(e){return[e,t[e]]}))}(e,t(e))}}function Bi(t,e,n,i,u,c,s,f){var l=2&e;if(!l&&"function"!=typeof t)throw new _t(o);var h=i?i.length:0;if(h||(e&=-97,i=u=void 0),s=void 0===s?s:an(ru(s),0),f=void 0===f?f:ru(f),h-=u?u.length:0,64&e){var d=i,p=u;i=u=void 0}var v=l?void 0:Hi(t),g=[t,e,n,i,u,d,p,c,s,f];if(v&&function(t,e){var n=t[1],r=e[1],i=n|r,o=i<131,u=128==r&&8==n||128==r&&256==n&&t[7].length<=e[8]||384==r&&e[7].length<=e[8]&&8==n;if(!o&&!u)return t;1&r&&(t[2]=e[2],i|=1&n?0:4);var c=e[3];if(c){var s=t[3];t[3]=s?vi(s,c,e[4]):c,t[4]=s?Fe(t[3],a):e[4]}(c=e[5])&&(s=t[5],t[5]=s?gi(s,c,e[6]):c,t[6]=s?Fe(t[5],a):e[6]);(c=e[7])&&(t[7]=c);128&r&&(t[8]=null==t[8]?e[8]:un(t[8],e[8]));null==t[9]&&(t[9]=e[9]);t[0]=e[0],t[1]=i}(g,v),t=g[0],e=g[1],n=g[2],i=g[3],u=g[4],!(f=g[9]=void 0===g[9]?l?0:t.length:an(g[9]-h,0))&&24&e&&(e&=-25),e&&1!=e)y=8==e||16==e?function(t,e,n){var i=Ri(t);return function o(){for(var a=arguments.length,u=r(a),c=a,s=Xi(o);c--;)u[c]=arguments[c];var f=a<3&&u[0]!==s&&u[a-1]!==s?[]:Fe(u,s);if((a-=f.length)<n)return Pi(t,e,ki,o.placeholder,void 0,u,f,void 0,void 0,n-a);var l=this&&this!==Ht&&this instanceof o?i:t;return oe(l,this,u)}}(t,e,f):32!=e&&33!=e||u.length?ki.apply(void 0,g):function(t,e,n,i){var o=1&e,a=Ri(t);return function e(){for(var u=-1,c=arguments.length,s=-1,f=i.length,l=r(f+c),h=this&&this!==Ht&&this instanceof e?a:t;++s<f;)l[s]=i[s];for(;c--;)l[s++]=arguments[++u];return oe(h,o?n:this,l)}}(t,e,n,i);else var y=function(t,e,n){var r=1&e,i=Ri(t);return function e(){var o=this&&this!==Ht&&this instanceof e?i:t;return o.apply(r?n:this,arguments)}}(t,e,n);return xo((v?Fr:mo)(y,g),t,e)}function Ni(t,e,n,r){return void 0===t||Ca(t,wt[n])&&!At.call(r,n)?e:t}function Wi(t,e,n,r,i,o){return qa(t)&&qa(e)&&(o.set(e,t),jr(t,e,void 0,Wi,o),o.delete(e)),t}function Fi(t){return Ha(t)?void 0:t}function qi(t,e,n,r,i,o){var a=1&n,u=t.length,c=e.length;if(u!=c&&!(a&&c>u))return!1;var s=o.get(t),f=o.get(e);if(s&&f)return s==e&&f==t;var l=-1,h=!0,d=2&n?new Ln:void 0;for(o.set(t,e),o.set(e,t);++l<u;){var p=t[l],v=e[l];if(r)var g=a?r(v,p,l,e,t,o):r(p,v,l,t,e,o);if(void 0!==g){if(g)continue;h=!1;break}if(d){if(!ye(e,(function(t,e){if(!Te(d,e)&&(p===t||i(p,t,n,r,o)))return d.push(e)}))){h=!1;break}}else if(p!==v&&!i(p,v,n,r,o)){h=!1;break}}return o.delete(t),o.delete(e),h}function Vi(t){return wo(vo(t,void 0,Do),t+"")}function Yi(t){return hr(t,bu,to)}function Gi(t){return hr(t,wu,eo)}var Hi=_n?function(t){return _n.get(t)}:Qu;function $i(t){for(var e=t.name+"",n=mn[e],r=At.call(mn,e)?n.length:0;r--;){var i=n[r],o=i.func;if(null==o||o==t)return i.name}return e}function Xi(t){return(At.call(kn,"placeholder")?kn:t).placeholder}function Zi(){var t=kn.iteratee||Hu;return t=t===Hu?Er:t,arguments.length?t(arguments[0],arguments[1]):t}function Qi(t,e){var n,r,i=t.__data__;return("string"==(r=typeof(n=e))||"number"==r||"symbol"==r||"boolean"==r?"__proto__"!==n:null===n)?i["string"==typeof e?"string":"hash"]:i.map}function Ki(t){for(var e=bu(t),n=e.length;n--;){var r=e[n],i=t[r];e[n]=[r,i,ho(i)]}return e}function Ji(t,e){var n=function(t,e){return null==t?void 0:t[e]}(t,e);return xr(n)?n:void 0}var to=tn?function(t){return null==t?[]:(t=vt(t),fe(tn(t),(function(e){return $t.call(t,e)})))}:ic,eo=tn?function(t){for(var e=[];t;)pe(e,to(t)),t=Yt(t);return e}:ic,no=dr;function ro(t,e,n){for(var r=-1,i=(e=ui(e,t)).length,o=!1;++r<i;){var a=So(e[r]);if(!(o=null!=t&&n(t,a)))break;t=t[a]}return o||++r!=i?o:!!(i=null==t?0:t.length)&&Fa(i)&&ao(a,i)&&(Ia(t)||Ta(t))}function io(t){return"function"!=typeof t.constructor||lo(t)?{}:Cn(Yt(t))}function oo(t){return Ia(t)||Ta(t)||!!(Qt&&t&&t[Qt])}function ao(t,e){var n=typeof t;return!!(e=null==e?9007199254740991:e)&&("number"==n||"symbol"!=n&&ct.test(t))&&t>-1&&t%1==0&&t<e}function uo(t,e,n){if(!qa(n))return!1;var r=typeof e;return!!("number"==r?Pa(n)&&ao(e,n.length):"string"==r&&e in n)&&Ca(n[e],t)}function co(t,e){if(Ia(t))return!1;var n=typeof t;return!("number"!=n&&"symbol"!=n&&"boolean"!=n&&null!=t&&!Qa(t))||(V.test(t)||!q.test(t)||null!=e&&t in vt(e))}function so(t){var e=$i(t),n=kn[e];if("function"!=typeof n||!(e in Tn.prototype))return!1;if(t===n)return!0;var r=Hi(n);return!!r&&t===r[0]}(hn&&no(new hn(new ArrayBuffer(1)))!=A||dn&&no(new dn)!=v||pn&&"[object Promise]"!=no(pn.resolve())||vn&&no(new vn)!=m||gn&&no(new gn)!=x)&&(no=function(t){var e=dr(t),n=e==y?t.constructor:void 0,r=n?Oo(n):"";if(r)switch(r){case bn:return A;case wn:return v;case xn:return"[object Promise]";case En:return m;case An:return x}return e});var fo=xt?Na:oc;function lo(t){var e=t&&t.constructor;return t===("function"==typeof e&&e.prototype||wt)}function ho(t){return t==t&&!qa(t)}function po(t,e){return function(n){return null!=n&&(n[t]===e&&(void 0!==e||t in vt(n)))}}function vo(t,e,n){return e=an(void 0===e?t.length-1:e,0),function(){for(var i=arguments,o=-1,a=an(i.length-e,0),u=r(a);++o<a;)u[o]=i[e+o];o=-1;for(var c=r(e+1);++o<e;)c[o]=i[o];return c[e]=n(u),oe(t,this,c)}}function go(t,e){return e.length<2?t:lr(t,Yr(e,0,-1))}function yo(t,e){for(var n=t.length,r=un(e.length,n),i=yi(t);r--;){var o=e[r];t[r]=ao(o,n)?i[o]:void 0}return t}function _o(t,e){if(("constructor"!==e||"function"!=typeof t[e])&&"__proto__"!=e)return t[e]}var mo=Eo(Fr),bo=Qe||function(t,e){return Ht.setTimeout(t,e)},wo=Eo(qr);function xo(t,e,n){var r=e+"";return wo(t,function(t,e){var n=e.length;if(!n)return t;var r=n-1;return e[r]=(n>1?"& ":"")+e[r],e=e.join(n>2?", ":" "),t.replace(Q,"{\n/* [wrapped with "+e+"] */\n")}(r,function(t,e){return ue(u,(function(n){var r="_."+n[0];e&n[1]&&!le(t,r)&&t.push(r)})),t.sort()}(function(t){var e=t.match(K);return e?e[1].split(J):[]}(r),n)))}function Eo(t){var e=0,n=0;return function(){var r=cn(),i=16-(r-n);if(n=r,i>0){if(++e>=800)return arguments[0]}else e=0;return t.apply(void 0,arguments)}}function Ao(t,e){var n=-1,r=t.length,i=r-1;for(e=void 0===e?r:e;++n<e;){var o=Lr(n,i),a=t[o];t[o]=t[n],t[n]=a}return t.length=e,t}var Ro=function(t){var e=Ea(t,(function(t){return 500===n.size&&n.clear(),t})),n=e.cache;return e}((function(t){var e=[];return 46===t.charCodeAt(0)&&e.push(""),t.replace(Y,(function(t,n,r,i){e.push(r?i.replace(et,"$1"):n||t)})),e}));function So(t){if("string"==typeof t||Qa(t))return t;var e=t+"";return"0"==e&&1/t==-1/0?"-0":e}function Oo(t){if(null!=t){try{return Et.call(t)}catch(t){}try{return t+""}catch(t){}}return""}function ko(t){if(t instanceof Tn)return t.clone();var e=new Mn(t.__wrapped__,t.__chain__);return e.__actions__=yi(t.__actions__),e.__index__=t.__index__,e.__values__=t.__values__,e}var Co=zr((function(t,e){return La(t)?Jn(t,or(e,1,La,!0)):[]})),jo=zr((function(t,e){var n=Bo(e);return La(n)&&(n=void 0),La(t)?Jn(t,or(e,1,La,!0),Zi(n,2)):[]})),Mo=zr((function(t,e){var n=Bo(e);return La(n)&&(n=void 0),La(t)?Jn(t,or(e,1,La,!0),void 0,n):[]}));function To(t,e,n){var r=null==t?0:t.length;if(!r)return-1;var i=null==n?0:ru(n);return i<0&&(i=an(r+i,0)),be(t,Zi(e,3),i)}function Io(t,e,n){var r=null==t?0:t.length;if(!r)return-1;var i=r-1;return void 0!==n&&(i=ru(n),i=n<0?an(r+i,0):un(i,r-1)),be(t,Zi(e,3),i,!0)}function Do(t){return(null==t?0:t.length)?or(t,1):[]}function Po(t){return t&&t.length?t[0]:void 0}var Lo=zr((function(t){var e=de(t,oi);return e.length&&e[0]===t[0]?yr(e):[]})),Uo=zr((function(t){var e=Bo(t),n=de(t,oi);return e===Bo(n)?e=void 0:n.pop(),n.length&&n[0]===t[0]?yr(n,Zi(e,2)):[]})),zo=zr((function(t){var e=Bo(t),n=de(t,oi);return(e="function"==typeof e?e:void 0)&&n.pop(),n.length&&n[0]===t[0]?yr(n,void 0,e):[]}));function Bo(t){var e=null==t?0:t.length;return e?t[e-1]:void 0}var No=zr(Wo);function Wo(t,e){return t&&t.length&&e&&e.length?Dr(t,e):t}var Fo=Vi((function(t,e){var n=null==t?0:t.length,r=$n(t,e);return Pr(t,de(e,(function(t){return ao(t,n)?+t:t})).sort(pi)),r}));function qo(t){return null==t?t:ln.call(t)}var Vo=zr((function(t){return Kr(or(t,1,La,!0))})),Yo=zr((function(t){var e=Bo(t);return La(e)&&(e=void 0),Kr(or(t,1,La,!0),Zi(e,2))})),Go=zr((function(t){var e=Bo(t);return e="function"==typeof e?e:void 0,Kr(or(t,1,La,!0),void 0,e)}));function Ho(t){if(!t||!t.length)return[];var e=0;return t=fe(t,(function(t){if(La(t))return e=an(t.length,e),!0})),Ce(e,(function(e){return de(t,Re(e))}))}function $o(t,e){if(!t||!t.length)return[];var n=Ho(t);return null==e?n:de(n,(function(t){return oe(e,void 0,t)}))}var Xo=zr((function(t,e){return La(t)?Jn(t,e):[]})),Zo=zr((function(t){return ri(fe(t,La))})),Qo=zr((function(t){var e=Bo(t);return La(e)&&(e=void 0),ri(fe(t,La),Zi(e,2))})),Ko=zr((function(t){var e=Bo(t);return e="function"==typeof e?e:void 0,ri(fe(t,La),void 0,e)})),Jo=zr(Ho);var ta=zr((function(t){var e=t.length,n=e>1?t[e-1]:void 0;return n="function"==typeof n?(t.pop(),n):void 0,$o(t,n)}));function ea(t){var e=kn(t);return e.__chain__=!0,e}function na(t,e){return e(t)}var ra=Vi((function(t){var e=t.length,n=e?t[0]:0,r=this.__wrapped__,i=function(e){return $n(e,t)};return!(e>1||this.__actions__.length)&&r instanceof Tn&&ao(n)?((r=r.slice(n,+n+(e?1:0))).__actions__.push({func:na,args:[i],thisArg:void 0}),new Mn(r,this.__chain__).thru((function(t){return e&&!t.length&&t.push(void 0),t}))):this.thru(i)}));var ia=mi((function(t,e,n){At.call(t,n)?++t[n]:Hn(t,n,1)}));var oa=Si(To),aa=Si(Io);function ua(t,e){return(Ia(t)?ue:tr)(t,Zi(e,3))}function ca(t,e){return(Ia(t)?ce:er)(t,Zi(e,3))}var sa=mi((function(t,e,n){At.call(t,n)?t[n].push(e):Hn(t,n,[e])}));var fa=zr((function(t,e,n){var i=-1,o="function"==typeof e,a=Pa(t)?r(t.length):[];return tr(t,(function(t){a[++i]=o?oe(e,t,n):_r(t,e,n)})),a})),la=mi((function(t,e,n){Hn(t,n,e)}));function ha(t,e){return(Ia(t)?de:Or)(t,Zi(e,3))}var da=mi((function(t,e,n){t[n?0:1].push(e)}),(function(){return[[],[]]}));var pa=zr((function(t,e){if(null==t)return[];var n=e.length;return n>1&&uo(t,e[0],e[1])?e=[]:n>2&&uo(e[0],e[1],e[2])&&(e=[e[0]]),Tr(t,or(e,1),[])})),va=Ze||function(){return Ht.Date.now()};function ga(t,e,n){return e=n?void 0:e,Bi(t,128,void 0,void 0,void 0,void 0,e=t&&null==e?t.length:e)}function ya(t,e){var n;if("function"!=typeof e)throw new _t(o);return t=ru(t),function(){return--t>0&&(n=e.apply(this,arguments)),t<=1&&(e=void 0),n}}var _a=zr((function(t,e,n){var r=1;if(n.length){var i=Fe(n,Xi(_a));r|=32}return Bi(t,r,e,n,i)})),ma=zr((function(t,e,n){var r=3;if(n.length){var i=Fe(n,Xi(ma));r|=32}return Bi(e,r,t,n,i)}));function ba(t,e,n){var r,i,a,u,c,s,f=0,l=!1,h=!1,d=!0;if("function"!=typeof t)throw new _t(o);function p(e){var n=r,o=i;return r=i=void 0,f=e,u=t.apply(o,n)}function v(t){return f=t,c=bo(y,e),l?p(t):u}function g(t){var n=t-s;return void 0===s||n>=e||n<0||h&&t-f>=a}function y(){var t=va();if(g(t))return _(t);c=bo(y,function(t){var n=e-(t-s);return h?un(n,a-(t-f)):n}(t))}function _(t){return c=void 0,d&&r?p(t):(r=i=void 0,u)}function m(){var t=va(),n=g(t);if(r=arguments,i=this,s=t,n){if(void 0===c)return v(s);if(h)return fi(c),c=bo(y,e),p(s)}return void 0===c&&(c=bo(y,e)),u}return e=ou(e)||0,qa(n)&&(l=!!n.leading,a=(h="maxWait"in n)?an(ou(n.maxWait)||0,e):a,d="trailing"in n?!!n.trailing:d),m.cancel=function(){void 0!==c&&fi(c),f=0,r=s=i=c=void 0},m.flush=function(){return void 0===c?u:_(va())},m}var wa=zr((function(t,e){return Kn(t,1,e)})),xa=zr((function(t,e,n){return Kn(t,ou(e)||0,n)}));function Ea(t,e){if("function"!=typeof t||null!=e&&"function"!=typeof e)throw new _t(o);var n=function(){var r=arguments,i=e?e.apply(this,r):r[0],o=n.cache;if(o.has(i))return o.get(i);var a=t.apply(this,r);return n.cache=o.set(i,a)||o,a};return n.cache=new(Ea.Cache||Pn),n}function Aa(t){if("function"!=typeof t)throw new _t(o);return function(){var e=arguments;switch(e.length){case 0:return!t.call(this);case 1:return!t.call(this,e[0]);case 2:return!t.call(this,e[0],e[1]);case 3:return!t.call(this,e[0],e[1],e[2])}return!t.apply(this,e)}}Ea.Cache=Pn;var Ra=ci((function(t,e){var n=(e=1==e.length&&Ia(e[0])?de(e[0],je(Zi())):de(or(e,1),je(Zi()))).length;return zr((function(r){for(var i=-1,o=un(r.length,n);++i<o;)r[i]=e[i].call(this,r[i]);return oe(t,this,r)}))})),Sa=zr((function(t,e){return Bi(t,32,void 0,e,Fe(e,Xi(Sa)))})),Oa=zr((function(t,e){return Bi(t,64,void 0,e,Fe(e,Xi(Oa)))})),ka=Vi((function(t,e){return Bi(t,256,void 0,void 0,void 0,e)}));function Ca(t,e){return t===e||t!=t&&e!=e}var ja=Di(pr),Ma=Di((function(t,e){return t>=e})),Ta=mr(function(){return arguments}())?mr:function(t){return Va(t)&&At.call(t,"callee")&&!$t.call(t,"callee")},Ia=r.isArray,Da=Jt?je(Jt):function(t){return Va(t)&&dr(t)==E};function Pa(t){return null!=t&&Fa(t.length)&&!Na(t)}function La(t){return Va(t)&&Pa(t)}var Ua=en||oc,za=te?je(te):function(t){return Va(t)&&dr(t)==l};function Ba(t){if(!Va(t))return!1;var e=dr(t);return e==h||"[object DOMException]"==e||"string"==typeof t.message&&"string"==typeof t.name&&!Ha(t)}function Na(t){if(!qa(t))return!1;var e=dr(t);return e==d||e==p||"[object AsyncFunction]"==e||"[object Proxy]"==e}function Wa(t){return"number"==typeof t&&t==ru(t)}function Fa(t){return"number"==typeof t&&t>-1&&t%1==0&&t<=9007199254740991}function qa(t){var e=typeof t;return null!=t&&("object"==e||"function"==e)}function Va(t){return null!=t&&"object"==typeof t}var Ya=ee?je(ee):function(t){return Va(t)&&no(t)==v};function Ga(t){return"number"==typeof t||Va(t)&&dr(t)==g}function Ha(t){if(!Va(t)||dr(t)!=y)return!1;var e=Yt(t);if(null===e)return!0;var n=At.call(e,"constructor")&&e.constructor;return"function"==typeof n&&n instanceof n&&Et.call(n)==kt}var $a=ne?je(ne):function(t){return Va(t)&&dr(t)==_};var Xa=re?je(re):function(t){return Va(t)&&no(t)==m};function Za(t){return"string"==typeof t||!Ia(t)&&Va(t)&&dr(t)==b}function Qa(t){return"symbol"==typeof t||Va(t)&&dr(t)==w}var Ka=ie?je(ie):function(t){return Va(t)&&Fa(t.length)&&!!Nt[dr(t)]};var Ja=Di(Sr),tu=Di((function(t,e){return t<=e}));function eu(t){if(!t)return[];if(Pa(t))return Za(t)?Ge(t):yi(t);if(Kt&&t[Kt])return function(t){for(var e,n=[];!(e=t.next()).done;)n.push(e.value);return n}(t[Kt]());var e=no(t);return(e==v?Ne:e==m?qe:Cu)(t)}function nu(t){return t?(t=ou(t))===1/0||t===-1/0?17976931348623157e292*(t<0?-1:1):t==t?t:0:0===t?t:0}function ru(t){var e=nu(t),n=e%1;return e==e?n?e-n:e:0}function iu(t){return t?Xn(ru(t),0,4294967295):0}function ou(t){if("number"==typeof t)return t;if(Qa(t))return NaN;if(qa(t)){var e="function"==typeof t.valueOf?t.valueOf():t;t=qa(e)?e+"":e}if("string"!=typeof t)return 0===t?t:+t;t=t.replace($,"");var n=ot.test(t);return n||ut.test(t)?Vt(t.slice(2),n?2:8):it.test(t)?NaN:+t}function au(t){return _i(t,wu(t))}function uu(t){return null==t?"":Qr(t)}var cu=bi((function(t,e){if(lo(e)||Pa(e))_i(e,bu(e),t);else for(var n in e)At.call(e,n)&&qn(t,n,e[n])})),su=bi((function(t,e){_i(e,wu(e),t)})),fu=bi((function(t,e,n,r){_i(e,wu(e),t,r)})),lu=bi((function(t,e,n,r){_i(e,bu(e),t,r)})),hu=Vi($n);var du=zr((function(t,e){t=vt(t);var n=-1,r=e.length,i=r>2?e[2]:void 0;for(i&&uo(e[0],e[1],i)&&(r=1);++n<r;)for(var o=e[n],a=wu(o),u=-1,c=a.length;++u<c;){var s=a[u],f=t[s];(void 0===f||Ca(f,wt[s])&&!At.call(t,s))&&(t[s]=o[s])}return t})),pu=zr((function(t){return t.push(void 0,Wi),oe(Eu,void 0,t)}));function vu(t,e,n){var r=null==t?void 0:lr(t,e);return void 0===r?n:r}function gu(t,e){return null!=t&&ro(t,e,gr)}var yu=Ci((function(t,e,n){null!=e&&"function"!=typeof e.toString&&(e=Ot.call(e)),t[e]=n}),qu(Gu)),_u=Ci((function(t,e,n){null!=e&&"function"!=typeof e.toString&&(e=Ot.call(e)),At.call(t,e)?t[e].push(n):t[e]=[n]}),Zi),mu=zr(_r);function bu(t){return Pa(t)?zn(t):Ar(t)}function wu(t){return Pa(t)?zn(t,!0):Rr(t)}var xu=bi((function(t,e,n){jr(t,e,n)})),Eu=bi((function(t,e,n,r){jr(t,e,n,r)})),Au=Vi((function(t,e){var n={};if(null==t)return n;var r=!1;e=de(e,(function(e){return e=ui(e,t),r||(r=e.length>1),e})),_i(t,Gi(t),n),r&&(n=Zn(n,7,Fi));for(var i=e.length;i--;)Jr(n,e[i]);return n}));var Ru=Vi((function(t,e){return null==t?{}:function(t,e){return Ir(t,e,(function(e,n){return gu(t,n)}))}(t,e)}));function Su(t,e){if(null==t)return{};var n=de(Gi(t),(function(t){return[t]}));return e=Zi(e),Ir(t,n,(function(t,n){return e(t,n[0])}))}var Ou=zi(bu),ku=zi(wu);function Cu(t){return null==t?[]:Me(t,bu(t))}var ju=Ai((function(t,e,n){return e=e.toLowerCase(),t+(n?Mu(e):e)}));function Mu(t){return Bu(uu(t).toLowerCase())}function Tu(t){return(t=uu(t))&&t.replace(st,Le).replace(It,"")}var Iu=Ai((function(t,e,n){return t+(n?"-":"")+e.toLowerCase()})),Du=Ai((function(t,e,n){return t+(n?" ":"")+e.toLowerCase()})),Pu=Ei("toLowerCase");var Lu=Ai((function(t,e,n){return t+(n?"_":"")+e.toLowerCase()}));var Uu=Ai((function(t,e,n){return t+(n?" ":"")+Bu(e)}));var zu=Ai((function(t,e,n){return t+(n?" ":"")+e.toUpperCase()})),Bu=Ei("toUpperCase");function Nu(t,e,n){return t=uu(t),void 0===(e=n?void 0:e)?function(t){return Ut.test(t)}(t)?function(t){return t.match(Pt)||[]}(t):function(t){return t.match(tt)||[]}(t):t.match(e)||[]}var Wu=zr((function(t,e){try{return oe(t,void 0,e)}catch(t){return Ba(t)?t:new ht(t)}})),Fu=Vi((function(t,e){return ue(e,(function(e){e=So(e),Hn(t,e,_a(t[e],t))})),t}));function qu(t){return function(){return t}}var Vu=Oi(),Yu=Oi(!0);function Gu(t){return t}function Hu(t){return Er("function"==typeof t?t:Zn(t,1))}var $u=zr((function(t,e){return function(n){return _r(n,t,e)}})),Xu=zr((function(t,e){return function(n){return _r(t,n,e)}}));function Zu(t,e,n){var r=bu(e),i=fr(e,r);null!=n||qa(e)&&(i.length||!r.length)||(n=e,e=t,t=this,i=fr(e,bu(e)));var o=!(qa(n)&&"chain"in n&&!n.chain),a=Na(t);return ue(i,(function(n){var r=e[n];t[n]=r,a&&(t.prototype[n]=function(){var e=this.__chain__;if(o||e){var n=t(this.__wrapped__),i=n.__actions__=yi(this.__actions__);return i.push({func:r,args:arguments,thisArg:t}),n.__chain__=e,n}return r.apply(t,pe([this.value()],arguments))})})),t}function Qu(){}var Ku=Mi(de),Ju=Mi(se),tc=Mi(ye);function ec(t){return co(t)?Re(So(t)):function(t){return function(e){return lr(e,t)}}(t)}var nc=Ii(),rc=Ii(!0);function ic(){return[]}function oc(){return!1}var ac=ji((function(t,e){return t+e}),0),uc=Li("ceil"),cc=ji((function(t,e){return t/e}),1),sc=Li("floor");var fc,lc=ji((function(t,e){return t*e}),1),hc=Li("round"),dc=ji((function(t,e){return t-e}),0);return kn.after=function(t,e){if("function"!=typeof e)throw new _t(o);return t=ru(t),function(){if(--t<1)return e.apply(this,arguments)}},kn.ary=ga,kn.assign=cu,kn.assignIn=su,kn.assignInWith=fu,kn.assignWith=lu,kn.at=hu,kn.before=ya,kn.bind=_a,kn.bindAll=Fu,kn.bindKey=ma,kn.castArray=function(){if(!arguments.length)return[];var t=arguments[0];return Ia(t)?t:[t]},kn.chain=ea,kn.chunk=function(t,e,n){e=(n?uo(t,e,n):void 0===e)?1:an(ru(e),0);var i=null==t?0:t.length;if(!i||e<1)return[];for(var o=0,a=0,u=r(Ke(i/e));o<i;)u[a++]=Yr(t,o,o+=e);return u},kn.compact=function(t){for(var e=-1,n=null==t?0:t.length,r=0,i=[];++e<n;){var o=t[e];o&&(i[r++]=o)}return i},kn.concat=function(){var t=arguments.length;if(!t)return[];for(var e=r(t-1),n=arguments[0],i=t;i--;)e[i-1]=arguments[i];return pe(Ia(n)?yi(n):[n],or(e,1))},kn.cond=function(t){var e=null==t?0:t.length,n=Zi();return t=e?de(t,(function(t){if("function"!=typeof t[1])throw new _t(o);return[n(t[0]),t[1]]})):[],zr((function(n){for(var r=-1;++r<e;){var i=t[r];if(oe(i[0],this,n))return oe(i[1],this,n)}}))},kn.conforms=function(t){return function(t){var e=bu(t);return function(n){return Qn(n,t,e)}}(Zn(t,1))},kn.constant=qu,kn.countBy=ia,kn.create=function(t,e){var n=Cn(t);return null==e?n:Gn(n,e)},kn.curry=function t(e,n,r){var i=Bi(e,8,void 0,void 0,void 0,void 0,void 0,n=r?void 0:n);return i.placeholder=t.placeholder,i},kn.curryRight=function t(e,n,r){var i=Bi(e,16,void 0,void 0,void 0,void 0,void 0,n=r?void 0:n);return i.placeholder=t.placeholder,i},kn.debounce=ba,kn.defaults=du,kn.defaultsDeep=pu,kn.defer=wa,kn.delay=xa,kn.difference=Co,kn.differenceBy=jo,kn.differenceWith=Mo,kn.drop=function(t,e,n){var r=null==t?0:t.length;return r?Yr(t,(e=n||void 0===e?1:ru(e))<0?0:e,r):[]},kn.dropRight=function(t,e,n){var r=null==t?0:t.length;return r?Yr(t,0,(e=r-(e=n||void 0===e?1:ru(e)))<0?0:e):[]},kn.dropRightWhile=function(t,e){return t&&t.length?ei(t,Zi(e,3),!0,!0):[]},kn.dropWhile=function(t,e){return t&&t.length?ei(t,Zi(e,3),!0):[]},kn.fill=function(t,e,n,r){var i=null==t?0:t.length;return i?(n&&"number"!=typeof n&&uo(t,e,n)&&(n=0,r=i),function(t,e,n,r){var i=t.length;for((n=ru(n))<0&&(n=-n>i?0:i+n),(r=void 0===r||r>i?i:ru(r))<0&&(r+=i),r=n>r?0:iu(r);n<r;)t[n++]=e;return t}(t,e,n,r)):[]},kn.filter=function(t,e){return(Ia(t)?fe:ir)(t,Zi(e,3))},kn.flatMap=function(t,e){return or(ha(t,e),1)},kn.flatMapDeep=function(t,e){return or(ha(t,e),1/0)},kn.flatMapDepth=function(t,e,n){return n=void 0===n?1:ru(n),or(ha(t,e),n)},kn.flatten=Do,kn.flattenDeep=function(t){return(null==t?0:t.length)?or(t,1/0):[]},kn.flattenDepth=function(t,e){return(null==t?0:t.length)?or(t,e=void 0===e?1:ru(e)):[]},kn.flip=function(t){return Bi(t,512)},kn.flow=Vu,kn.flowRight=Yu,kn.fromPairs=function(t){for(var e=-1,n=null==t?0:t.length,r={};++e<n;){var i=t[e];r[i[0]]=i[1]}return r},kn.functions=function(t){return null==t?[]:fr(t,bu(t))},kn.functionsIn=function(t){return null==t?[]:fr(t,wu(t))},kn.groupBy=sa,kn.initial=function(t){return(null==t?0:t.length)?Yr(t,0,-1):[]},kn.intersection=Lo,kn.intersectionBy=Uo,kn.intersectionWith=zo,kn.invert=yu,kn.invertBy=_u,kn.invokeMap=fa,kn.iteratee=Hu,kn.keyBy=la,kn.keys=bu,kn.keysIn=wu,kn.map=ha,kn.mapKeys=function(t,e){var n={};return e=Zi(e,3),cr(t,(function(t,r,i){Hn(n,e(t,r,i),t)})),n},kn.mapValues=function(t,e){var n={};return e=Zi(e,3),cr(t,(function(t,r,i){Hn(n,r,e(t,r,i))})),n},kn.matches=function(t){return kr(Zn(t,1))},kn.matchesProperty=function(t,e){return Cr(t,Zn(e,1))},kn.memoize=Ea,kn.merge=xu,kn.mergeWith=Eu,kn.method=$u,kn.methodOf=Xu,kn.mixin=Zu,kn.negate=Aa,kn.nthArg=function(t){return t=ru(t),zr((function(e){return Mr(e,t)}))},kn.omit=Au,kn.omitBy=function(t,e){return Su(t,Aa(Zi(e)))},kn.once=function(t){return ya(2,t)},kn.orderBy=function(t,e,n,r){return null==t?[]:(Ia(e)||(e=null==e?[]:[e]),Ia(n=r?void 0:n)||(n=null==n?[]:[n]),Tr(t,e,n))},kn.over=Ku,kn.overArgs=Ra,kn.overEvery=Ju,kn.overSome=tc,kn.partial=Sa,kn.partialRight=Oa,kn.partition=da,kn.pick=Ru,kn.pickBy=Su,kn.property=ec,kn.propertyOf=function(t){return function(e){return null==t?void 0:lr(t,e)}},kn.pull=No,kn.pullAll=Wo,kn.pullAllBy=function(t,e,n){return t&&t.length&&e&&e.length?Dr(t,e,Zi(n,2)):t},kn.pullAllWith=function(t,e,n){return t&&t.length&&e&&e.length?Dr(t,e,void 0,n):t},kn.pullAt=Fo,kn.range=nc,kn.rangeRight=rc,kn.rearg=ka,kn.reject=function(t,e){return(Ia(t)?fe:ir)(t,Aa(Zi(e,3)))},kn.remove=function(t,e){var n=[];if(!t||!t.length)return n;var r=-1,i=[],o=t.length;for(e=Zi(e,3);++r<o;){var a=t[r];e(a,r,t)&&(n.push(a),i.push(r))}return Pr(t,i),n},kn.rest=function(t,e){if("function"!=typeof t)throw new _t(o);return zr(t,e=void 0===e?e:ru(e))},kn.reverse=qo,kn.sampleSize=function(t,e,n){return e=(n?uo(t,e,n):void 0===e)?1:ru(e),(Ia(t)?Nn:Nr)(t,e)},kn.set=function(t,e,n){return null==t?t:Wr(t,e,n)},kn.setWith=function(t,e,n,r){return r="function"==typeof r?r:void 0,null==t?t:Wr(t,e,n,r)},kn.shuffle=function(t){return(Ia(t)?Wn:Vr)(t)},kn.slice=function(t,e,n){var r=null==t?0:t.length;return r?(n&&"number"!=typeof n&&uo(t,e,n)?(e=0,n=r):(e=null==e?0:ru(e),n=void 0===n?r:ru(n)),Yr(t,e,n)):[]},kn.sortBy=pa,kn.sortedUniq=function(t){return t&&t.length?Xr(t):[]},kn.sortedUniqBy=function(t,e){return t&&t.length?Xr(t,Zi(e,2)):[]},kn.split=function(t,e,n){return n&&"number"!=typeof n&&uo(t,e,n)&&(e=n=void 0),(n=void 0===n?4294967295:n>>>0)?(t=uu(t))&&("string"==typeof e||null!=e&&!$a(e))&&!(e=Qr(e))&&Be(t)?si(Ge(t),0,n):t.split(e,n):[]},kn.spread=function(t,e){if("function"!=typeof t)throw new _t(o);return e=null==e?0:an(ru(e),0),zr((function(n){var r=n[e],i=si(n,0,e);return r&&pe(i,r),oe(t,this,i)}))},kn.tail=function(t){var e=null==t?0:t.length;return e?Yr(t,1,e):[]},kn.take=function(t,e,n){return t&&t.length?Yr(t,0,(e=n||void 0===e?1:ru(e))<0?0:e):[]},kn.takeRight=function(t,e,n){var r=null==t?0:t.length;return r?Yr(t,(e=r-(e=n||void 0===e?1:ru(e)))<0?0:e,r):[]},kn.takeRightWhile=function(t,e){return t&&t.length?ei(t,Zi(e,3),!1,!0):[]},kn.takeWhile=function(t,e){return t&&t.length?ei(t,Zi(e,3)):[]},kn.tap=function(t,e){return e(t),t},kn.throttle=function(t,e,n){var r=!0,i=!0;if("function"!=typeof t)throw new _t(o);return qa(n)&&(r="leading"in n?!!n.leading:r,i="trailing"in n?!!n.trailing:i),ba(t,e,{leading:r,maxWait:e,trailing:i})},kn.thru=na,kn.toArray=eu,kn.toPairs=Ou,kn.toPairsIn=ku,kn.toPath=function(t){return Ia(t)?de(t,So):Qa(t)?[t]:yi(Ro(uu(t)))},kn.toPlainObject=au,kn.transform=function(t,e,n){var r=Ia(t),i=r||Ua(t)||Ka(t);if(e=Zi(e,4),null==n){var o=t&&t.constructor;n=i?r?new o:[]:qa(t)&&Na(o)?Cn(Yt(t)):{}}return(i?ue:cr)(t,(function(t,r,i){return e(n,t,r,i)})),n},kn.unary=function(t){return ga(t,1)},kn.union=Vo,kn.unionBy=Yo,kn.unionWith=Go,kn.uniq=function(t){return t&&t.length?Kr(t):[]},kn.uniqBy=function(t,e){return t&&t.length?Kr(t,Zi(e,2)):[]},kn.uniqWith=function(t,e){return e="function"==typeof e?e:void 0,t&&t.length?Kr(t,void 0,e):[]},kn.unset=function(t,e){return null==t||Jr(t,e)},kn.unzip=Ho,kn.unzipWith=$o,kn.update=function(t,e,n){return null==t?t:ti(t,e,ai(n))},kn.updateWith=function(t,e,n,r){return r="function"==typeof r?r:void 0,null==t?t:ti(t,e,ai(n),r)},kn.values=Cu,kn.valuesIn=function(t){return null==t?[]:Me(t,wu(t))},kn.without=Xo,kn.words=Nu,kn.wrap=function(t,e){return Sa(ai(e),t)},kn.xor=Zo,kn.xorBy=Qo,kn.xorWith=Ko,kn.zip=Jo,kn.zipObject=function(t,e){return ii(t||[],e||[],qn)},kn.zipObjectDeep=function(t,e){return ii(t||[],e||[],Wr)},kn.zipWith=ta,kn.entries=Ou,kn.entriesIn=ku,kn.extend=su,kn.extendWith=fu,Zu(kn,kn),kn.add=ac,kn.attempt=Wu,kn.camelCase=ju,kn.capitalize=Mu,kn.ceil=uc,kn.clamp=function(t,e,n){return void 0===n&&(n=e,e=void 0),void 0!==n&&(n=(n=ou(n))==n?n:0),void 0!==e&&(e=(e=ou(e))==e?e:0),Xn(ou(t),e,n)},kn.clone=function(t){return Zn(t,4)},kn.cloneDeep=function(t){return Zn(t,5)},kn.cloneDeepWith=function(t,e){return Zn(t,5,e="function"==typeof e?e:void 0)},kn.cloneWith=function(t,e){return Zn(t,4,e="function"==typeof e?e:void 0)},kn.conformsTo=function(t,e){return null==e||Qn(t,e,bu(e))},kn.deburr=Tu,kn.defaultTo=function(t,e){return null==t||t!=t?e:t},kn.divide=cc,kn.endsWith=function(t,e,n){t=uu(t),e=Qr(e);var r=t.length,i=n=void 0===n?r:Xn(ru(n),0,r);return(n-=e.length)>=0&&t.slice(n,i)==e},kn.eq=Ca,kn.escape=function(t){return(t=uu(t))&&B.test(t)?t.replace(U,Ue):t},kn.escapeRegExp=function(t){return(t=uu(t))&&H.test(t)?t.replace(G,"\\$&"):t},kn.every=function(t,e,n){var r=Ia(t)?se:nr;return n&&uo(t,e,n)&&(e=void 0),r(t,Zi(e,3))},kn.find=oa,kn.findIndex=To,kn.findKey=function(t,e){return me(t,Zi(e,3),cr)},kn.findLast=aa,kn.findLastIndex=Io,kn.findLastKey=function(t,e){return me(t,Zi(e,3),sr)},kn.floor=sc,kn.forEach=ua,kn.forEachRight=ca,kn.forIn=function(t,e){return null==t?t:ar(t,Zi(e,3),wu)},kn.forInRight=function(t,e){return null==t?t:ur(t,Zi(e,3),wu)},kn.forOwn=function(t,e){return t&&cr(t,Zi(e,3))},kn.forOwnRight=function(t,e){return t&&sr(t,Zi(e,3))},kn.get=vu,kn.gt=ja,kn.gte=Ma,kn.has=function(t,e){return null!=t&&ro(t,e,vr)},kn.hasIn=gu,kn.head=Po,kn.identity=Gu,kn.includes=function(t,e,n,r){t=Pa(t)?t:Cu(t),n=n&&!r?ru(n):0;var i=t.length;return n<0&&(n=an(i+n,0)),Za(t)?n<=i&&t.indexOf(e,n)>-1:!!i&&we(t,e,n)>-1},kn.indexOf=function(t,e,n){var r=null==t?0:t.length;if(!r)return-1;var i=null==n?0:ru(n);return i<0&&(i=an(r+i,0)),we(t,e,i)},kn.inRange=function(t,e,n){return e=nu(e),void 0===n?(n=e,e=0):n=nu(n),function(t,e,n){return t>=un(e,n)&&t<an(e,n)}(t=ou(t),e,n)},kn.invoke=mu,kn.isArguments=Ta,kn.isArray=Ia,kn.isArrayBuffer=Da,kn.isArrayLike=Pa,kn.isArrayLikeObject=La,kn.isBoolean=function(t){return!0===t||!1===t||Va(t)&&dr(t)==f},kn.isBuffer=Ua,kn.isDate=za,kn.isElement=function(t){return Va(t)&&1===t.nodeType&&!Ha(t)},kn.isEmpty=function(t){if(null==t)return!0;if(Pa(t)&&(Ia(t)||"string"==typeof t||"function"==typeof t.splice||Ua(t)||Ka(t)||Ta(t)))return!t.length;var e=no(t);if(e==v||e==m)return!t.size;if(lo(t))return!Ar(t).length;for(var n in t)if(At.call(t,n))return!1;return!0},kn.isEqual=function(t,e){return br(t,e)},kn.isEqualWith=function(t,e,n){var r=(n="function"==typeof n?n:void 0)?n(t,e):void 0;return void 0===r?br(t,e,void 0,n):!!r},kn.isError=Ba,kn.isFinite=function(t){return"number"==typeof t&&nn(t)},kn.isFunction=Na,kn.isInteger=Wa,kn.isLength=Fa,kn.isMap=Ya,kn.isMatch=function(t,e){return t===e||wr(t,e,Ki(e))},kn.isMatchWith=function(t,e,n){return n="function"==typeof n?n:void 0,wr(t,e,Ki(e),n)},kn.isNaN=function(t){return Ga(t)&&t!=+t},kn.isNative=function(t){if(fo(t))throw new ht("Unsupported core-js use. Try https://npms.io/search?q=ponyfill.");return xr(t)},kn.isNil=function(t){return null==t},kn.isNull=function(t){return null===t},kn.isNumber=Ga,kn.isObject=qa,kn.isObjectLike=Va,kn.isPlainObject=Ha,kn.isRegExp=$a,kn.isSafeInteger=function(t){return Wa(t)&&t>=-9007199254740991&&t<=9007199254740991},kn.isSet=Xa,kn.isString=Za,kn.isSymbol=Qa,kn.isTypedArray=Ka,kn.isUndefined=function(t){return void 0===t},kn.isWeakMap=function(t){return Va(t)&&no(t)==x},kn.isWeakSet=function(t){return Va(t)&&"[object WeakSet]"==dr(t)},kn.join=function(t,e){return null==t?"":rn.call(t,e)},kn.kebabCase=Iu,kn.last=Bo,kn.lastIndexOf=function(t,e,n){var r=null==t?0:t.length;if(!r)return-1;var i=r;return void 0!==n&&(i=(i=ru(n))<0?an(r+i,0):un(i,r-1)),e==e?function(t,e,n){for(var r=n+1;r--;)if(t[r]===e)return r;return r}(t,e,i):be(t,Ee,i,!0)},kn.lowerCase=Du,kn.lowerFirst=Pu,kn.lt=Ja,kn.lte=tu,kn.max=function(t){return t&&t.length?rr(t,Gu,pr):void 0},kn.maxBy=function(t,e){return t&&t.length?rr(t,Zi(e,2),pr):void 0},kn.mean=function(t){return Ae(t,Gu)},kn.meanBy=function(t,e){return Ae(t,Zi(e,2))},kn.min=function(t){return t&&t.length?rr(t,Gu,Sr):void 0},kn.minBy=function(t,e){return t&&t.length?rr(t,Zi(e,2),Sr):void 0},kn.stubArray=ic,kn.stubFalse=oc,kn.stubObject=function(){return{}},kn.stubString=function(){return""},kn.stubTrue=function(){return!0},kn.multiply=lc,kn.nth=function(t,e){return t&&t.length?Mr(t,ru(e)):void 0},kn.noConflict=function(){return Ht._===this&&(Ht._=Ct),this},kn.noop=Qu,kn.now=va,kn.pad=function(t,e,n){t=uu(t);var r=(e=ru(e))?Ye(t):0;if(!e||r>=e)return t;var i=(e-r)/2;return Ti(Je(i),n)+t+Ti(Ke(i),n)},kn.padEnd=function(t,e,n){t=uu(t);var r=(e=ru(e))?Ye(t):0;return e&&r<e?t+Ti(e-r,n):t},kn.padStart=function(t,e,n){t=uu(t);var r=(e=ru(e))?Ye(t):0;return e&&r<e?Ti(e-r,n)+t:t},kn.parseInt=function(t,e,n){return n||null==e?e=0:e&&(e=+e),sn(uu(t).replace(X,""),e||0)},kn.random=function(t,e,n){if(n&&"boolean"!=typeof n&&uo(t,e,n)&&(e=n=void 0),void 0===n&&("boolean"==typeof e?(n=e,e=void 0):"boolean"==typeof t&&(n=t,t=void 0)),void 0===t&&void 0===e?(t=0,e=1):(t=nu(t),void 0===e?(e=t,t=0):e=nu(e)),t>e){var r=t;t=e,e=r}if(n||t%1||e%1){var i=fn();return un(t+i*(e-t+qt("1e-"+((i+"").length-1))),e)}return Lr(t,e)},kn.reduce=function(t,e,n){var r=Ia(t)?ve:Oe,i=arguments.length<3;return r(t,Zi(e,4),n,i,tr)},kn.reduceRight=function(t,e,n){var r=Ia(t)?ge:Oe,i=arguments.length<3;return r(t,Zi(e,4),n,i,er)},kn.repeat=function(t,e,n){return e=(n?uo(t,e,n):void 0===e)?1:ru(e),Ur(uu(t),e)},kn.replace=function(){var t=arguments,e=uu(t[0]);return t.length<3?e:e.replace(t[1],t[2])},kn.result=function(t,e,n){var r=-1,i=(e=ui(e,t)).length;for(i||(i=1,t=void 0);++r<i;){var o=null==t?void 0:t[So(e[r])];void 0===o&&(r=i,o=n),t=Na(o)?o.call(t):o}return t},kn.round=hc,kn.runInContext=t,kn.sample=function(t){return(Ia(t)?Bn:Br)(t)},kn.size=function(t){if(null==t)return 0;if(Pa(t))return Za(t)?Ye(t):t.length;var e=no(t);return e==v||e==m?t.size:Ar(t).length},kn.snakeCase=Lu,kn.some=function(t,e,n){var r=Ia(t)?ye:Gr;return n&&uo(t,e,n)&&(e=void 0),r(t,Zi(e,3))},kn.sortedIndex=function(t,e){return Hr(t,e)},kn.sortedIndexBy=function(t,e,n){return $r(t,e,Zi(n,2))},kn.sortedIndexOf=function(t,e){var n=null==t?0:t.length;if(n){var r=Hr(t,e);if(r<n&&Ca(t[r],e))return r}return-1},kn.sortedLastIndex=function(t,e){return Hr(t,e,!0)},kn.sortedLastIndexBy=function(t,e,n){return $r(t,e,Zi(n,2),!0)},kn.sortedLastIndexOf=function(t,e){if(null==t?0:t.length){var n=Hr(t,e,!0)-1;if(Ca(t[n],e))return n}return-1},kn.startCase=Uu,kn.startsWith=function(t,e,n){return t=uu(t),n=null==n?0:Xn(ru(n),0,t.length),e=Qr(e),t.slice(n,n+e.length)==e},kn.subtract=dc,kn.sum=function(t){return t&&t.length?ke(t,Gu):0},kn.sumBy=function(t,e){return t&&t.length?ke(t,Zi(e,2)):0},kn.template=function(t,e,n){var r=kn.templateSettings;n&&uo(t,e,n)&&(e=void 0),t=uu(t),e=fu({},e,r,Ni);var i,o,a=fu({},e.imports,r.imports,Ni),u=bu(a),c=Me(a,u),s=0,f=e.interpolate||ft,l="__p += '",h=gt((e.escape||ft).source+"|"+f.source+"|"+(f===F?nt:ft).source+"|"+(e.evaluate||ft).source+"|$","g"),d="//# sourceURL="+(At.call(e,"sourceURL")?(e.sourceURL+"").replace(/\s/g," "):"lodash.templateSources["+ ++Bt+"]")+"\n";t.replace(h,(function(e,n,r,a,u,c){return r||(r=a),l+=t.slice(s,c).replace(lt,ze),n&&(i=!0,l+="' +\n__e("+n+") +\n'"),u&&(o=!0,l+="';\n"+u+";\n__p += '"),r&&(l+="' +\n((__t = ("+r+")) == null ? '' : __t) +\n'"),s=c+e.length,e})),l+="';\n";var p=At.call(e,"variable")&&e.variable;p||(l="with (obj) {\n"+l+"\n}\n"),l=(o?l.replace(I,""):l).replace(D,"$1").replace(P,"$1;"),l="function("+(p||"obj")+") {\n"+(p?"":"obj || (obj = {});\n")+"var __t, __p = ''"+(i?", __e = _.escape":"")+(o?", __j = Array.prototype.join;\nfunction print() { __p += __j.call(arguments, '') }\n":";\n")+l+"return __p\n}";var v=Wu((function(){return dt(u,d+"return "+l).apply(void 0,c)}));if(v.source=l,Ba(v))throw v;return v},kn.times=function(t,e){if((t=ru(t))<1||t>9007199254740991)return[];var n=4294967295,r=un(t,4294967295);t-=4294967295;for(var i=Ce(r,e=Zi(e));++n<t;)e(n);return i},kn.toFinite=nu,kn.toInteger=ru,kn.toLength=iu,kn.toLower=function(t){return uu(t).toLowerCase()},kn.toNumber=ou,kn.toSafeInteger=function(t){return t?Xn(ru(t),-9007199254740991,9007199254740991):0===t?t:0},kn.toString=uu,kn.toUpper=function(t){return uu(t).toUpperCase()},kn.trim=function(t,e,n){if((t=uu(t))&&(n||void 0===e))return t.replace($,"");if(!t||!(e=Qr(e)))return t;var r=Ge(t),i=Ge(e);return si(r,Ie(r,i),De(r,i)+1).join("")},kn.trimEnd=function(t,e,n){if((t=uu(t))&&(n||void 0===e))return t.replace(Z,"");if(!t||!(e=Qr(e)))return t;var r=Ge(t);return si(r,0,De(r,Ge(e))+1).join("")},kn.trimStart=function(t,e,n){if((t=uu(t))&&(n||void 0===e))return t.replace(X,"");if(!t||!(e=Qr(e)))return t;var r=Ge(t);return si(r,Ie(r,Ge(e))).join("")},kn.truncate=function(t,e){var n=30,r="...";if(qa(e)){var i="separator"in e?e.separator:i;n="length"in e?ru(e.length):n,r="omission"in e?Qr(e.omission):r}var o=(t=uu(t)).length;if(Be(t)){var a=Ge(t);o=a.length}if(n>=o)return t;var u=n-Ye(r);if(u<1)return r;var c=a?si(a,0,u).join(""):t.slice(0,u);if(void 0===i)return c+r;if(a&&(u+=c.length-u),$a(i)){if(t.slice(u).search(i)){var s,f=c;for(i.global||(i=gt(i.source,uu(rt.exec(i))+"g")),i.lastIndex=0;s=i.exec(f);)var l=s.index;c=c.slice(0,void 0===l?u:l)}}else if(t.indexOf(Qr(i),u)!=u){var h=c.lastIndexOf(i);h>-1&&(c=c.slice(0,h))}return c+r},kn.unescape=function(t){return(t=uu(t))&&z.test(t)?t.replace(L,He):t},kn.uniqueId=function(t){var e=++Rt;return uu(t)+e},kn.upperCase=zu,kn.upperFirst=Bu,kn.each=ua,kn.eachRight=ca,kn.first=Po,Zu(kn,(fc={},cr(kn,(function(t,e){At.call(kn.prototype,e)||(fc[e]=t)})),fc),{chain:!1}),kn.VERSION="4.17.19",ue(["bind","bindKey","curry","curryRight","partial","partialRight"],(function(t){kn[t].placeholder=kn})),ue(["drop","take"],(function(t,e){Tn.prototype[t]=function(n){n=void 0===n?1:an(ru(n),0);var r=this.__filtered__&&!e?new Tn(this):this.clone();return r.__filtered__?r.__takeCount__=un(n,r.__takeCount__):r.__views__.push({size:un(n,4294967295),type:t+(r.__dir__<0?"Right":"")}),r},Tn.prototype[t+"Right"]=function(e){return this.reverse()[t](e).reverse()}})),ue(["filter","map","takeWhile"],(function(t,e){var n=e+1,r=1==n||3==n;Tn.prototype[t]=function(t){var e=this.clone();return e.__iteratees__.push({iteratee:Zi(t,3),type:n}),e.__filtered__=e.__filtered__||r,e}})),ue(["head","last"],(function(t,e){var n="take"+(e?"Right":"");Tn.prototype[t]=function(){return this[n](1).value()[0]}})),ue(["initial","tail"],(function(t,e){var n="drop"+(e?"":"Right");Tn.prototype[t]=function(){return this.__filtered__?new Tn(this):this[n](1)}})),Tn.prototype.compact=function(){return this.filter(Gu)},Tn.prototype.find=function(t){return this.filter(t).head()},Tn.prototype.findLast=function(t){return this.reverse().find(t)},Tn.prototype.invokeMap=zr((function(t,e){return"function"==typeof t?new Tn(this):this.map((function(n){return _r(n,t,e)}))})),Tn.prototype.reject=function(t){return this.filter(Aa(Zi(t)))},Tn.prototype.slice=function(t,e){t=ru(t);var n=this;return n.__filtered__&&(t>0||e<0)?new Tn(n):(t<0?n=n.takeRight(-t):t&&(n=n.drop(t)),void 0!==e&&(n=(e=ru(e))<0?n.dropRight(-e):n.take(e-t)),n)},Tn.prototype.takeRightWhile=function(t){return this.reverse().takeWhile(t).reverse()},Tn.prototype.toArray=function(){return this.take(4294967295)},cr(Tn.prototype,(function(t,e){var n=/^(?:filter|find|map|reject)|While$/.test(e),r=/^(?:head|last)$/.test(e),i=kn[r?"take"+("last"==e?"Right":""):e],o=r||/^find/.test(e);i&&(kn.prototype[e]=function(){var e=this.__wrapped__,a=r?[1]:arguments,u=e instanceof Tn,c=a[0],s=u||Ia(e),f=function(t){var e=i.apply(kn,pe([t],a));return r&&l?e[0]:e};s&&n&&"function"==typeof c&&1!=c.length&&(u=s=!1);var l=this.__chain__,h=!!this.__actions__.length,d=o&&!l,p=u&&!h;if(!o&&s){e=p?e:new Tn(this);var v=t.apply(e,a);return v.__actions__.push({func:na,args:[f],thisArg:void 0}),new Mn(v,l)}return d&&p?t.apply(this,a):(v=this.thru(f),d?r?v.value()[0]:v.value():v)})})),ue(["pop","push","shift","sort","splice","unshift"],(function(t){var e=mt[t],n=/^(?:push|sort|unshift)$/.test(t)?"tap":"thru",r=/^(?:pop|shift)$/.test(t);kn.prototype[t]=function(){var t=arguments;if(r&&!this.__chain__){var i=this.value();return e.apply(Ia(i)?i:[],t)}return this[n]((function(n){return e.apply(Ia(n)?n:[],t)}))}})),cr(Tn.prototype,(function(t,e){var n=kn[e];if(n){var r=n.name+"";At.call(mn,r)||(mn[r]=[]),mn[r].push({name:e,func:n})}})),mn[ki(void 0,2).name]=[{name:"wrapper",func:void 0}],Tn.prototype.clone=function(){var t=new Tn(this.__wrapped__);return t.__actions__=yi(this.__actions__),t.__dir__=this.__dir__,t.__filtered__=this.__filtered__,t.__iteratees__=yi(this.__iteratees__),t.__takeCount__=this.__takeCount__,t.__views__=yi(this.__views__),t},Tn.prototype.reverse=function(){if(this.__filtered__){var t=new Tn(this);t.__dir__=-1,t.__filtered__=!0}else(t=this.clone()).__dir__*=-1;return t},Tn.prototype.value=function(){var t=this.__wrapped__.value(),e=this.__dir__,n=Ia(t),r=e<0,i=n?t.length:0,o=function(t,e,n){var r=-1,i=n.length;for(;++r<i;){var o=n[r],a=o.size;switch(o.type){case"drop":t+=a;break;case"dropRight":e-=a;break;case"take":e=un(e,t+a);break;case"takeRight":t=an(t,e-a)}}return{start:t,end:e}}(0,i,this.__views__),a=o.start,u=o.end,c=u-a,s=r?u:a-1,f=this.__iteratees__,l=f.length,h=0,d=un(c,this.__takeCount__);if(!n||!r&&i==c&&d==c)return ni(t,this.__actions__);var p=[];t:for(;c--&&h<d;){for(var v=-1,g=t[s+=e];++v<l;){var y=f[v],_=y.iteratee,m=y.type,b=_(g);if(2==m)g=b;else if(!b){if(1==m)continue t;break t}}p[h++]=g}return p},kn.prototype.at=ra,kn.prototype.chain=function(){return ea(this)},kn.prototype.commit=function(){return new Mn(this.value(),this.__chain__)},kn.prototype.next=function(){void 0===this.__values__&&(this.__values__=eu(this.value()));var t=this.__index__>=this.__values__.length;return{done:t,value:t?void 0:this.__values__[this.__index__++]}},kn.prototype.plant=function(t){for(var e,n=this;n instanceof jn;){var r=ko(n);r.__index__=0,r.__values__=void 0,e?i.__wrapped__=r:e=r;var i=r;n=n.__wrapped__}return i.__wrapped__=t,e},kn.prototype.reverse=function(){var t=this.__wrapped__;if(t instanceof Tn){var e=t;return this.__actions__.length&&(e=new Tn(this)),(e=e.reverse()).__actions__.push({func:na,args:[qo],thisArg:void 0}),new Mn(e,this.__chain__)}return this.thru(qo)},kn.prototype.toJSON=kn.prototype.valueOf=kn.prototype.value=function(){return ni(this.__wrapped__,this.__actions__)},kn.prototype.first=kn.prototype.head,Kt&&(kn.prototype[Kt]=function(){return this}),kn}();Ht._=$e,void 0===(i=function(){return $e}.call(e,n,e,r))||(r.exports=i)}).call(this)}).call(this,n(12),n(141)(t))},function(t,e){var n;n=function(){return this}();try{n=n||new Function("return this")()}catch(t){"object"==typeof window&&(n=window)}t.exports=n},function(t,e){var n,r,i=t.exports={};function o(){throw new Error("setTimeout has not been defined")}function a(){throw new Error("clearTimeout has not been defined")}function u(t){if(n===setTimeout)return setTimeout(t,0);if((n===o||!n)&&setTimeout)return n=setTimeout,setTimeout(t,0);try{return n(t,0)}catch(e){try{return n.call(null,t,0)}catch(e){return n.call(this,t,0)}}}!function(){try{n="function"==typeof setTimeout?setTimeout:o}catch(t){n=o}try{r="function"==typeof clearTimeout?clearTimeout:a}catch(t){r=a}}();var c,s=[],f=!1,l=-1;function h(){f&&c&&(f=!1,c.length?s=c.concat(s):l=-1,s.length&&d())}function d(){if(!f){var t=u(h);f=!0;for(var e=s.length;e;){for(c=s,s=[];++l<e;)c&&c[l].run();l=-1,e=s.length}c=null,f=!1,function(t){if(r===clearTimeout)return clearTimeout(t);if((r===a||!r)&&clearTimeout)return r=clearTimeout,clearTimeout(t);try{r(t)}catch(e){try{return r.call(null,t)}catch(e){return r.call(this,t)}}}(t)}}function p(t,e){this.fun=t,this.array=e}function v(){}i.nextTick=function(t){var e=new Array(arguments.length-1);if(arguments.length>1)for(var n=1;n<arguments.length;n++)e[n-1]=arguments[n];s.push(new p(t,e)),1!==s.length||f||u(d)},p.prototype.run=function(){this.fun.apply(null,this.array)},i.title="browser",i.browser=!0,i.env={},i.argv=[],i.version="",i.versions={},i.on=v,i.addListener=v,i.once=v,i.off=v,i.removeListener=v,i.removeAllListeners=v,i.emit=v,i.prependListener=v,i.prependOnceListener=v,i.listeners=function(t){return[]},i.binding=function(t){throw new Error("process.binding is not supported")},i.cwd=function(){return"/"},i.chdir=function(t){throw new Error("process.chdir is not supported")},i.umask=function(){return 0}},function(t,e,n){"use strict";var r=n(24),i=Object.keys||function(t){var e=[];for(var n in t)e.push(n);return e};t.exports=l;var o=Object.create(n(22));o.inherits=n(18);var a=n(57),u=n(33);o.inherits(l,a);for(var c=i(u.prototype),s=0;s<c.length;s++){var f=c[s];l.prototype[f]||(l.prototype[f]=u.prototype[f])}function l(t){if(!(this instanceof l))return new l(t);a.call(this,t),u.call(this,t),t&&!1===t.readable&&(this.readable=!1),t&&!1===t.writable&&(this.writable=!1),this.allowHalfOpen=!0,t&&!1===t.allowHalfOpen&&(this.allowHalfOpen=!1),this.once("end",h)}function h(){this.allowHalfOpen||this._writableState.ended||r.nextTick(d,this)}function d(t){t.end()}Object.defineProperty(l.prototype,"writableHighWaterMark",{enumerable:!1,get:function(){return this._writableState.highWaterMark}}),Object.defineProperty(l.prototype,"destroyed",{get:function(){return void 0!==this._readableState&&void 0!==this._writableState&&(this._readableState.destroyed&&this._writableState.destroyed)},set:function(t){void 0!==this._readableState&&void 0!==this._writableState&&(this._readableState.destroyed=t,this._writableState.destroyed=t)}}),l.prototype._destroy=function(t,e){this.push(null),this.end(),r.nextTick(e,t)}},function(t,e,n){"use strict";e.a={drawRect:function(t,e,n,r){n.strokeStyle=r.color,n.fillStyle=r.color,n.lineWidth=r.lineWidth||1,n.beginPath(),n.strokeRect(t.x,t.y,e.x,e.y)},drawPath:function(t,e,n,r){n.strokeStyle=r.color,n.fillStyle=r.color,n.lineWidth=r.lineWidth,n.beginPath(),n.moveTo(t[0][e.x],t[0][e.y]);for(var i=1;i<t.length;i++)n.lineTo(t[i][e.x],t[i][e.y]);n.closePath(),n.stroke()},drawImage:function(t,e,n){var r=n.getImageData(0,0,e.x,e.y),i=r.data,o=i.length,a=t.length;if(o/a!=4)return!1;for(;a--;){var u=t[a];i[--o]=255,i[--o]=u,i[--o]=u,i[--o]=u}return n.putImageData(r,0,0),!0}}},function(t,e,n){var r=n(145);function i(e,n,o){return"undefined"!=typeof Reflect&&Reflect.get?t.exports=i=Reflect.get:t.exports=i=function(t,e,n){var i=r(t,e);if(i){var o=Object.getOwnPropertyDescriptor(i,e);return o.get?o.get.call(n):o.value}},i(e,n,o||e)}t.exports=i},function(t,e,n){t.exports=n(146)},function(t,e){"function"==typeof Object.create?t.exports=function(t,e){e&&(t.super_=e,t.prototype=Object.create(e.prototype,{constructor:{value:t,enumerable:!1,writable:!0,configurable:!0}}))}:t.exports=function(t,e){if(e){t.super_=e;var n=function(){};n.prototype=e.prototype,t.prototype=new n,t.prototype.constructor=t}}},function(t,e){function n(e){return"function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?t.exports=n=function(t){return typeof t}:t.exports=n=function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},n(e)}t.exports=n},function(t,e,n){"use strict";e.a={searchDirections:[[0,1],[1,1],[1,0],[1,-1],[0,-1],[-1,-1],[-1,0],[-1,1]],create:function(t,e){var n,r=t.data,i=e.data,o=this.searchDirections,a=t.size.x;function u(t,e,u,c){var s,f,l;for(s=0;s<7;s++){if(f=t.cy+o[t.dir][0],l=t.cx+o[t.dir][1],r[n=f*a+l]===e&&(0===i[n]||i[n]===u))return i[n]=u,t.cy=f,t.cx=l,!0;0===i[n]&&(i[n]=c),t.dir=(t.dir+1)%8}return!1}function c(t,e,n){return{dir:n,x:t,y:e,next:null,prev:null}}return{trace:function(t,e,n,r){return u(t,e,n,r)},contourTracing:function(t,e,n,r,i){return function(t,e,n,r,i){var o,a,s,f=null,l={cx:e,cy:t,dir:0};if(u(l,r,n,i)){o=f=c(e,t,l.dir),s=l.dir,(a=c(l.cx,l.cy,0)).prev=o,o.next=a,a.next=null,o=a;do{l.dir=(l.dir+6)%8,u(l,r,n,i),s!==l.dir?(o.dir=l.dir,(a=c(l.cx,l.cy,0)).prev=o,o.next=a,a.next=null,o=a):(o.dir=s,o.x=l.cx,o.y=l.cy),s=l.dir}while(l.cx!==e||l.cy!==t);f.prev=o.prev,o.prev.next=f}return f}(t,e,n,r,i)}}}}},function(t,e,n){"use strict";(function(t){
/*!
 * The buffer module from node.js, for the browser.
 *
 * @author   Feross Aboukhadijeh <http://feross.org>
 * @license  MIT
 */
var r=n(159),i=n(160),o=n(161);function a(){return c.TYPED_ARRAY_SUPPORT?2147483647:1073741823}function u(t,e){if(a()<e)throw new RangeError("Invalid typed array length");return c.TYPED_ARRAY_SUPPORT?(t=new Uint8Array(e)).__proto__=c.prototype:(null===t&&(t=new c(e)),t.length=e),t}function c(t,e,n){if(!(c.TYPED_ARRAY_SUPPORT||this instanceof c))return new c(t,e,n);if("number"==typeof t){if("string"==typeof e)throw new Error("If encoding is specified then the first argument must be a string");return l(this,t)}return s(this,t,e,n)}function s(t,e,n,r){if("number"==typeof e)throw new TypeError('"value" argument must not be a number');return"undefined"!=typeof ArrayBuffer&&e instanceof ArrayBuffer?function(t,e,n,r){if(e.byteLength,n<0||e.byteLength<n)throw new RangeError("'offset' is out of bounds");if(e.byteLength<n+(r||0))throw new RangeError("'length' is out of bounds");e=void 0===n&&void 0===r?new Uint8Array(e):void 0===r?new Uint8Array(e,n):new Uint8Array(e,n,r);c.TYPED_ARRAY_SUPPORT?(t=e).__proto__=c.prototype:t=h(t,e);return t}(t,e,n,r):"string"==typeof e?function(t,e,n){"string"==typeof n&&""!==n||(n="utf8");if(!c.isEncoding(n))throw new TypeError('"encoding" must be a valid string encoding');var r=0|p(e,n),i=(t=u(t,r)).write(e,n);i!==r&&(t=t.slice(0,i));return t}(t,e,n):function(t,e){if(c.isBuffer(e)){var n=0|d(e.length);return 0===(t=u(t,n)).length||e.copy(t,0,0,n),t}if(e){if("undefined"!=typeof ArrayBuffer&&e.buffer instanceof ArrayBuffer||"length"in e)return"number"!=typeof e.length||(r=e.length)!=r?u(t,0):h(t,e);if("Buffer"===e.type&&o(e.data))return h(t,e.data)}var r;throw new TypeError("First argument must be a string, Buffer, ArrayBuffer, Array, or array-like object.")}(t,e)}function f(t){if("number"!=typeof t)throw new TypeError('"size" argument must be a number');if(t<0)throw new RangeError('"size" argument must not be negative')}function l(t,e){if(f(e),t=u(t,e<0?0:0|d(e)),!c.TYPED_ARRAY_SUPPORT)for(var n=0;n<e;++n)t[n]=0;return t}function h(t,e){var n=e.length<0?0:0|d(e.length);t=u(t,n);for(var r=0;r<n;r+=1)t[r]=255&e[r];return t}function d(t){if(t>=a())throw new RangeError("Attempt to allocate Buffer larger than maximum size: 0x"+a().toString(16)+" bytes");return 0|t}function p(t,e){if(c.isBuffer(t))return t.length;if("undefined"!=typeof ArrayBuffer&&"function"==typeof ArrayBuffer.isView&&(ArrayBuffer.isView(t)||t instanceof ArrayBuffer))return t.byteLength;"string"!=typeof t&&(t=""+t);var n=t.length;if(0===n)return 0;for(var r=!1;;)switch(e){case"ascii":case"latin1":case"binary":return n;case"utf8":case"utf-8":case void 0:return N(t).length;case"ucs2":case"ucs-2":case"utf16le":case"utf-16le":return 2*n;case"hex":return n>>>1;case"base64":return W(t).length;default:if(r)return N(t).length;e=(""+e).toLowerCase(),r=!0}}function v(t,e,n){var r=!1;if((void 0===e||e<0)&&(e=0),e>this.length)return"";if((void 0===n||n>this.length)&&(n=this.length),n<=0)return"";if((n>>>=0)<=(e>>>=0))return"";for(t||(t="utf8");;)switch(t){case"hex":return C(this,e,n);case"utf8":case"utf-8":return S(this,e,n);case"ascii":return O(this,e,n);case"latin1":case"binary":return k(this,e,n);case"base64":return R(this,e,n);case"ucs2":case"ucs-2":case"utf16le":case"utf-16le":return j(this,e,n);default:if(r)throw new TypeError("Unknown encoding: "+t);t=(t+"").toLowerCase(),r=!0}}function g(t,e,n){var r=t[e];t[e]=t[n],t[n]=r}function y(t,e,n,r,i){if(0===t.length)return-1;if("string"==typeof n?(r=n,n=0):n>2147483647?n=2147483647:n<-2147483648&&(n=-2147483648),n=+n,isNaN(n)&&(n=i?0:t.length-1),n<0&&(n=t.length+n),n>=t.length){if(i)return-1;n=t.length-1}else if(n<0){if(!i)return-1;n=0}if("string"==typeof e&&(e=c.from(e,r)),c.isBuffer(e))return 0===e.length?-1:_(t,e,n,r,i);if("number"==typeof e)return e&=255,c.TYPED_ARRAY_SUPPORT&&"function"==typeof Uint8Array.prototype.indexOf?i?Uint8Array.prototype.indexOf.call(t,e,n):Uint8Array.prototype.lastIndexOf.call(t,e,n):_(t,[e],n,r,i);throw new TypeError("val must be string, number or Buffer")}function _(t,e,n,r,i){var o,a=1,u=t.length,c=e.length;if(void 0!==r&&("ucs2"===(r=String(r).toLowerCase())||"ucs-2"===r||"utf16le"===r||"utf-16le"===r)){if(t.length<2||e.length<2)return-1;a=2,u/=2,c/=2,n/=2}function s(t,e){return 1===a?t[e]:t.readUInt16BE(e*a)}if(i){var f=-1;for(o=n;o<u;o++)if(s(t,o)===s(e,-1===f?0:o-f)){if(-1===f&&(f=o),o-f+1===c)return f*a}else-1!==f&&(o-=o-f),f=-1}else for(n+c>u&&(n=u-c),o=n;o>=0;o--){for(var l=!0,h=0;h<c;h++)if(s(t,o+h)!==s(e,h)){l=!1;break}if(l)return o}return-1}function m(t,e,n,r){n=Number(n)||0;var i=t.length-n;r?(r=Number(r))>i&&(r=i):r=i;var o=e.length;if(o%2!=0)throw new TypeError("Invalid hex string");r>o/2&&(r=o/2);for(var a=0;a<r;++a){var u=parseInt(e.substr(2*a,2),16);if(isNaN(u))return a;t[n+a]=u}return a}function b(t,e,n,r){return F(N(e,t.length-n),t,n,r)}function w(t,e,n,r){return F(function(t){for(var e=[],n=0;n<t.length;++n)e.push(255&t.charCodeAt(n));return e}(e),t,n,r)}function x(t,e,n,r){return w(t,e,n,r)}function E(t,e,n,r){return F(W(e),t,n,r)}function A(t,e,n,r){return F(function(t,e){for(var n,r,i,o=[],a=0;a<t.length&&!((e-=2)<0);++a)n=t.charCodeAt(a),r=n>>8,i=n%256,o.push(i),o.push(r);return o}(e,t.length-n),t,n,r)}function R(t,e,n){return 0===e&&n===t.length?r.fromByteArray(t):r.fromByteArray(t.slice(e,n))}function S(t,e,n){n=Math.min(t.length,n);for(var r=[],i=e;i<n;){var o,a,u,c,s=t[i],f=null,l=s>239?4:s>223?3:s>191?2:1;if(i+l<=n)switch(l){case 1:s<128&&(f=s);break;case 2:128==(192&(o=t[i+1]))&&(c=(31&s)<<6|63&o)>127&&(f=c);break;case 3:o=t[i+1],a=t[i+2],128==(192&o)&&128==(192&a)&&(c=(15&s)<<12|(63&o)<<6|63&a)>2047&&(c<55296||c>57343)&&(f=c);break;case 4:o=t[i+1],a=t[i+2],u=t[i+3],128==(192&o)&&128==(192&a)&&128==(192&u)&&(c=(15&s)<<18|(63&o)<<12|(63&a)<<6|63&u)>65535&&c<1114112&&(f=c)}null===f?(f=65533,l=1):f>65535&&(f-=65536,r.push(f>>>10&1023|55296),f=56320|1023&f),r.push(f),i+=l}return function(t){var e=t.length;if(e<=4096)return String.fromCharCode.apply(String,t);var n="",r=0;for(;r<e;)n+=String.fromCharCode.apply(String,t.slice(r,r+=4096));return n}(r)}e.Buffer=c,e.SlowBuffer=function(t){+t!=t&&(t=0);return c.alloc(+t)},e.INSPECT_MAX_BYTES=50,c.TYPED_ARRAY_SUPPORT=void 0!==t.TYPED_ARRAY_SUPPORT?t.TYPED_ARRAY_SUPPORT:function(){try{var t=new Uint8Array(1);return t.__proto__={__proto__:Uint8Array.prototype,foo:function(){return 42}},42===t.foo()&&"function"==typeof t.subarray&&0===t.subarray(1,1).byteLength}catch(t){return!1}}(),e.kMaxLength=a(),c.poolSize=8192,c._augment=function(t){return t.__proto__=c.prototype,t},c.from=function(t,e,n){return s(null,t,e,n)},c.TYPED_ARRAY_SUPPORT&&(c.prototype.__proto__=Uint8Array.prototype,c.__proto__=Uint8Array,"undefined"!=typeof Symbol&&Symbol.species&&c[Symbol.species]===c&&Object.defineProperty(c,Symbol.species,{value:null,configurable:!0})),c.alloc=function(t,e,n){return function(t,e,n,r){return f(e),e<=0?u(t,e):void 0!==n?"string"==typeof r?u(t,e).fill(n,r):u(t,e).fill(n):u(t,e)}(null,t,e,n)},c.allocUnsafe=function(t){return l(null,t)},c.allocUnsafeSlow=function(t){return l(null,t)},c.isBuffer=function(t){return!(null==t||!t._isBuffer)},c.compare=function(t,e){if(!c.isBuffer(t)||!c.isBuffer(e))throw new TypeError("Arguments must be Buffers");if(t===e)return 0;for(var n=t.length,r=e.length,i=0,o=Math.min(n,r);i<o;++i)if(t[i]!==e[i]){n=t[i],r=e[i];break}return n<r?-1:r<n?1:0},c.isEncoding=function(t){switch(String(t).toLowerCase()){case"hex":case"utf8":case"utf-8":case"ascii":case"latin1":case"binary":case"base64":case"ucs2":case"ucs-2":case"utf16le":case"utf-16le":return!0;default:return!1}},c.concat=function(t,e){if(!o(t))throw new TypeError('"list" argument must be an Array of Buffers');if(0===t.length)return c.alloc(0);var n;if(void 0===e)for(e=0,n=0;n<t.length;++n)e+=t[n].length;var r=c.allocUnsafe(e),i=0;for(n=0;n<t.length;++n){var a=t[n];if(!c.isBuffer(a))throw new TypeError('"list" argument must be an Array of Buffers');a.copy(r,i),i+=a.length}return r},c.byteLength=p,c.prototype._isBuffer=!0,c.prototype.swap16=function(){var t=this.length;if(t%2!=0)throw new RangeError("Buffer size must be a multiple of 16-bits");for(var e=0;e<t;e+=2)g(this,e,e+1);return this},c.prototype.swap32=function(){var t=this.length;if(t%4!=0)throw new RangeError("Buffer size must be a multiple of 32-bits");for(var e=0;e<t;e+=4)g(this,e,e+3),g(this,e+1,e+2);return this},c.prototype.swap64=function(){var t=this.length;if(t%8!=0)throw new RangeError("Buffer size must be a multiple of 64-bits");for(var e=0;e<t;e+=8)g(this,e,e+7),g(this,e+1,e+6),g(this,e+2,e+5),g(this,e+3,e+4);return this},c.prototype.toString=function(){var t=0|this.length;return 0===t?"":0===arguments.length?S(this,0,t):v.apply(this,arguments)},c.prototype.equals=function(t){if(!c.isBuffer(t))throw new TypeError("Argument must be a Buffer");return this===t||0===c.compare(this,t)},c.prototype.inspect=function(){var t="",n=e.INSPECT_MAX_BYTES;return this.length>0&&(t=this.toString("hex",0,n).match(/.{2}/g).join(" "),this.length>n&&(t+=" ... ")),"<Buffer "+t+">"},c.prototype.compare=function(t,e,n,r,i){if(!c.isBuffer(t))throw new TypeError("Argument must be a Buffer");if(void 0===e&&(e=0),void 0===n&&(n=t?t.length:0),void 0===r&&(r=0),void 0===i&&(i=this.length),e<0||n>t.length||r<0||i>this.length)throw new RangeError("out of range index");if(r>=i&&e>=n)return 0;if(r>=i)return-1;if(e>=n)return 1;if(this===t)return 0;for(var o=(i>>>=0)-(r>>>=0),a=(n>>>=0)-(e>>>=0),u=Math.min(o,a),s=this.slice(r,i),f=t.slice(e,n),l=0;l<u;++l)if(s[l]!==f[l]){o=s[l],a=f[l];break}return o<a?-1:a<o?1:0},c.prototype.includes=function(t,e,n){return-1!==this.indexOf(t,e,n)},c.prototype.indexOf=function(t,e,n){return y(this,t,e,n,!0)},c.prototype.lastIndexOf=function(t,e,n){return y(this,t,e,n,!1)},c.prototype.write=function(t,e,n,r){if(void 0===e)r="utf8",n=this.length,e=0;else if(void 0===n&&"string"==typeof e)r=e,n=this.length,e=0;else{if(!isFinite(e))throw new Error("Buffer.write(string, encoding, offset[, length]) is no longer supported");e|=0,isFinite(n)?(n|=0,void 0===r&&(r="utf8")):(r=n,n=void 0)}var i=this.length-e;if((void 0===n||n>i)&&(n=i),t.length>0&&(n<0||e<0)||e>this.length)throw new RangeError("Attempt to write outside buffer bounds");r||(r="utf8");for(var o=!1;;)switch(r){case"hex":return m(this,t,e,n);case"utf8":case"utf-8":return b(this,t,e,n);case"ascii":return w(this,t,e,n);case"latin1":case"binary":return x(this,t,e,n);case"base64":return E(this,t,e,n);case"ucs2":case"ucs-2":case"utf16le":case"utf-16le":return A(this,t,e,n);default:if(o)throw new TypeError("Unknown encoding: "+r);r=(""+r).toLowerCase(),o=!0}},c.prototype.toJSON=function(){return{type:"Buffer",data:Array.prototype.slice.call(this._arr||this,0)}};function O(t,e,n){var r="";n=Math.min(t.length,n);for(var i=e;i<n;++i)r+=String.fromCharCode(127&t[i]);return r}function k(t,e,n){var r="";n=Math.min(t.length,n);for(var i=e;i<n;++i)r+=String.fromCharCode(t[i]);return r}function C(t,e,n){var r=t.length;(!e||e<0)&&(e=0),(!n||n<0||n>r)&&(n=r);for(var i="",o=e;o<n;++o)i+=B(t[o]);return i}function j(t,e,n){for(var r=t.slice(e,n),i="",o=0;o<r.length;o+=2)i+=String.fromCharCode(r[o]+256*r[o+1]);return i}function M(t,e,n){if(t%1!=0||t<0)throw new RangeError("offset is not uint");if(t+e>n)throw new RangeError("Trying to access beyond buffer length")}function T(t,e,n,r,i,o){if(!c.isBuffer(t))throw new TypeError('"buffer" argument must be a Buffer instance');if(e>i||e<o)throw new RangeError('"value" argument is out of bounds');if(n+r>t.length)throw new RangeError("Index out of range")}function I(t,e,n,r){e<0&&(e=65535+e+1);for(var i=0,o=Math.min(t.length-n,2);i<o;++i)t[n+i]=(e&255<<8*(r?i:1-i))>>>8*(r?i:1-i)}function D(t,e,n,r){e<0&&(e=4294967295+e+1);for(var i=0,o=Math.min(t.length-n,4);i<o;++i)t[n+i]=e>>>8*(r?i:3-i)&255}function P(t,e,n,r,i,o){if(n+r>t.length)throw new RangeError("Index out of range");if(n<0)throw new RangeError("Index out of range")}function L(t,e,n,r,o){return o||P(t,0,n,4),i.write(t,e,n,r,23,4),n+4}function U(t,e,n,r,o){return o||P(t,0,n,8),i.write(t,e,n,r,52,8),n+8}c.prototype.slice=function(t,e){var n,r=this.length;if((t=~~t)<0?(t+=r)<0&&(t=0):t>r&&(t=r),(e=void 0===e?r:~~e)<0?(e+=r)<0&&(e=0):e>r&&(e=r),e<t&&(e=t),c.TYPED_ARRAY_SUPPORT)(n=this.subarray(t,e)).__proto__=c.prototype;else{var i=e-t;n=new c(i,void 0);for(var o=0;o<i;++o)n[o]=this[o+t]}return n},c.prototype.readUIntLE=function(t,e,n){t|=0,e|=0,n||M(t,e,this.length);for(var r=this[t],i=1,o=0;++o<e&&(i*=256);)r+=this[t+o]*i;return r},c.prototype.readUIntBE=function(t,e,n){t|=0,e|=0,n||M(t,e,this.length);for(var r=this[t+--e],i=1;e>0&&(i*=256);)r+=this[t+--e]*i;return r},c.prototype.readUInt8=function(t,e){return e||M(t,1,this.length),this[t]},c.prototype.readUInt16LE=function(t,e){return e||M(t,2,this.length),this[t]|this[t+1]<<8},c.prototype.readUInt16BE=function(t,e){return e||M(t,2,this.length),this[t]<<8|this[t+1]},c.prototype.readUInt32LE=function(t,e){return e||M(t,4,this.length),(this[t]|this[t+1]<<8|this[t+2]<<16)+16777216*this[t+3]},c.prototype.readUInt32BE=function(t,e){return e||M(t,4,this.length),16777216*this[t]+(this[t+1]<<16|this[t+2]<<8|this[t+3])},c.prototype.readIntLE=function(t,e,n){t|=0,e|=0,n||M(t,e,this.length);for(var r=this[t],i=1,o=0;++o<e&&(i*=256);)r+=this[t+o]*i;return r>=(i*=128)&&(r-=Math.pow(2,8*e)),r},c.prototype.readIntBE=function(t,e,n){t|=0,e|=0,n||M(t,e,this.length);for(var r=e,i=1,o=this[t+--r];r>0&&(i*=256);)o+=this[t+--r]*i;return o>=(i*=128)&&(o-=Math.pow(2,8*e)),o},c.prototype.readInt8=function(t,e){return e||M(t,1,this.length),128&this[t]?-1*(255-this[t]+1):this[t]},c.prototype.readInt16LE=function(t,e){e||M(t,2,this.length);var n=this[t]|this[t+1]<<8;return 32768&n?4294901760|n:n},c.prototype.readInt16BE=function(t,e){e||M(t,2,this.length);var n=this[t+1]|this[t]<<8;return 32768&n?4294901760|n:n},c.prototype.readInt32LE=function(t,e){return e||M(t,4,this.length),this[t]|this[t+1]<<8|this[t+2]<<16|this[t+3]<<24},c.prototype.readInt32BE=function(t,e){return e||M(t,4,this.length),this[t]<<24|this[t+1]<<16|this[t+2]<<8|this[t+3]},c.prototype.readFloatLE=function(t,e){return e||M(t,4,this.length),i.read(this,t,!0,23,4)},c.prototype.readFloatBE=function(t,e){return e||M(t,4,this.length),i.read(this,t,!1,23,4)},c.prototype.readDoubleLE=function(t,e){return e||M(t,8,this.length),i.read(this,t,!0,52,8)},c.prototype.readDoubleBE=function(t,e){return e||M(t,8,this.length),i.read(this,t,!1,52,8)},c.prototype.writeUIntLE=function(t,e,n,r){(t=+t,e|=0,n|=0,r)||T(this,t,e,n,Math.pow(2,8*n)-1,0);var i=1,o=0;for(this[e]=255&t;++o<n&&(i*=256);)this[e+o]=t/i&255;return e+n},c.prototype.writeUIntBE=function(t,e,n,r){(t=+t,e|=0,n|=0,r)||T(this,t,e,n,Math.pow(2,8*n)-1,0);var i=n-1,o=1;for(this[e+i]=255&t;--i>=0&&(o*=256);)this[e+i]=t/o&255;return e+n},c.prototype.writeUInt8=function(t,e,n){return t=+t,e|=0,n||T(this,t,e,1,255,0),c.TYPED_ARRAY_SUPPORT||(t=Math.floor(t)),this[e]=255&t,e+1},c.prototype.writeUInt16LE=function(t,e,n){return t=+t,e|=0,n||T(this,t,e,2,65535,0),c.TYPED_ARRAY_SUPPORT?(this[e]=255&t,this[e+1]=t>>>8):I(this,t,e,!0),e+2},c.prototype.writeUInt16BE=function(t,e,n){return t=+t,e|=0,n||T(this,t,e,2,65535,0),c.TYPED_ARRAY_SUPPORT?(this[e]=t>>>8,this[e+1]=255&t):I(this,t,e,!1),e+2},c.prototype.writeUInt32LE=function(t,e,n){return t=+t,e|=0,n||T(this,t,e,4,4294967295,0),c.TYPED_ARRAY_SUPPORT?(this[e+3]=t>>>24,this[e+2]=t>>>16,this[e+1]=t>>>8,this[e]=255&t):D(this,t,e,!0),e+4},c.prototype.writeUInt32BE=function(t,e,n){return t=+t,e|=0,n||T(this,t,e,4,4294967295,0),c.TYPED_ARRAY_SUPPORT?(this[e]=t>>>24,this[e+1]=t>>>16,this[e+2]=t>>>8,this[e+3]=255&t):D(this,t,e,!1),e+4},c.prototype.writeIntLE=function(t,e,n,r){if(t=+t,e|=0,!r){var i=Math.pow(2,8*n-1);T(this,t,e,n,i-1,-i)}var o=0,a=1,u=0;for(this[e]=255&t;++o<n&&(a*=256);)t<0&&0===u&&0!==this[e+o-1]&&(u=1),this[e+o]=(t/a>>0)-u&255;return e+n},c.prototype.writeIntBE=function(t,e,n,r){if(t=+t,e|=0,!r){var i=Math.pow(2,8*n-1);T(this,t,e,n,i-1,-i)}var o=n-1,a=1,u=0;for(this[e+o]=255&t;--o>=0&&(a*=256);)t<0&&0===u&&0!==this[e+o+1]&&(u=1),this[e+o]=(t/a>>0)-u&255;return e+n},c.prototype.writeInt8=function(t,e,n){return t=+t,e|=0,n||T(this,t,e,1,127,-128),c.TYPED_ARRAY_SUPPORT||(t=Math.floor(t)),t<0&&(t=255+t+1),this[e]=255&t,e+1},c.prototype.writeInt16LE=function(t,e,n){return t=+t,e|=0,n||T(this,t,e,2,32767,-32768),c.TYPED_ARRAY_SUPPORT?(this[e]=255&t,this[e+1]=t>>>8):I(this,t,e,!0),e+2},c.prototype.writeInt16BE=function(t,e,n){return t=+t,e|=0,n||T(this,t,e,2,32767,-32768),c.TYPED_ARRAY_SUPPORT?(this[e]=t>>>8,this[e+1]=255&t):I(this,t,e,!1),e+2},c.prototype.writeInt32LE=function(t,e,n){return t=+t,e|=0,n||T(this,t,e,4,2147483647,-2147483648),c.TYPED_ARRAY_SUPPORT?(this[e]=255&t,this[e+1]=t>>>8,this[e+2]=t>>>16,this[e+3]=t>>>24):D(this,t,e,!0),e+4},c.prototype.writeInt32BE=function(t,e,n){return t=+t,e|=0,n||T(this,t,e,4,2147483647,-2147483648),t<0&&(t=4294967295+t+1),c.TYPED_ARRAY_SUPPORT?(this[e]=t>>>24,this[e+1]=t>>>16,this[e+2]=t>>>8,this[e+3]=255&t):D(this,t,e,!1),e+4},c.prototype.writeFloatLE=function(t,e,n){return L(this,t,e,!0,n)},c.prototype.writeFloatBE=function(t,e,n){return L(this,t,e,!1,n)},c.prototype.writeDoubleLE=function(t,e,n){return U(this,t,e,!0,n)},c.prototype.writeDoubleBE=function(t,e,n){return U(this,t,e,!1,n)},c.prototype.copy=function(t,e,n,r){if(n||(n=0),r||0===r||(r=this.length),e>=t.length&&(e=t.length),e||(e=0),r>0&&r<n&&(r=n),r===n)return 0;if(0===t.length||0===this.length)return 0;if(e<0)throw new RangeError("targetStart out of bounds");if(n<0||n>=this.length)throw new RangeError("sourceStart out of bounds");if(r<0)throw new RangeError("sourceEnd out of bounds");r>this.length&&(r=this.length),t.length-e<r-n&&(r=t.length-e+n);var i,o=r-n;if(this===t&&n<e&&e<r)for(i=o-1;i>=0;--i)t[i+e]=this[i+n];else if(o<1e3||!c.TYPED_ARRAY_SUPPORT)for(i=0;i<o;++i)t[i+e]=this[i+n];else Uint8Array.prototype.set.call(t,this.subarray(n,n+o),e);return o},c.prototype.fill=function(t,e,n,r){if("string"==typeof t){if("string"==typeof e?(r=e,e=0,n=this.length):"string"==typeof n&&(r=n,n=this.length),1===t.length){var i=t.charCodeAt(0);i<256&&(t=i)}if(void 0!==r&&"string"!=typeof r)throw new TypeError("encoding must be a string");if("string"==typeof r&&!c.isEncoding(r))throw new TypeError("Unknown encoding: "+r)}else"number"==typeof t&&(t&=255);if(e<0||this.length<e||this.length<n)throw new RangeError("Out of range index");if(n<=e)return this;var o;if(e>>>=0,n=void 0===n?this.length:n>>>0,t||(t=0),"number"==typeof t)for(o=e;o<n;++o)this[o]=t;else{var a=c.isBuffer(t)?t:N(new c(t,r).toString()),u=a.length;for(o=0;o<n-e;++o)this[o+e]=a[o%u]}return this};var z=/[^+\/0-9A-Za-z-_]/g;function B(t){return t<16?"0"+t.toString(16):t.toString(16)}function N(t,e){var n;e=e||1/0;for(var r=t.length,i=null,o=[],a=0;a<r;++a){if((n=t.charCodeAt(a))>55295&&n<57344){if(!i){if(n>56319){(e-=3)>-1&&o.push(239,191,189);continue}if(a+1===r){(e-=3)>-1&&o.push(239,191,189);continue}i=n;continue}if(n<56320){(e-=3)>-1&&o.push(239,191,189),i=n;continue}n=65536+(i-55296<<10|n-56320)}else i&&(e-=3)>-1&&o.push(239,191,189);if(i=null,n<128){if((e-=1)<0)break;o.push(n)}else if(n<2048){if((e-=2)<0)break;o.push(n>>6|192,63&n|128)}else if(n<65536){if((e-=3)<0)break;o.push(n>>12|224,n>>6&63|128,63&n|128)}else{if(!(n<1114112))throw new Error("Invalid code point");if((e-=4)<0)break;o.push(n>>18|240,n>>12&63|128,n>>6&63|128,63&n|128)}}return o}function W(t){return r.toByteArray(function(t){if((t=function(t){return t.trim?t.trim():t.replace(/^\s+|\s+$/g,"")}(t).replace(z,"")).length<2)return"";for(;t.length%4!=0;)t+="=";return t}(t))}function F(t,e,n,r){for(var i=0;i<r&&!(i+n>=e.length||i>=t.length);++i)e[i+n]=t[i];return i}}).call(this,n(12))},function(t,e,n){(function(t){function n(t){return Object.prototype.toString.call(t)}e.isArray=function(t){return Array.isArray?Array.isArray(t):"[object Array]"===n(t)},e.isBoolean=function(t){return"boolean"==typeof t},e.isNull=function(t){return null===t},e.isNullOrUndefined=function(t){return null==t},e.isNumber=function(t){return"number"==typeof t},e.isString=function(t){return"string"==typeof t},e.isSymbol=function(t){return"symbol"==typeof t},e.isUndefined=function(t){return void 0===t},e.isRegExp=function(t){return"[object RegExp]"===n(t)},e.isObject=function(t){return"object"==typeof t&&null!==t},e.isDate=function(t){return"[object Date]"===n(t)},e.isError=function(t){return"[object Error]"===n(t)||t instanceof Error},e.isFunction=function(t){return"function"==typeof t},e.isPrimitive=function(t){return null===t||"boolean"==typeof t||"number"==typeof t||"string"==typeof t||"symbol"==typeof t||void 0===t},e.isBuffer=t.isBuffer}).call(this,n(21).Buffer)},function(t,e,n){"use strict";(function(t){var r,i,o,a,u,c,s,f,l,h,d,p,v=n(7),g=n(28),y=n(10),_=n(8),m=n(9),b=(n(15),n(64)),w=n(20),x=n(65),E={ctx:{binary:null},dom:{binary:null}},A={x:0,y:0};function R(t){var e,n,i,o,a,u,c,s=l.size.x,f=l.size.y,h=-l.size.x,d=-l.size.y;for(e=0,n=0;n<t.length;n++)e+=(o=t[n]).rad;for((e=(180*(e/=t.length)/Math.PI+90)%180-90)<0&&(e+=180),e=(180-e)*Math.PI/180,a=g.copy(g.create(),[Math.cos(e),Math.sin(e),-Math.sin(e),Math.cos(e)]),n=0;n<t.length;n++){for(o=t[n],i=0;i<4;i++)v.transformMat2(o.box[i],o.box[i],a);0}for(n=0;n<t.length;n++)for(o=t[n],i=0;i<4;i++)o.box[i][0]<s&&(s=o.box[i][0]),o.box[i][0]>h&&(h=o.box[i][0]),o.box[i][1]<f&&(f=o.box[i][1]),o.box[i][1]>d&&(d=o.box[i][1]);for(u=[[s,f],[h,f],[h,d],[s,d]],c=r.halfSample?2:1,a=g.invert(a,a),i=0;i<4;i++)v.transformMat2(u[i],u[i],a);for(i=0;i<4;i++)v.scale(u[i],u[i],c);return u}function S(t,e){l.subImageAsCopy(a,Object(_.imageRef)(t,e)),p.skeletonize()}function O(t,e,n,r){var i,o,u,c,s=[],f=[],l=Math.ceil(h.x/3);if(t.length>=2){for(i=0;i<t.length;i++)t[i].m00>l&&s.push(t[i]);if(s.length>=2){for(u=function(t){var e=Object(_.cluster)(t,.9),n=Object(_.topGeneric)(e,1,(function(t){return t.getPoints().length})),r=[],i=[];if(1===n.length){r=n[0].item.getPoints();for(var o=0;o<r.length;o++)i.push(r[o].point)}return i}(s),o=0,i=0;i<u.length;i++)o+=u[i].rad;u.length>1&&u.length>=s.length/4*3&&u.length>t.length/4&&(o/=u.length,c={index:e[1]*A.x+e[0],pos:{x:n,y:r},box:[v.clone([n,r]),v.clone([n+a.size.x,r]),v.clone([n+a.size.x,r+a.size.y]),v.clone([n,r+a.size.y])],moments:u,rad:o,vec:v.clone([Math.cos(o),Math.sin(o)])},f.push(c))}}return f}e.a={init:function(e,n){r=n,d=e,function(){i=r.halfSample?new y.a({x:d.size.x/2|0,y:d.size.y/2|0}):d,h=Object(_.calculatePatchSize)(r.patchSize,i.size),A.x=i.size.x/h.x|0,A.y=i.size.y/h.y|0,l=new y.a(i.size,void 0,Uint8Array,!1),u=new y.a(h,void 0,Array,!0);var e=new ArrayBuffer(65536);a=new y.a(h,new Uint8Array(e,0,h.x*h.y)),o=new y.a(h,new Uint8Array(e,h.x*h.y*3,h.x*h.y),void 0,!0),p=Object(x.a)("undefined"!=typeof window?window:"undefined"!=typeof self?self:t,{size:h.x},e),f=new y.a({x:i.size.x/a.size.x|0,y:i.size.y/a.size.y|0},void 0,Array,!0),c=new y.a(f.size,void 0,void 0,!0),s=new y.a(f.size,void 0,Int32Array,!0)}(),r.useWorker||"undefined"==typeof document||(E.dom.binary=document.createElement("canvas"),E.dom.binary.className="binaryBuffer",E.ctx.binary=E.dom.binary.getContext("2d"),E.dom.binary.width=l.size.x,E.dom.binary.height=l.size.y)},locate:function(){r.halfSample&&Object(_.halfSample)(d,i),Object(_.otsuThreshold)(i,l),l.zeroBorder();var t=function(){var t,e,n,r,i,c,s=[];for(t=0;t<A.x;t++)for(e=0;e<A.y;e++)S(n=a.size.x*t,r=a.size.y*e),o.zeroBorder(),m.a.init(u.data,0),c=b.a.create(o,u).rasterize(0),i=u.moments(c.count),s=s.concat(O(i,[t,e],n,r));return s}();if(t.length<A.x*A.y*.05)return null;var e=function(t){var e,n,r=0,i=0;function o(){var t;for(t=0;t<s.data.length;t++)if(0===s.data[t]&&1===c.data[t])return t;return s.length}function a(t){var e,n,i,o,u,l=t%s.size.x,h=t/s.size.x|0;if(t<s.data.length)for(i=f.data[t],s.data[t]=r,u=0;u<w.a.searchDirections.length;u++)n=h+w.a.searchDirections[u][0],e=l+w.a.searchDirections[u][1],o=n*s.size.x+e,0!==c.data[o]?0===s.data[o]&&Math.abs(v.dot(f.data[o].vec,i.vec))>.95&&a(o):s.data[o]=Number.MAX_VALUE}for(m.a.init(c.data,0),m.a.init(s.data,0),m.a.init(f.data,null),e=0;e<t.length;e++)n=t[e],f.data[n.index]=n,c.data[n.index]=1;for(c.zeroBorder();(i=o())<s.data.length;)r++,a(i);return r}(t);if(e<1)return null;var n=function(t){var e,n,r=[];for(e=0;e<t;e++)r.push(0);for(n=s.data.length;n--;)s.data[n]>0&&r[s.data[n]-1]++;return(r=r.map((function(t,e){return{val:t,label:e+1}}))).sort((function(t,e){return e.val-t.val})),r.filter((function(t){return t.val>=5}))}(e);return 0===n.length?null:function(t,e){var n,r,i,o,a=[],u=[];for(n=0;n<t.length;n++){for(r=s.data.length,a.length=0;r--;)s.data[r]===t[n].label&&(i=f.data[r],a.push(i));(o=R(a))&&u.push(o)}return u}(n)},checkImageConstraints:function(t,e){var n,r,i=t.getWidth(),o=t.getHeight(),a=e.halfSample?.5:1;t.getConfig().area&&(r=Object(_.computeImageArea)(i,o,t.getConfig().area),t.setTopRight({x:r.sx,y:r.sy}),t.setCanvasSize({x:i,y:o}),i=r.sw,o=r.sh);var u={x:Math.floor(i*a),y:Math.floor(o*a)};if(n=Object(_.calculatePatchSize)(e.patchSize,u),t.setWidth(Math.floor(Math.floor(u.x/n.x)*(1/a)*n.x)),t.setHeight(Math.floor(Math.floor(u.y/n.y)*(1/a)*n.y)),t.getWidth()%n.x==0&&t.getHeight()%n.y==0)return!0;throw new Error("Image dimensions do not comply with the current settings: Width (".concat(i," )and height (").concat(o,") must a multiple of ").concat(n.x))}}}).call(this,n(12))},function(t,e,n){"use strict";(function(e){void 0===e||!e.version||0===e.version.indexOf("v0.")||0===e.version.indexOf("v1.")&&0!==e.version.indexOf("v1.8.")?t.exports={nextTick:function(t,n,r,i){if("function"!=typeof t)throw new TypeError('"callback" argument must be a function');var o,a,u=arguments.length;switch(u){case 0:case 1:return e.nextTick(t);case 2:return e.nextTick((function(){t.call(null,n)}));case 3:return e.nextTick((function(){t.call(null,n,r)}));case 4:return e.nextTick((function(){t.call(null,n,r,i)}));default:for(o=new Array(u-1),a=0;a<o.length;)o[a++]=arguments[a];return e.nextTick((function(){t.apply(null,o)}))}}}:t.exports=e}).call(this,n(13))},function(t,e,n){var r=n(69),i=n(70),o=n(34),a=n(71);t.exports=function(t,e){return r(t)||i(t,e)||o(t,e)||a()}},function(t,e,n){var r=n(142),i=n(143),o=n(34),a=n(144);t.exports=function(t){return r(t)||i(t)||o(t)||a()}},function(t,e){function n(t,e,n,r,i,o,a){try{var u=t[o](a),c=u.value}catch(t){return void n(t)}u.done?e(c):Promise.resolve(c).then(r,i)}t.exports=function(t){return function(){var e=this,r=arguments;return new Promise((function(i,o){var a=t.apply(e,r);function u(t){n(a,i,o,u,c,"next",t)}function c(t){n(a,i,o,u,c,"throw",t)}u(void 0)}))}}},function(t,e,n){t.exports={determinant:n(147),transpose:n(148),multiply:n(149),identity:n(150),adjoint:n(151),rotate:n(152),invert:n(153),create:n(154),scale:n(155),copy:n(156),frob:n(157),ldu:n(158)}},function(t,e,n){var r=n(163),i=n(164),o="undefined"!=typeof Float64Array;function a(t,e){return t[0]-e[0]}function u(){var t,e=this.stride,n=new Array(e.length);for(t=0;t<n.length;++t)n[t]=[Math.abs(e[t]),t];n.sort(a);var r=new Array(n.length);for(t=0;t<r.length;++t)r[t]=n[t][1];return r}function c(t,e){var n=["View",e,"d",t].join("");e<0&&(n="View_Nil"+t);var i="generic"===t;if(-1===e){var o="function "+n+"(a){this.data=a;};var proto="+n+".prototype;proto.dtype='"+t+"';proto.index=function(){return -1};proto.size=0;proto.dimension=-1;proto.shape=proto.stride=proto.order=[];proto.lo=proto.hi=proto.transpose=proto.step=function(){return new "+n+"(this.data);};proto.get=proto.set=function(){};proto.pick=function(){return null};return function construct_"+n+"(a){return new "+n+"(a);}";return new Function(o)()}if(0===e){o="function "+n+"(a,d) {this.data = a;this.offset = d};var proto="+n+".prototype;proto.dtype='"+t+"';proto.index=function(){return this.offset};proto.dimension=0;proto.size=1;proto.shape=proto.stride=proto.order=[];proto.lo=proto.hi=proto.transpose=proto.step=function "+n+"_copy() {return new "+n+"(this.data,this.offset)};proto.pick=function "+n+"_pick(){return TrivialArray(this.data);};proto.valueOf=proto.get=function "+n+"_get(){return "+(i?"this.data.get(this.offset)":"this.data[this.offset]")+"};proto.set=function "+n+"_set(v){return "+(i?"this.data.set(this.offset,v)":"this.data[this.offset]=v")+"};return function construct_"+n+"(a,b,c,d){return new "+n+"(a,d)}";return new Function("TrivialArray",o)(s[t][0])}o=["'use strict'"];var a=r(e),c=a.map((function(t){return"i"+t})),f="this.offset+"+a.map((function(t){return"this.stride["+t+"]*i"+t})).join("+"),l=a.map((function(t){return"b"+t})).join(","),h=a.map((function(t){return"c"+t})).join(",");o.push("function "+n+"(a,"+l+","+h+",d){this.data=a","this.shape=["+l+"]","this.stride=["+h+"]","this.offset=d|0}","var proto="+n+".prototype","proto.dtype='"+t+"'","proto.dimension="+e),o.push("Object.defineProperty(proto,'size',{get:function "+n+"_size(){return "+a.map((function(t){return"this.shape["+t+"]"})).join("*"),"}})"),1===e?o.push("proto.order=[0]"):(o.push("Object.defineProperty(proto,'order',{get:"),e<4?(o.push("function "+n+"_order(){"),2===e?o.push("return (Math.abs(this.stride[0])>Math.abs(this.stride[1]))?[1,0]:[0,1]}})"):3===e&&o.push("var s0=Math.abs(this.stride[0]),s1=Math.abs(this.stride[1]),s2=Math.abs(this.stride[2]);if(s0>s1){if(s1>s2){return [2,1,0];}else if(s0>s2){return [1,2,0];}else{return [1,0,2];}}else if(s0>s2){return [2,0,1];}else if(s2>s1){return [0,1,2];}else{return [0,2,1];}}})")):o.push("ORDER})")),o.push("proto.set=function "+n+"_set("+c.join(",")+",v){"),i?o.push("return this.data.set("+f+",v)}"):o.push("return this.data["+f+"]=v}"),o.push("proto.get=function "+n+"_get("+c.join(",")+"){"),i?o.push("return this.data.get("+f+")}"):o.push("return this.data["+f+"]}"),o.push("proto.index=function "+n+"_index(",c.join(),"){return "+f+"}"),o.push("proto.hi=function "+n+"_hi("+c.join(",")+"){return new "+n+"(this.data,"+a.map((function(t){return["(typeof i",t,"!=='number'||i",t,"<0)?this.shape[",t,"]:i",t,"|0"].join("")})).join(",")+","+a.map((function(t){return"this.stride["+t+"]"})).join(",")+",this.offset)}");var d=a.map((function(t){return"a"+t+"=this.shape["+t+"]"})),p=a.map((function(t){return"c"+t+"=this.stride["+t+"]"}));o.push("proto.lo=function "+n+"_lo("+c.join(",")+"){var b=this.offset,d=0,"+d.join(",")+","+p.join(","));for(var v=0;v<e;++v)o.push("if(typeof i"+v+"==='number'&&i"+v+">=0){d=i"+v+"|0;b+=c"+v+"*d;a"+v+"-=d}");o.push("return new "+n+"(this.data,"+a.map((function(t){return"a"+t})).join(",")+","+a.map((function(t){return"c"+t})).join(",")+",b)}"),o.push("proto.step=function "+n+"_step("+c.join(",")+"){var "+a.map((function(t){return"a"+t+"=this.shape["+t+"]"})).join(",")+","+a.map((function(t){return"b"+t+"=this.stride["+t+"]"})).join(",")+",c=this.offset,d=0,ceil=Math.ceil");for(v=0;v<e;++v)o.push("if(typeof i"+v+"==='number'){d=i"+v+"|0;if(d<0){c+=b"+v+"*(a"+v+"-1);a"+v+"=ceil(-a"+v+"/d)}else{a"+v+"=ceil(a"+v+"/d)}b"+v+"*=d}");o.push("return new "+n+"(this.data,"+a.map((function(t){return"a"+t})).join(",")+","+a.map((function(t){return"b"+t})).join(",")+",c)}");var g=new Array(e),y=new Array(e);for(v=0;v<e;++v)g[v]="a[i"+v+"]",y[v]="b[i"+v+"]";o.push("proto.transpose=function "+n+"_transpose("+c+"){"+c.map((function(t,e){return t+"=("+t+"===undefined?"+e+":"+t+"|0)"})).join(";"),"var a=this.shape,b=this.stride;return new "+n+"(this.data,"+g.join(",")+","+y.join(",")+",this.offset)}"),o.push("proto.pick=function "+n+"_pick("+c+"){var a=[],b=[],c=this.offset");for(v=0;v<e;++v)o.push("if(typeof i"+v+"==='number'&&i"+v+">=0){c=(c+this.stride["+v+"]*i"+v+")|0}else{a.push(this.shape["+v+"]);b.push(this.stride["+v+"])}");return o.push("var ctor=CTOR_LIST[a.length+1];return ctor(this.data,a,b,c)}"),o.push("return function construct_"+n+"(data,shape,stride,offset){return new "+n+"(data,"+a.map((function(t){return"shape["+t+"]"})).join(",")+","+a.map((function(t){return"stride["+t+"]"})).join(",")+",offset)}"),new Function("CTOR_LIST","ORDER",o.join("\n"))(s[t],u)}var s={float32:[],float64:[],int8:[],int16:[],int32:[],uint8:[],uint16:[],uint32:[],array:[],uint8_clamped:[],bigint64:[],biguint64:[],buffer:[],generic:[]};t.exports=function(t,e,n,r){if(void 0===t)return(0,s.array[0])([]);"number"==typeof t&&(t=[t]),void 0===e&&(e=[t.length]);var a=e.length;if(void 0===n){n=new Array(a);for(var u=a-1,f=1;u>=0;--u)n[u]=f,f*=e[u]}if(void 0===r){r=0;for(u=0;u<a;++u)n[u]<0&&(r-=(e[u]-1)*n[u])}for(var l=function(t){if(i(t))return"buffer";if(o)switch(Object.prototype.toString.call(t)){case"[object Float64Array]":return"float64";case"[object Float32Array]":return"float32";case"[object Int8Array]":return"int8";case"[object Int16Array]":return"int16";case"[object Int32Array]":return"int32";case"[object Uint8Array]":return"uint8";case"[object Uint16Array]":return"uint16";case"[object Uint32Array]":return"uint32";case"[object Uint8ClampedArray]":return"uint8_clamped";case"[object BigInt64Array]":return"bigint64";case"[object BigUint64Array]":return"biguint64"}return Array.isArray(t)?"array":"generic"}(t),h=s[l];h.length<=a+1;)h.push(c(l,h.length-1));return(0,h[a+1])(t,e,n,r)}},function(t,e,n){"use strict";var r,i="object"==typeof Reflect?Reflect:null,o=i&&"function"==typeof i.apply?i.apply:function(t,e,n){return Function.prototype.apply.call(t,e,n)};r=i&&"function"==typeof i.ownKeys?i.ownKeys:Object.getOwnPropertySymbols?function(t){return Object.getOwnPropertyNames(t).concat(Object.getOwnPropertySymbols(t))}:function(t){return Object.getOwnPropertyNames(t)};var a=Number.isNaN||function(t){return t!=t};function u(){u.init.call(this)}t.exports=u,u.EventEmitter=u,u.prototype._events=void 0,u.prototype._eventsCount=0,u.prototype._maxListeners=void 0;var c=10;function s(t){if("function"!=typeof t)throw new TypeError('The "listener" argument must be of type Function. Received type '+typeof t)}function f(t){return void 0===t._maxListeners?u.defaultMaxListeners:t._maxListeners}function l(t,e,n,r){var i,o,a,u;if(s(n),void 0===(o=t._events)?(o=t._events=Object.create(null),t._eventsCount=0):(void 0!==o.newListener&&(t.emit("newListener",e,n.listener?n.listener:n),o=t._events),a=o[e]),void 0===a)a=o[e]=n,++t._eventsCount;else if("function"==typeof a?a=o[e]=r?[n,a]:[a,n]:r?a.unshift(n):a.push(n),(i=f(t))>0&&a.length>i&&!a.warned){a.warned=!0;var c=new Error("Possible EventEmitter memory leak detected. "+a.length+" "+String(e)+" listeners added. Use emitter.setMaxListeners() to increase limit");c.name="MaxListenersExceededWarning",c.emitter=t,c.type=e,c.count=a.length,u=c,console&&console.warn&&console.warn(u)}return t}function h(){if(!this.fired)return this.target.removeListener(this.type,this.wrapFn),this.fired=!0,0===arguments.length?this.listener.call(this.target):this.listener.apply(this.target,arguments)}function d(t,e,n){var r={fired:!1,wrapFn:void 0,target:t,type:e,listener:n},i=h.bind(r);return i.listener=n,r.wrapFn=i,i}function p(t,e,n){var r=t._events;if(void 0===r)return[];var i=r[e];return void 0===i?[]:"function"==typeof i?n?[i.listener||i]:[i]:n?function(t){for(var e=new Array(t.length),n=0;n<e.length;++n)e[n]=t[n].listener||t[n];return e}(i):g(i,i.length)}function v(t){var e=this._events;if(void 0!==e){var n=e[t];if("function"==typeof n)return 1;if(void 0!==n)return n.length}return 0}function g(t,e){for(var n=new Array(e),r=0;r<e;++r)n[r]=t[r];return n}Object.defineProperty(u,"defaultMaxListeners",{enumerable:!0,get:function(){return c},set:function(t){if("number"!=typeof t||t<0||a(t))throw new RangeError('The value of "defaultMaxListeners" is out of range. It must be a non-negative number. Received '+t+".");c=t}}),u.init=function(){void 0!==this._events&&this._events!==Object.getPrototypeOf(this)._events||(this._events=Object.create(null),this._eventsCount=0),this._maxListeners=this._maxListeners||void 0},u.prototype.setMaxListeners=function(t){if("number"!=typeof t||t<0||a(t))throw new RangeError('The value of "n" is out of range. It must be a non-negative number. Received '+t+".");return this._maxListeners=t,this},u.prototype.getMaxListeners=function(){return f(this)},u.prototype.emit=function(t){for(var e=[],n=1;n<arguments.length;n++)e.push(arguments[n]);var r="error"===t,i=this._events;if(void 0!==i)r=r&&void 0===i.error;else if(!r)return!1;if(r){var a;if(e.length>0&&(a=e[0]),a instanceof Error)throw a;var u=new Error("Unhandled error."+(a?" ("+a.message+")":""));throw u.context=a,u}var c=i[t];if(void 0===c)return!1;if("function"==typeof c)o(c,this,e);else{var s=c.length,f=g(c,s);for(n=0;n<s;++n)o(f[n],this,e)}return!0},u.prototype.addListener=function(t,e){return l(this,t,e,!1)},u.prototype.on=u.prototype.addListener,u.prototype.prependListener=function(t,e){return l(this,t,e,!0)},u.prototype.once=function(t,e){return s(e),this.on(t,d(this,t,e)),this},u.prototype.prependOnceListener=function(t,e){return s(e),this.prependListener(t,d(this,t,e)),this},u.prototype.removeListener=function(t,e){var n,r,i,o,a;if(s(e),void 0===(r=this._events))return this;if(void 0===(n=r[t]))return this;if(n===e||n.listener===e)0==--this._eventsCount?this._events=Object.create(null):(delete r[t],r.removeListener&&this.emit("removeListener",t,n.listener||e));else if("function"!=typeof n){for(i=-1,o=n.length-1;o>=0;o--)if(n[o]===e||n[o].listener===e){a=n[o].listener,i=o;break}if(i<0)return this;0===i?n.shift():function(t,e){for(;e+1<t.length;e++)t[e]=t[e+1];t.pop()}(n,i),1===n.length&&(r[t]=n[0]),void 0!==r.removeListener&&this.emit("removeListener",t,a||e)}return this},u.prototype.off=u.prototype.removeListener,u.prototype.removeAllListeners=function(t){var e,n,r;if(void 0===(n=this._events))return this;if(void 0===n.removeListener)return 0===arguments.length?(this._events=Object.create(null),this._eventsCount=0):void 0!==n[t]&&(0==--this._eventsCount?this._events=Object.create(null):delete n[t]),this;if(0===arguments.length){var i,o=Object.keys(n);for(r=0;r<o.length;++r)"removeListener"!==(i=o[r])&&this.removeAllListeners(i);return this.removeAllListeners("removeListener"),this._events=Object.create(null),this._eventsCount=0,this}if("function"==typeof(e=n[t]))this.removeListener(t,e);else if(void 0!==e)for(r=e.length-1;r>=0;r--)this.removeListener(t,e[r]);return this},u.prototype.listeners=function(t){return p(this,t,!0)},u.prototype.rawListeners=function(t){return p(this,t,!1)},u.listenerCount=function(t,e){return"function"==typeof t.listenerCount?t.listenerCount(e):v.call(t,e)},u.prototype.listenerCount=v,u.prototype.eventNames=function(){return this._eventsCount>0?r(this._events):[]}},function(t,e,n){(e=t.exports=n(57)).Stream=e,e.Readable=e,e.Writable=n(33),e.Duplex=n(14),e.Transform=n(61),e.PassThrough=n(182)},function(t,e,n){var r=n(21),i=r.Buffer;function o(t,e){for(var n in t)e[n]=t[n]}function a(t,e,n){return i(t,e,n)}i.from&&i.alloc&&i.allocUnsafe&&i.allocUnsafeSlow?t.exports=r:(o(r,e),e.Buffer=a),o(i,a),a.from=function(t,e,n){if("number"==typeof t)throw new TypeError("Argument must not be a number");return i(t,e,n)},a.alloc=function(t,e,n){if("number"!=typeof t)throw new TypeError("Argument must be a number");var r=i(t);return void 0!==e?"string"==typeof n?r.fill(e,n):r.fill(e):r.fill(0),r},a.allocUnsafe=function(t){if("number"!=typeof t)throw new TypeError("Argument must be a number");return i(t)},a.allocUnsafeSlow=function(t){if("number"!=typeof t)throw new TypeError("Argument must be a number");return r.SlowBuffer(t)}},function(t,e,n){"use strict";(function(e,r,i){var o=n(24);function a(t){var e=this;this.next=null,this.entry=null,this.finish=function(){!function(t,e,n){var r=t.entry;t.entry=null;for(;r;){var i=r.callback;e.pendingcb--,i(n),r=r.next}e.corkedRequestsFree?e.corkedRequestsFree.next=t:e.corkedRequestsFree=t}(e,t)}}t.exports=_;var u,c=!e.browser&&["v0.10","v0.9."].indexOf(e.version.slice(0,5))>-1?r:o.nextTick;_.WritableState=y;var s=Object.create(n(22));s.inherits=n(18);var f={deprecate:n(180)},l=n(58),h=n(32).Buffer,d=i.Uint8Array||function(){};var p,v=n(59);function g(){}function y(t,e){u=u||n(14),t=t||{};var r=e instanceof u;this.objectMode=!!t.objectMode,r&&(this.objectMode=this.objectMode||!!t.writableObjectMode);var i=t.highWaterMark,s=t.writableHighWaterMark,f=this.objectMode?16:16384;this.highWaterMark=i||0===i?i:r&&(s||0===s)?s:f,this.highWaterMark=Math.floor(this.highWaterMark),this.finalCalled=!1,this.needDrain=!1,this.ending=!1,this.ended=!1,this.finished=!1,this.destroyed=!1;var l=!1===t.decodeStrings;this.decodeStrings=!l,this.defaultEncoding=t.defaultEncoding||"utf8",this.length=0,this.writing=!1,this.corked=0,this.sync=!0,this.bufferProcessing=!1,this.onwrite=function(t){!function(t,e){var n=t._writableState,r=n.sync,i=n.writecb;if(function(t){t.writing=!1,t.writecb=null,t.length-=t.writelen,t.writelen=0}(n),e)!function(t,e,n,r,i){--e.pendingcb,n?(o.nextTick(i,r),o.nextTick(A,t,e),t._writableState.errorEmitted=!0,t.emit("error",r)):(i(r),t._writableState.errorEmitted=!0,t.emit("error",r),A(t,e))}(t,n,r,e,i);else{var a=x(n);a||n.corked||n.bufferProcessing||!n.bufferedRequest||w(t,n),r?c(b,t,n,a,i):b(t,n,a,i)}}(e,t)},this.writecb=null,this.writelen=0,this.bufferedRequest=null,this.lastBufferedRequest=null,this.pendingcb=0,this.prefinished=!1,this.errorEmitted=!1,this.bufferedRequestCount=0,this.corkedRequestsFree=new a(this)}function _(t){if(u=u||n(14),!(p.call(_,this)||this instanceof u))return new _(t);this._writableState=new y(t,this),this.writable=!0,t&&("function"==typeof t.write&&(this._write=t.write),"function"==typeof t.writev&&(this._writev=t.writev),"function"==typeof t.destroy&&(this._destroy=t.destroy),"function"==typeof t.final&&(this._final=t.final)),l.call(this)}function m(t,e,n,r,i,o,a){e.writelen=r,e.writecb=a,e.writing=!0,e.sync=!0,n?t._writev(i,e.onwrite):t._write(i,o,e.onwrite),e.sync=!1}function b(t,e,n,r){n||function(t,e){0===e.length&&e.needDrain&&(e.needDrain=!1,t.emit("drain"))}(t,e),e.pendingcb--,r(),A(t,e)}function w(t,e){e.bufferProcessing=!0;var n=e.bufferedRequest;if(t._writev&&n&&n.next){var r=e.bufferedRequestCount,i=new Array(r),o=e.corkedRequestsFree;o.entry=n;for(var u=0,c=!0;n;)i[u]=n,n.isBuf||(c=!1),n=n.next,u+=1;i.allBuffers=c,m(t,e,!0,e.length,i,"",o.finish),e.pendingcb++,e.lastBufferedRequest=null,o.next?(e.corkedRequestsFree=o.next,o.next=null):e.corkedRequestsFree=new a(e),e.bufferedRequestCount=0}else{for(;n;){var s=n.chunk,f=n.encoding,l=n.callback;if(m(t,e,!1,e.objectMode?1:s.length,s,f,l),n=n.next,e.bufferedRequestCount--,e.writing)break}null===n&&(e.lastBufferedRequest=null)}e.bufferedRequest=n,e.bufferProcessing=!1}function x(t){return t.ending&&0===t.length&&null===t.bufferedRequest&&!t.finished&&!t.writing}function E(t,e){t._final((function(n){e.pendingcb--,n&&t.emit("error",n),e.prefinished=!0,t.emit("prefinish"),A(t,e)}))}function A(t,e){var n=x(e);return n&&(!function(t,e){e.prefinished||e.finalCalled||("function"==typeof t._final?(e.pendingcb++,e.finalCalled=!0,o.nextTick(E,t,e)):(e.prefinished=!0,t.emit("prefinish")))}(t,e),0===e.pendingcb&&(e.finished=!0,t.emit("finish"))),n}s.inherits(_,l),y.prototype.getBuffer=function(){for(var t=this.bufferedRequest,e=[];t;)e.push(t),t=t.next;return e},function(){try{Object.defineProperty(y.prototype,"buffer",{get:f.deprecate((function(){return this.getBuffer()}),"_writableState.buffer is deprecated. Use _writableState.getBuffer instead.","DEP0003")})}catch(t){}}(),"function"==typeof Symbol&&Symbol.hasInstance&&"function"==typeof Function.prototype[Symbol.hasInstance]?(p=Function.prototype[Symbol.hasInstance],Object.defineProperty(_,Symbol.hasInstance,{value:function(t){return!!p.call(this,t)||this===_&&(t&&t._writableState instanceof y)}})):p=function(t){return t instanceof this},_.prototype.pipe=function(){this.emit("error",new Error("Cannot pipe, not readable"))},_.prototype.write=function(t,e,n){var r,i=this._writableState,a=!1,u=!i.objectMode&&(r=t,h.isBuffer(r)||r instanceof d);return u&&!h.isBuffer(t)&&(t=function(t){return h.from(t)}(t)),"function"==typeof e&&(n=e,e=null),u?e="buffer":e||(e=i.defaultEncoding),"function"!=typeof n&&(n=g),i.ended?function(t,e){var n=new Error("write after end");t.emit("error",n),o.nextTick(e,n)}(this,n):(u||function(t,e,n,r){var i=!0,a=!1;return null===n?a=new TypeError("May not write null values to stream"):"string"==typeof n||void 0===n||e.objectMode||(a=new TypeError("Invalid non-string/buffer chunk")),a&&(t.emit("error",a),o.nextTick(r,a),i=!1),i}(this,i,t,n))&&(i.pendingcb++,a=function(t,e,n,r,i,o){if(!n){var a=function(t,e,n){t.objectMode||!1===t.decodeStrings||"string"!=typeof e||(e=h.from(e,n));return e}(e,r,i);r!==a&&(n=!0,i="buffer",r=a)}var u=e.objectMode?1:r.length;e.length+=u;var c=e.length<e.highWaterMark;c||(e.needDrain=!0);if(e.writing||e.corked){var s=e.lastBufferedRequest;e.lastBufferedRequest={chunk:r,encoding:i,isBuf:n,callback:o,next:null},s?s.next=e.lastBufferedRequest:e.bufferedRequest=e.lastBufferedRequest,e.bufferedRequestCount+=1}else m(t,e,!1,u,r,i,o);return c}(this,i,u,t,e,n)),a},_.prototype.cork=function(){this._writableState.corked++},_.prototype.uncork=function(){var t=this._writableState;t.corked&&(t.corked--,t.writing||t.corked||t.finished||t.bufferProcessing||!t.bufferedRequest||w(this,t))},_.prototype.setDefaultEncoding=function(t){if("string"==typeof t&&(t=t.toLowerCase()),!(["hex","utf8","utf-8","ascii","binary","base64","ucs2","ucs-2","utf16le","utf-16le","raw"].indexOf((t+"").toLowerCase())>-1))throw new TypeError("Unknown encoding: "+t);return this._writableState.defaultEncoding=t,this},Object.defineProperty(_.prototype,"writableHighWaterMark",{enumerable:!1,get:function(){return this._writableState.highWaterMark}}),_.prototype._write=function(t,e,n){n(new Error("_write() is not implemented"))},_.prototype._writev=null,_.prototype.end=function(t,e,n){var r=this._writableState;"function"==typeof t?(n=t,t=null,e=null):"function"==typeof e&&(n=e,e=null),null!=t&&this.write(t,e),r.corked&&(r.corked=1,this.uncork()),r.ending||r.finished||function(t,e,n){e.ending=!0,A(t,e),n&&(e.finished?o.nextTick(n):t.once("finish",n));e.ended=!0,t.writable=!1}(this,r,n)},Object.defineProperty(_.prototype,"destroyed",{get:function(){return void 0!==this._writableState&&this._writableState.destroyed},set:function(t){this._writableState&&(this._writableState.destroyed=t)}}),_.prototype.destroy=v.destroy,_.prototype._undestroy=v.undestroy,_.prototype._destroy=function(t,e){this.end(),e(t)}}).call(this,n(13),n(178).setImmediate,n(12))},function(t,e,n){var r=n(35);t.exports=function(t,e){if(t){if("string"==typeof t)return r(t,e);var n=Object.prototype.toString.call(t).slice(8,-1);return"Object"===n&&t.constructor&&(n=t.constructor.name),"Map"===n||"Set"===n?Array.from(t):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?r(t,e):void 0}}},function(t,e){t.exports=function(t,e){(null==e||e>t.length)&&(e=t.length);for(var n=0,r=new Array(e);n<e;n++)r[n]=t[n];return r}},function(t,e){t.exports=1e-6},function(t,e){t.exports=function(){var t=new Float32Array(2);return t[0]=0,t[1]=0,t}},function(t,e){t.exports=function(t,e,n){return t[0]=e[0]-n[0],t[1]=e[1]-n[1],t}},function(t,e){t.exports=function(t,e,n){return t[0]=e[0]*n[0],t[1]=e[1]*n[1],t}},function(t,e){t.exports=function(t,e,n){return t[0]=e[0]/n[0],t[1]=e[1]/n[1],t}},function(t,e){t.exports=function(t,e){var n=e[0]-t[0],r=e[1]-t[1];return Math.sqrt(n*n+r*r)}},function(t,e){t.exports=function(t,e){var n=e[0]-t[0],r=e[1]-t[1];return n*n+r*r}},function(t,e){t.exports=function(t){var e=t[0],n=t[1];return Math.sqrt(e*e+n*n)}},function(t,e){t.exports=function(t){var e=t[0],n=t[1];return e*e+n*n}},function(t,e){t.exports=1e-6},function(t,e){t.exports=function(){var t=new Float32Array(3);return t[0]=0,t[1]=0,t[2]=0,t}},function(t,e){t.exports=function(t,e,n){var r=new Float32Array(3);return r[0]=t,r[1]=e,r[2]=n,r}},function(t,e){t.exports=function(t,e){var n=e[0],r=e[1],i=e[2],o=n*n+r*r+i*i;o>0&&(o=1/Math.sqrt(o),t[0]=e[0]*o,t[1]=e[1]*o,t[2]=e[2]*o);return t}},function(t,e){t.exports=function(t,e){return t[0]*e[0]+t[1]*e[1]+t[2]*e[2]}},function(t,e){t.exports=function(t,e,n){return t[0]=e[0]-n[0],t[1]=e[1]-n[1],t[2]=e[2]-n[2],t}},function(t,e){t.exports=function(t,e,n){return t[0]=e[0]*n[0],t[1]=e[1]*n[1],t[2]=e[2]*n[2],t}},function(t,e){t.exports=function(t,e,n){return t[0]=e[0]/n[0],t[1]=e[1]/n[1],t[2]=e[2]/n[2],t}},function(t,e){t.exports=function(t,e){var n=e[0]-t[0],r=e[1]-t[1],i=e[2]-t[2];return Math.sqrt(n*n+r*r+i*i)}},function(t,e){t.exports=function(t,e){var n=e[0]-t[0],r=e[1]-t[1],i=e[2]-t[2];return n*n+r*r+i*i}},function(t,e){t.exports=function(t){var e=t[0],n=t[1],r=t[2];return Math.sqrt(e*e+n*n+r*r)}},function(t,e){t.exports=function(t){var e=t[0],n=t[1],r=t[2];return e*e+n*n+r*r}},function(t,e,n){"use strict";(function(e,r){var i=n(24);t.exports=m;var o,a=n(174);m.ReadableState=_;n(30).EventEmitter;var u=function(t,e){return t.listeners(e).length},c=n(58),s=n(32).Buffer,f=e.Uint8Array||function(){};var l=Object.create(n(22));l.inherits=n(18);var h=n(175),d=void 0;d=h&&h.debuglog?h.debuglog("stream"):function(){};var p,v=n(176),g=n(59);l.inherits(m,c);var y=["error","close","destroy","pause","resume"];function _(t,e){t=t||{};var r=e instanceof(o=o||n(14));this.objectMode=!!t.objectMode,r&&(this.objectMode=this.objectMode||!!t.readableObjectMode);var i=t.highWaterMark,a=t.readableHighWaterMark,u=this.objectMode?16:16384;this.highWaterMark=i||0===i?i:r&&(a||0===a)?a:u,this.highWaterMark=Math.floor(this.highWaterMark),this.buffer=new v,this.length=0,this.pipes=null,this.pipesCount=0,this.flowing=null,this.ended=!1,this.endEmitted=!1,this.reading=!1,this.sync=!0,this.needReadable=!1,this.emittedReadable=!1,this.readableListening=!1,this.resumeScheduled=!1,this.destroyed=!1,this.defaultEncoding=t.defaultEncoding||"utf8",this.awaitDrain=0,this.readingMore=!1,this.decoder=null,this.encoding=null,t.encoding&&(p||(p=n(60).StringDecoder),this.decoder=new p(t.encoding),this.encoding=t.encoding)}function m(t){if(o=o||n(14),!(this instanceof m))return new m(t);this._readableState=new _(t,this),this.readable=!0,t&&("function"==typeof t.read&&(this._read=t.read),"function"==typeof t.destroy&&(this._destroy=t.destroy)),c.call(this)}function b(t,e,n,r,i){var o,a=t._readableState;null===e?(a.reading=!1,function(t,e){if(e.ended)return;if(e.decoder){var n=e.decoder.end();n&&n.length&&(e.buffer.push(n),e.length+=e.objectMode?1:n.length)}e.ended=!0,E(t)}(t,a)):(i||(o=function(t,e){var n;r=e,s.isBuffer(r)||r instanceof f||"string"==typeof e||void 0===e||t.objectMode||(n=new TypeError("Invalid non-string/buffer chunk"));var r;return n}(a,e)),o?t.emit("error",o):a.objectMode||e&&e.length>0?("string"==typeof e||a.objectMode||Object.getPrototypeOf(e)===s.prototype||(e=function(t){return s.from(t)}(e)),r?a.endEmitted?t.emit("error",new Error("stream.unshift() after end event")):w(t,a,e,!0):a.ended?t.emit("error",new Error("stream.push() after EOF")):(a.reading=!1,a.decoder&&!n?(e=a.decoder.write(e),a.objectMode||0!==e.length?w(t,a,e,!1):R(t,a)):w(t,a,e,!1))):r||(a.reading=!1));return function(t){return!t.ended&&(t.needReadable||t.length<t.highWaterMark||0===t.length)}(a)}function w(t,e,n,r){e.flowing&&0===e.length&&!e.sync?(t.emit("data",n),t.read(0)):(e.length+=e.objectMode?1:n.length,r?e.buffer.unshift(n):e.buffer.push(n),e.needReadable&&E(t)),R(t,e)}Object.defineProperty(m.prototype,"destroyed",{get:function(){return void 0!==this._readableState&&this._readableState.destroyed},set:function(t){this._readableState&&(this._readableState.destroyed=t)}}),m.prototype.destroy=g.destroy,m.prototype._undestroy=g.undestroy,m.prototype._destroy=function(t,e){this.push(null),e(t)},m.prototype.push=function(t,e){var n,r=this._readableState;return r.objectMode?n=!0:"string"==typeof t&&((e=e||r.defaultEncoding)!==r.encoding&&(t=s.from(t,e),e=""),n=!0),b(this,t,e,!1,n)},m.prototype.unshift=function(t){return b(this,t,null,!0,!1)},m.prototype.isPaused=function(){return!1===this._readableState.flowing},m.prototype.setEncoding=function(t){return p||(p=n(60).StringDecoder),this._readableState.decoder=new p(t),this._readableState.encoding=t,this};function x(t,e){return t<=0||0===e.length&&e.ended?0:e.objectMode?1:t!=t?e.flowing&&e.length?e.buffer.head.data.length:e.length:(t>e.highWaterMark&&(e.highWaterMark=function(t){return t>=8388608?t=8388608:(t--,t|=t>>>1,t|=t>>>2,t|=t>>>4,t|=t>>>8,t|=t>>>16,t++),t}(t)),t<=e.length?t:e.ended?e.length:(e.needReadable=!0,0))}function E(t){var e=t._readableState;e.needReadable=!1,e.emittedReadable||(d("emitReadable",e.flowing),e.emittedReadable=!0,e.sync?i.nextTick(A,t):A(t))}function A(t){d("emit readable"),t.emit("readable"),C(t)}function R(t,e){e.readingMore||(e.readingMore=!0,i.nextTick(S,t,e))}function S(t,e){for(var n=e.length;!e.reading&&!e.flowing&&!e.ended&&e.length<e.highWaterMark&&(d("maybeReadMore read 0"),t.read(0),n!==e.length);)n=e.length;e.readingMore=!1}function O(t){d("readable nexttick read 0"),t.read(0)}function k(t,e){e.reading||(d("resume read 0"),t.read(0)),e.resumeScheduled=!1,e.awaitDrain=0,t.emit("resume"),C(t),e.flowing&&!e.reading&&t.read(0)}function C(t){var e=t._readableState;for(d("flow",e.flowing);e.flowing&&null!==t.read(););}function j(t,e){return 0===e.length?null:(e.objectMode?n=e.buffer.shift():!t||t>=e.length?(n=e.decoder?e.buffer.join(""):1===e.buffer.length?e.buffer.head.data:e.buffer.concat(e.length),e.buffer.clear()):n=function(t,e,n){var r;t<e.head.data.length?(r=e.head.data.slice(0,t),e.head.data=e.head.data.slice(t)):r=t===e.head.data.length?e.shift():n?function(t,e){var n=e.head,r=1,i=n.data;t-=i.length;for(;n=n.next;){var o=n.data,a=t>o.length?o.length:t;if(a===o.length?i+=o:i+=o.slice(0,t),0===(t-=a)){a===o.length?(++r,n.next?e.head=n.next:e.head=e.tail=null):(e.head=n,n.data=o.slice(a));break}++r}return e.length-=r,i}(t,e):function(t,e){var n=s.allocUnsafe(t),r=e.head,i=1;r.data.copy(n),t-=r.data.length;for(;r=r.next;){var o=r.data,a=t>o.length?o.length:t;if(o.copy(n,n.length-t,0,a),0===(t-=a)){a===o.length?(++i,r.next?e.head=r.next:e.head=e.tail=null):(e.head=r,r.data=o.slice(a));break}++i}return e.length-=i,n}(t,e);return r}(t,e.buffer,e.decoder),n);var n}function M(t){var e=t._readableState;if(e.length>0)throw new Error('"endReadable()" called on non-empty stream');e.endEmitted||(e.ended=!0,i.nextTick(T,e,t))}function T(t,e){t.endEmitted||0!==t.length||(t.endEmitted=!0,e.readable=!1,e.emit("end"))}function I(t,e){for(var n=0,r=t.length;n<r;n++)if(t[n]===e)return n;return-1}m.prototype.read=function(t){d("read",t),t=parseInt(t,10);var e=this._readableState,n=t;if(0!==t&&(e.emittedReadable=!1),0===t&&e.needReadable&&(e.length>=e.highWaterMark||e.ended))return d("read: emitReadable",e.length,e.ended),0===e.length&&e.ended?M(this):E(this),null;if(0===(t=x(t,e))&&e.ended)return 0===e.length&&M(this),null;var r,i=e.needReadable;return d("need readable",i),(0===e.length||e.length-t<e.highWaterMark)&&d("length less than watermark",i=!0),e.ended||e.reading?d("reading or ended",i=!1):i&&(d("do read"),e.reading=!0,e.sync=!0,0===e.length&&(e.needReadable=!0),this._read(e.highWaterMark),e.sync=!1,e.reading||(t=x(n,e))),null===(r=t>0?j(t,e):null)?(e.needReadable=!0,t=0):e.length-=t,0===e.length&&(e.ended||(e.needReadable=!0),n!==t&&e.ended&&M(this)),null!==r&&this.emit("data",r),r},m.prototype._read=function(t){this.emit("error",new Error("_read() is not implemented"))},m.prototype.pipe=function(t,e){var n=this,o=this._readableState;switch(o.pipesCount){case 0:o.pipes=t;break;case 1:o.pipes=[o.pipes,t];break;default:o.pipes.push(t)}o.pipesCount+=1,d("pipe count=%d opts=%j",o.pipesCount,e);var c=(!e||!1!==e.end)&&t!==r.stdout&&t!==r.stderr?f:m;function s(e,r){d("onunpipe"),e===n&&r&&!1===r.hasUnpiped&&(r.hasUnpiped=!0,d("cleanup"),t.removeListener("close",y),t.removeListener("finish",_),t.removeListener("drain",l),t.removeListener("error",g),t.removeListener("unpipe",s),n.removeListener("end",f),n.removeListener("end",m),n.removeListener("data",v),h=!0,!o.awaitDrain||t._writableState&&!t._writableState.needDrain||l())}function f(){d("onend"),t.end()}o.endEmitted?i.nextTick(c):n.once("end",c),t.on("unpipe",s);var l=function(t){return function(){var e=t._readableState;d("pipeOnDrain",e.awaitDrain),e.awaitDrain&&e.awaitDrain--,0===e.awaitDrain&&u(t,"data")&&(e.flowing=!0,C(t))}}(n);t.on("drain",l);var h=!1;var p=!1;function v(e){d("ondata"),p=!1,!1!==t.write(e)||p||((1===o.pipesCount&&o.pipes===t||o.pipesCount>1&&-1!==I(o.pipes,t))&&!h&&(d("false write response, pause",n._readableState.awaitDrain),n._readableState.awaitDrain++,p=!0),n.pause())}function g(e){d("onerror",e),m(),t.removeListener("error",g),0===u(t,"error")&&t.emit("error",e)}function y(){t.removeListener("finish",_),m()}function _(){d("onfinish"),t.removeListener("close",y),m()}function m(){d("unpipe"),n.unpipe(t)}return n.on("data",v),function(t,e,n){if("function"==typeof t.prependListener)return t.prependListener(e,n);t._events&&t._events[e]?a(t._events[e])?t._events[e].unshift(n):t._events[e]=[n,t._events[e]]:t.on(e,n)}(t,"error",g),t.once("close",y),t.once("finish",_),t.emit("pipe",n),o.flowing||(d("pipe resume"),n.resume()),t},m.prototype.unpipe=function(t){var e=this._readableState,n={hasUnpiped:!1};if(0===e.pipesCount)return this;if(1===e.pipesCount)return t&&t!==e.pipes||(t||(t=e.pipes),e.pipes=null,e.pipesCount=0,e.flowing=!1,t&&t.emit("unpipe",this,n)),this;if(!t){var r=e.pipes,i=e.pipesCount;e.pipes=null,e.pipesCount=0,e.flowing=!1;for(var o=0;o<i;o++)r[o].emit("unpipe",this,n);return this}var a=I(e.pipes,t);return-1===a||(e.pipes.splice(a,1),e.pipesCount-=1,1===e.pipesCount&&(e.pipes=e.pipes[0]),t.emit("unpipe",this,n)),this},m.prototype.on=function(t,e){var n=c.prototype.on.call(this,t,e);if("data"===t)!1!==this._readableState.flowing&&this.resume();else if("readable"===t){var r=this._readableState;r.endEmitted||r.readableListening||(r.readableListening=r.needReadable=!0,r.emittedReadable=!1,r.reading?r.length&&E(this):i.nextTick(O,this))}return n},m.prototype.addListener=m.prototype.on,m.prototype.resume=function(){var t=this._readableState;return t.flowing||(d("resume"),t.flowing=!0,function(t,e){e.resumeScheduled||(e.resumeScheduled=!0,i.nextTick(k,t,e))}(this,t)),this},m.prototype.pause=function(){return d("call pause flowing=%j",this._readableState.flowing),!1!==this._readableState.flowing&&(d("pause"),this._readableState.flowing=!1,this.emit("pause")),this},m.prototype.wrap=function(t){var e=this,n=this._readableState,r=!1;for(var i in t.on("end",(function(){if(d("wrapped end"),n.decoder&&!n.ended){var t=n.decoder.end();t&&t.length&&e.push(t)}e.push(null)})),t.on("data",(function(i){(d("wrapped data"),n.decoder&&(i=n.decoder.write(i)),n.objectMode&&null==i)||(n.objectMode||i&&i.length)&&(e.push(i)||(r=!0,t.pause()))})),t)void 0===this[i]&&"function"==typeof t[i]&&(this[i]=function(e){return function(){return t[e].apply(t,arguments)}}(i));for(var o=0;o<y.length;o++)t.on(y[o],this.emit.bind(this,y[o]));return this._read=function(e){d("wrapped _read",e),r&&(r=!1,t.resume())},this},Object.defineProperty(m.prototype,"readableHighWaterMark",{enumerable:!1,get:function(){return this._readableState.highWaterMark}}),m._fromList=j}).call(this,n(12),n(13))},function(t,e,n){t.exports=n(30).EventEmitter},function(t,e,n){"use strict";var r=n(24);function i(t,e){t.emit("error",e)}t.exports={destroy:function(t,e){var n=this,o=this._readableState&&this._readableState.destroyed,a=this._writableState&&this._writableState.destroyed;return o||a?(e?e(t):!t||this._writableState&&this._writableState.errorEmitted||r.nextTick(i,this,t),this):(this._readableState&&(this._readableState.destroyed=!0),this._writableState&&(this._writableState.destroyed=!0),this._destroy(t||null,(function(t){!e&&t?(r.nextTick(i,n,t),n._writableState&&(n._writableState.errorEmitted=!0)):e&&e(t)})),this)},undestroy:function(){this._readableState&&(this._readableState.destroyed=!1,this._readableState.reading=!1,this._readableState.ended=!1,this._readableState.endEmitted=!1),this._writableState&&(this._writableState.destroyed=!1,this._writableState.ended=!1,this._writableState.ending=!1,this._writableState.finished=!1,this._writableState.errorEmitted=!1)}}},function(t,e,n){"use strict";var r=n(181).Buffer,i=r.isEncoding||function(t){switch((t=""+t)&&t.toLowerCase()){case"hex":case"utf8":case"utf-8":case"ascii":case"binary":case"base64":case"ucs2":case"ucs-2":case"utf16le":case"utf-16le":case"raw":return!0;default:return!1}};function o(t){var e;switch(this.encoding=function(t){var e=function(t){if(!t)return"utf8";for(var e;;)switch(t){case"utf8":case"utf-8":return"utf8";case"ucs2":case"ucs-2":case"utf16le":case"utf-16le":return"utf16le";case"latin1":case"binary":return"latin1";case"base64":case"ascii":case"hex":return t;default:if(e)return;t=(""+t).toLowerCase(),e=!0}}(t);if("string"!=typeof e&&(r.isEncoding===i||!i(t)))throw new Error("Unknown encoding: "+t);return e||t}(t),this.encoding){case"utf16le":this.text=c,this.end=s,e=4;break;case"utf8":this.fillLast=u,e=4;break;case"base64":this.text=f,this.end=l,e=3;break;default:return this.write=h,void(this.end=d)}this.lastNeed=0,this.lastTotal=0,this.lastChar=r.allocUnsafe(e)}function a(t){return t<=127?0:t>>5==6?2:t>>4==14?3:t>>3==30?4:t>>6==2?-1:-2}function u(t){var e=this.lastTotal-this.lastNeed,n=function(t,e,n){if(128!=(192&e[0]))return t.lastNeed=0,"�";if(t.lastNeed>1&&e.length>1){if(128!=(192&e[1]))return t.lastNeed=1,"�";if(t.lastNeed>2&&e.length>2&&128!=(192&e[2]))return t.lastNeed=2,"�"}}(this,t);return void 0!==n?n:this.lastNeed<=t.length?(t.copy(this.lastChar,e,0,this.lastNeed),this.lastChar.toString(this.encoding,0,this.lastTotal)):(t.copy(this.lastChar,e,0,t.length),void(this.lastNeed-=t.length))}function c(t,e){if((t.length-e)%2==0){var n=t.toString("utf16le",e);if(n){var r=n.charCodeAt(n.length-1);if(r>=55296&&r<=56319)return this.lastNeed=2,this.lastTotal=4,this.lastChar[0]=t[t.length-2],this.lastChar[1]=t[t.length-1],n.slice(0,-1)}return n}return this.lastNeed=1,this.lastTotal=2,this.lastChar[0]=t[t.length-1],t.toString("utf16le",e,t.length-1)}function s(t){var e=t&&t.length?this.write(t):"";if(this.lastNeed){var n=this.lastTotal-this.lastNeed;return e+this.lastChar.toString("utf16le",0,n)}return e}function f(t,e){var n=(t.length-e)%3;return 0===n?t.toString("base64",e):(this.lastNeed=3-n,this.lastTotal=3,1===n?this.lastChar[0]=t[t.length-1]:(this.lastChar[0]=t[t.length-2],this.lastChar[1]=t[t.length-1]),t.toString("base64",e,t.length-n))}function l(t){var e=t&&t.length?this.write(t):"";return this.lastNeed?e+this.lastChar.toString("base64",0,3-this.lastNeed):e}function h(t){return t.toString(this.encoding)}function d(t){return t&&t.length?this.write(t):""}e.StringDecoder=o,o.prototype.write=function(t){if(0===t.length)return"";var e,n;if(this.lastNeed){if(void 0===(e=this.fillLast(t)))return"";n=this.lastNeed,this.lastNeed=0}else n=0;return n<t.length?e?e+this.text(t,n):this.text(t,n):e||""},o.prototype.end=function(t){var e=t&&t.length?this.write(t):"";return this.lastNeed?e+"�":e},o.prototype.text=function(t,e){var n=function(t,e,n){var r=e.length-1;if(r<n)return 0;var i=a(e[r]);if(i>=0)return i>0&&(t.lastNeed=i-1),i;if(--r<n||-2===i)return 0;if((i=a(e[r]))>=0)return i>0&&(t.lastNeed=i-2),i;if(--r<n||-2===i)return 0;if((i=a(e[r]))>=0)return i>0&&(2===i?i=0:t.lastNeed=i-3),i;return 0}(this,t,e);if(!this.lastNeed)return t.toString("utf8",e);this.lastTotal=n;var r=t.length-(n-this.lastNeed);return t.copy(this.lastChar,0,r),t.toString("utf8",e,r)},o.prototype.fillLast=function(t){if(this.lastNeed<=t.length)return t.copy(this.lastChar,this.lastTotal-this.lastNeed,0,this.lastNeed),this.lastChar.toString(this.encoding,0,this.lastTotal);t.copy(this.lastChar,this.lastTotal-this.lastNeed,0,t.length),this.lastNeed-=t.length}},function(t,e,n){"use strict";t.exports=a;var r=n(14),i=Object.create(n(22));function o(t,e){var n=this._transformState;n.transforming=!1;var r=n.writecb;if(!r)return this.emit("error",new Error("write callback called multiple times"));n.writechunk=null,n.writecb=null,null!=e&&this.push(e),r(t);var i=this._readableState;i.reading=!1,(i.needReadable||i.length<i.highWaterMark)&&this._read(i.highWaterMark)}function a(t){if(!(this instanceof a))return new a(t);r.call(this,t),this._transformState={afterTransform:o.bind(this),needTransform:!1,transforming:!1,writecb:null,writechunk:null,writeencoding:null},this._readableState.needReadable=!0,this._readableState.sync=!1,t&&("function"==typeof t.transform&&(this._transform=t.transform),"function"==typeof t.flush&&(this._flush=t.flush)),this.on("prefinish",u)}function u(){var t=this;"function"==typeof this._flush?this._flush((function(e,n){c(t,e,n)})):c(this,null,null)}function c(t,e,n){if(e)return t.emit("error",e);if(null!=n&&t.push(n),t._writableState.length)throw new Error("Calling transform done when ws.length != 0");if(t._transformState.transforming)throw new Error("Calling transform done when still transforming");return t.push(null)}i.inherits=n(18),i.inherits(a,r),a.prototype.push=function(t,e){return this._transformState.needTransform=!1,r.prototype.push.call(this,t,e)},a.prototype._transform=function(t,e,n){throw new Error("_transform() is not implemented")},a.prototype._write=function(t,e,n){var r=this._transformState;if(r.writecb=n,r.writechunk=t,r.writeencoding=e,!r.transforming){var i=this._readableState;(r.needTransform||i.needReadable||i.length<i.highWaterMark)&&this._read(i.highWaterMark)}},a.prototype._read=function(t){var e=this._transformState;null!==e.writechunk&&e.writecb&&!e.transforming?(e.transforming=!0,this._transform(e.writechunk,e.writeencoding,e.afterTransform)):e.needTransform=!0},a.prototype._destroy=function(t,e){var n=this;r.prototype._destroy.call(this,t,(function(t){e(t),n.emit("close")}))}},function(t,e,n){var r=n(8),i=n(29),o=n(188).d2,a={create:function(t){var e={},n=r.imageRef(t.getRealWidth(),t.getRealHeight()),a=t.getCanvasSize(),u=r.imageRef(t.getWidth(),t.getHeight()),c=t.getTopRight(),s=new Uint8Array(u.x*u.y),f=new Uint8Array(n.x*n.y),l=new Uint8Array(a.x*a.y),h=i(f,[n.y,n.x]).transpose(1,0),d=i(l,[a.y,a.x]).transpose(1,0),p=d.hi(c.x+u.x,c.y+u.y).lo(c.x,c.y),v=n.x/a.x,g=n.y/a.y;return e.attachData=function(t){s=t},e.getData=function(){return s},e.grab=function(){var e=t.getFrame();return!!e&&(this.scaleAndCrop(e),!0)},e.scaleAndCrop=function(t){r.computeGray(t.data,f);for(var e=0;e<a.y;e++)for(var n=0;n<a.x;n++)d.set(n,e,0|o(h,n*v,e*g));if(p.shape[0]!==u.x||p.shape[1]!==u.y)throw new Error("Shapes do not match!");for(var i=0;i<u.y;i++)for(var c=0;c<u.x;c++)s[i*u.x+c]=p.get(c,i)},e.getSize=function(){return u},e}};t.exports=a},function(t,e,n){t.exports={EPSILON:n(45),create:n(46),clone:n(107),angle:n(108),fromValues:n(47),copy:n(109),set:n(110),equals:n(111),exactEquals:n(112),add:n(113),subtract:n(50),sub:n(114),multiply:n(51),mul:n(115),divide:n(52),div:n(116),min:n(117),max:n(118),floor:n(119),ceil:n(120),round:n(121),scale:n(122),scaleAndAdd:n(123),distance:n(53),dist:n(124),squaredDistance:n(54),sqrDist:n(125),length:n(55),len:n(126),squaredLength:n(56),sqrLen:n(127),negate:n(128),inverse:n(129),normalize:n(48),dot:n(49),cross:n(130),lerp:n(131),random:n(132),transformMat4:n(133),transformMat3:n(134),transformQuat:n(135),rotateX:n(136),rotateY:n(137),rotateZ:n(138),forEach:n(139)}},function(t,e,n){"use strict";var r=n(20),i={createContour2D:function(){return{dir:null,index:null,firstVertex:null,insideContours:null,nextpeer:null,prevpeer:null}},CONTOUR_DIR:{CW_DIR:0,CCW_DIR:1,UNKNOWN_DIR:2},DIR:{OUTSIDE_EDGE:-32767,INSIDE_EDGE:-32766},create:function(t,e){var n=t.data,o=e.data,a=t.size.x,u=t.size.y,c=r.a.create(t,e);return{rasterize:function(t){var e,r,s,f,l,h,d,p,v,g,y,_,m=[],b=0;for(_=0;_<400;_++)m[_]=0;for(m[0]=n[0],v=null,h=1;h<u-1;h++)for(f=0,r=m[0],l=1;l<a-1;l++)if(0===o[y=h*a+l])if((e=n[y])!==r){if(0===f)m[s=b+1]=e,r=e,null!==(d=c.contourTracing(h,l,s,e,i.DIR.OUTSIDE_EDGE))&&(b++,f=s,(p=i.createContour2D()).dir=i.CONTOUR_DIR.CW_DIR,p.index=f,p.firstVertex=d,p.nextpeer=v,p.insideContours=null,null!==v&&(v.prevpeer=p),v=p);else if(null!==(d=c.contourTracing(h,l,i.DIR.INSIDE_EDGE,e,f))){for((p=i.createContour2D()).firstVertex=d,p.insideContours=null,p.dir=0===t?i.CONTOUR_DIR.CCW_DIR:i.CONTOUR_DIR.CW_DIR,p.index=t,g=v;null!==g&&g.index!==f;)g=g.nextpeer;null!==g&&(p.nextpeer=g.insideContours,null!==g.insideContours&&(g.insideContours.prevpeer=p),g.insideContours=p)}}else o[y]=f;else o[y]===i.DIR.OUTSIDE_EDGE||o[y]===i.DIR.INSIDE_EDGE?(f=0,r=o[y]===i.DIR.INSIDE_EDGE?n[y]:m[0]):r=m[f=o[y]];for(g=v;null!==g;)g.index=t,g=g.nextpeer;return{cc:v,count:b}},debug:{drawContour:function(t,e){var n,r,o,a=t.getContext("2d"),u=e;for(a.strokeStyle="red",a.fillStyle="red",a.lineWidth=1,n=null!==u?u.insideContours:null;null!==u;){switch(null!==n?(r=n,n=n.nextpeer):(r=u,n=null!==(u=u.nextpeer)?u.insideContours:null),r.dir){case i.CONTOUR_DIR.CW_DIR:a.strokeStyle="red";break;case i.CONTOUR_DIR.CCW_DIR:a.strokeStyle="blue";break;case i.CONTOUR_DIR.UNKNOWN_DIR:a.strokeStyle="green"}o=r.firstVertex,a.beginPath(),a.moveTo(o.x,o.y);do{o=o.next,a.lineTo(o.x,o.y)}while(o!==r.firstVertex);a.stroke()}}}}}};e.a=i},function(t,e,n){"use strict";
/* @preserve ASM BEGIN */
/* @preserve ASM END */e.a=function(t,e,n){"use asm";var r=new t.Uint8Array(n),i=e.size|0,o=t.Math.imul;function a(t,e){t|=0;e|=0;var n=0;var o=0;var a=0;var u=0;var c=0;var s=0;var f=0;var l=0;for(n=1;(n|0)<(i-1|0);n=n+1|0){l=l+i|0;for(o=1;(o|0)<(i-1|0);o=o+1|0){u=l-i|0;c=l+i|0;s=o-1|0;f=o+1|0;a=(r[t+u+s|0]|0)+(r[t+u+f|0]|0)+(r[t+l+o|0]|0)+(r[t+c+s|0]|0)+(r[t+c+f|0]|0)|0;if((a|0)==(5|0)){r[e+l+o|0]=1}else{r[e+l+o|0]=0}}}}function u(t,e,n){t|=0;e|=0;n|=0;var a=0;a=o(i,i)|0;while((a|0)>0){a=a-1|0;r[n+a|0]=(r[t+a|0]|0)-(r[e+a|0]|0)|0}}function c(t,e,n){t|=0;e|=0;n|=0;var a=0;a=o(i,i)|0;while((a|0)>0){a=a-1|0;r[n+a|0]=r[t+a|0]|0|(r[e+a|0]|0)|0}}function s(t){t|=0;var e=0;var n=0;n=o(i,i)|0;while((n|0)>0){n=n-1|0;e=(e|0)+(r[t+n|0]|0)|0}return e|0}function f(t,e){t|=0;e|=0;var n=0;n=o(i,i)|0;while((n|0)>0){n=n-1|0;r[t+n|0]=e}}function l(t,e){t|=0;e|=0;var n=0;var o=0;var a=0;var u=0;var c=0;var s=0;var f=0;var l=0;for(n=1;(n|0)<(i-1|0);n=n+1|0){l=l+i|0;for(o=1;(o|0)<(i-1|0);o=o+1|0){u=l-i|0;c=l+i|0;s=o-1|0;f=o+1|0;a=(r[t+u+s|0]|0)+(r[t+u+f|0]|0)+(r[t+l+o|0]|0)+(r[t+c+s|0]|0)+(r[t+c+f|0]|0)|0;if((a|0)>(0|0)){r[e+l+o|0]=1}else{r[e+l+o|0]=0}}}}function h(t,e){t|=0;e|=0;var n=0;n=o(i,i)|0;while((n|0)>0){n=n-1|0;r[e+n|0]=r[t+n|0]|0}}function d(t){t|=0;var e=0;var n=0;for(e=0;(e|0)<(i-1|0);e=e+1|0){r[t+e|0]=0;r[t+n|0]=0;n=n+i-1|0;r[t+n|0]=0;n=n+1|0}for(e=0;(e|0)<(i|0);e=e+1|0){r[t+n|0]=0;n=n+1|0}}function p(){var t=0;var e=0;var n=0;var r=0;var p=0;var v=0;e=o(i,i)|0;n=e+e|0;r=n+e|0;f(r,0);d(t);do{a(t,e);l(e,n);u(t,n,n);c(r,n,r);h(e,t);p=s(t)|0;v=(p|0)==0|0}while(!v)}return{skeletonize:p}}},function(t,e,n){"use strict";(function(e,r){var i=n(162),o=n(29),a=n(165).GifReader,u=(n(166),n(172),n(187));function c(t,e){var n;try{n=new a(t)}catch(t){return void e(t)}if(n.numFrames()>0){var r=[n.numFrames(),n.height,n.width,4],i=new Uint8Array(r[0]*r[1]*r[2]*r[3]),u=o(i,r);try{for(var c=0;c<n.numFrames();++c)n.decodeAndBlitFrameRGBA(c,i.subarray(u.index(c,0,0,0),u.index(c+1,0,0,0)))}catch(t){return void e(t)}e(null,u.transpose(0,2,1))}else{r=[n.height,n.width,4],i=new Uint8Array(r[0]*r[1]*r[2]),u=o(i,r);try{n.decodeAndBlitFrameRGBA(0,i)}catch(t){return void e(t)}e(null,u.transpose(1,0))}}function s(t,n){e.nextTick((function(){try{var e=u(t);e?c(function(t){if(void 0===t[0]){for(var e=t.length,n=new Uint8Array(e),r=0;r<e;++r)n[r]=t.get(r);return n}return new Uint8Array(t)}(e),n):n(new Error("Error parsing data URI"))}catch(t){n(t)}}))}t.exports=function(t,e,n){n||(n=e,e="");var a=i.extname(t);switch(e||a.toUpperCase()){case".GIF":!function(t,e){var n=new XMLHttpRequest;n.open("GET",t,!0),n.responseType="arraybuffer",n.overrideMimeType&&n.overrideMimeType("application/binary"),n.onerror=function(t){e(t)},n.onload=function(){4===n.readyState&&c(new Uint8Array(n.response),e)},n.send()}(t,n);break;default:r.isBuffer(t)&&(t="data:"+e+";base64,"+t.toString("base64")),0===t.indexOf("data:image/gif;")?s(t,n):function(t,e){var n=new Image;n.crossOrigin="Anonymous",n.onload=function(){var t=document.createElement("canvas");t.width=n.width,t.height=n.height;var r=t.getContext("2d");r.drawImage(n,0,0);var i=r.getImageData(0,0,n.width,n.height);e(null,o(new Uint8Array(i.data),[n.width,n.height,4],[4,4*n.width,1],0))},n.onerror=function(t){e(t)},n.src=t}(t,n)}}}).call(this,n(13),n(21).Buffer)},function(t,e,n){t.exports=n(189)},function(t,e){"undefined"!=typeof window&&(window.requestAnimationFrame||(window.requestAnimationFrame=window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||window.oRequestAnimationFrame||window.msRequestAnimationFrame||function(t){window.setTimeout(t,1e3/60)})),"function"!=typeof Math.imul&&(Math.imul=function(t,e){var n=65535&t,r=65535&e;return n*r+((t>>>16&65535)*r+n*(e>>>16&65535)<<16>>>0)|0}),"function"!=typeof Object.assign&&(Object.assign=function(t){"use strict";if(null===t)throw new TypeError("Cannot convert undefined or null to object");for(var e=Object(t),n=1;n<arguments.length;n++){var r=arguments[n];if(null!==r)for(var i in r)Object.prototype.hasOwnProperty.call(r,i)&&(e[i]=r[i])}return e})},function(t,e){t.exports=function(t){if(Array.isArray(t))return t}},function(t,e){t.exports=function(t,e){if("undefined"!=typeof Symbol&&Symbol.iterator in Object(t)){var n=[],r=!0,i=!1,o=void 0;try{for(var a,u=t[Symbol.iterator]();!(r=(a=u.next()).done)&&(n.push(a.value),!e||n.length!==e);r=!0);}catch(t){i=!0,o=t}finally{try{r||null==u.return||u.return()}finally{if(i)throw o}}return n}}},function(t,e){t.exports=function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}},function(t,e){t.exports=function(t){var e=new Float32Array(2);return e[0]=t[0],e[1]=t[1],e}},function(t,e){t.exports=function(t,e){var n=new Float32Array(2);return n[0]=t,n[1]=e,n}},function(t,e){t.exports=function(t,e){return t[0]=e[0],t[1]=e[1],t}},function(t,e){t.exports=function(t,e,n){return t[0]=e,t[1]=n,t}},function(t,e,n){t.exports=function(t,e){var n=t[0],i=t[1],o=e[0],a=e[1];return Math.abs(n-o)<=r*Math.max(1,Math.abs(n),Math.abs(o))&&Math.abs(i-a)<=r*Math.max(1,Math.abs(i),Math.abs(a))};var r=n(36)},function(t,e){t.exports=function(t,e){return t[0]===e[0]&&t[1]===e[1]}},function(t,e){t.exports=function(t,e,n){return t[0]=e[0]+n[0],t[1]=e[1]+n[1],t}},function(t,e,n){t.exports=n(38)},function(t,e,n){t.exports=n(39)},function(t,e,n){t.exports=n(40)},function(t,e){t.exports=function(t,e){return t[0]=1/e[0],t[1]=1/e[1],t}},function(t,e){t.exports=function(t,e,n){return t[0]=Math.min(e[0],n[0]),t[1]=Math.min(e[1],n[1]),t}},function(t,e){t.exports=function(t,e,n){return t[0]=Math.max(e[0],n[0]),t[1]=Math.max(e[1],n[1]),t}},function(t,e){t.exports=function(t,e,n){var r=Math.cos(n),i=Math.sin(n),o=e[0],a=e[1];return t[0]=o*r-a*i,t[1]=o*i+a*r,t}},function(t,e){t.exports=function(t,e){return t[0]=Math.floor(e[0]),t[1]=Math.floor(e[1]),t}},function(t,e){t.exports=function(t,e){return t[0]=Math.ceil(e[0]),t[1]=Math.ceil(e[1]),t}},function(t,e){t.exports=function(t,e){return t[0]=Math.round(e[0]),t[1]=Math.round(e[1]),t}},function(t,e){t.exports=function(t,e,n){return t[0]=e[0]*n,t[1]=e[1]*n,t}},function(t,e){t.exports=function(t,e,n,r){return t[0]=e[0]+n[0]*r,t[1]=e[1]+n[1]*r,t}},function(t,e,n){t.exports=n(41)},function(t,e,n){t.exports=n(42)},function(t,e,n){t.exports=n(43)},function(t,e,n){t.exports=n(44)},function(t,e){t.exports=function(t,e){return t[0]=-e[0],t[1]=-e[1],t}},function(t,e){t.exports=function(t,e){var n=e[0],r=e[1],i=n*n+r*r;i>0&&(i=1/Math.sqrt(i),t[0]=e[0]*i,t[1]=e[1]*i);return t}},function(t,e){t.exports=function(t,e){return t[0]*e[0]+t[1]*e[1]}},function(t,e){t.exports=function(t,e,n){var r=e[0]*n[1]-e[1]*n[0];return t[0]=t[1]=0,t[2]=r,t}},function(t,e){t.exports=function(t,e,n,r){var i=e[0],o=e[1];return t[0]=i+r*(n[0]-i),t[1]=o+r*(n[1]-o),t}},function(t,e){t.exports=function(t,e){e=e||1;var n=2*Math.random()*Math.PI;return t[0]=Math.cos(n)*e,t[1]=Math.sin(n)*e,t}},function(t,e){t.exports=function(t,e,n){var r=e[0],i=e[1];return t[0]=n[0]*r+n[2]*i,t[1]=n[1]*r+n[3]*i,t}},function(t,e){t.exports=function(t,e,n){var r=e[0],i=e[1];return t[0]=n[0]*r+n[2]*i+n[4],t[1]=n[1]*r+n[3]*i+n[5],t}},function(t,e){t.exports=function(t,e,n){var r=e[0],i=e[1];return t[0]=n[0]*r+n[3]*i+n[6],t[1]=n[1]*r+n[4]*i+n[7],t}},function(t,e){t.exports=function(t,e,n){var r=e[0],i=e[1];return t[0]=n[0]*r+n[4]*i+n[12],t[1]=n[1]*r+n[5]*i+n[13],t}},function(t,e,n){t.exports=function(t,e,n,i,o,a){var u,c;e||(e=2);n||(n=0);c=i?Math.min(i*e+n,t.length):t.length;for(u=n;u<c;u+=e)r[0]=t[u],r[1]=t[u+1],o(r,r,a),t[u]=r[0],t[u+1]=r[1];return t};var r=n(37)()},function(t,e){t.exports=function(t,e,n){var r=e[0]*e[0]+e[1]*e[1];if(r>n*n){var i=Math.sqrt(r);t[0]=e[0]/i*n,t[1]=e[1]/i*n}else t[0]=e[0],t[1]=e[1];return t}},function(t,e){t.exports=function(t){var e=new Float32Array(3);return e[0]=t[0],e[1]=t[1],e[2]=t[2],e}},function(t,e,n){t.exports=function(t,e){var n=r(t[0],t[1],t[2]),a=r(e[0],e[1],e[2]);i(n,n),i(a,a);var u=o(n,a);return u>1?0:Math.acos(u)};var r=n(47),i=n(48),o=n(49)},function(t,e){t.exports=function(t,e){return t[0]=e[0],t[1]=e[1],t[2]=e[2],t}},function(t,e){t.exports=function(t,e,n,r){return t[0]=e,t[1]=n,t[2]=r,t}},function(t,e,n){t.exports=function(t,e){var n=t[0],i=t[1],o=t[2],a=e[0],u=e[1],c=e[2];return Math.abs(n-a)<=r*Math.max(1,Math.abs(n),Math.abs(a))&&Math.abs(i-u)<=r*Math.max(1,Math.abs(i),Math.abs(u))&&Math.abs(o-c)<=r*Math.max(1,Math.abs(o),Math.abs(c))};var r=n(45)},function(t,e){t.exports=function(t,e){return t[0]===e[0]&&t[1]===e[1]&&t[2]===e[2]}},function(t,e){t.exports=function(t,e,n){return t[0]=e[0]+n[0],t[1]=e[1]+n[1],t[2]=e[2]+n[2],t}},function(t,e,n){t.exports=n(50)},function(t,e,n){t.exports=n(51)},function(t,e,n){t.exports=n(52)},function(t,e){t.exports=function(t,e,n){return t[0]=Math.min(e[0],n[0]),t[1]=Math.min(e[1],n[1]),t[2]=Math.min(e[2],n[2]),t}},function(t,e){t.exports=function(t,e,n){return t[0]=Math.max(e[0],n[0]),t[1]=Math.max(e[1],n[1]),t[2]=Math.max(e[2],n[2]),t}},function(t,e){t.exports=function(t,e){return t[0]=Math.floor(e[0]),t[1]=Math.floor(e[1]),t[2]=Math.floor(e[2]),t}},function(t,e){t.exports=function(t,e){return t[0]=Math.ceil(e[0]),t[1]=Math.ceil(e[1]),t[2]=Math.ceil(e[2]),t}},function(t,e){t.exports=function(t,e){return t[0]=Math.round(e[0]),t[1]=Math.round(e[1]),t[2]=Math.round(e[2]),t}},function(t,e){t.exports=function(t,e,n){return t[0]=e[0]*n,t[1]=e[1]*n,t[2]=e[2]*n,t}},function(t,e){t.exports=function(t,e,n,r){return t[0]=e[0]+n[0]*r,t[1]=e[1]+n[1]*r,t[2]=e[2]+n[2]*r,t}},function(t,e,n){t.exports=n(53)},function(t,e,n){t.exports=n(54)},function(t,e,n){t.exports=n(55)},function(t,e,n){t.exports=n(56)},function(t,e){t.exports=function(t,e){return t[0]=-e[0],t[1]=-e[1],t[2]=-e[2],t}},function(t,e){t.exports=function(t,e){return t[0]=1/e[0],t[1]=1/e[1],t[2]=1/e[2],t}},function(t,e){t.exports=function(t,e,n){var r=e[0],i=e[1],o=e[2],a=n[0],u=n[1],c=n[2];return t[0]=i*c-o*u,t[1]=o*a-r*c,t[2]=r*u-i*a,t}},function(t,e){t.exports=function(t,e,n,r){var i=e[0],o=e[1],a=e[2];return t[0]=i+r*(n[0]-i),t[1]=o+r*(n[1]-o),t[2]=a+r*(n[2]-a),t}},function(t,e){t.exports=function(t,e){e=e||1;var n=2*Math.random()*Math.PI,r=2*Math.random()-1,i=Math.sqrt(1-r*r)*e;return t[0]=Math.cos(n)*i,t[1]=Math.sin(n)*i,t[2]=r*e,t}},function(t,e){t.exports=function(t,e,n){var r=e[0],i=e[1],o=e[2],a=n[3]*r+n[7]*i+n[11]*o+n[15];return a=a||1,t[0]=(n[0]*r+n[4]*i+n[8]*o+n[12])/a,t[1]=(n[1]*r+n[5]*i+n[9]*o+n[13])/a,t[2]=(n[2]*r+n[6]*i+n[10]*o+n[14])/a,t}},function(t,e){t.exports=function(t,e,n){var r=e[0],i=e[1],o=e[2];return t[0]=r*n[0]+i*n[3]+o*n[6],t[1]=r*n[1]+i*n[4]+o*n[7],t[2]=r*n[2]+i*n[5]+o*n[8],t}},function(t,e){t.exports=function(t,e,n){var r=e[0],i=e[1],o=e[2],a=n[0],u=n[1],c=n[2],s=n[3],f=s*r+u*o-c*i,l=s*i+c*r-a*o,h=s*o+a*i-u*r,d=-a*r-u*i-c*o;return t[0]=f*s+d*-a+l*-c-h*-u,t[1]=l*s+d*-u+h*-a-f*-c,t[2]=h*s+d*-c+f*-u-l*-a,t}},function(t,e){t.exports=function(t,e,n,r){var i=n[1],o=n[2],a=e[1]-i,u=e[2]-o,c=Math.sin(r),s=Math.cos(r);return t[0]=e[0],t[1]=i+a*s-u*c,t[2]=o+a*c+u*s,t}},function(t,e){t.exports=function(t,e,n,r){var i=n[0],o=n[2],a=e[0]-i,u=e[2]-o,c=Math.sin(r),s=Math.cos(r);return t[0]=i+u*c+a*s,t[1]=e[1],t[2]=o+u*s-a*c,t}},function(t,e){t.exports=function(t,e,n,r){var i=n[0],o=n[1],a=e[0]-i,u=e[1]-o,c=Math.sin(r),s=Math.cos(r);return t[0]=i+a*s-u*c,t[1]=o+a*c+u*s,t[2]=e[2],t}},function(t,e,n){t.exports=function(t,e,n,i,o,a){var u,c;e||(e=3);n||(n=0);c=i?Math.min(i*e+n,t.length):t.length;for(u=n;u<c;u+=e)r[0]=t[u],r[1]=t[u+1],r[2]=t[u+2],o(r,r,a),t[u]=r[0],t[u+1]=r[1],t[u+2]=r[2];return t};var r=n(46)()},function(t,e){function n(e,r){return t.exports=n=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t},n(e,r)}t.exports=n},function(t,e){t.exports=function(t){return t.webpackPolyfill||(t.deprecate=function(){},t.paths=[],t.children||(t.children=[]),Object.defineProperty(t,"loaded",{enumerable:!0,get:function(){return t.l}}),Object.defineProperty(t,"id",{enumerable:!0,get:function(){return t.i}}),t.webpackPolyfill=1),t}},function(t,e,n){var r=n(35);t.exports=function(t){if(Array.isArray(t))return r(t)}},function(t,e){t.exports=function(t){if("undefined"!=typeof Symbol&&Symbol.iterator in Object(t))return Array.from(t)}},function(t,e){t.exports=function(){throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}},function(t,e,n){var r=n(2);t.exports=function(t,e){for(;!Object.prototype.hasOwnProperty.call(t,e)&&null!==(t=r(t)););return t}},function(t,e,n){var r=function(t){"use strict";var e=Object.prototype,n=e.hasOwnProperty,r="function"==typeof Symbol?Symbol:{},i=r.iterator||"@@iterator",o=r.asyncIterator||"@@asyncIterator",a=r.toStringTag||"@@toStringTag";function u(t,e,n,r){var i=e&&e.prototype instanceof f?e:f,o=Object.create(i.prototype),a=new x(r||[]);return o._invoke=function(t,e,n){var r="suspendedStart";return function(i,o){if("executing"===r)throw new Error("Generator is already running");if("completed"===r){if("throw"===i)throw o;return A()}for(n.method=i,n.arg=o;;){var a=n.delegate;if(a){var u=m(a,n);if(u){if(u===s)continue;return u}}if("next"===n.method)n.sent=n._sent=n.arg;else if("throw"===n.method){if("suspendedStart"===r)throw r="completed",n.arg;n.dispatchException(n.arg)}else"return"===n.method&&n.abrupt("return",n.arg);r="executing";var f=c(t,e,n);if("normal"===f.type){if(r=n.done?"completed":"suspendedYield",f.arg===s)continue;return{value:f.arg,done:n.done}}"throw"===f.type&&(r="completed",n.method="throw",n.arg=f.arg)}}}(t,n,a),o}function c(t,e,n){try{return{type:"normal",arg:t.call(e,n)}}catch(t){return{type:"throw",arg:t}}}t.wrap=u;var s={};function f(){}function l(){}function h(){}var d={};d[i]=function(){return this};var p=Object.getPrototypeOf,v=p&&p(p(E([])));v&&v!==e&&n.call(v,i)&&(d=v);var g=h.prototype=f.prototype=Object.create(d);function y(t){["next","throw","return"].forEach((function(e){t[e]=function(t){return this._invoke(e,t)}}))}function _(t,e){var r;this._invoke=function(i,o){function a(){return new e((function(r,a){!function r(i,o,a,u){var s=c(t[i],t,o);if("throw"!==s.type){var f=s.arg,l=f.value;return l&&"object"==typeof l&&n.call(l,"__await")?e.resolve(l.__await).then((function(t){r("next",t,a,u)}),(function(t){r("throw",t,a,u)})):e.resolve(l).then((function(t){f.value=t,a(f)}),(function(t){return r("throw",t,a,u)}))}u(s.arg)}(i,o,r,a)}))}return r=r?r.then(a,a):a()}}function m(t,e){var n=t.iterator[e.method];if(void 0===n){if(e.delegate=null,"throw"===e.method){if(t.iterator.return&&(e.method="return",e.arg=void 0,m(t,e),"throw"===e.method))return s;e.method="throw",e.arg=new TypeError("The iterator does not provide a 'throw' method")}return s}var r=c(n,t.iterator,e.arg);if("throw"===r.type)return e.method="throw",e.arg=r.arg,e.delegate=null,s;var i=r.arg;return i?i.done?(e[t.resultName]=i.value,e.next=t.nextLoc,"return"!==e.method&&(e.method="next",e.arg=void 0),e.delegate=null,s):i:(e.method="throw",e.arg=new TypeError("iterator result is not an object"),e.delegate=null,s)}function b(t){var e={tryLoc:t[0]};1 in t&&(e.catchLoc=t[1]),2 in t&&(e.finallyLoc=t[2],e.afterLoc=t[3]),this.tryEntries.push(e)}function w(t){var e=t.completion||{};e.type="normal",delete e.arg,t.completion=e}function x(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(b,this),this.reset(!0)}function E(t){if(t){var e=t[i];if(e)return e.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var r=-1,o=function e(){for(;++r<t.length;)if(n.call(t,r))return e.value=t[r],e.done=!1,e;return e.value=void 0,e.done=!0,e};return o.next=o}}return{next:A}}function A(){return{value:void 0,done:!0}}return l.prototype=g.constructor=h,h.constructor=l,h[a]=l.displayName="GeneratorFunction",t.isGeneratorFunction=function(t){var e="function"==typeof t&&t.constructor;return!!e&&(e===l||"GeneratorFunction"===(e.displayName||e.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,h):(t.__proto__=h,a in t||(t[a]="GeneratorFunction")),t.prototype=Object.create(g),t},t.awrap=function(t){return{__await:t}},y(_.prototype),_.prototype[o]=function(){return this},t.AsyncIterator=_,t.async=function(e,n,r,i,o){void 0===o&&(o=Promise);var a=new _(u(e,n,r,i),o);return t.isGeneratorFunction(n)?a:a.next().then((function(t){return t.done?t.value:a.next()}))},y(g),g[a]="Generator",g[i]=function(){return this},g.toString=function(){return"[object Generator]"},t.keys=function(t){var e=[];for(var n in t)e.push(n);return e.reverse(),function n(){for(;e.length;){var r=e.pop();if(r in t)return n.value=r,n.done=!1,n}return n.done=!0,n}},t.values=E,x.prototype={constructor:x,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(w),!t)for(var e in this)"t"===e.charAt(0)&&n.call(this,e)&&!isNaN(+e.slice(1))&&(this[e]=void 0)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var e=this;function r(n,r){return a.type="throw",a.arg=t,e.next=n,r&&(e.method="next",e.arg=void 0),!!r}for(var i=this.tryEntries.length-1;i>=0;--i){var o=this.tryEntries[i],a=o.completion;if("root"===o.tryLoc)return r("end");if(o.tryLoc<=this.prev){var u=n.call(o,"catchLoc"),c=n.call(o,"finallyLoc");if(u&&c){if(this.prev<o.catchLoc)return r(o.catchLoc,!0);if(this.prev<o.finallyLoc)return r(o.finallyLoc)}else if(u){if(this.prev<o.catchLoc)return r(o.catchLoc,!0)}else{if(!c)throw new Error("try statement without catch or finally");if(this.prev<o.finallyLoc)return r(o.finallyLoc)}}}},abrupt:function(t,e){for(var r=this.tryEntries.length-1;r>=0;--r){var i=this.tryEntries[r];if(i.tryLoc<=this.prev&&n.call(i,"finallyLoc")&&this.prev<i.finallyLoc){var o=i;break}}o&&("break"===t||"continue"===t)&&o.tryLoc<=e&&e<=o.finallyLoc&&(o=null);var a=o?o.completion:{};return a.type=t,a.arg=e,o?(this.method="next",this.next=o.finallyLoc,s):this.complete(a)},complete:function(t,e){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&e&&(this.next=e),s},finish:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var n=this.tryEntries[e];if(n.finallyLoc===t)return this.complete(n.completion,n.afterLoc),w(n),s}},catch:function(t){for(var e=this.tryEntries.length-1;e>=0;--e){var n=this.tryEntries[e];if(n.tryLoc===t){var r=n.completion;if("throw"===r.type){var i=r.arg;w(n)}return i}}throw new Error("illegal catch attempt")},delegateYield:function(t,e,n){return this.delegate={iterator:E(t),resultName:e,nextLoc:n},"next"===this.method&&(this.arg=void 0),s}},t}(t.exports);try{regeneratorRuntime=r}catch(t){Function("r","regeneratorRuntime = r")(r)}},function(t,e){t.exports=function(t){return t[0]*t[3]-t[2]*t[1]}},function(t,e){t.exports=function(t,e){if(t===e){var n=e[1];t[1]=e[2],t[2]=n}else t[0]=e[0],t[1]=e[2],t[2]=e[1],t[3]=e[3];return t}},function(t,e){t.exports=function(t,e,n){var r=e[0],i=e[1],o=e[2],a=e[3],u=n[0],c=n[1],s=n[2],f=n[3];return t[0]=r*u+o*c,t[1]=i*u+a*c,t[2]=r*s+o*f,t[3]=i*s+a*f,t}},function(t,e){t.exports=function(t){return t[0]=1,t[1]=0,t[2]=0,t[3]=1,t}},function(t,e){t.exports=function(t,e){var n=e[0];return t[0]=e[3],t[1]=-e[1],t[2]=-e[2],t[3]=n,t}},function(t,e){t.exports=function(t,e,n){var r=e[0],i=e[1],o=e[2],a=e[3],u=Math.sin(n),c=Math.cos(n);return t[0]=r*c+o*u,t[1]=i*c+a*u,t[2]=r*-u+o*c,t[3]=i*-u+a*c,t}},function(t,e){t.exports=function(t,e){var n=e[0],r=e[1],i=e[2],o=e[3],a=n*o-i*r;return a?(a=1/a,t[0]=o*a,t[1]=-r*a,t[2]=-i*a,t[3]=n*a,t):null}},function(t,e){t.exports=function(){var t=new Float32Array(4);return t[0]=1,t[1]=0,t[2]=0,t[3]=1,t}},function(t,e){t.exports=function(t,e,n){var r=e[0],i=e[1],o=e[2],a=e[3],u=n[0],c=n[1];return t[0]=r*u,t[1]=i*u,t[2]=o*c,t[3]=a*c,t}},function(t,e){t.exports=function(t,e){return t[0]=e[0],t[1]=e[1],t[2]=e[2],t[3]=e[3],t}},function(t,e){t.exports=function(t){return Math.sqrt(Math.pow(t[0],2)+Math.pow(t[1],2)+Math.pow(t[2],2)+Math.pow(t[3],2))}},function(t,e){t.exports=function(t,e,n,r){return t[2]=r[2]/r[0],n[0]=r[0],n[1]=r[1],n[3]=r[3]-t[2]*n[1],[t,e,n]}},function(t,e,n){"use strict";e.byteLength=function(t){var e=s(t),n=e[0],r=e[1];return 3*(n+r)/4-r},e.toByteArray=function(t){var e,n,r=s(t),a=r[0],u=r[1],c=new o(function(t,e,n){return 3*(e+n)/4-n}(0,a,u)),f=0,l=u>0?a-4:a;for(n=0;n<l;n+=4)e=i[t.charCodeAt(n)]<<18|i[t.charCodeAt(n+1)]<<12|i[t.charCodeAt(n+2)]<<6|i[t.charCodeAt(n+3)],c[f++]=e>>16&255,c[f++]=e>>8&255,c[f++]=255&e;2===u&&(e=i[t.charCodeAt(n)]<<2|i[t.charCodeAt(n+1)]>>4,c[f++]=255&e);1===u&&(e=i[t.charCodeAt(n)]<<10|i[t.charCodeAt(n+1)]<<4|i[t.charCodeAt(n+2)]>>2,c[f++]=e>>8&255,c[f++]=255&e);return c},e.fromByteArray=function(t){for(var e,n=t.length,i=n%3,o=[],a=0,u=n-i;a<u;a+=16383)o.push(f(t,a,a+16383>u?u:a+16383));1===i?(e=t[n-1],o.push(r[e>>2]+r[e<<4&63]+"==")):2===i&&(e=(t[n-2]<<8)+t[n-1],o.push(r[e>>10]+r[e>>4&63]+r[e<<2&63]+"="));return o.join("")};for(var r=[],i=[],o="undefined"!=typeof Uint8Array?Uint8Array:Array,a="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/",u=0,c=a.length;u<c;++u)r[u]=a[u],i[a.charCodeAt(u)]=u;function s(t){var e=t.length;if(e%4>0)throw new Error("Invalid string. Length must be a multiple of 4");var n=t.indexOf("=");return-1===n&&(n=e),[n,n===e?0:4-n%4]}function f(t,e,n){for(var i,o,a=[],u=e;u<n;u+=3)i=(t[u]<<16&16711680)+(t[u+1]<<8&65280)+(255&t[u+2]),a.push(r[(o=i)>>18&63]+r[o>>12&63]+r[o>>6&63]+r[63&o]);return a.join("")}i["-".charCodeAt(0)]=62,i["_".charCodeAt(0)]=63},function(t,e){e.read=function(t,e,n,r,i){var o,a,u=8*i-r-1,c=(1<<u)-1,s=c>>1,f=-7,l=n?i-1:0,h=n?-1:1,d=t[e+l];for(l+=h,o=d&(1<<-f)-1,d>>=-f,f+=u;f>0;o=256*o+t[e+l],l+=h,f-=8);for(a=o&(1<<-f)-1,o>>=-f,f+=r;f>0;a=256*a+t[e+l],l+=h,f-=8);if(0===o)o=1-s;else{if(o===c)return a?NaN:1/0*(d?-1:1);a+=Math.pow(2,r),o-=s}return(d?-1:1)*a*Math.pow(2,o-r)},e.write=function(t,e,n,r,i,o){var a,u,c,s=8*o-i-1,f=(1<<s)-1,l=f>>1,h=23===i?Math.pow(2,-24)-Math.pow(2,-77):0,d=r?0:o-1,p=r?1:-1,v=e<0||0===e&&1/e<0?1:0;for(e=Math.abs(e),isNaN(e)||e===1/0?(u=isNaN(e)?1:0,a=f):(a=Math.floor(Math.log(e)/Math.LN2),e*(c=Math.pow(2,-a))<1&&(a--,c*=2),(e+=a+l>=1?h/c:h*Math.pow(2,1-l))*c>=2&&(a++,c/=2),a+l>=f?(u=0,a=f):a+l>=1?(u=(e*c-1)*Math.pow(2,i),a+=l):(u=e*Math.pow(2,l-1)*Math.pow(2,i),a=0));i>=8;t[n+d]=255&u,d+=p,u/=256,i-=8);for(a=a<<i|u,s+=i;s>0;t[n+d]=255&a,d+=p,a/=256,s-=8);t[n+d-p]|=128*v}},function(t,e){var n={}.toString;t.exports=Array.isArray||function(t){return"[object Array]"==n.call(t)}},function(t,e,n){(function(t){function n(t,e){for(var n=0,r=t.length-1;r>=0;r--){var i=t[r];"."===i?t.splice(r,1):".."===i?(t.splice(r,1),n++):n&&(t.splice(r,1),n--)}if(e)for(;n--;n)t.unshift("..");return t}function r(t,e){if(t.filter)return t.filter(e);for(var n=[],r=0;r<t.length;r++)e(t[r],r,t)&&n.push(t[r]);return n}e.resolve=function(){for(var e="",i=!1,o=arguments.length-1;o>=-1&&!i;o--){var a=o>=0?arguments[o]:t.cwd();if("string"!=typeof a)throw new TypeError("Arguments to path.resolve must be strings");a&&(e=a+"/"+e,i="/"===a.charAt(0))}return(i?"/":"")+(e=n(r(e.split("/"),(function(t){return!!t})),!i).join("/"))||"."},e.normalize=function(t){var o=e.isAbsolute(t),a="/"===i(t,-1);return(t=n(r(t.split("/"),(function(t){return!!t})),!o).join("/"))||o||(t="."),t&&a&&(t+="/"),(o?"/":"")+t},e.isAbsolute=function(t){return"/"===t.charAt(0)},e.join=function(){var t=Array.prototype.slice.call(arguments,0);return e.normalize(r(t,(function(t,e){if("string"!=typeof t)throw new TypeError("Arguments to path.join must be strings");return t})).join("/"))},e.relative=function(t,n){function r(t){for(var e=0;e<t.length&&""===t[e];e++);for(var n=t.length-1;n>=0&&""===t[n];n--);return e>n?[]:t.slice(e,n-e+1)}t=e.resolve(t).substr(1),n=e.resolve(n).substr(1);for(var i=r(t.split("/")),o=r(n.split("/")),a=Math.min(i.length,o.length),u=a,c=0;c<a;c++)if(i[c]!==o[c]){u=c;break}var s=[];for(c=u;c<i.length;c++)s.push("..");return(s=s.concat(o.slice(u))).join("/")},e.sep="/",e.delimiter=":",e.dirname=function(t){if("string"!=typeof t&&(t+=""),0===t.length)return".";for(var e=t.charCodeAt(0),n=47===e,r=-1,i=!0,o=t.length-1;o>=1;--o)if(47===(e=t.charCodeAt(o))){if(!i){r=o;break}}else i=!1;return-1===r?n?"/":".":n&&1===r?"/":t.slice(0,r)},e.basename=function(t,e){var n=function(t){"string"!=typeof t&&(t+="");var e,n=0,r=-1,i=!0;for(e=t.length-1;e>=0;--e)if(47===t.charCodeAt(e)){if(!i){n=e+1;break}}else-1===r&&(i=!1,r=e+1);return-1===r?"":t.slice(n,r)}(t);return e&&n.substr(-1*e.length)===e&&(n=n.substr(0,n.length-e.length)),n},e.extname=function(t){"string"!=typeof t&&(t+="");for(var e=-1,n=0,r=-1,i=!0,o=0,a=t.length-1;a>=0;--a){var u=t.charCodeAt(a);if(47!==u)-1===r&&(i=!1,r=a+1),46===u?-1===e?e=a:1!==o&&(o=1):-1!==e&&(o=-1);else if(!i){n=a+1;break}}return-1===e||-1===r||0===o||1===o&&e===r-1&&e===n+1?"":t.slice(e,r)};var i="b"==="ab".substr(-1)?function(t,e,n){return t.substr(e,n)}:function(t,e,n){return e<0&&(e=t.length+e),t.substr(e,n)}}).call(this,n(13))},function(t,e,n){"use strict";t.exports=function(t){for(var e=new Array(t),n=0;n<t;++n)e[n]=n;return e}},function(t,e){function n(t){return!!t.constructor&&"function"==typeof t.constructor.isBuffer&&t.constructor.isBuffer(t)}
/*!
 * Determine if an object is a Buffer
 *
 * @author   Feross Aboukhadijeh <https://feross.org>
 * @license  MIT
 */
t.exports=function(t){return null!=t&&(n(t)||function(t){return"function"==typeof t.readFloatLE&&"function"==typeof t.slice&&n(t.slice(0,0))}(t)||!!t._isBuffer)}},function(t,e,n){"use strict";function r(t,e,n,r){for(var i=t[e++],o=1<<i,a=o+1,u=a+1,c=i+1,s=(1<<c)-1,f=0,l=0,h=0,d=t[e++],p=new Int32Array(4096),v=null;;){for(;f<16&&0!==d;)l|=t[e++]<<f,f+=8,1===d?d=t[e++]:--d;if(f<c)break;var g=l&s;if(l>>=c,f-=c,g!==o){if(g===a)break;for(var y=g<u?g:v,_=0,m=y;m>o;)m=p[m]>>8,++_;var b=m;if(h+_+(y!==g?1:0)>r)return void console.log("Warning, gif stream longer than expected.");n[h++]=b;var w=h+=_;for(y!==g&&(n[h++]=b),m=y;_--;)m=p[m],n[--w]=255&m,m>>=8;null!==v&&u<4096&&(p[u++]=v<<8|b,u>=s+1&&c<12&&(++c,s=s<<1|1)),v=g}else u=a+1,s=(1<<(c=i+1))-1,v=null}return h!==r&&console.log("Warning, gif stream shorter than expected."),n}try{e.GifWriter=function(t,e,n,r){var i=0,o=void 0===(r=void 0===r?{}:r).loop?null:r.loop,a=void 0===r.palette?null:r.palette;if(e<=0||n<=0||e>65535||n>65535)throw new Error("Width/Height invalid.");function u(t){var e=t.length;if(e<2||e>256||e&e-1)throw new Error("Invalid code/color length, must be power of 2 and 2 .. 256.");return e}t[i++]=71,t[i++]=73,t[i++]=70,t[i++]=56,t[i++]=57,t[i++]=97;var c=0,s=0;if(null!==a){for(var f=u(a);f>>=1;)++c;if(f=1<<c,--c,void 0!==r.background){if((s=r.background)>=f)throw new Error("Background index out of range.");if(0===s)throw new Error("Background index explicitly passed as 0.")}}if(t[i++]=255&e,t[i++]=e>>8&255,t[i++]=255&n,t[i++]=n>>8&255,t[i++]=(null!==a?128:0)|c,t[i++]=s,t[i++]=0,null!==a)for(var l=0,h=a.length;l<h;++l){var d=a[l];t[i++]=d>>16&255,t[i++]=d>>8&255,t[i++]=255&d}if(null!==o){if(o<0||o>65535)throw new Error("Loop count invalid.");t[i++]=33,t[i++]=255,t[i++]=11,t[i++]=78,t[i++]=69,t[i++]=84,t[i++]=83,t[i++]=67,t[i++]=65,t[i++]=80,t[i++]=69,t[i++]=50,t[i++]=46,t[i++]=48,t[i++]=3,t[i++]=1,t[i++]=255&o,t[i++]=o>>8&255,t[i++]=0}var p=!1;this.addFrame=function(e,n,r,o,c,s){if(!0===p&&(--i,p=!1),s=void 0===s?{}:s,e<0||n<0||e>65535||n>65535)throw new Error("x/y invalid.");if(r<=0||o<=0||r>65535||o>65535)throw new Error("Width/Height invalid.");if(c.length<r*o)throw new Error("Not enough pixels for the frame size.");var f=!0,l=s.palette;if(null==l&&(f=!1,l=a),null==l)throw new Error("Must supply either a local or global palette.");for(var h=u(l),d=0;h>>=1;)++d;h=1<<d;var v=void 0===s.delay?0:s.delay,g=void 0===s.disposal?0:s.disposal;if(g<0||g>3)throw new Error("Disposal out of range.");var y=!1,_=0;if(void 0!==s.transparent&&null!==s.transparent&&(y=!0,(_=s.transparent)<0||_>=h))throw new Error("Transparent color index.");if((0!==g||y||0!==v)&&(t[i++]=33,t[i++]=249,t[i++]=4,t[i++]=g<<2|(!0===y?1:0),t[i++]=255&v,t[i++]=v>>8&255,t[i++]=_,t[i++]=0),t[i++]=44,t[i++]=255&e,t[i++]=e>>8&255,t[i++]=255&n,t[i++]=n>>8&255,t[i++]=255&r,t[i++]=r>>8&255,t[i++]=255&o,t[i++]=o>>8&255,t[i++]=!0===f?128|d-1:0,!0===f)for(var m=0,b=l.length;m<b;++m){var w=l[m];t[i++]=w>>16&255,t[i++]=w>>8&255,t[i++]=255&w}return i=function(t,e,n,r){t[e++]=n;var i=e++,o=1<<n,a=o-1,u=o+1,c=u+1,s=n+1,f=0,l=0;function h(n){for(;f>=n;)t[e++]=255&l,l>>=8,f-=8,e===i+256&&(t[i]=255,i=e++)}function d(t){l|=t<<f,f+=s,h(8)}var p=r[0]&a,v={};d(o);for(var g=1,y=r.length;g<y;++g){var _=r[g]&a,m=p<<8|_,b=v[m];if(void 0===b){for(l|=p<<f,f+=s;f>=8;)t[e++]=255&l,l>>=8,f-=8,e===i+256&&(t[i]=255,i=e++);4096===c?(d(o),c=u+1,s=n+1,v={}):(c>=1<<s&&++s,v[m]=c++),p=_}else p=b}d(p),d(u),h(1),i+1===e?t[i]=0:(t[i]=e-i-1,t[e++]=0);return e}(t,i,d<2?2:d,c)},this.end=function(){return!1===p&&(t[i++]=59,p=!0),i},this.getOutputBuffer=function(){return t},this.setOutputBuffer=function(e){t=e},this.getOutputBufferPosition=function(){return i},this.setOutputBufferPosition=function(t){i=t}},e.GifReader=function(t){var e=0;if(71!==t[e++]||73!==t[e++]||70!==t[e++]||56!==t[e++]||56!=(t[e++]+1&253)||97!==t[e++])throw new Error("Invalid GIF 87a/89a header.");var n=t[e++]|t[e++]<<8,i=t[e++]|t[e++]<<8,o=t[e++],a=o>>7,u=1<<(7&o)+1;t[e++],t[e++];var c=null,s=null;a&&(c=e,s=u,e+=3*u);var f=!0,l=[],h=0,d=null,p=0,v=null;for(this.width=n,this.height=i;f&&e<t.length;)switch(t[e++]){case 33:switch(t[e++]){case 255:if(11!==t[e]||78==t[e+1]&&69==t[e+2]&&84==t[e+3]&&83==t[e+4]&&67==t[e+5]&&65==t[e+6]&&80==t[e+7]&&69==t[e+8]&&50==t[e+9]&&46==t[e+10]&&48==t[e+11]&&3==t[e+12]&&1==t[e+13]&&0==t[e+16])e+=14,v=t[e++]|t[e++]<<8,e++;else for(e+=12;;){if(!((k=t[e++])>=0))throw Error("Invalid block size");if(0===k)break;e+=k}break;case 249:if(4!==t[e++]||0!==t[e+4])throw new Error("Invalid graphics extension block.");var g=t[e++];h=t[e++]|t[e++]<<8,d=t[e++],0==(1&g)&&(d=null),p=g>>2&7,e++;break;case 254:for(;;){if(!((k=t[e++])>=0))throw Error("Invalid block size");if(0===k)break;e+=k}break;default:throw new Error("Unknown graphic control label: 0x"+t[e-1].toString(16))}break;case 44:var y=t[e++]|t[e++]<<8,_=t[e++]|t[e++]<<8,m=t[e++]|t[e++]<<8,b=t[e++]|t[e++]<<8,w=t[e++],x=w>>6&1,E=1<<(7&w)+1,A=c,R=s,S=!1;if(w>>7){S=!0;A=e,R=E,e+=3*E}var O=e;for(e++;;){var k;if(!((k=t[e++])>=0))throw Error("Invalid block size");if(0===k)break;e+=k}l.push({x:y,y:_,width:m,height:b,has_local_palette:S,palette_offset:A,palette_size:R,data_offset:O,data_length:e-O,transparent_index:d,interlaced:!!x,delay:h,disposal:p});break;case 59:f=!1;break;default:throw new Error("Unknown gif block: 0x"+t[e-1].toString(16))}this.numFrames=function(){return l.length},this.loopCount=function(){return v},this.frameInfo=function(t){if(t<0||t>=l.length)throw new Error("Frame index out of range.");return l[t]},this.decodeAndBlitFrameBGRA=function(e,i){var o=this.frameInfo(e),a=o.width*o.height,u=new Uint8Array(a);r(t,o.data_offset,u,a);var c=o.palette_offset,s=o.transparent_index;null===s&&(s=256);var f=o.width,l=n-f,h=f,d=4*(o.y*n+o.x),p=4*((o.y+o.height)*n+o.x),v=d,g=4*l;!0===o.interlaced&&(g+=4*n*7);for(var y=8,_=0,m=u.length;_<m;++_){var b=u[_];if(0===h&&(h=f,(v+=g)>=p&&(g=4*l+4*n*(y-1),v=d+(f+l)*(y<<1),y>>=1)),b===s)v+=4;else{var w=t[c+3*b],x=t[c+3*b+1],E=t[c+3*b+2];i[v++]=E,i[v++]=x,i[v++]=w,i[v++]=255}--h}},this.decodeAndBlitFrameRGBA=function(e,i){var o=this.frameInfo(e),a=o.width*o.height,u=new Uint8Array(a);r(t,o.data_offset,u,a);var c=o.palette_offset,s=o.transparent_index;null===s&&(s=256);var f=o.width,l=n-f,h=f,d=4*(o.y*n+o.x),p=4*((o.y+o.height)*n+o.x),v=d,g=4*l;!0===o.interlaced&&(g+=4*n*7);for(var y=8,_=0,m=u.length;_<m;++_){var b=u[_];if(0===h&&(h=f,(v+=g)>=p&&(g=4*l+4*n*(y-1),v=d+(f+l)*(y<<1),y>>=1)),b===s)v+=4;else{var w=t[c+3*b],x=t[c+3*b+1],E=t[c+3*b+2];i[v++]=w,i[v++]=x,i[v++]=E,i[v++]=255}--h}}}}catch(t){}},function(t,e,n){"use strict";var r=n(29),i=n(167);t.exports=function(t,e){for(var n=[],o=t,a=1;Array.isArray(o);)n.push(o.length),a*=o.length,o=o[0];return 0===n.length?r():(e||(e=r(new Float64Array(a),n)),i(e,t),e)}},function(t,e,n){t.exports=n(168)({args:["array","scalar","index"],pre:{body:"{}",args:[],thisVars:[],localVars:[]},body:{body:"{\nvar _inline_1_v=_inline_1_arg1_,_inline_1_i\nfor(_inline_1_i=0;_inline_1_i<_inline_1_arg2_.length-1;++_inline_1_i) {\n_inline_1_v=_inline_1_v[_inline_1_arg2_[_inline_1_i]]\n}\n_inline_1_arg0_=_inline_1_v[_inline_1_arg2_[_inline_1_arg2_.length-1]]\n}",args:[{name:"_inline_1_arg0_",lvalue:!0,rvalue:!1,count:1},{name:"_inline_1_arg1_",lvalue:!1,rvalue:!0,count:1},{name:"_inline_1_arg2_",lvalue:!1,rvalue:!0,count:4}],thisVars:[],localVars:["_inline_1_i","_inline_1_v"]},post:{body:"{}",args:[],thisVars:[],localVars:[]},funcName:"convert",blockSize:64})},function(t,e,n){"use strict";var r=n(169);function i(){this.argTypes=[],this.shimArgs=[],this.arrayArgs=[],this.arrayBlockIndices=[],this.scalarArgs=[],this.offsetArgs=[],this.offsetArgIndex=[],this.indexArgs=[],this.shapeArgs=[],this.funcName="",this.pre=null,this.body=null,this.post=null,this.debug=!1}t.exports=function(t){var e=new i;e.pre=t.pre,e.body=t.body,e.post=t.post;var n=t.args.slice(0);e.argTypes=n;for(var o=0;o<n.length;++o){var a=n[o];if("array"===a||"object"==typeof a&&a.blockIndices){if(e.argTypes[o]="array",e.arrayArgs.push(o),e.arrayBlockIndices.push(a.blockIndices?a.blockIndices:0),e.shimArgs.push("array"+o),o<e.pre.args.length&&e.pre.args[o].count>0)throw new Error("cwise: pre() block may not reference array args");if(o<e.post.args.length&&e.post.args[o].count>0)throw new Error("cwise: post() block may not reference array args")}else if("scalar"===a)e.scalarArgs.push(o),e.shimArgs.push("scalar"+o);else if("index"===a){if(e.indexArgs.push(o),o<e.pre.args.length&&e.pre.args[o].count>0)throw new Error("cwise: pre() block may not reference array index");if(o<e.body.args.length&&e.body.args[o].lvalue)throw new Error("cwise: body() block may not write to array index");if(o<e.post.args.length&&e.post.args[o].count>0)throw new Error("cwise: post() block may not reference array index")}else if("shape"===a){if(e.shapeArgs.push(o),o<e.pre.args.length&&e.pre.args[o].lvalue)throw new Error("cwise: pre() block may not write to array shape");if(o<e.body.args.length&&e.body.args[o].lvalue)throw new Error("cwise: body() block may not write to array shape");if(o<e.post.args.length&&e.post.args[o].lvalue)throw new Error("cwise: post() block may not write to array shape")}else{if("object"!=typeof a||!a.offset)throw new Error("cwise: Unknown argument type "+n[o]);e.argTypes[o]="offset",e.offsetArgs.push({array:a.array,offset:a.offset}),e.offsetArgIndex.push(o)}}if(e.arrayArgs.length<=0)throw new Error("cwise: No array arguments specified");if(e.pre.args.length>n.length)throw new Error("cwise: Too many arguments in pre() block");if(e.body.args.length>n.length)throw new Error("cwise: Too many arguments in body() block");if(e.post.args.length>n.length)throw new Error("cwise: Too many arguments in post() block");return e.debug=!!t.printCode||!!t.debug,e.funcName=t.funcName||"cwise",e.blockSize=t.blockSize||64,r(e)}},function(t,e,n){"use strict";var r=n(170);t.exports=function(t){var e=["'use strict'","var CACHED={}"],n=[],i=t.funcName+"_cwise_thunk";e.push(["return function ",i,"(",t.shimArgs.join(","),"){"].join(""));for(var o=[],a=[],u=[["array",t.arrayArgs[0],".shape.slice(",Math.max(0,t.arrayBlockIndices[0]),t.arrayBlockIndices[0]<0?","+t.arrayBlockIndices[0]+")":")"].join("")],c=[],s=[],f=0;f<t.arrayArgs.length;++f){var l=t.arrayArgs[f];n.push(["t",l,"=array",l,".dtype,","r",l,"=array",l,".order"].join("")),o.push("t"+l),o.push("r"+l),a.push("t"+l),a.push("r"+l+".join()"),u.push("array"+l+".data"),u.push("array"+l+".stride"),u.push("array"+l+".offset|0"),f>0&&(c.push("array"+t.arrayArgs[0]+".shape.length===array"+l+".shape.length+"+(Math.abs(t.arrayBlockIndices[0])-Math.abs(t.arrayBlockIndices[f]))),s.push("array"+t.arrayArgs[0]+".shape[shapeIndex+"+Math.max(0,t.arrayBlockIndices[0])+"]===array"+l+".shape[shapeIndex+"+Math.max(0,t.arrayBlockIndices[f])+"]"))}for(t.arrayArgs.length>1&&(e.push("if (!("+c.join(" && ")+")) throw new Error('cwise: Arrays do not all have the same dimensionality!')"),e.push("for(var shapeIndex=array"+t.arrayArgs[0]+".shape.length-"+Math.abs(t.arrayBlockIndices[0])+"; shapeIndex--\x3e0;) {"),e.push("if (!("+s.join(" && ")+")) throw new Error('cwise: Arrays do not all have the same shape!')"),e.push("}")),f=0;f<t.scalarArgs.length;++f)u.push("scalar"+t.scalarArgs[f]);return n.push(["type=[",a.join(","),"].join()"].join("")),n.push("proc=CACHED[type]"),e.push("var "+n.join(",")),e.push(["if(!proc){","CACHED[type]=proc=compile([",o.join(","),"])}","return proc(",u.join(","),")}"].join("")),t.debug&&console.log("-----Generated thunk:\n"+e.join("\n")+"\n----------"),new Function("compile",e.join("\n"))(r.bind(void 0,t))}},function(t,e,n){"use strict";var r=n(171);function i(t,e,n){var r,i,o=t.length,a=e.arrayArgs.length,u=e.indexArgs.length>0,c=[],s=[],f=0,l=0;for(r=0;r<o;++r)s.push(["i",r,"=0"].join(""));for(i=0;i<a;++i)for(r=0;r<o;++r)l=f,f=t[r],0===r?s.push(["d",i,"s",r,"=t",i,"p",f].join("")):s.push(["d",i,"s",r,"=(t",i,"p",f,"-s",l,"*t",i,"p",l,")"].join(""));for(s.length>0&&c.push("var "+s.join(",")),r=o-1;r>=0;--r)f=t[r],c.push(["for(i",r,"=0;i",r,"<s",f,";++i",r,"){"].join(""));for(c.push(n),r=0;r<o;++r){for(l=f,f=t[r],i=0;i<a;++i)c.push(["p",i,"+=d",i,"s",r].join(""));u&&(r>0&&c.push(["index[",l,"]-=s",l].join("")),c.push(["++index[",f,"]"].join(""))),c.push("}")}return c.join("\n")}function o(t,e,n){for(var r=t.body,i=[],o=[],a=0;a<t.args.length;++a){var u=t.args[a];if(!(u.count<=0)){var c=new RegExp(u.name,"g"),s="",f=e.arrayArgs.indexOf(a);switch(e.argTypes[a]){case"offset":var l=e.offsetArgIndex.indexOf(a);f=e.offsetArgs[l].array,s="+q"+l;case"array":s="p"+f+s;var h="l"+a,d="a"+f;if(0===e.arrayBlockIndices[f])1===u.count?"generic"===n[f]?u.lvalue?(i.push(["var ",h,"=",d,".get(",s,")"].join("")),r=r.replace(c,h),o.push([d,".set(",s,",",h,")"].join(""))):r=r.replace(c,[d,".get(",s,")"].join("")):r=r.replace(c,[d,"[",s,"]"].join("")):"generic"===n[f]?(i.push(["var ",h,"=",d,".get(",s,")"].join("")),r=r.replace(c,h),u.lvalue&&o.push([d,".set(",s,",",h,")"].join(""))):(i.push(["var ",h,"=",d,"[",s,"]"].join("")),r=r.replace(c,h),u.lvalue&&o.push([d,"[",s,"]=",h].join("")));else{for(var p=[u.name],v=[s],g=0;g<Math.abs(e.arrayBlockIndices[f]);g++)p.push("\\s*\\[([^\\]]+)\\]"),v.push("$"+(g+1)+"*t"+f+"b"+g);if(c=new RegExp(p.join(""),"g"),s=v.join("+"),"generic"===n[f])throw new Error("cwise: Generic arrays not supported in combination with blocks!");r=r.replace(c,[d,"[",s,"]"].join(""))}break;case"scalar":r=r.replace(c,"Y"+e.scalarArgs.indexOf(a));break;case"index":r=r.replace(c,"index");break;case"shape":r=r.replace(c,"shape")}}}return[i.join("\n"),r,o.join("\n")].join("\n").trim()}function a(t){for(var e=new Array(t.length),n=!0,r=0;r<t.length;++r){var i=t[r],o=i.match(/\d+/);o=o?o[0]:"",0===i.charAt(0)?e[r]="u"+i.charAt(1)+o:e[r]=i.charAt(0)+o,r>0&&(n=n&&e[r]===e[r-1])}return n?e[0]:e.join("")}t.exports=function(t,e){for(var n=e[1].length-Math.abs(t.arrayBlockIndices[0])|0,u=new Array(t.arrayArgs.length),c=new Array(t.arrayArgs.length),s=0;s<t.arrayArgs.length;++s)c[s]=e[2*s],u[s]=e[2*s+1];var f=[],l=[],h=[],d=[],p=[];for(s=0;s<t.arrayArgs.length;++s){t.arrayBlockIndices[s]<0?(h.push(0),d.push(n),f.push(n),l.push(n+t.arrayBlockIndices[s])):(h.push(t.arrayBlockIndices[s]),d.push(t.arrayBlockIndices[s]+n),f.push(0),l.push(t.arrayBlockIndices[s]));for(var v=[],g=0;g<u[s].length;g++)h[s]<=u[s][g]&&u[s][g]<d[s]&&v.push(u[s][g]-h[s]);p.push(v)}var y=["SS"],_=["'use strict'"],m=[];for(g=0;g<n;++g)m.push(["s",g,"=SS[",g,"]"].join(""));for(s=0;s<t.arrayArgs.length;++s){y.push("a"+s),y.push("t"+s),y.push("p"+s);for(g=0;g<n;++g)m.push(["t",s,"p",g,"=t",s,"[",h[s]+g,"]"].join(""));for(g=0;g<Math.abs(t.arrayBlockIndices[s]);++g)m.push(["t",s,"b",g,"=t",s,"[",f[s]+g,"]"].join(""))}for(s=0;s<t.scalarArgs.length;++s)y.push("Y"+s);if(t.shapeArgs.length>0&&m.push("shape=SS.slice(0)"),t.indexArgs.length>0){var b=new Array(n);for(s=0;s<n;++s)b[s]="0";m.push(["index=[",b.join(","),"]"].join(""))}for(s=0;s<t.offsetArgs.length;++s){var w=t.offsetArgs[s],x=[];for(g=0;g<w.offset.length;++g)0!==w.offset[g]&&(1===w.offset[g]?x.push(["t",w.array,"p",g].join("")):x.push([w.offset[g],"*t",w.array,"p",g].join("")));0===x.length?m.push("q"+s+"=0"):m.push(["q",s,"=",x.join("+")].join(""))}var E=r([].concat(t.pre.thisVars).concat(t.body.thisVars).concat(t.post.thisVars));for((m=m.concat(E)).length>0&&_.push("var "+m.join(",")),s=0;s<t.arrayArgs.length;++s)_.push("p"+s+"|=0");t.pre.body.length>3&&_.push(o(t.pre,t,c));var A=o(t.body,t,c),R=function(t){for(var e=0,n=t[0].length;e<n;){for(var r=1;r<t.length;++r)if(t[r][e]!==t[0][e])return e;++e}return e}(p);R<n?_.push(function(t,e,n,r){for(var o=e.length,a=n.arrayArgs.length,u=n.blockSize,c=n.indexArgs.length>0,s=[],f=0;f<a;++f)s.push(["var offset",f,"=p",f].join(""));for(f=t;f<o;++f)s.push(["for(var j"+f+"=SS[",e[f],"]|0;j",f,">0;){"].join("")),s.push(["if(j",f,"<",u,"){"].join("")),s.push(["s",e[f],"=j",f].join("")),s.push(["j",f,"=0"].join("")),s.push(["}else{s",e[f],"=",u].join("")),s.push(["j",f,"-=",u,"}"].join("")),c&&s.push(["index[",e[f],"]=j",f].join(""));for(f=0;f<a;++f){for(var l=["offset"+f],h=t;h<o;++h)l.push(["j",h,"*t",f,"p",e[h]].join(""));s.push(["p",f,"=(",l.join("+"),")"].join(""))}for(s.push(i(e,n,r)),f=t;f<o;++f)s.push("}");return s.join("\n")}(R,p[0],t,A)):_.push(i(p[0],t,A)),t.post.body.length>3&&_.push(o(t.post,t,c)),t.debug&&console.log("-----Generated cwise routine for ",e,":\n"+_.join("\n")+"\n----------");var S=[t.funcName||"unnamed","_cwise_loop_",u[0].join("s"),"m",R,a(c)].join("");return new Function(["function ",S,"(",y.join(","),"){",_.join("\n"),"} return ",S].join(""))()}},function(t,e,n){"use strict";t.exports=function(t,e,n){return 0===t.length?t:e?(n||t.sort(e),function(t,e){for(var n=1,r=t.length,i=t[0],o=t[0],a=1;a<r;++a)if(o=i,e(i=t[a],o)){if(a===n){n++;continue}t[n++]=i}return t.length=n,t}(t,e)):(n||t.sort(),function(t){for(var e=1,n=t.length,r=t[0],i=t[0],o=1;o<n;++o,i=r)if(i=r,(r=t[o])!==i){if(o===e){e++;continue}t[e++]=r}return t.length=e,t}(t))}},function(t,e,n){(function(e){var r=n(173);function i(t,n,i){t=t||function(t){this.queue(t)},n=n||function(){this.queue(null)};var o=!1,a=!1,u=[],c=!1,s=new r;function f(){for(;u.length&&!s.paused;){var t=u.shift();if(null===t)return s.emit("end");s.emit("data",t)}}function l(){s.writable=!1,n.call(s),!s.readable&&s.autoDestroy&&s.destroy()}return s.readable=s.writable=!0,s.paused=!1,s.autoDestroy=!(i&&!1===i.autoDestroy),s.write=function(e){return t.call(this,e),!s.paused},s.queue=s.push=function(t){return c||(null===t&&(c=!0),u.push(t),f()),s},s.on("end",(function(){s.readable=!1,!s.writable&&s.autoDestroy&&e.nextTick((function(){s.destroy()}))})),s.end=function(t){if(!o)return o=!0,arguments.length&&s.write(t),l(),s},s.destroy=function(){if(!a)return a=!0,o=!0,u.length=0,s.writable=s.readable=!1,s.emit("close"),s},s.pause=function(){if(!s.paused)return s.paused=!0,s},s.resume=function(){return s.paused&&(s.paused=!1,s.emit("resume")),f(),s.paused||s.emit("drain"),s},s}t.exports=i,i.through=i}).call(this,n(13))},function(t,e,n){t.exports=i;var r=n(30).EventEmitter;function i(){r.call(this)}n(18)(i,r),i.Readable=n(31),i.Writable=n(183),i.Duplex=n(184),i.Transform=n(185),i.PassThrough=n(186),i.Stream=i,i.prototype.pipe=function(t,e){var n=this;function i(e){t.writable&&!1===t.write(e)&&n.pause&&n.pause()}function o(){n.readable&&n.resume&&n.resume()}n.on("data",i),t.on("drain",o),t._isStdio||e&&!1===e.end||(n.on("end",u),n.on("close",c));var a=!1;function u(){a||(a=!0,t.end())}function c(){a||(a=!0,"function"==typeof t.destroy&&t.destroy())}function s(t){if(f(),0===r.listenerCount(this,"error"))throw t}function f(){n.removeListener("data",i),t.removeListener("drain",o),n.removeListener("end",u),n.removeListener("close",c),n.removeListener("error",s),t.removeListener("error",s),n.removeListener("end",f),n.removeListener("close",f),t.removeListener("close",f)}return n.on("error",s),t.on("error",s),n.on("end",f),n.on("close",f),t.on("close",f),t.emit("pipe",n),t}},function(t,e){var n={}.toString;t.exports=Array.isArray||function(t){return"[object Array]"==n.call(t)}},function(t,e){},function(t,e,n){"use strict";var r=n(32).Buffer,i=n(177);t.exports=function(){function t(){!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t),this.head=null,this.tail=null,this.length=0}return t.prototype.push=function(t){var e={data:t,next:null};this.length>0?this.tail.next=e:this.head=e,this.tail=e,++this.length},t.prototype.unshift=function(t){var e={data:t,next:this.head};0===this.length&&(this.tail=e),this.head=e,++this.length},t.prototype.shift=function(){if(0!==this.length){var t=this.head.data;return 1===this.length?this.head=this.tail=null:this.head=this.head.next,--this.length,t}},t.prototype.clear=function(){this.head=this.tail=null,this.length=0},t.prototype.join=function(t){if(0===this.length)return"";for(var e=this.head,n=""+e.data;e=e.next;)n+=t+e.data;return n},t.prototype.concat=function(t){if(0===this.length)return r.alloc(0);if(1===this.length)return this.head.data;for(var e,n,i,o=r.allocUnsafe(t>>>0),a=this.head,u=0;a;)e=a.data,n=o,i=u,e.copy(n,i),u+=a.data.length,a=a.next;return o},t}(),i&&i.inspect&&i.inspect.custom&&(t.exports.prototype[i.inspect.custom]=function(){var t=i.inspect({length:this.length});return this.constructor.name+" "+t})},function(t,e){},function(t,e,n){(function(t){var r=void 0!==t&&t||"undefined"!=typeof self&&self||window,i=Function.prototype.apply;function o(t,e){this._id=t,this._clearFn=e}e.setTimeout=function(){return new o(i.call(setTimeout,r,arguments),clearTimeout)},e.setInterval=function(){return new o(i.call(setInterval,r,arguments),clearInterval)},e.clearTimeout=e.clearInterval=function(t){t&&t.close()},o.prototype.unref=o.prototype.ref=function(){},o.prototype.close=function(){this._clearFn.call(r,this._id)},e.enroll=function(t,e){clearTimeout(t._idleTimeoutId),t._idleTimeout=e},e.unenroll=function(t){clearTimeout(t._idleTimeoutId),t._idleTimeout=-1},e._unrefActive=e.active=function(t){clearTimeout(t._idleTimeoutId);var e=t._idleTimeout;e>=0&&(t._idleTimeoutId=setTimeout((function(){t._onTimeout&&t._onTimeout()}),e))},n(179),e.setImmediate="undefined"!=typeof self&&self.setImmediate||void 0!==t&&t.setImmediate||this&&this.setImmediate,e.clearImmediate="undefined"!=typeof self&&self.clearImmediate||void 0!==t&&t.clearImmediate||this&&this.clearImmediate}).call(this,n(12))},function(t,e,n){(function(t,e){!function(t,n){"use strict";if(!t.setImmediate){var r,i,o,a,u,c=1,s={},f=!1,l=t.document,h=Object.getPrototypeOf&&Object.getPrototypeOf(t);h=h&&h.setTimeout?h:t,"[object process]"==={}.toString.call(t.process)?r=function(t){e.nextTick((function(){p(t)}))}:!function(){if(t.postMessage&&!t.importScripts){var e=!0,n=t.onmessage;return t.onmessage=function(){e=!1},t.postMessage("","*"),t.onmessage=n,e}}()?t.MessageChannel?((o=new MessageChannel).port1.onmessage=function(t){p(t.data)},r=function(t){o.port2.postMessage(t)}):l&&"onreadystatechange"in l.createElement("script")?(i=l.documentElement,r=function(t){var e=l.createElement("script");e.onreadystatechange=function(){p(t),e.onreadystatechange=null,i.removeChild(e),e=null},i.appendChild(e)}):r=function(t){setTimeout(p,0,t)}:(a="setImmediate$"+Math.random()+"$",u=function(e){e.source===t&&"string"==typeof e.data&&0===e.data.indexOf(a)&&p(+e.data.slice(a.length))},t.addEventListener?t.addEventListener("message",u,!1):t.attachEvent("onmessage",u),r=function(e){t.postMessage(a+e,"*")}),h.setImmediate=function(t){"function"!=typeof t&&(t=new Function(""+t));for(var e=new Array(arguments.length-1),n=0;n<e.length;n++)e[n]=arguments[n+1];var i={callback:t,args:e};return s[c]=i,r(c),c++},h.clearImmediate=d}function d(t){delete s[t]}function p(t){if(f)setTimeout(p,0,t);else{var e=s[t];if(e){f=!0;try{!function(t){var e=t.callback,n=t.args;switch(n.length){case 0:e();break;case 1:e(n[0]);break;case 2:e(n[0],n[1]);break;case 3:e(n[0],n[1],n[2]);break;default:e.apply(void 0,n)}}(e)}finally{d(t),f=!1}}}}}("undefined"==typeof self?void 0===t?this:t:self)}).call(this,n(12),n(13))},function(t,e,n){(function(e){function n(t){try{if(!e.localStorage)return!1}catch(t){return!1}var n=e.localStorage[t];return null!=n&&"true"===String(n).toLowerCase()}t.exports=function(t,e){if(n("noDeprecation"))return t;var r=!1;return function(){if(!r){if(n("throwDeprecation"))throw new Error(e);n("traceDeprecation")?console.trace(e):console.warn(e),r=!0}return t.apply(this,arguments)}}}).call(this,n(12))},function(t,e,n){var r=n(21),i=r.Buffer;function o(t,e){for(var n in t)e[n]=t[n]}function a(t,e,n){return i(t,e,n)}i.from&&i.alloc&&i.allocUnsafe&&i.allocUnsafeSlow?t.exports=r:(o(r,e),e.Buffer=a),a.prototype=Object.create(i.prototype),o(i,a),a.from=function(t,e,n){if("number"==typeof t)throw new TypeError("Argument must not be a number");return i(t,e,n)},a.alloc=function(t,e,n){if("number"!=typeof t)throw new TypeError("Argument must be a number");var r=i(t);return void 0!==e?"string"==typeof n?r.fill(e,n):r.fill(e):r.fill(0),r},a.allocUnsafe=function(t){if("number"!=typeof t)throw new TypeError("Argument must be a number");return i(t)},a.allocUnsafeSlow=function(t){if("number"!=typeof t)throw new TypeError("Argument must be a number");return r.SlowBuffer(t)}},function(t,e,n){"use strict";t.exports=o;var r=n(61),i=Object.create(n(22));function o(t){if(!(this instanceof o))return new o(t);r.call(this,t)}i.inherits=n(18),i.inherits(o,r),o.prototype._transform=function(t,e,n){n(null,t)}},function(t,e,n){t.exports=n(33)},function(t,e,n){t.exports=n(14)},function(t,e,n){t.exports=n(31).Transform},function(t,e,n){t.exports=n(31).PassThrough},function(t,e,n){(function(e){t.exports=function(t){if(!/^data\:/i.test(t))throw new TypeError('`uri` does not appear to be a Data URI (must begin with "data:")');var n=(t=t.replace(/\r?\n/g,"")).indexOf(",");if(-1===n||n<=4)throw new TypeError("malformed data: URI");for(var r=t.substring(5,n).split(";"),i=!1,o="US-ASCII",a=0;a<r.length;a++)"base64"==r[a]?i=!0:0==r[a].indexOf("charset=")&&(o=r[a].substring(8));var u=unescape(t.substring(n+1)),c=new e(u,i?"base64":"ascii");return c.type=r[0]||"text/plain",c.charset=o,c}}).call(this,n(21).Buffer)},function(t,e,n){"use strict";function r(t,e){var n=Math.floor(e),r=e-n,i=0<=n&&n<t.shape[0],o=0<=n+1&&n+1<t.shape[0];return(1-r)*(i?+t.get(n):0)+r*(o?+t.get(n+1):0)}function i(t,e,n){var r=Math.floor(e),i=e-r,o=0<=r&&r<t.shape[0],a=0<=r+1&&r+1<t.shape[0],u=Math.floor(n),c=n-u,s=0<=u&&u<t.shape[1],f=0<=u+1&&u+1<t.shape[1],l=o&&s?t.get(r,u):0,h=o&&f?t.get(r,u+1):0;return(1-c)*((1-i)*l+i*(a&&s?t.get(r+1,u):0))+c*((1-i)*h+i*(a&&f?t.get(r+1,u+1):0))}function o(t,e,n,r){var i=Math.floor(e),o=e-i,a=0<=i&&i<t.shape[0],u=0<=i+1&&i+1<t.shape[0],c=Math.floor(n),s=n-c,f=0<=c&&c<t.shape[1],l=0<=c+1&&c+1<t.shape[1],h=Math.floor(r),d=r-h,p=0<=h&&h<t.shape[2],v=0<=h+1&&h+1<t.shape[2],g=a&&f&&p?t.get(i,c,h):0,y=a&&l&&p?t.get(i,c+1,h):0,_=u&&f&&p?t.get(i+1,c,h):0,m=u&&l&&p?t.get(i+1,c+1,h):0,b=a&&f&&v?t.get(i,c,h+1):0,w=a&&l&&v?t.get(i,c+1,h+1):0;return(1-d)*((1-s)*((1-o)*g+o*_)+s*((1-o)*y+o*m))+d*((1-s)*((1-o)*b+o*(u&&f&&v?t.get(i+1,c,h+1):0))+s*((1-o)*w+o*(u&&l&&v?t.get(i+1,c+1,h+1):0)))}function a(t){var e,n,r=0|t.shape.length,i=new Array(r),o=new Array(r),a=new Array(r),u=new Array(r);for(e=0;e<r;++e)n=+arguments[e+1],i[e]=Math.floor(n),o[e]=n-i[e],a[e]=0<=i[e]&&i[e]<t.shape[e],u[e]=0<=i[e]+1&&i[e]+1<t.shape[e];var c,s,f,l=0;t:for(e=0;e<1<<r;++e){for(s=1,f=t.offset,c=0;c<r;++c)if(e&1<<c){if(!u[c])continue t;s*=o[c],f+=t.stride[c]*(i[c]+1)}else{if(!a[c])continue t;s*=1-o[c],f+=t.stride[c]*i[c]}l+=s*t.data[f]}return l}t.exports=function(t,e,n,u){switch(t.shape.length){case 0:return 0;case 1:return r(t,e);case 2:return i(t,e,n);case 3:return o(t,e,n,u);default:return a.apply(void 0,arguments)}},t.exports.d1=r,t.exports.d2=i,t.exports.d3=o},function(t,e,n){"use strict";n.r(e),n.d(e,"BarcodeDecoder",(function(){return Mt})),n.d(e,"BarcodeReader",(function(){return S})),n.d(e,"CameraAccess",(function(){return Gt})),n.d(e,"ImageDebug",(function(){return f.a})),n.d(e,"ImageWrapper",(function(){return o.a})),n.d(e,"ResultCollector",(function(){return Ht}));var r=n(19),i=n.n(r),o=(n(68),n(10)),a={},u={UP:1,DOWN:-1};a.getBarcodeLine=function(t,e,n){var r,i,o,a,u,c=0|e.x,s=0|e.y,f=0|n.x,l=0|n.y,h=Math.abs(l-s)>Math.abs(f-c),d=[],p=t.data,v=t.size.x,g=255,y=0;function _(t,e){u=p[e*v+t],g=u<g?u:g,y=u>y?u:y,d.push(u)}h&&(o=c,c=s,s=o,o=f,f=l,l=o),c>f&&(o=c,c=f,f=o,o=s,s=l,l=o);var m=f-c,b=Math.abs(l-s);r=m/2|0,i=s;var w=s<l?1:-1;for(a=c;a<f;a++)h?_(i,a):_(a,i),(r-=b)<0&&(i+=w,r+=m);return{line:d,min:g,max:y}},a.toBinaryLine=function(t){var e,n,r,i,o,a,c=t.min,s=t.max,f=t.line,l=c+(s-c)/2,h=[],d=(s-c)/12,p=-d;for(r=f[0]>l?u.UP:u.DOWN,h.push({pos:0,val:f[0]}),o=0;o<f.length-2;o++)r!==(i=(e=f[o+1]-f[o])+(n=f[o+2]-f[o+1])<p&&f[o+1]<1.5*l?u.DOWN:e+n>d&&f[o+1]>.5*l?u.UP:r)&&(h.push({pos:o,val:f[o]}),r=i);for(h.push({pos:f.length,val:f[f.length-1]}),a=h[0].pos;a<h[1].pos;a++)f[a]=f[a]>l?0:1;for(o=1;o<h.length-1;o++)for(d=h[o+1].val>h[o].val?h[o].val+(h[o+1].val-h[o].val)/3*2|0:h[o+1].val+(h[o].val-h[o+1].val)/3|0,a=h[o].pos;a<h[o+1].pos;a++)f[a]=f[a]>d?0:1;return{line:f,threshold:d}},a.debug={printFrequency:function(t,e){var n,r=e.getContext("2d");for(e.width=t.length,e.height=256,r.beginPath(),r.strokeStyle="blue",n=0;n<t.length;n++)r.moveTo(n,255),r.lineTo(n,255-t[n]);r.stroke(),r.closePath()},printPattern:function(t,e){var n,r=e.getContext("2d");for(e.width=t.length,r.fillColor="black",n=0;n<t.length;n++)1===t[n]&&r.fillRect(n,0,1,100)}};var c,s=a,f=n(15),l=n(3),h=n.n(l),d=n(4),p=n.n(d),v=n(1),g=n.n(v),y=n(6),_=n.n(y),m=n(5),b=n.n(m),w=n(2),x=n.n(w),E=n(0),A=n.n(E),R=n(9);!function(t){t[t.Forward=1]="Forward",t[t.Reverse=-1]="Reverse"}(c||(c={}));var S=function(){function t(e,n){return h()(this,t),A()(this,"_row",[]),A()(this,"config",{}),A()(this,"supplements",[]),A()(this,"SINGLE_CODE_ERROR",0),A()(this,"FORMAT","unknown"),A()(this,"CONFIG_KEYS",{}),this._row=[],this.config=e||{},n&&(this.supplements=n),this}return p()(t,null,[{key:"Exception",get:function(){return{StartNotFoundException:"Start-Info was not found!",CodeNotFoundException:"Code could not be found!",PatternNotFoundException:"Pattern could not be found!"}}}]),p()(t,[{key:"_nextUnset",value:function(t){for(var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:0,n=e;n<t.length;n++)if(!t[n])return n;return t.length}},{key:"_matchPattern",value:function(t,e,n){var r,i=0,o=0,a=0,u=0,c=0,s=0;n=n||this.SINGLE_CODE_ERROR||1;for(var f=0;f<t.length;f++)a+=t[f],u+=e[f];if(a<u)return Number.MAX_VALUE;n*=r=a/u;for(var l=0;l<t.length;l++){if(c=t[l],s=e[l]*r,(o=Math.abs(c-s)/s)>n)return Number.MAX_VALUE;i+=o}return i/u}},{key:"_nextSet",value:function(t){for(var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:0,n=e;n<t.length;n++)if(t[n])return n;return t.length}},{key:"_correctBars",value:function(t,e,n){for(var r=n.length,i=0;r--;)(i=t[n[r]]*(1-(1-e)/2))>1&&(t[n[r]]=i)}},{key:"decodePattern",value:function(t){this._row=t;var e=this._decode();return null===e?(this._row.reverse(),(e=this._decode())&&(e.direction=c.Reverse,e.start=this._row.length-e.start,e.end=this._row.length-e.end)):e.direction=c.Forward,e&&(e.format=this.FORMAT),e}},{key:"_matchRange",value:function(t,e,n){var r;for(r=t=t<0?0:t;r<e;r++)if(this._row[r]!==n)return!1;return!0}},{key:"_fillCounters",value:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:this._nextUnset(this._row),e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:this._row.length,n=!(arguments.length>2&&void 0!==arguments[2])||arguments[2],r=[],i=0;r[i]=0;for(var o=t;o<e;o++)this._row[o]^(n?1:0)?r[i]++:(r[++i]=1,n=!n);return r}},{key:"_toCounters",value:function(t,e){var n=e.length,r=this._row.length,i=!this._row[t],o=0;R.a.init(e,0);for(var a=t;a<r;a++)if(this._row[a]^(i?1:0))e[o]++;else{if(++o===n)break;e[o]=1,i=!i}return e}}]),t}();function O(t){var e=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(t){return!1}}();return function(){var n,r=x()(t);if(e){var i=x()(this).constructor;n=Reflect.construct(r,arguments,i)}else n=r.apply(this,arguments);return b()(this,n)}}var k=function(t){_()(n,t);var e=O(n);function n(){var t;h()(this,n);for(var r=arguments.length,i=new Array(r),o=0;o<r;o++)i[o]=arguments[o];return t=e.call.apply(e,[this].concat(i)),A()(g()(t),"CODE_SHIFT",98),A()(g()(t),"CODE_C",99),A()(g()(t),"CODE_B",100),A()(g()(t),"CODE_A",101),A()(g()(t),"START_CODE_A",103),A()(g()(t),"START_CODE_B",104),A()(g()(t),"START_CODE_C",105),A()(g()(t),"STOP_CODE",106),A()(g()(t),"CODE_PATTERN",[[2,1,2,2,2,2],[2,2,2,1,2,2],[2,2,2,2,2,1],[1,2,1,2,2,3],[1,2,1,3,2,2],[1,3,1,2,2,2],[1,2,2,2,1,3],[1,2,2,3,1,2],[1,3,2,2,1,2],[2,2,1,2,1,3],[2,2,1,3,1,2],[2,3,1,2,1,2],[1,1,2,2,3,2],[1,2,2,1,3,2],[1,2,2,2,3,1],[1,1,3,2,2,2],[1,2,3,1,2,2],[1,2,3,2,2,1],[2,2,3,2,1,1],[2,2,1,1,3,2],[2,2,1,2,3,1],[2,1,3,2,1,2],[2,2,3,1,1,2],[3,1,2,1,3,1],[3,1,1,2,2,2],[3,2,1,1,2,2],[3,2,1,2,2,1],[3,1,2,2,1,2],[3,2,2,1,1,2],[3,2,2,2,1,1],[2,1,2,1,2,3],[2,1,2,3,2,1],[2,3,2,1,2,1],[1,1,1,3,2,3],[1,3,1,1,2,3],[1,3,1,3,2,1],[1,1,2,3,1,3],[1,3,2,1,1,3],[1,3,2,3,1,1],[2,1,1,3,1,3],[2,3,1,1,1,3],[2,3,1,3,1,1],[1,1,2,1,3,3],[1,1,2,3,3,1],[1,3,2,1,3,1],[1,1,3,1,2,3],[1,1,3,3,2,1],[1,3,3,1,2,1],[3,1,3,1,2,1],[2,1,1,3,3,1],[2,3,1,1,3,1],[2,1,3,1,1,3],[2,1,3,3,1,1],[2,1,3,1,3,1],[3,1,1,1,2,3],[3,1,1,3,2,1],[3,3,1,1,2,1],[3,1,2,1,1,3],[3,1,2,3,1,1],[3,3,2,1,1,1],[3,1,4,1,1,1],[2,2,1,4,1,1],[4,3,1,1,1,1],[1,1,1,2,2,4],[1,1,1,4,2,2],[1,2,1,1,2,4],[1,2,1,4,2,1],[1,4,1,1,2,2],[1,4,1,2,2,1],[1,1,2,2,1,4],[1,1,2,4,1,2],[1,2,2,1,1,4],[1,2,2,4,1,1],[1,4,2,1,1,2],[1,4,2,2,1,1],[2,4,1,2,1,1],[2,2,1,1,1,4],[4,1,3,1,1,1],[2,4,1,1,1,2],[1,3,4,1,1,1],[1,1,1,2,4,2],[1,2,1,1,4,2],[1,2,1,2,4,1],[1,1,4,2,1,2],[1,2,4,1,1,2],[1,2,4,2,1,1],[4,1,1,2,1,2],[4,2,1,1,1,2],[4,2,1,2,1,1],[2,1,2,1,4,1],[2,1,4,1,2,1],[4,1,2,1,2,1],[1,1,1,1,4,3],[1,1,1,3,4,1],[1,3,1,1,4,1],[1,1,4,1,1,3],[1,1,4,3,1,1],[4,1,1,1,1,3],[4,1,1,3,1,1],[1,1,3,1,4,1],[1,1,4,1,3,1],[3,1,1,1,4,1],[4,1,1,1,3,1],[2,1,1,4,1,2],[2,1,1,2,1,4],[2,1,1,2,3,2],[2,3,3,1,1,1,2]]),A()(g()(t),"SINGLE_CODE_ERROR",.64),A()(g()(t),"AVG_CODE_ERROR",.3),A()(g()(t),"FORMAT","code_128"),A()(g()(t),"MODULE_INDICES",{bar:[0,2,4],space:[1,3,5]}),t}return p()(n,[{key:"_decodeCode",value:function(t,e){for(var n={error:Number.MAX_VALUE,code:-1,start:t,end:t,correction:{bar:1,space:1}},r=[0,0,0,0,0,0],i=t,o=!this._row[i],a=0,u=i;u<this._row.length;u++)if(this._row[u]^(o?1:0))r[a]++;else{if(a===r.length-1){e&&this._correct(r,e);for(var c=0;c<this.CODE_PATTERN.length;c++){var s=this._matchPattern(r,this.CODE_PATTERN[c]);s<n.error&&(n.code=c,n.error=s)}return n.end=u,-1===n.code||n.error>this.AVG_CODE_ERROR?null:(this.CODE_PATTERN[n.code]&&(n.correction.bar=this.calculateCorrection(this.CODE_PATTERN[n.code],r,this.MODULE_INDICES.bar),n.correction.space=this.calculateCorrection(this.CODE_PATTERN[n.code],r,this.MODULE_INDICES.space)),n)}r[++a]=1,o=!o}return null}},{key:"_correct",value:function(t,e){this._correctBars(t,e.bar,this.MODULE_INDICES.bar),this._correctBars(t,e.space,this.MODULE_INDICES.space)}},{key:"_findStart",value:function(){for(var t=[0,0,0,0,0,0],e=this._nextSet(this._row),n={error:Number.MAX_VALUE,code:-1,start:0,end:0,correction:{bar:1,space:1}},r=!1,i=0,o=e;o<this._row.length;o++)if(this._row[o]^(r?1:0))t[i]++;else{if(i===t.length-1){for(var a=t.reduce((function(t,e){return t+e}),0),u=this.START_CODE_A;u<=this.START_CODE_C;u++){var c=this._matchPattern(t,this.CODE_PATTERN[u]);c<n.error&&(n.code=u,n.error=c)}if(n.error<this.AVG_CODE_ERROR)return n.start=o-a,n.end=o,n.correction.bar=this.calculateCorrection(this.CODE_PATTERN[n.code],t,this.MODULE_INDICES.bar),n.correction.space=this.calculateCorrection(this.CODE_PATTERN[n.code],t,this.MODULE_INDICES.space),n;for(var s=0;s<4;s++)t[s]=t[s+2];t[4]=0,t[5]=0,i--}else i++;t[i]=1,r=!r}return null}},{key:"_decode",value:function(t,e){var n=this,r=this._findStart();if(null===r)return null;var i={code:r.code,start:r.start,end:r.end,correction:{bar:r.correction.bar,space:r.correction.space}},o=[];o.push(i);for(var a=i.code,u=function(t){switch(t){case n.START_CODE_A:return n.CODE_A;case n.START_CODE_B:return n.CODE_B;case n.START_CODE_C:return n.CODE_C;default:return null}}(i.code),c=!1,s=!1,f=s,l=!0,h=0,d=[],p=[];!c;){if(f=s,s=!1,null!==(i=this._decodeCode(i.end,i.correction)))switch(i.code!==this.STOP_CODE&&(l=!0),i.code!==this.STOP_CODE&&(d.push(i.code),a+=++h*i.code),o.push(i),u){case this.CODE_A:if(i.code<64)p.push(String.fromCharCode(32+i.code));else if(i.code<96)p.push(String.fromCharCode(i.code-64));else switch(i.code!==this.STOP_CODE&&(l=!1),i.code){case this.CODE_SHIFT:s=!0,u=this.CODE_B;break;case this.CODE_B:u=this.CODE_B;break;case this.CODE_C:u=this.CODE_C;break;case this.STOP_CODE:c=!0}break;case this.CODE_B:if(i.code<96)p.push(String.fromCharCode(32+i.code));else switch(i.code!==this.STOP_CODE&&(l=!1),i.code){case this.CODE_SHIFT:s=!0,u=this.CODE_A;break;case this.CODE_A:u=this.CODE_A;break;case this.CODE_C:u=this.CODE_C;break;case this.STOP_CODE:c=!0}break;case this.CODE_C:if(i.code<100)p.push(i.code<10?"0"+i.code:i.code);else switch(i.code!==this.STOP_CODE&&(l=!1),i.code){case this.CODE_A:u=this.CODE_A;break;case this.CODE_B:u=this.CODE_B;break;case this.STOP_CODE:c=!0}}else c=!0;f&&(u=u===this.CODE_A?this.CODE_B:this.CODE_A)}return null===i?null:(i.end=this._nextUnset(this._row,i.end),this._verifyTrailingWhitespace(i)?(a-=h*d[d.length-1])%103!==d[d.length-1]?null:p.length?(l&&p.splice(p.length-1,1),{code:p.join(""),start:r.start,end:i.end,codeset:u,startInfo:r,decodedCodes:o,endInfo:i,format:this.FORMAT}):null:null)}},{key:"_verifyTrailingWhitespace",value:function(t){var e;return(e=t.end+(t.end-t.start)/2)<this._row.length&&this._matchRange(t.end,e,0)?t:null}},{key:"calculateCorrection",value:function(t,e,n){for(var r=n.length,i=0,o=0;r--;)o+=t[n[r]],i+=e[n[r]];return o/i}}]),n}(S),C=n(11);function j(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,r)}return n}function M(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?j(Object(n),!0).forEach((function(e){A()(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):j(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}function T(t){var e=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(t){return!1}}();return function(){var n,r=x()(t);if(e){var i=x()(this).constructor;n=Reflect.construct(r,arguments,i)}else n=r.apply(this,arguments);return b()(this,n)}}var I=[1,1,1],D=[1,1,1,1,1],P=[1,1,2],L=[[3,2,1,1],[2,2,2,1],[2,1,2,2],[1,4,1,1],[1,1,3,2],[1,2,3,1],[1,1,1,4],[1,3,1,2],[1,2,1,3],[3,1,1,2],[1,1,2,3],[1,2,2,2],[2,2,1,2],[1,1,4,1],[2,3,1,1],[1,3,2,1],[4,1,1,1],[2,1,3,1],[3,1,2,1],[2,1,1,3]],U=[0,11,13,14,19,25,28,21,22,26],z=function(t){_()(n,t);var e=T(n);function n(t,r){var i;return h()(this,n),i=e.call(this,Object(C.merge)({supplements:[]},t),r),A()(g()(i),"FORMAT","ean_13"),A()(g()(i),"SINGLE_CODE_ERROR",.7),A()(g()(i),"STOP_PATTERN",[1,1,1]),i}return p()(n,[{key:"_findPattern",value:function(t,e,n,r){var i=new Array(t.length).fill(0),o={error:Number.MAX_VALUE,start:0,end:0},a=0;e||(e=this._nextSet(this._row));for(var u=!1,c=e;c<this._row.length;c++)if(this._row[c]^(n?1:0))i[a]+=1;else{if(a===i.length-1){var s=this._matchPattern(i,t);if(s<.48&&o.error&&s<o.error)return u=!0,o.error=s,o.start=c-i.reduce((function(t,e){return t+e}),0),o.end=c,o;if(r){for(var f=0;f<i.length-2;f++)i[f]=i[f+2];i[i.length-2]=0,i[i.length-1]=0,a--}}else a++;i[a]=1,n=!n}return u?o:null}},{key:"_decodeCode",value:function(t,e){var n=[0,0,0,0],r=t,i={error:Number.MAX_VALUE,code:-1,start:t,end:t},o=!this._row[r],a=0;e||(e=L.length);for(var u=r;u<this._row.length;u++)if(this._row[u]^(o?1:0))n[a]++;else{if(a===n.length-1){for(var c=0;c<e;c++){var s=this._matchPattern(n,L[c]);i.end=u,s<i.error&&(i.code=c,i.error=s)}return i.error>.48?null:i}n[++a]=1,o=!o}return null}},{key:"_findStart",value:function(){for(var t=this._nextSet(this._row),e=null;!e;){if(!(e=this._findPattern(I,t,!1,!0)))return null;var n=e.start-(e.end-e.start);if(n>=0&&this._matchRange(n,e.start,0))return e;t=e.end,e=null}return null}},{key:"_calculateFirstDigit",value:function(t){for(var e=0;e<U.length;e++)if(t===U[e])return e;return null}},{key:"_decodePayload",value:function(t,e,n){for(var r=M({},t),i=0,o=0;o<6;o++){if(!(r=this._decodeCode(r.end)))return null;r.code>=10?(r.code-=10,i|=1<<5-o):i|=0<<5-o,e.push(r.code),n.push(r)}var a=this._calculateFirstDigit(i);if(null===a)return null;e.unshift(a);var u=this._findPattern(D,r.end,!0,!1);if(null===u||!u.end)return null;n.push(u);for(var c=0;c<6;c++){if(!(u=this._decodeCode(u.end,10)))return null;n.push(u),e.push(u.code)}return u}},{key:"_verifyTrailingWhitespace",value:function(t){var e=t.end+(t.end-t.start);return e<this._row.length&&this._matchRange(t.end,e,0)?t:null}},{key:"_findEnd",value:function(t,e){var n=this._findPattern(this.STOP_PATTERN,t,e,!1);return null!==n?this._verifyTrailingWhitespace(n):null}},{key:"_checksum",value:function(t){for(var e=0,n=t.length-2;n>=0;n-=2)e+=t[n];e*=3;for(var r=t.length-1;r>=0;r-=2)e+=t[r];return e%10==0}},{key:"_decodeExtensions",value:function(t){var e=this._nextSet(this._row,t),n=this._findPattern(P,e,!1,!1);if(null===n)return null;for(var r=0;r<this.supplements.length;r++)try{var i=this.supplements[r]._decode(this._row,n.end);if(null!==i)return{code:i.code,start:e,startInfo:n,end:i.end,decodedCodes:i.decodedCodes,format:this.supplements[r].FORMAT}}catch(t){console.error("* decodeExtensions error in ",this.supplements[r],": ",t)}return null}},{key:"_decode",value:function(t,e){var n=new Array,r=new Array,i={},o=this._findStart();if(!o)return null;var a={start:o.start,end:o.end};if(r.push(a),!(a=this._decodePayload(a,n,r)))return null;if(!(a=this._findEnd(a.end,!1)))return null;if(r.push(a),!this._checksum(n))return null;if(this.supplements.length>0){var u=this._decodeExtensions(a.end);if(!u)return null;if(!u.decodedCodes)return null;var c=u.decodedCodes[u.decodedCodes.length-1],s={start:c.start+((c.end-c.start)/2|0),end:c.end};if(!this._verifyTrailingWhitespace(s))return null;i={supplement:u,code:n.join("")+u.code}}return M(M({code:n.join(""),start:o.start,end:a.end,startInfo:o,decodedCodes:r},i),{},{format:this.FORMAT})}}]),n}(S),B=n(26),N=n.n(B);function W(t){var e=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(t){return!1}}();return function(){var n,r=x()(t);if(e){var i=x()(this).constructor;n=Reflect.construct(r,arguments,i)}else n=r.apply(this,arguments);return b()(this,n)}}var F=new Uint16Array(N()("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ-. *$/+%").map((function(t){return t.charCodeAt(0)}))),q=new Uint16Array([52,289,97,352,49,304,112,37,292,100,265,73,328,25,280,88,13,268,76,28,259,67,322,19,274,82,7,262,70,22,385,193,448,145,400,208,133,388,196,148,168,162,138,42]),V=function(t){_()(n,t);var e=W(n);function n(){var t;h()(this,n);for(var r=arguments.length,i=new Array(r),o=0;o<r;o++)i[o]=arguments[o];return t=e.call.apply(e,[this].concat(i)),A()(g()(t),"FORMAT","code_39"),t}return p()(n,[{key:"_findStart",value:function(){for(var t=this._nextSet(this._row),e=t,n=new Uint16Array([0,0,0,0,0,0,0,0,0]),r=0,i=!1,o=t;o<this._row.length;o++)if(this._row[o]^(i?1:0))n[r]++;else{if(r===n.length-1){if(148===this._toPattern(n)){var a=Math.floor(Math.max(0,e-(o-e)/4));if(this._matchRange(a,e,0))return{start:e,end:o}}e+=n[0]+n[1];for(var u=0;u<7;u++)n[u]=n[u+2];n[7]=0,n[8]=0,r--}else r++;n[r]=1,i=!i}return null}},{key:"_toPattern",value:function(t){for(var e=t.length,n=0,r=e,i=0;r>3;){n=this._findNextWidth(t,n),r=0;for(var o=0,a=0;a<e;a++)t[a]>n&&(o|=1<<e-1-a,r++,i+=t[a]);if(3===r){for(var u=0;u<e&&r>0;u++)if(t[u]>n&&(r--,2*t[u]>=i))return-1;return o}}return-1}},{key:"_findNextWidth",value:function(t,e){for(var n=Number.MAX_VALUE,r=0;r<t.length;r++)t[r]<n&&t[r]>e&&(n=t[r]);return n}},{key:"_patternToChar",value:function(t){for(var e=0;e<q.length;e++)if(q[e]===t)return String.fromCharCode(F[e]);return null}},{key:"_verifyTrailingWhitespace",value:function(t,e,n){var r=R.a.sum(n);return 3*(e-t-r)>=r}},{key:"_decode",value:function(t,e){var n=new Uint16Array([0,0,0,0,0,0,0,0,0]),r=[];if(!(e=this._findStart()))return null;var i,o,a=this._nextSet(this._row,e.end);do{n=this._toCounters(a,n);var u=this._toPattern(n);if(u<0)return null;if(null===(i=this._patternToChar(u)))return null;r.push(i),o=a,a+=R.a.sum(n),a=this._nextSet(this._row,a)}while("*"!==i);return r.pop(),r.length&&this._verifyTrailingWhitespace(o,a,n)?{code:r.join(""),start:e.start,end:a,startInfo:e,decodedCodes:r,format:this.FORMAT}:null}}]),n}(S),Y=n(16),G=n.n(Y);function H(t){var e=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(t){return!1}}();return function(){var n,r=x()(t);if(e){var i=x()(this).constructor;n=Reflect.construct(r,arguments,i)}else n=r.apply(this,arguments);return b()(this,n)}}var $=/[IOQ]/g,X=/[A-Z0-9]{17}/,Z=function(t){_()(n,t);var e=H(n);function n(){var t;h()(this,n);for(var r=arguments.length,i=new Array(r),o=0;o<r;o++)i[o]=arguments[o];return t=e.call.apply(e,[this].concat(i)),A()(g()(t),"FORMAT","code_39_vin"),t}return p()(n,[{key:"_checkChecksum",value:function(t){return!!t}},{key:"_decode",value:function(t,e){var r=G()(x()(n.prototype),"_decode",this).call(this,t,e);if(!r)return null;var i=r.code;return i&&(i=i.replace($,"")).match(X)&&this._checkChecksum(i)?(r.code=i,r):null}}]),n}(V);function Q(t){var e=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(t){return!1}}();return function(){var n,r=x()(t);if(e){var i=x()(this).constructor;n=Reflect.construct(r,arguments,i)}else n=r.apply(this,arguments);return b()(this,n)}}var K=[48,49,50,51,52,53,54,55,56,57,45,36,58,47,46,43,65,66,67,68],J=[3,6,9,96,18,66,33,36,48,72,12,24,69,81,84,21,26,41,11,14],tt=[26,41,11,14],et=function(t){_()(n,t);var e=Q(n);function n(){var t;h()(this,n);for(var r=arguments.length,i=new Array(r),o=0;o<r;o++)i[o]=arguments[o];return t=e.call.apply(e,[this].concat(i)),A()(g()(t),"_counters",[]),A()(g()(t),"FORMAT","codabar"),t}return p()(n,[{key:"_computeAlternatingThreshold",value:function(t,e){for(var n=Number.MAX_VALUE,r=0,i=0,o=t;o<e;o+=2)(i=this._counters[o])>r&&(r=i),i<n&&(n=i);return(n+r)/2|0}},{key:"_toPattern",value:function(t){var e=t+7;if(e>this._counters.length)return-1;for(var n=this._computeAlternatingThreshold(t,e),r=this._computeAlternatingThreshold(t+1,e),i=64,o=0,a=0,u=0;u<7;u++)o=0==(1&u)?n:r,this._counters[t+u]>o&&(a|=i),i>>=1;return a}},{key:"_isStartEnd",value:function(t){for(var e=0;e<tt.length;e++)if(tt[e]===t)return!0;return!1}},{key:"_sumCounters",value:function(t,e){for(var n=0,r=t;r<e;r++)n+=this._counters[r];return n}},{key:"_findStart",value:function(){for(var t=this._nextUnset(this._row),e=1;e<this._counters.length;e++){var n=this._toPattern(e);if(-1!==n&&this._isStartEnd(n))return{start:t+=this._sumCounters(0,e),end:t+this._sumCounters(e,e+8),startCounter:e,endCounter:e+8}}return null}},{key:"_patternToChar",value:function(t){for(var e=0;e<J.length;e++)if(J[e]===t)return String.fromCharCode(K[e]);return null}},{key:"_calculatePatternLength",value:function(t){for(var e=0,n=t;n<t+7;n++)e+=this._counters[n];return e}},{key:"_verifyWhitespace",value:function(t,e){return(t-1<=0||this._counters[t-1]>=this._calculatePatternLength(t)/2)&&(e+8>=this._counters.length||this._counters[e+7]>=this._calculatePatternLength(e)/2)}},{key:"_charToPattern",value:function(t){for(var e=t.charCodeAt(0),n=0;n<K.length;n++)if(K[n]===e)return J[n];return 0}},{key:"_thresholdResultPattern",value:function(t,e){for(var n,r={space:{narrow:{size:0,counts:0,min:0,max:Number.MAX_VALUE},wide:{size:0,counts:0,min:0,max:Number.MAX_VALUE}},bar:{narrow:{size:0,counts:0,min:0,max:Number.MAX_VALUE},wide:{size:0,counts:0,min:0,max:Number.MAX_VALUE}}},i=e,o=0;o<t.length;o++){n=this._charToPattern(t[o]);for(var a=6;a>=0;a--){var u=2==(1&a)?r.bar:r.space,c=1==(1&n)?u.wide:u.narrow;c.size+=this._counters[i+a],c.counts++,n>>=1}i+=8}return["space","bar"].forEach((function(t){var e=r[t];e.wide.min=Math.floor((e.narrow.size/e.narrow.counts+e.wide.size/e.wide.counts)/2),e.narrow.max=Math.ceil(e.wide.min),e.wide.max=Math.ceil((2*e.wide.size+1.5)/e.wide.counts)})),r}},{key:"_validateResult",value:function(t,e){for(var n,r=this._thresholdResultPattern(t,e),i=e,o=0;o<t.length;o++){n=this._charToPattern(t[o]);for(var a=6;a>=0;a--){var u=0==(1&a)?r.bar:r.space,c=1==(1&n)?u.wide:u.narrow,s=this._counters[i+a];if(s<c.min||s>c.max)return!1;n>>=1}i+=8}return!0}},{key:"_decode",value:function(t,e){if(this._counters=this._fillCounters(),!(e=this._findStart()))return null;var n,r=e.startCounter,i=[];do{if((n=this._toPattern(r))<0)return null;var o=this._patternToChar(n);if(null===o)return null;if(i.push(o),r+=8,i.length>1&&this._isStartEnd(n))break}while(r<this._counters.length);if(i.length-2<4||!this._isStartEnd(n))return null;if(!this._verifyWhitespace(e.startCounter,r-8))return null;if(!this._validateResult(i,e.startCounter))return null;r=r>this._counters.length?this._counters.length:r;var a=e.start+this._sumCounters(e.startCounter,r-8);return{code:i.join(""),start:e.start,end:a,startInfo:e,decodedCodes:i,format:this.FORMAT}}}]),n}(S);function nt(t){var e=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(t){return!1}}();return function(){var n,r=x()(t);if(e){var i=x()(this).constructor;n=Reflect.construct(r,arguments,i)}else n=r.apply(this,arguments);return b()(this,n)}}var rt=function(t){_()(n,t);var e=nt(n);function n(){var t;h()(this,n);for(var r=arguments.length,i=new Array(r),o=0;o<r;o++)i[o]=arguments[o];return t=e.call.apply(e,[this].concat(i)),A()(g()(t),"FORMAT","upc_a"),t}return p()(n,[{key:"_decode",value:function(t,e){var n=z.prototype._decode.call(this);return n&&n.code&&13===n.code.length&&"0"===n.code.charAt(0)?(n.code=n.code.substring(1),n):null}}]),n}(z);function it(t){var e=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(t){return!1}}();return function(){var n,r=x()(t);if(e){var i=x()(this).constructor;n=Reflect.construct(r,arguments,i)}else n=r.apply(this,arguments);return b()(this,n)}}var ot=function(t){_()(n,t);var e=it(n);function n(){var t;h()(this,n);for(var r=arguments.length,i=new Array(r),o=0;o<r;o++)i[o]=arguments[o];return t=e.call.apply(e,[this].concat(i)),A()(g()(t),"FORMAT","ean_8"),t}return p()(n,[{key:"_decodePayload",value:function(t,e,n){for(var r=t,i=0;i<4;i++){if(!(r=this._decodeCode(r.end,10)))return null;e.push(r.code),n.push(r)}if(null===(r=this._findPattern(D,r.end,!0,!1)))return null;n.push(r);for(var o=0;o<4;o++){if(!(r=this._decodeCode(r.end,10)))return null;n.push(r),e.push(r.code)}return r}}]),n}(z);function at(t){var e=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(t){return!1}}();return function(){var n,r=x()(t);if(e){var i=x()(this).constructor;n=Reflect.construct(r,arguments,i)}else n=r.apply(this,arguments);return b()(this,n)}}var ut=function(t){_()(n,t);var e=at(n);function n(){var t;h()(this,n);for(var r=arguments.length,i=new Array(r),o=0;o<r;o++)i[o]=arguments[o];return t=e.call.apply(e,[this].concat(i)),A()(g()(t),"FORMAT","ean_2"),t}return p()(n,[{key:"_decode",value:function(t,e){t&&(this._row=t);var n=0,r=e,i=this._row.length,o=[],a=[],u=null;if(void 0===r)return null;for(var c=0;c<2&&r<i;c++){if(!(u=this._decodeCode(r)))return null;a.push(u),o.push(u.code%10),u.code>=10&&(n|=1<<1-c),1!==c&&(r=this._nextSet(this._row,u.end),r=this._nextUnset(this._row,r))}if(2!==o.length||parseInt(o.join(""))%4!==n)return null;var s=this._findStart();return{code:o.join(""),decodedCodes:a,end:u.end,format:this.FORMAT,startInfo:s,start:s.start}}}]),n}(z);function ct(t){var e=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(t){return!1}}();return function(){var n,r=x()(t);if(e){var i=x()(this).constructor;n=Reflect.construct(r,arguments,i)}else n=r.apply(this,arguments);return b()(this,n)}}var st=[24,20,18,17,12,6,3,10,9,5];var ft=function(t){_()(n,t);var e=ct(n);function n(){var t;h()(this,n);for(var r=arguments.length,i=new Array(r),o=0;o<r;o++)i[o]=arguments[o];return t=e.call.apply(e,[this].concat(i)),A()(g()(t),"FORMAT","ean_5"),t}return p()(n,[{key:"_decode",value:function(t,e){if(void 0===e)return null;t&&(this._row=t);for(var n=0,r=e,i=this._row.length,o=null,a=[],u=[],c=0;c<5&&r<i;c++){if(!(o=this._decodeCode(r)))return null;u.push(o),a.push(o.code%10),o.code>=10&&(n|=1<<4-c),4!==c&&(r=this._nextSet(this._row,o.end),r=this._nextUnset(this._row,r))}if(5!==a.length)return null;if(function(t){for(var e=t.length,n=0,r=e-2;r>=0;r-=2)n+=t[r];n*=3;for(var i=e-1;i>=0;i-=2)n+=t[i];return(n*=3)%10}(a)!==function(t){for(var e=0;e<10;e++)if(t===st[e])return e;return null}(n))return null;var s=this._findStart();return{code:a.join(""),decodedCodes:u,end:o.end,format:this.FORMAT,startInfo:s,start:s.start}}}]),n}(z);function lt(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,r)}return n}function ht(t){var e=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(t){return!1}}();return function(){var n,r=x()(t);if(e){var i=x()(this).constructor;n=Reflect.construct(r,arguments,i)}else n=r.apply(this,arguments);return b()(this,n)}}var dt=function(t){_()(n,t);var e=ht(n);function n(){var t;h()(this,n);for(var r=arguments.length,i=new Array(r),o=0;o<r;o++)i[o]=arguments[o];return t=e.call.apply(e,[this].concat(i)),A()(g()(t),"CODE_FREQUENCY",[[56,52,50,49,44,38,35,42,41,37],[7,11,13,14,19,25,28,21,22,26]]),A()(g()(t),"STOP_PATTERN",[1/6*7,1/6*7,1/6*7,1/6*7,1/6*7,1/6*7]),A()(g()(t),"FORMAT","upc_e"),t}return p()(n,[{key:"_decodePayload",value:function(t,e,n){for(var r=function(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?lt(Object(n),!0).forEach((function(e){A()(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):lt(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}({},t),i=0,o=0;o<6;o++){if(!(r=this._decodeCode(r.end)))return null;r.code>=10&&(r.code=r.code-10,i|=1<<5-o),e.push(r.code),n.push(r)}return this._determineParity(i,e)?r:null}},{key:"_determineParity",value:function(t,e){for(var n=0;n<this.CODE_FREQUENCY.length;n++)for(var r=0;r<this.CODE_FREQUENCY[n].length;r++)if(t===this.CODE_FREQUENCY[n][r])return e.unshift(n),e.push(r),!0;return!1}},{key:"_convertToUPCA",value:function(t){var e=[t[0]],n=t[t.length-2];return(e=n<=2?e.concat(t.slice(1,3)).concat([n,0,0,0,0]).concat(t.slice(3,6)):3===n?e.concat(t.slice(1,4)).concat([0,0,0,0,0]).concat(t.slice(4,6)):4===n?e.concat(t.slice(1,5)).concat([0,0,0,0,0,t[5]]):e.concat(t.slice(1,6)).concat([0,0,0,0,n])).push(t[t.length-1]),e}},{key:"_checksum",value:function(t){return G()(x()(n.prototype),"_checksum",this).call(this,this._convertToUPCA(t))}},{key:"_findEnd",value:function(t,e){return G()(x()(n.prototype),"_findEnd",this).call(this,t,!0)}},{key:"_verifyTrailingWhitespace",value:function(t){var e=t.end+(t.end-t.start)/2;return e<this._row.length&&this._matchRange(t.end,e,0)?t:null}}]),n}(z);function pt(t){var e=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(t){return!1}}();return function(){var n,r=x()(t);if(e){var i=x()(this).constructor;n=Reflect.construct(r,arguments,i)}else n=r.apply(this,arguments);return b()(this,n)}}var vt=function(t){_()(n,t);var e=pt(n);function n(t){var r;return h()(this,n),r=e.call(this,Object(C.merge)({normalizeBarSpaceWidth:!1},t)),A()(g()(r),"barSpaceRatio",[1,1]),A()(g()(r),"SINGLE_CODE_ERROR",.78),A()(g()(r),"AVG_CODE_ERROR",.38),A()(g()(r),"START_PATTERN",[1,1,1,1]),A()(g()(r),"STOP_PATTERN",[1,1,3]),A()(g()(r),"CODE_PATTERN",[[1,1,3,3,1],[3,1,1,1,3],[1,3,1,1,3],[3,3,1,1,1],[1,1,3,1,3],[3,1,3,1,1],[1,3,3,1,1],[1,1,1,3,3],[3,1,1,3,1],[1,3,1,3,1]]),A()(g()(r),"MAX_CORRECTION_FACTOR",5),A()(g()(r),"FORMAT","i2of5"),t.normalizeBarSpaceWidth&&(r.SINGLE_CODE_ERROR=.38,r.AVG_CODE_ERROR=.09),r.config=t,b()(r,g()(r))}return p()(n,[{key:"_matchPattern",value:function(t,e){if(this.config.normalizeBarSpaceWidth){for(var n=[0,0],r=[0,0],i=[0,0],o=this.MAX_CORRECTION_FACTOR,a=1/o,u=0;u<t.length;u++)n[u%2]+=t[u],r[u%2]+=e[u];i[0]=r[0]/n[0],i[1]=r[1]/n[1],i[0]=Math.max(Math.min(i[0],o),a),i[1]=Math.max(Math.min(i[1],o),a),this.barSpaceRatio=i;for(var c=0;c<t.length;c++)t[c]*=this.barSpaceRatio[c%2]}return S.prototype._matchPattern.call(this,t,e)}},{key:"_findPattern",value:function(t,e){var n=arguments.length>2&&void 0!==arguments[2]&&arguments[2],r=arguments.length>3&&void 0!==arguments[3]&&arguments[3],i=new Array(t.length).fill(0),o=0,a={error:Number.MAX_VALUE,code:-1,start:0,end:0},u=this.AVG_CODE_ERROR;n=n||!1,r=r||!1,e||(e=this._nextSet(this._row));for(var c=e;c<this._row.length;c++)if(this._row[c]^(n?1:0))i[o]++;else{if(o===i.length-1){var s=i.reduce((function(t,e){return t+e}),0),f=this._matchPattern(i,t);if(f<u)return a.error=f,a.start=c-s,a.end=c,a;if(!r)return null;for(var l=0;l<i.length-2;l++)i[l]=i[l+2];i[i.length-2]=0,i[i.length-1]=0,o--}else o++;i[o]=1,n=!n}return null}},{key:"_findStart",value:function(){for(var t=0,e=this._nextSet(this._row),n=null,r=1;!n;){if(!(n=this._findPattern(this.START_PATTERN,e,!1,!0)))return null;if(r=Math.floor((n.end-n.start)/4),(t=n.start-10*r)>=0&&this._matchRange(t,n.start,0))return n;e=n.end,n=null}return null}},{key:"_verifyTrailingWhitespace",value:function(t){var e=t.end+(t.end-t.start)/2;return e<this._row.length&&this._matchRange(t.end,e,0)?t:null}},{key:"_findEnd",value:function(){this._row.reverse();var t=this._findPattern(this.STOP_PATTERN);if(this._row.reverse(),null===t)return null;var e=t.start;return t.start=this._row.length-t.end,t.end=this._row.length-e,null!==t?this._verifyTrailingWhitespace(t):null}},{key:"_decodePair",value:function(t){for(var e=[],n=0;n<t.length;n++){var r=this._decodeCode(t[n]);if(!r)return null;e.push(r)}return e}},{key:"_decodeCode",value:function(t){for(var e=this.AVG_CODE_ERROR,n={error:Number.MAX_VALUE,code:-1,start:0,end:0},r=0;r<this.CODE_PATTERN.length;r++){var i=this._matchPattern(t,this.CODE_PATTERN[r]);i<n.error&&(n.code=r,n.error=i)}return n.error<e?n:null}},{key:"_decodePayload",value:function(t,e,n){for(var r=0,i=t.length,o=[[0,0,0,0,0],[0,0,0,0,0]],a=null;r<i;){for(var u=0;u<5;u++)o[0][u]=t[r]*this.barSpaceRatio[0],o[1][u]=t[r+1]*this.barSpaceRatio[1],r+=2;if(!(a=this._decodePair(o)))return null;for(var c=0;c<a.length;c++)e.push(a[c].code+""),n.push(a[c])}return a}},{key:"_verifyCounterLength",value:function(t){return t.length%10==0}},{key:"_decode",value:function(t,e){var n=new Array,r=new Array,i=this._findStart();if(!i)return null;r.push(i);var o=this._findEnd();if(!o)return null;var a=this._fillCounters(i.end,o.start,!1);return this._verifyCounterLength(a)&&this._decodePayload(a,n,r)?n.length%2!=0||n.length<6?null:(r.push(o),{code:n.join(""),start:i.start,end:o.end,startInfo:i,decodedCodes:r,format:this.FORMAT}):null}}]),n}(S);function gt(t){var e=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(t){return!1}}();return function(){var n,r=x()(t);if(e){var i=x()(this).constructor;n=Reflect.construct(r,arguments,i)}else n=r.apply(this,arguments);return b()(this,n)}}var yt=[3,1,3,1,1,1],_t=[3,1,1,1,3],mt=[[1,1,3,3,1],[3,1,1,1,3],[1,3,1,1,3],[3,3,1,1,1],[1,1,3,1,3],[3,1,3,1,1],[1,3,3,1,1],[1,1,1,3,3],[3,1,1,3,1],[1,3,1,3,1]],bt=yt.reduce((function(t,e){return t+e}),0),wt=function(t){_()(n,t);var e=gt(n);function n(){var t;h()(this,n);for(var r=arguments.length,i=new Array(r),o=0;o<r;o++)i[o]=arguments[o];return t=e.call.apply(e,[this].concat(i)),A()(g()(t),"barSpaceRatio",[1,1]),A()(g()(t),"FORMAT","2of5"),A()(g()(t),"SINGLE_CODE_ERROR",.78),A()(g()(t),"AVG_CODE_ERROR",.3),t}return p()(n,[{key:"_findPattern",value:function(t,e){var n=arguments.length>2&&void 0!==arguments[2]&&arguments[2],r=arguments.length>3&&void 0!==arguments[3]&&arguments[3],i=[],o=0,a={error:Number.MAX_VALUE,code:-1,start:0,end:0},u=0,c=0,s=this.AVG_CODE_ERROR;e||(e=this._nextSet(this._row));for(var f=0;f<t.length;f++)i[f]=0;for(var l=e;l<this._row.length;l++)if(this._row[l]^(n?1:0))i[o]++;else{if(o===i.length-1){u=0;for(var h=0;h<i.length;h++)u+=i[h];if((c=this._matchPattern(i,t))<s)return a.error=c,a.start=l-u,a.end=l,a;if(!r)return null;for(var d=0;d<i.length-2;d++)i[d]=i[d+2];i[i.length-2]=0,i[i.length-1]=0,o--}else o++;i[o]=1,n=!n}return null}},{key:"_findStart",value:function(){for(var t=null,e=this._nextSet(this._row),n=1,r=0;!t;){if(!(t=this._findPattern(yt,e,!1,!0)))return null;if(n=Math.floor((t.end-t.start)/bt),(r=t.start-5*n)>=0&&this._matchRange(r,t.start,0))return t;e=t.end,t=null}return t}},{key:"_verifyTrailingWhitespace",value:function(t){var e=t.end+(t.end-t.start)/2;return e<this._row.length&&this._matchRange(t.end,e,0)?t:null}},{key:"_findEnd",value:function(){this._row.reverse();var t=this._nextSet(this._row),e=this._findPattern(_t,t,!1,!0);if(this._row.reverse(),null===e)return null;var n=e.start;return e.start=this._row.length-e.end,e.end=this._row.length-n,null!==e?this._verifyTrailingWhitespace(e):null}},{key:"_verifyCounterLength",value:function(t){return t.length%10==0}},{key:"_decodeCode",value:function(t){for(var e=this.AVG_CODE_ERROR,n={error:Number.MAX_VALUE,code:-1,start:0,end:0},r=0;r<mt.length;r++){var i=this._matchPattern(t,mt[r]);i<n.error&&(n.code=r,n.error=i)}return n.error<e?n:null}},{key:"_decodePayload",value:function(t,e,n){for(var r=0,i=t.length,o=[0,0,0,0,0],a=null;r<i;){for(var u=0;u<5;u++)o[u]=t[r]*this.barSpaceRatio[0],r+=2;if(!(a=this._decodeCode(o)))return null;e.push("".concat(a.code)),n.push(a)}return a}},{key:"_decode",value:function(t,e){var n=this._findStart();if(!n)return null;var r=this._findEnd();if(!r)return null;var i=this._fillCounters(n.end,r.start,!1);if(!this._verifyCounterLength(i))return null;var o=[];o.push(n);var a=[];return this._decodePayload(i,a,o)?a.length<5?null:(o.push(r),{code:a.join(""),start:n.start,end:r.end,startInfo:n,decodedCodes:o,format:this.FORMAT}):null}}]),n}(S);function xt(t){var e=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(t){return!1}}();return function(){var n,r=x()(t);if(e){var i=x()(this).constructor;n=Reflect.construct(r,arguments,i)}else n=r.apply(this,arguments);return b()(this,n)}}var Et=new Uint16Array(N()("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ-. $/+%abcd*").map((function(t){return t.charCodeAt(0)}))),At=new Uint16Array([276,328,324,322,296,292,290,336,274,266,424,420,418,404,402,394,360,356,354,308,282,344,332,326,300,278,436,434,428,422,406,410,364,358,310,314,302,468,466,458,366,374,430,294,474,470,306,350]);function Rt(t){var e=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(t){return!1}}();return function(){var n,r=x()(t);if(e){var i=x()(this).constructor;n=Reflect.construct(r,arguments,i)}else n=r.apply(this,arguments);return b()(this,n)}}var St,Ot=/[AEIO]/g,kt=/[A-Z0-9]/,Ct=[{digit_code:0,character_code:"0"},{digit_code:1,character_code:"1"},{digit_code:2,character_code:"2"},{digit_code:3,character_code:"3"},{digit_code:4,character_code:"4"},{digit_code:5,character_code:"5"},{digit_code:6,character_code:"6"},{digit_code:7,character_code:"7"},{digit_code:8,character_code:"8"},{digit_code:9,character_code:"9"},{digit_code:10,character_code:"B"},{digit_code:11,character_code:"C"},{digit_code:12,character_code:"D"},{digit_code:13,character_code:"F"},{digit_code:14,character_code:"G"},{digit_code:15,character_code:"H"},{digit_code:16,character_code:"J"},{digit_code:17,character_code:"K"},{digit_code:18,character_code:"L"},{digit_code:19,character_code:"M"},{digit_code:20,character_code:"N"},{digit_code:21,character_code:"P"},{digit_code:22,character_code:"Q"},{digit_code:23,character_code:"R"},{digit_code:24,character_code:"S"},{digit_code:25,character_code:"T"},{digit_code:26,character_code:"U"},{digit_code:27,character_code:"V"},{digit_code:28,character_code:"W"},{digit_code:29,character_code:"X"},{digit_code:30,character_code:"Y"},{digit_code:31,character_code:"Z"}],jt={code_128_reader:k,ean_reader:z,ean_5_reader:ft,ean_2_reader:ut,ean_8_reader:ot,code_39_reader:V,code_39_vin_reader:Z,codabar_reader:et,upc_reader:rt,upc_e_reader:dt,i2of5_reader:vt,"2of5_reader":wt,code_93_reader:function(t){_()(n,t);var e=xt(n);function n(){var t;h()(this,n);for(var r=arguments.length,i=new Array(r),o=0;o<r;o++)i[o]=arguments[o];return t=e.call.apply(e,[this].concat(i)),A()(g()(t),"FORMAT","code_93"),t}return p()(n,[{key:"_patternToChar",value:function(t){for(var e=0;e<At.length;e++)if(At[e]===t)return String.fromCharCode(Et[e]);return null}},{key:"_toPattern",value:function(t){for(var e=t.length,n=t.reduce((function(t,e){return t+e}),0),r=0,i=0;i<e;i++){var o=Math.round(9*t[i]/n);if(o<1||o>4)return-1;if(0==(1&i))for(var a=0;a<o;a++)r=r<<1|1;else r<<=o}return r}},{key:"_findStart",value:function(){for(var t=this._nextSet(this._row),e=t,n=new Uint16Array([0,0,0,0,0,0]),r=0,i=!1,o=t;o<this._row.length;o++)if(this._row[o]^(i?1:0))n[r]++;else{if(r===n.length-1){if(350===this._toPattern(n)){var a=Math.floor(Math.max(0,e-(o-e)/4));if(this._matchRange(a,e,0))return{start:e,end:o}}e+=n[0]+n[1];for(var u=0;u<4;u++)n[u]=n[u+2];n[4]=0,n[5]=0,r--}else r++;n[r]=1,i=!i}return null}},{key:"_verifyEnd",value:function(t,e){return!(t===e||!this._row[e])}},{key:"_decodeExtended",value:function(t){for(var e=t.length,n=[],r=0;r<e;r++){var i=t[r];if(i>="a"&&i<="d"){if(r>e-2)return null;var o=t[++r],a=o.charCodeAt(0),u=void 0;switch(i){case"a":if(!(o>="A"&&o<="Z"))return null;u=String.fromCharCode(a-64);break;case"b":if(o>="A"&&o<="E")u=String.fromCharCode(a-38);else if(o>="F"&&o<="J")u=String.fromCharCode(a-11);else if(o>="K"&&o<="O")u=String.fromCharCode(a+16);else if(o>="P"&&o<="S")u=String.fromCharCode(a+43);else{if(!(o>="T"&&o<="Z"))return null;u=String.fromCharCode(127)}break;case"c":if(o>="A"&&o<="O")u=String.fromCharCode(a-32);else{if("Z"!==o)return null;u=":"}break;case"d":if(!(o>="A"&&o<="Z"))return null;u=String.fromCharCode(a+32);break;default:return console.warn("* code_93_reader _decodeExtended hit default case, this may be an error",u),null}n.push(u)}else n.push(i)}return n}},{key:"_matchCheckChar",value:function(t,e,n){var r=t.slice(0,e),i=r.length,o=r.reduce((function(t,e,r){return t+((-1*r+(i-1))%n+1)*Et.indexOf(e.charCodeAt(0))}),0);return Et[o%47]===t[e].charCodeAt(0)}},{key:"_verifyChecksums",value:function(t){return this._matchCheckChar(t,t.length-2,20)&&this._matchCheckChar(t,t.length-1,15)}},{key:"_decode",value:function(t,e){if(!(e=this._findStart()))return null;var n,r,i=new Uint16Array([0,0,0,0,0,0]),o=[],a=this._nextSet(this._row,e.end);do{i=this._toCounters(a,i);var u=this._toPattern(i);if(u<0)return null;if(null===(r=this._patternToChar(u)))return null;o.push(r),n=a,a+=R.a.sum(i),a=this._nextSet(this._row,a)}while("*"!==r);return o.pop(),o.length&&this._verifyEnd(n,a)&&this._verifyChecksums(o)?(o=o.slice(0,o.length-2),null===(o=this._decodeExtended(o))?null:{code:o.join(""),start:e.start,end:a,startInfo:e,decodedCodes:o,format:this.FORMAT}):null}}]),n}(S),code_32_reader:function(t){_()(n,t);var e=Rt(n);function n(){var t;h()(this,n);for(var r=arguments.length,i=new Array(r),o=0;o<r;o++)i[o]=arguments[o];return t=e.call.apply(e,[this].concat(i)),A()(g()(t),"FORMAT","code_32_reader"),t}return p()(n,[{key:"_checkChecksum",value:function(t){return!!t}},{key:"_decode",value:function(t,e){var r=G()(x()(n.prototype),"_decode",this).call(this,t,e);if(!r)return null;var i=r.code;if(!i)return null;if(!(i=i.replace(Ot,"")).match(kt))return null;if(!this._checkChecksum(i))return null;for(var o,a=0,u=function(t){var e=i.charAt(t),n=Ct.find((function(t){return t.character_code===e}));if(void 0!==n){var r=n.digit_code,o=i.length-t-1;r*=Math.pow(32,o),a+=r}},c=0;c<=i.length;c++)u(c);if(a.toString().length<9)for(var s=9-a.toString().length,f=0;f<s;f++)o="0"+a;return o="A"+a,r.code=o,r}}]),n}(V)},Mt={registerReader:function(t,e){jt[t]=e},create:function(t,e){var n={frequency:null,pattern:null,overlay:null},r=[];function o(){t.readers.forEach((function(t){var e,n={},o=[];"object"===i()(t)?(e=t.format,n=t.config):"string"==typeof t&&(e=t),n.supplements&&(o=n.supplements.map((function(t){return new jt[t]})));try{var a=new jt[e](n,o);r.push(a)}catch(t){throw console.error("* Error constructing reader ",e,t),t}}))}function a(t){var n,i=null,o=s.getBarcodeLine(e,t[0],t[1]);for(s.toBinaryLine(o),n=0;n<r.length&&null===i;n++)i=r[n].decodePattern(o.line);return null===i?null:{codeResult:i,barcodeLine:o}}function u(t){var r,i;n.overlay;var o=function(t){return Math.sqrt(Math.pow(Math.abs(t[1].y-t[0].y),2)+Math.pow(Math.abs(t[1].x-t[0].x),2))}(r=function(t){return[{x:(t[1][0]-t[0][0])/2+t[0][0],y:(t[1][1]-t[0][1])/2+t[0][1]},{x:(t[3][0]-t[2][0])/2+t[2][0],y:(t[3][1]-t[2][1])/2+t[2][1]}]}(t)),u=Math.atan2(r[1].y-r[0].y,r[1].x-r[0].x);return null===(r=function(t,n,r){function i(e){var r=e*Math.sin(n),i=e*Math.cos(n);t[0].y-=r,t[0].x-=i,t[1].y+=r,t[1].x+=i}for(i(r);r>1&&(!e.inImageWithBorder(t[0])||!e.inImageWithBorder(t[1]));)i(-(r-=Math.ceil(r/2)));return t}(r,u,Math.floor(.1*o)))?null:(null===(i=a(r))&&(i=function(t,e,n){var r,i,o,u=Math.sqrt(Math.pow(t[1][0]-t[0][0],2)+Math.pow(t[1][1]-t[0][1],2)),c=null,s=Math.sin(n),f=Math.cos(n);for(r=1;r<16&&null===c;r++)o={y:(i=u/16*r*(r%2==0?-1:1))*s,x:i*f},e[0].y+=o.x,e[0].x-=o.y,e[1].y+=o.x,e[1].x-=o.y,c=a(e);return c}(t,r,u)),null===i?null:{codeResult:i.codeResult,line:r,angle:u,pattern:i.barcodeLine.line,threshold:i.barcodeLine.threshold})}return o(),{decodeFromBoundingBox:function(t){return u(t)},decodeFromBoundingBoxes:function(e){var n,r,i=[],o=t.multiple;for(n=0;n<e.length;n++){var a=e[n];if((r=u(a)||{}).box=a,o)i.push(r);else if(r.codeResult)return r}if(o)return{barcodes:i}},decodeFromImage:function(t){return function(t){for(var e=null,n=0;n<r.length&&null===e;n++)e=r[n].decodeImage?r[n].decodeImage(t):null;return e}(t)},registerReader:function(t,e){if(jt[t])throw new Error("cannot register existing reader",t);jt[t]=e},setReaders:function(e){t.readers=e,r.length=0,o()}}}},Tt=function(){var t={};function e(e){return t[e]||(t[e]={subscribers:[]}),t[e]}function n(t,e){t.async?setTimeout((function(){t.callback(e)}),4):t.callback(e)}function r(t,n,r){var i;if("function"==typeof n)i={callback:n,async:r};else if(!(i=n).callback)throw new Error("Callback was not specified on options");e(t).subscribers.push(i)}return{subscribe:function(t,e,n){return r(t,e,n)},publish:function(t,r){var i=e(t),o=i.subscribers;o.filter((function(t){return!!t.once})).forEach((function(t){n(t,r)})),i.subscribers=o.filter((function(t){return!t.once})),i.subscribers.forEach((function(t){n(t,r)}))},once:function(t,e){var n=arguments.length>2&&void 0!==arguments[2]&&arguments[2];r(t,{callback:e,async:n,once:!0})},unsubscribe:function(n,r){if(n){var i=e(n);i.subscribers=i&&r?i.subscribers.filter((function(t){return t.callback!==r})):[]}else t={}}}}(),It=n(17),Dt=n.n(It),Pt=n(27),Lt=n.n(Pt);function Ut(){try{return navigator.mediaDevices.enumerateDevices()}catch(t){return Promise.reject(new Error("enumerateDevices is not defined"))}}function zt(t){try{return navigator.mediaDevices.getUserMedia(t)}catch(t){return Promise.reject(new Error("getUserMedia is not defined"))}}function Bt(t){return new Promise((function(e,n){var r=10;!function i(){r>0?t.videoWidth>10&&t.videoHeight>10?e():window.setTimeout(i,500):n(new Error("Unable to play video stream. Is webcam working?")),r--}()}))}function Nt(t,e){return Wt.apply(this,arguments)}function Wt(){return(Wt=Lt()(Dt.a.mark((function t(e,n){var r;return Dt.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,zt(n);case 2:return r=t.sent,St=r,e.setAttribute("autoplay","true"),e.setAttribute("muted","true"),e.setAttribute("playsinline","true"),e.srcObject=r,e.addEventListener("loadedmetadata",(function(){e.play()})),t.abrupt("return",Bt(e));case 10:case"end":return t.stop()}}),t)})))).apply(this,arguments)}function Ft(t){var e=Object(C.pick)(t,["width","height","facingMode","aspectRatio","deviceId"]);return void 0!==t.minAspectRatio&&t.minAspectRatio>0&&(e.aspectRatio=t.minAspectRatio,console.log("WARNING: Constraint 'minAspectRatio' is deprecated; Use 'aspectRatio' instead")),void 0!==t.facing&&(e.facingMode=t.facing,console.log("WARNING: Constraint 'facing' is deprecated. Use 'facingMode' instead'")),e}function qt(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},e=Ft(t);return e&&e.deviceId&&e.facingMode&&delete e.facingMode,Promise.resolve({audio:!1,video:e})}function Vt(){return(Vt=Lt()(Dt.a.mark((function t(){var e;return Dt.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return t.next=2,Ut();case 2:return e=t.sent,t.abrupt("return",e.filter((function(t){return"videoinput"===t.kind})));case 4:case"end":return t.stop()}}),t)})))).apply(this,arguments)}function Yt(){if(!St)return null;var t=St.getVideoTracks();return t&&(null==t?void 0:t.length)?t[0]:null}var Gt={request:function(t,e){return Lt()(Dt.a.mark((function n(){var r;return Dt.a.wrap((function(n){for(;;)switch(n.prev=n.next){case 0:return n.next=2,qt(e);case 2:return r=n.sent,n.abrupt("return",Nt(t,r));case 4:case"end":return n.stop()}}),n)})))()},release:function(){var t=St&&St.getVideoTracks();t&&t.length&&t[0].stop(),St=null},enumerateVideoDevices:function(){return Vt.apply(this,arguments)},getActiveStreamLabel:function(){var t=Yt();return t?t.label:""},getActiveTrack:Yt};var Ht={create:function(t){var e,n=document.createElement("canvas"),r=n.getContext("2d"),i=[],o=null!==(e=t.capacity)&&void 0!==e?e:20,a=!0===t.capture;function u(e){return!!o&&e&&!function(t,e){return e&&e.some((function(e){return Object.keys(e).every((function(n){return e[n]===t[n]}))}))}(e,t.blacklist)&&function(t,e){return"function"!=typeof e||e(t)}(e,t.filter)}return{addResult:function(t,e,c){var s={};u(c)&&(o--,s.codeResult=c,a&&(n.width=e.x,n.height=e.y,f.a.drawImage(t,e,r),s.frame=n.toDataURL()),i.push(s))},getResults:function(){return i}}}},$t={inputStream:{name:"Live",type:"LiveStream",constraints:{width:640,height:480,facingMode:"environment"},area:{top:"0%",right:"0%",left:"0%",bottom:"0%"},singleChannel:!1},locate:!0,numOfWorkers:4,decoder:{readers:["code_128_reader"]},locator:{halfSample:!0,patchSize:"medium"}},Xt=n(7),Zt=function t(){h()(this,t),A()(this,"config",void 0),A()(this,"inputStream",void 0),A()(this,"framegrabber",void 0),A()(this,"inputImageWrapper",void 0),A()(this,"stopped",!1),A()(this,"boxSize",void 0),A()(this,"resultCollector",void 0),A()(this,"decoder",void 0),A()(this,"workerPool",[]),A()(this,"onUIThread",!0),A()(this,"canvasContainer",new Kt)},Qt=function t(){h()(this,t),A()(this,"image",void 0),A()(this,"overlay",void 0)},Kt=function t(){h()(this,t),A()(this,"ctx",void 0),A()(this,"dom",void 0),this.ctx=new Qt,this.dom=new Qt},Jt=n(23);function te(t){if("undefined"==typeof document)return null;if(t instanceof HTMLElement&&t.nodeName&&1===t.nodeType)return t;var e="string"==typeof t?t:"#interactive.viewport";return document.querySelector(e)}function ee(t,e){var n=function(t,e){var n=document.querySelector(t);return n||((n=document.createElement("canvas")).className=e),n}(t,e),r=n.getContext("2d");return{canvas:n,context:r}}function ne(t){var e,n,r,i,o=te(null==t||null===(e=t.config)||void 0===e||null===(n=e.inputStream)||void 0===n?void 0:n.target),a=null==t||null===(r=t.config)||void 0===r||null===(i=r.inputStream)||void 0===i?void 0:i.type;if(!a)return null;var u=function(t){if("undefined"!=typeof document){var e=ee("canvas.imgBuffer","imgBuffer"),n=ee("canvas.drawingBuffer","drawingBuffer");return e.canvas.width=n.canvas.width=t.x,e.canvas.height=n.canvas.height=t.y,{dom:{image:e.canvas,overlay:n.canvas},ctx:{image:e.context,overlay:n.context}}}return null}(t.inputStream.getCanvasSize());if(!u)return{dom:{image:null,overlay:null},ctx:{image:null,overlay:null}};var c=u.dom;return"undefined"!=typeof document&&o&&("ImageStream"!==a||o.contains(c.image)||o.appendChild(c.image),o.contains(c.overlay)||o.appendChild(c.overlay)),u}var re={274:"orientation"},ie=Object.keys(re).map((function(t){return re[t]}));function oe(t){return new Promise((function(e){var n=new FileReader;n.onload=function(t){return e(t.target.result)},n.readAsArrayBuffer(t)}))}function ae(t){return new Promise((function(e,n){var r=new XMLHttpRequest;r.open("GET",t,!0),r.responseType="blob",r.onreadystatechange=function(){r.readyState!==XMLHttpRequest.DONE||200!==r.status&&0!==r.status||e(this.response)},r.onerror=n,r.send()}))}function ue(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:ie,n=new DataView(t),r=t.byteLength,i=e.reduce((function(t,e){var n=Object.keys(re).filter((function(t){return re[t]===e}))[0];return n&&(t[n]=e),t}),{}),o=2;if(255!==n.getUint8(0)||216!==n.getUint8(1))return!1;for(;o<r;){if(255!==n.getUint8(o))return!1;if(225===n.getUint8(o+1))return ce(n,o+4,i);o+=2+n.getUint16(o+2)}return!1}function ce(t,e,n){if("Exif"!==function(t,e,n){for(var r="",i=e;i<e+n;i++)r+=String.fromCharCode(t.getUint8(i));return r}(t,e,4))return!1;var r,i=e+6;if(18761===t.getUint16(i))r=!1;else{if(19789!==t.getUint16(i))return!1;r=!0}if(42!==t.getUint16(i+2,!r))return!1;var o=t.getUint32(i+4,!r);return!(o<8)&&function(t,e,n,r,i){for(var o=t.getUint16(n,!i),a={},u=0;u<o;u++){var c=n+12*u+2,s=r[t.getUint16(c,!i)];s&&(a[s]=se(t,c,e,n,i))}return a}(t,i,i+o,n,r)}function se(t,e,n,r,i){var o=t.getUint16(e+2,!i),a=t.getUint32(e+4,!i);switch(o){case 3:if(1===a)return t.getUint16(e+8,!i)}return null}var fe={};function le(t,e){t.onload=function(){e.loaded(this)}}fe.load=function(t,e,n,r,i){var o,a,u,c=new Array(r),s=new Array(c.length);if(!1===i)c[0]=t;else for(o=0;o<c.length;o++)u=n+o,c[o]="".concat(t,"image-").concat("00".concat(u).slice(-3),".jpg");for(s.notLoaded=[],s.addImage=function(t){s.notLoaded.push(t)},s.loaded=function(n){for(var r=s.notLoaded,o=0;o<r.length;o++)if(r[o]===n){r.splice(o,1);for(var a=0;a<c.length;a++){var u=c[a].substr(c[a].lastIndexOf("/"));if(-1!==n.src.lastIndexOf(u)){s[a]={img:n};break}}break}0===r.length&&(!1===i?function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:ie;return/^blob:/i.test(t)?ae(t).then(oe).then((function(t){return ue(t,e)})):Promise.resolve(null)}(t,["orientation"]).then((function(t){s[0].tags=t,e(s)})).catch((function(t){console.log(t),e(s)})):e(s))},o=0;o<c.length;o++)a=new Image,s.addImage(a),le(a,s),a.src=c[o]};var he=fe,de={createVideoStream:function(t){var e,n,r=null,i=["canrecord","ended"],o={},a={x:0,y:0,type:"Point"},u={x:0,y:0,type:"XYSize"};var c={getRealWidth:function(){return t.videoWidth},getRealHeight:function(){return t.videoHeight},getWidth:function(){return e},getHeight:function(){return n},setWidth:function(t){e=t},setHeight:function(t){n=t},setInputStream:function(t){r=t,this.setAttribute("src",void 0!==t.src?t.src:"")},ended:function(){return t.ended},getConfig:function(){return r},setAttribute:function(e,n){t&&t.setAttribute(e,n)},pause:function(){t.pause()},play:function(){t.play()},setCurrentTime:function(t){var e;"LiveStream"!==(null===(e=r)||void 0===e?void 0:e.type)&&this.setAttribute("currentTime",t.toString())},addEventListener:function(e,n,r){-1!==i.indexOf(e)?(o[e]||(o[e]=[]),o[e].push(n)):t.addEventListener(e,n,r)},clearEventHandlers:function(){i.forEach((function(e){var n=o[e];n&&n.length>0&&n.forEach((function(n){t.removeEventListener(e,n)}))}))},trigger:function(i,a){var s,f,l,h,d,p=o[i];if("canrecord"===i&&(h=t.videoWidth,d=t.videoHeight,e=(null===(f=r)||void 0===f?void 0:f.size)?h/d>1?r.size:Math.floor(h/d*r.size):h,n=(null===(l=r)||void 0===l?void 0:l.size)?h/d>1?Math.floor(d/h*r.size):r.size:d,u.x=e,u.y=n),p&&p.length>0)for(s=0;s<p.length;s++)p[s].apply(c,a)},setTopRight:function(t){a.x=t.x,a.y=t.y},getTopRight:function(){return a},setCanvasSize:function(t){u.x=t.x,u.y=t.y},getCanvasSize:function(){return u},getFrame:function(){return t}};return c},createLiveStream:function(t){t&&t.setAttribute("autoplay","true");var e=de.createVideoStream(t);return e.ended=function(){return!1},e},createImageStream:function(){var t,e,n=null,r=0,i=0,o=0,a=!0,u=!1,c=null,s=0,f=null,l=!1,h=["canrecord","ended"],d={},p={x:0,y:0,type:"Point"},v={x:0,y:0,type:"XYSize"};function g(t,e){var n,r=d[t];if(r&&r.length>0)for(n=0;n<r.length;n++)r[n].apply(y,e)}var y={trigger:g,getWidth:function(){return t},getHeight:function(){return e},setWidth:function(e){t=e},setHeight:function(t){e=t},getRealWidth:function(){return r},getRealHeight:function(){return i},setInputStream:function(a){var l;n=a,!1===a.sequence?(f=a.src,s=1):(f=a.src,s=a.length),u=!1,he.load(f,(function(a){var s,f;if(c=a,a[0].tags&&a[0].tags.orientation)switch(a[0].tags.orientation){case 6:case 8:r=a[0].img.height,i=a[0].img.width;break;default:r=a[0].img.width,i=a[0].img.height}else r=a[0].img.width,i=a[0].img.height;t=(null===(s=n)||void 0===s?void 0:s.size)?r/i>1?n.size:Math.floor(r/i*n.size):r,e=(null===(f=n)||void 0===f?void 0:f.size)?r/i>1?Math.floor(i/r*n.size):n.size:i,v.x=t,v.y=e,u=!0,o=0,setTimeout((function(){g("canrecord",[])}),0)}),1,s,null===(l=n)||void 0===l?void 0:l.sequence)},ended:function(){return l},setAttribute:function(){},getConfig:function(){return n},pause:function(){a=!0},play:function(){a=!1},setCurrentTime:function(t){o=t},addEventListener:function(t,e){-1!==h.indexOf(t)&&(d[t]||(d[t]=[]),d[t].push(e))},clearEventHandlers:function(){Object.keys(d).forEach((function(t){return delete d[t]}))},setTopRight:function(t){p.x=t.x,p.y=t.y},getTopRight:function(){return p},setCanvasSize:function(t){v.x=t.x,v.y=t.y},getCanvasSize:function(){return v},getFrame:function(){var t,e;if(!u)return null;a||(t=null===(e=c)||void 0===e?void 0:e[o],o<s-1?o++:setTimeout((function(){l=!0,g("ended",[])}),0));return t}};return y}},pe=de,ve=n(25),ge=n.n(ve),ye=n(66),_e=n.n(ye),me={createVideoStream:function(){throw new Error("createVideoStream not available")},createLiveStream:function(){throw new Error("createLiveStream not available")},createImageStream:function(){var t,e,n,r=null,i=0,o=0,a=!1,u=null,c=["canrecord","ended"],s={},f={x:0,y:0,type:"Point"},l={x:0,y:0,type:"XYSize"};function h(t,e){var n=s[t];if(n&&n.length>0)for(var r=0;r<n.length;r++)n[r].apply(d,e)}var d={trigger:h,getWidth:function(){return e},getHeight:function(){return n},setWidth:function(t){e=t},setHeight:function(t){n=t},getRealWidth:function(){return i},getRealHeight:function(){return o},setInputStream:function(c){var s,f;t=null===(s=r=c)||void 0===s?void 0:s.src,1,a=!1,_e()(t,null===(f=r)||void 0===f?void 0:f.mime,(function(t,c){var s,f;if(t)throw console.error("**** quagga loadImages error:",t),new Error("error decoding pixels in loadImages");a=!0,u=c;var d=ge()(c.shape,2);i=d[0],o=d[1],e=(null===(s=r)||void 0===s?void 0:s.size)?i/o>1?r.size:Math.floor(i/o*r.size):i,n=(null===(f=r)||void 0===f?void 0:f.size)?i/o>1?Math.floor(o/i*r.size):r.size:o,l.x=e,l.y=n,setTimeout((function(){h("canrecord",[])}),0)}))},ended:function(){return!1},setAttribute:function(){},getConfig:function(){return r},pause:function(){!0},play:function(){!1},setCurrentTime:function(t){t},addEventListener:function(t,e){-1!==c.indexOf(t)&&(s[t]||(s[t]=[]),s[t].push(e))},clearEventHandlers:function(){Object.keys(s).forEach((function(t){return delete s[t]}))},setTopRight:function(t){f.x=t.x,f.y=t.y},getTopRight:function(){return f},setCanvasSize:function(t){l.x=t.x,l.y=t.y},getCanvasSize:function(){return l},getFrame:function(){return a?u:null}};return d}},be=pe,we=n(62),xe=n.n(we),Ee=n(8),Ae=Math.PI/180;var Re={create:function(t,e){var n,r={},i=t.getConfig(),o=(Object(Ee.imageRef)(t.getRealWidth(),t.getRealHeight()),t.getCanvasSize()),a=Object(Ee.imageRef)(t.getWidth(),t.getHeight()),u=t.getTopRight(),c=u.x,s=u.y,f=null,l=null;return(n=e||document.createElement("canvas")).width=o.x,n.height=o.y,f=n.getContext("2d"),l=new Uint8Array(a.x*a.y),r.attachData=function(t){l=t},r.getData=function(){return l},r.grab=function(){var e,r=i.halfSample,u=t.getFrame(),h=u,d=0;if(h){if(function(t,e){t.width!==e.x&&(t.width=e.x),t.height!==e.y&&(t.height=e.y)}(n,o),"ImageStream"===i.type&&(h=u.img,u.tags&&u.tags.orientation))switch(u.tags.orientation){case 6:d=90*Ae;break;case 8:d=-90*Ae}return 0!==d?(f.translate(o.x/2,o.y/2),f.rotate(d),f.drawImage(h,-o.y/2,-o.x/2,o.y,o.x),f.rotate(-d),f.translate(-o.x/2,-o.y/2)):f.drawImage(h,0,0,o.x,o.y),e=f.getImageData(c,s,a.x,a.y).data,r?Object(Ee.grayAndHalfSampleFromCanvasData)(e,a,l):Object(Ee.computeGray)(e,l,i),!0}return!1},r.getSize=function(){return a},r}},Se=Re;function Oe(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,r)}return n}function ke(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?Oe(Object(n),!0).forEach((function(e){A()(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):Oe(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}var Ce=[];function je(t){return ke(ke({},t),{},{inputStream:ke(ke({},t.inputStream),{},{target:null})})}function Me(t){if(t){var e=t().default;if(!e)return void self.postMessage({event:"error",message:"Quagga could not be created"})}var n;function r(t){self.postMessage({event:"processed",imageData:n.data,result:t},[n.data.buffer])}function i(){self.postMessage({event:"initialized",imageData:n.data},[n.data.buffer])}self.onmessage=function(t){if("init"===t.data.cmd){var o=t.data.config;o.numOfWorkers=0,n=new e.ImageWrapper({x:t.data.size.x,y:t.data.size.y},new Uint8Array(t.data.imageData)),e.init(o,i,n),e.onProcessed(r)}else"process"===t.data.cmd?(n.data=new Uint8Array(t.data.imageData),e.start()):"setReaders"===t.data.cmd?e.setReaders(t.data.readers):"registerReader"===t.data.cmd&&e.registerReader(t.data.name,t.data.reader)}}function Te(t,e,n){var r,i,o=("undefined"!=typeof __factorySource__&&(i=__factorySource__),r=new Blob(["("+Me.toString()+")("+i+");"],{type:"text/javascript"}),window.URL.createObjectURL(r)),a={worker:new Worker(o),imageData:new Uint8Array(e.getWidth()*e.getHeight()),busy:!0};a.worker.onmessage=function(t){"initialized"===t.data.event?(URL.revokeObjectURL(o),a.busy=!1,a.imageData=new Uint8Array(t.data.imageData),n(a)):"processed"===t.data.event?(a.imageData=new Uint8Array(t.data.imageData),a.busy=!1):t.data.event},a.worker.postMessage({cmd:"init",size:{x:e.getWidth(),y:e.getHeight()},imageData:a.imageData,config:je(t)},[a.imageData.buffer])}function Ie(t,e,n,r){var i=t-Ce.length;if(0===i&&r)r();else if(i<0){Ce.slice(i).forEach((function(t){t.worker.terminate()})),Ce=Ce.slice(0,i),r&&r()}else{var o=function(e){Ce.push(e),Ce.length>=t&&r&&r()};if(e)for(var a=0;a<i;a++)Te(e,n,o)}}function De(t,e,n){for(var r=t.length;r--;)t[r][0]+=e,t[r][1]+=n}var Pe="undefined"==typeof window?me:be,Le="undefined"==typeof window?xe.a:Se,Ue=function(){function t(){var e=this;h()(this,t),A()(this,"context",new Zt),A()(this,"canRecord",(function(t){var n;e.context.config&&(Jt.a.checkImageConstraints(e.context.inputStream,null===(n=e.context.config)||void 0===n?void 0:n.locator),e.initCanvas(),e.context.framegrabber=Le.create(e.context.inputStream,e.context.canvasContainer.dom.image),void 0===e.context.config.numOfWorkers&&(e.context.config.numOfWorkers=0),Ie(e.context.config.numOfWorkers,e.context.config,e.context.inputStream,(function(){var n;0===(null===(n=e.context.config)||void 0===n?void 0:n.numOfWorkers)&&e.initializeData(),e.ready(t)})))})),A()(this,"update",(function(){if(e.context.onUIThread){var t,n=(i=e.context.framegrabber,Ce.length?!!(o=Ce.filter((function(t){return!t.busy}))[0])&&(i.attachData(o.imageData),i.grab()&&(o.busy=!0,o.worker.postMessage({cmd:"process",imageData:o.imageData},[o.imageData.buffer])),!0):null);if(!n)e.context.framegrabber.attachData(null===(t=e.context.inputImageWrapper)||void 0===t?void 0:t.data),e.context.framegrabber.grab()&&(n||e.locateAndDecode())}else{var r;e.context.framegrabber.attachData(null===(r=e.context.inputImageWrapper)||void 0===r?void 0:r.data),e.context.framegrabber.grab(),e.locateAndDecode()}var i,o}))}return p()(t,[{key:"initBuffers",value:function(t){if(this.context.config){var e=function(t,e,n){var r=e||new o.a({x:t.getWidth(),y:t.getHeight(),type:"XYSize"}),i=[Object(Xt.clone)([0,0]),Object(Xt.clone)([0,r.size.y]),Object(Xt.clone)([r.size.x,r.size.y]),Object(Xt.clone)([r.size.x,0])];return Jt.a.init(r,n),{inputImageWrapper:r,boxSize:i}}(this.context.inputStream,t,this.context.config.locator),n=e.inputImageWrapper,r=e.boxSize;this.context.inputImageWrapper=n,this.context.boxSize=r}}},{key:"initializeData",value:function(t){this.context.config&&(this.initBuffers(t),this.context.decoder=Mt.create(this.context.config.decoder,this.context.inputImageWrapper))}},{key:"getViewPort",value:function(){return this.context.config&&this.context.config.inputStream?te(this.context.config.inputStream.target):null}},{key:"ready",value:function(t){this.context.inputStream.play(),t()}},{key:"initCanvas",value:function(){var t=ne(this.context);if(t){var e=t.ctx,n=t.dom;this.context.canvasContainer.dom.image=n.image,this.context.canvasContainer.dom.overlay=n.overlay,this.context.canvasContainer.ctx.image=e.image,this.context.canvasContainer.ctx.overlay=e.overlay}}},{key:"initInputStream",value:function(t){if(this.context.config&&this.context.config.inputStream){var e=this.context.config.inputStream,n=e.type,r=e.constraints,i=function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"LiveStream",e=arguments.length>1?arguments[1]:void 0,n=arguments.length>2?arguments[2]:void 0;switch(t){case"VideoStream":var r=document.createElement("video");return{video:r,inputStream:n.createVideoStream(r)};case"ImageStream":return{inputStream:n.createImageStream()};case"LiveStream":var i=null;return e&&((i=e.querySelector("video"))||(i=document.createElement("video"),e.appendChild(i))),{video:i,inputStream:n.createLiveStream(i)};default:return console.error("* setupInputStream invalid type ".concat(t)),{video:null,inputStream:null}}}(n,this.getViewPort(),Pe),o=i.video,a=i.inputStream;"LiveStream"===n&&o&&Gt.request(o,r).then((function(){return a.trigger("canrecord")})).catch((function(e){return t(e)})),a.setAttribute("preload","auto"),a.setInputStream(this.context.config.inputStream),a.addEventListener("canrecord",this.canRecord.bind(void 0,t)),this.context.inputStream=a}}},{key:"getBoundingBoxes",value:function(){var t;return(null===(t=this.context.config)||void 0===t?void 0:t.locate)?Jt.a.locate():[[Object(Xt.clone)(this.context.boxSize[0]),Object(Xt.clone)(this.context.boxSize[1]),Object(Xt.clone)(this.context.boxSize[2]),Object(Xt.clone)(this.context.boxSize[3])]]}},{key:"transformResult",value:function(t){var e=this,n=this.context.inputStream.getTopRight(),r=n.x,i=n.y;if((0!==r||0!==i)&&(t.barcodes&&t.barcodes.forEach((function(t){return e.transformResult(t)})),t.line&&2===t.line.length&&function(t,e,n){t[0].x+=e,t[0].y+=n,t[1].x+=e,t[1].y+=n}(t.line,r,i),t.box&&De(t.box,r,i),t.boxes&&t.boxes.length>0))for(var o=0;o<t.boxes.length;o++)De(t.boxes[o],r,i)}},{key:"addResult",value:function(t,e){var n=this;e&&this.context.resultCollector&&(t.barcodes?t.barcodes.filter((function(t){return t.codeResult})).forEach((function(t){return n.addResult(t,e)})):t.codeResult&&this.context.resultCollector.addResult(e,this.context.inputStream.getCanvasSize(),t.codeResult))}},{key:"hasCodeResult",value:function(t){return!(!t||!(t.barcodes?t.barcodes.some((function(t){return t.codeResult})):t.codeResult))}},{key:"publishResult",value:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:null,e=arguments.length>1?arguments[1]:void 0,n=t;t&&this.context.onUIThread&&(this.transformResult(t),this.addResult(t,e),n=t.barcodes||t),Tt.publish("processed",n),this.hasCodeResult(t)&&Tt.publish("detected",n)}},{key:"locateAndDecode",value:function(){var t=this.getBoundingBoxes();if(t){var e,n=this.context.decoder.decodeFromBoundingBoxes(t)||{};n.boxes=t,this.publishResult(n,null===(e=this.context.inputImageWrapper)||void 0===e?void 0:e.data)}else{var r,i=this.context.decoder.decodeFromImage(this.context.inputImageWrapper);if(i)this.publishResult(i,null===(r=this.context.inputImageWrapper)||void 0===r?void 0:r.data);else this.publishResult()}}},{key:"startContinuousUpdate",value:function(){var t,e=this,n=null,r=1e3/((null===(t=this.context.config)||void 0===t?void 0:t.frequency)||60);this.context.stopped=!1;var i=this.context;!function t(o){n=n||o,i.stopped||(o>=n&&(n+=r,e.update()),window.requestAnimationFrame(t))}(performance.now())}},{key:"start",value:function(){var t,e;this.context.onUIThread&&"LiveStream"===(null===(t=this.context.config)||void 0===t||null===(e=t.inputStream)||void 0===e?void 0:e.type)?this.startContinuousUpdate():this.update()}},{key:"stop",value:function(){var t;this.context.stopped=!0,Ie(0),(null===(t=this.context.config)||void 0===t?void 0:t.inputStream)&&"LiveStream"===this.context.config.inputStream.type&&(Gt.release(),this.context.inputStream.clearEventHandlers())}},{key:"setReaders",value:function(t){this.context.decoder&&this.context.decoder.setReaders(t),function(t){Ce.forEach((function(e){return e.worker.postMessage({cmd:"setReaders",readers:t})}))}(t)}},{key:"registerReader",value:function(t,e){Mt.registerReader(t,e),this.context.decoder&&this.context.decoder.registerReader(t,e),function(t,e){Ce.forEach((function(n){return n.worker.postMessage({cmd:"registerReader",name:t,reader:e})}))}(t,e)}}]),t}(),ze=new Ue,Be=ze.context,Ne={init:function(t,e,n){var r,i=arguments.length>3&&void 0!==arguments[3]?arguments[3]:ze;return e||(r=new Promise((function(t,n){e=function(e){e?n(e):t()}}))),i.context.config=Object(C.merge)({},$t,t),i.context.config.numOfWorkers>0&&(i.context.config.numOfWorkers=0),n?(i.context.onUIThread=!1,i.initializeData(n),e&&e()):i.initInputStream(e),r},start:function(){ze.start()},stop:function(){ze.stop()},pause:function(){Be.stopped=!0},onDetected:function(t){t&&("function"==typeof t||"object"===i()(t)&&t.callback)?Tt.subscribe("detected",t):console.trace("* warning: Quagga.onDetected called with invalid callback, ignoring")},offDetected:function(t){Tt.unsubscribe("detected",t)},onProcessed:function(t){t&&("function"==typeof t||"object"===i()(t)&&t.callback)?Tt.subscribe("processed",t):console.trace("* warning: Quagga.onProcessed called with invalid callback, ignoring")},offProcessed:function(t){Tt.unsubscribe("processed",t)},setReaders:function(t){t?ze.setReaders(t):console.trace("* warning: Quagga.setReaders called with no readers, ignoring")},registerReader:function(t,e){t?e?ze.registerReader(t,e):console.trace("* warning: Quagga.registerReader called with no reader, ignoring"):console.trace("* warning: Quagga.registerReader called with no name, ignoring")},registerResultCollector:function(t){t&&"function"==typeof t.addResult&&(Be.resultCollector=t)},get canvas(){return Be.canvasContainer},decodeSingle:function(t,e){var n=this,r=new Ue;return(t=Object(C.merge)({inputStream:{type:"ImageStream",sequence:!1,size:800,src:t.src},numOfWorkers:1,locator:{halfSample:!1}},t)).numOfWorkers>0&&(t.numOfWorkers=0),t.numOfWorkers>0&&("undefined"==typeof Blob||"undefined"==typeof Worker)&&(console.warn("* no Worker and/or Blob support - forcing numOfWorkers to 0"),t.numOfWorkers=0),new Promise((function(i,o){try{n.init(t,(function(){Tt.once("processed",(function(t){r.stop(),e&&e.call(null,t),i(t)}),!0),r.start()}),null,r)}catch(t){o(t)}}))},get default(){return Ne},BarcodeReader:S,CameraAccess:Gt,ImageDebug:f.a,ImageWrapper:o.a,ResultCollector:Ht};e.default=Ne}]).default}));

/***/ }),

/***/ "./node_modules/jquery/dist/jquery.js":
/*!********************************************!*\
  !*** ./node_modules/jquery/dist/jquery.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*!
 * jQuery JavaScript Library v3.5.1
 * https://jquery.com/
 *
 * Includes Sizzle.js
 * https://sizzlejs.com/
 *
 * Copyright JS Foundation and other contributors
 * Released under the MIT license
 * https://jquery.org/license
 *
 * Date: 2020-05-04T22:49Z
 */
( function( global, factory ) {

	"use strict";

	if (  true && typeof module.exports === "object" ) {

		// For CommonJS and CommonJS-like environments where a proper `window`
		// is present, execute the factory and get jQuery.
		// For environments that do not have a `window` with a `document`
		// (such as Node.js), expose a factory as module.exports.
		// This accentuates the need for the creation of a real `window`.
		// e.g. var jQuery = require("jquery")(window);
		// See ticket #14549 for more info.
		module.exports = global.document ?
			factory( global, true ) :
			function( w ) {
				if ( !w.document ) {
					throw new Error( "jQuery requires a window with a document" );
				}
				return factory( w );
			};
	} else {
		factory( global );
	}

// Pass this if window is not defined yet
} )( typeof window !== "undefined" ? window : this, function( window, noGlobal ) {

// Edge <= 12 - 13+, Firefox <=18 - 45+, IE 10 - 11, Safari 5.1 - 9+, iOS 6 - 9.1
// throw exceptions when non-strict code (e.g., ASP.NET 4.5) accesses strict mode
// arguments.callee.caller (trac-13335). But as of jQuery 3.0 (2016), strict mode should be common
// enough that all such attempts are guarded in a try block.
"use strict";

var arr = [];

var getProto = Object.getPrototypeOf;

var slice = arr.slice;

var flat = arr.flat ? function( array ) {
	return arr.flat.call( array );
} : function( array ) {
	return arr.concat.apply( [], array );
};


var push = arr.push;

var indexOf = arr.indexOf;

var class2type = {};

var toString = class2type.toString;

var hasOwn = class2type.hasOwnProperty;

var fnToString = hasOwn.toString;

var ObjectFunctionString = fnToString.call( Object );

var support = {};

var isFunction = function isFunction( obj ) {

      // Support: Chrome <=57, Firefox <=52
      // In some browsers, typeof returns "function" for HTML <object> elements
      // (i.e., `typeof document.createElement( "object" ) === "function"`).
      // We don't want to classify *any* DOM node as a function.
      return typeof obj === "function" && typeof obj.nodeType !== "number";
  };


var isWindow = function isWindow( obj ) {
		return obj != null && obj === obj.window;
	};


var document = window.document;



	var preservedScriptAttributes = {
		type: true,
		src: true,
		nonce: true,
		noModule: true
	};

	function DOMEval( code, node, doc ) {
		doc = doc || document;

		var i, val,
			script = doc.createElement( "script" );

		script.text = code;
		if ( node ) {
			for ( i in preservedScriptAttributes ) {

				// Support: Firefox 64+, Edge 18+
				// Some browsers don't support the "nonce" property on scripts.
				// On the other hand, just using `getAttribute` is not enough as
				// the `nonce` attribute is reset to an empty string whenever it
				// becomes browsing-context connected.
				// See https://github.com/whatwg/html/issues/2369
				// See https://html.spec.whatwg.org/#nonce-attributes
				// The `node.getAttribute` check was added for the sake of
				// `jQuery.globalEval` so that it can fake a nonce-containing node
				// via an object.
				val = node[ i ] || node.getAttribute && node.getAttribute( i );
				if ( val ) {
					script.setAttribute( i, val );
				}
			}
		}
		doc.head.appendChild( script ).parentNode.removeChild( script );
	}


function toType( obj ) {
	if ( obj == null ) {
		return obj + "";
	}

	// Support: Android <=2.3 only (functionish RegExp)
	return typeof obj === "object" || typeof obj === "function" ?
		class2type[ toString.call( obj ) ] || "object" :
		typeof obj;
}
/* global Symbol */
// Defining this global in .eslintrc.json would create a danger of using the global
// unguarded in another place, it seems safer to define global only for this module



var
	version = "3.5.1",

	// Define a local copy of jQuery
	jQuery = function( selector, context ) {

		// The jQuery object is actually just the init constructor 'enhanced'
		// Need init if jQuery is called (just allow error to be thrown if not included)
		return new jQuery.fn.init( selector, context );
	};

jQuery.fn = jQuery.prototype = {

	// The current version of jQuery being used
	jquery: version,

	constructor: jQuery,

	// The default length of a jQuery object is 0
	length: 0,

	toArray: function() {
		return slice.call( this );
	},

	// Get the Nth element in the matched element set OR
	// Get the whole matched element set as a clean array
	get: function( num ) {

		// Return all the elements in a clean array
		if ( num == null ) {
			return slice.call( this );
		}

		// Return just the one element from the set
		return num < 0 ? this[ num + this.length ] : this[ num ];
	},

	// Take an array of elements and push it onto the stack
	// (returning the new matched element set)
	pushStack: function( elems ) {

		// Build a new jQuery matched element set
		var ret = jQuery.merge( this.constructor(), elems );

		// Add the old object onto the stack (as a reference)
		ret.prevObject = this;

		// Return the newly-formed element set
		return ret;
	},

	// Execute a callback for every element in the matched set.
	each: function( callback ) {
		return jQuery.each( this, callback );
	},

	map: function( callback ) {
		return this.pushStack( jQuery.map( this, function( elem, i ) {
			return callback.call( elem, i, elem );
		} ) );
	},

	slice: function() {
		return this.pushStack( slice.apply( this, arguments ) );
	},

	first: function() {
		return this.eq( 0 );
	},

	last: function() {
		return this.eq( -1 );
	},

	even: function() {
		return this.pushStack( jQuery.grep( this, function( _elem, i ) {
			return ( i + 1 ) % 2;
		} ) );
	},

	odd: function() {
		return this.pushStack( jQuery.grep( this, function( _elem, i ) {
			return i % 2;
		} ) );
	},

	eq: function( i ) {
		var len = this.length,
			j = +i + ( i < 0 ? len : 0 );
		return this.pushStack( j >= 0 && j < len ? [ this[ j ] ] : [] );
	},

	end: function() {
		return this.prevObject || this.constructor();
	},

	// For internal use only.
	// Behaves like an Array's method, not like a jQuery method.
	push: push,
	sort: arr.sort,
	splice: arr.splice
};

jQuery.extend = jQuery.fn.extend = function() {
	var options, name, src, copy, copyIsArray, clone,
		target = arguments[ 0 ] || {},
		i = 1,
		length = arguments.length,
		deep = false;

	// Handle a deep copy situation
	if ( typeof target === "boolean" ) {
		deep = target;

		// Skip the boolean and the target
		target = arguments[ i ] || {};
		i++;
	}

	// Handle case when target is a string or something (possible in deep copy)
	if ( typeof target !== "object" && !isFunction( target ) ) {
		target = {};
	}

	// Extend jQuery itself if only one argument is passed
	if ( i === length ) {
		target = this;
		i--;
	}

	for ( ; i < length; i++ ) {

		// Only deal with non-null/undefined values
		if ( ( options = arguments[ i ] ) != null ) {

			// Extend the base object
			for ( name in options ) {
				copy = options[ name ];

				// Prevent Object.prototype pollution
				// Prevent never-ending loop
				if ( name === "__proto__" || target === copy ) {
					continue;
				}

				// Recurse if we're merging plain objects or arrays
				if ( deep && copy && ( jQuery.isPlainObject( copy ) ||
					( copyIsArray = Array.isArray( copy ) ) ) ) {
					src = target[ name ];

					// Ensure proper type for the source value
					if ( copyIsArray && !Array.isArray( src ) ) {
						clone = [];
					} else if ( !copyIsArray && !jQuery.isPlainObject( src ) ) {
						clone = {};
					} else {
						clone = src;
					}
					copyIsArray = false;

					// Never move original objects, clone them
					target[ name ] = jQuery.extend( deep, clone, copy );

				// Don't bring in undefined values
				} else if ( copy !== undefined ) {
					target[ name ] = copy;
				}
			}
		}
	}

	// Return the modified object
	return target;
};

jQuery.extend( {

	// Unique for each copy of jQuery on the page
	expando: "jQuery" + ( version + Math.random() ).replace( /\D/g, "" ),

	// Assume jQuery is ready without the ready module
	isReady: true,

	error: function( msg ) {
		throw new Error( msg );
	},

	noop: function() {},

	isPlainObject: function( obj ) {
		var proto, Ctor;

		// Detect obvious negatives
		// Use toString instead of jQuery.type to catch host objects
		if ( !obj || toString.call( obj ) !== "[object Object]" ) {
			return false;
		}

		proto = getProto( obj );

		// Objects with no prototype (e.g., `Object.create( null )`) are plain
		if ( !proto ) {
			return true;
		}

		// Objects with prototype are plain iff they were constructed by a global Object function
		Ctor = hasOwn.call( proto, "constructor" ) && proto.constructor;
		return typeof Ctor === "function" && fnToString.call( Ctor ) === ObjectFunctionString;
	},

	isEmptyObject: function( obj ) {
		var name;

		for ( name in obj ) {
			return false;
		}
		return true;
	},

	// Evaluates a script in a provided context; falls back to the global one
	// if not specified.
	globalEval: function( code, options, doc ) {
		DOMEval( code, { nonce: options && options.nonce }, doc );
	},

	each: function( obj, callback ) {
		var length, i = 0;

		if ( isArrayLike( obj ) ) {
			length = obj.length;
			for ( ; i < length; i++ ) {
				if ( callback.call( obj[ i ], i, obj[ i ] ) === false ) {
					break;
				}
			}
		} else {
			for ( i in obj ) {
				if ( callback.call( obj[ i ], i, obj[ i ] ) === false ) {
					break;
				}
			}
		}

		return obj;
	},

	// results is for internal usage only
	makeArray: function( arr, results ) {
		var ret = results || [];

		if ( arr != null ) {
			if ( isArrayLike( Object( arr ) ) ) {
				jQuery.merge( ret,
					typeof arr === "string" ?
					[ arr ] : arr
				);
			} else {
				push.call( ret, arr );
			}
		}

		return ret;
	},

	inArray: function( elem, arr, i ) {
		return arr == null ? -1 : indexOf.call( arr, elem, i );
	},

	// Support: Android <=4.0 only, PhantomJS 1 only
	// push.apply(_, arraylike) throws on ancient WebKit
	merge: function( first, second ) {
		var len = +second.length,
			j = 0,
			i = first.length;

		for ( ; j < len; j++ ) {
			first[ i++ ] = second[ j ];
		}

		first.length = i;

		return first;
	},

	grep: function( elems, callback, invert ) {
		var callbackInverse,
			matches = [],
			i = 0,
			length = elems.length,
			callbackExpect = !invert;

		// Go through the array, only saving the items
		// that pass the validator function
		for ( ; i < length; i++ ) {
			callbackInverse = !callback( elems[ i ], i );
			if ( callbackInverse !== callbackExpect ) {
				matches.push( elems[ i ] );
			}
		}

		return matches;
	},

	// arg is for internal usage only
	map: function( elems, callback, arg ) {
		var length, value,
			i = 0,
			ret = [];

		// Go through the array, translating each of the items to their new values
		if ( isArrayLike( elems ) ) {
			length = elems.length;
			for ( ; i < length; i++ ) {
				value = callback( elems[ i ], i, arg );

				if ( value != null ) {
					ret.push( value );
				}
			}

		// Go through every key on the object,
		} else {
			for ( i in elems ) {
				value = callback( elems[ i ], i, arg );

				if ( value != null ) {
					ret.push( value );
				}
			}
		}

		// Flatten any nested arrays
		return flat( ret );
	},

	// A global GUID counter for objects
	guid: 1,

	// jQuery.support is not used in Core but other projects attach their
	// properties to it so it needs to exist.
	support: support
} );

if ( typeof Symbol === "function" ) {
	jQuery.fn[ Symbol.iterator ] = arr[ Symbol.iterator ];
}

// Populate the class2type map
jQuery.each( "Boolean Number String Function Array Date RegExp Object Error Symbol".split( " " ),
function( _i, name ) {
	class2type[ "[object " + name + "]" ] = name.toLowerCase();
} );

function isArrayLike( obj ) {

	// Support: real iOS 8.2 only (not reproducible in simulator)
	// `in` check used to prevent JIT error (gh-2145)
	// hasOwn isn't used here due to false negatives
	// regarding Nodelist length in IE
	var length = !!obj && "length" in obj && obj.length,
		type = toType( obj );

	if ( isFunction( obj ) || isWindow( obj ) ) {
		return false;
	}

	return type === "array" || length === 0 ||
		typeof length === "number" && length > 0 && ( length - 1 ) in obj;
}
var Sizzle =
/*!
 * Sizzle CSS Selector Engine v2.3.5
 * https://sizzlejs.com/
 *
 * Copyright JS Foundation and other contributors
 * Released under the MIT license
 * https://js.foundation/
 *
 * Date: 2020-03-14
 */
( function( window ) {
var i,
	support,
	Expr,
	getText,
	isXML,
	tokenize,
	compile,
	select,
	outermostContext,
	sortInput,
	hasDuplicate,

	// Local document vars
	setDocument,
	document,
	docElem,
	documentIsHTML,
	rbuggyQSA,
	rbuggyMatches,
	matches,
	contains,

	// Instance-specific data
	expando = "sizzle" + 1 * new Date(),
	preferredDoc = window.document,
	dirruns = 0,
	done = 0,
	classCache = createCache(),
	tokenCache = createCache(),
	compilerCache = createCache(),
	nonnativeSelectorCache = createCache(),
	sortOrder = function( a, b ) {
		if ( a === b ) {
			hasDuplicate = true;
		}
		return 0;
	},

	// Instance methods
	hasOwn = ( {} ).hasOwnProperty,
	arr = [],
	pop = arr.pop,
	pushNative = arr.push,
	push = arr.push,
	slice = arr.slice,

	// Use a stripped-down indexOf as it's faster than native
	// https://jsperf.com/thor-indexof-vs-for/5
	indexOf = function( list, elem ) {
		var i = 0,
			len = list.length;
		for ( ; i < len; i++ ) {
			if ( list[ i ] === elem ) {
				return i;
			}
		}
		return -1;
	},

	booleans = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|" +
		"ismap|loop|multiple|open|readonly|required|scoped",

	// Regular expressions

	// http://www.w3.org/TR/css3-selectors/#whitespace
	whitespace = "[\\x20\\t\\r\\n\\f]",

	// https://www.w3.org/TR/css-syntax-3/#ident-token-diagram
	identifier = "(?:\\\\[\\da-fA-F]{1,6}" + whitespace +
		"?|\\\\[^\\r\\n\\f]|[\\w-]|[^\0-\\x7f])+",

	// Attribute selectors: http://www.w3.org/TR/selectors/#attribute-selectors
	attributes = "\\[" + whitespace + "*(" + identifier + ")(?:" + whitespace +

		// Operator (capture 2)
		"*([*^$|!~]?=)" + whitespace +

		// "Attribute values must be CSS identifiers [capture 5]
		// or strings [capture 3 or capture 4]"
		"*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + identifier + "))|)" +
		whitespace + "*\\]",

	pseudos = ":(" + identifier + ")(?:\\((" +

		// To reduce the number of selectors needing tokenize in the preFilter, prefer arguments:
		// 1. quoted (capture 3; capture 4 or capture 5)
		"('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|" +

		// 2. simple (capture 6)
		"((?:\\\\.|[^\\\\()[\\]]|" + attributes + ")*)|" +

		// 3. anything else (capture 2)
		".*" +
		")\\)|)",

	// Leading and non-escaped trailing whitespace, capturing some non-whitespace characters preceding the latter
	rwhitespace = new RegExp( whitespace + "+", "g" ),
	rtrim = new RegExp( "^" + whitespace + "+|((?:^|[^\\\\])(?:\\\\.)*)" +
		whitespace + "+$", "g" ),

	rcomma = new RegExp( "^" + whitespace + "*," + whitespace + "*" ),
	rcombinators = new RegExp( "^" + whitespace + "*([>+~]|" + whitespace + ")" + whitespace +
		"*" ),
	rdescend = new RegExp( whitespace + "|>" ),

	rpseudo = new RegExp( pseudos ),
	ridentifier = new RegExp( "^" + identifier + "$" ),

	matchExpr = {
		"ID": new RegExp( "^#(" + identifier + ")" ),
		"CLASS": new RegExp( "^\\.(" + identifier + ")" ),
		"TAG": new RegExp( "^(" + identifier + "|[*])" ),
		"ATTR": new RegExp( "^" + attributes ),
		"PSEUDO": new RegExp( "^" + pseudos ),
		"CHILD": new RegExp( "^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" +
			whitespace + "*(even|odd|(([+-]|)(\\d*)n|)" + whitespace + "*(?:([+-]|)" +
			whitespace + "*(\\d+)|))" + whitespace + "*\\)|)", "i" ),
		"bool": new RegExp( "^(?:" + booleans + ")$", "i" ),

		// For use in libraries implementing .is()
		// We use this for POS matching in `select`
		"needsContext": new RegExp( "^" + whitespace +
			"*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + whitespace +
			"*((?:-\\d)?\\d*)" + whitespace + "*\\)|)(?=[^-]|$)", "i" )
	},

	rhtml = /HTML$/i,
	rinputs = /^(?:input|select|textarea|button)$/i,
	rheader = /^h\d$/i,

	rnative = /^[^{]+\{\s*\[native \w/,

	// Easily-parseable/retrievable ID or TAG or CLASS selectors
	rquickExpr = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,

	rsibling = /[+~]/,

	// CSS escapes
	// http://www.w3.org/TR/CSS21/syndata.html#escaped-characters
	runescape = new RegExp( "\\\\[\\da-fA-F]{1,6}" + whitespace + "?|\\\\([^\\r\\n\\f])", "g" ),
	funescape = function( escape, nonHex ) {
		var high = "0x" + escape.slice( 1 ) - 0x10000;

		return nonHex ?

			// Strip the backslash prefix from a non-hex escape sequence
			nonHex :

			// Replace a hexadecimal escape sequence with the encoded Unicode code point
			// Support: IE <=11+
			// For values outside the Basic Multilingual Plane (BMP), manually construct a
			// surrogate pair
			high < 0 ?
				String.fromCharCode( high + 0x10000 ) :
				String.fromCharCode( high >> 10 | 0xD800, high & 0x3FF | 0xDC00 );
	},

	// CSS string/identifier serialization
	// https://drafts.csswg.org/cssom/#common-serializing-idioms
	rcssescape = /([\0-\x1f\x7f]|^-?\d)|^-$|[^\0-\x1f\x7f-\uFFFF\w-]/g,
	fcssescape = function( ch, asCodePoint ) {
		if ( asCodePoint ) {

			// U+0000 NULL becomes U+FFFD REPLACEMENT CHARACTER
			if ( ch === "\0" ) {
				return "\uFFFD";
			}

			// Control characters and (dependent upon position) numbers get escaped as code points
			return ch.slice( 0, -1 ) + "\\" +
				ch.charCodeAt( ch.length - 1 ).toString( 16 ) + " ";
		}

		// Other potentially-special ASCII characters get backslash-escaped
		return "\\" + ch;
	},

	// Used for iframes
	// See setDocument()
	// Removing the function wrapper causes a "Permission Denied"
	// error in IE
	unloadHandler = function() {
		setDocument();
	},

	inDisabledFieldset = addCombinator(
		function( elem ) {
			return elem.disabled === true && elem.nodeName.toLowerCase() === "fieldset";
		},
		{ dir: "parentNode", next: "legend" }
	);

// Optimize for push.apply( _, NodeList )
try {
	push.apply(
		( arr = slice.call( preferredDoc.childNodes ) ),
		preferredDoc.childNodes
	);

	// Support: Android<4.0
	// Detect silently failing push.apply
	// eslint-disable-next-line no-unused-expressions
	arr[ preferredDoc.childNodes.length ].nodeType;
} catch ( e ) {
	push = { apply: arr.length ?

		// Leverage slice if possible
		function( target, els ) {
			pushNative.apply( target, slice.call( els ) );
		} :

		// Support: IE<9
		// Otherwise append directly
		function( target, els ) {
			var j = target.length,
				i = 0;

			// Can't trust NodeList.length
			while ( ( target[ j++ ] = els[ i++ ] ) ) {}
			target.length = j - 1;
		}
	};
}

function Sizzle( selector, context, results, seed ) {
	var m, i, elem, nid, match, groups, newSelector,
		newContext = context && context.ownerDocument,

		// nodeType defaults to 9, since context defaults to document
		nodeType = context ? context.nodeType : 9;

	results = results || [];

	// Return early from calls with invalid selector or context
	if ( typeof selector !== "string" || !selector ||
		nodeType !== 1 && nodeType !== 9 && nodeType !== 11 ) {

		return results;
	}

	// Try to shortcut find operations (as opposed to filters) in HTML documents
	if ( !seed ) {
		setDocument( context );
		context = context || document;

		if ( documentIsHTML ) {

			// If the selector is sufficiently simple, try using a "get*By*" DOM method
			// (excepting DocumentFragment context, where the methods don't exist)
			if ( nodeType !== 11 && ( match = rquickExpr.exec( selector ) ) ) {

				// ID selector
				if ( ( m = match[ 1 ] ) ) {

					// Document context
					if ( nodeType === 9 ) {
						if ( ( elem = context.getElementById( m ) ) ) {

							// Support: IE, Opera, Webkit
							// TODO: identify versions
							// getElementById can match elements by name instead of ID
							if ( elem.id === m ) {
								results.push( elem );
								return results;
							}
						} else {
							return results;
						}

					// Element context
					} else {

						// Support: IE, Opera, Webkit
						// TODO: identify versions
						// getElementById can match elements by name instead of ID
						if ( newContext && ( elem = newContext.getElementById( m ) ) &&
							contains( context, elem ) &&
							elem.id === m ) {

							results.push( elem );
							return results;
						}
					}

				// Type selector
				} else if ( match[ 2 ] ) {
					push.apply( results, context.getElementsByTagName( selector ) );
					return results;

				// Class selector
				} else if ( ( m = match[ 3 ] ) && support.getElementsByClassName &&
					context.getElementsByClassName ) {

					push.apply( results, context.getElementsByClassName( m ) );
					return results;
				}
			}

			// Take advantage of querySelectorAll
			if ( support.qsa &&
				!nonnativeSelectorCache[ selector + " " ] &&
				( !rbuggyQSA || !rbuggyQSA.test( selector ) ) &&

				// Support: IE 8 only
				// Exclude object elements
				( nodeType !== 1 || context.nodeName.toLowerCase() !== "object" ) ) {

				newSelector = selector;
				newContext = context;

				// qSA considers elements outside a scoping root when evaluating child or
				// descendant combinators, which is not what we want.
				// In such cases, we work around the behavior by prefixing every selector in the
				// list with an ID selector referencing the scope context.
				// The technique has to be used as well when a leading combinator is used
				// as such selectors are not recognized by querySelectorAll.
				// Thanks to Andrew Dupont for this technique.
				if ( nodeType === 1 &&
					( rdescend.test( selector ) || rcombinators.test( selector ) ) ) {

					// Expand context for sibling selectors
					newContext = rsibling.test( selector ) && testContext( context.parentNode ) ||
						context;

					// We can use :scope instead of the ID hack if the browser
					// supports it & if we're not changing the context.
					if ( newContext !== context || !support.scope ) {

						// Capture the context ID, setting it first if necessary
						if ( ( nid = context.getAttribute( "id" ) ) ) {
							nid = nid.replace( rcssescape, fcssescape );
						} else {
							context.setAttribute( "id", ( nid = expando ) );
						}
					}

					// Prefix every selector in the list
					groups = tokenize( selector );
					i = groups.length;
					while ( i-- ) {
						groups[ i ] = ( nid ? "#" + nid : ":scope" ) + " " +
							toSelector( groups[ i ] );
					}
					newSelector = groups.join( "," );
				}

				try {
					push.apply( results,
						newContext.querySelectorAll( newSelector )
					);
					return results;
				} catch ( qsaError ) {
					nonnativeSelectorCache( selector, true );
				} finally {
					if ( nid === expando ) {
						context.removeAttribute( "id" );
					}
				}
			}
		}
	}

	// All others
	return select( selector.replace( rtrim, "$1" ), context, results, seed );
}

/**
 * Create key-value caches of limited size
 * @returns {function(string, object)} Returns the Object data after storing it on itself with
 *	property name the (space-suffixed) string and (if the cache is larger than Expr.cacheLength)
 *	deleting the oldest entry
 */
function createCache() {
	var keys = [];

	function cache( key, value ) {

		// Use (key + " ") to avoid collision with native prototype properties (see Issue #157)
		if ( keys.push( key + " " ) > Expr.cacheLength ) {

			// Only keep the most recent entries
			delete cache[ keys.shift() ];
		}
		return ( cache[ key + " " ] = value );
	}
	return cache;
}

/**
 * Mark a function for special use by Sizzle
 * @param {Function} fn The function to mark
 */
function markFunction( fn ) {
	fn[ expando ] = true;
	return fn;
}

/**
 * Support testing using an element
 * @param {Function} fn Passed the created element and returns a boolean result
 */
function assert( fn ) {
	var el = document.createElement( "fieldset" );

	try {
		return !!fn( el );
	} catch ( e ) {
		return false;
	} finally {

		// Remove from its parent by default
		if ( el.parentNode ) {
			el.parentNode.removeChild( el );
		}

		// release memory in IE
		el = null;
	}
}

/**
 * Adds the same handler for all of the specified attrs
 * @param {String} attrs Pipe-separated list of attributes
 * @param {Function} handler The method that will be applied
 */
function addHandle( attrs, handler ) {
	var arr = attrs.split( "|" ),
		i = arr.length;

	while ( i-- ) {
		Expr.attrHandle[ arr[ i ] ] = handler;
	}
}

/**
 * Checks document order of two siblings
 * @param {Element} a
 * @param {Element} b
 * @returns {Number} Returns less than 0 if a precedes b, greater than 0 if a follows b
 */
function siblingCheck( a, b ) {
	var cur = b && a,
		diff = cur && a.nodeType === 1 && b.nodeType === 1 &&
			a.sourceIndex - b.sourceIndex;

	// Use IE sourceIndex if available on both nodes
	if ( diff ) {
		return diff;
	}

	// Check if b follows a
	if ( cur ) {
		while ( ( cur = cur.nextSibling ) ) {
			if ( cur === b ) {
				return -1;
			}
		}
	}

	return a ? 1 : -1;
}

/**
 * Returns a function to use in pseudos for input types
 * @param {String} type
 */
function createInputPseudo( type ) {
	return function( elem ) {
		var name = elem.nodeName.toLowerCase();
		return name === "input" && elem.type === type;
	};
}

/**
 * Returns a function to use in pseudos for buttons
 * @param {String} type
 */
function createButtonPseudo( type ) {
	return function( elem ) {
		var name = elem.nodeName.toLowerCase();
		return ( name === "input" || name === "button" ) && elem.type === type;
	};
}

/**
 * Returns a function to use in pseudos for :enabled/:disabled
 * @param {Boolean} disabled true for :disabled; false for :enabled
 */
function createDisabledPseudo( disabled ) {

	// Known :disabled false positives: fieldset[disabled] > legend:nth-of-type(n+2) :can-disable
	return function( elem ) {

		// Only certain elements can match :enabled or :disabled
		// https://html.spec.whatwg.org/multipage/scripting.html#selector-enabled
		// https://html.spec.whatwg.org/multipage/scripting.html#selector-disabled
		if ( "form" in elem ) {

			// Check for inherited disabledness on relevant non-disabled elements:
			// * listed form-associated elements in a disabled fieldset
			//   https://html.spec.whatwg.org/multipage/forms.html#category-listed
			//   https://html.spec.whatwg.org/multipage/forms.html#concept-fe-disabled
			// * option elements in a disabled optgroup
			//   https://html.spec.whatwg.org/multipage/forms.html#concept-option-disabled
			// All such elements have a "form" property.
			if ( elem.parentNode && elem.disabled === false ) {

				// Option elements defer to a parent optgroup if present
				if ( "label" in elem ) {
					if ( "label" in elem.parentNode ) {
						return elem.parentNode.disabled === disabled;
					} else {
						return elem.disabled === disabled;
					}
				}

				// Support: IE 6 - 11
				// Use the isDisabled shortcut property to check for disabled fieldset ancestors
				return elem.isDisabled === disabled ||

					// Where there is no isDisabled, check manually
					/* jshint -W018 */
					elem.isDisabled !== !disabled &&
					inDisabledFieldset( elem ) === disabled;
			}

			return elem.disabled === disabled;

		// Try to winnow out elements that can't be disabled before trusting the disabled property.
		// Some victims get caught in our net (label, legend, menu, track), but it shouldn't
		// even exist on them, let alone have a boolean value.
		} else if ( "label" in elem ) {
			return elem.disabled === disabled;
		}

		// Remaining elements are neither :enabled nor :disabled
		return false;
	};
}

/**
 * Returns a function to use in pseudos for positionals
 * @param {Function} fn
 */
function createPositionalPseudo( fn ) {
	return markFunction( function( argument ) {
		argument = +argument;
		return markFunction( function( seed, matches ) {
			var j,
				matchIndexes = fn( [], seed.length, argument ),
				i = matchIndexes.length;

			// Match elements found at the specified indexes
			while ( i-- ) {
				if ( seed[ ( j = matchIndexes[ i ] ) ] ) {
					seed[ j ] = !( matches[ j ] = seed[ j ] );
				}
			}
		} );
	} );
}

/**
 * Checks a node for validity as a Sizzle context
 * @param {Element|Object=} context
 * @returns {Element|Object|Boolean} The input node if acceptable, otherwise a falsy value
 */
function testContext( context ) {
	return context && typeof context.getElementsByTagName !== "undefined" && context;
}

// Expose support vars for convenience
support = Sizzle.support = {};

/**
 * Detects XML nodes
 * @param {Element|Object} elem An element or a document
 * @returns {Boolean} True iff elem is a non-HTML XML node
 */
isXML = Sizzle.isXML = function( elem ) {
	var namespace = elem.namespaceURI,
		docElem = ( elem.ownerDocument || elem ).documentElement;

	// Support: IE <=8
	// Assume HTML when documentElement doesn't yet exist, such as inside loading iframes
	// https://bugs.jquery.com/ticket/4833
	return !rhtml.test( namespace || docElem && docElem.nodeName || "HTML" );
};

/**
 * Sets document-related variables once based on the current document
 * @param {Element|Object} [doc] An element or document object to use to set the document
 * @returns {Object} Returns the current document
 */
setDocument = Sizzle.setDocument = function( node ) {
	var hasCompare, subWindow,
		doc = node ? node.ownerDocument || node : preferredDoc;

	// Return early if doc is invalid or already selected
	// Support: IE 11+, Edge 17 - 18+
	// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
	// two documents; shallow comparisons work.
	// eslint-disable-next-line eqeqeq
	if ( doc == document || doc.nodeType !== 9 || !doc.documentElement ) {
		return document;
	}

	// Update global variables
	document = doc;
	docElem = document.documentElement;
	documentIsHTML = !isXML( document );

	// Support: IE 9 - 11+, Edge 12 - 18+
	// Accessing iframe documents after unload throws "permission denied" errors (jQuery #13936)
	// Support: IE 11+, Edge 17 - 18+
	// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
	// two documents; shallow comparisons work.
	// eslint-disable-next-line eqeqeq
	if ( preferredDoc != document &&
		( subWindow = document.defaultView ) && subWindow.top !== subWindow ) {

		// Support: IE 11, Edge
		if ( subWindow.addEventListener ) {
			subWindow.addEventListener( "unload", unloadHandler, false );

		// Support: IE 9 - 10 only
		} else if ( subWindow.attachEvent ) {
			subWindow.attachEvent( "onunload", unloadHandler );
		}
	}

	// Support: IE 8 - 11+, Edge 12 - 18+, Chrome <=16 - 25 only, Firefox <=3.6 - 31 only,
	// Safari 4 - 5 only, Opera <=11.6 - 12.x only
	// IE/Edge & older browsers don't support the :scope pseudo-class.
	// Support: Safari 6.0 only
	// Safari 6.0 supports :scope but it's an alias of :root there.
	support.scope = assert( function( el ) {
		docElem.appendChild( el ).appendChild( document.createElement( "div" ) );
		return typeof el.querySelectorAll !== "undefined" &&
			!el.querySelectorAll( ":scope fieldset div" ).length;
	} );

	/* Attributes
	---------------------------------------------------------------------- */

	// Support: IE<8
	// Verify that getAttribute really returns attributes and not properties
	// (excepting IE8 booleans)
	support.attributes = assert( function( el ) {
		el.className = "i";
		return !el.getAttribute( "className" );
	} );

	/* getElement(s)By*
	---------------------------------------------------------------------- */

	// Check if getElementsByTagName("*") returns only elements
	support.getElementsByTagName = assert( function( el ) {
		el.appendChild( document.createComment( "" ) );
		return !el.getElementsByTagName( "*" ).length;
	} );

	// Support: IE<9
	support.getElementsByClassName = rnative.test( document.getElementsByClassName );

	// Support: IE<10
	// Check if getElementById returns elements by name
	// The broken getElementById methods don't pick up programmatically-set names,
	// so use a roundabout getElementsByName test
	support.getById = assert( function( el ) {
		docElem.appendChild( el ).id = expando;
		return !document.getElementsByName || !document.getElementsByName( expando ).length;
	} );

	// ID filter and find
	if ( support.getById ) {
		Expr.filter[ "ID" ] = function( id ) {
			var attrId = id.replace( runescape, funescape );
			return function( elem ) {
				return elem.getAttribute( "id" ) === attrId;
			};
		};
		Expr.find[ "ID" ] = function( id, context ) {
			if ( typeof context.getElementById !== "undefined" && documentIsHTML ) {
				var elem = context.getElementById( id );
				return elem ? [ elem ] : [];
			}
		};
	} else {
		Expr.filter[ "ID" ] =  function( id ) {
			var attrId = id.replace( runescape, funescape );
			return function( elem ) {
				var node = typeof elem.getAttributeNode !== "undefined" &&
					elem.getAttributeNode( "id" );
				return node && node.value === attrId;
			};
		};

		// Support: IE 6 - 7 only
		// getElementById is not reliable as a find shortcut
		Expr.find[ "ID" ] = function( id, context ) {
			if ( typeof context.getElementById !== "undefined" && documentIsHTML ) {
				var node, i, elems,
					elem = context.getElementById( id );

				if ( elem ) {

					// Verify the id attribute
					node = elem.getAttributeNode( "id" );
					if ( node && node.value === id ) {
						return [ elem ];
					}

					// Fall back on getElementsByName
					elems = context.getElementsByName( id );
					i = 0;
					while ( ( elem = elems[ i++ ] ) ) {
						node = elem.getAttributeNode( "id" );
						if ( node && node.value === id ) {
							return [ elem ];
						}
					}
				}

				return [];
			}
		};
	}

	// Tag
	Expr.find[ "TAG" ] = support.getElementsByTagName ?
		function( tag, context ) {
			if ( typeof context.getElementsByTagName !== "undefined" ) {
				return context.getElementsByTagName( tag );

			// DocumentFragment nodes don't have gEBTN
			} else if ( support.qsa ) {
				return context.querySelectorAll( tag );
			}
		} :

		function( tag, context ) {
			var elem,
				tmp = [],
				i = 0,

				// By happy coincidence, a (broken) gEBTN appears on DocumentFragment nodes too
				results = context.getElementsByTagName( tag );

			// Filter out possible comments
			if ( tag === "*" ) {
				while ( ( elem = results[ i++ ] ) ) {
					if ( elem.nodeType === 1 ) {
						tmp.push( elem );
					}
				}

				return tmp;
			}
			return results;
		};

	// Class
	Expr.find[ "CLASS" ] = support.getElementsByClassName && function( className, context ) {
		if ( typeof context.getElementsByClassName !== "undefined" && documentIsHTML ) {
			return context.getElementsByClassName( className );
		}
	};

	/* QSA/matchesSelector
	---------------------------------------------------------------------- */

	// QSA and matchesSelector support

	// matchesSelector(:active) reports false when true (IE9/Opera 11.5)
	rbuggyMatches = [];

	// qSa(:focus) reports false when true (Chrome 21)
	// We allow this because of a bug in IE8/9 that throws an error
	// whenever `document.activeElement` is accessed on an iframe
	// So, we allow :focus to pass through QSA all the time to avoid the IE error
	// See https://bugs.jquery.com/ticket/13378
	rbuggyQSA = [];

	if ( ( support.qsa = rnative.test( document.querySelectorAll ) ) ) {

		// Build QSA regex
		// Regex strategy adopted from Diego Perini
		assert( function( el ) {

			var input;

			// Select is set to empty string on purpose
			// This is to test IE's treatment of not explicitly
			// setting a boolean content attribute,
			// since its presence should be enough
			// https://bugs.jquery.com/ticket/12359
			docElem.appendChild( el ).innerHTML = "<a id='" + expando + "'></a>" +
				"<select id='" + expando + "-\r\\' msallowcapture=''>" +
				"<option selected=''></option></select>";

			// Support: IE8, Opera 11-12.16
			// Nothing should be selected when empty strings follow ^= or $= or *=
			// The test attribute must be unknown in Opera but "safe" for WinRT
			// https://msdn.microsoft.com/en-us/library/ie/hh465388.aspx#attribute_section
			if ( el.querySelectorAll( "[msallowcapture^='']" ).length ) {
				rbuggyQSA.push( "[*^$]=" + whitespace + "*(?:''|\"\")" );
			}

			// Support: IE8
			// Boolean attributes and "value" are not treated correctly
			if ( !el.querySelectorAll( "[selected]" ).length ) {
				rbuggyQSA.push( "\\[" + whitespace + "*(?:value|" + booleans + ")" );
			}

			// Support: Chrome<29, Android<4.4, Safari<7.0+, iOS<7.0+, PhantomJS<1.9.8+
			if ( !el.querySelectorAll( "[id~=" + expando + "-]" ).length ) {
				rbuggyQSA.push( "~=" );
			}

			// Support: IE 11+, Edge 15 - 18+
			// IE 11/Edge don't find elements on a `[name='']` query in some cases.
			// Adding a temporary attribute to the document before the selection works
			// around the issue.
			// Interestingly, IE 10 & older don't seem to have the issue.
			input = document.createElement( "input" );
			input.setAttribute( "name", "" );
			el.appendChild( input );
			if ( !el.querySelectorAll( "[name='']" ).length ) {
				rbuggyQSA.push( "\\[" + whitespace + "*name" + whitespace + "*=" +
					whitespace + "*(?:''|\"\")" );
			}

			// Webkit/Opera - :checked should return selected option elements
			// http://www.w3.org/TR/2011/REC-css3-selectors-20110929/#checked
			// IE8 throws error here and will not see later tests
			if ( !el.querySelectorAll( ":checked" ).length ) {
				rbuggyQSA.push( ":checked" );
			}

			// Support: Safari 8+, iOS 8+
			// https://bugs.webkit.org/show_bug.cgi?id=136851
			// In-page `selector#id sibling-combinator selector` fails
			if ( !el.querySelectorAll( "a#" + expando + "+*" ).length ) {
				rbuggyQSA.push( ".#.+[+~]" );
			}

			// Support: Firefox <=3.6 - 5 only
			// Old Firefox doesn't throw on a badly-escaped identifier.
			el.querySelectorAll( "\\\f" );
			rbuggyQSA.push( "[\\r\\n\\f]" );
		} );

		assert( function( el ) {
			el.innerHTML = "<a href='' disabled='disabled'></a>" +
				"<select disabled='disabled'><option/></select>";

			// Support: Windows 8 Native Apps
			// The type and name attributes are restricted during .innerHTML assignment
			var input = document.createElement( "input" );
			input.setAttribute( "type", "hidden" );
			el.appendChild( input ).setAttribute( "name", "D" );

			// Support: IE8
			// Enforce case-sensitivity of name attribute
			if ( el.querySelectorAll( "[name=d]" ).length ) {
				rbuggyQSA.push( "name" + whitespace + "*[*^$|!~]?=" );
			}

			// FF 3.5 - :enabled/:disabled and hidden elements (hidden elements are still enabled)
			// IE8 throws error here and will not see later tests
			if ( el.querySelectorAll( ":enabled" ).length !== 2 ) {
				rbuggyQSA.push( ":enabled", ":disabled" );
			}

			// Support: IE9-11+
			// IE's :disabled selector does not pick up the children of disabled fieldsets
			docElem.appendChild( el ).disabled = true;
			if ( el.querySelectorAll( ":disabled" ).length !== 2 ) {
				rbuggyQSA.push( ":enabled", ":disabled" );
			}

			// Support: Opera 10 - 11 only
			// Opera 10-11 does not throw on post-comma invalid pseudos
			el.querySelectorAll( "*,:x" );
			rbuggyQSA.push( ",.*:" );
		} );
	}

	if ( ( support.matchesSelector = rnative.test( ( matches = docElem.matches ||
		docElem.webkitMatchesSelector ||
		docElem.mozMatchesSelector ||
		docElem.oMatchesSelector ||
		docElem.msMatchesSelector ) ) ) ) {

		assert( function( el ) {

			// Check to see if it's possible to do matchesSelector
			// on a disconnected node (IE 9)
			support.disconnectedMatch = matches.call( el, "*" );

			// This should fail with an exception
			// Gecko does not error, returns false instead
			matches.call( el, "[s!='']:x" );
			rbuggyMatches.push( "!=", pseudos );
		} );
	}

	rbuggyQSA = rbuggyQSA.length && new RegExp( rbuggyQSA.join( "|" ) );
	rbuggyMatches = rbuggyMatches.length && new RegExp( rbuggyMatches.join( "|" ) );

	/* Contains
	---------------------------------------------------------------------- */
	hasCompare = rnative.test( docElem.compareDocumentPosition );

	// Element contains another
	// Purposefully self-exclusive
	// As in, an element does not contain itself
	contains = hasCompare || rnative.test( docElem.contains ) ?
		function( a, b ) {
			var adown = a.nodeType === 9 ? a.documentElement : a,
				bup = b && b.parentNode;
			return a === bup || !!( bup && bup.nodeType === 1 && (
				adown.contains ?
					adown.contains( bup ) :
					a.compareDocumentPosition && a.compareDocumentPosition( bup ) & 16
			) );
		} :
		function( a, b ) {
			if ( b ) {
				while ( ( b = b.parentNode ) ) {
					if ( b === a ) {
						return true;
					}
				}
			}
			return false;
		};

	/* Sorting
	---------------------------------------------------------------------- */

	// Document order sorting
	sortOrder = hasCompare ?
	function( a, b ) {

		// Flag for duplicate removal
		if ( a === b ) {
			hasDuplicate = true;
			return 0;
		}

		// Sort on method existence if only one input has compareDocumentPosition
		var compare = !a.compareDocumentPosition - !b.compareDocumentPosition;
		if ( compare ) {
			return compare;
		}

		// Calculate position if both inputs belong to the same document
		// Support: IE 11+, Edge 17 - 18+
		// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
		// two documents; shallow comparisons work.
		// eslint-disable-next-line eqeqeq
		compare = ( a.ownerDocument || a ) == ( b.ownerDocument || b ) ?
			a.compareDocumentPosition( b ) :

			// Otherwise we know they are disconnected
			1;

		// Disconnected nodes
		if ( compare & 1 ||
			( !support.sortDetached && b.compareDocumentPosition( a ) === compare ) ) {

			// Choose the first element that is related to our preferred document
			// Support: IE 11+, Edge 17 - 18+
			// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
			// two documents; shallow comparisons work.
			// eslint-disable-next-line eqeqeq
			if ( a == document || a.ownerDocument == preferredDoc &&
				contains( preferredDoc, a ) ) {
				return -1;
			}

			// Support: IE 11+, Edge 17 - 18+
			// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
			// two documents; shallow comparisons work.
			// eslint-disable-next-line eqeqeq
			if ( b == document || b.ownerDocument == preferredDoc &&
				contains( preferredDoc, b ) ) {
				return 1;
			}

			// Maintain original order
			return sortInput ?
				( indexOf( sortInput, a ) - indexOf( sortInput, b ) ) :
				0;
		}

		return compare & 4 ? -1 : 1;
	} :
	function( a, b ) {

		// Exit early if the nodes are identical
		if ( a === b ) {
			hasDuplicate = true;
			return 0;
		}

		var cur,
			i = 0,
			aup = a.parentNode,
			bup = b.parentNode,
			ap = [ a ],
			bp = [ b ];

		// Parentless nodes are either documents or disconnected
		if ( !aup || !bup ) {

			// Support: IE 11+, Edge 17 - 18+
			// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
			// two documents; shallow comparisons work.
			/* eslint-disable eqeqeq */
			return a == document ? -1 :
				b == document ? 1 :
				/* eslint-enable eqeqeq */
				aup ? -1 :
				bup ? 1 :
				sortInput ?
				( indexOf( sortInput, a ) - indexOf( sortInput, b ) ) :
				0;

		// If the nodes are siblings, we can do a quick check
		} else if ( aup === bup ) {
			return siblingCheck( a, b );
		}

		// Otherwise we need full lists of their ancestors for comparison
		cur = a;
		while ( ( cur = cur.parentNode ) ) {
			ap.unshift( cur );
		}
		cur = b;
		while ( ( cur = cur.parentNode ) ) {
			bp.unshift( cur );
		}

		// Walk down the tree looking for a discrepancy
		while ( ap[ i ] === bp[ i ] ) {
			i++;
		}

		return i ?

			// Do a sibling check if the nodes have a common ancestor
			siblingCheck( ap[ i ], bp[ i ] ) :

			// Otherwise nodes in our document sort first
			// Support: IE 11+, Edge 17 - 18+
			// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
			// two documents; shallow comparisons work.
			/* eslint-disable eqeqeq */
			ap[ i ] == preferredDoc ? -1 :
			bp[ i ] == preferredDoc ? 1 :
			/* eslint-enable eqeqeq */
			0;
	};

	return document;
};

Sizzle.matches = function( expr, elements ) {
	return Sizzle( expr, null, null, elements );
};

Sizzle.matchesSelector = function( elem, expr ) {
	setDocument( elem );

	if ( support.matchesSelector && documentIsHTML &&
		!nonnativeSelectorCache[ expr + " " ] &&
		( !rbuggyMatches || !rbuggyMatches.test( expr ) ) &&
		( !rbuggyQSA     || !rbuggyQSA.test( expr ) ) ) {

		try {
			var ret = matches.call( elem, expr );

			// IE 9's matchesSelector returns false on disconnected nodes
			if ( ret || support.disconnectedMatch ||

				// As well, disconnected nodes are said to be in a document
				// fragment in IE 9
				elem.document && elem.document.nodeType !== 11 ) {
				return ret;
			}
		} catch ( e ) {
			nonnativeSelectorCache( expr, true );
		}
	}

	return Sizzle( expr, document, null, [ elem ] ).length > 0;
};

Sizzle.contains = function( context, elem ) {

	// Set document vars if needed
	// Support: IE 11+, Edge 17 - 18+
	// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
	// two documents; shallow comparisons work.
	// eslint-disable-next-line eqeqeq
	if ( ( context.ownerDocument || context ) != document ) {
		setDocument( context );
	}
	return contains( context, elem );
};

Sizzle.attr = function( elem, name ) {

	// Set document vars if needed
	// Support: IE 11+, Edge 17 - 18+
	// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
	// two documents; shallow comparisons work.
	// eslint-disable-next-line eqeqeq
	if ( ( elem.ownerDocument || elem ) != document ) {
		setDocument( elem );
	}

	var fn = Expr.attrHandle[ name.toLowerCase() ],

		// Don't get fooled by Object.prototype properties (jQuery #13807)
		val = fn && hasOwn.call( Expr.attrHandle, name.toLowerCase() ) ?
			fn( elem, name, !documentIsHTML ) :
			undefined;

	return val !== undefined ?
		val :
		support.attributes || !documentIsHTML ?
			elem.getAttribute( name ) :
			( val = elem.getAttributeNode( name ) ) && val.specified ?
				val.value :
				null;
};

Sizzle.escape = function( sel ) {
	return ( sel + "" ).replace( rcssescape, fcssescape );
};

Sizzle.error = function( msg ) {
	throw new Error( "Syntax error, unrecognized expression: " + msg );
};

/**
 * Document sorting and removing duplicates
 * @param {ArrayLike} results
 */
Sizzle.uniqueSort = function( results ) {
	var elem,
		duplicates = [],
		j = 0,
		i = 0;

	// Unless we *know* we can detect duplicates, assume their presence
	hasDuplicate = !support.detectDuplicates;
	sortInput = !support.sortStable && results.slice( 0 );
	results.sort( sortOrder );

	if ( hasDuplicate ) {
		while ( ( elem = results[ i++ ] ) ) {
			if ( elem === results[ i ] ) {
				j = duplicates.push( i );
			}
		}
		while ( j-- ) {
			results.splice( duplicates[ j ], 1 );
		}
	}

	// Clear input after sorting to release objects
	// See https://github.com/jquery/sizzle/pull/225
	sortInput = null;

	return results;
};

/**
 * Utility function for retrieving the text value of an array of DOM nodes
 * @param {Array|Element} elem
 */
getText = Sizzle.getText = function( elem ) {
	var node,
		ret = "",
		i = 0,
		nodeType = elem.nodeType;

	if ( !nodeType ) {

		// If no nodeType, this is expected to be an array
		while ( ( node = elem[ i++ ] ) ) {

			// Do not traverse comment nodes
			ret += getText( node );
		}
	} else if ( nodeType === 1 || nodeType === 9 || nodeType === 11 ) {

		// Use textContent for elements
		// innerText usage removed for consistency of new lines (jQuery #11153)
		if ( typeof elem.textContent === "string" ) {
			return elem.textContent;
		} else {

			// Traverse its children
			for ( elem = elem.firstChild; elem; elem = elem.nextSibling ) {
				ret += getText( elem );
			}
		}
	} else if ( nodeType === 3 || nodeType === 4 ) {
		return elem.nodeValue;
	}

	// Do not include comment or processing instruction nodes

	return ret;
};

Expr = Sizzle.selectors = {

	// Can be adjusted by the user
	cacheLength: 50,

	createPseudo: markFunction,

	match: matchExpr,

	attrHandle: {},

	find: {},

	relative: {
		">": { dir: "parentNode", first: true },
		" ": { dir: "parentNode" },
		"+": { dir: "previousSibling", first: true },
		"~": { dir: "previousSibling" }
	},

	preFilter: {
		"ATTR": function( match ) {
			match[ 1 ] = match[ 1 ].replace( runescape, funescape );

			// Move the given value to match[3] whether quoted or unquoted
			match[ 3 ] = ( match[ 3 ] || match[ 4 ] ||
				match[ 5 ] || "" ).replace( runescape, funescape );

			if ( match[ 2 ] === "~=" ) {
				match[ 3 ] = " " + match[ 3 ] + " ";
			}

			return match.slice( 0, 4 );
		},

		"CHILD": function( match ) {

			/* matches from matchExpr["CHILD"]
				1 type (only|nth|...)
				2 what (child|of-type)
				3 argument (even|odd|\d*|\d*n([+-]\d+)?|...)
				4 xn-component of xn+y argument ([+-]?\d*n|)
				5 sign of xn-component
				6 x of xn-component
				7 sign of y-component
				8 y of y-component
			*/
			match[ 1 ] = match[ 1 ].toLowerCase();

			if ( match[ 1 ].slice( 0, 3 ) === "nth" ) {

				// nth-* requires argument
				if ( !match[ 3 ] ) {
					Sizzle.error( match[ 0 ] );
				}

				// numeric x and y parameters for Expr.filter.CHILD
				// remember that false/true cast respectively to 0/1
				match[ 4 ] = +( match[ 4 ] ?
					match[ 5 ] + ( match[ 6 ] || 1 ) :
					2 * ( match[ 3 ] === "even" || match[ 3 ] === "odd" ) );
				match[ 5 ] = +( ( match[ 7 ] + match[ 8 ] ) || match[ 3 ] === "odd" );

				// other types prohibit arguments
			} else if ( match[ 3 ] ) {
				Sizzle.error( match[ 0 ] );
			}

			return match;
		},

		"PSEUDO": function( match ) {
			var excess,
				unquoted = !match[ 6 ] && match[ 2 ];

			if ( matchExpr[ "CHILD" ].test( match[ 0 ] ) ) {
				return null;
			}

			// Accept quoted arguments as-is
			if ( match[ 3 ] ) {
				match[ 2 ] = match[ 4 ] || match[ 5 ] || "";

			// Strip excess characters from unquoted arguments
			} else if ( unquoted && rpseudo.test( unquoted ) &&

				// Get excess from tokenize (recursively)
				( excess = tokenize( unquoted, true ) ) &&

				// advance to the next closing parenthesis
				( excess = unquoted.indexOf( ")", unquoted.length - excess ) - unquoted.length ) ) {

				// excess is a negative index
				match[ 0 ] = match[ 0 ].slice( 0, excess );
				match[ 2 ] = unquoted.slice( 0, excess );
			}

			// Return only captures needed by the pseudo filter method (type and argument)
			return match.slice( 0, 3 );
		}
	},

	filter: {

		"TAG": function( nodeNameSelector ) {
			var nodeName = nodeNameSelector.replace( runescape, funescape ).toLowerCase();
			return nodeNameSelector === "*" ?
				function() {
					return true;
				} :
				function( elem ) {
					return elem.nodeName && elem.nodeName.toLowerCase() === nodeName;
				};
		},

		"CLASS": function( className ) {
			var pattern = classCache[ className + " " ];

			return pattern ||
				( pattern = new RegExp( "(^|" + whitespace +
					")" + className + "(" + whitespace + "|$)" ) ) && classCache(
						className, function( elem ) {
							return pattern.test(
								typeof elem.className === "string" && elem.className ||
								typeof elem.getAttribute !== "undefined" &&
									elem.getAttribute( "class" ) ||
								""
							);
				} );
		},

		"ATTR": function( name, operator, check ) {
			return function( elem ) {
				var result = Sizzle.attr( elem, name );

				if ( result == null ) {
					return operator === "!=";
				}
				if ( !operator ) {
					return true;
				}

				result += "";

				/* eslint-disable max-len */

				return operator === "=" ? result === check :
					operator === "!=" ? result !== check :
					operator === "^=" ? check && result.indexOf( check ) === 0 :
					operator === "*=" ? check && result.indexOf( check ) > -1 :
					operator === "$=" ? check && result.slice( -check.length ) === check :
					operator === "~=" ? ( " " + result.replace( rwhitespace, " " ) + " " ).indexOf( check ) > -1 :
					operator === "|=" ? result === check || result.slice( 0, check.length + 1 ) === check + "-" :
					false;
				/* eslint-enable max-len */

			};
		},

		"CHILD": function( type, what, _argument, first, last ) {
			var simple = type.slice( 0, 3 ) !== "nth",
				forward = type.slice( -4 ) !== "last",
				ofType = what === "of-type";

			return first === 1 && last === 0 ?

				// Shortcut for :nth-*(n)
				function( elem ) {
					return !!elem.parentNode;
				} :

				function( elem, _context, xml ) {
					var cache, uniqueCache, outerCache, node, nodeIndex, start,
						dir = simple !== forward ? "nextSibling" : "previousSibling",
						parent = elem.parentNode,
						name = ofType && elem.nodeName.toLowerCase(),
						useCache = !xml && !ofType,
						diff = false;

					if ( parent ) {

						// :(first|last|only)-(child|of-type)
						if ( simple ) {
							while ( dir ) {
								node = elem;
								while ( ( node = node[ dir ] ) ) {
									if ( ofType ?
										node.nodeName.toLowerCase() === name :
										node.nodeType === 1 ) {

										return false;
									}
								}

								// Reverse direction for :only-* (if we haven't yet done so)
								start = dir = type === "only" && !start && "nextSibling";
							}
							return true;
						}

						start = [ forward ? parent.firstChild : parent.lastChild ];

						// non-xml :nth-child(...) stores cache data on `parent`
						if ( forward && useCache ) {

							// Seek `elem` from a previously-cached index

							// ...in a gzip-friendly way
							node = parent;
							outerCache = node[ expando ] || ( node[ expando ] = {} );

							// Support: IE <9 only
							// Defend against cloned attroperties (jQuery gh-1709)
							uniqueCache = outerCache[ node.uniqueID ] ||
								( outerCache[ node.uniqueID ] = {} );

							cache = uniqueCache[ type ] || [];
							nodeIndex = cache[ 0 ] === dirruns && cache[ 1 ];
							diff = nodeIndex && cache[ 2 ];
							node = nodeIndex && parent.childNodes[ nodeIndex ];

							while ( ( node = ++nodeIndex && node && node[ dir ] ||

								// Fallback to seeking `elem` from the start
								( diff = nodeIndex = 0 ) || start.pop() ) ) {

								// When found, cache indexes on `parent` and break
								if ( node.nodeType === 1 && ++diff && node === elem ) {
									uniqueCache[ type ] = [ dirruns, nodeIndex, diff ];
									break;
								}
							}

						} else {

							// Use previously-cached element index if available
							if ( useCache ) {

								// ...in a gzip-friendly way
								node = elem;
								outerCache = node[ expando ] || ( node[ expando ] = {} );

								// Support: IE <9 only
								// Defend against cloned attroperties (jQuery gh-1709)
								uniqueCache = outerCache[ node.uniqueID ] ||
									( outerCache[ node.uniqueID ] = {} );

								cache = uniqueCache[ type ] || [];
								nodeIndex = cache[ 0 ] === dirruns && cache[ 1 ];
								diff = nodeIndex;
							}

							// xml :nth-child(...)
							// or :nth-last-child(...) or :nth(-last)?-of-type(...)
							if ( diff === false ) {

								// Use the same loop as above to seek `elem` from the start
								while ( ( node = ++nodeIndex && node && node[ dir ] ||
									( diff = nodeIndex = 0 ) || start.pop() ) ) {

									if ( ( ofType ?
										node.nodeName.toLowerCase() === name :
										node.nodeType === 1 ) &&
										++diff ) {

										// Cache the index of each encountered element
										if ( useCache ) {
											outerCache = node[ expando ] ||
												( node[ expando ] = {} );

											// Support: IE <9 only
											// Defend against cloned attroperties (jQuery gh-1709)
											uniqueCache = outerCache[ node.uniqueID ] ||
												( outerCache[ node.uniqueID ] = {} );

											uniqueCache[ type ] = [ dirruns, diff ];
										}

										if ( node === elem ) {
											break;
										}
									}
								}
							}
						}

						// Incorporate the offset, then check against cycle size
						diff -= last;
						return diff === first || ( diff % first === 0 && diff / first >= 0 );
					}
				};
		},

		"PSEUDO": function( pseudo, argument ) {

			// pseudo-class names are case-insensitive
			// http://www.w3.org/TR/selectors/#pseudo-classes
			// Prioritize by case sensitivity in case custom pseudos are added with uppercase letters
			// Remember that setFilters inherits from pseudos
			var args,
				fn = Expr.pseudos[ pseudo ] || Expr.setFilters[ pseudo.toLowerCase() ] ||
					Sizzle.error( "unsupported pseudo: " + pseudo );

			// The user may use createPseudo to indicate that
			// arguments are needed to create the filter function
			// just as Sizzle does
			if ( fn[ expando ] ) {
				return fn( argument );
			}

			// But maintain support for old signatures
			if ( fn.length > 1 ) {
				args = [ pseudo, pseudo, "", argument ];
				return Expr.setFilters.hasOwnProperty( pseudo.toLowerCase() ) ?
					markFunction( function( seed, matches ) {
						var idx,
							matched = fn( seed, argument ),
							i = matched.length;
						while ( i-- ) {
							idx = indexOf( seed, matched[ i ] );
							seed[ idx ] = !( matches[ idx ] = matched[ i ] );
						}
					} ) :
					function( elem ) {
						return fn( elem, 0, args );
					};
			}

			return fn;
		}
	},

	pseudos: {

		// Potentially complex pseudos
		"not": markFunction( function( selector ) {

			// Trim the selector passed to compile
			// to avoid treating leading and trailing
			// spaces as combinators
			var input = [],
				results = [],
				matcher = compile( selector.replace( rtrim, "$1" ) );

			return matcher[ expando ] ?
				markFunction( function( seed, matches, _context, xml ) {
					var elem,
						unmatched = matcher( seed, null, xml, [] ),
						i = seed.length;

					// Match elements unmatched by `matcher`
					while ( i-- ) {
						if ( ( elem = unmatched[ i ] ) ) {
							seed[ i ] = !( matches[ i ] = elem );
						}
					}
				} ) :
				function( elem, _context, xml ) {
					input[ 0 ] = elem;
					matcher( input, null, xml, results );

					// Don't keep the element (issue #299)
					input[ 0 ] = null;
					return !results.pop();
				};
		} ),

		"has": markFunction( function( selector ) {
			return function( elem ) {
				return Sizzle( selector, elem ).length > 0;
			};
		} ),

		"contains": markFunction( function( text ) {
			text = text.replace( runescape, funescape );
			return function( elem ) {
				return ( elem.textContent || getText( elem ) ).indexOf( text ) > -1;
			};
		} ),

		// "Whether an element is represented by a :lang() selector
		// is based solely on the element's language value
		// being equal to the identifier C,
		// or beginning with the identifier C immediately followed by "-".
		// The matching of C against the element's language value is performed case-insensitively.
		// The identifier C does not have to be a valid language name."
		// http://www.w3.org/TR/selectors/#lang-pseudo
		"lang": markFunction( function( lang ) {

			// lang value must be a valid identifier
			if ( !ridentifier.test( lang || "" ) ) {
				Sizzle.error( "unsupported lang: " + lang );
			}
			lang = lang.replace( runescape, funescape ).toLowerCase();
			return function( elem ) {
				var elemLang;
				do {
					if ( ( elemLang = documentIsHTML ?
						elem.lang :
						elem.getAttribute( "xml:lang" ) || elem.getAttribute( "lang" ) ) ) {

						elemLang = elemLang.toLowerCase();
						return elemLang === lang || elemLang.indexOf( lang + "-" ) === 0;
					}
				} while ( ( elem = elem.parentNode ) && elem.nodeType === 1 );
				return false;
			};
		} ),

		// Miscellaneous
		"target": function( elem ) {
			var hash = window.location && window.location.hash;
			return hash && hash.slice( 1 ) === elem.id;
		},

		"root": function( elem ) {
			return elem === docElem;
		},

		"focus": function( elem ) {
			return elem === document.activeElement &&
				( !document.hasFocus || document.hasFocus() ) &&
				!!( elem.type || elem.href || ~elem.tabIndex );
		},

		// Boolean properties
		"enabled": createDisabledPseudo( false ),
		"disabled": createDisabledPseudo( true ),

		"checked": function( elem ) {

			// In CSS3, :checked should return both checked and selected elements
			// http://www.w3.org/TR/2011/REC-css3-selectors-20110929/#checked
			var nodeName = elem.nodeName.toLowerCase();
			return ( nodeName === "input" && !!elem.checked ) ||
				( nodeName === "option" && !!elem.selected );
		},

		"selected": function( elem ) {

			// Accessing this property makes selected-by-default
			// options in Safari work properly
			if ( elem.parentNode ) {
				// eslint-disable-next-line no-unused-expressions
				elem.parentNode.selectedIndex;
			}

			return elem.selected === true;
		},

		// Contents
		"empty": function( elem ) {

			// http://www.w3.org/TR/selectors/#empty-pseudo
			// :empty is negated by element (1) or content nodes (text: 3; cdata: 4; entity ref: 5),
			//   but not by others (comment: 8; processing instruction: 7; etc.)
			// nodeType < 6 works because attributes (2) do not appear as children
			for ( elem = elem.firstChild; elem; elem = elem.nextSibling ) {
				if ( elem.nodeType < 6 ) {
					return false;
				}
			}
			return true;
		},

		"parent": function( elem ) {
			return !Expr.pseudos[ "empty" ]( elem );
		},

		// Element/input types
		"header": function( elem ) {
			return rheader.test( elem.nodeName );
		},

		"input": function( elem ) {
			return rinputs.test( elem.nodeName );
		},

		"button": function( elem ) {
			var name = elem.nodeName.toLowerCase();
			return name === "input" && elem.type === "button" || name === "button";
		},

		"text": function( elem ) {
			var attr;
			return elem.nodeName.toLowerCase() === "input" &&
				elem.type === "text" &&

				// Support: IE<8
				// New HTML5 attribute values (e.g., "search") appear with elem.type === "text"
				( ( attr = elem.getAttribute( "type" ) ) == null ||
					attr.toLowerCase() === "text" );
		},

		// Position-in-collection
		"first": createPositionalPseudo( function() {
			return [ 0 ];
		} ),

		"last": createPositionalPseudo( function( _matchIndexes, length ) {
			return [ length - 1 ];
		} ),

		"eq": createPositionalPseudo( function( _matchIndexes, length, argument ) {
			return [ argument < 0 ? argument + length : argument ];
		} ),

		"even": createPositionalPseudo( function( matchIndexes, length ) {
			var i = 0;
			for ( ; i < length; i += 2 ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		} ),

		"odd": createPositionalPseudo( function( matchIndexes, length ) {
			var i = 1;
			for ( ; i < length; i += 2 ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		} ),

		"lt": createPositionalPseudo( function( matchIndexes, length, argument ) {
			var i = argument < 0 ?
				argument + length :
				argument > length ?
					length :
					argument;
			for ( ; --i >= 0; ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		} ),

		"gt": createPositionalPseudo( function( matchIndexes, length, argument ) {
			var i = argument < 0 ? argument + length : argument;
			for ( ; ++i < length; ) {
				matchIndexes.push( i );
			}
			return matchIndexes;
		} )
	}
};

Expr.pseudos[ "nth" ] = Expr.pseudos[ "eq" ];

// Add button/input type pseudos
for ( i in { radio: true, checkbox: true, file: true, password: true, image: true } ) {
	Expr.pseudos[ i ] = createInputPseudo( i );
}
for ( i in { submit: true, reset: true } ) {
	Expr.pseudos[ i ] = createButtonPseudo( i );
}

// Easy API for creating new setFilters
function setFilters() {}
setFilters.prototype = Expr.filters = Expr.pseudos;
Expr.setFilters = new setFilters();

tokenize = Sizzle.tokenize = function( selector, parseOnly ) {
	var matched, match, tokens, type,
		soFar, groups, preFilters,
		cached = tokenCache[ selector + " " ];

	if ( cached ) {
		return parseOnly ? 0 : cached.slice( 0 );
	}

	soFar = selector;
	groups = [];
	preFilters = Expr.preFilter;

	while ( soFar ) {

		// Comma and first run
		if ( !matched || ( match = rcomma.exec( soFar ) ) ) {
			if ( match ) {

				// Don't consume trailing commas as valid
				soFar = soFar.slice( match[ 0 ].length ) || soFar;
			}
			groups.push( ( tokens = [] ) );
		}

		matched = false;

		// Combinators
		if ( ( match = rcombinators.exec( soFar ) ) ) {
			matched = match.shift();
			tokens.push( {
				value: matched,

				// Cast descendant combinators to space
				type: match[ 0 ].replace( rtrim, " " )
			} );
			soFar = soFar.slice( matched.length );
		}

		// Filters
		for ( type in Expr.filter ) {
			if ( ( match = matchExpr[ type ].exec( soFar ) ) && ( !preFilters[ type ] ||
				( match = preFilters[ type ]( match ) ) ) ) {
				matched = match.shift();
				tokens.push( {
					value: matched,
					type: type,
					matches: match
				} );
				soFar = soFar.slice( matched.length );
			}
		}

		if ( !matched ) {
			break;
		}
	}

	// Return the length of the invalid excess
	// if we're just parsing
	// Otherwise, throw an error or return tokens
	return parseOnly ?
		soFar.length :
		soFar ?
			Sizzle.error( selector ) :

			// Cache the tokens
			tokenCache( selector, groups ).slice( 0 );
};

function toSelector( tokens ) {
	var i = 0,
		len = tokens.length,
		selector = "";
	for ( ; i < len; i++ ) {
		selector += tokens[ i ].value;
	}
	return selector;
}

function addCombinator( matcher, combinator, base ) {
	var dir = combinator.dir,
		skip = combinator.next,
		key = skip || dir,
		checkNonElements = base && key === "parentNode",
		doneName = done++;

	return combinator.first ?

		// Check against closest ancestor/preceding element
		function( elem, context, xml ) {
			while ( ( elem = elem[ dir ] ) ) {
				if ( elem.nodeType === 1 || checkNonElements ) {
					return matcher( elem, context, xml );
				}
			}
			return false;
		} :

		// Check against all ancestor/preceding elements
		function( elem, context, xml ) {
			var oldCache, uniqueCache, outerCache,
				newCache = [ dirruns, doneName ];

			// We can't set arbitrary data on XML nodes, so they don't benefit from combinator caching
			if ( xml ) {
				while ( ( elem = elem[ dir ] ) ) {
					if ( elem.nodeType === 1 || checkNonElements ) {
						if ( matcher( elem, context, xml ) ) {
							return true;
						}
					}
				}
			} else {
				while ( ( elem = elem[ dir ] ) ) {
					if ( elem.nodeType === 1 || checkNonElements ) {
						outerCache = elem[ expando ] || ( elem[ expando ] = {} );

						// Support: IE <9 only
						// Defend against cloned attroperties (jQuery gh-1709)
						uniqueCache = outerCache[ elem.uniqueID ] ||
							( outerCache[ elem.uniqueID ] = {} );

						if ( skip && skip === elem.nodeName.toLowerCase() ) {
							elem = elem[ dir ] || elem;
						} else if ( ( oldCache = uniqueCache[ key ] ) &&
							oldCache[ 0 ] === dirruns && oldCache[ 1 ] === doneName ) {

							// Assign to newCache so results back-propagate to previous elements
							return ( newCache[ 2 ] = oldCache[ 2 ] );
						} else {

							// Reuse newcache so results back-propagate to previous elements
							uniqueCache[ key ] = newCache;

							// A match means we're done; a fail means we have to keep checking
							if ( ( newCache[ 2 ] = matcher( elem, context, xml ) ) ) {
								return true;
							}
						}
					}
				}
			}
			return false;
		};
}

function elementMatcher( matchers ) {
	return matchers.length > 1 ?
		function( elem, context, xml ) {
			var i = matchers.length;
			while ( i-- ) {
				if ( !matchers[ i ]( elem, context, xml ) ) {
					return false;
				}
			}
			return true;
		} :
		matchers[ 0 ];
}

function multipleContexts( selector, contexts, results ) {
	var i = 0,
		len = contexts.length;
	for ( ; i < len; i++ ) {
		Sizzle( selector, contexts[ i ], results );
	}
	return results;
}

function condense( unmatched, map, filter, context, xml ) {
	var elem,
		newUnmatched = [],
		i = 0,
		len = unmatched.length,
		mapped = map != null;

	for ( ; i < len; i++ ) {
		if ( ( elem = unmatched[ i ] ) ) {
			if ( !filter || filter( elem, context, xml ) ) {
				newUnmatched.push( elem );
				if ( mapped ) {
					map.push( i );
				}
			}
		}
	}

	return newUnmatched;
}

function setMatcher( preFilter, selector, matcher, postFilter, postFinder, postSelector ) {
	if ( postFilter && !postFilter[ expando ] ) {
		postFilter = setMatcher( postFilter );
	}
	if ( postFinder && !postFinder[ expando ] ) {
		postFinder = setMatcher( postFinder, postSelector );
	}
	return markFunction( function( seed, results, context, xml ) {
		var temp, i, elem,
			preMap = [],
			postMap = [],
			preexisting = results.length,

			// Get initial elements from seed or context
			elems = seed || multipleContexts(
				selector || "*",
				context.nodeType ? [ context ] : context,
				[]
			),

			// Prefilter to get matcher input, preserving a map for seed-results synchronization
			matcherIn = preFilter && ( seed || !selector ) ?
				condense( elems, preMap, preFilter, context, xml ) :
				elems,

			matcherOut = matcher ?

				// If we have a postFinder, or filtered seed, or non-seed postFilter or preexisting results,
				postFinder || ( seed ? preFilter : preexisting || postFilter ) ?

					// ...intermediate processing is necessary
					[] :

					// ...otherwise use results directly
					results :
				matcherIn;

		// Find primary matches
		if ( matcher ) {
			matcher( matcherIn, matcherOut, context, xml );
		}

		// Apply postFilter
		if ( postFilter ) {
			temp = condense( matcherOut, postMap );
			postFilter( temp, [], context, xml );

			// Un-match failing elements by moving them back to matcherIn
			i = temp.length;
			while ( i-- ) {
				if ( ( elem = temp[ i ] ) ) {
					matcherOut[ postMap[ i ] ] = !( matcherIn[ postMap[ i ] ] = elem );
				}
			}
		}

		if ( seed ) {
			if ( postFinder || preFilter ) {
				if ( postFinder ) {

					// Get the final matcherOut by condensing this intermediate into postFinder contexts
					temp = [];
					i = matcherOut.length;
					while ( i-- ) {
						if ( ( elem = matcherOut[ i ] ) ) {

							// Restore matcherIn since elem is not yet a final match
							temp.push( ( matcherIn[ i ] = elem ) );
						}
					}
					postFinder( null, ( matcherOut = [] ), temp, xml );
				}

				// Move matched elements from seed to results to keep them synchronized
				i = matcherOut.length;
				while ( i-- ) {
					if ( ( elem = matcherOut[ i ] ) &&
						( temp = postFinder ? indexOf( seed, elem ) : preMap[ i ] ) > -1 ) {

						seed[ temp ] = !( results[ temp ] = elem );
					}
				}
			}

		// Add elements to results, through postFinder if defined
		} else {
			matcherOut = condense(
				matcherOut === results ?
					matcherOut.splice( preexisting, matcherOut.length ) :
					matcherOut
			);
			if ( postFinder ) {
				postFinder( null, results, matcherOut, xml );
			} else {
				push.apply( results, matcherOut );
			}
		}
	} );
}

function matcherFromTokens( tokens ) {
	var checkContext, matcher, j,
		len = tokens.length,
		leadingRelative = Expr.relative[ tokens[ 0 ].type ],
		implicitRelative = leadingRelative || Expr.relative[ " " ],
		i = leadingRelative ? 1 : 0,

		// The foundational matcher ensures that elements are reachable from top-level context(s)
		matchContext = addCombinator( function( elem ) {
			return elem === checkContext;
		}, implicitRelative, true ),
		matchAnyContext = addCombinator( function( elem ) {
			return indexOf( checkContext, elem ) > -1;
		}, implicitRelative, true ),
		matchers = [ function( elem, context, xml ) {
			var ret = ( !leadingRelative && ( xml || context !== outermostContext ) ) || (
				( checkContext = context ).nodeType ?
					matchContext( elem, context, xml ) :
					matchAnyContext( elem, context, xml ) );

			// Avoid hanging onto element (issue #299)
			checkContext = null;
			return ret;
		} ];

	for ( ; i < len; i++ ) {
		if ( ( matcher = Expr.relative[ tokens[ i ].type ] ) ) {
			matchers = [ addCombinator( elementMatcher( matchers ), matcher ) ];
		} else {
			matcher = Expr.filter[ tokens[ i ].type ].apply( null, tokens[ i ].matches );

			// Return special upon seeing a positional matcher
			if ( matcher[ expando ] ) {

				// Find the next relative operator (if any) for proper handling
				j = ++i;
				for ( ; j < len; j++ ) {
					if ( Expr.relative[ tokens[ j ].type ] ) {
						break;
					}
				}
				return setMatcher(
					i > 1 && elementMatcher( matchers ),
					i > 1 && toSelector(

					// If the preceding token was a descendant combinator, insert an implicit any-element `*`
					tokens
						.slice( 0, i - 1 )
						.concat( { value: tokens[ i - 2 ].type === " " ? "*" : "" } )
					).replace( rtrim, "$1" ),
					matcher,
					i < j && matcherFromTokens( tokens.slice( i, j ) ),
					j < len && matcherFromTokens( ( tokens = tokens.slice( j ) ) ),
					j < len && toSelector( tokens )
				);
			}
			matchers.push( matcher );
		}
	}

	return elementMatcher( matchers );
}

function matcherFromGroupMatchers( elementMatchers, setMatchers ) {
	var bySet = setMatchers.length > 0,
		byElement = elementMatchers.length > 0,
		superMatcher = function( seed, context, xml, results, outermost ) {
			var elem, j, matcher,
				matchedCount = 0,
				i = "0",
				unmatched = seed && [],
				setMatched = [],
				contextBackup = outermostContext,

				// We must always have either seed elements or outermost context
				elems = seed || byElement && Expr.find[ "TAG" ]( "*", outermost ),

				// Use integer dirruns iff this is the outermost matcher
				dirrunsUnique = ( dirruns += contextBackup == null ? 1 : Math.random() || 0.1 ),
				len = elems.length;

			if ( outermost ) {

				// Support: IE 11+, Edge 17 - 18+
				// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
				// two documents; shallow comparisons work.
				// eslint-disable-next-line eqeqeq
				outermostContext = context == document || context || outermost;
			}

			// Add elements passing elementMatchers directly to results
			// Support: IE<9, Safari
			// Tolerate NodeList properties (IE: "length"; Safari: <number>) matching elements by id
			for ( ; i !== len && ( elem = elems[ i ] ) != null; i++ ) {
				if ( byElement && elem ) {
					j = 0;

					// Support: IE 11+, Edge 17 - 18+
					// IE/Edge sometimes throw a "Permission denied" error when strict-comparing
					// two documents; shallow comparisons work.
					// eslint-disable-next-line eqeqeq
					if ( !context && elem.ownerDocument != document ) {
						setDocument( elem );
						xml = !documentIsHTML;
					}
					while ( ( matcher = elementMatchers[ j++ ] ) ) {
						if ( matcher( elem, context || document, xml ) ) {
							results.push( elem );
							break;
						}
					}
					if ( outermost ) {
						dirruns = dirrunsUnique;
					}
				}

				// Track unmatched elements for set filters
				if ( bySet ) {

					// They will have gone through all possible matchers
					if ( ( elem = !matcher && elem ) ) {
						matchedCount--;
					}

					// Lengthen the array for every element, matched or not
					if ( seed ) {
						unmatched.push( elem );
					}
				}
			}

			// `i` is now the count of elements visited above, and adding it to `matchedCount`
			// makes the latter nonnegative.
			matchedCount += i;

			// Apply set filters to unmatched elements
			// NOTE: This can be skipped if there are no unmatched elements (i.e., `matchedCount`
			// equals `i`), unless we didn't visit _any_ elements in the above loop because we have
			// no element matchers and no seed.
			// Incrementing an initially-string "0" `i` allows `i` to remain a string only in that
			// case, which will result in a "00" `matchedCount` that differs from `i` but is also
			// numerically zero.
			if ( bySet && i !== matchedCount ) {
				j = 0;
				while ( ( matcher = setMatchers[ j++ ] ) ) {
					matcher( unmatched, setMatched, context, xml );
				}

				if ( seed ) {

					// Reintegrate element matches to eliminate the need for sorting
					if ( matchedCount > 0 ) {
						while ( i-- ) {
							if ( !( unmatched[ i ] || setMatched[ i ] ) ) {
								setMatched[ i ] = pop.call( results );
							}
						}
					}

					// Discard index placeholder values to get only actual matches
					setMatched = condense( setMatched );
				}

				// Add matches to results
				push.apply( results, setMatched );

				// Seedless set matches succeeding multiple successful matchers stipulate sorting
				if ( outermost && !seed && setMatched.length > 0 &&
					( matchedCount + setMatchers.length ) > 1 ) {

					Sizzle.uniqueSort( results );
				}
			}

			// Override manipulation of globals by nested matchers
			if ( outermost ) {
				dirruns = dirrunsUnique;
				outermostContext = contextBackup;
			}

			return unmatched;
		};

	return bySet ?
		markFunction( superMatcher ) :
		superMatcher;
}

compile = Sizzle.compile = function( selector, match /* Internal Use Only */ ) {
	var i,
		setMatchers = [],
		elementMatchers = [],
		cached = compilerCache[ selector + " " ];

	if ( !cached ) {

		// Generate a function of recursive functions that can be used to check each element
		if ( !match ) {
			match = tokenize( selector );
		}
		i = match.length;
		while ( i-- ) {
			cached = matcherFromTokens( match[ i ] );
			if ( cached[ expando ] ) {
				setMatchers.push( cached );
			} else {
				elementMatchers.push( cached );
			}
		}

		// Cache the compiled function
		cached = compilerCache(
			selector,
			matcherFromGroupMatchers( elementMatchers, setMatchers )
		);

		// Save selector and tokenization
		cached.selector = selector;
	}
	return cached;
};

/**
 * A low-level selection function that works with Sizzle's compiled
 *  selector functions
 * @param {String|Function} selector A selector or a pre-compiled
 *  selector function built with Sizzle.compile
 * @param {Element} context
 * @param {Array} [results]
 * @param {Array} [seed] A set of elements to match against
 */
select = Sizzle.select = function( selector, context, results, seed ) {
	var i, tokens, token, type, find,
		compiled = typeof selector === "function" && selector,
		match = !seed && tokenize( ( selector = compiled.selector || selector ) );

	results = results || [];

	// Try to minimize operations if there is only one selector in the list and no seed
	// (the latter of which guarantees us context)
	if ( match.length === 1 ) {

		// Reduce context if the leading compound selector is an ID
		tokens = match[ 0 ] = match[ 0 ].slice( 0 );
		if ( tokens.length > 2 && ( token = tokens[ 0 ] ).type === "ID" &&
			context.nodeType === 9 && documentIsHTML && Expr.relative[ tokens[ 1 ].type ] ) {

			context = ( Expr.find[ "ID" ]( token.matches[ 0 ]
				.replace( runescape, funescape ), context ) || [] )[ 0 ];
			if ( !context ) {
				return results;

			// Precompiled matchers will still verify ancestry, so step up a level
			} else if ( compiled ) {
				context = context.parentNode;
			}

			selector = selector.slice( tokens.shift().value.length );
		}

		// Fetch a seed set for right-to-left matching
		i = matchExpr[ "needsContext" ].test( selector ) ? 0 : tokens.length;
		while ( i-- ) {
			token = tokens[ i ];

			// Abort if we hit a combinator
			if ( Expr.relative[ ( type = token.type ) ] ) {
				break;
			}
			if ( ( find = Expr.find[ type ] ) ) {

				// Search, expanding context for leading sibling combinators
				if ( ( seed = find(
					token.matches[ 0 ].replace( runescape, funescape ),
					rsibling.test( tokens[ 0 ].type ) && testContext( context.parentNode ) ||
						context
				) ) ) {

					// If seed is empty or no tokens remain, we can return early
					tokens.splice( i, 1 );
					selector = seed.length && toSelector( tokens );
					if ( !selector ) {
						push.apply( results, seed );
						return results;
					}

					break;
				}
			}
		}
	}

	// Compile and execute a filtering function if one is not provided
	// Provide `match` to avoid retokenization if we modified the selector above
	( compiled || compile( selector, match ) )(
		seed,
		context,
		!documentIsHTML,
		results,
		!context || rsibling.test( selector ) && testContext( context.parentNode ) || context
	);
	return results;
};

// One-time assignments

// Sort stability
support.sortStable = expando.split( "" ).sort( sortOrder ).join( "" ) === expando;

// Support: Chrome 14-35+
// Always assume duplicates if they aren't passed to the comparison function
support.detectDuplicates = !!hasDuplicate;

// Initialize against the default document
setDocument();

// Support: Webkit<537.32 - Safari 6.0.3/Chrome 25 (fixed in Chrome 27)
// Detached nodes confoundingly follow *each other*
support.sortDetached = assert( function( el ) {

	// Should return 1, but returns 4 (following)
	return el.compareDocumentPosition( document.createElement( "fieldset" ) ) & 1;
} );

// Support: IE<8
// Prevent attribute/property "interpolation"
// https://msdn.microsoft.com/en-us/library/ms536429%28VS.85%29.aspx
if ( !assert( function( el ) {
	el.innerHTML = "<a href='#'></a>";
	return el.firstChild.getAttribute( "href" ) === "#";
} ) ) {
	addHandle( "type|href|height|width", function( elem, name, isXML ) {
		if ( !isXML ) {
			return elem.getAttribute( name, name.toLowerCase() === "type" ? 1 : 2 );
		}
	} );
}

// Support: IE<9
// Use defaultValue in place of getAttribute("value")
if ( !support.attributes || !assert( function( el ) {
	el.innerHTML = "<input/>";
	el.firstChild.setAttribute( "value", "" );
	return el.firstChild.getAttribute( "value" ) === "";
} ) ) {
	addHandle( "value", function( elem, _name, isXML ) {
		if ( !isXML && elem.nodeName.toLowerCase() === "input" ) {
			return elem.defaultValue;
		}
	} );
}

// Support: IE<9
// Use getAttributeNode to fetch booleans when getAttribute lies
if ( !assert( function( el ) {
	return el.getAttribute( "disabled" ) == null;
} ) ) {
	addHandle( booleans, function( elem, name, isXML ) {
		var val;
		if ( !isXML ) {
			return elem[ name ] === true ? name.toLowerCase() :
				( val = elem.getAttributeNode( name ) ) && val.specified ?
					val.value :
					null;
		}
	} );
}

return Sizzle;

} )( window );



jQuery.find = Sizzle;
jQuery.expr = Sizzle.selectors;

// Deprecated
jQuery.expr[ ":" ] = jQuery.expr.pseudos;
jQuery.uniqueSort = jQuery.unique = Sizzle.uniqueSort;
jQuery.text = Sizzle.getText;
jQuery.isXMLDoc = Sizzle.isXML;
jQuery.contains = Sizzle.contains;
jQuery.escapeSelector = Sizzle.escape;




var dir = function( elem, dir, until ) {
	var matched = [],
		truncate = until !== undefined;

	while ( ( elem = elem[ dir ] ) && elem.nodeType !== 9 ) {
		if ( elem.nodeType === 1 ) {
			if ( truncate && jQuery( elem ).is( until ) ) {
				break;
			}
			matched.push( elem );
		}
	}
	return matched;
};


var siblings = function( n, elem ) {
	var matched = [];

	for ( ; n; n = n.nextSibling ) {
		if ( n.nodeType === 1 && n !== elem ) {
			matched.push( n );
		}
	}

	return matched;
};


var rneedsContext = jQuery.expr.match.needsContext;



function nodeName( elem, name ) {

  return elem.nodeName && elem.nodeName.toLowerCase() === name.toLowerCase();

};
var rsingleTag = ( /^<([a-z][^\/\0>:\x20\t\r\n\f]*)[\x20\t\r\n\f]*\/?>(?:<\/\1>|)$/i );



// Implement the identical functionality for filter and not
function winnow( elements, qualifier, not ) {
	if ( isFunction( qualifier ) ) {
		return jQuery.grep( elements, function( elem, i ) {
			return !!qualifier.call( elem, i, elem ) !== not;
		} );
	}

	// Single element
	if ( qualifier.nodeType ) {
		return jQuery.grep( elements, function( elem ) {
			return ( elem === qualifier ) !== not;
		} );
	}

	// Arraylike of elements (jQuery, arguments, Array)
	if ( typeof qualifier !== "string" ) {
		return jQuery.grep( elements, function( elem ) {
			return ( indexOf.call( qualifier, elem ) > -1 ) !== not;
		} );
	}

	// Filtered directly for both simple and complex selectors
	return jQuery.filter( qualifier, elements, not );
}

jQuery.filter = function( expr, elems, not ) {
	var elem = elems[ 0 ];

	if ( not ) {
		expr = ":not(" + expr + ")";
	}

	if ( elems.length === 1 && elem.nodeType === 1 ) {
		return jQuery.find.matchesSelector( elem, expr ) ? [ elem ] : [];
	}

	return jQuery.find.matches( expr, jQuery.grep( elems, function( elem ) {
		return elem.nodeType === 1;
	} ) );
};

jQuery.fn.extend( {
	find: function( selector ) {
		var i, ret,
			len = this.length,
			self = this;

		if ( typeof selector !== "string" ) {
			return this.pushStack( jQuery( selector ).filter( function() {
				for ( i = 0; i < len; i++ ) {
					if ( jQuery.contains( self[ i ], this ) ) {
						return true;
					}
				}
			} ) );
		}

		ret = this.pushStack( [] );

		for ( i = 0; i < len; i++ ) {
			jQuery.find( selector, self[ i ], ret );
		}

		return len > 1 ? jQuery.uniqueSort( ret ) : ret;
	},
	filter: function( selector ) {
		return this.pushStack( winnow( this, selector || [], false ) );
	},
	not: function( selector ) {
		return this.pushStack( winnow( this, selector || [], true ) );
	},
	is: function( selector ) {
		return !!winnow(
			this,

			// If this is a positional/relative selector, check membership in the returned set
			// so $("p:first").is("p:last") won't return true for a doc with two "p".
			typeof selector === "string" && rneedsContext.test( selector ) ?
				jQuery( selector ) :
				selector || [],
			false
		).length;
	}
} );


// Initialize a jQuery object


// A central reference to the root jQuery(document)
var rootjQuery,

	// A simple way to check for HTML strings
	// Prioritize #id over <tag> to avoid XSS via location.hash (#9521)
	// Strict HTML recognition (#11290: must start with <)
	// Shortcut simple #id case for speed
	rquickExpr = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]+))$/,

	init = jQuery.fn.init = function( selector, context, root ) {
		var match, elem;

		// HANDLE: $(""), $(null), $(undefined), $(false)
		if ( !selector ) {
			return this;
		}

		// Method init() accepts an alternate rootjQuery
		// so migrate can support jQuery.sub (gh-2101)
		root = root || rootjQuery;

		// Handle HTML strings
		if ( typeof selector === "string" ) {
			if ( selector[ 0 ] === "<" &&
				selector[ selector.length - 1 ] === ">" &&
				selector.length >= 3 ) {

				// Assume that strings that start and end with <> are HTML and skip the regex check
				match = [ null, selector, null ];

			} else {
				match = rquickExpr.exec( selector );
			}

			// Match html or make sure no context is specified for #id
			if ( match && ( match[ 1 ] || !context ) ) {

				// HANDLE: $(html) -> $(array)
				if ( match[ 1 ] ) {
					context = context instanceof jQuery ? context[ 0 ] : context;

					// Option to run scripts is true for back-compat
					// Intentionally let the error be thrown if parseHTML is not present
					jQuery.merge( this, jQuery.parseHTML(
						match[ 1 ],
						context && context.nodeType ? context.ownerDocument || context : document,
						true
					) );

					// HANDLE: $(html, props)
					if ( rsingleTag.test( match[ 1 ] ) && jQuery.isPlainObject( context ) ) {
						for ( match in context ) {

							// Properties of context are called as methods if possible
							if ( isFunction( this[ match ] ) ) {
								this[ match ]( context[ match ] );

							// ...and otherwise set as attributes
							} else {
								this.attr( match, context[ match ] );
							}
						}
					}

					return this;

				// HANDLE: $(#id)
				} else {
					elem = document.getElementById( match[ 2 ] );

					if ( elem ) {

						// Inject the element directly into the jQuery object
						this[ 0 ] = elem;
						this.length = 1;
					}
					return this;
				}

			// HANDLE: $(expr, $(...))
			} else if ( !context || context.jquery ) {
				return ( context || root ).find( selector );

			// HANDLE: $(expr, context)
			// (which is just equivalent to: $(context).find(expr)
			} else {
				return this.constructor( context ).find( selector );
			}

		// HANDLE: $(DOMElement)
		} else if ( selector.nodeType ) {
			this[ 0 ] = selector;
			this.length = 1;
			return this;

		// HANDLE: $(function)
		// Shortcut for document ready
		} else if ( isFunction( selector ) ) {
			return root.ready !== undefined ?
				root.ready( selector ) :

				// Execute immediately if ready is not present
				selector( jQuery );
		}

		return jQuery.makeArray( selector, this );
	};

// Give the init function the jQuery prototype for later instantiation
init.prototype = jQuery.fn;

// Initialize central reference
rootjQuery = jQuery( document );


var rparentsprev = /^(?:parents|prev(?:Until|All))/,

	// Methods guaranteed to produce a unique set when starting from a unique set
	guaranteedUnique = {
		children: true,
		contents: true,
		next: true,
		prev: true
	};

jQuery.fn.extend( {
	has: function( target ) {
		var targets = jQuery( target, this ),
			l = targets.length;

		return this.filter( function() {
			var i = 0;
			for ( ; i < l; i++ ) {
				if ( jQuery.contains( this, targets[ i ] ) ) {
					return true;
				}
			}
		} );
	},

	closest: function( selectors, context ) {
		var cur,
			i = 0,
			l = this.length,
			matched = [],
			targets = typeof selectors !== "string" && jQuery( selectors );

		// Positional selectors never match, since there's no _selection_ context
		if ( !rneedsContext.test( selectors ) ) {
			for ( ; i < l; i++ ) {
				for ( cur = this[ i ]; cur && cur !== context; cur = cur.parentNode ) {

					// Always skip document fragments
					if ( cur.nodeType < 11 && ( targets ?
						targets.index( cur ) > -1 :

						// Don't pass non-elements to Sizzle
						cur.nodeType === 1 &&
							jQuery.find.matchesSelector( cur, selectors ) ) ) {

						matched.push( cur );
						break;
					}
				}
			}
		}

		return this.pushStack( matched.length > 1 ? jQuery.uniqueSort( matched ) : matched );
	},

	// Determine the position of an element within the set
	index: function( elem ) {

		// No argument, return index in parent
		if ( !elem ) {
			return ( this[ 0 ] && this[ 0 ].parentNode ) ? this.first().prevAll().length : -1;
		}

		// Index in selector
		if ( typeof elem === "string" ) {
			return indexOf.call( jQuery( elem ), this[ 0 ] );
		}

		// Locate the position of the desired element
		return indexOf.call( this,

			// If it receives a jQuery object, the first element is used
			elem.jquery ? elem[ 0 ] : elem
		);
	},

	add: function( selector, context ) {
		return this.pushStack(
			jQuery.uniqueSort(
				jQuery.merge( this.get(), jQuery( selector, context ) )
			)
		);
	},

	addBack: function( selector ) {
		return this.add( selector == null ?
			this.prevObject : this.prevObject.filter( selector )
		);
	}
} );

function sibling( cur, dir ) {
	while ( ( cur = cur[ dir ] ) && cur.nodeType !== 1 ) {}
	return cur;
}

jQuery.each( {
	parent: function( elem ) {
		var parent = elem.parentNode;
		return parent && parent.nodeType !== 11 ? parent : null;
	},
	parents: function( elem ) {
		return dir( elem, "parentNode" );
	},
	parentsUntil: function( elem, _i, until ) {
		return dir( elem, "parentNode", until );
	},
	next: function( elem ) {
		return sibling( elem, "nextSibling" );
	},
	prev: function( elem ) {
		return sibling( elem, "previousSibling" );
	},
	nextAll: function( elem ) {
		return dir( elem, "nextSibling" );
	},
	prevAll: function( elem ) {
		return dir( elem, "previousSibling" );
	},
	nextUntil: function( elem, _i, until ) {
		return dir( elem, "nextSibling", until );
	},
	prevUntil: function( elem, _i, until ) {
		return dir( elem, "previousSibling", until );
	},
	siblings: function( elem ) {
		return siblings( ( elem.parentNode || {} ).firstChild, elem );
	},
	children: function( elem ) {
		return siblings( elem.firstChild );
	},
	contents: function( elem ) {
		if ( elem.contentDocument != null &&

			// Support: IE 11+
			// <object> elements with no `data` attribute has an object
			// `contentDocument` with a `null` prototype.
			getProto( elem.contentDocument ) ) {

			return elem.contentDocument;
		}

		// Support: IE 9 - 11 only, iOS 7 only, Android Browser <=4.3 only
		// Treat the template element as a regular one in browsers that
		// don't support it.
		if ( nodeName( elem, "template" ) ) {
			elem = elem.content || elem;
		}

		return jQuery.merge( [], elem.childNodes );
	}
}, function( name, fn ) {
	jQuery.fn[ name ] = function( until, selector ) {
		var matched = jQuery.map( this, fn, until );

		if ( name.slice( -5 ) !== "Until" ) {
			selector = until;
		}

		if ( selector && typeof selector === "string" ) {
			matched = jQuery.filter( selector, matched );
		}

		if ( this.length > 1 ) {

			// Remove duplicates
			if ( !guaranteedUnique[ name ] ) {
				jQuery.uniqueSort( matched );
			}

			// Reverse order for parents* and prev-derivatives
			if ( rparentsprev.test( name ) ) {
				matched.reverse();
			}
		}

		return this.pushStack( matched );
	};
} );
var rnothtmlwhite = ( /[^\x20\t\r\n\f]+/g );



// Convert String-formatted options into Object-formatted ones
function createOptions( options ) {
	var object = {};
	jQuery.each( options.match( rnothtmlwhite ) || [], function( _, flag ) {
		object[ flag ] = true;
	} );
	return object;
}

/*
 * Create a callback list using the following parameters:
 *
 *	options: an optional list of space-separated options that will change how
 *			the callback list behaves or a more traditional option object
 *
 * By default a callback list will act like an event callback list and can be
 * "fired" multiple times.
 *
 * Possible options:
 *
 *	once:			will ensure the callback list can only be fired once (like a Deferred)
 *
 *	memory:			will keep track of previous values and will call any callback added
 *					after the list has been fired right away with the latest "memorized"
 *					values (like a Deferred)
 *
 *	unique:			will ensure a callback can only be added once (no duplicate in the list)
 *
 *	stopOnFalse:	interrupt callings when a callback returns false
 *
 */
jQuery.Callbacks = function( options ) {

	// Convert options from String-formatted to Object-formatted if needed
	// (we check in cache first)
	options = typeof options === "string" ?
		createOptions( options ) :
		jQuery.extend( {}, options );

	var // Flag to know if list is currently firing
		firing,

		// Last fire value for non-forgettable lists
		memory,

		// Flag to know if list was already fired
		fired,

		// Flag to prevent firing
		locked,

		// Actual callback list
		list = [],

		// Queue of execution data for repeatable lists
		queue = [],

		// Index of currently firing callback (modified by add/remove as needed)
		firingIndex = -1,

		// Fire callbacks
		fire = function() {

			// Enforce single-firing
			locked = locked || options.once;

			// Execute callbacks for all pending executions,
			// respecting firingIndex overrides and runtime changes
			fired = firing = true;
			for ( ; queue.length; firingIndex = -1 ) {
				memory = queue.shift();
				while ( ++firingIndex < list.length ) {

					// Run callback and check for early termination
					if ( list[ firingIndex ].apply( memory[ 0 ], memory[ 1 ] ) === false &&
						options.stopOnFalse ) {

						// Jump to end and forget the data so .add doesn't re-fire
						firingIndex = list.length;
						memory = false;
					}
				}
			}

			// Forget the data if we're done with it
			if ( !options.memory ) {
				memory = false;
			}

			firing = false;

			// Clean up if we're done firing for good
			if ( locked ) {

				// Keep an empty list if we have data for future add calls
				if ( memory ) {
					list = [];

				// Otherwise, this object is spent
				} else {
					list = "";
				}
			}
		},

		// Actual Callbacks object
		self = {

			// Add a callback or a collection of callbacks to the list
			add: function() {
				if ( list ) {

					// If we have memory from a past run, we should fire after adding
					if ( memory && !firing ) {
						firingIndex = list.length - 1;
						queue.push( memory );
					}

					( function add( args ) {
						jQuery.each( args, function( _, arg ) {
							if ( isFunction( arg ) ) {
								if ( !options.unique || !self.has( arg ) ) {
									list.push( arg );
								}
							} else if ( arg && arg.length && toType( arg ) !== "string" ) {

								// Inspect recursively
								add( arg );
							}
						} );
					} )( arguments );

					if ( memory && !firing ) {
						fire();
					}
				}
				return this;
			},

			// Remove a callback from the list
			remove: function() {
				jQuery.each( arguments, function( _, arg ) {
					var index;
					while ( ( index = jQuery.inArray( arg, list, index ) ) > -1 ) {
						list.splice( index, 1 );

						// Handle firing indexes
						if ( index <= firingIndex ) {
							firingIndex--;
						}
					}
				} );
				return this;
			},

			// Check if a given callback is in the list.
			// If no argument is given, return whether or not list has callbacks attached.
			has: function( fn ) {
				return fn ?
					jQuery.inArray( fn, list ) > -1 :
					list.length > 0;
			},

			// Remove all callbacks from the list
			empty: function() {
				if ( list ) {
					list = [];
				}
				return this;
			},

			// Disable .fire and .add
			// Abort any current/pending executions
			// Clear all callbacks and values
			disable: function() {
				locked = queue = [];
				list = memory = "";
				return this;
			},
			disabled: function() {
				return !list;
			},

			// Disable .fire
			// Also disable .add unless we have memory (since it would have no effect)
			// Abort any pending executions
			lock: function() {
				locked = queue = [];
				if ( !memory && !firing ) {
					list = memory = "";
				}
				return this;
			},
			locked: function() {
				return !!locked;
			},

			// Call all callbacks with the given context and arguments
			fireWith: function( context, args ) {
				if ( !locked ) {
					args = args || [];
					args = [ context, args.slice ? args.slice() : args ];
					queue.push( args );
					if ( !firing ) {
						fire();
					}
				}
				return this;
			},

			// Call all the callbacks with the given arguments
			fire: function() {
				self.fireWith( this, arguments );
				return this;
			},

			// To know if the callbacks have already been called at least once
			fired: function() {
				return !!fired;
			}
		};

	return self;
};


function Identity( v ) {
	return v;
}
function Thrower( ex ) {
	throw ex;
}

function adoptValue( value, resolve, reject, noValue ) {
	var method;

	try {

		// Check for promise aspect first to privilege synchronous behavior
		if ( value && isFunction( ( method = value.promise ) ) ) {
			method.call( value ).done( resolve ).fail( reject );

		// Other thenables
		} else if ( value && isFunction( ( method = value.then ) ) ) {
			method.call( value, resolve, reject );

		// Other non-thenables
		} else {

			// Control `resolve` arguments by letting Array#slice cast boolean `noValue` to integer:
			// * false: [ value ].slice( 0 ) => resolve( value )
			// * true: [ value ].slice( 1 ) => resolve()
			resolve.apply( undefined, [ value ].slice( noValue ) );
		}

	// For Promises/A+, convert exceptions into rejections
	// Since jQuery.when doesn't unwrap thenables, we can skip the extra checks appearing in
	// Deferred#then to conditionally suppress rejection.
	} catch ( value ) {

		// Support: Android 4.0 only
		// Strict mode functions invoked without .call/.apply get global-object context
		reject.apply( undefined, [ value ] );
	}
}

jQuery.extend( {

	Deferred: function( func ) {
		var tuples = [

				// action, add listener, callbacks,
				// ... .then handlers, argument index, [final state]
				[ "notify", "progress", jQuery.Callbacks( "memory" ),
					jQuery.Callbacks( "memory" ), 2 ],
				[ "resolve", "done", jQuery.Callbacks( "once memory" ),
					jQuery.Callbacks( "once memory" ), 0, "resolved" ],
				[ "reject", "fail", jQuery.Callbacks( "once memory" ),
					jQuery.Callbacks( "once memory" ), 1, "rejected" ]
			],
			state = "pending",
			promise = {
				state: function() {
					return state;
				},
				always: function() {
					deferred.done( arguments ).fail( arguments );
					return this;
				},
				"catch": function( fn ) {
					return promise.then( null, fn );
				},

				// Keep pipe for back-compat
				pipe: function( /* fnDone, fnFail, fnProgress */ ) {
					var fns = arguments;

					return jQuery.Deferred( function( newDefer ) {
						jQuery.each( tuples, function( _i, tuple ) {

							// Map tuples (progress, done, fail) to arguments (done, fail, progress)
							var fn = isFunction( fns[ tuple[ 4 ] ] ) && fns[ tuple[ 4 ] ];

							// deferred.progress(function() { bind to newDefer or newDefer.notify })
							// deferred.done(function() { bind to newDefer or newDefer.resolve })
							// deferred.fail(function() { bind to newDefer or newDefer.reject })
							deferred[ tuple[ 1 ] ]( function() {
								var returned = fn && fn.apply( this, arguments );
								if ( returned && isFunction( returned.promise ) ) {
									returned.promise()
										.progress( newDefer.notify )
										.done( newDefer.resolve )
										.fail( newDefer.reject );
								} else {
									newDefer[ tuple[ 0 ] + "With" ](
										this,
										fn ? [ returned ] : arguments
									);
								}
							} );
						} );
						fns = null;
					} ).promise();
				},
				then: function( onFulfilled, onRejected, onProgress ) {
					var maxDepth = 0;
					function resolve( depth, deferred, handler, special ) {
						return function() {
							var that = this,
								args = arguments,
								mightThrow = function() {
									var returned, then;

									// Support: Promises/A+ section 2.3.3.3.3
									// https://promisesaplus.com/#point-59
									// Ignore double-resolution attempts
									if ( depth < maxDepth ) {
										return;
									}

									returned = handler.apply( that, args );

									// Support: Promises/A+ section 2.3.1
									// https://promisesaplus.com/#point-48
									if ( returned === deferred.promise() ) {
										throw new TypeError( "Thenable self-resolution" );
									}

									// Support: Promises/A+ sections 2.3.3.1, 3.5
									// https://promisesaplus.com/#point-54
									// https://promisesaplus.com/#point-75
									// Retrieve `then` only once
									then = returned &&

										// Support: Promises/A+ section 2.3.4
										// https://promisesaplus.com/#point-64
										// Only check objects and functions for thenability
										( typeof returned === "object" ||
											typeof returned === "function" ) &&
										returned.then;

									// Handle a returned thenable
									if ( isFunction( then ) ) {

										// Special processors (notify) just wait for resolution
										if ( special ) {
											then.call(
												returned,
												resolve( maxDepth, deferred, Identity, special ),
												resolve( maxDepth, deferred, Thrower, special )
											);

										// Normal processors (resolve) also hook into progress
										} else {

											// ...and disregard older resolution values
											maxDepth++;

											then.call(
												returned,
												resolve( maxDepth, deferred, Identity, special ),
												resolve( maxDepth, deferred, Thrower, special ),
												resolve( maxDepth, deferred, Identity,
													deferred.notifyWith )
											);
										}

									// Handle all other returned values
									} else {

										// Only substitute handlers pass on context
										// and multiple values (non-spec behavior)
										if ( handler !== Identity ) {
											that = undefined;
											args = [ returned ];
										}

										// Process the value(s)
										// Default process is resolve
										( special || deferred.resolveWith )( that, args );
									}
								},

								// Only normal processors (resolve) catch and reject exceptions
								process = special ?
									mightThrow :
									function() {
										try {
											mightThrow();
										} catch ( e ) {

											if ( jQuery.Deferred.exceptionHook ) {
												jQuery.Deferred.exceptionHook( e,
													process.stackTrace );
											}

											// Support: Promises/A+ section 2.3.3.3.4.1
											// https://promisesaplus.com/#point-61
											// Ignore post-resolution exceptions
											if ( depth + 1 >= maxDepth ) {

												// Only substitute handlers pass on context
												// and multiple values (non-spec behavior)
												if ( handler !== Thrower ) {
													that = undefined;
													args = [ e ];
												}

												deferred.rejectWith( that, args );
											}
										}
									};

							// Support: Promises/A+ section 2.3.3.3.1
							// https://promisesaplus.com/#point-57
							// Re-resolve promises immediately to dodge false rejection from
							// subsequent errors
							if ( depth ) {
								process();
							} else {

								// Call an optional hook to record the stack, in case of exception
								// since it's otherwise lost when execution goes async
								if ( jQuery.Deferred.getStackHook ) {
									process.stackTrace = jQuery.Deferred.getStackHook();
								}
								window.setTimeout( process );
							}
						};
					}

					return jQuery.Deferred( function( newDefer ) {

						// progress_handlers.add( ... )
						tuples[ 0 ][ 3 ].add(
							resolve(
								0,
								newDefer,
								isFunction( onProgress ) ?
									onProgress :
									Identity,
								newDefer.notifyWith
							)
						);

						// fulfilled_handlers.add( ... )
						tuples[ 1 ][ 3 ].add(
							resolve(
								0,
								newDefer,
								isFunction( onFulfilled ) ?
									onFulfilled :
									Identity
							)
						);

						// rejected_handlers.add( ... )
						tuples[ 2 ][ 3 ].add(
							resolve(
								0,
								newDefer,
								isFunction( onRejected ) ?
									onRejected :
									Thrower
							)
						);
					} ).promise();
				},

				// Get a promise for this deferred
				// If obj is provided, the promise aspect is added to the object
				promise: function( obj ) {
					return obj != null ? jQuery.extend( obj, promise ) : promise;
				}
			},
			deferred = {};

		// Add list-specific methods
		jQuery.each( tuples, function( i, tuple ) {
			var list = tuple[ 2 ],
				stateString = tuple[ 5 ];

			// promise.progress = list.add
			// promise.done = list.add
			// promise.fail = list.add
			promise[ tuple[ 1 ] ] = list.add;

			// Handle state
			if ( stateString ) {
				list.add(
					function() {

						// state = "resolved" (i.e., fulfilled)
						// state = "rejected"
						state = stateString;
					},

					// rejected_callbacks.disable
					// fulfilled_callbacks.disable
					tuples[ 3 - i ][ 2 ].disable,

					// rejected_handlers.disable
					// fulfilled_handlers.disable
					tuples[ 3 - i ][ 3 ].disable,

					// progress_callbacks.lock
					tuples[ 0 ][ 2 ].lock,

					// progress_handlers.lock
					tuples[ 0 ][ 3 ].lock
				);
			}

			// progress_handlers.fire
			// fulfilled_handlers.fire
			// rejected_handlers.fire
			list.add( tuple[ 3 ].fire );

			// deferred.notify = function() { deferred.notifyWith(...) }
			// deferred.resolve = function() { deferred.resolveWith(...) }
			// deferred.reject = function() { deferred.rejectWith(...) }
			deferred[ tuple[ 0 ] ] = function() {
				deferred[ tuple[ 0 ] + "With" ]( this === deferred ? undefined : this, arguments );
				return this;
			};

			// deferred.notifyWith = list.fireWith
			// deferred.resolveWith = list.fireWith
			// deferred.rejectWith = list.fireWith
			deferred[ tuple[ 0 ] + "With" ] = list.fireWith;
		} );

		// Make the deferred a promise
		promise.promise( deferred );

		// Call given func if any
		if ( func ) {
			func.call( deferred, deferred );
		}

		// All done!
		return deferred;
	},

	// Deferred helper
	when: function( singleValue ) {
		var

			// count of uncompleted subordinates
			remaining = arguments.length,

			// count of unprocessed arguments
			i = remaining,

			// subordinate fulfillment data
			resolveContexts = Array( i ),
			resolveValues = slice.call( arguments ),

			// the master Deferred
			master = jQuery.Deferred(),

			// subordinate callback factory
			updateFunc = function( i ) {
				return function( value ) {
					resolveContexts[ i ] = this;
					resolveValues[ i ] = arguments.length > 1 ? slice.call( arguments ) : value;
					if ( !( --remaining ) ) {
						master.resolveWith( resolveContexts, resolveValues );
					}
				};
			};

		// Single- and empty arguments are adopted like Promise.resolve
		if ( remaining <= 1 ) {
			adoptValue( singleValue, master.done( updateFunc( i ) ).resolve, master.reject,
				!remaining );

			// Use .then() to unwrap secondary thenables (cf. gh-3000)
			if ( master.state() === "pending" ||
				isFunction( resolveValues[ i ] && resolveValues[ i ].then ) ) {

				return master.then();
			}
		}

		// Multiple arguments are aggregated like Promise.all array elements
		while ( i-- ) {
			adoptValue( resolveValues[ i ], updateFunc( i ), master.reject );
		}

		return master.promise();
	}
} );


// These usually indicate a programmer mistake during development,
// warn about them ASAP rather than swallowing them by default.
var rerrorNames = /^(Eval|Internal|Range|Reference|Syntax|Type|URI)Error$/;

jQuery.Deferred.exceptionHook = function( error, stack ) {

	// Support: IE 8 - 9 only
	// Console exists when dev tools are open, which can happen at any time
	if ( window.console && window.console.warn && error && rerrorNames.test( error.name ) ) {
		window.console.warn( "jQuery.Deferred exception: " + error.message, error.stack, stack );
	}
};




jQuery.readyException = function( error ) {
	window.setTimeout( function() {
		throw error;
	} );
};




// The deferred used on DOM ready
var readyList = jQuery.Deferred();

jQuery.fn.ready = function( fn ) {

	readyList
		.then( fn )

		// Wrap jQuery.readyException in a function so that the lookup
		// happens at the time of error handling instead of callback
		// registration.
		.catch( function( error ) {
			jQuery.readyException( error );
		} );

	return this;
};

jQuery.extend( {

	// Is the DOM ready to be used? Set to true once it occurs.
	isReady: false,

	// A counter to track how many items to wait for before
	// the ready event fires. See #6781
	readyWait: 1,

	// Handle when the DOM is ready
	ready: function( wait ) {

		// Abort if there are pending holds or we're already ready
		if ( wait === true ? --jQuery.readyWait : jQuery.isReady ) {
			return;
		}

		// Remember that the DOM is ready
		jQuery.isReady = true;

		// If a normal DOM Ready event fired, decrement, and wait if need be
		if ( wait !== true && --jQuery.readyWait > 0 ) {
			return;
		}

		// If there are functions bound, to execute
		readyList.resolveWith( document, [ jQuery ] );
	}
} );

jQuery.ready.then = readyList.then;

// The ready event handler and self cleanup method
function completed() {
	document.removeEventListener( "DOMContentLoaded", completed );
	window.removeEventListener( "load", completed );
	jQuery.ready();
}

// Catch cases where $(document).ready() is called
// after the browser event has already occurred.
// Support: IE <=9 - 10 only
// Older IE sometimes signals "interactive" too soon
if ( document.readyState === "complete" ||
	( document.readyState !== "loading" && !document.documentElement.doScroll ) ) {

	// Handle it asynchronously to allow scripts the opportunity to delay ready
	window.setTimeout( jQuery.ready );

} else {

	// Use the handy event callback
	document.addEventListener( "DOMContentLoaded", completed );

	// A fallback to window.onload, that will always work
	window.addEventListener( "load", completed );
}




// Multifunctional method to get and set values of a collection
// The value/s can optionally be executed if it's a function
var access = function( elems, fn, key, value, chainable, emptyGet, raw ) {
	var i = 0,
		len = elems.length,
		bulk = key == null;

	// Sets many values
	if ( toType( key ) === "object" ) {
		chainable = true;
		for ( i in key ) {
			access( elems, fn, i, key[ i ], true, emptyGet, raw );
		}

	// Sets one value
	} else if ( value !== undefined ) {
		chainable = true;

		if ( !isFunction( value ) ) {
			raw = true;
		}

		if ( bulk ) {

			// Bulk operations run against the entire set
			if ( raw ) {
				fn.call( elems, value );
				fn = null;

			// ...except when executing function values
			} else {
				bulk = fn;
				fn = function( elem, _key, value ) {
					return bulk.call( jQuery( elem ), value );
				};
			}
		}

		if ( fn ) {
			for ( ; i < len; i++ ) {
				fn(
					elems[ i ], key, raw ?
					value :
					value.call( elems[ i ], i, fn( elems[ i ], key ) )
				);
			}
		}
	}

	if ( chainable ) {
		return elems;
	}

	// Gets
	if ( bulk ) {
		return fn.call( elems );
	}

	return len ? fn( elems[ 0 ], key ) : emptyGet;
};


// Matches dashed string for camelizing
var rmsPrefix = /^-ms-/,
	rdashAlpha = /-([a-z])/g;

// Used by camelCase as callback to replace()
function fcamelCase( _all, letter ) {
	return letter.toUpperCase();
}

// Convert dashed to camelCase; used by the css and data modules
// Support: IE <=9 - 11, Edge 12 - 15
// Microsoft forgot to hump their vendor prefix (#9572)
function camelCase( string ) {
	return string.replace( rmsPrefix, "ms-" ).replace( rdashAlpha, fcamelCase );
}
var acceptData = function( owner ) {

	// Accepts only:
	//  - Node
	//    - Node.ELEMENT_NODE
	//    - Node.DOCUMENT_NODE
	//  - Object
	//    - Any
	return owner.nodeType === 1 || owner.nodeType === 9 || !( +owner.nodeType );
};




function Data() {
	this.expando = jQuery.expando + Data.uid++;
}

Data.uid = 1;

Data.prototype = {

	cache: function( owner ) {

		// Check if the owner object already has a cache
		var value = owner[ this.expando ];

		// If not, create one
		if ( !value ) {
			value = {};

			// We can accept data for non-element nodes in modern browsers,
			// but we should not, see #8335.
			// Always return an empty object.
			if ( acceptData( owner ) ) {

				// If it is a node unlikely to be stringify-ed or looped over
				// use plain assignment
				if ( owner.nodeType ) {
					owner[ this.expando ] = value;

				// Otherwise secure it in a non-enumerable property
				// configurable must be true to allow the property to be
				// deleted when data is removed
				} else {
					Object.defineProperty( owner, this.expando, {
						value: value,
						configurable: true
					} );
				}
			}
		}

		return value;
	},
	set: function( owner, data, value ) {
		var prop,
			cache = this.cache( owner );

		// Handle: [ owner, key, value ] args
		// Always use camelCase key (gh-2257)
		if ( typeof data === "string" ) {
			cache[ camelCase( data ) ] = value;

		// Handle: [ owner, { properties } ] args
		} else {

			// Copy the properties one-by-one to the cache object
			for ( prop in data ) {
				cache[ camelCase( prop ) ] = data[ prop ];
			}
		}
		return cache;
	},
	get: function( owner, key ) {
		return key === undefined ?
			this.cache( owner ) :

			// Always use camelCase key (gh-2257)
			owner[ this.expando ] && owner[ this.expando ][ camelCase( key ) ];
	},
	access: function( owner, key, value ) {

		// In cases where either:
		//
		//   1. No key was specified
		//   2. A string key was specified, but no value provided
		//
		// Take the "read" path and allow the get method to determine
		// which value to return, respectively either:
		//
		//   1. The entire cache object
		//   2. The data stored at the key
		//
		if ( key === undefined ||
				( ( key && typeof key === "string" ) && value === undefined ) ) {

			return this.get( owner, key );
		}

		// When the key is not a string, or both a key and value
		// are specified, set or extend (existing objects) with either:
		//
		//   1. An object of properties
		//   2. A key and value
		//
		this.set( owner, key, value );

		// Since the "set" path can have two possible entry points
		// return the expected data based on which path was taken[*]
		return value !== undefined ? value : key;
	},
	remove: function( owner, key ) {
		var i,
			cache = owner[ this.expando ];

		if ( cache === undefined ) {
			return;
		}

		if ( key !== undefined ) {

			// Support array or space separated string of keys
			if ( Array.isArray( key ) ) {

				// If key is an array of keys...
				// We always set camelCase keys, so remove that.
				key = key.map( camelCase );
			} else {
				key = camelCase( key );

				// If a key with the spaces exists, use it.
				// Otherwise, create an array by matching non-whitespace
				key = key in cache ?
					[ key ] :
					( key.match( rnothtmlwhite ) || [] );
			}

			i = key.length;

			while ( i-- ) {
				delete cache[ key[ i ] ];
			}
		}

		// Remove the expando if there's no more data
		if ( key === undefined || jQuery.isEmptyObject( cache ) ) {

			// Support: Chrome <=35 - 45
			// Webkit & Blink performance suffers when deleting properties
			// from DOM nodes, so set to undefined instead
			// https://bugs.chromium.org/p/chromium/issues/detail?id=378607 (bug restricted)
			if ( owner.nodeType ) {
				owner[ this.expando ] = undefined;
			} else {
				delete owner[ this.expando ];
			}
		}
	},
	hasData: function( owner ) {
		var cache = owner[ this.expando ];
		return cache !== undefined && !jQuery.isEmptyObject( cache );
	}
};
var dataPriv = new Data();

var dataUser = new Data();



//	Implementation Summary
//
//	1. Enforce API surface and semantic compatibility with 1.9.x branch
//	2. Improve the module's maintainability by reducing the storage
//		paths to a single mechanism.
//	3. Use the same single mechanism to support "private" and "user" data.
//	4. _Never_ expose "private" data to user code (TODO: Drop _data, _removeData)
//	5. Avoid exposing implementation details on user objects (eg. expando properties)
//	6. Provide a clear path for implementation upgrade to WeakMap in 2014

var rbrace = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,
	rmultiDash = /[A-Z]/g;

function getData( data ) {
	if ( data === "true" ) {
		return true;
	}

	if ( data === "false" ) {
		return false;
	}

	if ( data === "null" ) {
		return null;
	}

	// Only convert to a number if it doesn't change the string
	if ( data === +data + "" ) {
		return +data;
	}

	if ( rbrace.test( data ) ) {
		return JSON.parse( data );
	}

	return data;
}

function dataAttr( elem, key, data ) {
	var name;

	// If nothing was found internally, try to fetch any
	// data from the HTML5 data-* attribute
	if ( data === undefined && elem.nodeType === 1 ) {
		name = "data-" + key.replace( rmultiDash, "-$&" ).toLowerCase();
		data = elem.getAttribute( name );

		if ( typeof data === "string" ) {
			try {
				data = getData( data );
			} catch ( e ) {}

			// Make sure we set the data so it isn't changed later
			dataUser.set( elem, key, data );
		} else {
			data = undefined;
		}
	}
	return data;
}

jQuery.extend( {
	hasData: function( elem ) {
		return dataUser.hasData( elem ) || dataPriv.hasData( elem );
	},

	data: function( elem, name, data ) {
		return dataUser.access( elem, name, data );
	},

	removeData: function( elem, name ) {
		dataUser.remove( elem, name );
	},

	// TODO: Now that all calls to _data and _removeData have been replaced
	// with direct calls to dataPriv methods, these can be deprecated.
	_data: function( elem, name, data ) {
		return dataPriv.access( elem, name, data );
	},

	_removeData: function( elem, name ) {
		dataPriv.remove( elem, name );
	}
} );

jQuery.fn.extend( {
	data: function( key, value ) {
		var i, name, data,
			elem = this[ 0 ],
			attrs = elem && elem.attributes;

		// Gets all values
		if ( key === undefined ) {
			if ( this.length ) {
				data = dataUser.get( elem );

				if ( elem.nodeType === 1 && !dataPriv.get( elem, "hasDataAttrs" ) ) {
					i = attrs.length;
					while ( i-- ) {

						// Support: IE 11 only
						// The attrs elements can be null (#14894)
						if ( attrs[ i ] ) {
							name = attrs[ i ].name;
							if ( name.indexOf( "data-" ) === 0 ) {
								name = camelCase( name.slice( 5 ) );
								dataAttr( elem, name, data[ name ] );
							}
						}
					}
					dataPriv.set( elem, "hasDataAttrs", true );
				}
			}

			return data;
		}

		// Sets multiple values
		if ( typeof key === "object" ) {
			return this.each( function() {
				dataUser.set( this, key );
			} );
		}

		return access( this, function( value ) {
			var data;

			// The calling jQuery object (element matches) is not empty
			// (and therefore has an element appears at this[ 0 ]) and the
			// `value` parameter was not undefined. An empty jQuery object
			// will result in `undefined` for elem = this[ 0 ] which will
			// throw an exception if an attempt to read a data cache is made.
			if ( elem && value === undefined ) {

				// Attempt to get data from the cache
				// The key will always be camelCased in Data
				data = dataUser.get( elem, key );
				if ( data !== undefined ) {
					return data;
				}

				// Attempt to "discover" the data in
				// HTML5 custom data-* attrs
				data = dataAttr( elem, key );
				if ( data !== undefined ) {
					return data;
				}

				// We tried really hard, but the data doesn't exist.
				return;
			}

			// Set the data...
			this.each( function() {

				// We always store the camelCased key
				dataUser.set( this, key, value );
			} );
		}, null, value, arguments.length > 1, null, true );
	},

	removeData: function( key ) {
		return this.each( function() {
			dataUser.remove( this, key );
		} );
	}
} );


jQuery.extend( {
	queue: function( elem, type, data ) {
		var queue;

		if ( elem ) {
			type = ( type || "fx" ) + "queue";
			queue = dataPriv.get( elem, type );

			// Speed up dequeue by getting out quickly if this is just a lookup
			if ( data ) {
				if ( !queue || Array.isArray( data ) ) {
					queue = dataPriv.access( elem, type, jQuery.makeArray( data ) );
				} else {
					queue.push( data );
				}
			}
			return queue || [];
		}
	},

	dequeue: function( elem, type ) {
		type = type || "fx";

		var queue = jQuery.queue( elem, type ),
			startLength = queue.length,
			fn = queue.shift(),
			hooks = jQuery._queueHooks( elem, type ),
			next = function() {
				jQuery.dequeue( elem, type );
			};

		// If the fx queue is dequeued, always remove the progress sentinel
		if ( fn === "inprogress" ) {
			fn = queue.shift();
			startLength--;
		}

		if ( fn ) {

			// Add a progress sentinel to prevent the fx queue from being
			// automatically dequeued
			if ( type === "fx" ) {
				queue.unshift( "inprogress" );
			}

			// Clear up the last queue stop function
			delete hooks.stop;
			fn.call( elem, next, hooks );
		}

		if ( !startLength && hooks ) {
			hooks.empty.fire();
		}
	},

	// Not public - generate a queueHooks object, or return the current one
	_queueHooks: function( elem, type ) {
		var key = type + "queueHooks";
		return dataPriv.get( elem, key ) || dataPriv.access( elem, key, {
			empty: jQuery.Callbacks( "once memory" ).add( function() {
				dataPriv.remove( elem, [ type + "queue", key ] );
			} )
		} );
	}
} );

jQuery.fn.extend( {
	queue: function( type, data ) {
		var setter = 2;

		if ( typeof type !== "string" ) {
			data = type;
			type = "fx";
			setter--;
		}

		if ( arguments.length < setter ) {
			return jQuery.queue( this[ 0 ], type );
		}

		return data === undefined ?
			this :
			this.each( function() {
				var queue = jQuery.queue( this, type, data );

				// Ensure a hooks for this queue
				jQuery._queueHooks( this, type );

				if ( type === "fx" && queue[ 0 ] !== "inprogress" ) {
					jQuery.dequeue( this, type );
				}
			} );
	},
	dequeue: function( type ) {
		return this.each( function() {
			jQuery.dequeue( this, type );
		} );
	},
	clearQueue: function( type ) {
		return this.queue( type || "fx", [] );
	},

	// Get a promise resolved when queues of a certain type
	// are emptied (fx is the type by default)
	promise: function( type, obj ) {
		var tmp,
			count = 1,
			defer = jQuery.Deferred(),
			elements = this,
			i = this.length,
			resolve = function() {
				if ( !( --count ) ) {
					defer.resolveWith( elements, [ elements ] );
				}
			};

		if ( typeof type !== "string" ) {
			obj = type;
			type = undefined;
		}
		type = type || "fx";

		while ( i-- ) {
			tmp = dataPriv.get( elements[ i ], type + "queueHooks" );
			if ( tmp && tmp.empty ) {
				count++;
				tmp.empty.add( resolve );
			}
		}
		resolve();
		return defer.promise( obj );
	}
} );
var pnum = ( /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/ ).source;

var rcssNum = new RegExp( "^(?:([+-])=|)(" + pnum + ")([a-z%]*)$", "i" );


var cssExpand = [ "Top", "Right", "Bottom", "Left" ];

var documentElement = document.documentElement;



	var isAttached = function( elem ) {
			return jQuery.contains( elem.ownerDocument, elem );
		},
		composed = { composed: true };

	// Support: IE 9 - 11+, Edge 12 - 18+, iOS 10.0 - 10.2 only
	// Check attachment across shadow DOM boundaries when possible (gh-3504)
	// Support: iOS 10.0-10.2 only
	// Early iOS 10 versions support `attachShadow` but not `getRootNode`,
	// leading to errors. We need to check for `getRootNode`.
	if ( documentElement.getRootNode ) {
		isAttached = function( elem ) {
			return jQuery.contains( elem.ownerDocument, elem ) ||
				elem.getRootNode( composed ) === elem.ownerDocument;
		};
	}
var isHiddenWithinTree = function( elem, el ) {

		// isHiddenWithinTree might be called from jQuery#filter function;
		// in that case, element will be second argument
		elem = el || elem;

		// Inline style trumps all
		return elem.style.display === "none" ||
			elem.style.display === "" &&

			// Otherwise, check computed style
			// Support: Firefox <=43 - 45
			// Disconnected elements can have computed display: none, so first confirm that elem is
			// in the document.
			isAttached( elem ) &&

			jQuery.css( elem, "display" ) === "none";
	};



function adjustCSS( elem, prop, valueParts, tween ) {
	var adjusted, scale,
		maxIterations = 20,
		currentValue = tween ?
			function() {
				return tween.cur();
			} :
			function() {
				return jQuery.css( elem, prop, "" );
			},
		initial = currentValue(),
		unit = valueParts && valueParts[ 3 ] || ( jQuery.cssNumber[ prop ] ? "" : "px" ),

		// Starting value computation is required for potential unit mismatches
		initialInUnit = elem.nodeType &&
			( jQuery.cssNumber[ prop ] || unit !== "px" && +initial ) &&
			rcssNum.exec( jQuery.css( elem, prop ) );

	if ( initialInUnit && initialInUnit[ 3 ] !== unit ) {

		// Support: Firefox <=54
		// Halve the iteration target value to prevent interference from CSS upper bounds (gh-2144)
		initial = initial / 2;

		// Trust units reported by jQuery.css
		unit = unit || initialInUnit[ 3 ];

		// Iteratively approximate from a nonzero starting point
		initialInUnit = +initial || 1;

		while ( maxIterations-- ) {

			// Evaluate and update our best guess (doubling guesses that zero out).
			// Finish if the scale equals or crosses 1 (making the old*new product non-positive).
			jQuery.style( elem, prop, initialInUnit + unit );
			if ( ( 1 - scale ) * ( 1 - ( scale = currentValue() / initial || 0.5 ) ) <= 0 ) {
				maxIterations = 0;
			}
			initialInUnit = initialInUnit / scale;

		}

		initialInUnit = initialInUnit * 2;
		jQuery.style( elem, prop, initialInUnit + unit );

		// Make sure we update the tween properties later on
		valueParts = valueParts || [];
	}

	if ( valueParts ) {
		initialInUnit = +initialInUnit || +initial || 0;

		// Apply relative offset (+=/-=) if specified
		adjusted = valueParts[ 1 ] ?
			initialInUnit + ( valueParts[ 1 ] + 1 ) * valueParts[ 2 ] :
			+valueParts[ 2 ];
		if ( tween ) {
			tween.unit = unit;
			tween.start = initialInUnit;
			tween.end = adjusted;
		}
	}
	return adjusted;
}


var defaultDisplayMap = {};

function getDefaultDisplay( elem ) {
	var temp,
		doc = elem.ownerDocument,
		nodeName = elem.nodeName,
		display = defaultDisplayMap[ nodeName ];

	if ( display ) {
		return display;
	}

	temp = doc.body.appendChild( doc.createElement( nodeName ) );
	display = jQuery.css( temp, "display" );

	temp.parentNode.removeChild( temp );

	if ( display === "none" ) {
		display = "block";
	}
	defaultDisplayMap[ nodeName ] = display;

	return display;
}

function showHide( elements, show ) {
	var display, elem,
		values = [],
		index = 0,
		length = elements.length;

	// Determine new display value for elements that need to change
	for ( ; index < length; index++ ) {
		elem = elements[ index ];
		if ( !elem.style ) {
			continue;
		}

		display = elem.style.display;
		if ( show ) {

			// Since we force visibility upon cascade-hidden elements, an immediate (and slow)
			// check is required in this first loop unless we have a nonempty display value (either
			// inline or about-to-be-restored)
			if ( display === "none" ) {
				values[ index ] = dataPriv.get( elem, "display" ) || null;
				if ( !values[ index ] ) {
					elem.style.display = "";
				}
			}
			if ( elem.style.display === "" && isHiddenWithinTree( elem ) ) {
				values[ index ] = getDefaultDisplay( elem );
			}
		} else {
			if ( display !== "none" ) {
				values[ index ] = "none";

				// Remember what we're overwriting
				dataPriv.set( elem, "display", display );
			}
		}
	}

	// Set the display of the elements in a second loop to avoid constant reflow
	for ( index = 0; index < length; index++ ) {
		if ( values[ index ] != null ) {
			elements[ index ].style.display = values[ index ];
		}
	}

	return elements;
}

jQuery.fn.extend( {
	show: function() {
		return showHide( this, true );
	},
	hide: function() {
		return showHide( this );
	},
	toggle: function( state ) {
		if ( typeof state === "boolean" ) {
			return state ? this.show() : this.hide();
		}

		return this.each( function() {
			if ( isHiddenWithinTree( this ) ) {
				jQuery( this ).show();
			} else {
				jQuery( this ).hide();
			}
		} );
	}
} );
var rcheckableType = ( /^(?:checkbox|radio)$/i );

var rtagName = ( /<([a-z][^\/\0>\x20\t\r\n\f]*)/i );

var rscriptType = ( /^$|^module$|\/(?:java|ecma)script/i );



( function() {
	var fragment = document.createDocumentFragment(),
		div = fragment.appendChild( document.createElement( "div" ) ),
		input = document.createElement( "input" );

	// Support: Android 4.0 - 4.3 only
	// Check state lost if the name is set (#11217)
	// Support: Windows Web Apps (WWA)
	// `name` and `type` must use .setAttribute for WWA (#14901)
	input.setAttribute( "type", "radio" );
	input.setAttribute( "checked", "checked" );
	input.setAttribute( "name", "t" );

	div.appendChild( input );

	// Support: Android <=4.1 only
	// Older WebKit doesn't clone checked state correctly in fragments
	support.checkClone = div.cloneNode( true ).cloneNode( true ).lastChild.checked;

	// Support: IE <=11 only
	// Make sure textarea (and checkbox) defaultValue is properly cloned
	div.innerHTML = "<textarea>x</textarea>";
	support.noCloneChecked = !!div.cloneNode( true ).lastChild.defaultValue;

	// Support: IE <=9 only
	// IE <=9 replaces <option> tags with their contents when inserted outside of
	// the select element.
	div.innerHTML = "<option></option>";
	support.option = !!div.lastChild;
} )();


// We have to close these tags to support XHTML (#13200)
var wrapMap = {

	// XHTML parsers do not magically insert elements in the
	// same way that tag soup parsers do. So we cannot shorten
	// this by omitting <tbody> or other required elements.
	thead: [ 1, "<table>", "</table>" ],
	col: [ 2, "<table><colgroup>", "</colgroup></table>" ],
	tr: [ 2, "<table><tbody>", "</tbody></table>" ],
	td: [ 3, "<table><tbody><tr>", "</tr></tbody></table>" ],

	_default: [ 0, "", "" ]
};

wrapMap.tbody = wrapMap.tfoot = wrapMap.colgroup = wrapMap.caption = wrapMap.thead;
wrapMap.th = wrapMap.td;

// Support: IE <=9 only
if ( !support.option ) {
	wrapMap.optgroup = wrapMap.option = [ 1, "<select multiple='multiple'>", "</select>" ];
}


function getAll( context, tag ) {

	// Support: IE <=9 - 11 only
	// Use typeof to avoid zero-argument method invocation on host objects (#15151)
	var ret;

	if ( typeof context.getElementsByTagName !== "undefined" ) {
		ret = context.getElementsByTagName( tag || "*" );

	} else if ( typeof context.querySelectorAll !== "undefined" ) {
		ret = context.querySelectorAll( tag || "*" );

	} else {
		ret = [];
	}

	if ( tag === undefined || tag && nodeName( context, tag ) ) {
		return jQuery.merge( [ context ], ret );
	}

	return ret;
}


// Mark scripts as having already been evaluated
function setGlobalEval( elems, refElements ) {
	var i = 0,
		l = elems.length;

	for ( ; i < l; i++ ) {
		dataPriv.set(
			elems[ i ],
			"globalEval",
			!refElements || dataPriv.get( refElements[ i ], "globalEval" )
		);
	}
}


var rhtml = /<|&#?\w+;/;

function buildFragment( elems, context, scripts, selection, ignored ) {
	var elem, tmp, tag, wrap, attached, j,
		fragment = context.createDocumentFragment(),
		nodes = [],
		i = 0,
		l = elems.length;

	for ( ; i < l; i++ ) {
		elem = elems[ i ];

		if ( elem || elem === 0 ) {

			// Add nodes directly
			if ( toType( elem ) === "object" ) {

				// Support: Android <=4.0 only, PhantomJS 1 only
				// push.apply(_, arraylike) throws on ancient WebKit
				jQuery.merge( nodes, elem.nodeType ? [ elem ] : elem );

			// Convert non-html into a text node
			} else if ( !rhtml.test( elem ) ) {
				nodes.push( context.createTextNode( elem ) );

			// Convert html into DOM nodes
			} else {
				tmp = tmp || fragment.appendChild( context.createElement( "div" ) );

				// Deserialize a standard representation
				tag = ( rtagName.exec( elem ) || [ "", "" ] )[ 1 ].toLowerCase();
				wrap = wrapMap[ tag ] || wrapMap._default;
				tmp.innerHTML = wrap[ 1 ] + jQuery.htmlPrefilter( elem ) + wrap[ 2 ];

				// Descend through wrappers to the right content
				j = wrap[ 0 ];
				while ( j-- ) {
					tmp = tmp.lastChild;
				}

				// Support: Android <=4.0 only, PhantomJS 1 only
				// push.apply(_, arraylike) throws on ancient WebKit
				jQuery.merge( nodes, tmp.childNodes );

				// Remember the top-level container
				tmp = fragment.firstChild;

				// Ensure the created nodes are orphaned (#12392)
				tmp.textContent = "";
			}
		}
	}

	// Remove wrapper from fragment
	fragment.textContent = "";

	i = 0;
	while ( ( elem = nodes[ i++ ] ) ) {

		// Skip elements already in the context collection (trac-4087)
		if ( selection && jQuery.inArray( elem, selection ) > -1 ) {
			if ( ignored ) {
				ignored.push( elem );
			}
			continue;
		}

		attached = isAttached( elem );

		// Append to fragment
		tmp = getAll( fragment.appendChild( elem ), "script" );

		// Preserve script evaluation history
		if ( attached ) {
			setGlobalEval( tmp );
		}

		// Capture executables
		if ( scripts ) {
			j = 0;
			while ( ( elem = tmp[ j++ ] ) ) {
				if ( rscriptType.test( elem.type || "" ) ) {
					scripts.push( elem );
				}
			}
		}
	}

	return fragment;
}


var
	rkeyEvent = /^key/,
	rmouseEvent = /^(?:mouse|pointer|contextmenu|drag|drop)|click/,
	rtypenamespace = /^([^.]*)(?:\.(.+)|)/;

function returnTrue() {
	return true;
}

function returnFalse() {
	return false;
}

// Support: IE <=9 - 11+
// focus() and blur() are asynchronous, except when they are no-op.
// So expect focus to be synchronous when the element is already active,
// and blur to be synchronous when the element is not already active.
// (focus and blur are always synchronous in other supported browsers,
// this just defines when we can count on it).
function expectSync( elem, type ) {
	return ( elem === safeActiveElement() ) === ( type === "focus" );
}

// Support: IE <=9 only
// Accessing document.activeElement can throw unexpectedly
// https://bugs.jquery.com/ticket/13393
function safeActiveElement() {
	try {
		return document.activeElement;
	} catch ( err ) { }
}

function on( elem, types, selector, data, fn, one ) {
	var origFn, type;

	// Types can be a map of types/handlers
	if ( typeof types === "object" ) {

		// ( types-Object, selector, data )
		if ( typeof selector !== "string" ) {

			// ( types-Object, data )
			data = data || selector;
			selector = undefined;
		}
		for ( type in types ) {
			on( elem, type, selector, data, types[ type ], one );
		}
		return elem;
	}

	if ( data == null && fn == null ) {

		// ( types, fn )
		fn = selector;
		data = selector = undefined;
	} else if ( fn == null ) {
		if ( typeof selector === "string" ) {

			// ( types, selector, fn )
			fn = data;
			data = undefined;
		} else {

			// ( types, data, fn )
			fn = data;
			data = selector;
			selector = undefined;
		}
	}
	if ( fn === false ) {
		fn = returnFalse;
	} else if ( !fn ) {
		return elem;
	}

	if ( one === 1 ) {
		origFn = fn;
		fn = function( event ) {

			// Can use an empty set, since event contains the info
			jQuery().off( event );
			return origFn.apply( this, arguments );
		};

		// Use same guid so caller can remove using origFn
		fn.guid = origFn.guid || ( origFn.guid = jQuery.guid++ );
	}
	return elem.each( function() {
		jQuery.event.add( this, types, fn, data, selector );
	} );
}

/*
 * Helper functions for managing events -- not part of the public interface.
 * Props to Dean Edwards' addEvent library for many of the ideas.
 */
jQuery.event = {

	global: {},

	add: function( elem, types, handler, data, selector ) {

		var handleObjIn, eventHandle, tmp,
			events, t, handleObj,
			special, handlers, type, namespaces, origType,
			elemData = dataPriv.get( elem );

		// Only attach events to objects that accept data
		if ( !acceptData( elem ) ) {
			return;
		}

		// Caller can pass in an object of custom data in lieu of the handler
		if ( handler.handler ) {
			handleObjIn = handler;
			handler = handleObjIn.handler;
			selector = handleObjIn.selector;
		}

		// Ensure that invalid selectors throw exceptions at attach time
		// Evaluate against documentElement in case elem is a non-element node (e.g., document)
		if ( selector ) {
			jQuery.find.matchesSelector( documentElement, selector );
		}

		// Make sure that the handler has a unique ID, used to find/remove it later
		if ( !handler.guid ) {
			handler.guid = jQuery.guid++;
		}

		// Init the element's event structure and main handler, if this is the first
		if ( !( events = elemData.events ) ) {
			events = elemData.events = Object.create( null );
		}
		if ( !( eventHandle = elemData.handle ) ) {
			eventHandle = elemData.handle = function( e ) {

				// Discard the second event of a jQuery.event.trigger() and
				// when an event is called after a page has unloaded
				return typeof jQuery !== "undefined" && jQuery.event.triggered !== e.type ?
					jQuery.event.dispatch.apply( elem, arguments ) : undefined;
			};
		}

		// Handle multiple events separated by a space
		types = ( types || "" ).match( rnothtmlwhite ) || [ "" ];
		t = types.length;
		while ( t-- ) {
			tmp = rtypenamespace.exec( types[ t ] ) || [];
			type = origType = tmp[ 1 ];
			namespaces = ( tmp[ 2 ] || "" ).split( "." ).sort();

			// There *must* be a type, no attaching namespace-only handlers
			if ( !type ) {
				continue;
			}

			// If event changes its type, use the special event handlers for the changed type
			special = jQuery.event.special[ type ] || {};

			// If selector defined, determine special event api type, otherwise given type
			type = ( selector ? special.delegateType : special.bindType ) || type;

			// Update special based on newly reset type
			special = jQuery.event.special[ type ] || {};

			// handleObj is passed to all event handlers
			handleObj = jQuery.extend( {
				type: type,
				origType: origType,
				data: data,
				handler: handler,
				guid: handler.guid,
				selector: selector,
				needsContext: selector && jQuery.expr.match.needsContext.test( selector ),
				namespace: namespaces.join( "." )
			}, handleObjIn );

			// Init the event handler queue if we're the first
			if ( !( handlers = events[ type ] ) ) {
				handlers = events[ type ] = [];
				handlers.delegateCount = 0;

				// Only use addEventListener if the special events handler returns false
				if ( !special.setup ||
					special.setup.call( elem, data, namespaces, eventHandle ) === false ) {

					if ( elem.addEventListener ) {
						elem.addEventListener( type, eventHandle );
					}
				}
			}

			if ( special.add ) {
				special.add.call( elem, handleObj );

				if ( !handleObj.handler.guid ) {
					handleObj.handler.guid = handler.guid;
				}
			}

			// Add to the element's handler list, delegates in front
			if ( selector ) {
				handlers.splice( handlers.delegateCount++, 0, handleObj );
			} else {
				handlers.push( handleObj );
			}

			// Keep track of which events have ever been used, for event optimization
			jQuery.event.global[ type ] = true;
		}

	},

	// Detach an event or set of events from an element
	remove: function( elem, types, handler, selector, mappedTypes ) {

		var j, origCount, tmp,
			events, t, handleObj,
			special, handlers, type, namespaces, origType,
			elemData = dataPriv.hasData( elem ) && dataPriv.get( elem );

		if ( !elemData || !( events = elemData.events ) ) {
			return;
		}

		// Once for each type.namespace in types; type may be omitted
		types = ( types || "" ).match( rnothtmlwhite ) || [ "" ];
		t = types.length;
		while ( t-- ) {
			tmp = rtypenamespace.exec( types[ t ] ) || [];
			type = origType = tmp[ 1 ];
			namespaces = ( tmp[ 2 ] || "" ).split( "." ).sort();

			// Unbind all events (on this namespace, if provided) for the element
			if ( !type ) {
				for ( type in events ) {
					jQuery.event.remove( elem, type + types[ t ], handler, selector, true );
				}
				continue;
			}

			special = jQuery.event.special[ type ] || {};
			type = ( selector ? special.delegateType : special.bindType ) || type;
			handlers = events[ type ] || [];
			tmp = tmp[ 2 ] &&
				new RegExp( "(^|\\.)" + namespaces.join( "\\.(?:.*\\.|)" ) + "(\\.|$)" );

			// Remove matching events
			origCount = j = handlers.length;
			while ( j-- ) {
				handleObj = handlers[ j ];

				if ( ( mappedTypes || origType === handleObj.origType ) &&
					( !handler || handler.guid === handleObj.guid ) &&
					( !tmp || tmp.test( handleObj.namespace ) ) &&
					( !selector || selector === handleObj.selector ||
						selector === "**" && handleObj.selector ) ) {
					handlers.splice( j, 1 );

					if ( handleObj.selector ) {
						handlers.delegateCount--;
					}
					if ( special.remove ) {
						special.remove.call( elem, handleObj );
					}
				}
			}

			// Remove generic event handler if we removed something and no more handlers exist
			// (avoids potential for endless recursion during removal of special event handlers)
			if ( origCount && !handlers.length ) {
				if ( !special.teardown ||
					special.teardown.call( elem, namespaces, elemData.handle ) === false ) {

					jQuery.removeEvent( elem, type, elemData.handle );
				}

				delete events[ type ];
			}
		}

		// Remove data and the expando if it's no longer used
		if ( jQuery.isEmptyObject( events ) ) {
			dataPriv.remove( elem, "handle events" );
		}
	},

	dispatch: function( nativeEvent ) {

		var i, j, ret, matched, handleObj, handlerQueue,
			args = new Array( arguments.length ),

			// Make a writable jQuery.Event from the native event object
			event = jQuery.event.fix( nativeEvent ),

			handlers = (
					dataPriv.get( this, "events" ) || Object.create( null )
				)[ event.type ] || [],
			special = jQuery.event.special[ event.type ] || {};

		// Use the fix-ed jQuery.Event rather than the (read-only) native event
		args[ 0 ] = event;

		for ( i = 1; i < arguments.length; i++ ) {
			args[ i ] = arguments[ i ];
		}

		event.delegateTarget = this;

		// Call the preDispatch hook for the mapped type, and let it bail if desired
		if ( special.preDispatch && special.preDispatch.call( this, event ) === false ) {
			return;
		}

		// Determine handlers
		handlerQueue = jQuery.event.handlers.call( this, event, handlers );

		// Run delegates first; they may want to stop propagation beneath us
		i = 0;
		while ( ( matched = handlerQueue[ i++ ] ) && !event.isPropagationStopped() ) {
			event.currentTarget = matched.elem;

			j = 0;
			while ( ( handleObj = matched.handlers[ j++ ] ) &&
				!event.isImmediatePropagationStopped() ) {

				// If the event is namespaced, then each handler is only invoked if it is
				// specially universal or its namespaces are a superset of the event's.
				if ( !event.rnamespace || handleObj.namespace === false ||
					event.rnamespace.test( handleObj.namespace ) ) {

					event.handleObj = handleObj;
					event.data = handleObj.data;

					ret = ( ( jQuery.event.special[ handleObj.origType ] || {} ).handle ||
						handleObj.handler ).apply( matched.elem, args );

					if ( ret !== undefined ) {
						if ( ( event.result = ret ) === false ) {
							event.preventDefault();
							event.stopPropagation();
						}
					}
				}
			}
		}

		// Call the postDispatch hook for the mapped type
		if ( special.postDispatch ) {
			special.postDispatch.call( this, event );
		}

		return event.result;
	},

	handlers: function( event, handlers ) {
		var i, handleObj, sel, matchedHandlers, matchedSelectors,
			handlerQueue = [],
			delegateCount = handlers.delegateCount,
			cur = event.target;

		// Find delegate handlers
		if ( delegateCount &&

			// Support: IE <=9
			// Black-hole SVG <use> instance trees (trac-13180)
			cur.nodeType &&

			// Support: Firefox <=42
			// Suppress spec-violating clicks indicating a non-primary pointer button (trac-3861)
			// https://www.w3.org/TR/DOM-Level-3-Events/#event-type-click
			// Support: IE 11 only
			// ...but not arrow key "clicks" of radio inputs, which can have `button` -1 (gh-2343)
			!( event.type === "click" && event.button >= 1 ) ) {

			for ( ; cur !== this; cur = cur.parentNode || this ) {

				// Don't check non-elements (#13208)
				// Don't process clicks on disabled elements (#6911, #8165, #11382, #11764)
				if ( cur.nodeType === 1 && !( event.type === "click" && cur.disabled === true ) ) {
					matchedHandlers = [];
					matchedSelectors = {};
					for ( i = 0; i < delegateCount; i++ ) {
						handleObj = handlers[ i ];

						// Don't conflict with Object.prototype properties (#13203)
						sel = handleObj.selector + " ";

						if ( matchedSelectors[ sel ] === undefined ) {
							matchedSelectors[ sel ] = handleObj.needsContext ?
								jQuery( sel, this ).index( cur ) > -1 :
								jQuery.find( sel, this, null, [ cur ] ).length;
						}
						if ( matchedSelectors[ sel ] ) {
							matchedHandlers.push( handleObj );
						}
					}
					if ( matchedHandlers.length ) {
						handlerQueue.push( { elem: cur, handlers: matchedHandlers } );
					}
				}
			}
		}

		// Add the remaining (directly-bound) handlers
		cur = this;
		if ( delegateCount < handlers.length ) {
			handlerQueue.push( { elem: cur, handlers: handlers.slice( delegateCount ) } );
		}

		return handlerQueue;
	},

	addProp: function( name, hook ) {
		Object.defineProperty( jQuery.Event.prototype, name, {
			enumerable: true,
			configurable: true,

			get: isFunction( hook ) ?
				function() {
					if ( this.originalEvent ) {
							return hook( this.originalEvent );
					}
				} :
				function() {
					if ( this.originalEvent ) {
							return this.originalEvent[ name ];
					}
				},

			set: function( value ) {
				Object.defineProperty( this, name, {
					enumerable: true,
					configurable: true,
					writable: true,
					value: value
				} );
			}
		} );
	},

	fix: function( originalEvent ) {
		return originalEvent[ jQuery.expando ] ?
			originalEvent :
			new jQuery.Event( originalEvent );
	},

	special: {
		load: {

			// Prevent triggered image.load events from bubbling to window.load
			noBubble: true
		},
		click: {

			// Utilize native event to ensure correct state for checkable inputs
			setup: function( data ) {

				// For mutual compressibility with _default, replace `this` access with a local var.
				// `|| data` is dead code meant only to preserve the variable through minification.
				var el = this || data;

				// Claim the first handler
				if ( rcheckableType.test( el.type ) &&
					el.click && nodeName( el, "input" ) ) {

					// dataPriv.set( el, "click", ... )
					leverageNative( el, "click", returnTrue );
				}

				// Return false to allow normal processing in the caller
				return false;
			},
			trigger: function( data ) {

				// For mutual compressibility with _default, replace `this` access with a local var.
				// `|| data` is dead code meant only to preserve the variable through minification.
				var el = this || data;

				// Force setup before triggering a click
				if ( rcheckableType.test( el.type ) &&
					el.click && nodeName( el, "input" ) ) {

					leverageNative( el, "click" );
				}

				// Return non-false to allow normal event-path propagation
				return true;
			},

			// For cross-browser consistency, suppress native .click() on links
			// Also prevent it if we're currently inside a leveraged native-event stack
			_default: function( event ) {
				var target = event.target;
				return rcheckableType.test( target.type ) &&
					target.click && nodeName( target, "input" ) &&
					dataPriv.get( target, "click" ) ||
					nodeName( target, "a" );
			}
		},

		beforeunload: {
			postDispatch: function( event ) {

				// Support: Firefox 20+
				// Firefox doesn't alert if the returnValue field is not set.
				if ( event.result !== undefined && event.originalEvent ) {
					event.originalEvent.returnValue = event.result;
				}
			}
		}
	}
};

// Ensure the presence of an event listener that handles manually-triggered
// synthetic events by interrupting progress until reinvoked in response to
// *native* events that it fires directly, ensuring that state changes have
// already occurred before other listeners are invoked.
function leverageNative( el, type, expectSync ) {

	// Missing expectSync indicates a trigger call, which must force setup through jQuery.event.add
	if ( !expectSync ) {
		if ( dataPriv.get( el, type ) === undefined ) {
			jQuery.event.add( el, type, returnTrue );
		}
		return;
	}

	// Register the controller as a special universal handler for all event namespaces
	dataPriv.set( el, type, false );
	jQuery.event.add( el, type, {
		namespace: false,
		handler: function( event ) {
			var notAsync, result,
				saved = dataPriv.get( this, type );

			if ( ( event.isTrigger & 1 ) && this[ type ] ) {

				// Interrupt processing of the outer synthetic .trigger()ed event
				// Saved data should be false in such cases, but might be a leftover capture object
				// from an async native handler (gh-4350)
				if ( !saved.length ) {

					// Store arguments for use when handling the inner native event
					// There will always be at least one argument (an event object), so this array
					// will not be confused with a leftover capture object.
					saved = slice.call( arguments );
					dataPriv.set( this, type, saved );

					// Trigger the native event and capture its result
					// Support: IE <=9 - 11+
					// focus() and blur() are asynchronous
					notAsync = expectSync( this, type );
					this[ type ]();
					result = dataPriv.get( this, type );
					if ( saved !== result || notAsync ) {
						dataPriv.set( this, type, false );
					} else {
						result = {};
					}
					if ( saved !== result ) {

						// Cancel the outer synthetic event
						event.stopImmediatePropagation();
						event.preventDefault();
						return result.value;
					}

				// If this is an inner synthetic event for an event with a bubbling surrogate
				// (focus or blur), assume that the surrogate already propagated from triggering the
				// native event and prevent that from happening again here.
				// This technically gets the ordering wrong w.r.t. to `.trigger()` (in which the
				// bubbling surrogate propagates *after* the non-bubbling base), but that seems
				// less bad than duplication.
				} else if ( ( jQuery.event.special[ type ] || {} ).delegateType ) {
					event.stopPropagation();
				}

			// If this is a native event triggered above, everything is now in order
			// Fire an inner synthetic event with the original arguments
			} else if ( saved.length ) {

				// ...and capture the result
				dataPriv.set( this, type, {
					value: jQuery.event.trigger(

						// Support: IE <=9 - 11+
						// Extend with the prototype to reset the above stopImmediatePropagation()
						jQuery.extend( saved[ 0 ], jQuery.Event.prototype ),
						saved.slice( 1 ),
						this
					)
				} );

				// Abort handling of the native event
				event.stopImmediatePropagation();
			}
		}
	} );
}

jQuery.removeEvent = function( elem, type, handle ) {

	// This "if" is needed for plain objects
	if ( elem.removeEventListener ) {
		elem.removeEventListener( type, handle );
	}
};

jQuery.Event = function( src, props ) {

	// Allow instantiation without the 'new' keyword
	if ( !( this instanceof jQuery.Event ) ) {
		return new jQuery.Event( src, props );
	}

	// Event object
	if ( src && src.type ) {
		this.originalEvent = src;
		this.type = src.type;

		// Events bubbling up the document may have been marked as prevented
		// by a handler lower down the tree; reflect the correct value.
		this.isDefaultPrevented = src.defaultPrevented ||
				src.defaultPrevented === undefined &&

				// Support: Android <=2.3 only
				src.returnValue === false ?
			returnTrue :
			returnFalse;

		// Create target properties
		// Support: Safari <=6 - 7 only
		// Target should not be a text node (#504, #13143)
		this.target = ( src.target && src.target.nodeType === 3 ) ?
			src.target.parentNode :
			src.target;

		this.currentTarget = src.currentTarget;
		this.relatedTarget = src.relatedTarget;

	// Event type
	} else {
		this.type = src;
	}

	// Put explicitly provided properties onto the event object
	if ( props ) {
		jQuery.extend( this, props );
	}

	// Create a timestamp if incoming event doesn't have one
	this.timeStamp = src && src.timeStamp || Date.now();

	// Mark it as fixed
	this[ jQuery.expando ] = true;
};

// jQuery.Event is based on DOM3 Events as specified by the ECMAScript Language Binding
// https://www.w3.org/TR/2003/WD-DOM-Level-3-Events-20030331/ecma-script-binding.html
jQuery.Event.prototype = {
	constructor: jQuery.Event,
	isDefaultPrevented: returnFalse,
	isPropagationStopped: returnFalse,
	isImmediatePropagationStopped: returnFalse,
	isSimulated: false,

	preventDefault: function() {
		var e = this.originalEvent;

		this.isDefaultPrevented = returnTrue;

		if ( e && !this.isSimulated ) {
			e.preventDefault();
		}
	},
	stopPropagation: function() {
		var e = this.originalEvent;

		this.isPropagationStopped = returnTrue;

		if ( e && !this.isSimulated ) {
			e.stopPropagation();
		}
	},
	stopImmediatePropagation: function() {
		var e = this.originalEvent;

		this.isImmediatePropagationStopped = returnTrue;

		if ( e && !this.isSimulated ) {
			e.stopImmediatePropagation();
		}

		this.stopPropagation();
	}
};

// Includes all common event props including KeyEvent and MouseEvent specific props
jQuery.each( {
	altKey: true,
	bubbles: true,
	cancelable: true,
	changedTouches: true,
	ctrlKey: true,
	detail: true,
	eventPhase: true,
	metaKey: true,
	pageX: true,
	pageY: true,
	shiftKey: true,
	view: true,
	"char": true,
	code: true,
	charCode: true,
	key: true,
	keyCode: true,
	button: true,
	buttons: true,
	clientX: true,
	clientY: true,
	offsetX: true,
	offsetY: true,
	pointerId: true,
	pointerType: true,
	screenX: true,
	screenY: true,
	targetTouches: true,
	toElement: true,
	touches: true,

	which: function( event ) {
		var button = event.button;

		// Add which for key events
		if ( event.which == null && rkeyEvent.test( event.type ) ) {
			return event.charCode != null ? event.charCode : event.keyCode;
		}

		// Add which for click: 1 === left; 2 === middle; 3 === right
		if ( !event.which && button !== undefined && rmouseEvent.test( event.type ) ) {
			if ( button & 1 ) {
				return 1;
			}

			if ( button & 2 ) {
				return 3;
			}

			if ( button & 4 ) {
				return 2;
			}

			return 0;
		}

		return event.which;
	}
}, jQuery.event.addProp );

jQuery.each( { focus: "focusin", blur: "focusout" }, function( type, delegateType ) {
	jQuery.event.special[ type ] = {

		// Utilize native event if possible so blur/focus sequence is correct
		setup: function() {

			// Claim the first handler
			// dataPriv.set( this, "focus", ... )
			// dataPriv.set( this, "blur", ... )
			leverageNative( this, type, expectSync );

			// Return false to allow normal processing in the caller
			return false;
		},
		trigger: function() {

			// Force setup before trigger
			leverageNative( this, type );

			// Return non-false to allow normal event-path propagation
			return true;
		},

		delegateType: delegateType
	};
} );

// Create mouseenter/leave events using mouseover/out and event-time checks
// so that event delegation works in jQuery.
// Do the same for pointerenter/pointerleave and pointerover/pointerout
//
// Support: Safari 7 only
// Safari sends mouseenter too often; see:
// https://bugs.chromium.org/p/chromium/issues/detail?id=470258
// for the description of the bug (it existed in older Chrome versions as well).
jQuery.each( {
	mouseenter: "mouseover",
	mouseleave: "mouseout",
	pointerenter: "pointerover",
	pointerleave: "pointerout"
}, function( orig, fix ) {
	jQuery.event.special[ orig ] = {
		delegateType: fix,
		bindType: fix,

		handle: function( event ) {
			var ret,
				target = this,
				related = event.relatedTarget,
				handleObj = event.handleObj;

			// For mouseenter/leave call the handler if related is outside the target.
			// NB: No relatedTarget if the mouse left/entered the browser window
			if ( !related || ( related !== target && !jQuery.contains( target, related ) ) ) {
				event.type = handleObj.origType;
				ret = handleObj.handler.apply( this, arguments );
				event.type = fix;
			}
			return ret;
		}
	};
} );

jQuery.fn.extend( {

	on: function( types, selector, data, fn ) {
		return on( this, types, selector, data, fn );
	},
	one: function( types, selector, data, fn ) {
		return on( this, types, selector, data, fn, 1 );
	},
	off: function( types, selector, fn ) {
		var handleObj, type;
		if ( types && types.preventDefault && types.handleObj ) {

			// ( event )  dispatched jQuery.Event
			handleObj = types.handleObj;
			jQuery( types.delegateTarget ).off(
				handleObj.namespace ?
					handleObj.origType + "." + handleObj.namespace :
					handleObj.origType,
				handleObj.selector,
				handleObj.handler
			);
			return this;
		}
		if ( typeof types === "object" ) {

			// ( types-object [, selector] )
			for ( type in types ) {
				this.off( type, selector, types[ type ] );
			}
			return this;
		}
		if ( selector === false || typeof selector === "function" ) {

			// ( types [, fn] )
			fn = selector;
			selector = undefined;
		}
		if ( fn === false ) {
			fn = returnFalse;
		}
		return this.each( function() {
			jQuery.event.remove( this, types, fn, selector );
		} );
	}
} );


var

	// Support: IE <=10 - 11, Edge 12 - 13 only
	// In IE/Edge using regex groups here causes severe slowdowns.
	// See https://connect.microsoft.com/IE/feedback/details/1736512/
	rnoInnerhtml = /<script|<style|<link/i,

	// checked="checked" or checked
	rchecked = /checked\s*(?:[^=]|=\s*.checked.)/i,
	rcleanScript = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g;

// Prefer a tbody over its parent table for containing new rows
function manipulationTarget( elem, content ) {
	if ( nodeName( elem, "table" ) &&
		nodeName( content.nodeType !== 11 ? content : content.firstChild, "tr" ) ) {

		return jQuery( elem ).children( "tbody" )[ 0 ] || elem;
	}

	return elem;
}

// Replace/restore the type attribute of script elements for safe DOM manipulation
function disableScript( elem ) {
	elem.type = ( elem.getAttribute( "type" ) !== null ) + "/" + elem.type;
	return elem;
}
function restoreScript( elem ) {
	if ( ( elem.type || "" ).slice( 0, 5 ) === "true/" ) {
		elem.type = elem.type.slice( 5 );
	} else {
		elem.removeAttribute( "type" );
	}

	return elem;
}

function cloneCopyEvent( src, dest ) {
	var i, l, type, pdataOld, udataOld, udataCur, events;

	if ( dest.nodeType !== 1 ) {
		return;
	}

	// 1. Copy private data: events, handlers, etc.
	if ( dataPriv.hasData( src ) ) {
		pdataOld = dataPriv.get( src );
		events = pdataOld.events;

		if ( events ) {
			dataPriv.remove( dest, "handle events" );

			for ( type in events ) {
				for ( i = 0, l = events[ type ].length; i < l; i++ ) {
					jQuery.event.add( dest, type, events[ type ][ i ] );
				}
			}
		}
	}

	// 2. Copy user data
	if ( dataUser.hasData( src ) ) {
		udataOld = dataUser.access( src );
		udataCur = jQuery.extend( {}, udataOld );

		dataUser.set( dest, udataCur );
	}
}

// Fix IE bugs, see support tests
function fixInput( src, dest ) {
	var nodeName = dest.nodeName.toLowerCase();

	// Fails to persist the checked state of a cloned checkbox or radio button.
	if ( nodeName === "input" && rcheckableType.test( src.type ) ) {
		dest.checked = src.checked;

	// Fails to return the selected option to the default selected state when cloning options
	} else if ( nodeName === "input" || nodeName === "textarea" ) {
		dest.defaultValue = src.defaultValue;
	}
}

function domManip( collection, args, callback, ignored ) {

	// Flatten any nested arrays
	args = flat( args );

	var fragment, first, scripts, hasScripts, node, doc,
		i = 0,
		l = collection.length,
		iNoClone = l - 1,
		value = args[ 0 ],
		valueIsFunction = isFunction( value );

	// We can't cloneNode fragments that contain checked, in WebKit
	if ( valueIsFunction ||
			( l > 1 && typeof value === "string" &&
				!support.checkClone && rchecked.test( value ) ) ) {
		return collection.each( function( index ) {
			var self = collection.eq( index );
			if ( valueIsFunction ) {
				args[ 0 ] = value.call( this, index, self.html() );
			}
			domManip( self, args, callback, ignored );
		} );
	}

	if ( l ) {
		fragment = buildFragment( args, collection[ 0 ].ownerDocument, false, collection, ignored );
		first = fragment.firstChild;

		if ( fragment.childNodes.length === 1 ) {
			fragment = first;
		}

		// Require either new content or an interest in ignored elements to invoke the callback
		if ( first || ignored ) {
			scripts = jQuery.map( getAll( fragment, "script" ), disableScript );
			hasScripts = scripts.length;

			// Use the original fragment for the last item
			// instead of the first because it can end up
			// being emptied incorrectly in certain situations (#8070).
			for ( ; i < l; i++ ) {
				node = fragment;

				if ( i !== iNoClone ) {
					node = jQuery.clone( node, true, true );

					// Keep references to cloned scripts for later restoration
					if ( hasScripts ) {

						// Support: Android <=4.0 only, PhantomJS 1 only
						// push.apply(_, arraylike) throws on ancient WebKit
						jQuery.merge( scripts, getAll( node, "script" ) );
					}
				}

				callback.call( collection[ i ], node, i );
			}

			if ( hasScripts ) {
				doc = scripts[ scripts.length - 1 ].ownerDocument;

				// Reenable scripts
				jQuery.map( scripts, restoreScript );

				// Evaluate executable scripts on first document insertion
				for ( i = 0; i < hasScripts; i++ ) {
					node = scripts[ i ];
					if ( rscriptType.test( node.type || "" ) &&
						!dataPriv.access( node, "globalEval" ) &&
						jQuery.contains( doc, node ) ) {

						if ( node.src && ( node.type || "" ).toLowerCase()  !== "module" ) {

							// Optional AJAX dependency, but won't run scripts if not present
							if ( jQuery._evalUrl && !node.noModule ) {
								jQuery._evalUrl( node.src, {
									nonce: node.nonce || node.getAttribute( "nonce" )
								}, doc );
							}
						} else {
							DOMEval( node.textContent.replace( rcleanScript, "" ), node, doc );
						}
					}
				}
			}
		}
	}

	return collection;
}

function remove( elem, selector, keepData ) {
	var node,
		nodes = selector ? jQuery.filter( selector, elem ) : elem,
		i = 0;

	for ( ; ( node = nodes[ i ] ) != null; i++ ) {
		if ( !keepData && node.nodeType === 1 ) {
			jQuery.cleanData( getAll( node ) );
		}

		if ( node.parentNode ) {
			if ( keepData && isAttached( node ) ) {
				setGlobalEval( getAll( node, "script" ) );
			}
			node.parentNode.removeChild( node );
		}
	}

	return elem;
}

jQuery.extend( {
	htmlPrefilter: function( html ) {
		return html;
	},

	clone: function( elem, dataAndEvents, deepDataAndEvents ) {
		var i, l, srcElements, destElements,
			clone = elem.cloneNode( true ),
			inPage = isAttached( elem );

		// Fix IE cloning issues
		if ( !support.noCloneChecked && ( elem.nodeType === 1 || elem.nodeType === 11 ) &&
				!jQuery.isXMLDoc( elem ) ) {

			// We eschew Sizzle here for performance reasons: https://jsperf.com/getall-vs-sizzle/2
			destElements = getAll( clone );
			srcElements = getAll( elem );

			for ( i = 0, l = srcElements.length; i < l; i++ ) {
				fixInput( srcElements[ i ], destElements[ i ] );
			}
		}

		// Copy the events from the original to the clone
		if ( dataAndEvents ) {
			if ( deepDataAndEvents ) {
				srcElements = srcElements || getAll( elem );
				destElements = destElements || getAll( clone );

				for ( i = 0, l = srcElements.length; i < l; i++ ) {
					cloneCopyEvent( srcElements[ i ], destElements[ i ] );
				}
			} else {
				cloneCopyEvent( elem, clone );
			}
		}

		// Preserve script evaluation history
		destElements = getAll( clone, "script" );
		if ( destElements.length > 0 ) {
			setGlobalEval( destElements, !inPage && getAll( elem, "script" ) );
		}

		// Return the cloned set
		return clone;
	},

	cleanData: function( elems ) {
		var data, elem, type,
			special = jQuery.event.special,
			i = 0;

		for ( ; ( elem = elems[ i ] ) !== undefined; i++ ) {
			if ( acceptData( elem ) ) {
				if ( ( data = elem[ dataPriv.expando ] ) ) {
					if ( data.events ) {
						for ( type in data.events ) {
							if ( special[ type ] ) {
								jQuery.event.remove( elem, type );

							// This is a shortcut to avoid jQuery.event.remove's overhead
							} else {
								jQuery.removeEvent( elem, type, data.handle );
							}
						}
					}

					// Support: Chrome <=35 - 45+
					// Assign undefined instead of using delete, see Data#remove
					elem[ dataPriv.expando ] = undefined;
				}
				if ( elem[ dataUser.expando ] ) {

					// Support: Chrome <=35 - 45+
					// Assign undefined instead of using delete, see Data#remove
					elem[ dataUser.expando ] = undefined;
				}
			}
		}
	}
} );

jQuery.fn.extend( {
	detach: function( selector ) {
		return remove( this, selector, true );
	},

	remove: function( selector ) {
		return remove( this, selector );
	},

	text: function( value ) {
		return access( this, function( value ) {
			return value === undefined ?
				jQuery.text( this ) :
				this.empty().each( function() {
					if ( this.nodeType === 1 || this.nodeType === 11 || this.nodeType === 9 ) {
						this.textContent = value;
					}
				} );
		}, null, value, arguments.length );
	},

	append: function() {
		return domManip( this, arguments, function( elem ) {
			if ( this.nodeType === 1 || this.nodeType === 11 || this.nodeType === 9 ) {
				var target = manipulationTarget( this, elem );
				target.appendChild( elem );
			}
		} );
	},

	prepend: function() {
		return domManip( this, arguments, function( elem ) {
			if ( this.nodeType === 1 || this.nodeType === 11 || this.nodeType === 9 ) {
				var target = manipulationTarget( this, elem );
				target.insertBefore( elem, target.firstChild );
			}
		} );
	},

	before: function() {
		return domManip( this, arguments, function( elem ) {
			if ( this.parentNode ) {
				this.parentNode.insertBefore( elem, this );
			}
		} );
	},

	after: function() {
		return domManip( this, arguments, function( elem ) {
			if ( this.parentNode ) {
				this.parentNode.insertBefore( elem, this.nextSibling );
			}
		} );
	},

	empty: function() {
		var elem,
			i = 0;

		for ( ; ( elem = this[ i ] ) != null; i++ ) {
			if ( elem.nodeType === 1 ) {

				// Prevent memory leaks
				jQuery.cleanData( getAll( elem, false ) );

				// Remove any remaining nodes
				elem.textContent = "";
			}
		}

		return this;
	},

	clone: function( dataAndEvents, deepDataAndEvents ) {
		dataAndEvents = dataAndEvents == null ? false : dataAndEvents;
		deepDataAndEvents = deepDataAndEvents == null ? dataAndEvents : deepDataAndEvents;

		return this.map( function() {
			return jQuery.clone( this, dataAndEvents, deepDataAndEvents );
		} );
	},

	html: function( value ) {
		return access( this, function( value ) {
			var elem = this[ 0 ] || {},
				i = 0,
				l = this.length;

			if ( value === undefined && elem.nodeType === 1 ) {
				return elem.innerHTML;
			}

			// See if we can take a shortcut and just use innerHTML
			if ( typeof value === "string" && !rnoInnerhtml.test( value ) &&
				!wrapMap[ ( rtagName.exec( value ) || [ "", "" ] )[ 1 ].toLowerCase() ] ) {

				value = jQuery.htmlPrefilter( value );

				try {
					for ( ; i < l; i++ ) {
						elem = this[ i ] || {};

						// Remove element nodes and prevent memory leaks
						if ( elem.nodeType === 1 ) {
							jQuery.cleanData( getAll( elem, false ) );
							elem.innerHTML = value;
						}
					}

					elem = 0;

				// If using innerHTML throws an exception, use the fallback method
				} catch ( e ) {}
			}

			if ( elem ) {
				this.empty().append( value );
			}
		}, null, value, arguments.length );
	},

	replaceWith: function() {
		var ignored = [];

		// Make the changes, replacing each non-ignored context element with the new content
		return domManip( this, arguments, function( elem ) {
			var parent = this.parentNode;

			if ( jQuery.inArray( this, ignored ) < 0 ) {
				jQuery.cleanData( getAll( this ) );
				if ( parent ) {
					parent.replaceChild( elem, this );
				}
			}

		// Force callback invocation
		}, ignored );
	}
} );

jQuery.each( {
	appendTo: "append",
	prependTo: "prepend",
	insertBefore: "before",
	insertAfter: "after",
	replaceAll: "replaceWith"
}, function( name, original ) {
	jQuery.fn[ name ] = function( selector ) {
		var elems,
			ret = [],
			insert = jQuery( selector ),
			last = insert.length - 1,
			i = 0;

		for ( ; i <= last; i++ ) {
			elems = i === last ? this : this.clone( true );
			jQuery( insert[ i ] )[ original ]( elems );

			// Support: Android <=4.0 only, PhantomJS 1 only
			// .get() because push.apply(_, arraylike) throws on ancient WebKit
			push.apply( ret, elems.get() );
		}

		return this.pushStack( ret );
	};
} );
var rnumnonpx = new RegExp( "^(" + pnum + ")(?!px)[a-z%]+$", "i" );

var getStyles = function( elem ) {

		// Support: IE <=11 only, Firefox <=30 (#15098, #14150)
		// IE throws on elements created in popups
		// FF meanwhile throws on frame elements through "defaultView.getComputedStyle"
		var view = elem.ownerDocument.defaultView;

		if ( !view || !view.opener ) {
			view = window;
		}

		return view.getComputedStyle( elem );
	};

var swap = function( elem, options, callback ) {
	var ret, name,
		old = {};

	// Remember the old values, and insert the new ones
	for ( name in options ) {
		old[ name ] = elem.style[ name ];
		elem.style[ name ] = options[ name ];
	}

	ret = callback.call( elem );

	// Revert the old values
	for ( name in options ) {
		elem.style[ name ] = old[ name ];
	}

	return ret;
};


var rboxStyle = new RegExp( cssExpand.join( "|" ), "i" );



( function() {

	// Executing both pixelPosition & boxSizingReliable tests require only one layout
	// so they're executed at the same time to save the second computation.
	function computeStyleTests() {

		// This is a singleton, we need to execute it only once
		if ( !div ) {
			return;
		}

		container.style.cssText = "position:absolute;left:-11111px;width:60px;" +
			"margin-top:1px;padding:0;border:0";
		div.style.cssText =
			"position:relative;display:block;box-sizing:border-box;overflow:scroll;" +
			"margin:auto;border:1px;padding:1px;" +
			"width:60%;top:1%";
		documentElement.appendChild( container ).appendChild( div );

		var divStyle = window.getComputedStyle( div );
		pixelPositionVal = divStyle.top !== "1%";

		// Support: Android 4.0 - 4.3 only, Firefox <=3 - 44
		reliableMarginLeftVal = roundPixelMeasures( divStyle.marginLeft ) === 12;

		// Support: Android 4.0 - 4.3 only, Safari <=9.1 - 10.1, iOS <=7.0 - 9.3
		// Some styles come back with percentage values, even though they shouldn't
		div.style.right = "60%";
		pixelBoxStylesVal = roundPixelMeasures( divStyle.right ) === 36;

		// Support: IE 9 - 11 only
		// Detect misreporting of content dimensions for box-sizing:border-box elements
		boxSizingReliableVal = roundPixelMeasures( divStyle.width ) === 36;

		// Support: IE 9 only
		// Detect overflow:scroll screwiness (gh-3699)
		// Support: Chrome <=64
		// Don't get tricked when zoom affects offsetWidth (gh-4029)
		div.style.position = "absolute";
		scrollboxSizeVal = roundPixelMeasures( div.offsetWidth / 3 ) === 12;

		documentElement.removeChild( container );

		// Nullify the div so it wouldn't be stored in the memory and
		// it will also be a sign that checks already performed
		div = null;
	}

	function roundPixelMeasures( measure ) {
		return Math.round( parseFloat( measure ) );
	}

	var pixelPositionVal, boxSizingReliableVal, scrollboxSizeVal, pixelBoxStylesVal,
		reliableTrDimensionsVal, reliableMarginLeftVal,
		container = document.createElement( "div" ),
		div = document.createElement( "div" );

	// Finish early in limited (non-browser) environments
	if ( !div.style ) {
		return;
	}

	// Support: IE <=9 - 11 only
	// Style of cloned element affects source element cloned (#8908)
	div.style.backgroundClip = "content-box";
	div.cloneNode( true ).style.backgroundClip = "";
	support.clearCloneStyle = div.style.backgroundClip === "content-box";

	jQuery.extend( support, {
		boxSizingReliable: function() {
			computeStyleTests();
			return boxSizingReliableVal;
		},
		pixelBoxStyles: function() {
			computeStyleTests();
			return pixelBoxStylesVal;
		},
		pixelPosition: function() {
			computeStyleTests();
			return pixelPositionVal;
		},
		reliableMarginLeft: function() {
			computeStyleTests();
			return reliableMarginLeftVal;
		},
		scrollboxSize: function() {
			computeStyleTests();
			return scrollboxSizeVal;
		},

		// Support: IE 9 - 11+, Edge 15 - 18+
		// IE/Edge misreport `getComputedStyle` of table rows with width/height
		// set in CSS while `offset*` properties report correct values.
		// Behavior in IE 9 is more subtle than in newer versions & it passes
		// some versions of this test; make sure not to make it pass there!
		reliableTrDimensions: function() {
			var table, tr, trChild, trStyle;
			if ( reliableTrDimensionsVal == null ) {
				table = document.createElement( "table" );
				tr = document.createElement( "tr" );
				trChild = document.createElement( "div" );

				table.style.cssText = "position:absolute;left:-11111px";
				tr.style.height = "1px";
				trChild.style.height = "9px";

				documentElement
					.appendChild( table )
					.appendChild( tr )
					.appendChild( trChild );

				trStyle = window.getComputedStyle( tr );
				reliableTrDimensionsVal = parseInt( trStyle.height ) > 3;

				documentElement.removeChild( table );
			}
			return reliableTrDimensionsVal;
		}
	} );
} )();


function curCSS( elem, name, computed ) {
	var width, minWidth, maxWidth, ret,

		// Support: Firefox 51+
		// Retrieving style before computed somehow
		// fixes an issue with getting wrong values
		// on detached elements
		style = elem.style;

	computed = computed || getStyles( elem );

	// getPropertyValue is needed for:
	//   .css('filter') (IE 9 only, #12537)
	//   .css('--customProperty) (#3144)
	if ( computed ) {
		ret = computed.getPropertyValue( name ) || computed[ name ];

		if ( ret === "" && !isAttached( elem ) ) {
			ret = jQuery.style( elem, name );
		}

		// A tribute to the "awesome hack by Dean Edwards"
		// Android Browser returns percentage for some values,
		// but width seems to be reliably pixels.
		// This is against the CSSOM draft spec:
		// https://drafts.csswg.org/cssom/#resolved-values
		if ( !support.pixelBoxStyles() && rnumnonpx.test( ret ) && rboxStyle.test( name ) ) {

			// Remember the original values
			width = style.width;
			minWidth = style.minWidth;
			maxWidth = style.maxWidth;

			// Put in the new values to get a computed value out
			style.minWidth = style.maxWidth = style.width = ret;
			ret = computed.width;

			// Revert the changed values
			style.width = width;
			style.minWidth = minWidth;
			style.maxWidth = maxWidth;
		}
	}

	return ret !== undefined ?

		// Support: IE <=9 - 11 only
		// IE returns zIndex value as an integer.
		ret + "" :
		ret;
}


function addGetHookIf( conditionFn, hookFn ) {

	// Define the hook, we'll check on the first run if it's really needed.
	return {
		get: function() {
			if ( conditionFn() ) {

				// Hook not needed (or it's not possible to use it due
				// to missing dependency), remove it.
				delete this.get;
				return;
			}

			// Hook needed; redefine it so that the support test is not executed again.
			return ( this.get = hookFn ).apply( this, arguments );
		}
	};
}


var cssPrefixes = [ "Webkit", "Moz", "ms" ],
	emptyStyle = document.createElement( "div" ).style,
	vendorProps = {};

// Return a vendor-prefixed property or undefined
function vendorPropName( name ) {

	// Check for vendor prefixed names
	var capName = name[ 0 ].toUpperCase() + name.slice( 1 ),
		i = cssPrefixes.length;

	while ( i-- ) {
		name = cssPrefixes[ i ] + capName;
		if ( name in emptyStyle ) {
			return name;
		}
	}
}

// Return a potentially-mapped jQuery.cssProps or vendor prefixed property
function finalPropName( name ) {
	var final = jQuery.cssProps[ name ] || vendorProps[ name ];

	if ( final ) {
		return final;
	}
	if ( name in emptyStyle ) {
		return name;
	}
	return vendorProps[ name ] = vendorPropName( name ) || name;
}


var

	// Swappable if display is none or starts with table
	// except "table", "table-cell", or "table-caption"
	// See here for display values: https://developer.mozilla.org/en-US/docs/CSS/display
	rdisplayswap = /^(none|table(?!-c[ea]).+)/,
	rcustomProp = /^--/,
	cssShow = { position: "absolute", visibility: "hidden", display: "block" },
	cssNormalTransform = {
		letterSpacing: "0",
		fontWeight: "400"
	};

function setPositiveNumber( _elem, value, subtract ) {

	// Any relative (+/-) values have already been
	// normalized at this point
	var matches = rcssNum.exec( value );
	return matches ?

		// Guard against undefined "subtract", e.g., when used as in cssHooks
		Math.max( 0, matches[ 2 ] - ( subtract || 0 ) ) + ( matches[ 3 ] || "px" ) :
		value;
}

function boxModelAdjustment( elem, dimension, box, isBorderBox, styles, computedVal ) {
	var i = dimension === "width" ? 1 : 0,
		extra = 0,
		delta = 0;

	// Adjustment may not be necessary
	if ( box === ( isBorderBox ? "border" : "content" ) ) {
		return 0;
	}

	for ( ; i < 4; i += 2 ) {

		// Both box models exclude margin
		if ( box === "margin" ) {
			delta += jQuery.css( elem, box + cssExpand[ i ], true, styles );
		}

		// If we get here with a content-box, we're seeking "padding" or "border" or "margin"
		if ( !isBorderBox ) {

			// Add padding
			delta += jQuery.css( elem, "padding" + cssExpand[ i ], true, styles );

			// For "border" or "margin", add border
			if ( box !== "padding" ) {
				delta += jQuery.css( elem, "border" + cssExpand[ i ] + "Width", true, styles );

			// But still keep track of it otherwise
			} else {
				extra += jQuery.css( elem, "border" + cssExpand[ i ] + "Width", true, styles );
			}

		// If we get here with a border-box (content + padding + border), we're seeking "content" or
		// "padding" or "margin"
		} else {

			// For "content", subtract padding
			if ( box === "content" ) {
				delta -= jQuery.css( elem, "padding" + cssExpand[ i ], true, styles );
			}

			// For "content" or "padding", subtract border
			if ( box !== "margin" ) {
				delta -= jQuery.css( elem, "border" + cssExpand[ i ] + "Width", true, styles );
			}
		}
	}

	// Account for positive content-box scroll gutter when requested by providing computedVal
	if ( !isBorderBox && computedVal >= 0 ) {

		// offsetWidth/offsetHeight is a rounded sum of content, padding, scroll gutter, and border
		// Assuming integer scroll gutter, subtract the rest and round down
		delta += Math.max( 0, Math.ceil(
			elem[ "offset" + dimension[ 0 ].toUpperCase() + dimension.slice( 1 ) ] -
			computedVal -
			delta -
			extra -
			0.5

		// If offsetWidth/offsetHeight is unknown, then we can't determine content-box scroll gutter
		// Use an explicit zero to avoid NaN (gh-3964)
		) ) || 0;
	}

	return delta;
}

function getWidthOrHeight( elem, dimension, extra ) {

	// Start with computed style
	var styles = getStyles( elem ),

		// To avoid forcing a reflow, only fetch boxSizing if we need it (gh-4322).
		// Fake content-box until we know it's needed to know the true value.
		boxSizingNeeded = !support.boxSizingReliable() || extra,
		isBorderBox = boxSizingNeeded &&
			jQuery.css( elem, "boxSizing", false, styles ) === "border-box",
		valueIsBorderBox = isBorderBox,

		val = curCSS( elem, dimension, styles ),
		offsetProp = "offset" + dimension[ 0 ].toUpperCase() + dimension.slice( 1 );

	// Support: Firefox <=54
	// Return a confounding non-pixel value or feign ignorance, as appropriate.
	if ( rnumnonpx.test( val ) ) {
		if ( !extra ) {
			return val;
		}
		val = "auto";
	}


	// Support: IE 9 - 11 only
	// Use offsetWidth/offsetHeight for when box sizing is unreliable.
	// In those cases, the computed value can be trusted to be border-box.
	if ( ( !support.boxSizingReliable() && isBorderBox ||

		// Support: IE 10 - 11+, Edge 15 - 18+
		// IE/Edge misreport `getComputedStyle` of table rows with width/height
		// set in CSS while `offset*` properties report correct values.
		// Interestingly, in some cases IE 9 doesn't suffer from this issue.
		!support.reliableTrDimensions() && nodeName( elem, "tr" ) ||

		// Fall back to offsetWidth/offsetHeight when value is "auto"
		// This happens for inline elements with no explicit setting (gh-3571)
		val === "auto" ||

		// Support: Android <=4.1 - 4.3 only
		// Also use offsetWidth/offsetHeight for misreported inline dimensions (gh-3602)
		!parseFloat( val ) && jQuery.css( elem, "display", false, styles ) === "inline" ) &&

		// Make sure the element is visible & connected
		elem.getClientRects().length ) {

		isBorderBox = jQuery.css( elem, "boxSizing", false, styles ) === "border-box";

		// Where available, offsetWidth/offsetHeight approximate border box dimensions.
		// Where not available (e.g., SVG), assume unreliable box-sizing and interpret the
		// retrieved value as a content box dimension.
		valueIsBorderBox = offsetProp in elem;
		if ( valueIsBorderBox ) {
			val = elem[ offsetProp ];
		}
	}

	// Normalize "" and auto
	val = parseFloat( val ) || 0;

	// Adjust for the element's box model
	return ( val +
		boxModelAdjustment(
			elem,
			dimension,
			extra || ( isBorderBox ? "border" : "content" ),
			valueIsBorderBox,
			styles,

			// Provide the current computed size to request scroll gutter calculation (gh-3589)
			val
		)
	) + "px";
}

jQuery.extend( {

	// Add in style property hooks for overriding the default
	// behavior of getting and setting a style property
	cssHooks: {
		opacity: {
			get: function( elem, computed ) {
				if ( computed ) {

					// We should always get a number back from opacity
					var ret = curCSS( elem, "opacity" );
					return ret === "" ? "1" : ret;
				}
			}
		}
	},

	// Don't automatically add "px" to these possibly-unitless properties
	cssNumber: {
		"animationIterationCount": true,
		"columnCount": true,
		"fillOpacity": true,
		"flexGrow": true,
		"flexShrink": true,
		"fontWeight": true,
		"gridArea": true,
		"gridColumn": true,
		"gridColumnEnd": true,
		"gridColumnStart": true,
		"gridRow": true,
		"gridRowEnd": true,
		"gridRowStart": true,
		"lineHeight": true,
		"opacity": true,
		"order": true,
		"orphans": true,
		"widows": true,
		"zIndex": true,
		"zoom": true
	},

	// Add in properties whose names you wish to fix before
	// setting or getting the value
	cssProps: {},

	// Get and set the style property on a DOM Node
	style: function( elem, name, value, extra ) {

		// Don't set styles on text and comment nodes
		if ( !elem || elem.nodeType === 3 || elem.nodeType === 8 || !elem.style ) {
			return;
		}

		// Make sure that we're working with the right name
		var ret, type, hooks,
			origName = camelCase( name ),
			isCustomProp = rcustomProp.test( name ),
			style = elem.style;

		// Make sure that we're working with the right name. We don't
		// want to query the value if it is a CSS custom property
		// since they are user-defined.
		if ( !isCustomProp ) {
			name = finalPropName( origName );
		}

		// Gets hook for the prefixed version, then unprefixed version
		hooks = jQuery.cssHooks[ name ] || jQuery.cssHooks[ origName ];

		// Check if we're setting a value
		if ( value !== undefined ) {
			type = typeof value;

			// Convert "+=" or "-=" to relative numbers (#7345)
			if ( type === "string" && ( ret = rcssNum.exec( value ) ) && ret[ 1 ] ) {
				value = adjustCSS( elem, name, ret );

				// Fixes bug #9237
				type = "number";
			}

			// Make sure that null and NaN values aren't set (#7116)
			if ( value == null || value !== value ) {
				return;
			}

			// If a number was passed in, add the unit (except for certain CSS properties)
			// The isCustomProp check can be removed in jQuery 4.0 when we only auto-append
			// "px" to a few hardcoded values.
			if ( type === "number" && !isCustomProp ) {
				value += ret && ret[ 3 ] || ( jQuery.cssNumber[ origName ] ? "" : "px" );
			}

			// background-* props affect original clone's values
			if ( !support.clearCloneStyle && value === "" && name.indexOf( "background" ) === 0 ) {
				style[ name ] = "inherit";
			}

			// If a hook was provided, use that value, otherwise just set the specified value
			if ( !hooks || !( "set" in hooks ) ||
				( value = hooks.set( elem, value, extra ) ) !== undefined ) {

				if ( isCustomProp ) {
					style.setProperty( name, value );
				} else {
					style[ name ] = value;
				}
			}

		} else {

			// If a hook was provided get the non-computed value from there
			if ( hooks && "get" in hooks &&
				( ret = hooks.get( elem, false, extra ) ) !== undefined ) {

				return ret;
			}

			// Otherwise just get the value from the style object
			return style[ name ];
		}
	},

	css: function( elem, name, extra, styles ) {
		var val, num, hooks,
			origName = camelCase( name ),
			isCustomProp = rcustomProp.test( name );

		// Make sure that we're working with the right name. We don't
		// want to modify the value if it is a CSS custom property
		// since they are user-defined.
		if ( !isCustomProp ) {
			name = finalPropName( origName );
		}

		// Try prefixed name followed by the unprefixed name
		hooks = jQuery.cssHooks[ name ] || jQuery.cssHooks[ origName ];

		// If a hook was provided get the computed value from there
		if ( hooks && "get" in hooks ) {
			val = hooks.get( elem, true, extra );
		}

		// Otherwise, if a way to get the computed value exists, use that
		if ( val === undefined ) {
			val = curCSS( elem, name, styles );
		}

		// Convert "normal" to computed value
		if ( val === "normal" && name in cssNormalTransform ) {
			val = cssNormalTransform[ name ];
		}

		// Make numeric if forced or a qualifier was provided and val looks numeric
		if ( extra === "" || extra ) {
			num = parseFloat( val );
			return extra === true || isFinite( num ) ? num || 0 : val;
		}

		return val;
	}
} );

jQuery.each( [ "height", "width" ], function( _i, dimension ) {
	jQuery.cssHooks[ dimension ] = {
		get: function( elem, computed, extra ) {
			if ( computed ) {

				// Certain elements can have dimension info if we invisibly show them
				// but it must have a current display style that would benefit
				return rdisplayswap.test( jQuery.css( elem, "display" ) ) &&

					// Support: Safari 8+
					// Table columns in Safari have non-zero offsetWidth & zero
					// getBoundingClientRect().width unless display is changed.
					// Support: IE <=11 only
					// Running getBoundingClientRect on a disconnected node
					// in IE throws an error.
					( !elem.getClientRects().length || !elem.getBoundingClientRect().width ) ?
						swap( elem, cssShow, function() {
							return getWidthOrHeight( elem, dimension, extra );
						} ) :
						getWidthOrHeight( elem, dimension, extra );
			}
		},

		set: function( elem, value, extra ) {
			var matches,
				styles = getStyles( elem ),

				// Only read styles.position if the test has a chance to fail
				// to avoid forcing a reflow.
				scrollboxSizeBuggy = !support.scrollboxSize() &&
					styles.position === "absolute",

				// To avoid forcing a reflow, only fetch boxSizing if we need it (gh-3991)
				boxSizingNeeded = scrollboxSizeBuggy || extra,
				isBorderBox = boxSizingNeeded &&
					jQuery.css( elem, "boxSizing", false, styles ) === "border-box",
				subtract = extra ?
					boxModelAdjustment(
						elem,
						dimension,
						extra,
						isBorderBox,
						styles
					) :
					0;

			// Account for unreliable border-box dimensions by comparing offset* to computed and
			// faking a content-box to get border and padding (gh-3699)
			if ( isBorderBox && scrollboxSizeBuggy ) {
				subtract -= Math.ceil(
					elem[ "offset" + dimension[ 0 ].toUpperCase() + dimension.slice( 1 ) ] -
					parseFloat( styles[ dimension ] ) -
					boxModelAdjustment( elem, dimension, "border", false, styles ) -
					0.5
				);
			}

			// Convert to pixels if value adjustment is needed
			if ( subtract && ( matches = rcssNum.exec( value ) ) &&
				( matches[ 3 ] || "px" ) !== "px" ) {

				elem.style[ dimension ] = value;
				value = jQuery.css( elem, dimension );
			}

			return setPositiveNumber( elem, value, subtract );
		}
	};
} );

jQuery.cssHooks.marginLeft = addGetHookIf( support.reliableMarginLeft,
	function( elem, computed ) {
		if ( computed ) {
			return ( parseFloat( curCSS( elem, "marginLeft" ) ) ||
				elem.getBoundingClientRect().left -
					swap( elem, { marginLeft: 0 }, function() {
						return elem.getBoundingClientRect().left;
					} )
				) + "px";
		}
	}
);

// These hooks are used by animate to expand properties
jQuery.each( {
	margin: "",
	padding: "",
	border: "Width"
}, function( prefix, suffix ) {
	jQuery.cssHooks[ prefix + suffix ] = {
		expand: function( value ) {
			var i = 0,
				expanded = {},

				// Assumes a single number if not a string
				parts = typeof value === "string" ? value.split( " " ) : [ value ];

			for ( ; i < 4; i++ ) {
				expanded[ prefix + cssExpand[ i ] + suffix ] =
					parts[ i ] || parts[ i - 2 ] || parts[ 0 ];
			}

			return expanded;
		}
	};

	if ( prefix !== "margin" ) {
		jQuery.cssHooks[ prefix + suffix ].set = setPositiveNumber;
	}
} );

jQuery.fn.extend( {
	css: function( name, value ) {
		return access( this, function( elem, name, value ) {
			var styles, len,
				map = {},
				i = 0;

			if ( Array.isArray( name ) ) {
				styles = getStyles( elem );
				len = name.length;

				for ( ; i < len; i++ ) {
					map[ name[ i ] ] = jQuery.css( elem, name[ i ], false, styles );
				}

				return map;
			}

			return value !== undefined ?
				jQuery.style( elem, name, value ) :
				jQuery.css( elem, name );
		}, name, value, arguments.length > 1 );
	}
} );


function Tween( elem, options, prop, end, easing ) {
	return new Tween.prototype.init( elem, options, prop, end, easing );
}
jQuery.Tween = Tween;

Tween.prototype = {
	constructor: Tween,
	init: function( elem, options, prop, end, easing, unit ) {
		this.elem = elem;
		this.prop = prop;
		this.easing = easing || jQuery.easing._default;
		this.options = options;
		this.start = this.now = this.cur();
		this.end = end;
		this.unit = unit || ( jQuery.cssNumber[ prop ] ? "" : "px" );
	},
	cur: function() {
		var hooks = Tween.propHooks[ this.prop ];

		return hooks && hooks.get ?
			hooks.get( this ) :
			Tween.propHooks._default.get( this );
	},
	run: function( percent ) {
		var eased,
			hooks = Tween.propHooks[ this.prop ];

		if ( this.options.duration ) {
			this.pos = eased = jQuery.easing[ this.easing ](
				percent, this.options.duration * percent, 0, 1, this.options.duration
			);
		} else {
			this.pos = eased = percent;
		}
		this.now = ( this.end - this.start ) * eased + this.start;

		if ( this.options.step ) {
			this.options.step.call( this.elem, this.now, this );
		}

		if ( hooks && hooks.set ) {
			hooks.set( this );
		} else {
			Tween.propHooks._default.set( this );
		}
		return this;
	}
};

Tween.prototype.init.prototype = Tween.prototype;

Tween.propHooks = {
	_default: {
		get: function( tween ) {
			var result;

			// Use a property on the element directly when it is not a DOM element,
			// or when there is no matching style property that exists.
			if ( tween.elem.nodeType !== 1 ||
				tween.elem[ tween.prop ] != null && tween.elem.style[ tween.prop ] == null ) {
				return tween.elem[ tween.prop ];
			}

			// Passing an empty string as a 3rd parameter to .css will automatically
			// attempt a parseFloat and fallback to a string if the parse fails.
			// Simple values such as "10px" are parsed to Float;
			// complex values such as "rotate(1rad)" are returned as-is.
			result = jQuery.css( tween.elem, tween.prop, "" );

			// Empty strings, null, undefined and "auto" are converted to 0.
			return !result || result === "auto" ? 0 : result;
		},
		set: function( tween ) {

			// Use step hook for back compat.
			// Use cssHook if its there.
			// Use .style if available and use plain properties where available.
			if ( jQuery.fx.step[ tween.prop ] ) {
				jQuery.fx.step[ tween.prop ]( tween );
			} else if ( tween.elem.nodeType === 1 && (
					jQuery.cssHooks[ tween.prop ] ||
					tween.elem.style[ finalPropName( tween.prop ) ] != null ) ) {
				jQuery.style( tween.elem, tween.prop, tween.now + tween.unit );
			} else {
				tween.elem[ tween.prop ] = tween.now;
			}
		}
	}
};

// Support: IE <=9 only
// Panic based approach to setting things on disconnected nodes
Tween.propHooks.scrollTop = Tween.propHooks.scrollLeft = {
	set: function( tween ) {
		if ( tween.elem.nodeType && tween.elem.parentNode ) {
			tween.elem[ tween.prop ] = tween.now;
		}
	}
};

jQuery.easing = {
	linear: function( p ) {
		return p;
	},
	swing: function( p ) {
		return 0.5 - Math.cos( p * Math.PI ) / 2;
	},
	_default: "swing"
};

jQuery.fx = Tween.prototype.init;

// Back compat <1.8 extension point
jQuery.fx.step = {};




var
	fxNow, inProgress,
	rfxtypes = /^(?:toggle|show|hide)$/,
	rrun = /queueHooks$/;

function schedule() {
	if ( inProgress ) {
		if ( document.hidden === false && window.requestAnimationFrame ) {
			window.requestAnimationFrame( schedule );
		} else {
			window.setTimeout( schedule, jQuery.fx.interval );
		}

		jQuery.fx.tick();
	}
}

// Animations created synchronously will run synchronously
function createFxNow() {
	window.setTimeout( function() {
		fxNow = undefined;
	} );
	return ( fxNow = Date.now() );
}

// Generate parameters to create a standard animation
function genFx( type, includeWidth ) {
	var which,
		i = 0,
		attrs = { height: type };

	// If we include width, step value is 1 to do all cssExpand values,
	// otherwise step value is 2 to skip over Left and Right
	includeWidth = includeWidth ? 1 : 0;
	for ( ; i < 4; i += 2 - includeWidth ) {
		which = cssExpand[ i ];
		attrs[ "margin" + which ] = attrs[ "padding" + which ] = type;
	}

	if ( includeWidth ) {
		attrs.opacity = attrs.width = type;
	}

	return attrs;
}

function createTween( value, prop, animation ) {
	var tween,
		collection = ( Animation.tweeners[ prop ] || [] ).concat( Animation.tweeners[ "*" ] ),
		index = 0,
		length = collection.length;
	for ( ; index < length; index++ ) {
		if ( ( tween = collection[ index ].call( animation, prop, value ) ) ) {

			// We're done with this property
			return tween;
		}
	}
}

function defaultPrefilter( elem, props, opts ) {
	var prop, value, toggle, hooks, oldfire, propTween, restoreDisplay, display,
		isBox = "width" in props || "height" in props,
		anim = this,
		orig = {},
		style = elem.style,
		hidden = elem.nodeType && isHiddenWithinTree( elem ),
		dataShow = dataPriv.get( elem, "fxshow" );

	// Queue-skipping animations hijack the fx hooks
	if ( !opts.queue ) {
		hooks = jQuery._queueHooks( elem, "fx" );
		if ( hooks.unqueued == null ) {
			hooks.unqueued = 0;
			oldfire = hooks.empty.fire;
			hooks.empty.fire = function() {
				if ( !hooks.unqueued ) {
					oldfire();
				}
			};
		}
		hooks.unqueued++;

		anim.always( function() {

			// Ensure the complete handler is called before this completes
			anim.always( function() {
				hooks.unqueued--;
				if ( !jQuery.queue( elem, "fx" ).length ) {
					hooks.empty.fire();
				}
			} );
		} );
	}

	// Detect show/hide animations
	for ( prop in props ) {
		value = props[ prop ];
		if ( rfxtypes.test( value ) ) {
			delete props[ prop ];
			toggle = toggle || value === "toggle";
			if ( value === ( hidden ? "hide" : "show" ) ) {

				// Pretend to be hidden if this is a "show" and
				// there is still data from a stopped show/hide
				if ( value === "show" && dataShow && dataShow[ prop ] !== undefined ) {
					hidden = true;

				// Ignore all other no-op show/hide data
				} else {
					continue;
				}
			}
			orig[ prop ] = dataShow && dataShow[ prop ] || jQuery.style( elem, prop );
		}
	}

	// Bail out if this is a no-op like .hide().hide()
	propTween = !jQuery.isEmptyObject( props );
	if ( !propTween && jQuery.isEmptyObject( orig ) ) {
		return;
	}

	// Restrict "overflow" and "display" styles during box animations
	if ( isBox && elem.nodeType === 1 ) {

		// Support: IE <=9 - 11, Edge 12 - 15
		// Record all 3 overflow attributes because IE does not infer the shorthand
		// from identically-valued overflowX and overflowY and Edge just mirrors
		// the overflowX value there.
		opts.overflow = [ style.overflow, style.overflowX, style.overflowY ];

		// Identify a display type, preferring old show/hide data over the CSS cascade
		restoreDisplay = dataShow && dataShow.display;
		if ( restoreDisplay == null ) {
			restoreDisplay = dataPriv.get( elem, "display" );
		}
		display = jQuery.css( elem, "display" );
		if ( display === "none" ) {
			if ( restoreDisplay ) {
				display = restoreDisplay;
			} else {

				// Get nonempty value(s) by temporarily forcing visibility
				showHide( [ elem ], true );
				restoreDisplay = elem.style.display || restoreDisplay;
				display = jQuery.css( elem, "display" );
				showHide( [ elem ] );
			}
		}

		// Animate inline elements as inline-block
		if ( display === "inline" || display === "inline-block" && restoreDisplay != null ) {
			if ( jQuery.css( elem, "float" ) === "none" ) {

				// Restore the original display value at the end of pure show/hide animations
				if ( !propTween ) {
					anim.done( function() {
						style.display = restoreDisplay;
					} );
					if ( restoreDisplay == null ) {
						display = style.display;
						restoreDisplay = display === "none" ? "" : display;
					}
				}
				style.display = "inline-block";
			}
		}
	}

	if ( opts.overflow ) {
		style.overflow = "hidden";
		anim.always( function() {
			style.overflow = opts.overflow[ 0 ];
			style.overflowX = opts.overflow[ 1 ];
			style.overflowY = opts.overflow[ 2 ];
		} );
	}

	// Implement show/hide animations
	propTween = false;
	for ( prop in orig ) {

		// General show/hide setup for this element animation
		if ( !propTween ) {
			if ( dataShow ) {
				if ( "hidden" in dataShow ) {
					hidden = dataShow.hidden;
				}
			} else {
				dataShow = dataPriv.access( elem, "fxshow", { display: restoreDisplay } );
			}

			// Store hidden/visible for toggle so `.stop().toggle()` "reverses"
			if ( toggle ) {
				dataShow.hidden = !hidden;
			}

			// Show elements before animating them
			if ( hidden ) {
				showHide( [ elem ], true );
			}

			/* eslint-disable no-loop-func */

			anim.done( function() {

			/* eslint-enable no-loop-func */

				// The final step of a "hide" animation is actually hiding the element
				if ( !hidden ) {
					showHide( [ elem ] );
				}
				dataPriv.remove( elem, "fxshow" );
				for ( prop in orig ) {
					jQuery.style( elem, prop, orig[ prop ] );
				}
			} );
		}

		// Per-property setup
		propTween = createTween( hidden ? dataShow[ prop ] : 0, prop, anim );
		if ( !( prop in dataShow ) ) {
			dataShow[ prop ] = propTween.start;
			if ( hidden ) {
				propTween.end = propTween.start;
				propTween.start = 0;
			}
		}
	}
}

function propFilter( props, specialEasing ) {
	var index, name, easing, value, hooks;

	// camelCase, specialEasing and expand cssHook pass
	for ( index in props ) {
		name = camelCase( index );
		easing = specialEasing[ name ];
		value = props[ index ];
		if ( Array.isArray( value ) ) {
			easing = value[ 1 ];
			value = props[ index ] = value[ 0 ];
		}

		if ( index !== name ) {
			props[ name ] = value;
			delete props[ index ];
		}

		hooks = jQuery.cssHooks[ name ];
		if ( hooks && "expand" in hooks ) {
			value = hooks.expand( value );
			delete props[ name ];

			// Not quite $.extend, this won't overwrite existing keys.
			// Reusing 'index' because we have the correct "name"
			for ( index in value ) {
				if ( !( index in props ) ) {
					props[ index ] = value[ index ];
					specialEasing[ index ] = easing;
				}
			}
		} else {
			specialEasing[ name ] = easing;
		}
	}
}

function Animation( elem, properties, options ) {
	var result,
		stopped,
		index = 0,
		length = Animation.prefilters.length,
		deferred = jQuery.Deferred().always( function() {

			// Don't match elem in the :animated selector
			delete tick.elem;
		} ),
		tick = function() {
			if ( stopped ) {
				return false;
			}
			var currentTime = fxNow || createFxNow(),
				remaining = Math.max( 0, animation.startTime + animation.duration - currentTime ),

				// Support: Android 2.3 only
				// Archaic crash bug won't allow us to use `1 - ( 0.5 || 0 )` (#12497)
				temp = remaining / animation.duration || 0,
				percent = 1 - temp,
				index = 0,
				length = animation.tweens.length;

			for ( ; index < length; index++ ) {
				animation.tweens[ index ].run( percent );
			}

			deferred.notifyWith( elem, [ animation, percent, remaining ] );

			// If there's more to do, yield
			if ( percent < 1 && length ) {
				return remaining;
			}

			// If this was an empty animation, synthesize a final progress notification
			if ( !length ) {
				deferred.notifyWith( elem, [ animation, 1, 0 ] );
			}

			// Resolve the animation and report its conclusion
			deferred.resolveWith( elem, [ animation ] );
			return false;
		},
		animation = deferred.promise( {
			elem: elem,
			props: jQuery.extend( {}, properties ),
			opts: jQuery.extend( true, {
				specialEasing: {},
				easing: jQuery.easing._default
			}, options ),
			originalProperties: properties,
			originalOptions: options,
			startTime: fxNow || createFxNow(),
			duration: options.duration,
			tweens: [],
			createTween: function( prop, end ) {
				var tween = jQuery.Tween( elem, animation.opts, prop, end,
						animation.opts.specialEasing[ prop ] || animation.opts.easing );
				animation.tweens.push( tween );
				return tween;
			},
			stop: function( gotoEnd ) {
				var index = 0,

					// If we are going to the end, we want to run all the tweens
					// otherwise we skip this part
					length = gotoEnd ? animation.tweens.length : 0;
				if ( stopped ) {
					return this;
				}
				stopped = true;
				for ( ; index < length; index++ ) {
					animation.tweens[ index ].run( 1 );
				}

				// Resolve when we played the last frame; otherwise, reject
				if ( gotoEnd ) {
					deferred.notifyWith( elem, [ animation, 1, 0 ] );
					deferred.resolveWith( elem, [ animation, gotoEnd ] );
				} else {
					deferred.rejectWith( elem, [ animation, gotoEnd ] );
				}
				return this;
			}
		} ),
		props = animation.props;

	propFilter( props, animation.opts.specialEasing );

	for ( ; index < length; index++ ) {
		result = Animation.prefilters[ index ].call( animation, elem, props, animation.opts );
		if ( result ) {
			if ( isFunction( result.stop ) ) {
				jQuery._queueHooks( animation.elem, animation.opts.queue ).stop =
					result.stop.bind( result );
			}
			return result;
		}
	}

	jQuery.map( props, createTween, animation );

	if ( isFunction( animation.opts.start ) ) {
		animation.opts.start.call( elem, animation );
	}

	// Attach callbacks from options
	animation
		.progress( animation.opts.progress )
		.done( animation.opts.done, animation.opts.complete )
		.fail( animation.opts.fail )
		.always( animation.opts.always );

	jQuery.fx.timer(
		jQuery.extend( tick, {
			elem: elem,
			anim: animation,
			queue: animation.opts.queue
		} )
	);

	return animation;
}

jQuery.Animation = jQuery.extend( Animation, {

	tweeners: {
		"*": [ function( prop, value ) {
			var tween = this.createTween( prop, value );
			adjustCSS( tween.elem, prop, rcssNum.exec( value ), tween );
			return tween;
		} ]
	},

	tweener: function( props, callback ) {
		if ( isFunction( props ) ) {
			callback = props;
			props = [ "*" ];
		} else {
			props = props.match( rnothtmlwhite );
		}

		var prop,
			index = 0,
			length = props.length;

		for ( ; index < length; index++ ) {
			prop = props[ index ];
			Animation.tweeners[ prop ] = Animation.tweeners[ prop ] || [];
			Animation.tweeners[ prop ].unshift( callback );
		}
	},

	prefilters: [ defaultPrefilter ],

	prefilter: function( callback, prepend ) {
		if ( prepend ) {
			Animation.prefilters.unshift( callback );
		} else {
			Animation.prefilters.push( callback );
		}
	}
} );

jQuery.speed = function( speed, easing, fn ) {
	var opt = speed && typeof speed === "object" ? jQuery.extend( {}, speed ) : {
		complete: fn || !fn && easing ||
			isFunction( speed ) && speed,
		duration: speed,
		easing: fn && easing || easing && !isFunction( easing ) && easing
	};

	// Go to the end state if fx are off
	if ( jQuery.fx.off ) {
		opt.duration = 0;

	} else {
		if ( typeof opt.duration !== "number" ) {
			if ( opt.duration in jQuery.fx.speeds ) {
				opt.duration = jQuery.fx.speeds[ opt.duration ];

			} else {
				opt.duration = jQuery.fx.speeds._default;
			}
		}
	}

	// Normalize opt.queue - true/undefined/null -> "fx"
	if ( opt.queue == null || opt.queue === true ) {
		opt.queue = "fx";
	}

	// Queueing
	opt.old = opt.complete;

	opt.complete = function() {
		if ( isFunction( opt.old ) ) {
			opt.old.call( this );
		}

		if ( opt.queue ) {
			jQuery.dequeue( this, opt.queue );
		}
	};

	return opt;
};

jQuery.fn.extend( {
	fadeTo: function( speed, to, easing, callback ) {

		// Show any hidden elements after setting opacity to 0
		return this.filter( isHiddenWithinTree ).css( "opacity", 0 ).show()

			// Animate to the value specified
			.end().animate( { opacity: to }, speed, easing, callback );
	},
	animate: function( prop, speed, easing, callback ) {
		var empty = jQuery.isEmptyObject( prop ),
			optall = jQuery.speed( speed, easing, callback ),
			doAnimation = function() {

				// Operate on a copy of prop so per-property easing won't be lost
				var anim = Animation( this, jQuery.extend( {}, prop ), optall );

				// Empty animations, or finishing resolves immediately
				if ( empty || dataPriv.get( this, "finish" ) ) {
					anim.stop( true );
				}
			};
			doAnimation.finish = doAnimation;

		return empty || optall.queue === false ?
			this.each( doAnimation ) :
			this.queue( optall.queue, doAnimation );
	},
	stop: function( type, clearQueue, gotoEnd ) {
		var stopQueue = function( hooks ) {
			var stop = hooks.stop;
			delete hooks.stop;
			stop( gotoEnd );
		};

		if ( typeof type !== "string" ) {
			gotoEnd = clearQueue;
			clearQueue = type;
			type = undefined;
		}
		if ( clearQueue ) {
			this.queue( type || "fx", [] );
		}

		return this.each( function() {
			var dequeue = true,
				index = type != null && type + "queueHooks",
				timers = jQuery.timers,
				data = dataPriv.get( this );

			if ( index ) {
				if ( data[ index ] && data[ index ].stop ) {
					stopQueue( data[ index ] );
				}
			} else {
				for ( index in data ) {
					if ( data[ index ] && data[ index ].stop && rrun.test( index ) ) {
						stopQueue( data[ index ] );
					}
				}
			}

			for ( index = timers.length; index--; ) {
				if ( timers[ index ].elem === this &&
					( type == null || timers[ index ].queue === type ) ) {

					timers[ index ].anim.stop( gotoEnd );
					dequeue = false;
					timers.splice( index, 1 );
				}
			}

			// Start the next in the queue if the last step wasn't forced.
			// Timers currently will call their complete callbacks, which
			// will dequeue but only if they were gotoEnd.
			if ( dequeue || !gotoEnd ) {
				jQuery.dequeue( this, type );
			}
		} );
	},
	finish: function( type ) {
		if ( type !== false ) {
			type = type || "fx";
		}
		return this.each( function() {
			var index,
				data = dataPriv.get( this ),
				queue = data[ type + "queue" ],
				hooks = data[ type + "queueHooks" ],
				timers = jQuery.timers,
				length = queue ? queue.length : 0;

			// Enable finishing flag on private data
			data.finish = true;

			// Empty the queue first
			jQuery.queue( this, type, [] );

			if ( hooks && hooks.stop ) {
				hooks.stop.call( this, true );
			}

			// Look for any active animations, and finish them
			for ( index = timers.length; index--; ) {
				if ( timers[ index ].elem === this && timers[ index ].queue === type ) {
					timers[ index ].anim.stop( true );
					timers.splice( index, 1 );
				}
			}

			// Look for any animations in the old queue and finish them
			for ( index = 0; index < length; index++ ) {
				if ( queue[ index ] && queue[ index ].finish ) {
					queue[ index ].finish.call( this );
				}
			}

			// Turn off finishing flag
			delete data.finish;
		} );
	}
} );

jQuery.each( [ "toggle", "show", "hide" ], function( _i, name ) {
	var cssFn = jQuery.fn[ name ];
	jQuery.fn[ name ] = function( speed, easing, callback ) {
		return speed == null || typeof speed === "boolean" ?
			cssFn.apply( this, arguments ) :
			this.animate( genFx( name, true ), speed, easing, callback );
	};
} );

// Generate shortcuts for custom animations
jQuery.each( {
	slideDown: genFx( "show" ),
	slideUp: genFx( "hide" ),
	slideToggle: genFx( "toggle" ),
	fadeIn: { opacity: "show" },
	fadeOut: { opacity: "hide" },
	fadeToggle: { opacity: "toggle" }
}, function( name, props ) {
	jQuery.fn[ name ] = function( speed, easing, callback ) {
		return this.animate( props, speed, easing, callback );
	};
} );

jQuery.timers = [];
jQuery.fx.tick = function() {
	var timer,
		i = 0,
		timers = jQuery.timers;

	fxNow = Date.now();

	for ( ; i < timers.length; i++ ) {
		timer = timers[ i ];

		// Run the timer and safely remove it when done (allowing for external removal)
		if ( !timer() && timers[ i ] === timer ) {
			timers.splice( i--, 1 );
		}
	}

	if ( !timers.length ) {
		jQuery.fx.stop();
	}
	fxNow = undefined;
};

jQuery.fx.timer = function( timer ) {
	jQuery.timers.push( timer );
	jQuery.fx.start();
};

jQuery.fx.interval = 13;
jQuery.fx.start = function() {
	if ( inProgress ) {
		return;
	}

	inProgress = true;
	schedule();
};

jQuery.fx.stop = function() {
	inProgress = null;
};

jQuery.fx.speeds = {
	slow: 600,
	fast: 200,

	// Default speed
	_default: 400
};


// Based off of the plugin by Clint Helfers, with permission.
// https://web.archive.org/web/20100324014747/http://blindsignals.com/index.php/2009/07/jquery-delay/
jQuery.fn.delay = function( time, type ) {
	time = jQuery.fx ? jQuery.fx.speeds[ time ] || time : time;
	type = type || "fx";

	return this.queue( type, function( next, hooks ) {
		var timeout = window.setTimeout( next, time );
		hooks.stop = function() {
			window.clearTimeout( timeout );
		};
	} );
};


( function() {
	var input = document.createElement( "input" ),
		select = document.createElement( "select" ),
		opt = select.appendChild( document.createElement( "option" ) );

	input.type = "checkbox";

	// Support: Android <=4.3 only
	// Default value for a checkbox should be "on"
	support.checkOn = input.value !== "";

	// Support: IE <=11 only
	// Must access selectedIndex to make default options select
	support.optSelected = opt.selected;

	// Support: IE <=11 only
	// An input loses its value after becoming a radio
	input = document.createElement( "input" );
	input.value = "t";
	input.type = "radio";
	support.radioValue = input.value === "t";
} )();


var boolHook,
	attrHandle = jQuery.expr.attrHandle;

jQuery.fn.extend( {
	attr: function( name, value ) {
		return access( this, jQuery.attr, name, value, arguments.length > 1 );
	},

	removeAttr: function( name ) {
		return this.each( function() {
			jQuery.removeAttr( this, name );
		} );
	}
} );

jQuery.extend( {
	attr: function( elem, name, value ) {
		var ret, hooks,
			nType = elem.nodeType;

		// Don't get/set attributes on text, comment and attribute nodes
		if ( nType === 3 || nType === 8 || nType === 2 ) {
			return;
		}

		// Fallback to prop when attributes are not supported
		if ( typeof elem.getAttribute === "undefined" ) {
			return jQuery.prop( elem, name, value );
		}

		// Attribute hooks are determined by the lowercase version
		// Grab necessary hook if one is defined
		if ( nType !== 1 || !jQuery.isXMLDoc( elem ) ) {
			hooks = jQuery.attrHooks[ name.toLowerCase() ] ||
				( jQuery.expr.match.bool.test( name ) ? boolHook : undefined );
		}

		if ( value !== undefined ) {
			if ( value === null ) {
				jQuery.removeAttr( elem, name );
				return;
			}

			if ( hooks && "set" in hooks &&
				( ret = hooks.set( elem, value, name ) ) !== undefined ) {
				return ret;
			}

			elem.setAttribute( name, value + "" );
			return value;
		}

		if ( hooks && "get" in hooks && ( ret = hooks.get( elem, name ) ) !== null ) {
			return ret;
		}

		ret = jQuery.find.attr( elem, name );

		// Non-existent attributes return null, we normalize to undefined
		return ret == null ? undefined : ret;
	},

	attrHooks: {
		type: {
			set: function( elem, value ) {
				if ( !support.radioValue && value === "radio" &&
					nodeName( elem, "input" ) ) {
					var val = elem.value;
					elem.setAttribute( "type", value );
					if ( val ) {
						elem.value = val;
					}
					return value;
				}
			}
		}
	},

	removeAttr: function( elem, value ) {
		var name,
			i = 0,

			// Attribute names can contain non-HTML whitespace characters
			// https://html.spec.whatwg.org/multipage/syntax.html#attributes-2
			attrNames = value && value.match( rnothtmlwhite );

		if ( attrNames && elem.nodeType === 1 ) {
			while ( ( name = attrNames[ i++ ] ) ) {
				elem.removeAttribute( name );
			}
		}
	}
} );

// Hooks for boolean attributes
boolHook = {
	set: function( elem, value, name ) {
		if ( value === false ) {

			// Remove boolean attributes when set to false
			jQuery.removeAttr( elem, name );
		} else {
			elem.setAttribute( name, name );
		}
		return name;
	}
};

jQuery.each( jQuery.expr.match.bool.source.match( /\w+/g ), function( _i, name ) {
	var getter = attrHandle[ name ] || jQuery.find.attr;

	attrHandle[ name ] = function( elem, name, isXML ) {
		var ret, handle,
			lowercaseName = name.toLowerCase();

		if ( !isXML ) {

			// Avoid an infinite loop by temporarily removing this function from the getter
			handle = attrHandle[ lowercaseName ];
			attrHandle[ lowercaseName ] = ret;
			ret = getter( elem, name, isXML ) != null ?
				lowercaseName :
				null;
			attrHandle[ lowercaseName ] = handle;
		}
		return ret;
	};
} );




var rfocusable = /^(?:input|select|textarea|button)$/i,
	rclickable = /^(?:a|area)$/i;

jQuery.fn.extend( {
	prop: function( name, value ) {
		return access( this, jQuery.prop, name, value, arguments.length > 1 );
	},

	removeProp: function( name ) {
		return this.each( function() {
			delete this[ jQuery.propFix[ name ] || name ];
		} );
	}
} );

jQuery.extend( {
	prop: function( elem, name, value ) {
		var ret, hooks,
			nType = elem.nodeType;

		// Don't get/set properties on text, comment and attribute nodes
		if ( nType === 3 || nType === 8 || nType === 2 ) {
			return;
		}

		if ( nType !== 1 || !jQuery.isXMLDoc( elem ) ) {

			// Fix name and attach hooks
			name = jQuery.propFix[ name ] || name;
			hooks = jQuery.propHooks[ name ];
		}

		if ( value !== undefined ) {
			if ( hooks && "set" in hooks &&
				( ret = hooks.set( elem, value, name ) ) !== undefined ) {
				return ret;
			}

			return ( elem[ name ] = value );
		}

		if ( hooks && "get" in hooks && ( ret = hooks.get( elem, name ) ) !== null ) {
			return ret;
		}

		return elem[ name ];
	},

	propHooks: {
		tabIndex: {
			get: function( elem ) {

				// Support: IE <=9 - 11 only
				// elem.tabIndex doesn't always return the
				// correct value when it hasn't been explicitly set
				// https://web.archive.org/web/20141116233347/http://fluidproject.org/blog/2008/01/09/getting-setting-and-removing-tabindex-values-with-javascript/
				// Use proper attribute retrieval(#12072)
				var tabindex = jQuery.find.attr( elem, "tabindex" );

				if ( tabindex ) {
					return parseInt( tabindex, 10 );
				}

				if (
					rfocusable.test( elem.nodeName ) ||
					rclickable.test( elem.nodeName ) &&
					elem.href
				) {
					return 0;
				}

				return -1;
			}
		}
	},

	propFix: {
		"for": "htmlFor",
		"class": "className"
	}
} );

// Support: IE <=11 only
// Accessing the selectedIndex property
// forces the browser to respect setting selected
// on the option
// The getter ensures a default option is selected
// when in an optgroup
// eslint rule "no-unused-expressions" is disabled for this code
// since it considers such accessions noop
if ( !support.optSelected ) {
	jQuery.propHooks.selected = {
		get: function( elem ) {

			/* eslint no-unused-expressions: "off" */

			var parent = elem.parentNode;
			if ( parent && parent.parentNode ) {
				parent.parentNode.selectedIndex;
			}
			return null;
		},
		set: function( elem ) {

			/* eslint no-unused-expressions: "off" */

			var parent = elem.parentNode;
			if ( parent ) {
				parent.selectedIndex;

				if ( parent.parentNode ) {
					parent.parentNode.selectedIndex;
				}
			}
		}
	};
}

jQuery.each( [
	"tabIndex",
	"readOnly",
	"maxLength",
	"cellSpacing",
	"cellPadding",
	"rowSpan",
	"colSpan",
	"useMap",
	"frameBorder",
	"contentEditable"
], function() {
	jQuery.propFix[ this.toLowerCase() ] = this;
} );




	// Strip and collapse whitespace according to HTML spec
	// https://infra.spec.whatwg.org/#strip-and-collapse-ascii-whitespace
	function stripAndCollapse( value ) {
		var tokens = value.match( rnothtmlwhite ) || [];
		return tokens.join( " " );
	}


function getClass( elem ) {
	return elem.getAttribute && elem.getAttribute( "class" ) || "";
}

function classesToArray( value ) {
	if ( Array.isArray( value ) ) {
		return value;
	}
	if ( typeof value === "string" ) {
		return value.match( rnothtmlwhite ) || [];
	}
	return [];
}

jQuery.fn.extend( {
	addClass: function( value ) {
		var classes, elem, cur, curValue, clazz, j, finalValue,
			i = 0;

		if ( isFunction( value ) ) {
			return this.each( function( j ) {
				jQuery( this ).addClass( value.call( this, j, getClass( this ) ) );
			} );
		}

		classes = classesToArray( value );

		if ( classes.length ) {
			while ( ( elem = this[ i++ ] ) ) {
				curValue = getClass( elem );
				cur = elem.nodeType === 1 && ( " " + stripAndCollapse( curValue ) + " " );

				if ( cur ) {
					j = 0;
					while ( ( clazz = classes[ j++ ] ) ) {
						if ( cur.indexOf( " " + clazz + " " ) < 0 ) {
							cur += clazz + " ";
						}
					}

					// Only assign if different to avoid unneeded rendering.
					finalValue = stripAndCollapse( cur );
					if ( curValue !== finalValue ) {
						elem.setAttribute( "class", finalValue );
					}
				}
			}
		}

		return this;
	},

	removeClass: function( value ) {
		var classes, elem, cur, curValue, clazz, j, finalValue,
			i = 0;

		if ( isFunction( value ) ) {
			return this.each( function( j ) {
				jQuery( this ).removeClass( value.call( this, j, getClass( this ) ) );
			} );
		}

		if ( !arguments.length ) {
			return this.attr( "class", "" );
		}

		classes = classesToArray( value );

		if ( classes.length ) {
			while ( ( elem = this[ i++ ] ) ) {
				curValue = getClass( elem );

				// This expression is here for better compressibility (see addClass)
				cur = elem.nodeType === 1 && ( " " + stripAndCollapse( curValue ) + " " );

				if ( cur ) {
					j = 0;
					while ( ( clazz = classes[ j++ ] ) ) {

						// Remove *all* instances
						while ( cur.indexOf( " " + clazz + " " ) > -1 ) {
							cur = cur.replace( " " + clazz + " ", " " );
						}
					}

					// Only assign if different to avoid unneeded rendering.
					finalValue = stripAndCollapse( cur );
					if ( curValue !== finalValue ) {
						elem.setAttribute( "class", finalValue );
					}
				}
			}
		}

		return this;
	},

	toggleClass: function( value, stateVal ) {
		var type = typeof value,
			isValidValue = type === "string" || Array.isArray( value );

		if ( typeof stateVal === "boolean" && isValidValue ) {
			return stateVal ? this.addClass( value ) : this.removeClass( value );
		}

		if ( isFunction( value ) ) {
			return this.each( function( i ) {
				jQuery( this ).toggleClass(
					value.call( this, i, getClass( this ), stateVal ),
					stateVal
				);
			} );
		}

		return this.each( function() {
			var className, i, self, classNames;

			if ( isValidValue ) {

				// Toggle individual class names
				i = 0;
				self = jQuery( this );
				classNames = classesToArray( value );

				while ( ( className = classNames[ i++ ] ) ) {

					// Check each className given, space separated list
					if ( self.hasClass( className ) ) {
						self.removeClass( className );
					} else {
						self.addClass( className );
					}
				}

			// Toggle whole class name
			} else if ( value === undefined || type === "boolean" ) {
				className = getClass( this );
				if ( className ) {

					// Store className if set
					dataPriv.set( this, "__className__", className );
				}

				// If the element has a class name or if we're passed `false`,
				// then remove the whole classname (if there was one, the above saved it).
				// Otherwise bring back whatever was previously saved (if anything),
				// falling back to the empty string if nothing was stored.
				if ( this.setAttribute ) {
					this.setAttribute( "class",
						className || value === false ?
						"" :
						dataPriv.get( this, "__className__" ) || ""
					);
				}
			}
		} );
	},

	hasClass: function( selector ) {
		var className, elem,
			i = 0;

		className = " " + selector + " ";
		while ( ( elem = this[ i++ ] ) ) {
			if ( elem.nodeType === 1 &&
				( " " + stripAndCollapse( getClass( elem ) ) + " " ).indexOf( className ) > -1 ) {
					return true;
			}
		}

		return false;
	}
} );




var rreturn = /\r/g;

jQuery.fn.extend( {
	val: function( value ) {
		var hooks, ret, valueIsFunction,
			elem = this[ 0 ];

		if ( !arguments.length ) {
			if ( elem ) {
				hooks = jQuery.valHooks[ elem.type ] ||
					jQuery.valHooks[ elem.nodeName.toLowerCase() ];

				if ( hooks &&
					"get" in hooks &&
					( ret = hooks.get( elem, "value" ) ) !== undefined
				) {
					return ret;
				}

				ret = elem.value;

				// Handle most common string cases
				if ( typeof ret === "string" ) {
					return ret.replace( rreturn, "" );
				}

				// Handle cases where value is null/undef or number
				return ret == null ? "" : ret;
			}

			return;
		}

		valueIsFunction = isFunction( value );

		return this.each( function( i ) {
			var val;

			if ( this.nodeType !== 1 ) {
				return;
			}

			if ( valueIsFunction ) {
				val = value.call( this, i, jQuery( this ).val() );
			} else {
				val = value;
			}

			// Treat null/undefined as ""; convert numbers to string
			if ( val == null ) {
				val = "";

			} else if ( typeof val === "number" ) {
				val += "";

			} else if ( Array.isArray( val ) ) {
				val = jQuery.map( val, function( value ) {
					return value == null ? "" : value + "";
				} );
			}

			hooks = jQuery.valHooks[ this.type ] || jQuery.valHooks[ this.nodeName.toLowerCase() ];

			// If set returns undefined, fall back to normal setting
			if ( !hooks || !( "set" in hooks ) || hooks.set( this, val, "value" ) === undefined ) {
				this.value = val;
			}
		} );
	}
} );

jQuery.extend( {
	valHooks: {
		option: {
			get: function( elem ) {

				var val = jQuery.find.attr( elem, "value" );
				return val != null ?
					val :

					// Support: IE <=10 - 11 only
					// option.text throws exceptions (#14686, #14858)
					// Strip and collapse whitespace
					// https://html.spec.whatwg.org/#strip-and-collapse-whitespace
					stripAndCollapse( jQuery.text( elem ) );
			}
		},
		select: {
			get: function( elem ) {
				var value, option, i,
					options = elem.options,
					index = elem.selectedIndex,
					one = elem.type === "select-one",
					values = one ? null : [],
					max = one ? index + 1 : options.length;

				if ( index < 0 ) {
					i = max;

				} else {
					i = one ? index : 0;
				}

				// Loop through all the selected options
				for ( ; i < max; i++ ) {
					option = options[ i ];

					// Support: IE <=9 only
					// IE8-9 doesn't update selected after form reset (#2551)
					if ( ( option.selected || i === index ) &&

							// Don't return options that are disabled or in a disabled optgroup
							!option.disabled &&
							( !option.parentNode.disabled ||
								!nodeName( option.parentNode, "optgroup" ) ) ) {

						// Get the specific value for the option
						value = jQuery( option ).val();

						// We don't need an array for one selects
						if ( one ) {
							return value;
						}

						// Multi-Selects return an array
						values.push( value );
					}
				}

				return values;
			},

			set: function( elem, value ) {
				var optionSet, option,
					options = elem.options,
					values = jQuery.makeArray( value ),
					i = options.length;

				while ( i-- ) {
					option = options[ i ];

					/* eslint-disable no-cond-assign */

					if ( option.selected =
						jQuery.inArray( jQuery.valHooks.option.get( option ), values ) > -1
					) {
						optionSet = true;
					}

					/* eslint-enable no-cond-assign */
				}

				// Force browsers to behave consistently when non-matching value is set
				if ( !optionSet ) {
					elem.selectedIndex = -1;
				}
				return values;
			}
		}
	}
} );

// Radios and checkboxes getter/setter
jQuery.each( [ "radio", "checkbox" ], function() {
	jQuery.valHooks[ this ] = {
		set: function( elem, value ) {
			if ( Array.isArray( value ) ) {
				return ( elem.checked = jQuery.inArray( jQuery( elem ).val(), value ) > -1 );
			}
		}
	};
	if ( !support.checkOn ) {
		jQuery.valHooks[ this ].get = function( elem ) {
			return elem.getAttribute( "value" ) === null ? "on" : elem.value;
		};
	}
} );




// Return jQuery for attributes-only inclusion


support.focusin = "onfocusin" in window;


var rfocusMorph = /^(?:focusinfocus|focusoutblur)$/,
	stopPropagationCallback = function( e ) {
		e.stopPropagation();
	};

jQuery.extend( jQuery.event, {

	trigger: function( event, data, elem, onlyHandlers ) {

		var i, cur, tmp, bubbleType, ontype, handle, special, lastElement,
			eventPath = [ elem || document ],
			type = hasOwn.call( event, "type" ) ? event.type : event,
			namespaces = hasOwn.call( event, "namespace" ) ? event.namespace.split( "." ) : [];

		cur = lastElement = tmp = elem = elem || document;

		// Don't do events on text and comment nodes
		if ( elem.nodeType === 3 || elem.nodeType === 8 ) {
			return;
		}

		// focus/blur morphs to focusin/out; ensure we're not firing them right now
		if ( rfocusMorph.test( type + jQuery.event.triggered ) ) {
			return;
		}

		if ( type.indexOf( "." ) > -1 ) {

			// Namespaced trigger; create a regexp to match event type in handle()
			namespaces = type.split( "." );
			type = namespaces.shift();
			namespaces.sort();
		}
		ontype = type.indexOf( ":" ) < 0 && "on" + type;

		// Caller can pass in a jQuery.Event object, Object, or just an event type string
		event = event[ jQuery.expando ] ?
			event :
			new jQuery.Event( type, typeof event === "object" && event );

		// Trigger bitmask: & 1 for native handlers; & 2 for jQuery (always true)
		event.isTrigger = onlyHandlers ? 2 : 3;
		event.namespace = namespaces.join( "." );
		event.rnamespace = event.namespace ?
			new RegExp( "(^|\\.)" + namespaces.join( "\\.(?:.*\\.|)" ) + "(\\.|$)" ) :
			null;

		// Clean up the event in case it is being reused
		event.result = undefined;
		if ( !event.target ) {
			event.target = elem;
		}

		// Clone any incoming data and prepend the event, creating the handler arg list
		data = data == null ?
			[ event ] :
			jQuery.makeArray( data, [ event ] );

		// Allow special events to draw outside the lines
		special = jQuery.event.special[ type ] || {};
		if ( !onlyHandlers && special.trigger && special.trigger.apply( elem, data ) === false ) {
			return;
		}

		// Determine event propagation path in advance, per W3C events spec (#9951)
		// Bubble up to document, then to window; watch for a global ownerDocument var (#9724)
		if ( !onlyHandlers && !special.noBubble && !isWindow( elem ) ) {

			bubbleType = special.delegateType || type;
			if ( !rfocusMorph.test( bubbleType + type ) ) {
				cur = cur.parentNode;
			}
			for ( ; cur; cur = cur.parentNode ) {
				eventPath.push( cur );
				tmp = cur;
			}

			// Only add window if we got to document (e.g., not plain obj or detached DOM)
			if ( tmp === ( elem.ownerDocument || document ) ) {
				eventPath.push( tmp.defaultView || tmp.parentWindow || window );
			}
		}

		// Fire handlers on the event path
		i = 0;
		while ( ( cur = eventPath[ i++ ] ) && !event.isPropagationStopped() ) {
			lastElement = cur;
			event.type = i > 1 ?
				bubbleType :
				special.bindType || type;

			// jQuery handler
			handle = (
					dataPriv.get( cur, "events" ) || Object.create( null )
				)[ event.type ] &&
				dataPriv.get( cur, "handle" );
			if ( handle ) {
				handle.apply( cur, data );
			}

			// Native handler
			handle = ontype && cur[ ontype ];
			if ( handle && handle.apply && acceptData( cur ) ) {
				event.result = handle.apply( cur, data );
				if ( event.result === false ) {
					event.preventDefault();
				}
			}
		}
		event.type = type;

		// If nobody prevented the default action, do it now
		if ( !onlyHandlers && !event.isDefaultPrevented() ) {

			if ( ( !special._default ||
				special._default.apply( eventPath.pop(), data ) === false ) &&
				acceptData( elem ) ) {

				// Call a native DOM method on the target with the same name as the event.
				// Don't do default actions on window, that's where global variables be (#6170)
				if ( ontype && isFunction( elem[ type ] ) && !isWindow( elem ) ) {

					// Don't re-trigger an onFOO event when we call its FOO() method
					tmp = elem[ ontype ];

					if ( tmp ) {
						elem[ ontype ] = null;
					}

					// Prevent re-triggering of the same event, since we already bubbled it above
					jQuery.event.triggered = type;

					if ( event.isPropagationStopped() ) {
						lastElement.addEventListener( type, stopPropagationCallback );
					}

					elem[ type ]();

					if ( event.isPropagationStopped() ) {
						lastElement.removeEventListener( type, stopPropagationCallback );
					}

					jQuery.event.triggered = undefined;

					if ( tmp ) {
						elem[ ontype ] = tmp;
					}
				}
			}
		}

		return event.result;
	},

	// Piggyback on a donor event to simulate a different one
	// Used only for `focus(in | out)` events
	simulate: function( type, elem, event ) {
		var e = jQuery.extend(
			new jQuery.Event(),
			event,
			{
				type: type,
				isSimulated: true
			}
		);

		jQuery.event.trigger( e, null, elem );
	}

} );

jQuery.fn.extend( {

	trigger: function( type, data ) {
		return this.each( function() {
			jQuery.event.trigger( type, data, this );
		} );
	},
	triggerHandler: function( type, data ) {
		var elem = this[ 0 ];
		if ( elem ) {
			return jQuery.event.trigger( type, data, elem, true );
		}
	}
} );


// Support: Firefox <=44
// Firefox doesn't have focus(in | out) events
// Related ticket - https://bugzilla.mozilla.org/show_bug.cgi?id=687787
//
// Support: Chrome <=48 - 49, Safari <=9.0 - 9.1
// focus(in | out) events fire after focus & blur events,
// which is spec violation - http://www.w3.org/TR/DOM-Level-3-Events/#events-focusevent-event-order
// Related ticket - https://bugs.chromium.org/p/chromium/issues/detail?id=449857
if ( !support.focusin ) {
	jQuery.each( { focus: "focusin", blur: "focusout" }, function( orig, fix ) {

		// Attach a single capturing handler on the document while someone wants focusin/focusout
		var handler = function( event ) {
			jQuery.event.simulate( fix, event.target, jQuery.event.fix( event ) );
		};

		jQuery.event.special[ fix ] = {
			setup: function() {

				// Handle: regular nodes (via `this.ownerDocument`), window
				// (via `this.document`) & document (via `this`).
				var doc = this.ownerDocument || this.document || this,
					attaches = dataPriv.access( doc, fix );

				if ( !attaches ) {
					doc.addEventListener( orig, handler, true );
				}
				dataPriv.access( doc, fix, ( attaches || 0 ) + 1 );
			},
			teardown: function() {
				var doc = this.ownerDocument || this.document || this,
					attaches = dataPriv.access( doc, fix ) - 1;

				if ( !attaches ) {
					doc.removeEventListener( orig, handler, true );
					dataPriv.remove( doc, fix );

				} else {
					dataPriv.access( doc, fix, attaches );
				}
			}
		};
	} );
}
var location = window.location;

var nonce = { guid: Date.now() };

var rquery = ( /\?/ );



// Cross-browser xml parsing
jQuery.parseXML = function( data ) {
	var xml;
	if ( !data || typeof data !== "string" ) {
		return null;
	}

	// Support: IE 9 - 11 only
	// IE throws on parseFromString with invalid input.
	try {
		xml = ( new window.DOMParser() ).parseFromString( data, "text/xml" );
	} catch ( e ) {
		xml = undefined;
	}

	if ( !xml || xml.getElementsByTagName( "parsererror" ).length ) {
		jQuery.error( "Invalid XML: " + data );
	}
	return xml;
};


var
	rbracket = /\[\]$/,
	rCRLF = /\r?\n/g,
	rsubmitterTypes = /^(?:submit|button|image|reset|file)$/i,
	rsubmittable = /^(?:input|select|textarea|keygen)/i;

function buildParams( prefix, obj, traditional, add ) {
	var name;

	if ( Array.isArray( obj ) ) {

		// Serialize array item.
		jQuery.each( obj, function( i, v ) {
			if ( traditional || rbracket.test( prefix ) ) {

				// Treat each array item as a scalar.
				add( prefix, v );

			} else {

				// Item is non-scalar (array or object), encode its numeric index.
				buildParams(
					prefix + "[" + ( typeof v === "object" && v != null ? i : "" ) + "]",
					v,
					traditional,
					add
				);
			}
		} );

	} else if ( !traditional && toType( obj ) === "object" ) {

		// Serialize object item.
		for ( name in obj ) {
			buildParams( prefix + "[" + name + "]", obj[ name ], traditional, add );
		}

	} else {

		// Serialize scalar item.
		add( prefix, obj );
	}
}

// Serialize an array of form elements or a set of
// key/values into a query string
jQuery.param = function( a, traditional ) {
	var prefix,
		s = [],
		add = function( key, valueOrFunction ) {

			// If value is a function, invoke it and use its return value
			var value = isFunction( valueOrFunction ) ?
				valueOrFunction() :
				valueOrFunction;

			s[ s.length ] = encodeURIComponent( key ) + "=" +
				encodeURIComponent( value == null ? "" : value );
		};

	if ( a == null ) {
		return "";
	}

	// If an array was passed in, assume that it is an array of form elements.
	if ( Array.isArray( a ) || ( a.jquery && !jQuery.isPlainObject( a ) ) ) {

		// Serialize the form elements
		jQuery.each( a, function() {
			add( this.name, this.value );
		} );

	} else {

		// If traditional, encode the "old" way (the way 1.3.2 or older
		// did it), otherwise encode params recursively.
		for ( prefix in a ) {
			buildParams( prefix, a[ prefix ], traditional, add );
		}
	}

	// Return the resulting serialization
	return s.join( "&" );
};

jQuery.fn.extend( {
	serialize: function() {
		return jQuery.param( this.serializeArray() );
	},
	serializeArray: function() {
		return this.map( function() {

			// Can add propHook for "elements" to filter or add form elements
			var elements = jQuery.prop( this, "elements" );
			return elements ? jQuery.makeArray( elements ) : this;
		} )
		.filter( function() {
			var type = this.type;

			// Use .is( ":disabled" ) so that fieldset[disabled] works
			return this.name && !jQuery( this ).is( ":disabled" ) &&
				rsubmittable.test( this.nodeName ) && !rsubmitterTypes.test( type ) &&
				( this.checked || !rcheckableType.test( type ) );
		} )
		.map( function( _i, elem ) {
			var val = jQuery( this ).val();

			if ( val == null ) {
				return null;
			}

			if ( Array.isArray( val ) ) {
				return jQuery.map( val, function( val ) {
					return { name: elem.name, value: val.replace( rCRLF, "\r\n" ) };
				} );
			}

			return { name: elem.name, value: val.replace( rCRLF, "\r\n" ) };
		} ).get();
	}
} );


var
	r20 = /%20/g,
	rhash = /#.*$/,
	rantiCache = /([?&])_=[^&]*/,
	rheaders = /^(.*?):[ \t]*([^\r\n]*)$/mg,

	// #7653, #8125, #8152: local protocol detection
	rlocalProtocol = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/,
	rnoContent = /^(?:GET|HEAD)$/,
	rprotocol = /^\/\//,

	/* Prefilters
	 * 1) They are useful to introduce custom dataTypes (see ajax/jsonp.js for an example)
	 * 2) These are called:
	 *    - BEFORE asking for a transport
	 *    - AFTER param serialization (s.data is a string if s.processData is true)
	 * 3) key is the dataType
	 * 4) the catchall symbol "*" can be used
	 * 5) execution will start with transport dataType and THEN continue down to "*" if needed
	 */
	prefilters = {},

	/* Transports bindings
	 * 1) key is the dataType
	 * 2) the catchall symbol "*" can be used
	 * 3) selection will start with transport dataType and THEN go to "*" if needed
	 */
	transports = {},

	// Avoid comment-prolog char sequence (#10098); must appease lint and evade compression
	allTypes = "*/".concat( "*" ),

	// Anchor tag for parsing the document origin
	originAnchor = document.createElement( "a" );
	originAnchor.href = location.href;

// Base "constructor" for jQuery.ajaxPrefilter and jQuery.ajaxTransport
function addToPrefiltersOrTransports( structure ) {

	// dataTypeExpression is optional and defaults to "*"
	return function( dataTypeExpression, func ) {

		if ( typeof dataTypeExpression !== "string" ) {
			func = dataTypeExpression;
			dataTypeExpression = "*";
		}

		var dataType,
			i = 0,
			dataTypes = dataTypeExpression.toLowerCase().match( rnothtmlwhite ) || [];

		if ( isFunction( func ) ) {

			// For each dataType in the dataTypeExpression
			while ( ( dataType = dataTypes[ i++ ] ) ) {

				// Prepend if requested
				if ( dataType[ 0 ] === "+" ) {
					dataType = dataType.slice( 1 ) || "*";
					( structure[ dataType ] = structure[ dataType ] || [] ).unshift( func );

				// Otherwise append
				} else {
					( structure[ dataType ] = structure[ dataType ] || [] ).push( func );
				}
			}
		}
	};
}

// Base inspection function for prefilters and transports
function inspectPrefiltersOrTransports( structure, options, originalOptions, jqXHR ) {

	var inspected = {},
		seekingTransport = ( structure === transports );

	function inspect( dataType ) {
		var selected;
		inspected[ dataType ] = true;
		jQuery.each( structure[ dataType ] || [], function( _, prefilterOrFactory ) {
			var dataTypeOrTransport = prefilterOrFactory( options, originalOptions, jqXHR );
			if ( typeof dataTypeOrTransport === "string" &&
				!seekingTransport && !inspected[ dataTypeOrTransport ] ) {

				options.dataTypes.unshift( dataTypeOrTransport );
				inspect( dataTypeOrTransport );
				return false;
			} else if ( seekingTransport ) {
				return !( selected = dataTypeOrTransport );
			}
		} );
		return selected;
	}

	return inspect( options.dataTypes[ 0 ] ) || !inspected[ "*" ] && inspect( "*" );
}

// A special extend for ajax options
// that takes "flat" options (not to be deep extended)
// Fixes #9887
function ajaxExtend( target, src ) {
	var key, deep,
		flatOptions = jQuery.ajaxSettings.flatOptions || {};

	for ( key in src ) {
		if ( src[ key ] !== undefined ) {
			( flatOptions[ key ] ? target : ( deep || ( deep = {} ) ) )[ key ] = src[ key ];
		}
	}
	if ( deep ) {
		jQuery.extend( true, target, deep );
	}

	return target;
}

/* Handles responses to an ajax request:
 * - finds the right dataType (mediates between content-type and expected dataType)
 * - returns the corresponding response
 */
function ajaxHandleResponses( s, jqXHR, responses ) {

	var ct, type, finalDataType, firstDataType,
		contents = s.contents,
		dataTypes = s.dataTypes;

	// Remove auto dataType and get content-type in the process
	while ( dataTypes[ 0 ] === "*" ) {
		dataTypes.shift();
		if ( ct === undefined ) {
			ct = s.mimeType || jqXHR.getResponseHeader( "Content-Type" );
		}
	}

	// Check if we're dealing with a known content-type
	if ( ct ) {
		for ( type in contents ) {
			if ( contents[ type ] && contents[ type ].test( ct ) ) {
				dataTypes.unshift( type );
				break;
			}
		}
	}

	// Check to see if we have a response for the expected dataType
	if ( dataTypes[ 0 ] in responses ) {
		finalDataType = dataTypes[ 0 ];
	} else {

		// Try convertible dataTypes
		for ( type in responses ) {
			if ( !dataTypes[ 0 ] || s.converters[ type + " " + dataTypes[ 0 ] ] ) {
				finalDataType = type;
				break;
			}
			if ( !firstDataType ) {
				firstDataType = type;
			}
		}

		// Or just use first one
		finalDataType = finalDataType || firstDataType;
	}

	// If we found a dataType
	// We add the dataType to the list if needed
	// and return the corresponding response
	if ( finalDataType ) {
		if ( finalDataType !== dataTypes[ 0 ] ) {
			dataTypes.unshift( finalDataType );
		}
		return responses[ finalDataType ];
	}
}

/* Chain conversions given the request and the original response
 * Also sets the responseXXX fields on the jqXHR instance
 */
function ajaxConvert( s, response, jqXHR, isSuccess ) {
	var conv2, current, conv, tmp, prev,
		converters = {},

		// Work with a copy of dataTypes in case we need to modify it for conversion
		dataTypes = s.dataTypes.slice();

	// Create converters map with lowercased keys
	if ( dataTypes[ 1 ] ) {
		for ( conv in s.converters ) {
			converters[ conv.toLowerCase() ] = s.converters[ conv ];
		}
	}

	current = dataTypes.shift();

	// Convert to each sequential dataType
	while ( current ) {

		if ( s.responseFields[ current ] ) {
			jqXHR[ s.responseFields[ current ] ] = response;
		}

		// Apply the dataFilter if provided
		if ( !prev && isSuccess && s.dataFilter ) {
			response = s.dataFilter( response, s.dataType );
		}

		prev = current;
		current = dataTypes.shift();

		if ( current ) {

			// There's only work to do if current dataType is non-auto
			if ( current === "*" ) {

				current = prev;

			// Convert response if prev dataType is non-auto and differs from current
			} else if ( prev !== "*" && prev !== current ) {

				// Seek a direct converter
				conv = converters[ prev + " " + current ] || converters[ "* " + current ];

				// If none found, seek a pair
				if ( !conv ) {
					for ( conv2 in converters ) {

						// If conv2 outputs current
						tmp = conv2.split( " " );
						if ( tmp[ 1 ] === current ) {

							// If prev can be converted to accepted input
							conv = converters[ prev + " " + tmp[ 0 ] ] ||
								converters[ "* " + tmp[ 0 ] ];
							if ( conv ) {

								// Condense equivalence converters
								if ( conv === true ) {
									conv = converters[ conv2 ];

								// Otherwise, insert the intermediate dataType
								} else if ( converters[ conv2 ] !== true ) {
									current = tmp[ 0 ];
									dataTypes.unshift( tmp[ 1 ] );
								}
								break;
							}
						}
					}
				}

				// Apply converter (if not an equivalence)
				if ( conv !== true ) {

					// Unless errors are allowed to bubble, catch and return them
					if ( conv && s.throws ) {
						response = conv( response );
					} else {
						try {
							response = conv( response );
						} catch ( e ) {
							return {
								state: "parsererror",
								error: conv ? e : "No conversion from " + prev + " to " + current
							};
						}
					}
				}
			}
		}
	}

	return { state: "success", data: response };
}

jQuery.extend( {

	// Counter for holding the number of active queries
	active: 0,

	// Last-Modified header cache for next request
	lastModified: {},
	etag: {},

	ajaxSettings: {
		url: location.href,
		type: "GET",
		isLocal: rlocalProtocol.test( location.protocol ),
		global: true,
		processData: true,
		async: true,
		contentType: "application/x-www-form-urlencoded; charset=UTF-8",

		/*
		timeout: 0,
		data: null,
		dataType: null,
		username: null,
		password: null,
		cache: null,
		throws: false,
		traditional: false,
		headers: {},
		*/

		accepts: {
			"*": allTypes,
			text: "text/plain",
			html: "text/html",
			xml: "application/xml, text/xml",
			json: "application/json, text/javascript"
		},

		contents: {
			xml: /\bxml\b/,
			html: /\bhtml/,
			json: /\bjson\b/
		},

		responseFields: {
			xml: "responseXML",
			text: "responseText",
			json: "responseJSON"
		},

		// Data converters
		// Keys separate source (or catchall "*") and destination types with a single space
		converters: {

			// Convert anything to text
			"* text": String,

			// Text to html (true = no transformation)
			"text html": true,

			// Evaluate text as a json expression
			"text json": JSON.parse,

			// Parse text as xml
			"text xml": jQuery.parseXML
		},

		// For options that shouldn't be deep extended:
		// you can add your own custom options here if
		// and when you create one that shouldn't be
		// deep extended (see ajaxExtend)
		flatOptions: {
			url: true,
			context: true
		}
	},

	// Creates a full fledged settings object into target
	// with both ajaxSettings and settings fields.
	// If target is omitted, writes into ajaxSettings.
	ajaxSetup: function( target, settings ) {
		return settings ?

			// Building a settings object
			ajaxExtend( ajaxExtend( target, jQuery.ajaxSettings ), settings ) :

			// Extending ajaxSettings
			ajaxExtend( jQuery.ajaxSettings, target );
	},

	ajaxPrefilter: addToPrefiltersOrTransports( prefilters ),
	ajaxTransport: addToPrefiltersOrTransports( transports ),

	// Main method
	ajax: function( url, options ) {

		// If url is an object, simulate pre-1.5 signature
		if ( typeof url === "object" ) {
			options = url;
			url = undefined;
		}

		// Force options to be an object
		options = options || {};

		var transport,

			// URL without anti-cache param
			cacheURL,

			// Response headers
			responseHeadersString,
			responseHeaders,

			// timeout handle
			timeoutTimer,

			// Url cleanup var
			urlAnchor,

			// Request state (becomes false upon send and true upon completion)
			completed,

			// To know if global events are to be dispatched
			fireGlobals,

			// Loop variable
			i,

			// uncached part of the url
			uncached,

			// Create the final options object
			s = jQuery.ajaxSetup( {}, options ),

			// Callbacks context
			callbackContext = s.context || s,

			// Context for global events is callbackContext if it is a DOM node or jQuery collection
			globalEventContext = s.context &&
				( callbackContext.nodeType || callbackContext.jquery ) ?
					jQuery( callbackContext ) :
					jQuery.event,

			// Deferreds
			deferred = jQuery.Deferred(),
			completeDeferred = jQuery.Callbacks( "once memory" ),

			// Status-dependent callbacks
			statusCode = s.statusCode || {},

			// Headers (they are sent all at once)
			requestHeaders = {},
			requestHeadersNames = {},

			// Default abort message
			strAbort = "canceled",

			// Fake xhr
			jqXHR = {
				readyState: 0,

				// Builds headers hashtable if needed
				getResponseHeader: function( key ) {
					var match;
					if ( completed ) {
						if ( !responseHeaders ) {
							responseHeaders = {};
							while ( ( match = rheaders.exec( responseHeadersString ) ) ) {
								responseHeaders[ match[ 1 ].toLowerCase() + " " ] =
									( responseHeaders[ match[ 1 ].toLowerCase() + " " ] || [] )
										.concat( match[ 2 ] );
							}
						}
						match = responseHeaders[ key.toLowerCase() + " " ];
					}
					return match == null ? null : match.join( ", " );
				},

				// Raw string
				getAllResponseHeaders: function() {
					return completed ? responseHeadersString : null;
				},

				// Caches the header
				setRequestHeader: function( name, value ) {
					if ( completed == null ) {
						name = requestHeadersNames[ name.toLowerCase() ] =
							requestHeadersNames[ name.toLowerCase() ] || name;
						requestHeaders[ name ] = value;
					}
					return this;
				},

				// Overrides response content-type header
				overrideMimeType: function( type ) {
					if ( completed == null ) {
						s.mimeType = type;
					}
					return this;
				},

				// Status-dependent callbacks
				statusCode: function( map ) {
					var code;
					if ( map ) {
						if ( completed ) {

							// Execute the appropriate callbacks
							jqXHR.always( map[ jqXHR.status ] );
						} else {

							// Lazy-add the new callbacks in a way that preserves old ones
							for ( code in map ) {
								statusCode[ code ] = [ statusCode[ code ], map[ code ] ];
							}
						}
					}
					return this;
				},

				// Cancel the request
				abort: function( statusText ) {
					var finalText = statusText || strAbort;
					if ( transport ) {
						transport.abort( finalText );
					}
					done( 0, finalText );
					return this;
				}
			};

		// Attach deferreds
		deferred.promise( jqXHR );

		// Add protocol if not provided (prefilters might expect it)
		// Handle falsy url in the settings object (#10093: consistency with old signature)
		// We also use the url parameter if available
		s.url = ( ( url || s.url || location.href ) + "" )
			.replace( rprotocol, location.protocol + "//" );

		// Alias method option to type as per ticket #12004
		s.type = options.method || options.type || s.method || s.type;

		// Extract dataTypes list
		s.dataTypes = ( s.dataType || "*" ).toLowerCase().match( rnothtmlwhite ) || [ "" ];

		// A cross-domain request is in order when the origin doesn't match the current origin.
		if ( s.crossDomain == null ) {
			urlAnchor = document.createElement( "a" );

			// Support: IE <=8 - 11, Edge 12 - 15
			// IE throws exception on accessing the href property if url is malformed,
			// e.g. http://example.com:80x/
			try {
				urlAnchor.href = s.url;

				// Support: IE <=8 - 11 only
				// Anchor's host property isn't correctly set when s.url is relative
				urlAnchor.href = urlAnchor.href;
				s.crossDomain = originAnchor.protocol + "//" + originAnchor.host !==
					urlAnchor.protocol + "//" + urlAnchor.host;
			} catch ( e ) {

				// If there is an error parsing the URL, assume it is crossDomain,
				// it can be rejected by the transport if it is invalid
				s.crossDomain = true;
			}
		}

		// Convert data if not already a string
		if ( s.data && s.processData && typeof s.data !== "string" ) {
			s.data = jQuery.param( s.data, s.traditional );
		}

		// Apply prefilters
		inspectPrefiltersOrTransports( prefilters, s, options, jqXHR );

		// If request was aborted inside a prefilter, stop there
		if ( completed ) {
			return jqXHR;
		}

		// We can fire global events as of now if asked to
		// Don't fire events if jQuery.event is undefined in an AMD-usage scenario (#15118)
		fireGlobals = jQuery.event && s.global;

		// Watch for a new set of requests
		if ( fireGlobals && jQuery.active++ === 0 ) {
			jQuery.event.trigger( "ajaxStart" );
		}

		// Uppercase the type
		s.type = s.type.toUpperCase();

		// Determine if request has content
		s.hasContent = !rnoContent.test( s.type );

		// Save the URL in case we're toying with the If-Modified-Since
		// and/or If-None-Match header later on
		// Remove hash to simplify url manipulation
		cacheURL = s.url.replace( rhash, "" );

		// More options handling for requests with no content
		if ( !s.hasContent ) {

			// Remember the hash so we can put it back
			uncached = s.url.slice( cacheURL.length );

			// If data is available and should be processed, append data to url
			if ( s.data && ( s.processData || typeof s.data === "string" ) ) {
				cacheURL += ( rquery.test( cacheURL ) ? "&" : "?" ) + s.data;

				// #9682: remove data so that it's not used in an eventual retry
				delete s.data;
			}

			// Add or update anti-cache param if needed
			if ( s.cache === false ) {
				cacheURL = cacheURL.replace( rantiCache, "$1" );
				uncached = ( rquery.test( cacheURL ) ? "&" : "?" ) + "_=" + ( nonce.guid++ ) +
					uncached;
			}

			// Put hash and anti-cache on the URL that will be requested (gh-1732)
			s.url = cacheURL + uncached;

		// Change '%20' to '+' if this is encoded form body content (gh-2658)
		} else if ( s.data && s.processData &&
			( s.contentType || "" ).indexOf( "application/x-www-form-urlencoded" ) === 0 ) {
			s.data = s.data.replace( r20, "+" );
		}

		// Set the If-Modified-Since and/or If-None-Match header, if in ifModified mode.
		if ( s.ifModified ) {
			if ( jQuery.lastModified[ cacheURL ] ) {
				jqXHR.setRequestHeader( "If-Modified-Since", jQuery.lastModified[ cacheURL ] );
			}
			if ( jQuery.etag[ cacheURL ] ) {
				jqXHR.setRequestHeader( "If-None-Match", jQuery.etag[ cacheURL ] );
			}
		}

		// Set the correct header, if data is being sent
		if ( s.data && s.hasContent && s.contentType !== false || options.contentType ) {
			jqXHR.setRequestHeader( "Content-Type", s.contentType );
		}

		// Set the Accepts header for the server, depending on the dataType
		jqXHR.setRequestHeader(
			"Accept",
			s.dataTypes[ 0 ] && s.accepts[ s.dataTypes[ 0 ] ] ?
				s.accepts[ s.dataTypes[ 0 ] ] +
					( s.dataTypes[ 0 ] !== "*" ? ", " + allTypes + "; q=0.01" : "" ) :
				s.accepts[ "*" ]
		);

		// Check for headers option
		for ( i in s.headers ) {
			jqXHR.setRequestHeader( i, s.headers[ i ] );
		}

		// Allow custom headers/mimetypes and early abort
		if ( s.beforeSend &&
			( s.beforeSend.call( callbackContext, jqXHR, s ) === false || completed ) ) {

			// Abort if not done already and return
			return jqXHR.abort();
		}

		// Aborting is no longer a cancellation
		strAbort = "abort";

		// Install callbacks on deferreds
		completeDeferred.add( s.complete );
		jqXHR.done( s.success );
		jqXHR.fail( s.error );

		// Get transport
		transport = inspectPrefiltersOrTransports( transports, s, options, jqXHR );

		// If no transport, we auto-abort
		if ( !transport ) {
			done( -1, "No Transport" );
		} else {
			jqXHR.readyState = 1;

			// Send global event
			if ( fireGlobals ) {
				globalEventContext.trigger( "ajaxSend", [ jqXHR, s ] );
			}

			// If request was aborted inside ajaxSend, stop there
			if ( completed ) {
				return jqXHR;
			}

			// Timeout
			if ( s.async && s.timeout > 0 ) {
				timeoutTimer = window.setTimeout( function() {
					jqXHR.abort( "timeout" );
				}, s.timeout );
			}

			try {
				completed = false;
				transport.send( requestHeaders, done );
			} catch ( e ) {

				// Rethrow post-completion exceptions
				if ( completed ) {
					throw e;
				}

				// Propagate others as results
				done( -1, e );
			}
		}

		// Callback for when everything is done
		function done( status, nativeStatusText, responses, headers ) {
			var isSuccess, success, error, response, modified,
				statusText = nativeStatusText;

			// Ignore repeat invocations
			if ( completed ) {
				return;
			}

			completed = true;

			// Clear timeout if it exists
			if ( timeoutTimer ) {
				window.clearTimeout( timeoutTimer );
			}

			// Dereference transport for early garbage collection
			// (no matter how long the jqXHR object will be used)
			transport = undefined;

			// Cache response headers
			responseHeadersString = headers || "";

			// Set readyState
			jqXHR.readyState = status > 0 ? 4 : 0;

			// Determine if successful
			isSuccess = status >= 200 && status < 300 || status === 304;

			// Get response data
			if ( responses ) {
				response = ajaxHandleResponses( s, jqXHR, responses );
			}

			// Use a noop converter for missing script
			if ( !isSuccess && jQuery.inArray( "script", s.dataTypes ) > -1 ) {
				s.converters[ "text script" ] = function() {};
			}

			// Convert no matter what (that way responseXXX fields are always set)
			response = ajaxConvert( s, response, jqXHR, isSuccess );

			// If successful, handle type chaining
			if ( isSuccess ) {

				// Set the If-Modified-Since and/or If-None-Match header, if in ifModified mode.
				if ( s.ifModified ) {
					modified = jqXHR.getResponseHeader( "Last-Modified" );
					if ( modified ) {
						jQuery.lastModified[ cacheURL ] = modified;
					}
					modified = jqXHR.getResponseHeader( "etag" );
					if ( modified ) {
						jQuery.etag[ cacheURL ] = modified;
					}
				}

				// if no content
				if ( status === 204 || s.type === "HEAD" ) {
					statusText = "nocontent";

				// if not modified
				} else if ( status === 304 ) {
					statusText = "notmodified";

				// If we have data, let's convert it
				} else {
					statusText = response.state;
					success = response.data;
					error = response.error;
					isSuccess = !error;
				}
			} else {

				// Extract error from statusText and normalize for non-aborts
				error = statusText;
				if ( status || !statusText ) {
					statusText = "error";
					if ( status < 0 ) {
						status = 0;
					}
				}
			}

			// Set data for the fake xhr object
			jqXHR.status = status;
			jqXHR.statusText = ( nativeStatusText || statusText ) + "";

			// Success/Error
			if ( isSuccess ) {
				deferred.resolveWith( callbackContext, [ success, statusText, jqXHR ] );
			} else {
				deferred.rejectWith( callbackContext, [ jqXHR, statusText, error ] );
			}

			// Status-dependent callbacks
			jqXHR.statusCode( statusCode );
			statusCode = undefined;

			if ( fireGlobals ) {
				globalEventContext.trigger( isSuccess ? "ajaxSuccess" : "ajaxError",
					[ jqXHR, s, isSuccess ? success : error ] );
			}

			// Complete
			completeDeferred.fireWith( callbackContext, [ jqXHR, statusText ] );

			if ( fireGlobals ) {
				globalEventContext.trigger( "ajaxComplete", [ jqXHR, s ] );

				// Handle the global AJAX counter
				if ( !( --jQuery.active ) ) {
					jQuery.event.trigger( "ajaxStop" );
				}
			}
		}

		return jqXHR;
	},

	getJSON: function( url, data, callback ) {
		return jQuery.get( url, data, callback, "json" );
	},

	getScript: function( url, callback ) {
		return jQuery.get( url, undefined, callback, "script" );
	}
} );

jQuery.each( [ "get", "post" ], function( _i, method ) {
	jQuery[ method ] = function( url, data, callback, type ) {

		// Shift arguments if data argument was omitted
		if ( isFunction( data ) ) {
			type = type || callback;
			callback = data;
			data = undefined;
		}

		// The url can be an options object (which then must have .url)
		return jQuery.ajax( jQuery.extend( {
			url: url,
			type: method,
			dataType: type,
			data: data,
			success: callback
		}, jQuery.isPlainObject( url ) && url ) );
	};
} );

jQuery.ajaxPrefilter( function( s ) {
	var i;
	for ( i in s.headers ) {
		if ( i.toLowerCase() === "content-type" ) {
			s.contentType = s.headers[ i ] || "";
		}
	}
} );


jQuery._evalUrl = function( url, options, doc ) {
	return jQuery.ajax( {
		url: url,

		// Make this explicit, since user can override this through ajaxSetup (#11264)
		type: "GET",
		dataType: "script",
		cache: true,
		async: false,
		global: false,

		// Only evaluate the response if it is successful (gh-4126)
		// dataFilter is not invoked for failure responses, so using it instead
		// of the default converter is kludgy but it works.
		converters: {
			"text script": function() {}
		},
		dataFilter: function( response ) {
			jQuery.globalEval( response, options, doc );
		}
	} );
};


jQuery.fn.extend( {
	wrapAll: function( html ) {
		var wrap;

		if ( this[ 0 ] ) {
			if ( isFunction( html ) ) {
				html = html.call( this[ 0 ] );
			}

			// The elements to wrap the target around
			wrap = jQuery( html, this[ 0 ].ownerDocument ).eq( 0 ).clone( true );

			if ( this[ 0 ].parentNode ) {
				wrap.insertBefore( this[ 0 ] );
			}

			wrap.map( function() {
				var elem = this;

				while ( elem.firstElementChild ) {
					elem = elem.firstElementChild;
				}

				return elem;
			} ).append( this );
		}

		return this;
	},

	wrapInner: function( html ) {
		if ( isFunction( html ) ) {
			return this.each( function( i ) {
				jQuery( this ).wrapInner( html.call( this, i ) );
			} );
		}

		return this.each( function() {
			var self = jQuery( this ),
				contents = self.contents();

			if ( contents.length ) {
				contents.wrapAll( html );

			} else {
				self.append( html );
			}
		} );
	},

	wrap: function( html ) {
		var htmlIsFunction = isFunction( html );

		return this.each( function( i ) {
			jQuery( this ).wrapAll( htmlIsFunction ? html.call( this, i ) : html );
		} );
	},

	unwrap: function( selector ) {
		this.parent( selector ).not( "body" ).each( function() {
			jQuery( this ).replaceWith( this.childNodes );
		} );
		return this;
	}
} );


jQuery.expr.pseudos.hidden = function( elem ) {
	return !jQuery.expr.pseudos.visible( elem );
};
jQuery.expr.pseudos.visible = function( elem ) {
	return !!( elem.offsetWidth || elem.offsetHeight || elem.getClientRects().length );
};




jQuery.ajaxSettings.xhr = function() {
	try {
		return new window.XMLHttpRequest();
	} catch ( e ) {}
};

var xhrSuccessStatus = {

		// File protocol always yields status code 0, assume 200
		0: 200,

		// Support: IE <=9 only
		// #1450: sometimes IE returns 1223 when it should be 204
		1223: 204
	},
	xhrSupported = jQuery.ajaxSettings.xhr();

support.cors = !!xhrSupported && ( "withCredentials" in xhrSupported );
support.ajax = xhrSupported = !!xhrSupported;

jQuery.ajaxTransport( function( options ) {
	var callback, errorCallback;

	// Cross domain only allowed if supported through XMLHttpRequest
	if ( support.cors || xhrSupported && !options.crossDomain ) {
		return {
			send: function( headers, complete ) {
				var i,
					xhr = options.xhr();

				xhr.open(
					options.type,
					options.url,
					options.async,
					options.username,
					options.password
				);

				// Apply custom fields if provided
				if ( options.xhrFields ) {
					for ( i in options.xhrFields ) {
						xhr[ i ] = options.xhrFields[ i ];
					}
				}

				// Override mime type if needed
				if ( options.mimeType && xhr.overrideMimeType ) {
					xhr.overrideMimeType( options.mimeType );
				}

				// X-Requested-With header
				// For cross-domain requests, seeing as conditions for a preflight are
				// akin to a jigsaw puzzle, we simply never set it to be sure.
				// (it can always be set on a per-request basis or even using ajaxSetup)
				// For same-domain requests, won't change header if already provided.
				if ( !options.crossDomain && !headers[ "X-Requested-With" ] ) {
					headers[ "X-Requested-With" ] = "XMLHttpRequest";
				}

				// Set headers
				for ( i in headers ) {
					xhr.setRequestHeader( i, headers[ i ] );
				}

				// Callback
				callback = function( type ) {
					return function() {
						if ( callback ) {
							callback = errorCallback = xhr.onload =
								xhr.onerror = xhr.onabort = xhr.ontimeout =
									xhr.onreadystatechange = null;

							if ( type === "abort" ) {
								xhr.abort();
							} else if ( type === "error" ) {

								// Support: IE <=9 only
								// On a manual native abort, IE9 throws
								// errors on any property access that is not readyState
								if ( typeof xhr.status !== "number" ) {
									complete( 0, "error" );
								} else {
									complete(

										// File: protocol always yields status 0; see #8605, #14207
										xhr.status,
										xhr.statusText
									);
								}
							} else {
								complete(
									xhrSuccessStatus[ xhr.status ] || xhr.status,
									xhr.statusText,

									// Support: IE <=9 only
									// IE9 has no XHR2 but throws on binary (trac-11426)
									// For XHR2 non-text, let the caller handle it (gh-2498)
									( xhr.responseType || "text" ) !== "text"  ||
									typeof xhr.responseText !== "string" ?
										{ binary: xhr.response } :
										{ text: xhr.responseText },
									xhr.getAllResponseHeaders()
								);
							}
						}
					};
				};

				// Listen to events
				xhr.onload = callback();
				errorCallback = xhr.onerror = xhr.ontimeout = callback( "error" );

				// Support: IE 9 only
				// Use onreadystatechange to replace onabort
				// to handle uncaught aborts
				if ( xhr.onabort !== undefined ) {
					xhr.onabort = errorCallback;
				} else {
					xhr.onreadystatechange = function() {

						// Check readyState before timeout as it changes
						if ( xhr.readyState === 4 ) {

							// Allow onerror to be called first,
							// but that will not handle a native abort
							// Also, save errorCallback to a variable
							// as xhr.onerror cannot be accessed
							window.setTimeout( function() {
								if ( callback ) {
									errorCallback();
								}
							} );
						}
					};
				}

				// Create the abort callback
				callback = callback( "abort" );

				try {

					// Do send the request (this may raise an exception)
					xhr.send( options.hasContent && options.data || null );
				} catch ( e ) {

					// #14683: Only rethrow if this hasn't been notified as an error yet
					if ( callback ) {
						throw e;
					}
				}
			},

			abort: function() {
				if ( callback ) {
					callback();
				}
			}
		};
	}
} );




// Prevent auto-execution of scripts when no explicit dataType was provided (See gh-2432)
jQuery.ajaxPrefilter( function( s ) {
	if ( s.crossDomain ) {
		s.contents.script = false;
	}
} );

// Install script dataType
jQuery.ajaxSetup( {
	accepts: {
		script: "text/javascript, application/javascript, " +
			"application/ecmascript, application/x-ecmascript"
	},
	contents: {
		script: /\b(?:java|ecma)script\b/
	},
	converters: {
		"text script": function( text ) {
			jQuery.globalEval( text );
			return text;
		}
	}
} );

// Handle cache's special case and crossDomain
jQuery.ajaxPrefilter( "script", function( s ) {
	if ( s.cache === undefined ) {
		s.cache = false;
	}
	if ( s.crossDomain ) {
		s.type = "GET";
	}
} );

// Bind script tag hack transport
jQuery.ajaxTransport( "script", function( s ) {

	// This transport only deals with cross domain or forced-by-attrs requests
	if ( s.crossDomain || s.scriptAttrs ) {
		var script, callback;
		return {
			send: function( _, complete ) {
				script = jQuery( "<script>" )
					.attr( s.scriptAttrs || {} )
					.prop( { charset: s.scriptCharset, src: s.url } )
					.on( "load error", callback = function( evt ) {
						script.remove();
						callback = null;
						if ( evt ) {
							complete( evt.type === "error" ? 404 : 200, evt.type );
						}
					} );

				// Use native DOM manipulation to avoid our domManip AJAX trickery
				document.head.appendChild( script[ 0 ] );
			},
			abort: function() {
				if ( callback ) {
					callback();
				}
			}
		};
	}
} );




var oldCallbacks = [],
	rjsonp = /(=)\?(?=&|$)|\?\?/;

// Default jsonp settings
jQuery.ajaxSetup( {
	jsonp: "callback",
	jsonpCallback: function() {
		var callback = oldCallbacks.pop() || ( jQuery.expando + "_" + ( nonce.guid++ ) );
		this[ callback ] = true;
		return callback;
	}
} );

// Detect, normalize options and install callbacks for jsonp requests
jQuery.ajaxPrefilter( "json jsonp", function( s, originalSettings, jqXHR ) {

	var callbackName, overwritten, responseContainer,
		jsonProp = s.jsonp !== false && ( rjsonp.test( s.url ) ?
			"url" :
			typeof s.data === "string" &&
				( s.contentType || "" )
					.indexOf( "application/x-www-form-urlencoded" ) === 0 &&
				rjsonp.test( s.data ) && "data"
		);

	// Handle iff the expected data type is "jsonp" or we have a parameter to set
	if ( jsonProp || s.dataTypes[ 0 ] === "jsonp" ) {

		// Get callback name, remembering preexisting value associated with it
		callbackName = s.jsonpCallback = isFunction( s.jsonpCallback ) ?
			s.jsonpCallback() :
			s.jsonpCallback;

		// Insert callback into url or form data
		if ( jsonProp ) {
			s[ jsonProp ] = s[ jsonProp ].replace( rjsonp, "$1" + callbackName );
		} else if ( s.jsonp !== false ) {
			s.url += ( rquery.test( s.url ) ? "&" : "?" ) + s.jsonp + "=" + callbackName;
		}

		// Use data converter to retrieve json after script execution
		s.converters[ "script json" ] = function() {
			if ( !responseContainer ) {
				jQuery.error( callbackName + " was not called" );
			}
			return responseContainer[ 0 ];
		};

		// Force json dataType
		s.dataTypes[ 0 ] = "json";

		// Install callback
		overwritten = window[ callbackName ];
		window[ callbackName ] = function() {
			responseContainer = arguments;
		};

		// Clean-up function (fires after converters)
		jqXHR.always( function() {

			// If previous value didn't exist - remove it
			if ( overwritten === undefined ) {
				jQuery( window ).removeProp( callbackName );

			// Otherwise restore preexisting value
			} else {
				window[ callbackName ] = overwritten;
			}

			// Save back as free
			if ( s[ callbackName ] ) {

				// Make sure that re-using the options doesn't screw things around
				s.jsonpCallback = originalSettings.jsonpCallback;

				// Save the callback name for future use
				oldCallbacks.push( callbackName );
			}

			// Call if it was a function and we have a response
			if ( responseContainer && isFunction( overwritten ) ) {
				overwritten( responseContainer[ 0 ] );
			}

			responseContainer = overwritten = undefined;
		} );

		// Delegate to script
		return "script";
	}
} );




// Support: Safari 8 only
// In Safari 8 documents created via document.implementation.createHTMLDocument
// collapse sibling forms: the second one becomes a child of the first one.
// Because of that, this security measure has to be disabled in Safari 8.
// https://bugs.webkit.org/show_bug.cgi?id=137337
support.createHTMLDocument = ( function() {
	var body = document.implementation.createHTMLDocument( "" ).body;
	body.innerHTML = "<form></form><form></form>";
	return body.childNodes.length === 2;
} )();


// Argument "data" should be string of html
// context (optional): If specified, the fragment will be created in this context,
// defaults to document
// keepScripts (optional): If true, will include scripts passed in the html string
jQuery.parseHTML = function( data, context, keepScripts ) {
	if ( typeof data !== "string" ) {
		return [];
	}
	if ( typeof context === "boolean" ) {
		keepScripts = context;
		context = false;
	}

	var base, parsed, scripts;

	if ( !context ) {

		// Stop scripts or inline event handlers from being executed immediately
		// by using document.implementation
		if ( support.createHTMLDocument ) {
			context = document.implementation.createHTMLDocument( "" );

			// Set the base href for the created document
			// so any parsed elements with URLs
			// are based on the document's URL (gh-2965)
			base = context.createElement( "base" );
			base.href = document.location.href;
			context.head.appendChild( base );
		} else {
			context = document;
		}
	}

	parsed = rsingleTag.exec( data );
	scripts = !keepScripts && [];

	// Single tag
	if ( parsed ) {
		return [ context.createElement( parsed[ 1 ] ) ];
	}

	parsed = buildFragment( [ data ], context, scripts );

	if ( scripts && scripts.length ) {
		jQuery( scripts ).remove();
	}

	return jQuery.merge( [], parsed.childNodes );
};


/**
 * Load a url into a page
 */
jQuery.fn.load = function( url, params, callback ) {
	var selector, type, response,
		self = this,
		off = url.indexOf( " " );

	if ( off > -1 ) {
		selector = stripAndCollapse( url.slice( off ) );
		url = url.slice( 0, off );
	}

	// If it's a function
	if ( isFunction( params ) ) {

		// We assume that it's the callback
		callback = params;
		params = undefined;

	// Otherwise, build a param string
	} else if ( params && typeof params === "object" ) {
		type = "POST";
	}

	// If we have elements to modify, make the request
	if ( self.length > 0 ) {
		jQuery.ajax( {
			url: url,

			// If "type" variable is undefined, then "GET" method will be used.
			// Make value of this field explicit since
			// user can override it through ajaxSetup method
			type: type || "GET",
			dataType: "html",
			data: params
		} ).done( function( responseText ) {

			// Save response for use in complete callback
			response = arguments;

			self.html( selector ?

				// If a selector was specified, locate the right elements in a dummy div
				// Exclude scripts to avoid IE 'Permission Denied' errors
				jQuery( "<div>" ).append( jQuery.parseHTML( responseText ) ).find( selector ) :

				// Otherwise use the full result
				responseText );

		// If the request succeeds, this function gets "data", "status", "jqXHR"
		// but they are ignored because response was set above.
		// If it fails, this function gets "jqXHR", "status", "error"
		} ).always( callback && function( jqXHR, status ) {
			self.each( function() {
				callback.apply( this, response || [ jqXHR.responseText, status, jqXHR ] );
			} );
		} );
	}

	return this;
};




jQuery.expr.pseudos.animated = function( elem ) {
	return jQuery.grep( jQuery.timers, function( fn ) {
		return elem === fn.elem;
	} ).length;
};




jQuery.offset = {
	setOffset: function( elem, options, i ) {
		var curPosition, curLeft, curCSSTop, curTop, curOffset, curCSSLeft, calculatePosition,
			position = jQuery.css( elem, "position" ),
			curElem = jQuery( elem ),
			props = {};

		// Set position first, in-case top/left are set even on static elem
		if ( position === "static" ) {
			elem.style.position = "relative";
		}

		curOffset = curElem.offset();
		curCSSTop = jQuery.css( elem, "top" );
		curCSSLeft = jQuery.css( elem, "left" );
		calculatePosition = ( position === "absolute" || position === "fixed" ) &&
			( curCSSTop + curCSSLeft ).indexOf( "auto" ) > -1;

		// Need to be able to calculate position if either
		// top or left is auto and position is either absolute or fixed
		if ( calculatePosition ) {
			curPosition = curElem.position();
			curTop = curPosition.top;
			curLeft = curPosition.left;

		} else {
			curTop = parseFloat( curCSSTop ) || 0;
			curLeft = parseFloat( curCSSLeft ) || 0;
		}

		if ( isFunction( options ) ) {

			// Use jQuery.extend here to allow modification of coordinates argument (gh-1848)
			options = options.call( elem, i, jQuery.extend( {}, curOffset ) );
		}

		if ( options.top != null ) {
			props.top = ( options.top - curOffset.top ) + curTop;
		}
		if ( options.left != null ) {
			props.left = ( options.left - curOffset.left ) + curLeft;
		}

		if ( "using" in options ) {
			options.using.call( elem, props );

		} else {
			if ( typeof props.top === "number" ) {
				props.top += "px";
			}
			if ( typeof props.left === "number" ) {
				props.left += "px";
			}
			curElem.css( props );
		}
	}
};

jQuery.fn.extend( {

	// offset() relates an element's border box to the document origin
	offset: function( options ) {

		// Preserve chaining for setter
		if ( arguments.length ) {
			return options === undefined ?
				this :
				this.each( function( i ) {
					jQuery.offset.setOffset( this, options, i );
				} );
		}

		var rect, win,
			elem = this[ 0 ];

		if ( !elem ) {
			return;
		}

		// Return zeros for disconnected and hidden (display: none) elements (gh-2310)
		// Support: IE <=11 only
		// Running getBoundingClientRect on a
		// disconnected node in IE throws an error
		if ( !elem.getClientRects().length ) {
			return { top: 0, left: 0 };
		}

		// Get document-relative position by adding viewport scroll to viewport-relative gBCR
		rect = elem.getBoundingClientRect();
		win = elem.ownerDocument.defaultView;
		return {
			top: rect.top + win.pageYOffset,
			left: rect.left + win.pageXOffset
		};
	},

	// position() relates an element's margin box to its offset parent's padding box
	// This corresponds to the behavior of CSS absolute positioning
	position: function() {
		if ( !this[ 0 ] ) {
			return;
		}

		var offsetParent, offset, doc,
			elem = this[ 0 ],
			parentOffset = { top: 0, left: 0 };

		// position:fixed elements are offset from the viewport, which itself always has zero offset
		if ( jQuery.css( elem, "position" ) === "fixed" ) {

			// Assume position:fixed implies availability of getBoundingClientRect
			offset = elem.getBoundingClientRect();

		} else {
			offset = this.offset();

			// Account for the *real* offset parent, which can be the document or its root element
			// when a statically positioned element is identified
			doc = elem.ownerDocument;
			offsetParent = elem.offsetParent || doc.documentElement;
			while ( offsetParent &&
				( offsetParent === doc.body || offsetParent === doc.documentElement ) &&
				jQuery.css( offsetParent, "position" ) === "static" ) {

				offsetParent = offsetParent.parentNode;
			}
			if ( offsetParent && offsetParent !== elem && offsetParent.nodeType === 1 ) {

				// Incorporate borders into its offset, since they are outside its content origin
				parentOffset = jQuery( offsetParent ).offset();
				parentOffset.top += jQuery.css( offsetParent, "borderTopWidth", true );
				parentOffset.left += jQuery.css( offsetParent, "borderLeftWidth", true );
			}
		}

		// Subtract parent offsets and element margins
		return {
			top: offset.top - parentOffset.top - jQuery.css( elem, "marginTop", true ),
			left: offset.left - parentOffset.left - jQuery.css( elem, "marginLeft", true )
		};
	},

	// This method will return documentElement in the following cases:
	// 1) For the element inside the iframe without offsetParent, this method will return
	//    documentElement of the parent window
	// 2) For the hidden or detached element
	// 3) For body or html element, i.e. in case of the html node - it will return itself
	//
	// but those exceptions were never presented as a real life use-cases
	// and might be considered as more preferable results.
	//
	// This logic, however, is not guaranteed and can change at any point in the future
	offsetParent: function() {
		return this.map( function() {
			var offsetParent = this.offsetParent;

			while ( offsetParent && jQuery.css( offsetParent, "position" ) === "static" ) {
				offsetParent = offsetParent.offsetParent;
			}

			return offsetParent || documentElement;
		} );
	}
} );

// Create scrollLeft and scrollTop methods
jQuery.each( { scrollLeft: "pageXOffset", scrollTop: "pageYOffset" }, function( method, prop ) {
	var top = "pageYOffset" === prop;

	jQuery.fn[ method ] = function( val ) {
		return access( this, function( elem, method, val ) {

			// Coalesce documents and windows
			var win;
			if ( isWindow( elem ) ) {
				win = elem;
			} else if ( elem.nodeType === 9 ) {
				win = elem.defaultView;
			}

			if ( val === undefined ) {
				return win ? win[ prop ] : elem[ method ];
			}

			if ( win ) {
				win.scrollTo(
					!top ? val : win.pageXOffset,
					top ? val : win.pageYOffset
				);

			} else {
				elem[ method ] = val;
			}
		}, method, val, arguments.length );
	};
} );

// Support: Safari <=7 - 9.1, Chrome <=37 - 49
// Add the top/left cssHooks using jQuery.fn.position
// Webkit bug: https://bugs.webkit.org/show_bug.cgi?id=29084
// Blink bug: https://bugs.chromium.org/p/chromium/issues/detail?id=589347
// getComputedStyle returns percent when specified for top/left/bottom/right;
// rather than make the css module depend on the offset module, just check for it here
jQuery.each( [ "top", "left" ], function( _i, prop ) {
	jQuery.cssHooks[ prop ] = addGetHookIf( support.pixelPosition,
		function( elem, computed ) {
			if ( computed ) {
				computed = curCSS( elem, prop );

				// If curCSS returns percentage, fallback to offset
				return rnumnonpx.test( computed ) ?
					jQuery( elem ).position()[ prop ] + "px" :
					computed;
			}
		}
	);
} );


// Create innerHeight, innerWidth, height, width, outerHeight and outerWidth methods
jQuery.each( { Height: "height", Width: "width" }, function( name, type ) {
	jQuery.each( { padding: "inner" + name, content: type, "": "outer" + name },
		function( defaultExtra, funcName ) {

		// Margin is only for outerHeight, outerWidth
		jQuery.fn[ funcName ] = function( margin, value ) {
			var chainable = arguments.length && ( defaultExtra || typeof margin !== "boolean" ),
				extra = defaultExtra || ( margin === true || value === true ? "margin" : "border" );

			return access( this, function( elem, type, value ) {
				var doc;

				if ( isWindow( elem ) ) {

					// $( window ).outerWidth/Height return w/h including scrollbars (gh-1729)
					return funcName.indexOf( "outer" ) === 0 ?
						elem[ "inner" + name ] :
						elem.document.documentElement[ "client" + name ];
				}

				// Get document width or height
				if ( elem.nodeType === 9 ) {
					doc = elem.documentElement;

					// Either scroll[Width/Height] or offset[Width/Height] or client[Width/Height],
					// whichever is greatest
					return Math.max(
						elem.body[ "scroll" + name ], doc[ "scroll" + name ],
						elem.body[ "offset" + name ], doc[ "offset" + name ],
						doc[ "client" + name ]
					);
				}

				return value === undefined ?

					// Get width or height on the element, requesting but not forcing parseFloat
					jQuery.css( elem, type, extra ) :

					// Set width or height on the element
					jQuery.style( elem, type, value, extra );
			}, type, chainable ? margin : undefined, chainable );
		};
	} );
} );


jQuery.each( [
	"ajaxStart",
	"ajaxStop",
	"ajaxComplete",
	"ajaxError",
	"ajaxSuccess",
	"ajaxSend"
], function( _i, type ) {
	jQuery.fn[ type ] = function( fn ) {
		return this.on( type, fn );
	};
} );




jQuery.fn.extend( {

	bind: function( types, data, fn ) {
		return this.on( types, null, data, fn );
	},
	unbind: function( types, fn ) {
		return this.off( types, null, fn );
	},

	delegate: function( selector, types, data, fn ) {
		return this.on( types, selector, data, fn );
	},
	undelegate: function( selector, types, fn ) {

		// ( namespace ) or ( selector, types [, fn] )
		return arguments.length === 1 ?
			this.off( selector, "**" ) :
			this.off( types, selector || "**", fn );
	},

	hover: function( fnOver, fnOut ) {
		return this.mouseenter( fnOver ).mouseleave( fnOut || fnOver );
	}
} );

jQuery.each( ( "blur focus focusin focusout resize scroll click dblclick " +
	"mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave " +
	"change select submit keydown keypress keyup contextmenu" ).split( " " ),
	function( _i, name ) {

		// Handle event binding
		jQuery.fn[ name ] = function( data, fn ) {
			return arguments.length > 0 ?
				this.on( name, null, data, fn ) :
				this.trigger( name );
		};
	} );




// Support: Android <=4.0 only
// Make sure we trim BOM and NBSP
var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;

// Bind a function to a context, optionally partially applying any
// arguments.
// jQuery.proxy is deprecated to promote standards (specifically Function#bind)
// However, it is not slated for removal any time soon
jQuery.proxy = function( fn, context ) {
	var tmp, args, proxy;

	if ( typeof context === "string" ) {
		tmp = fn[ context ];
		context = fn;
		fn = tmp;
	}

	// Quick check to determine if target is callable, in the spec
	// this throws a TypeError, but we will just return undefined.
	if ( !isFunction( fn ) ) {
		return undefined;
	}

	// Simulated bind
	args = slice.call( arguments, 2 );
	proxy = function() {
		return fn.apply( context || this, args.concat( slice.call( arguments ) ) );
	};

	// Set the guid of unique handler to the same of original handler, so it can be removed
	proxy.guid = fn.guid = fn.guid || jQuery.guid++;

	return proxy;
};

jQuery.holdReady = function( hold ) {
	if ( hold ) {
		jQuery.readyWait++;
	} else {
		jQuery.ready( true );
	}
};
jQuery.isArray = Array.isArray;
jQuery.parseJSON = JSON.parse;
jQuery.nodeName = nodeName;
jQuery.isFunction = isFunction;
jQuery.isWindow = isWindow;
jQuery.camelCase = camelCase;
jQuery.type = toType;

jQuery.now = Date.now;

jQuery.isNumeric = function( obj ) {

	// As of jQuery 3.0, isNumeric is limited to
	// strings and numbers (primitives or objects)
	// that can be coerced to finite numbers (gh-2662)
	var type = jQuery.type( obj );
	return ( type === "number" || type === "string" ) &&

		// parseFloat NaNs numeric-cast false positives ("")
		// ...but misinterprets leading-number strings, particularly hex literals ("0x...")
		// subtraction forces infinities to NaN
		!isNaN( obj - parseFloat( obj ) );
};

jQuery.trim = function( text ) {
	return text == null ?
		"" :
		( text + "" ).replace( rtrim, "" );
};



// Register as a named AMD module, since jQuery can be concatenated with other
// files that may use define, but not via a proper concatenation script that
// understands anonymous AMD modules. A named AMD is safest and most robust
// way to register. Lowercase jquery is used because AMD module names are
// derived from file names, and jQuery is normally delivered in a lowercase
// file name. Do this after creating the global so that if an AMD module wants
// to call noConflict to hide this version of jQuery, it will work.

// Note that for maximum portability, libraries that are not jQuery should
// declare themselves as anonymous modules, and avoid setting a global if an
// AMD loader is present. jQuery is a special case. For more information, see
// https://github.com/jrburke/requirejs/wiki/Updating-existing-libraries#wiki-anon

if ( true ) {
	!(__WEBPACK_AMD_DEFINE_ARRAY__ = [], __WEBPACK_AMD_DEFINE_RESULT__ = (function() {
		return jQuery;
	}).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
}




var

	// Map over jQuery in case of overwrite
	_jQuery = window.jQuery,

	// Map over the $ in case of overwrite
	_$ = window.$;

jQuery.noConflict = function( deep ) {
	if ( window.$ === jQuery ) {
		window.$ = _$;
	}

	if ( deep && window.jQuery === jQuery ) {
		window.jQuery = _jQuery;
	}

	return jQuery;
};

// Expose jQuery and $ identifiers, even in AMD
// (#7102#comment:10, https://github.com/jquery/jquery/pull/557)
// and CommonJS for browser emulators (#13566)
if ( typeof noGlobal === "undefined" ) {
	window.jQuery = window.$ = jQuery;
}




return jQuery;
} );


/***/ }),

/***/ "./node_modules/lodash/_Symbol.js":
/*!****************************************!*\
  !*** ./node_modules/lodash/_Symbol.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var root = __webpack_require__(/*! ./_root */ "./node_modules/lodash/_root.js");

/** Built-in value references. */
var Symbol = root.Symbol;

module.exports = Symbol;


/***/ }),

/***/ "./node_modules/lodash/_arrayMap.js":
/*!******************************************!*\
  !*** ./node_modules/lodash/_arrayMap.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * A specialized version of `_.map` for arrays without support for iteratee
 * shorthands.
 *
 * @private
 * @param {Array} [array] The array to iterate over.
 * @param {Function} iteratee The function invoked per iteration.
 * @returns {Array} Returns the new mapped array.
 */
function arrayMap(array, iteratee) {
  var index = -1,
      length = array == null ? 0 : array.length,
      result = Array(length);

  while (++index < length) {
    result[index] = iteratee(array[index], index, array);
  }
  return result;
}

module.exports = arrayMap;


/***/ }),

/***/ "./node_modules/lodash/_arrayReduce.js":
/*!*********************************************!*\
  !*** ./node_modules/lodash/_arrayReduce.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * A specialized version of `_.reduce` for arrays without support for
 * iteratee shorthands.
 *
 * @private
 * @param {Array} [array] The array to iterate over.
 * @param {Function} iteratee The function invoked per iteration.
 * @param {*} [accumulator] The initial value.
 * @param {boolean} [initAccum] Specify using the first element of `array` as
 *  the initial value.
 * @returns {*} Returns the accumulated value.
 */
function arrayReduce(array, iteratee, accumulator, initAccum) {
  var index = -1,
      length = array == null ? 0 : array.length;

  if (initAccum && length) {
    accumulator = array[++index];
  }
  while (++index < length) {
    accumulator = iteratee(accumulator, array[index], index, array);
  }
  return accumulator;
}

module.exports = arrayReduce;


/***/ }),

/***/ "./node_modules/lodash/_asciiToArray.js":
/*!**********************************************!*\
  !*** ./node_modules/lodash/_asciiToArray.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * Converts an ASCII `string` to an array.
 *
 * @private
 * @param {string} string The string to convert.
 * @returns {Array} Returns the converted array.
 */
function asciiToArray(string) {
  return string.split('');
}

module.exports = asciiToArray;


/***/ }),

/***/ "./node_modules/lodash/_asciiWords.js":
/*!********************************************!*\
  !*** ./node_modules/lodash/_asciiWords.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/** Used to match words composed of alphanumeric characters. */
var reAsciiWord = /[^\x00-\x2f\x3a-\x40\x5b-\x60\x7b-\x7f]+/g;

/**
 * Splits an ASCII `string` into an array of its words.
 *
 * @private
 * @param {string} The string to inspect.
 * @returns {Array} Returns the words of `string`.
 */
function asciiWords(string) {
  return string.match(reAsciiWord) || [];
}

module.exports = asciiWords;


/***/ }),

/***/ "./node_modules/lodash/_baseGetTag.js":
/*!********************************************!*\
  !*** ./node_modules/lodash/_baseGetTag.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var Symbol = __webpack_require__(/*! ./_Symbol */ "./node_modules/lodash/_Symbol.js"),
    getRawTag = __webpack_require__(/*! ./_getRawTag */ "./node_modules/lodash/_getRawTag.js"),
    objectToString = __webpack_require__(/*! ./_objectToString */ "./node_modules/lodash/_objectToString.js");

/** `Object#toString` result references. */
var nullTag = '[object Null]',
    undefinedTag = '[object Undefined]';

/** Built-in value references. */
var symToStringTag = Symbol ? Symbol.toStringTag : undefined;

/**
 * The base implementation of `getTag` without fallbacks for buggy environments.
 *
 * @private
 * @param {*} value The value to query.
 * @returns {string} Returns the `toStringTag`.
 */
function baseGetTag(value) {
  if (value == null) {
    return value === undefined ? undefinedTag : nullTag;
  }
  return (symToStringTag && symToStringTag in Object(value))
    ? getRawTag(value)
    : objectToString(value);
}

module.exports = baseGetTag;


/***/ }),

/***/ "./node_modules/lodash/_basePropertyOf.js":
/*!************************************************!*\
  !*** ./node_modules/lodash/_basePropertyOf.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * The base implementation of `_.propertyOf` without support for deep paths.
 *
 * @private
 * @param {Object} object The object to query.
 * @returns {Function} Returns the new accessor function.
 */
function basePropertyOf(object) {
  return function(key) {
    return object == null ? undefined : object[key];
  };
}

module.exports = basePropertyOf;


/***/ }),

/***/ "./node_modules/lodash/_baseSlice.js":
/*!*******************************************!*\
  !*** ./node_modules/lodash/_baseSlice.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * The base implementation of `_.slice` without an iteratee call guard.
 *
 * @private
 * @param {Array} array The array to slice.
 * @param {number} [start=0] The start position.
 * @param {number} [end=array.length] The end position.
 * @returns {Array} Returns the slice of `array`.
 */
function baseSlice(array, start, end) {
  var index = -1,
      length = array.length;

  if (start < 0) {
    start = -start > length ? 0 : (length + start);
  }
  end = end > length ? length : end;
  if (end < 0) {
    end += length;
  }
  length = start > end ? 0 : ((end - start) >>> 0);
  start >>>= 0;

  var result = Array(length);
  while (++index < length) {
    result[index] = array[index + start];
  }
  return result;
}

module.exports = baseSlice;


/***/ }),

/***/ "./node_modules/lodash/_baseToString.js":
/*!**********************************************!*\
  !*** ./node_modules/lodash/_baseToString.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var Symbol = __webpack_require__(/*! ./_Symbol */ "./node_modules/lodash/_Symbol.js"),
    arrayMap = __webpack_require__(/*! ./_arrayMap */ "./node_modules/lodash/_arrayMap.js"),
    isArray = __webpack_require__(/*! ./isArray */ "./node_modules/lodash/isArray.js"),
    isSymbol = __webpack_require__(/*! ./isSymbol */ "./node_modules/lodash/isSymbol.js");

/** Used as references for various `Number` constants. */
var INFINITY = 1 / 0;

/** Used to convert symbols to primitives and strings. */
var symbolProto = Symbol ? Symbol.prototype : undefined,
    symbolToString = symbolProto ? symbolProto.toString : undefined;

/**
 * The base implementation of `_.toString` which doesn't convert nullish
 * values to empty strings.
 *
 * @private
 * @param {*} value The value to process.
 * @returns {string} Returns the string.
 */
function baseToString(value) {
  // Exit early for strings to avoid a performance hit in some environments.
  if (typeof value == 'string') {
    return value;
  }
  if (isArray(value)) {
    // Recursively convert values (susceptible to call stack limits).
    return arrayMap(value, baseToString) + '';
  }
  if (isSymbol(value)) {
    return symbolToString ? symbolToString.call(value) : '';
  }
  var result = (value + '');
  return (result == '0' && (1 / value) == -INFINITY) ? '-0' : result;
}

module.exports = baseToString;


/***/ }),

/***/ "./node_modules/lodash/_castSlice.js":
/*!*******************************************!*\
  !*** ./node_modules/lodash/_castSlice.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var baseSlice = __webpack_require__(/*! ./_baseSlice */ "./node_modules/lodash/_baseSlice.js");

/**
 * Casts `array` to a slice if it's needed.
 *
 * @private
 * @param {Array} array The array to inspect.
 * @param {number} start The start position.
 * @param {number} [end=array.length] The end position.
 * @returns {Array} Returns the cast slice.
 */
function castSlice(array, start, end) {
  var length = array.length;
  end = end === undefined ? length : end;
  return (!start && end >= length) ? array : baseSlice(array, start, end);
}

module.exports = castSlice;


/***/ }),

/***/ "./node_modules/lodash/_createCaseFirst.js":
/*!*************************************************!*\
  !*** ./node_modules/lodash/_createCaseFirst.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var castSlice = __webpack_require__(/*! ./_castSlice */ "./node_modules/lodash/_castSlice.js"),
    hasUnicode = __webpack_require__(/*! ./_hasUnicode */ "./node_modules/lodash/_hasUnicode.js"),
    stringToArray = __webpack_require__(/*! ./_stringToArray */ "./node_modules/lodash/_stringToArray.js"),
    toString = __webpack_require__(/*! ./toString */ "./node_modules/lodash/toString.js");

/**
 * Creates a function like `_.lowerFirst`.
 *
 * @private
 * @param {string} methodName The name of the `String` case method to use.
 * @returns {Function} Returns the new case function.
 */
function createCaseFirst(methodName) {
  return function(string) {
    string = toString(string);

    var strSymbols = hasUnicode(string)
      ? stringToArray(string)
      : undefined;

    var chr = strSymbols
      ? strSymbols[0]
      : string.charAt(0);

    var trailing = strSymbols
      ? castSlice(strSymbols, 1).join('')
      : string.slice(1);

    return chr[methodName]() + trailing;
  };
}

module.exports = createCaseFirst;


/***/ }),

/***/ "./node_modules/lodash/_createCompounder.js":
/*!**************************************************!*\
  !*** ./node_modules/lodash/_createCompounder.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var arrayReduce = __webpack_require__(/*! ./_arrayReduce */ "./node_modules/lodash/_arrayReduce.js"),
    deburr = __webpack_require__(/*! ./deburr */ "./node_modules/lodash/deburr.js"),
    words = __webpack_require__(/*! ./words */ "./node_modules/lodash/words.js");

/** Used to compose unicode capture groups. */
var rsApos = "['\u2019]";

/** Used to match apostrophes. */
var reApos = RegExp(rsApos, 'g');

/**
 * Creates a function like `_.camelCase`.
 *
 * @private
 * @param {Function} callback The function to combine each word.
 * @returns {Function} Returns the new compounder function.
 */
function createCompounder(callback) {
  return function(string) {
    return arrayReduce(words(deburr(string).replace(reApos, '')), callback, '');
  };
}

module.exports = createCompounder;


/***/ }),

/***/ "./node_modules/lodash/_deburrLetter.js":
/*!**********************************************!*\
  !*** ./node_modules/lodash/_deburrLetter.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var basePropertyOf = __webpack_require__(/*! ./_basePropertyOf */ "./node_modules/lodash/_basePropertyOf.js");

/** Used to map Latin Unicode letters to basic Latin letters. */
var deburredLetters = {
  // Latin-1 Supplement block.
  '\xc0': 'A',  '\xc1': 'A', '\xc2': 'A', '\xc3': 'A', '\xc4': 'A', '\xc5': 'A',
  '\xe0': 'a',  '\xe1': 'a', '\xe2': 'a', '\xe3': 'a', '\xe4': 'a', '\xe5': 'a',
  '\xc7': 'C',  '\xe7': 'c',
  '\xd0': 'D',  '\xf0': 'd',
  '\xc8': 'E',  '\xc9': 'E', '\xca': 'E', '\xcb': 'E',
  '\xe8': 'e',  '\xe9': 'e', '\xea': 'e', '\xeb': 'e',
  '\xcc': 'I',  '\xcd': 'I', '\xce': 'I', '\xcf': 'I',
  '\xec': 'i',  '\xed': 'i', '\xee': 'i', '\xef': 'i',
  '\xd1': 'N',  '\xf1': 'n',
  '\xd2': 'O',  '\xd3': 'O', '\xd4': 'O', '\xd5': 'O', '\xd6': 'O', '\xd8': 'O',
  '\xf2': 'o',  '\xf3': 'o', '\xf4': 'o', '\xf5': 'o', '\xf6': 'o', '\xf8': 'o',
  '\xd9': 'U',  '\xda': 'U', '\xdb': 'U', '\xdc': 'U',
  '\xf9': 'u',  '\xfa': 'u', '\xfb': 'u', '\xfc': 'u',
  '\xdd': 'Y',  '\xfd': 'y', '\xff': 'y',
  '\xc6': 'Ae', '\xe6': 'ae',
  '\xde': 'Th', '\xfe': 'th',
  '\xdf': 'ss',
  // Latin Extended-A block.
  '\u0100': 'A',  '\u0102': 'A', '\u0104': 'A',
  '\u0101': 'a',  '\u0103': 'a', '\u0105': 'a',
  '\u0106': 'C',  '\u0108': 'C', '\u010a': 'C', '\u010c': 'C',
  '\u0107': 'c',  '\u0109': 'c', '\u010b': 'c', '\u010d': 'c',
  '\u010e': 'D',  '\u0110': 'D', '\u010f': 'd', '\u0111': 'd',
  '\u0112': 'E',  '\u0114': 'E', '\u0116': 'E', '\u0118': 'E', '\u011a': 'E',
  '\u0113': 'e',  '\u0115': 'e', '\u0117': 'e', '\u0119': 'e', '\u011b': 'e',
  '\u011c': 'G',  '\u011e': 'G', '\u0120': 'G', '\u0122': 'G',
  '\u011d': 'g',  '\u011f': 'g', '\u0121': 'g', '\u0123': 'g',
  '\u0124': 'H',  '\u0126': 'H', '\u0125': 'h', '\u0127': 'h',
  '\u0128': 'I',  '\u012a': 'I', '\u012c': 'I', '\u012e': 'I', '\u0130': 'I',
  '\u0129': 'i',  '\u012b': 'i', '\u012d': 'i', '\u012f': 'i', '\u0131': 'i',
  '\u0134': 'J',  '\u0135': 'j',
  '\u0136': 'K',  '\u0137': 'k', '\u0138': 'k',
  '\u0139': 'L',  '\u013b': 'L', '\u013d': 'L', '\u013f': 'L', '\u0141': 'L',
  '\u013a': 'l',  '\u013c': 'l', '\u013e': 'l', '\u0140': 'l', '\u0142': 'l',
  '\u0143': 'N',  '\u0145': 'N', '\u0147': 'N', '\u014a': 'N',
  '\u0144': 'n',  '\u0146': 'n', '\u0148': 'n', '\u014b': 'n',
  '\u014c': 'O',  '\u014e': 'O', '\u0150': 'O',
  '\u014d': 'o',  '\u014f': 'o', '\u0151': 'o',
  '\u0154': 'R',  '\u0156': 'R', '\u0158': 'R',
  '\u0155': 'r',  '\u0157': 'r', '\u0159': 'r',
  '\u015a': 'S',  '\u015c': 'S', '\u015e': 'S', '\u0160': 'S',
  '\u015b': 's',  '\u015d': 's', '\u015f': 's', '\u0161': 's',
  '\u0162': 'T',  '\u0164': 'T', '\u0166': 'T',
  '\u0163': 't',  '\u0165': 't', '\u0167': 't',
  '\u0168': 'U',  '\u016a': 'U', '\u016c': 'U', '\u016e': 'U', '\u0170': 'U', '\u0172': 'U',
  '\u0169': 'u',  '\u016b': 'u', '\u016d': 'u', '\u016f': 'u', '\u0171': 'u', '\u0173': 'u',
  '\u0174': 'W',  '\u0175': 'w',
  '\u0176': 'Y',  '\u0177': 'y', '\u0178': 'Y',
  '\u0179': 'Z',  '\u017b': 'Z', '\u017d': 'Z',
  '\u017a': 'z',  '\u017c': 'z', '\u017e': 'z',
  '\u0132': 'IJ', '\u0133': 'ij',
  '\u0152': 'Oe', '\u0153': 'oe',
  '\u0149': "'n", '\u017f': 's'
};

/**
 * Used by `_.deburr` to convert Latin-1 Supplement and Latin Extended-A
 * letters to basic Latin letters.
 *
 * @private
 * @param {string} letter The matched letter to deburr.
 * @returns {string} Returns the deburred letter.
 */
var deburrLetter = basePropertyOf(deburredLetters);

module.exports = deburrLetter;


/***/ }),

/***/ "./node_modules/lodash/_freeGlobal.js":
/*!********************************************!*\
  !*** ./node_modules/lodash/_freeGlobal.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(global) {/** Detect free variable `global` from Node.js. */
var freeGlobal = typeof global == 'object' && global && global.Object === Object && global;

module.exports = freeGlobal;

/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! ./../webpack/buildin/global.js */ "./node_modules/webpack/buildin/global.js")))

/***/ }),

/***/ "./node_modules/lodash/_getRawTag.js":
/*!*******************************************!*\
  !*** ./node_modules/lodash/_getRawTag.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var Symbol = __webpack_require__(/*! ./_Symbol */ "./node_modules/lodash/_Symbol.js");

/** Used for built-in method references. */
var objectProto = Object.prototype;

/** Used to check objects for own properties. */
var hasOwnProperty = objectProto.hasOwnProperty;

/**
 * Used to resolve the
 * [`toStringTag`](http://ecma-international.org/ecma-262/7.0/#sec-object.prototype.tostring)
 * of values.
 */
var nativeObjectToString = objectProto.toString;

/** Built-in value references. */
var symToStringTag = Symbol ? Symbol.toStringTag : undefined;

/**
 * A specialized version of `baseGetTag` which ignores `Symbol.toStringTag` values.
 *
 * @private
 * @param {*} value The value to query.
 * @returns {string} Returns the raw `toStringTag`.
 */
function getRawTag(value) {
  var isOwn = hasOwnProperty.call(value, symToStringTag),
      tag = value[symToStringTag];

  try {
    value[symToStringTag] = undefined;
    var unmasked = true;
  } catch (e) {}

  var result = nativeObjectToString.call(value);
  if (unmasked) {
    if (isOwn) {
      value[symToStringTag] = tag;
    } else {
      delete value[symToStringTag];
    }
  }
  return result;
}

module.exports = getRawTag;


/***/ }),

/***/ "./node_modules/lodash/_hasUnicode.js":
/*!********************************************!*\
  !*** ./node_modules/lodash/_hasUnicode.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/** Used to compose unicode character classes. */
var rsAstralRange = '\\ud800-\\udfff',
    rsComboMarksRange = '\\u0300-\\u036f',
    reComboHalfMarksRange = '\\ufe20-\\ufe2f',
    rsComboSymbolsRange = '\\u20d0-\\u20ff',
    rsComboRange = rsComboMarksRange + reComboHalfMarksRange + rsComboSymbolsRange,
    rsVarRange = '\\ufe0e\\ufe0f';

/** Used to compose unicode capture groups. */
var rsZWJ = '\\u200d';

/** Used to detect strings with [zero-width joiners or code points from the astral planes](http://eev.ee/blog/2015/09/12/dark-corners-of-unicode/). */
var reHasUnicode = RegExp('[' + rsZWJ + rsAstralRange  + rsComboRange + rsVarRange + ']');

/**
 * Checks if `string` contains Unicode symbols.
 *
 * @private
 * @param {string} string The string to inspect.
 * @returns {boolean} Returns `true` if a symbol is found, else `false`.
 */
function hasUnicode(string) {
  return reHasUnicode.test(string);
}

module.exports = hasUnicode;


/***/ }),

/***/ "./node_modules/lodash/_hasUnicodeWord.js":
/*!************************************************!*\
  !*** ./node_modules/lodash/_hasUnicodeWord.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/** Used to detect strings that need a more robust regexp to match words. */
var reHasUnicodeWord = /[a-z][A-Z]|[A-Z]{2}[a-z]|[0-9][a-zA-Z]|[a-zA-Z][0-9]|[^a-zA-Z0-9 ]/;

/**
 * Checks if `string` contains a word composed of Unicode symbols.
 *
 * @private
 * @param {string} string The string to inspect.
 * @returns {boolean} Returns `true` if a word is found, else `false`.
 */
function hasUnicodeWord(string) {
  return reHasUnicodeWord.test(string);
}

module.exports = hasUnicodeWord;


/***/ }),

/***/ "./node_modules/lodash/_objectToString.js":
/*!************************************************!*\
  !*** ./node_modules/lodash/_objectToString.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/** Used for built-in method references. */
var objectProto = Object.prototype;

/**
 * Used to resolve the
 * [`toStringTag`](http://ecma-international.org/ecma-262/7.0/#sec-object.prototype.tostring)
 * of values.
 */
var nativeObjectToString = objectProto.toString;

/**
 * Converts `value` to a string using `Object.prototype.toString`.
 *
 * @private
 * @param {*} value The value to convert.
 * @returns {string} Returns the converted string.
 */
function objectToString(value) {
  return nativeObjectToString.call(value);
}

module.exports = objectToString;


/***/ }),

/***/ "./node_modules/lodash/_root.js":
/*!**************************************!*\
  !*** ./node_modules/lodash/_root.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var freeGlobal = __webpack_require__(/*! ./_freeGlobal */ "./node_modules/lodash/_freeGlobal.js");

/** Detect free variable `self`. */
var freeSelf = typeof self == 'object' && self && self.Object === Object && self;

/** Used as a reference to the global object. */
var root = freeGlobal || freeSelf || Function('return this')();

module.exports = root;


/***/ }),

/***/ "./node_modules/lodash/_stringToArray.js":
/*!***********************************************!*\
  !*** ./node_modules/lodash/_stringToArray.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var asciiToArray = __webpack_require__(/*! ./_asciiToArray */ "./node_modules/lodash/_asciiToArray.js"),
    hasUnicode = __webpack_require__(/*! ./_hasUnicode */ "./node_modules/lodash/_hasUnicode.js"),
    unicodeToArray = __webpack_require__(/*! ./_unicodeToArray */ "./node_modules/lodash/_unicodeToArray.js");

/**
 * Converts `string` to an array.
 *
 * @private
 * @param {string} string The string to convert.
 * @returns {Array} Returns the converted array.
 */
function stringToArray(string) {
  return hasUnicode(string)
    ? unicodeToArray(string)
    : asciiToArray(string);
}

module.exports = stringToArray;


/***/ }),

/***/ "./node_modules/lodash/_unicodeToArray.js":
/*!************************************************!*\
  !*** ./node_modules/lodash/_unicodeToArray.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/** Used to compose unicode character classes. */
var rsAstralRange = '\\ud800-\\udfff',
    rsComboMarksRange = '\\u0300-\\u036f',
    reComboHalfMarksRange = '\\ufe20-\\ufe2f',
    rsComboSymbolsRange = '\\u20d0-\\u20ff',
    rsComboRange = rsComboMarksRange + reComboHalfMarksRange + rsComboSymbolsRange,
    rsVarRange = '\\ufe0e\\ufe0f';

/** Used to compose unicode capture groups. */
var rsAstral = '[' + rsAstralRange + ']',
    rsCombo = '[' + rsComboRange + ']',
    rsFitz = '\\ud83c[\\udffb-\\udfff]',
    rsModifier = '(?:' + rsCombo + '|' + rsFitz + ')',
    rsNonAstral = '[^' + rsAstralRange + ']',
    rsRegional = '(?:\\ud83c[\\udde6-\\uddff]){2}',
    rsSurrPair = '[\\ud800-\\udbff][\\udc00-\\udfff]',
    rsZWJ = '\\u200d';

/** Used to compose unicode regexes. */
var reOptMod = rsModifier + '?',
    rsOptVar = '[' + rsVarRange + ']?',
    rsOptJoin = '(?:' + rsZWJ + '(?:' + [rsNonAstral, rsRegional, rsSurrPair].join('|') + ')' + rsOptVar + reOptMod + ')*',
    rsSeq = rsOptVar + reOptMod + rsOptJoin,
    rsSymbol = '(?:' + [rsNonAstral + rsCombo + '?', rsCombo, rsRegional, rsSurrPair, rsAstral].join('|') + ')';

/** Used to match [string symbols](https://mathiasbynens.be/notes/javascript-unicode). */
var reUnicode = RegExp(rsFitz + '(?=' + rsFitz + ')|' + rsSymbol + rsSeq, 'g');

/**
 * Converts a Unicode `string` to an array.
 *
 * @private
 * @param {string} string The string to convert.
 * @returns {Array} Returns the converted array.
 */
function unicodeToArray(string) {
  return string.match(reUnicode) || [];
}

module.exports = unicodeToArray;


/***/ }),

/***/ "./node_modules/lodash/_unicodeWords.js":
/*!**********************************************!*\
  !*** ./node_modules/lodash/_unicodeWords.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/** Used to compose unicode character classes. */
var rsAstralRange = '\\ud800-\\udfff',
    rsComboMarksRange = '\\u0300-\\u036f',
    reComboHalfMarksRange = '\\ufe20-\\ufe2f',
    rsComboSymbolsRange = '\\u20d0-\\u20ff',
    rsComboRange = rsComboMarksRange + reComboHalfMarksRange + rsComboSymbolsRange,
    rsDingbatRange = '\\u2700-\\u27bf',
    rsLowerRange = 'a-z\\xdf-\\xf6\\xf8-\\xff',
    rsMathOpRange = '\\xac\\xb1\\xd7\\xf7',
    rsNonCharRange = '\\x00-\\x2f\\x3a-\\x40\\x5b-\\x60\\x7b-\\xbf',
    rsPunctuationRange = '\\u2000-\\u206f',
    rsSpaceRange = ' \\t\\x0b\\f\\xa0\\ufeff\\n\\r\\u2028\\u2029\\u1680\\u180e\\u2000\\u2001\\u2002\\u2003\\u2004\\u2005\\u2006\\u2007\\u2008\\u2009\\u200a\\u202f\\u205f\\u3000',
    rsUpperRange = 'A-Z\\xc0-\\xd6\\xd8-\\xde',
    rsVarRange = '\\ufe0e\\ufe0f',
    rsBreakRange = rsMathOpRange + rsNonCharRange + rsPunctuationRange + rsSpaceRange;

/** Used to compose unicode capture groups. */
var rsApos = "['\u2019]",
    rsBreak = '[' + rsBreakRange + ']',
    rsCombo = '[' + rsComboRange + ']',
    rsDigits = '\\d+',
    rsDingbat = '[' + rsDingbatRange + ']',
    rsLower = '[' + rsLowerRange + ']',
    rsMisc = '[^' + rsAstralRange + rsBreakRange + rsDigits + rsDingbatRange + rsLowerRange + rsUpperRange + ']',
    rsFitz = '\\ud83c[\\udffb-\\udfff]',
    rsModifier = '(?:' + rsCombo + '|' + rsFitz + ')',
    rsNonAstral = '[^' + rsAstralRange + ']',
    rsRegional = '(?:\\ud83c[\\udde6-\\uddff]){2}',
    rsSurrPair = '[\\ud800-\\udbff][\\udc00-\\udfff]',
    rsUpper = '[' + rsUpperRange + ']',
    rsZWJ = '\\u200d';

/** Used to compose unicode regexes. */
var rsMiscLower = '(?:' + rsLower + '|' + rsMisc + ')',
    rsMiscUpper = '(?:' + rsUpper + '|' + rsMisc + ')',
    rsOptContrLower = '(?:' + rsApos + '(?:d|ll|m|re|s|t|ve))?',
    rsOptContrUpper = '(?:' + rsApos + '(?:D|LL|M|RE|S|T|VE))?',
    reOptMod = rsModifier + '?',
    rsOptVar = '[' + rsVarRange + ']?',
    rsOptJoin = '(?:' + rsZWJ + '(?:' + [rsNonAstral, rsRegional, rsSurrPair].join('|') + ')' + rsOptVar + reOptMod + ')*',
    rsOrdLower = '\\d*(?:1st|2nd|3rd|(?![123])\\dth)(?=\\b|[A-Z_])',
    rsOrdUpper = '\\d*(?:1ST|2ND|3RD|(?![123])\\dTH)(?=\\b|[a-z_])',
    rsSeq = rsOptVar + reOptMod + rsOptJoin,
    rsEmoji = '(?:' + [rsDingbat, rsRegional, rsSurrPair].join('|') + ')' + rsSeq;

/** Used to match complex or compound words. */
var reUnicodeWord = RegExp([
  rsUpper + '?' + rsLower + '+' + rsOptContrLower + '(?=' + [rsBreak, rsUpper, '$'].join('|') + ')',
  rsMiscUpper + '+' + rsOptContrUpper + '(?=' + [rsBreak, rsUpper + rsMiscLower, '$'].join('|') + ')',
  rsUpper + '?' + rsMiscLower + '+' + rsOptContrLower,
  rsUpper + '+' + rsOptContrUpper,
  rsOrdUpper,
  rsOrdLower,
  rsDigits,
  rsEmoji
].join('|'), 'g');

/**
 * Splits a Unicode `string` into an array of its words.
 *
 * @private
 * @param {string} The string to inspect.
 * @returns {Array} Returns the words of `string`.
 */
function unicodeWords(string) {
  return string.match(reUnicodeWord) || [];
}

module.exports = unicodeWords;


/***/ }),

/***/ "./node_modules/lodash/camelCase.js":
/*!******************************************!*\
  !*** ./node_modules/lodash/camelCase.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var capitalize = __webpack_require__(/*! ./capitalize */ "./node_modules/lodash/capitalize.js"),
    createCompounder = __webpack_require__(/*! ./_createCompounder */ "./node_modules/lodash/_createCompounder.js");

/**
 * Converts `string` to [camel case](https://en.wikipedia.org/wiki/CamelCase).
 *
 * @static
 * @memberOf _
 * @since 3.0.0
 * @category String
 * @param {string} [string=''] The string to convert.
 * @returns {string} Returns the camel cased string.
 * @example
 *
 * _.camelCase('Foo Bar');
 * // => 'fooBar'
 *
 * _.camelCase('--foo-bar--');
 * // => 'fooBar'
 *
 * _.camelCase('__FOO_BAR__');
 * // => 'fooBar'
 */
var camelCase = createCompounder(function(result, word, index) {
  word = word.toLowerCase();
  return result + (index ? capitalize(word) : word);
});

module.exports = camelCase;


/***/ }),

/***/ "./node_modules/lodash/capitalize.js":
/*!*******************************************!*\
  !*** ./node_modules/lodash/capitalize.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var toString = __webpack_require__(/*! ./toString */ "./node_modules/lodash/toString.js"),
    upperFirst = __webpack_require__(/*! ./upperFirst */ "./node_modules/lodash/upperFirst.js");

/**
 * Converts the first character of `string` to upper case and the remaining
 * to lower case.
 *
 * @static
 * @memberOf _
 * @since 3.0.0
 * @category String
 * @param {string} [string=''] The string to capitalize.
 * @returns {string} Returns the capitalized string.
 * @example
 *
 * _.capitalize('FRED');
 * // => 'Fred'
 */
function capitalize(string) {
  return upperFirst(toString(string).toLowerCase());
}

module.exports = capitalize;


/***/ }),

/***/ "./node_modules/lodash/deburr.js":
/*!***************************************!*\
  !*** ./node_modules/lodash/deburr.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var deburrLetter = __webpack_require__(/*! ./_deburrLetter */ "./node_modules/lodash/_deburrLetter.js"),
    toString = __webpack_require__(/*! ./toString */ "./node_modules/lodash/toString.js");

/** Used to match Latin Unicode letters (excluding mathematical operators). */
var reLatin = /[\xc0-\xd6\xd8-\xf6\xf8-\xff\u0100-\u017f]/g;

/** Used to compose unicode character classes. */
var rsComboMarksRange = '\\u0300-\\u036f',
    reComboHalfMarksRange = '\\ufe20-\\ufe2f',
    rsComboSymbolsRange = '\\u20d0-\\u20ff',
    rsComboRange = rsComboMarksRange + reComboHalfMarksRange + rsComboSymbolsRange;

/** Used to compose unicode capture groups. */
var rsCombo = '[' + rsComboRange + ']';

/**
 * Used to match [combining diacritical marks](https://en.wikipedia.org/wiki/Combining_Diacritical_Marks) and
 * [combining diacritical marks for symbols](https://en.wikipedia.org/wiki/Combining_Diacritical_Marks_for_Symbols).
 */
var reComboMark = RegExp(rsCombo, 'g');

/**
 * Deburrs `string` by converting
 * [Latin-1 Supplement](https://en.wikipedia.org/wiki/Latin-1_Supplement_(Unicode_block)#Character_table)
 * and [Latin Extended-A](https://en.wikipedia.org/wiki/Latin_Extended-A)
 * letters to basic Latin letters and removing
 * [combining diacritical marks](https://en.wikipedia.org/wiki/Combining_Diacritical_Marks).
 *
 * @static
 * @memberOf _
 * @since 3.0.0
 * @category String
 * @param {string} [string=''] The string to deburr.
 * @returns {string} Returns the deburred string.
 * @example
 *
 * _.deburr('déjà vu');
 * // => 'deja vu'
 */
function deburr(string) {
  string = toString(string);
  return string && string.replace(reLatin, deburrLetter).replace(reComboMark, '');
}

module.exports = deburr;


/***/ }),

/***/ "./node_modules/lodash/isArray.js":
/*!****************************************!*\
  !*** ./node_modules/lodash/isArray.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * Checks if `value` is classified as an `Array` object.
 *
 * @static
 * @memberOf _
 * @since 0.1.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is an array, else `false`.
 * @example
 *
 * _.isArray([1, 2, 3]);
 * // => true
 *
 * _.isArray(document.body.children);
 * // => false
 *
 * _.isArray('abc');
 * // => false
 *
 * _.isArray(_.noop);
 * // => false
 */
var isArray = Array.isArray;

module.exports = isArray;


/***/ }),

/***/ "./node_modules/lodash/isObjectLike.js":
/*!*********************************************!*\
  !*** ./node_modules/lodash/isObjectLike.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * Checks if `value` is object-like. A value is object-like if it's not `null`
 * and has a `typeof` result of "object".
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is object-like, else `false`.
 * @example
 *
 * _.isObjectLike({});
 * // => true
 *
 * _.isObjectLike([1, 2, 3]);
 * // => true
 *
 * _.isObjectLike(_.noop);
 * // => false
 *
 * _.isObjectLike(null);
 * // => false
 */
function isObjectLike(value) {
  return value != null && typeof value == 'object';
}

module.exports = isObjectLike;


/***/ }),

/***/ "./node_modules/lodash/isSymbol.js":
/*!*****************************************!*\
  !*** ./node_modules/lodash/isSymbol.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var baseGetTag = __webpack_require__(/*! ./_baseGetTag */ "./node_modules/lodash/_baseGetTag.js"),
    isObjectLike = __webpack_require__(/*! ./isObjectLike */ "./node_modules/lodash/isObjectLike.js");

/** `Object#toString` result references. */
var symbolTag = '[object Symbol]';

/**
 * Checks if `value` is classified as a `Symbol` primitive or object.
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to check.
 * @returns {boolean} Returns `true` if `value` is a symbol, else `false`.
 * @example
 *
 * _.isSymbol(Symbol.iterator);
 * // => true
 *
 * _.isSymbol('abc');
 * // => false
 */
function isSymbol(value) {
  return typeof value == 'symbol' ||
    (isObjectLike(value) && baseGetTag(value) == symbolTag);
}

module.exports = isSymbol;


/***/ }),

/***/ "./node_modules/lodash/toString.js":
/*!*****************************************!*\
  !*** ./node_modules/lodash/toString.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var baseToString = __webpack_require__(/*! ./_baseToString */ "./node_modules/lodash/_baseToString.js");

/**
 * Converts `value` to a string. An empty string is returned for `null`
 * and `undefined` values. The sign of `-0` is preserved.
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category Lang
 * @param {*} value The value to convert.
 * @returns {string} Returns the converted string.
 * @example
 *
 * _.toString(null);
 * // => ''
 *
 * _.toString(-0);
 * // => '-0'
 *
 * _.toString([1, 2, 3]);
 * // => '1,2,3'
 */
function toString(value) {
  return value == null ? '' : baseToString(value);
}

module.exports = toString;


/***/ }),

/***/ "./node_modules/lodash/upperFirst.js":
/*!*******************************************!*\
  !*** ./node_modules/lodash/upperFirst.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var createCaseFirst = __webpack_require__(/*! ./_createCaseFirst */ "./node_modules/lodash/_createCaseFirst.js");

/**
 * Converts the first character of `string` to upper case.
 *
 * @static
 * @memberOf _
 * @since 4.0.0
 * @category String
 * @param {string} [string=''] The string to convert.
 * @returns {string} Returns the converted string.
 * @example
 *
 * _.upperFirst('fred');
 * // => 'Fred'
 *
 * _.upperFirst('FRED');
 * // => 'FRED'
 */
var upperFirst = createCaseFirst('toUpperCase');

module.exports = upperFirst;


/***/ }),

/***/ "./node_modules/lodash/words.js":
/*!**************************************!*\
  !*** ./node_modules/lodash/words.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var asciiWords = __webpack_require__(/*! ./_asciiWords */ "./node_modules/lodash/_asciiWords.js"),
    hasUnicodeWord = __webpack_require__(/*! ./_hasUnicodeWord */ "./node_modules/lodash/_hasUnicodeWord.js"),
    toString = __webpack_require__(/*! ./toString */ "./node_modules/lodash/toString.js"),
    unicodeWords = __webpack_require__(/*! ./_unicodeWords */ "./node_modules/lodash/_unicodeWords.js");

/**
 * Splits `string` into an array of its words.
 *
 * @static
 * @memberOf _
 * @since 3.0.0
 * @category String
 * @param {string} [string=''] The string to inspect.
 * @param {RegExp|string} [pattern] The pattern to match words.
 * @param- {Object} [guard] Enables use as an iteratee for methods like `_.map`.
 * @returns {Array} Returns the words of `string`.
 * @example
 *
 * _.words('fred, barney, & pebbles');
 * // => ['fred', 'barney', 'pebbles']
 *
 * _.words('fred, barney, & pebbles', /[^, ]+/g);
 * // => ['fred', 'barney', '&', 'pebbles']
 */
function words(string, pattern, guard) {
  string = toString(string);
  pattern = guard ? undefined : pattern;

  if (pattern === undefined) {
    return hasUnicodeWord(string) ? unicodeWords(string) : asciiWords(string);
  }
  return string.match(pattern) || [];
}

module.exports = words;


/***/ }),

/***/ "./node_modules/magnific-popup/dist/jquery.magnific-popup.js":
/*!*******************************************************************!*\
  !*** ./node_modules/magnific-popup/dist/jquery.magnific-popup.js ***!
  \*******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*! Magnific Popup - v1.1.0 - 2016-02-20
* http://dimsemenov.com/plugins/magnific-popup/
* Copyright (c) 2016 Dmitry Semenov; */
;(function (factory) { 
if (true) { 
 // AMD. Register as an anonymous module. 
 !(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
				__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
				(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__)); 
 } else {} 
 }(function($) { 

/*>>core*/
/**
 * 
 * Magnific Popup Core JS file
 * 
 */


/**
 * Private static constants
 */
var CLOSE_EVENT = 'Close',
	BEFORE_CLOSE_EVENT = 'BeforeClose',
	AFTER_CLOSE_EVENT = 'AfterClose',
	BEFORE_APPEND_EVENT = 'BeforeAppend',
	MARKUP_PARSE_EVENT = 'MarkupParse',
	OPEN_EVENT = 'Open',
	CHANGE_EVENT = 'Change',
	NS = 'mfp',
	EVENT_NS = '.' + NS,
	READY_CLASS = 'mfp-ready',
	REMOVING_CLASS = 'mfp-removing',
	PREVENT_CLOSE_CLASS = 'mfp-prevent-close';


/**
 * Private vars 
 */
/*jshint -W079 */
var mfp, // As we have only one instance of MagnificPopup object, we define it locally to not to use 'this'
	MagnificPopup = function(){},
	_isJQ = !!(window.jQuery),
	_prevStatus,
	_window = $(window),
	_document,
	_prevContentType,
	_wrapClasses,
	_currPopupType;


/**
 * Private functions
 */
var _mfpOn = function(name, f) {
		mfp.ev.on(NS + name + EVENT_NS, f);
	},
	_getEl = function(className, appendTo, html, raw) {
		var el = document.createElement('div');
		el.className = 'mfp-'+className;
		if(html) {
			el.innerHTML = html;
		}
		if(!raw) {
			el = $(el);
			if(appendTo) {
				el.appendTo(appendTo);
			}
		} else if(appendTo) {
			appendTo.appendChild(el);
		}
		return el;
	},
	_mfpTrigger = function(e, data) {
		mfp.ev.triggerHandler(NS + e, data);

		if(mfp.st.callbacks) {
			// converts "mfpEventName" to "eventName" callback and triggers it if it's present
			e = e.charAt(0).toLowerCase() + e.slice(1);
			if(mfp.st.callbacks[e]) {
				mfp.st.callbacks[e].apply(mfp, $.isArray(data) ? data : [data]);
			}
		}
	},
	_getCloseBtn = function(type) {
		if(type !== _currPopupType || !mfp.currTemplate.closeBtn) {
			mfp.currTemplate.closeBtn = $( mfp.st.closeMarkup.replace('%title%', mfp.st.tClose ) );
			_currPopupType = type;
		}
		return mfp.currTemplate.closeBtn;
	},
	// Initialize Magnific Popup only when called at least once
	_checkInstance = function() {
		if(!$.magnificPopup.instance) {
			/*jshint -W020 */
			mfp = new MagnificPopup();
			mfp.init();
			$.magnificPopup.instance = mfp;
		}
	},
	// CSS transition detection, http://stackoverflow.com/questions/7264899/detect-css-transitions-using-javascript-and-without-modernizr
	supportsTransitions = function() {
		var s = document.createElement('p').style, // 's' for style. better to create an element if body yet to exist
			v = ['ms','O','Moz','Webkit']; // 'v' for vendor

		if( s['transition'] !== undefined ) {
			return true; 
		}
			
		while( v.length ) {
			if( v.pop() + 'Transition' in s ) {
				return true;
			}
		}
				
		return false;
	};



/**
 * Public functions
 */
MagnificPopup.prototype = {

	constructor: MagnificPopup,

	/**
	 * Initializes Magnific Popup plugin. 
	 * This function is triggered only once when $.fn.magnificPopup or $.magnificPopup is executed
	 */
	init: function() {
		var appVersion = navigator.appVersion;
		mfp.isLowIE = mfp.isIE8 = document.all && !document.addEventListener;
		mfp.isAndroid = (/android/gi).test(appVersion);
		mfp.isIOS = (/iphone|ipad|ipod/gi).test(appVersion);
		mfp.supportsTransition = supportsTransitions();

		// We disable fixed positioned lightbox on devices that don't handle it nicely.
		// If you know a better way of detecting this - let me know.
		mfp.probablyMobile = (mfp.isAndroid || mfp.isIOS || /(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent) );
		_document = $(document);

		mfp.popupsCache = {};
	},

	/**
	 * Opens popup
	 * @param  data [description]
	 */
	open: function(data) {

		var i;

		if(data.isObj === false) { 
			// convert jQuery collection to array to avoid conflicts later
			mfp.items = data.items.toArray();

			mfp.index = 0;
			var items = data.items,
				item;
			for(i = 0; i < items.length; i++) {
				item = items[i];
				if(item.parsed) {
					item = item.el[0];
				}
				if(item === data.el[0]) {
					mfp.index = i;
					break;
				}
			}
		} else {
			mfp.items = $.isArray(data.items) ? data.items : [data.items];
			mfp.index = data.index || 0;
		}

		// if popup is already opened - we just update the content
		if(mfp.isOpen) {
			mfp.updateItemHTML();
			return;
		}
		
		mfp.types = []; 
		_wrapClasses = '';
		if(data.mainEl && data.mainEl.length) {
			mfp.ev = data.mainEl.eq(0);
		} else {
			mfp.ev = _document;
		}

		if(data.key) {
			if(!mfp.popupsCache[data.key]) {
				mfp.popupsCache[data.key] = {};
			}
			mfp.currTemplate = mfp.popupsCache[data.key];
		} else {
			mfp.currTemplate = {};
		}



		mfp.st = $.extend(true, {}, $.magnificPopup.defaults, data ); 
		mfp.fixedContentPos = mfp.st.fixedContentPos === 'auto' ? !mfp.probablyMobile : mfp.st.fixedContentPos;

		if(mfp.st.modal) {
			mfp.st.closeOnContentClick = false;
			mfp.st.closeOnBgClick = false;
			mfp.st.showCloseBtn = false;
			mfp.st.enableEscapeKey = false;
		}
		

		// Building markup
		// main containers are created only once
		if(!mfp.bgOverlay) {

			// Dark overlay
			mfp.bgOverlay = _getEl('bg').on('click'+EVENT_NS, function() {
				mfp.close();
			});

			mfp.wrap = _getEl('wrap').attr('tabindex', -1).on('click'+EVENT_NS, function(e) {
				if(mfp._checkIfClose(e.target)) {
					mfp.close();
				}
			});

			mfp.container = _getEl('container', mfp.wrap);
		}

		mfp.contentContainer = _getEl('content');
		if(mfp.st.preloader) {
			mfp.preloader = _getEl('preloader', mfp.container, mfp.st.tLoading);
		}


		// Initializing modules
		var modules = $.magnificPopup.modules;
		for(i = 0; i < modules.length; i++) {
			var n = modules[i];
			n = n.charAt(0).toUpperCase() + n.slice(1);
			mfp['init'+n].call(mfp);
		}
		_mfpTrigger('BeforeOpen');


		if(mfp.st.showCloseBtn) {
			// Close button
			if(!mfp.st.closeBtnInside) {
				mfp.wrap.append( _getCloseBtn() );
			} else {
				_mfpOn(MARKUP_PARSE_EVENT, function(e, template, values, item) {
					values.close_replaceWith = _getCloseBtn(item.type);
				});
				_wrapClasses += ' mfp-close-btn-in';
			}
		}

		if(mfp.st.alignTop) {
			_wrapClasses += ' mfp-align-top';
		}

	

		if(mfp.fixedContentPos) {
			mfp.wrap.css({
				overflow: mfp.st.overflowY,
				overflowX: 'hidden',
				overflowY: mfp.st.overflowY
			});
		} else {
			mfp.wrap.css({ 
				top: _window.scrollTop(),
				position: 'absolute'
			});
		}
		if( mfp.st.fixedBgPos === false || (mfp.st.fixedBgPos === 'auto' && !mfp.fixedContentPos) ) {
			mfp.bgOverlay.css({
				height: _document.height(),
				position: 'absolute'
			});
		}

		

		if(mfp.st.enableEscapeKey) {
			// Close on ESC key
			_document.on('keyup' + EVENT_NS, function(e) {
				if(e.keyCode === 27) {
					mfp.close();
				}
			});
		}

		_window.on('resize' + EVENT_NS, function() {
			mfp.updateSize();
		});


		if(!mfp.st.closeOnContentClick) {
			_wrapClasses += ' mfp-auto-cursor';
		}
		
		if(_wrapClasses)
			mfp.wrap.addClass(_wrapClasses);


		// this triggers recalculation of layout, so we get it once to not to trigger twice
		var windowHeight = mfp.wH = _window.height();

		
		var windowStyles = {};

		if( mfp.fixedContentPos ) {
            if(mfp._hasScrollBar(windowHeight)){
                var s = mfp._getScrollbarSize();
                if(s) {
                    windowStyles.marginRight = s;
                }
            }
        }

		if(mfp.fixedContentPos) {
			if(!mfp.isIE7) {
				windowStyles.overflow = 'hidden';
			} else {
				// ie7 double-scroll bug
				$('body, html').css('overflow', 'hidden');
			}
		}

		
		
		var classesToadd = mfp.st.mainClass;
		if(mfp.isIE7) {
			classesToadd += ' mfp-ie7';
		}
		if(classesToadd) {
			mfp._addClassToMFP( classesToadd );
		}

		// add content
		mfp.updateItemHTML();

		_mfpTrigger('BuildControls');

		// remove scrollbar, add margin e.t.c
		$('html').css(windowStyles);
		
		// add everything to DOM
		mfp.bgOverlay.add(mfp.wrap).prependTo( mfp.st.prependTo || $(document.body) );

		// Save last focused element
		mfp._lastFocusedEl = document.activeElement;
		
		// Wait for next cycle to allow CSS transition
		setTimeout(function() {
			
			if(mfp.content) {
				mfp._addClassToMFP(READY_CLASS);
				mfp._setFocus();
			} else {
				// if content is not defined (not loaded e.t.c) we add class only for BG
				mfp.bgOverlay.addClass(READY_CLASS);
			}
			
			// Trap the focus in popup
			_document.on('focusin' + EVENT_NS, mfp._onFocusIn);

		}, 16);

		mfp.isOpen = true;
		mfp.updateSize(windowHeight);
		_mfpTrigger(OPEN_EVENT);

		return data;
	},

	/**
	 * Closes the popup
	 */
	close: function() {
		if(!mfp.isOpen) return;
		_mfpTrigger(BEFORE_CLOSE_EVENT);

		mfp.isOpen = false;
		// for CSS3 animation
		if(mfp.st.removalDelay && !mfp.isLowIE && mfp.supportsTransition )  {
			mfp._addClassToMFP(REMOVING_CLASS);
			setTimeout(function() {
				mfp._close();
			}, mfp.st.removalDelay);
		} else {
			mfp._close();
		}
	},

	/**
	 * Helper for close() function
	 */
	_close: function() {
		_mfpTrigger(CLOSE_EVENT);

		var classesToRemove = REMOVING_CLASS + ' ' + READY_CLASS + ' ';

		mfp.bgOverlay.detach();
		mfp.wrap.detach();
		mfp.container.empty();

		if(mfp.st.mainClass) {
			classesToRemove += mfp.st.mainClass + ' ';
		}

		mfp._removeClassFromMFP(classesToRemove);

		if(mfp.fixedContentPos) {
			var windowStyles = {marginRight: ''};
			if(mfp.isIE7) {
				$('body, html').css('overflow', '');
			} else {
				windowStyles.overflow = '';
			}
			$('html').css(windowStyles);
		}
		
		_document.off('keyup' + EVENT_NS + ' focusin' + EVENT_NS);
		mfp.ev.off(EVENT_NS);

		// clean up DOM elements that aren't removed
		mfp.wrap.attr('class', 'mfp-wrap').removeAttr('style');
		mfp.bgOverlay.attr('class', 'mfp-bg');
		mfp.container.attr('class', 'mfp-container');

		// remove close button from target element
		if(mfp.st.showCloseBtn &&
		(!mfp.st.closeBtnInside || mfp.currTemplate[mfp.currItem.type] === true)) {
			if(mfp.currTemplate.closeBtn)
				mfp.currTemplate.closeBtn.detach();
		}


		if(mfp.st.autoFocusLast && mfp._lastFocusedEl) {
			$(mfp._lastFocusedEl).focus(); // put tab focus back
		}
		mfp.currItem = null;	
		mfp.content = null;
		mfp.currTemplate = null;
		mfp.prevHeight = 0;

		_mfpTrigger(AFTER_CLOSE_EVENT);
	},
	
	updateSize: function(winHeight) {

		if(mfp.isIOS) {
			// fixes iOS nav bars https://github.com/dimsemenov/Magnific-Popup/issues/2
			var zoomLevel = document.documentElement.clientWidth / window.innerWidth;
			var height = window.innerHeight * zoomLevel;
			mfp.wrap.css('height', height);
			mfp.wH = height;
		} else {
			mfp.wH = winHeight || _window.height();
		}
		// Fixes #84: popup incorrectly positioned with position:relative on body
		if(!mfp.fixedContentPos) {
			mfp.wrap.css('height', mfp.wH);
		}

		_mfpTrigger('Resize');

	},

	/**
	 * Set content of popup based on current index
	 */
	updateItemHTML: function() {
		var item = mfp.items[mfp.index];

		// Detach and perform modifications
		mfp.contentContainer.detach();

		if(mfp.content)
			mfp.content.detach();

		if(!item.parsed) {
			item = mfp.parseEl( mfp.index );
		}

		var type = item.type;

		_mfpTrigger('BeforeChange', [mfp.currItem ? mfp.currItem.type : '', type]);
		// BeforeChange event works like so:
		// _mfpOn('BeforeChange', function(e, prevType, newType) { });

		mfp.currItem = item;

		if(!mfp.currTemplate[type]) {
			var markup = mfp.st[type] ? mfp.st[type].markup : false;

			// allows to modify markup
			_mfpTrigger('FirstMarkupParse', markup);

			if(markup) {
				mfp.currTemplate[type] = $(markup);
			} else {
				// if there is no markup found we just define that template is parsed
				mfp.currTemplate[type] = true;
			}
		}

		if(_prevContentType && _prevContentType !== item.type) {
			mfp.container.removeClass('mfp-'+_prevContentType+'-holder');
		}

		var newContent = mfp['get' + type.charAt(0).toUpperCase() + type.slice(1)](item, mfp.currTemplate[type]);
		mfp.appendContent(newContent, type);

		item.preloaded = true;

		_mfpTrigger(CHANGE_EVENT, item);
		_prevContentType = item.type;

		// Append container back after its content changed
		mfp.container.prepend(mfp.contentContainer);

		_mfpTrigger('AfterChange');
	},


	/**
	 * Set HTML content of popup
	 */
	appendContent: function(newContent, type) {
		mfp.content = newContent;

		if(newContent) {
			if(mfp.st.showCloseBtn && mfp.st.closeBtnInside &&
				mfp.currTemplate[type] === true) {
				// if there is no markup, we just append close button element inside
				if(!mfp.content.find('.mfp-close').length) {
					mfp.content.append(_getCloseBtn());
				}
			} else {
				mfp.content = newContent;
			}
		} else {
			mfp.content = '';
		}

		_mfpTrigger(BEFORE_APPEND_EVENT);
		mfp.container.addClass('mfp-'+type+'-holder');

		mfp.contentContainer.append(mfp.content);
	},


	/**
	 * Creates Magnific Popup data object based on given data
	 * @param  {int} index Index of item to parse
	 */
	parseEl: function(index) {
		var item = mfp.items[index],
			type;

		if(item.tagName) {
			item = { el: $(item) };
		} else {
			type = item.type;
			item = { data: item, src: item.src };
		}

		if(item.el) {
			var types = mfp.types;

			// check for 'mfp-TYPE' class
			for(var i = 0; i < types.length; i++) {
				if( item.el.hasClass('mfp-'+types[i]) ) {
					type = types[i];
					break;
				}
			}

			item.src = item.el.attr('data-mfp-src');
			if(!item.src) {
				item.src = item.el.attr('href');
			}
		}

		item.type = type || mfp.st.type || 'inline';
		item.index = index;
		item.parsed = true;
		mfp.items[index] = item;
		_mfpTrigger('ElementParse', item);

		return mfp.items[index];
	},


	/**
	 * Initializes single popup or a group of popups
	 */
	addGroup: function(el, options) {
		var eHandler = function(e) {
			e.mfpEl = this;
			mfp._openClick(e, el, options);
		};

		if(!options) {
			options = {};
		}

		var eName = 'click.magnificPopup';
		options.mainEl = el;

		if(options.items) {
			options.isObj = true;
			el.off(eName).on(eName, eHandler);
		} else {
			options.isObj = false;
			if(options.delegate) {
				el.off(eName).on(eName, options.delegate , eHandler);
			} else {
				options.items = el;
				el.off(eName).on(eName, eHandler);
			}
		}
	},
	_openClick: function(e, el, options) {
		var midClick = options.midClick !== undefined ? options.midClick : $.magnificPopup.defaults.midClick;


		if(!midClick && ( e.which === 2 || e.ctrlKey || e.metaKey || e.altKey || e.shiftKey ) ) {
			return;
		}

		var disableOn = options.disableOn !== undefined ? options.disableOn : $.magnificPopup.defaults.disableOn;

		if(disableOn) {
			if($.isFunction(disableOn)) {
				if( !disableOn.call(mfp) ) {
					return true;
				}
			} else { // else it's number
				if( _window.width() < disableOn ) {
					return true;
				}
			}
		}

		if(e.type) {
			e.preventDefault();

			// This will prevent popup from closing if element is inside and popup is already opened
			if(mfp.isOpen) {
				e.stopPropagation();
			}
		}

		options.el = $(e.mfpEl);
		if(options.delegate) {
			options.items = el.find(options.delegate);
		}
		mfp.open(options);
	},


	/**
	 * Updates text on preloader
	 */
	updateStatus: function(status, text) {

		if(mfp.preloader) {
			if(_prevStatus !== status) {
				mfp.container.removeClass('mfp-s-'+_prevStatus);
			}

			if(!text && status === 'loading') {
				text = mfp.st.tLoading;
			}

			var data = {
				status: status,
				text: text
			};
			// allows to modify status
			_mfpTrigger('UpdateStatus', data);

			status = data.status;
			text = data.text;

			mfp.preloader.html(text);

			mfp.preloader.find('a').on('click', function(e) {
				e.stopImmediatePropagation();
			});

			mfp.container.addClass('mfp-s-'+status);
			_prevStatus = status;
		}
	},


	/*
		"Private" helpers that aren't private at all
	 */
	// Check to close popup or not
	// "target" is an element that was clicked
	_checkIfClose: function(target) {

		if($(target).hasClass(PREVENT_CLOSE_CLASS)) {
			return;
		}

		var closeOnContent = mfp.st.closeOnContentClick;
		var closeOnBg = mfp.st.closeOnBgClick;

		if(closeOnContent && closeOnBg) {
			return true;
		} else {

			// We close the popup if click is on close button or on preloader. Or if there is no content.
			if(!mfp.content || $(target).hasClass('mfp-close') || (mfp.preloader && target === mfp.preloader[0]) ) {
				return true;
			}

			// if click is outside the content
			if(  (target !== mfp.content[0] && !$.contains(mfp.content[0], target))  ) {
				if(closeOnBg) {
					// last check, if the clicked element is in DOM, (in case it's removed onclick)
					if( $.contains(document, target) ) {
						return true;
					}
				}
			} else if(closeOnContent) {
				return true;
			}

		}
		return false;
	},
	_addClassToMFP: function(cName) {
		mfp.bgOverlay.addClass(cName);
		mfp.wrap.addClass(cName);
	},
	_removeClassFromMFP: function(cName) {
		this.bgOverlay.removeClass(cName);
		mfp.wrap.removeClass(cName);
	},
	_hasScrollBar: function(winHeight) {
		return (  (mfp.isIE7 ? _document.height() : document.body.scrollHeight) > (winHeight || _window.height()) );
	},
	_setFocus: function() {
		(mfp.st.focus ? mfp.content.find(mfp.st.focus).eq(0) : mfp.wrap).focus();
	},
	_onFocusIn: function(e) {
		if( e.target !== mfp.wrap[0] && !$.contains(mfp.wrap[0], e.target) ) {
			mfp._setFocus();
			return false;
		}
	},
	_parseMarkup: function(template, values, item) {
		var arr;
		if(item.data) {
			values = $.extend(item.data, values);
		}
		_mfpTrigger(MARKUP_PARSE_EVENT, [template, values, item] );

		$.each(values, function(key, value) {
			if(value === undefined || value === false) {
				return true;
			}
			arr = key.split('_');
			if(arr.length > 1) {
				var el = template.find(EVENT_NS + '-'+arr[0]);

				if(el.length > 0) {
					var attr = arr[1];
					if(attr === 'replaceWith') {
						if(el[0] !== value[0]) {
							el.replaceWith(value);
						}
					} else if(attr === 'img') {
						if(el.is('img')) {
							el.attr('src', value);
						} else {
							el.replaceWith( $('<img>').attr('src', value).attr('class', el.attr('class')) );
						}
					} else {
						el.attr(arr[1], value);
					}
				}

			} else {
				template.find(EVENT_NS + '-'+key).html(value);
			}
		});
	},

	_getScrollbarSize: function() {
		// thx David
		if(mfp.scrollbarSize === undefined) {
			var scrollDiv = document.createElement("div");
			scrollDiv.style.cssText = 'width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;';
			document.body.appendChild(scrollDiv);
			mfp.scrollbarSize = scrollDiv.offsetWidth - scrollDiv.clientWidth;
			document.body.removeChild(scrollDiv);
		}
		return mfp.scrollbarSize;
	}

}; /* MagnificPopup core prototype end */




/**
 * Public static functions
 */
$.magnificPopup = {
	instance: null,
	proto: MagnificPopup.prototype,
	modules: [],

	open: function(options, index) {
		_checkInstance();

		if(!options) {
			options = {};
		} else {
			options = $.extend(true, {}, options);
		}

		options.isObj = true;
		options.index = index || 0;
		return this.instance.open(options);
	},

	close: function() {
		return $.magnificPopup.instance && $.magnificPopup.instance.close();
	},

	registerModule: function(name, module) {
		if(module.options) {
			$.magnificPopup.defaults[name] = module.options;
		}
		$.extend(this.proto, module.proto);
		this.modules.push(name);
	},

	defaults: {

		// Info about options is in docs:
		// http://dimsemenov.com/plugins/magnific-popup/documentation.html#options

		disableOn: 0,

		key: null,

		midClick: false,

		mainClass: '',

		preloader: true,

		focus: '', // CSS selector of input to focus after popup is opened

		closeOnContentClick: false,

		closeOnBgClick: true,

		closeBtnInside: true,

		showCloseBtn: true,

		enableEscapeKey: true,

		modal: false,

		alignTop: false,

		removalDelay: 0,

		prependTo: null,

		fixedContentPos: 'auto',

		fixedBgPos: 'auto',

		overflowY: 'auto',

		closeMarkup: '<button title="%title%" type="button" class="mfp-close">&#215;</button>',

		tClose: 'Close (Esc)',

		tLoading: 'Loading...',

		autoFocusLast: true

	}
};



$.fn.magnificPopup = function(options) {
	_checkInstance();

	var jqEl = $(this);

	// We call some API method of first param is a string
	if (typeof options === "string" ) {

		if(options === 'open') {
			var items,
				itemOpts = _isJQ ? jqEl.data('magnificPopup') : jqEl[0].magnificPopup,
				index = parseInt(arguments[1], 10) || 0;

			if(itemOpts.items) {
				items = itemOpts.items[index];
			} else {
				items = jqEl;
				if(itemOpts.delegate) {
					items = items.find(itemOpts.delegate);
				}
				items = items.eq( index );
			}
			mfp._openClick({mfpEl:items}, jqEl, itemOpts);
		} else {
			if(mfp.isOpen)
				mfp[options].apply(mfp, Array.prototype.slice.call(arguments, 1));
		}

	} else {
		// clone options obj
		options = $.extend(true, {}, options);

		/*
		 * As Zepto doesn't support .data() method for objects
		 * and it works only in normal browsers
		 * we assign "options" object directly to the DOM element. FTW!
		 */
		if(_isJQ) {
			jqEl.data('magnificPopup', options);
		} else {
			jqEl[0].magnificPopup = options;
		}

		mfp.addGroup(jqEl, options);

	}
	return jqEl;
};

/*>>core*/

/*>>inline*/

var INLINE_NS = 'inline',
	_hiddenClass,
	_inlinePlaceholder,
	_lastInlineElement,
	_putInlineElementsBack = function() {
		if(_lastInlineElement) {
			_inlinePlaceholder.after( _lastInlineElement.addClass(_hiddenClass) ).detach();
			_lastInlineElement = null;
		}
	};

$.magnificPopup.registerModule(INLINE_NS, {
	options: {
		hiddenClass: 'hide', // will be appended with `mfp-` prefix
		markup: '',
		tNotFound: 'Content not found'
	},
	proto: {

		initInline: function() {
			mfp.types.push(INLINE_NS);

			_mfpOn(CLOSE_EVENT+'.'+INLINE_NS, function() {
				_putInlineElementsBack();
			});
		},

		getInline: function(item, template) {

			_putInlineElementsBack();

			if(item.src) {
				var inlineSt = mfp.st.inline,
					el = $(item.src);

				if(el.length) {

					// If target element has parent - we replace it with placeholder and put it back after popup is closed
					var parent = el[0].parentNode;
					if(parent && parent.tagName) {
						if(!_inlinePlaceholder) {
							_hiddenClass = inlineSt.hiddenClass;
							_inlinePlaceholder = _getEl(_hiddenClass);
							_hiddenClass = 'mfp-'+_hiddenClass;
						}
						// replace target inline element with placeholder
						_lastInlineElement = el.after(_inlinePlaceholder).detach().removeClass(_hiddenClass);
					}

					mfp.updateStatus('ready');
				} else {
					mfp.updateStatus('error', inlineSt.tNotFound);
					el = $('<div>');
				}

				item.inlineElement = el;
				return el;
			}

			mfp.updateStatus('ready');
			mfp._parseMarkup(template, {}, item);
			return template;
		}
	}
});

/*>>inline*/

/*>>ajax*/
var AJAX_NS = 'ajax',
	_ajaxCur,
	_removeAjaxCursor = function() {
		if(_ajaxCur) {
			$(document.body).removeClass(_ajaxCur);
		}
	},
	_destroyAjaxRequest = function() {
		_removeAjaxCursor();
		if(mfp.req) {
			mfp.req.abort();
		}
	};

$.magnificPopup.registerModule(AJAX_NS, {

	options: {
		settings: null,
		cursor: 'mfp-ajax-cur',
		tError: '<a href="%url%">The content</a> could not be loaded.'
	},

	proto: {
		initAjax: function() {
			mfp.types.push(AJAX_NS);
			_ajaxCur = mfp.st.ajax.cursor;

			_mfpOn(CLOSE_EVENT+'.'+AJAX_NS, _destroyAjaxRequest);
			_mfpOn('BeforeChange.' + AJAX_NS, _destroyAjaxRequest);
		},
		getAjax: function(item) {

			if(_ajaxCur) {
				$(document.body).addClass(_ajaxCur);
			}

			mfp.updateStatus('loading');

			var opts = $.extend({
				url: item.src,
				success: function(data, textStatus, jqXHR) {
					var temp = {
						data:data,
						xhr:jqXHR
					};

					_mfpTrigger('ParseAjax', temp);

					mfp.appendContent( $(temp.data), AJAX_NS );

					item.finished = true;

					_removeAjaxCursor();

					mfp._setFocus();

					setTimeout(function() {
						mfp.wrap.addClass(READY_CLASS);
					}, 16);

					mfp.updateStatus('ready');

					_mfpTrigger('AjaxContentAdded');
				},
				error: function() {
					_removeAjaxCursor();
					item.finished = item.loadError = true;
					mfp.updateStatus('error', mfp.st.ajax.tError.replace('%url%', item.src));
				}
			}, mfp.st.ajax.settings);

			mfp.req = $.ajax(opts);

			return '';
		}
	}
});

/*>>ajax*/

/*>>image*/
var _imgInterval,
	_getTitle = function(item) {
		if(item.data && item.data.title !== undefined)
			return item.data.title;

		var src = mfp.st.image.titleSrc;

		if(src) {
			if($.isFunction(src)) {
				return src.call(mfp, item);
			} else if(item.el) {
				return item.el.attr(src) || '';
			}
		}
		return '';
	};

$.magnificPopup.registerModule('image', {

	options: {
		markup: '<div class="mfp-figure">'+
					'<div class="mfp-close"></div>'+
					'<figure>'+
						'<div class="mfp-img"></div>'+
						'<figcaption>'+
							'<div class="mfp-bottom-bar">'+
								'<div class="mfp-title"></div>'+
								'<div class="mfp-counter"></div>'+
							'</div>'+
						'</figcaption>'+
					'</figure>'+
				'</div>',
		cursor: 'mfp-zoom-out-cur',
		titleSrc: 'title',
		verticalFit: true,
		tError: '<a href="%url%">The image</a> could not be loaded.'
	},

	proto: {
		initImage: function() {
			var imgSt = mfp.st.image,
				ns = '.image';

			mfp.types.push('image');

			_mfpOn(OPEN_EVENT+ns, function() {
				if(mfp.currItem.type === 'image' && imgSt.cursor) {
					$(document.body).addClass(imgSt.cursor);
				}
			});

			_mfpOn(CLOSE_EVENT+ns, function() {
				if(imgSt.cursor) {
					$(document.body).removeClass(imgSt.cursor);
				}
				_window.off('resize' + EVENT_NS);
			});

			_mfpOn('Resize'+ns, mfp.resizeImage);
			if(mfp.isLowIE) {
				_mfpOn('AfterChange', mfp.resizeImage);
			}
		},
		resizeImage: function() {
			var item = mfp.currItem;
			if(!item || !item.img) return;

			if(mfp.st.image.verticalFit) {
				var decr = 0;
				// fix box-sizing in ie7/8
				if(mfp.isLowIE) {
					decr = parseInt(item.img.css('padding-top'), 10) + parseInt(item.img.css('padding-bottom'),10);
				}
				item.img.css('max-height', mfp.wH-decr);
			}
		},
		_onImageHasSize: function(item) {
			if(item.img) {

				item.hasSize = true;

				if(_imgInterval) {
					clearInterval(_imgInterval);
				}

				item.isCheckingImgSize = false;

				_mfpTrigger('ImageHasSize', item);

				if(item.imgHidden) {
					if(mfp.content)
						mfp.content.removeClass('mfp-loading');

					item.imgHidden = false;
				}

			}
		},

		/**
		 * Function that loops until the image has size to display elements that rely on it asap
		 */
		findImageSize: function(item) {

			var counter = 0,
				img = item.img[0],
				mfpSetInterval = function(delay) {

					if(_imgInterval) {
						clearInterval(_imgInterval);
					}
					// decelerating interval that checks for size of an image
					_imgInterval = setInterval(function() {
						if(img.naturalWidth > 0) {
							mfp._onImageHasSize(item);
							return;
						}

						if(counter > 200) {
							clearInterval(_imgInterval);
						}

						counter++;
						if(counter === 3) {
							mfpSetInterval(10);
						} else if(counter === 40) {
							mfpSetInterval(50);
						} else if(counter === 100) {
							mfpSetInterval(500);
						}
					}, delay);
				};

			mfpSetInterval(1);
		},

		getImage: function(item, template) {

			var guard = 0,

				// image load complete handler
				onLoadComplete = function() {
					if(item) {
						if (item.img[0].complete) {
							item.img.off('.mfploader');

							if(item === mfp.currItem){
								mfp._onImageHasSize(item);

								mfp.updateStatus('ready');
							}

							item.hasSize = true;
							item.loaded = true;

							_mfpTrigger('ImageLoadComplete');

						}
						else {
							// if image complete check fails 200 times (20 sec), we assume that there was an error.
							guard++;
							if(guard < 200) {
								setTimeout(onLoadComplete,100);
							} else {
								onLoadError();
							}
						}
					}
				},

				// image error handler
				onLoadError = function() {
					if(item) {
						item.img.off('.mfploader');
						if(item === mfp.currItem){
							mfp._onImageHasSize(item);
							mfp.updateStatus('error', imgSt.tError.replace('%url%', item.src) );
						}

						item.hasSize = true;
						item.loaded = true;
						item.loadError = true;
					}
				},
				imgSt = mfp.st.image;


			var el = template.find('.mfp-img');
			if(el.length) {
				var img = document.createElement('img');
				img.className = 'mfp-img';
				if(item.el && item.el.find('img').length) {
					img.alt = item.el.find('img').attr('alt');
				}
				item.img = $(img).on('load.mfploader', onLoadComplete).on('error.mfploader', onLoadError);
				img.src = item.src;

				// without clone() "error" event is not firing when IMG is replaced by new IMG
				// TODO: find a way to avoid such cloning
				if(el.is('img')) {
					item.img = item.img.clone();
				}

				img = item.img[0];
				if(img.naturalWidth > 0) {
					item.hasSize = true;
				} else if(!img.width) {
					item.hasSize = false;
				}
			}

			mfp._parseMarkup(template, {
				title: _getTitle(item),
				img_replaceWith: item.img
			}, item);

			mfp.resizeImage();

			if(item.hasSize) {
				if(_imgInterval) clearInterval(_imgInterval);

				if(item.loadError) {
					template.addClass('mfp-loading');
					mfp.updateStatus('error', imgSt.tError.replace('%url%', item.src) );
				} else {
					template.removeClass('mfp-loading');
					mfp.updateStatus('ready');
				}
				return template;
			}

			mfp.updateStatus('loading');
			item.loading = true;

			if(!item.hasSize) {
				item.imgHidden = true;
				template.addClass('mfp-loading');
				mfp.findImageSize(item);
			}

			return template;
		}
	}
});

/*>>image*/

/*>>zoom*/
var hasMozTransform,
	getHasMozTransform = function() {
		if(hasMozTransform === undefined) {
			hasMozTransform = document.createElement('p').style.MozTransform !== undefined;
		}
		return hasMozTransform;
	};

$.magnificPopup.registerModule('zoom', {

	options: {
		enabled: false,
		easing: 'ease-in-out',
		duration: 300,
		opener: function(element) {
			return element.is('img') ? element : element.find('img');
		}
	},

	proto: {

		initZoom: function() {
			var zoomSt = mfp.st.zoom,
				ns = '.zoom',
				image;

			if(!zoomSt.enabled || !mfp.supportsTransition) {
				return;
			}

			var duration = zoomSt.duration,
				getElToAnimate = function(image) {
					var newImg = image.clone().removeAttr('style').removeAttr('class').addClass('mfp-animated-image'),
						transition = 'all '+(zoomSt.duration/1000)+'s ' + zoomSt.easing,
						cssObj = {
							position: 'fixed',
							zIndex: 9999,
							left: 0,
							top: 0,
							'-webkit-backface-visibility': 'hidden'
						},
						t = 'transition';

					cssObj['-webkit-'+t] = cssObj['-moz-'+t] = cssObj['-o-'+t] = cssObj[t] = transition;

					newImg.css(cssObj);
					return newImg;
				},
				showMainContent = function() {
					mfp.content.css('visibility', 'visible');
				},
				openTimeout,
				animatedImg;

			_mfpOn('BuildControls'+ns, function() {
				if(mfp._allowZoom()) {

					clearTimeout(openTimeout);
					mfp.content.css('visibility', 'hidden');

					// Basically, all code below does is clones existing image, puts in on top of the current one and animated it

					image = mfp._getItemToZoom();

					if(!image) {
						showMainContent();
						return;
					}

					animatedImg = getElToAnimate(image);

					animatedImg.css( mfp._getOffset() );

					mfp.wrap.append(animatedImg);

					openTimeout = setTimeout(function() {
						animatedImg.css( mfp._getOffset( true ) );
						openTimeout = setTimeout(function() {

							showMainContent();

							setTimeout(function() {
								animatedImg.remove();
								image = animatedImg = null;
								_mfpTrigger('ZoomAnimationEnded');
							}, 16); // avoid blink when switching images

						}, duration); // this timeout equals animation duration

					}, 16); // by adding this timeout we avoid short glitch at the beginning of animation


					// Lots of timeouts...
				}
			});
			_mfpOn(BEFORE_CLOSE_EVENT+ns, function() {
				if(mfp._allowZoom()) {

					clearTimeout(openTimeout);

					mfp.st.removalDelay = duration;

					if(!image) {
						image = mfp._getItemToZoom();
						if(!image) {
							return;
						}
						animatedImg = getElToAnimate(image);
					}

					animatedImg.css( mfp._getOffset(true) );
					mfp.wrap.append(animatedImg);
					mfp.content.css('visibility', 'hidden');

					setTimeout(function() {
						animatedImg.css( mfp._getOffset() );
					}, 16);
				}

			});

			_mfpOn(CLOSE_EVENT+ns, function() {
				if(mfp._allowZoom()) {
					showMainContent();
					if(animatedImg) {
						animatedImg.remove();
					}
					image = null;
				}
			});
		},

		_allowZoom: function() {
			return mfp.currItem.type === 'image';
		},

		_getItemToZoom: function() {
			if(mfp.currItem.hasSize) {
				return mfp.currItem.img;
			} else {
				return false;
			}
		},

		// Get element postion relative to viewport
		_getOffset: function(isLarge) {
			var el;
			if(isLarge) {
				el = mfp.currItem.img;
			} else {
				el = mfp.st.zoom.opener(mfp.currItem.el || mfp.currItem);
			}

			var offset = el.offset();
			var paddingTop = parseInt(el.css('padding-top'),10);
			var paddingBottom = parseInt(el.css('padding-bottom'),10);
			offset.top -= ( $(window).scrollTop() - paddingTop );


			/*

			Animating left + top + width/height looks glitchy in Firefox, but perfect in Chrome. And vice-versa.

			 */
			var obj = {
				width: el.width(),
				// fix Zepto height+padding issue
				height: (_isJQ ? el.innerHeight() : el[0].offsetHeight) - paddingBottom - paddingTop
			};

			// I hate to do this, but there is no another option
			if( getHasMozTransform() ) {
				obj['-moz-transform'] = obj['transform'] = 'translate(' + offset.left + 'px,' + offset.top + 'px)';
			} else {
				obj.left = offset.left;
				obj.top = offset.top;
			}
			return obj;
		}

	}
});



/*>>zoom*/

/*>>iframe*/

var IFRAME_NS = 'iframe',
	_emptyPage = '//about:blank',

	_fixIframeBugs = function(isShowing) {
		if(mfp.currTemplate[IFRAME_NS]) {
			var el = mfp.currTemplate[IFRAME_NS].find('iframe');
			if(el.length) {
				// reset src after the popup is closed to avoid "video keeps playing after popup is closed" bug
				if(!isShowing) {
					el[0].src = _emptyPage;
				}

				// IE8 black screen bug fix
				if(mfp.isIE8) {
					el.css('display', isShowing ? 'block' : 'none');
				}
			}
		}
	};

$.magnificPopup.registerModule(IFRAME_NS, {

	options: {
		markup: '<div class="mfp-iframe-scaler">'+
					'<div class="mfp-close"></div>'+
					'<iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe>'+
				'</div>',

		srcAction: 'iframe_src',

		// we don't care and support only one default type of URL by default
		patterns: {
			youtube: {
				index: 'youtube.com',
				id: 'v=',
				src: '//www.youtube.com/embed/%id%?autoplay=1'
			},
			vimeo: {
				index: 'vimeo.com/',
				id: '/',
				src: '//player.vimeo.com/video/%id%?autoplay=1'
			},
			gmaps: {
				index: '//maps.google.',
				src: '%id%&output=embed'
			}
		}
	},

	proto: {
		initIframe: function() {
			mfp.types.push(IFRAME_NS);

			_mfpOn('BeforeChange', function(e, prevType, newType) {
				if(prevType !== newType) {
					if(prevType === IFRAME_NS) {
						_fixIframeBugs(); // iframe if removed
					} else if(newType === IFRAME_NS) {
						_fixIframeBugs(true); // iframe is showing
					}
				}// else {
					// iframe source is switched, don't do anything
				//}
			});

			_mfpOn(CLOSE_EVENT + '.' + IFRAME_NS, function() {
				_fixIframeBugs();
			});
		},

		getIframe: function(item, template) {
			var embedSrc = item.src;
			var iframeSt = mfp.st.iframe;

			$.each(iframeSt.patterns, function() {
				if(embedSrc.indexOf( this.index ) > -1) {
					if(this.id) {
						if(typeof this.id === 'string') {
							embedSrc = embedSrc.substr(embedSrc.lastIndexOf(this.id)+this.id.length, embedSrc.length);
						} else {
							embedSrc = this.id.call( this, embedSrc );
						}
					}
					embedSrc = this.src.replace('%id%', embedSrc );
					return false; // break;
				}
			});

			var dataObj = {};
			if(iframeSt.srcAction) {
				dataObj[iframeSt.srcAction] = embedSrc;
			}
			mfp._parseMarkup(template, dataObj, item);

			mfp.updateStatus('ready');

			return template;
		}
	}
});



/*>>iframe*/

/*>>gallery*/
/**
 * Get looped index depending on number of slides
 */
var _getLoopedId = function(index) {
		var numSlides = mfp.items.length;
		if(index > numSlides - 1) {
			return index - numSlides;
		} else  if(index < 0) {
			return numSlides + index;
		}
		return index;
	},
	_replaceCurrTotal = function(text, curr, total) {
		return text.replace(/%curr%/gi, curr + 1).replace(/%total%/gi, total);
	};

$.magnificPopup.registerModule('gallery', {

	options: {
		enabled: false,
		arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',
		preload: [0,2],
		navigateByImgClick: true,
		arrows: true,

		tPrev: 'Previous (Left arrow key)',
		tNext: 'Next (Right arrow key)',
		tCounter: '%curr% of %total%'
	},

	proto: {
		initGallery: function() {

			var gSt = mfp.st.gallery,
				ns = '.mfp-gallery';

			mfp.direction = true; // true - next, false - prev

			if(!gSt || !gSt.enabled ) return false;

			_wrapClasses += ' mfp-gallery';

			_mfpOn(OPEN_EVENT+ns, function() {

				if(gSt.navigateByImgClick) {
					mfp.wrap.on('click'+ns, '.mfp-img', function() {
						if(mfp.items.length > 1) {
							mfp.next();
							return false;
						}
					});
				}

				_document.on('keydown'+ns, function(e) {
					if (e.keyCode === 37) {
						mfp.prev();
					} else if (e.keyCode === 39) {
						mfp.next();
					}
				});
			});

			_mfpOn('UpdateStatus'+ns, function(e, data) {
				if(data.text) {
					data.text = _replaceCurrTotal(data.text, mfp.currItem.index, mfp.items.length);
				}
			});

			_mfpOn(MARKUP_PARSE_EVENT+ns, function(e, element, values, item) {
				var l = mfp.items.length;
				values.counter = l > 1 ? _replaceCurrTotal(gSt.tCounter, item.index, l) : '';
			});

			_mfpOn('BuildControls' + ns, function() {
				if(mfp.items.length > 1 && gSt.arrows && !mfp.arrowLeft) {
					var markup = gSt.arrowMarkup,
						arrowLeft = mfp.arrowLeft = $( markup.replace(/%title%/gi, gSt.tPrev).replace(/%dir%/gi, 'left') ).addClass(PREVENT_CLOSE_CLASS),
						arrowRight = mfp.arrowRight = $( markup.replace(/%title%/gi, gSt.tNext).replace(/%dir%/gi, 'right') ).addClass(PREVENT_CLOSE_CLASS);

					arrowLeft.click(function() {
						mfp.prev();
					});
					arrowRight.click(function() {
						mfp.next();
					});

					mfp.container.append(arrowLeft.add(arrowRight));
				}
			});

			_mfpOn(CHANGE_EVENT+ns, function() {
				if(mfp._preloadTimeout) clearTimeout(mfp._preloadTimeout);

				mfp._preloadTimeout = setTimeout(function() {
					mfp.preloadNearbyImages();
					mfp._preloadTimeout = null;
				}, 16);
			});


			_mfpOn(CLOSE_EVENT+ns, function() {
				_document.off(ns);
				mfp.wrap.off('click'+ns);
				mfp.arrowRight = mfp.arrowLeft = null;
			});

		},
		next: function() {
			mfp.direction = true;
			mfp.index = _getLoopedId(mfp.index + 1);
			mfp.updateItemHTML();
		},
		prev: function() {
			mfp.direction = false;
			mfp.index = _getLoopedId(mfp.index - 1);
			mfp.updateItemHTML();
		},
		goTo: function(newIndex) {
			mfp.direction = (newIndex >= mfp.index);
			mfp.index = newIndex;
			mfp.updateItemHTML();
		},
		preloadNearbyImages: function() {
			var p = mfp.st.gallery.preload,
				preloadBefore = Math.min(p[0], mfp.items.length),
				preloadAfter = Math.min(p[1], mfp.items.length),
				i;

			for(i = 1; i <= (mfp.direction ? preloadAfter : preloadBefore); i++) {
				mfp._preloadItem(mfp.index+i);
			}
			for(i = 1; i <= (mfp.direction ? preloadBefore : preloadAfter); i++) {
				mfp._preloadItem(mfp.index-i);
			}
		},
		_preloadItem: function(index) {
			index = _getLoopedId(index);

			if(mfp.items[index].preloaded) {
				return;
			}

			var item = mfp.items[index];
			if(!item.parsed) {
				item = mfp.parseEl( index );
			}

			_mfpTrigger('LazyLoad', item);

			if(item.type === 'image') {
				item.img = $('<img class="mfp-img" />').on('load.mfploader', function() {
					item.hasSize = true;
				}).on('error.mfploader', function() {
					item.hasSize = true;
					item.loadError = true;
					_mfpTrigger('LazyLoadError', item);
				}).attr('src', item.src);
			}


			item.preloaded = true;
		}
	}
});

/*>>gallery*/

/*>>retina*/

var RETINA_NS = 'retina';

$.magnificPopup.registerModule(RETINA_NS, {
	options: {
		replaceSrc: function(item) {
			return item.src.replace(/\.\w+$/, function(m) { return '@2x' + m; });
		},
		ratio: 1 // Function or number.  Set to 1 to disable.
	},
	proto: {
		initRetina: function() {
			if(window.devicePixelRatio > 1) {

				var st = mfp.st.retina,
					ratio = st.ratio;

				ratio = !isNaN(ratio) ? ratio : ratio();

				if(ratio > 1) {
					_mfpOn('ImageHasSize' + '.' + RETINA_NS, function(e, item) {
						item.img.css({
							'max-width': item.img[0].naturalWidth / ratio,
							'width': '100%'
						});
					});
					_mfpOn('ElementParse' + '.' + RETINA_NS, function(e, item) {
						item.src = st.replaceSrc(item, ratio);
					});
				}
			}

		}
	}
});

/*>>retina*/
 _checkInstance(); }));

/***/ }),

/***/ "./node_modules/webpack/buildin/global.js":
/*!***********************************!*\
  !*** (webpack)/buildin/global.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

var g;

// This works in non-strict mode
g = (function() {
	return this;
})();

try {
	// This works if eval is allowed (see CSP)
	g = g || new Function("return this")();
} catch (e) {
	// This works if the window reference is available
	if (typeof window === "object") g = window;
}

// g can still be undefined, but nothing to do about it...
// We return undefined, instead of nothing here, so it's
// easier to handle this case. if(!global) { ...}

module.exports = g;


/***/ }),

/***/ "./resources/assets/js/app.js":
/*!************************************!*\
  !*** ./resources/assets/js/app.js ***!
  \************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _site__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./site */ "./resources/assets/js/site.js");

$(document).ready(function () {
  Object(_site__WEBPACK_IMPORTED_MODULE_0__["default"])().init();
});

/***/ }),

/***/ "./resources/assets/js/component/barcode-reader.js":
/*!*********************************************************!*\
  !*** ./resources/assets/js/component/barcode-reader.js ***!
  \*********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return BarcodeReader; });
/* harmony import */ var _utilities_select_component__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utilities/select-component */ "./resources/assets/js/utilities/select-component.js");
/* harmony import */ var _ericblade_quagga2__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @ericblade/quagga2 */ "./node_modules/@ericblade/quagga2/dist/quagga.min.js");
/* harmony import */ var _ericblade_quagga2__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_ericblade_quagga2__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var magnific_popup__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! magnific-popup */ "./node_modules/magnific-popup/dist/jquery.magnific-popup.js");
/* harmony import */ var magnific_popup__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(magnific_popup__WEBPACK_IMPORTED_MODULE_3__);
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

// import 'velocity-animate'
// import 'velocity-animate/velocity.ui.min'

 // ES6




var BarcodeReader = function BarcodeReader(element) {
  var _this = this;

  var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

  _classCallCheck(this, BarcodeReader);

  this.openCameraModal = function (event) {
    jquery__WEBPACK_IMPORTED_MODULE_2__["magnificPopup"].open({
      items: {
        type: 'inline',
        src: '#quagga-popup'
      },
      callbacks: {
        open: function open() {
          _this.initQuagga();

          _this.attachBarcodeActions();
        },
        close: function close() {
          if (_ericblade_quagga2__WEBPACK_IMPORTED_MODULE_1___default.a) {
            _ericblade_quagga2__WEBPACK_IMPORTED_MODULE_1___default.a.stop();
          }

          _this.detachBarcodeActions();
        } // e.t.c.

      }
    });
  };

  this.initQuagga = function () {
    if (_ericblade_quagga2__WEBPACK_IMPORTED_MODULE_1___default.a) {
      _ericblade_quagga2__WEBPACK_IMPORTED_MODULE_1___default.a.stop();
    }

    _ericblade_quagga2__WEBPACK_IMPORTED_MODULE_1___default.a.init({
      inputStream: {
        name: "Live",
        type: "LiveStream",
        target: '#quagga-popup__video'
      },
      numOfWorkers: navigator.hardwareConcurrency ? navigator.hardwareConcurrency : 4,
      decoder: {
        readers: ["code_128_reader", 'upc_reader', 'ean_reader', 'ean_8_reader']
      }
    }, function (err) {
      if (err) {
        jquery__WEBPACK_IMPORTED_MODULE_2__('#quagga-popup__video').html('<div class="alert alert-danger"><strong><i class="fa fa-exclamation-triangle"></i> ' + err.name + '</strong>: ' + err.message + '</div>');
        return;
      }

      _ericblade_quagga2__WEBPACK_IMPORTED_MODULE_1___default.a.start();
    }); // Make sure, QuaggaJS draws frames an lines around possible
    // barcodes on the live stream

    _ericblade_quagga2__WEBPACK_IMPORTED_MODULE_1___default.a.onProcessed(function (result) {
      var drawingCtx = _ericblade_quagga2__WEBPACK_IMPORTED_MODULE_1___default.a.canvas.ctx.overlay,
          drawingCanvas = _ericblade_quagga2__WEBPACK_IMPORTED_MODULE_1___default.a.canvas.dom.overlay;

      if (result) {
        if (result.boxes) {
          drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
          result.boxes.filter(function (box) {
            return box !== result.box;
          }).forEach(function (box) {
            _ericblade_quagga2__WEBPACK_IMPORTED_MODULE_1___default.a.ImageDebug.drawPath(box, {
              x: 0,
              y: 1
            }, drawingCtx, {
              color: "green",
              lineWidth: 2
            });
          });
        }

        if (result.box) {
          _ericblade_quagga2__WEBPACK_IMPORTED_MODULE_1___default.a.ImageDebug.drawPath(result.box, {
            x: 0,
            y: 1
          }, drawingCtx, {
            color: "#00F",
            lineWidth: 2
          });
        }

        if (result.codeResult && result.codeResult.code) {
          _ericblade_quagga2__WEBPACK_IMPORTED_MODULE_1___default.a.ImageDebug.drawPath(result.line, {
            x: 'x',
            y: 'y'
          }, drawingCtx, {
            color: 'red',
            lineWidth: 3
          });
        }
      }
    }); // Once a barcode had been read successfully, stop quagga and
    // close the modal after a second to let the user notice where
    // the barcode had actually been found.

    _ericblade_quagga2__WEBPACK_IMPORTED_MODULE_1___default.a.onDetected(function (result) {
      if (result.codeResult.code) {
        _this.$barcodeInput.val(result.codeResult.code);

        _ericblade_quagga2__WEBPACK_IMPORTED_MODULE_1___default.a.pause();

        _this.enableBarcodeActions();

        _this.$freezeFrame.attr('src', _ericblade_quagga2__WEBPACK_IMPORTED_MODULE_1___default.a.canvas.dom.image.toDataURL());

        _this.$modalContainer.addClass('paused');
      }
    });
  };

  this.attachBarcodeActions = function () {
    _this.$barcodeRefresh.on('click', _this.handleBarcodeRefresh);

    _this.$barcodeButton.on('click', _this.handleBarcodeSubmit);
  };

  this.detachBarcodeActions = function () {
    _this.$barcodeRefresh.off('click');

    _this.$barcodeButton.off('click');
  };

  this.enableBarcodeActions = function () {
    _this.$barcodeRefresh.prop('disabled', false);

    _this.$barcodeButton.prop('disabled', false);
  };

  this.handleBarcodeRefresh = function () {
    _this.$barcodeInput.val('');

    _ericblade_quagga2__WEBPACK_IMPORTED_MODULE_1___default.a.start();

    _this.$modalContainer.removeClass('paused');

    _this.disableBarcodeActions();
  };

  this.handleBarcodeSubmit = function () {
    _this.$input.val(_this.$barcodeInput.val());

    jquery__WEBPACK_IMPORTED_MODULE_2__["magnificPopup"].close();

    _this.$parentForm.submit();

    console.log(_this.$parentForm);
  };

  this.disableBarcodeActions = function () {
    _this.$barcodeRefresh.prop('disabled', true);

    _this.$barcodeButton.prop('disabled', true);
  };

  this.$component = Object(_utilities_select_component__WEBPACK_IMPORTED_MODULE_0__["default"])(element);
  this.$input = this.$component.elements.input;
  this.$button = this.$component.elements.button;
  this.$parentForm = this.$input.closest('form');
  this.$modalContainer = jquery__WEBPACK_IMPORTED_MODULE_2__('#quagga-popup');
  this.$barcodeInput = jquery__WEBPACK_IMPORTED_MODULE_2__('#barcode-reader-input');
  this.$barcodeButton = jquery__WEBPACK_IMPORTED_MODULE_2__('#barcode-reader-button');
  this.$barcodeRefresh = jquery__WEBPACK_IMPORTED_MODULE_2__('#barcode-reader-refresh');
  this.$freezeFrame = jquery__WEBPACK_IMPORTED_MODULE_2__('#freeze-frame');
  this.$button.on('click', this.openCameraModal);
};



/***/ }),

/***/ "./resources/assets/js/component/focusable-input-group.js":
/*!****************************************************************!*\
  !*** ./resources/assets/js/component/focusable-input-group.js ***!
  \****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return FocusableInputGroup; });
/* harmony import */ var _utilities_select_component__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utilities/select-component */ "./resources/assets/js/utilities/select-component.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_1__);
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }




var FocusableInputGroup = function FocusableInputGroup(element) {
  var _this = this;

  var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

  _classCallCheck(this, FocusableInputGroup);

  this.handleFocus = function (e) {
    _this.$component.addClass('focused');
  };

  this.handleBlur = function (e) {
    _this.$component.removeClass('focused');
  };

  this.$component = Object(_utilities_select_component__WEBPACK_IMPORTED_MODULE_0__["default"])(element);
  this.$input = this.$component.elements.input;
  this.$input.on('focus', this.handleFocus);
  this.$input.on('blur', this.handleBlur);
};



/***/ }),

/***/ "./resources/assets/js/component/listing-type-select.js":
/*!**************************************************************!*\
  !*** ./resources/assets/js/component/listing-type-select.js ***!
  \**************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return ListingTypeSelect; });
/* harmony import */ var _utilities_select_component__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utilities/select-component */ "./resources/assets/js/utilities/select-component.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }



var ListingTypeSelect = function ListingTypeSelect(element) {
  var _this = this;

  var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

  _classCallCheck(this, ListingTypeSelect);

  this.handleChange = function (e) {
    if (_this.$select.val() === 'buy-it-now') {
      _this.$quantity.addClass('visible');
    } else {
      _this.$quantity.removeClass('visible');
    }
  };

  this.$component = Object(_utilities_select_component__WEBPACK_IMPORTED_MODULE_0__["default"])(element);
  this.$select = this.$component.elements.select;
  this.$quantity = this.$component.elements.quantity;
  this.$select.on('change', this.handleChange);
  this.$select.trigger('change');
};



/***/ }),

/***/ "./resources/assets/js/component/new-product-image.js":
/*!************************************************************!*\
  !*** ./resources/assets/js/component/new-product-image.js ***!
  \************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return NewProductImage; });
/* harmony import */ var _utilities_select_component__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utilities/select-component */ "./resources/assets/js/utilities/select-component.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _product_image__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./product-image */ "./resources/assets/js/component/product-image.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }





var NewProductImage = function NewProductImage(element) {
  var _this = this;

  var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

  _classCallCheck(this, NewProductImage);

  this.handleChange = function () {
    _this.startSpinner();

    jquery__WEBPACK_IMPORTED_MODULE_1__["ajax"]({
      type: 'POST',
      url: _this.$input.attr('data-action'),
      data: _this.getFormData(),
      cache: false,
      contentType: false,
      processData: false,
      success: function success(data) {
        console.log("success");
        console.log(data);
        jquery__WEBPACK_IMPORTED_MODULE_1__["each"](data.images, function (i, image) {
          _this.appendImage(image.filename, image.url);
        });

        _this.stopSpinner();

        _this.resetInput();
      },
      error: function error(data) {
        console.log("error");
        console.log(data);

        _this.stopSpinner();

        _this.showMessage();
      }
    });
  };

  this.getFormData = function () {
    var formData = new FormData();
    jquery__WEBPACK_IMPORTED_MODULE_1__["each"](_this.$input.get(0).files, function (i, file) {
      formData.append('image[]', file);
    });
    return formData;
  };

  this.startSpinner = function () {
    _this.$component.addClass('loading');
  };

  this.stopSpinner = function () {
    _this.$component.removeClass('loading');
  };

  this.appendImage = function (filename, url) {
    var $element = jquery__WEBPACK_IMPORTED_MODULE_1__("<div class=\"lister-product-image clearfix\" data-component=\"lister-product-image\" data-saved=\"false\">\n            <input\n                type=\"hidden\"\n                name=\"new_images[]\"\n                value=\"".concat(filename, "\"\n            />\n            <label class=\"col-sm-4 control-label\"></label>\n            <div class=\"col-sm-8 lister-product-image__display-container\">\n                <div class=\"lister-product-image__image-wrapper\"><img src=\"").concat(url, "\"></div>\n                <a href=\"#\" data-element=\"delete\"><i class=\"fa fa-trash\"></i> Delete</a>\n            </div>\n        </div>"));
    jquery__WEBPACK_IMPORTED_MODULE_1__('.images-wrapper').append($element);
    new _product_image__WEBPACK_IMPORTED_MODULE_2__["default"]($element);
  };

  this.resetInput = function () {
    _this.$input.val('');
  };

  this.showMessage = function (message) {
    _this.$message.html(message);
  };

  jquery__WEBPACK_IMPORTED_MODULE_1__["ajaxSetup"]({
    headers: {
      'X-CSRF-TOKEN': jquery__WEBPACK_IMPORTED_MODULE_1__('meta[name="csrf-token"]').attr('content')
    }
  });
  this.$component = Object(_utilities_select_component__WEBPACK_IMPORTED_MODULE_0__["default"])(element);
  this.$input = this.$component.elements.input;
  this.$spinner = this.$component.elements.spinner;
  this.$message = this.$component.elements.message;
  this.$input.on('change', this.handleChange);
};



/***/ }),

/***/ "./resources/assets/js/component/product-categories-child.js":
/*!*******************************************************************!*\
  !*** ./resources/assets/js/component/product-categories-child.js ***!
  \*******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return ProductCategoriesChild; });
/* harmony import */ var _utilities_select_component__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utilities/select-component */ "./resources/assets/js/utilities/select-component.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }



var ProductCategoriesChild = /*#__PURE__*/function () {
  function ProductCategoriesChild(element) {
    var _this = this;

    var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

    _classCallCheck(this, ProductCategoriesChild);

    this.handleChange = function (e) {
      if (!_this.hasChildComponent) {
        return;
      }

      _this.childComponent.setOptions(_this.getNewChildren());

      if (_this.$select.val() === 'new' && _this.hasChildComponent) {
        _this.childComponent.value('new');
      }

      if (_this.$select.val() != '') {
        _this.childComponent.addClass('visible');
      } else {
        _this.childComponent.removeClass('visible');
      }

      _this.childComponent.trigger('change');
    };

    this.getNewChildren = function () {
      if (!(_this.$select.val() in _this.options)) {
        return {};
      }

      return _this.options[_this.$select.val()].children;
    };

    this.$component = Object(_utilities_select_component__WEBPACK_IMPORTED_MODULE_0__["default"])(element);
    this.$select = this.$component.find('select');
    this.prettyName = 'Child Category';

    if (typeof this.$component.attr('data-my-child-hierarchy-component') !== 'undefined') {
      this.hasChildComponent = true;
      this.childComponent = new ProductCategoriesChild($(this.$component.attr('data-my-child-hierarchy-component')));
    } else {
      this.hasChildComponent = false;
    }

    if (!this.hasChildComponent) {
      this.prettyName = 'Grandchild Category';
    }

    this.$select.on('change', this.handleChange);
  }

  _createClass(ProductCategoriesChild, [{
    key: "setOptions",
    value: function setOptions(options) {
      this.options = options;
      this.replaceOptions();
    }
  }, {
    key: "addClass",
    value: function addClass(the_class) {
      this.$component.addClass(the_class);
    }
  }, {
    key: "removeClass",
    value: function removeClass(the_class) {
      this.$component.removeClass(the_class);
    }
  }, {
    key: "replaceOptions",
    value: function replaceOptions() {
      var options = '';
      options += "<option value=\"\">Select ".concat(this.prettyName, "...</option>");
      options += "<option value=\"new\">New ".concat(this.prettyName, "...</option>");

      for (var i in this.options) {
        options += "<option value=\"".concat(this.options[i].id, "\">").concat(this.options[i].name, "</option>");
      }

      this.$select.html(options);
      this.$select.val(this.$select.attr('data-selected'));

      if (this.hasChildComponent) {
        this.childComponent.setOptions(this.getNewChildren());
      }
    }
  }, {
    key: "value",
    value: function value(_value) {
      if (typeof _value === 'undefined') {
        return this.$select.val();
      }

      this.$select.val(_value);
    }
  }, {
    key: "trigger",
    value: function trigger(eventName) {
      this.$select.trigger(eventName);
    }
  }]);

  return ProductCategoriesChild;
}();



/***/ }),

/***/ "./resources/assets/js/component/product-categories-hierarchy.js":
/*!***********************************************************************!*\
  !*** ./resources/assets/js/component/product-categories-hierarchy.js ***!
  \***********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return ProductCategoriesHierarchy; });
/* harmony import */ var _utilities_select_component__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utilities/select-component */ "./resources/assets/js/utilities/select-component.js");
/* harmony import */ var _product_categories_child__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./product-categories-child */ "./resources/assets/js/component/product-categories-child.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_2__);
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }





var ProductCategoriesHierarchy = function ProductCategoriesHierarchy(element) {
  var _this = this;

  var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

  _classCallCheck(this, ProductCategoriesHierarchy);

  this.handleChange = function (e) {
    _this.$childProductCategoriesComponent.setOptions(_this.getNewChildren());

    if (_this.$topSelect.val() != '') {
      _this.$childProductCategoriesComponent.addClass('visible');
    } else {
      _this.$childProductCategoriesComponent.removeClass('visible');
    }

    if (_this.$topSelect.val() === 'new') {
      _this.$childProductCategoriesComponent.value('new');
    }

    _this.$childProductCategoriesComponent.trigger('change');
  };

  this.getNewChildren = function () {
    if (!(_this.$topSelect.val() in _this.categories)) {
      return {};
    }

    return _this.categories[_this.$topSelect.val()].children;
  };

  this.$component = Object(_utilities_select_component__WEBPACK_IMPORTED_MODULE_0__["default"])(element);
  this.categories = window.categoryHierarchy;
  this.$topSelect = this.$component.find('[data-product-categories-hierarchy-element="topSelect"]');
  this.$topSelect.on('change', this.handleChange);
  this.$childProductCategoriesComponent = new _product_categories_child__WEBPACK_IMPORTED_MODULE_1__["default"](jquery__WEBPACK_IMPORTED_MODULE_2__('[data-product-categories-hierarchy-element="child-select"]'));
};



/***/ }),

/***/ "./resources/assets/js/component/product-image.js":
/*!********************************************************!*\
  !*** ./resources/assets/js/component/product-image.js ***!
  \********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return ProductImage; });
/* harmony import */ var _utilities_select_component__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utilities/select-component */ "./resources/assets/js/utilities/select-component.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }



var ProductImage = function ProductImage(element) {
  var _this = this;

  var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

  _classCallCheck(this, ProductImage);

  this.handleClick = function (e) {
    e.preventDefault();

    if (!confirm("Are you sure you want to delete this image?")) {
      return;
    }

    var deletableImage = _this.$component.find('input').val();

    _this.$component.html('');

    if (!_this.alreadySaved) {
      _this.$component.html('<input type="hidden" name="deletable_images[]" value="' + deletableImage + '">');
    }
  };

  this.$component = Object(_utilities_select_component__WEBPACK_IMPORTED_MODULE_0__["default"])(element);
  this.$delete = this.$component.elements["delete"];
  this.alreadySaved = this.$component.attr('data-saved') === 'false' ? false : true;
  this.$delete.on('click', this.handleClick);
};



/***/ }),

/***/ "./resources/assets/js/component/product-suggestion.js":
/*!*************************************************************!*\
  !*** ./resources/assets/js/component/product-suggestion.js ***!
  \*************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return ProductSuggestion; });
/* harmony import */ var _utilities_select_component__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utilities/select-component */ "./resources/assets/js/utilities/select-component.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var magnific_popup__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! magnific-popup */ "./node_modules/magnific-popup/dist/jquery.magnific-popup.js");
/* harmony import */ var magnific_popup__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(magnific_popup__WEBPACK_IMPORTED_MODULE_2__);
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }





var ProductSuggestion = function ProductSuggestion(element) {
  var _this = this;

  var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

  _classCallCheck(this, ProductSuggestion);

  this.openModal = function () {
    jquery__WEBPACK_IMPORTED_MODULE_1__["magnificPopup"].open({
      items: {
        type: 'inline',
        src: _this.$modalTrigger.attr('href')
      }
    });
  };

  this.$component = Object(_utilities_select_component__WEBPACK_IMPORTED_MODULE_0__["default"])(element);
  this.$modalTrigger = this.$component.elements.modalTrigger;
  this.$modalTrigger.on('click', this.openModal);
};



/***/ }),

/***/ "./resources/assets/js/component/select-or-new.js":
/*!********************************************************!*\
  !*** ./resources/assets/js/component/select-or-new.js ***!
  \********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return SelectOrNew; });
/* harmony import */ var _utilities_select_component__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../utilities/select-component */ "./resources/assets/js/utilities/select-component.js");
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }



var SelectOrNew = function SelectOrNew(element) {
  var _this = this;

  var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};

  _classCallCheck(this, SelectOrNew);

  this.handleChange = function (e) {
    if (_this.$select.val() == 'new') {
      _this.$new.addClass('visible');
    } else {
      _this.$new.removeClass('visible');
    }
  };

  this.$component = Object(_utilities_select_component__WEBPACK_IMPORTED_MODULE_0__["default"])(element);
  this.$select = this.$component.find('select');
  this.$new = this.$component.find('[data-element="new"]');
  this.$select.on('change', this.handleChange);
  this.$select.trigger('change');
};



/***/ }),

/***/ "./resources/assets/js/site.js":
/*!*************************************!*\
  !*** ./resources/assets/js/site.js ***!
  \*************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return Site; });
/* harmony import */ var _utilities_select_component__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./utilities/select-component */ "./resources/assets/js/utilities/select-component.js");
/* harmony import */ var _component_barcode_reader__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./component/barcode-reader */ "./resources/assets/js/component/barcode-reader.js");
/* harmony import */ var _component_product_suggestion__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./component/product-suggestion */ "./resources/assets/js/component/product-suggestion.js");
/* harmony import */ var _component_select_or_new__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./component/select-or-new */ "./resources/assets/js/component/select-or-new.js");
/* harmony import */ var _component_new_product_image__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./component/new-product-image */ "./resources/assets/js/component/new-product-image.js");
/* harmony import */ var _component_product_image__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./component/product-image */ "./resources/assets/js/component/product-image.js");
/* harmony import */ var _component_listing_type_select__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./component/listing-type-select */ "./resources/assets/js/component/listing-type-select.js");
/* harmony import */ var _component_product_categories_hierarchy__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./component/product-categories-hierarchy */ "./resources/assets/js/component/product-categories-hierarchy.js");
/* harmony import */ var _component_focusable_input_group__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./component/focusable-input-group */ "./resources/assets/js/component/focusable-input-group.js");









function Site() {
  var init = function init() {
    startCustom();
  };

  var startCustom = function startCustom() {
    Object(_utilities_select_component__WEBPACK_IMPORTED_MODULE_0__["default"])('barcode-reader').each(function (index, element) {
      return new _component_barcode_reader__WEBPACK_IMPORTED_MODULE_1__["default"](element);
    });
    Object(_utilities_select_component__WEBPACK_IMPORTED_MODULE_0__["default"])('product-suggestion').each(function (index, element) {
      return new _component_product_suggestion__WEBPACK_IMPORTED_MODULE_2__["default"](element);
    });
    Object(_utilities_select_component__WEBPACK_IMPORTED_MODULE_0__["default"])('product-categories-hierarchy').each(function (index, element) {
      return new _component_product_categories_hierarchy__WEBPACK_IMPORTED_MODULE_7__["default"](element);
    });
    Object(_utilities_select_component__WEBPACK_IMPORTED_MODULE_0__["default"])('select-or-new').each(function (index, element) {
      return new _component_select_or_new__WEBPACK_IMPORTED_MODULE_3__["default"](element);
    });
    Object(_utilities_select_component__WEBPACK_IMPORTED_MODULE_0__["default"])('new-product-image').each(function (index, element) {
      return new _component_new_product_image__WEBPACK_IMPORTED_MODULE_4__["default"](element);
    });
    Object(_utilities_select_component__WEBPACK_IMPORTED_MODULE_0__["default"])('lister-product-image').each(function (index, element) {
      return new _component_product_image__WEBPACK_IMPORTED_MODULE_5__["default"](element);
    });
    Object(_utilities_select_component__WEBPACK_IMPORTED_MODULE_0__["default"])('listing-type-select').each(function (index, element) {
      return new _component_listing_type_select__WEBPACK_IMPORTED_MODULE_6__["default"](element);
    });
    Object(_utilities_select_component__WEBPACK_IMPORTED_MODULE_0__["default"])('focusable-input-group').each(function (index, element) {
      return new _component_focusable_input_group__WEBPACK_IMPORTED_MODULE_8__["default"](element);
    });
  };

  return {
    init: init
  };
}

/***/ }),

/***/ "./resources/assets/js/utilities/select-component.js":
/*!***********************************************************!*\
  !*** ./resources/assets/js/utilities/select-component.js ***!
  \***********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return selectComponent; });
/* harmony import */ var lodash_camelCase__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! lodash/camelCase */ "./node_modules/lodash/camelCase.js");
/* harmony import */ var lodash_camelCase__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(lodash_camelCase__WEBPACK_IMPORTED_MODULE_0__);


var componentSelectorTemplate = function componentSelectorTemplate(name) {
  return "[data-component='".concat(name, "']");
};

var elementSelector = '[data-element]';
var componentSelector = '[data-component]';
function selectComponent(target) {
  var debug = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
  var selector = $.type(target) === 'string' ? componentSelectorTemplate(target) : false;
  var $component;
  var elements;

  var init = function init() {
    if (target instanceof jQuery) {
      $component = target;
    } else {
      $component = selector ? $(selector) : $(target);
    }

    $component.elements = buildElements($component);
    $component.refresh = refresh;
    $component.selector = selector;
  };

  var buildElements = function buildElements(component) {
    var elementMap = {};
    var $elements = component.find(elementSelector);

    if (debug) {
      console.log('Original elements', $elements);
    }

    if ($elements.length) {
      var $excludedElements = $elements.filter(function (index, element) {
        return $(element).parentsUntil($component).filter(componentSelector).length;
      });
      $elements = $elements.not($excludedElements);

      if (debug) {
        console.log('Filtered elements', $elements);
      }

      $elements.each(function (index, element) {
        var $element = $(element);
        var elementName = lodash_camelCase__WEBPACK_IMPORTED_MODULE_0___default()($element.data('element'));

        if (elementMap.hasOwnProperty(elementName)) {
          elementMap[elementName] = elementMap[elementName].add($element);
        } else {
          elementMap[elementName] = $element;
        }
      });
      return elementMap;
    }

    return {};
  };

  var refresh = function refresh(debugSetting) {
    debug = debugSetting;
    $component.elements = buildElements($component);
  };

  init();
  return $component;
}

/***/ }),

/***/ "./resources/assets/sass/app.scss":
/*!****************************************!*\
  !*** ./resources/assets/sass/app.scss ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!***************************************************************************!*\
  !*** multi ./resources/assets/js/app.js ./resources/assets/sass/app.scss ***!
  \***************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Volumes/dev/oohology/catchndealz/resources/assets/js/app.js */"./resources/assets/js/app.js");
module.exports = __webpack_require__(/*! /Volumes/dev/oohology/catchndealz/resources/assets/sass/app.scss */"./resources/assets/sass/app.scss");


/***/ })

/******/ });