<template>
    <div class="container mt-5">
        <div class="logo-container mb-4">
            <img src="../../assets/fashionette-logo.svg" class="company-logo mb-3" alt="fashionette logo">
        </div>
        <div class="text-content">
            <h1 class="header">Basic Laravel setup / API for the GET request to TVMaze</h1>
            <h2 class="mt-5">Basic usage</h2>
            <p class="message mt-4">Send a GET request to /search with your query parameter.</p>
            <div class="d-flex">
                <p class="message">For example: <a class="example" href="http://0.0.0.0/api/search?q=deadwood" target="_blank"> http://0.0.0.0/api/search?q=deadwood</a></p>
            </div>

            <h2 class="mt-3">Error response codes:</h2>
            <table class="tg">
                <thead>
                <tr>
                    <th class="tg-0lax">Error code</th>
                    <th class="tg-0lax">Description</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="tg-0lax">1</td>
                    <td class="tg-0lax">Invalid query parameter provided</td>
                </tr>
                <tr>
                    <td class="tg-0lax">2</td>
                    <td class="tg-0lax">Request to external API failed / Guzzle Exception caught</td>
                </tr>
                <tr>
                    <td class="tg-0lax">3</td>
                    <td class="tg-0lax">Unsupported API call, this challenge API supports /search with a query parameter 'q'</td>
                </tr>
                </tbody>
            </table>
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
// https://www.tablesgenerator.com/html_tables
.tg {
    border-collapse: collapse;
    border-spacing: 0;
}
.tg td {
    border-color: black;
    border-style: solid;
    border-width: 1px;
    font-size: 20px;
    overflow: hidden;
    padding: 10px 5px;
    word-break: normal;
}
.tg th {
    border-color: black;
    border-style: solid;
    border-width: 1px;
    font-size: 20px;
    overflow: hidden;
    padding: 10px 5px;
    word-break: normal;
}
.tg .tg-0lax {
    text-align: left;
    vertical-align: top
}
</style>
