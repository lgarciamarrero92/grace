<template>
    <v-file-input
        v-model="selected"
        :label="label"
        :multiple="JSON.parse(details).multiple"
        accept="image/png, image/jpeg, image/bmp"
        @change="handleInput"
    ></v-file-input>
</template>

<script>
    export default {
        props: ['value','details','label'],
        data(){
            return {
                selected: this.value
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
