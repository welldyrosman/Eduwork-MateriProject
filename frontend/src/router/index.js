import { createRouter, createWebHistory } from 'vue-router'
import LandingPageVue from '@/views/LandingPage.vue'
import ProductPage from '@/views/ProductPage.vue'
import LoginPage from '@/views/LoginPage.vue'
import FormPage from '@/views/FormPage.vue'
import UserLayout from '@/components/layouts/UserLayout.vue'
import AdminLayout from '@/components/layouts/AdminLayout.vue'
import { useUserStore } from '@/stores/user'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      component: UserLayout,
      children: [
        {
          name: 'home',
          path: '',
          component: LandingPageVue
        }
      ]
    },
    {
      path: '/admin',
      component: AdminLayout,
      meta: {
        requiresAuth: true
      },
      children: [
        {
          path: '',
          name: 'product',
          component: ProductPage,
          
        }
      ]
    },

    {
      path: '/login',
      name: 'login',
      component: LoginPage,
      meta: { canntoAccessAfterLogin: true }
    },
    {
      path: '/form',
      name: 'form',
      component: FormPage,
      meta: { canntoAccessAfterLogin: true }
    }
  ]
})
router.beforeEach((to, from, next) => {

  const userAuth = useUserStore()
  //userAuth.setAuth();
  if (to.meta.canntoAccessAfterLogin) {
    if (userAuth.user && userAuth.token != '') {
      next('/')
    } else {
      next()
    }
  }
  if (to.meta.requiresAuth) {
    if (userAuth.user && userAuth.token) {
      next()
    } else {
      next('/login')
    }
  } else {
    next()
  }
})

export default router
