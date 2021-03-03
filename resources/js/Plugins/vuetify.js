import Vue from 'vue';
import Vuetify from 'vuetify';
import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/dist/vuetify.min.css';
//import es from 'vuetify/src/locale/es.ts'
//import en from 'vuetify/src/locale/en.ts'
import en from './locale/en.js'
import es from './locale/es.js'
Vue.use(Vuetify);

const opts = {
    icons: {
        iconfont: 'mdi', // 'mdi' || 'mdiSvg' || 'md' || 'fa' || 'fa4' || 'faSvg'
    },
    lang: {
        locales: { es, en},
        current: 'es',
    }
}
export default new Vuetify(opts)
