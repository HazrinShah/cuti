<template>
    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h4">Senarai Cuti</h2>
            <Link href="/cutis/tambah" class="btn btn-primary btn-sm">Tambah Cuti</Link>
        </div>

        <div v-if="!cutis.length" class="text-center py-5 text-muted">
            <p>Tiada cuti yang ditemui.</p>
        </div>

        <div v-else>
            <div v-if="editingId" class="mb-4">
                <h5>Edit Cuti</h5>
                <form @submit.prevent="saveEdit({ id: editingId })" class="row g-3">
                    <div class="col-md-6">
                        <label for="edit-nama" class="form-label">Nama</label>
                        <input type="text" id="edit-nama" v-model="editForm.nama" class="form-control form-control-sm">
                    </div>
                    <div class="col-md-6">
                        <label for="edit-jenis_cuti" class="form-label">Jenis Cuti</label>
                        <input type="text" id="edit-jenis_cuti" v-model="editForm.jenis_cuti" class="form-control form-control-sm">
                    </div>
                    <div class="col-md-6">
                        <label for="edit-tarikh_mula" class="form-label">Tarikh Mula</label>
                        <input type="date" id="edit-tarikh_mula" v-model="editForm.tarikh_mula" class="form-control form-control-sm">
                    </div>
                    <div class="col-md-6">
                        <label for="edit-tarikh_tamat" class="form-label">Tarikh Tamat</label>
                        <input type="date" id="edit-tarikh_tamat" v-model="editForm.tarikh_tamat" class="form-control form-control-sm">
                    </div>
                    <div class="col-12 d-flex gap-2">
                        <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                        <button type="button" @click="cancelEdit" class="btn btn-secondary btn-sm">Batal</button>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Nama</th>
                            <th>Jenis Cuti</th>
                            <th>Tarikh Mula</th>
                            <th>Tarikh Tamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="c in cutis" :key="c.id">
                            <td>{{ c.nama }}</td>
                            <td>{{ c.jenis_cuti }}</td>
                            <td>{{ c.tarikh_mula }}</td>
                            <td>{{ c.tarikh_tamat }}</td>
                            <td>
                                <button @click="startEdit(c)" class="btn btn-sm btn-outline-primary me-1">Edit</button>
                                <button @click="deleteCuti(c.id)" class="btn btn-sm btn-outline-danger">Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'
import { ref, reactive } from 'vue';

defineProps({
    cutis: {
        type: Array,
        default : () => []
    }
})

const editingId = ref(null);
const editForm = reactive({
    nama: '',
    jenis_cuti:'',
    tarikh_mula:'',
    tarikh_tamat:''
})

function startEdit(c){
    editingId.value = c.id;
    editForm.nama = c.nama;
    editForm.jenis_cuti = c.jenis_cuti;
    editForm.tarikh_mula = c.tarikh_mula;
    editForm.tarikh_tamat = c.tarikh_tamat;
}

function cancelEdit(){
    editingId.value = null;
    editForm.nama = '';
    editForm.jenis_cuti = '';
    editForm.tarikh_mula = '';
    editForm.tarikh_tamat = '';
}

function saveEdit(c){
    // contoh c.id=5
    // dia jadi /cutis/5/update
    // update ni kita buat dalam controller, kita buat route untuk handle ni
    router.post(`/cutis/${c.id}/update`,{
        nama: editForm.nama,
        jenis_cuti: editForm.jenis_cuti,
        tarikh_mula: editForm.tarikh_mula,
        tarikh_tamat: editForm.tarikh_tamat
    },
    {
        onSuccess: () => cancelEdit(),

    })
}

function deleteCuti(id){
    if(confirm('Adakah anda pasti mahu hapus cuti ini?')){
        router.delete(`/cutis/${id}`);
    }
}



</script>

<!--
  Make sure you include Bootstrap CSS in your layout (e.g. via CDN in head):
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
-->
