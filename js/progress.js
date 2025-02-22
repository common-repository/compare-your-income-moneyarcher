(function( $ ) {

    var defaults = {
        img_url: "http://no.flyingtiger.com/Content/img/noPicture.png",
        size: 200,
        barSize: 12,
        backgroundColor: 'white',
        foregroundColor: 'red',
        backgroundSize: 'cover',
        percent: 0
    }

    //Init ImgProgress
    $.fn.cyiImgProgress = function(options) {
        var elm = this[0];

        //OPTIONS
        var img_url = $(elm).data("img") == null ? defaults.img_url : $(elm).data("img");
        var size = options.size == null ? defaults.size : options.size;
        var barSize = options.barSize == null ? defaults.barSize : options.barSize;
        var backgroundColor = options.backgroundColor == null ? defaults.backgroundColor : options.backgroundColor;
        var foregroundColor = options.foregroundColor == null ? defaults.foregroundColor : options.foregroundColor;
        var percent = $(elm).data("parcent") == null ? defaults.percent : $(elm).data("parcent");
        var backgroundSize = options.backgroundSize == null ? defaults.backgroundSize : options.backgroundSize;

        //CURRENT IMGPROGRESS
        var myClass = this[0];
        myClass.classList.add("imgProgress-round");
        myClass.classList.add("imgProgress-progress");
        myClass.style.width = size + "px";
        myClass.style.height = size + "px";

        //SVG
        var xmlns = "http://www.w3.org/2000/svg";
        var svg = document.createElementNS(xmlns, "svg");
        svg.setAttribute("class", "imgProgress-svg");
        svg.setAttributeNS(null, "viewBox", "0 0 32 32");
        svg.style.background = backgroundColor;
        svg.style.border = "1px solid" + backgroundColor;

        var circle = document.createElementNS(xmlns, "circle");
        circle.setAttribute("class", "imgProgress-circle");
        circle.setAttributeNS(null, "r", "16");
        circle.setAttributeNS(null, "cx", "16");
        circle.setAttributeNS(null, "cy", "16");
        circle.style.strokeDasharray = percent + " 100";
        circle.style.fill = backgroundColor;
        circle.style.stroke = foregroundColor;
        svg.appendChild(circle);
        myClass.appendChild(svg);

        //IMG
        var img = document.createElement("div");
        img.setAttribute("class", "imgProgress-img");
        img.style.background  = "url(" + img_url + ") 50% 50% no-repeat, white";
        img.style.backgroundSize = backgroundSize;
        img.style.width = (size - cyiGetPercent(barSize, size)) + "px";
        img.style.height = (size - cyiGetPercent(barSize, size)) + "px";
        img.style.top = (cyiGetPercent(barSize, size) / 2) + "px";
        img.style.left = (cyiGetPercent(barSize, size) / 2) + "px";
        myClass.appendChild(img);

    }
}( jQuery ));

function cyiGetPercent(percent, value) {
    return value * (percent / 100);
}
