<template>
    <h1 v-if="show">INI ABOUT {{ msg }}</h1>
    <input v-model="panjang"/>
    <input v-model="lebar"/>
    <h1>{{ luas }}</h1>
    <button @click="onUbah" class="border rounded p-2">KLIK</button>
</template>
<script>
export default{
    data() {
        return {
            show:true,
            msg:"",
            panjang:10,
            lebar:10
        }
    },
    methods:{
        onUbah(){
            this.msg="HALLO SAYA MESSAGE"
            this.show=true
        }
    },
    computed:{
        luas(){
            return this.panjang * this.lebar;
        }
    },
    watch:{
        show(){
            console.log();
        }
    },
    mounted(){

        this.msg="SAYA MOUNTED"
    },
    updated(){
        console.log("SAYA BERUBAH")
    },
    unmounted(){
    }
}
</script>