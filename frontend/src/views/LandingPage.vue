<template>
    <main>
      
        <div class="container mx-auto p-5">
            <div class="grid grid-cols-6 gap-3">
                <CardCatalog v-for="(item, index) in dataproduct" :barang="item" :key="index" />
            </div>
        </div>
    </main>
</template>
<script>
import CardCatalog from '@/components/CardCatalog.vue';
import axios from 'axios';
export default {
    components: {CardCatalog },
    data() {
        return {
            dataproduct: []
        }
    },
    created() {
        console.log("Hallo 1")

        axios.get('http://localhost:8000/api/products').then(ret => {
            console.log("Hallo Hallo")
            // console.log("BERHASIL INI DATANYA",ret)
            // console.log("Data product",this.dataproduct)
            this.dataproduct = ret.data
            //console.log("Data product after",this.dataproduct)
        }).catch(err => {
            console.log("GAGAL CUY", err)
        });

        console.log("Hallo 2")
    },
}
</script>