<template>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Tambah Cuti Baru</h5>
                        <form @submit.prevent="submit" class="row g-3">
                            <div class="col-12">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" id="nama" v-model="form.nama" class="form-control form-control-sm" placeholder="Masukkan nama anda">
                            </div>
                            <div class="col-12">
                                <label for="jenis_cuti" class="form-label">Jenis Cuti</label>
                                <input type="text" id="jenis_cuti" v-model="form.jenis_cuti" class="form-control form-control-sm" placeholder="Cth: Cuti Tahunan, Sakit, Khusus">
                            </div>
                            <div class="col-md-6">
                                <label for="tarikh_mula" class="form-label">Tarikh Mula</label>
                                <input type="date" id="tarikh_mula" v-model="form.tarikh_mula" class="form-control form-control-sm">
                            </div>
                            <div class="col-md-6">
                                <label for="tarikh_tamat" class="form-label">Tarikh Tamat</label>
                                <input type="date" id="tarikh_tamat" v-model="form.tarikh_tamat" class="form-control form-control-sm">
                            </div>
                            <div class="col-12 d-flex gap-2">
                                <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                                <Link href="/cutis" class="btn btn-secondary btn-sm">Batal</Link>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import { useForm } from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3'

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

<!-- Bootstrap CSS must be included globally in layout/head -->