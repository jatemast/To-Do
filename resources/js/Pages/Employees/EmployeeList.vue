<template>
    <div>
        <h1>Employee List</h1>
        <router-link to="/employees/create">Add Employee</router-link>
        <ul>
            <li v-for="employee in employees" :key="employee.id">
                {{ employee.name }} - {{ employee.email }}
                <router-link :to="`/employees/${employee.id}/edit`">Edit</router-link>
                <button @click="deleteEmployee(employee.id)">Delete</button>
            </li>
        </ul>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            employees: []
        };
    },
    mounted() {
        this.fetchEmployees();
    },
    methods: {
        async fetchEmployees() {
            try {
                const response = await axios.get('/api/employees'); // Ajusta según tu ruta
                this.employees = response.data; // Asegúrate de que esta es la forma correcta
            } catch (error) {
                console.error('Error fetching employees:', error);
            }
        },
        async deleteEmployee(id) {
            if (confirm('Are you sure you want to delete this employee?')) {
                try {
                    await axios.delete(`/api/employees/${id}`);
                    this.fetchEmployees(); // Refresca la lista después de eliminar
                } catch (error) {
                    console.error('Error deleting employee:', error);
                }
            }
        }
    }
};
</script>
