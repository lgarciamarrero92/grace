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
                                {{item.category.title}}
                            </v-card-title>

                            <v-card-text>
                                <v-rating
                                    :value="4.5"
                                    color="amber"
                                    dense
                                    half-increments
                                    readonly
                                    size="20"
                                ></v-rating>
                                <div
                                    v-for="(entry,index) in item.entry_rows"
                                    :key="index"
                                >
                                    {{entry.data_input.display_name}}: {{ entry.value }}
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
    </div>
</template>

<script>
export default {
    components: {
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
                this.items = res.data
                this.isBusy = false
            })
        },
        handleDelete(id){
            this.$inertia.delete(`entry/${id}`,{
                onBefore: () => confirm('Are you sure?'),
            })
        },
    },
}
</script>
