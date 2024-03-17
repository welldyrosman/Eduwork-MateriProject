<template>
    <div class="w-100 border-b p-3 flex justify-between relative">
        <div class="font-bold">TOKO EDU</div>
        <div class="flex">
            <div>MENU 1</div>
            <div>MENU 2</div>
            <div>MENU 3</div>
            <div @click="show = !show">Carts <span class="bg-red-400 text-white p-1 rounded-full">{{ carts.length
                    }}</span>

            </div>

        </div>
        <div class="absolute -bottom-96 right-0 bg-white z-50 p-3" v-if="show">
            <ul>
                <li class="flex justify-between" v-for="(item, index) in carts" :key="index">
                    <span>{{ item.qty }} X </span><span>{{ item.product.nama_product }}</span><span>{{ item.harga }}</span> <span>Rp.{{ item.qty * item.harga }}</span></li>
            </ul>

            <button class="bg-blue-400 text-white rounded p-2" @click="checkout">Checkout</button>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
export default {
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
        checkout(){
            axios.post('http://localhost:8000/api/checkout').then(ret => {
                //this.carts = ret.data
                Swal.fire("OK!", "Barang telah dibeli", "success");
                console.log("Transaksi",ret.data)
            }).catch(err => {
                Swal.fire("OK!", "Barang gagal dibeli", "error");
                console.log("GAGAL CUY", err)
            });
        },
        loadcart() {
            axios.get('http://localhost:8000/api/carts').then(ret => {
                this.carts = ret.data
                //console.log("Data product after",this.dataproduct)
            }).catch(err => {
                console.log("GAGAL CUY", err)
            });
        }
    }
}
</script>