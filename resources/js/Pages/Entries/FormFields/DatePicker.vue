<template>
    <v-menu
        v-model="show"
        :close-on-content-click="false"
        :nudge-right="40"
        transition="scale-transition"
        offset-y
        min-width="auto"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-text-field
            v-model="value"
            prepend-icon="mdi-calendar"
            readonly
            v-bind="attrs"
            v-on="on"
          >
            <template v-slot:label>
              <span v-if="required" style="color: red">*</span>
              {{label}}
            </template>
          </v-text-field>
        </template>
        <v-date-picker
          v-if="JSON.parse(details).type == 'month'"
          v-model="$data._value"
          @input="handleInput"
          type="month"
        ></v-date-picker>
        <v-date-picker
          v-else
          v-model="$data._value"
          @input="handleInput"
        ></v-date-picker>
    </v-menu>
</template>

<script>
    export default {
        props: ['value','details','label','required'],
        data(){
            return {
                _value: this.value,
                show: false
            }
        },
        mounted() {
        },
        methods: {
            handleInput(value){
                this.show = false;
                this.$emit('input', this.$data._value);
            }
        },
    }
</script>
