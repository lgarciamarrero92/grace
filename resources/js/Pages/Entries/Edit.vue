<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Entry
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <v-row
                        class="pa-4"
                        justify="space-between"
                    >
                        <v-col
                            class="d-flex text-center"
                        >
                            <v-scroll-y-transition mode="out-in">
                                <v-card
                                    class="pt-6 mx-auto"
                                    flat
                                    max-width="400"
                                >
                                    <h3 class="headline mb-2">
                                        {{category.title}}
                                    </h3>

                                    <create-edit-entry-form :inputs="inputs" :category="category" :entry="entry" :errors="errors"> </create-edit-entry-form>

                                </v-card>
                            </v-scroll-y-transition>
                        </v-col>
                    </v-row>
                </div>
            </div>
            <!-- Modal Portal -->
            <portal-target name="modal" multiple>
            </portal-target>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import CreateEditEntryForm from '@/Pages/Entries/CreateEditForm'
export default {
    components: {
        AppLayout,
        CreateEditEntryForm
    },
    props:{
        inputs: Array,
        entry: Object,
        category: Object,
        errors: Object
    },
    data() {
        return {
        }
    },
    mounted(){
    },
    computed: {
    },
    watch: {
    },
    methods: {
    },
}
</script>
