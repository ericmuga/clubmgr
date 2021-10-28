import Vue from 'vue'
import VueMeta from 'vue-meta'
import PortalVue from 'portal-vue'
import { InertiaProgress } from '@inertiajs/progress'
import { createInertiaApp } from '@inertiajs/inertia-vue'
// import VueTailwindAccordion from 'vue-tailwind-accordion'
 
//import Chart from 'chart.js/auto'
import VueTailwind from 'vue-tailwind'

import {
  TInput,
  TTextarea,
  TSelect,
  TRadio,
  TCheckbox,
  TButton,
  TInputGroup,
  TCard,
  TAlert,
  TModal,
  TDropdown,
  TRichSelect,
  TPagination,
  TTag,
  TRadioGroup,
  TCheckboxGroup,
  TTable,
  TDatepicker,
  TToggle,
  TDialog,
} from 'vue-tailwind/dist/components';

const components = {
  TTable,
}

const settings = {
  // Use the following syntax
  // {component-name}: {
  //   component: {importedComponentObject},
  //   props: {
  //     {propToOverride}: {newDefaultValue}
  //     {propToOverride2}: {newDefaultValue2}
  //   }
  // }
  't-input': {
    component: TInput,
    props: {
      classes: 'border-2 block w-full rounded text-gray-800'
      // ...More settings
    }
  },
  't-textarea': {
    component: TTextarea,
    props: {
      classes: 'border-2 block w-full rounded text-gray-800'
      // ...More settings
    },
    't-table':{
      component: TTable,
      props:{
       
        classes: {
          table: 'min-w-full divide-y divide-gray-100 shadow-sm border-gray-200 border',
          thead: '',
          theadTr: '',
          theadTh: 'px-3 py-2 font-semibold text-left bg-gray-100 border-b',
          tbody: 'bg-white divide-y divide-gray-100',
          tr: '',
          td: 'px-3 py-2 whitespace-no-wrap',
          tfoot: '',
          tfootTr: '',
          tfootTd: ''
        },
        variants: {
          thin: {
            td: 'p-1 whitespace-no-wrap text-sm',
            theadTh: 'p-1 font-semibold text-left bg-gray-100 border-b text-sm'
          }
        },
      
        responsive:true,
      }
    }
  },
  // ...Rest of the components
}

Vue.use(VueTailwind, settings)

// Vue.use(VueTailwindAccordion)


Vue.config.productionTip = false
Vue.mixin({ methods: { route: window.route } })
Vue.use(PortalVue)
Vue.use(VueMeta)
Vue.use(require('vue-moment'))
Vue.component('TTable','TTable');

InertiaProgress.init()

createInertiaApp({
  resolve: name => require(`./Pages/${name}`),
  setup({ el, app, props }) {
    new Vue({
      metaInfo: {
        titleTemplate: title => (title ? `${title} -ClubMgr` : 'ClubMgr'),
      },
      render: h => h(app, props),
    }).$mount(el)
  },
})
