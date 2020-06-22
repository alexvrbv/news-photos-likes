<template>
    <div>
        <h3 class="text-center">Add News Item</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addNewsItem">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="newsItem.name" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" v-model="newsItem.description" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add News Item</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
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
            }
        }
    }
</script>