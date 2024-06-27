<template>
    <k-field
        class="k-organizer-field"
    
        :disabled="disabled"
        :help="help"
        :label="label"
        :required="required"
        :when="when"
        >
        <k-tags
            :after="after"
            :before="before"
            :icon="icon"
            theme="field"
            type="text"
            name="textfield"
            :value="value"
            @input="onInput">
        </k-tags>
        <k-header>Veranstalter</k-header>
        <k-text>
            Veranstaltungen: {{ total }}
        </k-text>
        <k-text>
            Seite: {{ page }}
        </k-text>
        <k-text>
            Elemente: {{ orgs.length }}
        </k-text>
        <div v-if="orgs">
            <k-items items="1" class="elements" layout="cardlets">

                <k-item v-for="(value, index) in orgs" :text="value.name" :key="index" :info="value.description"
                    layout="carlets"></k-item>
            </k-items>
            <k-pagination :page="page" :total="total" :limit="30" :details="true" @paginate="paginate" />
        </div>

        <div v-else>No items available</div>
    </k-field>
  </template>
  
  <script>
  export default {
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
        this.value = ["test1", "test2"]
        console.log(this)
    },
    computed: {
        orgs() {
            return this.controller.orgs
        },
        total() {
            return this.controller.total
        },
        has_prev() {
            return this.controller.has_prev
        },
        has_next() {
            return this.controller.has_next
        },
        page() {
            return this.controller.page
        },
        pages() {
            return this.controller.pages
        },
    },
    methods: {
      onInput(value) {
        var value = ["Test", "test2"]
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
    },

  }
  </script>