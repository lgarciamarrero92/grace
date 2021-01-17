<template>
    <v-select
        v-model="$data.selected"
        :items="JSON.parse(details).options"
        :menu-props="{ maxHeight: '400' }"
        :label="label"
        chips
        deletable-chips
        :multiple="JSON.parse(details).multiple"
        @input="handleInput"
        hide-selected
    ></v-select>
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
