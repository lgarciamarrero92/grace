<template>
    <v-textarea
        @input="handleInput"
        :value="value"
        type="text"
    >
        <template v-slot:label>
          <span v-if="required" style="color: red">*</span>
          {{label}}
        </template>
    </v-textarea>
</template>

<script>
    export default {
        props: ['value','details','label','required'],
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