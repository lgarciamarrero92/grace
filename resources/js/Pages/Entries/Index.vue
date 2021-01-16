<template>
    <div>
        <v-data-iterator
            :items="items"
            :search="search"
            :loading="isBusy"
            loading-text="Loading... Please wait"
            :sort-by="sortBy.toLowerCase()"
            :sort-desc="sortDesc"
        >
            <template v-slot:header>
                <v-toolbar
                    dark
                    color="blue darken-3"
                    class="mb-1"
                >
                    <v-text-field
                        v-model="search"
                        clearable
                        flat
                        solo-inverted
                        hide-details
                        prepend-inner-icon="mdi-magnify"
                        label="Search"
                    ></v-text-field>

                    <template v-if="$vuetify.breakpoint.mdAndUp">
                        <v-spacer></v-spacer>
                        <v-select
                            v-model="sortBy"
                            flat
                            solo-inverted
                            hide-details
                            :items="keys"
                            prepend-inner-icon="mdi-magnify"
                            label="Sort by"
                        ></v-select>
                            <v-spacer></v-spacer>
                            <v-btn-toggle
                                v-model="sortDesc"
                                mandatory
                            >
                            <v-btn
                                large
                                depressed
                                color="blue"
                                :value="false"
                            >
                                <v-icon>mdi-arrow-up</v-icon>
                            </v-btn>
                            <v-btn
                                large
                                depressed
                                color="blue"
                                :value="true"
                            >
                                <v-icon>mdi-arrow-down</v-icon>
                            </v-btn>
                        </v-btn-toggle>
                    </template>
                </v-toolbar>
            </template>
            <template v-slot:default="props">
                <v-row>
                    <v-col
                        v-for="item in props.items"
                        :key="item.id"
                        cols="6"
                    >
                        <v-card>
                            <v-card-title>
                                <span
                                    style="width: 70%;">
                                   {{item.category.title}}
                                </span>
                                <span
                                    style="width: 30%;">
                                    <v-rating
                                        style="float: right"
                                        :value="4.5"
                                        color="amber"
                                        dense
                                        half-increments
                                        readonly
                                        size="20"
                                    ></v-rating>
                                </span>
                            </v-card-title>

                            <v-card-text>

                                <div
                                    v-for="(entry,index) in item.entry_rows"
                                    :key="index"
                                >
                                    <strong>{{ entry[0].data_input.display_name }}</strong>:

                                    <span
                                        style="margin-right: 10px;"
                                        v-for="(elm, idx) in entry"
                                        :key="idx">
                                        {{ elm.value }}

                                    </span>

                                </div>

                            </v-card-text>
                            <v-card-actions>
                                <inertia-link :href="route('entries.edit',item.id)">
                                    <v-btn
                                        text
                                        color="deep-purple accent-4"
                                    >
                                        Edit
                                    </v-btn>
                                </inertia-link>

                                <v-btn
                                    text
                                    color="error"
                                    @click="handleDelete(item.id)"
                                >
                                    Delete
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-col>
                </v-row>
            </template>
        </v-data-iterator>
        <confirm-dialog ref="confirmDialog"></confirm-dialog>
    </div>
</template>

<script>
import ConfirmDialog from '@/Mixins/ConfirmDialog'
export default {
    components: {
        ConfirmDialog
    },
    props:{
    },
    data() {
        return {
            items: [],
            search: '',
            isBusy: false,
            sortBy: 'name',
            sortDesc: false,
            keys: [
                'name',
                'titulo'
            ]
        }
    },
    mounted(){
        this.getEntries()
    },
    computed: {
    },
    watch: {
    },
    methods: {
        getEntries(){
            this.isBusy = true
            axios.get('/entries').then(res => {
                //this.items = res.data

                this.items = res.data.map(elm => {
                    let n_elm = elm;
                    let entry_rows = {};
                    elm.entry_rows.forEach(item => {
                        if(entry_rows.hasOwnProperty(item.data_input_id)){
                            entry_rows[item.data_input_id].push(item);
                        }
                        else{
                            entry_rows[item.data_input_id] = [item];
                        }
                    });
                    n_elm.entry_rows = entry_rows;
                    return n_elm;
                });


                this.isBusy = false
            })
        },
        handleDelete(id){
            this.$refs.confirmDialog.open('Delete', 'Are you sure?', { color: 'red' }).then((confirm) => {
                if(confirm)
                    this.$inertia.delete(`entry/${id}`)
            })
        },
    },
}
</script>
