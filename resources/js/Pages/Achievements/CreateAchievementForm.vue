<template>
    <jet-form-section >
        <template #title>
            Insert achievement
        </template>

        <template #description>
            Select blablabla
        </template>
        <template #form>

            <div class="col-span-6 sm:col-span-6">
                <template>
                    <v-row
                        class="pa-4"
                        justify="space-between"
                    >
                        <v-col cols="5">
                            <v-treeview
                                :items="achievements"
                                open-on-click
                                transition
                                :active.sync="active"
                                :open.sync="open"
                                rounded
                                activatable
                                >
                                <template v-slot:prepend="{ item }">
                                    <v-icon v-if="item.type!='leaf'">
                                        mdi-account
                                    </v-icon>
                                </template>
                            </v-treeview>
                        </v-col>

                        <v-divider vertical></v-divider>

                        <v-col
                            class="d-flex text-center"
                        >
                            <v-scroll-y-transition mode="out-in">
                                <div
                                    v-if="!selected"
                                    class="title grey--text text--lighten-1 font-weight-light"
                                    style="align-self: center;"
                                >
                                    Seleccione elemento
                                </div>
                                <v-card
                                    v-else
                                    :key="selected.id"
                                    class="pt-6 mx-auto"
                                    flat
                                    max-width="400"
                                >
                                    <h3 class="headline mb-2">
                                        {{ selected.name }}
                                    </h3>

                                    <v-form>
                                        <div v-for="item in selected.leafs">
                                            <v-text-field
                                                v-if="item.data_type=='string'"
                                                v-bind:label="item.display_name"
                                            >
                                            </v-text-field>
                                            <v-text-field
                                                v-if="item.data_type=='number'"
                                                v-bind:label="item.display_name"
                                            >
                                            </v-text-field>
                                        </div>
                                    </v-form>

                                </v-card>
                            </v-scroll-y-transition>
                        </v-col>
                    </v-row>
                </template>

            </div>




        </template>


    </jet-form-section>
</template>

<script>


    import JetActionMessage from '@/Jetstream/ActionMessage'
    import JetButton from '@/Jetstream/Button'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'

    export default {
        props: ['achievements'],
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
        },

        data: () => ({

            active: [],
            open: [],
        }),

        methods: {
            createTeam() {
                this.form.post(route('teams.store'), {
                    preserveScroll: true
                });
            },
            findRecursive(item, id){
                if(item.id === id)
                    return item

                if(!item.children)
                    return undefined

                for(let i = 0; i < item.children.length; i++){
                    const resp = this.findRecursive(item.children[i], id)

                    if(resp) return resp
                }

                return undefined
            },
            findAchievement(id){
                for(let i = 0; i < this.achievements.length; i++){
                    let ach = this.findRecursive(this.achievements[i], id);
                    if(ach)
                        return ach
                }

                return undefined
            }

        },
        mounted(){
        },
        computed:{
            items(){
                return this.achievements;
            },
            loadChildren(){

            },
            selected () {

                if (!this.active.length) return undefined

                const id = this.active[0]

                console.log(this.findAchievement(id));
                return this.findAchievement(id)
                //return this.achievements.find(ach => ach.id === id)
            },
        }
    }
</script>
