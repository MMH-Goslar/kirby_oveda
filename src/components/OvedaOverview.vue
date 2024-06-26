<template>
	<k-inside>
	  <k-view class="k-oveda-overview">
		<k-header>Movie reviews</k-header>
		<k-items v-if="orgs.length" :items="orgs">
		   <k-item
			  v-for="(org, index) in orgs"
			  :layout="card"
			  :key="index"
			  link="https://test.de"
			  :text="org.name"
			  target="_blank"></k-item>
			  
		</k-items>
		<div>No items available</div>
	  </k-view>
	</k-inside>
  </template>

<script>


export default {
	props: {
		orgs: Array
	}
	// Put your section logic here
};
</script>

<style>
/** Put your CSS here **/
</style>
