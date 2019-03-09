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
        <link rel="stylesheet" href="{{url('app/css/bootstrap.min.css')}}" />
        <script src="{{url('app/js/jquery-1.11.3.min.js')}}"></script>
        <script src="{{url('app/js/bootstrap.min.js')}}"></script>
        <script src="{{url('app/plugins/vue.js')}}"></script>       
    </head>
    <body>
        <div id="app">
            <list></list>
            <template id="list-template">
                <div v-for="task in list">
                    <table class="table table-bordered table-hover table-fixed table-responsive">
                        <tr>
                            <td style="width: 30%;text-align: center">@{{task.name}}</td>
                            <td style="width: 30%;text-align: center">@{{task.email}}</td>
                            <td style="width: 40%;text-align: center">@{{task.mobile_number}}</td>
                        </tr>
                    </table>                 
                </div>
            </template>
        </div>
        <script>
Vue.component('list', {
    template: '#list-template',
    data: function () {
        return {
            list: []
        }
    },
    created: function () {
        $.getJSON('../api/users/list?email=anand.vuppu@pravahya.com', function (data) {
            this.list = data.result;
        }.bind(this))
    }
});
new Vue({
    el: '#app',
})
        </script>
    </body>
</html>