<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Qadashe</title>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
  

  <div class="container">
    <div class="header clearfix">
  
      <h3 class="text-muted">{{config('app.name')}}</h3>
    </div>

    <br>
    <br>
    <br>
    <br>



{{--     
    <div class="jumbotron">
      <h1>Hi, {{$data[1]['firstname'].' '.$data[1]['lastname']}} 👋🏼  </h1>
 
      <p class="lead">This is to inform you that you have received a new payment of <br> <b> &#8358;{{$data[0]['amount']}} </b> from <b>{{Auth::user()->firstname.' '.Auth::user()->lastname}}</b> in <b> Level 2.</b> </p>
     <p> <b> Cheers 🍻 </b></p>
      <p><a class="btn btn-lg btn-success" href={{route('merging')}} role="button">Approve</a></p>
    </div>
 --}}



    <footer class="footer">
      <p>© 2020 Qadashe, Inc.</p>
    </footer>

  </div>

  


</body>
</html>