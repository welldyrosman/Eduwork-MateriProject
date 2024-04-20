<template>
    <div class="flex flex-col">
        <h1>FORM DATA FRAINCISE</h1>
        <div @click="onSave" class="p-2 border rounded bg-blue-400 text-white">Simpan</div>
        <label>Nama </label>
        <input v-model="payload.nama_frenchise" class="border rounded" />
        <label>Alamat </label>
        <input class="border rounded" />
        <label>Lain Lain </label>
        <input class="border rounded mb-4" />
        <br />
        <hr class="m-3" />
        <div class="flex justify-between p-2">
            <div>Menu</div>
            <div @click="addMenu" class="p-2 border rounded bg-blue-400 text-white">Add Menu</div>
        </div>
        <hr class="m-3" />
        <div v-for="(item, index) in payload.menus" :key="index" class="border rounded p-2 flex flex-col">
            <label>Nama </label>
            <input v-model="item.nama_menu" class="border rounded" />
            <label>Harga </label>
            <input v-model="item.harga" class="border rounded" />
            <label>Gambar </label>
            <input class="border rounded" />
        </div>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            payload: {
                nama_frenchise: "FRENCHISE YOGA",
                alamat: "JAKARTA",
                menus: [
                    {
                        nama_menu: "MENU 1",
                        harga: 100000,
                        image: null
                    },
                    {
                        nama_menu: "MENU 2",
                        harga: 200000,
                        image: null
                    }
                ]
            }
        }
    },
    methods: {
        addMenu() {
            this.payload.menus.push({
                nama_menu: "",
                harga: 0,
                image: null
            });
        },
        onSave() {
           
           // alert(JSON.stringify(this.payload));
            var data = new FormData();
            for (var p in this.payload) {
                if(p!=menus){
                    data.append(p, this.payload[p])
                }
            }
            for(var i=0;i<this.payload.menus.length;i++){
                for(var p in this.payload.menus[i]){
                    data.append(`menus[${i}][${p}]`, this.payload.menus[i][p])
                }
               
            }
            console.log("data",data.getAll)
            //axios.post("", this.payload)
        }
    }
}
</script>