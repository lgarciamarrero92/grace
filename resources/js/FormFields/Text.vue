<template>
    <v-text-field
        :label="label"
        @input="handleInput"
        :value="value"
        type="text"
    >
    </v-text-field>
</template>

<script>
    export default {
        props: ['value','details','label'],
        data(){
            return {
            }
        },
        mounted() {
            
        },
        methods: {
            handleInput(value){
                this.$emit('input',value)
            }
        },
    }
</script>