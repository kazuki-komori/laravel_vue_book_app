<template>
    <div>
        <div>
            <p>タイトル: <input type="text" v-model="title"></p>
            <p>著者: <input type="text" v-model="author"></p>
            <button @click="addBook">追加</button>
        </div>

        <div>
            <ul>
                <li v-for="(book, index) in books" :key="index">
                    {{book.id}}/{{book.title}}/{{book.author}}
                    <button :disabled="isPush" @click="displayUpdate(book.id, book.title, book.author)">編集</button>
                    <button :disabled="isPush" @click="deleteBook(book.id)">削除</button>
                </li>
            </ul>
        </div>

        <div v-if="updateForm">
            <p>idが{{updateId}}の編集フォーム</p>
            <p>タイトル: <input type="text" v-model="updateTitle"></p>
            <p>著者: <input type="text" v-model="updateAuthor"></p>
            <button @click="updateBook(updateId, updateTitle, updateAuthor)">編集する</button>
            <button @click="updateCancel">キャンセル</button>
        </div>

        <div v-if="message">
            <p>{{message}}</p>
        </div>
    </div>
</template>
<script>
import axos from "axios"
export default {
    data(){
        return{
            message: "",
            books: {},
            isPush: false,
            updateForm: false,
            title: "",
            author: "",
            updateId: "",
            updateTitle: "",
            updateAuthor: ""
        }
    },
    created() {
        this.getBook()
    },
    methods: {
        async getBook(){
            const response = await axos.get("/api/books/")
            this.books = response.data
        },
        async addBook(){
            try{
                const response = await axos.post("/api/books/",{
                    title: this.title,
                    author: this.author
                })
                this.getBook()
                this.title = ""
                this.author = ""
                this.message = ""
            } catch (e) {
                this.message = e
            }
        },
        updateCancel(){
          this.isPush = false
          this.updateForm = false
          this.message = ""
        },
        displayUpdate(id, title, author){
            this.isPush = true
            this.updateForm = true
            this.message = ""
            this.updateId = id
            this.updateTitle = title
            this. updateAuthor = author
        },
        async updateBook(id, title, author){
            try{
                const response = await axios.put(`/api/books/${id}`,{
                    title: title,
                    author: author
                })
                this.getBook()
                this.isPush = false
                this.updateForm = false
                this.message = ""
            } catch (e) {
                this.message = e
            }
        },
        async deleteBook(id){
            try{
                const response = await axos.delete(`/api/books/${id}`)
                this.getBook()
                this.message = ""
            } catch (e) {
                this.message(e)
            }
        }
    }
}
</script>
<style>

</style>
