import { createRouter, createWebHashHistory } from 'vue-router'
import loginUsuaris from '../views/loginUsuaris'
import gestioTasca from '../views/gestioTasca'
import gestioUsuari from '../views/gestioUsuari'
import iniciOpcions from '../views/iniciOpcions'
import misTrabajos from '../views/misTrabajos'
import treballadorsGestio from '../views/treballadorsGestio'

const routes = [
  {
    path: '/',
    name: 'login',
    component:loginUsuaris
  },
  {
    path: '/',
    name: '/gestioTasca',
    component:gestioTasca
  },
  {
    path: '/',
    name: '/gestioUsuari',
    component:gestioUsuari
  },
  {
    path: '/',
    name: '/misTrabajos',
    component:misTrabajos
  },
  {
    path: '/',
    name: '/iniciOpcions',
    component:iniciOpcions
  },
  {
    path: '/',
    name: '/treballadorsGestio',
    component:treballadorsGestio
  },
  
  
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
