<template>
    <MyNavbar />
    <RouterView />
</template>
<script>
import MyNavbar from '@/components/MyNavbar.vue';
export default {
    components: { MyNavbar },
    data() {
        return {

        }
    },
}
</script>