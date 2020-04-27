<template>
    <article :class="{isActive: currentNote.id === note.id}" @dblclick="deleteNote(note)" @click="select(note)">
        <h3>{{moment(note.updated_at).locale('fr').format("D MMM")}}</h3>
        <p>{{note.content}}</p>
    </article>
</template>
<script>
    import {mapActions} from 'vuex'
    export default {
        props: ['note', 'moment', 'currentNote'],
        methods: {
            ...mapActions(['deleteNote']),
            select(note){
                this.$emit('select', note)
            }
        }
    }
</script>
<style lang="scss" scoped>
    .isActive {
        background-color: white;
    }
    article {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        background-color: rgb(245,244,250);
        border: 1px solid #E9EAEE;
        text-align: center;
        transition: background-color .2s;
        cursor: pointer;

        h3 {
            width: 30%;
            padding: 15px;
        }
        p {
            padding: 15px;
            border-left: 1px solid #E9EAEE;
            width: 100%;
            text-align: start;
        }
    }
    article:hover {
        background-color: white;
    }
</style>
