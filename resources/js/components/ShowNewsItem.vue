<template>
    <div>
        <h3 class="text-center">{{ newsItem.name }}</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div v-html="newsItem.description" class="card-text"></div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">ID: {{ newsItem.id }}</li>
                        <li class="list-group-item">Created by user (id): {{ newsItem.user_id }}</li>
                        <li class="list-group-item">Created At: {{ newsItem.created_at }}</li>
                        <li class="list-group-item">Updated At: {{ newsItem.updated_at }}</li>
                    </ul>
                    <div v-if="$auth.user()" class="card-body">
                        <div class="btn-group" role="group">
                            <router-link v-if="newsItem.user_id == $auth.user().id" :to="{name: 'edit-news-item', params: { id: newsItem.id }}" class="btn btn-primary">Edit
                            </router-link>
                            <button v-if="newsItem.user_id == $auth.user().id" class="btn btn-danger" @click="deleteNewsItem(newsItem.id)">Delete</button>
                        </div>
                        <div class="clearfix"></div>
                        <div class="btn-group" role="group">
                            <like :item_id="$route.params.id" :item_type="'newsItem'" :user_id="$auth.user().id"></like>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Like from './Like.vue';
    export default {
        components: {
            Like,
        },   
        data() {
            return {
                newsItem: {}
            }
        },
        created() {
            this.axios
                .get(`/newsItem/show/${this.$route.params.id}`)
                .then((response) => {
                    this.newsItem = response.data;
                    // console.log(response.data);
                });
        },
        methods: {
           
        }
    }
</script>