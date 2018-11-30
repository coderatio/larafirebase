<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span class="card-title">Add post</span>
                        <span class="float-right">
                            <router-link to="/posts" class=""><i class="sl sl-icon-notebook"></i> All Posts</router-link>
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="" v-if="!isLoading">
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
                                    <button class="btn btn-primary mr-2" @click.prevent="saveRecords()"><i class="sl sl-icon-cloud-upload"></i> Save Post</button>
                                    <button class="btn" @click.prevent="closeAdd()"><i class="sl sl-icon-close"></i> Cancel</button>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center" v-if="!isConnected">
                            <div class="col-md-8 m-3">
                                <div class="alert alert-danger">
                                    <i class="sl sl-icon-info"></i> You are not connected to active internet!
                                </div>
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
    export default {
        name: "AddPost",
        data() {
            return {
                post: {
                    title: '',
                    body: ''
                },
                spinner: loadingSpinner,
                isLoading: false,
                isConnected: true
            }
        },
        
        methods: {
            async saveRecords() {
                this.isLoading = true;
                if (this.post.title == '') {
                    alert('Enter post title');
                    this.isLoading = false;
                    
                    return false;
                }
                
                if (this.post.body == '') {
                    alert('Enter post body');
                    this.isLoading = false;
                    
                    return false;
                }
                
                await axios.post(`${baseUrl}/post/store`, {
                    title: this.post.title,
                    body: this.post.body
                }).then(response => {
                    this.isLoading = false;
                    if (response.data.connected) {
                        this.isConnected = true;
                        this.$router.push({
                            path: `/post/${response.data.post.id}/edit/`
                        })
                    } else {
                        this.isConnected = false;
                    }
                }).catch(error => {
                    this.isLoading = false;
                    alert('Failed to create post');
                    console.log(error.message)
                })
            },
            
            closeAdd() {
                this.$router.push('/')
            }
        }
    }
</script>

<style scoped>
    .spinner {
        width: 50px;
    }
</style>
