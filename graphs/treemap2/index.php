
<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <title>Treemap - Neat Zoom Effect</title>
    <script type="text/javascript" src="js/modernizr.js" charset="utf-8"></script>
    <script type="text/javascript" src="js/d3.js"></script>
    <style type="text/css">
        body {
            overflow: hidden;
            margin: 0;
            font-size: 12px;
            font-family: "Helvetica Neue", Helvetica;
            z-index: 1000;
        }

        .footer {
            z-index: 1;
            display: block;
            font-size: 26px;
            font-weight: 200;
            text-shadow: 0 1px 0 #fff;
        }

        svg {
            overflow: hidden;
        }

        rect {
            stroke: #EEEEEE;
            overflow: hidden;
        }

        .chart {
            display: block;
            margin: auto;
        }

        .parent .label {
            color: #FFFFFF;
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);
            -webkit-text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);
            -moz-text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);
        }

        .labelbody {
            background: transparent;
        }

        .label {
            pointer-events: all;
            cursor: pointer;
            margin: 2px;
            white-space: pre;
            overflow: hidden;
/*            text-overflow: ellipsis;*/
            text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);
            -webkit-text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);
            -moz-text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);
        }

        .child {
            z-index: -10;
            overflow: hidden;
        }

        .child .label {
            white-space: pre-wrap;
            width:80%;
            text-align: center;
            text-overflow: ellipsis;
            font-size: 10px;
            margin-top: -7px;
        }

        .cell {
            font-size: 11px;
            cursor: pointer
            overflow: hidden;
            z-index: -10;
        }

        .label a {
            white-space: pre-wrap;
            width:80%;
            text-align: center;
            text-overflow: ellipsis;
        }

        .label a:after {
    	   content: attr(href);
           display: none;
        }
    </style>
</head>
<body>
<br><br>
<center><div id="body"></div></center>
<!--div class="footer">
    <select>
        <option value="size">Size</option>
        <option value="count">Count</option>
    </select>
</div-->


</body>

<script type="text/javascript">
    var supportsForeignObject = Modernizr.svgforeignobject;
    var chartWidth = 1000;
    var chartHeight = 700;
    var xscale = d3.scale.linear().range([0, chartWidth]);
    var yscale = d3.scale.linear().range([0, chartHeight]);
    var color = d3.scale.category10();
    var headerHeight = 25;
    var minHeight = 15;
    var headerColor = "#01AECE";
    var boxColor = "#BCBD22";

    var transitionDuration = 500;
    var root;
    var node;

    var treemap = d3.layout.treemap()
        .round(false)
        .size([chartWidth, chartHeight])
        .sticky(true)
        .value(function(d) {
            return d.size;
        });

    var chart = d3.select("#body")
        .append("svg:svg")
        .attr("width", chartWidth)
        .attr("height", chartHeight)
        .append("svg:g");
<?php
  $data = $_GET["f"];
