<template>
    <v-form @submit.prevent="entry?form.post(route('entries.update',entry.id)):form.post(route('entries.store'))" ref="form">
        <v-row>
            <v-col cols="12" v-for="(input, index) in orderedInputs" :key="index">
                <component 
                    v-if="$options.components[getComponentName(input.type)]" 
                    :is="getComponentName(input.type)" 
                    :label="input.display_name" 
                    :required="input.required" 
                    :multiple="input.multiple" 
                    :details="input.details"
                    v-model="form[input.slug]"
                ></component>
                <v-alert v-if="errors[input.slug]" type="error" dense outlined> {{errors[input.slug]}} </v-alert>
            </v-col>
            <v-col cols="12">
                <v-btn
                    depressed
                    color="primary"
                    type="submit"
                    :disabled="form.processing"
                    :loading="form.processing"
                >
                    Save
                </v-btn>
            </v-col>
        </v-row>
        <v-snackbar
            :value="form.recentlySuccessful"
            color="success"
            top
            right
        >
            <v-icon>
                mdi-check
            </v-icon>
            All saved successfully
        </v-snackbar>
    </v-form>
</template>

<script>
export default {
    components:{
    },
    props:{
        inputs: Array,
        category: Object,
        entry: Object,
        edit: Boolean,
        errors: Object
    },
    data() {
        return {
            form: this.initForm()
        }
    },
    mounted(){
    },
    created(){
        let formFields = this.$inertia.page.props.formFields;
        this.inputs.forEach(input => {
            const componentConfig = require(`${formFields[input.type]}`)
            this.$options.components[this.getComponentName(input.type)] = componentConfig.default
        });
    },
    computed: {
        orderedInputs(){
            return this.inputs.sort((a,b)=>{
                return a.order-b.order
            })
        }
    },
    watch: {
        'category.id': function () {
            this.form = this.initForm()
        }
    },
    methods: {
        getComponentName(code){
            return (code + '-field');
        },
        initForm(){
            var form = {
                category_id: this.category.id
            }
            this.inputs.forEach(element => {

                // Handle arrays
                let ln = 0;
                if(element.entry_rows)
                    ln = element.entry_rows.length;

                if(ln === 0)
                    form[element.slug] = null;
                else if(ln === 1 && !element.multiple)
                    form[element.slug] = element.entry_rows[0].value;
                else
                    form[element.slug] = element.entry_rows.map(itm => {
                        return itm.value;
                    })
                //form[element.slug] = (element.entry_rows && element.entry_rows.length) ?element.entry_rows[0].value:null

            });
            form = this.$inertia.form(form,{
                resetOnSuccess: this.entry?false:true //is in editing false else true
            })
            return form;
        }
    },
}
</script>
