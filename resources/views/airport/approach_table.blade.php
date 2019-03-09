<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  .table_container{
    width:95%;
    background: #fff;
    -webkit-box-shadow: 0px 1px 0px 0px rgba(0, 0, 0, 0.12);
   -moz-box-shadow: 0px 1px 0px 0px rgba(0, 0, 0, 0.12);
   box-shadow: 0px 1px 0px 0px rgba(0, 0, 0, 0.12);
   -moz-transition: 0.5s all ease;
   -o-transition: 0.5s all ease;
   margin-top:10px;
   z-index: 1;
   border: 1px solid #eee;
}
.tab_heading{
    text-align: center;
    padding: 5px;
    color: #333;
    font-weight:bold;
    font-size: 20px;
}
.sec-table{
    background: #333;
    color:#fff;
    padding: 5px;
}
.p-rl-0{
    padding-right: 0;
    padding-left: 0;
}
body{
    background: #eeeeee ;
}
.table-striped{
  background: #eee;
}
  </style>
</head>
<body >

<div class="container table_container">
   <div class="row">
       <div class="col-md-12 p-rl-0">
           <p class="tab_heading">VOBL</p>
           <table class="table table-striped">
             
               <thead class="sec-table">
                   <tr>
                   <th>File Name</th>
                   </tr>
               </thead>
               <tbody>
                   <tr>
                       <td><a href="{{url('VOBRWY09SIDs.pdf')}}" class="name" target="iframe_a"><img src="{{url('media/whe-icons/pdf.png')}}">VOBL RWY 09 SIDs.pdf</a></td>
                   </tr>
                   <tr>
                      <td><img src="{{url('media/whe-icons/pdf.png')}}">VOBL RWY 09 STARs.pdf</td>
                    </tr>
                    <tr>
                      <td><img src="{{url('media/whe-icons/pdf.png')}}">VOBL RWY 27 SIDs.pdf</td>
                    </tr>
                    <tr>
                      <td><img src="{{url('media/whe-icons/pdf.png')}}">VOBL RWY 27 STARs.pdf</td>
                    </tr>
                    <tr>
                      <td><img src="{{url('media/whe-icons/pdf.png')}}">VOBL-ILS(Y)09 (2012).pdf</td>
                    </tr>
                    <tr>
                      <td><img src="{{url('media/whe-icons/pdf.png')}}">VOBL-ILS(Y)27 (2012).pdf</td>
                    </tr> 
                    <tr>
                      <td><img src="{{url('media/whe-icons/pdf.png')}}">VOBL-ILS(Z)09 (2012).pdf</td>
                    </tr>
                    <tr>
                      <td><img src="{{url('media/whe-icons/pdf.png')}}">VOBL-ILS(Z)27 (2012).pdf</td>
                    </tr>
               </tbody>
           </table>
       </div>
   </div>
</div>
</body>
</html>