var labelType, useGradients, nativeTextSupport, animate;
var tm;

(function() {
  var ua = navigator.userAgent,
      iStuff = ua.match(/iPhone/i) || ua.match(/iPad/i),
      typeOfCanvas = typeof HTMLCanvasElement,
      nativeCanvasSupport = (typeOfCanvas == 'object' || typeOfCanvas == 'function'),
      textSupport = nativeCanvasSupport 
        && (typeof document.createElement('canvas').getContext('2d').fillText == 'function');
  //I'm setting this based on the fact that ExCanvas provides text support for IE
  //and that as of today iPhone/iPad current text support is lame
  labelType = (!nativeCanvasSupport || (textSupport && !iStuff))? 'Native' : 'HTML';
  nativeTextSupport = labelType == 'Native';
  useGradients = nativeCanvasSupport;
  animate = !(iStuff || !nativeCanvasSupport);
})();

var jsonNew = [] ;

function initMinistereAndMakeRequest ( )
{
	var ministere=[];
	for(var j=1;j<=2;j++)
		ministere[j-1]=""+j;

	var data="institutie=";
	for(var i=0;i<ministere.length;i++)
	{
		data+=ministere[i];
		if(i!=ministere.length-1)
			data+=",";
	}

	$.ajax({
		dataType: "json",
		url: "ajax/getData.php",
		data: data ,
		success: function(data){
			console.log ( data["results"] ) ;
			processData ( data["results"] ) ;
		}
	});
}

function init(){
  //init data

var json = {
    "children":
    [
	     {

			"children": [], 
			"data": { 
				"$area": 276
			}, 
			"id": "album-Thirteenth Step", 
			"name": "Ministerul Finantelor"
		}, 
		{
			"children": [], 
			"data": {
				"$area": 271
			}, 
			"id": "album-Mer De Noms", 
			"name": "Ministerul de Interne"
		}
    ], 
       "data": { 
         "$area": 547
       }, 
       "id": "artist_A Perfect Circle", 
       "name": "Ministere"

   };


  //end
  //init TreeMap
tm = new $jit.TM.Squarified({  
  //where to inject the visualization  
  injectInto: 'infovis',  
  //parent box title heights  
  titleHeight: 15,  
  //enable animations  
  animate: animate,  
  //box offsets  
  offset: 1,  
  //Attach left and right click events  
  Events: {  
    enable: true,  
    onClick: function(node) {  
      if(node) tm.enter(node);  
    },  
    onRightClick: function() {  
      tm.out();  
    }  
  },  
  duration: 1000,  
  //Enable tips  
  Tips: {  
    enable: true,  
    //add positioning offsets  
    offsetX: 20,  
    offsetY: 20,  
    //implement the onShow method to  
    //add content to the tooltip when a node  
    //is hovered  
    onShow: function(tip, node, isLeaf, domElement) {  
      var html = "<div class=\"tip-title\">" + node.name   
        + "</div><div class=\"tip-text\">";  
      var data = node.data;  
      if(data.playcount) {  
        html += "play count: " + data.playcount;  
      }  
      if(data.image) {  
        html += "<img src=\""+ data.image +"\" class=\"album\" />";  
      }  
      tip.innerHTML =  html;   
    }    
  },  
  //Add the name of the node in the correponding label  
  //This method is called once, on label creation.  
  onCreateLabel: function(domElement, node){  
      domElement.innerHTML = node.name;  
      var style = domElement.style;  
      style.display = '';  
      style.border = '1px solid transparent';  
      domElement.onmouseover = function() {  
        style.border = '1px solid #9FD4FF';  
      };  
      domElement.onmouseout = function() {  
        style.border = '1px solid transparent';  
      };  
  }  
});  
console.log ( json ) ;
initMinistereAndMakeRequest();
tm.loadJSON(json);  
tm.refresh();
    //end
 }

function processData ( array )
{
	var sum=0;
	object=array;
 	for(var i=0;i<array.length;i++)
 	{
 		var value=parseInt(array[i].Suma);
 		var nume;

 		nume=array[i].NumeInstitutie;

 		jsonNew.push ( {
				       "data": { 
				       	"$color": "#906E32", 
				         "$area": value
				       },  
				       "id":nume,
				       "name": nume
     				} );
 	}
 	console.log ( jsonNew ) ;
 	var theReal_JSON = { "children:":jsonNew , "data":{"$area":8191956} , "id": "root",  "name":"total" } ;

 	console.log ( theReal_JSON ) ;
 	// tm.loadJSON ( theReal_JSON ) ;
 	// tm.refresh ( ) ;
}