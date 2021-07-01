<template>
    <div>
        <h3 class="text-center">Edit News Item</h3>
        <div class="row">
            <div class="col-md-12">
                <form @submit.prevent="updateNewsItem">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="newsItem.name" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <vue-editor id="editor" useCustomImageHandler @image-added="handleImageAdded" v-model="newsItem.description" required />
                    </div>
                    <button type="submit" class="btn btn-primary">Update News item</button>
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
        created() {
            this.axios
                .get(`/newsItem/edit/${this.$route.params.id}`)
                .then((response) => {
                    this.newsItem = response.data;
                    // console.log(response.data);
                });
        },
        methods: {
            updateNewsItem() {
                this.axios
                    .post(`/newsItem/update/${this.$route.params.id}`, this.newsItem)
                    .then((response) => {
                        this.$router.push({name: 'home'});
                    });
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