<!DOCTYPE>
<html>
    <head>
        <title>Vue js Hello World</title>
        <style>
            .error{
                color: red
            }
            .margin-40{
                margin: 40px;
                width: 100%;
                text-align: center
            }
            .margin-10{
                margin: 10px;
                width: 100%
            }
        </style>
        <script src="{{url('app/plugins/vue.js')}}"></script>
    </head>
    <body>
        <div id="app">
            <form class="margin-40" id="form">
                <counter subject="Likes"></counter>
                <counter subject="DisLikes"></counter>
            </form>
            <template id="counter-template">
                <h2>@{{subject}}</h2>
                <button type="button" @click="count += 1">@{{count}}</button>
            </template>
        </div>
        <script>

new Vue({
    el: '#app',
    components: {
        counter: {
            template: '#counter-template',
            props: ['subject'],
            data: function () {
                return {count: 0};
            }
        }
    }})
        </script>
    </body>
</html>