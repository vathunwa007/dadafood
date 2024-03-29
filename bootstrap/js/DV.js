
	var standardbody=(document.compatMode=="CSS1Compat")? document.documentElement : document.body //create reference to common "body" across doctypes

  //attributes you may vary
  var closingSign = "x";                                            //the sign in the upper right corner which signs to close the viewer
  var loadingSign = "L.O.A.D.I.N.G";                                //the sign in the loading-div
  var beforeSign = "&lt;";					   //the sign to show the last image
  var nextSign = "&gt;";						   //the sign to show the next image
  var borderDV = 2;                                                 //border-width arround the viewer
  var spaceDV = 20;                                                 //space between the viewer and the inner-window
  var borderColorDV = "#ffffff";                                    //border color and the color of the closing-sign-text
  var bgColorDV = "black";                                        //background color for the closing sign
  var bgOpacity = 50;						   //opacity in percent


  //DO NOT CHANGE ANYTHING IF YOU ARE NOT FAMILIAR WITH JAVASCRIPT NOW

  /**********************************************************************/
  /* DivViewer                                                          */
  /**********************************************************************/

  //create DV-Object
  var dv = new DVObject();

  function initDV() {
    //write html code to the document
    dv.writeHtmlCode();

    //initialize the dhtml-library
    DHTML_init();

    //set attributes
    dv.setAttributes();
  }

  function DVObject() {
    //attributes
    this.htmlCode;
    this.parentDV;
    this.childDVCont;
    this.childDVClose;
    this.childDVLoad;
    this.childDVBeforeAndNext;
    this.childDVTblBeforeAndNext;
    this.childDVBefore;
    this.childDVNext;
    this.errorMessage;
    this.img = new DVImg();
    this.swapImg;
    this.allImages;
    this.currentDisplayedImage;

    //general functions for the div-viewer
    // # writeHtmlCode()
    // # setAttributes()
    // # showDV()
    // # hideDV()
    // # showLoadDV()
    // # checkImgParameter()
    // # checkLoad()
    // # regSearch()
    // # regSearchNumber()
    // # getMiddlePosition()
    // # getScreenSize()
    // # decodeHtml()
    // # setOpacityStyle()
    // # getOpacityValue()

    //functions for a before-next-functionality
    // # setAllImagesArray()
    // # checkBeforeAndNextImages()
    // # showLastImage()
    // # showNextImage()
    // # getPositionOfImage()
  }
  function DVImg() {
    this.src;
    this.width;
    this.height;
    this.border;
    this.alt;
  }
  // # writeHtmlCode()
  DVObject.prototype.writeHtmlCode = function() {
    //the DV-Object consists of two inner divs
    // # content-div
    // # close-div

    //build the html code
    dv.htmlCode = '<div id="parentDV">\n' +
                    '<div id="childDVCont"><img src="" width="10" height="10" border="0" alt="" title="" name="picDV"></div>\n' +
                    '<div id="childDVLoad">'+loadingSign+'</div>' +
                    '<div id="childDVClose" onClick="dv.hideDV();" title="Schliessen!">'+closingSign+'</div>' +
                    '<div id="childDVBeforeAndNext">' +
                    ' <table id="childDVTblBeforeAndNext" cellspacing="0" cellpadding="0">' +
                    '  <tr>' +
                    '   <td><div id="childDVBefore" onClick="dv.showLastImage();" title="Vorheriges Bild"><b>'+beforeSign+'</b></div></td>' +
                    '   <td><div id="childDVNext" onClick="dv.showNextImage();" title="Nächstes Bild"><b>'+nextSign+'</b></div></td>' +
                    '  </tr>' +
                    ' </table>' +
                    '</div>' +
                  '</div>';
    //write the code to the document
    window.document.writeln(dv.htmlCode);
  };
  // # setAttributes()
  DVObject.prototype.setAttributes = function() {
    //get the html-object of the divs to change their attributes
    dv.parentDV 			= getElem("id", "parentDV", 		null);
    dv.childDVCont 		= getElem("id", "childDVCont", 		null);
    dv.childDVClose 		= getElem("id", "childDVClose", 	null);
    dv.childDVLoad 		= getElem("id", "childDVLoad", 		null);
    dv.childDVBeforeAndNext 	= getElem("id", "childDVBeforeAndNext", null);
    dv.childDVTblBeforeAndNext 	= getElem("id", "childDVTblBeforeAndNext", null);
    dv.childDVBefore 		= getElem("id", "childDVBefore", 	null);
    dv.childDVNext 		= getElem("id", "childDVNext", 		null);

    //set the style attributes to the divs
    with(dv.parentDV.style) {
      position = "absolute";
      zIndex = 100;
      border = borderDV+"px solid "+borderColorDV;
      visibility = "hidden";
    }
    with(dv.childDVCont.style) {
      position = "relative";
      zIndex = 1;
      visibility = "hidden";
    }
    with(dv.childDVClose.style) {
      position = "absolute";
      zIndex = 2;
      cursor = "pointer";
      right = borderDV+'px';
      top = borderDV+'px';
      width = 25+'px';
      height = 20+'px';
      textAlign = "center";
      verticalAlign = "middle";
      border = borderDV+"px solid "+borderColorDV;
      padding = 2;
      color = borderColorDV;
      backgroundColor = bgColorDV;
      visibility = "hidden";
    }
    dv.setOpacityStyle(dv.childDVClose.style);

    with(dv.childDVLoad.style) {
      position = "absolute";
      zIndex = 2;
      left = borderDV+'px';
      bottom = borderDV+'px';
      height = 20+'px';
      textAlign = "center";
      verticalAlign = "middle";
      border = borderDV+"px solid "+borderColorDV;
      padding = 2;
      color = borderColorDV;
      backgroundColor = bgColorDV;
      visibility = "hidden";
    }
    dv.setOpacityStyle(dv.childDVLoad.style);

    with(dv.childDVBeforeAndNext.style) {
      position = "absolute";
      zIndex = 2;
      textAlign = "center";
      verticalAlign = "middle";
      top = borderDV+'px';
      left = borderDV+'px';
      height = 20+'px';
      border = borderDV+"px solid "+borderColorDV;
      padding = 2;
      color = borderColorDV;
      backgroundColor = bgColorDV;
      visibility = "hidden";
    }
    dv.setOpacityStyle(dv.childDVBeforeAndNext.style);

    with(dv.childDVTblBeforeAndNext.style) {
      border = "none";
      height = 20;
      borderSpacing = 0;
      borderCollapse = "collapse";
      emptyCells = "show";
      padding = 0;
      margin = 0;
      textAlign = "center";
      verticalAlign = "middle";
    }

    with(dv.childDVBefore.style) {
      position = "relative";
      zIndex = 1;
      cursor = "pointer";
      textAlign = "center";
      verticalAlign = "middle";
      height = 20;
      padding = 2;
    }

    with(dv.childDVNext.style) {
      position = "relative";
      zIndex = 1;
      cursor = "pointer";
      textAlign = "center";
      verticalAlign = "middle";
      height = 20;
      padding = 2;
    }

    //set swap-image-object
    this.swapImg = document.images["picDV"];

    //set error message
    dv.errorMessage = "";
  };
  // # showDV()
  DVObject.prototype.showDV = function(imgString) {
    //hide the old image
    dv.hideDV();

    //does the parameter consist of the correct values
    dv.checkImgParameter(imgString);
    if(dv.errorMessage=="") {
      //calculate the dimension of parentDV and childDVContent
      var width = dv.img.width + 2*borderDV + 2*spaceDV;
      var height = dv.img.height + 2*borderDV + 2*spaceDV;
      var mid = dv.getMiddlePosition(width, height);

      //swap the default-image
      with(dv.swapImg) {
        src = dv.img.src;
        title = dv.img.alt;
        alt = dv.img.title;
        width = mid["width"] - (2*borderDV + 2*spaceDV);
        height = mid["height"] - (2*borderDV + 2*spaceDV);
      }
      with(dv.parentDV.style) {
        width = mid["width"] - (2*borderDV + 2*spaceDV);
        height = mid["height"] - (2*borderDV + 2*spaceDV);
        top = parseInt(mid["top"]) + borderDV + spaceDV+'px';
        left = parseInt(mid["left"]) + borderDV + spaceDV+'px';
        visibility = "visible";
      }
      with(dv.childDVCont.style) {
        visibility = "visible";
      }
      with(dv.childDVClose.style) {
        visibility = "visible";
      }
      with(dv.childDVBeforeAndNext.style) {
        visibility = "visible";
      }
      dv.showLoadDV();
      dv.checkBeforeAndNextImages(imgString);
    } else alert(dv.errorMessage);
  };
  // # hideDV()
  DVObject.prototype.hideDV = function() {
    with(dv.parentDV.style) {
      visibility = "hidden";
    }
    with(dv.childDVCont.style) {
      visibility = "hidden";
    }
    with(dv.childDVClose.style) {
      visibility = "hidden";
    }
    with(dv.childDVLoad.style) {
      visibility = "hidden";
    }
    with(dv.childDVBeforeAndNext.style) {
        visibility = "hidden";
    }
    with(dv.childDVBefore.style) {
        visibility = "hidden";
    }
    with(dv.childDVNext.style) {
        visibility = "hidden";
    }
    with(dv.swapImg) {
        src = "";
        width = 10;
        height = 10;
      }
  };
  // # showLoadDV()
  DVObject.prototype.showLoadDV = function() {
    with(dv.childDVLoad.style) {
      visibility = "visible";
    }
    dv.checkLoad();
  };
  // # checkLoad
  DVObject.prototype.checkLoad = function() {
    if(document.images["picDV"].complete==false || dv.img.src=="") {
      window.setTimeout("dv.checkLoad()", 200);
    } else {
      with(dv.childDVLoad.style) {
        visibility = "hidden";
      }
    }
  };
  // # checkImgParameter
  DVObject.prototype.checkImgParameter = function(imgString) {
    if(imgString) {
      var regSearchSrc = /src=["]?[a-zA-Z0-9.:_\-\/]+["]?/;
      var regSearchWidth = /width=["]?\d+["]?/;
      var regSearchHeight = /height=["]?\d+["]?/;
      var regSearchAlt = /alt=["]?[a-zA-Z0-9._\/&; ]*["]?/;
      var regSearchString = /[a-zA-Z0-9._\/]+/;

      //check if the principle values are given
      // # src
      if(dv.regSearch(imgString, regSearchSrc, "test")) {
        dv.img.src = dv.regSearch(imgString, regSearchSrc, "exec")+"";
        dv.img.src = dv.img.src.substring(5, dv.img.src.length-1);
      } else dv.errorMessage += "# The given Parameter within the dv.showDV-call does not consist of an src='...'!\n";
      // # width
      if(dv.regSearch(imgString, regSearchWidth, "test")) {
        dv.img.width = parseInt(dv.regSearchNumber(dv.regSearch(imgString, regSearchWidth, "exec")));
      } else dv.errorMessage += "# The given Parameter within the dv.showDV-call does not consist of an width='...'!\n";
      // # height
      if(dv.regSearch(imgString, regSearchHeight, "test")) {
        dv.img.height = parseInt(dv.regSearchNumber(dv.regSearch(imgString, regSearchHeight, "exec")));
      } else dv.errorMessage += "# The given Parameter within the dv.showDV-call does not consist of an hidth='...'!\n";
      //check optional values
      // # alt | title
      if(dv.regSearch(imgString, regSearchAlt, "test")) {
        dv.img.alt = dv.regSearch(imgString, regSearchAlt, "exec")+"";
        dv.img.alt = dv.img.alt.substring(5, dv.img.alt.length-1);
        dv.img.alt = dv.decodeHtml(dv.img.alt);
        dv.img.title = dv.img.alt;
      }
    } else dv.errorMessage += "# The Parameter within the dv.showDV-call is null!\n";
  };
  // # decodeHtml()
  DVObject.prototype.decodeHtml = function(encodedString) {
    //exchanges some html-decoded signs
    encodedString = encodedString.replace(/&auml;/, "ä");
    encodedString = encodedString.replace(/&Auml;/, "Ä");
    encodedString = encodedString.replace(/&uuml;/, "ü");
    encodedString = encodedString.replace(/&Uuml;/, "Ü");
    encodedString = encodedString.replace(/&ouml;/, "ö");
    encodedString = encodedString.replace(/&Ouml;/, "Ö");
    encodedString = encodedString.replace(/&szlig;/, "ß");

    return encodedString;
  };
  // # regSearch()
  DVObject.prototype.regSearch = function(regString, regSearch, fct) {
    if(fct=="exec") return regSearch.exec(regString);
    else if(fct=="test") return regSearch.test(regString);
    else dv.errorMessage += "There is no fct-parameter given in the regSearch-call!";
  };
  // # regSearchNumber()
  DVObject.prototype.regSearchNumber = function(paramString) {
    if(!isFinite(paramString)) {
      return dv.regSearch(paramString, /[-]?\d+([,.]\d+)?/, "exec");
    } else dv.errorMessage += "The given string ("+paramString+") does not consist of a number!\n";
  };
  // # getMiddlePosition()
  DVObject.prototype.getMiddlePosition = function(ow, oh) {
    var sw = dv.getScreenSize("width", "inner");
    var sh = dv.getScreenSize("height", "inner");
    var mid = new Array(4);

    //look if the picture is bigger than the screen resolution
    if(sw<ow || sh<oh) {
      //which dimension is relatively bigger in comparison to the screen resolution
      if(sw/ow > sh/oh) {    //height is bigger
        var tmp = oh;
        oh = sh;
        ow = oh*ow/tmp;
      } else {               //width is bigger (or both)
        var tmp = ow;
        ow = sw;
        oh = ow*oh/tmp;
      }
    }

    mid["width"] = Math.round(ow);
    mid["height"] = Math.round(oh);
    if(sw/ow < sh/oh) mid["top"] = Math.round((sh-oh)/2)+'px'; else mid["top"] = Math.round((sh-oh)/2)+'px';
    if(sw/ow > sh/oh) mid["left"] = Math.round((sw-ow)/2)+'px'; else mid["left"] = Math.round((sw-ow)/2)+'px';

    //if you have scrollbars, you have to add the scrolled-pixel
    if(MS) {
      mid["top"] = parseInt(mid["top"])+standardbody.scrollTop+'px';
      mid["left"] = parseInt(mid["left"])+standardbody.scrollLeft+'px';
    } else {
      mid["top"] = parseInt(mid["top"])+window.pageYOffset+'px';
      mid["left"] = parseInt(mid["left"])+window.pageXOffset+'px';
    }

    return mid;
  };
  // # getScreenSize()
  DVObject.prototype.getScreenSize = function(whichSize, whichWindow) {
    var agt       = navigator.userAgent.toLowerCase();
    var isIE     = ((agt.indexOf("msie") != -1) && (agt.indexOf("opera") == -1));
    var isW3C    = (window.document.getElementById) ? true : false;

    var size;
    if(whichWindow=="inner") {
      if(isIE) {
        if(whichSize=='width') size = standardbody.offsetWidth;
        else size = standardbody.offsetHeight;
      } else if(isW3C) {
        if(whichSize=='width') size = window.innerWidth;
        else size = window.innerHeight;
      } else BrowserFailure();
    } else if(whichWindow=="outer") {
      if(whichSize=='width') size = screen.availWidth;
      if(whichSize=='height') size = screen.availHeight;
    } else if(whichWindow=="max") {
      if(whichSize=='width') size = screen.width;
      if(whichSize=='height') size = screen.height;
    } else ParameterFailure();
    return size;
  };
  // # setAllImagesArray()
  DVObject.prototype.setAllImagesArray = function(allImagesArray) {
    dv.allImages = allImagesArray;
  };
  // # checkBeforeAndNextImages()
  DVObject.prototype.checkBeforeAndNextImages = function(imgString) {
    //is an image-array provided by the page and are there more than 1 images in it
    if(!dv.allImages || !dv.allImages.length || dv.allImages.length<2)
    {
      with(dv.childDVBeforeAndNext.style) {
        visibility = "hidden";
      }
      return;
    }

    //check position of the current-displayed image
    dv.currentDisplayedImage = dv.getPositionOfImage(imgString);

    //show before-sign
    if(parseInt(dv.currentDisplayedImage)==0)
      dv.childDVBefore.style.visibility = "hidden";
    else
      dv.childDVBefore.style.visibility = "visible";

    //show next-sign
    if(parseInt(dv.currentDisplayedImage)==parseInt(dv.allImages.length)-1)
      dv.childDVNext.style.visibility = "hidden";
    else
      dv.childDVNext.style.visibility = "visible";

  };
  // # showLastImage()
  DVObject.prototype.showLastImage = function() {
    var tmp = dv.allImages[parseInt(dv.currentDisplayedImage)-1];
    dv.showDV(tmp);
  };
  // # showNextImage()
  DVObject.prototype.showNextImage = function() {
    var tmp = dv.allImages[parseInt(dv.currentDisplayedImage)+1];
    dv.showDV(tmp);
  };
  // # setOpacityStyle()
  DVObject.prototype.setOpacityStyle = function(styleObject) {
    with(styleObject)
    {
      opacity = dv.getOpacityValue("opacity");		//".50";
      filter = dv.getOpacityValue("filter");		//"alpha(opacity=50)"
      mozOpacity = dv.getOpacityValue("mozOpacity");	//"0.5";
    }
  };
  // # getOpacityValue()
  DVObject.prototype.getOpacityValue = function(opacityStyle) {
    if(opacityStyle=="opacity")
      return "."+bgOpacity;
    else if(opacityStyle=="filter")
      return "alpha(opacity="+bgOpacity+")";
    else if(opacityStyle=="mozOpacity")
    {
      var v = bgOpacity/100;
      return ""+v;
    }
    else
    {
      alert("Unknown kind of opacityStyle! Could not set opacity.");
      return bgOpacity;
    }
  };
  // # getPositionOfImage()
  DVObject.prototype.getPositionOfImage = function(imgString) {
    for(var index in dv.allImages)
    {
      if(dv.allImages[index]==imgString)
        return index;
    }
  };


  /**********************************************************************/
  /* DHTML-Bibliothek (www.teamone.de/selfhtml)                         */
  /**********************************************************************/

  var DHTML = 0, DOM = 0, MS = 0, NS = 0, OP = 0;

  function DHTML_init() {

   if (window.opera) {
       OP = 1;
   }
   if(document.getElementById) {
     DHTML = 1;
     DOM = 1;
   }
   if(document.all && !OP) {
     DHTML = 1;
     MS = 1;
   }
   if(document.layers && !OP) {
     DHTML = 1;
     NS = 1;
   }
  }

  function getElem(p1,p2,p3) {
 var Elem;
 if(DOM) {
   if(p1.toLowerCase()=="id") {
     if (typeof document.getElementById(p2) == "object")
     Elem = document.getElementById(p2);
     else Elem = void(0);
     return(Elem);
   }
   else if(p1.toLowerCase()=="name") {
     if (typeof document.getElementsByName(p2) == "object")
     Elem = document.getElementsByName(p2)[p3];
     else Elem = void(0);
     return(Elem);
   }
   else if(p1.toLowerCase()=="tagname") {
     if (typeof document.getElementsByTagName(p2) == "object" ||
        (OP && typeof document.getElementsByTagName(p2) == "function"))
     Elem = document.getElementsByTagName(p2)[p3];
     else Elem = void(0);
     return(Elem);
   }
   else return void(0);
 }
 else if(MS) {
   if(p1.toLowerCase()=="id") {
     if (typeof document.all[p2] == "object")
     Elem = document.all[p2];
     else Elem = void(0);
     return(Elem);
   }
   else if(p1.toLowerCase()=="tagname") {
     if (typeof document.all.tags(p2) == "object")
     Elem = document.all.tags(p2)[p3];
     else Elem = void(0);
     return(Elem);
   }
   else if(p1.toLowerCase()=="name") {
     if (typeof document[p2] == "object")
     Elem = document[p2];
     else Elem = void(0);
     return(Elem);
   }
   else return void(0);
 }
 else if(NS) {
   if(p1.toLowerCase()=="id" || p1.toLowerCase()=="name") {
   if (typeof document[p2] == "object")
     Elem = document[p2];
     else Elem = void(0);
     return(Elem);
   }
   else if(p1.toLowerCase()=="index") {
    if (typeof document.layers[p2] == "object")
     Elem = document.layers[p2];
    else Elem = void(0);
     return(Elem);
   }
   else return void(0);
 }
}

//the code for the view-div is written above the body-tag.. hope this does not matter
initDV();

function checkLoad() {
  //do nothing
}