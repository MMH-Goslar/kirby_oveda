import DemoSection from "./components/DemoSection.vue";
import OvedaOverview from "./components/OvedaOverview.vue";
import Organizations from "./components/Organziers.vue"

window.panel.plugin("mmh-goslar/kirby-oveda", {
	components: {
		oveda: OvedaOverview,
		"k-events-view": Organizations
	}
	
});
