<template>
    <v-container fluid>
    <v-radio-group v-model="selected">
      <template v-slot:label>
        <div>{{ label }}</div>
      </template>
      <v-radio
        v-for="item in JSON.parse(details).options"
        :value="item"
        :key="item"
        :label="`${item}`">
      </v-radio>
    </v-radio-group>
  </v-container>
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
        watch: {
            'selected': function () {
                this.$emit('input', this.selected);
            }
        },
        methods: {
            handleInput(value){
                this.$emit('input', this.$data.selected);
            }
        },
    }
</script>
