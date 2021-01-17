<template>
    <v-col cols="12">
        <v-subheader class="pl-0">
          {{ label }}: {{ slider }}
        </v-subheader>
        <v-slider
          v-model="slider"
          thumb-label
          @input="handleInput"
          max="1000"
          :hint="JSON.parse(details).hint"
        ></v-slider>
      </v-col>
</template>

<script>
    export default {
        props: ['value','details','label'],
        data(){
            return {
                slider: this.value,
            }
        },
        mounted() {
        },
        methods: {
            handleInput(value){
                this.$emit('input', this.$data.slider);
            }
        },
    }
</script>
