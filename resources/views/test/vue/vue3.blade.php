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
                width: 100%
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
            <form class="margin-40" id="form" @submit="handle">
                <div class="margin-10">
                    <div class="error" v-show="!name">Enter Name</div>
                    <input value="@{{count}}" id="name" name="name" v-model="name" />
                </div>
                <div class="margin-10">
                    <div class="error" v-show="!message">Enter Message</div>
                    <input id="message" name="message" v-model="message" />
                </div>
                <div class="margin-10">
                    <input type="submit" value="submit" />
                </div>
            </form>
        </div>
        <script>
new Vue({
    el: '#app',
    data: {
        message: '',
        name:'',
        count: 0
    },
    methods: {
        handle: function (e) {
            console.log('Hiii');
            this.count++;
//            var form = $("#form").serialize();
            console.log(this.name)
            e.preventDefault();
        }
    }
})
        </script>
    </body>
</html>