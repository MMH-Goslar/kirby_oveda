import OvedaOverview from "./components/OvedaOverview.vue";

import Organizations from "./components/Organziers.vue";
import Oveda from "./components/sections/OvedaSection.vue";
import OrganizersField from "./components/fields/OrganizerMultiSelectField.vue";

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
