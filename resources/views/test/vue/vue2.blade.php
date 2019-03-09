<html>
    <head>
        <title>Vue js Hello World</title>
        <style>
            .error{
                color: red
            }
        </style>
        <script src="{{url('app/plugins/vue.js')}}"></script>
    </head>
    <body>
        <div id="app">
            <div class="error" v-show='!message'>Enter valid message</div>
            <textarea rows="10" cols="30" v-model='message'></textarea>
            <div v-show='message'><input type="submit" style="margin: 20px" value="submit" /></div>
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