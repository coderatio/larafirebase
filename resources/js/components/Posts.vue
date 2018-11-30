<template>
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">All posts</span>
                    <span class="float-right">
                        <router-link to="/post/add" class="btn btn-sm btn-primary"><i class="sl sl-icon-plus"></i> New Post</router-link>
                    </span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table" v-if="!isLoading && isConnected">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(post, key) in posts" v-if="post != null">
                                <td>{{ post.id }}</td>
                                <td>{{ post.title }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Action buttons">
                                        <router-link :to="`/post/${post.id}/read`" class="btn btn-success btn-sm" title="Read Post" data-toggle="tooltip">
                                            <i class="sl sl-icon-eye"></i>
                                        </router-link>
                                        <router-link :to="`/post/${post.id}/edit`" class="btn btn-primary btn-sm" title="Edit Post" data-toggle="tooltip">
                                            <i class="sl sl-icon-note"></i>
                                        </router-link>
                                        <a href="" @click.prevent="deletePost(key, post.id)" class="btn btn-danger btn-sm" title="Delete Post">
                                            <i class="sl sl-icon-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row justify-content-center" v-if="!isLoading && !isConnected">
                        <div class="col-md-6 m-3">
                            <NoInternet></NoInternet>
                        </div>
                    </div>
                    <div v-if="isLoading" class="row justify-content-center">
                        <div class="col-md-2 pt-4 pb-4 text-center">
                            <img :src="spinner" alt="" class="spinner">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    let NoInternet = require('../components/NoInternet')
    export default {
        name: "Posts",
        components: {
            NoInternet
        },
        data() {
            return {
                posts: {},
                spinner: loadingSpinner,
                isLoading: true,
                isConnected: false
            }
        },
        mounted() {
          this.getAllPosts();
        },
        methods: {
            async getAllPosts() {
                await axios.post(`${baseUrl}/posts`, {}).then(response => {
                    this.isLoading = false;
                    if (response.data.connected) {
                        this.isConnected = true;
                        this.posts = response.data.posts;
                    }
                    console.log(response);
                }).catch(error => {
                    this.isLoading = false;
                    console.log(error.message)
                });
            },
            
            async deletePost(key, postId) {
                if (confirm("Are you sure you want to delete this post?")) {
                    this.isLoading = true;
                    this.posts.splice(key, 1);
                    await axios.post(`${baseUrl}/post/delete`, {postId: postId})
                        .then(response => {
                            this.isLoading = false;
                            if (!response.data.connected) {
                                alert('Connect to internet please.')
                            }
                        }).catch(error => {
                            this.isLoading = false;
                            console.log(error.message)
                        })
                }
            }
        }
    }
</script>

<style scoped>
    .spinner {
        width: 50px;
    }
</style>
