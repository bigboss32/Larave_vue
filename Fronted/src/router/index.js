import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import ProyectoNew from '../views/ProyectoNew.vue'
import ProyectoEdit from '../views/ProyectoEdit.vue'
import ProyectoView from '../views/ProyectoView.vue'
import Iniciosesion from '../views/Iniciosesion.vue'
import Registraseusuario from '../views/Registraseusuario.vue'


const routes = [
  {
    path: '/home',
    name: 'home',
    component: HomeView,
    meta: {
      mostrarNav: true // Indicar que no se debe mostrar la barra de navegación
    }
  },
  {
    path: '/crearproyecto',
    name: 'crear',
    component: ProyectoNew,
    meta: {
      mostrarNav: true // Indicar que no se debe mostrar la barra de navegación
    }
  },
  {
    path: '/editarproyecto/:id',
    name: 'editar',
    component: ProyectoEdit,meta: {
      mostrarNav: true // Indicar que no se debe mostrar la barra de navegación
    }
  },
  {
    path: '/verproyecto/:id',
    name: 'ver',
    component: ProyectoView,
    meta: {
      mostrarNav: true // Indicar que no se debe mostrar la barra de navegación
    }
  },
  {
    path: '/',
    name: 'iniciodesesion',
    component: Iniciosesion,
    meta: {
      mostrarNav: false // Indicar que no se debe mostrar la barra de navegación
    }
  },
  {
    path: '/Registraseusuario',
    name: 'Registraseusuario',
    component: Registraseusuario,
    meta: {
      mostrarNav: false // Indicar que no se debe mostrar la barra de navegación
    }
  },
 
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
