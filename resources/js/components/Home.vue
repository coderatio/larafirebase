<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="jumbotron text-center">
                    <h2>Welcome to Larafirebase</h2>
                    <p>
                        This is a simple laravel blog app with Google firebase. Choose your preference below to continue.
                    </p>
                    <p class="mt-5">
                        <router-link to="/post/add" class="btn btn-primary mr-3"><i class="sl sl-icon-plus"></i> New Post</router-link>
                        <router-link to="/posts" class="btn btn-secondary"><i class="sl sl-icon-notebook"></i> All Posts</router-link>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Home"
    }
</script>

<style scoped>

</style>
