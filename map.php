<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
 <body>
		<div id="map">
    <canvas id="canvas" width="2000" height="2000"></canvas>
</div>
 </body>

<script type="text/javascript">
$( document ).ready( function() {
var canvas = document.getElementById("canvas");
var context = canvas.getContext("2d");
var scale = 1.5;
var originx = 0;
var originy = 0;
var imageObj = new Image(); 
    imageObj.src = 'resources/Erangel_Minimap.png';

function draw(){
    // From: http://goo.gl/jypct
    // Store the current transformation matrix
    context.save();

    // Use the identity matrix while clearing the canvas
    context.setTransform(1, 0, 0, 1, 0, 0);
    context.clearRect(0, 0, canvas.width, canvas.height);

    // Restore the transform
    context.restore();

    // Draw on transformed context    
    context.drawImage(imageObj, 0, 0, 2000, 2000);

}
setInterval(draw,100);

canvas.onmousewheel = function (event){
    var mousex = event.clientX - canvas.offsetLeft;
    var mousey = event.clientY - canvas.offsetTop;
    var wheel = event.wheelDelta/120;//n or -n


    //according to Chris comment
    var zoom = Math.pow(1 + Math.abs(wheel)/2 , wheel > 0 ? 1 : -1);

    context.translate(
        originx,
        originy
    );
    context.scale(zoom,zoom);
    context.translate(
        -( mousex / scale + originx - mousex / ( scale * zoom ) ),
        -( mousey / scale + originy - mousey / ( scale * zoom ) )
    );

    originx = ( mousex / scale + originx - mousex / ( scale * zoom ) );
    originy = ( mousey / scale + originy - mousey / ( scale * zoom ) );
    scale *= zoom;
}

} );
</script>
</html>