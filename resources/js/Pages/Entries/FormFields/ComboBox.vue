<template>
    <v-combobox
        :value="value"
        :items="items"
        :loading="isLoading"
        :search-input.sync="search"
        :multiple="multiple == 1"
        @change="handleChange"
        chips
        deletable-chips
        hide-selected
    >
        <template v-slot:label>
          <span v-if="required" style="color: red">*</span>
          {{label}}
        </template>
        <template v-slot:no-data>
            <v-list-item v-if="search && !isLoading">
                <v-list-item-content>
                    <v-list-item-title>
                        No results matching "<strong>{{ search }}</strong>". Press <kbd>enter</kbd> to create a new one
                    </v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </template>
    </v-combobox>
</template>

<script>
    export default {
        props: ['value','details','label','multiple','required'],
        data(){
            return {
                selected: this.value,
                search: null,
                isLoading: false,
                items: JSON.parse(this.details).options?JSON.parse(this.details).options:[]
            }
        },
        mounted() {
            let optionsApi = JSON.parse(this.details)["options-api"]
            if(optionsApi){
                this.isLoading = true
                axios.get(optionsApi).then(res=>{
                    this.items = []
                    if(res.data){
                        res.data.forEach(element => {
                            this.items.push(element.name)
                        });
                    }
                    this.isLoading = false
                })
            }
        },
        methods: {
            handleChange(value){
                this.search = ''
                if(value.length){
                    let last = value[value.length-1]
                    if(!last){
                        value.pop()
                    }
                }
                this.$emit('input', value);
            }
        },
        computed: {
        },
        watch: {
            search(val) {
                if(!JSON.parse(this.details)["search-api"]){
                    return
                }
                this.isLoading = true
                axios.get(`${JSON.parse(this.details)["search-api"]}?query=${val}`).then(res=>{
                    this.items = []
                    if(res.data){
                        res.data.forEach(element => {
                            this.items.push(element.name)
                        });
                    }
                    this.isLoading = false
                })
            }
        }
    }
</script>
