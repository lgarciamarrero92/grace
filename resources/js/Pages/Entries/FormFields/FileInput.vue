<template>
    <v-file-input
        v-model="selected"
        :label="label"
        :multiple="isTrue(multiple)"
        accept="image/png, image/jpeg, image/bmp"
        @change="handleInput"
        truncate-length="15"
        >
        <template v-slot:selection="{ index, text }">
            <v-tooltip slot="append" left>
                <template v-slot:activator="{ on }">
                    <v-chip
                    v-on="on"
                    small
                    label
                    color="primary"
                    :close="isTrue(multiple)"
                    @click:close="deleteChip(index)"
                    draggable

                    >
                        {{ text }}
                    </v-chip>
                </template>
                <span>
                    <v-img
                    :src="createBlob(index)"
                    max-width="200"
                    ></v-img>
                </span>
            </v-tooltip>
        </template>
    </v-file-input>
</template>

<script>
    export default {
        props: {
            value: Array,
            details: String,
            label: String,
            multiple: Number
        },
        data(){
            return {
                selected: this.value
            }
        },
        mounted() {
        },
        methods: {
            handleInput(value){
                //console.log(this.$data.selected);
                this.$emit('input', this.$data.selected);
            },
            isTrue(elm){
                return elm !== 0;
            },
            showPreview(index){
                console.log(index);
            },
            deleteChip(index){
                this.$data.selected.splice(index, 1);
            },
            createBlob(index){
                if(this.$data.selected[index].onDB)
                    return '/storage/documents/' + this.$data.selected[index].name;

                return URL.createObjectURL(this.$data.selected[index]);
            }
        },
    }
</script>
