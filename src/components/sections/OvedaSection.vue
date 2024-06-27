<template>
    <section class="bg-gray-200">
        <header>
            <h2> {{ label }} </h2>
        </header>
        <k-fieldset :fields="fields">

        </k-fieldset>
    </section>
</template>

<script>
export default {
  data() {
    return {

    }
  },
  props: {
    label: String,
    fields: Array
  },
};
</script>