<template>
    <div class="w-100 border-b p-3 flex items-center justify-between relative container mx-auto">
        <div class="font-bold">TOKO EDU</div>
        <div class="flex items-center gap-2">
            <div class="cursor-pointer p-2 rounded  hover:bg-gray-200">Menu 1</div>
            <div class="cursor-pointer p-2 rounded  hover:bg-gray-200">Menu 2</div>
            <router-link to="/login" class="cursor-pointer p-2 rounded  hover:bg-gray-200">Login</router-link>
            <div @click="logout" class="cursor-pointer p-2 rounded  hover:bg-gray-200">Logout</div>
            <div @click="show = !show" class="cursor-pointer relative hover:bg-gray-200 p-2 rounded">Carts
                <span class="text-center bg-red-400 text-white text-xs min-w-4 min-w-4 rounded-full absolute ">{{ carts.length }}</span>
                <div class="absolute rounded top-15 border right-0 bg-white z-50 p-3 w-max" v-if="show">
                    <table class="w-100 mb-3">
                        <tbody>
                            <tr class="border-b" v-for="(item, index) in carts" :key="index">
                                <td class="p-2 ">{{ item.qty }} X </td>
                                <td class="p-2">{{ item.product.nama_product }}</td>
                                <td class="p-2">Rp.{{item.harga}}</td>
                                <td class="p-2">Rp.{{ item.qty * item.harga }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="bg-blue-400 text-white rounded p-2" @click="checkout">Checkout</button>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
import axios from '@/plugins/axios';
import { useUserStore } from '@/stores/user';
export default {
    setup(){
        const userstore=useUserStore();
        return {
            userstore
        }
    },
    data() {
        return {
            show: false,
            carts: []
        }
    },
    created() {
        this.loadcart();
    },
    methods: {
        checkout() {
            axios.post('http://localhost:8000/api/checkout').then(ret => {
                //this.carts = ret.data
                Swal.fire("OK!", "Barang telah dibeli", "success");
                console.log("Transaksi", ret.data)
            }).catch(err => {
                Swal.fire("OK!", "Barang gagal dibeli", "error");
                console.log("GAGAL CUY", err)
            });
        },
        logout(){
            axios.post('/logout').then(()=>{
                this.userstore.logout();
            })
        },
        loadcart() {
            axios.get('http://localhost:8000/api/carts').then(ret => {
                this.carts = ret.data.data
                //console.log("Data product after",this.dataproduct)
            }).catch(err => {
                console.log("GAGAL CUY", err)
            });
        }
    }
}
</script>