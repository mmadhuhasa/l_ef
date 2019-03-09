<!DOCTYPE>
<html>
    <head>
        <title>Vue js Hello World</title>
        <style>
            .error{
                color: red
            }
            .margin-40,#app{
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
            <div>Skill: @{{skill}}</div>
            <input v-model="points" />
        </div>
        <script>

new Vue({
    el: '#app',
    data:{
      points: 50  
    },
    computed:{
        skill: function(){
            return (this.points>100)?'Advanced':'Beginner';
        }
    }
    
    })
        </script>
    </body>
</html>