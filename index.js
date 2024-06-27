(function() {
  "use strict";
  function normalizeComponent(scriptExports, render, staticRenderFns, functionalTemplate, injectStyles, scopeId, moduleIdentifier, shadowMode) {
    var options = typeof scriptExports === "function" ? scriptExports.options : scriptExports;
    if (render) {
      options.render = render;
      options.staticRenderFns = staticRenderFns;
      options._compiled = true;
    }
    return {
      exports: scriptExports,
      options
    };
  }
  const _sfc_main$2 = {
    // Put your section logic here
  };
  var _sfc_render$2 = function render() {
    var _vm = this;
    _vm._self._c;
    return _vm._m(0);
  };
  var _sfc_staticRenderFns$2 = [function() {
    var _vm = this, _c = _vm._self._c;
    return _c("section", { staticClass: "k-demo-section" }, [_c("header", { staticClass: "k-section-header" }, [_c("h2", { staticClass: "k-headline" }, [_vm._v("Your custom section")])])]);
  }];
  _sfc_render$2._withStripped = true;
  var __component__$2 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$2,
    _sfc_render$2,
    _sfc_staticRenderFns$2
  );
  __component__$2.options.__file = "/Users/stuff/Documents/projects/GS_MMH_WEB/site/plugins/kirby-oveda/src/components/DemoSection.vue";
  const _sfc_main$1 = {
    props: {
      orgs: Array
    }
    // Put your section logic here
  };
  var _sfc_render$1 = function render() {
    var _vm = this, _c = _vm._self._c;
    return _c("k-inside", [_c("k-view", { staticClass: "k-oveda-overview" }, [_c("k-header", [_vm._v("Movie reviews")]), _vm.orgs.length ? _c("k-items", { attrs: { "items": _vm.orgs } }, _vm._l(_vm.orgs, function(org, index) {
      return _c("k-item", { key: index, attrs: { "layout": _vm.card, "link": "https://test.de", "text": org.name, "target": "_blank" } });
    }), 1) : _vm._e(), _c("div", [_vm._v("No items available")])], 1)], 1);
  };
  var _sfc_staticRenderFns$1 = [];
  _sfc_render$1._withStripped = true;
  var __component__$1 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$1,
    _sfc_render$1,
    _sfc_staticRenderFns$1
  );
  __component__$1.options.__file = "/Users/stuff/Documents/projects/GS_MMH_WEB/site/plugins/kirby-oveda/src/components/OvedaOverview.vue";
  const OvedaOverview = __component__$1.exports;
  const _sfc_main = {
    props: {
      events: Array
    },
    // Put your section logic here
    created() {
      console.log(this.events);
    }
  };
  var _sfc_render = function render() {
    var _vm = this, _c = _vm._self._c;
    return _c("k-panel-inside", [_c("k-header", [_vm._v("Veranstalter")]), _c("k-text", [_vm._v(" Veranstaltungen: " + _vm._s(_vm.events.total) + " ")]), _c("k-text", [_vm._v(" Seite: " + _vm._s(_vm.events.page) + " ")]), _c("k-text", [_vm._v(" Elemente: " + _vm._s(Object.values(_vm.events.organizations).length) + " ")]), _vm.events.organizations ? _c("k-items", { staticClass: "elements", attrs: { "items": "1", "layout": "cardlets" } }, _vm._l(_vm.events.organizations, function(value, index) {
      return _c("k-item", { key: index, attrs: { "text": value.name, "info": value.description, "layout": "carlets" } });
    }), 1) : _c("div", [_vm._v("No items available")])], 1);
  };
  var _sfc_staticRenderFns = [];
  _sfc_render._withStripped = true;
  var __component__ = /* @__PURE__ */ normalizeComponent(
    _sfc_main,
    _sfc_render,
    _sfc_staticRenderFns
  );
  __component__.options.__file = "/Users/stuff/Documents/projects/GS_MMH_WEB/site/plugins/kirby-oveda/src/components/Organziers.vue";
  const Organizations = __component__.exports;
  window.panel.plugin("mmh-goslar/kirby-oveda", {
    components: {
      oveda: OvedaOverview,
      "k-events-view": Organizations
    }
  });
})();
