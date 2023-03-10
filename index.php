<html>
<head>
<title>Paintings Web Service </title>
<style>
  	body {font-family:georgia;}
    .painting{
      border:1px solid #E77DC2;
      border-radius: 5px;
      padding: 5px;
      margin-bottom:5px;
      position:relative; 
      min-height: 150px;
    }

    .painting-description{
      max-width: 900px;
    }
  
    .pic{
      position:absolute;
      right:10px;
      top:10px;
    }

  
    .pic img{
  	  max-width:100px;
    }


</style>
<script src="https://code.jquery.com/jquery-latest.js"></script>

<script type="text/javascript">
    function paintingTemplate(painting) {

      return `
        <div class = "painting" >
            <div class="painting-description">
              <b>Title</b>: ${painting.Title}<br>
              <b>Artist</b>: ${painting.Artist}<br>
              <b>Cost</b>:${painting.Cost}<br>
              <b>Year</b>: ${painting.Year}<br>
              <b>Note</b>: ${painting.Note}<br>
            </div>
            <div class = "Pic" ><img src="thumbnails/${painting.Image}"></div>
        </div>       
      ` ;      
    }
  
  $(document).ready(function() { 

   $('.category').click(function(e){
     e.preventDefault(); //stop default action of the link
     cat = $(this).attr("href");  //get category from URL
     //clear the oldpaintins
     $("#paintings").html("");

     var request = $.ajax({
     url: "api.php?cat=" + cat,
     method: "GET",
     dataType: "json"
   });
   request.done(function( data ) {
     console.log(data);
     $("#paintingtitle").html(data.title);

     $.each( data.paintings, function(i,item){
       let myData = paintingTemplate(item);
       $("<div></div>").html( myData ).appendTo("#paintings"); 
       
     });
 
   });
   request.fail(function(xhr, status, error ) {
alert('Error - ' + xhr.status + ': ' + xhr.statusText);
   });


  });
}); 



</script>
</head>
	<body>
	<h1>Paintings Web Service</h1>
		<a href="year" class="category">Expensive Paintings By Year</a><br />
		<a href="box" class="category">Expensive Paintings By Sale Price</a>
		<h3 id="paintingtitle">Title Will Go Here</h3>
		<div id="paintings">
      <p>Painting Will Go Here</p>
		</div>
		<div id="output">Results go here</div>
	</body>
</html>
