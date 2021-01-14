<template>
    <v-combobox
        v-if="JSON.parse(details).combobox"
        v-model="$data.selected"
        :items="JSON.parse(details).options"
        :label="label"
        multiple
        @input="handleInput"
        chips
    ></v-combobox>
    <v-select
        v-else
        v-model="$data.selected"
        :items="JSON.parse(details).options"
        :menu-props="{ maxHeight: '400' }"
        :label="label"
        chips
        :multiple="JSON.parse(details).multiple"
        @input="handleInput"
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
