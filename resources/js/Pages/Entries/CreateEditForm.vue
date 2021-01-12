<template>
    <v-form @submit.prevent="entry?form.post(route('entries.update',entry.id)):form.post(route('entries.store'))" ref="form">
        <v-row>
            <v-col cols="12" v-for="(input, index) in inputs" :key="index">
                <component :is="input.type+'-field'" :label="input.display_name" :details="input.details" v-model="form[input.slug]"></component>
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
            All saved successfully
        </v-snackbar>
    </v-form>
</template>

<script>
import TextField from '@/FormFields/Text'
import Text_areaField from '@/FormFields/TextArea'
export default {
    components: {
        TextField,
        Text_areaField
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
        this.inputs.sort((a,b)=>{
            return a.order-b.order
        })
    },
    computed: {
    },
    watch: {
        'category.id': function () {
            this.form = this.initForm()
        }
    },
    methods: {
        initForm(){
            var form = {
                category_id: this.category.id
            }
            this.inputs.forEach(element => {
                form[element.slug] = (element.entry_rows && element.entry_rows.length) ?element.entry_rows[0].value:null
            });
            form = this.$inertia.form(form,{
                resetOnSuccess: this.entry?false:true //is in editing false else true
            })
            return form;
        }
    },
}
</script>
