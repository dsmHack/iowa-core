(window.webpackJsonp=window.webpackJsonp||[]).push([[8],{"/h46":function(t,n,e){e("cHUd")("Map")},"3Hq7":function(t,n,e){"use strict";var r=e("q1tI"),o=e.n(r),i=e("YFqc"),s=e.n(i),a=o.a.createElement,u={marginRight:15};function f(){return a("div",null,a(s.a,{href:"/"},a("a",{style:u},"Home")),a(s.a,{href:"/about"},a("a",{style:u},"About")))}e.d(n,"a",(function(){return p}));var c=o.a.createElement,l={margin:20,padding:20,border:"1px solid #DDD"};function p(t){return c("div",{style:l},c(f,null),t.children)}},"8iia":function(t,n,e){var r=e("QMMT"),o=e("RRc/");t.exports=function(t){return function(){if(r(this)!=t)throw TypeError(t+"#toJSON isn't generic");return o(this)}}},LX0d:function(t,n,e){t.exports=e("UDep")},RNiq:function(t,n,e){"use strict";e.r(n);var r=e("eVuF"),o=e.n(r),i=e("ln6h"),s=e.n(i),a=e("q1tI"),u=e.n(a),f=e("3Hq7"),c=e("YFqc"),l=e.n(c),p=e("vcXL"),h=e.n(p),v=u.a.createElement,d=function(t){return v(f.a,null,v("h1",null,"Batman TV Shows"),v("ul",null,t.shows.map((function(t){return v("li",{key:t.id},v(l.a,{href:"/show/[id]",as:"/show/".concat(t.id)},v("a",null,t.name)))}))))};d.getInitialProps=function(){var t,n;return s.a.async((function(e){for(;;)switch(e.prev=e.next){case 0:return e.next=2,s.a.awrap(h()("https://api.tvmaze.com/search/shows?q=batman"));case 2:return t=e.sent,e.next=5,s.a.awrap(t.json());case 5:return n=e.sent,console.log("Show data fetched. Count: ".concat(n.length)),e.abrupt("return",{shows:n.map((function(t){return t.show}))});case 8:case"end":return e.stop()}}),null,null,null,o.a)},n.default=d},"RRc/":function(t,n,e){var r=e("oioR");t.exports=function(t,n){var e=[];return r(t,!1,e.push,e,n),e}},UDep:function(t,n,e){e("wgeU"),e("FlQf"),e("bBy9"),e("g33z"),e("XLbu"),e("/h46"),e("dVTT"),t.exports=e("WEpk").Map},Wu5q:function(t,n,e){"use strict";var r=e("2faE").f,o=e("oVml"),i=e("XJU/"),s=e("2GTP"),a=e("EXMj"),u=e("oioR"),f=e("MPFp"),c=e("UO39"),l=e("TJWN"),p=e("jmDH"),h=e("6/1s").fastKey,v=e("n3ko"),d=p?"_s":"size",_=function(t,n){var e,r=h(n);if("F"!==r)return t._i[r];for(e=t._f;e;e=e.n)if(e.k==n)return e};t.exports={getConstructor:function(t,n,e,f){var c=t((function(t,r){a(t,c,n,"_i"),t._t=n,t._i=o(null),t._f=void 0,t._l=void 0,t[d]=0,void 0!=r&&u(r,e,t[f],t)}));return i(c.prototype,{clear:function(){for(var t=v(this,n),e=t._i,r=t._f;r;r=r.n)r.r=!0,r.p&&(r.p=r.p.n=void 0),delete e[r.i];t._f=t._l=void 0,t[d]=0},delete:function(t){var e=v(this,n),r=_(e,t);if(r){var o=r.n,i=r.p;delete e._i[r.i],r.r=!0,i&&(i.n=o),o&&(o.p=i),e._f==r&&(e._f=o),e._l==r&&(e._l=i),e[d]--}return!!r},forEach:function(t){v(this,n);for(var e,r=s(t,arguments.length>1?arguments[1]:void 0,3);e=e?e.n:this._f;)for(r(e.v,e.k,this);e&&e.r;)e=e.p},has:function(t){return!!_(v(this,n),t)}}),p&&r(c.prototype,"size",{get:function(){return v(this,n)[d]}}),c},def:function(t,n,e){var r,o,i=_(t,n);return i?i.v=e:(t._l=i={i:o=h(n,!0),k:n,v:e,p:r=t._l,n:void 0,r:!1},t._f||(t._f=i),r&&(r.n=i),t[d]++,"F"!==o&&(t._i[o]=i)),t},getEntry:_,setStrong:function(t,n,e){f(t,n,(function(t,e){this._t=v(t,n),this._k=e,this._l=void 0}),(function(){for(var t=this._k,n=this._l;n&&n.r;)n=n.p;return this._t&&(this._l=n=n?n.n:this._t._f)?c(0,"keys"==t?n.k:"values"==t?n.v:[n.k,n.v]):(this._t=void 0,c(1))}),e?"entries":"values",!e,!0),l(n)}}},XLbu:function(t,n,e){var r=e("Y7ZC");r(r.P+r.R,"Map",{toJSON:e("8iia")("Map")})},YFqc:function(t,n,e){t.exports=e("cTJO")},cTJO:function(t,n,e){"use strict";var r=e("8+Nu"),o=e("/HRN"),i=e("WaGi"),s=e("ZDA2"),a=e("/+P4"),u=e("N9n2"),f=e("LX0d"),c=e("KI45"),l=e("5Uuq");n.__esModule=!0,n.default=void 0;var p,h=l(e("q1tI")),v=e("CxY0"),d=e("g/15"),_=c(e("nOHt"));function g(t){return t&&"object"===typeof t?(0,d.formatWithValidation)(t):t}var w=new f,y=window.IntersectionObserver,m={};function k(){return p||(y?p=new y((function(t){t.forEach((function(t){if(w.has(t.target)){var n=w.get(t.target);(t.isIntersecting||t.intersectionRatio>0)&&(p.unobserve(t.target),w.delete(t.target),n())}}))}),{rootMargin:"200px"}):void 0)}var E=function(t){function n(t){var e;return o(this,n),(e=s(this,a(n).call(this,t))).p=void 0,e.cleanUpListeners=function(){},e.formatUrls=function(t){var n=null,e=null,r=null;return function(o,i){if(r&&o===n&&i===e)return r;var s=t(o,i);return n=o,e=i,r=s,s}}((function(t,n){return{href:g(t),as:n?g(n):n}})),e.linkClicked=function(t){var n=t.currentTarget,r=n.nodeName,o=n.target;if("A"!==r||!(o&&"_self"!==o||t.metaKey||t.ctrlKey||t.shiftKey||t.nativeEvent&&2===t.nativeEvent.which)){var i=e.formatUrls(e.props.href,e.props.as),s=i.href,a=i.as;if(function(t){var n=(0,v.parse)(t,!1,!0),e=(0,v.parse)((0,d.getLocationOrigin)(),!1,!0);return!n.host||n.protocol===e.protocol&&n.host===e.host}(s)){var u=window.location.pathname;s=(0,v.resolve)(u,s),a=a?(0,v.resolve)(u,a):s,t.preventDefault();var f=e.props.scroll;null==f&&(f=a.indexOf("#")<0),_.default[e.props.replace?"replace":"push"](s,a,{shallow:e.props.shallow}).then((function(t){t&&f&&(window.scrollTo(0,0),document.body.focus())}))}}},e.p=!1!==t.prefetch,e}return u(n,t),i(n,[{key:"componentWillUnmount",value:function(){this.cleanUpListeners()}},{key:"getPaths",value:function(){var t=window.location.pathname,n=this.formatUrls(this.props.href,this.props.as),e=n.href,r=n.as,o=(0,v.resolve)(t,e);return[o,r?(0,v.resolve)(t,r):o]}},{key:"handleRef",value:function(t){var n=this,e=m[this.getPaths()[0]];this.p&&y&&t&&t.tagName&&(this.cleanUpListeners(),e||(this.cleanUpListeners=function(t,n){var e=k();return e?(e.observe(t),w.set(t,n),function(){try{e.unobserve(t)}catch(n){console.error(n)}w.delete(t)}):function(){}}(t,(function(){n.prefetch()}))))}},{key:"prefetch",value:function(t){if(this.p){var n=this.getPaths(),e=r(n,2),o=e[0],i=e[1];_.default.prefetch(o,i,t),m[o]=!0}}},{key:"render",value:function(){var t=this,n=this.props.children,r=this.formatUrls(this.props.href,this.props.as),o=r.href,i=r.as;"string"===typeof n&&(n=h.default.createElement("a",null,n));var s=h.Children.only(n),a={ref:function(n){t.handleRef(n),s&&"object"===typeof s&&s.ref&&("function"===typeof s.ref?s.ref(n):"object"===typeof s.ref&&(s.ref.current=n))},onMouseEnter:function(n){s.props&&"function"===typeof s.props.onMouseEnter&&s.props.onMouseEnter(n),t.prefetch({priority:!0})},onClick:function(n){s.props&&"function"===typeof s.props.onClick&&s.props.onClick(n),n.defaultPrevented||t.linkClicked(n)}};!this.props.passHref&&("a"!==s.type||"href"in s.props)||(a.href=i||o);var u=e("P5f7").rewriteUrlForNextExport;return a.href&&"undefined"!==typeof __NEXT_DATA__&&__NEXT_DATA__.nextExport&&(a.href=u(a.href)),h.default.cloneElement(s,a)}}]),n}(h.Component);n.default=E},dVTT:function(t,n,e){e("aPfg")("Map")},g33z:function(t,n,e){"use strict";var r=e("Wu5q"),o=e("n3ko");t.exports=e("raTm")("Map",(function(t){return function(){return t(this,arguments.length>0?arguments[0]:void 0)}}),{get:function(t){var n=r.getEntry(o(this,"Map"),t);return n&&n.v},set:function(t,n){return r.def(o(this,"Map"),0===t?0:t,n)}},r,!0)},vcXL:function(t,n,e){"use strict";var r=self.fetch.bind(self);t.exports=r,t.exports.default=t.exports},vlRD:function(t,n,e){(window.__NEXT_P=window.__NEXT_P||[]).push(["/",function(){return e("RNiq")}])}},[["vlRD",1,2,0]]]);