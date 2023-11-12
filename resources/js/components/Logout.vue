<template>
  
</template>

<script>
import User from '../Helpers/User'
export default {
    name: 'Logout',
    data() {
        return {
            //
        }
    },
    methods: {
        //
    },
    mounted() {
        User.logout();
        this.$router.push({ name: 'home' });
        Toast.fire({
            icon: 'success',
            title: 'Logout successful!!!'
        })
    },
}
</script>

<style>

</style>