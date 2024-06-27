<template>
	<k-panel-inside>
		<k-header>Veranstalter</k-header>
        <k-text>
            Veranstaltungen: {{ events.total }}
        </k-text>
        <k-text>
            Seite: {{ events.page }}
        </k-text>
        <k-text>
            Elemente: {{Object.values(events.organizations).length}}
        </k-text>
		<k-items v-if="events.organizations" items="1" class="elements" layout="cardlets">

            <k-item
                v-for="(value, index) in events.organizations"
                :text="value.name"
                :key="index"
                :info="value.description"
                layout="carlets"
            ></k-item>
        </k-items>
		<div v-else>No items available</div>
	</k-panel-inside>
  </template>

<script>

export default {
	props: {
		events: Array
	},
	// Put your section logic here
    created() {
            console.log(this.events);
    }
}
</script>

<style>
/** Put your CSS here **/
</style>
