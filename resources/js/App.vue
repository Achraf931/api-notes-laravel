<template>
    <div class="app">
        <div class="left">
            <div @click="newNote" class="newNote"><span style="font-size: 20px; margin-right: 10px;">+</span>Nouvelle note</div>
            <Note @select="select" v-for="note in notes" :key="note.id" :note="note"  :currentNote="currentNote" :moment="moment"/>
        </div>
        <div class="right">
            <CurrentNote  @update="updateNote" :moment="moment" :note="currentNote"/>
        </div>
    </div>
</template>
<script>
    import {bus} from './app'
    import moment from 'moment'
    import {mapGetters} from 'vuex'
    import Note from './components/Note'
    import CurrentNote from './components/CurrentNote'

    export default {
        name: 'App',
        data() {
            return {
                newNoteEvent: false,
                moment: moment,
                currentNote: {
                    content: '',
                    created_at: ''
                }
            }
        },
        created() {
            bus.$on('create', result => {
                console.log(result)
            })
        },
        components: {
            Note,
            CurrentNote
        },
        computed: {
            ...mapGetters(['notes'])
        },
        beforeMount() {
            this.$store.dispatch('getNotes')
        },
        methods: {
            getNote(note) {
                bus.$emit('newNoteEvent', note.newNoteEvent)
                this.$store.dispatch('getNote', note.id)
            },
            addNote() {
                this.$store.dispatch('addNote', this.note)
            },
            updateNote(note) {
                this.$store.dispatch('updateNote', note)
            },
            emitNewEvent() {
                bus.$emit('newNoteEvent', true)
            },
            newNote(){
                this.currentNote = {
                    content: ''
                }
            },
            select(param){
                this.currentNote = param
            }
        }
    }
</script>
<style lang="scss">
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    .newNote {
        width: 100%;
        height: 55px;
        background-color: #4536BB;
    }
    ::selection {
        color: white;
        background: #4536BB;
    }
    .scrollbar-track-y {
        width: 4px !important;
    }
    .app {
        width: 100%;
        max-width: 100vw;
        height: 100vh;
        display: flex;
        flex-direction: row;
        font-family: Poppins, Nunito, Arial, sans-serif;

        .left {
            width: 30%;
            height: 100%;
            overflow: scroll;
            background-color: rgb(245,244,250);

            .newNote {
                display: flex;
                justify-content: center;
                align-items: center;
                width: 100%;
                height: 55px;
                color: white;
                cursor: pointer;
                padding: 15px;
            }
        }
        .left::-webkit-scrollbar {
            width: 5px!important;
        }
        .left::-webkit-scrollbar-thumb {
            mso-background: #4536BB;
            background: #4536BB!important;
        }
        .right {
            width: 70%;
        }
    }
</style>
