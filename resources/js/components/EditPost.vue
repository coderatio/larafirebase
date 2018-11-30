<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span class="card-title">Edit post</span>
                        <span class="float-right">
                            <router-link to="/post/add" class=""><i class="sl sl-icon-plus"></i> New Post</router-link>
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="" v-if="!isLoading && isConnected">
                            <div class="form-group row">
                                <label for="title" class="col-md-2 col-form-label text-md-right">Post title</label>
                                <div class="col-md-10">
                                    <input id="title" type="text" class="form-control" v-model="post.title" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="body" class="col-md-2 col-form-label text-md-right">Body</label>
                                <div class="col-md-10">
                                    <textarea name="" id="body" cols="3" rows="10" class="form-control" v-model="post.body"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="title" class="col-md-2 col-form-label text-md-right"></label>
                                <div class="col-md-10">
                                    <button class="btn btn-primary mr-2" @click.prevent="saveAndStay()"><i class="sl sl-icon-cloud-upload"></i> Save changes</button>
                                    <button class="btn" @click.prevent="closeEdit()"><i class="sl sl-icon-arrow-left-circle"></i> Back to posts</button>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center" v-if="!isLoading && !isConnected">
                            <div class="col-md-8 m-3">
                                <NoInternet></NoInternet>
                            </div>
                        </div>
                        <div v-if="isLoading" class="row justify-content-center">
                            <div class="col-md-2 pt-3 pb-3 text-center">
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
        name: "EditPost",
        components: {
            NoInternet
        },
        data() {
            return {
                post: {},
                isLoading: true,
                isConnected: false,
                spinner: loadingSpinner,
                postId: this.$route.params.postId
            }
        },
        mounted() {
          this.getPost(this.postId);
        },
        methods: {
            async getPost(id) {
                await axios.post(`${baseUrl}/post/edit`, {postId: id})
                    .then(response => {
                        this.isLoading = false;
                        if (response.data.connected) {
                            this.isConnected = true;
                            this.post = response.data.post;
                        }
                    }).catch(error => {
                        this.isLoading = false;
                        console.log(error)
                    });
            },
            
            async saveAndStay() {
                this.isLoading = true;
                await axios.post(`${baseUrl}/post/update`, {
                    id: this.post.id,
                    title: this.post.title,
                    body: this.post.body
                })
                    .then(response => {
                        this.isLoading = false;
                        alert("Post saved successfully");
                    }).catch(error => {
                        this.isLoading = false;
                        alert("Failed to update post!");
                        console.log(error.message)
                    })
            },
            
            closeEdit() {
                this.$router.push('/posts');
            }
        }
    }
</script>

<style scoped>
    .spinner {
        width: 50px;
    }
</style>
