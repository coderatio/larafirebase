<template>
    <div class="alert alert-danger">
        <i class="sl sl-icon-info"></i> <b>Whoops</b>. Unable to connect to firebase!
        <a href="#" class="btn btn-primary btn-sm" onclick="window.location.reload()"><b>Retry</b></a>
    </div>
</template>

<script>
    export default {
        name: "NoInternet"
    }
</script>

<style scoped>

</style>
