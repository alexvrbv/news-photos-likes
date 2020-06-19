<template>
    <div v-if="like.status == ''">
        <form @submit.prevent="addLike">
            <div class="form-group">
                <input type="hidden" :value="like.item_id" class="form-control">
                <input type="hidden" :value="like.item_type" class="form-control">
            </div>
            <button type="submit" class="btn btn-secondary">Like</button>
        </form>
    </div>
    <div v-else>
        <div class="form-group"></div>
        <button type="button" class="btn btn-secondary" @click="deleteLike(like.id)">Unlike</button>
    </div>    
</template>

<script>
    export default {
        props: [
            'item_id',
            'item_type',
            'user_id',
        ],
        data() {
            return {
                like: {
                   item_id: this.item_id, 
                   item_type: this.item_type,
                   user_id: this.user_id,
                   status: '',
                }
            }
        },
        mounted() {
            this.getLike(this.like.item_id,this.like.item_type)
        },
        methods: {
            addLike() {
                this.axios
                    .post('/like/store', this.like)
                    .then(response => (
                        this.getLike(this.like.item_id,this.like.item_type)
                    ))
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
            },
            getLike(item_id,item_type) {
                this.axios
                    .get(`/like/get-one/${item_id}/${item_type}`)
                    .then(response => {
                        this.like.current_state = response.data;
                        if (response.data['0']) {
                            this.like.id = response.data['0'].id;
                            this.like.status = 'liked';
                        } else {
                            this.like.id = 0;
                            this.like.status = '';
                        }
                    });
            },
            deleteLike(id) {
                this.axios
                    .delete(`/like/destroy/${id}`)
                    .then(response => {
                        this.like.status = '';
                    });
            },   
        }
    }
</script>