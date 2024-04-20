<template>
    <div class="container mx-auto">
        <div class="flex flex-col gap-3 mx-96">
            <h1>NAME IS {{ store?.user?.name }} - {{ counter.count }}</h1>
            <label>Username/Email</label>
            <input v-model="loginpayload.email" class="border p-1" type="text"/>
            <label>Password</label>
            <input v-model="loginpayload.password" class="border p-1" type="password"/>
            <button @click="onLogin" class="border bg-blue-400 rounded p-2">Login</button>
            <button @click="onAdd" class="border bg-blue-400 rounded p-2">Add Counter</button>
            <RouterLink to="/product">To PRODUCT</RouterLink>
        </div>
    </div>
</template>
<script>
import axios from '@/plugins/axios';
import { useUserStore } from '@/stores/user';
import { useCounterStore } from '@/stores/counter';
import { RouterLink } from 'vue-router';
export default{
    setup(){
        const store=useUserStore();
        const counter=useCounterStore();
        return {store,counter}
    },
    data() {
        return {
            loginpayload:{
                email:"lacy.hills@example.org",
                password:"password"
            }
        }
    },
    mounted(){
        console.log("Store",this.store)
    },
    methods:{
        onAdd(){
            this.counter.increment();
        },
        onLogin(){
            axios.post("/login",this.loginpayload).then(ret=>{
                console.log("LOGIN Berhasil",ret.data.user)
                this.store.login(ret.data.user,ret.data.token);
                Swal.fire("sukses!", ret.message, "success");
                this.$router.push("/")
            }).catch(err=>{
                console.log("Login GAGAL",err)
                Swal.fire("Error!", err.message, "errors");
            })
        }
    }
}
</script>