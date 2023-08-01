import { createRouter, createWebHistory } from 'vue-router'

export const ROUTER_CONST = {
  main: '/',
}

const routes = [
  {
    path: ROUTER_CONST.main,
    name: 'MainPage',
    component: () => import(/* webpackChunkName: "MainPage" */ '@/pages/MainPage/MainPage.vue')
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
