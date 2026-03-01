<template>
    <header>
        <h2>Senarai Cuti</h2>
    </header>

    <Link href="/cutis/tambah">Tambah Cuti</Link>

    <div v-if="!cutis.length">
        <p>Tiada cuti yang ditemui.</p>
    </div>

    <div v-else>
        <div v-if="editingId" class="edit-form-container">
            <h3>Edit Cuti</h3>
            <form @submit.prevent="saveEdit({ id: editingId })">
                <div>
                    <label for="edit-nama">Nama:</label>
                    <input type="text" id="edit-nama" v-model="editForm.nama">
                </div>

                <div>
                    <label for="edit-jenis_cuti">Jenis Cuti:</label>
                    <input type="text" id="edit-jenis_cuti" v-model="editForm.jenis_cuti">
                </div>

                <div>
                    <label for="edit-tarikh_mula">Tarikh Mula:</label>
                    <input type="date" id="edit-tarikh_mula" v-model="editForm.tarikh_mula">
                </div>

                <div>
                    <label for="edit-tarikh_tamat">Tarikh Tamat:</label>
                    <input type="date" id="edit-tarikh_tamat" v-model="editForm.tarikh_tamat">
                </div>

                <button type="submit" @click="">Simpan</button>
                <button type="button" @click="cancelEdit">Batal</button>
            </form>
        </div>

        <table>
            <thead>
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
                        <button @click="startEdit(c)">Edit</button>
                        <button @click="deleteCuti(c.id)">Hapus</button>

                    </td>
                </tr>

            </tbody>
        </table>


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