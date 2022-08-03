import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import LoginView from "../views/LoginView.vue";
import RegisterView from "../views/RegisterView.vue";
// import AboutView from "../views/AboutView.vue";

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomeView,
    },
    {
      path: "/login",
      name: "login",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: LoginView,
    },
    {
      path: "/register",
      name: "register",
      component: RegisterView,
    },
  ],
});
// const routes = [
//   {
//     path: "/",
//     name: "index",
//     component: HomeView,
//   },

//   {
//     path: "/about",
//     name: "about",
//     component: AboutView,
//   },
// ];

// const router = createRouter({
//   // 4. Provide the history implementation to use. We are using the hash history for simplicity here.
//   history: createWebHistory(),
//   routes, // short for `routes: routes`
// });

export default router;
