<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Form Test
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <v-row justify="center">
                        <v-col cols="8" v-for="(input, index) in inputs" :key="index">
                            <component :is="input.type+'-field'" :label="input.display_name" :details="input.details"></component>
                        </v-col>
                        <v-col cols="8">
                            <v-btn
                                depressed
                                color="primary"
                            >
                                Save
                            </v-btn>
                        </v-col>
                    </v-row>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import TextField from '@/FormFields/Text'
import TextareaField from '@/FormFields/TextArea'
export default {
    components: {
        AppLayout,
        TextField,
        TextareaField
    },
    props:{
        inputs: Array
    },
    mounted(){
    },
    methods: {
    },
}
</script>
