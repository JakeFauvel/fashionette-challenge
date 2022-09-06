<template>
    <div class="container mt-5">
        <div class="logo-container mb-4">
            <img src="../../assets/fashionette-logo.svg" class="company-logo mb-3" alt="fashionette logo">
        </div>
        <div class="text-content">
            <h1 class="header">Basic Laravel setup / API for the GET request to TVMaze</h1>
            <p class="message mt-4">
                Send a GET request to /search with your query parameter.
            </p>
            <p class="message">
                For example:
            </p>
            <a class="example" href="http://0.0.0.0/api/search?q=deadwood" target="_blank">http://0.0.0.0/api/search?q=deadwood</a>
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
.company-logo {
    width: 225px;
    height: auto;
}
.message, .example {
    font-size: 20px;
}
.example {
    font-weight: bold;
}
</style>
