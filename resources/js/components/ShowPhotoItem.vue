<template>
    <div>
        <h3 class="text-center">{{ photoItem.name }}</h3>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <a href="#" data-toggle="modal" data-target="#photoItemModal">
                        <img :src="'/storage/' + photoItem.image" class="card-img-top">
                    </a>
                    <div class="modal fade" id="photoItemModal" tabindex="-1" role="dialog" aria-labelledby="photoItemModalLabel" aria-hidden="true">
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
                        <h5 class="card-title">{{ photoItem.name }}</h5>
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
                            <like :item_id="$route.params.id" :item_type="'photoItem'" :user_id="$auth.user().id"></like>
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
                photoItem: {}
            }
        },
        created() {
            this.axios
                .get(`/photoItem/show/${this.$route.params.id}`)
                .then((response) => {
                    this.photoItem = response.data;
                    // console.log(response.data);
                });
        },
        methods: {
           
        }
    }
</script>