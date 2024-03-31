<template>
    <div class="container mx-auto">
        <h1 class="font-bold text-xl">HALAMAN PRODUCT</h1>
        <div class="flex flex-col">
            <label>Scan Product</label>
            <input v-model="barcode" @change="scanBarcode" type="text" class="border rounded w-100 p-1" />
            <label>Nama Product</label>
            <input type="text" v-model="formdata.nama_product"
                :class="{ 'border-red-700 bg-red-400': errors.nama_product }" class="border rounded w-100 p-1" />

            <label>Harga Product</label>
            <input type="number" v-model="formdata.harga" class="border rounded w-100 p-1" />

            <label>Qty</label>
            <input type="number" v-model="qty" class="border rounded w-100 p-1" />

            <h1>Rp.{{ total.toLocaleString() }}</h1>
            <div class="flex  gap-2 flex-wrap">
                <div class="flex justify-between text-md bg-gray-200 rounded-md w-min px-2 py-1"
                    v-for="(tagi, index) in formdata.producttags" :key="index">{{ tagi.tag.tag }} <div
                        class="cursor-pointer" @click="removetag(tagi.id)">X</div>
                </div>
            </div>
            <span v-if="errors.harga" class="text-red-700">{{ laodErrorMsg(errors.harga) }}</span>
            <div class="flex my-2 justify-end">
                <button @click="submitForm" class="bg-blue-400 text-white px-5 py-2 rounded">Simpan</button>
            </div>

            <hr />
            <table>
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Nama Product</td>
                        <td>Harga</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in dataproduct" :key="index">
                        <td>{{ item.id }}</td>
                        <td>{{ item.nama_product }}</td>
                        <td>{{ item.harga }}</td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
import axios from '@/plugins/axios'
export default {
    data() {
        return {
            dataproduct: [],
            errors: {},
            barcode: "",
            qty: 0,
            formdata: {
                nama_product: "",
                harga: 0,

            }
        }
    },
    computed: {
        total() {
            return this.formdata.harga * this.qty
        }
    },
    created() {
        this.loadData();
    },
    methods: {
        removetag(producttag_id) {
            axios.delete('/deletebyproducttag/' + producttag_id).then(ret => {
                this.scanBarcode();
                Swal.fire("OK!", "Tag Telah DI Hapus", "success");
            }).catch(err => {
                Swal.fire("Error!", "Barang deang abrcode tsb tidak ada", "errors");
            });
        },
        scanBarcode() {
            axios.get('/admin/products/' + this.barcode).then(ret => {
                this.formdata = ret.data
            }).catch(err => {
                Swal.fire("Error!", "Barang deang abrcode tsb tidak ada", "errors");
            });
        },
        laodErrorMsg(errors) {
            let msg = ""
            for (var i = 0; i < errors.length; i++) {
                msg += errors[i] + " , ";
            }
            return msg
        },
        loadData() {
            axios.get('/admin/products').then(ret => {
                console.log("Hallo Hallo")
                this.dataproduct = ret
            }).catch(err => {
                console.log("GAGAL CUY", err)
            });
            //     //axios.get('http://localhost:8000/api/products').then(ret => {
            //     console.log("Hallo Hallo")
            //     this.dataproduct = ret.data

            // }).catch(err => {
            //     console.log("GAGAL CUY", err)
            // });
        },
        submitForm() {
            Swal.fire({
                title: "Kamu Yakin Mau Simpan?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Gasss",
                denyButtonText: `Janganlah`
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    axios.post('http://localhost:8000/api/products', this.formdata).then(ret => {
                        Swal.fire("Saved!", "", "success");
                        this.loadData();
                    }).catch(err => {
                        this.errors = err.response.data.errors;
                        Swal.fire("Error!", "Coba lagi broo", "errors");
                        console.log("GAGAL SUBMIT", err.response.data.errors)
                    })

                } else if (result.isDenied) {
                    Swal.fire("Changes are not saved", "", "info");
                }
            });

        }
    },
}
</script>