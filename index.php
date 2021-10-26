<?php

$weather="";
$error="";


if($_GET['city']){
$file_headers = @get_headers("https://www.weather-forecast.com/locations/".str_replace(' ', '', $_GET['city'])."/forecasts/latest");
if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
    $exists = false;
    $error="That city could not be found";
}
else {
    $exists = true;


  $forecastPage = file_get_contents("https://www.weather-forecast.com/locations/".str_replace(' ', '', $_GET['city'])."/forecasts/latest");
  $pageArray=explode('(1&ndash;3 days)</div><p class="b-forecast__table-description-content"><span class="phrase">', $forecastPage);
  $SecondPageArray=explode('</span></p></td><td class="b-forecast__table-description-cell--js"', $pageArray[1]);
  $weather= $SecondPageArray[0];
}
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Weather Scraper</title>
    <link rel="shortcut icon" href="https://globalnews.ca/wp-content/themes/shaw-globalnews/_img/weather/wx_87.png" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>

    <style type="text/css">
      body{
        background-image:url("image 2.jpg");
        background-repeat:no-repeat;
        background-attachment:fixed;
        margin:20px 50px 20px 50px;
      }

      .container{
        text-align:center;
        margin-top:180px;
        width:500px;
      }

      input{
        margin:30px 0;
      }
    </style>


  </head>
  <body>
    <div class="container">
      <h1>What's The Weather?</h1>
      <small>By chandranshu</small>
      <br><br>
      <form action="">
        <fieldset class="form-group">
          <label for="city" style="font-size:25px">Enter the name of a city.</label>
          <input type="text" class="form-control" id="city" name="city" placeholder="e.g. Paris, New Delhi">
        </fieldset>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      <br><br>
      <div id="weather">
        <?php

        if($weather){
          echo '<div class="alert alert-primary" role="alert">'.$weather.'</div>';
        }
        if($error){
          echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
        }

        ?>

      </div>

    </div>
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>