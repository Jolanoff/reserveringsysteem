import { createApp } from 'vue'
import { createWebHistory, createRouter } from "vue-router";
import App from './App.vue'
import axios from 'axios'
import vSelect from "vue-select";
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import VueNumberInput from '@chenfengyuan/vue-number-input';
import Popper from "vue3-popper";
import VueAxios from 'vue-axios'
import Inloggen from './components/InLoggen.vue'
import HomePagina from './components/HomePagina.vue'
import medewerkersOZ from './components/system/medewerkersOZ.vue'
import beschikbaarPlekken from './components/system/beschikbaarPlekken.vue'
import klantenOverzicht from './components/system/klantenOverzicht.vue'
import ReserveringAanmaken from './components/system/ReserveringAanmaken.vue'
const routes = [
    {
      path: "/",
      name: "LoginPagina",
      component: Inloggen,
    },
    {
      path: "/Home",
      name: "HomePagina",
      component: HomePagina,
    },
    {
      path: "/medewerkers",
      name: "medewerkers",
      component: medewerkersOZ,
    },
    {
      path: "/klanten",
      name: "klantenOverzicht",
      component: klantenOverzicht,
    },
    {
      path: "/beschikbaarPlekken",
      name: "beschikbaarPlekken",
      component: beschikbaarPlekken,
    },
    {
      path: "/ReserveringAanmaken",
      name: "ReserveringAanmaken",
      component: ReserveringAanmaken,
    },
    
  ];
  
const router = createRouter({
    history: createWebHistory(),
    routes,
  });
  let app = createApp(App)
app
.component('v-select', vSelect)
.component('Datepicker', Datepicker)
.use(router)
.use(VueAxios, axios)
.component(VueNumberInput.name, VueNumberInput)
.component("Popper", Popper)
.mount('#app')
