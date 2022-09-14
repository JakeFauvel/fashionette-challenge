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
            <p class="message">The application is first checking if the search is cached, if so returns the response from the cache. Alternatively, it makes a GET request to TVMaze.</p>

            <h2 class="mt-3">Example successful response:</h2>
            <pre class="language-javascript">
              <code>
{
    "searchTerm": "game of thrones",
    "showData": {
        "score": 1.4277765,
        "show": {
            "id": 82,
            "url": "https://www.tvmaze.com/shows/82/game-of-thrones",
            "name": "Game of Thrones",
            "type": "Scripted",
            "language": "English",
            "genres": [
                "Drama",
                "Adventure",
                "Fantasy"
            ],
            "status": "Ended",
            "runtime": 60,
            "averageRuntime": 61,
            "premiered": "2011-04-17",
            "ended": "2019-05-19",
            "officialSite": "http://www.hbo.com/game-of-thrones",
            "schedule": {
                "time": "21:00",
                "days": [
                    "Sunday"
                ]
            },
            "rating": {
                "average": 9
            },
            "weight": 100,
            "network": {
                "id": 8,
                "name": "HBO",
                "country": {
                    "name": "United States",
                    "code": "US",
                    "timezone": "America/New_York"
                },
                "officialSite": "https://www.hbo.com/"
            },
            "webChannel": null,
            "dvdCountry": null,
            "externals": {
                "tvrage": 24493,
                "thetvdb": 121361,
                "imdb": "tt0944947"
            },
            "image": {
                "medium": "https://static.tvmaze.com/uploads/images/medium_portrait/190/476117.jpg",
                "original": "https://static.tvmaze.com/uploads/images/original_untouched/190/476117.jpg"
            },
            "summary": "<p>Based on the bestselling book series <i>A Song of Ice and Fire</i> by George R.R. Martin, this sprawling new HBO drama is set in a world where summers span decades and winters can last a lifetime. From the scheming south and the savage eastern lands, to the frozen north and ancient Wall that protects the realm from the mysterious darkness beyond, the powerful families of the Seven Kingdoms are locked in a battle for the Iron Throne. This is a story of duplicity and treachery, nobility and honor, conquest and triumph. In the <b>Game of Thrones</b>, you either win or you die.</p>",
            "updated": 1658720459,
            "_links": {
                "self": {
                    "href": "https://api.tvmaze.com/shows/82"
                },
                "previousepisode": {
                    "href": "https://api.tvmaze.com/episodes/1623968"
                }
            }
        }
    }
}
              </code>
            </pre>

            <h2 class="mt-3">Example incorrect query parameters:</h2>
            <pre class="language-javascript">
                <code>
{
    "message": "Failed request, invalid query paramter",
    "suggestion": "This request expects a single query parameter (q). For example http://0.0.0.0/api/search?q=example",
    "code": 1
}
                </code>
            </pre>

            <h2 class="mt-3">Example incorrect API endpoint:</h2>
            <pre class="language-javascript">
                <code>
{
    "message": "API call not found/supported",
    "suggestion": "Try /search with a valid query parameter for example /search?q=deadwood. This is the only supported call in this challenge",
    "code": 3
}
                </code>
            </pre>

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
                <tr>
                    <td class="tg-0lax">4</td>
                    <td class="tg-0lax">Internal error</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
import "vue-code-highlight/themes/duotone-sea.css";
import "vue-code-highlight/themes/window.css";
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
