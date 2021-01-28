<template>
    <v-container fluid>
        <p>{{ label }}</p>
        <v-checkbox
            v-for="(option, index) in JSON.parse(details).options"
            :key="index"
            v-model="$data.selected"
            :label="option"
            :value="option"
            @change="handleInput"
        ></v-checkbox>
    </v-container>
</template>

<script>
    export default {
        props: ['value','details','label'],
        data(){
            return {
                selected: (this.value!= null && typeof(this.value) === 'object')? this.value:[]
            }
        },
        mounted() {
        },
        methods: {
            handleInput(value){
                this.$emit('input', this.$data.selected);
            }
        },
    }
</script>
