<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="graphs/presupuesto/js/d3.v3.min.js"></script>
<script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>
<script src="graphs/presupuesto/js/bullet.js"></script>

<style>
.d3-tip {
  line-height: 1;
  font-weight: bold;
  padding: 12px;
  background: rgba(0, 0, 0, 0.8);
  color: #fff;
  border-radius: 2px;
}
.d3-tip:after {
  box-sizing: border-box;
  display: inline;
  font-size: 10px;
  width: 100%;
  line-height: 1;
  color: rgba(0, 0, 0, 0.8);
  content: "\25BC";
  position: absolute;
  text-align: center;
}

/* Style northward tooltips differently */
.d3-tip.n:after {
  margin: -1px 0 0 0;
  top: 100%;
  left: 0;
}


/**.acotaciones { float:right; margin: 0px; margin-right: 300px; } **/
.acotaciones li{ border: 1px solid #ccc; display: inline; margin: 2px; padding: 5px; list-style: none; font-size: 0.75em; } 
.t {width:200px !important;} 
li.range { background-color: #01AECE; } 
li.marker { background-color: #B0C4DE; } 
li.measure { background-color: #FFF ; }

   table {
      font-size: small !important;
   }
</style>


<style>
.barras {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  margin: auto;
  padding-top: 40px;
  position: relative;
  width: 960px;
}

.bullet { font: 10px sans-serif; }
.bullet .marker { stroke: navy; stroke-width: 2px; }
.bullet .tick line { stroke: #666; stroke-width: .5px; }

.bullet .range.s0 { fill: #01AECE; }
.bullet .range.s1 { fill: #01AECE; }
.bullet .range.s2 { fill: red; }
.bullet .range.s3 { fill: yellow; }

.bullet .measure.s0 { fill: lightsteelblue; }
.bullet .measure.s1 { fill: steelblue; }
.bullet .measure.s2 { fill: navy; }
.bullet .measure.s3 { fill: #CACACA; }

.bullet .title { font-size: 14px; font-weight: bold; }
.bullet .subtitle { fill: #999; }

.subtitle { height: 100px; background:#c0c0c0; }

</style>

</head>
<body>
<br>
   <center>
   <div style="width:900px;">
      <p style="width:700px;margin-left:77px;"> Coloca el cursor sobre las gráficas para conocer los detalle de la partida.</p>
   </div>

   <ul class="acotaciones"> 
      <li class="bullet range"> Presupuesto original </li> 
      <li class="bullet marker"> Monto ejercido </li> 
      <li class="bullet measure"> Presupuesto modificado </li> 
   </ul>
   </center>


   <div id="barras" class="barras"/>
<script>
function formatNumber(numero){ // v2007-08-06
    decimales = 2;
    separador_decimal = ".";
    separador_miles = ",";
    numero=parseFloat(numero);
    if(isNaN(numero)){
        return "";
    }

    if(decimales!==undefined){
        // Redondeamos
        numero=numero.toFixed(decimales);
    }

    // Convertimos el punto en separador_decimal
    numero=numero.toString().replace(".", separador_decimal!==undefined ? separador_decimal : ",");

    if(separador_miles){
        // Añadimos los separadores de miles
        var miles=new RegExp("(-?[0-9]+)([0-9]{3})");
        while(miles.test(numero)) {
            numero=numero.replace(miles, "$1" + separador_miles + "$2");
        }
    }

    return numero;
}


var margin = {top: 5, right: 40, bottom: 20, left: 120},
    width = 960 - margin.left - margin.right,
    height = 50 - margin.top - margin.bottom;

var chart = d3.bullet()
    .width(width)
    .height(height);
    
var tip = d3.tip( )
  .attr('class', 'd3-tip')
  .offset([-10, 0])
  .html(function(d) {
     if ($('.range:hover').length != 0) {
        return "<strong>Presupuesto original:</strong> <span style='color:#fff'>$ " + formatNumber(d.ranges)  + " </span>";
     } else {
        if ($('.measure:hover').length != 0) {
           return "<strong>Monto ejercido:</strong> <span style='color:#fff'>$ " + formatNumber(d.measures) + " </span>";        
        } else {  
           if ($('.marker:hover').length != 0) {
              return "<strong>Presupuesto modificado:</strong> <span style='color:#fff'>$ " + formatNumber(d.markers) +" </span>";         
           } else {                 
              return "<strong>Presupuesto original:</strong> <span style='color:#fff'>$ " + formatNumber(d.ranges) +
                     " <br><br><strong>Monto ejercido:</strong> <span style='color:#fff'>$ " + formatNumber(d.measures) +
                     " <br><br><strong>Presupuesto modificado:</strong> <span style='color:#fff'>$ " + formatNumber(d.markers) +
                     " </span>";
           }
        }
     }
  });
  
d3.json("data/presupuesto.json", function(error, data) {


   <!--?php $data2 = exportData2ToJson(); ?--->

//   d3.json("<?php echo URL_ROOT; ?>graphs/data2.json", function(error, data) {

  if (error) throw error;

  var svg = d3.select("#barras").selectAll("svg")
      .data(data)
    .enter().append("svg")
      .attr("class", "bullet")
      .attr("width", width + margin.left + margin.right)
      .attr("height", height + margin.top + margin.bottom)
    .append("g")
      .attr("transform", "translate(" + margin.left + "," + margin.top + ")")
      .on('mouseover', tip.show)
      .on('mouseout', tip.hide)
      .call(chart);

  
  var title = svg.append("g")
      .style("text-anchor", "end")
      .attr("transform", "translate(-6," + height / 2 + ")");


  title.append("text")
      .attr("class", "title")
      .text(function(d) { return d.title; });

  title.append("text")
      .attr("class", "subtitle")
      .attr("dy", "1em")
      .text(function(d) { return d.subtitle; });

   svg.call(tip);

  d3.selectAll("button").on("click", function() {
    svg.datum(randomize).call(chart.duration(1000)); // TODO automatic transition
  });  
});

function randomize(d) {
  if (!d.randomizer) d.randomizer = randomizer(d);
  d.ranges = d.ranges.map(d.randomizer);
  d.markers = d.markers.map(d.randomizer);
  d.measures = d.measures.map(d.randomizer);
  return d;
}

function randomizer(d) {
  var k = d3.max(d.ranges) * .2;
  return function(d) {
    return Math.max(0, d + k * (Math.random() - .5));
  };
}
</script>

</body>
</html>
