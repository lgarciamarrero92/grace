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
                        <v-btn
                            icon
                            color="white"
                            @click="expand_all = !expand_all;items.forEach(item=>{item.show_tags=false;item.show_content=false;})"
                        >
                            <v-icon>{{ expand_all ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
                        </v-btn>
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
                            <v-card-title
                                class="d-flex justify-space-between">
                                    <span
                                        @click="item.show_content = !item.show_content">
                                        {{item.category.title}}
                                    </span>
                                    <span>
                                        <v-rating
                                            v-model="item.rating"
                                            color="amber"
                                            dense
                                            half-increments
                                            size="20"
                                            hover
                                        ></v-rating>
                                    </span>
                            </v-card-title>

                            <v-expand-transition>
                                <div v-show="item.show_content || expand_all">
                                    <v-card-text>
                                        <div
                                            v-for="(entry,index) in item.entry_rows"
                                            :key="index"
                                        >
                                            <strong>{{ entry[0].data_input.display_name }}</strong>:
                                            <span
                                                class="mr-1"
                                                v-for="(elm, idx) in entry"
                                                :key="idx">
                                                {{ elm.value }}
                                            </span>
                                        </div>
                                    </v-card-text>
                                </div>
                            </v-expand-transition>

                            <v-card-actions
                                class="d-flex justify-space-between"
                            >
                                <span
                                    class="justify-sm-start"
                                >

                                    <inertia-link :href="route('entries.edit',[item.entry_id,{'category_id': item.category_id}])">
                                        <v-btn
                                            class="pa-0 ml-1"
                                            text
                                            color="deep-purple accent-4"
                                        >
                                            {{$vuetify.lang.t('$vuetify.edit')}}
                                        </v-btn>
                                    </inertia-link>

                                    <v-btn
                                        class="pa-0"
                                        text
                                        color="error"
                                        @click="handleDelete(item.entry_id)"
                                    >
                                        {{$vuetify.lang.t('$vuetify.delete')}}
                                    </v-btn>
                                </span>

                                <v-btn
                                    class="float-right"
                                    icon
                                    color="orange lighten-2"
                                    @click="item.show_tags = !item.show_tags"
                                >
                                    <v-icon>{{ item.show_tags ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
                                </v-btn>


                            </v-card-actions>
                            <v-expand-transition>

                                <div v-show="item.show_tags || expand_all">
                                    <v-spacer></v-spacer>
                                    <v-divider></v-divider>
                                    <v-card-text>
                                        <v-combobox
                                            v-model="item.selected_tags"
                                            :items="$data.tags"
                                            label="Tags"
                                            multiple
                                            chips
                                            deletable-chips
                                            hide-selected
                                        >
                                            <template v-slot:no-data>
                                                <v-list-item>
                                                <v-list-item-content>
                                                    <v-list-item-title>
                                                    No results found. Press <kbd>enter</kbd> to create a new one
                                                    </v-list-item-title>
                                                </v-list-item-content>
                                                </v-list-item>
                                            </template>
                                        </v-combobox>
                                    </v-card-text>
                                </div>
                            </v-expand-transition>
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
            ],
            expand_all: false,
            tags: ['Tag1', 'Tag2', 'Tag3']
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
                    let _title = '';
                    elm.entry_rows.forEach(item => {
                        if(item.data_input.slug === 'titulo')
                            _title = item.value;
                        if(entry_rows.hasOwnProperty(item.data_input_id)){
                            entry_rows[item.data_input_id].push(item);
                        }
                        else{
                            entry_rows[item.data_input_id] = [item];
                        }
                    });
                    n_elm.entry_rows = entry_rows;
                    n_elm.rating = 2.5;
                    n_elm.show_tags = false;
                    n_elm.show_content = true;
                    n_elm.title = _title;
                    n_elm.selected_tags = []
                    return n_elm;
                });

                console.log(this.items);

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
