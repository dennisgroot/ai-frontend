/* Alpine JS */
import Alpine from 'alpinejs'

/* Alpine JS plugins: */
// import mask from '@alpinejs/mask' // Masker voor input velden. Docs: https://alpinejs.dev/plugins/mask
import intersect from '@alpinejs/intersect' // Viewport wachter. Docs: https://alpinejs.dev/plugins/intersect
import persist from '@alpinejs/persist' // Sla data op in LocalStorage. Docs: https://alpinejs.dev/plugins/persist
import focus from '@alpinejs/focus' // Focus management (WCAG). Docs: https://alpinejs.dev/plugins/focus
import collapse from '@alpinejs/collapse' // Geanimeerde collapse, handig voor accorion. Docs: https://alpinejs.dev/plugins/collapse
// import morph from '@alpinejs/morph' // https://alpinejs.dev/plugins/morph

/* External: Alpine JS plugins: */
import tooltip from "@ryangjchandler/alpine-tooltip"; // Tooltip plugin o.b.v. Tippy JS. Docs: https://github.com/ryangjchandler/alpine-tooltip

// Alpine.plugin(mask)
Alpine.plugin(intersect)
Alpine.plugin(persist)
Alpine.plugin(focus)
Alpine.plugin(collapse)
// Alpine.plugin(morph)
Alpine.plugin(tooltip);

window.Alpine = Alpine  // add to window, to make globally available
Alpine.start()