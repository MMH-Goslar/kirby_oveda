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
  const _sfc_main$3 = {
    props: {
      orgs: Array
    }
    // Put your section logic here
  };
  var _sfc_render$3 = function render() {
    var _vm = this, _c = _vm._self._c;
    return _c("k-inside", [_c("k-view", { staticClass: "k-oveda-overview" }, [_c("k-header", [_vm._v("Movie reviews")]), _vm.orgs.length ? _c("k-items", { attrs: { "items": _vm.orgs } }, _vm._l(_vm.orgs, function(org, index) {
      return _c("k-item", { key: index, attrs: { "layout": _vm.card, "link": "https://test.de", "text": org.name, "target": "_blank" } });
    }), 1) : _vm._e(), _c("div", [_vm._v("No items available")])], 1)], 1);
  };
  var _sfc_staticRenderFns$3 = [];
  _sfc_render$3._withStripped = true;
  var __component__$3 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$3,
    _sfc_render$3,
    _sfc_staticRenderFns$3
  );
  __component__$3.options.__file = "/Users/stuff/Documents/projects/GS_MMH_WEB/site/plugins/kirby-oveda/src/components/OvedaOverview.vue";
  const OvedaOverview = __component__$3.exports;
  const _sfc_main$2 = {
    props: {
      controller: Object
    },
    // Put your section logic here
    created() {
      console.log(this.controller);
    },
    computed: {
      orgs() {
        return this.controller.orgs;
      },
      total() {
        return this.controller.total;
      },
      has_prev() {
        return this.controller.has_prev;
      },
      has_next() {
        return this.controller.has_next;
      },
      page() {
        return this.controller.page;
      },
      pages() {
        return this.controller.pages;
      }
    },
    methods: {
      paginate(pagination) {
        this.$reload({
          query: {
            page: pagination.page
          }
        });
      }
    }
  };
  var _sfc_render$2 = function render() {
    var _vm = this, _c = _vm._self._c;
    return _c("k-panel-inside", [_c("k-header", [_vm._v("Veranstalter")]), _c("k-text", [_vm._v(" Veranstaltungen: " + _vm._s(_vm.total) + " ")]), _c("k-text", [_vm._v(" Seite: " + _vm._s(_vm.page) + " ")]), _c("k-text", [_vm._v(" Elemente: " + _vm._s(_vm.orgs.length) + " ")]), _vm.orgs ? _c("div", [_c("k-items", { staticClass: "elements", attrs: { "items": "1", "layout": "cardlets" } }, _vm._l(_vm.orgs, function(value, index) {
      return _c("k-item", { key: index, attrs: { "text": value.name, "info": value.description, "layout": "carlets" } });
    }), 1), _c("k-pagination", { attrs: { "page": _vm.page, "total": _vm.total, "limit": 30, "details": true }, on: { "paginate": _vm.paginate } })], 1) : _c("div", [_vm._v("No items available")])], 1);
  };
  var _sfc_staticRenderFns$2 = [];
  _sfc_render$2._withStripped = true;
  var __component__$2 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$2,
    _sfc_render$2,
    _sfc_staticRenderFns$2
  );
  __component__$2.options.__file = "/Users/stuff/Documents/projects/GS_MMH_WEB/site/plugins/kirby-oveda/src/components/Organziers.vue";
  const Organizations = __component__$2.exports;
  const _sfc_main$1 = {
    data() {
      return {};
    },
    props: {
      label: String,
      fields: Array
    }
  };
  var _sfc_render$1 = function render() {
    var _vm = this, _c = _vm._self._c;
    return _c("section", { staticClass: "bg-gray-200" }, [_c("header", [_c("h2", [_vm._v(" " + _vm._s(_vm.label) + " ")])]), _c("k-fieldset", { attrs: { "fields": _vm.fields } })], 1);
  };
  var _sfc_staticRenderFns$1 = [];
  _sfc_render$1._withStripped = true;
  var __component__$1 = /* @__PURE__ */ normalizeComponent(
    _sfc_main$1,
    _sfc_render$1,
    _sfc_staticRenderFns$1
  );
  __component__$1.options.__file = "/Users/stuff/Documents/projects/GS_MMH_WEB/site/plugins/kirby-oveda/src/components/sections/OvedaSection.vue";
  const Oveda = __component__$1.exports;
  const _sfc_main = {
    props: {
      after: String,
      before: String,
      disabled: Boolean,
      help: String,
      icon: String,
      label: String,
      required: Boolean,
      when: String,
      value: String,
      controller: Object
    },
    created() {
      this.value = ["test1", "test2"];
      console.log(this);
    },
    computed: {
      orgs() {
        return this.controller.orgs;
      },
      total() {
        return this.controller.total;
      },
      has_prev() {
        return this.controller.has_prev;
      },
      has_next() {
        return this.controller.has_next;
      },
      page() {
        return this.controller.page;
      },
      pages() {
        return this.controller.pages;
      }
    },
    methods: {
      onInput(value) {
        var value = ["Test", "test2"];
        console.log("Emitting:", value);
        this.$emit("input", value);
      },
      paginate(pagination) {
        this.$reload({
          query: {
            page: pagination.page
          }
        });
      }
    }
  };
  var _sfc_render = function render() {
    var _vm = this, _c = _vm._self._c;
    return _c("k-field", { staticClass: "k-organizer-field", attrs: { "disabled": _vm.disabled, "help": _vm.help, "label": _vm.label, "required": _vm.required, "when": _vm.when } }, [_c("k-tags", { attrs: { "after": _vm.after, "before": _vm.before, "icon": _vm.icon, "theme": "field", "type": "text", "name": "textfield", "value": _vm.value }, on: { "input": _vm.onInput } }), _c("k-header", [_vm._v("Veranstalter")]), _c("k-text", [_vm._v(" Veranstaltungen: " + _vm._s(_vm.total) + " ")]), _c("k-text", [_vm._v(" Seite: " + _vm._s(_vm.page) + " ")]), _c("k-text", [_vm._v(" Elemente: " + _vm._s(_vm.orgs.length) + " ")]), _vm.orgs ? _c("div", [_c("k-items", { staticClass: "elements", attrs: { "items": "1", "layout": "cardlets" } }, _vm._l(_vm.orgs, function(value, index) {
      return _c("k-item", { key: index, attrs: { "text": value.name, "info": value.description, "layout": "carlets" } });
    }), 1), _c("k-pagination", { attrs: { "page": _vm.page, "total": _vm.total, "limit": 30, "details": true }, on: { "paginate": _vm.paginate } })], 1) : _c("div", [_vm._v("No items available")])], 1);
  };
  var _sfc_staticRenderFns = [];
  _sfc_render._withStripped = true;
  var __component__ = /* @__PURE__ */ normalizeComponent(
    _sfc_main,
    _sfc_render,
    _sfc_staticRenderFns
  );
  __component__.options.__file = "/Users/stuff/Documents/projects/GS_MMH_WEB/site/plugins/kirby-oveda/src/components/fields/OrganizerMultiSelectField.vue";
  const OrganizersField = __component__.exports;
  window.panel.plugin("mmh-goslar/kirby-oveda", {
    components: {
      oveda: OvedaOverview,
      "k-events-view": Organizations
    },
    fields: {
      organizerz: OrganizersField
    },
    sections: {
      oveda: Oveda
    }
  });
})();
