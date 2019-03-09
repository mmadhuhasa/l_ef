<html>
    <head>
        <title>Vue js Hello World</title>
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.27/vue.min.js"></script>-->
        <script src="{{url('app/plugins/vue.js')}}"></script>
    </head>
    <body>
        <div id="app">            
            <input v-model="message" />
            <div>@{{message}}</div>
            <pre>
            @{{$data | json}}
            </pre>
        </div>
        <script>
new Vue({
    el: '#app',
    data: {
        message: 'Hello Vue.js!'
    }
})
        </script>
    </body>
</html>