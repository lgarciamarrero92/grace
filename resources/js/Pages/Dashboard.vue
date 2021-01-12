<template>
    <app-layout>
        <template #header>
            <v-row no-gutters>
                <v-col>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        DASHBOARD
                    </h2>
                </v-col>
                <v-spacer></v-spacer>
                <v-col>
                    <inertia-link :href="route('entries.create')">
                        <v-btn
                            class="float-right"
                            depressed
                            color="primary"
                        >
                            New Entry
                        </v-btn>
                    </inertia-link>
                </v-col>
            </v-row>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <entry-index />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import EntryIndex from '@/Pages/Entries/Index'

    export default {
        components: {
            AppLayout,
            EntryIndex,
        },
    }
</script>
