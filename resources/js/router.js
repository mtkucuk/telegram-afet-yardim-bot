import {createWebHistory, createRouter} from "vue-router";
import Home from './pages/home'
import Preview from "./pages/preview.vue";
import Links from "./pages/links.vue";
import kvkk from "./pages/kvkk.vue";

export const routes = [
    {
        name: "home",
        path: "/",
        component: Home
    },
    {
        name: "preview",
        path: "/preview/:id",
        component: Preview
    },
    {
        name: "links",
        path: "/links",
        component: Links
    },
    {
        name: "kvkk",
        path: "/kvkk",
        component: kvkk
    },
    { path: '/:pathMatch(.*)', component: Home }
]

const router = createRouter({
    history: createWebHistory(),
    routes: routes
})

export default router;
