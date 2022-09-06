<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="header">Basic Laravel setup / API for the GET request to TVMaze</h1>
                <p class="message mt-5">
                    Send a GET request to /search with your query parameter.
                </p>
                <p class="message">
                   For example:
                </p>
                <a class="example" href="http://0.0.0.0/search?q=deadwood" target="_blank">http://0.0.0.0/search?q=deadwood</a>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        mounted() {
            console.log('Oh hi, you found the console. 😉👏🏼')
        }
    }
</script>
<style lang="scss" scoped>
.message, .example {
    font-size: 20px;
}
.example {
    font-weight: bold;
}
</style>
