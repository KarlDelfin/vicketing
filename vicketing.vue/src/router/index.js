import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import EnforcerView from '../views/EnforcerView.vue'
import Violation from '../views/ViolationView.vue'
import ViolationArticle from '../views/ViolationArticleView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/enforcers',
      name: 'enforcers',
      component: EnforcerView,
    },
    {
      path: '/violations',
      name: 'violations',
      component: Violation,
    },
    {
      path: '/violation-articles',
      name: 'violation-articles',
      component: ViolationArticle,
    },
  ],
})

export default router
