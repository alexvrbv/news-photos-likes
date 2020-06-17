<template>
    <div class="container">
        <div class="text-center" style="margin: 20px 0px 20px 0px;">
            <h1>News Photos Likes</h1>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link :to="{ name: 'home' }" class="nav-item nav-link">Home</router-link>
                    <router-link v-if="$auth.check()" :to="{ name: 'add-photo-item' }" class="nav-item nav-link">Add photo</router-link>
                    <router-link v-if="$auth.check()" :to="{ name: 'add-news-item' }" class="nav-item nav-link">Add news item</router-link>
                    <router-link v-if="!$auth.check()" :to="{ name: 'login' }" class="nav-item nav-link">Login</router-link>
                    <router-link v-if="!$auth.check()" :to="{ name: 'register' }" class="nav-item nav-link">Register</router-link>
                    <a v-if="$auth.check()" href="#"  @click.prevent="$auth.logout()" class="nav-item nav-link">Logout ({{$auth.user().email}})</a>
                </div>
            </div>
        </nav>
        <br/>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {}
</script>