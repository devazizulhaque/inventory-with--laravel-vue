<template>
    <!--start wrapper-->
    <div class="wrapper">
        <!--start top header-->
        <Header v-if="showHeaderAndSidebar"/>
        <!--end top header-->

        <!--start sidebar -->
        <Sidebar v-if="showHeaderAndSidebar"/>
        <!--end sidebar-->

        <!--start content-->
        <main class="page-content" :class="{ 'full-width': !showHeaderAndSidebar }">
            <router-view></router-view>
        </main>
        <!--end content-->
    </div>
    <!--end wrapper-->
</template>

<script>
import Header from './components/includes/Header.vue';
import Sidebar from './components/includes/Sidebar.vue';
import User from './Helpers/User';

export default {
    name: 'App',
    components: {
        Header,
        Sidebar,
    },
    
    data() {
        return {
            showHeaderAndSidebar: false,
        }
    },
    watch: {
        '$route' (to, from) {
            if (to.name !== 'login' && to.name !== 'register' && to.name !== 'home') {
                if (User.loggedIn()) {
                    this.showHeaderAndSidebar = true;
                } else {
                    this.showHeaderAndSidebar = false;
                }
            } else {
            this.showHeaderAndSidebar = false;
            }
        },
    },
}
</script>

<style>
.full-width {
    width: 100%;
    margin-left: 0px;
    margin-top: 0px;
}
</style>