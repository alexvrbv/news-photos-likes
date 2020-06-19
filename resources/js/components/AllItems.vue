<template>
    <div>
        <h3 class="text-center">All Photos</h3><br/>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Created by user (id)</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th v-if="$auth.user()">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="photoItem in photoItems" :key="photoItem.id">
                <td>{{ photoItem.id }}</td>
                <td>{{ photoItem.name }}</td>
                <td><img class="img-thumbnail" :src="'/storage/' + photoItem.image"></td>
                <td>{{ photoItem.user_id }}</td>
                <td>{{ photoItem.created_at }}</td>
                <td>{{ photoItem.updated_at }}</td>
                <td v-if="$auth.user()">
                    <div class="btn-group" role="group">
                        <router-link v-if="photoItem.user_id == $auth.user().id" :to="{name: 'edit-photo-item', params: { id: photoItem.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button v-if="photoItem.user_id == $auth.user().id" class="btn btn-danger" @click="deletePhotoItem(photoItem.id)">Delete</button>
                    </div>
                    <div class="clearfix"></div>
                    <div class="btn-group" role="group">
                        <like :item_id="photoItem.id" :item_type="'photoItem'" :user_id="$auth.user().id"></like>
                    </div>                    
                </td>
            </tr>
            </tbody>
        </table>
        <br/>

        <h3 class="text-center">All News</h3><br/>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Created by user (id)</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th v-if="$auth.user()">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="newsItem in newsItems" :key="newsItem.id">
                <td>{{ newsItem.id }}</td>
                <td>{{ newsItem.name }}</td>
                <td>{{ newsItem.user_id }}</td>
                <td>{{ newsItem.created_at }}</td>
                <td>{{ newsItem.updated_at }}</td>
                <td v-if="$auth.user()">
                    <div class="btn-group" role="group">
                        <router-link v-if="newsItem.user_id == $auth.user().id" :to="{name: 'edit-news-item', params: { id: newsItem.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button v-if="newsItem.user_id == $auth.user().id" class="btn btn-danger" @click="deleteNewsItem(newsItem.id)">Delete</button>
                    </div>
                    <div class="clearfix"></div>
                    <div class="btn-group" role="group">
                        <like :item_id="newsItem.id" :item_type="'newsItem'" :user_id="$auth.user().id"></like>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
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
                photoItems: [],
                newsItems: []
            }
        },
        created() {
            this.axios
                .get('/photoItems')
                .then(response => {
                    this.photoItems = response.data;
                });
            this.axios
                .get('/newsItems')
                .then(response => {
                    this.newsItems = response.data;
                });
        },
        methods: {
            deletePhotoItem(id) {
                this.axios
                    .delete(`/photoItem/destroy/${id}`)
                    .then(response => {
                        let i = this.photoItems.map(item => item.id).indexOf(id); // find index of your object
                        this.photoItems.splice(i, 1)
                    });
            },
            deleteNewsItem(id) {
                this.axios
                    .delete(`/newsItem/destroy/${id}`)
                    .then(response => {
                        let i = this.newsItems.map(item => item.id).indexOf(id); // find index of your object
                        this.newsItems.splice(i, 1)
                    });
            },       
        }
    }
</script>