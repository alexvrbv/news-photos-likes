<template>
    <div>
        <h3 class="text-center">Edit News Item</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateNewsItem">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="newsItem.name">
                    </div>
                    <button type="submit" class="btn btn-primary">Update News item</button>
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
            }
        }
    }
</script>