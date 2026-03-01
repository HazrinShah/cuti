<template>
    <div>Tambah Cuti</div>

    <form @submit.prevent="submit">
        <div>
            <label for="nama">Nama:</label>
            <input type="text" id="nama" v-model="form.nama">
        </div>

        <div>
            <label for="jenis_cuti">Jenis Cuti:</label>
            <input type="text" id="jenis_cuti" v-model="form.jenis_cuti">
        </div>

        <div>
            <label for="tarikh_mula">Tarikh Mula:</label>
            <input type="date" id="tarikh_mula" v-model="form.tarikh_mula">
        </div>

        <div>
            <label for="tarikh_tamat">Tarikh Tamat:</label>
            <input type="date" id="tarikh_tamat" v-model="form.tarikh_tamat">
        </div>

        <button type="submit">Simpan</button>

    </form>
</template>

<script setup>

import { useForm } from '@inertiajs/vue3'

const form = useForm({
    nama: '',
    jenis_cuti: '',
    tarikh_mula: '',
    tarikh_tamat: ''
})

function submit() {
    form.post('/cutis');
}

</script>