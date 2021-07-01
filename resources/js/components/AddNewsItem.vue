<template>
    <div>
        <h3 class="text-center">Add News Item</h3>
        <div class="row">
            <div class="col-md-12">
                <form @submit.prevent="addNewsItem">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="newsItem.name" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <vue-editor id="editor" useCustomImageHandler @image-added="handleImageAdded" v-model="newsItem.description" required />
                    </div>
                    <button type="submit" class="btn btn-primary">Add News Item</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import { VueEditor } from "vue2-editor";
    export default {
        components: {
            VueEditor,
        }, 
        data() {
            return {
                newsItem: {}
            }
        },
        methods: {
            addNewsItem() {
                this.axios
                    .post('/newsItem/store', this.newsItem)
                    .then(response => (
                        this.$router.push({name: 'home'})
                        // console.log(response.data)
                    ))
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
            },
            handleImageAdded: function(file, Editor, cursorLocation, resetUploader) {
                let formdata = new FormData();
                formdata.append("image", file);
                axios.post('/editor-image-store', formdata)
                    .then(response => {
                        Editor.insertEmbed(cursorLocation, "image", "/storage/"+response.data);
                        resetUploader();
                    });
            }
        }
    }
</script>