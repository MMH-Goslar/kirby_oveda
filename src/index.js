import DemoSection from "./components/DemoSection.vue";
import OvedaOverview from "./components/OvedaOverview.vue";
import Events from "./components/Events.vue"

window.panel.plugin("mmh-goslar/kirby-oveda", {
	components: {
		oveda: OvedaOverview,
		"k-events-view": Events
	}
	
});
