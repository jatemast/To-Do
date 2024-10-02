<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            Dashboard
        </template>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                ¡Has iniciado sesión, {{ $page.props.auth.user.name }}!

                <div class="flex justify-center mt-4">
                    <img src="/character/estudiante.webp" alt="Dashboard Image" class="rounded-lg shadow-lg">
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3';
</script>
