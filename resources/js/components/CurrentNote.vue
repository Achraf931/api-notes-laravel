<template>
    <div>
        <header>
            <p>{{moment(note.updated_at).locale('fr').format('Do MMMM YYYY, HH:mm')}}</p>
        </header>
        <textarea v-model="note.content" @keyup="newNote(note)">
            {{note.content}}
        </textarea>
    </div>
</template>
<script>
    import {mapActions} from 'vuex'
    export default {
        props: ['note', 'moment'],
        methods: {
            ...mapActions({
                addNote: 'addNote',
                updateNote: 'updateNote'
            }),
            newNote() {
                if (this.note.id) {
                    this.updateNote(this.note)
                } else {
                    this.addNote(this.note)
                }
            }
        }
    }
</script>
<style lang="scss" scoped>
    div {
        height: 100%;
    }

    header {
        width: 100%;
        padding: 15px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-bottom: 1px solid #E9EAEE;
    }

    textarea {
        width: 100%;
        height: 90%;
        border: none;
        outline: none;
        font-size: 18px;
        padding: 15px;
    }
</style>
