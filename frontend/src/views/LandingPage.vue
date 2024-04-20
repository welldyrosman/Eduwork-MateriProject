<template>
    <main>
        <div class="container mx-auto p-5">
            <div class="grid grid-cols-6 gap-3">
                <CardCatalog @click="addcart(item.id)" v-for="(item, index) in dataproduct" :barang="item" :key="index" />
            </div>
        </div>
    </main>
</template>
<script>
import CardCatalog from '@/components/CardCatalog.vue';
import axios from '@/plugins/axios'
export default {
    components: {CardCatalog },
    data() {
        return {
            dataproduct: []
        }
    },
    methods:{
        // addcart(product_id){
        //     axios.post('http://localhost:8000/api/addcart',{
        //         product_id:product_id
        //     }).then(ret => {
        //         this.$refs.navbar.loadcart();
        //         Swal.fire("OK!", "Barang telah ditambah", "success");
        //     })
        // }
    },
    created() {
        console.log("Hallo 1")
        
        axios.get('/products').then(ret => {
            this.dataproduct = ret
        }).catch(err => {
            console.log("GAGAL CUY", err)
        });

        console.log("Hallo 2")
    },
}
</script>