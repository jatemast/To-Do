<template>
    <div>
        <h1>Departament List</h1>
        <router-link to="/departaments/create">Add Departament</router-link>
        <ul>
            <li v-for="departament in departaments" :key="departament.id">
                {{ departament.name }}
                <router-link :to="`/departaments/${departament.id}/edit`">Edit</router-link>
                <button @click="deleteDepartament(departament.id)">Delete</button>
            </li>
        </ul>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            departaments: []
        };
    },
    mounted() {
        this.fetchDepartaments();
    },
    methods: {
        async fetchDepartaments() {
            try {
                const response = await axios.get('/api/departaments'); // Ajusta según tu ruta
                this.departaments = response.data; // Asegúrate de que esta es la forma correcta
            } catch (error) {
                console.error('Error fetching departaments:', error);
            }
        },
        async deleteDepartament(id) {
            if (confirm('Are you sure you want to delete this departament?')) {
                try {
                    await axios.delete(`/api/departaments/${id}`);
                    this.fetchDepartaments(); // Refresca la lista después de eliminar
                } catch (error) {
                    console.error('Error deleting departament:', error);
                }
            }
        }
    }
};
</script>
