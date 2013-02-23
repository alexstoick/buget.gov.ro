<html>
	<head>
		<script src="js/jit.js"></script>
		<script src="js/treemap.js"></script>
		<link type="text/css" href="css/base.css" rel="stylesheet" />
		<link type="text/css" href="css/Treemap.css" rel="stylesheet" />
	</head>
	<body onload="init();">
<div id="container">

<div id="left-container">



<div class="text">
<h4>
TreeMap with on-demand nodes    
</h4> 

            This example shows how you can use the <b>request</b> controller method to create a TreeMap with on demand nodes<br /><br />
            This example makes use of native Canvas text and shadows, but can be easily adapted to use HTML like the other examples.<br /><br />
            There should be only one level shown at a time.<br /><br /> 
            Clicking on a band should show a new TreeMap with its most listened albums.<br /><br />            
            
</div>

<div id="id-list">
<table>
    <tr>
        <td>
            <label for="r-sq">Squarified </label>
        </td>
        <td>
            <input type="radio" id="r-sq" name="layout" checked="checked" value="left" />
        </td>
    </tr>
    <tr>
         <td>
            <label for="r-st">Strip </label>
         </td>
         <td>
            <input type="radio" id="r-st" name="layout" value="top" />
         </td>
    <tr>
         <td>
            <label for="r-sd">SliceAndDice </label>
          </td>
          <td>
            <input type="radio" id="r-sd" name="layout" value="bottom" />
          </td>
    </tr>
</table>
</div>

<a id="back" href="#" class="theme button white">Go to Parent</a>


<div style="text-align:center;"><a href="example2.code.html">See the Example Code</a></div>
</div>

<div id="center-container">
    <div id="infovis"></div>    
</div>

<div id="right-container">

<div id="inner-details"></div>

</div>

<div id="log"></div>
</div>
	</body>
</html>
