<template>
    <div>
        <h3 class="text-center">Add Photo</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addPhotoItem">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="photoItem.name">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Photo</button>
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
        methods: {
            addPhotoItem() {

                this.axios
                    .post('/photoItem/store', this.photoItem)
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