<template>
    <div class="border rounded-lg cursor-pointer transition transform hover:scale-105">
        <img src="https://picsum.photos/300/300" class="w-100" style="object-fit:cover" />
        <div class="flex flex-col p-2">
            <div>{{ barang.nama_product }}</div>
            <div class="font-bold">Rp.{{ barang.harga }}</div>
            <div class="text-xxs p-1 bg-red-100 rounded w-max font-semibold text-red-400">Cashback 6,8rb</div>
            <div>Stok : 1</div>
        </div>
    </div>
</template>
<script>
export default {
    props:{
        barang:{
            default:{
                nama_product:"BARANG BELUM DI TENTUKAN",
                harga:'000000'
            }
        }
    }
}
</script>