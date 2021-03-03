<template>
    <v-file-input
        v-model="selected"
        :label="label"
        :multiple="isTrue(multiple)"
        accept="image/png, image/jpeg, image/bmp"
        @change="handleInput"
    ></v-file-input>
</template>

<script>
    export default {
        props: {
            value: Array,
            details: String,
            label: String,
            multiple: Number
        },
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
            },
            stringToArray(itm){
                if(typeof itm === 'string')
                    return [itm];
                return itm;
            },
            isTrue(elm){
                return elm !== 0;
            }
        },
    }
</script>
