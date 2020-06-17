<template>
    <div>
        <h3 class="text-center">Edit Photo</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updatePhotoItem">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="photoItem.name">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Photo</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                photoItem: {}
            }
        },
        created() {
            this.axios
                .get(`/photoItem/edit/${this.$route.params.id}`)
                .then((response) => {
                    this.photoItem = response.data;
                    // console.log(response.data);
                });
        },
        methods: {
            updatePhotoItem() {
                this.axios
                    .post(`/photoItem/update/${this.$route.params.id}`, this.photoItem)
                    .then((response) => {
                        this.$router.push({name: 'home'});
                    });
            }
        }
    }
</script>