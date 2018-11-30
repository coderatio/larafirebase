<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12 text-right mb-4">
                        <router-link to="/posts" class="btn btn-success" title="All posts"><i class="sl sl-icon-notebook"></i></router-link>
                        <router-link to="/post/add/" class="btn btn-primary" title="Add new post"><i class="sl sl-icon-plus"></i></router-link>
                        <router-link :to="`/post/${postId}/edit`" class="btn btn-secondary" title="Edit post"> <i class="sl sl-icon-note"></i></router-link>
                        <a href="" @click.prevent="deletePost(postId)" class="btn btn-danger" title="Delete post"> <i class="sl sl-icon-trash"></i></a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <span class="card-title font-weight-bold" v-if="!isLoading && isConnected">{{ post.title }}</span>
                        <span class="card-title" v-if="isLoading || !isLoading && !isConnected">Read post</span>
                    </div>
                    <div class="card-body">
                        <div v-if="!isLoading && isConnected">
                            {{ post.body }}
                            <br/><br/>
                            <div class="divider"></div>
                            <span class="text-right text-muted">
                            <i class="sl sl-icon-calender"></i> {{ post.date }}
                        </span>
                        </div>
                        <div class="row justify-content-center" v-if="!isLoading && !isConnected">
                            <div class="col-md-7 m-3">
                                <NoInternet></NoInternet>
                            </div>
                        </div>
                        <div class="row justify-content-center" v-if="isLoading">
                            <div class="col-md-2 text-center pt-3 pb-3">
                                <img :src="spinner" alt="" class="spinner">
                            </div>
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
        name: "ReadPost",
        components: {
            NoInternet
        },
        data() {
            return {
                post: {},
                postId: this.$route.params.postId,
                isLoading: true,
                spinner: loadingSpinner,
                isConnected: false
            }
        },
        mounted() {
            axios.post(`${baseUrl}/post/show`, {postId: this.$route.params.postId})
                .then(response => {
                    this.isLoading = false;
                    if (response.data.connected) {
                        this.isConnected = true;
                        this.post = response.data.post;
                    }
                })
                .catch(error => {
                    console.log(error.data.message)
                })
        },
        methods: {
            async deletePost(postId) {
                this.isLoading = true;
                if (confirm("Are you sure you want to delete this post?")) {
                    this.isLoading = true;
                    await axios.post(`${baseUrl}/post/delete`, {postId: postId})
                        .then(response => {
                            if (!response.data.connected) {
                                alert('Connect to internet please.')
                            }
                            this.$router.push('/posts')
                        }).catch(error => {
                            console.log(error.data.message)
                        })
                } else {
                    this.isLoading = false;
                }
            }
        }
    }
</script>

<style scoped>
    .spinner {
        width: 50px;
    }
    .divider {
        width: 100%;
        display: block;
        height: 2px;
        margin-bottom: 20px;
    }
</style>
