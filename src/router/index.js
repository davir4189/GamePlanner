import { createRouter, createWebHashHistory } from 'vue-router'
import loginUsuaris from '../views/loginUsuaris'


const routes = [
  {
    path: '/',
    name: 'login',
    component:loginUsuaris
  },
  
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