?> 

    d3.json("../../data/<?php echo $data; ?>", function(data) {
        node = root = data;
        var nodes = treemap.nodes(root);

        var children = nodes.filter(function(d) {
            return !d.children;
        });
        var parents = nodes.filter(function(d) {
            return d.children;
        });

        // create parent cells
        var parentCells = chart.selectAll("g.cell.parent")
            .data(parents, function(d) {
                return "p-" + d.name;
            });
        var parentEnterTransition = parentCells.enter()
            .append("g")
            .attr("class", "cell parent")
            .on("click", function(d) {
                zoom(d);
            });
        parentEnterTransition.append("rect")
            .attr("width", function(d) {
                return Math.max(0.01, d.dx);
            })
            .attr("height", headerHeight)
            .style("z-index", 1000)
            .style("fill", headerColor);
        parentEnterTransition.append('foreignObject')
            .attr("class", "foreignObject")
            .append("xhtml:body")
            .attr("class", "labelbody")
            .append("div")
            .attr("class", "label");
        // update transition
        var parentUpdateTransition = parentCells.transition().duration(transitionDuration);
        parentUpdateTransition.select(".cell")
            .attr("transform", function(d) {
                return "translate(" + d.dx + "," + d.y + ")";
            });
        parentUpdateTransition.select("rect")
            .attr("width", function(d) {
                return Math.max(0.01, d.dx);
            })
            .attr("height", headerHeight)
            .style("z-index", 1000)
            .style("fill", headerColor);
        parentUpdateTransition.select(".foreignObject")
            .attr("width", function(d) {
                return Math.max(0.01, d.dx);
            })
            .attr("height", headerHeight)
            .select(".labelbody .label")
            .text(function(d) {
                return d.name;
            });
        // remove transition
        parentCells.exit()
            .remove();

        // create children cells
        var childrenCells = chart.selectAll("g.cell.child")
            .data(children, function(d) {
                return "c-" + d.name;
            });
        // enter transition
        var childEnterTransition = childrenCells.enter()
            .append("g")
            .attr("class", "cell child")
            .on("click", function(d) {
                zoom(node === d.parent ? root : d.parent);
            });
        childEnterTransition.append("rect")
            .classed("background", true)
            .style("fill", function(d) {
                return "#88BEDE";
//                return color(d.parent.name);
            });

        childEnterTransition.append('foreignObject')
            .attr("class", "foreignObject")
            .attr("width", function(d) {
                return Math.max(0.01, d.dx);
            })
            .attr("height", function(d) {
                return Math.max(0.01, d.dy);
//                return Math.max(minHeight, d.dy);

            })
            .append("xhtml:body")
            .attr("class", "labelbody")
            .append("a")
            .attr("target", "_blanck")
            .attr("class", "label")
            .attr("title",  function(d){
                return d.name
            })
            .attr("href", function(d){
              return '../../Sys_Detalle5?campana=' + d.id
            })
/*
            .append("div")
            .attr("class", "label")
            .text(function(d) {
                return d.name;
            });
*/
        if (supportsForeignObject) {
            childEnterTransition.selectAll(".foreignObject")
                .style("display", "none");
        } else {
            childEnterTransition.selectAll(".foreignObject .labelbody .label")
                .style("display", "none");
        }

        // update transition
        var childUpdateTransition = childrenCells.transition().duration(transitionDuration);
        childUpdateTransition.select(".cell")
            .attr("transform", function(d) {
                return "translate(" + d.x  + "," + d.y + ")";
            });
        childUpdateTransition.select("rect")
            .attr("width", function(d) {
                return Math.max(0.01, d.dx);
            })
            .attr("height", function(d) {
                return Math.max(minHeight, d.dy);
//                return d.dy;
            })
            .style("fill", function(d) {
                return "#88BEDE";
//              return color(d.parent.name);
            });
        childUpdateTransition.select(".foreignObject")
            .attr("width", function(d) {
                return Math.max(0.01, d.dx);
            })
            .attr("height", function(d) {
//                return Math.max(0.01, d.dy);
                return Math.max(minHeight, d.dy);
            })
            .select(".labelbody .label")
            .text(function(d) {
/*                a = d.name.str.split("-");
alert(a);
alert(a[0]);
                return a[0];
*/
                return d.name.substr(0,7) + '...';  // LFC ancho etiqueta
            });

        // exit transition
        childrenCells.exit()
            .remove();

        d3.select("select").on("change", function() {
            console.log("select zoom(node)");
            treemap.value(this.value == "size" ? size : count)
                .nodes(root);
            zoom(node);
        });

        zoom(node);
    });


    function size(d) {
        return d.size;
    }


    function count(d) {
        return 1;
    }


    //and another one
    function textHeight(d) {
        var ky = chartHeight / d.dy;
        yscale.domain([d.y, d.y + d.dy]);
//        return (ky * d.dy) / headerHeight;
        return headerHeight;
    }


    function getRGBComponents (color) {
        var r = color.substring(1, 3);
        var g = color.substring(3, 5);
        var b = color.substring(5, 7);
        return {
            R: parseInt(r, 16),
            G: parseInt(g, 16),
            B: parseInt(b, 16)
        };
    }


    function idealTextColor (bgColor) {
        var nThreshold = 105;
        var components = getRGBComponents(bgColor);
        var bgDelta = (components.R * 0.299) + (components.G * 0.587) + (components.B * 0.114);
        return ((255 - bgDelta) < nThreshold) ? "#000000" : "#ffffff";
    }


    function zoom(d) {
        this.treemap
            .padding([headerHeight/(chartHeight/d.dy), 0, 0, 0])
            .nodes(d);

        // moving the next two lines above treemap layout messes up padding of zoom result
        var kx = chartWidth  / d.dx;
        var ky = chartHeight / d.dy;
        var level = d;

        xscale.domain([d.x, d.x + d.dx]);
        yscale.domain([d.y, d.y + d.dy]);

        if (node != level) {
            if (supportsForeignObject) {
                chart.selectAll(".cell.child .foreignObject")
                    .style("display", "none");
            } else {
                chart.selectAll(".cell.child .foreignObject .labelbody .label")
                    .style("display", "none");
            }
        }

        var zoomTransition = chart.selectAll("g.cell").transition().duration(transitionDuration)
            .attr("transform", function(d) {
                return "translate(" + xscale(d.x) + "," + yscale(d.y) + ")";
            })
            .each("end", function(d, i) {
                if (!i && (level !== self.root)) {
                    chart.selectAll(".cell.child")
                        .filter(function(d) {
                            return d.parent === self.node; // only get the children for selected group
                        })
                        .select(".foreignObject .labelbody .label")
                        .style("color", function(d) {
//                            return idealTextColor(color(d.parent.name));
                              return idealTextColor("#000");
                        });

                    if (supportsForeignObject) {
                        chart.selectAll(".cell.child")
                            .filter(function(d) {
                                return d.parent === self.node; // only get the children for selected group
                            })
                            .select(".foreignObject")
                            .style("display", "");
                    } else {
                        chart.selectAll(".cell.child")
                            .filter(function(d) {
                                return d.parent === self.node; // only get the children for selected group
                            })
                            .select(".foreignObject .labelbody .label")
                            .style("display", "");
                    }
                }
            });

        zoomTransition.select(".foreignObject")
            .attr("width", function(d) {
                return Math.max(0.01, kx * d.dx);
            })
            .attr("height", function(d) {
                return d.children ? headerHeight: Math.max(0.01, ky * d.dy);
            })
            .select(".labelbody .label");

/*
            .text(function(d) {
                return '*'+d.name.substr(0,10);
            });
*/
        // update the width/height of the rects
        zoomTransition.select("rect")
            .attr("width", function(d) {
                return Math.max(0.01, kx * d.dx);
            })
            .attr("height", function(d) {
//                return d.children ? headerHeight : Math.max(0.01, ky * d.dy);
                return d.children ? headerHeight : Math.max(minHeight, ky * d.dy);
            })
            .style("fill", function(d) {
//                return d.children ? headerColor : color(d|.parent.name);
                return d.children ? headerColor : "#88BEDE";
            });

//            .style("fill", );

        node = d;

        if (d3.event) {
            d3.event.stopPropagation();
        }
    }
</script>

</html>
