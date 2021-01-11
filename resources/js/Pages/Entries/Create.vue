<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Entry
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <v-row
                        class="pa-4"
                        justify="space-between"
                    >
                        <v-col cols="5">
                            <v-treeview
                                :items="items"
                                :active.sync="active"
                                open-on-click
                                transition
                                rounded
                                activatable
                            >
                            </v-treeview>
                        </v-col>
                        <v-divider vertical></v-divider>
                        <v-col
                            class="d-flex text-center"
                        >
                            <v-scroll-y-transition mode="out-in">
                                <div
                                    v-if="!category"
                                    class="title grey--text text--lighten-1 font-weight-light"
                                    style="align-self: center;"
                                >
                                    Seleccione una categoría
                                </div>
                                <v-card
                                    v-else
                                    class="pt-6 mx-auto"
                                    flat
                                    max-width="400"
                                >
                                    <h3 class="headline mb-2">
                                        {{category.title}}
                                    </h3>

                                    <create-edit-entry-form :inputs="inputs" :category="category" :errors="errors"> </create-edit-entry-form>

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
        categories: Array,
        category: Object,
        errors: Object
    },
    data() {
        return {
            active: []
        }
    },
    mounted(){
        console.log(this.errors)
    },
    computed: {
        items(){
            return this.categories
        }
    },
    watch: {
        active: function(value, oldValue){
            const id = this.active[0]
            this.$inertia.get(route('entries.create',id),{},{only: ['inputs','category','errors'],preserveState: true, preserveScroll: true})
        }
    },
    methods: {
    },
}
</script>
