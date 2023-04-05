import { createRouter, createWebHistory } from 'vue-router'
// import HomeView from '../views/HomeView.vue'
import ContactCreate from '../views/contacts/Create.vue'
import Contacts from '../views/contacts/Index.vue'
import ContactEdit from '../views/contacts/Edit.vue'


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'index',
      component: Contacts
    },
    {
      path: '/contacts/create',
      name: 'create',
      component: ContactCreate
    },
     {
      path: '/contacts/edit/:id',
      name: 'edit',
      component: ContactEdit
    },
   
    // {
    //   path: '/about',
    //   name: 'about',
    //   // route level code-splitting
    //   // this generates a separate chunk (About.[hash].js) for this route
    //   // which is lazy-loaded when the route is visited.
    //   component: () => import('../views/AboutView.vue')
    // }
  ]
})

export default router
