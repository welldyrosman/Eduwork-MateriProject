import { createRouter, createWebHistory } from 'vue-router'
import LandingPageVue from '@/views/LandingPage.vue'
import ProductPage from '@/views/ProductPage.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: LandingPageVue
    },
    {
      path: '/product',
      name: 'product',
      component: ProductPage
    },
  ]
})

export default router
