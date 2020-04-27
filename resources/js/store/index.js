import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        notes: []
    },
    getters: {
        notes: state => {
            return state.notes
        }
    },
    mutations: {
        getNotes(state, notes) {
            state.notes = notes
        },
        addNote(state, {note}) {
            state.notes.unshift(note)
        },
        deleteNote(state, elem){
            state.notes.splice(state.notes.findIndex(note =>  note.id === elem), 1)
        },
    },
    actions: {
        addNote({commit}, note) {
            axios.post(`/api/notes`, note)
                .then(res => {
                    {
                        commit('addNote', res.data)
                    }
                })
                .catch(err => console.error(err))
        },

        getNotes({commit}) {
            axios.get('/api/notes')
                .then(res => {
                    {
                        commit('getNotes', res.data.notes)
                    }
                })
                .catch(err => {
                    console.log(err)
                })
        },

        updateNote({commit}, note) {
            axios.patch(`/api/notes/${note.id}`, note)
                .catch(err => {
                    console.log(err)
                })
        },

        deleteNote({commit}, note) {
            console.log(note)
            if (note.content !== '') {
                axios.delete(`/api/notes/${note.id}`)
                    .then(res => {
                        {
                            commit('deleteNote', note.id)
                        }
                    })
                    .catch(err => {
                        console.log(err)
                    })
            }
        }
    }
})


