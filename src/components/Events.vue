<template>
	<k-panel-inside>
		<k-header>Events</k-header>
        <k-text>
            Veranstaltungen: {{ events.total }}
        </k-text>
        <k-text>
            Seite: {{ events.page }}
        </k-text>
        <k-text>
            Elemente: {{Object.values(events.events).length}}
        </k-text>
		<k-items v-if="events.events" class="elements" :items="events.events">

            <k-item
                :text="item.name"
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
