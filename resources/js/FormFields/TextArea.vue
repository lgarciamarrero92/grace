<template>
    <v-textarea
        :label="label"
        @input="handleInput"
        :value="value"
        type="text"
    >
    </v-textarea>
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