<template>
    <v-autocomplete
        v-model="$data.selected"
        :items="JSON.parse(details).options"
        :label="label"
        multiple
        @input="handleInput"
        chips
        deletable-chips
        hide-selected
    ></v-autocomplete>
</template>

<script>
    export default {
        props: ['value','details','label'],
        data(){
            return {
                selected: this.value,
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
