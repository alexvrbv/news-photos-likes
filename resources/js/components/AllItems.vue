<template>
    <div>
        <h2 class="text-center mb-3">All Photos</h2>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-lg-6 col-xl-3" v-for="photoItem in photoItems" :key="photoItem.id">
                    <div class="card mb-4">
                        <a href="#" data-toggle="modal" :data-target="'#photoItemModal' + photoItem.id">
                            <img :src="'/storage/' + photoItem.image" class="card-img-top">
                        </a>
                        <div class="modal fade" :id="'photoItemModal' + photoItem.id" tabindex="-1" role="dialog" aria-labelledby="photoItemModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="photoItemModalLabel">{{ photoItem.name }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>                                    
                                    <div class="modal-body">
                                        <img class="mw-100" :src="'/storage/' + photoItem.image">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                <router-link :to="{ name: 'show-photo-item', params: { id: photoItem.id } }">
                                    {{ photoItem.name }}
                                </router-link>
                            </h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">ID: {{ photoItem.id }}</li>
                            <li class="list-group-item">Created by user (id): {{ photoItem.user_id }}</li>
                            <li class="list-group-item">Created At: {{ photoItem.created_at }}</li>
                            <li class="list-group-item">Updated At: {{ photoItem.updated_at }}</li>
                        </ul>
                        <div v-if="$auth.user()" class="card-body">
                            <div class="btn-group" role="group">
                                <router-link v-if="photoItem.user_id == $auth.user().id" :to="{name: 'edit-photo-item', params: { id: photoItem.id }}" class="btn btn-primary">Edit
                                </router-link>
                                <button v-if="photoItem.user_id == $auth.user().id" class="btn btn-danger" @click="deletePhotoItem(photoItem.id)">Delete</button>
                            </div>
                            <div class="clearfix"></div>
                            <div class="btn-group" role="group">
                                <like :item_id="photoItem.id" :item_type="'photoItem'" :user_id="$auth.user().id"></like>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="text-center mb-3">All News</h3>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-lg-6 col-xl-3" v-for="newsItem in newsItems" :key="newsItem.id">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">
                                <router-link :to="{ name: 'show-news-item', params: { id: newsItem.id } }">
                                    {{ newsItem.name }}
                                </router-link>
                            </h5>
                            <div v-plaintext class="card-text">{{ newsItem.description }}</div>
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
                                <like :item_id="newsItem.id" :item_type="'newsItem'" :user_id="$auth.user().id"></like>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</template>

<script>
    import Vue from 'vue';
    import Like from './Like.vue';

    Vue.directive('plaintext', {
        bind(el, binding, vnode) {
            el.innerHTML = el.innerText;
            el.innerHTML = el.innerHTML.replace(/<[^>]+>/gm, ' ');
        }
    });

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