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
	for(var j=1;j<=18;j++)
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
			processData ( data["results"] ) ;
		}
	});
}

function init(){
  //init data


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

initMinistereAndMakeRequest();

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


 		jsonNew.push ( { "children": [],
				       "data": { 
				         "$area": value,
                 "$color":"#"+2*i+"0000" 
				       },  
				       "id":i,
				       "name": nume
     				} );
 	}

 	var theReal_JSON = { "children": jsonNew , "id": "root" , "data": { "playcount": 547,"$area":547 } , "name":"total" } ;




 	tm.loadJSON ( theReal_JSON ) ;
 	tm.refresh ( ) ;
}