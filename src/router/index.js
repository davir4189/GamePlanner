import { createRouter, createWebHashHistory } from 'vue-router'
import loginUsuaris from '../views/loginUsuaris'
import gestioTasca from '../views/gestioTasca'
import gestioUsuari from '../views/gestioUsuari'
import iniciOpcions from '../views/iniciOpcions'
import misTrabajos from '../views/misTrabajos'
import tasques from '../views/tasques'
import usuaris from '../views/usuaris'

const routes = [
  {
    path: '/login',
    name: 'login',
    component:loginUsuaris
  },
  {
    path: '/works',
    name: 'works',
    component:tasques
  },
  {
    path: '/works/addWork',
    name: 'addWork',
    component:gestioTasca
  },
  {
    path: '/works/editWork',
    name: 'editWork',
    component:gestioTasca
  },
  {
    path: '/employees',
    name: 'employees',
    component:usuaris
  },
  {
    path: '/employees/addEmployee',
    name: 'addEmployee',
    component:gestioUsuari
  },
  {
    path: '/employees/editEmployee',
    name: 'editEmployee',
    component:gestioUsuari
  },
  {
    path: '/myWorks',
    name: 'myWorks',
    component:misTrabajos
  },
  {
    path: '/admin',
    name: 'admin',
    component:iniciOpcions
  },
  {
    path: '/manager',
    name: 'manager',
    component:iniciOpcions
  },
  {
    path: '/technical',
    name: 'technical',
    component:iniciOpcions
  }
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
